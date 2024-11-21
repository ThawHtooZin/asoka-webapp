<x-layout>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Slab:wght@100..900&display=swap"
        rel="stylesheet">
    <style>
        .kanit-bold {
            font-family: "Kanit", serif;
            font-weight: 700;
            font-style: normal;
        }
    </style>
    <div class="grid grid-cols-5">
        <div></div>
        <div class="col-span-3 p-4">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-6">
                <div class="p-2">
                    <a href="/" class="text-blue-800 font-bold hover:underline">Home</a> > <a href="/forum"
                        class="text-blue-800 font-bold hover:underline">Forums</a>
                </div>
                {{-- Forum Post --}}
                <div
                    class="bg-gradient-to-r from-blue-50 via-white to-blue-50 shadow-2xl rounded-lg p-8 mb-8 border border-gray-200 hover:shadow-[0px_10px_40px_rgba(0,0,0,0.15)] transition-shadow duration-300">
                    <div class="flex justify-between items-start border-b pb-3">
                        <div class="space-y-3">
                            <p class="text-xl text-gray-900 flex items-center space-x-2">
                                <span>{{ $forum->user->name }}</span>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full font-medium">
                                    {{ date('M d, Y', strtotime($forum->created_at)) }}
                                </span>
                            </p>
                            <h2 class="kanit-bold text-4xl font-extrabold text-gray-800 tracking-wide leading-tight">
                                {{ $forum->title }}
                            </h2>
                        </div>
                        <div class="flex items-center space-x-6 text-gray-500">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15" />
                                </svg>
                                <span>{{ $forum->comments()->count() }} Comments</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                </svg>
                                <span>{{ $forum->views }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-lg text-gray-700 leading-relaxed">
                            {{ $forum->content }}
                        </p>
                    </div>
                </div>

                @if (!empty($forum->comments))
                    {{-- Comments Section --}}
                    <div class="space-y-6">
                        @foreach ($forum->comments as $comment)
                            {{-- Comment --}}
                            <div
                                class="bg-white shadow-lg rounded-lg p-6 @if ($comment->parent_comment_id !== null) hidden @endif">
                                {{-- Comment Header --}}
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ date('M d, Y H:i', strtotime($comment->created_at)) }}
                                        </p>
                                    </div>
                                </div>
                                {{-- Comment Content --}}
                                <div class="mt-4 text-gray-800">
                                    <p>{{ $comment->comment }}</p>
                                </div>
                                {{-- Reply Button --}}
                                <div class="mt-4">
                                    <button
                                        class="bg-blue-500 text-white py-1 px-4 rounded-lg hover:bg-blue-600 transition duration-300 reply-btn"
                                        data-comment-id="{{ $comment->id }}">
                                        Reply
                                    </button>
                                </div>
                                {{-- Hidden Reply Form --}}
                                <div id="reply-box-{{ $comment->id }}" class="hidden mt-4">
                                    <form action="{{ route('forum.replies.store', [$forum->id, $comment->id]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <textarea name="comment" rows="3"
                                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Write your reply..."></textarea>
                                        <button type="submit"
                                            class="mt-3 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none">
                                            Submit Reply
                                        </button>
                                    </form>
                                </div>

                                {{-- Replies --}}
                                @if ($comment->replies->count())
                                    <div class="mt-6 pl-8 border-l-2 border-blue-200">
                                        @foreach ($comment->replies as $reply)
                                            <div class="bg-gray-100 shadow rounded-lg p-4 mb-4">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <p class="font-semibold text-gray-800">{{ $reply->user->name }}
                                                        </p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ date('M d, Y H:i', strtotime($reply->created_at)) }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mt-3 text-gray-700">
                                                    <p>{{ $reply->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach

                    </div>
                @endif
                <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-gray-800">Write an Comment</p>
                        </div>
                    </div>
                    <form action="{{ route('forum.comments.store', $forum->id) }}" method="POST">
                        @csrf
                        <textarea name="comment" rows="3"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Write your reply..."></textarea>
                        <button type="submit"
                            class="mt-3 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none">
                            Submit Reply
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const replyButtons = document.querySelectorAll('.reply-btn');

            replyButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const commentId = button.getAttribute('data-comment-id');
                    const replyBox = document.getElementById(`reply-box-${commentId}`);

                    // Toggle visibility of the reply box
                    if (replyBox.classList.contains('hidden')) {
                        replyBox.classList.remove('hidden');
                    } else {
                        replyBox.classList.add('hidden');
                    }
                });
            });
        });
    </script>

</x-layout>
