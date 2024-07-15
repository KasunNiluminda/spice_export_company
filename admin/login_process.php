<?php
session_start();
include '../db.php';

$response = array('success' => false, 'message' => '');

if (isset($_POST['username'], $_POST['password'])) {
    $username = $conn->real_escape_string($_POST['username']); // Prevent SQL injection
    $password = $conn->real_escape_string($_POST['password']); // Prevent SQL injection

    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin['username'];
            $response['success'] = true;
            $response['message'] = 'Login successful.';
        } else {
            $response['message'] = 'Invalid password.';
        }
    } else {
        $response['message'] = 'Invalid username.';
    }
}

$conn->close();

echo json_encode($response);
?>
