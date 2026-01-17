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
        Schema::create('dosen_dpl', function (Blueprint $table) {
            $table->id();
            $table->string('nuptk', 20)->unique();
            $table->string('nama_dosen', 100);
            $table->string('bidang_keahlian', 50);
            $table->string('no_hp', 15);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_dpl');
    }
};
