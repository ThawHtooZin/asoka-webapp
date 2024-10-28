<div class="py-3 px-80 bg-asokablue shadow-lg text-white sticky top-0 z-50">
    <ul class="flex justify-around relative">
        <li><a href="/" class="text-lg">Home</a></li>
        <li class="group relative">
            <a href="/aboutus" class="text-lg">About</a>
            <x-navlinkcontainer>
                <x-navlink>Vision</x-navlink>
                <x-navlink>Objectives</x-navlink>
                <x-navlink>Motto</x-navlink>
            </x-navlinkcontainer>
        </li>
        <li class="group relative">
            <a href="#" class="text-lg">Courses</a>
            <x-navlinkcontainer>
                <x-navlink>Meditations</x-navlink>
                <x-navlink>History of Buddha</x-navlink>
                <x-navlink>Ethics</x-navlink>
                <x-navlink>Buddhist Practices</x-navlink>
            </x-navlinkcontainer>
        </li>
        <li class="group relative">
            <a href="#" class="text-lg">Resources</a>
            <x-navlinkcontainer>
                <x-navlink>Certificated Articles</x-navlink>
                <x-navlink>Videos</x-navlink>
                <x-navlink>Book Section</x-navlink>
            </x-navlinkcontainer>
        </li>
        <li class="group relative">
            <a href="#" class="text-lg">News & Announcement</a>
            <x-navlinkcontainer>
                <x-navlink>Forums</x-navlink>
                <x-navlink>New Courses</x-navlink>
                <x-navlink>Events</x-navlink>
            </x-navlinkcontainer>
        </li>
        <li class="group relative">
            <a href="#" class="text-lg">Gallery</a>
        </li>
        <li class="group relative">
            <a href="#" class="text-lg">Contact Us</a>
        </li>
        <li class="group relative">
            <a href="/login" class="text-lg">
                @auth
                    {{ Auth::user()->name }}
                @endauth
                @guest
                    Account
                @endguest
            </a>
            <x-navlinkcontainer>
                @auth
                    <x-navlink href="/profile">Profile</x-navlink>
                    <x-navlink href="/logout" class="text-red-500 hover:bg-red-500 hover:text-white">Logout</x-navlink>
                @endauth
                @guest
                    <x-navlink href="/login">Login</x-navlink>
                    <x-navlink href="/register">Register</x-navlink>
                @endguest
            </x-navlinkcontainer>
        </li>
    </ul>
</div>
