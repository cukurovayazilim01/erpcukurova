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
        Schema::create('kasalars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->longText('kasa_adi')->nullable();
            $table->double('acilis_bakiye', 15, 2)->nullable();
            $table->double('bakiye',17,2)->nullable();
            $table->date('acilis_bakiye_tarih')->nullable();
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
        Schema::dropIfExists('kasalars');
    }
};
