<x-layout>
    <style>
        .marquee-container {
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 300px;
            /* Adjust as needed */
            background-color: #f3f3f3;
        }

        .marquee {
            display: flex;
            animation: scroll 75s linear infinite;
            width: max-content;
            /* Ensures a smooth infinite effect */
        }

        .marquee:hover {
            animation-play-state: paused;
        }

        .marquee-image {
            width: 400px;
            /* Image width */
            height: auto;
            margin-right: 10px;
            cursor: pointer;
        }

        @keyframes scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        /* Modal styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .hidden {
            display: none;
        }

        .modal-content {
            background: #fff;
            border-radius: 8px;
            text-align: center;
            position: relative;
        }

        .modal-content img {
            width: 700px;
            height: auto;
            border-radius: 8px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
    <div class=" py-10">
        <h1 class="text-center text-4xl font-serif text-primary">Gallery of ASOKA</h1>

        <div class="marquee-container">
            <div class="marquee">
                <img src="/images/Slide/one/1.png" alt="Image 1" class="marquee-image">
                <img src="/images/Slide/one/2.png" alt="Image 2" class="marquee-image">
                <img src="/images/Slide/one/3.png" alt="Image 3" class="marquee-image">
                <img src="/images/Slide/two/1.png" alt="Image 1" class="marquee-image">
                <img src="/images/Slide/two/2.png" alt="Image 2" class="marquee-image">
                <img src="/images/Slide/two/3.png" alt="Image 3" class="marquee-image">
            </div>
        </div>

        <!-- Modal -->
        <div id="imageModal" class="modal hidden">
            <div class="modal-content">
                <span class="close"></span>
                <img id="modalImage" src="" alt="Selected Image">
                <p id="modalInfo"></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const marquee = document.querySelector(".marquee");

            // Duplicate images for seamless looping
            const images = [...marquee.children];
            images.forEach((img) => {
                const clone = img.cloneNode(true);
                marquee.appendChild(clone);
            });

            const modal = document.getElementById("imageModal");
            const modalImage = document.getElementById("modalImage");
            const closeModal = modal.querySelector(".close");

            // Image click event for modal
            document.querySelectorAll(".marquee-image").forEach((img) => {
                img.addEventListener("click", () => {
                    modalImage.src = img.src;
                    modal.classList.remove("hidden");
                });
            });

            // Close modal
            closeModal.addEventListener("click", () => {
                modal.classList.add("hidden");
            });

            // Close modal by clicking outside
            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.classList.add("hidden");
                }
            });
        });
    </script>
</x-layout>
