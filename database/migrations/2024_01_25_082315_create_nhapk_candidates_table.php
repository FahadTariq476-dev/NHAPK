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
        Schema::create('nhapk_candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId')->nullable();
            $table->unsignedBigInteger('stateId')->nullable();
            $table->unsignedBigInteger('cityId')->nullable();
            $table->unsignedBigInteger('electionCategoryId')->nullable();
            $table->unsignedBigInteger('electionId')->nullable();
            $table->enum('status',['pending','working','approved','objection','rejected'])->default('pending');
            $table->string('file')->nullable();
            $table->bigInteger('referralCount');
            $table->text('stars');
            $table->timestamps();
            // Define foreign key constraint
            $table->foreign('userId')->references('id')->on('users')->onDelete('set null');
            $table->foreign('stateId')->references('id')->on('states')->onDelete('set null');
            $table->foreign('cityId')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('electionCategoryId')->references('id')->on('nhapk_election_categories')->onDelete('set null');
            $table->foreign('electionId')->references('id')->on('nhapk_elections')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhapk_candidates');
    }
};
