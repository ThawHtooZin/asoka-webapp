<x-layout>
    <div class="py-12 text-white">
        <div class="max-w-6xl mx-auto p-6 bg-gradient-to-br from-gray-900 to-gray-600 rounded-lg shadow-2xl">
            <!-- Breadcrumbs -->
            <div class="text-sm text-blue-400 mb-4">
                <a href="/" class="hover:underline">Asoka </a> / <a href="/announcement"
                    class="hover:underline">Announcements</a>
            </div>

            <div class="flex flex-col md:flex-row md:items-start gap-8">
                <!-- Text Section -->
                <div class="@if (!empty($announcement->image)) md:w-2/3 @else md:w-full @endif mx-auto">
                    <h1 class="text-4xl font-extrabold mb-4 tracking-tight leading-tight text-center">
                        {{ $announcement->title }}</h1>
                    <p class="text-blue-500 font-semibold mb-2 text-center">{{ $announcement->by }}</p>
                    <pre class="font-sans text-base font-normal whitespace-pre-wrap text-gray-200 mb-6 text-center">{{ $announcement->content }}</pre>
                    <!-- Optional Date and Tags -->
                    <p class="text-sm text-gray-500 text-center">{{ date('M', strtotime($announcement->created_at)) }}
                        {{ date('d', strtotime($announcement->created_at)) }},
                        {{ date('Y', strtotime($announcement->created_at)) }}</p>
                </div>

                <!-- Image Section -->
                <div class="@if (!empty($announcement->image)) md:w-1/3 @endif">
                    <div class="relative overflow-hidden rounded-lg shadow-lg">
                        @if (!empty($announcement->image))
                            <a href="{{ $announcement->image }}" target="_blank">
                                <img src="{{ $announcement->image }}" alt="Announcement Image"
                                    class="w-full transition duration-300 transform hover:scale-125 hover:shadow-2xl">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
