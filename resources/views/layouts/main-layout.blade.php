<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Default Title' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include jQuery (before DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
    </script>

</head>

<body>
    <!-- App Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $title ?? 'Default Title' }}</a>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    contentType: 'application/json', // Set content type to JSON
    dataType: 'json'  // Expecting JSON response from the server
});







            storeData = function(
                action,
                method,
                formData,
                modal = null,
                table = null,
                redirect = null
            ) {
                $.ajax({
                    url: action,
                    type: method,
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        // showLoading();
                    },
                    success: function(response, status, xhr) {
                        if (xhr.status === 200) {
                            if (table) {
                                flasher.success(response.message);
                                table.ajax.reload();
                            }
                            if (modal) {
                                flasher.success(response.message);
                                $(modal).modal("hide");
                            }
                            if (redirect) {
                                location.href = redirect;
                            }
                        } else if (xhr.status === 204) {
                            flasher.warning("Please make any changes.");
                        } else if (xhr.status === 205) {
                            flasher.error(response.message);
                        } else {
                            flasher.error("Internal server error.");
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            displayValidationErrors(errors);
                        } else {
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                flasher.error(xhr.responseJSON.error);
                            } else {
                                flasher.error("Internal server error.");
                            }
                        }
                    },
                    complete: function() {
                        // hideLoading();
                    },
                });
            };

            displayValidationErrors = function(errors) {
                $.each(errors, function(key, value) {
                    var error = "";
                    $.each(value, function(index, errorMessage) {
                        error = error + errorMessage + " <br>";
                    });
                    var keyForClass = key.replace(/\./g, "_");
                    $(".error_" + keyForClass)
                        .html(error)
                        .closest(".form-group")
                        .addClass("border--red");
                });
            };

            changeStatus = function(url, table = null, id) {
                Swal.fire({
                    title: "Are You Sure??", //Do you want to delete this User?//r
                    showCancelButton: true,
                    confirmButtonText: "Yes", //Delete
                }).then((result) => {
                    if (result.isConfirmed) {
                        // destroyData(url, table);

                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                id: id
                            },
                            beforeSend: function() {
                                //showLoading();
                            },
                            success: function(response, status, xhr) {
                                if (xhr.status === 200) {
                                    flasher.success(response.message);
                                    if (table) {
                                        table.ajax.reload();
                                    }
                                } else {
                                    flasher.error("Internal server error.");
                                }
                            },
                            error: function(xhr) {
                                if (xhr.status === 406) {
                                    flasher.warning(xhr.responseJSON.error);
                                    if (table) {
                                        table.ajax.reload();
                                    }
                                } else {
                                    flasher.error("Internal Server Error.");
                                }
                            },
                            complete: function() {
                                // hideLoading();
                            },
                        });
                    }
                });
            };

            changeActiveStatus = function(url, table = null) {
                Swal.fire({
                    title: "Are You Sure??", //Do you want to delete this User?//r
                    showCancelButton: true,
                    confirmButtonText: "Yes", //Delete
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: "GET",
                            beforeSend: function() {
                                // showLoading();
                            },
                            success: function(response, status, xhr) {
                                if (xhr.status === 200) {
                                    flasher.success(response.message);
                                    if (table) {
                                        table.ajax.reload();
                                    }
                                } else if (xhr.status === 203) {
                                    flasher.warning(
                                        "You cannot change logged user details.");
                                } else {
                                    flasher.error("Internal server error.");
                                }
                            },
                            error: function(xhr) {
                                if (xhr.responseJSON && xhr.responseJSON.error) {
                                    flasher.error(xhr.responseJSON.error);
                                } else {
                                    flasher.error("Internal Server Error.");
                                }
                            },
                            complete: function() {
                                // hideLoading();
                            },
                        });
                    }
                });
            };

            destroyData = function(url, table = null) {
                $.ajax({
                    url: url,
                    type: "DELETE",
                    beforeSend: function() {
                        //showLoading();
                    },
                    success: function(response, status, xhr) {
                        if (xhr.status === 200) {
                            flasher.success(response.message);
                            if (table) {
                                table.ajax.reload();
                            }
                        } else if (xhr.status === 203) {
                            flasher.warning("You cannot change logged user details.");
                        } else {
                            flasher.error("Internal server error.");
                        }
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            flasher.error(xhr.responseJSON.error);
                        } else {
                            flasher.error("Internal server error.");
                        }
                    },
                    complete: function() {
                        // hideLoading();
                    },
                });
            };

            exportFile = function(url) {
                window.open(url, "_blank");
            };

        });
    </script>
    @yield('scripts')
</body>



</html>
