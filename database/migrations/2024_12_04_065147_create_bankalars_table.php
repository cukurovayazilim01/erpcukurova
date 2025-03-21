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
        Schema::create('bankalars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->longText('banka_adi')->nullable();
            $table->longText('sube_adi')->nullable();
            $table->longText('sube_kodu')->nullable();
            $table->longText('hesap_adi')->nullable();
            $table->longText('hesap_no')->nullable();
            $table->longText('iban')->nullable();
            $table->string('kart_turu')->nullable();
            $table->date('acilis_bakiye_tarih')->nullable();
            $table->double('acilis_bakiyesi', 15, 2)->nullable();
            $table->double('bakiye',17,2)->nullable();

            $table->string('doviz')->nullable();
            $table->string('durum')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bankalars');
    }
};
