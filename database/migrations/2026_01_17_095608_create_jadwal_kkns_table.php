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
        Schema::create('jadwal_kkn', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siakad')->unique();
            $table->unsignedBigInteger('tahun_akademik_id');
            $table->string('nama_periode', 50);
            $table->string('semester', 10);
            $table->string('tahun_ajaran', 10);
            $table->date('tanggal_dibuka')->nullable();
            $table->date('tanggal_ditutup')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kkn');
    }
};
