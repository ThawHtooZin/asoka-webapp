<x-layout>
    <div class="container mx-auto p-6">
        <!-- Grid layout for main content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Course Image (spans 2 columns on large screens) -->
            <div class="lg:col-span-2">
                <img src="{{ asset($course->image) }}" alt="{{ $course->name }}"
                    class="w-full h-auto rounded-lg shadow-lg" />

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
                    <p class="mb-2"><strong>Total Views:</strong> 10 </p>
                    <p class="mb-2"><strong>Rating:</strong> 5 out of 5</p>
                </div>

                {{-- Start Learning --}}
                <a href="/"
                    class="w-full inline-block text-lg px-6 py-3 mt-4 rounded-lg shadow-md bg-green-500 text-white hover:bg-green-400 hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 text-center">
                    Start Learning
                </a>



                {{-- Course Chapter Section --}}
                <div class="bg-gray-100 rounded-lg p-6 overflow-hidden mt-4 shadow-lg">
                    <h4 class="text-lg font-semibold mb-4">Course Chapters:</h4>
                    <ul class="list-disc pl-5 space-y-2">
                        {{-- Uncomment and replace with dynamic data --}}
                        {{-- @foreach ($course->chapter as $chapter) --}}
                        {{-- <li>{{ $chapter->name }}</li> --}}
                        {{-- @endforeach --}}
                        <li>Course Chapter 1</li>
                        <li>Course Chapter 2</li>
                        <li>Course Chapter 3</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-layout>
