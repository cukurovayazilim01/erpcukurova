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
        Schema::create('bankahrkts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banka_id')->nullable();
            $table->foreign('banka_id')->references('id')->on('bankalars')->onDelete('cascade');
            $table->unsignedBigInteger('tahsilat_id')->nullable();
            $table->foreign('tahsilat_id')->references('id')->on('tahsilats')->onDelete('cascade');
            $table->unsignedBigInteger('odeme_id')->nullable();
            $table->foreign('odeme_id')->references('id')->on('odemelers')->onDelete('cascade');
            $table->date('hareket_saati')->nullable();
            $table->string('hareket_tipi')->nullable();
            $table->string('doviz')->nullable();
            $table->double('bakiye',17,2)->nullable();
            $table->double('eklenen_tutar',17,2)->nullable();
            $table->double('guncel_bakiye',17,2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bankahrkts');
    }
};
