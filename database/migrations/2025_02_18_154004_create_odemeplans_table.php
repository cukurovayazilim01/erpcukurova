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
        Schema::create('odemeplans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('teklif_id')->nullable();
            $table->foreign('teklif_id')->references('id')->on('tekliflers')->onDelete('cascade');
            $table->longText('taksit_sayisi')->nullable();
            $table->date('odeme_tarihi')->nullable();
            $table->string('odeme_turu')->nullable();
            $table->string('odendi_mi')->nullable();
            $table->string('tutar')->nullable();
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
        Schema::dropIfExists('odemeplans');
    }
};
