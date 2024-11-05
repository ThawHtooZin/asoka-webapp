@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <button class="btn btn-primary mb-3" onclick="openAddModal()">Add Category</button>

        <table id="categorytable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')"
                                class="btn btn-info">Edit</button>

                            <!-- Delete Button -->
                            <button onclick="deleteCategory({{ $category->id }})" class="btn btn-danger">Delete</button>
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
                        <h5 class="modal-title" id="addModalLabel">Add New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addCategoryForm" method="POST" action="/dashboard/articles/categories">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="categoryName">Category Name</label>
                                <input type="text" class="form-control" id="CategoryName" name="name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Category</button>
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
                        <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editCategoryForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="editCategoryId">
                            <div class="form-group">
                                <label for="editCategoryName">Category Name</label>
                                <input type="text" class="form-control" id="editCategoryName" name="name">
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
                $('#categorytable').DataTable();
            });

            // Function to open Add Modal
            function openAddModal() {
                $('#addModal').modal('show');
            }

            // Function to open Edit Modal with pre-filled Category data
            function openEditModal(id, name) {
                $('#editCategoryId').val(id);
                $('#editCategoryName').val(name);

                $('#editModal').modal('show');

                // Update the form action dynamically
                $('#editCategoryForm').attr('action', `/dashboard/articles/categories/${id}`);
            }

            // Function to handle delete request
            function deleteCategory(id) {
                if (confirm("Are you sure you want to delete this Category?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/articles/categories/${id}`;

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
