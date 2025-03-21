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
        Schema::create('hizmetlerkategoris', function (Blueprint $table) {
            $table->id();
            $table->longText('kategori_ad')->nullable();
            $table->longText('durum')->nullable();
            $table->longText('teklife_ekle')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hizmetlerkategoris');
    }
};
