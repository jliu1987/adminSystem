<?php
session_start();
// Update logoutDateTime in log table
if (isset($_SESSION['staffID'])) {
    // Connect to the database
    require ('db.php');
    $staffID = $_SESSION['staffID'];
    $updateLogoutTime = "UPDATE log SET logoutDateTime = NOW() WHERE staffID = '$staffID'";
    $result = mysqli_query($connection, $updateLogoutTime);
    if (!$result) {
        // Handle the error if the query fails
        echo "Error updating logoutDateTime: " . mysqli_error($connection);
        exit();
    }
}

// Destroying All Sessions
session_destroy();
// Redirecting To Home Page
echo '<script>window.location.href = "https://jliu.tafewest.com/sunnyspot/admin/login.php";</script>';


exit();
?>
