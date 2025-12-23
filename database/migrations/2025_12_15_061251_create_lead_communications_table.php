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
        Schema::create('lead_communications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('type'); // email, call, meeting, note, sms
            $table->string('direction')->default('outbound'); // inbound, outbound
            $table->string('subject')->nullable();
            $table->text('content')->nullable();
            $table->datetime('scheduled_at')->nullable();
            $table->datetime('occurred_at')->nullable();
            $table->string('status')->default('pending'); // pending, completed, cancelled
            $table->json('metadata')->nullable(); // Additional data like email headers, call duration, etc.
            $table->timestamps();
            
            $table->index('lead_id');
            $table->index('type');
            $table->index('scheduled_at');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_communications');
    }
};
