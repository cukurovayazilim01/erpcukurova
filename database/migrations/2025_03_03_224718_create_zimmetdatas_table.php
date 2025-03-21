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
        Schema::create('zimmetdatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zimmet_id')->nullable();
            $table->foreign('zimmet_id')->references('id')->on('zimmets')->onDelete('cascade');
            $table->date('verilme_tarihi')->nullable();
            $table->string('marka')->nullable();
            $table->string('model')->nullable();
            $table->string('miktar')->nullable();
            $table->string('birim')->nullable();
            $table->longText('verme_dosya')->nullable();

            $table->date('geri_alma_tarihi')->nullable();
            $table->string('geri_alma_miktar')->nullable();
            $table->longText('alma_dosya')->nullable();
            $table->string('durum')->nullable();
            $table->string('aciklama')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zimmetdatas');
    }
};
