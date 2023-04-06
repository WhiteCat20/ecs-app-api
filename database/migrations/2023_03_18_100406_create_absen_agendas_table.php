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
        Schema::create('absen_agendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_asisten');
            $table->string('nama_agenda');
            $table->string('kode_absensi');
            $table->string('file_photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen_agendas');
    }
};
