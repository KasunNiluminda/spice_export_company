<?php
session_start();
include '../db.php';

$response = array('success' => false, 'message' => '');

if (isset($_POST['username'], $_POST['password'], $_POST['confirm_password'])) {
    $username = $conn->real_escape_string($_POST['username']); // Prevent SQL injection
    $password = $conn->real_escape_string($_POST['password']); // Prevent SQL injection
    $confirmPassword = $conn->real_escape_string($_POST['confirm_password']); // Prevent SQL injection

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $response['message'] = 'Passwords do not match.';
    } else {
        // Check if username already exists
        $sql = "SELECT * FROM admin WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $response['message'] = 'Username already exists.';
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$hashedPassword')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['admin'] = $username;
                $response['success'] = true;
                $response['message'] = 'Registration successful.';
            } else {
                $response['message'] = 'Error: ' . $conn->error;
            }
        }
    }
}

$conn->close();

echo json_encode($response);
?>
