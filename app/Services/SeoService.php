<?php

namespace App\Services;

use App\Models\Tour;
use App\Models\BlogPost;
use App\Models\Setting;
use Illuminate\Support\Collection;

class SeoService
{
    /**
     * Generate Organization & TravelAgency JSON-LD schema for homepage.
     */
    public function generateTravelAgencySchema(): string
    {
        $name = Setting::get('site_name', 'Emisha Tours & Travels');
        $phone = Setting::get('contact_phone', '+880 1805-464291');
        $email = Setting::get('contact_email', 'info@emishatours.com');
        $address = Setting::get('office_address', 'Union Bank Building (6th Floor), 1281, East Monipur, Begum Rokeya Sarani, Mirpur, Dhaka');

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'TravelAgency',
            'name' => $name,
            'image' => asset('images/logo.png'),
            '@id' => url('/'),
            'url' => url('/'),
            'telephone' => $phone,
            'email' => $email,
            'priceRange' => '৳৳',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Union Bank Building (6th Floor), 1281, East Monipur, Begum Rokeya Sarani, Mirpur',
                'addressLocality' => 'Dhaka',
                'postalCode' => '1216',
                'addressCountry' => 'BD',
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'],
                'opens' => '10:00',
                'closes' => '18:30',
            ],
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate Tour / Trip Product JSON-LD schema.
     */
    public function generateTourSchema(Tour $tour): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'TouristTrip',
            'name' => $tour->title,
            'description' => $tour->short_description,
            'image' => $tour->cover_image ? [$tour->cover_image] : [],
            'touristType' => $tour->category->name ?? 'International Tourist',
            'offers' => [
                '@type' => 'Offer',
                'price' => (float) ($tour->discount_price ?: $tour->price),
                'priceCurrency' => $tour->currency ?: 'BDT',
                'availability' => 'https://schema.org/InStock',
                'url' => route('tours.show', $tour->slug),
            ],
            'provider' => [
                '@type' => 'TravelAgency',
                'name' => 'Emisha Tours & Travels',
                'url' => url('/'),
            ],
        ];

        if ($tour->itineraries->isNotEmpty()) {
            $schema['itinerary'] = [
                '@type' => 'ItemList',
                'numberOfItems' => $tour->itineraries->count(),
                'itemListElement' => $tour->itineraries->map(function ($it, $idx) {
                    return [
                        '@type' => 'ListItem',
                        'position' => $idx + 1,
                        'name' => "Day {$it->day_number}: {$it->title}",
                        'description' => $it->description,
                    ];
                })->toArray(),
            ];
        }

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate FAQPage schema.
     */
    public function generateFaqSchema(iterable $faqs): string
    {
        $faqItems = [];
        foreach ($faqs as $faq) {
            $faqItems[] = [
                '@type' => 'Question',
                'name' => $faq->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => strip_tags($faq->answer),
                ],
            ];
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faqItems,
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate Article schema for Blog Posts.
     */
    public function generateArticleSchema(BlogPost $post): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post->title,
            'description' => $post->excerpt,
            'image' => $post->featured_image ? [$post->featured_image] : [],
            'datePublished' => $post->published_at ? $post->published_at->toIso8601String() : $post->created_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => 'Emisha Tours & Travels',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Emisha Tours & Travels',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png'),
                ],
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('blog.show', $post->slug),
            ],
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate BreadcrumbList JSON-LD schema.
     *
     * @param array<string, string> $breadcrumbs [Name => URL]
     */
    public function generateBreadcrumbSchema(array $breadcrumbs): string
    {
        $items = [];
        $position = 1;
        foreach ($breadcrumbs as $name => $url) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $name,
                'item' => $url ?: url()->current(),
            ];
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
}
