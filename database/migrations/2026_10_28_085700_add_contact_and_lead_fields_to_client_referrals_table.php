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
        Schema::table('client_referrals', function (Blueprint $table) {
            $table->string('client_contact_person')->nullable()->after('client_name');
            $table->string('client_email')->nullable()->after('client_contact_person');
            $table->string('client_phone')->nullable()->after('client_email');
            $table->text('notes')->nullable()->after('services_needed');
            $table->boolean('promoted_to_lead')->default(false)->after('status');
            $table->timestamp('promoted_at')->nullable()->after('promoted_to_lead');
            $table->unsignedBigInteger('promoted_lead_id')->nullable()->after('promoted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_referrals', function (Blueprint $table) {
            $table->dropColumn([
                'client_contact_person',
                'client_email',
                'client_phone',
                'notes',
                'promoted_to_lead',
                'promoted_at',
                'promoted_lead_id',
            ]);
        });
    }
};
