<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visa_applications', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique()->index();
            $table->foreignId('visa_country_id')->constrained('visa_countries')->cascadeOnDelete();
            $table->foreignId('visa_type_id')->constrained('visa_types')->cascadeOnDelete();
            $table->foreignId('profession_type_id')->nullable()->constrained('profession_types')->nullOnDelete();
            
            // Applicant Information
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->default('Bangladeshi');
            $table->string('passport_number')->nullable();
            
            // Travel Details
            $table->string('travel_purpose')->nullable();
            $table->date('travel_date')->nullable();
            $table->string('stay_duration')->nullable();
            $table->integer('travelers_count')->default(1);
            
            // Workflow Status
            $table->string('status')->default('received')->index();
            // received, under_review, documents_required, processing, submitted, decision_received, completed, rejected, cancelled
            
            $table->text('admin_notes')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('visa_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visa_application_id')->constrained('visa_applications')->cascadeOnDelete();
            $table->string('document_type'); // passport_scan, photograph, bank_statement, employment_noc, trade_license, other
            $table->string('original_filename');
            $table->string('stored_filename');
            $table->string('mime_type');
            $table->unsignedBigInteger('file_size');
            $table->string('storage_path'); // protected storage path in storage/app/private/visa/
            $table->string('status')->default('uploaded'); // uploaded, verified, rejected
            $table->text('rejection_reason')->nullable();
            $table->timestamp('uploaded_at')->nullable();
            $table->timestamps();
        });

        Schema::create('tour_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique()->index();
            $table->foreignId('tour_id')->nullable()->constrained('tours')->nullOnDelete();
            $table->string('tour_title')->nullable(); // fallback if customized
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->date('travel_date')->nullable();
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->text('message')->nullable();
            $table->string('status')->default('new')->index(); // new, contacted, quote_sent, confirmed, closed
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ticket_requests', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique()->index();
            $table->string('trip_type')->default('round-trip'); // one-way, round-trip, multi-city
            $table->string('origin');
            $table->string('destination');
            $table->date('departure_date');
            $table->date('return_date')->nullable();
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->integer('infants')->default(0);
            $table->string('cabin_class')->default('Economy'); // Economy, Premium Economy, Business, First
            $table->string('preferred_airline')->nullable();
            $table->text('additional_requirements')->nullable();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('status')->default('new')->index(); // new, contacted, quote_prepared, waiting_for_customer, confirmed, closed, cancelled
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('service')->nullable(); // Tour, Visa, Air Ticketing, Other
            $table->date('travel_date')->nullable();
            $table->text('message');
            $table->string('status')->default('unread')->index(); // unread, read, replied, archived
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('ticket_requests');
        Schema::dropIfExists('tour_inquiries');
        Schema::dropIfExists('visa_documents');
        Schema::dropIfExists('visa_applications');
    }
};
