<x-layout>
    {{-- Research Articles --}}
    <section class="py-16 bg-gradient-to-b from-gray-100 to-gray-300">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl sm:text-2xl md:text-3xl text-center font-bold mb-12">Research Articles</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($researcharticles as $researcharticle)
                    <div class="rounded-lg shadow-lg overflow-hidden bg-white">
                        <div class="overflow-hidden">
                            @if ($researcharticle->image != '')
                                <img src="{{ $researcharticle->image }}" alt="News image"
                                    class="w-full h-48 object-cover hover:scale-105 duration-300">
                            @else
                                <img src="https://t3.ftcdn.net/jpg/02/37/52/96/360_F_237529608_wgrqq5sgBW7wvoiRYn5pRH8MnkgwfOiR.webp"
                                    alt="News image" class="w-full h-48 object-cover hover:scale-105 duration-300">
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-sm text-gray-500 mb-2">
                                {{ date('M-d-Y', strtotime($researcharticle->created_at)) }}</p>
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 mb-2">
                                {{ $researcharticle->title }}</h2>

                            <p class="text-gray-600 text-sm md:text-base description-preview mb-2">
                                {{ Str::limit($researcharticle->description, 300) }}
                                <span class="text-blue-500 cursor-pointer read-more">Read more</span>
                            </p>

                            <p class="text-gray-600 text-sm md:text-base description-full hidden">
                                {{ $researcharticle->description }}
                                <span class="text-blue-500 cursor-pointer read-more">Read less</span>
                            </p>

                            <a href="/researcharticles/{{ $researcharticle->id }}/show"
                                class="text-blue-500 font-semibold text-sm md:text-base mt-3 block">View PDF Article >>>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // Toggle description visibility on "Read more" or "Read less" click
            $('.read-more').click(function() {
                const $this = $(this);
                const $fullDescription = $this.closest('.p-4').find('.description-full');
                const $previewDescription = $this.closest('.p-4').find('.description-preview');

                // Toggle between showing full and preview descriptions
                $fullDescription.toggleClass('hidden');
                $previewDescription.toggleClass('hidden');

                // Change text based on whether full description is shown
                if ($fullDescription.hasClass('hidden')) {
                    $this.text('Read more'); // When full text is hidden, show "Read more"
                } else {
                    $this.text('Read less'); // When full text is visible, show "Read less"
                }
            });
        });
    </script>
</x-layout>
