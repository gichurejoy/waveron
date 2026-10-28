<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_roles', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            $table->string('employment_type'); // Full-Time, Contract, Part-Time
            $table->string('location');
            $table->string('compensation');
            $table->json('prerequisites')->default('[]');
            $table->string('status')->default('Active'); // Active, Archived
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_roles');
    }
};
