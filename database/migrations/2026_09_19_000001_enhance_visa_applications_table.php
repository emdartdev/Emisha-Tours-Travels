<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visa_applications', function (Blueprint $table) {
            // Profile & Dynamic Step Payloads (JSON)
            $table->json('applicant_profile')->nullable()->after('nationality');
            $table->json('passport_details')->nullable()->after('passport_number');
            $table->json('travel_details')->nullable()->after('stay_duration');
            $table->json('employment_details')->nullable()->after('travel_details');
            $table->json('financial_details')->nullable()->after('employment_details');
            $table->json('travel_history')->nullable()->after('financial_details');
            $table->json('co_travelers')->nullable()->after('travel_history');
            $table->json('accommodation_details')->nullable()->after('co_travelers');
            $table->json('flight_details')->nullable()->after('accommodation_details');
            $table->json('pricing_breakdown')->nullable()->after('flight_details');

            // Onboarding & Payment State
            $table->string('workflow_type')->default('evisa')->after('status'); // evisa, consular_processing
            $table->string('payment_status')->default('pending')->after('workflow_type'); // pending, completed, pay_at_desk
            $table->decimal('total_service_fee', 12, 2)->default(0.00)->after('payment_status');
            $table->string('currency', 10)->default('BDT')->after('total_service_fee');
            $table->string('draft_session_id')->nullable()->index()->after('currency');
            $table->text('applicant_notes')->nullable()->after('admin_notes');
            $table->timestamp('processed_at')->nullable()->after('submitted_at');
        });

        Schema::table('visa_documents', function (Blueprint $table) {
            $table->string('document_code')->nullable()->after('document_type'); // e.g. passport_bio, photograph, etc.
            $table->boolean('required')->default(true)->after('document_code');
            $table->string('review_status')->default('uploaded')->after('status'); // uploaded, approved, needs_replacement, rejected
            $table->text('review_note')->nullable()->after('rejection_reason');
        });
    }

    public function down(): void
    {
        Schema::table('visa_documents', function (Blueprint $table) {
            $table->dropColumn(['document_code', 'required', 'review_status', 'review_note']);
        });

        Schema::table('visa_applications', function (Blueprint $table) {
            $table->dropColumn([
                'applicant_profile',
                'passport_details',
                'travel_details',
                'employment_details',
                'financial_details',
                'travel_history',
                'co_travelers',
                'accommodation_details',
                'flight_details',
                'pricing_breakdown',
                'workflow_type',
                'payment_status',
                'total_service_fee',
                'currency',
                'draft_session_id',
                'applicant_notes',
                'processed_at',
            ]);
        });
    }
};
