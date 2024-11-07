@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <button class="btn btn-primary mb-3" onclick="openAddModal()">Add Chapter</button>

        <table id="chaptertable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chapters as $chapter)
                    <tr>
                        <td>{{ $chapter->id }}</td>
                        <td>{{ $chapter->title }}</td>
                        <td>{{ $chapter->description }}</td>
                        <td>{{ $chapter->courses()->first()->name }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button
                                onclick="openEditModal({{ $chapter->id }}, '{{ $chapter->title }}', '{{ $chapter->description }}', '{{ $chapter->course_id }}')"
                                class="btn btn-info">Edit</button>

                            <!-- Delete Button -->
                            <button onclick="deleteChapter({{ $chapter->id }})" class="btn btn-danger">Delete</button>
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
                        <h5 class="modal-title" id="addModalLabel">Add New Chapter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addCategoryForm" method="POST" action="/dashboard/courses/chapters">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ChapterTitle">Chapter Title</label>
                                <input type="text" class="form-control" id="ChapterTitle" name="title" required>

                                <label for="ChapterDescription">Chapter Description</label>
                                <textarea name="description" id="ChapterDescription" cols="30" rows="4" class="form-control" required></textarea>

                                <label for="ChapterCourse">Course</label>
                                <select name="course_id" id="ChapterCourse" class="form-control">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">
                                            {{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Chapter</button>
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
                        <h5 class="modal-title" id="editModalLabel">Edit Chapter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editChapterForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="editChapterId">
                            <div class="form-group">
                                <label for="ChapterTitle">Chapter Title</label>
                                <input type="text" class="form-control" id="editChapterTitle" name="title" required>

                                <label for="ChapterDescription">Chapter Description</label>
                                <textarea name="description" id="editChapterDescription" cols="30" rows="4" class="form-control" required></textarea>

                                <label for="ChapterCourse">Course</label>
                                <select name="course_id" id="editChapterCourse" class="form-control">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">
                                            {{ $course->name }}</option>
                                    @endforeach
                                </select>
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
                $('#chaptertable').DataTable();
            });

            // Function to open Add Modal
            function openAddModal() {
                $('#addModal').modal('show');
            }

            // Function to open Edit Modal with pre-filled Category data
            function openEditModal(id, title, description, courseid) {
                $('#editChapterId').val(id);
                $('#editChapterTitle').val(title);
                $('#editChapterDescription').val(description);
                $('#editChapterCourse').val(courseid);

                $('#editModal').modal('show');

                // Update the form action dynamically
                $('#editChapterForm').attr('action', `/dashboard/courses/chapters/${id}`);
            }

            // Function to handle delete request
            function deleteChapter(id) {
                if (confirm("Are you sure you want to delete this Chapter?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/courses/chapters/${id}`;

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
