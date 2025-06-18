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
        Schema::create('fornas_registrations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignUuid('fornas_event_id')->references('uuid')->on('fornas_events')->nullOnDelete();
            $table->foreignUuid('kormi_id')->references('uuid')->on('kormis')->nullOnDelete();
            $table->string('penanggung_jawab');
            $table->string('no_hp');
            $table->enum('status', ['Menunggu', 'Diproses', 'Terverifikasi', 'Tidak Lengkap',  'Ditolak'])->default('Menunggu');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornas_registrations');
    }
};
