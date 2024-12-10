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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('author', 255);
            $table->integer('year');
            $table->string('publisher', 255);
            $table->string('city', 255);
            $table->string('cover', 255)->nullable();
            $table->unsignedBigInteger('bookshelf_id');
            $table->timestamps();

            $table->foreign('bookshelf_id')->references('id')->on('bookshelves')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
