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
        Schema::create('nhapk_dynamic_surveys_form_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dynamicSurveysFromsId')->nullable();
            $table->string('field_label')->nullable();
            $table->text('response_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhapk_dynamic_surveys_form_responses');
    }
};
