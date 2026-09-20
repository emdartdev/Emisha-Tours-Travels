<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tour;
use App\Models\VisaCountry;
use App\Models\ProfessionType;
use App\Models\TourInquiry;
use App\Models\VisaApplication;
use App\Models\TicketRequest;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EndToEndUserJourneyTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        Storage::fake('visa_private');

        $this->admin = User::where('email', 'admin@emishatours.com')->first() ?? User::factory()->create([
            'email' => 'admin@emishatours.com',
            'role' => 'admin',
        ]);
    }

    public function test_complete_end_to_end_customer_and_admin_operational_journey(): void
    {
        // -------------------------------------------------------------
        // Step 1: Customer browses tours and submits a booking inquiry
        // -------------------------------------------------------------
        $tour = Tour::published()->firstOrFail();
        $tourPageResponse = $this->get("/tours/{$tour->slug}");
        $tourPageResponse->assertStatus(200);
        $tourPageResponse->assertSee($tour->title);

        $inquiryResponse = $this->post("/tours/{$tour->slug}/inquire", [
            'tour_id' => $tour->id,
            'tour_title' => $tour->title,
            'full_name' => 'Tanvir Ahmed',
            'email' => 'tanvir@example.com',
            'phone' => '+8801712345678',
            'travel_date' => now()->addWeeks(3)->format('Y-m-d'),
            'adults' => 2,
            'children' => 1,
            'message' => 'Please arrange a 4-star hotel near the beach.',
        ]);

        $inquiryResponse->assertRedirect();
        $inquiry = TourInquiry::where('email', 'tanvir@example.com')->first();
        $this->assertNotNull($inquiry);
        $this->assertStringStartsWith('TOUR-', $inquiry->reference_number);
        $this->assertEquals('new', $inquiry->status);

        // -------------------------------------------------------------
        // Step 2: Customer navigates to Visa Wizard and submits application
        // -------------------------------------------------------------
        $country = VisaCountry::active()->firstOrFail();
        $visaType = $country->visaTypes()->firstOrFail();
        $profession = ProfessionType::firstOrFail();

        $wizardPageResponse = $this->get("/visa/{$country->slug}/apply");
        $wizardPageResponse->assertStatus(200);

        $passportFile = UploadedFile::fake()->create('passport_scan.pdf', 800, 'application/pdf');
        $photoFile = UploadedFile::fake()->create('photo.jpg', 600, 'image/jpeg');
        $bankFile = UploadedFile::fake()->create('bank_statement.pdf', 1200, 'application/pdf');

        $visaAppResponse = $this->post('/visa/apply', [
            'visa_country_id' => $country->id,
            'visa_type_id' => $visaType->id,
            'profession_type_id' => $profession->id,
            'full_name' => 'Tanvir Ahmed',
            'email' => 'tanvir.visa@example.com',
            'phone' => '+8801712345678',
            'passport_number' => 'A12345678',
            'passport_expiry' => now()->addYears(3)->format('Y-m-d'),
            'travel_date' => now()->addMonth()->format('Y-m-d'),
            'documents' => [
                'passport_scan' => $passportFile,
                'photograph' => $photoFile,
                'bank_statement' => $bankFile,
            ],
        ]);

        $visaAppResponse->assertRedirect();
        $visaApp = VisaApplication::where('email', 'tanvir.visa@example.com')->first();
        $this->assertNotNull($visaApp);
        $this->assertStringStartsWith('VISA-', $visaApp->reference_number);
        $this->assertEquals(3, $visaApp->documents()->count());

        // Verify private disk storage
        foreach ($visaApp->documents as $doc) {
            Storage::disk('visa_private')->assertExists($doc->storage_path);
        }

        // -------------------------------------------------------------
        // Step 3: Customer requests Air Ticket quotation
        // -------------------------------------------------------------
        $ticketResponse = $this->post('/air-ticketing', [
            'full_name' => 'Tanvir Ahmed',
            'email' => 'tanvir.tkt@example.com',
            'phone' => '+8801712345678',
            'trip_type' => 'round-trip',
            'origin' => 'DAC (Dhaka)',
            'destination' => 'BKK (Bangkok)',
            'departure_date' => now()->addWeeks(4)->format('Y-m-d'),
            'return_date' => now()->addWeeks(5)->format('Y-m-d'),
            'adults' => 2,
            'children' => 1,
            'infants' => 0,
            'cabin_class' => 'Economy',
            'preferred_airline' => 'Biman Bangladesh Airlines',
            'additional_requirements' => 'Morning flight preferred.',
        ]);

        $ticketResponse->assertRedirect();
        $ticketReq = TicketRequest::where('email', 'tanvir.tkt@example.com')->first();
        $this->assertNotNull($ticketReq);
        $this->assertStringStartsWith('TKT-', $ticketReq->reference_number);

        // -------------------------------------------------------------
        // Step 4: Customer submits Contact Message
        // -------------------------------------------------------------
        $contactResponse = $this->post('/contact', [
            'name' => 'Tanvir Ahmed',
            'email' => 'tanvir.contact@example.com',
            'phone' => '+8801712345678',
            'service' => 'Holiday Packages',
            'message' => 'Do you provide group corporate discounts for 20 travelers?',
        ]);

        $contactResponse->assertRedirect();
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'tanvir.contact@example.com',
            'service' => 'Holiday Packages',
        ]);

        // -------------------------------------------------------------
        // Step 6: Admin logs in, verifies application, downloads document
        // -------------------------------------------------------------
        $loginResponse = $this->post('/admin/login', [
            'email' => 'admin@emishatours.com',
            'password' => 'Emisha@01805464291#Naznin#@',
        ]);
        $loginResponse->assertRedirect('/admin/dashboard');

        // Check Dashboard displays active counts
        $dashboardResponse = $this->actingAs($this->admin)->get('/admin/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee($visaApp->reference_number);
        $dashboardResponse->assertSee($inquiry->reference_number);

        // Admin reviews visa file & downloads documents securely
        $visaShowResponse = $this->actingAs($this->admin)->get("/admin/visa-applications/{$visaApp->id}");
        $visaShowResponse->assertStatus(200);
        $visaShowResponse->assertSee('Tanvir Ahmed');

        $firstDoc = $visaApp->documents->first();
        $docDownloadResponse = $this->actingAs($this->admin)->get("/admin/visa-applications/{$visaApp->id}/document/{$firstDoc->id}/download");
        $docDownloadResponse->assertStatus(200);

        // Admin updates visa application status
        $updateVisaResponse = $this->actingAs($this->admin)->patch("/admin/visa-applications/{$visaApp->id}/status", [
            'status' => 'under_review',
            'admin_notes' => 'All passports and bank statements authenticated.',
        ]);
        $updateVisaResponse->assertRedirect();
        $this->assertEquals('under_review', $visaApp->fresh()->status);

        // Admin updates tour inquiry lead
        $updateInquiryResponse = $this->actingAs($this->admin)->patch("/admin/inquiries/{$inquiry->id}/status", [
            'status' => 'quoted',
            'admin_notes' => 'Sent customized 4-star quote via email and WhatsApp.',
        ]);
        $updateInquiryResponse->assertRedirect();
        $this->assertEquals('quoted', $inquiry->fresh()->status);

        // Admin logs out
        $logoutResponse = $this->actingAs($this->admin)->post('/admin/logout');
        $logoutResponse->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
