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
        Schema::create('resmievraklars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('islem_yapan')->nullable();
            $table->foreign('islem_yapan')->references('id')->on('users')->onDelete('cascade');
            $table->date('islem_tarihi')->nullable();
            $table->longText('dokuman_yili')->nullable();
            $table->longText('dokuman_adi')->nullable();
            $table->longText('dokuman_yolu')->nullable();
            $table->date('dokuman_alim_tarihi')->nullable();
            $table->date('dokuman_hatirlatma_tarihi')->nullable();
            $table->longText('aciklama')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resmievraklars');
    }
};
