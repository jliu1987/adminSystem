<?php
include("processLogin.php");
require('db.php');

$feedback = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['submit'] === 'Add') {
    $cabinType=$_POST['cabinType'];
    $cabinDescription=$_POST['cabinDescription'];
    $pricePerNight=$_POST['pricePerNight'];
    $pricePerWeek=$_POST['pricePerWeek'];
    $validation=false;
    $photo="testCabin.jpg";
    $selectedInclusions = $_POST['inclusions'];
    // Validate price per night
    if ($pricePerNight <= 0 || $pricePerWeek <= 0) {
        $feedback= "**Price must be a positive integer.**";
        $validation=false;
    } else if ($pricePerWeek > 5 * $pricePerNight) {
        $feedback="**Price per week cannot exceed 5 times the price per night.**";
        $validation=false;

    } else {
        // Price is valid
        $validation=true;
    }
    if($validation){
        //insert all the information except photo into the database. the photo value is set as default
        
        $insert = "INSERT INTO cabin (cabinType, cabinDescription, pricePerNight, pricePerWeek, photo) 
        VALUES ('$cabinType', '$cabinDescription', '$pricePerNight', '$pricePerWeek', '$photo')";
        
        // Execute the insert query
        $result = mysqli_query($connection, $insert)or die(mysqli_error($connection));
    
        $cabinID = mysqli_insert_id($connection); // Retrieve the generated cabinID
        // Insert the associated cabinID and incID values into the `cabinInclusion` table
        foreach ($selectedInclusions as $incID) {
                
            $insertCabinInclusion = "INSERT INTO cabininclusion (cabinID, incID) VALUES ('$cabinID', '$incID')";
            mysqli_query($connection, $insertCabinInclusion);
        }
        if ($result) {
        

            // Check if a file was uploaded
            if (isset($_FILES['photo'])) {
                $filename = $_FILES['photo']['name'];
                $tempFilePath = $_FILES['photo']['tmp_name'];
                $targetPath = 'images/' . basename($filename);

                if (move_uploaded_file($tempFilePath, $targetPath)) {
                    // Update the photo value for the newly created cabin
                    $update = "UPDATE cabin SET photo = '$filename' WHERE cabinID = '$cabinID'";
                    mysqli_query($connection, $update);
                    mysqli_close($connection);
                    echo '<script>window.location.href = "https://jliu.tafewest.com/sunnyspot/admin/view.php";</script>';
            exit;
                } else {
                    // File upload failed
                    echo "Sorry, there was an error uploading the image.";
                }
            }
            mysqli_close($connection);
            echo '<script>window.location.href = "https://jliu.tafewest.com/sunnyspot/admin/view.php";</script>';
            exit;
        } else {
            $feedback = "Error: " . mysqli_error($connection);
        }
}else{
    // validation failed
    echo "**Please input valid content for new cabin.";
  }
      
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu | Add</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
    <img src="images/accommodation.png" alt="Accommodation">
    <h1>Add a new cabin</h1>
</header>

<section>
    <span><?= $feedback; ?></span>
</section>

<footer>
    <a href="adminMenu.php">Admin</a>
</footer>
</body>
</html>
