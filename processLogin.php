<?php
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['userName'])) {
    // Redirect to the login page or display an error message
    echo '<script>window.location.href = "https://jliu.tafewest.com/sunnyspot/admin/login.php";</script>';

    exit();
}
?>