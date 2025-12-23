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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('quote_number')->unique();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('service_type'); // software, design, branding, marketing
            $table->string('complexity'); // basic, advanced, enterprise
            $table->string('timeline'); // flexible, standard, rush
            $table->integer('feature_count')->default(6);
            $table->decimal('base_price', 10, 2);
            $table->decimal('complexity_multiplier', 5, 2)->default(1.0);
            $table->decimal('timeline_multiplier', 5, 2)->default(1.0);
            $table->decimal('feature_adjustment', 5, 2)->default(1.0);
            $table->decimal('addons_total', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_rate', 5, 2)->nullable();
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->string('discount_code')->nullable();
            $table->decimal('total', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->integer('validity_days')->default(30);
            $table->dateTime('expires_at');
            $table->string('status')->default('draft'); // draft, sent, viewed, accepted, rejected, expired
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('notes')->nullable();
            $table->json('selected_features')->nullable();
            $table->json('selected_addons')->nullable();
            $table->dateTime('viewed_at')->nullable();
            $table->dateTime('responded_at')->nullable();
            $table->boolean('is_converted')->default(false);
            $table->foreignId('converted_to_order_id')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('service_id');
            $table->index('expires_at');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
