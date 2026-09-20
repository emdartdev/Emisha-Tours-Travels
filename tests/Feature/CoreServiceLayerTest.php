<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\DatabaseSeeder;
use App\Support\ReferenceGenerator;
use App\Services\TourService;
use App\Services\VisaService;
use App\Services\InquiryService;
use App\Services\TicketRequestService;
use App\Services\SeoService;

class CoreServiceLayerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_reference_numbers_are_generated_properly(): void
    {
        $visaRef = ReferenceGenerator::forVisaApplication();
        $tourRef = ReferenceGenerator::forTourInquiry();
        $tktRef = ReferenceGenerator::forTicketRequest();

        $year = date('Y');
        $this->assertStringStartsWith("VISA-{$year}-", $visaRef);
        $this->assertStringStartsWith("TOUR-{$year}-", $tourRef);
        $this->assertStringStartsWith("TKT-{$year}-", $tktRef);
    }

    public function test_tour_service_retrieves_filtered_and_featured_tours(): void
    {
        $tourService = new TourService();
        $featured = $tourService->getFeaturedTours();
        $this->assertNotEmpty($featured);

        $filtered = $tourService->getFilteredTours(['search' => 'Bangkok']);
        $this->assertNotEmpty($filtered->items());
    }

    public function test_visa_service_retrieves_countries_and_professions(): void
    {
        $visaService = new VisaService();
        $countries = $visaService->getActiveCountries();
        $this->assertNotEmpty($countries);

        $professions = $visaService->getProfessions();
        $this->assertNotEmpty($professions);
    }

    public function test_inquiry_service_creates_tour_inquiry(): void
    {
        $inquiryService = new InquiryService();
        $inquiry = $inquiryService->createTourInquiry([
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '+8801700000000',
            'travel_date' => '2026-10-15',
            'adults' => 2,
            'children' => 0,
            'message' => 'Testing tour inquiry creation.',
        ]);

        $this->assertNotNull($inquiry->id);
        $this->assertNotNull($inquiry->reference_number);
    }

    public function test_ticket_request_service_creates_request(): void
    {
        $ticketService = new TicketRequestService();
        $ticket = $ticketService->createTicketRequest([
            'trip_type' => 'round-trip',
            'origin' => 'DAC',
            'destination' => 'BKK',
            'departure_date' => '2026-10-20',
            'return_date' => '2026-10-27',
            'adults' => 1,
            'cabin_class' => 'Economy',
            'full_name' => 'Flight Passenger',
            'email' => 'passenger@example.com',
            'phone' => '+8801800000000',
        ]);

        $this->assertNotNull($ticket->id);
        $this->assertStringStartsWith('TKT-', $ticket->reference_number);
    }

    public function test_seo_service_generates_json_ld(): void
    {
        $seoService = new SeoService();
        $schema = $seoService->generateTravelAgencySchema();
        $this->assertStringContainsString('https://schema.org', $schema);
        $this->assertStringContainsString('TravelAgency', $schema);
    }
}
