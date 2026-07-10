<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('service_type');
            $table->string('complexity')->nullable();
            $table->string('timeline')->nullable();
            $table->json('selected_features')->nullable();
            $table->json('selected_addons')->nullable();
            $table->unsignedBigInteger('estimated_total')->default(0);
            $table->string('user_email');
            $table->string('company')->nullable();
            $table->string('status')->default('New'); // New, In Review, Converted, Archived
            $table->text('internal_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_submissions');
    }
};
