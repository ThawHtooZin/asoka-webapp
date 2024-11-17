<x-layout>
    <div class="container mx-auto p-6">
        <!-- Grid layout for main content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Course Image (spans 2 columns on large screens) -->
            <div class="lg:col-span-2">
                <div class="relative w-full h-[400px]">
                    <img src="{{ asset($course->image) }}" alt="{{ $course->name }}"
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 object-contain max-w-full max-h-full" />
                </div>

                <!-- Description Section -->
                <div class="border-4 border-gray-200 rounded-lg p-6 overflow-hidden lg:col-span-2 mt-4">
                    <h3 class="text-xl font-semibold mb-4">Description</h3>
                    <p class="text-gray-700 break-words">{{ $course->description }}</p>
                </div>
            </div>

            <div>
                <!-- About Course Section -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-semibold mb-4">About Course</h2>
                    <p class="mb-2"><strong>Name:</strong> {{ $course->name }}</p>
                    <p class="mb-2"><strong>People Enrolled:</strong> {{ $course->enrolled }}</p>
                    <p class="mb-2"><strong>Duration:</strong> {{ $course->duration }}</p>
                    <p class="mb-2 text-green-500"><strong>Price:</strong>
                        @if ($course->price == 0)
                            {{ 'FREE' }}
                        @else
                            ${{ $course->price }}
                        @endif
                    </p>
                </div>

                {{-- Start Learning --}}
                @if (!empty($chapters))
                    @if ($course->price == 0)
                        <a href="/courses/{{ $course->id }}/chapters/<?php if (!empty($chapters[0])) {
                            echo $chapters[0]->id;
                        } else {
                            echo 0;
                        } ?>/videos/<?php if (!empty($video->id)) {
                            echo $video->id;
                        } else {
                            echo 0;
                        } ?>"
                            class="w-full inline-block text-lg px-6 py-3 mt-4 rounded-lg shadow-md bg-green-500 text-white hover:bg-green-400 hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 text-center">
                            Start Learning
                        </a>
                    @else
                        @if (!empty($course->purchased()->first()->status) && $course->purchased()->first()->status == 'confirmed')
                            <a href="/courses/{{ $course->id }}/chapters/<?php if (!empty($chapters[0])) {
                                echo $chapters[0]->id;
                            } else {
                                echo 0;
                            } ?>/videos/<?php if (!empty($video->id)) {
                                echo $video->id;
                            } else {
                                echo 0;
                            } ?>"
                                class="w-full inline-block text-lg px-6 py-3 mt-4 rounded-lg shadow-md bg-green-500 text-white hover:bg-green-400 hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 text-center">
                                Start Learning
                            </a>
                        @elseif(!empty($course->purchased()->first()->status) && $course->purchased()->first()->status == 'requested')
                            <a href="#"
                                class="w-full inline-block text-lg px-6 py-3 mt-4 rounded-lg shadow-md bg-yellow-400 text-white hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 text-center">
                                Requested
                            </a>
                        @else
                            <a href="/courses/{{ $course->id }}/buy"
                                class="w-full inline-block text-lg px-6 py-3 mt-4 rounded-lg shadow-md bg-primary text-white hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 text-center">
                                Start Learning
                            </a>
                        @endif
                    @endif
                @else
                    <a href="/courses/{{ $course->id }}/buy"
                        class="w-full inline-block text-lg px-6 py-3 mt-4 rounded-lg shadow-md bg-primary text-white hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 text-center">
                        Start Learning
                    </a>
                @endif




                {{-- Course Chapter Section --}}
                <div class="bg-gray-100 rounded-lg p-6 overflow-hidden mt-4 shadow-lg">
                    <h4 class="text-lg font-semibold mb-4">Course Chapters:</h4>
                    <ul class="space-y-4">
                        @if (!empty($chapters))
                            @foreach ($chapters as $chapter)
                                <li class="border-2 bg-white rounded-lg overflow-hidden">
                                    <div class="flex justify-between items-center p-4 cursor-pointer chapter-title"
                                        data-chapter-id="{{ $chapter->id }}">
                                        <h3 class="text-lg font-medium">{{ $chapter->title }}</h3>
                                        <span class="transition-transform transform chapter-arrow">&#9660;</span>
                                        <!-- Down arrow for toggle -->
                                    </div>
                                    <ul class="space-y-2 max-h-0 overflow-hidden transition-all duration-500 ease-in-out chapter-videos"
                                        data-chapter-id="{{ $chapter->id }}">
                                        @foreach ($chapter->videos as $video)
                                            <li class="px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200">
                                                {{ $video->title }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>

    @if (session('score'))
        <div class="flex justify-center items-center min-h-screen bg-gray-800 bg-opacity-50 fixed inset-0 z-50">
            <div class="bg-blue-600 text-white p-8 rounded-xl shadow-lg text-center max-w-xl w-full">
                <h2 class="text-3xl font-bold mb-4">Course Completed!</h2>
                <p class="text-lg mb-6">Congratulations! You have completed the quiz with a score of:</p>
                <div class="text-4xl font-extrabold text-yellow-400 mb-6">{{ session('score') }} /
                    {{ session('totalQuestions') }}</div>
                <p class="text-lg">Well done on your performance! Keep going!</p>
                <div class="mt-8">
                    <a href="{{ route('course.show', ['id' => $course]) }}"
                        class="text-white hover:text-gray-200 underline text-lg">Return to Course</a>
                </div>
            </div>
        </div>
    @endif

    <script>
        $(document).ready(function() {
            // Toggle the visibility of chapter videos when the chapter title is clicked
            $('.chapter-title').on('click', function() {
                const chapterId = $(this).data('chapter-id');
                const videosList = $(`.chapter-videos[data-chapter-id="${chapterId}"]`);
                const arrow = $(this).find('.chapter-arrow');

                // Toggle visibility of the videos list and rotate the arrow
                videosList.toggleClass('max-h-0 max-h-screen');
                arrow.toggleClass('rotate-180');
            });
        });
    </script>
</x-layout>
