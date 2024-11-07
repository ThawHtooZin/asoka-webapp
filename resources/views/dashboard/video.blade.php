@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <button class="btn btn-primary mb-3" onclick="openAddModal()">Add Chapter</button>

        <table id="videotable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Chapter</th>
                    <th>Video</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                    <tr>
                        <td>{{ $video->id }}</td>
                        <td>{{ $video->title }}</td>
                        <td>{{ $video->chapter()->first()->title }}</td>
                        <td>{{ $video->video_url }}</td>
                        <td>{{ $video->description }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button
                                onclick="openEditModal({{ $video->id }}, '{{ $video->title }}', '{{ $video->description }}', '{{ $video->video_url }}')"
                                class="btn btn-info">Edit</button>

                            <!-- Delete Button -->
                            <button onclick="deleteVideo({{ $video->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add New Video</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addCategoryForm" method="POST" action="/dashboard/courses/videos"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="VideoTitle">Video Title</label>
                                <input type="text" class="form-control" id="VideoTitle" name="title" required>

                                <label for="VideoCourse">Course</label>
                                <select name="course_id" id="VideoCourse" class="form-control"
                                    onchange="addcoursechange(this.value)">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" <?php if (empty($course->chapters()->first())) {
                                            echo 'style="display: none;"';
                                        } ?>>{{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="VideoChapter" id="VideoChapterlabel">Chapter</label>
                                <select name="chapter_id" id="VideoChapter" class="form-control">
                                    @foreach ($chapters as $chapter)
                                        <option value="{{ $chapter->id }}" data-courseid="{{ $chapter->course_id }}">
                                            {{ $chapter->title }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="VideoFile">Video</label>
                                <input type="input" name="video" id="VideoFile" class="form-control">

                                <label for="VideoDescription">Video Description</label>
                                <textarea name="description" id="VideoDescription" cols="30" rows="4" class="form-control" required></textarea>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Video</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Video</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editVideoForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="editVideoId">
                            <div class="form-group">
                                <label for="VideoTitle">Video Title</label>
                                <input type="text" class="form-control" id="editVideoTitle" name="title" required>

                                <label for="editVideoCourse">Course</label>
                                <select name="course_id" id="editVideoCourse" class="form-control"
                                    onchange="editcoursechange(this.value)">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" <?php if (empty($course->chapters()->first())) {
                                            echo 'style="display: none;"';
                                        } ?>>{{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="editVideoChapter" id="editVideoChapterlabel">Chapter</label>
                                <select name="chapter_id" id="editVideoChapter" class="form-control">
                                    @foreach ($chapters as $chapter)
                                        <option value="{{ $chapter->id }}"
                                            data-courseidedit="{{ $chapter->course_id }}">
                                            {{ $chapter->title }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="editVideoFile">Video</label>
                                <input type="text" name="video" id="editVideoFile" class="form-control">

                                <label for="VideoDescription">Video Description</label>
                                <textarea name="description" id="editVideoDescription" cols="30" rows="4" class="form-control" required></textarea>

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

        <script>
            $(document).ready(function() {
                $('#videotable').DataTable();
            });

            $('#VideoChapter').hide();
            $('#VideoChapterlabel').hide();
            $('#editVideoChapter').hide();
            $('#editVideoChapterlabel').hide();

            function addcoursechange(value) {
                $('#VideoChapter').show();
                $('#VideoChapterlabel').show();
                // Select all elements with the attribute 'data-courseid'
                $('[data-courseid]').each(function() {
                    // Get the course ID from the attribute for each element
                    let courseid = $(this).data('courseid');

                    // Check if the data attribute matches the provided value
                    if (courseid == value) {
                        $(this).css('display', 'block');
                    } else {
                        $(this).css('display', 'none');
                    }
                });
            }

            function editcoursechange(value) {
                $('#editVideoChapter').show();
                $('#editVideoChapterlabel').show();
                // Select all elements with the attribute 'data-courseid'
                $('[data-courseidedit]').each(function() {
                    // Get the course ID from the attribute for each element
                    let courseid = $(this).data('courseidedit');

                    // Check if the data attribute matches the provided value
                    if (courseid == value) {
                        $(this).css('display', 'block');
                    } else {
                        $(this).css('display', 'none');
                    }
                });
            }


            // Function to open Add Modal
            function openAddModal() {
                $('#addModal').modal('show');
            }

            // Function to open Edit Modal with pre-filled Category data
            function openEditModal(id, title, description, video_url) {
                $('#editVideoId').val(id);
                $('#editVideoTitle').val(title);
                $('#editVideoDescription').val(description);
                $('#editVideoFile').val(video_url);

                $('#editModal').modal('show');

                // Update the form action dynamically
                $('#editVideoForm').attr('action', `/dashboard/courses/videos/${id}`);
            }

            // Function to handle delete request
            function deleteVideo(id) {
                if (confirm("Are you sure you want to delete this Video?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/courses/videos/${id}`;

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
