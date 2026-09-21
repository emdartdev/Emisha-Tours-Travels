<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\InquiryService;
use App\Http\Requests\StoreContactMessageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        protected InquiryService $inquiryService,
        protected \App\Services\SeoService $seoService,
        protected \App\Services\TrackingService $trackingService
    ) {}

    public function index(): View
    {
        $breadcrumbs = [
            'Home' => route('home'),
            'Contact & Office Locations' => route('contact.index'),
        ];
        $breadcrumbSchema = $this->seoService->generateBreadcrumbSchema($breadcrumbs);
        $agencySchema = $this->seoService->generateTravelAgencySchema();
        $schema = $agencySchema . "\n" . $breadcrumbSchema;

        return view('public.contact.index', compact('schema'));
    }

    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        $contactMessage = $this->inquiryService->createContactMessage($request->validated());
        $ref = 'EMT-' . strtoupper(substr(uniqid(), -6));

        // Record telemetry conversion event
        $this->trackingService->recordEvent('contact_message', [
            'category' => 'conversion',
            'value' => 5000,
            'currency' => 'BDT',
            'page_title' => 'Contact Inquiry: ' . $request->input('service', 'General Inquiry'),
            'metadata' => [
                'reference' => $ref,
                'name' => $request->input('name'),
                'service' => $request->input('service', 'General Inquiry'),
            ]
        ], $request);

        return redirect()
            ->back()
            ->with('contact_success_modal', true)
            ->with('contact_reference', $ref)
            ->with('contact_name', $request->input('name'))
            ->with('contact_service', $request->input('service', 'General Inquiry'))
            ->with('contact_phone', $request->input('phone'))
            ->with('success', 'Thank you for contacting Emisha Tours & Travels! Our team has received your message and will respond promptly.');
    }
}
