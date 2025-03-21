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
        Schema::create('yillikizins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->unsignedBigInteger('personel_id')->nullable();
            $table->foreign('personel_id')->references('id')->on('personels')->onDelete('cascade');
            $table->date('baslangic_tarihi')->nullable();
            $table->date('bitis_tarihi')->nullable();
            $table->longText('izin_gun')->nullable();
            $table->longText('hangi_ay')->nullable();
            $table->longText('yillik_izin_hakki')->nullable();
            $table->longText('kalan_izin_hakki')->nullable();
            $table->longText('yili')->nullable();
            $table->longText('gecirilecek_adres')->nullable();
            $table->longText('izin_aciklama')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yillikizins');
    }
};
