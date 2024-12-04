<x-layout>
    <style>
        /* Base Button Styles */
        .custom-btn {
            color: white;
            font-medium;
            padding: 10px 40px;
            border: none;
            border-radius: 8px;
            /* Rounded corners */
            display: inline-block;
            text-align: center;
            cursor: pointer;
            background-size: 300% 300%;
            /* For gradient animation */
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            /* Smooth transform */
        }



        /* Phone Button Gradient */
        .phone-btn {
            background: linear-gradient(45deg, #28a745, #5fd067);
            /* Green theme */
            animation: gradient-hover 4s ease infinite;
            /* Loop animation */
        }

        .phone-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Email Button Gradient */
        .email-btn {
            background: linear-gradient(45deg, #ff6b6b, #ff8787);
            /* Red theme */
            animation: gradient-hover 4s ease infinite;
        }

        .email-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Facebook Button Gradient */
        .facebook-btn {
            background: linear-gradient(45deg, #1877f2, #4097f9);
            /* Facebook blue theme */
            animation: gradient-hover 4s ease infinite;
        }

        .facebook-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Messenger Button Gradient */
        .messenger-btn {
            background: linear-gradient(45deg, #006aff, #ff47c0);
            /* Messenger theme */
            animation: gradient-hover 4s ease infinite;
        }

        .messenger-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
    <div class="md:px-[5rem] lg:px-[15rem]">
        <div class="min-h-screen">
            <!-- Header Section -->
            <header class="bg-white shadow pb-72 md:pb-36">
                <div class="relative">
                    <!-- Cover Photo -->
                    <img src="/images/lotus-transformed.jpeg" alt="Cover Photo"
                        class="w-full h-[13rem] md:h-[15rem] object-cover">

                    <!-- Profile Picture and Info -->
                    <div
                        class="absolute bottom-[-17rem] md:bottom-[-9rem] left-1/2 transform -translate-x-1/2 md:left-10 md:translate-x-0 flex flex-col md:flex-row items-center md:items-start text-center md:text-left">
                        <!-- Profile Picture -->
                        <img src="/images/partnership/anadagayunar.jpg" alt="Profile Pic"
                            class="w-36 h-36 md:w-44 md:h-44 rounded-full border-4 border-white shadow-lg">

                        <!-- Title and Bio -->
                        <div class="mt-4 md:mt-20 md:ml-6">
                            <!-- Page Title -->
                            <h1 class="text-xl md:text-3xl font-bold text-gray-800">Patrons of Buddha Sasana
                            </h1>

                            <!-- Bio -->
                            <span class="text-gray-600 text-md md:text-lg block">ပရဟိတ အသင်း</span>

                            <div class="flex gap-4 mt-5 mb-3">
                                <a href="#" class="custom-btn phone-btn">
                                    <i class="mr-0 md:mr-3 fa-solid fa-phone"></i>Phone
                                </a>
                                <a href="#" class="custom-btn email-btn">
                                    <i class="mr-0 md:mr-3 fa-solid fa-envelope"></i>Email
                                </a>
                                <a href="#" class="custom-btn facebook-btn">
                                    <i class="mr-0 md:mr-3 fab fa-facebook"></i>Facebook
                                </a>
                                <a href="#" class="custom-btn messenger-btn">
                                    <i class="mr-0 md:mr-3 fab fa-facebook-messenger"></i>Messenger
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="p-6 mt-6 border-2 border-gray-300 rounded-lg shadow-md bg-white">
                <h3 class="text-xl font-bold mb-4 text-primary border-b-2 border-primary/60 inline-block">About Patrons
                    of Buddha Sasana</h3>
                <p class="text-gray-600 leading-relaxed">
                    The Ananda Kaurna Association, also known as the "Patrons of Buddha Sasana", is a dedicated
                    organization chaired by Prof. Dr. Saw Htut Sandar. The association unites a team of compassionate
                    individuals committed to promoting social welfare and upholding Buddhist values. The leadership
                    includes Daw Mie Mie Han as the Vice Chairperson, fostering effective collaboration among members.
                    The General Secretaries, Daw Khin Lay Lwin and Daw Hnin Nwe Aung, manage the association's
                    administrative and operational tasks, while the Treasurers, Daw Khin Lapyae Win, are responsible for
                    the financial aspects. Additionally, the association is enriched by the guidance and wisdom of the
                    Honorable Leaders, Ven. Candavara, Ven. Vicitta, Ven. Acara, and Ven. Addica Vamsa.
                    <br><br>
                    The main mission of the Ananda Kaurna Association is to act as a patron for the Buddha Sasana by
                    supporting venerable monks and promoting the practice of Dhamma. The association also extends its
                    compassionate efforts to disaster relief in Myanmar, offering aid to victims and alleviating their
                    suffering during challenging times. This spirit of kindness and community service reflects the
                    association’s commitment to fostering harmony and compassion in society.
                </p>
            </div>

            <div class="p-6 mt-6 mb-6 border-2 border-gray-300 rounded-lg shadow-md bg-white">
                <h3 class="text-xl font-bold mb-4 text-primary border-b-2 border-primary/60 inline-block">Collaborative
                    Efforts with Patrons of Buddha Sasana
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="/images/Slide/one/1.png" target="__blank">
                        <img src="/images/Slide/one/1.png" alt="Image 1"
                            class="w-full h-48 object-cover rounded-md shadow-lg">
                    </a>
                    <a href="/images/Slide/one/27.png" target="__blank">
                        <img src="/images/Slide/one/27.png" alt="Image 2"
                            class="w-full h-48 object-cover rounded-md shadow-lg">
                    </a>
                    <a href="/images/Slide/one/20.png" target="__blank">
                        <img src="/images/Slide/one/20.png" alt="Image 2"
                            class="w-full h-48 object-cover rounded-md shadow-lg">
                    </a>
                </div>
                <div class="text-center mt-3">
                    <a href="/gallery"
                        class="text-blue-600 font-semibold text-md sm:text-lg hover:text-blue-800 transition duration-300 transform hover:scale-105">
                        Check Out Gallery
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-layout>
