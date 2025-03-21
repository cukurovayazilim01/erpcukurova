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
        Schema::create('gelenefaturadatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gelenefatura_id')->nullable();
            $table->foreign('gelenefatura_id')->references('id')->on('gelenefaturalars')->onDelete('cascade');

            $table->string('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('quantity_unit')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_currency')->default('TRY');
            $table->decimal('extension_amount', 10, 2)->nullable();
            $table->string('extension_amount_currency')->default('TRY');

            // Tax Information
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->string('tax_amount_currency')->default('TRY');
            $table->decimal('tax_percent', 5, 2)->nullable();
            $table->decimal('taxable', 10, 2)->nullable();
            $table->string('taxable_currency')->default('TRY');
            $table->decimal('tax_total_amount', 10, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gelenefaturadatas');
    }
};
