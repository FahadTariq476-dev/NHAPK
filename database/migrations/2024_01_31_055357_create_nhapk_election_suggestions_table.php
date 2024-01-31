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
        Schema::create('nhapk_election_suggestions', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->enum('suggestionType',['suggestion','objection'])->default('suggestion');
            $table->unsignedBigInteger('candidateId')->nullable();
            $table->unsignedBigInteger('userId')->nullable();
            $table->enum('status',['approved','pending','cancelled'])->default('approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhapk_election_suggestions');
    }
};
