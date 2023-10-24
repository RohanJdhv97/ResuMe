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
        Schema::create('candidate_assessments', function (Blueprint $table) {
            $table->id();
            $table->longText('questions');
            $table->longText('answers');
            $table->longText('candidate_answers');
            $table->longText('interview_url');
            $table->dateTime('assessment_created_date');
            $table->dateTime('assessment_expiery_date');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_assessments');
    }
};
