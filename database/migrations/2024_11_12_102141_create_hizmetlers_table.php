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
        Schema::create('hizmetlers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->unsignedBigInteger('hizmetler_kategori_id')->nullable();
            $table->foreign('hizmetler_kategori_id')->references('id')->on('hizmetlerkategoris')->onDelete('cascade');
            $table->longText('hizmet_ad')->nullable();
            $table->double('hizmet_maliyet', 15, 2)->nullable();
            $table->double('hizmet_satis_fiyati', 15, 2)->nullable();
            $table->longText('hizmet_aciklama')->nullable();
            $table->longText('durum')->nullable();
            $table->longText('teklife_ekle')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hizmetlers');
    }
};
