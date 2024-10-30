@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <!-- Add User Button -->
        <button class="btn btn-success mb-3" onclick="openAddModal()">Add User</button>

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

        <!-- Add User Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addUserForm" action="/dashboard/users" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="addUserName">Name</label>
                                <input type="text" class="form-control" id="addUserName" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="addUserEmail">Email</label>
                                <input type="email" class="form-control" id="addUserEmail" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="addUserPhone">Phone</label>
                                <input type="text" class="form-control" id="addUserPhone" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address here"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="form-group">
                                <label for="addUserRole">Role</label>
                                <select class="form-control" name="role" id="addUserRole" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add User</button>
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

                            <div class="form-group">
                                <label for="editUserRole">Role</label>
                                <select class="form-control" name="role" id="editUserRole">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
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
                $('#usertable').DataTable();
            });

            // Function to open Add Modal
            function openAddModal() {
                $('#addModal').modal('show');
            }

            // Function to open Edit Modal with pre-filled user data
            function openEditModal(id, name, email, phone) {
                $('#editUserId').val(id);
                $('#editUserName').val(name);
                $('#editUserEmail').val(email);
                $('#editUserPhone').val(phone);

                $('#editModal').modal('show');

                // Update the form action dynamically
                $('#editUserForm').attr('action', `/dashboard/users/${id}`);
            }

            // Function to handle delete request
            function deleteUser(id) {
                if (confirm("Are you sure you want to delete this user?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/users/${id}`;

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
