@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <table id="roletable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                $('#roletable').DataTable(); // Replace #yourTableID with the actual ID of your table
            });
        </script>
    </div>
@endsection
