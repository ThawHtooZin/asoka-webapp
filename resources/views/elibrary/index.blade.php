<x-layout>
    <div class="container mx-auto p-6 space-y-8">
        <div class="px-6">
            <a href="/" class="text-blue-800 font-bold hover:underline">Home</a> > <a href="/elibrary"
                class="text-blue-800 font-bold hover:underline">Elibrary</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            @foreach ($books as $book)
                <a href="/elibrary/book/{{ $book->id }}">
                    <div class="border-2 border-primary p-5 text-center">
                        <img src="{{ asset($book->cover_image) }}" alt=""
                            class="mx-auto w-32 h-48 duration-300 hover:scale-105">
                        <p class="mt-2">{{ $book->title }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-layout>
