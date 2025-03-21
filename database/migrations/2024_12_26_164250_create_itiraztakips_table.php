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
        Schema::create('itiraztakips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();

            $table->unsignedBigInteger('markatakip_id')->nullable();
            $table->foreign('markatakip_id')->references('id')->on('markatakips')->onDelete('cascade');
            $table->string('marka_adi')->nullable();
            $table->string('firma_adi')->nullable();
            $table->string('referans_no')->nullable();
            $table->string('musteri_temsilcisi')->nullable();
            $table->string('satis_temsilcisi')->nullable();
            $table->date('teblig_tarihi')->nullable();
            $table->string('bakanlik_karari')->nullable();
            $table->string('itiraz_islem')->nullable();
            $table->string('itiraz_durum')->nullable();
            $table->date('teblig_bitis_tarihi')->nullable();
            $table->double('ucret',17,2)->nullable();
            $table->longText('itiraz_dosya')->nullable();
            $table->longText('itiraz_aciklama')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itiraztakips');
    }
};
