<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visa_countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_name');
            $table->string('slug')->unique()->index();
            $table->string('flag')->nullable();
            $table->string('hero_image')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('status')->default('active')->index();
            $table->boolean('featured')->default(false)->index();
            $table->integer('sort_order')->default(0);
            $table->timestamp('information_updated_at')->nullable();
            $table->timestamps();
        });

        Schema::create('visa_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visa_country_id')->constrained('visa_countries')->cascadeOnDelete();
            $table->string('name'); // Tourist Visa, Business Visa, Student Visa, Medical Visa, E-Visa
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->string('validity')->nullable(); // e.g. 90 Days, 6 Months, 5 Years
            $table->string('stay_period')->nullable(); // e.g. 30 Days, 60 Days
            $table->string('entry_type')->nullable(); // Single Entry, Multiple Entry
            $table->string('processing_time')->nullable(); // e.g. 5-7
            $table->string('processing_time_unit')->default('working days');
            $table->decimal('starting_fee', 12, 2)->default(0.00);
            $table->decimal('service_fee', 12, 2)->default(0.00);
            $table->string('currency', 10)->default('BDT');
            $table->string('status')->default('active')->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('visa_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visa_type_id')->constrained('visa_types')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('required')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('profession_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Salaried, Business Owner, Student, Freelancer, Retired, Housewife, Other
            $table->string('slug')->unique()->index();
            $table->string('status')->default('active');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('visa_profession_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visa_type_id')->constrained('visa_types')->cascadeOnDelete();
            $table->foreignId('profession_type_id')->constrained('profession_types')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('required')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visa_profession_requirements');
        Schema::dropIfExists('profession_types');
        Schema::dropIfExists('visa_requirements');
        Schema::dropIfExists('visa_types');
        Schema::dropIfExists('visa_countries');
    }
};
