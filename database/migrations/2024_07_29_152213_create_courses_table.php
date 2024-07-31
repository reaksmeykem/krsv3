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
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // Auto-incrementing UNSIGNED BIGINT (primary key)
            $table->string('title'); // Title of the course
            $table->string('slug')->unique(); // URL-friendly version of the title
            $table->text('description')->nullable(); // Detailed description of the course
            $table->text('objectives')->nullable(); // Learning objectives and outcomes
            $table->date('start_date'); // The start date of the course
            $table->date('end_date'); // The end date of the course
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner'); // Difficulty level
            $table->string('language')->nullable(); // Language of instruction
            $table->text('schedule')->nullable(); // Course schedule or timetable
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade'); // Foreign key to the users table
            $table->unsignedInteger('max_enrollments')->default(100); // Maximum number of students allowed to enroll
            $table->unsignedInteger('enrollment_count')->default(0); // Current number of students enrolled
            $table->boolean('is_active')->default(true); // Indicates if the course is active
            $table->boolean('is_featured')->default(false); // Indicates if the course is featured
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes(); // Soft delete timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
