<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\VisaCountry;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Services\SeoService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeoAndPerformanceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_sitemap_xml_returns_valid_xml_and_contains_urls(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false);
        $response->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', false);
        $response->assertSee(url('/tours'), false);
        $response->assertSee(url('/visa'), false);
        $response->assertSee(url('/destinations'), false);
        $response->assertSee(url('/blog'), false);

        // Check dynamic tour in sitemap
        $tour = Tour::published()->first();
        if ($tour) {
            $response->assertSee(route('tours.show', $tour->slug), false);
        }

        // Check dynamic visa country in sitemap
        $country = VisaCountry::active()->first();
        if ($country) {
            $response->assertSee(route('visa.show', $country->slug), false);
            $response->assertSee(route('visa.apply', $country->slug), false);
        }
    }

    public function test_robots_txt_returns_proper_directives(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
        $response->assertSee('User-agent: *');
        $response->assertSee('Disallow: /admin/');
        $response->assertSee('Sitemap: ' . url('/sitemap.xml'));
    }

    public function test_homepage_includes_seo_meta_tags_and_travel_agency_schema(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('og:site_name', false);
        $response->assertSee('twitter:card', false);
        $response->assertSee('TravelAgency', false);
        $response->assertSee('https://schema.org', false);
    }

    public function test_tour_detail_page_includes_tourist_trip_schema(): void
    {
        $tour = Tour::published()->firstOrFail();

        $response = $this->get("/tours/{$tour->slug}");

        $response->assertStatus(200);
        $response->assertSee('TouristTrip', false);
        $response->assertSee($tour->title, false);
        $response->assertSee('og:type', false);
    }

    public function test_faq_page_includes_faq_schema(): void
    {
        $response = $this->get('/faq');

        $response->assertStatus(200);
        $response->assertSee('FAQPage', false);
    }

    public function test_seo_service_generates_valid_breadcrumb_schema(): void
    {
        $seoService = new SeoService();
        $crumbs = [
            'Home' => url('/'),
            'Tours' => url('/tours'),
            'Thailand Package' => url('/tours/thailand-package'),
        ];

        $schema = $seoService->generateBreadcrumbSchema($crumbs);

        $this->assertStringContainsString('BreadcrumbList', $schema);
        $this->assertStringContainsString('Thailand Package', $schema);
        $this->assertStringContainsString('position', $schema);
    }
}
