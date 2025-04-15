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
        Schema::create('accountapidatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accountapi_id')->nullable();
            $table->foreign('accountapi_id')->references('id')->on('accountapis')->onDelete('cascade');
            $table->string('location_name');
            $table->string('location_title');
            $table->string('primary_phone')->nullable();
            $table->string('address')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accountapidatas');
    }
};
