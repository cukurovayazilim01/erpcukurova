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
        Schema::create('dokumanlars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');

            $table->unsignedBigInteger('personel_id')->nullable();
            $table->foreign('personel_id')->references('id')->on('personels')->onDelete('cascade');

            $table->string('kategori')->nullable();
            $table->string('sinif')->nullable();
            $table->string('grup')->nullable();
            $table->longText('dokuman_tipi')->nullable();
            $table->longText('dokuman_donem')->nullable();
            $table->longText('dokuman_adi')->nullable();
            $table->longText('dokuman_yolu')->nullable();
            $table->longText('aciklama')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokümanlars');
    }
};
