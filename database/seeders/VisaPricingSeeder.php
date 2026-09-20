<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisaCountry;
use App\Models\VisaType;
use App\Models\ProfessionType;
use App\Models\VisaRequirement;
use App\Models\VisaProfessionRequirement;

class VisaPricingSeeder extends Seeder
{
    public function run(): void
    {
        $profMap = ProfessionType::all()->pluck('id', 'slug')->toArray();

        $visaData = [
            [
                'country_name' => 'Thailand',
                'slug' => 'thailand',
                'flag' => '🇹🇭',
                'hero_image' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Fast and hassle-free Thailand tourist e-Visa and sticker visa processing.',
                'description' => 'Thailand is the most visited destination by Bangladeshi travelers. We assist with single-entry tourist e-Visas and physical sticker visa submissions through VFS Thailand.',
                'featured' => true,
                'sort_order' => 1,
                'types' => [
                    [
                        'name' => 'E-Visa',
                        'slug' => 'thailand-e-visa',
                        'description' => 'Official Thailand tourist e-Visa valid for 90 days with up to 60 days stay period.',
                        'validity' => '90 Days',
                        'stay_period' => '60 Days',
                        'entry_type' => 'Single Entry',
                        'processing_time' => '5-7',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 6000.00,
                        'service_fee' => 0.00,
                        'requirements' => [
                            ['title' => 'Original Passport with minimum 6 months validity from travel date'],
                            ['title' => '2 Recent Passport Size Photographs (3.5cm x 4.5cm, white background, matte finish)'],
                            ['title' => 'Bank Statement of last 6 months with minimum ending balance ৳60,000 per person'],
                            ['title' => 'Bank Solvency Certificate from the same bank'],
                            ['title' => 'Confirmed round-trip air ticket itinerary & hotel booking (Provided by Emisha)'],
                            ['title' => 'Visa Application Form duly signed by applicant'],
                        ],
                    ],
                ],
            ],
            [
                'country_name' => 'Malaysia',
                'slug' => 'malaysia',
                'flag' => '🇲🇾',
                'hero_image' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Official Malaysia tourist e-Visa processing with verified document assistance.',
                'description' => 'Explore Malaysia with fast official e-Visa processing. Quick turnaround with guaranteed document verification.',
                'featured' => true,
                'sort_order' => 2,
                'types' => [
                    [
                        'name' => 'E-Visa',
                        'slug' => 'malaysia-e-visa',
                        'description' => 'Electronic visa valid for 3 months with up to 30 days single entry stay.',
                        'validity' => '90 Days',
                        'stay_period' => '30 Days',
                        'entry_type' => 'Single Entry',
                        'processing_time' => '3-5',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 4500.00,
                        'service_fee' => 0.00,
                        'requirements' => [
                            ['title' => 'Original Passport Scan (Bio Page + previous visa pages)'],
                            ['title' => 'Digital Passport Photograph (35mm x 50mm, white background)'],
                            ['title' => 'Last 6 Months Bank Statement with minimum balance ৳80,000 per applicant'],
                            ['title' => 'Bank Solvency Certificate'],
                            ['title' => 'Confirmed Return Flight Ticket'],
                        ],
                    ],
                ],
            ],
            [
                'country_name' => 'Singapore',
                'slug' => 'singapore',
                'flag' => '🇸🇬',
                'hero_image' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Singapore Authorized e-Visa processing with official invitation support.',
                'description' => 'Singapore e-Visa processing handled with precision. Form 14A and LOI documentation verified to high standards.',
                'featured' => true,
                'sort_order' => 3,
                'types' => [
                    [
                        'name' => 'E-Visa',
                        'slug' => 'singapore-e-visa',
                        'description' => 'Authorized electronic visa with up to 30 days stay per entry.',
                        'validity' => '35 Days / 2 Years (Embassy discretion)',
                        'stay_period' => 'Up to 30 Days',
                        'entry_type' => 'Multiple / Single Entry',
                        'processing_time' => '5-7',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 6000.00,
                        'service_fee' => 0.00,
                        'requirements' => [
                            ['title' => 'Passport scan (valid for at least 6 months)'],
                            ['title' => 'Digital photo (35mm x 45mm, matte finish, white background)'],
                            ['title' => 'Bank statement of last 6 months (Ending balance ৳1,00,000+) & Solvency'],
                            ['title' => 'Official Employment NOC / Trade License'],
                        ],
                    ],
                ],
            ],
            [
                'country_name' => 'Sri Lanka',
                'slug' => 'sri-lanka',
                'flag' => '🇱🇰',
                'hero_image' => 'https://images.unsplash.com/photo-1586861635167-e5223aadc9fe?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Instant Sri Lanka Tourist ETA / e-Visa processing within 24-48 hours.',
                'description' => 'Fast online ETA and tourist e-Visa processing for travelers visiting the pearl of the Indian Ocean.',
                'featured' => true,
                'sort_order' => 4,
                'types' => [
                    [
                        'name' => 'E-Visa',
                        'slug' => 'sri-lanka-e-visa',
                        'description' => 'Official Sri Lanka ETA tourist visa with double entry facility.',
                        'validity' => '180 Days',
                        'stay_period' => '30 Days',
                        'entry_type' => 'Double Entry',
                        'processing_time' => '2-3',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 3500.00,
                        'service_fee' => 0.00,
                        'requirements' => [
                            ['title' => 'Passport Bio-Data page scan (Clear color copy)'],
                            ['title' => 'Digital passport size photograph (White background)'],
                            ['title' => 'Return air ticket and hotel reservation'],
                        ],
                    ],
                ],
            ],
            [
                'country_name' => 'Japan',
                'slug' => 'japan',
                'flag' => '🇯🇵',
                'hero_image' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Complete Japan tourist visa application assistance & document scrutiny.',
                'description' => 'Comprehensive document checking, itinerary preparation, and embassy application assistance for Japan visas.',
                'featured' => true,
                'sort_order' => 5,
                'types' => [
                    [
                        'name' => 'Processing Fee',
                        'slug' => 'japan-processing-fee',
                        'description' => 'Full consultancy, document preparation, and itinerary scheduling for Japan tourist visa.',
                        'validity' => '90 Days',
                        'stay_period' => '15 / 30 Days',
                        'entry_type' => 'Single Entry',
                        'processing_time' => '7-10',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 3500.00,
                        'service_fee' => 0.00,
                        'requirements' => [
                            ['title' => 'Original Passport with at least 6 months validity'],
                            ['title' => '2 Recent Photographs (2in x 2in, white background)'],
                            ['title' => 'Bank Statement of last 6 months with Solvency Certificate'],
                            ['title' => 'Income Tax Return (ITR) certificate / TIN'],
                            ['title' => 'Day-wise detailed travel itinerary in Japan'],
                        ],
                    ],
                ],
            ],
            [
                'country_name' => 'United States (USA)',
                'slug' => 'usa',
                'flag' => '🇺🇸',
                'hero_image' => 'https://images.unsplash.com/photo-1485738422979-f5c462d49f74?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'US B1/B2 Tourist & Business Visa consultancy, DS-160 filling & appointment slot booking.',
                'description' => 'Expert DS-160 form filling, profile assessment, mock interview preparation, and embassy appointment scheduling.',
                'featured' => true,
                'sort_order' => 6,
                'types' => [
                    [
                        'name' => 'Processing Fee',
                        'slug' => 'usa-processing-fee',
                        'description' => 'B1/B2 Visa full profile review, DS-160 submission, fee payment & interview appointment booking.',
                        'validity' => '5 Years',
                        'stay_period' => 'Up to 6 Months',
                        'entry_type' => 'Multiple Entry',
                        'processing_time' => 'Appointment Based',
                        'processing_time_unit' => '',
                        'starting_fee' => 15000.00,
                        'service_fee' => 0.00,
                        'requirements' => [
                            ['title' => 'Valid Passport with minimum 6 months validity'],
                            ['title' => 'US Visa Specification Digital Photo (2in x 2in, white background)'],
                            ['title' => 'Completed DS-160 Application Confirmation'],
                            ['title' => 'Financial Solvency, Asset Evaluation & Bank Statements'],
                            ['title' => 'Employment / Business Verification Documents & Tax Returns'],
                        ],
                    ],
                ],
            ],
            [
                'country_name' => 'Canada',
                'slug' => 'canada',
                'flag' => '🇨🇦',
                'hero_image' => 'https://images.unsplash.com/photo-1503614472-8c93d56e92ce?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Canada Visitor Visa online portal submission, statement analysis & biometrics guidance.',
                'description' => 'Complete IRCC portal application management, financial documentation audit, and biometrics appointment support.',
                'featured' => true,
                'sort_order' => 7,
                'types' => [
                    [
                        'name' => 'Processing Fee',
                        'slug' => 'canada-processing-fee',
                        'description' => 'Comprehensive Canada Visitor Visa online file preparation, submission and tracking.',
                        'validity' => 'Up to 10 Years (Passport Validity)',
                        'stay_period' => 'Up to 6 Months per visit',
                        'entry_type' => 'Multiple Entry',
                        'processing_time' => '15-30',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 8000.00,
                        'service_fee' => 0.00,
                        'requirements' => [
                            ['title' => 'Valid Passport Scan (All pages with stamps and visas)'],
                            ['title' => 'Digital Photograph (35mm x 45mm, white background)'],
                            ['title' => 'Bank Statements of last 6 months + Solvency Certificate'],
                            ['title' => 'Employment NOC / Business Trade License & Incorporation Deed'],
                            ['title' => 'Purpose of travel cover letter & travel itinerary'],
                        ],
                    ],
                ],
            ],
            [
                'country_name' => 'United Kingdom (UK)',
                'slug' => 'uk',
                'flag' => '🇬🇧',
                'hero_image' => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'UK Standard Visitor Visa application filling, appointment booking & VFS document upload.',
                'description' => 'Professional UK Visas and Immigration (UKVI) online application filing, supporting evidence verification, and VFS Global appointment booking.',
                'featured' => true,
                'sort_order' => 8,
                'types' => [
                    [
                        'name' => 'Processing Fee',
                        'slug' => 'uk-processing-fee',
                        'description' => 'UK Standard Visitor Visa application, document structuring and VFS submission.',
                        'validity' => '6 Months / 2 Years',
                        'stay_period' => 'Up to 180 Days',
                        'entry_type' => 'Multiple Entry',
                        'processing_time' => '15-20',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 8000.00,
                        'service_fee' => 0.00,
                        'requirements' => [
                            ['title' => 'Original Passport valid for at least 6 months'],
                            ['title' => 'Bank Statement (6 months) showing consistent balance & Solvency'],
                            ['title' => 'Proof of Employment / Business ownership & Income Tax Returns'],
                            ['title' => 'Accommodation & Flight itinerary bookings'],
                            ['title' => 'Cover letter explaining purpose of visit and ties to Bangladesh'],
                        ],
                    ],
                ],
            ],
            [
                'country_name' => 'Australia',
                'slug' => 'australia',
                'flag' => '🇦🇺',
                'hero_image' => 'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Australia Subclass 600 Tourist stream online submission and ImmiAccount assistance.',
                'description' => 'Full ImmiAccount management, genuine temporary entrant (GTE) evidence compilation, and biometric appointment guidance.',
                'featured' => true,
                'sort_order' => 9,
                'types' => [
                    [
                        'name' => 'Processing Fee',
                        'slug' => 'australia-processing-fee',
                        'description' => 'Visitor Visa (Subclass 600) Tourist Stream full online application handling.',
                        'validity' => '1 Year',
                        'stay_period' => 'Up to 3 Months per entry',
                        'entry_type' => 'Multiple / Single Entry',
                        'processing_time' => '15-25',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 8000.00,
                        'service_fee' => 0.00,
                        'requirements' => [
                            ['title' => 'Passport Color Scan (All stamped pages)'],
                            ['title' => 'Digital Photograph according to Australian visa standards'],
                            ['title' => 'Personal & Business Bank Statements (Last 6 months)'],
                            ['title' => 'Leave sanction letter / NOC from employer'],
                            ['title' => 'Proof of assets, family ties, and return commitment to Bangladesh'],
                        ],
                    ],
                ],
            ],
            [
                'country_name' => 'Europe (Schengen)',
                'slug' => 'europe-schengen',
                'flag' => '🇪🇺',
                'hero_image' => 'https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Schengen tourist & business visa consultation, VFS/BLS slot booking & travel insurance assistance.',
                'description' => 'Expert guidance for all 29 Schengen member states (France, Germany, Italy, Switzerland, Spain, etc.). Complete file compilation, travel insurance, and interview scheduling.',
                'featured' => true,
                'sort_order' => 10,
                'types' => [
                    [
                        'name' => 'Processing Fee',
                        'slug' => 'schengen-processing-fee',
                        'description' => 'Comprehensive Schengen Visa dossier preparation, VFS/BLS slot booking & document audit.',
                        'validity' => 'As per Embassy decision',
                        'stay_period' => 'Up to 90 Days in any 180-day period',
                        'entry_type' => 'Single / Multiple Entry',
                        'processing_time' => '15-20',
                        'processing_time_unit' => 'working days',
                        'starting_fee' => 15000.00,
                        'service_fee' => 0.00,
                        'requirements' => [
                            ['title' => 'Original Passport valid for at least 3 months beyond intended departure date'],
                            ['title' => '2 Recent Photographs (35mm x 45mm, biometric, 80% face view, white background)'],
                            ['title' => 'Bank Statements of last 6 months + Solvency Certificate'],
                            ['title' => 'Schengen Travel Health Insurance covering minimum €30,000 (Provided by Emisha)'],
                            ['title' => 'Confirmed round-trip flight reservations and hotel bookings throughout Schengen zone'],
                            ['title' => 'Employment NOC / Trade License / Student ID and Income Tax Returns'],
                        ],
                    ],
                ],
            ],
        ];

        VisaCountry::where('slug', 'uae-dubai')->update(['sort_order' => 11, 'featured' => false]);

        foreach ($visaData as $vCountry) {
            $types = $vCountry['types'];
            unset($vCountry['types']);

            $country = VisaCountry::updateOrCreate(
                ['slug' => $vCountry['slug']],
                array_merge($vCountry, ['status' => 'active', 'featured' => true, 'information_updated_at' => now()])
            );

            foreach ($types as $tIdx => $vt) {
                $reqs = $vt['requirements'] ?? [];
                unset($vt['requirements']);

                $existingType = VisaType::where('visa_country_id', $country->id)->first();
                if ($existingType) {
                    $existingType->update(array_merge($vt, [
                        'status' => 'active',
                        'sort_order' => 1,
                    ]));
                    $visaType = $existingType;
                } else {
                    $visaType = VisaType::create(array_merge($vt, [
                        'visa_country_id' => $country->id,
                        'status' => 'active',
                        'sort_order' => $tIdx + 1,
                    ]));
                }

                // Insert requirements
                VisaRequirement::where('visa_type_id', $visaType->id)->delete();
                foreach ($reqs as $rIdx => $r) {
                    VisaRequirement::create([
                        'visa_type_id' => $visaType->id,
                        'title' => $r['title'],
                        'required' => true,
                        'sort_order' => $rIdx + 1,
                    ]);
                }
            }
        }
    }
}
