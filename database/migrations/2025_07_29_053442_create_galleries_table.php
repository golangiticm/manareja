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
        Schema::create('galleries', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // polymorphic relation
            $table->uuid('eventable_id');
            $table->string('eventable_type');

            $table->string('title');
            $table->string('thumbnail');
            $table->text('description');
            $table->json('images');
            $table->boolean('is_publish')->default(false);
            $table->date('published_at')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
