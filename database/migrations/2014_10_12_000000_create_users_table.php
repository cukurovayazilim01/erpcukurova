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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->longText('ad_soyad')->nullable();
            $table->longText('departman')->nullable();
            $table->longText('gorev')->nullable();
            $table->longText('resim')->nullable();
            $table->longText('durum')->nullable();
            $table->string('telefon')->nullable();
            $table->string('email')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
