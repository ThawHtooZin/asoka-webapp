@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <button class="btn btn-primary mb-3" onclick="openAddModal()">Add Course</button>

        <table id="coursetable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Course Category</th>
                    <th>Language</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ Str::limit($course->description, 30) }}</td>
                        <td><a href="{{ $course->image }}" target="__blank"><img src="{{ $course->image }}" alt=""
                                    class="w-40 h-20"></a>
                        </td>
                        <td>{{-- $course->category()->first()->name --}}</td>
                        <td>{{ $course->language }}</td>
                        <td>{{ $course->duration }}</td>
                        <td>{{ $course->price }}</td>
                        <td>{{ $course->status }}</td>
                        <td>{{ date('d-m-Y', strtotime($course->created_at)) }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button onclick="openEditModal({{ $course->id }})" class="btn btn-info">Edit</button>

                            <!-- Delete Button -->
                            <button onclick="deleteCourse({{ $course->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $course->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit a Course</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editCourseForm" method="POST" action="/dashboard/courses/{{ $course->id }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" id="editCourseId">
                                        <div class="form-group">
                                            <label for="editCourseName">Course Name</label>
                                            <input type="text" class="form-control" id="editCourseName" name="name"
                                                required value="{{ $course->name }}">

                                            <label for="editCourseDescription">Course Description</label>
                                            <textarea class="form-control" id="editCourseDescription" name="description" required cols="30" rows="7">{{ $course->description }}</textarea>

                                            <label for="CourseCategory">Course Category</label>
                                            <select class="form-control" name="category_id" id="CourseCategory" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            <label for="editCourseImage">Course Image</label>
                                            <input type="file" class="form-control" id="editCourseImage" name="image"
                                                required>
                                            <img src="{{ $course->image }}" alt="" class="w-40 h-20">

                                            <label for="editCourseLanguage">Course Language</label>
                                            <input type="text" class="form-control" id="editCourseLanguage"
                                                name="language" required value="{{ $course->language }}">

                                            <label for="editCourseDuration">Course Duration</label>
                                            <input type="text" class="form-control" id="editCourseDuration"
                                                name="duration" required value="{{ $course->duration }}">

                                            <label for="editCoursePrice">Course Price</label>
                                            <input type="text" class="form-control" id="editCoursePrice" name="price"
                                                required value="{{ $course->price }}">

                                            <label for="editCourseStatus">Course Status</label>
                                            <select name="status" class="form-control" id="editCourseStatus"
                                                name="status">
                                                <option value="public">Public</option>
                                                <option value="closed">Closed</option>
                                                <option value="waiting">Waiting</option>
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
                @endforeach
            </tbody>
        </table>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Create a New Article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addCourseForm" method="POST" action="/dashboard/courses/" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="editCourseName">Course Name</label>
                                <input type="text" class="form-control" id="editCourseName" name="name" required>

                                <label for="editCourseDescription">Course Description</label>
                                <textarea class="form-control" id="editCourseDescription" name="description" required cols="30"
                                    rows="7"></textarea>

                                <label for="CourseCategory">Course Category</label>
                                <select class="form-control" name="category_id" id="CourseCategory" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <label for="editCourseImage">Course Image</label>
                                <input type="file" class="form-control" id="editCourseImage" name="image" required>

                                <label for="editCourseLanguage">Course Language</label>
                                <input type="text" class="form-control" id="editCourseLanguage" name="language"
                                    required value="">

                                <label for="editCourseDuration">Course Duration</label>
                                <input type="text" class="form-control" id="editCourseDuration" name="duration"
                                    required value="">

                                <label for="editCoursePrice">Course Price</label>
                                <input type="text" class="form-control" id="editCoursePrice" name="price" required
                                    value="">

                                <label for="editCourseStatus">Course Status</label>
                                <select name="status" class="form-control" id="editCourseStatus" name="status">
                                    <option value="public">Public</option>
                                    <option value="closed">Closed</option>
                                    <option value="waiting">Waiting</option>
                                </select>

                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Article</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#coursetable').DataTable({
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
            function deleteCourse(id) {
                if (confirm("Are you sure you want to delete this Course?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/courses/${id}`;

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
