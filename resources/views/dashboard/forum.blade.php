@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <table id="forumtable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>By</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forums as $forum)
                    <tr>
                        <td>{{ $forum->id }}</td>
                        <td>{{ $forum->title }}</td>
                        <td>{{ $forum->user()->first()->name }}</td>
                        <td>{{ Str::limit($forum->content, 100, '...') }}</td>
                        <td>{{ date('d-m-Y', strtotime($forum->created_at)) }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button onclick="openEditModal({{ $forum->id }})" class="btn btn-info">Edit</button>

                            <!-- Delete Button -->
                            <button onclick="deleteForum({{ $forum->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $forum->id }}" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Forum</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editForumForm" method="POST" action="/dashboard/forums/{{ $forum->id }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editForumTitle">Forum Title</label>
                                            <input type="text" class="form-control" id="editForumTitle" name="title"
                                                required value="{{ old('title', $forum->title) }}">
                                            @error('title')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="editForumBy">Forum By</label>
                                            <select name="by" class="form-control" id="editForumBy">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $forum->user()->first()->id) selected @endif>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('by')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="editForumContent">Forum Content</label>
                                            <textarea class="form-control" id="editForumContent" name="content" required cols="30" rows="7">{{ old('content', $forum->content) }}</textarea>
                                            @error('content')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                $('#forumtable').DataTable({
                    pageLength: 4
                });
            });

            function openEditModal(id) {
                var modalid = '#editModal' + id;
                console.log(modalid);
                $(modalid).modal('show');
            }

            // Function to handle delete request
            function deleteForum(id) {
                if (confirm("Are you sure you want to delete this Forum?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/forums/${id}`;

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
        </script>
    </div>
@endsection
