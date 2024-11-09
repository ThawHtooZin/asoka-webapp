<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();

        foreach ($questions as $question) {
            for ($i = 1; $i <= 4; $i++) { // Create 4 answers per question
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => 'Answer Option ' . $i . ' for Question ' . $question->id,
                    'is_correct' => $i === 1, // Set the first answer as correct
                ]);
            }
        }
    }
}
