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
        Schema::create('isbasvurularis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->date('tarih')->nullable();
            $table->string('ad_soyad')->nullable();
            $table->string('basvuru_pozisyon')->nullable();
            $table->longText('telefon')->nullable();
            $table->longText('email')->nullable();
            $table->longText( 'mezuniyet')->nullable();
            $table->string( 'durum')->nullable();
            $table->longText( 'dosya')->nullable();
            $table->longText( 'gorusme_notu')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isbasvurularis');
    }
};
