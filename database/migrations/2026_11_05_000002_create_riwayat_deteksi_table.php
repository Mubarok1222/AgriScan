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
        Schema::create('riwayat_deteksi', function (Blueprint $table) {
            $table->id('id_deteksi');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_penyakit')->nullable();
            $table->foreign('id_penyakit')->references('id_penyakit')->on('penyakit_padi')->onDelete('set null');
            $table->string('foto_daun');
            $table->decimal('skor_akurasi', 5, 2)->nullable();
            $table->enum('status_hasil', ['Sehat', 'Dugaan Penyakit', 'Tidak Meyakinkan', 'Gagal Teknis'])->default('Dugaan Penyakit');
            $table->dateTime('tanggal_deteksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_deteksi');
    }
};

