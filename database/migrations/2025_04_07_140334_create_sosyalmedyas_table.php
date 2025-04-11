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
        Schema::create('sosyalmedyas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->string('gonderi_tipi')->nullable();
            $table->dateTime('gonderi_zamani')->nullable();
            $table->string('gonderi_adi')->nullable();
            $table->string('gonderi_boyutu')->nullable();
            $table->json('resim')->nullable();
            $table->text('text')->nullable();
            $table->string('platforms')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sosyalmedyas');
    }
};
