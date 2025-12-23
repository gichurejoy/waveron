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
        Schema::table('services', function (Blueprint $table) {
            $table->json('complexity_multipliers')->nullable()->after('base_price');
            $table->json('timeline_multipliers')->nullable()->after('complexity_multipliers');
            $table->decimal('feature_base_price', 10, 2)->nullable()->after('timeline_multipliers');
            $table->integer('default_feature_count')->default(6)->after('feature_base_price');
            $table->decimal('feature_price_per_additional', 10, 2)->nullable()->after('default_feature_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'complexity_multipliers',
                'timeline_multipliers',
                'feature_base_price',
                'default_feature_count',
                'feature_price_per_additional',
            ]);
        });
    }
};
