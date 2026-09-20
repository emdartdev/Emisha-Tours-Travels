<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->cascadeOnDelete();
            $table->foreignId('tour_category_id')->nullable()->constrained('tour_categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->integer('duration_days')->default(1);
            $table->integer('duration_nights')->default(0);
            $table->decimal('price', 12, 2)->default(0.00);
            $table->decimal('discount_price', 12, 2)->nullable();
            $table->string('currency', 10)->default('BDT');
            $table->string('status')->default('published')->index(); // published, draft, archived
            $table->boolean('featured')->default(false)->index();
            $table->boolean('popular')->default(false)->index();
            $table->string('cover_image')->nullable();
            $table->json('gallery')->nullable();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tour_itineraries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete();
            $table->integer('day_number')->default(1);
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('meals')->nullable(); // e.g. Breakfast, Lunch, Dinner
            $table->string('stay')->nullable(); // Hotel name/type
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_inclusions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_exclusions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_exclusions');
        Schema::dropIfExists('tour_inclusions');
        Schema::dropIfExists('tour_itineraries');
        Schema::dropIfExists('tours');
    }
};
