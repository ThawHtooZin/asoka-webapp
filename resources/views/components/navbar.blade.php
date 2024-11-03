<!-- Navbar Container -->
<div class="py-3 px-6 sm:px-12 lg:px-32 bg-asokablue shadow-lg text-white sticky top-0 z-40">
    <!-- Desktop Navbar -->
    <div class="hidden lg:flex justify-around items-center">
        <ul class="flex space-x-8">
            <li><a href="/" class="text-lg">Home</a></li>
            <li class="group relative">
                <a href="/aboutus" class="text-lg">About</a>
                <x-navlinkcontainer
                    class="absolute left-0 hidden group-hover:flex flex-col bg-asokablue mt-2 p-2 rounded shadow-lg">
                    <x-navlink>Vision</x-navlink>
                    <x-navlink>Objectives</x-navlink>
                    <x-navlink>Motto</x-navlink>
                </x-navlinkcontainer>
            </li>
            <li class="group relative">
                <a href="#" class="text-lg">Learning</a>
                <div>
                    <x-navlinkcontainer
                        class="absolute left-0 hidden group-hover:flex flex-col bg-asokablue mt-2 p-2 rounded shadow-lg">
                        <x-navlink href="/course">Courses</x-navlink>
                        <x-navlink href="/elibrary">E-Library</x-navlink>
                    </x-navlinkcontainer>
                </div>
            </li>
            <li class="group relative">
                <a href="#" class="text-lg">News & Announcement</a>
                <x-navlinkcontainer
                    class="absolute left-0 hidden group-hover:flex flex-col bg-asokablue mt-2 p-2 rounded shadow-lg">
                    <x-navlink href="/news">News</x-navlink>
                    <x-navlink href="/announcement">Announcement</x-navlink>
                </x-navlinkcontainer>
            </li>
            <li class="group relative">
                <a href="#" class="text-lg">Resources</a>
                <x-navlinkcontainer
                    class="absolute left-0 hidden group-hover:flex flex-col bg-asokablue mt-2 p-2 rounded shadow-lg">
                    <x-navlink href="/articles">Article</x-navlink>
                    <x-navlink href="/videos">Videos</x-navlink>
                </x-navlinkcontainer>
            </li>
            <li><a href="#" class="text-lg">Gallery</a></li>
            <li><a href="#" class="text-lg">Contact Us</a></li>
        </ul>
    </div>

    <!-- Mobile Navbar -->
    <div class="flex lg:hidden items-center justify-between">
        <a href="/" class="text-lg font-bold">ASOKA</a>
        <button id="menu-toggle" class="focus:outline-none">
            <!-- Hamburger Icon -->
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden flex-col space-y-2 mt-4 lg:hidden">
        <a href="/" class="text-md block py-2">Home</a>
        <a href="/aboutus" class="text-md block py-2">About</a>
        <div class="flex flex-col space-y-1 pl-4">
            <x-navlink>Vision</x-navlink>
            <x-navlink>Objectives</x-navlink>
            <x-navlink>Motto</x-navlink>
        </div>
        <a href="/courses" class="text-md block py-2">Courses</a>
        <a href="#" class="text-md block py-2">Resources</a>
        <div class="flex flex-col space-y-1 pl-4">
            <x-navlink href="/announcement">Announcement</x-navlink>
            <x-navlink href="/articles">Article</x-navlink>
            <x-navlink href="/elibrary">E-Library</x-navlink>
            <x-navlink href="/videos">Videos</x-navlink>
        </div>
        <a href="#" class="text-md block py-2">Gallery</a>
        <a href="#" class="text-md block py-2">Contact Us</a>
        <a href="/login" class="text-md block py-2">
            @auth
                {{ Auth::user()->name }}
            @endauth
            @guest
                Account
            @endguest
        </a>
        <div class="flex flex-col space-y-1 pl-4">
            @auth
                <x-navlink href="/profile">Profile</x-navlink>
                @if (auth()->user()->roles()->first()->name == 'admin' || auth()->user()->roles()->first()->name == 'instructor')
                    <x-navlink href="/dashboard">Dashboard</x-navlink>
                @endif
                <x-navlink href="/logout" class="text-red-500 hover:bg-red-500 hover:text-white">Logout</x-navlink>
            @endauth
            @guest
                <x-navlink href="/login">Login</x-navlink>
                <x-navlink href="/register">Register</x-navlink>
            @endguest
        </div>
    </div>
</div>

<!-- JavaScript to toggle mobile menu -->
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
