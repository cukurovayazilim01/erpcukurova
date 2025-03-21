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
        Schema::create('ceksenets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();

            $table->unsignedBigInteger('odeme_id')->nullable();
            $table->foreign('odeme_id')->references('id')->on('odemelers')->onDelete('cascade');
            $table->unsignedBigInteger('tahsilat_id')->nullable();
            $table->foreign('tahsilat_id')->references('id')->on('tahsilats')->onDelete('cascade');
            $table->date('cek_vade_tarihi')->nullable();
            $table->string('cek_no')->nullable();
            $table->string('cek_tipi')->nullable();
            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');

            $table->double('tutar',17,2)->nullable();
            $table->string('banka_adi')->nullable();
            $table->string('sube_adi')->nullable();
            $table->string('hesap_no')->nullable();
            $table->longText('cek_resim')->nullable();
            $table->longText('aciklama')->nullable();

            $table->string('durum')->nullable();
            $table->string('pasifcekme_durum')->nullable();



            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ceksenets');
    }
};
