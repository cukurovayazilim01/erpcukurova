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
        Schema::create('pyillikhedeflers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->unsignedBigInteger('personel_id')->nullable();
            $table->foreign('personel_id')->references('id')->on('personels')->onDelete('cascade');
            $table->unsignedBigInteger('hedef_konusu_id')->nullable();
            $table->foreign('hedef_konusu_id')->references('id')->on('yillik_hedefkonus')->onDelete('cascade');
            $table->longText('hedef_yili')->nullable();
            $table->string('hedef_mevcut_degeri')->nullable();
            $table->string('hedeflenen_deger')->nullable();
            $table->string('hedef_hesaplama_yontemi')->nullable();
            $table->string('hedef_aksiyonu')->nullable();
            $table->date('hedef_termini')->nullable();
            $table->string('hedef_kontrol_termini')->nullable();
            $table->string('kontrol_sonucu')->nullable();


            $table->string('yonetici_hedeflenen_deger')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pyillikhedeflers');
    }
};
