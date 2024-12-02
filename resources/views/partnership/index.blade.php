<x-layout>
    <style>
        .glowing-text {
            font-size: 3rem;
            /* Adjust text size */
            font-weight: bold;
            position: relative;
            display: inline-block;
            text-transform: uppercase;
            background-image: linear-gradient(90deg, transparent, white, transparent);
            background-size: 200%;
            /* Makes the animation noticeable */
            -webkit-background-clip: text;
            /* Clips background to text only */
            -webkit-text-fill-color: transparent;
            /* Hides text color */
            animation: glowingEffect 3s linear infinite;
        }

        @keyframes glowingEffect {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }
    </style>
    <section class="bg-gradient-to-r from-gray-100 via-blue-50 to-gray-100 py-16 px-10 md:24 xl:px-32"
        style="background-image: url('images/waves/wave3.png'); background-repeat: no-repeat; background-size: cover">
        <!-- Partnership Benefits Section -->
        <div class="container mx-auto text-center">
            <h2 class="text-5xl font-bold text-white mb-6 glowing-text">Our Esteemed Partners</h2>
            <p class="text-lg text-gray-300 mb-12">We're proud to collaborate with industry leaders to
                create innovative solutions.</p>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Benefit 1 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="text-6xl text-primary mb-4"><img class="h-24 mx-auto"
                            src="/images/partnership/anadagayunar.jpg" alt="">
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-800">Ananda Kaurna Association</h3>
                    <p class="text-gray-600 mt-4">The Ananda Kaurna Association, led by Prof. Dr. Saw Htut Sandar,
                        promotes Buddhist values, supports monks, aids disaster relief, and fosters compassion and
                        social welfare.</p>
                    <a href="/" class="text-primary text-center hover:underline">View more</a>
                </div>
                <!-- Benefit 2 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="text-6xl text-primary mb-4">🤝</div>
                    <h3 class="text-2xl font-semibold text-gray-800">Collaborative Success</h3>
                    <p class="text-gray-600 mt-4">Work together with us to create impactful, long-term results.</p>
                </div>
                <!-- Benefit 3 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="text-6xl text-primary mb-4">🌍</div>
                    <h3 class="text-2xl font-semibold text-gray-800">Global Exposure</h3>
                    <p class="text-gray-600 mt-4">Reach a broader audience through our international presence.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-r from-gray-100 via-blue-50 to-gray-100 py-16 px-10 md:24 xl:px-32">
        <!-- Partnership Benefits Section -->
        <div class="container mx-auto text-center">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">Why Partner with Us?</h2>
            <p class="text-lg text-gray-700 mb-12">Join a network of like-minded organizations and benefit from shared
                growth and success.</p>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Benefit 1 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="text-6xl text-primary mb-4">📈</div>
                    <h3 class="text-2xl font-semibold text-gray-800">Growth Opportunities</h3>
                    <p class="text-gray-600 mt-4">Leverage our network and resources to reach new heights.</p>
                </div>
                <!-- Benefit 2 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="text-6xl text-primary mb-4">🤝</div>
                    <h3 class="text-2xl font-semibold text-gray-800">Collaborative Success</h3>
                    <p class="text-gray-600 mt-4">Work together with us to create impactful, long-term results.</p>
                </div>
                <!-- Benefit 3 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="text-6xl text-primary mb-4">🌍</div>
                    <h3 class="text-2xl font-semibold text-gray-800">Global Exposure</h3>
                    <p class="text-gray-600 mt-4">Reach a broader audience through our international presence.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Partners --}}
    {{-- <section class="py-16 bg-gradient-to-r from-gray-100 via-blue-50 to-gray-100 px-10 md:24 xl:px-32">
        <div class="container mx-auto">
            <h2 class="text-5xl font-bold text-gray-900 mb-8 text-center">Our Esteemed Partners</h2>
            <p class="text-lg text-gray-700 mb-12 text-center">We're proud to collaborate with industry leaders to
                create innovative solutions.</p>

            <!-- Partners Logos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                <!-- Partner 1 -->
                <div
                    class="flex justify-center items-center p-5 py-14 hover:scale-105 transition-transform duration-300 bg-white rounded-lg">
                    <div
                        class="grid grid-cols-1 lg:grid-cols-2 gap-3 transition duration-300 ease-in-out transform grayscale hover:grayscale-0">
                        <!-- Image Section -->
                        <div class="text-center mx-auto">
                            <img src="/images/partnership/anadagayunar.jpg" alt="Partner Logo"
                                class="h-28 object-contain">
                        </div>
                        <!-- Text Section -->
                        <div class="text-center mx-auto">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut doloremque consectetur minus
                                aperiam quidem totam, recusandae architecto nesciunt molestiae explicabo.</p>
                        </div>
                    </div>
                </div>
            </div>
    </section> --}}
</x-layout>
