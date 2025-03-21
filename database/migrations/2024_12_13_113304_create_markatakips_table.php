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
        Schema::create('markatakips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');
            $table->string('musteri_temsilcisi')->nullable();
            $table->unsignedBigInteger('satis_temsilcisi')->nullable();
            $table->foreign('satis_temsilcisi')->references('id')->on('users')->onDelete('cascade');
            $table->longText('tc')->nullable();
            $table->longText('vkn')->nullable();
            $table->longText('sehir')->nullable();
            $table->longText('basvuru_no')->nullable();
            $table->longText('referans_no')->nullable();
            $table->string('marka_adi')->nullable();
            $table->string('marka_sinif')->nullable();
            $table->unsignedBigInteger('hizmet_turu')->nullable();
            $table->foreign('hizmet_turu')->references('id')->on('hizmetlers')->onDelete('cascade');
            $table->date('basvuru_tarihi')->nullable();
            $table->string('marka_islem')->nullable();
            $table->string('marka_durum')->nullable();
            $table->date('yenileme_tarih')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markatakips');
    }
};
