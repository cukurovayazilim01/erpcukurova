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
        Schema::create('aramalars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('islem_tarihi')->nullable();
            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');
            $table->longText('arama_tipi')->nullable();
            $table->longText('hatirlat_durumu')->nullable();
            $table->longText('hatirlat_tarihi')->nullable();
            $table->longText('not')->nullable();
            $table->longText('hizmet_turu')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aramalars');
    }
};
