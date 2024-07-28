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
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('author');
            $table->text('description')->nullable();
            $table->date('publication_date')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('pdf_path')->nullable();
            $table->string('cover_image_path')->nullable();
            $table->string('isbn')->nullable();
            $table->string('language')->nullable(); // Language of the book
            $table->string('publisher')->nullable(); // Publisher of the book
            $table->string('genre')->nullable(); // Genre of the book
            $table->integer('page_count')->nullable(); // Number of pages
            $table->boolean('drm_protected')->default(false); // DRM protection
            $table->decimal('price', 8, 2)->nullable(); // Price of the book
            $table->float('rating')->nullable(); // Average rating
            $table->timestamps();
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
