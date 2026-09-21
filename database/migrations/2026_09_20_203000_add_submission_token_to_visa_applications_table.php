<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('visa_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('visa_applications', 'submission_token')) {
                $table->string('submission_token', 64)->nullable()->unique()->after('reference_number');
            }
            if (!Schema::hasColumn('visa_applications', 'idempotency_key')) {
                $table->string('idempotency_key', 64)->nullable()->index()->after('submission_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visa_applications', function (Blueprint $table) {
            if (Schema::hasColumn('visa_applications', 'submission_token')) {
                $table->dropColumn('submission_token');
            }
            if (Schema::hasColumn('visa_applications', 'idempotency_key')) {
                $table->dropColumn('idempotency_key');
            }
        });
    }
};
