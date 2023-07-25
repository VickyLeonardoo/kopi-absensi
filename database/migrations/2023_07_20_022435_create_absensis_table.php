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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('shift_id')->references('id')->on('shifts');
            $table->time('jamIn')->nullable();
            $table->time('jamOut')->nullable();
            $table->date('tglAbsen');
            $table->enum('status', ['Pending', 'Hadir', 'Tidak Hadir', 'Ditolak'])->default('Tidak Hadir');
            $table->text('fotoMasuk')->nullable();
            $table->text('fotoPulang')->nullable();
            $table->string('telat')->nullable();
            $table->string('pulangCepat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
