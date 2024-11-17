@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <button class="btn btn-primary mb-3" onclick="openAddModal()">Add Announcement</button>

        <table id="announcementtable" class="display">
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
                @foreach ($announcements as $announcement)
                    <tr>
                        <td>{{ $announcement->id }}</td>
                        <td>{{ $announcement->title }}</td>
                        <td>{{ $announcement->by }}</td>
                        <td>{{ Str::limit($announcement->content, 100, '...') }}</td>
                        <td>
                            @if (!empty($announcement->image))
                                <img src="{{ $announcement->image }}" alt="" class="w-48 h-28">
                            @else
                                No image Uploaded
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($announcement->created_at)) }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button onclick="openEditModal({{ $announcement->id }})" class="btn btn-info">Edit</button>

                            <!-- Delete Button -->
                            <button onclick="deleteAnnouncement({{ $announcement->id }})"
                                class="btn btn-danger">Delete</button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $announcement->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Announcement</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editArticleForm" method="POST"
                                    action="/dashboard/announcements/{{ $announcement->id }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" id="editArticleId">
                                        <div class="form-group">
                                            <label for="editAnnouncementTitle">Announcement Title</label>
                                            <input type="text" class="form-control" id="editAnnouncementTitle"
                                                name="title" required value="{{ old('title', $announcement->title) }}">
                                            @error('title')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="editAnnouncedBy">Announced By</label>
                                            <input type="text" class="form-control" id="editAnnouncedBy" name="by"
                                                required value="{{ old('by', $announcement->by) }}">
                                            @error('by')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="editAnnouncedContent">Announcement Content</label>
                                            <textarea class="form-control" id="editAnnouncedContent" name="content" required cols="30" rows="7">{{ old('content', $announcement->content) }}</textarea>
                                            @error('content')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="editAnnouncedImage">Announcement Image</label>
                                            <input type="file" name="image" id="editAnnouncedImage"
                                                class="form-control">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            @if (!empty($announcement->image))
                                                <img src="{{ $announcement->image }}" alt=""
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
                        <h5 class="modal-title" id="addModalLabel">Create a New Announcement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addAnnouncementForm" method="POST" action="/dashboard/announcements/"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="AnnouncementTitle">Announcement Title</label>
                                <input type="text" class="form-control" id="AnnouncementTitle" name="title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <label for="AnnouncedBy">Announced By</label>
                                <input type="text" class="form-control" id="AnnouncedBy" name="by">
                                @error('by')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <label for="AnnouncedContent">Announcement Content</label>
                                <textarea class="form-control" id="AnnouncedContent" name="content" cols="30" rows="7"></textarea>
                                @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <label for="AnnouncedImage">Announcement Image</label>
                                <input type="file" name="image" id="AnnouncedImage" class="form-control">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Announcement</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#announcementtable').DataTable({
                    pageLength: 4
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
            function deleteAnnouncement(id) {
                if (confirm("Are you sure you want to delete this announcement?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/announcements/${id}`;

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
