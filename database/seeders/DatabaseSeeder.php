<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Destination;
use App\Models\TourCategory;
use App\Models\Tour;
use App\Models\TourItinerary;
use App\Models\TourInclusion;
use App\Models\TourExclusion;
use App\Models\VisaCountry;
use App\Models\VisaType;
use App\Models\VisaRequirement;
use App\Models\ProfessionType;
use App\Models\VisaProfessionRequirement;
use App\Models\TourInquiry;
use App\Models\TicketRequest;
use App\Models\VisaApplication;
use App\Models\Offer;
use App\Models\Testimonial;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Authorized Executive & Operations Users
        $accounts = [
            [
                'name' => 'Naznin Alam',
                'email' => 'admin@emishatours.com',
                'password' => 'Emisha@01805464291#Naznin#@',
                'role' => 'admin',
                'phone' => '+880 1805-464291',
                'status' => 'active',
            ],
            [
                'name' => 'Operations Manager',
                'email' => 'manager@emishatours.com',
                'password' => 'Emisha@01805464291#@Treker#@',
                'role' => 'manager',
                'phone' => '+880 1805-464292',
                'status' => 'active',
            ],
            [
                'name' => 'Moderator 1',
                'email' => 'm1@emishatours.com',
                'password' => 'Emisha@583214#@Treker#@',
                'role' => 'moderator',
                'phone' => '+880 1805-464293',
                'status' => 'active',
            ],
            [
                'name' => 'Moderator 2',
                'email' => 'm2@emishatours.com',
                'password' => 'Emisha@741906#@Treker#@',
                'role' => 'moderator',
                'phone' => '+880 1805-464294',
                'status' => 'active',
            ],
            [
                'name' => 'Moderator 3',
                'email' => 'm3@emishatours.com',
                'password' => 'Emisha@326857#@Treker#@',
                'role' => 'moderator',
                'phone' => '+880 1805-464291',
                'status' => 'active',
            ],
            [
                'name' => 'Moderator 4',
                'email' => 'm4@emishatours.com',
                'password' => 'Emisha@914263#@Treker#@',
                'role' => 'moderator',
                'phone' => '+880 1805-464292',
                'status' => 'active',
            ],
            [
                'name' => 'Moderator 5',
                'email' => 'm5@emishatours.com',
                'password' => 'Emisha@67053#@Treker#@',
                'role' => 'moderator',
                'phone' => '+880 1805-464293',
                'status' => 'active',
            ],
            [
                'name' => 'Moderator 6',
                'email' => 'm6@emishatours.com',
                'password' => 'Emisha@458729#@Treker#@',
                'role' => 'moderator',
                'phone' => '+880 1805-464294',
                'status' => 'active',
            ],
        ];

        // Purge any past accounts not in authorized list
        $allowedEmails = array_column($accounts, 'email');
        User::whereNotIn('email', $allowedEmails)->delete();

        // Seed or update authorized accounts
        $admin = null;
        foreach ($accounts as $account) {
            $user = User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'phone' => $account['phone'],
                    'role' => $account['role'],
                    'status' => $account['status'],
                    'password' => Hash::make($account['password']),
                    'email_verified_at' => now(),
                ]
            );

            if ($account['role'] === 'admin') {
                $admin = $user;
            }
        }

        // 2. Global Settings
        $settings = [
            'site_name' => 'Emisha Tours & Travels',
            'site_tagline' => 'Explore the World With Confidence',
            'contact_phone' => '+880 1805-464291',
            'contact_phone_2' => '+880 1805-464292',
            'contact_phone_3' => '+880 1805-464293',
            'contact_phone_4' => '+880 1805-464294',
            'contact_whatsapp' => '+880 1805-464291',
            'contact_email' => 'info@emishatours.com',
            'support_email' => 'info@emishatours.com',
            'office_hours' => 'Saturday – Thursday: 10:00 AM – 6:30 PM',
            'office_address' => 'Union Bank Building (6th Floor), 1281, East Monipur, Begum Rokeya Sarani, Mirpur, Dhaka',
            'office_landmark' => 'Kazipara Metro Station (Pillar No. 267)',
            'google_maps_url' => 'https://maps.app.goo.gl/yVBQmUfCS57Esag76',
            'facebook_url' => 'https://facebook.com/emishatravels',
            'instagram_url' => 'https://instagram.com/emishatravels',
            'linkedin_url' => 'https://linkedin.com/company/emishatravels',
            'youtube_url' => 'https://youtube.com/@emishatravels',
            'primary_currency' => 'BDT',
            'currency_symbol' => '৳',
            'visa_disclaimer' => 'Visa issuance is subject to the sole discretion and policies of the respective Embassy / High Commission / Immigration Authority. Emisha Tours & Travels acts purely as a visa consultancy and facilitation agency.',
            'footer_about' => 'Emisha Tours & Travels is a premier travel agency in Bangladesh offering customized international tour packages, certified visa consultancy, and global air ticketing solutions.',
        ];

        foreach ($settings as $key => $val) {
            Setting::updateOrCreate(['key' => $key], ['value' => $val, 'group' => 'general']);
        }

        // 3. Tour Categories
        $categories = [
            ['name' => 'International Tour', 'slug' => 'international-tours', 'description' => 'Worldwide holiday escapes and cultural tours.'],
            ['name' => 'Honeymoon Special', 'slug' => 'honeymoon-packages', 'description' => 'Romantic escapes with candlelit dinners and luxury stays.'],
            ['name' => 'Family Holiday', 'slug' => 'family-holidays', 'description' => 'Comfortable itineraries crafted for all age groups.'],
            ['name' => 'Group & Corporate', 'slug' => 'group-corporate', 'description' => 'Custom MICE, company retreats, and group adventures.'],
            ['name' => 'Domestic Escapes', 'slug' => 'domestic-tours', 'description' => 'Scenic beaches, hills, and heritage sites within Bangladesh.'],
            ['name' => 'Luxury Getaways', 'slug' => 'luxury-tours', 'description' => '5-star resorts, private transfers, and bespoke concierge.'],
        ];

        $catMap = [];
        foreach ($categories as $idx => $cat) {
            $catMap[$cat['slug']] = TourCategory::updateOrCreate(['slug' => $cat['slug']], array_merge($cat, ['sort_order' => $idx + 1]));
        }

        // 4. Destinations
        $destinations = [
            [
                'name' => 'Thailand',
                'slug' => 'thailand',
                'country' => 'Thailand',
                'region' => 'Asia',
                'short_description' => 'Tropical beaches, opulent royal palaces, ancient ruins, and ornate temples.',
                'description' => 'Thailand offers the perfect mix of bustling city life in Bangkok, tropical beaches in Phuket and Krabi, and serene culture in Chiang Mai. Enjoy vibrant night markets, world-class street food, and warm Thai hospitality.',
                'hero_image' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?auto=format&fit=crop&w=1600&q=80',
                'thumbnail' => 'https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=600&q=80',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Maldives',
                'slug' => 'maldives',
                'country' => 'Maldives',
                'region' => 'Asia',
                'short_description' => 'Crystal-clear turquoise waters, overwater villas, and untouched white sand atolls.',
                'description' => 'The Maldives is the ultimate luxury and honeymoon escape. Unwind in private overwater villas, dive alongside vibrant coral reefs and manta rays, and experience world-renowned barefoot luxury.',
                'hero_image' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=1600&q=80',
                'thumbnail' => 'https://images.unsplash.com/photo-1573843981267-be1999ff37cd?auto=format&fit=crop&w=600&q=80',
                'featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Dubai, UAE',
                'slug' => 'dubai',
                'country' => 'United Arab Emirates',
                'region' => 'Middle East',
                'short_description' => 'Futuristic skyscrapers, desert safaris, mega shopping malls, and luxury dining.',
                'description' => 'Dubai is a city of superlatives where modern architecture meets rich Arabian heritage. From the Burj Khalifa to adrenaline-pumping desert safaris and luxury yacht cruises, Dubai offers unforgettable grandeur.',
                'hero_image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1600&q=80',
                'thumbnail' => 'https://images.unsplash.com/photo-1518684079-3c830dcef090?auto=format&fit=crop&w=600&q=80',
                'featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Malaysia',
                'slug' => 'malaysia',
                'country' => 'Malaysia',
                'region' => 'Asia',
                'short_description' => 'Dynamic cityscape of Kuala Lumpur, misty Genting Highlands, and lush Penang beaches.',
                'description' => 'Malaysia is a multicultural melting pot featuring iconic landmarks like the Petronas Towers, rainforest canopy walks, high-altitude theme parks at Genting, and gastronomic wonders across Penang.',
                'hero_image' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=1600&q=80',
                'thumbnail' => 'https://images.unsplash.com/photo-1528728329032-2972f65dfb3f?auto=format&fit=crop&w=600&q=80',
                'featured' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Singapore',
                'slug' => 'singapore',
                'country' => 'Singapore',
                'region' => 'Asia',
                'short_description' => 'The futuristic Garden City with Marina Bay Sands, Sentosa Island, and Universal Studios.',
                'description' => 'Singapore is an ultra-modern city-state blending green garden innovations with high-energy attractions. Explore Gardens by the Bay, Universal Studios Sentosa, Jewel Changi, and gourmet street food.',
                'hero_image' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=1600&q=80',
                'thumbnail' => 'https://images.unsplash.com/photo-1565967511849-76a60a516170?auto=format&fit=crop&w=600&q=80',
                'featured' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Cox\'s Bazar, Bangladesh',
                'slug' => 'coxs-bazar',
                'country' => 'Bangladesh',
                'region' => 'Domestic',
                'short_description' => 'The longest unbroken natural sea beach in the world with sunset views.',
                'description' => 'Experience the sound of roaring waves across 120 km of golden sandy beach. Explore Marine Drive, Inani Beach coral stones, and Himchari waterfalls with premium beach resort stays.',
                'hero_image' => 'https://images.unsplash.com/photo-1608958435020-e8a7109ba809?auto=format&fit=crop&w=1600&q=80',
                'thumbnail' => 'https://images.unsplash.com/photo-1608958435020-e8a7109ba809?auto=format&fit=crop&w=600&q=80',
                'featured' => true,
                'sort_order' => 6,
            ],
        ];

        $destMap = [];
        foreach ($destinations as $dest) {
            $destMap[$dest['slug']] = Destination::updateOrCreate(['slug' => $dest['slug']], $dest);
        }

        // 5. Tours
        $tours = [
            [
                'destination_id' => $destMap['thailand']->id,
                'tour_category_id' => $catMap['international-tours']->id,
                'title' => 'Bangkok & Pattaya Highlights',
                'slug' => 'bangkok-pattaya-highlights',
                'short_description' => '5 Days / 4 Nights classic Thailand tour featuring Coral Island speed boat tour, Chao Phraya Dinner Cruise, and Safari World.',
                'description' => 'Discover the best of Thailand with this all-inclusive 5-day package. Begin your adventure in Pattaya with turquoise waters at Coral Island, followed by Bangkok\'s majestic temples, city shopping, and the magical Chao Phraya Princess dinner cruise.',
                'duration_days' => 5,
                'duration_nights' => 4,
                'price' => 48500.00,
                'discount_price' => 44900.00,
                'currency' => 'BDT',
                'status' => 'published',
                'featured' => true,
                'popular' => true,
                'cover_image' => 'https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now(),
                'itineraries' => [
                    ['day_number' => 1, 'title' => 'Arrival in Bangkok & Transfer to Pattaya', 'description' => 'Warm airport welcome at Suvarnabhumi Airport. Private transfer to Pattaya hotel. Evening Alcazar Show with VIP seating.', 'meals' => 'Dinner', 'stay' => '4-Star Pattaya Hotel'],
                    ['day_number' => 2, 'title' => 'Coral Island Speed Boat Tour with Lunch', 'description' => 'Speed boat ride to Coral Island (Koh Larn). Enjoy water sports, white sand beaches, and Indian/Thai buffet lunch.', 'meals' => 'Breakfast, Lunch', 'stay' => '4-Star Pattaya Hotel'],
                    ['day_number' => 3, 'title' => 'Pattaya to Bangkok & Chao Phraya Cruise', 'description' => 'Scenic transfer back to Bangkok. Check-in and evening luxury dinner cruise along the illuminated Chao Phraya River.', 'meals' => 'Breakfast, Dinner Cruise', 'stay' => '4-Star Bangkok Hotel'],
                    ['day_number' => 4, 'title' => 'Safari World & Marine Park Full Day', 'description' => 'Full-day tour to Safari World with Dolphin Show, Sea Lion Show, Safari drive-thru, and international buffet lunch.', 'meals' => 'Breakfast, Lunch', 'stay' => '4-Star Bangkok Hotel'],
                    ['day_number' => 5, 'title' => 'Bangkok City Temple Tour & Departure', 'description' => 'Visit Golden Buddha (Wat Traimit) and Marble Temple. Free time for shopping at MBK / Siam Paragon before airport drop-off.', 'meals' => 'Breakfast', 'stay' => 'Return Flight'],
                ],
                'inclusions' => [
                    ['title' => '4 Nights 4-Star Hotel Accommodation (Twin/Double Sharing)'],
                    ['title' => 'Daily Buffet Breakfast at Hotels'],
                    ['title' => 'Coral Island Tour with Speedboat & Indian/Thai Lunch'],
                    ['title' => 'Chao Phraya Princess Luxury Dinner Cruise with Live Music'],
                    ['title' => 'Safari World & Marine Park with Lunch & Transfers'],
                    ['title' => 'All Airport, Inter-city & Sightseeing Private AC Transfers'],
                    ['title' => 'English Speaking Tour Guide'],
                ],
                'exclusions' => [
                    ['title' => 'International Air Ticket (Available upon request)'],
                    ['title' => 'Thailand Visa Fee & E-Visa Processing'],
                    ['title' => 'Personal expenses, laundry, tips, and mini bar'],
                    ['title' => 'Travel Insurance (Recommended)'],
                ],
            ],
            [
                'destination_id' => $destMap['maldives']->id,
                'tour_category_id' => $catMap['honeymoon-packages']->id,
                'title' => 'Romantic Maldives Overwater Retreat',
                'slug' => 'romantic-maldives-overwater-retreat',
                'short_description' => '4 Days / 3 Nights luxury honeymoon in an Overwater Villa with speedboat transfers and all-inclusive dining.',
                'description' => 'Indulge in a dreamy tropical paradise. Stay in a private overwater villa perched directly above turquoise lagoons. Includes daily candlelight dinners, sunset dolphin cruise, complimentary snorkeling gear, and personalized honeymoon bed decoration.',
                'duration_days' => 4,
                'duration_nights' => 3,
                'price' => 128000.00,
                'discount_price' => 119000.00,
                'currency' => 'BDT',
                'status' => 'published',
                'featured' => true,
                'popular' => true,
                'cover_image' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now(),
                'itineraries' => [
                    ['day_number' => 1, 'title' => 'Arrival in Malé & Speedboat Transfer', 'description' => 'Arrive at Velana International Airport, Malé. Welcome drink and scenic speedboat transfer to the private island resort. Check into your Overwater Villa.', 'meals' => 'Dinner', 'stay' => '5-Star Overwater Villa'],
                    ['day_number' => 2, 'title' => 'Island Leisure & Sunset Dolphin Cruise', 'description' => 'Breakfast with endless ocean views. Leisure day enjoying swimming pools, kayak rentals, and evening romantic dolphin cruise.', 'meals' => 'Breakfast, Lunch, Dinner', 'stay' => '5-Star Overwater Villa'],
                    ['day_number' => 3, 'title' => 'Snorkeling Adventure & Candlelight Dinner', 'description' => 'Guided reef snorkeling to witness exotic marine life. Evening private candlelight beach dinner with wine.', 'meals' => 'Breakfast, Lunch, Beach Dinner', 'stay' => '5-Star Overwater Villa'],
                    ['day_number' => 4, 'title' => 'Breakfast & Departure Transfer', 'description' => 'Final breakfast overlooking the lagoon. Check-out and speedboat transfer back to Malé International Airport.', 'meals' => 'Breakfast', 'stay' => 'Return Flight'],
                ],
                'inclusions' => [
                    ['title' => '3 Nights in Luxury Overwater Lagoon Villa'],
                    ['title' => 'Full Board Meals (Breakfast, Lunch & Dinner Daily)'],
                    ['title' => 'Roundtrip Airport Speedboat Transfers'],
                    ['title' => 'Sunset Dolphin Cruise for Two'],
                    ['title' => 'Complimentary Snorkeling Equipment & Non-motorized Water Sports'],
                    ['title' => 'Honeymoon Special: Sparkling wine & Floral Bed Decoration'],
                    ['title' => 'All Maldives Green Taxes & Service Charges Included'],
                ],
                'exclusions' => [
                    ['title' => 'International Air Ticket (Malé return)'],
                    ['title' => 'Motorized water sports and Scuba Diving'],
                    ['title' => 'Personal expenses and Spa treatments'],
                ],
            ],
            [
                'destination_id' => $destMap['dubai']->id,
                'tour_category_id' => $catMap['international-tours']->id,
                'title' => 'Dubai Extravaganza with Desert Safari',
                'slug' => 'dubai-extravaganza-with-desert-safari',
                'short_description' => '5 Days / 4 Nights grand Dubai tour with Burj Khalifa 124th floor, Marina Dhow Cruise, and 4x4 Dune Bashing Safari.',
                'description' => 'Experience the glamour of the UAE. Gaze across Dubai from the top of the Burj Khalifa, cruise along Dubai Marina under starlit skies, and thrill your senses with an unforgettable desert safari, belly dancing, and BBQ dinner.',
                'duration_days' => 5,
                'duration_nights' => 4,
                'price' => 69500.00,
                'discount_price' => 64500.00,
                'currency' => 'BDT',
                'status' => 'published',
                'featured' => true,
                'popular' => true,
                'cover_image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now(),
                'itineraries' => [
                    ['day_number' => 1, 'title' => 'Arrival in Dubai & Marina Dhow Cruise', 'description' => 'Arrive at Dubai International Airport (DXB). Private hotel transfer. Evening Marina Dhow Cruise with 5-star buffet dinner and Tanoura dance show.', 'meals' => 'Dinner Cruise', 'stay' => '4-Star Dubai City Hotel'],
                    ['day_number' => 2, 'title' => 'Half-Day Dubai City Tour & Burj Khalifa At The Top', 'description' => 'City tour covering Dubai Frame (photo stop), Jumeirah Mosque, Burj Al Arab. Evening visit to Dubai Mall and Burj Khalifa 124th Floor observation deck.', 'meals' => 'Breakfast', 'stay' => '4-Star Dubai City Hotel'],
                    ['day_number' => 3, 'title' => 'Morning Leisure & 4x4 Desert Safari', 'description' => 'Morning free for shopping at Gold Souk / Meena Bazaar. Afternoon 4x4 Land Cruiser desert dune bashing, camel riding, BBQ dinner, and live fire shows.', 'meals' => 'Breakfast, BBQ Dinner', 'stay' => '4-Star Dubai City Hotel'],
                    ['day_number' => 4, 'title' => 'Abu Dhabi City Tour & Grand Mosque', 'description' => 'Full-day excursion to Abu Dhabi visiting Sheikh Zayed Grand Mosque, Emirates Palace (photo stop), and Ferrari World (photo stop).', 'meals' => 'Breakfast', 'stay' => '4-Star Dubai City Hotel'],
                    ['day_number' => 5, 'title' => 'Departure Transfer', 'description' => 'Breakfast and leisure until checkout. Private airport transfer for your departure flight.', 'meals' => 'Breakfast', 'stay' => 'Return Flight'],
                ],
                'inclusions' => [
                    ['title' => '4 Nights Stay at 4-Star Central Dubai Hotel'],
                    ['title' => 'Daily International Buffet Breakfast'],
                    ['title' => 'Dubai Marina Luxury Dhow Cruise with Dinner'],
                    ['title' => '4x4 Desert Safari with Dune Bashing, Camel Ride & BBQ Dinner'],
                    ['title' => 'Burj Khalifa 124th Floor Observatory Standard Entry'],
                    ['title' => 'Half-Day Guided Dubai City Tour'],
                    ['title' => 'Full-Day Abu Dhabi City Tour with Grand Mosque Entry'],
                    ['title' => 'Roundtrip Airport & Sightseeing Transfers in AC Vehicle'],
                ],
                'exclusions' => [
                    ['title' => 'UAE Visa Fee'],
                    ['title' => 'Dubai Tourism Dirham Fee (Payable directly at hotel)'],
                    ['title' => 'International Airfare'],
                ],
            ],
            [
                'destination_id' => $destMap['malaysia']->id,
                'tour_category_id' => $catMap['family-holidays']->id,
                'title' => 'Kuala Lumpur & Genting Highlands Family Tour',
                'slug' => 'kuala-lumpur-genting-highlands-family-tour',
                'short_description' => '4 Days / 3 Nights family holiday exploring Batu Caves, Cable Car, Genting Theme Park, and Twin Towers.',
                'description' => 'A wonderful family escape to Malaysia. Visit the towering Batu Caves, take the thrilling Awana SkyWay cable car to Genting Highlands, and experience world-class city sights in Kuala Lumpur.',
                'duration_days' => 4,
                'duration_nights' => 3,
                'price' => 39500.00,
                'discount_price' => 36500.00,
                'currency' => 'BDT',
                'status' => 'published',
                'featured' => false,
                'popular' => true,
                'cover_image' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now(),
                'itineraries' => [
                    ['day_number' => 1, 'title' => 'Arrival in Kuala Lumpur & City Night Tour', 'description' => 'Arrive at KLIA. Hotel transfer. Evening visit to Petronas Twin Towers for photography and Bukit Bintang shopping.', 'meals' => 'Dinner', 'stay' => '4-Star KL Hotel'],
                    ['day_number' => 2, 'title' => 'Batu Caves & Genting Highlands Day Tour', 'description' => 'Excursion to Batu Caves Murugan statue, followed by Awana SkyWay Cable Car to Genting Highlands resort and Skytropolis theme park.', 'meals' => 'Breakfast', 'stay' => '4-Star KL Hotel'],
                    ['day_number' => 3, 'title' => 'Putrajaya Administrative City Tour', 'description' => 'Tour to Putrajaya lake, Pink Mosque, Prime Minister Office, and Sunway Lagoon (optional).', 'meals' => 'Breakfast', 'stay' => '4-Star KL Hotel'],
                    ['day_number' => 4, 'title' => 'Shopping & Airport Drop', 'description' => 'Breakfast at hotel. Free time for souvenirs at Central Market before departure transfer.', 'meals' => 'Breakfast', 'stay' => 'Return Flight'],
                ],
                'inclusions' => [
                    ['title' => '3 Nights Accommodation in Central Kuala Lumpur Hotel'],
                    ['title' => 'Daily Breakfast'],
                    ['title' => 'Batu Caves Tour + Return Genting SkyWay Cable Car Ticket'],
                    ['title' => 'KL Half-Day City Orientation Tour'],
                    ['title' => 'Roundtrip Private Airport Transfers'],
                ],
                'exclusions' => [
                    ['title' => 'Malaysia Visa Fee'],
                    ['title' => 'Theme Park Entry Tickets'],
                    ['title' => 'International Air Ticket'],
                ],
            ],
            [
                'destination_id' => $destMap['coxs-bazar']->id,
                'tour_category_id' => $catMap['domestic-tours']->id,
                'title' => 'Cox\'s Bazar Beach & Marine Drive Getaway',
                'slug' => 'coxs-bazar-beach-marine-drive-getaway',
                'short_description' => '3 Days / 2 Nights relaxing beach vacation with 5-star ocean-view resort and private Marine Drive tour.',
                'description' => 'Unwind on the world\'s longest sandy sea beach. Stay in a luxury 5-star beach resort, cruise along the spectacular Marine Drive, and explore the coral stones of Inani Beach and Himchari Hill viewpoint.',
                'duration_days' => 3,
                'duration_nights' => 2,
                'price' => 16500.00,
                'discount_price' => 14500.00,
                'currency' => 'BDT',
                'status' => 'published',
                'featured' => false,
                'popular' => true,
                'cover_image' => 'https://images.unsplash.com/photo-1608958435020-e8a7109ba809?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now(),
                'itineraries' => [
                    ['day_number' => 1, 'title' => 'Arrival in Cox\'s Bazar & Sunset Beach Walk', 'description' => 'Airport pickup and check-in to 5-star beachfront resort. Free afternoon to enjoy Laboni / Sugandha beach and seafood BBQ dinner.', 'meals' => 'Dinner', 'stay' => '5-Star Beach Resort'],
                    ['day_number' => 2, 'title' => 'Marine Drive, Himchari & Inani Coral Beach', 'description' => 'Scenic open-top or AC 4x4 drive along Marine Drive to Inani Coral Beach. Visit Himchari hill and waterfall.', 'meals' => 'Breakfast, Lunch', 'stay' => '5-Star Beach Resort'],
                    ['day_number' => 3, 'title' => 'Burmese Market Shopping & Departure', 'description' => 'Morning dip in swimming pool or beach. Visit Burmese Market for dry fish and handicrafts before airport drop.', 'meals' => 'Breakfast', 'stay' => 'Departure Flight'],
                ],
                'inclusions' => [
                    ['title' => '2 Nights in 5-Star Beach Resort (Ocean View Room)'],
                    ['title' => 'Daily Buffet Breakfast'],
                    ['title' => 'Private AC Vehicle for Inani & Himchari Tour'],
                    ['title' => 'Airport Pickup and Drop-off in Cox\'s Bazar'],
                    ['title' => 'Complimentary Resort Swimming Pool & Gym Access'],
                ],
                'exclusions' => [
                    ['title' => 'Dhaka – Cox\'s Bazar Air Ticket (Available upon request)'],
                    ['title' => 'Lunch & Dinner unless specified'],
                ],
            ],
        ];

        foreach ($tours as $tData) {
            $itin = $tData['itineraries'];
            $inc = $tData['inclusions'];
            $exc = $tData['exclusions'];
            unset($tData['itineraries'], $tData['inclusions'], $tData['exclusions']);

            $tour = Tour::updateOrCreate(['slug' => $tData['slug']], $tData);

            TourItinerary::where('tour_id', $tour->id)->delete();
            foreach ($itin as $it) {
                TourItinerary::create(array_merge($it, ['tour_id' => $tour->id]));
            }
            TourInclusion::where('tour_id', $tour->id)->delete();
            foreach ($inc as $iIdx => $in) {
                TourInclusion::create(array_merge($in, ['tour_id' => $tour->id, 'sort_order' => $iIdx + 1]));
            }
            TourExclusion::where('tour_id', $tour->id)->delete();
            foreach ($exc as $eIdx => $ex) {
                TourExclusion::create(array_merge($ex, ['tour_id' => $tour->id, 'sort_order' => $eIdx + 1]));
            }
        }

        // 6. Profession Types
        $professions = [
            ['name' => 'Salaried Employee / Service Holder', 'slug' => 'salaried', 'sort_order' => 1],
            ['name' => 'Business Owner / Entrepreneur', 'slug' => 'business-owner', 'sort_order' => 2],
            ['name' => 'Student', 'slug' => 'student', 'sort_order' => 3],
            ['name' => 'Freelancer / Remote Worker', 'slug' => 'freelancer', 'sort_order' => 4],
            ['name' => 'Retired Person', 'slug' => 'retired', 'sort_order' => 5],
            ['name' => 'Housewife', 'slug' => 'housewife', 'sort_order' => 6],
            ['name' => 'Other Professional', 'slug' => 'other', 'sort_order' => 7],
        ];

        $profMap = [];
        foreach ($professions as $prof) {
            $profMap[$prof['slug']] = ProfessionType::updateOrCreate(['slug' => $prof['slug']], $prof);
        }

        // 7. Visa Countries & Requirements
        $visaCountries = [
            [
                'country_name' => 'Thailand',
                'slug' => 'thailand',
                'flag' => '🇹🇭',
                'hero_image' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Fast and hassle-free Thailand tourist visa processing with verified document assistance.',
                'description' => 'Thailand is the most visited destination by Bangladeshi travelers. We assist with single-entry tourist visas (e-Visa and physical sticker visa submission through VFS Thailand). Our team checks every bank statement and NOC to maximize visa approval probability.',
                'featured' => true,
                'sort_order' => 1,
                'information_updated_at' => now(),
                'types' => [
                    [
                        'name' => 'Tourist Visa (Single Entry)',
                        'slug' => 'tourist-visa-single-entry',
                        'description' => 'Valid for 90 days with up to 60 days stay period.',
                        'validity' => '90 Days',
                        'stay_period' => '60 Days',
                        'entry_type' => 'Single Entry',
                        'processing_time' => '5-7',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 5000.00,
                        'service_fee' => 1500.00,
                        'requirements' => [
                            ['title' => 'Original Passport with minimum 6 months validity from travel date'],
                            ['title' => '2 Recent Passport Size Photographs (3.5cm x 4.5cm, white background, matte finish)'],
                            ['title' => 'Bank Statement of last 6 months with minimum ending balance ৳60,000 per person / ৳1,20,000 for family'],
                            ['title' => 'Bank Solvency Certificate from the same bank'],
                            ['title' => 'Confirmed round-trip air ticket itinerary & hotel booking (Provided by Emisha)'],
                            ['title' => 'Visa Application Form duly signed by applicant'],
                        ],
                        'profession_requirements' => [
                            'salaried' => [
                                ['title' => 'No Objection Certificate (NOC) on company official letterhead'],
                                ['title' => 'Office ID Card Copy & Visiting Card'],
                                ['title' => 'Salary Certificate or Pay Slips of last 3 months'],
                                ['title' => 'GO / Note Verbale (For Government Officers)'],
                            ],
                            'business-owner' => [
                                ['title' => 'Valid Trade License translated and notarized in English'],
                                ['title' => 'Memorandum of Articles (For Limited Company) / Partnership Deed'],
                                ['title' => 'Company Visiting Card & Official Blank Letterhead Pad'],
                                ['title' => 'Company Bank Statement & Solvency Certificate (if company sponsoring)'],
                            ],
                            'student' => [
                                ['title' => 'Student ID Card copy'],
                                ['title' => 'Leave / Permission Letter from School / College / University'],
                                ['title' => 'Financial sponsorship letter from parent + parent bank statement & solvency'],
                            ],
                            'freelancer' => [
                                ['title' => 'Freelancing platform profile link / Certificate of earnings / Tax Certificate'],
                                ['title' => 'Personal Bank Statement showing foreign remittance inflow'],
                            ],
                            'housewife' => [
                                ['title' => 'Spouse\'s sponsorship letter and marriage certificate (Nikahnama)'],
                                ['title' => 'Spouse\'s Bank Statement & Solvency Certificate'],
                            ],
                            'retired' => [
                                ['title' => 'Retirement Certificate or Pension Book copy'],
                            ],
                        ],
                    ],
                    [
                        'name' => 'Medical Visa (Single Entry)',
                        'slug' => 'medical-visa',
                        'description' => 'For specialized medical treatment and checkups at Thailand hospitals.',
                        'validity' => '90 Days',
                        'stay_period' => 'Up to 90 Days',
                        'entry_type' => 'Single Entry',
                        'processing_time' => '5-7',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 6500.00,
                        'service_fee' => 2000.00,
                        'requirements' => [
                            ['title' => 'Original Passport with minimum 6 months validity'],
                            ['title' => 'Doctor\'s referral letter from Bangladesh hospital'],
                            ['title' => 'Hospital appointment letter from Thailand recognized hospital'],
                            ['title' => 'Bank Statement (Minimum balance ৳1,50,000) & Bank Solvency'],
                        ],
                        'profession_requirements' => [],
                    ],
                ],
            ],
            [
                'country_name' => 'Malaysia',
                'slug' => 'malaysia',
                'flag' => '🇲🇾',
                'hero_image' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Malaysia e-Visa and sticker visa processing for tourism and business.',
                'description' => 'Explore the vibrant multicultural paradise of Malaysia. We process official Malaysia e-Visas within 3-5 working days with guaranteed document verification.',
                'featured' => true,
                'sort_order' => 2,
                'information_updated_at' => now(),
                'types' => [
                    [
                        'name' => 'Tourist e-Visa',
                        'slug' => 'tourist-e-visa',
                        'description' => 'Electronic visa valid for 3 months with up to 30 days single entry stay.',
                        'validity' => '90 Days',
                        'stay_period' => '30 Days',
                        'entry_type' => 'Single Entry',
                        'processing_time' => '3-5',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 5500.00,
                        'service_fee' => 1500.00,
                        'requirements' => [
                            ['title' => 'Original Passport Scan (Bio Page + previous visa pages)'],
                            ['title' => 'Digital Passport Photograph (35mm x 50mm, white background, studio quality)'],
                            ['title' => 'Last 6 Months Bank Statement with minimum balance ৳80,000 per applicant'],
                            ['title' => 'Bank Solvency Certificate'],
                            ['title' => 'Confirmed Return Flight Ticket (Included in Emisha package)'],
                        ],
                        'profession_requirements' => [
                            'salaried' => [
                                ['title' => 'Official Employment NOC & Office ID Card'],
                                ['title' => 'Salary Pay Slips of last 3 months'],
                            ],
                            'business-owner' => [
                                ['title' => 'Trade License (translated & notarized in English)'],
                                ['title' => 'Visiting Card & Letterhead'],
                            ],
                            'student' => [
                                ['title' => 'Student ID Card & Institution Permission Letter'],
                                ['title' => 'Parental Financial Sponsorship Letter'],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'country_name' => 'United Arab Emirates (Dubai)',
                'slug' => 'uae-dubai',
                'flag' => '🇦🇪',
                'hero_image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Fast Dubai tourist e-Visa processing within 24 to 72 hours.',
                'description' => 'Experience Dubai with simple and swift tourist visa processing. No complicated embassy interview required. 30 Days and 60 Days single/multiple entry visas available.',
                'featured' => true,
                'sort_order' => 3,
                'information_updated_at' => now(),
                'types' => [
                    [
                        'name' => '30 Days Tourist E-Visa',
                        'slug' => '30-days-tourist-e-visa',
                        'description' => 'Quick e-Visa valid for 60 days from issuance date with 30 days single entry stay.',
                        'validity' => '60 Days',
                        'stay_period' => '30 Days',
                        'entry_type' => 'Single Entry',
                        'processing_time' => '2-3',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 12500.00,
                        'service_fee' => 1500.00,
                        'requirements' => [
                            ['title' => 'Passport Color Scan copy (Clear 1st and 2nd pages)'],
                            ['title' => 'Passport size photograph with white background (Digital copy)'],
                            ['title' => 'National ID Card or Birth Certificate copy'],
                        ],
                        'profession_requirements' => [],
                    ],
                    [
                        'name' => '60 Days Tourist E-Visa',
                        'slug' => '60-days-tourist-e-visa',
                        'description' => 'Ideal for extended family visits or leisure travel across all Emirates.',
                        'validity' => '60 Days',
                        'stay_period' => '60 Days',
                        'entry_type' => 'Single Entry',
                        'processing_time' => '3-4',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 21500.00,
                        'service_fee' => 2000.00,
                        'requirements' => [
                            ['title' => 'Passport Color Scan copy (Minimum 6 months validity)'],
                            ['title' => 'Digital passport photo (White background)'],
                        ],
                        'profession_requirements' => [],
                    ],
                ],
            ],
            [
                'country_name' => 'Singapore',
                'slug' => 'singapore',
                'flag' => '🇸🇬',
                'hero_image' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Singapore Authorized e-Visa processing with official invitation support.',
                'description' => 'Singapore e-Visa processing handled with precision. We ensure all Form 14A documentation, LOI (Letter of Introduction), and financial papers are verified to the highest standard.',
                'featured' => true,
                'sort_order' => 4,
                'information_updated_at' => now(),
                'types' => [
                    [
                        'name' => 'Singapore Tourist E-Visa',
                        'slug' => 'singapore-tourist-e-visa',
                        'description' => 'E-Visa with up to 30 days stay per entry.',
                        'validity' => '35 Days / 2 Years (Embassy discretion)',
                        'stay_period' => 'Up to 30 Days',
                        'entry_type' => 'Multiple / Single Entry',
                        'processing_time' => '5-7',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 4500.00,
                        'service_fee' => 2000.00,
                        'requirements' => [
                            ['title' => 'Passport scan (valid for at least 6 months)'],
                            ['title' => 'Digital photo (35mm x 45mm, matte finish, white background)'],
                            ['title' => 'Bank statement of last 6 months (Ending balance ৳1,00,000+) & Solvency'],
                            ['title' => 'Official Employment NOC / Trade License'],
                        ],
                        'profession_requirements' => [],
                    ],
                ],
            ],
        ];

        foreach ($visaCountries as $vCountry) {
            $types = $vCountry['types'];
            unset($vCountry['types']);

            $country = VisaCountry::updateOrCreate(['slug' => $vCountry['slug']], $vCountry);

            foreach ($types as $tIdx => $vt) {
                $reqs = $vt['requirements'];
                $profReqs = $vt['profession_requirements'] ?? [];
                unset($vt['requirements'], $vt['profession_requirements']);

                $visaType = VisaType::updateOrCreate(
                    ['visa_country_id' => $country->id, 'slug' => $vt['slug']],
                    array_merge($vt, [
                        'sort_order' => $tIdx + 1,
                    ])
                );

                VisaRequirement::where('visa_type_id', $visaType->id)->delete();
                foreach ($reqs as $rIdx => $r) {
                    VisaRequirement::create(array_merge($r, [
                        'visa_type_id' => $visaType->id,
                        'sort_order' => $rIdx + 1,
                    ]));
                }

                VisaProfessionRequirement::where('visa_type_id', $visaType->id)->delete();
                foreach ($profReqs as $pSlug => $pList) {
                    if (isset($profMap[$pSlug])) {
                        $pId = $profMap[$pSlug]->id;
                        foreach ($pList as $pIdx => $pReq) {
                            VisaProfessionRequirement::create(array_merge($pReq, [
                                'visa_type_id' => $visaType->id,
                                'profession_type_id' => $pId,
                                'sort_order' => $pIdx + 1,
                            ]));
                        }
                    }
                }
            }
        }

        $this->call(VisaPricingSeeder::class);

        // 8. Sample Testimonials
        $testimonials = [
            [
                'customer_name' => 'Tanvir Ahmed',
                'photo' => '/images/clients/tanvir-ahmed.jpg',
                'destination' => 'Thailand Escape',
                'service' => 'Tour Package',
                'review' => 'Our 5-day Bangkok and Pattaya tour was flawlessly organized by Emisha Tours. From hotel transfers to dinner cruise tickets, everything was on time and stress-free. Highly recommended!',
                'rating' => 5,
                'featured' => true,
                'status' => 'published',
            ],
            [
                'customer_name' => 'Nusrat Jahan & Farhan',
                'photo' => '/images/clients/nusrat-farhan.jpg',
                'destination' => 'Maldives Honeymoon',
                'service' => 'Honeymoon Tour',
                'review' => 'The overwater villa experience in the Maldives arranged by Emisha was pure magic! They took care of our speedboat transfers, candlelight dinner, and green taxes without any hidden costs.',
                'rating' => 5,
                'featured' => true,
                'status' => 'published',
            ],
            [
                'customer_name' => 'Dr. Kamrul Hasan',
                'photo' => '/images/clients/dr-kamrul-hasan.jpg',
                'destination' => 'Dubai, UAE',
                'service' => 'Visa & Ticketing',
                'review' => 'Got my Dubai e-Visa in just 48 hours and roundtrip Emirates tickets at an unbeatable corporate rate. Emisha’s visa consultancy team is professional, prompt, and trustworthy.',
                'rating' => 5,
                'featured' => true,
                'status' => 'published',
            ],
        ];

        foreach ($testimonials as $idx => $test) {
            Testimonial::updateOrCreate(['customer_name' => $test['customer_name']], array_merge($test, ['sort_order' => $idx + 1]));
        }

        // 9. Sample FAQs
        $faqs = [
            [
                'category' => 'general',
                'question' => 'How can I book a tour package with Emisha Tours & Travels?',
                'answer' => 'You can browse our curated packages, click "Request This Tour" or "Start Inquiry", fill in your expected travel dates and passenger details, or directly message us on WhatsApp. Our dedicated travel consultant will contact you within 2 hours with quotation options.',
                'sort_order' => 1,
            ],
            [
                'category' => 'visa',
                'question' => 'What happens if my visa application gets rejected?',
                'answer' => 'Visa approvals are subject to the sole discretion of the respective embassy or immigration authority. While embassy processing fees are generally non-refundable per embassy policies, our expert team reviews every document beforehand to maximize your chances of approval.',
                'sort_order' => 2,
            ],
            [
                'category' => 'ticketing',
                'question' => 'How do I get the lowest airfare quotation for domestic and international flights?',
                'answer' => 'Navigate to our Air Ticketing page, submit your origin, destination, preferred dates, and cabin class. Our ticketing desk searches across GDS systems (Amadeus, Sabre) and low-cost carriers to provide you with the most competitive fare quotes.',
                'sort_order' => 3,
            ],
            [
                'category' => 'tour',
                'question' => 'Can I customize the tour itinerary according to my family\'s preference?',
                'answer' => 'Yes! All our tour packages can be customized. You can add extra days, upgrade to 5-star hotels, request private vehicles, or add specific theme park tickets by submitting a customized tour request.',
                'sort_order' => 4,
            ],
            [
                'category' => 'booking',
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept bank transfers to our corporate accounts (City Bank, BRAC Bank, Eastern Bank), bKash/Nagad merchant payments, and direct cash payments at our Mirpur office.',
                'sort_order' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }

        // 10. Blog Categories and Posts
        $bCat1 = BlogCategory::updateOrCreate(['slug' => 'visa-guides'], ['name' => 'Visa Guides', 'description' => 'Up-to-date visa guidelines for Bangladeshi passport holders.']);
        $bCat2 = BlogCategory::updateOrCreate(['slug' => 'destination-insights'], ['name' => 'Destination Insights', 'description' => 'Travel tips, food guides, and itineraries.']);

        $posts = [
            [
                'blog_category_id' => $bCat1->id,
                'author_id' => $admin->id,
                'destination_id' => $destMap['thailand']->id,
                'title' => 'Thailand Visa Requirements for Bangladeshi Citizens in 2026: Complete Step-by-Step Guide',
                'slug' => 'thailand-visa-requirements-bangladesh-guide-2026',
                'excerpt' => 'Everything you need to know about bank solvency, NOC formats, photo specifications, and VFS submission for Thailand tourist visas.',
                'content' => '<p>Planning a trip to Bangkok or Phuket? As a Bangladeshi citizen, securing a Thailand tourist visa is straightforward if you prepare the required paperwork properly.</p><h3>Key Required Documents:</h3><ul><li>Original Passport with at least 6 months validity.</li><li>2 Recent photos (3.5cm x 4.5cm, matte finish).</li><li>Bank Statement with minimum ending balance of ৳60,000 for individuals or ৳1,20,000 for families.</li><li>Official NOC on company letterhead for job holders or Trade License for business owners.</li></ul><p>Let Emisha Tours & Travels handle your document scrutiny and submission for a 100% stress-free journey.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?auto=format&fit=crop&w=1200&q=80',
                'reading_time' => 6,
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'blog_category_id' => $bCat2->id,
                'author_id' => $admin->id,
                'destination_id' => $destMap['maldives']->id,
                'title' => 'Top 7 Things to Know Before Booking a Maldives Honeymoon Trip from Bangladesh',
                'slug' => 'top-7-things-to-know-maldives-honeymoon-bangladesh',
                'excerpt' => 'Speedboat vs Seaplane transfers, All-Inclusive meal plans, Best season to travel, and overwater villa tips for Bangladeshi couples.',
                'content' => '<p>The Maldives is a bucket-list dream for newlyweds. Here is our essential guide on meal plan choices (Half-board vs All-Inclusive), choosing between speedboat and seaplane resorts, and saving money on international flights.</p><p>Bangladeshi passport holders receive a 30-day on-arrival visa free of cost upon showing hotel confirmation and return flight tickets.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=1200&q=80',
                'reading_time' => 5,
                'status' => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'blog_category_id' => $bCat2->id,
                'author_id' => $admin->id,
                'destination_id' => $destMap['dubai']->id,
                'title' => 'Ultimate 5-Day Dubai Itinerary: Desert Safari, Burj Khalifa & Shopping Extravaganza',
                'slug' => 'ultimate-5-day-dubai-itinerary-guide',
                'excerpt' => 'How to optimize your Dubai vacation with the best timing for desert dune bashing, top observation decks, and luxury dhow cruises.',
                'content' => '<p>Dubai combines hyper-modern architecture with authentic Arabian hospitality. Discover the optimal 5-day travel schedule covering Dubai Marina, Burj Khalifa, Abu Dhabi Grand Mosque, and Gold Souk shopping.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1200&q=80',
                'reading_time' => 7,
                'status' => 'published',
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(['slug' => $post['slug']], $post);
        }

        // 11. Gallery Categories & Images
        $gCat1 = GalleryCategory::updateOrCreate(['slug' => 'international-gallery'], ['name' => 'International Tours', 'sort_order' => 1]);
        $gCat2 = GalleryCategory::updateOrCreate(['slug' => 'island-beach-escapes'], ['name' => 'Island & Beach Escapes', 'sort_order' => 2]);
        $gCat3 = GalleryCategory::updateOrCreate(['slug' => 'cultural-city-landmarks'], ['name' => 'Cultural & City Landmarks', 'sort_order' => 3]);
        $gCat4 = GalleryCategory::updateOrCreate(['slug' => 'client-memories'], ['name' => 'Client & Group Memories', 'sort_order' => 4]);
        $gCat5 = GalleryCategory::updateOrCreate(['slug' => 'umrah-sacred-journeys'], ['name' => 'Umrah & Sacred Journeys', 'sort_order' => 5]);

        $gallery = [
            ['gallery_category_id' => $gCat2->id, 'title' => 'Maldives Overwater Luxury Lagoon', 'location' => 'South Ari Atoll, Maldives', 'caption' => 'Turquoise crystal ocean with private overwater sundeck and coral reef snorkeling.', 'image_path' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Maldives Luxury Overwater Resort'],
            ['gallery_category_id' => $gCat2->id, 'title' => 'Phi Phi Islands Speedboat Cruise', 'location' => 'Phuket, Thailand', 'caption' => 'Cruising Maya Bay and Pileh Lagoon with emerald turquoise lagoons and limestone cliffs.', 'image_path' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Phi Phi Island Speedboat Cruise Thailand'],
            ['gallery_category_id' => $gCat1->id, 'title' => 'Lahbab Red Desert Safari', 'location' => 'Lahbab Desert, Dubai', 'caption' => 'Thrilling 4x4 dune bashing, camel riding, and VIP BBQ dinner under the desert stars.', 'image_path' => 'https://images.unsplash.com/photo-1451337516015-6b6e9a44a8a3?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Dubai Red Dunes Safari'],
            ['gallery_category_id' => $gCat3->id, 'title' => 'Wat Arun Temple of Dawn', 'location' => 'Bangkok, Thailand', 'caption' => 'Iconic riverside Khmer-style porcelain spire glowing during sunset at Chao Phraya River.', 'image_path' => 'https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Wat Arun Bangkok Thailand'],
            ['gallery_category_id' => $gCat3->id, 'title' => 'Downtown Dubai & Burj Khalifa', 'location' => 'Dubai, UAE', 'caption' => 'World-famous futuristic skyline and choreographed Dubai Fountain spectacle.', 'image_path' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Dubai Burj Khalifa Skyline'],
            ['gallery_category_id' => $gCat3->id, 'title' => 'Petronas Twin Towers Illumination', 'location' => 'Kuala Lumpur, Malaysia', 'caption' => 'Stunning 88-storey architectural masterpiece illuminated in the heart of KLCC.', 'image_path' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Petronas Twin Towers Malaysia'],
            ['gallery_category_id' => $gCat2->id, 'title' => 'Bali Ubud Lush Rice Terraces', 'location' => 'Ubud, Bali, Indonesia', 'caption' => 'Serene emerald green Tegallalang rice paddies, traditional culture, and tropical nature.', 'image_path' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Bali Ubud Rice Terraces'],
            ['gallery_category_id' => $gCat1->id, 'title' => 'Cappadocia Sunrise Hot Air Balloons', 'location' => 'Göreme, Cappadocia, Turkey', 'caption' => 'Fairy-tale landscape filled with hundreds of colorful hot air balloons rising over fairy chimneys.', 'image_path' => 'https://images.unsplash.com/photo-1570939274717-7eda259b50ed?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Cappadocia Hot Air Balloons Turkey'],
            ['gallery_category_id' => $gCat1->id, 'title' => 'Swiss Alps Panoramic Mountain Vista', 'location' => 'Jungfrau Region, Switzerland', 'caption' => 'Majestic snow-capped alpine peaks, scenic cogwheel trains, and pristine mountain air.', 'image_path' => 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Swiss Alps Panoramic Vista'],
            ['gallery_category_id' => $gCat4->id, 'title' => 'Happy Family Vacation in Coral Island', 'location' => 'Pattaya, Thailand', 'caption' => 'Capturing unforgettable smiling moments during our private customized family tour package.', 'image_path' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Happy Travelers Group Photo'],
            ['gallery_category_id' => $gCat4->id, 'title' => 'Cox\'s Bazar Marine Drive Golden Sunset', 'location' => 'Cox\'s Bazar, Bangladesh', 'caption' => 'Breathtaking crimson sunset overlooking the world’s longest natural sea beach.', 'image_path' => 'https://images.unsplash.com/photo-1608958435020-e8a7109ba809?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Sunset at Cox\'s Bazar Sea Beach'],
            ['gallery_category_id' => $gCat5->id, 'title' => 'Holy Makkah Masjid Al-Haram', 'location' => 'Makkah, Saudi Arabia', 'caption' => 'Peaceful spiritual atmosphere at the Holy Kaaba during premium VIP Umrah pilgrimage.', 'image_path' => 'https://images.unsplash.com/photo-1565552684305-7e77f250353a?auto=format&fit=crop&w=1200&h=1500&q=85', 'alt_text' => 'Holy Kaaba Makkah Umrah'],
        ];

        foreach ($gallery as $idx => $g) {
            GalleryImage::updateOrCreate(['title' => $g['title']], array_merge($g, ['sort_order' => $idx + 1]));
        }

        // 12. Standard Legal & Info Pages
        $pages = [
            [
                'title' => 'About Emisha Tours & Travels',
                'slug' => 'about',
                'template' => 'about',
                'content' => '<h2>Welcome to Emisha Tours & Travels</h2><p>Emisha Tours & Travels is a trusted, full-service travel management and visa consultancy company based in Dhaka, Bangladesh. We specialize in providing customized international tour packages, certified visa assistance, hotel reservations, and worldwide flight ticketing for leisure and corporate travelers.</p><h3>Our Mission</h3><p>To provide transparent, dependable, and memorable travel experiences while maintaining the highest standard of customer care and ethical consultancy.</p><h3>Why Travel With Us?</h3><ul><li><strong>Authorized Partnerships:</strong> Direct alliances with leading global hotel chains and DMC suppliers.</li><li><strong>Expert Visa Consultants:</strong> High visa approval success rate backed by meticulous document review.</li><li><strong>24/7 Ground Assistance:</strong> Dedicated helpline for our traveling guests abroad.</li><li><strong>No Hidden Costs:</strong> Clear, upfront pricing with all inclusions and exclusions itemized.</li></ul>',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'template' => 'privacy',
                'content' => '<h2>Privacy Policy</h2><p>At Emisha Tours & Travels, we respect and protect the privacy of our customers. This Privacy Policy details how we collect, store, and handle your personal and confidential information.</p><h3>Information We Collect</h3><p>We only collect personal information necessary to deliver travel services, including your name, email, phone number, passport scan copies (for visa and flight booking), and travel preferences.</p><h3>Data Security & Protection</h3><p>All sensitive uploaded documents (passport copies, bank statements) are stored in secure private server storage and are accessible only to authorized visa officers for submission to relevant embassies.</p>',
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'template' => 'terms',
                'content' => '<h2>Terms & Conditions</h2><p>By using the website and services of Emisha Tours & Travels, you agree to comply with our booking conditions, quotation validity periods, and terms of service.</p><h3>Bookings & Inquiries</h3><p>All travel quotations are subject to seat and room availability at the time of final confirmation. Fares and package rates may fluctuate due to airline taxes or currency exchange changes.</p>',
            ],
            [
                'title' => 'Refund & Cancellation Policy',
                'slug' => 'refund-cancellation-policy',
                'template' => 'refund',
                'content' => '<h2>Refund & Cancellation Policy</h2><p>Cancellation policies vary based on the airline, hotel supplier, and timing of cancellation before the travel departure date.</p><ul><li>Cancellations 30+ days prior to travel: Subject to standard non-refundable airline / hotel deposit terms.</li><li>Visa consultancy fees and embassy submission charges are non-refundable once submitted.</li></ul>',
            ],
            [
                'title' => 'Visa Disclaimer',
                'slug' => 'visa-disclaimer',
                'template' => 'disclaimer',
                'content' => '<h2>Visa Consultancy Disclaimer</h2><p>Emisha Tours & Travels operates solely as a third-party visa facilitation and advisory consultancy. The decision to grant, refuse, or delay a visa lies exclusively with the respective Embassy, High Commission, or Immigration Authority. Emisha Tours & Travels cannot guarantee visa issuance under any circumstances.</p>',
            ],
            [
                'title' => 'Cookie Policy',
                'slug' => 'cookie-policy',
                'template' => 'cookie',
                'content' => '<h2>Cookie Policy</h2><p>We use essential cookies to maintain user session state, enable security features, and analyze aggregate website usage traffic for performance optimization.</p>',
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 13. Sample Inquiries, Ticket Requests, and Visa Applications
        TourInquiry::firstOrCreate(
            ['reference_number' => 'TOUR-2026-000001'],
            [
                'tour_id' => 1,
                'tour_title' => 'Bangkok & Pattaya Highlights',
                'full_name' => 'Zubair Hossain',
                'email' => 'zubair.h@example.com',
                'phone' => '+880 1715 112233',
                'travel_date' => Carbon::now()->addWeeks(3),
                'adults' => 2,
                'children' => 1,
                'message' => 'Looking for family travel next month with private transfer and halal food options.',
                'status' => 'new',
            ]
        );

        TicketRequest::firstOrCreate(
            ['reference_number' => 'TKT-2026-000001'],
            [
                'trip_type' => 'round-trip',
                'origin' => 'Dhaka (DAC)',
                'destination' => 'Bangkok (BKK)',
                'departure_date' => Carbon::now()->addWeeks(3),
                'return_date' => Carbon::now()->addWeeks(4),
                'adults' => 2,
                'children' => 1,
                'cabin_class' => 'Economy',
                'preferred_airline' => 'Thai Airways / Biman',
                'full_name' => 'Zubair Hossain',
                'email' => 'zubair.h@example.com',
                'phone' => '+880 1715 112233',
                'status' => 'new',
            ]
        );

        VisaApplication::firstOrCreate(
            ['reference_number' => 'VISA-2026-000001'],
            [
                'visa_country_id' => 1,
                'visa_type_id' => 1,
                'profession_type_id' => 1,
                'full_name' => 'Mustafizur Rahman',
                'email' => 'mustafiz@example.com',
                'phone' => '+880 1912 334455',
                'date_of_birth' => '1990-05-15',
                'nationality' => 'Bangladeshi',
                'passport_number' => 'A12345678',
                'travel_purpose' => 'Tourism & Leisure',
                'travel_date' => Carbon::now()->addMonth(),
                'stay_duration' => '10 Days',
                'travelers_count' => 1,
                'status' => 'received',
                'submitted_at' => now(),
            ]
        );
    }
}
