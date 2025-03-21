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
        Schema::create('alislars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->date('fis_tarihi')->nullable();
            $table->string('fis_no')->nullable();
            $table->longText('doviz')->nullable();
            $table->longText('alis_kodu')->nullable();
            $table->longText('alis_kodu_text')->nullable();

            // $table->longText('durum')->nullable();

            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');


            $table->longText('aciklama')->nullable();


            $table->double('toplam_ara_toplam',17,2)->nullable();
            $table->double('toplam_iskonto',17,2)->nullable();
            $table->double('indirimli_tutar',17,2)->nullable();
            $table->double('toplam_kdv_tutar',17,2)->nullable();
            $table->double('toplam_tutar',17,2)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alislars');
    }
};
