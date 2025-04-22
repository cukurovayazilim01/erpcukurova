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
        Schema::create('tekliflers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->dateTime('teklif_tarihi')->nullable();
            $table->integer('teklif_kodu')->nullable();
            $table->longText('teklif_kodu_text')->nullable();

            $table->string('odemeplan_durum')->nullable();

            $table->longText('satis_durum')->nullable();
            $table->longText('durum')->nullable();
            $table->longText('tescil_tl')->nullable();

            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');

            // $table->unsignedBigInteger('yetkili_kisi_id')->nullable();
            // $table->foreign('yetkili_kisi_id')->references('id')->on('kontaks')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');



            $table->longText('teklif_konu')->nullable();
            $table->longText('teklif_aciklama')->nullable();
            $table->longText('aciklama')->nullable();





            $table->double('teklif_iskonto_toplam', 15, 2)->nullable();
            $table->double('teklif_kdv_toplam', 15, 2)->nullable();
            $table->double('teklif_ara_toplam', 15, 2)->nullable();
            $table->double('teklif_kdvli_toplam', 15, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tekliflers');
    }
};
