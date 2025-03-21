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
        Schema::create('isotakips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');
            $table->string('musteri_temsilcisi')->nullable();
            $table->unsignedBigInteger('satis_temsilcisi')->nullable();
            $table->foreign('satis_temsilcisi')->references('id')->on('users')->onDelete('cascade');
            $table->string('il')->nullable();
            $table->date('basvuru_tarihi')->nullable();
            $table->date('belge_tarihi')->nullable();
            $table->date('belge_bitis_tarihi')->nullable();
            $table->date('ara_denetim_tarihi')->nullable();
            $table->longText('basvuru_referans_no')->nullable();
            $table->longText('hizmet_turu')->nullable();
            $table->longText('hizmet_adi')->nullable();
            $table->longText('akreditasyon_kurulusu')->nullable();
            $table->longText('belgelendirme_kurulusu')->nullable();
            $table->longText('kapsam')->nullable();
            $table->longText('belge')->nullable();
            $table->string('yenileme_durumu')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isotakips');
    }
};
