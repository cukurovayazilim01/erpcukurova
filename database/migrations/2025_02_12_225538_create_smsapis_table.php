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
        Schema::create('smsapis', function (Blueprint $table) {
            $table->id();
            $table->string('kullanici_no')->nullable();
            $table->string('kullanici_adi')->nullable();
            $table->string('sifre')->nullable();
            $table->string('orginator')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smsapis');
    }
};
