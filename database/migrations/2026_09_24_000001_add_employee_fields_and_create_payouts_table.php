<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add employee financial and onboarding fields to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->decimal('commission_rate', 5, 2)->default(10.00)->after('role'); // e.g. 10.00%
            $table->decimal('base_salary', 12, 2)->nullable()->after('commission_rate'); // e.g. monthly retainer in KES
            $table->string('payout_method')->default('M-Pesa')->after('base_salary'); // M-Pesa, Bank Transfer
            $table->string('payout_account')->nullable()->after('payout_method'); // phone or bank account number
            $table->string('employment_status')->default('Active')->after('payout_account'); // Active, Probation, Inactive, Suspended
            $table->timestamp('hired_at')->nullable()->after('employment_status');
            $table->unsignedBigInteger('job_application_id')->nullable()->after('hired_at');
        });

        // 2. Create employee payouts table
        Schema::create('employee_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('invoice_id')->nullable()->constrained('invoices')->nullOnDelete();
            $table->decimal('amount', 12, 2);
            $table->string('type')->default('Commission'); // Commission, Base Salary, Bonus, Referral Bounty
            $table->string('status')->default('Paid'); // Pending, Approved, Paid, Cancelled
            $table->string('payout_method')->default('M-Pesa');
            $table->string('transaction_reference')->nullable(); // M-Pesa Code / Bank Ref
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_payouts');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'commission_rate',
                'base_salary',
                'payout_method',
                'payout_account',
                'employment_status',
                'hired_at',
                'job_application_id',
            ]);
        });
    }
};
