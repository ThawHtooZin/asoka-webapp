<x-layout>
    <div class="container mx-auto p-6 space-y-8">
        <!-- Search Input -->
        <form action="/articles" method="GET" class="flex items-center mb-6 shadow-lg rounded-lg overflow-hidden">
            <input type="text" name="search" placeholder="Search for articles..."
                class="w-full p-4 border-0 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-asokablue transition duration-300" />
            <button type="submit"
                class="p-4 bg-asokablue text-white hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </button>
        </form>

        <!-- Categories Section -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Categories</h2>
            <div class="flex flex-wrap gap-4">
                @foreach ($categories as $category)
                    <button onclick="showArticles({{ $category->id }})"
                        class="category-box px-10 py-8 border-2 border-primary rounded-lg bg-gradient-to-r from-gray-100 to-white shadow-md transition duration-300 hover:shadow-2xl hover:shadow-asokablue text-center">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Main Content: Articles -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700 md:col-span-3">Articles</h2>
            <div id="articles-container" class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 md:col-span-3">
                @foreach ($articles as $article)
                    <div id="article-{{ $article->article_category_id }}"
                        class="article-card bg-white p-4 rounded-md shadow-md">
                        <!-- Article Image -->
                        @if ($article->image)
                            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                                class="w-full h-40 object-cover rounded-md mb-2" />
                        @endif

                        <h3 class="text-lg font-semibold">{{ $article->title }}</h3>
                        <p class="text-sm">By: {{ $article->user->name }}</p>
                        <p class="text-sm">Published on: {{ $article->created_at->format('F j, Y') }}</p>
                        <p class="text-sm mt-2">{{ Str::limit($article->description) }}</p>

                        @guest
                            <a href="/login"
                                class="mt-4 block w-full px-4 py-2 bg-asokablue text-white text-center rounded-lg hover:bg-blue-700 transition duration-300">
                                Log in to View Details
                            </a>
                        @else
                            <a href="/article/{{ $article->id }}"
                                class="mt-4 block w-full px-4 py-2 bg-asokablue text-white text-center rounded-lg hover:bg-blue-700 transition duration-300">
                                Read More
                            </a>
                        @endguest
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function showArticles(categoryId) {
            // Hide all article cards
            document.querySelectorAll('.article-card').forEach(card => {
                card.classList.add('hidden');
            });

            // Show article cards for the selected category
            document.querySelectorAll(`#article-${categoryId}`).forEach(card => {
                card.classList.remove('hidden');
            });
        }
    </script>
</x-layout>
