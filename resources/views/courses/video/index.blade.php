<x-layout>
    <div class="flex min-h-screen text-white">

        <!-- Main Content for Video Player or Quiz Interface on the Right -->
        <main class="flex-1 m-8 bg-gray-300 px-2 py-3 text-gray-900 rounded-lg">
            @if (Route::is('questionshow'))
                <!-- Quiz Interface -->
                <div class="p-4 bg-gray-100 rounded-md shadow-lg">
                    <h1 class="text-2xl font-bold mb-4">{{ $question->title ?? 'Quiz Question' }}</h1>

                    <!-- Quiz Question and Options -->
                    <form method="POST"
                        action="{{ route('submitquizanswer', ['course' => $course->id, 'quiz' => $quiz->id, 'question' => $question->id]) }}">
                        @csrf
                        <div class="mb-4">
                            <p class="mb-2">{{ $question->question_text }}</p>
                            @foreach ($question->answers as $answer)
                                <label class="block p-2 border border-gray-300 rounded-lg mb-2 cursor-pointer">
                                    <input type="radio" name="answer" value="{{ $answer->id }}" class="mr-2">
                                    {{ $answer->answer_text }}
                                </label>
                            @endforeach
                            @error('answer')
                                <div class="text-red-500">Please Choose an answer!</div>
                            @enderror
                        </div>

                        <!-- Navigation Buttons for Previous and Next Questions -->
                        <div class="flex justify-between mt-4">
                            <input type="hidden" name="nextquestion" value="{{ $nextQuestionUrl }}">
                            <button type="submit"
                                class="px-4 py-2 bg-green-500 text-white rounded-lg font-semibold transition-transform duration-200 hover:scale-105">
                                Submit Answer
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <!-- Video Interface -->
                <div
                    class="aspect-w-16 aspect-h-9 bg-black rounded-md overflow-hidden border border-gray-300 shadow-md">
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
            @endif
        </main>


        <!-- Sidebar for Chapters on the Right -->
        <aside class="w-1/3 bg-asokablue text-white p-4 h-screen shadow-lg overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6 border-b border-gray-300 pb-2">{{ $course->name }}</h2>
            <ul>
                @foreach ($chapters as $chapter)
                    <li class="mb-4 border border-gray-300 rounded-lg overflow-hidden">
                        <div class="flex justify-between items-center p-3 cursor-pointer chapter-title"
                            data-chapter-id="{{ $chapter->id }}">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-camera-reels" viewBox="0 0 16 16">
                                    <path d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0M1 3a2 2 0 1 0 4 0 2 2 0 0 0-4 0" />
                                    <path
                                        d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2zm6 8.73V7.27l-3.5 1.555v4.35zM1 8v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1" />
                                    <path d="M9 6a3 3 0 1 0 0-6 3 3 0 0 0 0 6M7 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                                </svg>
                                <h3 class="text-lg font-medium">{{ $chapter->title }}</h3>
                            </div>
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
                    <form class="flex justify-between items-center p-3 cursor-pointer quiz-title mb-0"
                        action="/courses/{{ $course->id }}/quiz/{{ $quiz->id }}/questions/{{ $question->id }}"
                        method="get">
                        <button type="submit" class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-lightbulb-fill" viewBox="0 0 16 16">
                                <path
                                    d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5" />
                            </svg>
                            <h3 class="text-lg font-medium">Take Quiz</h3>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>
    </div>

    @if (session('score'))
        <div class="alert alert-success">
            <strong>Congratulations!</strong> Your score is: {{ session('score') }}.
        </div>
    @endif

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

            // Automatically open the chapter video list if the current URL matches a chapter
            @foreach ($chapters as $chapter)
                // Check if the current URL contains the chapter and video links
                if (window.location.href.indexOf(
                        "{{ url('/courses/' . $course->id . '/chapters/' . $chapter->id . '/videos') }}") > -1) {
                    const videosList = $(`.chapter-videos[data-chapter-id="{{ $chapter->id }}"]`);
                    const arrow = $(`.chapter-title[data-chapter-id="{{ $chapter->id }}"] .chapter-arrow`);

                    // Ensure the chapter is expanded when the page URL matches
                    videosList.removeClass('max-h-0').addClass('max-h-screen');
                    arrow.addClass('rotate-180');
                }
            @endforeach
        });
    </script>
</x-layout>
