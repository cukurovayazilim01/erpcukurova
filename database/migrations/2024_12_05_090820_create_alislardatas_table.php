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
        Schema::create('alislardatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();

            $table->unsignedBigInteger('alis_id')->nullable();
            $table->foreign('alis_id')->references('id')->on('alislars')->onDelete('cascade');

            $table->unsignedBigInteger('giderkategori_id')->nullable();
            $table->foreign('giderkategori_id')->references('id')->on('giderkategoris')->onDelete('cascade');

            $table->unsignedBigInteger('gider_id')->nullable();
            $table->foreign('gider_id')->references('id')->on('giders')->onDelete('cascade');

            $table->longText('gider_adi')->nullable();
            $table->longText('miktar')->nullable();
            $table->longText('birim')->nullable();
            $table->double('birim_fiyat',17,2)->nullable();
            $table->double('ara_toplam',17,2)->nullable();
            $table->double('iskonto',17,2)->nullable();
            $table->longText('kdv_oran')->nullable();
            $table->double('kdv_tutar',17,2)->nullable();
            $table->double('tutar',17,2)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alislardatas');
    }
};
