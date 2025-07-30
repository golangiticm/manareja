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
        Schema::create('qris', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', ['brc', 'yyp', 'yys']);
            $table->string('atas_nama');
            $table->string('qr_code');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qris');
    }
};
