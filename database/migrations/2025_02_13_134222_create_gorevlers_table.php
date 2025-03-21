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
        Schema::create('gorevlers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->unsignedBigInteger('gorevlendirilen_id')->nullable();
            $table->foreign('gorevlendirilen_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');
            $table->date('gorev_baslama_tarihi')->nullable();
            $table->date('gorev_bitis_tarihi')->nullable();
            $table->longText('gorev_adi')->nullable();
            $table->longText('gorev_tanimi')->nullable();
            $table->longText('gorev_derecesi')->nullable();
            $table->longText('aciklama')->nullable();
            $table->longText('gorev_bitirme_tarihi')->nullable();
            $table->string('gorev_durumu')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gorevlers');
    }
};
