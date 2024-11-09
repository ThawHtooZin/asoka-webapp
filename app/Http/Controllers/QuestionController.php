<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function questionshow($id, $quiz_id, $question_id)
    {
        $course = Course::findOrFail($id);
        $quiz = Quiz::where('id', $quiz_id)->where('course_id', $id)->firstOrFail();
        $question = $this->getQuestions($id, $quiz_id, $question_id);

        if (!$question) {
            abort(404);
        }

        // Find current question index in the quiz
        $currentQuestionIndex = $quiz->questions->pluck('id')->search($question_id);

        // Find the next question within the quiz
        if ($currentQuestionIndex !== false && $currentQuestionIndex + 1 < $quiz->questions->count()) {
            $nextQuestion = $quiz->questions[$currentQuestionIndex + 1];
            $nextQuestionUrl = route('questionshow', [
                'course' => $id,
                'quizzes' => $quiz_id,
                'question' => $nextQuestion->id
            ]);
        } else {
            // Move to the next quiz if no more questions
            $nextQuiz = Quiz::where('course_id', $id)
                ->where('id', '>', $quiz_id)
                ->orderBy('id')
                ->first();

            if ($nextQuiz && $nextQuiz->questions->isNotEmpty()) {
                $nextQuestion = $nextQuiz->questions->first();
                $nextQuestionUrl = route('questionshow', [
                    'course' => $id,
                    'quizzes' => $nextQuiz->id,
                    'question' => $nextQuestion->id
                ]);
            } else {
                $nextQuestionUrl = null; // No more questions available
            }
        }

        // Find the previous question within the quiz
        if ($currentQuestionIndex > 0) {
            $previousQuestion = $quiz->questions[$currentQuestionIndex - 1];
            $previousQuestionUrl = route('questionshow', [
                'course' => $id,
                'quizzes' => $quiz_id,
                'question' => $previousQuestion->id
            ]);
        } else {
            // Move to the previous quiz if at the first question
            $previousQuiz = Quiz::where('course_id', $id)
                ->where('id', '<', $quiz_id)
                ->orderByDesc('id')
                ->first();

            if ($previousQuiz && $previousQuiz->questions->isNotEmpty()) {
                $previousQuestion = $previousQuiz->questions->last();
                $previousQuestionUrl = route('questionshow', [
                    'course' => $id,
                    'quizzes' => $previousQuiz->id,
                    'question' => $previousQuestion->id
                ]);
            } else {
                $previousQuestionUrl = null; // No previous questions available
            }
        }

        $chapters = $this->getChapters($id);
        $questions = Question::where('quiz_id', $quiz->id)->get();

        return view('courses.video.index', compact('course', 'chapters', 'quiz', 'question', 'questions', 'nextQuestionUrl', 'previousQuestionUrl'));
    }

    public function submitAnswer(Request $request, $course_id, $quiz_id, $question_id)
    {
        // Get the current question
        $question = Question::findOrFail($question_id);

        // Retrieve the correct answer for the question
        $correctAnswer = $question->answers()->where('is_correct', 1)->first();

        // Get the selected answer from the form submission
        $selectedAnswer = $request->input('answer');

        // Check if the selected answer is the same as the correct answer
        $isCorrect = $correctAnswer && $correctAnswer->id == $selectedAnswer;

        // Get the next question URL from the form
        $nextQuestionUrl = $request->input('nextquestion');

        if ($isCorrect) {
            // If the answer is correct, redirect to the next question with success message
            return redirect($nextQuestionUrl)->with('success', 'Correct!');
        } else {
            // If the answer is wrong, stay on the current question and show 'Try again!'
            return back()->with('error', 'Try again!');
        }
    }




    // Helper method to get a specific question within a quiz in a course
    private function getQuestions($course_id, $quiz_id, $question_id)
    {
        return Question::where('id', $question_id)
            ->where('quiz_id', $quiz_id)
            ->whereHas('quiz', fn($query) => $query->where('course_id', $course_id))
            ->first();
    }

    private function getChapters($course_id)
    {
        return Chapter::where('course_id', $course_id)->get();
    }
}
