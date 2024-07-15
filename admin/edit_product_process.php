<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

include '../db.php';

if (isset($_POST['title']) && isset($_POST['price']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];

    $sql_image1 = $image1 ? ", image1 = '$image1'" : "";
    $sql_image2 = $image2 ? ", image2 = '$image2'" : "";
    $sql_image3 = $image3 ? ", image3 = '$image3'" : "";

    if ($image1) {
        $target_file1 = "../resources/products/" . basename($image1);
        move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file1);
    }

    if ($image2) {
        $target_file2 = "../resources/products/" . basename($image2);
        move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file2);
    }

    if ($image3) {
        $target_file3 = "../resources/products/" . basename($image3);
        move_uploaded_file($_FILES["image3"]["tmp_name"], $target_file3);
    }

    $sql = "UPDATE products SET title = ?, price = ? $sql_image1 $sql_image2 $sql_image3 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($sql_image1) $stmt->bind_param('sssi', $title, $price, $image1, $id);
    if ($sql_image2) $stmt->bind_param('sssi', $title, $price, $image2, $id);
    if ($sql_image3) $stmt->bind_param('sssi', $title, $price, $image3, $id);
    $stmt->bind_param('ssi', $title, $price, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
}

$conn->close();
