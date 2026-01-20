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
        Schema::table('pendaftaran_kkn', function (Blueprint $table) {
            $table->foreignId('jadwal_kkn_id')->after('status_pendaftaran')->nullable()->constrained('jadwal_kkn')->onDelete('cascade');
            $table->foreignId('kelompok_kkn_id')->after('jadwal_kkn_id')->nullable()->constrained('kelompok_kkn')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_kkn', function (Blueprint $table) {
            $table->dropForeign(['jadwal_kkn_id']);
            $table->dropColumn('jadwal_kkn_id');
            $table->dropForeign(['kelompok_kkn_id']);
            $table->dropColumn('kelompok_kkn_id');
        });
    }
};
