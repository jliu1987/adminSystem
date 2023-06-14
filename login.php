<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
    .form-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .form-container h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }
    .form-container form {
      display: flex;
      flex-direction: column;
    }
    .form-container input[type="text"],
    .form-container input[type="password"] {
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      width: 20%;
      margin:1% 40%;
    }
    .form-container input[type="submit"] {
      padding: 10px 20px;
      background-color: #1E548E;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 20%;
      margin:1% 40%;
    }
    .form-container input[type="submit"]:hover {
      background-color: #2C3D4F;
    }
    .form-container p {
      margin-top: 10px;
      text-align: center;
    }
    .form-container p a {
      color: #007bff;
      text-decoration: none;
    }
    .form-container p a:hover {
      text-decoration: underline;
    }
    .form-container label {
      margin-bottom: 5px;
      color: #333;
      font-weight: bold;
      margin:0 40%;
    }
  </style>
  <script>
    function displayError() {
        alert("Username/password is incorrect.");
    }
    </script>
</head>

<body>
<header>
    <img src="images/accommodation.png" alt="Accommodation">
    <h1>Sunny Spot</h1>
</header>

<?php
// Connect to the database
require('db.php');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// validate the input
if (isset($_POST['username'])) {
    // Removes backslashes
    $username = stripslashes($_REQUEST['username']);
    // Escapes special characters in a string
    $username = mysqli_real_escape_string($connection, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($connection, $password);
    // Checking if the user exists in the database
    $query = "SELECT * FROM `admin` WHERE userName='$username' AND password='" . md5($password) . "'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
       // If the username and password match those in the database
       $_SESSION['userName'] = $username;
       // Get the staffID from the database
       $row = mysqli_fetch_assoc($result);
       $staffID = $row['staffID'];
       // Set the staffID in the session
       $_SESSION['staffID'] = $staffID;

       // Insert log entry for login
       $insertLoginLog = "INSERT INTO log (staffID, loginDateTime) VALUES ('$staffID', NOW())";
       $resultLoginLog = mysqli_query($connection, $insertLoginLog);

        // Redirect user to admin menu page
        echo '<script>window.location.href = "https://jliu.tafewest.com/sunnyspot/admin/adminMenu.php";</script>';
        exit();
    } else {
        echo "<script>displayError();</script>";
        echo "<div class='form'>
            <h3 style='margin:20px 40px; padding: 15px;'>Username/password is incorrect.</h3>
            <br/>Click here to <a href='login.php'>Login</a>
        </div>";
    }
} else {
    ?>
    <div class="form-container">
        <h1>Log In</h1>
        <form action="" method="post" name="login">
            <label for="username" style="font-size: 14px;">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required/>

            <label for="password" style="font-size: 14px;">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required/>

            <input name="submit" type="submit" value="Login"/>
        </form>
        <p>Not registered yet? <a href="registration.php">Register Here</a></p>
    </div>
    <?php
}
?>
<footer>
<a href="adminMenu.php">Admin</a>

</footer>
</body>
</html>
