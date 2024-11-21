<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts List</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


    <a href="{{ route('posts.create') }}">
        <button>
            ADD
        </button>
    </a>

    <br>
    <br>

<table id="posts-table" class="display">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Is Liked</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data will be populated by DataTables -->
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#posts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('posts.index') }}',
                type: 'GET',
            },
            columns: [
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'is_liked', name: 'is_liked' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>

</body>
</html>
