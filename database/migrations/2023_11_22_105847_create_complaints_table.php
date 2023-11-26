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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mob_no');
            $table->string('email');
            $table->string('room_no');
            $table->unsignedBigInteger('hostel_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->string('complaint_type');
            $table->string('complaint_priority');
            $table->text('complaint_details');
            $table->enum('status', ['pending', 'approved','resolved','inprocess'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
