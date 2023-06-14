<?php
// Include the database connection file
include('db.php');

// Check if the cabin ID is set and not empty
if(isset($_GET['id']) && !empty($_GET['id'])){
    // Get the cabin ID from the URL parameter
    $cabinID = $_GET['id'];

    // Delete the associated records in the cabininclusion table
    $deleteInclusionStatement = $connection->prepare("DELETE FROM cabininclusion WHERE cabinID = ?");
    $deleteInclusionStatement->bind_param("i", $cabinID);
    $deleteInclusionStatement->execute();

    // Prepare the delete statement for the cabin
    $deleteCabinStatement = $connection->prepare("DELETE FROM cabin WHERE cabinID = ?");
    $deleteCabinStatement->bind_param("i", $cabinID);

    // Execute the delete statement for the cabin
    if($deleteCabinStatement->execute()){
        // Redirect back to the view.php page after successful deletion
        echo '<script>window.location.href = "https://jliu.tafewest.com/sunnyspot/admin/view.php";</script>';

        exit();
    } else {
        // Display an error message if the deletion fails
        echo "Error deleting cabin.";
    }

    // Close the prepared statements
    $deleteInclusionStatement->close();
    $deleteCabinStatement->close();
}

// Close the database connection
$connection->close();
?>
