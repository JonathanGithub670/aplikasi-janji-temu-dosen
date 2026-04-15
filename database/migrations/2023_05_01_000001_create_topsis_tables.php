<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Kriteria
        Schema::create('kriteria', function (Blueprint $table) {
            $table->increments('id_kriteria');
            $table->string('kode')->nullable();
            $table->string('nama_kriteria')->nullable();
            $table->string('atribut')->nullable();
            $table->double('bobot')->nullable();
        });

        // Tabel Alternatif
        Schema::create('alternatif', function (Blueprint $table) {
            $table->increments('id_alternatif');
            $table->string('kode_alternatif')->nullable();
            $table->string('nama_alternatif')->nullable();
        });

        // Tabel Relations (Penilaian)
        Schema::create('relations', function (Blueprint $table) {
            $table->increments('id_relasi');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('alternatif')->nullable();
            $table->string('kriteria')->nullable();
            $table->double('nilai')->nullable();
        });

        // Tabel Results (Hasil)
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id_result');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('alternatif')->nullable();
            $table->double('hasil')->nullable();
        });

        // Tabel Pivot Chooses - Alternatif
        Schema::create('chooses_alternatif', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chooses_id');
            $table->unsignedInteger('alternatif_id');
        });

        // Tabel Images
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('path')->nullable();
        });

        // Tabel Routine Periods (Periode Perkuliahan)
        Schema::create('routine_periods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('mulai_perkuliahan')->nullable();
            $table->date('selesai_perkuliahan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routine_periods');
        Schema::dropIfExists('images');
        Schema::dropIfExists('chooses_alternatif');
        Schema::dropIfExists('results');
        Schema::dropIfExists('relations');
        Schema::dropIfExists('alternatif');
        Schema::dropIfExists('kriteria');
    }
};
