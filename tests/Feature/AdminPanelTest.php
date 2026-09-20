<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\TourCategory;
use App\Models\VisaCountry;
use App\Models\VisaApplication;
use App\Models\VisaDocument;
use App\Models\TourInquiry;
use App\Models\TicketRequest;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class AdminPanelTest extends TestCase
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
            'role' => 'admin'
        ]);
    }

    public function test_guests_are_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_successfully(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@emishatours.com',
            'password' => 'Emisha@01805464291#Naznin#@',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_all_authorized_worker_accounts_can_login_successfully(): void
    {
        $accounts = [
            ['email' => 'admin@emishatours.com', 'password' => 'Emisha@01805464291#Naznin#@'],
            ['email' => 'manager@emishatours.com', 'password' => 'Emisha@01805464291#@Treker#@'],
            ['email' => 'm1@emishatours.com', 'password' => 'Emisha@583214#@Treker#@'],
            ['email' => 'm2@emishatours.com', 'password' => 'Emisha@741906#@Treker#@'],
            ['email' => 'm3@emishatours.com', 'password' => 'Emisha@326857#@Treker#@'],
            ['email' => 'm4@emishatours.com', 'password' => 'Emisha@914263#@Treker#@'],
            ['email' => 'm5@emishatours.com', 'password' => 'Emisha@67053#@Treker#@'],
            ['email' => 'm6@emishatours.com', 'password' => 'Emisha@458729#@Treker#@'],
        ];

        foreach ($accounts as $cred) {
            $user = User::where('email', $cred['email'])->first();
            $this->assertNotNull($user, "Account {$cred['email']} must exist in database.");

            $response = $this->post('/admin/login', [
                'email' => $cred['email'],
                'password' => $cred['password'],
            ]);

            $response->assertRedirect('/admin/dashboard');
            $this->assertAuthenticatedAs($user);

            // Log out for next iteration
            $this->post('/admin/logout');
            $this->assertGuest();
        }
    }

    public function test_admin_dashboard_renders_with_kpi_stats(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Operations Command Dashboard');
        $response->assertSee('Visa Applications');
        $response->assertSee('Tour Inquiries');
    }

    public function test_admin_can_view_and_update_visa_application_status(): void
    {
        $country = VisaCountry::active()->first();
        $visaType = $country->visaTypes()->first();

        $application = VisaApplication::create([
            'reference_number' => 'VISA-2026-999999',
            'visa_country_id' => $country->id,
            'visa_type_id' => $visaType->id,
            'full_name' => 'MD RASHEDUL KARIM',
            'email' => 'rashed@example.com',
            'phone' => '+8801700112233',
            'status' => 'received',
            'submitted_at' => now(),
        ]);

        // View index & show
        $indexResponse = $this->actingAs($this->admin)->get('/admin/visa-applications');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('VISA-2026-999999');

        $showResponse = $this->actingAs($this->admin)->get("/admin/visa-applications/{$application->id}");
        $showResponse->assertStatus(200);
        $showResponse->assertSee('MD RASHEDUL KARIM');

        // Update status
        $statusResponse = $this->actingAs($this->admin)->patch("/admin/visa-applications/{$application->id}/status", [
            'status' => 'under_review',
            'admin_notes' => 'Checking bank statements.',
        ]);

        $statusResponse->assertRedirect();
        $this->assertDatabaseHas('visa_applications', [
            'id' => $application->id,
            'status' => 'under_review',
            'admin_notes' => 'Checking bank statements.',
        ]);
    }

    public function test_admin_can_download_private_visa_document(): void
    {
        $country = VisaCountry::active()->first();
        $visaType = $country->visaTypes()->first();

        $application = VisaApplication::create([
            'reference_number' => 'VISA-2026-888888',
            'visa_country_id' => $country->id,
            'visa_type_id' => $visaType->id,
            'full_name' => 'TEST APPLICANT',
            'email' => 'test@example.com',
            'phone' => '+8801700112244',
            'status' => 'received',
        ]);

        Storage::disk('visa_private')->put('applications/2026/09/sample_passport.pdf', 'fake-content');

        $document = VisaDocument::create([
            'visa_application_id' => $application->id,
            'document_type' => 'passport_scan',
            'original_filename' => 'passport.pdf',
            'stored_filename' => 'sample_passport.pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 1234,
            'storage_path' => 'applications/2026/09/sample_passport.pdf',
            'status' => 'uploaded',
        ]);

        $downloadResponse = $this->actingAs($this->admin)->get("/admin/visa-applications/{$application->id}/document/{$document->id}/download");
        $downloadResponse->assertStatus(200);
    }

    public function test_admin_can_create_update_and_delete_tour_package(): void
    {
        $destination = Destination::active()->first();
        $category = TourCategory::where('status', 'active')->first();

        // Create Tour
        $createResponse = $this->actingAs($this->admin)->post('/admin/tours', [
            'title' => 'Exotic Singapore & Sentosa Island Gateway',
            'destination_id' => $destination->id,
            'tour_category_id' => $category->id,
            'regular_price' => 75000,
            'discount_price' => 69000,
            'duration_days' => 5,
            'duration_nights' => 4,
            'description' => 'Complete package with Universal Studios pass and daily buffet breakfast.',
            'status' => 'published',
            'featured' => 1,
        ]);

        $createResponse->assertRedirect('/admin/tours');
        $this->assertDatabaseHas('tours', [
            'title' => 'Exotic Singapore & Sentosa Island Gateway',
        ]);

        $tour = Tour::where('title', 'Exotic Singapore & Sentosa Island Gateway')->first();
        $this->assertNotNull($tour);

        // Update Tour
        $updateResponse = $this->actingAs($this->admin)->put("/admin/tours/{$tour->id}", [
            'title' => 'Exotic Singapore & Sentosa Island Gateway (Updated)',
            'destination_id' => $destination->id,
            'tour_category_id' => $category->id,
            'regular_price' => 80000,
            'discount_price' => 72000,
            'duration_days' => 6,
            'duration_nights' => 5,
            'description' => 'Updated itinerary.',
            'status' => 'published',
            'featured' => 0,
        ]);

        $updateResponse->assertRedirect('/admin/tours');
        $this->assertDatabaseHas('tours', [
            'id' => $tour->id,
            'title' => 'Exotic Singapore & Sentosa Island Gateway (Updated)',
            'duration_days' => 6,
        ]);

        // Toggle Featured
        $toggleResponse = $this->actingAs($this->admin)->patch("/admin/tours/{$tour->id}/toggle-featured");
        $toggleResponse->assertRedirect();
        $this->assertTrue($tour->fresh()->featured);

        // Delete Tour
        $deleteResponse = $this->actingAs($this->admin)->delete("/admin/tours/{$tour->id}");
        $deleteResponse->assertRedirect('/admin/tours');
        $this->assertSoftDeleted('tours', ['id' => $tour->id]);
    }

    public function test_admin_can_update_platform_settings(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/settings', [
            'phone' => '+880 1800 999888',
            'whatsapp_number' => '+880 1800 999888',
            'email' => 'help@emishatours.com',
        ]);

        $response->assertRedirect('/admin/settings');
        $this->assertDatabaseHas('settings', [
            'key' => 'phone',
            'value' => '+880 1800 999888',
        ]);
    }

    public function test_admin_can_search_contact_messages(): void
    {
        ContactMessage::create([
            'name' => 'John Doe Contact',
            'email' => 'johndoe@test.com',
            'phone' => '+8801712000000',
            'service' => 'Visa Consulting',
            'message' => 'Inquiring about visa requirements.',
            'status' => 'unread',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/contact-messages?search=Visa');
        $response->assertStatus(200);
        $response->assertSee('John Doe Contact');
        $response->assertSee('Visa Consulting');
    }

    public function test_admin_can_search_ticket_requests(): void
    {
        TicketRequest::create([
            'reference_number' => 'TKT-2026-SEARCHTEST',
            'trip_type' => 'round-trip',
            'origin' => 'Dhaka (DAC)',
            'destination' => 'London (LHR)',
            'departure_date' => now()->addDays(10),
            'return_date' => now()->addDays(20),
            'adults' => 2,
            'children' => 0,
            'infants' => 0,
            'cabin_class' => 'Economy',
            'full_name' => 'Alice Passenger',
            'email' => 'alice@test.com',
            'phone' => '+8801819000000',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/ticket-requests?search=Alice');
        $response->assertStatus(200);
        $response->assertSee('TKT-2026-SEARCHTEST');
        $response->assertSee('Alice Passenger');
    }

    public function test_admin_can_manage_gallery_photos(): void
    {
        $category = \App\Models\GalleryCategory::firstOrCreate(['slug' => 'test-gallery'], ['name' => 'Test Gallery', 'sort_order' => 1]);

        $storeResponse = $this->actingAs($this->admin)->post('/admin/gallery', [
            'gallery_category_id' => $category->id,
            'image_url' => 'https://images.unsplash.com/photo-test-123',
            'title' => 'Sample Sunset Island',
            'caption' => 'Scenic view of Maldives resort',
        ]);

        $storeResponse->assertRedirect('/admin/gallery');
        $this->assertDatabaseHas('gallery_images', [
            'title' => 'Sample Sunset Island',
            'image_path' => 'https://images.unsplash.com/photo-test-123',
        ]);

        $indexResponse = $this->actingAs($this->admin)->get('/admin/gallery');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Sample Sunset Island');
    }

    public function test_admin_can_logout(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/logout');

        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
