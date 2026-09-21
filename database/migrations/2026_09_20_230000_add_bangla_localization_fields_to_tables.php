<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Destinations
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
            $table->text('short_description_bn')->nullable()->after('short_description');
            $table->longText('description_bn')->nullable()->after('description');
        });

        // 2. Tour Categories
        Schema::table('tour_categories', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
            $table->text('description_bn')->nullable()->after('description');
        });

        // 3. Tours
        Schema::table('tours', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->text('short_description_bn')->nullable()->after('short_description');
            $table->longText('description_bn')->nullable()->after('description');
        });

        // 4. Tour Itineraries
        Schema::table('tour_itineraries', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->longText('description_bn')->nullable()->after('description');
            $table->string('meals_bn')->nullable()->after('meals');
            $table->string('stay_bn')->nullable()->after('stay');
        });

        // 5. Tour Inclusions & Exclusions
        Schema::table('tour_inclusions', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->text('description_bn')->nullable()->after('description');
        });

        Schema::table('tour_exclusions', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->text('description_bn')->nullable()->after('description');
        });

        // 6. Visa Countries
        Schema::table('visa_countries', function (Blueprint $table) {
            $table->string('country_name_bn')->nullable()->after('country_name');
            $table->text('short_description_bn')->nullable()->after('short_description');
            $table->longText('description_bn')->nullable()->after('description');
        });

        // 7. Visa Types
        Schema::table('visa_types', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
            $table->text('description_bn')->nullable()->after('description');
            $table->string('validity_bn')->nullable()->after('validity');
            $table->string('stay_period_bn')->nullable()->after('stay_period');
            $table->string('entry_type_bn')->nullable()->after('entry_type');
            $table->string('processing_time_bn')->nullable()->after('processing_time');
            $table->string('processing_time_unit_bn')->nullable()->after('processing_time_unit');
        });

        // 8. Visa Requirements
        Schema::table('visa_requirements', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->text('description_bn')->nullable()->after('description');
        });

        // 9. Profession Types & Profession Requirements
        Schema::table('profession_types', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
        });

        Schema::table('visa_profession_requirements', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->text('description_bn')->nullable()->after('description');
        });

        // 10. Offers & Testimonials
        Schema::table('offers', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->text('description_bn')->nullable()->after('description');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('customer_name_bn')->nullable()->after('customer_name');
            $table->string('destination_bn')->nullable()->after('destination');
            $table->string('service_bn')->nullable()->after('service');
            $table->text('review_bn')->nullable()->after('review');
        });

        // 11. Gallery Categories & Images
        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
            $table->text('description_bn')->nullable()->after('description');
        });

        Schema::table('gallery_images', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->string('location_bn')->nullable()->after('location');
            $table->text('caption_bn')->nullable()->after('caption');
        });

        // 12. Blog Categories & Posts
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
            $table->text('description_bn')->nullable()->after('description');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->text('excerpt_bn')->nullable()->after('excerpt');
            $table->longText('content_bn')->nullable()->after('content');
        });

        // 13. FAQs
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('question_bn')->nullable()->after('question');
            $table->text('answer_bn')->nullable()->after('answer');
        });

        // 14. Pages
        Schema::table('pages', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->longText('content_bn')->nullable()->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'content_bn']);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question_bn', 'answer_bn']);
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'excerpt_bn', 'content_bn']);
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn(['name_bn', 'description_bn']);
        });

        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'location_bn', 'caption_bn']);
        });

        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->dropColumn(['name_bn', 'description_bn']);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['customer_name_bn', 'destination_bn', 'service_bn', 'review_bn']);
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'description_bn']);
        });

        Schema::table('visa_profession_requirements', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'description_bn']);
        });

        Schema::table('profession_types', function (Blueprint $table) {
            $table->dropColumn('name_bn');
        });

        Schema::table('visa_requirements', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'description_bn']);
        });

        Schema::table('visa_types', function (Blueprint $table) {
            $table->dropColumn([
                'name_bn', 'description_bn', 'validity_bn',
                'stay_period_bn', 'entry_type_bn', 'processing_time_bn',
                'processing_time_unit_bn'
            ]);
        });

        Schema::table('visa_countries', function (Blueprint $table) {
            $table->dropColumn(['country_name_bn', 'short_description_bn', 'description_bn']);
        });

        Schema::table('tour_exclusions', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'description_bn']);
        });

        Schema::table('tour_inclusions', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'description_bn']);
        });

        Schema::table('tour_itineraries', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'description_bn', 'meals_bn', 'stay_bn']);
        });

        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'short_description_bn', 'description_bn']);
        });

        Schema::table('tour_categories', function (Blueprint $table) {
            $table->dropColumn(['name_bn', 'description_bn']);
        });

        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['name_bn', 'short_description_bn', 'description_bn']);
        });
    }
};
