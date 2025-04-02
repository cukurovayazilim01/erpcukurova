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
        Schema::create('isbasvurularis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->date('tarih')->nullable();
            $table->string('ad_soyad')->nullable();
            $table->string('basvuru_pozisyon')->nullable();
            $table->longText('telefon')->nullable();
            $table->longText('ev_telefon')->nullable();
            $table->longText('dogum_yeri')->nullable();
            $table->longText('dogum_tarihi')->nullable();
            $table->longText('resim')->nullable();
            $table->string('meslegi')->nullable();
            $table->longText('email')->nullable();
            $table->longText( 'mezuniyet')->nullable();
            $table->string( 'medeni_hal')->nullable();
            $table->longText( 'cocuk_yasi')->nullable();
            $table->string( 'askerlik_durumu')->nullable();
            $table->string( 'ehliyet_sinif')->nullable();
            $table->longText( 'ehliyet_tarihi')->nullable();
            $table->string( 'kan_grubu')->nullable();
            $table->string( 'sorusturma')->nullable();
            $table->string( 'sigara')->nullable();
            $table->string( 'ameliyat')->nullable();
            $table->longText( 'dosya')->nullable();

            $table->json('yabanci_dil')->nullable();
            $table->json('egitim_durumu')->nullable();
            $table->json('calisilan_firma')->nullable();
            $table->json('referanss')->nullable();
            $table->json('pc_programi')->nullable();

            $table->longText( 'gorusme_notu')->nullable();
            $table->longText( 'kurs')->nullable();
            $table->longText( 'sertifika')->nullable();
            $table->string( 'kalite_firma')->nullable();
            $table->longText( 'ev_adresi')->nullable();
            $table->longText( 'aylik_ucret')->nullable();
            $table->longText( 'ise_baslama')->nullable();
            $table->longText( 'signature_data')->nullable();
            $table->string('personel_aktarma_durum')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isbasvurularis');
    }
};
