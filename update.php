<?php
//once staff login successfully
include("processLogin.php");
//connect the database
require('db.php');
//obtain the cabin id once the user clicks on a selected item to be updated
$cabinID=$_REQUEST['id'];
$query = "SELECT * FROM cabininclusion WHERE cabinID = '$cabinID'";
//obtain the cabin inclusion stored in the database
$result = mysqli_query($connection, $query) or die ( mysqli_error($connection));
$selectedInclusions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $selectedInclusions[] = $row['incID'];
}

//obtain the cabin information stored in the database
$query = "SELECT * from cabin where cabinID='".$cabinID."'"; 
$result = mysqli_query($connection, $query) or die ( mysqli_error($connection));
$row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu | Update</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
        .form-field {
            margin-bottom: 15px;
        }
        .form-field label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        .form-field input[type="text"],
        .form-field textarea {
            padding: 5px;
            border: 2px solid #ddd;
            border-radius: 4px;
            width: 250px;
            margin-left: 10px;
        }
        .form-field input[type="submit"] {
            padding: 8px 15px;
            background-color: #1E548E;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }
        .form-field input[type="submit"]:hover {
            background-color: #134170;
        }
        #update-form {
            margin: 5% 30%;
            width: 40%;
            border: 4px solid #26568A;
            border-radius: 10px;
            padding: 15px 20px;
        }
    </style>
</head>
<body>
    <header>
        <img src="images/accommodation.png" alt="Accommodation">
        <h1>Sunny Spot Admin</h1>
    </header>
    <div class="form">
        <h1 style='margin: 0 40%;'>Update Record</h1>
        <?php
        $status = "";
        $feedback = '';
        //validate the input
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['new']) && $_POST['new'] == 1) {
                $cabinType = $_POST['cabinType'];
                $cabinDescription = $_POST['cabinDescription'];
                $pricePerNight = $_POST['pricePerNight'];
                $pricePerWeek = $_POST['pricePerWeek'];
                $selectedInclusions = $_POST['inclusions'];
                // Delete existing records for the cabin from the cabininclusion table
                $query = "DELETE FROM cabininclusion WHERE cabinID='$cabinID'";
                $result = mysqli_query($connection, $query);
                if ($result) {
                    // Insert the updated inclusions for the cabin into the cabininclusion table
                    foreach ($selectedInclusions as $incID) {
                        $query = "INSERT INTO cabininclusion (cabinID, incID) VALUES ('$cabinID', '$incID')";
                        $result = mysqli_query($connection, $query);
                        if (!$result) {
                            // Handle the insertion error if necessary
                            echo "Error inserting inclusion: " . mysqli_error($connection);
                        }
                    }
                    $validation = false;
                    // Validate price per night
                    if ($pricePerNight <= 0 || $pricePerWeek <= 0) {
                        $feedback = "**Price must be a positive integer.**";
                        $validation = false;
                    } else if ($pricePerWeek > 5 * $pricePerNight) {
                        $feedback = "**Price per week cannot exceed 5 times the price per night.**";
                        $validation = false;
                    } else {
                        // Price is valid
                        $validation = true;
                    }
                    if ($validation) {
                        //update all the information except photo into the database.
                        $update = "UPDATE cabin 
                                   SET cabinType = '$cabinType', 
                                       cabinDescription = '$cabinDescription', 
                                       pricePerNight = '$pricePerNight', 
                                       pricePerWeek = '$pricePerWeek' 
                                   WHERE cabinID = '$cabinID'";
                        // Execute the insert query
                        $result = mysqli_query($connection, $update) or die(mysqli_error($connection));
                        if ($result) {
                            // Query executed successfully, perform further actions
                            // Check if a file was uploaded
                            if (isset($_FILES['photo'])) {
                                $filename = $_FILES['photo']['name'];
                                $tempFilePath = $_FILES['photo']['tmp_name'];
                                $targetPath = 'images/' . basename($filename);
                                // Move the uploaded file to the target directory
                                if (move_uploaded_file($tempFilePath, $targetPath)) {
                                    //update photo value for this cabin
                                    $upload = "UPDATE cabin SET photo = '$filename' WHERE cabinID = '$cabinID'";
                                    // Execute the update query
                                    $final_result = mysqli_query($connection, $upload) or die(mysqli_error($connection));
                                    if ($final_result) {
                                        $feedback = "The cabin has been updated successfully.";
                                        //disconnect with database
                                        mysqli_close($connection);
                                        //lead to view page
                                        echo '<script>window.location.href = "https://jliu.tafewest.com/sunnyspot/admin/view.php";</script>';
                                        exit;
                                    } else {
                                        // Query execution failed, display error message or handle the error
                                        $feedback = "Error: " . mysqli_error($connection);
                                    }
                                }
                            }
                            $feedback = "The cabin has been updated successfully.";
                            //disconnect with database
                            mysqli_close($connection);
                            //lead to view page
                            echo '<script>window.location.href = "https://jliu.tafewest.com/sunnyspot/admin/view.php";</script>';
                        } else {
                            // Query execution failed, display error message or handle the error
                            $feedback = "Error: " . mysqli_error($connection);
                        }
                    } else {
                        // validation failed
                        echo "**Please input valid content for new cabin.";
                    }
                }
            }
        } else {
        ?>
        <div id="update-form">
            <form method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="new" value="1" />
                <p class="form-field">
                    <label for="cabinType">Cabin Type:</label>
                    <input type="text" name="cabinType" placeholder="Enter cabin type" required value="<?php echo $row['cabinType']; ?>" />
                </p>
                <p class="form-field">
                    <label for="cabinDescription">Cabin Description:</label>
                    <textarea name="cabinDescription" placeholder="Enter cabin description details" rows='5' cols='32'><?php echo $row['cabinDescription']; ?></textarea>
                </p>
                <!-- Cabin inclusion -->
                <p class="form-field">
                    <label for="inclusion">Inclusions:</label><br>
                    <?php
                    $inclusions = "SELECT * FROM inclusion";
                    $queryInclusions = mysqli_query($connection, $inclusions);
                    while ($row_inc = mysqli_fetch_assoc($queryInclusions)) {
                        $incID = $row_inc['incID'];
                        $incName = $row_inc['incName'];
                        echo "<input type='checkbox' name='inclusions[]' value='$incID'" . (in_array($incID, $selectedInclusions) ? 'checked' : '') . ">$incName<br>";
                    }
                    ?>
                </p>
                <p class="form-field">
                    <label for="pricePerNight">Price per Night:</label>
                    <input type="text" name="pricePerNight" placeholder="Enter cabin price per night" required value="<?php echo $row['pricePerNight']; ?>" />
                </p>
                <p class="form-field">
                    <label for="pricePerWeek">Price per Week:</label>
                    <input type="text" name="pricePerWeek" placeholder="Enter cabin price per week" required value="<?php echo $row['pricePerWeek']; ?>" />
                </p>
                <p class="form-field">Current Photo: <img src="images/<?php echo $row['photo']; ?>" alt="Cabin Photo"></p>
                <p class="form-field">
                    <label for="photo">New Photo:</label>
                    <input type="file" name="photo" accept="image/*" placeholder="Upload the cabin photo" />
                </p>
                <p class="form-field">
                    <input name="submit" type="submit" value="Update" />
                </p>
            </form>

            <?php } ?>
        </div>
    </div>
</div>
<footer>
<a href="adminMenu.php">Admin</a>

</footer>
</body>
</html>

