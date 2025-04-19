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
        Schema::create('efaturalardatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('efatura_id')->nullable();
            $table->foreign('efatura_id')->references('id')->on('efaturalars')->onDelete('cascade');
            $table->string('hizmet_adi')->nullable();
            $table->longText('aciklama')->nullable();
            $table->integer('miktar')->nullable();
            $table->string('birim')->nullable();
            $table->double('fiyat',17,3)->nullable();
            $table->integer('kdv_oran')->nullable();
            $table->double('kdv_tutar',17,3)->nullable();
            $table->double('kdvsiztutar',17,3)->nullable();
            $table->double('iskonto',17,3)->nullable();
            $table->double('toplam_fiyat',17,3)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('efaturalardatas');
    }
};
