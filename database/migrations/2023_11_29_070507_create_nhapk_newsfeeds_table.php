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
        Schema::create('nhapk_newsfeeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->string('title');
            $table->text('short_description');
            $table->longText('editor_content');
            $table->string('image_path')->nullable();
            $table->string('thumbnail_image_path')->nullable();
            $table->boolean('featured_post')->default(0);
            $table->enum('status', ['published', 'pending'])->default('pending');
            $table->unsignedBigInteger('news_category_id')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhapk_newsfeeds');
    }
};
