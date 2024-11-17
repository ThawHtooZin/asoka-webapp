<x-layout>
    <div class="container mx-auto p-6 lg:px-44 md:px-24">
        <div class="-ps-32">
            <h1 class="text-5xl font-bold mb-2 roboto-slab">Announcements from <span class="text-t2">ASOKA</span></h1>
            <p class="text-lg text-gray-600">All updates for the month of {{ date('Y') }} </p>
        </div>

        @foreach ($announcements as $announcement)
            <div class="overflow-hidden p-5">
                <p class="text-gray-600">Published at {{ date('d-m-Y', strtotime($announcement->created_at)) }}</p>
                <div class=" grid grid-cols-8">
                    <div class="@if (!empty($announcement->image)) col-span-6 @else col-span-8 @endif">
                        <a href="announcement/{{ $announcement->id }}/show"
                            class="text-3xl text-primary hover:underline font-semibold">{{ $announcement->title }}</a>

                        <blockquote class="mt-2 text-xl italic text-gray-700">
                            "{{ Str::limit($announcement->content, 100, '...') }}"
                        </blockquote>
                    </div>
                    <div class="@if (!empty($announcement->image)) col-span-2 @endif">
                        @if (!empty($announcement->image))
                            <img src="{{ $announcement->image }}" alt="" class="w-96 h-40 p-3">
                        @endif
                    </div>
                </div>
            </div>

            <hr class="border-black">
        @endforeach
    </div>
</x-layout>
