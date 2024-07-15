<?php
session_start();
include '../db.php';

// Redirect to dashboard.php if session is already started
if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body class="login-register-body">
    <div class="login-register-container">
        <h2 class="text-center">Admin Login</h2>
        <div id="response" class="alert d-none"></div>
        <form id="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="mt-3 text-center">
            <a href="register.php" class="btn btn-secondary btn-block">Create an account</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#login-form').on('submit', function (e) {
                e.preventDefault();

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    type: 'POST',
                    url: 'login_process.php', // Endpoint for processing the form
                    data: formData,
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            window.location.href = 'dashboard.php'; // Redirect to dashboard on success
                        } else {
                            $('#response').removeClass('d-none alert-success').addClass('alert-danger').text(data.message);
                        }
                    },
                    error: function () {
                        $('#response').removeClass('d-none').addClass('alert-danger').text('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
</body>

</html>