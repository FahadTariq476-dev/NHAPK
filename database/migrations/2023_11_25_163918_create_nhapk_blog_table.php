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
        Schema::create('nhapk_blog', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->string('title');
            $table->string('short_description');
            $table->text('full_description');
            $table->text('editor_content'); // Assuming this is where you store the formatted text from the editor
            $table->string('image_path'); // Assuming you store the path to the image file
            $table->string('thumbnail_image_path'); // Assuming you store the path to the thumbnail image file
            $table->boolean('featured_post')->default(false);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('post_category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhapk_blog');
    }
};
