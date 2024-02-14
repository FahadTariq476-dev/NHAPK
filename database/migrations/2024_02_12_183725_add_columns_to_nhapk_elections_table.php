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
        Schema::table('nhapk_elections', function (Blueprint $table) {
            $table->unsignedBigInteger('countryId')->nullable();
            $table->foreign('countryId')->references('id')->on('countries')->onDelete('set null');

            $table->unsignedBigInteger('stateId')->nullable();
            $table->foreign('stateId')->references('id')->on('states')->onDelete('set null');

            $table->unsignedBigInteger('cityId')->nullable();
            $table->foreign('cityId')->references('id')->on('cities')->onDelete('set null');

            $table->unsignedBigInteger('electionCategoryId')->nullable();
            $table->foreign('electionCategoryId')->references('id')->on('nhapk_election_categories')->onDelete('set null');

            $table->json('areaId')->nullable();

            $table->json('electionSeatId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nhapk_elections', function (Blueprint $table) {
            $table->dropForeign(['countryId']);
            $table->dropForeign(['stateId']);
            $table->dropForeign(['cityId']);
            $table->dropForeign(['electionCategoryId']);
            $table->dropColumn('areaId');
            $table->dropColumn('electionSeatId');
        });
    }
};
