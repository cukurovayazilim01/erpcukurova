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
        Schema::create('domaintakips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');
            $table->longText('domain_adi')->nullable();
            $table->date('tarih')->nullable();
            $table->longText('musteri_temsilcisi')->nullable();
            $table->longText('satis_temsilcisi')->nullable();
            $table->longText('telefon_no')->nullable();
            $table->date('bitis_tarihi')->nullable();
            $table->double('tutar',17,2)->nullable();
            $table->longText('hizmet_turu')->nullable();
            $table->longText('aciklama')->nullable();
            $table->longText('hosting_platform')->nullable();
            $table->longText('resim')->nullable();
            $table->longText('mail_adet')->nullable();
            $table->longText('mail_platform')->nullable();
            $table->string('yenileme_durum')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domaintakips');
    }
};
