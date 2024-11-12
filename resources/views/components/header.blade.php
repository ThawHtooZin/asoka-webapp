<div class="py-3 bg-white shadow-lg">
    <!-- Container for logo, title, and buttons -->
    <div class="flex flex-wrap items-center justify-between px-4 sm:px-8">
        <!-- Logo and Title -->
        <div class="flex items-center space-x-4">
            <img src="/images/logo.png" alt="Asoka Logo" class="h-[80px] sm:h-[100px] lg:h-[120px]">
            <div class="flex flex-col text-center sm:text-left">
                <h1 class="text-2xl sm:text-3xl lg:text-5xl roboto-slab font-bold text-t5 tracking-wide text-center">
                    ASOKA
                </h1>
                <span class="text-sm sm:text-base mt-1">Center of Buddhist Studies</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 mt-4 sm:mt-0">
            <!-- Translate Button -->
            <button class="flex items-center space-x-2 bg-primary p-2 rounded-lg border-4 border-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-translate text-white" viewBox="0 0 16 16">
                    <path
                        d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286zm1.634-.736L5.5 3.956h-.049l-.679 2.022z" />
                    <path
                        d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm7.138 9.995q.289.451.63.846c-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6 6 0 0 1-.415-.492 2 2 0 0 1-.94.31" />
                </svg>
            </button>

            <!-- Search & User Button with Dropdown -->
            <div class="relative">
                <button class="flex items-center space-x-2 text-primary p-3 rounded-lg border-2 border-primary"
                    onclick="toggleDropdown()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                    @auth
                        <span class=" text-sm font-medium">{{ auth()->user()->name }}</span>
                    @endauth
                </button>

                <!-- Dropdown Menu for User Account -->
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg hidden z-50">
                    <ul>
                        @auth
                            <li><a href="/profile"
                                    class="block px-4 py-2 hover:rounded-t-lg hover:bg-primary hover:text-white">Profile</a>
                            </li>
                            @if (auth()->user()->roles()->first()->name == 'admin' || auth()->user()->roles()->first()->name == 'instructor')
                                <li><a href="/dashboard"
                                        class="block px-4 py-2 hover:bg-primary hover:text-white">Dashboard</a>
                                </li>
                            @endif
                            <li><a href="/logout"
                                    class="block px-4 py-2 text-red-500 hover:rounded-b-lg hover:bg-red-500 hover:text-white">Logout</a>
                            </li>
                        @endauth
                        @guest
                            <li><a href="/login"
                                    class="block px-4 py-2 hover:rounded-t-lg hover:bg-primary hover:text-white">Login</a>
                            </li>
                            <li><a href="/register"
                                    class="block px-4 py-2 hover:rounded-b-lg hover:bg-primary hover:text-white">Register</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById("dropdownMenu");
        dropdown.classList.toggle("hidden");
    }
</script>
