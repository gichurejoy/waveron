<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fast_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('company')->nullable();
            $table->string('budget')->nullable();
            $table->string('timeline')->nullable();
            $table->string('services_requested')->nullable();
            $table->text('project_details')->nullable();
            $table->string('status')->default('New'); // New, Contacted, Qualified, Lost
            $table->json('internal_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fast_inquiries');
    }
};
