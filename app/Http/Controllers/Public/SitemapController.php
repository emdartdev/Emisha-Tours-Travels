<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\VisaCountry;
use App\Models\BlogPost;
use App\Models\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Generate dynamic sitemap.xml with 1-hour cache.
     */
    public function sitemap(): Response
    {
        $xml = Cache::remember('sitemap_xml_content', 3600, function () {
            $tours = Tour::published()->select(['slug', 'updated_at'])->get();
            $destinations = Destination::active()->select(['slug', 'updated_at'])->get();
            $visaCountries = VisaCountry::active()->select(['slug', 'updated_at'])->get();
            $blogPosts = BlogPost::published()->select(['slug', 'updated_at'])->get();
            $pages = Page::where('status', 'active')->select(['slug', 'updated_at'])->get();

            $urls = [];

            // Core static public routes
            $staticRoutes = [
                ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('tours.index'), 'priority' => '0.9', 'changefreq' => 'daily', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('visa.index'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('ticketing.index'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('destinations.index'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('blog.index'), 'priority' => '0.8', 'changefreq' => 'daily', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('gallery.index'), 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('faq.index'), 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('contact.index'), 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('about'), 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => now()->toIso8601String()],
            ];

            foreach ($staticRoutes as $r) {
                $urls[] = $r;
            }

            // Published Tours
            foreach ($tours as $tour) {
                $urls[] = [
                    'loc' => route('tours.show', $tour->slug),
                    'priority' => '0.9',
                    'changefreq' => 'weekly',
                    'lastmod' => $tour->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                ];
            }

            // Active Destinations
            foreach ($destinations as $dest) {
                $urls[] = [
                    'loc' => route('destinations.show', $dest->slug),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                    'lastmod' => $dest->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                ];
            }

            // Visa Countries
            foreach ($visaCountries as $country) {
                $urls[] = [
                    'loc' => route('visa.show', $country->slug),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                    'lastmod' => $country->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                ];
                $urls[] = [
                    'loc' => route('visa.apply', $country->slug),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                    'lastmod' => $country->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                ];
            }

            // Blog Articles
            foreach ($blogPosts as $post) {
                $urls[] = [
                    'loc' => route('blog.show', $post->slug),
                    'priority' => '0.7',
                    'changefreq' => 'weekly',
                    'lastmod' => $post->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                ];
            }

            // CMS Pages
            foreach ($pages as $page) {
                $urls[] = [
                    'loc' => route('pages.show', $page->slug),
                    'priority' => '0.5',
                    'changefreq' => 'monthly',
                    'lastmod' => $page->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                ];
            }

            $output = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
            foreach ($urls as $u) {
                $output .= "  <url>\n";
                $output .= "    <loc>" . htmlspecialchars($u['loc'], ENT_XML1) . "</loc>\n";
                $output .= "    <lastmod>" . $u['lastmod'] . "</lastmod>\n";
                $output .= "    <changefreq>" . $u['changefreq'] . "</changefreq>\n";
                $output .= "    <priority>" . $u['priority'] . "</priority>\n";
                $output .= "  </url>\n";
            }
            $output .= '</urlset>';

            return $output;
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Generate robots.txt response.
     */
    public function robots(): Response
    {
        $sitemapUrl = url('/sitemap.xml');
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /admin/*\n";
        $content .= "Disallow: /login\n\n";
        $content .= "Sitemap: {$sitemapUrl}\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
