<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $questions = Question::all();

        foreach ($users as $user) {
            foreach ($questions as $question) {
                $answer = Answer::where('question_id', $question->id)->inRandomOrder()->first();

                UserAnswer::create([
                    'user_id' => $user->id,
                    'question_id' => $question->id,
                    'answer_id' => $answer->id,
                ]);
            }
        }
    }
}
