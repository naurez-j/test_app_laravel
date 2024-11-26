<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts List</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <!-- App Bar -->
    <header class="p-3 mb-4 text-white rounded app-bar bg-primary">
        <h1 class="m-0">Posts</h1>
        <a href="{{ route('posts.create') }}" class="add-button">
            ADD
        </a>
    </header>

    <hr>

    <div class="container">
        <table id="posts-table" class="table display table-striped table-bordered">
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
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).on("click", ".deleteBtn", function() {
            var id = $(this).data('id');
            var url = '{{ route('posts.destroy', ['post' => '__id']) }}'.replace('__id', id);
            Swal.fire({
                title: 'Do you want to delete this post?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
            }).then((result) => {
                if (result.isConfirmed) {
                    destroyData(url, table);
                }
            })
        });

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

<style>
    body {
        background-color: #f8f9fa; /* Light background */
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    .app-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for modern look */
    }

    .app-bar h1 {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
    }

    .add-button {
        display: inline-block;
        background-color: #ffffff;
        color: #007bff;
        border: 2px solid #007bff;
        border-radius: 20px;
        padding: 8px 20px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
    }

    .add-button:hover {
        background-color: #007bff;
        color: white;
        transform: scale(1.05);
    }

    .add-button:active {
        background-color: #0056b3;
        color: white;
        transform: scale(0.95);
    }

    table {
        margin-top: 20px;
    }
</style>

</html>
