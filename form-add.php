
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu | Add</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
      .form-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 50%;
        margin: 0 auto;
      }
    
      .form-container label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
      }
      .form-container input[type="checkbox"]{
        padding: 10px;
        margin-bottom: 10px;
        width: 20%;
      }
    
      .form-container input[type="text"],
      .form-container textarea,
      .form-container input[type="number"],
      .form-container input[type="file"] {
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
      }
    
      .form-container input[type="submit"] {
        padding: 10px 20px;
        background-color: #1E548E;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
    
      .form-container input[type="submit"]:hover {
        background-color: #2C3D4F;
      }
    </style>
</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Add a new cabin</h1>
  </header>
  
 
  <div class="form-container">
    <!-- Update form -->
    <form action="add.php" method="post" enctype="multipart/form-data">
  
      <!-- Cabin type -->
      <label for="type">Please enter the type of the cabin:</label>
      <input id="type" type="text" name="cabinType" required>
  
      <!-- Cabin description -->
      <label for="description">Please enter the description of the cabin:</label>
      <textarea id="description" name="cabinDescription" cols="50" rows="5" required>Details</textarea>
      <!-- Cabin inclusion -->
      <label for="inclusion">Please select the inclusions for the cabin:</label>
      <?php
      require ("db.php");
      $selectInclusions = "SELECT * FROM inclusion";
      $queryInclusions = mysqli_query($connection, $selectInclusions);
      while ($row = mysqli_fetch_assoc($queryInclusions)) {
        $incID = $row['incID'];
        $incName = $row['incName'];
        echo "<input type='checkbox' name='inclusions[]' value='$incID'>$incName<br>";
    }
      ?>
      <!-- Price per night -->
      <br><label for="pricePerNight">Please enter the price per night for the cabin:</label>
      <input id="pricePerNight" type="number" name="pricePerNight" required>
  
      <!-- Price per week -->
      <label for="pricePerWeek">Please enter the price per week for the cabin:</label>
      <input id="pricePerWeek" type="number" name="pricePerWeek" required>
  
      <!-- Photo selection -->
      <label for="photo">Please select a new photo for the cabin:</label>
      <input type="file" name="photo" accept="image/*">
  
      <!-- Submit button -->
      <input type="submit" name="submit" value="Add">
     
    </form>
  </div>
  
  <footer> 
    <!-- This is linked to admin menu -->
    <a href="adminMenu.php">Admin</a>

  </footer>
</body>
</html>
