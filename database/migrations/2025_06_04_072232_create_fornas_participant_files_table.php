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
        Schema::create('fornas_participant_files', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignUuid('fornas_participant_id')->references('uuid')->on('fornas_participants')->cascadeOnDelete();
            $table->string('ktp');
            $table->string('kk');
            $table->string('kartu_bpjs');
            $table->string('surat_keterangan_sehat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornas_participant_files');
    }
};
