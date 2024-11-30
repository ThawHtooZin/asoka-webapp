<x-layout>
    <div class="py-12 text-white">
        <div
            class="max-w-6xl mx-auto p-14 bg-gradient-to-r from-blue-100 via-indigo-100 to-blue-200 rounded-lg shadow-2xl">
            <!-- Breadcrumbs -->
            <div class="grid grid-cols-2">
                <div class="text-sm text-blue-400 mb-4">
                    <a href="/" class="hover:underline">Asoka </a> / <a href="/newsandupdate"
                        class="hover:underline">News
                        and Update</a>
                </div>
                <div class="text-gray-800 text-right">
                    Published {{ Carbon\Carbon::parse($newsandupdate->created_at)->diffForHumans() }}
                </div>
            </div>

            <div>
                <h1
                    class="text-4xl font-extrabold mb-10 tracking-tight leading-tight text-gray-800 @if (empty($newsandupdate->image)) text-center @endif ">
                    {{ $newsandupdate->title }}</h1>
            </div>
            <div class="flex flex-col md:flex-row md:items-start gap-8">
                <!-- Text Section -->
                <div class="@if (!empty($newsandupdate->image)) md:w-2/3 @else md:w-full @endif mx-auto">
                    <div class="@if (empty($newsandupdate->image)) text-center @endif ">
                        <p class="text-blue-500 font-semibold mb-2">{{ $newsandupdate->by }}</p>
                        <pre class="font-sans text-base font-normal whitespace-pre-wrap text-gray-800 mb-6 ">{{ $newsandupdate->content }}</pre>
                    </div>
                </div>

                <!-- Image Section -->
                <div class="@if (!empty($newsandupdate->image)) md:w-1/3 @endif">
                    <div class="relative overflow-hidden rounded-lg shadow-lg">
                        @if (!empty($newsandupdate->image))
                            <a href="{{ $newsandupdate->image }}" target="_blank">
                                <img src="{{ $newsandupdate->image }}" alt="News and Update Image"
                                    class="w-full transition duration-300 transform hover:scale-125 hover:shadow-2xl">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <p class="text-sm text-gray-500 text-center">
                {{ date('M d, Y', strtotime($newsandupdate->created_at)) }}
            </p>
        </div>
    </div>
</x-layout>
