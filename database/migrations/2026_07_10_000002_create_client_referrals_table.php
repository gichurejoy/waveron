<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_referrals', function (Blueprint $table) {
            $table->id();
            $table->string('referral_code')->unique();
            $table->string('referrer_name');
            $table->string('referrer_contact');
            $table->string('client_name');
            $table->text('services_needed');
            $table->integer('commission_amount')->default(0);
            $table->string('payout_status')->default('Pending'); // Pending, In Progress, Paid
            $table->string('status')->default('Pending Review'); // Pending Review, Active Lead, Paid Out Commission, Declined
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_referrals');
    }
};
