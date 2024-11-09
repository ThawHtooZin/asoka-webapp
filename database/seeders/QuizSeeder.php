<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            Quiz::create([
                'course_id' => $course->id,
                'title' => 'Sample Quiz for ' . $course->name,
                'description' => 'A sample quiz for the course: ' . $course->name,
            ]);
        }
    }
}
