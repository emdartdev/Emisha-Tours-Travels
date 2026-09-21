<?php

namespace App\Services;

use App\Models\Tour;
use App\Models\Destination;
use App\Models\VisaCountry;
use App\Models\VisaType;
use App\Models\BlogPost;
use App\Models\Setting;
use Illuminate\Support\Collection;

class SeoService
{
    /**
     * Generate WebSite JSON-LD schema with Sitelinks Searchbox.
     */
    public function generateWebSiteSchema(): string
    {
        $name = Setting::get('site_name', 'Emisha Tours & Travels');
        $url = url('/');

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $name,
            'alternateName' => ['Emisha T&T', 'Emisha Tours Bangladesh', 'Emisha Travels'],
            'url' => $url,
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => route('tours.index') . '?search={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate Organization & TravelAgency JSON-LD schema for homepage and site-wide branding.
     */
    public function generateTravelAgencySchema(): string
    {
        $name = Setting::get('site_name', 'Emisha Tours & Travels');
        $phone = Setting::get('contact_phone', '+880 1805-464291');
        $email = Setting::get('contact_email', 'info@emishatours.com');
        $address = Setting::get('office_address', 'Union Bank Building (6th Floor), 1281, East Monipur, Begum Rokeya Sarani, Mirpur, Dhaka-1216');

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => ['TravelAgency', 'LocalBusiness'],
            'name' => $name,
            'alternateName' => 'Emisha Tours & Travels Ltd.',
            'image' => [
                asset('images/logo.png'),
                url('/storage/branding/og-preview.jpg'),
            ],
            '@id' => url('/') . '#travelagency',
            'url' => url('/'),
            'telephone' => $phone,
            'email' => $email,
            'priceRange' => '৳৳ - ৳৳৳৳',
            'currenciesAccepted' => 'BDT, USD',
            'paymentAccepted' => 'Cash, Credit Card, Bank Transfer, bKash, Nagad',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Union Bank Building (6th Floor), 1281, East Monipur, Begum Rokeya Sarani, Mirpur',
                'addressLocality' => 'Dhaka',
                'postalCode' => '1216',
                'addressRegion' => 'Dhaka Division',
                'addressCountry' => 'BD',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 23.7937,
                'longitude' => 90.3742,
            ],
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'],
                    'opens' => '10:00',
                    'closes' => '19:00',
                ],
            ],
            'sameAs' => [
                'https://www.facebook.com/emishatours',
                'https://www.instagram.com/emishatours',
                'https://www.linkedin.com/company/emishatours',
                'https://twitter.com/emishatours',
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Emisha Travel Services',
                'itemListElement' => [
                    [
                        '@type' => 'OfferCatalog',
                        'name' => 'International & Domestic Tour Packages',
                        'url' => route('tours.index'),
                    ],
                    [
                        '@type' => 'OfferCatalog',
                        'name' => 'Visa Processing & Consultation Services',
                        'url' => route('visa.index'),
                    ],
                    [
                        '@type' => 'OfferCatalog',
                        'name' => 'Domestic & International Air Ticketing',
                        'url' => route('ticketing.index'),
                    ],
                ],
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
            'description' => $tour->short_description ?: strip_tags($tour->description),
            'image' => $tour->cover_image ? [url($tour->cover_image)] : [asset('images/logo.png')],
            'touristType' => $tour->category->name ?? 'International Tourist',
            'offers' => [
                '@type' => 'Offer',
                'price' => (float) ($tour->discount_price ?: $tour->price),
                'priceCurrency' => $tour->currency ?: 'BDT',
                'availability' => 'https://schema.org/InStock',
                'validFrom' => $tour->created_at ? $tour->created_at->toIso8601String() : now()->toIso8601String(),
                'url' => route('tours.show', $tour->slug),
            ],
            'provider' => [
                '@type' => 'TravelAgency',
                'name' => 'Emisha Tours & Travels',
                'url' => url('/'),
                'telephone' => Setting::get('contact_phone', '+880 1805-464291'),
            ],
        ];

        if ($tour->destination) {
            $schema['itineraryLocation'] = [
                '@type' => 'TouristDestination',
                'name' => $tour->destination->name,
                'description' => $tour->destination->country ?? $tour->destination->name,
            ];
        }

        if ($tour->itineraries && $tour->itineraries->isNotEmpty()) {
            $schema['itinerary'] = [
                '@type' => 'ItemList',
                'numberOfItems' => $tour->itineraries->count(),
                'itemListElement' => $tour->itineraries->map(function ($it, $idx) {
                    return [
                        '@type' => 'ListItem',
                        'position' => $idx + 1,
                        'name' => "Day {$it->day_number}: {$it->title}",
                        'description' => strip_tags($it->description),
                    ];
                })->toArray(),
            ];
        }

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate TouristDestination JSON-LD schema for Destination guide pages.
     */
    public function generateDestinationSchema(Destination $destination): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'TouristDestination',
            'name' => $destination->name,
            'description' => $destination->short_description ?: strip_tags($destination->description),
            'image' => $destination->cover_image ? [url($destination->cover_image)] : [],
            'url' => route('destinations.show', $destination->slug),
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => $destination->country ?: $destination->name,
            ],
            'touristType' => ['Sightseeing', 'Adventure', 'Leisure', 'Cultural Heritage', 'Luxury Travel'],
            'provider' => [
                '@type' => 'TravelAgency',
                'name' => 'Emisha Tours & Travels',
                'url' => url('/'),
            ],
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate Visa Service & GovernmentPermit JSON-LD schema.
     */
    public function generateVisaServiceSchema(VisaCountry $country, ?VisaType $type = null): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => ($type ? $type->name . ' - ' : '') . $country->name . ' Visa Processing & Assistance Services',
            'serviceType' => 'Visa Processing & Immigration Assistance',
            'description' => "Professional visa processing, document verification, and embassy appointment assistance for {$country->name} by Emisha Tours & Travels Dhaka.",
            'provider' => [
                '@type' => 'TravelAgency',
                'name' => 'Emisha Tours & Travels',
                'url' => url('/'),
                'telephone' => Setting::get('contact_phone', '+880 1805-464291'),
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Bangladesh',
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => "{$country->name} Visa Services",
                'itemListElement' => $country->visaTypes ? $country->visaTypes->map(function ($vt) use ($country) {
                    return [
                        '@type' => 'Offer',
                        'name' => "{$country->name} {$vt->name}",
                        'price' => (float) ($vt->fee ?? 0),
                        'priceCurrency' => 'BDT',
                        'description' => "Processing time: " . ($vt->processing_time ?? 'Standard duration') . ". Requirements: " . strip_tags($vt->requirements ?? 'Standard embassy documents'),
                    ];
                })->toArray() : [],
            ],
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate Air Ticketing Service JSON-LD schema.
     */
    public function generateAirTicketingServiceSchema(): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => 'Domestic & International Air Ticketing Services Dhaka',
            'serviceType' => 'Flight Booking and Air Travel Reservation',
            'description' => 'Fast, affordable airline ticket booking, flight itinerary changes, baggage assistance, and worldwide airline reservations from Dhaka, Bangladesh with Emisha Tours & Travels.',
            'provider' => [
                '@type' => 'TravelAgency',
                'name' => 'Emisha Tours & Travels',
                'url' => url('/'),
                'telephone' => Setting::get('contact_phone', '+880 1805-464291'),
                'email' => Setting::get('contact_email', 'info@emishatours.com'),
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Bangladesh',
            ],
            'offers' => [
                '@type' => 'AggregateOffer',
                'priceCurrency' => 'BDT',
                'lowPrice' => '3500',
                'offerCount' => '500+',
            ],
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate ItemList schema for catalogs and collections.
     */
    public function generateItemListSchema(string $name, Collection $items, string $itemType = 'TouristTrip'): string
    {
        $elements = [];
        $pos = 1;
        foreach ($items as $item) {
            $itemData = [
                '@type' => 'ListItem',
                'position' => $pos++,
                'name' => $item->title ?? $item->name,
            ];

            if (isset($item->slug)) {
                $route = match ($itemType) {
                    'TouristTrip' => route('tours.show', $item->slug),
                    'TouristDestination' => route('destinations.show', $item->slug),
                    'VisaCountry' => route('visa.show', $item->slug),
                    'Article' => route('blog.show', $item->slug),
                    default => url('/'),
                };
                $itemData['url'] = $route;
            }

            $elements[] = $itemData;
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'name' => $name,
            'numberOfItems' => count($elements),
            'itemListElement' => $elements,
        ];

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
            'image' => $post->featured_image ? [url($post->featured_image)] : [asset('images/logo.png')],
            'datePublished' => $post->published_at ? $post->published_at->toIso8601String() : $post->created_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => 'Emisha Tours & Travels',
                'url' => url('/'),
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
