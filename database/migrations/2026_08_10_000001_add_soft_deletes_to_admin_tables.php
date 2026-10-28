<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('job_applications', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('quote_submissions', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('fast_inquiries', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('contact_submissions', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('quote_submissions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('fast_inquiries', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('contact_submissions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
