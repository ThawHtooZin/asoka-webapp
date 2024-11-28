<style>
    .text-underline {
        text-decoration: underline !important;
    }
</style>
<!-- Navbar Container -->
<div class="py-3 px-6 sm:px-12 lg:px-32 bg-asokablue shadow-lg text-white sticky top-0 z-40">
    <!-- Desktop Navbar -->
    <div class="hidden lg:flex justify-around items-center">
        <ul class="flex space-x-12">
            <!-- Home -->
            <li><a href="/"
                    class="text-lg @if (Request::is('/')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">
                    @lang('navbar.home')</a>
            </li>

            <!-- About Dropdown -->
            <li class="group relative">
                <button
                    class="text-lg @if (Request::is('about*')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">
                    @lang('navbar.about')
                </button>
                <x-navlinkcontainer>
                    <x-navlink href="/about/vision">@lang('navbar.about_vision')</x-navlink>
                    <x-navlink href="/about/objectives">@lang('navbar.about_objectives')</x-navlink>
                    <x-navlink href="/about/motto">@lang('navbar.about_motto')</x-navlink>
                </x-navlinkcontainer>
            </li>

            <!-- Learning Dropdown -->
            <li class="group relative">
                <button
                    class="text-lg @if (Request::is('courses*') || Request::is('elibrary*')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">
                    @lang('navbar.learning')
                </button>
                <x-navlinkcontainer>
                    <x-navlink href="/courses">@lang('navbar.learning_courses')</x-navlink>
                    <x-navlink href="/elibrary">@lang('navbar.learning_elibrary')</x-navlink>
                </x-navlinkcontainer>
            </li>

            <!-- Resources Dropdown -->
            <li class="group relative">
                <button
                    class="text-lg @if (Request::is('articles*') || Request::is('forum*')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">
                    @lang('navbar.resources')
                </button>
                <x-navlinkcontainer>
                    <x-navlink href="/articles">@lang('navbar.resources_articles')</x-navlink>
                    <x-navlink href="/forum">@lang('navbar.resources_forum')</x-navlink>
                </x-navlinkcontainer>
            </li>

            <!-- News -->
            <li><a href="/newsandupdate"
                    class="text-lg @if (Request::is('newsandupdate')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">@lang('navbar.news')</a>
            </li>

            <!-- Gallery -->
            <a href="/gallery"
                class="text-lg @if (Request::is('gallery')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">@lang('navbar.gallery')</a>
            </li>

            <!-- Contact -->
            <a href="/contactus"
                class="text-lg @if (Request::is('contactus')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">@lang('navbar.contact')</a>
            </li>
        </ul>
    </div>

    <!-- Mobile Navbar -->
    <div class="flex lg:hidden items-center justify-between">
        <a href="/"
            class="text-lg @if (Request::is('/')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">ASOKA</a>
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
        <!-- Home -->
        <a href="/"
            class="text-md block py-2 @if (Request::is('/')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">@lang('navbar.home')</a>

        <!-- About -->
        <div class="group">
            <button
                class="text-md block py-2 @if (Request::is('about*')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">@lang('navbar.about')</button>
            <div class="flex flex-col space-y-1 pl-4">
                <x-navlink href="/about/vision">@lang('navbar.about_vision')</x-navlink>
                <x-navlink href="/about/objectives">@lang('navbar.about_objectives')</x-navlink>
                <x-navlink href="/about/motto">@lang('navbar.about_motto')</x-navlink>
            </div>
        </div>

        <!-- Learning -->
        <div class="group">
            <button
                class="text-md block py-2 @if (Request::is('courses*') || Request::is('elibrary*')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">@lang('navbar.learning')</button>
            <div class="flex flex-col space-y-1 pl-4">
                <x-navlink href="/courses">@lang('navbar.learning_courses')</x-navlink>
                <x-navlink href="/elibrary">@lang('navbar.learning_elibrary')</x-navlink>
            </div>
        </div>

        <!-- Resources -->
        <div class="group">
            <button
                class="text-md block py-2 @if (Request::is('articles*') || Request::is('forum*')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">@lang('navbar.resources')</button>
            <div class="flex flex-col space-y-1 pl-4">
                <x-navlink href="/articles">@lang('navbar.resources_articles')</x-navlink>
                <x-navlink href="/forum">@lang('navbar.resources_forum')</x-navlink>
            </div>
        </div>

        <!-- News and Updates -->
        <a href="/newsandupdate"
            class="text-md block py-2 @if (Request::is('newsandupdate')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">@lang('navbar.news')</a>

        <!-- Gallery -->
        <a href="/gallery"
            class="text-md block py-2 @if (Request::is('gallery')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">@lang('navbar.gallery')</a>

        <!-- Contact Us -->
        <a href="/contactus"
            class="text-md block py-2 @if (Request::is('contactus')) text-underline @elseif (App::getLocale() == 'mm') text-[1rem] font-bold @endif">@lang('navbar.contact')</a>
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
