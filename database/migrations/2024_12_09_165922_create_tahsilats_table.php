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
        Schema::create('tahsilats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->dateTime('tarih')->nullable();
            $table->integer('tahsilat_kodu')->nullable();
            $table->longText('tahsilat_kodu_text')->nullable();
            $table->string('odeme_turu')->nullable();
            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');
            $table->unsignedBigInteger('tahsileden_id')->nullable();
            $table->foreign('tahsileden_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('odeme_yapan')->nullable();
            $table->string('odeme_tipi')->nullable();
            $table->unsignedBigInteger('kasa_id')->nullable();
            $table->foreign('kasa_id')->references('id')->on('kasalars')->onDelete('cascade');
            $table->unsignedBigInteger('banka_id')->nullable();
            $table->foreign('banka_id')->references('id')->on('bankalars')->onDelete('cascade');
            $table->double('tahsilat_tutar',17,2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahsilats');
    }
};
