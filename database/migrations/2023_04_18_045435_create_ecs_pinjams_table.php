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
        Schema::create('ecs_pinjams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nama_peminjam");
            $table->string("nama_barang");
            $table->string("kepentingan");
            $table->string("tanggal_pinjam");
            $table->string("tanggal_kembali");
            $table->string("foto_barang");
            $table->string("jaminan");
            $table->string("signature");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecs_pinjams');
    }
};
