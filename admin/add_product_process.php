<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

include '../db.php';

if (isset($_POST['title']) && isset($_POST['price'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];

    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];

    $target_dir = "../resources/products/";

    // Create target paths for the images
    $target_file1 = $target_dir . basename($image1);
    $target_file2 = $target_dir . basename($image2);
    $target_file3 = $target_dir . basename($image3);

    // Initialize upload success flag
    $uploadOk = true;

    // Check and move each image file
    if (!empty($image1) && !move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file1)) {
        $uploadOk = false;
    }
    if (!empty($image2) && !move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file2)) {
        $uploadOk = false;
    }
    if (!empty($image3) && !move_uploaded_file($_FILES["image3"]["tmp_name"], $target_file3)) {
        $uploadOk = false;
    }

    if ($uploadOk) {
        // Prepare SQL statement
        $sql = "INSERT INTO products (title, image1, image2, image3, price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('sssss', $title, $image1, $image2, $image3, $price);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error: ' . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to prepare the statement']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to upload images']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
}

$conn->close();
?>
