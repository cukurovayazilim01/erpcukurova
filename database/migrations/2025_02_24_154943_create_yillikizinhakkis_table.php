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
        Schema::create('yillikizinhakkis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->unsignedBigInteger('personel_id')->nullable();
            $table->foreign('personel_id')->references('id')->on('personels')->onDelete('cascade');
            $table->longText('yillik_izin_hakki')->nullable();
            $table->longText('kalan_izin_hakki')->nullable();
            $table->longText('yili')->nullable();
            $table->longText('durum')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yillikizinhakkis');
    }
};
