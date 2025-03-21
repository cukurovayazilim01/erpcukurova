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
        Schema::create('carilers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->unsignedBigInteger('son_guncelleyen')->nullable();
            $table->foreign('son_guncelleyen')->references('id')->on('users')->onDelete('cascade');
            $table->longText('firma_unvan')->nullable();
            $table->longText('ticari_unvan')->nullable();
            $table->longText('firma_sektor')->nullable();
            $table->longText('is_tel')->nullable();
            $table->longText('yetkili_kisi')->nullable();
            $table->longText('yetkili_kisi_tel')->nullable();
            $table->longText('eposta')->nullable();
            $table->longText('web_adres')->nullable();
            $table->longText('firma_turu')->nullable();
            $table->longText('il')->nullable();
            $table->longText('ilce')->nullable();
            $table->longText('vergi_no')->nullable();
            $table->longText('vergi_dairesi')->nullable();
            $table->longText('tc_kimlik')->nullable();
            $table->longText('adres')->nullable();
            $table->longText('aciklama')->nullable();
            $table->longText('musteri_temsilcisi')->nullable();
            $table->longText('firma_tipi')->nullable();
            $table->longText('firma_durumu')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carilers');
    }
};
