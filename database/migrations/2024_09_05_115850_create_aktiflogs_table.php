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
        Schema::create('aktiflogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islemiyapan_id')->nullable();
            $table->foreign('islemiyapan_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->longText('islem')->nullable();
            $table->longText('guncellenmis_islem')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktiflogs');
    }
};
