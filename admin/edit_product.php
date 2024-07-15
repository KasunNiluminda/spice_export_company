<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body class="edit-add-body">
    <div class="container edit-add-container">
        <h2 class="text-center">Edit Product</h2>
        <div id="message" class="alert d-none"></div>
        <form id="edit-product-form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <div class="form-group">
                <label for="title">Product Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $product['title']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control" value="<?php echo $product['price']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="image1">Image 1</label>
                <input type="file" name="image1" id="image1" class="form-control">
                <?php if ($product['image1']): ?>
                    <img src="../resources/products/<?php echo $product['image1']; ?>" alt="Image 1" class="img-fluid mt-2"
                        style="max-height: 200px;">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="image2">Image 2</label>
                <input type="file" name="image2" id="image2" class="form-control">
                <?php if ($product['image2']): ?>
                    <img src="../resources/products/<?php echo $product['image2']; ?>" alt="Image 2" class="img-fluid mt-2"
                        style="max-height: 200px;">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="image3">Image 3</label>
                <input type="file" name="image3" id="image3" class="form-control">
                <?php if ($product['image3']): ?>
                    <img src="../resources/products/<?php echo $product['image3']; ?>" alt="Image 3" class="img-fluid mt-2"
                        style="max-height: 200px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-warning btn-block">Edit Product</button>
        </form>
        <div class="mt-3 text-center">
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#edit-product-form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: 'edit_product_process.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        try {
                            var jsonResponse = JSON.parse(response);
                            if (jsonResponse.success) {
                                $('#message').removeClass('d-none alert-danger').addClass('alert-success').text('Product updated successfully!');
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