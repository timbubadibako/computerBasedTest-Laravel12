<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // kolom 'id' untuk question
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->text(column: 'question'); // Pertanyaan
            $table->string('option_a');
            $table->string(column: 'option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->string('correct_answer'); // Jawaban benar
            $table->timestamps();
            $table->softDeletes(); // 👈 ini juga
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question');
    }
};
