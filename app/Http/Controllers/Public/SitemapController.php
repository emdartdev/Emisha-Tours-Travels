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
     * Generate dynamic sitemap.xml with 1-hour cache, image sitemap, and multilingual alternates.
     */
    public function sitemap(): Response
    {
        $xml = Cache::remember('sitemap_xml_content_v2', 3600, function () {
            $tours = Tour::published()->select(['slug', 'title', 'cover_image', 'updated_at'])->get();
            $destinations = Destination::active()->select(['slug', 'name', 'cover_image', 'updated_at'])->get();
            $visaCountries = VisaCountry::active()->select(['slug', 'name', 'updated_at'])->get();
            $blogPosts = BlogPost::published()->select(['slug', 'title', 'featured_image', 'updated_at'])->get();
            $pages = Page::where('status', 'active')->select(['slug', 'title', 'updated_at'])->get();

            $urls = [];

            // Helper to format image absolute URL
            $formatImageUrl = function (?string $path): ?string {
                if (!$path) {
                    return null;
                }
                return str_starts_with($path, 'http://') || str_starts_with($path, 'https://')
                    ? $path
                    : url($path);
            };

            // Core static public routes
            $staticRoutes = [
                ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('tours.index'), 'priority' => '0.9', 'changefreq' => 'daily', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('visa.index'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => now()->toIso8601String()],
                ['loc' => route('visa.apply'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => now()->toIso8601String()],
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
                $entry = [
                    'loc' => route('tours.show', $tour->slug),
                    'priority' => '0.9',
                    'changefreq' => 'weekly',
                    'lastmod' => $tour->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                ];
                if ($tour->cover_image) {
                    $entry['image'] = [
                        'loc' => $formatImageUrl($tour->cover_image),
                        'title' => $tour->title,
                    ];
                }
                $urls[] = $entry;
            }

            // Active Destinations
            foreach ($destinations as $dest) {
                $entry = [
                    'loc' => route('destinations.show', $dest->slug),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                    'lastmod' => $dest->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                ];
                if ($dest->cover_image) {
                    $entry['image'] = [
                        'loc' => $formatImageUrl($dest->cover_image),
                        'title' => $dest->name,
                    ];
                }
                $urls[] = $entry;
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
                    'loc' => route('visa.apply.slug', ['slug' => $country->slug]),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                    'lastmod' => $country->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                ];
            }

            // Blog Articles
            foreach ($blogPosts as $post) {
                $entry = [
                    'loc' => route('blog.show', $post->slug),
                    'priority' => '0.7',
                    'changefreq' => 'weekly',
                    'lastmod' => $post->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                ];
                if ($post->featured_image) {
                    $entry['image'] = [
                        'loc' => $formatImageUrl($post->featured_image),
                        'title' => $post->title,
                    ];
                }
                $urls[] = $entry;
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
            $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

            foreach ($urls as $u) {
                $loc = $u['loc'];
                $sep = str_contains($loc, '?') ? '&' : '?';
                $enLoc = $loc . $sep . 'lang=en';
                $bnLoc = $loc . $sep . 'lang=bn';

                $output .= "  <url>\n";
                $output .= "    <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
                $output .= "    <lastmod>" . $u['lastmod'] . "</lastmod>\n";
                $output .= "    <changefreq>" . $u['changefreq'] . "</changefreq>\n";
                $output .= "    <priority>" . $u['priority'] . "</priority>\n";
                $output .= '    <xhtml:link rel="alternate" hreflang="en" href="' . htmlspecialchars($enLoc, ENT_XML1) . '" />' . "\n";
                $output .= '    <xhtml:link rel="alternate" hreflang="bn" href="' . htmlspecialchars($bnLoc, ENT_XML1) . '" />' . "\n";
                $output .= '    <xhtml:link rel="alternate" hreflang="x-default" href="' . htmlspecialchars($loc, ENT_XML1) . '" />' . "\n";

                if (!empty($u['image']['loc'])) {
                    $output .= "    <image:image>\n";
                    $output .= "      <image:loc>" . htmlspecialchars($u['image']['loc'], ENT_XML1) . "</image:loc>\n";
                    if (!empty($u['image']['title'])) {
                        $output .= "      <image:title>" . htmlspecialchars($u['image']['title'], ENT_XML1) . "</image:title>\n";
                    }
                    $output .= "    </image:image>\n";
                }

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
        $content .= "Disallow: /login\n";
        $content .= "Disallow: /api/\n";
        $content .= "Disallow: /visa/track*\n";
        $content .= "Disallow: /visa/onboarding/*\n\n";
        $content .= "Sitemap: {$sitemapUrl}\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
