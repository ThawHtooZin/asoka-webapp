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
                <h2 class="section-heading">About <span class="text-t5">ASOKA</span> Center of Buddhist Studies</h2>
                <p class="section-text">
                    <b>ASOKA Center of Buddhist Studies</b> offers an inspiring and transformative education grounded in
                    the
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
    <section class="py-16 bg-gradient-to-b from-gray-100 to-gray-300">
        <div class="container mx-auto px-6 lg:px-8 grid grid-rows-2 gap-y-12">

            <!-- Mission Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <!-- Text Content -->
                <div
                    class="bg-white p-8 rounded-xl shadow-2xl transform transition duration-300 hover:scale-105 hover:shadow-lg">
                    <h2 class="text-2xl font-bold text-asokablue mb-4">Mission</h2>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        To inspire individuals worldwide through the teachings of Buddhism, fostering inner peace,
                        mindfulness, and compassionate living while preserving and promoting Buddhist history, culture,
                        and spiritual practices for all generations.
                    </p>
                </div>
                <!-- Image -->
                <div class="flex justify-center transform transition duration-300 hover:scale-105 hover:rotate-1">
                    <img src="/images/buddhatree.png" alt="Buddha Tree" class="rounded-3xl shadow-2xl w-4/5">
                </div>
            </div>

            <!-- Vision Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <!-- Image -->
                <div class="flex justify-center transform transition duration-300 hover:scale-105 hover:rotate-1">
                    <img src="/images/buddhastatue.jpg" alt="Buddha Statue" class="rounded-3xl shadow-2xl w-4/5">
                </div>
                <!-- Text Content -->
                <div
                    class="bg-white p-8 rounded-xl shadow-2xl transform transition duration-300 hover:scale-105 hover:shadow-lg">
                    <h2 class="text-2xl font-bold text-asokablue mb-4">Vision</h2>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Asoka Center for Buddhist Studies is committed to providing accessible and enriching online
                        resources, including lectures, special courses, meditation courses, discussion forums, and
                        specialized programs for all age groups. We aim to nurture understanding, self-awareness, and
                        stress resilience through the timeless wisdom of Buddhism while supporting scholarly and
                        practical engagement with Buddhist history, archaeology, and philosophy.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- News and Update --}}
    <section class="py-16 bg-gradient-to-b from-gray-100 to-gray-300">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl sm:text-2gxl md:text-3xl text-center font-bold mb-12">News and Updates</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($newsandupdates as $newsandupdate)
                    <div class="rounded-lg shadow-lg overflow-hidden bg-white">
                        <div class="overflow-hidden">
                            @if ($newsandupdate->image != '')
                                <img src="{{ $newsandupdate->image }}" alt="News image"
                                    class="w-full h-48 object-cover hover:scale-105 duration-300">
                            @else
                                <img src="images/announcement.jpg" alt="News image"
                                    class="w-full h-48 object-cover hover:scale-105 duration-300">
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-sm text-gray-500 mb-2">
                                {{ Carbon\Carbon::parse($newsandupdate->created_at)->diffForHumans() }}</p>
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 mb-2">
                                {{ $newsandupdate->title }}</h2>
                            <p class="text-gray-600 text-sm md:text-base">
                                {{ Str::limit($newsandupdate->content, 100, '...') }}</p>
                            <a href="/newsandupdate/{{ $newsandupdate->id }}/show"
                                class="text-blue-500 font-semibold text-sm md:text-base mt-3 block">More details</a>
                        </div>
                    </div>
                @endforeach

                <div class="pt-6 mt-6 border-t border-gray-300 text-center">
                    <a href="/newsandupdate"
                        class="text-blue-600 font-semibold text-md sm:text-lg hover:text-blue-800 transition duration-300 transform hover:scale-105">
                        Check out more News and Announcements!
                    </a>
                </div>
            </div>
        </div>
    </section>



</x-layout>
