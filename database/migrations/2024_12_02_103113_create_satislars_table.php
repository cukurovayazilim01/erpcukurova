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
        Schema::create('satislars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->date('satis_tarihi')->nullable();
            $table->longText('satis_kodu')->nullable();
            $table->longText('satis_kodu_text')->nullable();

            $table->longText('durum')->nullable();
            $table->longText('tescil_tl')->nullable();

            $table->unsignedBigInteger('teklif_id')->nullable();
            $table->foreign('teklif_id')->references('id')->on('tekliflers')->onDelete('cascade');

            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('hizmetlerkategori_id')->nullable();
            $table->foreign('hizmetlerkategori_id')->references('id')->on('hizmetlerkategoris')->onDelete('cascade');

            $table->unsignedBigInteger('hizmet_id')->nullable();
            $table->foreign('hizmet_id')->references('id')->on('hizmetlers')->onDelete('cascade');

            $table->longText('satis_konu')->nullable();
            $table->longText('satis_aciklama')->nullable();
            $table->longText('aciklama')->nullable();
            $table->longText('satis_hizmet_miktar')->nullable();
            $table->double('satis_fiyat', 15, 2)->nullable();
            $table->longText('satis_hizmet_birim')->nullable();
            $table->double('hizmet_maliyet', 15, 2)->nullable();
            $table->double('maliyet_toplam_fiyat', 15, 2)->nullable();
            $table->double('satis_kdv_tutar', 15, 2)->nullable();



            $table->double('satis_kdv_oran', 15, 2)->nullable();
            $table->double('satis_kdvsiz_fiyat', 15, 2)->nullable();
            $table->double('satis_iskonto', 15, 2)->nullable();
            $table->double('satis_toplam_fiyat', 15, 2)->nullable();

            $table->double('satis_iskonto_toplam', 15, 2)->nullable();
            $table->double('satis_kdv_toplam', 15, 2)->nullable();
            $table->double('satis_ara_toplam', 15, 2)->nullable();
            $table->double('satis_kdvli_toplam', 15, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satislars');
    }
};
