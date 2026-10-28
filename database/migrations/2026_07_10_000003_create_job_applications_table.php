<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('career_role_id')->nullable();
            $table->foreign('career_role_id')->references('id')->on('career_roles')->nullOnDelete();
            $table->string('name');
            $table->string('contact');
            $table->string('resume_path')->nullable();
            $table->integer('years_exp')->default(0);
            $table->text('why_fit');
            $table->text('largest_deal');
            $table->text('proud_sale');
            $table->text('first_clients');
            $table->json('internal_notes')->default('[]');
            $table->string('status')->default('New'); // New, Reviewing, Interview, Hired, Rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
