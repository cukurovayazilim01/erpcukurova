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
        Schema::create('kargotakips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->string('gonderen_ad')->nullable();
            $table->string('gonderi_tipi')->nullable();
            $table->date('gonderi_tarihi')->nullable();
            $table->longText('kargo_takip_no')->nullable();
            $table->string('hangi_kargo')->nullable();
            $table->longText('aciklama')->nullable();
            $table->longText('kargoyu_alan')->nullable();
            $table->longText('alinan_tarih')->nullable();
            $table->longText('kargo_durum')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kargotakips');
    }
};
