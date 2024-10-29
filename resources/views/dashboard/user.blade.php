@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <table id="usertable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->roles()->first()->name }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button
                                onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->phone }}')"
                                class="btn btn-info">Edit</button>

                            <!-- Delete Button -->
                            <button onclick="deleteUser({{ $user->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editUserForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="editUserId">

                            <div class="form-group">
                                <label for="editUserName">Name</label>
                                <input type="text" class="form-control" id="editUserName" name="name">
                            </div>

                            <div class="form-group">
                                <label for="editUserEmail">Email</label>
                                <input type="email" class="form-control" id="editUserEmail" name="email">
                            </div>

                            <div class="form-group">
                                <label for="editUserPhone">Phone</label>
                                <input type="text" class="form-control" id="editUserPhone" name="phone">
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
                $('#usertable').DataTable();

            });
            // Function to open Edit Modal with pre-filled user data
            function openEditModal(id, name, email, phone) {
                $('#editUserId').val(id);
                $('#editUserName').val(name);
                $('#editUserEmail').val(email);
                $('#editUserPhone').val(phone);

                $('#editModal').modal('show');

                // Update the form action dynamically
                $('#editUserForm').attr('action', `/users/${id}`);
            }

            // Function to handle delete request
            function deleteUser(id) {
                if (confirm("Are you sure you want to delete this user?")) {
                    $.ajax({
                        url: `/users/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('User deleted successfully');
                            location.reload(); // Reload to reflect changes
                        },
                        error: function(xhr) {
                            alert('Error deleting user');
                        }
                    });
                }
            }
        </script>
    </div>
@endsection
