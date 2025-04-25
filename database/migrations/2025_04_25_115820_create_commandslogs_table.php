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
        Schema::create('commandslogs', function (Blueprint $table) {
            $table->id();
            $table->string('command_name')->nullable();         // Komutun adı (örnek: gelenefatura:aktar)
            $table->string('status')->nullable();               // success, failed, warning gibi
            $table->text('message')->nullable();                // Genel mesaj veya hata
            $table->json('context')->nullable();                // Hatalı satır, fatura uuid vs. ek bilgi
            $table->timestamp('logged_at')->nullable();         // Ne zaman loglandı
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandslogs');
    }
};
