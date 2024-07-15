<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body class="edit-add-body">
    <div class="container edit-add-container">
        <h2 class="text-center">Add Product</h2>
        <div id="message" class="alert d-none"></div>
        <form id="add-product-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Product Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image1">Image 1</label>
                <input type="file" name="image1" id="image1" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image2">Image 2</label>
                <input type="file" name="image2" id="image2" class="form-control">
            </div>
            <div class="form-group">
                <label for="image3">Image 3</label>
                <input type="file" name="image3" id="image3" class="form-control">
            </div>
            <button type="submit" class="btn btn-success btn-block">Add Product</button>
        </form>
        <div class="mt-3 text-center">
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#add-product-form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: 'add_product_process.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        try {
                            var jsonResponse = JSON.parse(response);
                            if (jsonResponse.success) {
                                $('#message').removeClass('d-none alert-danger').addClass('alert-success').text('Product added successfully!');
                                $('#add-product-form')[0].reset();
                                setTimeout(function() {
                                    window.location.href = 'dashboard.php';
                                }, 2000);
                            } else {
                                $('#message').removeClass('d-none alert-success').addClass('alert-danger').text(jsonResponse.error);
                            }
                        } catch (e) {
                            $('#message').removeClass('d-none alert-success').addClass('alert-danger').text('An unexpected error occurred.');
                        }
                    },
                    error: function () {
                        $('#message').removeClass('d-none alert-success').addClass('alert-danger').text('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
</body>

</html>
