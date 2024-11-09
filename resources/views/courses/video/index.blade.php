<x-layout>
    <div class="flex min-h-screen text-white">

        <!-- Main Content for Video Player on the Right -->
        <main class="flex-1 m-8 bg-gray-300 px-2 py-3 text-gray-900 rounded-lg">
            <div class="aspect-w-16 aspect-h-9 bg-black rounded-md overflow-hidden border border-gray-300 shadow-md">
                <video controls class="mx-auto" loop autoplay>
                    <source src="{{ asset($video->video_url) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="mt-4 p-3 rounded-lg bg-gray-100">

                <!-- Navigation Buttons for Previous and Next Videos -->
                <div class="flex justify-between mb-4">
                    <a href="{{ $previousVideoUrl ?? '#' }}"
                        class="px-4 py-2 bg-asokablue text-white rounded-lg font-semibold transition-transform duration-200 hover:scale-105 {{ !$previousVideoUrl ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ !$previousVideoUrl ? 'aria-disabled=true' : '' }}>
                        &larr; Previous
                    </a>

                    <a href="{{ $nextVideoUrl ?? '#' }}"
                        class="px-4 py-2 bg-asokablue text-white rounded-lg font-semibold transition-transform duration-200 hover:scale-105 {{ !$nextVideoUrl ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ !$nextVideoUrl ? 'aria-disabled=true' : '' }}>
                        Next &rarr;
                    </a>
                </div>

                <!-- Video Title and Description Section -->
                <div class="bg-gray-100 px-4 py-3 rounded-lg">
                    <h1 class="text-xl font-bold mb-4">{{ $video->title }}</h1>
                    <p>
                        {{ $video->description ?? 'No description available for this video.' }}
                    </p>
                </div>
            </div>

        </main>

        <!-- Sidebar for Chapters on the Right -->
        <aside class="w-1/3 bg-asokablue text-white p-4 h-screen shadow-lg overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6 border-b border-gray-300 pb-2">{{ $course->name }}</h2>
            <ul>
                @foreach ($chapters as $chapter)
                    <li class="mb-4 border border-gray-300 rounded-lg overflow-hidden">
                        <div class="flex justify-between items-center p-3 cursor-pointer chapter-title"
                            data-chapter-id="{{ $chapter->id }}">
                            <h3 class="text-lg font-medium">{{ $chapter->title }}</h3>
                            <span class="transition-transform transform chapter-arrow">&#9660;</span>
                            <!-- Down arrow -->
                        </div>
                        <ul class="space-y-2 max-h-0 overflow-hidden transition-max-height duration-500 ease-in-out chapter-videos"
                            data-chapter-id="{{ $chapter->id }}">
                            @foreach ($chapter->videos as $video)
                                <li>
                                    <a href="/courses/{{ $course->id }}/chapters/{{ $chapter->id }}/videos/{{ $video->id }}"
                                        class="text-sm block px-3 py-2 
                        {{ request()->is('courses/*/chapters/*/videos/' . $video->id) ? 'bg-blue-300 text-gray-900' : 'bg-gray-300 text-gray-900' }} 
                        hover:bg-gray-100 hover:shadow-md transition-all duration-200">
                                        {{ $video->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                <li class="mb-4 border border-gray-300 rounded-lg overflow-hidden">
                    <!-- Quiz Title Section -->
                    <div class="flex justify-between items-center p-3 cursor-pointer quiz-title"
                        data-quiz-id="{{ $quiz->id }}">
                        <h3 class="text-lg font-medium">{{ $quiz->title }}</h3>
                        <span class="transition-transform transform chapter-arrow">&#9660;</span>
                    </div>

                    <!-- Questions List for Quiz -->
                    <ul class="space-y-2 max-h-0 overflow-hidden transition-max-height duration-500 ease-in-out chapter-videos"
                        data-quiz-id="{{ $quiz->id }}">
                        @foreach ($questions as $question)
                            <li>
                                <a href="/courses/{{ $course->id }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}"
                                    class="text-sm block px-3 py-2 
                                    {{ request()->is('courses/*/quiz/*/question/' . $question->id) ? 'bg-blue-300 text-gray-900' : 'bg-gray-300 text-gray-900' }} 
                                    hover:bg-gray-100 hover:shadow-md transition-all duration-200">
                                    {{ $question->question_text }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

            </ul>
        </aside>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggling logic for chapter and quiz video list based on click
            $('.chapter-title').on('click', function() {
                const chapterId = $(this).data('chapter-id');
                const videosList = $(`.chapter-videos[data-chapter-id="${chapterId}"]`);
                const arrow = $(this).find('.chapter-arrow');

                videosList.toggleClass('max-h-0 max-h-screen');
                arrow.toggleClass('rotate-180');
            });

            // Toggling logic for quiz questions based on click
            $('.quiz-title').on('click', function() {
                const quizId = $(this).data('quiz-id');
                const questionsList = $(`.chapter-videos[data-quiz-id="${quizId}"]`);
                const arrow = $(this).find('.chapter-arrow');

                questionsList.toggleClass('max-h-0 max-h-screen');
                arrow.toggleClass('rotate-180');
            });

            // Auto-expand the quiz section if the current URL matches the quiz route
            if (window.location.href.includes("{{ url('/courses/' . $course->id . '/quiz/' . $quiz->id) }}")) {
                const questionsList = $(`.chapter-videos[data-quiz-id="{{ $quiz->id }}"]`);
                const arrow = $(`.quiz-title[data-quiz-id="{{ $quiz->id }}"] .chapter-arrow`);

                questionsList.removeClass('max-h-0').addClass('max-h-screen');
                arrow.addClass('rotate-180');
            }
        });
    </script>
</x-layout>
