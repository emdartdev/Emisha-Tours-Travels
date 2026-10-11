<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\VisaService;
use App\Services\VisaApplicationService;
use App\Services\VisaOnboardingService;
use App\Http\Requests\StoreVisaApplicationRequest;
use App\Models\VisaCountry;
use App\Models\VisaApplication;
use App\Models\ProfessionType;
use App\Services\FormSubmissionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VisaController extends Controller
{
    public function __construct(
        protected VisaService $visaService,
        protected VisaApplicationService $visaApplicationService,
        protected VisaOnboardingService $onboardingService,
        protected FormSubmissionService $formSubmissionService,
        protected \App\Services\SeoService $seoService,
        protected \App\Services\TrackingService $trackingService
    ) {}

    public function index(Request $request): View
    {
        $countries = $this->visaService->getActiveCountries();

        $breadcrumbs = [
            'Home' => route('home'),
            'Visa Processing & Consultancy' => route('visa.index'),
        ];
        $breadcrumbSchema = $this->seoService->generateBreadcrumbSchema($breadcrumbs);
        $itemListSchema = $this->seoService->generateItemListSchema('Country Visa Assistance & Processing Services', $countries, 'VisaCountry');
        $schema = $breadcrumbSchema . "\n" . $itemListSchema;

        return view('public.visa.index', compact('countries', 'schema'));
    }

    public function show(string $slug): View
    {
        $country = $this->visaService->getCountryBySlug($slug);
        $professions = $this->visaService->getProfessions();

        $breadcrumbs = [
            'Home' => route('home'),
            'Visa Services' => route('visa.index'),
            $country->name . ' Visa' => route('visa.show', $country->slug),
        ];
        $breadcrumbSchema = $this->seoService->generateBreadcrumbSchema($breadcrumbs);
        $visaSchema = $this->seoService->generateVisaServiceSchema($country);
        $schema = $visaSchema . "\n" . $breadcrumbSchema;

        return view('public.visa.show', compact('country', 'professions', 'schema'));
    }

    public function apply(Request $request, ?string $slug = null): View
    {
        $destinations = $this->onboardingService->getDestinations();
        $schengenCountries = $this->onboardingService->getSchengenCountries();
        $countries = $this->visaService->getActiveCountries();
        $professions = $this->visaService->getProfessions();

        $selectedSlug = $slug ?: $request->query('destination', $request->query('country', 'thailand'));
        
        // Match numeric country ID if passed
        if (is_numeric($selectedSlug)) {
            $matchedCountry = $countries->firstWhere('id', (int) $selectedSlug);
            if ($matchedCountry) {
                $selectedSlug = $matchedCountry->slug;
            }
        }

        if (!isset($destinations[$selectedSlug])) {
            $selectedSlug = 'thailand';
        }

        $activeDestination = $destinations[$selectedSlug];
        $selectedCountryId = $countries->firstWhere('slug', $selectedSlug)?->id;
        $selectedTypeId = $request->query('type');

        // Manage persistent submission token & check if already submitted
        if ($request->query('new') === '1') {
            $submissionToken = $this->formSubmissionService->rotateSessionToken('visa_apply');
            session()->forget('visa_onboarding_draft');
            session()->forget('visa_submitted_ref');
            $isAlreadySubmitted = false;
            $submittedApplicationData = null;
        } else {
            $submissionToken = $this->formSubmissionService->getOrCreateSessionToken('visa_apply');
            $existingApp = VisaApplication::where('submission_token', $submissionToken)->first();
            $isAlreadySubmitted = (bool) $existingApp;
            $submittedApplicationData = $existingApp ? [
                'reference_number' => $existingApp->reference_number,
                'country_name' => $existingApp->country->country_name ?? 'Destination',
                'flag' => $existingApp->country->flag ?? '✈️',
                'applicant_name' => $existingApp->full_name,
                'total_service_fee' => number_format($existingApp->total_service_fee, 0),
                'submitted_at' => $existingApp->submitted_at?->format('d M Y, h:i A') ?? now()->format('d M Y, h:i A'),
                'tracking_url' => route('visa.track.reference', ['reference' => $existingApp->reference_number]),
                'whatsapp_url' => "https://wa.me/8801805464294?text=" . urlencode("Hello Emisha Visa Desk, I have an inquiry about my submitted Visa Application Ref: {$existingApp->reference_number}."),
            ] : null;
        }

        // Restore draft data from session if any
        $draftData = session()->get('visa_onboarding_draft', []);

        // Retrieve current rate limiting upload quota status for client
        $identifier = $this->onboardingService->getUploadIdentifier($request->ip(), $request->user()?->email);
        $uploadQuota = $this->onboardingService->getUploadQuotaState($identifier);

        $matchedVisaCountry = $countries->firstWhere('slug', $selectedSlug);
        $breadcrumbs = [
            'Home' => route('home'),
            'Visa Processing' => route('visa.index'),
            ($matchedVisaCountry?->name ?? ucfirst($selectedSlug)) . ' Visa' => route('visa.show', $selectedSlug),
            'Apply Online' => route('visa.apply.slug', ['slug' => $selectedSlug]),
        ];
        $breadcrumbSchema = $this->seoService->generateBreadcrumbSchema($breadcrumbs);
        $visaSchema = $matchedVisaCountry ? $this->seoService->generateVisaServiceSchema($matchedVisaCountry) : '';
        $schema = ($visaSchema ? $visaSchema . "\n" : '') . $breadcrumbSchema;

        return view('public.visa.apply', compact(
            'destinations',
            'schengenCountries',
            'activeDestination',
            'selectedSlug',
            'countries',
            'professions',
            'selectedCountryId',
            'selectedTypeId',
            'draftData',
            'submissionToken',
            'isAlreadySubmitted',
            'submittedApplicationData',
            'uploadQuota',
            'schema'
        ));
    }

    public function storeApplication(StoreVisaApplicationRequest $request): RedirectResponse|JsonResponse
    {
        $data = $request->validated();
        $files = $request->allFiles();

        $submissionToken = $request->input('submission_token') ?: $this->formSubmissionService->getOrCreateSessionToken('visa_apply');
        $data['submission_token'] = $submissionToken;

        // Check if an application with this token already exists (Idempotent response)
        $existingApp = VisaApplication::where('submission_token', $submissionToken)->first();
        if ($existingApp) {
            session()->forget('visa_onboarding_draft');
            if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'is_existing' => true,
                    'reference_number' => $existingApp->reference_number,
                    'country_name' => $existingApp->country->country_name ?? 'Destination',
                    'flag' => $existingApp->country->flag ?? '✈️',
                    'applicant_name' => $existingApp->full_name,
                    'email' => $existingApp->email,
                    'phone' => $existingApp->phone,
                    'passport_number' => $existingApp->passport_number,
                    'travel_date' => $existingApp->travel_date ? $existingApp->travel_date->format('d M Y') : 'Tentative',
                    'application_status' => $existingApp->status,
                    'formatted_status' => $existingApp->formatted_status,
                    'status_badge_class' => $existingApp->status_badge_class,
                    'total_service_fee' => number_format($existingApp->total_service_fee, 0),
                    'tracking_url' => route('visa.track.reference', ['reference' => $existingApp->reference_number]),
                    'whatsapp_url' => "https://wa.me/8801805464294?text=" . urlencode("Hello Emisha Visa Desk, I have just submitted my Visa Application (Ref: {$existingApp->reference_number}) for " . ($existingApp->country->country_name ?? 'Visa') . "."),
                    'message' => "Application is already submitted. Reference ID: {$existingApp->reference_number}."
                ]);
            }

            return redirect()
                ->route('visa.track.reference', ['reference' => $existingApp->reference_number])
                ->with('success', "Your Visa Application has already been submitted! Reference ID: {$existingApp->reference_number}.")
                ->with('show_status_modal', true);
        }

        // Acquire lock against rapid concurrent double-click attempts
        $this->formSubmissionService->acquireSubmissionLock($submissionToken);

        // Check and enforce rate limiting & 3-attempt quota on custom file uploads
        if (!empty($files)) {
            $identifier = $this->onboardingService->getUploadIdentifier($request->ip(), $data['email'] ?? null);
            $this->onboardingService->validateAndRecordUploadAttempt($identifier, count($files));
        }

        // If legacy direct country_id provided without destination_slug, map slug
        if (empty($data['destination_slug']) && !empty($data['visa_country_id'])) {
            $country = VisaCountry::find($data['visa_country_id']);
            if ($country) {
                $data['destination_slug'] = $country->slug;
            }
        }

        $application = $this->onboardingService->submitApplication($data, $files);

        // Release submission lock
        $this->formSubmissionService->releaseSubmissionLock($submissionToken);

        // Record telemetry conversion event
        $this->trackingService->recordEvent('visa_application', [
            'category' => 'conversion',
            'value' => (float) $application->total_service_fee,
            'currency' => 'BDT',
            'page_title' => "Visa Application: {$application->country?->country_name}",
            'metadata' => [
                'country_id' => $application->visa_country_id,
                'country_name' => $application->country?->country_name,
                'reference' => $application->reference_number,
                'applicant_name' => $application->full_name,
            ]
        ], $request);

        // Clear session draft
        session()->forget('visa_onboarding_draft');

        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'reference_number' => $application->reference_number,
                'country_name' => $application->country->country_name ?? 'Destination',
                'flag' => $application->country->flag ?? '✈️',
                'applicant_name' => $application->full_name,
                'email' => $application->email,
                'phone' => $application->phone,
                'passport_number' => $application->passport_number,
                'travel_date' => $application->travel_date ? $application->travel_date->format('d M Y') : 'Tentative',
                'application_status' => $application->status,
                'formatted_status' => $application->formatted_status,
                'status_badge_class' => $application->status_badge_class,
                'total_service_fee' => number_format($application->total_service_fee, 0),
                'tracking_url' => route('visa.track.reference', ['reference' => $application->reference_number]),
                'whatsapp_url' => "https://wa.me/8801805464294?text=" . urlencode("Hello Emisha Visa Desk, I have just submitted my Visa Application (Ref: {$application->reference_number}) for {$application->country->country_name}."),
                'message' => "Your Visa Application for {$application->country->country_name} has been successfully submitted! Reference ID: {$application->reference_number}."
            ]);
        }

        return redirect()
            ->route('visa.track.reference', ['reference' => $application->reference_number])
            ->with('success', "Your Visa Application for {$application->country->country_name} has been successfully submitted! Reference ID: {$application->reference_number}.")
            ->with('show_status_modal', true);
    }

    public function checkUploadQuota(Request $request): JsonResponse
    {
        $email = $request->query('email') ?: $request->input('email');
        $identifier = $this->onboardingService->getUploadIdentifier($request->ip(), $email);
        $quota = $this->onboardingService->getUploadQuotaState($identifier);

        return response()->json([
            'status' => 'success',
            'quota' => $quota,
        ]);
    }

    public function track(Request $request, ?string $reference = null): View
    {
        $refNumber = $reference ?: $request->query('reference', $request->query('ref'));
        $application = null;
        $errorMessage = null;

        if ($refNumber) {
            $application = VisaApplication::with(['country', 'visaType', 'documents'])
                ->where('reference_number', strtoupper(trim($refNumber)))
                ->first();

            if (!$application) {
                $errorMessage = "No visa application record was found for reference number: " . e($refNumber);
            }
        }

        return view('public.visa.track', compact('application', 'refNumber', 'errorMessage'));
    }

    public function saveDraft(Request $request): JsonResponse
    {
        $data = $request->all();
        session()->put('visa_onboarding_draft', $data);

        return response()->json([
            'status' => 'success',
            'message' => 'Progress auto-saved successfully.',
            'saved_at' => now()->toIso8601String(),
        ]);
    }

    public function getDestinationChecklist(Request $request): JsonResponse
    {
        $slug = $request->query('slug', 'thailand');
        $formData = $request->all();
        $checklist = $this->onboardingService->evaluateDocumentChecklist($slug, $formData);
        $config = $this->onboardingService->getDestinationConfig($slug);

        return response()->json([
            'status' => 'success',
            'destination' => $config,
            'checklist' => $checklist,
        ]);
    }
}
