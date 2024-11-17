<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\UserAnswer;
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
        $chapters = $this->getChapters($id);
        $questions = Question::where('quiz_id', $quiz->id)->get();
        return view('courses.video.index', compact('course', 'chapters', 'quiz', 'question', 'questions', 'nextQuestionUrl'));
    }

    public function submitAnswer(Request $request, $course_id, $quiz_id, $question_id)
    {
        $request->validate([
            'answer' => 'required',
        ]);

        // Get the current question
        $question = Question::findOrFail($question_id);

        // Retrieve the correct answer for the question
        $correctAnswer = $question->answers()->where('is_correct', 1)->first();

        // Get the selected answer from the form submission
        $selectedAnswer = $request->input('answer');

        // Check if the selected answer is the same as the correct answer
        $isCorrect = $correctAnswer && $correctAnswer->id == $selectedAnswer;

        // Store the user's answer in the 'user_answers' table
        $userAnswer = new UserAnswer();
        $userAnswer->user_id = auth()->id(); // Assuming you're using authentication
        $userAnswer->question_id = $question_id;
        $userAnswer->quiz_id = $quiz_id;
        $userAnswer->answer_id = $selectedAnswer;
        $userAnswer->is_correct = $isCorrect;
        $userAnswer->save();

        // Get the next question URL from the form (if there is one)
        $nextQuestionUrl = $request->input('nextquestion');

        // Check if it's the last question of the current quiz
        $nextQuestion = Question::where('quiz_id', $quiz_id)
            ->where('id', '>', $question_id)
            ->first();

        if (!$nextQuestion) {
            // If no more questions, calculate the score
            $score = UserAnswer::where('user_id', auth()->id())
                ->where('quiz_id', $quiz_id)
                ->where('is_correct', 1)
                ->count();

            // Flash the score to session
            session()->flash('score', $score);

            // Get the next quiz in sequence, assuming quizzes are ordered by ID or some other column
            $nextQuiz = Quiz::where('course_id', $course_id)
                ->where('id', '>', $quiz_id)
                ->first();

            if ($nextQuiz) {
                // If there is a next quiz, redirect to it
                return redirect()->route('quiz.show', ['course_id' => $course_id, 'quiz_id' => $nextQuiz->id]);
            } else {
                // If no more quizzes, redirect to the course completion page
                return redirect()->route('quiz.complete', ['quiz_id' => $quiz_id, 'course' => $course_id]);
            }
        }

        // Redirect to the next question
        return redirect()->route('questionshow', [
            'course' => $course_id,
            'quizzes' => $quiz_id,
            'question' => $nextQuestion->id
        ]);
    }



    public function showScore($course, $quiz_id)
    {
        // Get the authenticated user's ID
        $user_id = auth()->id();

        // Retrieve the quiz and its associated questions
        $quiz = Quiz::with('questions')->findOrFail($quiz_id);

        // Calculate the score by counting the correct answers for the specific user
        $score = UserAnswer::where('quiz_id', $quiz_id)
            ->where('user_id', $user_id)
            ->where('is_correct', 1)
            ->count();

        // Get the total number of questions in the quiz
        $totalQuestions = $quiz->questions->count();

        UserAnswer::where('quiz_id', $quiz_id)
            ->where('user_id', $user_id)
            ->delete();

        // Redirect to the course show page with the score and total questions
        return redirect()->route('course.show', ['id' => $course])
            ->with('score', $score)
            ->with('totalQuestions', $totalQuestions);
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
