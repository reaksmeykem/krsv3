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
        Schema::create('course_materials', function (Blueprint $table) {
            $table->id(); // Auto-incrementing UNSIGNED BIGINT (primary key)
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // Foreign key to the courses table
            $table->string('title'); // Title of the material
            $table->text('description')->nullable(); // Description of the material
            $table->string('type'); // Type of material (e.g., 'PDF', 'Video', 'Slide Deck')
            $table->string('url')->nullable(); // URL to access the material (e.g., S3 link or local path)
            $table->string('file_path')->nullable(); // Path to the file if stored locally
            $table->integer('size')->nullable(); // Size of the file in bytes
            $table->timestamp('published_at')->nullable(); // Date and time when the material was published
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes(); // Soft delete timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_materials');
    }
};
