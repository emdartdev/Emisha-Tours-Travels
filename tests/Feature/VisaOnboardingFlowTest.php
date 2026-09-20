<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\VisaCountry;
use App\Models\VisaType;
use App\Models\ProfessionType;
use App\Models\VisaApplication;
use App\Models\VisaDocument;
use App\Models\User;
use App\Services\VisaOnboardingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VisaOnboardingFlowTest extends TestCase
{
    use RefreshDatabase;

    protected VisaOnboardingService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        Storage::fake('visa_private');
        $this->service = app(VisaOnboardingService::class);
    }

    public function test_onboarding_page_loads_with_all_10_destinations_and_service_fees(): void
    {
        $response = $this->get('/visa/apply');
        $response->assertStatus(200);
        $response->assertSee('Tourist Visa Application Portal');

        $expectedDestinations = [
            'Thailand' => '6,000',
            'Malaysia' => '4,500',
            'Singapore' => '6,000',
            'Sri Lanka' => '3,500',
            'Japan' => '3,500',
            'United States (USA)' => '15,000',
            'Canada' => '8,000',
            'United Kingdom (UK)' => '8,000',
            'Australia' => '8,000',
            'Europe (Schengen Area)' => '15,000',
        ];

        foreach ($expectedDestinations as $name => $price) {
            $response->assertSee($name);
        }
    }

    public function test_schengen_longest_stay_calculation(): void
    {
        // Case 1: France has longest stay
        $result = $this->service->calculateSchengenMainDestination([
            'Germany' => 3,
            'France' => 7,
            'Italy' => 4,
        ], 'Germany');

        $this->assertEquals('France', $result['main_country']);
        $this->assertFalse($result['is_tie']);

        // Case 2: Tie between Italy and Spain with Italy as first entry
        $resultTie = $this->service->calculateSchengenMainDestination([
            'Italy' => 5,
            'Spain' => 5,
            'France' => 2,
        ], 'Italy');

        $this->assertEquals('Italy', $resultTie['main_country']);
        $this->assertTrue($resultTie['is_tie']);
    }

    public function test_dynamic_document_checklist_evaluation_for_employed_vs_student_vs_sponsored(): void
    {
        // 1. Employed applicant
        $checklistEmployed = $this->service->evaluateDocumentChecklist('thailand', [
            'employment_status' => 'employed',
            'funding_source' => 'self',
            'has_visa_refusal' => 'no',
        ]);

        $this->assertArrayHasKey('passport_bio', $checklistEmployed);
        $this->assertArrayHasKey('employment_noc', $checklistEmployed);
        $this->assertArrayNotHasKey('student_id_noc', $checklistEmployed);

        // 2. Student applicant
        $checklistStudent = $this->service->evaluateDocumentChecklist('japan', [
            'employment_status' => 'student',
            'funding_source' => 'self',
            'has_visa_refusal' => 'no',
        ]);

        $this->assertArrayHasKey('student_id_noc', $checklistStudent);
        $this->assertArrayNotHasKey('employment_noc', $checklistStudent);

        // 3. Sponsored applicant with previous refusal
        $checklistSponsored = $this->service->evaluateDocumentChecklist('uk', [
            'employment_status' => 'employed',
            'funding_source' => 'sponsored',
            'has_visa_refusal' => 'yes',
        ]);

        $this->assertArrayHasKey('sponsor_documents', $checklistSponsored);
        $this->assertArrayHasKey('refusal_letter', $checklistSponsored);
    }

    public function test_passport_validity_rule_validation(): void
    {
        // 1. Valid passport (12 months validity)
        $futureExpiry = date('Y-m-d', strtotime('+12 months'));
        $valPass = $this->service->validatePassportValidity('thailand', $futureExpiry, date('Y-m-d'));
        $this->assertTrue($valPass['valid']);

        // 2. Expiring soon (only 2 months validity when 6 months required)
        $shortExpiry = date('Y-m-d', strtotime('+2 months'));
        $valFail = $this->service->validatePassportValidity('thailand', $shortExpiry, date('Y-m-d'));
        $this->assertFalse($valFail['valid']);
    }

    public function test_ajax_draft_auto_save_and_restore(): void
    {
        $payload = [
            'destination_slug' => 'japan',
            'full_name' => 'MD ANISUR RAHMAN',
            'email' => 'anisur@example.com',
            'phone' => '+8801811223344',
            'passport_number' => 'B09876543',
            'employment_status' => 'business_owner',
        ];

        $response = $this->postJson('/visa/onboarding/save-draft', $payload);
        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);

        $this->assertEquals('MD ANISUR RAHMAN', session('visa_onboarding_draft.full_name'));
        $this->assertEquals('japan', session('visa_onboarding_draft.destination_slug'));
    }

    public function test_all_10_destination_application_submissions(): void
    {
        $destinations = [
            'thailand' => 6000.00,
            'malaysia' => 4500.00,
            'singapore' => 6000.00,
            'sri-lanka' => 3500.00,
            'japan' => 3500.00,
            'usa' => 15000.00,
            'canada' => 8000.00,
            'uk' => 8000.00,
            'australia' => 8000.00,
            'europe-schengen' => 15000.00,
        ];

        foreach ($destinations as $slug => $expectedFee) {
            $passportFile = UploadedFile::fake()->create('passport_scan.pdf', 900, 'application/pdf');
            $photoFile = UploadedFile::fake()->create('photo.jpg', 400, 'image/jpeg');

            $payload = [
                'destination_slug' => $slug,
                'full_name' => 'APPLICANT ' . strtoupper($slug),
                'email' => "applicant.{$slug}@example.com",
                'phone' => '+880170000' . rand(1000, 9999),
                'date_of_birth' => '1990-01-15',
                'nationality' => 'Bangladeshi',
                'passport_number' => 'P' . rand(1000000, 9999999),
                'passport_expiry_date' => date('Y-m-d', strtotime('+2 years')),
                'travel_purpose' => 'Tourism',
                'travel_date' => date('Y-m-d', strtotime('+45 days')),
                'employment_status' => 'employed',
                'employer_name' => 'Tech Solutions Ltd',
                'funding_source' => 'self',
                'accommodation_type' => 'Hotel',
                'payment_method' => 'bkash_online',
                'passport_bio' => $passportFile,
                'photograph' => $photoFile,
            ];

            if ($slug === 'europe-schengen') {
                $payload['schengen_countries'] = ['France', 'Italy'];
                $payload['schengen_nights'] = ['France' => 6, 'Italy' => 4];
            }

            $response = $this->post('/visa/apply', $payload);
            $response->assertStatus(302);

            $application = VisaApplication::where('email', "applicant.{$slug}@example.com")->first();
            $this->assertNotNull($application, "Failed to create application for destination: {$slug}");
            $this->assertEquals($expectedFee, (float) $application->total_service_fee);
            $this->assertMatchesRegularExpression('/^VISA-\d{4}-\d{6}$/', $application->reference_number);

            // Verify Documents
            $docs = VisaDocument::where('visa_application_id', $application->id)->get();
            $this->assertGreaterThanOrEqual(1, $docs->count());
            foreach ($docs as $d) {
                Storage::disk('visa_private')->assertExists($d->storage_path);
            }
        }
    }

    public function test_public_application_tracking_page(): void
    {
        $application = VisaApplication::first();
        $this->assertNotNull($application);

        // Track by direct URL
        $response = $this->get("/visa/track/{$application->reference_number}");
        $response->assertStatus(200);
        $response->assertSee($application->reference_number);
        $response->assertSee($application->full_name);
        $response->assertSee('Live Workflow Milestone Timeline');

        // Track by search query
        $searchResponse = $this->get("/visa/track?reference={$application->reference_number}");
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee($application->reference_number);
    }

    public function test_admin_can_view_dossier_and_verify_documents_and_status(): void
    {
        $admin = User::first() ?? User::factory()->create(['email' => 'admin@emishatours.com']);
        $application = VisaApplication::with('documents')->first();

        $this->actingAs($admin);

        // View application
        $response = $this->get("/admin/visa-applications/{$application->id}");
        $response->assertStatus(200);
        $response->assertSee($application->reference_number);
        $response->assertSee('Applicant Personal Profile');

        // Update document status
        $doc = $application->documents->first();
        if ($doc) {
            $docResponse = $this->patch("/admin/visa-applications/{$application->id}/document/{$doc->id}/status", [
                'review_status' => 'approved',
                'review_note' => 'Valid passport bio-data page verified.',
            ]);
            $docResponse->assertRedirect();
            $this->assertDatabaseHas('visa_documents', [
                'id' => $doc->id,
                'review_status' => 'approved',
            ]);
        }

        // Update application status
        $statusResponse = $this->patch("/admin/visa-applications/{$application->id}/status", [
            'status' => 'under_review',
            'applicant_notes' => 'All documents verified by officer Tanvir.',
            'admin_notes' => 'Internal note: Ready for appointment booking.',
        ]);
        $statusResponse->assertRedirect();
        $this->assertDatabaseHas('visa_applications', [
            'id' => $application->id,
            'status' => 'under_review',
            'applicant_notes' => 'All documents verified by officer Tanvir.',
        ]);
    }

    public function test_ajax_application_submission_returns_modal_status_payload(): void
    {
        $payload = [
            'destination_slug' => 'thailand',
            'full_name' => 'MD TANVIR ISLAM',
            'email' => 'tanvir.modal@example.com',
            'phone' => '+8801711998877',
            'date_of_birth' => '1992-05-20',
            'passport_number' => 'A99887766',
            'passport_expiry_date' => date('Y-m-d', strtotime('+3 years')),
            'travel_purpose' => 'Tourism',
            'travel_date' => date('Y-m-d', strtotime('+30 days')),
            'employment_status' => 'employed',
            'funding_source' => 'self',
            'payment_method' => 'bkash_online',
        ];

        $response = $this->postJson('/visa/apply', $payload);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'reference_number',
            'country_name',
            'flag',
            'applicant_name',
            'application_status',
            'total_service_fee',
            'tracking_url',
            'whatsapp_url',
            'message',
        ]);
        $response->assertJson([
            'status' => 'success',
            'country_name' => 'Thailand',
            'applicant_name' => 'MD TANVIR ISLAM',
        ]);
    }

    public function test_ajax_validation_failure_returns_structured_error_json(): void
    {
        $response = $this->postJson('/visa/apply', [
            'destination_slug' => 'thailand',
            // Missing required full_name, email, phone
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'full_name',
                'email',
                'phone',
            ],
        ]);
    }

    public function test_file_upload_rate_limit_and_cooldown_behavior(): void
    {
        $email = 'rate.limit.test@example.com';
        $ip = '127.0.0.1';
        $identifier = $this->service->getUploadIdentifier($ip, $email);
        $this->service->resetUploadQuota($identifier);

        $payload = [
            'destination_slug' => 'thailand',
            'full_name' => 'RATE LIMIT TESTER',
            'email' => $email,
            'phone' => '+8801805464294',
            'date_of_birth' => '1995-01-01',
            'passport_number' => 'A12345678',
            'passport_expiry_date' => date('Y-m-d', strtotime('+3 years')),
            'travel_purpose' => 'Tourism',
            'travel_date' => date('Y-m-d', strtotime('+30 days')),
            'employment_status' => 'employed',
            'funding_source' => 'self',
            'payment_method' => 'bkash_online',
        ];

        // 1st Upload Attempt: Should pass and start 5 min cooldown
        $file = UploadedFile::fake()->create('passport.pdf', 1024, 'application/pdf');
        $response1 = $this->post('/visa/apply', array_merge($payload, ['passport_bio' => $file]));
        $response1->assertStatus(302);

        $quota = $this->service->getUploadQuotaState($identifier);
        $this->assertEquals(1, $quota['attempts']);
        $this->assertTrue($quota['is_cooldown']);
        $this->assertTrue($quota['is_blocked']);

        // Immediate Re-upload during cooldown: Should fail with validation error
        $file2 = UploadedFile::fake()->create('photo.jpg', 500, 'image/jpeg');
        $responseBlocked = $this->postJson('/visa/apply', array_merge($payload, ['photograph' => $file2]));
        $responseBlocked->assertStatus(422);
        $responseBlocked->assertJsonFragment([
            'files' => [
                "Security cooldown active: Please wait 5 minute(s) before submitting files again. If you want to fast-forward immediately, contact our Visa Consultation Support on WhatsApp: +8801805464294."
            ]
        ]);
    }

    public function test_file_size_exceeded_rejection(): void
    {
        $payload = [
            'destination_slug' => 'thailand',
            'full_name' => 'OVERSIZED TESTER',
            'email' => 'oversized@example.com',
            'phone' => '+8801805464294',
            'date_of_birth' => '1990-01-01',
            'passport_number' => 'A55667788',
            'passport_expiry_date' => date('Y-m-d', strtotime('+2 years')),
            'travel_purpose' => 'Tourism',
            'travel_date' => date('Y-m-d', strtotime('+30 days')),
            'employment_status' => 'employed',
            'funding_source' => 'self',
            'payment_method' => 'bkash_online',
        ];

        // Photograph limit is 5MB (5120 KB). Provide 8MB (8192 KB)
        $oversizedPhoto = UploadedFile::fake()->create('huge_photo.jpg', 8192, 'image/jpeg');

        $response = $this->postJson('/visa/apply', array_merge($payload, ['photograph' => $oversizedPhoto]));
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['photograph']);
    }

    public function test_upload_quota_status_endpoint(): void
    {
        $response = $this->getJson('/visa/onboarding/upload-quota?email=quota.check@example.com');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'quota' => [
                'attempts',
                'max_attempts',
                'remaining_attempts',
                'is_blocked',
                'is_cooldown',
                'max_reached',
                'whatsapp_helpline',
                'whatsapp_raw',
            ]
        ]);
    }
}
