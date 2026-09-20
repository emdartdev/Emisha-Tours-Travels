<?php

namespace App\Services;

use App\Models\VisaApplication;
use App\Models\VisaCountry;
use App\Models\VisaDocument;
use App\Models\VisaType;
use App\Models\ProfessionType;
use App\Support\ReferenceGenerator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VisaOnboardingService
{
    /**
     * Get all supported destinations from config.
     */
    public function getDestinations(): array
    {
        return config('visa_onboarding.destinations', []);
    }

    /**
     * Get configuration for a specific destination slug.
     */
    public function getDestinationConfig(string $slug): ?array
    {
        $destinations = $this->getDestinations();
        return $destinations[$slug] ?? null;
    }

    /**
     * Get Schengen member countries.
     */
    public function getSchengenCountries(): array
    {
        return config('visa_onboarding.schengen_countries', []);
    }

    /**
     * Calculate Schengen main destination based on days/nights in each country.
     */
    public function calculateSchengenMainDestination(array $countryStays, ?string $firstEntryCountry = null): array
    {
        if (empty($countryStays)) {
            return [
                'main_country' => $firstEntryCountry ?: 'France',
                'is_tie' => false,
                'max_nights' => 0,
            ];
        }

        $maxNights = -1;
        $longestCountries = [];

        foreach ($countryStays as $country => $nights) {
            $nights = (int) $nights;
            if ($nights > $maxNights) {
                $maxNights = $nights;
                $longestCountries = [$country];
            } elseif ($nights === $maxNights && $maxNights > 0) {
                $longestCountries[] = $country;
            }
        }

        $isTie = count($longestCountries) > 1;
        $mainCountry = $longestCountries[0] ?? ($firstEntryCountry ?: 'France');

        // If tie, prefer first entry country if it's one of the tied countries
        if ($isTie && $firstEntryCountry && in_array($firstEntryCountry, $longestCountries)) {
            $mainCountry = $firstEntryCountry;
        }

        return [
            'main_country' => $mainCountry,
            'is_tie' => $isTie,
            'tied_countries' => $longestCountries,
            'max_nights' => $maxNights,
        ];
    }

    /**
     * Dynamically evaluate required and optional documents based on destination and applicant profile.
     */
    public function evaluateDocumentChecklist(string $countrySlug, array $formData): array
    {
        $destConfig = $this->getDestinationConfig($countrySlug);
        if (!$destConfig) {
            return [];
        }

        $checklist = [];
        $baseDocs = $destConfig['base_documents'] ?? [];

        foreach ($baseDocs as $code => $doc) {
            $checklist[$code] = array_merge($doc, [
                'origin' => 'base',
                'is_conditional' => false,
            ]);
        }

        $conditionalRules = config('visa_onboarding.conditional_documents', []);
        $occupation = strtolower($formData['employment_status'] ?? $formData['occupation'] ?? '');
        $fundingSource = strtolower($formData['funding_source'] ?? $formData['paying_for_trip'] ?? 'self');
        $travelPurpose = strtolower($formData['travel_purpose'] ?? 'tourism');
        $hasRefusal = !empty($formData['has_visa_refusal']) && in_array(strtolower($formData['has_visa_refusal']), ['yes', '1', 'true']);

        // Employment conditionals
        if (in_array($occupation, ['employed', 'salaried', 'job', 'private_job', 'govt_job'])) {
            if (isset($conditionalRules['employed'])) {
                $checklist['employment_noc'] = array_merge($conditionalRules['employed'], [
                    'origin' => 'employment',
                    'is_conditional' => true,
                    'condition_reason' => 'Required for employed applicants',
                ]);
            }
            if (isset($conditionalRules['pay_slips'])) {
                $checklist['pay_slips'] = array_merge($conditionalRules['pay_slips'], [
                    'origin' => 'employment',
                    'is_conditional' => true,
                    'condition_reason' => 'Recommended salary evidence',
                ]);
            }
        } elseif (in_array($occupation, ['business', 'business_owner', 'self_employed', 'entrepreneur', 'director'])) {
            if (isset($conditionalRules['business'])) {
                $checklist['business_registration'] = array_merge($conditionalRules['business'], [
                    'origin' => 'business',
                    'is_conditional' => true,
                    'condition_reason' => 'Required for business owners / self-employed',
                ]);
            }
            if (isset($conditionalRules['company_letterhead'])) {
                $checklist['company_letterhead'] = array_merge($conditionalRules['company_letterhead'], [
                    'origin' => 'business',
                    'is_conditional' => true,
                    'condition_reason' => 'Recommended company forwarding letter',
                ]);
            }
        } elseif (in_array($occupation, ['student', 'university_student', 'school_student'])) {
            if (isset($conditionalRules['student'])) {
                $checklist['student_id_noc'] = array_merge($conditionalRules['student'], [
                    'origin' => 'education',
                    'is_conditional' => true,
                    'condition_reason' => 'Required for students (ID & institutional leave)',
                ]);
            }
        }

        // Host / Invitation conditionals
        if (str_contains($travelPurpose, 'family') || str_contains($travelPurpose, 'friend') || str_contains($travelPurpose, 'visit')) {
            if (isset($conditionalRules['invitation_letter'])) {
                $checklist['invitation_letter'] = array_merge($conditionalRules['invitation_letter'], [
                    'origin' => 'purpose',
                    'is_conditional' => true,
                    'condition_reason' => 'Required when visiting family or friends',
                ]);
            }
        }

        // Sponsor conditionals
        if (in_array($fundingSource, ['sponsored', 'family_funded', 'sponsor', 'employer_funded'])) {
            if (isset($conditionalRules['sponsor_documents'])) {
                $checklist['sponsor_documents'] = array_merge($conditionalRules['sponsor_documents'], [
                    'origin' => 'sponsor',
                    'is_conditional' => true,
                    'condition_reason' => 'Required when trip is sponsored by another entity/family',
                ]);
            }
        }

        // Refusal history conditionals
        if ($hasRefusal && isset($conditionalRules['refusal_letter'])) {
            $checklist['refusal_letter'] = array_merge($conditionalRules['refusal_letter'], [
                'origin' => 'history',
                'is_conditional' => true,
                'condition_reason' => 'Optional: Helps address previous refusal reasons',
            ]);
        }

        return $checklist;
    }

    /**
     * Validate passport expiry according to destination rules.
     */
    public function validatePassportValidity(string $countrySlug, ?string $expiryDate, ?string $travelDate = null): array
    {
        if (empty($expiryDate)) {
            return ['valid' => false, 'message' => 'Passport expiry date is required.'];
        }

        try {
            $expiry = Carbon::parse($expiryDate);
            $travel = $travelDate ? Carbon::parse($travelDate) : Carbon::today();
            $destConfig = $this->getDestinationConfig($countrySlug);
            $monthsReq = $destConfig['passport_validity_months'] ?? 6;

            if ($expiry->isPast()) {
                return [
                    'valid' => false,
                    'message' => 'Your passport has already expired on ' . $expiry->format('d M Y') . '. Please renew your passport before applying.',
                ];
            }

            $diffMonths = $travel->diffInMonths($expiry, false);

            if ($diffMonths < $monthsReq) {
                return [
                    'valid' => false,
                    'message' => "Selected destination ({$destConfig['name']}) requires at least {$monthsReq} months passport validity from intended travel date. Your passport has only ~{$diffMonths} months validity remaining.",
                ];
            }

            return ['valid' => true, 'message' => 'Passport validity meets destination requirements.'];
        } catch (\Exception $e) {
            return ['valid' => false, 'message' => 'Invalid passport expiry date format.'];
        }
    }

    /**
     * Validate specific step data and return clean error array.
     */
    public function validateStep(int $step, array $data, string $countrySlug): array
    {
        $errors = [];

        switch ($step) {
            case 1: // Destination Selection
                if (empty($data['destination_slug']) && empty($countrySlug)) {
                    $errors['destination_slug'] = 'Please select a destination country.';
                }
                break;

            case 2: // Basic Applicant Profile
                if (empty(trim($data['full_name'] ?? ''))) {
                    $errors['full_name'] = 'Full legal name is required as per passport.';
                }
                if (empty(trim($data['email'] ?? '')) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'A valid email address is required.';
                }
                if (empty(trim($data['phone'] ?? ''))) {
                    $errors['phone'] = 'Mobile or WhatsApp number is required.';
                }
                if (empty($data['date_of_birth'])) {
                    $errors['date_of_birth'] = 'Date of birth is required.';
                }
                if (($data['living_in_bangladesh'] ?? 'yes') === 'no') {
                    if (empty(trim($data['residence_country'] ?? ''))) {
                        $errors['residence_country'] = 'Please specify your current country of residence.';
                    }
                    if (empty(trim($data['residence_status'] ?? ''))) {
                        $errors['residence_status'] = 'Please specify your residence permit/visa status in that country.';
                    }
                }
                break;

            case 3: // Passport Information
                if (empty(trim($data['passport_number'] ?? ''))) {
                    $errors['passport_number'] = 'Passport number is required.';
                }
                if (empty($data['passport_expiry_date'])) {
                    $errors['passport_expiry_date'] = 'Passport expiry date is required.';
                } else {
                    $val = $this->validatePassportValidity($countrySlug, $data['passport_expiry_date'], $data['travel_date'] ?? null);
                    if (!$val['valid']) {
                        $errors['passport_expiry_date'] = $val['message'];
                    }
                }
                break;

            case 4: // Travel Purpose & Host
                if (empty($data['travel_purpose'])) {
                    $errors['travel_purpose'] = 'Please select your primary purpose of travel.';
                }
                if (($data['travel_purpose'] ?? '') === 'visiting_family_friends') {
                    if (empty(trim($data['host_name'] ?? ''))) {
                        $errors['host_name'] = 'Host full name is required when visiting family or friends.';
                    }
                    if (empty(trim($data['host_phone'] ?? ''))) {
                        $errors['host_phone'] = 'Host contact number is required.';
                    }
                }
                break;

            case 5: // Travel Details & Schengen Matrix
                if (empty($data['travel_date'])) {
                    $errors['travel_date'] = 'Tentative departure date is required.';
                }
                if ($countrySlug === 'europe-schengen') {
                    if (empty($data['schengen_countries']) || !is_array($data['schengen_countries']) || count($data['schengen_countries']) === 0) {
                        $errors['schengen_countries'] = 'Please select at least one Schengen destination country.';
                    }
                }
                break;

            case 6: // Employment & Financial Profile
                if (empty($data['employment_status'])) {
                    $errors['employment_status'] = 'Please select your current occupation / employment status.';
                }
                $occ = strtolower($data['employment_status'] ?? '');
                if (in_array($occ, ['employed', 'salaried']) && empty(trim($data['employer_name'] ?? ''))) {
                    $errors['employer_name'] = 'Employer / Company name is required.';
                }
                if (in_array($occ, ['business', 'business_owner', 'self_employed']) && empty(trim($data['business_name'] ?? ''))) {
                    $errors['business_name'] = 'Business / Organization name is required.';
                }
                if ($occ === 'student' && empty(trim($data['institution_name'] ?? ''))) {
                    $errors['institution_name'] = 'Educational institution name is required.';
                }
                break;

            case 7: // Travel History & Refusals
                if (($data['has_visa_refusal'] ?? 'no') === 'yes') {
                    if (empty(trim($data['refusal_country'] ?? ''))) {
                        $errors['refusal_country'] = 'Please specify the country that issued the previous refusal.';
                    }
                }
                break;

            case 8: // Co-Travelers
                // Optional, but if co-travelers added validate names
                if (!empty($data['co_travelers']) && is_array($data['co_travelers'])) {
                    foreach ($data['co_travelers'] as $idx => $trav) {
                        if (empty(trim($trav['name'] ?? ''))) {
                            $errors["co_travelers.{$idx}.name"] = "Co-traveler #" . ($idx + 1) . " full name is required.";
                        }
                    }
                }
                break;

            case 9: // Accommodation
                if (empty($data['accommodation_type'])) {
                    $errors['accommodation_type'] = 'Please select your intended accommodation type.';
                }
                break;

            case 10: // Flight / Itinerary
                // Optional details
                break;
        }

        return $errors;
    }

    /**
     * Submit application and persist complete onboarding record with private encrypted documents.
     */
    public function submitApplication(array $data, array $uploadedFiles = []): VisaApplication
    {
        $countrySlug = $data['destination_slug'] ?? 'thailand';
        $destConfig = $this->getDestinationConfig($countrySlug);

        // Resolve or create VisaCountry & VisaType models
        $country = VisaCountry::where('slug', $countrySlug)->first();
        if (!$country) {
            $country = VisaCountry::firstOrCreate(
                ['slug' => $countrySlug],
                [
                    'country_name' => $destConfig['name'] ?? ucfirst($countrySlug),
                    'flag' => $destConfig['flag'] ?? '🌐',
                    'status' => 'active',
                    'short_description' => $destConfig['summary'] ?? '',
                ]
            );
        }

        $visaType = $country->visaTypes()->first();
        if (!$visaType) {
            $visaType = VisaType::firstOrCreate(
                ['visa_country_id' => $country->id, 'slug' => "{$countrySlug}-tourist"],
                [
                    'name' => $destConfig['visa_category'] ?? 'Tourist Visa',
                    'starting_fee' => $destConfig['service_fee'] ?? 6000.00,
                    'service_fee' => 0.00,
                    'validity' => $destConfig['validity'] ?? '90 Days',
                    'stay_period' => $destConfig['stay_period'] ?? '30 Days',
                    'currency' => 'BDT',
                    'status' => 'active',
                ]
            );
        }

        // Resolve ProfessionType
        $professionSlug = Str::slug($data['employment_status'] ?? 'general');
        $profession = ProfessionType::where('slug', $professionSlug)->first()
            ?? ProfessionType::firstOrCreate(
                ['slug' => $professionSlug ?: 'general'],
                ['name' => ucwords(str_replace('_', ' ', $data['employment_status'] ?? 'General'))]
            );

        $refNumber = ReferenceGenerator::visa();
        $serviceFee = (float) ($destConfig['service_fee'] ?? 6000.00);

        // Structured JSON Payloads
        $applicantProfile = [
            'gender' => $data['gender'] ?? 'Not Specified',
            'marital_status' => $data['marital_status'] ?? 'Single',
            'living_in_bangladesh' => $data['living_in_bangladesh'] ?? 'yes',
            'current_city' => $data['current_city'] ?? 'Dhaka',
            'residence_country' => $data['residence_country'] ?? 'Bangladesh',
            'residence_status' => $data['residence_status'] ?? 'Citizen',
            'whatsapp' => $data['whatsapp'] ?? $data['phone'] ?? '',
            'documents_drive_link' => $data['documents_drive_link'] ?? null,
            'submission_channel' => $data['submission_channel'] ?? (!empty($data['documents_drive_link']) ? 'gdrive_link' : (!empty($uploadedFiles) ? 'file_upload' : 'whatsapp_direct')),
        ];

        $passportDetails = [
            'passport_type' => $data['passport_type'] ?? 'Regular / Ordinary',
            'passport_number' => strtoupper($data['passport_number'] ?? ''),
            'issue_date' => $data['passport_issue_date'] ?? null,
            'expiry_date' => $data['passport_expiry_date'] ?? null,
            'issuing_country' => $data['passport_issuing_country'] ?? 'Bangladesh',
            'place_of_birth' => $data['place_of_birth'] ?? 'Bangladesh',
            'printed_name' => $data['passport_printed_name'] ?? $data['full_name'] ?? '',
        ];

        $travelDetails = [
            'departure_date' => $data['travel_date'] ?? null,
            'return_date' => $data['return_date'] ?? null,
            'duration_days' => $data['stay_duration'] ?? '7-10 Days',
            'cities_to_visit' => $data['cities_to_visit'] ?? '',
            'travel_purpose' => $data['travel_purpose'] ?? 'Tourism',
            'schengen_countries' => $data['schengen_countries'] ?? [],
            'schengen_nights' => $data['schengen_nights'] ?? [],
            'main_destination' => $data['main_destination'] ?? $country->country_name,
            'first_entry_country' => $data['first_entry_country'] ?? null,
        ];

        $employmentDetails = [
            'employment_status' => $data['employment_status'] ?? 'Employed',
            'employer_name' => $data['employer_name'] ?? null,
            'job_title' => $data['job_title'] ?? null,
            'company_address' => $data['company_address'] ?? null,
            'employment_start_date' => $data['employment_start_date'] ?? null,
            'business_name' => $data['business_name'] ?? null,
            'business_type' => $data['business_type'] ?? null,
            'institution_name' => $data['institution_name'] ?? null,
            'student_id' => $data['student_id'] ?? null,
            'monthly_income_bdt' => $data['monthly_income'] ?? null,
        ];

        $financialDetails = [
            'monthly_income' => $data['monthly_income'] ?? null,
            'available_funds_bdt' => $data['available_funds'] ?? null,
            'has_bank_statement' => $data['has_bank_statement'] ?? 'yes',
            'funding_source' => $data['funding_source'] ?? 'Self-funded',
            'sponsor_name' => $data['sponsor_name'] ?? null,
            'sponsor_relationship' => $data['sponsor_relationship'] ?? null,
            'sponsor_contact' => $data['sponsor_contact'] ?? null,
        ];

        $travelHistory = [
            'has_travelled_internationally' => $data['has_travelled'] ?? 'no',
            'countries_visited' => $data['countries_visited'] ?? '',
            'previous_visas' => $data['previous_visas'] ?? [],
            'has_visa_refusal' => $data['has_visa_refusal'] ?? 'no',
            'refusal_country' => $data['refusal_country'] ?? null,
            'refusal_year' => $data['refusal_year'] ?? null,
            'refusal_reason' => $data['refusal_reason'] ?? null,
        ];

        $coTravelers = $data['co_travelers'] ?? [];

        $accommodationDetails = [
            'type' => $data['accommodation_type'] ?? 'Hotel',
            'hotel_name' => $data['hotel_name'] ?? null,
            'hotel_address' => $data['hotel_address'] ?? null,
            'booking_reference' => $data['booking_reference'] ?? null,
            'host_name' => $data['host_name'] ?? null,
            'host_address' => $data['host_address'] ?? null,
            'host_phone' => $data['host_phone'] ?? null,
            'host_relationship' => $data['host_relationship'] ?? null,
        ];

        $flightDetails = [
            'departure_city' => $data['departure_city'] ?? 'Dhaka (DAC)',
            'arrival_city' => $data['arrival_city'] ?? '',
            'flight_type' => $data['flight_type'] ?? 'Round-trip',
            'transit_countries' => $data['transit_countries'] ?? null,
        ];

        $pricingBreakdown = [
            'service_fee' => $serviceFee,
            'service_fee_label' => $destConfig['service_fee_label'] ?? 'Our Service Fee',
            'govt_fee_note' => $destConfig['govt_fee_note'] ?? 'Not included / calculated separately',
            'total_payable_now' => $serviceFee,
            'currency' => 'BDT',
        ];

        // Create VisaApplication Record
        $application = VisaApplication::create([
            'reference_number' => $refNumber,
            'visa_country_id' => $country->id,
            'visa_type_id' => $visaType->id,
            'profession_type_id' => $profession->id,
            'full_name' => trim($data['full_name'] ?? 'Applicant'),
            'email' => strtolower(trim($data['email'] ?? '')),
            'phone' => trim($data['phone'] ?? ''),
            'date_of_birth' => !empty($data['date_of_birth']) ? $data['date_of_birth'] : null,
            'nationality' => $data['nationality'] ?? 'Bangladeshi',
            'passport_number' => strtoupper(trim($data['passport_number'] ?? '')),
            'applicant_profile' => $applicantProfile,
            'passport_details' => $passportDetails,
            'travel_purpose' => $data['travel_purpose'] ?? 'Tourism',
            'travel_date' => !empty($data['travel_date']) ? $data['travel_date'] : null,
            'stay_duration' => $data['stay_duration'] ?? '7-10 Days',
            'travelers_count' => count($coTravelers) + 1,
            'travel_details' => $travelDetails,
            'employment_details' => $employmentDetails,
            'financial_details' => $financialDetails,
            'travel_history' => $travelHistory,
            'co_travelers' => $coTravelers,
            'accommodation_details' => $accommodationDetails,
            'flight_details' => $flightDetails,
            'pricing_breakdown' => $pricingBreakdown,
            'workflow_type' => $destConfig['workflow_type'] ?? 'evisa',
            'payment_status' => $data['payment_method'] ?? 'pending',
            'total_service_fee' => $serviceFee,
            'currency' => 'BDT',
            'status' => 'received',
            'applicant_notes' => $data['applicant_notes'] ?? null,
            'submitted_at' => now(),
        ]);

        // Process Attached Files and store securely in visa_private disk
        $checklist = $this->evaluateDocumentChecklist($countrySlug, $data);

        // Flatten any nested file arrays (e.g. ['documents' => [...]])
        $flatFiles = [];
        foreach ($uploadedFiles as $k => $item) {
            if ($item instanceof UploadedFile) {
                $flatFiles[$k] = $item;
            } elseif (is_array($item)) {
                foreach ($item as $subK => $subFile) {
                    if ($subFile instanceof UploadedFile) {
                        $flatFiles[$subK] = $subFile;
                    }
                }
            }
        }

        foreach ($flatFiles as $docKey => $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $docMeta = $checklist[$docKey] ?? [
                    'name' => ucwords(str_replace('_', ' ', $docKey)),
                    'category' => 'Additional',
                    'required' => false,
                ];

                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $storedName = Str::random(32) . '.' . $extension;
                $yearMonth = date('Y/m');
                $relativePath = "{$yearMonth}/{$storedName}";

                // Save to private disk
                Storage::disk('visa_private')->putFileAs($yearMonth, $file, $storedName);

                VisaDocument::create([
                    'visa_application_id' => $application->id,
                    'document_type' => $docKey,
                    'document_code' => $docKey,
                    'required' => $docMeta['required'] ?? false,
                    'original_filename' => $originalName,
                    'stored_filename' => $storedName,
                    'mime_type' => $file->getClientMimeType() ?? 'application/octet-stream',
                    'file_size' => $file->getSize() ?: 0,
                    'storage_path' => $relativePath,
                    'status' => 'uploaded',
                    'review_status' => 'uploaded',
                    'uploaded_at' => now(),
                ]);
            }
        }

        // If Google Drive link was provided, register a specialized document record
        if (!empty($data['documents_drive_link'])) {
            VisaDocument::create([
                'visa_application_id' => $application->id,
                'document_type' => 'gdrive_link',
                'document_code' => 'google_drive_folder',
                'required' => true,
                'original_filename' => 'Google Drive Dossier Folder',
                'stored_filename' => $data['documents_drive_link'],
                'mime_type' => 'text/uri-list',
                'file_size' => 0,
                'storage_path' => $data['documents_drive_link'],
                'status' => 'uploaded',
                'review_status' => 'uploaded',
                'uploaded_at' => now(),
            ]);
        }

        return $application;
    }

    /**
     * Generate unique identifier for upload rate limiting based on IP and email.
     */
    public function getUploadIdentifier(string $ip, ?string $email = null): string
    {
        $normalizedEmail = strtolower(trim($email ?? ''));
        return sha1("visa_upload_{$ip}_{$normalizedEmail}");
    }

    /**
     * Get current upload quota and cooldown status for a user / IP.
     */
    public function getUploadQuotaState(string $identifier): array
    {
        $data = Cache::get("visa_quota_{$identifier}", [
            'attempts' => 0,
            'next_allowed_at' => 0,
        ]);

        $attempts = (int) ($data['attempts'] ?? 0);
        $nextAllowedAt = (int) ($data['next_allowed_at'] ?? 0);
        $now = time();

        $remainingSeconds = max(0, $nextAllowedAt - $now);
        $maxAttempts = 3;
        $maxReached = $attempts >= $maxAttempts;
        $isCooldown = !$maxReached && $remainingSeconds > 0;

        return [
            'attempts' => $attempts,
            'max_attempts' => $maxAttempts,
            'remaining_attempts' => max(0, $maxAttempts - $attempts),
            'next_allowed_at' => $nextAllowedAt,
            'remaining_seconds' => $remainingSeconds,
            'is_blocked' => $maxReached || $isCooldown,
            'is_cooldown' => $isCooldown,
            'max_reached' => $maxReached,
            'whatsapp_helpline' => config('visa_onboarding.visa_support_whatsapp', '+880 1805-464294'),
            'whatsapp_raw' => config('visa_onboarding.visa_support_whatsapp_raw', '8801805464294'),
        ];
    }

    /**
     * Validate and record a file upload attempt. Throws ValidationException if blocked.
     */
    public function validateAndRecordUploadAttempt(string $identifier, int $fileCount = 1): void
    {
        if ($fileCount <= 0) {
            return;
        }

        $quota = $this->getUploadQuotaState($identifier);

        if ($quota['max_reached']) {
            throw ValidationException::withMessages([
                'files' => [
                    'You have reached the maximum allowed file upload limit (3 of 3 attempts used). To upload additional files or submit documents directly, please contact our Visa Desk on WhatsApp (+8801805464294) or attach a Google Drive link.'
                ]
            ]);
        }

        if ($quota['is_cooldown']) {
            $mins = ceil($quota['remaining_seconds'] / 60);
            $timeText = $mins > 60 ? (round($mins / 60, 1) . ' hours') : "{$mins} minute(s)";
            throw ValidationException::withMessages([
                'files' => [
                    "Security cooldown active: Please wait {$timeText} before submitting files again. If you want to fast-forward immediately, contact our Visa Consultation Support on WhatsApp: +8801805464294."
                ]
            ]);
        }

        // Advance quota
        $newAttempts = $quota['attempts'] + 1;
        $cooldownSeconds = 0;
        if ($newAttempts === 1) {
            $cooldownSeconds = 300; // 5 minutes after 1st upload
        } elseif ($newAttempts === 2) {
            $cooldownSeconds = 3600; // 1 hour after 2nd upload
        } else {
            $cooldownSeconds = 86400 * 30; // 30 days lock after 3rd upload
        }

        Cache::put("visa_quota_{$identifier}", [
            'attempts' => $newAttempts,
            'next_allowed_at' => time() + $cooldownSeconds,
        ], now()->addDays(30));
    }

    /**
     * Reset upload quota for testing or customer support fast-forward.
     */
    public function resetUploadQuota(string $identifier): void
    {
        Cache::forget("visa_quota_{$identifier}");
    }
}
