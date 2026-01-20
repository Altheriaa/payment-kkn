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
        Schema::create('kelompok_kkn', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_kkn_id')->constrained('jadwal_kkn')->onDelete('cascade');
            $table->foreignId('dpl_id')->nullable()->constrained('dosen_dpl')->onDelete('set null');
            $table->foreignId('lokasi_kkn_id')->nullable()->constrained('lokasi_kkn')->onDelete('set null');
            $table->string('nama_kelompok', 50);
            $table->enum('jenis_kkn', ['Reguler', 'Non Reguler']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_kkn');
    }
};
