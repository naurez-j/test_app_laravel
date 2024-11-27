@extends('layouts.main-layout')

@section('title', 'Home Page')

@section('content')
    <h1>Users</h1>

    <br>

    <table id="usersDataTable" class="table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>

    <script>
        var table = $(document).ready(function() {

                $('#usersDataTable').DataTable({
                    lengthMenu: [
                        [15, 30, 50, 100, -1],
                        ['15', '30', '50', '100', 'All']
                    ],
                    pageLength: 15,
                    ajax: {
                        url: '{{ route('users.getData') }}',
                         dataType: 'json'
                    },
                    processing: true,
                    serverSide: true,
                    columns: [{
                            data: 'id',
                            name: 'id',
                            className: 'text-center'
                        },
                        {
                            data: 'username',
                            name: 'username',
                            className: 'text-start'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            className: 'text-start'
                        },
                        {
                            data: 'active_status',
                            name: 'active_status',
                            'searchable': false,
                            'orderable': false,
                            className: 'text-center'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            'searchable': false,
                            'orderable': false,
                            className: 'text-center'
                        },
                    ],
                    order: [
                        [0, 'desc']
                    ],
                    columnDefs: [{
                            "targets": 0,
                            "width": "60px"
                        },
                        {
                            "targets": 1,
                            "width": "200px"
                        },
                        {
                            "targets": 2,
                            "width": "250px"
                        },
                        {
                            "targets": 3,
                            "width": "100px"
                        },
                        {
                            "targets": 4,
                            "width": "100px"
                        }
                    ],
                });
            });
    </script>
@endsection
