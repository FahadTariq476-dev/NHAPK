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
            $table->dateTime('applyStartDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nhapk_elections', function (Blueprint $table) {
            $table->dropColumn('applyStartDate');
        });
    }
};
