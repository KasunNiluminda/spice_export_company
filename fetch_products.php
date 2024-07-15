<?php
include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$output = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= '
        <div class="col-md-4 mb-4">
            <div class="product card h-100">
                <img src="resources/products/'.$row['image1'].'" class="card-img-top img-fluid" alt="'.$row['title'].'">
                <div class="card-body">
                    <h5 class="card-title">'.$row['title'].'</h5>
                    <p class="card-text">Price: $'.$row['price'].'</p>
                </div>
            </div>
        </div>';
    }
} else {
    $output .= '<div class="col-12"><p>No products available.</p></div>';
}

echo $output;

$conn->close();
?>
