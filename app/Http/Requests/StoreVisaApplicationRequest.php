<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisaApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // If destination_slug is provided, resolve corresponding visa_country_id and visa_type_id
        if ($this->filled('destination_slug')) {
            $slug = $this->input('destination_slug');
            $country = \App\Models\VisaCountry::where('slug', $slug)->first();
            
            if (!$country) {
                $destConfig = config("visa_onboarding.destinations.{$slug}");
                if ($destConfig) {
                    $country = \App\Models\VisaCountry::firstOrCreate(
                        ['slug' => $slug],
                        [
                            'country_name' => $destConfig['name'] ?? ucfirst(str_replace('-', ' ', $slug)),
                            'flag' => $destConfig['flag'] ?? '✈️',
                            'is_active' => true,
                        ]
                    );
                }
            }

            if ($country) {
                $this->merge(['visa_country_id' => $country->id]);
                
                $type = null;
                if ($this->filled('visa_type_id')) {
                    $type = \App\Models\VisaType::where('id', $this->input('visa_type_id'))
                        ->where('visa_country_id', $country->id)
                        ->first();
                }

                if (!$type) {
                    $type = $country->visaTypes()->first();
                }

                if (!$type) {
                    $destConfig = config("visa_onboarding.destinations.{$slug}");
                    $type = $country->visaTypes()->create([
                        'type_name' => $destConfig['visa_category'] ?? 'Tourist Visa',
                        'validity' => $destConfig['validity'] ?? '90 Days',
                        'processing_time' => $destConfig['processing_time'] ?? '5-7 Working Days',
                        'price' => (float) ($destConfig['service_fee'] ?? 6000.00),
                        'entry_type' => 'Single Entry',
                        'is_active' => true,
                    ]);
                }

                if ($type) {
                    $this->merge(['visa_type_id' => $type->id]);
                }
            }
        } elseif ($this->filled('visa_country_id') && !$this->filled('visa_type_id')) {
            $country = \App\Models\VisaCountry::find($this->input('visa_country_id'));
            if ($country) {
                $firstType = $country->visaTypes()->first();
                if ($firstType) {
                    $this->merge(['visa_type_id' => $firstType->id]);
                }
            }
        }
    }

    public function rules(): array
    {
        return [
            'destination_slug' => ['nullable', 'string', 'max:100'],
            'visa_country_id' => ['required_without:destination_slug', 'nullable', 'exists:visa_countries,id'],
            'visa_type_id' => ['required_without:destination_slug', 'nullable', 'exists:visa_types,id'],
            'profession_type_id' => ['nullable', 'exists:profession_types,id'],
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'passport_number' => ['nullable', 'string', 'max:50'],
            'passport_type' => ['nullable', 'string', 'max:50'],
            'passport_issue_date' => ['nullable', 'date'],
            'passport_expiry_date' => ['nullable', 'date'],
            'passport_issuing_country' => ['nullable', 'string', 'max:100'],
            'place_of_birth' => ['nullable', 'string', 'max:100'],
            'gender' => ['nullable', 'string', 'max:30'],
            'marital_status' => ['nullable', 'string', 'max:30'],
            'living_in_bangladesh' => ['nullable', 'string', 'in:yes,no'],
            'current_city' => ['nullable', 'string', 'max:100'],
            'residence_country' => ['nullable', 'string', 'max:100'],
            'residence_status' => ['nullable', 'string', 'max:100'],
            'travel_purpose' => ['nullable', 'string', 'max:150'],
            'travel_date' => ['nullable', 'date'],
            'return_date' => ['nullable', 'date'],
            'stay_duration' => ['nullable', 'string', 'max:100'],
            'cities_to_visit' => ['nullable', 'string', 'max:255'],
            'schengen_countries' => ['nullable', 'array'],
            'schengen_nights' => ['nullable', 'array'],
            'main_destination' => ['nullable', 'string', 'max:100'],
            'first_entry_country' => ['nullable', 'string', 'max:100'],
            'employment_status' => ['nullable', 'string', 'max:100'],
            'employer_name' => ['nullable', 'string', 'max:150'],
            'job_title' => ['nullable', 'string', 'max:100'],
            'company_address' => ['nullable', 'string', 'max:255'],
            'business_name' => ['nullable', 'string', 'max:150'],
            'institution_name' => ['nullable', 'string', 'max:150'],
            'monthly_income' => ['nullable', 'string', 'max:100'],
            'funding_source' => ['nullable', 'string', 'max:100'],
            'sponsor_name' => ['nullable', 'string', 'max:150'],
            'sponsor_relationship' => ['nullable', 'string', 'max:100'],
            'has_travelled' => ['nullable', 'string', 'in:yes,no'],
            'countries_visited' => ['nullable', 'string', 'max:255'],
            'has_visa_refusal' => ['nullable', 'string', 'in:yes,no'],
            'refusal_country' => ['nullable', 'string', 'max:100'],
            'accommodation_type' => ['nullable', 'string', 'max:100'],
            'hotel_name' => ['nullable', 'string', 'max:150'],
            'hotel_address' => ['nullable', 'string', 'max:255'],
            'booking_reference' => ['nullable', 'string', 'max:100'],
            'host_name' => ['nullable', 'string', 'max:150'],
            'co_travelers' => ['nullable', 'array'],
            'payment_method' => ['nullable', 'string', 'max:50'],
            'applicant_notes' => ['nullable', 'string', 'max:1000'],

            // Cloud Link & Submission Channel
            'documents_drive_link' => ['nullable', 'url', 'max:500'],
            'submission_channel' => ['nullable', 'string', 'max:50'],

            // Document File Uploads (Strict limits & safe mime types)
            'passport_bio' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'passport_scan' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'photograph' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // 5MB
            'bank_statement' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:15360'], // 15MB
            'travel_insurance' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'flight_reservation' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'hotel_booking' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'travel_itinerary' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'tax_documents' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:15360'], // 15MB
            'employment_noc' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'pay_slips' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'business_registration' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:15360'], // 15MB
            'company_letterhead' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'student_id_noc' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'invitation_letter' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:15360'], // 15MB
            'sponsor_documents' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:20480'], // 20MB
            'refusal_letter' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
            'other_documents.*' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'], // 10MB
        ];
    }

    public function messages(): array
    {
        return [
            'photograph.max' => 'Passport Photograph size cannot exceed 5 MB. Please compress or crop your photo.',
            'photograph.mimes' => 'Photograph must be a valid image file (JPG, PNG, WEBP).',
            'passport_bio.max' => 'Passport Bio-Page file cannot exceed 10 MB.',
            'bank_statement.max' => 'Bank Statement file cannot exceed 15 MB.',
            'business_registration.max' => 'Trade License / Business Registration file cannot exceed 15 MB.',
            'employment_noc.max' => 'Employment NOC file cannot exceed 10 MB.',
            'student_id_noc.max' => 'Student ID / Leave certificate cannot exceed 10 MB.',
            'invitation_letter.max' => 'Invitation Letter file cannot exceed 15 MB.',
            'sponsor_documents.max' => 'Sponsor documents file cannot exceed 20 MB.',
            'documents_drive_link.url' => 'Please provide a valid URL for your Google Drive / Cloud folder link.',
        ];
    }
}
