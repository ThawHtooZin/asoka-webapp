@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <button class="btn btn-primary mb-3" onclick="openAddModal()">Add News and Update</button>

        <table id="newsandupdatetable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>By</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newsandupdates as $newsandupdate)
                    <tr>
                        <td>{{ $newsandupdate->id }}</td>
                        <td>{{ $newsandupdate->title }}</td>
                        <td>{{ $newsandupdate->by }}</td>
                        <td>{{ Str::limit($newsandupdate->content, 50, '...') }}</td>
                        <td>
                            @if (!empty($newsandupdate->image))
                                <img src="{{ $newsandupdate->image }}" alt="" class="w-48 h-28">
                            @else
                                No image Uploaded
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($newsandupdate->created_at)) }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button onclick="openEditModal({{ $newsandupdate->id }})" class="btn btn-info">Edit</button>

                            <!-- Delete Button -->
                            <button onclick="deleteNewsAndUpdate({{ $newsandupdate->id }})"
                                class="btn btn-danger">Delete</button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $newsandupdate->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit News and Update</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editNewsAndUpdateForm" method="POST"
                                    action="/dashboard/newsandupdates/{{ $newsandupdate->id }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editNewsAndUpdateTitle">News and Update Title</label>
                                            <input type="text" class="form-control" id="editNewsAndUpdateTitle"
                                                name="title" required value="{{ old('title', $newsandupdate->title) }}">
                                            @error('title')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="editNewsAndUpdateBy">By</label>
                                            <input type="text" class="form-control" id="editNewsAndUpdateBy"
                                                name="by" required value="{{ old('by', $newsandupdate->by) }}">
                                            @error('by')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="editNewsAndUpdateContent">Content</label>
                                            <textarea class="form-control" id="editNewsAndUpdateContent" name="content" required cols="30" rows="7">{{ old('content', $newsandupdate->content) }}</textarea>
                                            @error('content')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="editNewsAndUpdateImage">Image</label>
                                            <input type="file" name="image" id="editNewsAndUpdateImage"
                                                class="form-control">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            @if (!empty($newsandupdate->image))
                                                <img src="{{ $newsandupdate->image }}" alt=""
                                                    class="w-48 h-28 mt-2">
                                            @else
                                                No image Uploaded
                                            @endif
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

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Create a New News and Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addNewsAndUpdateForm" method="POST" action="/dashboard/newsandupdates/"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="NewsAndUpdateTitle">News and Update Title</label>
                                <input type="text" class="form-control" id="NewsAndUpdateTitle" name="title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <label for="NewsAndUpdateBy">By</label>
                                <input type="text" class="form-control" id="NewsAndUpdateBy" name="by">
                                @error('by')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <label for="NewsAndUpdateContent">Content</label>
                                <textarea class="form-control" id="NewsAndUpdateContent" name="content" cols="30" rows="7"></textarea>
                                @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <label for="NewsAndUpdateImage">Image</label>
                                <input type="file" name="image" id="NewsAndUpdateImage" class="form-control">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add News and Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#newsandupdatetable').DataTable({
                    pageLength: 3
                });
            });

            // Function to open Add Modal
            function openAddModal() {
                $('#addModal').modal('show');
            }

            function openEditModal(id) {
                var modalid = '#editModal' + id;
                console.log(modalid);
                $(modalid).modal('show');
            }

            // Function to handle delete request
            function deleteNewsAndUpdate(id) {
                if (confirm("Are you sure you want to delete this news and update?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/newsandupdates/${id}`;

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
