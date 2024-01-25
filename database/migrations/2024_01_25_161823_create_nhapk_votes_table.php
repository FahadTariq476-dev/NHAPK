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
        Schema::create('nhapk_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId')->nullable();
            $table->unsignedBigInteger('candidateId')->nullable();
            $table->unsignedBigInteger('electionCategoryId')->nullable();
            $table->unsignedBigInteger('electionId')->nullable();
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('userId')->references('id')->on('users')->onDelete('set null');
            $table->foreign('candidateId')->references('id')->on('nhapk_candidates')->onDelete('set null');
            $table->foreign('electionCategoryId')->references('id')->on('nhapk_election_categories')->onDelete('set null');
            $table->foreign('electionId')->references('id')->on('nhapk_elections')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhapk_votes');
    }
};
