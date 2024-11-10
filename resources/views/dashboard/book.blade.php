@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <button class="btn btn-primary mb-3" onclick="openAddModal()">Add Book</button>

        <table id="booktable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Cover Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td><a href="{{ $book->cover_image }}" target="__blank"><img src="{{ $book->cover_image }}"
                                    alt="" class="w-10 h-20"></a>
                        <td>{{ Str::limit($book->description, 30) }}</td>
                        <td>{{ $book->price }}</td>
                        </td>
                        <td>{{ date('d-m-Y', strtotime($book->created_at)) }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button onclick="openEditModal({{ $book->id }})" class="btn btn-info">Edit</button>

                            <!-- Delete Button -->
                            <button onclick="deleteBook({{ $book->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $book->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit a Book</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editBookForm" method="POST" action="/dashboard/books/{{ $book->id }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <!-- Book Title -->
                                            <label for="editBookTitle">Book Title</label>
                                            <input type="text" class="form-control" id="editBookTitle" name="title"
                                                value="{{ old('title', $book->title) }}" required>
                                            @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <!-- Book Author -->
                                            <label for="editBookAuthor">Book Author</label>
                                            <input type="text" class="form-control" id="editBookAuthor" name="author"
                                                value="{{ old('author', $book->author) }}" required>
                                            @error('author')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <!-- Book Category -->
                                            <label for="editBookCategory">Book Category</label>
                                            <select class="form-control" name="book_category_id" id="editBookCategory"
                                                required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $book->book_category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            <!-- ISBN Number -->
                                            <label for="editisbn">ISBN Number</label>
                                            <input type="text" class="form-control" name="isbn" id="editisbn"
                                                value="{{ old('isbn', $book->isbn) }}" required>
                                            @error('isbn')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <!-- Book Image -->
                                            <label for="editBookImage">Book Image</label>
                                            <input type="file" class="form-control" id="editCourseImage"
                                                name="cover_image">
                                            @if ($book->cover_image)
                                                <div class="mt-2">
                                                    <img src="{{ $book->cover_image }}" alt="Book Cover Image"
                                                        class="w-40 h-20">
                                                </div>
                                            @endif
                                            @error('cover_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <!-- Book Description -->
                                            <label for="editBookDescription">Book Description</label>
                                            <textarea class="form-control" id="editBookDescription" name="description" required cols="30" rows="7">{{ old('description', $book->description) }}</textarea>
                                            @error('description')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <!-- Book Price -->
                                            <label for="editBookPrice">Book Price</label>
                                            <input type="text" class="form-control" id="editBookPrice" name="price"
                                                value="{{ old('price', $book->price) }}" required>
                                            @error('price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <!-- Book File (PDF) -->
                                            <label for="editBookUrl">Book PDF</label>
                                            <input type="file" class="form-control" name="book_url" id="editBookUrl">
                                            @error('book_url')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
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
                        <h5 class="modal-title" id="addModalLabel">Create a New Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addBookForm" method="POST" action="/dashboard/books/" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <!-- Book Title -->
                                <label for="editBookTitle">Book Title</label>
                                <input type="text" class="form-control" id="editBookTitle" name="title"
                                    value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- Book Author -->
                                <label for="editBookAuthor">Book Author</label>
                                <input type="text" class="form-control" id="editBookAuthor" name="author"
                                    value="{{ old('author') }}" required>
                                @error('author')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <label for="editBookCategory">Book Category</label>
                                <select class="form-control" name="book_category_id" id="editBookCategory" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <!-- ISBN Number -->
                                <label for="editisbn">ISBN Number</label>
                                <input type="text" class="form-control" name="isbn" id="editisbn"
                                    value="{{ old('isbn') }}" required>
                                @error('isbn')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- Book Image -->
                                <label for="editBookImage">Book Image</label>
                                <input type="file" class="form-control" id="editCourseImage" name="cover_image">
                                @error('cover_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- Book Description -->
                                <label for="editBookDescription">Book Description</label>
                                <textarea class="form-control" id="editBookDescription" name="description" required cols="30" rows="7">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- Book Price -->
                                <label for="editBookPrice">Book Price</label>
                                <input type="text" class="form-control" id="editBookPrice" name="price"
                                    value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- Book File -->
                                <label for="editBookUrl">Book</label>
                                <input type="file" class="form-control" name="book_url" id="editBookUrl" required>
                                @error('book')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#booktable').DataTable({
                    pageLength: 4
                });
            });


            // Function to open Add Modal
            function openAddModal() {
                $('#addModal').modal('show');
            }

            function openEditModal(id) {
                var modalid = '#editModal' + id;
                $(modalid).modal('show');
            }

            // Function to handle delete request
            function deleteBook(id) {
                if (confirm("Are you sure you want to delete this Book?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/books/${id}`;

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
