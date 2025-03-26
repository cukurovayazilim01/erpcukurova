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
        Schema::create('poegitims', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('personel_id')->nullable();
            $table->foreign('personel_id')->references('id')->on('personels')->onDelete('cascade');

            $table->date('egitim_yili')->nullable();
            $table->string('egitim_adi')->nullable();
            $table->string('egitim_suresi')->nullable();
            $table->string('egitim_yeri')->nullable();
            $table->longText('egitim_dosya')->nullable();
            $table->longText('egitim_sonucu')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poegitims');
    }
};
