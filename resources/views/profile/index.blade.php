<x-layout>
    <div class="bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center px-52 py-10">
        <div class="space-y-3 w-full">
            <!-- User Profile Section -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="flex justify-between">
                    <div class="flex">
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                            alt="" class="w-24 h-24 rounded-lg">
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
                        <h1 class="transition-colors duration-300">Courses Activity</h1>
                        <p class="text-xl font-bold py-3">{{ $Courses->count() }}</p>
                    </div>
                    <div
                        class="rounded-lg bg-blue-500 p-3 px-6 m-4 text-white text-center hover:bg-blue-400 duration-300">
                        <h1 class="transition-colors duration-300">Books Activity</h1>
                        <p class="text-xl font-bold py-3">{{ $Books->count() }}</p>
                    </div>

                </div>
            </div>

            <!-- Activity Courses Section -->
            <div class="bg-gray-50 py-8 px-6">
                <div class="max-w-6xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-2 border-gray-200 pb-2">
                        Your Courses Activity
                    </h1>

                    <!-- Courses Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Single Course Card -->
                        @foreach ($Courses as $course)
                            <a href="/courses/{{ $course->course()->first()->id }}/show">
                                <div
                                    class="bg-white rounded-lg shadow-lg overflow-hidden transform transition hover:scale-105">
                                    <img src="{{ $course->course()->first()->image }}" alt="Course Name"
                                        class="w-full h-48 object-cover" />

                                    <div class="p-3">
                                        <h3 class="text-lg font-semibold text-gray-700 mb-2">
                                            {{ $course->course()->first()->name }}
                                        </h3>
                                        <!-- Conditional Pill for Requested or Owned -->
                                        @if ($course->status == 'requested')
                                            <!-- Replace with your actual check for "requested" status -->
                                            <span
                                                class="inline-block bg-yellow-500 text-white text-xs py-1 px-3 rounded-full">
                                                Requested
                                            </span>
                                        @elseif ($course->status == 'confirmed')
                                            <!-- Replace with your actual check for "owned" status -->
                                            <span
                                                class="inline-block bg-green-500 text-white text-xs py-1 px-3 rounded-full">
                                                Owned
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>



            <!-- Activity Books Section -->
            <div class="bg-gray-50 py-8 px-6">
                <div class="max-w-6xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-2 border-gray-200 pb-2">
                        Your Books Activity
                    </h1>

                    <!-- Books Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                        <!-- Single Book Card -->
                        @foreach ($Books as $book)
                            <a href="/elibrary/book/{{ $book->book()->first()->id }}" class="relative">
                                <div
                                    class="bg-white rounded-lg shadow-lg overflow-hidden transform transition hover:scale-105">
                                    <img src="{{ $book->book()->first()->cover_image }}" alt="Book Cover"
                                        class="w-full h-72 object-cover" />

                                    <!-- Conditional Badge for Requested or Owned -->
                                    @if ($book->status == 'requested')
                                        <span
                                            class="absolute top-2 right-2 inline-block bg-yellow-500 text-white text-xs py-2 px-4 rounded-full shadow-lg">
                                            Requested
                                        </span>
                                    @elseif ($book->status == 'confirmed')
                                        <span
                                            class="absolute top-2 right-2 inline-block bg-green-500 text-white text-xs py-2 px-4 rounded-full shadow-lg">
                                            Owned
                                        </span>
                                    @endif
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
