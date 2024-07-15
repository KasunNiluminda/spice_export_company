<?php
include '../db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productId = $row['id'];
        $productName = $row['title'];
        $productPrice = $row['price'];
        $productImage = $row['image1'];

        echo '<div class="col-md-4 product-item" data-id="' . $productId . '">';
        echo '    <div class="card product-card">';
        echo '        <img src="../resources/products/' . $productImage . '" class="card-img-top" alt="' . htmlspecialchars($productName) . '">';
        echo '        <div class="card-body">';
        echo '            <h5 class="card-title">' . htmlspecialchars($productName) . '</h5>';
        echo '            <p class="card-text">$' . number_format($productPrice, 2) . '</p>';
        echo '            <a href="edit_product.php?id=' . $productId . '" class="btn btn-primary">Edit</a>';
        echo '            <button class="btn btn-danger delete-product" data-id="' . $productId . '">Delete</button>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo '<p>No products available.</p>';
}

$conn->close();
?>
