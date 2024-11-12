<x-layout>
    <style>
        .course-card:nth-child(2) {
            transform: scale(1.1);
            transition: transform 0.3s;
        }

        .course-card:hover {
            transform: scale(1.05);
        }

        /* Ensuring a consistent typography scale */
        .section-heading {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .section-text {
            font-size: 1prem;
            color: #4a5568;
            line-height: 1.75;
        }

        .sub-heading {
            font-size: 1.5rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 1rem;
        }

        .list-item {
            font-size: 1rem;
            color: #4a5568;
        }
    </style>

    <x-banner />

    <!-- About Section -->
    <div class="container mx-auto py-12 px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 items-start px-10 sm:px-24">
            <!-- Text Section -->
            <div class="sm:col-span-3">
                <h2 class="section-heading">About ASOKA Center</h2>
                <p class="section-text">
                    ASOKA Center of Buddhist Studies offers an inspiring and transformative education grounded in the
                    rich history and teachings of Buddhism. Our center provides an environment where students can deepen
                    their understanding and practice of Buddhist wisdom.
                </p>
                <p class="section-text">
                    Our courses, retreats, and resources are designed to help individuals grow in mindfulness,
                    compassion, and ethical living. Join us in our mission to bring peace to the world through Buddhist
                    education.
                </p>
            </div>

            <!-- Image Section -->
            <div class="flex justify-center md:justify-end bg-transparent sm:row-span-2">
                <img src="/images/asokapillartransparent.png" alt="ASOKA Pillar"
                    class="transform transition-transform duration-500 hover:scale-105 w-1/2 md:w-48 lg:w-56">
            </div>
        </div>
    </div>

    <!-- Mission & Vision Section -->
    <section class="py-16 bg-gradient-to-b from-gray-50 to-gray-200">
        <div class="container mx-auto px-4 grid grid-rows-2 gap-y-8">

            <!-- Mission Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Text Content -->
                <div class="bg-white p-8 rounded-xl shadow-lg transform transition duration-300 hover:scale-105">
                    <h2 class="sub-heading text-indigo-600">Mission</h2>
                    <p class="section-text mb-6">
                        Our mission is to offer accessible Buddhist teachings that promote personal transformation,
                        ethical living, and mindfulness. We are committed to nurturing inner peace and wisdom for
                        individuals and communities alike.
                    </p>
                    <ul class="list-disc list-inside">
                        <li class="list-item">Promote inner peace and mindfulness</li>
                        <li class="list-item">Encourage ethical and compassionate living</li>
                        <li class="list-item">Support community transformation</li>
                    </ul>
                </div>
                <!-- Image -->
                <div class="flex justify-center transform transition duration-300 hover:scale-105">
                    <img src="/images/buddhatree.png" alt="Buddha Tree" class="rounded-2xl shadow-xl">
                </div>
            </div>

            <!-- Vision Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Image -->
                <div class="flex justify-center transform transition duration-300 hover:scale-105">
                    <img src="/images/buddhastatue.jpg" alt="Buddha Statue" class="rounded-2xl shadow-xl">
                </div>
                <!-- Text Content -->
                <div class="bg-white p-8 rounded-xl shadow-lg transform transition duration-300 hover:scale-105">
                    <h2 class="sub-heading text-purple-600">Vision</h2>
                    <p class="section-text mb-6">
                        Our vision is to inspire a global community to practice mindfulness, compassion, and wisdom. We
                        envision a world where these values contribute to greater harmony, understanding, and
                        interconnectedness.
                    </p>
                    <ul class="list-disc list-inside">
                        <li class="list-item">Inspire mindfulness and compassion globally</li>
                        <li class="list-item">Foster wisdom for a peaceful world</li>
                        <li class="list-item">Create a future of understanding and unity</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Courses Section --}}
    <section class="bg-gray-50 py-12 px-10 md:p-24">
        <div class="container mx-auto">
            <h2 class=" text-3xl font-bold mb-4 md:ms-20">Join Us in Our Journey</h2>
            <p class=" text-lg mb-8 md:ms-20">
                Become a part of our community and start your path toward mindfulness, peace, and wisdom today.
            </p>

            <!-- Course Slider -->
            <div class="relative">
                <div class="flex items-center justify-center overflow-hidden">
                    <!-- Course Cards (looped dynamically from $courses) -->
                    <div id="courseSlider" class="flex transition-transform duration-500 text-center">
                        @foreach ($courses as $course)
                            <div class="w-full flex-shrink-0 flex justify-center p-5 border-t-2 border-b-2">
                                <a href="{{ url('/courses/' . $course->id . '/show') }}">
                                    <div class="bg-white rounded-lg overflow-hidden shadow-lg w-[350px] md:w-[500px]">
                                        <!-- Course Image -->
                                        <div class="h-60 w-full overflow-hidden">
                                            <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image"
                                                class="object-cover w-full h-full hover:scale-105 duration-300 transition-transform">
                                        </div>
                                        <div class="p-3">
                                            <!-- Course Name as Link -->
                                            <h3 class="text-xl font-bold text-gray-800">{{ $course->name }}</h3>

                                            <!-- Course Price -->
                                            <p class="text-lg text-gray-600">
                                                {{ $course->price == 0 ? 'Free' : '$' . number_format($course->price, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button id="prevBtn"
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white text-primary rounded-full shadow-md p-4">
                    ←
                </button>
                <button id="nextBtn"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white text-primary rounded-full shadow-md p-4">
                    →
                </button>
            </div>

            <!-- Call-to-Action Button -->
            <a href="courses"
                class="mt-6 inline-block bg-white text-primary px-4 py-2 text-lg font-semibold rounded-lg shadow-md hover:bg-primary transition duration-300 hover:text-white">
                Explore Our Courses &rarr;
            </a>
        </div>
    </section>

    <script>
        const slider = document.getElementById("courseSlider");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        let currentIndex = 0;

        // Move to previous course
        prevBtn.addEventListener("click", () => {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : slider.children.length - 1;
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        });

        // Move to next course
        nextBtn.addEventListener("click", () => {
            currentIndex = (currentIndex < slider.children.length - 1) ? currentIndex + 1 : 0;
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        });
    </script>
</x-layout>
