<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$adminName = $_SESSION['admin'];  // Get the admin's username from the session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo htmlspecialchars($adminName); ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .product-card {
            margin-bottom: 1.5rem;
        }

        .product-card img {
            height: 150px;
            object-fit: cover;
        }

        .modal-backdrop.show {
            opacity: 0.5 !important;
        }

        .modal-dialog {
            max-width: 400px;
        }

        .modal-content {
            border-radius: 8px;
        }

        .message-box {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
        }
    </style>
</head>

<body>
    <div class="container ">
        <div class="bg-primary ">
            <h2 class="my-4 text-center p-3">Admin Dashboard</h2>
        </div>


        <h3 class="my-4 text-center">Welcome, <?php echo htmlspecialchars($adminName); ?>!</h3>
        <!-- Display welcome message -->
        <a href="add_product.php" class="btn btn-success mb-3">Add Product</a>
        <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
        <h3 class="mb-4 text-center">Product List</h3>
        <div id="message-box" class="message-box"></div> <!-- Message box for success/error messages -->
        <div id="product-list" class="row">
            <!-- Product list will be loaded here -->
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "../footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            loadProducts();

            function loadProducts() {
                $.ajax({
                    url: 'fetch_products_admin.php',
                    method: 'GET',
                    success: function (response) {
                        $('#product-list').html(response);
                        bindDeleteButtons();
                    }
                });
            }

            function bindDeleteButtons() {
                $('.delete-product').on('click', function () {
                    var productId = $(this).data('id');
                    $('#confirm-delete').data('id', productId);  // Store productId in confirm-delete button
                    $('#confirmationModal').modal('show');  // Show confirmation modal
                });

                $('#confirm-delete').on('click', function () {
                    var productId = $(this).data('id');
                    $.ajax({
                        url: 'delete_product.php',
                        method: 'POST',
                        data: { id: productId },
                        success: function (response) {
                            var data = JSON.parse(response);
                            if (data.success) {
                                loadProducts();
                                $('#message-box').html('<div class="alert alert-success text-center">' + data.message + '</div>');
                                setTimeout(() => $('#message-box').empty(), 3000);  // Clear message box after 3 seconds
                            } else {
                                $('#message-box').html('<div class="alert alert-danger text-center">' + data.message + '</div>');
                                setTimeout(() => $('#message-box').empty(), 3000);  // Clear message box after 3 seconds
                            }
                            $('#confirmationModal').modal('hide');  // Hide confirmation modal
                        },
                        error: function () {
                            $('#message-box').html('<div class="alert alert-danger text-center">An error occurred. Please try again.</div>');
                            setTimeout(() => $('#message-box').empty(), 3000);  // Clear message box after 3 seconds
                            $('#confirmationModal').modal('hide');  // Hide confirmation modal
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>