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
        Schema::create('satislardatas', function (Blueprint $table) {
            $table->id();
            $table->longText('islem_tarihi')->nullable();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('satis_id')->nullable();
            $table->foreign('satis_id')->references('id')->on('satislars')->onDelete('cascade');

            $table->unsignedBigInteger('hizmetlerkategori_id')->nullable();
            $table->foreign('hizmetlerkategori_id')->references('id')->on('hizmetlerkategoris')->onDelete('cascade');

            $table->unsignedBigInteger('hizmet_id')->nullable();
            $table->foreign('hizmet_id')->references('id')->on('hizmetlers')->onDelete('cascade');

            $table->longText('satir_aciklama')->nullable();
            $table->longText('satis_hizmet_miktar')->nullable();
            $table->longText('satis_hizmet_birim')->nullable();

            $table->double('hizmet_maliyet', 15, 2)->nullable();
            $table->double('maliyet_toplam_fiyat', 15, 2)->nullable();
            $table->double('satis_fiyat', 15, 2)->nullable();
            $table->longText('satis_kdv_oran')->nullable();
            $table->double('satis_kdv_tutar', 15, 2)->nullable();
            $table->double('satis_kdvsiz_fiyat', 15, 2)->nullable();
            $table->double('satis_iskonto', 15, 2)->nullable();
            $table->double('satis_toplam_fiyat', 15, 2)->nullable();



            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satislardatas');
    }
};
