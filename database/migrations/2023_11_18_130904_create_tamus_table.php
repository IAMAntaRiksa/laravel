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
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_instansi');
            $table->string('pekerjaan_intansi');
            $table->enum('tipe_tamu', ['penting', 'biasa']);
            $table->string('alamat');
            $table->string('pertemuan');
            $table->string('keperluan');
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();
            $table->string('identitas');
            $table->string('status_keluar')->default('aktif');
            $table->string('foto_identitas')->nullable();
            $table->string('foto_tamu')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};
