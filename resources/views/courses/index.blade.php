<x-layout>
    <style>
        /* Base styles for the button and blade effect */
        .category-blade {
            position: relative;
            overflow: hidden;
            color: inherit;
        }

        .category-blade::before {
            content: "";
            position: absolute;
            top: 0;
            left: -110%;
            width: 100%;
            height: 100%;
            background-color: #007bff;
            /* Primary color */
            transform: skewX(-20deg);
            transition: all 0.4s ease-in-out;
        }

        /* Hover effect to animate the blade flowing from left to right */
        .category-blade:hover::before {
            left: -30%;
            transition: left 0.4s ease;
        }

        /* Active category effect: show the blade by default */
        .category-blade.active-category::before {
            left: -30%;
        }

        /* Active category effect: show the blade by default */
        .category-blade.active-category span {
            color: white !important;
        }

        /* Ensure text is above the blade effect */
        .category-blade span {
            position: relative;
            z-index: 10;
        }

        /* Title Section Styles */
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            border-left: 4px solid #007bff;
            /* Primary color border */
            padding-left: 16px;
            margin-bottom: 24px;
        }
    </style>
    <div class="container mx-auto p-6 space-y-8">
        <!-- Title Section -->
        <div class="px-6">
            <a href="/" class="text-blue-800 font-bold hover:underline">Home</a> > <a href="/courses"
                class="text-blue-800 font-bold hover:underline">Courses</a>
        </div>
        <!-- Main Content: Categories and Courses -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Categories Section -->
            <div class="bg-white rounded-lg p-6 shadow-md">
                <!-- Search Input -->
                <form action="/courses" method="GET"
                    class="flex items-center mb-6 shadow-md rounded-lg overflow-hidden bg-gradient-to-r from-gray-50 to-white">
                    <input type="text" name="search" placeholder="Search for courses..."
                        class="w-full p-3 border-0 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-asokablue transition duration-300 text-sm" />
                    <button type="submit"
                        class="p-4 bg-asokablue text-white hover:bg-blue-700 transition duration-300 flex items-center justify-center rounded-r-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </form>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Categories</h3>
                <div class="flex flex-col space-y-4">
                    @foreach ($categories as $category)
                        <form action="" method="GET" class="mb-0">
                            <input type="hidden" name="category" value="{{ $category->id }}">
                            <button
                                class="capitalize category-blade relative text-left px-4 py-2 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-asokablue shadow-md hover:text-white transition duration-300 overflow-hidden w-full 
    {{ $category->id == request('category') ? 'active-category' : '' }}">
                                <span class="relative z-10">
                                    {{ $category->name }}
                                </span>
                            </button>

                        </form>
                    @endforeach
                </div>
            </div>

            <!-- Courses Section -->
            <div class="md:col-span-3">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Courses</h2>
                <div id="courses-container" class="grid gap-4 sm:grid-cols-1 md:grid-cols-2">
                    @foreach ($courses as $course)
                        <div id="course-{{ $course->course_category_id }}"
                            class="course-card bg-white p-4 rounded-md shadow-md flex flex-col h-full">
                            <!-- Content Container -->
                            <div class="flex-grow">
                                <!-- Course Image -->
                                <img src="{{ asset($course->image) }}" alt="{{ $course->name }} "
                                    class="w-full h-40 object-cover rounded-md mb-2" />

                                <h3 class="text-lg font-semibold">{{ $course->name }}</h3>
                                <p class="text-sm">Duration: {{ $course->duration }}</p>
                                <p class="text-sm">Price:
                                    @if ($course->price == 0)
                                        <span class="text-green-600">FREE</span>
                                    @else
                                        <span class="text-primary">${{ $course->price }}</span>
                                    @endif
                                </p>
                                <p class="text-sm">Rating:
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $course->rating)
                                            <span class="text-yellow-500">★</span>
                                        @else
                                            <span class="text-gray-300">★</span>
                                        @endif
                                    @endfor
                                </p>
                            </div>

                            <!-- View Details / Login Button at the Bottom -->
                            @guest
                                <a href="/login"
                                    class="mt-4 block w-full px-4 py-2 bg-asokablue text-white text-center rounded-lg hover:bg-blue-700 transition duration-300">
                                    Log in to View Details
                                </a>
                            @else
                                <a href="/courses/{{ $course->id }}/show"
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
</x-layout>
