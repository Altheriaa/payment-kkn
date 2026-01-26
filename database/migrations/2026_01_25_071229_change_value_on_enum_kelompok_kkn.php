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
        Schema::table('kelompok_kkn', function (Blueprint $table) {
            $table->dropColumn('jenis_kkn');
        });

        Schema::table('kelompok_kkn', function (Blueprint $table) {
            $table->enum('jenis_kkn', ['KKN-UNAYA Regular', 'KKN-UNAYA Non-Regular'])->after('nama_kelompok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelompok_kkn', function (Blueprint $table) {
            $table->dropColumn('jenis_kkn');
        });

        Schema::table('kelompok_kkn', function (Blueprint $table) {
            $table->enum('jenis_kkn', ['Reguler', 'Non Reguler']);
        });
    }
};
