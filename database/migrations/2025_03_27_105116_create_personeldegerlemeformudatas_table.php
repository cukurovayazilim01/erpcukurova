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
        Schema::create('personeldegerlemeformudatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personeldegerlemeform_id')->nullable();
            $table->foreign('personeldegerlemeform_id')->references('id')->on('personeldegerlemeformus')->onDelete('cascade');
            $table->string('kriter')->nullable();
            $table->longText('rating')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personeldegerlemeformudatas');
    }
};
