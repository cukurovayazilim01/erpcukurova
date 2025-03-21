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
        Schema::create('odemeplanlaris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->date('tarih')->nullable();
            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');
            $table->date('vade_tarih')->nullable();
            $table->double('odeme_tutar',7,2)->nullable();
            $table->string('durum')->nullable();
            $table->longText('aciklama')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odemeplanlaris');
    }
};
