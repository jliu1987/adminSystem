<?php
//once staff login successfully, the database will be connected
include("processLogin.php");
require('db.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrative menu</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
#admin-menu {
  
  background-color: #fff;
  padding: 20px;
  text-align: center;
  z-index: 9999;
  border: 4px solid #26568A;
  border-radius: 10px;
}

#admin-menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

#admin-menu li {
  margin-bottom: 10px;
}

#admin-menu a {
  display: block;
  padding: 10px;
  text-decoration: none;
  color: black;
  border-radius: 4px;
  font-size: 18px;
  
}

#admin-menu a:hover {
  background-color: #26568A;
  color:#fff;
}

#admin-menu a.active {
  background-color: #fff;
  color:#2B4D71;
  font-weight: bold;
}

</style>
</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Sunny Spot Administrative menu</h1>
  </header>

 <section>
 <!-- This is admin menu -->


<div id="admin-menu">
  <ul>
    <li><a href="allCabins.php">Home</a></li>
    <li><a href="form-add.php">Insert New Record</a></li>
    <li><a href="view.php">View Records</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</div>

</section>

  <footer> 
    <a href="adminMenu.php">Admin</a>
  </footer>
</body>
</html>


    