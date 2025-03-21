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
        Schema::create('virmen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();

            $table->date('tarih')->nullable();
            $table->longText('secimislemi')->nullable();
            $table->double('virman_tutar',17,2)->nullable();

            $table->unsignedBigInteger('birinci_kasa')->nullable();
            $table->foreign('birinci_kasa')->references('id')->on('kasalars')->onDelete('cascade');

            $table->unsignedBigInteger('ikinci_kasa')->nullable();
            $table->foreign('ikinci_kasa')->references('id')->on('kasalars')->onDelete('cascade');

            $table->unsignedBigInteger('birinci_banka')->nullable();
            $table->foreign('birinci_banka')->references('id')->on('bankalars')->onDelete('cascade');

            $table->unsignedBigInteger('ikinci_banka')->nullable();
            $table->foreign('ikinci_banka')->references('id')->on('bankalars')->onDelete('cascade');


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('virmen');
    }
};
