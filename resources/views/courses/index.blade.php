<x-layout>
    <div class="container mx-auto p-6 space-y-8">
        <!-- Search Input -->
        <form action="/courses" method="GET" class="flex items-center mb-6 shadow-lg rounded-lg overflow-hidden">
            <input type="text" name="search" placeholder="Search for courses..."
                class="w-full p-4 border-0 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-asokablue transition duration-300" />
            <button type="submit"
                class="p-4 bg-asokablue text-white hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </button>
        </form>


        <!-- Main Content: Categories and Courses -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Categories Section -->
            <div class="md:col-span-1">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Categories</h2>
                <div class="space-y-3">
                    @foreach ($categories as $category)
                        <button onclick="showCourses({{ $category->id }})"
                            class="block w-full text-left px-4 py-2 rounded-lg bg-gradient-to-r from-gray-100 to-white shadow-md hover:shadow-lg transition duration-300 hover:from-asokablue hover:to-blue-600 hover:text-white">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Courses Section -->
            <div class="md:col-span-3">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Courses</h2>
                <div id="courses-container" class="grid gap-4 sm:grid-cols-1 md:grid-cols-2">
                    @foreach ($courses as $course)
                        <div id="course-{{ $course->category_id }}"
                            class="course-card bg-white p-4 rounded-md shadow-md">
                            <!-- Course Image -->
                            <img src="{{ asset($course->image) }}" alt="{{ $course->name }}"
                                class="w-full h-40 object-cover rounded-md mb-2" />

                            <h3 class="text-lg font-semibold">{{ $course->name }}</h3>
                            <p class="text-sm">Duration: {{ $course->duration }}</p>
                            <p class="text-sm">Price: ${{ $course->price }}</p>
                            <p class="text-sm">Rating:
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $course->rating)
                                        <!-- Assuming rating is out of 5 -->
                                        <span class="text-yellow-500">★</span>
                                    @else
                                        <span class="text-gray-300">★</span>
                                    @endif
                                @endfor
                            </p>

                            @guest
                                <a href="/login"
                                    class="mt-4 block w-full px-4 py-2 bg-asokablue text-white text-center rounded-lg hover:bg-blue-700 transition duration-300">
                                    Log in to View Details
                                </a>
                            @else
                                <a href="/course/{{ $course->id }}"
                                    class="mt-4 block w-full px-4 py-2 bg-asokablue text-white text-center rounded-lg hover:bg-blue-700 transition duration-300">
                                    View Details
                                </a>
                            @endguest
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCourses(categoryId) {
            // Hide all course cards
            document.querySelectorAll('.course-card').forEach(card => {
                card.classList.add('hidden');
            });

            // Show course cards for the selected category
            document.querySelectorAll(`#course-${categoryId}`).forEach(card => {
                card.classList.remove('hidden');
            });
        }
    </script>
</x-layout>
