<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin registration</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
    .form {
      background-color: #fff;
      padding: auto;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      width: 40%;
      flex-direction: column;
      align-items: center;
    }

    .form h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    .form form {
      display: flex;
      width: 100%;
      flex-direction: column;
      align-items: flex-start;
    }

    .form label {
      margin-bottom: 5px;
      color: #333;
      font-weight: bold;
    }

    .form input[type="text"],
    .form input[type="password"],
    .form input[type="number"] {
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      width: 100%;
    }

    .form input[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>

</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Registration</h1>
  </header>

  <section>

<?php
require('db.php');

function validateNumber($number) {
  // Remove any non-digit characters from the number
  $number = preg_replace('/\D/', '', $number);

  // Check if the number is exactly 8 digits long and starts with a 0
  if (preg_match('/^0\d{7}$/', $number)) {
    return true; // Valid number
  } else {
    return false; // Invalid number
  }
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['submit'] === 'Register') {

    $userName = stripslashes($_POST['username']);
    $userName = mysqli_real_escape_string($connection, $userName);

    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($connection, $password);

    $firstName = stripslashes($_POST['firstname']);
    $lastName = stripslashes($_POST['lastname']);
    $address = stripslashes($_POST['address']);
    $mobile = $_POST['mobile'];
    // Validate mobile number
    
    if (validateNumber($mobile)) {
      $query = "INSERT into `admin` (userName, password, firstName, lastName, address, mobile)
        VALUES ('$userName', '".md5($password)."', '$firstName', '$lastName', '$address', '$mobile')";

        $result = mysqli_query($connection, $query);

        if ($result) {
            //disconnect with database
            mysqli_close($connection);
            echo "<div class='form'>
            <h3>Congradulation! You has registered successfully.</h3>
            <a href='login.php'>Click to Login Page</a>
            </div>";
            } else {
            echo "<div class='form-container'>
            <h3>Error: Failed to register. Please try again.</h3>
            </div>";
        }
    } else {
      echo "<div class='form-container'>
        <h3>Error: Mobile number must be a 8-digit integer starting with 0.</h3>
        </div>";
    }
  
} else {
    // Display the form
?>

  <div class="form">
    <h1>Registration</h1>
    <form action="" method="post">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Username" required /><br>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Password" required /><br>

      <label for="firstname">Firstname</label>
      <input type="text" id="firstname" name="firstname" placeholder="Firstname" required /><br>

      <label for="lastname">Lastname</label>
      <input type="text" id="lastname" name="lastname" placeholder="Lastname" required /><br>

      <label for="address">Address</label>
      <input type="text" id="address" name="address" placeholder="Address" required /><br>

      <label for="mobile">Mobile</label>
      <input type="number" id="mobile" name="mobile" placeholder="Mobile" required /><br>

      <input type="submit" name="submit" value="Register" />
    </form>
  </div>
<?php } ?>
    </section>
  <footer> 
  <a href="adminMenu.php">Admin</a>

  </footer>
</body>
</html>
