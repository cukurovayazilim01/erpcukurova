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
        Schema::create('personels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();

            $table->string('ad_soyad')->nullable();
            $table->longText('tc')->nullable();
            $table->longText('sigorta_sicil_no')->nullable();
            $table->date('sigorta_giris_tarihi')->nullable();
            $table->longText('meslek_kodu')->nullable();
            $table->string('okul')->nullable();
            $table->string('mezuniyet')->nullable();
            $table->string('meslegi')->nullable();
            $table->string('departman')->nullable();
            $table->string('dogum_yeri')->nullable();
            $table->date('dogum_tarihi')->nullable();
            $table->longText('gsm')->nullable();
            $table->longText('mail')->nullable();
            $table->date('ise_giris_tarihi')->nullable();
            $table->date('isten_cikis_tarihi')->nullable();
            $table->longText('gorevi')->nullable();
            $table->longText('kidem_yili')->nullable();
            $table->string('medeni_hali')->nullable();
            $table->longText('kan_grubu')->nullable();
            $table->string('askerlik_durumu')->nullable();
            $table->longText('personel_resim')->nullable();
            $table->longText('ehliyet_sinif')->nullable();
            $table->longText('ehliyet_tarihi')->nullable();
            $table->longText('baba_adi')->nullable();
            $table->longText('baba_meslegi')->nullable();
            $table->longText('ayak_no')->nullable();
            $table->longText('beden')->nullable();
            $table->longText('ev_gsm')->nullable();
            $table->longText('ev_adresi')->nullable();
            $table->longText('acil_durum_kisi')->nullable();
            $table->longText('durum')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personels');
    }
};
