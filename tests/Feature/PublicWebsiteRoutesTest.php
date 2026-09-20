<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\VisaCountry;
use App\Models\BlogPost;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicWebsiteRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_homepage_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Emisha Tours &amp; Travels', false);
    }

    public function test_tours_catalog_and_detail_render_successfully(): void
    {
        $response = $this->get('/tours');
        $response->assertStatus(200);

        $tour = Tour::published()->first();
        if ($tour) {
            $detailResponse = $this->get("/tours/{$tour->slug}");
            $detailResponse->assertStatus(200);
            $detailResponse->assertSee($tour->title);
        }
    }

    public function test_destinations_catalog_and_detail_render_successfully(): void
    {
        $response = $this->get('/destinations');
        $response->assertStatus(200);

        $destination = Destination::active()->first();
        if ($destination) {
            $detailResponse = $this->get("/destinations/{$destination->slug}");
            $detailResponse->assertStatus(200);
            $detailResponse->assertSee($destination->name);
        }
    }

    public function test_visa_guide_and_country_detail_and_apply_page_render_successfully(): void
    {
        $response = $this->get('/visa');
        $response->assertStatus(200);

        $applyResponse = $this->get('/visa/apply');
        $applyResponse->assertStatus(200);
        $applyResponse->assertSee('Tourist Visa Application Portal');

        $country = VisaCountry::active()->first();
        if ($country) {
            $detailResponse = $this->get("/visa/{$country->slug}");
            $detailResponse->assertStatus(200);
            $detailResponse->assertSee($country->name);
        }
    }

    public function test_air_ticketing_page_renders_successfully(): void
    {
        $response = $this->get('/air-ticketing');
        $response->assertStatus(200);
        $response->assertSee('Air Ticketing');
        $response->assertSee('Flight Request Form');
    }

    public function test_blog_index_and_show_render_successfully(): void
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);

        $post = BlogPost::published()->first();
        if ($post) {
            $detailResponse = $this->get("/blog/{$post->slug}");
            $detailResponse->assertStatus(200);
            $detailResponse->assertSee($post->title);
        }
    }

    public function test_gallery_page_renders_successfully(): void
    {
        $response = $this->get('/gallery');
        $response->assertStatus(200);
        $response->assertSee('Travel Gallery');
    }

    public function test_faq_page_renders_successfully(): void
    {
        $response = $this->get('/faq');
        $response->assertStatus(200);
        $response->assertSee('Frequently Asked Questions');
    }

    public function test_contact_page_renders_and_handles_submission(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);

        $postResponse = $this->post('/contact', [
            'name' => 'Fahim Rahman',
            'email' => 'fahim@example.com',
            'phone' => '+8801712345678',
            'subject' => 'General Inquiry',
            'message' => 'I would like to inquire about a family holiday to Thailand.'
        ]);

        $postResponse->assertRedirect();
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'fahim@example.com'
        ]);
    }

    public function test_about_and_cms_pages_render_successfully(): void
    {
        $aboutResponse = $this->get('/about');
        $aboutResponse->assertStatus(200);
        $aboutResponse->assertSee('Crafting Unforgettable Journeys');

        $page = Page::published()->where('slug', 'terms-and-conditions')->first();
        if ($page) {
            $pageResponse = $this->get("/page/{$page->slug}");
            $pageResponse->assertStatus(200);
            $pageResponse->assertSee($page->title);
        }
    }
}
