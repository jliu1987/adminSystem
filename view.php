
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Cabins</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>

  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Update/Delete a cabin</h1>
  </header>
  <main>
    <!-- display cabin information in a table -->
    <!-- add table head -->
    
  <table style='border-collapse: collapse;width: 100%; margin: 5px 25px;width:80%;' >
    <tr style="background-color:#2B4D71; color:#fff;">
      <th style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'>Cabin ID</th>
      <th style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px; '>Cabin type</th>
      <th style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'>Description</th>
      <th style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'>Inclusions</th>
      <th style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'>Price per night</th>
      <th style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'>Price per week</th>
      <th style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'>Photo</th>
      <th style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;' colspan="2">Operation</th>
    

    </tr>
 
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
   

    //save the number of cabins in a variable
      $num=mysqli_num_rows($query);
    //check if there is any cabin available in the database
      if($num>0){
        //loop for each cabin information
        while($result=mysqli_fetch_assoc($query)){?>
          <!-- each cabin information will be displayed in a row -->
        
          <tr style=' border: 1px solid #2B4D71;  text-align: left;'>
            <td style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'> <?=$result['cabinID'];?></td>
            <td style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'><?=$result['cabinType'];?></td>
            <td style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'><?=$result['cabinDescription'];?></td>
            <td style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'><?=$result['inclusions'];?></td>
            <td style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'><?=$result['pricePerNight'];?></td>
            <td style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'><?=$result['pricePerWeek'];?></td>
            <td style=' border: 1px solid #2B4D71; text-align: left; padding: 10px 15px;'><?=$result['photo'];?></td>   
            <!-- linked to update.php for editing -->

            <td><a href='update.php?id=<?=$result['cabinID'];?>' 
            style="margin: 0 5px; font-size: 14px; display: inline-block; padding: 5px 10px; background-color: #1E548E; color: #fff; text-decoration: none; border-radius: 4px; border: 2px solid #1E548E; text-align: center; cursor: pointer;">
            Update</a></td>
            <!-- linked to delete.php for delete. once the button clicked, the select row of cabin will be deleted directly not only on the page but also from the database -->
            <td><a href='delete.php?id=<?=$result['cabinID'];?>' 
            style="margin: 0 5px; font-size: 14px; display: inline-block; padding: 5px 10px; background-color: #1E548E; color: #fff; text-decoration: none; border-radius: 4px; border: 2px solid #1E548E; text-align: center; cursor: pointer;">
            Delete</a></td></tr>
        <?php }}?>
    

  </table>

  </main>
  
  <footer> 
    <!-- linked to login page for authorization check before accessing the admin menu -->

    <a href="adminMenu.php">Admin</a>

   </footer>
</body>
</html>