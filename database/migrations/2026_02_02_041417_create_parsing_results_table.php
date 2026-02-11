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
        Schema::create('parsing_results', function (Blueprint $table) {
            $table->id();

            // Identitas dokumen
            $table->string('nosert')->nullable()->index();
            $table->string('noreg')->nullable();
            $table->string('nmkpl')->nullable();

            // Informasi sertifikat
            $table->string('jenis_sert')->nullable();
            $table->string('jenis_survey')->nullable();
            $table->string('divisi')->nullable();
            $table->string('lokasi_survey')->nullable();
            $table->string('mem01')->nullable();

            // Tanggal-tanggal
            $table->date('tgl_sert')->nullable();
            $table->date('tgl_berlaku')->nullable();
            $table->date('tgl_survey1')->nullable();
            $table->date('tgl_survey2')->nullable();

            // Optional: simpan JSON mentah hasil OCR
            $table->jsonb('raw_result')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parsing_results');
    }
};
