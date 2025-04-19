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
        Schema::create('efaturalars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->string('fatura_no_text')->nullable();
            $table->integer('fatura_no')->nullable();
            $table->dateTime('fatura_tarihi')->nullable();
            $table->unsignedBigInteger('cari_id')->nullable();
            $table->foreign('cari_id')->references('id')->on('carilers')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('vkn')->nullable();
            $table->string('tckimlikno')->nullable();
            $table->string('vergidairesi')->nullable();
            $table->string('il')->nullable();
            $table->string('ilce')->nullable();
            $table->string('efatura_tipi')->nullable();
            $table->double('kdv_toplam',17,3)->nullable();
            $table->double('iskonto_toplam',17,3)->nullable();
            $table->double('ara_toplam',17,3)->nullable();
            $table->double('toplam_tutar',17,3)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('efaturalars');
    }
};
