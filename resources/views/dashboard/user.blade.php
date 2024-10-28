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
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles }}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                $('#usertable').DataTable(); // Replace #yourTableID with the actual ID of your table
            });
        </script>
    </div>
@endsection
