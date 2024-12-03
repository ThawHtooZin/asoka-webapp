<x-layout>
    <style>
        .overlay {
            display: none;
        }

        .image-item {
            box-shadow: 2px 2px 2px red;
        }

        .image-item img {
            height: 180px;
        }
    </style>


    <div class="px-[9rem] py-[1rem]">
        {{-- <h1 class="text-2xl font-semibold font-serif text-center">Image Gallery</h1> --}}
        <div class="mt-4">
            <!-- Filter Options -->
            <div class="flex gap-2">
                {{-- <button class="filter-btn text-md font-semibold p-2 px-4 text-t3 active" data-filter="all">All</button> --}}
                <button
                    class="filter-btn text-md font-semibold p-2 px-4 active:bg-white duration-300 hover:bg-red-100 text-t3 border-2 border-red-400 rounded-lg"
                    data-filter="တောင်ငူ">တောင်ငူ
                    ရေဘေးအလှူတော်</button>
                <button
                    class="filter-btn text-md font-semibold p-2 px-4 active:bg-white duration-300 hover:bg-red-100 text-t3 border-2 border-red-400 rounded-lg"
                    data-filter="အင်းလေး">အင်းလေး
                    ရေဘေးအလှူတော်</button>
            </div>

            <!-- Image Grid -->
            <div
                class="image-gallery grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-x-10 gap-y-7 overflow-hidden pt-4 p-3">
                <div class="col-span-4 image-item category-header mb-2 တောင်ငူ" style="box-shadow: none;">
                    <h1 class="text-md text-t1">တောင်ငူရေဘေးအလှူတော်</h1>
                </div>
                <div class="col-span-4 image-item category-header mb-2 အင်းလေး hidden" style="box-shadow: none;">
                    <h1 class="text-md text-t1">အင်းလေးရေဘေးအလှူတော်</h1>
                </div>

                @php
                    $taunggus = [
                        ['image' => '/images/slide/one/1.png'],
                        ['image' => '/images/slide/one/2.png'],
                        ['image' => '/images/slide/one/3.png'],
                        ['image' => '/images/slide/one/4.png'],
                        ['image' => '/images/slide/one/5.png'],
                        ['image' => '/images/slide/one/6.png'],
                        ['image' => '/images/slide/one/7.png'],
                        ['image' => '/images/slide/one/8.png'],
                        ['image' => '/images/slide/one/9.png'],
                        ['image' => '/images/slide/one/10.png'],
                        ['image' => '/images/slide/one/11.png'],
                        ['image' => '/images/slide/one/12.png'],
                        ['image' => '/images/slide/one/13.png'],
                        ['image' => '/images/slide/one/14.png'],
                        ['image' => '/images/slide/one/15.png'],
                        ['image' => '/images/slide/one/16.png'],
                        ['image' => '/images/slide/one/17.png'],
                        ['image' => '/images/slide/one/18.png'],
                        ['image' => '/images/slide/one/19.png'],
                        ['image' => '/images/slide/one/20.png'],
                        ['image' => '/images/slide/one/21.png'],
                        ['image' => '/images/slide/one/22.png'],
                        ['image' => '/images/slide/one/23.png'],
                        ['image' => '/images/slide/one/24.png'],
                        ['image' => '/images/slide/one/25.png'],
                        ['image' => '/images/slide/one/26.png'],
                        ['image' => '/images/slide/one/27.png'],
                        ['image' => '/images/slide/one/28.png'],
                        ['image' => '/images/slide/one/29.png'],
                        ['image' => '/images/slide/one/30.png'],
                        ['image' => '/images/slide/one/31.png'],
                        ['image' => '/images/slide/one/32.png'],
                        ['image' => '/images/slide/one/33.png'],
                    ];
                @endphp

                @foreach ($taunggus as $taunggu)
                    <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden တောင်ငူ">
                        <div class="relative">
                            <img class="h-[100%] cursor-pointer hover:scale-110 duration-300"
                                src="{{ $taunggu['image'] }}" alt="တောင်ငူ 1">
                            <!-- Overlay -->
                            <div
                                class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- ------------------------ Inn Lay ------------------------ --}}
                @php
                    $innlays = [
                        ['image' => '/images/slide/two/1.jpg'],
                        ['image' => '/images/slide/two/2.jpg'],
                        ['image' => '/images/slide/two/3.jpg'],
                        ['image' => '/images/slide/two/4.jpg'],
                        ['image' => '/images/slide/two/5.jpg'],
                        ['image' => '/images/slide/two/6.jpg'],
                        ['image' => '/images/slide/two/7.jpg'],
                        ['image' => '/images/slide/two/8.jpg'],
                        ['image' => '/images/slide/two/9.jpg'],
                        ['image' => '/images/slide/two/10.jpg'],
                        ['image' => '/images/slide/two/11.jpg'],
                        ['image' => '/images/slide/two/12.jpg'],
                        ['image' => '/images/slide/two/13.jpg'],
                        ['image' => '/images/slide/two/14.jpg'],
                        ['image' => '/images/slide/two/15.jpg'],
                        ['image' => '/images/slide/two/16.jpg'],
                        ['image' => '/images/slide/two/17.jpg'],
                        ['image' => '/images/slide/two/18.jpg'],
                        ['image' => '/images/slide/two/19.jpg'],
                        ['image' => '/images/slide/two/20.jpg'],
                        ['image' => '/images/slide/two/21.jpg'],
                        ['image' => '/images/slide/two/22.jpg'],
                        ['image' => '/images/slide/two/23.jpg'],
                        ['image' => '/images/slide/two/24.jpg'],
                        ['image' => '/images/slide/two/25.jpg'],
                        ['image' => '/images/slide/two/26.jpg'],
                        ['image' => '/images/slide/two/27.jpg'],
                        ['image' => '/images/slide/two/28.jpg'],
                        ['image' => '/images/slide/two/29.jpg'],
                        ['image' => '/images/slide/two/30.jpg'],
                        ['image' => '/images/slide/two/31.jpg'],
                        ['image' => '/images/slide/two/32.jpg'],
                        ['image' => '/images/slide/two/33.jpg'],
                        ['image' => '/images/slide/two/34.jpg'],
                        ['image' => '/images/slide/two/35.jpg'],
                        ['image' => '/images/slide/two/36.jpg'],
                        ['image' => '/images/slide/two/37.jpg'],
                        ['image' => '/images/slide/two/38.jpg'],
                        ['image' => '/images/slide/two/39.jpg'],
                        ['image' => '/images/slide/two/40.jpg'],
                    ];
                @endphp
                @foreach ($innlays as $innlay)
                    <div class="image-item p-2 rounded-lg overflow-hidden အင်းလေး hidden" style="box-shadow: none;">
                        <div class="relative">
                            <img class="h-[100%] cursor-pointer hover:scale-125 duration-300"
                                src="{{ $innlay['image'] }}" alt="အင်းလေး 1">
                            <!-- Overlay -->
                            <div
                                class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            </div>
                        </div>
                    </div>
                @endforeach

                <div>

                </div>
            </div>
        </div>
    </div>

    <!-- Full Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 justify-center items-center z-50 hidden">
        <div class="bg-blue-100 p-3 rounded-lg max-w-[55rem] mx-auto my-14 w-full">
            <img id="modalImage" src="" alt="Full Image" class="rounded-lg shadow-lg w-full h-auto">
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('.image-item img').on('load', function() {
                $(this).addClass('loaded'); // Add a class when loaded
            }).each(function() {
                if (this.complete) $(this).addClass('loaded');
            });

            // Show full image modal when image is clicked
            $('.image-item img').click(function() {
                const imgSrc = $(this).attr('src'); // Get the image source
                $('#modalImage').attr('src', imgSrc); // Set the full image in the modal
                $('#imageModal').fadeIn().addClass('show'); // Show the modal with fade-in effect
            });

            // Close modal when the close button is clicked
            $('#closeModal').click(function() {
                $('#imageModal').fadeOut().removeClass('show'); // Hide the modal
            });

            // Close modal when clicked outside the image (on the overlay)
            $('#imageModal').click(function(e) {
                if ($(e.target).is('#imageModal')) {
                    $('#imageModal').fadeOut().removeClass('show'); // Hide the modal if overlay is clicked
                }
            });

            // Filter images by category
            $('.filter-btn').click(function() {
                const filter = $(this).data('filter');
                if (filter === 'all') {
                    $('.image-item').fadeIn();
                    $('.category-header').hide();
                } else {
                    $('.image-item').not(`.${filter}`).fadeOut();
                    $(`.${filter}`).fadeIn();
                }
                // Toggle active class on filter buttons
                $(this).addClass('active').siblings().removeClass('active');
            });
        });
        $(document).keyup(function(e) {
            if (e.key === "Escape" && $('#imageModal').hasClass('show')) {
                $('#imageModal').fadeOut().removeClass('show');
            }
        });
    </script>
</x-layout>
