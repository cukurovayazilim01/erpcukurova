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
        Schema::create('firmahrkts', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tarih')->nullable();

            $table->date('islem_tarihi')->nullable();
            $table->longText('islem')->nullable();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');
            $table->unsignedBigInteger('kasahareket_id')->nullable();
            $table->foreign('kasahareket_id')->references('id')->on('kasahrkts')->onDelete('cascade');
            $table->unsignedBigInteger('bankahareket_id')->nullable();
            $table->foreign('bankahareket_id')->references('id')->on('bankahrkts')->onDelete('cascade');
            $table->unsignedBigInteger('odeme_id')->nullable();
            $table->foreign('odeme_id')->references('id')->on('odemelers')->onDelete('cascade');

            $table->unsignedBigInteger('satis_id')->nullable();
            $table->foreign('satis_id')->references('id')->on('satislars')->onDelete('cascade');
            $table->unsignedBigInteger('alis_id')->nullable();
            $table->foreign('alis_id')->references('id')->on('alislars')->onDelete('cascade');
            $table->unsignedBigInteger('tahsilat_id')->nullable();
            $table->foreign('tahsilat_id')->references('id')->on('tahsilats')->onDelete('cascade');
            $table->unsignedBigInteger('ceksenet_id')->nullable();
            $table->foreign('ceksenet_id')->references('id')->on('ceksenets')->onDelete('cascade');

            $table->double('islem_miktar',15,2)->nullable();
            $table->double('alacak',15,2)->nullable();
            $table->double('borc',15,2)->nullable();
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
        Schema::dropIfExists('firmahrkts');
    }
};
