<x-layout>
    <div class="container mx-auto p-6 lg:px-44 md:px-24">
        <div class="mb-3">
            <a href="/" class="text-blue-800 font-bold hover:underline">Home</a> > <a href="/newsandupdate"
                class="text-blue-800 font-bold hover:underline">News and Update</a>
        </div>
        <h1 class="text-4xl font-bold mb-2 roboto-slab">News and Update from <span class="text-t2">ASOKA</span></h1>
        @foreach ($newsandupdates as $newsandupdate)
            <div class="overflow-hidden p-5">
                <p class="text-gray-600">Published at {{ date('d-m-Y', strtotime($newsandupdate->created_at)) }}.
                    {{ Carbon\Carbon::parse($newsandupdate->created_at)->diffForHumans() }}</p>
                <div class=" grid grid-cols-8">
                    <div class="@if (!empty($newsandupdate->image)) col-span-6 @else col-span-8 @endif">
                        <a href="newsandupdate/{{ $newsandupdate->id }}/show"
                            class="text-2xl text-primary hover:underline font-bold">{{ $newsandupdate->title }}</a>

                        <blockquote class="mt-2 text-lg italic text-gray-700">
                            "{{ Str::limit($newsandupdate->content, 100, '...') }}"
                        </blockquote>
                    </div>
                    <div class="@if (!empty($newsandupdate->image)) col-span-2 @endif">
                        @if (!empty($newsandupdate->image))
                            <img src="{{ $newsandupdate->image }}" alt="" class="w-96 h-40 p-3">
                        @endif
                    </div>
                </div>
            </div>

            <hr class="border-black">
        @endforeach
    </div>
</x-layout>
