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
        Schema::table('file_uploads', function (Blueprint $table) {
            if (!Schema::hasColumn('file_uploads', 'is_paid')) {
                $table->boolean('is_paid')->default(false)->after('qr_code');
            }
            if (!Schema::hasColumn('file_uploads', 'payout_date')) {
                $table->timestamp('payout_date')->nullable()->after('is_paid');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_uploads', function (Blueprint $table) {
            $table->dropColumn(['is_paid', 'payout_date']);
        });
    }
};
