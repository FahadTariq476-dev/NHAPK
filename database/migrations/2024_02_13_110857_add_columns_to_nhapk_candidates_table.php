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
        Schema::table('nhapk_candidates', function (Blueprint $table) {
            $table->unsignedBigInteger('electionSeatId')->nullable();
            $table->foreign('electionSeatId')->references('id')->on('nhapk_election_seats')->onDelete('set null');

            $table->unsignedBigInteger('hostelId')->nullable();
            $table->foreign('hostelId')->references('id')->on('properties')->onDelete('set null');

            $table->text('objectives')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nhapk_candidates', function (Blueprint $table) {
            $table->dropForeign(['electionSeatId']);
            $table->dropForeign(['hostelId']);
            $table->dropColumn('objectives');
        });
    }
};
