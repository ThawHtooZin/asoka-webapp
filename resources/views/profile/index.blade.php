<x-layout>
    <div class="bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center px-52 py-10">
        <div class="space-y-3 w-full">
            <!-- User Profile Section -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="flex justify-between">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor"
                            class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                        <div>
                            <h1 class="text-2xl font-semibold text-primary ml-2">{{ $user->name }}</h1>
                            <p class="texl-xl text-primary ml-3">Joined Since
                                {{ date('Y-m-d', strtotime($user->created_at)) }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <a href="profile/edit"
                            class=" float-end py-2 px-4 bg-yellow-400 text-white font-semibold rounded-md shadow-md hover:bg-yellow-400 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-yellow-200">
                            Edit Profile
                        </a>
                    </div>
                </div>
                <div class="flex max-h-full justify-center">
                    <div
                        class="rounded-lg bg-blue-500 p-3 px-6 m-4 text-white text-center hover:bg-blue-400 duration-300">
                        <h1 class="transition-colors duration-300">Courses Owned</h1>
                        <p class="text-xl font-bold py-3">{{ $ownedCourses->count() }}</p>
                    </div>
                    <div
                        class="rounded-lg bg-blue-500 p-3 px-6 m-4 text-white text-center hover:bg-blue-400 duration-300">
                        <h1 class="transition-colors duration-300 hover:text-gray-900">Books Owned</h1>
                        <p class="text-xl font-bold py-3">{{ $ownedBooks->count() }}</p>
                    </div>

                </div>
            </div>

            <!-- Owned Courses Section -->
            <div class="bg-gray-50 py-8 px-6">
                <div class="max-w-6xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-2 border-gray-200 pb-2">
                        Your Owned Courses (Latest)
                    </h1>

                    <!-- Courses Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Single Course Card -->
                        @foreach ($ownedCourses as $course)
                            <div
                                class="bg-white rounded-lg shadow-lg overflow-hidden transform transition hover:scale-105">
                                <img src="{{ $course->course()->first()->image }}" alt="Course Name"
                                    class="w-full h-48 object-cover" />

                                <form class="p-4" method="get"
                                    action="/courses/{{ $course->course()->first()->id }}/show">
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">
                                        {{ $course->course()->first()->name }}
                                    </h3>
                                    <button
                                        class="px-2 py-1 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500"
                                        type="submit">
                                        Detail
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>



            <!-- Owned Books Section -->
            <div class="bg-gray-50 py-8 px-6">
                <div class="max-w-6xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-2 border-gray-200 pb-2">
                        Your Owned Books (Latest)
                    </h1>

                    <!-- Books Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                        <!-- Single Book Card -->
                        @foreach ($ownedBooks as $book)
                            <a href="/elibrary/book/{{ $book->book()->first()->id }}">
                                <div
                                    class="bg-white rounded-lg shadow-lg overflow-hidden transform transition hover:scale-105">
                                    <img src="{{ $book->book()->first()->cover_image }}" alt="Book Cover"
                                        class="w-full h-72 object-cover" />

                                    <div class="relative p-4">
                                        <h3
                                            class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-xl font-semibold text-white bg-black bg-opacity-60 px-4 py-2 rounded-md text-center">
                                            {{ $book->book()->first()->title }}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>


            <!-- Other Section -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-800 mb-4">Other</h1>
                <p class="text-lg text-gray-600">
                    Stay tuned for more updates and features in your dashboard. Check back often for new courses and
                    resources.
                </p>
            </div>
        </div>
    </div>
</x-layout>
