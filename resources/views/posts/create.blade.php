<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts - Create</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <!-- App Bar -->
    <header class="p-3 mb-4 text-white rounded app-bar bg-primary">
        <h1 class="m-0">Create Post</h1>
    </header>

    <!-- Form Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="shadow card">
                    <div class="card-body">
                        <h4 class="mb-4 text-center card-title">Add a New Post</h4>
                        <form id="storePostForm" action="{{ route('posts.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter the title" required>
                            </div>

                            <div class="form-group">
                                <label for="description" class="font-weight-bold">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter the description" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<style>
    body {
        background-color: #f8f9fa; /* Light background for better aesthetics */
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    .app-bar {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .btn-primary {
        background-color: #007bff; /* Primary button color */
        border: none;
        padding: 10px;
        font-size: 16px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Slightly darker on hover */
        transform: scale(1.02);
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
</style>

<script>
    // Wait for the document to be ready
    $(document).ready(function() {
        // Intercept the form submission
        $("#storePostForm").submit(function(e) {
            e.preventDefault();  // Prevent default form submission (page refresh)

            // Get form data
            var formData = $(this).serialize();

            // Perform AJAX request
            $.ajax({
                url: $(this).attr("action"), // Use the action attribute (the form's route)
                type: "POST", // POST method
                data: formData, // Send form data
                success: function(response) {
                    // You can display a success message here or clear the form fields
                    alert("Post created successfully!");
                    $("#storePostForm")[0].reset(); // Reset the form fields
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    alert("Something went wrong, please try again.");
                }
            });
        });
    });
</script>

</html>
