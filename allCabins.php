
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunnspot Accommodation</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?php
  //connect the database
require ('db.php');
  //obtain all the cabins available in the database
    //select all the cabins available in the database
    $select = "SELECT cabin.*, GROUP_CONCAT(inclusion.incName SEPARATOR ', ') AS inclusions
    FROM cabin 
    LEFT JOIN cabininclusion ON cabin.cabinID = cabininclusion.cabinID
    LEFT JOIN inclusion ON cabininclusion.incID = inclusion.incID
    GROUP BY cabin.cabinID";
    $query=mysqli_query($connection, $select);
 
  ?>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Sunnspot Accommodation</h1>
  </header>
  <main>
  <section>
    <article>
      <h2>Standard Cabin</h2>
      <img src="images/stCabin.jpg" alt="Standard Cabin">
      <p><span>Details: </span>2 bedroom cabin with double in main and either double or 2 singles in the second bedroom </p>
      <p><span>Price per night: </span>$100</p>
      <p><span>Price per week: </span>$1000</p>
    </article>
<?php
      $num=mysqli_num_rows($query);
  
      if($num>0){
        //loop the seleted cabins
        while($result=mysqli_fetch_assoc($query)){?>
          <!-- display cabin type, description, inclusions, price per night, price per week and photo for each cabin available in database-->
          <article>
            <h2><?=$result['cabinType'];?></h2>
            <?php
            $filename = $result['photo'];
            // Construct the image source path
            $imagePath = "images/" . $filename;
            // Output the image
            echo '<img src="' . $imagePath . '" alt="Cabin Photo">';
            ?>
            <p><span>Details: </span><?=$result['cabinDescription'];?></p>
            <p><span>Inclusions: </span><?= $result['inclusions']; ?></p>
            <p><span>Price per night: </span>$<?=$result['pricePerNight'];?></p>
            <p><span>Price per week: </span>$<?=$result['pricePerWeek'];?></p>
          </article>
<?php }}?>
      
  </section>
  
  </main>
  
  <footer> 
    <!-- linked to login page for authorization check before accessing the admin menu -->

    <a href="adminMenu.php">Admin</a>

   </footer>
</body>
</html>