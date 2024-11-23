<x-layout>
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
                    <div class="border-b pb-3">
                        <div class="space-y-3">
                            <div class="flex justify-between items-start ">
                                <p class="text-xl text-gray-900 flex items-center space-x-2">
                                    <span>{{ $forum->user->name }}</span>
                                    <span
                                        class="text-sm bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full font-medium">
                                        {{ date('M d, Y', strtotime($forum->created_at)) }}
                                    </span>
                                </p>
                                <div class="flex items-center space-x-3 text-gray-500">
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
                                        <span>{{ $forum->views()->count() }} Views</span>
                                    </div>

                                    @if (!empty(Auth::user()) && (Auth::user()->id == $forum->user->id || Auth::user()->roles()->first()->name == 'admin'))
                                        <button
                                            class="bg-yellow-400 p-2 rounded-lg text-white transition duration-300 ease-in-out transform hover:bg-yellow-500 hover:scale-105 hover:shadow-lg"
                                            onclick="openEditForumBox({{ $forum->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                            </svg>
                                        </button>
                                        <button onclick="deleteForum({{ $forum->id }})"
                                            class="bg-red-600 p-2 rounded-lg text-white transition duration-300 ease-in-out transform hover:bg-red-700 hover:scale-105 hover:shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <h2 class="text-4xl font-extrabold text-gray-800 tracking-wide leading-tight"
                                style="word-wrap: break-word;">
                                {{ $forum->title }}
                            </h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <pre class="font-sans text-lg text-gray-700 leading-relaxed">
                            {{ $forum->content }}
                        </pre>
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
                                <div class="flex justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
                                        <p class="text-sm text-gray-500">
                                            @if ($comment->created_at == $comment->updated_at)
                                                {{ date('M d, Y H:i', strtotime($comment->created_at)) }}
                                            @else
                                                {{ 'Updated At ' . date('M d, Y H:i', strtotime($comment->updated_at)) }}
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        @if (!empty(Auth::user()) && (Auth::user()->id == $comment->user->id || Auth::user()->roles()->first()->name == 'admin'))
                                            <button
                                                class="bg-yellow-400 p-2 rounded-lg text-white transition duration-300 ease-in-out transform hover:bg-yellow-500 hover:scale-105 hover:shadow-lg"
                                                onclick="openEditCommentBox({{ $comment->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                </svg>
                                            </button>
                                            <button onclick="deleteComment({{ $forum->id }}, {{ $comment->id }})"
                                                class="bg-red-600 p-2 rounded-lg text-white transition duration-300 ease-in-out transform hover:bg-red-700 hover:scale-105 hover:shadow-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>

                                </div>
                                {{-- Comment Content --}}
                                <div class="mt-4 text-gray-800">
                                    <pre class="font-sans">{{ $comment->comment }}</pre>
                                </div>
                                @if (!empty(Auth::user()) && optional(Auth::user()->roles()->first())->name == 'admin')
                                    {{-- Reply Button --}}
                                    <div class="mt-4">
                                        <button
                                            class="bg-blue-500 text-white py-1 px-4 rounded-lg hover:bg-blue-600 transition duration-300 reply-btn"
                                            data-comment-id="{{ $comment->id }}">
                                            Reply
                                        </button>
                                    </div>
                                @endif
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
                                                        <p class="font-semibold text-gray-800">
                                                            {{ $reply->user->name }}</p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ date('M d, Y H:i', strtotime($reply->created_at)) }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        @if (!empty(Auth::user()) && (Auth::user()->id == $reply->user->id || Auth::user()->roles()->first()->name == 'admin'))
                                                            <button onclick="openEditReplyBox({{ $reply->id }})"
                                                                class="bg-yellow-400 p-2 rounded-lg text-white transition duration-300 ease-in-out transform hover:bg-yellow-500 hover:scale-105 hover:shadow-lg">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                                </svg>
                                                            </button>
                                                            <button
                                                                onclick="deleteReply({{ $forum->id }}, {{ $reply->id }})"
                                                                class="bg-red-600 p-2 rounded-lg text-white transition duration-300 ease-in-out transform hover:bg-red-700 hover:scale-105 hover:shadow-lg">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                                </svg>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="mt-3 text-gray-700">
                                                    <pre class="font-sans">{{ $reply->comment }}</pre>
                                                </div>
                                            </div>

                                            {{-- Edit Reply Box --}}
                                            <div id="EditReply{{ $reply->id }}"
                                                class="fixed bottom-0 left-1/2 transform -translate-x-1/2 bg-white border-t border-gray-300 p-6 shadow-lg hidden z-50 w-full max-w-3xl">
                                                <div class="max-w-3xl mx-auto">
                                                    <h3 class="text-2xl font-semibold mb-4 text-gray-800">Edit Your
                                                        Reply</h3>
                                                    <form
                                                        action="{{ $forum->id }}/comments/{{ $reply->id }}/replies"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-4">
                                                            <label for="reply"
                                                                class="block text-gray-700 font-medium">Reply</label>
                                                            <textarea name="reply" id="reply" rows="4"
                                                                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                                placeholder="Enter comment reply" required>{{ $reply->comment }}</textarea>
                                                        </div>
                                                        <div class="flex justify-between">
                                                            <button type="submit"
                                                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                                                                Edit Reply
                                                            </button>
                                                            <button type="button"
                                                                onclick="cancelreplyedit({{ $reply->id }})"
                                                                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <script>
                                                function openEditReplyBox(commentId) {
                                                    $('#EditReply' + commentId).removeClass('hidden');
                                                }

                                                function cancelreplyedit(commentId) {
                                                    $('#EditReply' + commentId).addClass('hidden');
                                                }
                                            </script>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Edit Comment Box --}}
                            <div id="EditComment{{ $comment->id }}"
                                class="fixed bottom-0 left-1/2 transform -translate-x-1/2 bg-white border-t border-gray-300 p-6 shadow-lg hidden z-50 w-full max-w-3xl">
                                <div class="max-w-3xl mx-auto">
                                    <h3 class="text-2xl font-semibold mb-4 text-gray-800">Edit Your
                                        Comment</h3>
                                    <form action="{{ $forum->id }}/comments/{{ $comment->id }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="mb-4">
                                            <label for="comment"
                                                class="block text-gray-700 font-medium">Comment</label>
                                            <textarea name="comment" id="comment" rows="4"
                                                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                placeholder="Enter forum comment" required>{{ $comment->comment }}</textarea>
                                        </div>
                                        <div class="flex justify-between">
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                                                Edit Comment
                                            </button>
                                            <button type="button" onclick="cancelcommentedit({{ $comment->id }})"
                                                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <script>
                                function openEditCommentBox(commentId) {
                                    $('#EditComment' + commentId).removeClass('hidden');
                                }

                                function cancelcommentedit(commentId) {
                                    $('#EditComment' + commentId).addClass('hidden');
                                }
                            </script>
                        @endforeach

                    </div>
                @endif
                @if (!empty(Auth::user()) && optional(Auth::user()->roles()->first())->name == 'admin')
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
                                Comment
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div></div>
    </div>

    @if (!empty(Auth::user()) && (Auth::user()->id == $forum->user->id || Auth::user()->roles()->first()->name == 'admin'))
        <div id="EditForum"
            class="fixed bottom-0 left-1/2 transform -translate-x-1/2 bg-white border-t border-gray-300 p-6 shadow-lg hidden z-50 w-full max-w-3xl">
            <div class="max-w-3xl mx-auto">
                <h3 class="text-2xl font-semibold mb-4 text-gray-800">Edit Your
                    Forum</h3>
                <form action="{{ $forum->id }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium">Title</label>
                        <input type="text" name="title" id="title"
                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            value="{{ $forum->title }}" placeholder="Enter forum title" required>
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 font-medium">Content</label>
                        <textarea name="content" id="content" rows="6"
                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter forum content" required>{{ $forum->content }}</textarea>
                    </div>
                    <div class="flex justify-between">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                            Edit Forum
                        </button>
                        <button type="button" onclick="cancelforumedit({{ $forum->id }})"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

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

        // Function to handle delete request
        function deleteComment(forumid, commentid) {
            if (confirm("Are you sure you want to delete this Comment?")) {
                // Create a temporary form to send the DELETE request
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = `/forum/${forumid}/comments/${commentid}`;

                // Add CSRF token
                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Add hidden DELETE method input
                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                // Append to the body and submit the form
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Function to handle delete request
        function deleteReply(forumid, commentid) {
            if (confirm("Are you sure you want to delete this Reply?")) {
                // Create a temporary form to send the DELETE request
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = `/forum/${forumid}/comments/${commentid}/replies`;

                // Add CSRF token
                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Add hidden DELETE method input
                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                // Append to the body and submit the form
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Function to handle delete request
        function deleteForum(forumid) {
            if (confirm("Are you sure you want to delete this Forum?")) {
                // Create a temporary form to send the DELETE request
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = `/forum/${forumid}`;

                // Add CSRF token
                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Add hidden DELETE method input
                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                // Append to the body and submit the form
                document.body.appendChild(form);
                form.submit();
            }
        }

        function openEditForumBox(forumId) {
            $('#EditForum').removeClass('hidden');
        }

        function cancelforumedit(forumId) {
            $('#EditForum').addClass('hidden');
        }
    </script>

</x-layout>
