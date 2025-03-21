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
        Schema::create('gelenefaturalars', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('fatura_no')->nullable();
            $table->string('profile_id')->nullable();
            $table->string('type_code')->nullable();
            $table->date('issue_date')->nullable();
            $table->string('currency')->nullable();
            $table->longText('note')->nullable();
            $table->json('notes')->nullable();

            // Sender Information
            $table->string('sender_name')->nullable();
            $table->string('sender_vkn_tckn')->nullable();
            $table->string('sender_city')->nullable();
            $table->string('sender_city_subdivision')->nullable();
            $table->string('sender_tax_office')->nullable();
            $table->string('sender_email')->nullable();

            // Receiver Information
            $table->string('receiver_name')->nullable();
            $table->string('receiver_vkn_tckn')->nullable();
            $table->string('receiver_city')->nullable();
            $table->string('receiver_city_subdivision')->nullable();
            $table->string('receiver_tax_office')->nullable();
            $table->string('receiver_email')->nullable();

            // Financial Data
            $table->decimal('line_extension', 10, 2)->nullable();
            $table->string('line_extension_currency')->nullable();
            $table->decimal('tax_exclusive', 10, 2)->nullable();
            $table->string('tax_exclusive_currency')->nullable();
            $table->decimal('tax_inclusive', 10, 2)->nullable();
            $table->string('tax_inclusive_currency')->nullable();
            $table->decimal('allowance', 10, 2)->nullable();
            $table->string('allowance_currency')->nullable();
            $table->decimal('payable', 10, 2)->nullable();
            $table->string('payable_currency')->nullable();

            // Tax Details
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->string('tax_amount_currency')->nullable();
            $table->json('tax_subtotals')->nullable();
            $table->json('tax_totals')->nullable();

            $table->json('json_data')->nullable();
            $table->string('alis_aktarilma_durum')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gelenefaturalars');
    }
};
