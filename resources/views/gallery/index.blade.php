<x-layout>
    <style>
        .overlay {
            display: none;
        }

        /* Modal styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1000;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Black with opacity */
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 8px;
            /* Rounded corners for the image */
        }

        #imageModal {
            visibility: hidden;
            opacity: 0;
        }

        #imageModal.show {
            visibility: visible;
            opacity: 1;
        }

        #closeModal:hover {
            background-color: red;
        }

        #modalImage {
            margin-left: auto;
            margin-right: auto;
            width: 70%;
            height: 600px;
            object-fit: cover;
        }

        .image-item {
            box-shadow: 2px 2px 2px red;
        }
    </style>


    <div class="px-[9rem] py-[1rem]">
        {{-- <h1 class="text-2xl font-semibold font-serif text-center">Image Gallery</h1> --}}
        <div class="mt-4">
            <!-- Filter Options -->
            <div class="flex">
                <button class="filter-btn text-md font-semibold p-2 px-4 text-t3 active" data-filter="all">All</button>
                <button class="filter-btn text-md font-semibold p-2 px-4 text-t3" data-filter="တောင်ငူ">တောင်ငူ
                    ရေဘေးအလှူတော်</button>
                <button class="filter-btn text-md font-semibold p-2 px-4 text-t3" data-filter="အင်းလေး">အင်းလေး
                    ရေဘေးအလှူတော်</button>
            </div>

            <!-- Image Grid -->
            <div
                class="image-gallery grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-x-10 gap-y-7 overflow-hidden pt-4 p-3">
                <div class="col-span-4 image-item category-header mb-2 တောင်ငူ hidden" style="box-shadow: none;">
                    <h1 class="text-md text-t1">တောင်ငူရေဘေးအလှူတော်</h1>
                </div>
                <div class="col-span-4 image-item category-header mb-2 အင်းလေး hidden" style="box-shadow: none;">
                    <h1 class="text-md text-t1">အင်းလေးရေဘေးအလှူတော်</h1>
                </div>
                <!-- Image Item -->
                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden တောင်ငူ">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/one/1.png"
                            alt="တောင်ငူ 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden တောင်ငူ">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/one/2.png"
                            alt="တောင်ငူ 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden တောင်ငူ">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/one/3.png"
                            alt="တောင်ငူ 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden တောင်ငူ">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/one/1.png"
                            alt="တောင်ငူ 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden တောင်ငူ">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/one/2.png"
                            alt="တောင်ငူ 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden တောင်ငူ">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/one/2.png"
                            alt="တောင်ငူ 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden တောင်ငူ">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/one/1.png"
                            alt="တောင်ငူ 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden တောင်ငူ">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/one/2.png"
                            alt="တောင်ငူ 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                {{-- ------------------------ Inn Lay ------------------------ --}}

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden အင်းလေး">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/two/1.png"
                            alt="အင်းလေး 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden အင်းလေး">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/two/2.png"
                            alt="အင်းလေး 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden အင်းလေး">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/two/3.png"
                            alt="အင်းလေး 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden အင်းလေး">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300" src="/images/slide/two/1.png"
                            alt="အင်းလေး 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden အင်းလေး">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300"
                            src="/images/slide/two/2.png" alt="အင်းလေး 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden အင်းလေး">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300"
                            src="/images/slide/two/2.png" alt="အင်းလေး 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden အင်းလေး">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300"
                            src="/images/slide/two/1.png" alt="အင်းလေး 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div class="image-item border-4 border-warning p-2 rounded-lg overflow-hidden အင်းလေး">
                    <div class="relative">
                        <img class="h-[100%] cursor-pointer hover:scale-110 duration-300"
                            src="/images/slide/two/2.png" alt="အင်းလေး 1">
                        <!-- Overlay -->
                        <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <button class="close text-white text-lg p-4 bg-red-500 rounded-full">X</button>
                        </div>
                    </div>
                </div>

                <div>

                </div>
            </div>
        </div>
    </div>

    <!-- Full Image Modal -->
    <div id="imageModal" class="modal">
        <img id="modalImage" src="" alt="Full Image" class="rounded-lg shadow-lg">
        <button id="closeModal" class="rounded-full">&times;</button>
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
