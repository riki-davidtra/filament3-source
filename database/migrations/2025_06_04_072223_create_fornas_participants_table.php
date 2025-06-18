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
        Schema::create('fornas_participants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignUuid('fornas_registration_id')->references('uuid')->on('fornas_registrations')->cascadeOnDelete();
            $table->string('nama_lengkap');
            $table->foreignUuid('inorga_id')->references('uuid')->on('inorgas')->nullOnDelete();
            $table->string('nik');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('no_hp');
            $table->string('email');
            $table->enum('ukuran_baju', ['S', 'M', 'L', 'XL', 'XXL']);
            $table->string('jenis_peserta');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->string('penginapan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornas_participants');
    }
};
