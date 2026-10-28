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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique()->index();
            $table->string('project_type');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->text('project_brief');
            $table->bigInteger('amount'); // Representing KES amount
            $table->date('issued_at');
            $table->date('due_at');
            $table->string('status')->default('Draft'); // Draft, Sent, Paid, Overdue, Void
            $table->string('credit_terms')->default('Standard Net-14');
            $table->foreignId('quote_submission_id')->nullable()->constrained('quote_submissions')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
