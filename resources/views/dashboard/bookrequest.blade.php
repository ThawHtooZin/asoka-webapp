@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <table id="requesttable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Payment Image</th>
                    <th>Requested User</th>
                    <th>Requested Book</th>
                    <th>Status</th>
                    <th>Requested At</th>
                    <th>Confirmation</th>
                    <th>Archive</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td><a href="{{ $request->payment_image }}" target="__blank"><img src="{{ $request->payment_image }}"
                                    alt="" class="w-40 h-20"></a>
                        </td>
                        <td>{{ $request->user()->first()->name }}</td>
                        <td>{{ $request->book()->first()->title }}</td>
                        <td>{{ $request->status }}</td>
                        <td>{{ date('d-m-Y', strtotime($request->created_at)) }}</td>
                        <td>
                            <!-- Confirm Button -->
                            @if ($request->status != 'confirmed')
                                <button onclick="confirmRequest({{ $request->id }})" class="btn btn-success">Confirm</button>
                            @else
                                <span class="text-green-400">Confirmed</span>
                            @endif
                        </td>
                        <td>
                            {{-- Remove Button --}}
                            @if ($request->status == 'confirmed')
                                <button onclick="achiveRequest({{ $request->id }})" class="btn btn-warning">Achive</button>
                            @elseif($request->status == 'achived')
                                <span class="text-yellow-400">Achived</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                $('#requesttable').DataTable({
                    pageLength: 4
                });
            });


            // Function to handle delete request
            function confirmRequest(id) {
                if (confirm("Are you sure you want to Confirm this Request?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/books/request/${id}/confirm`;

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
                    methodInput.value = 'POST';
                    form.appendChild(methodInput);

                    // Append to the body and submit the form
                    document.body.appendChild(form);
                    form.submit();
                }
            }

            // Function to handle remove request
            function achiveRequest(id) {
                if (confirm("Are you sure you want to Achive this Request?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/books/request/${id}/achive`;

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
                    methodInput.value = 'POST';
                    form.appendChild(methodInput);

                    // Append to the body and submit the form
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        </script>
    </div>
@endsection
