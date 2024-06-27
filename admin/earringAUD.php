<?php


require '../config.php';
$CategoryID=1;
if(isset($_GET['CategoryID'])){


  $CategoryID= $_GET['CategoryID'];





}
if(!isset($_SESSION['username'] ) && !isset($_SESSION['type'] )  && $_SESSION['type'] =="admin" ){


  header( "location: ../login.php" );
  
  
  }
  




?>

<html lang="en" dir="ltr">
    <head>  
        <title>Admin Page</title>
        <link rel="stylesheet" href="./css/earringAUD.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
</head>

    <body>
    <header>
        <?php

require 'navbar.php';

?>
        <img src="../image/logo.jpeg" style="height: 150px; width: 200px;padding-left: 43%;">
        </header>

      <br>
      <br>
<fieldset>
<h1 style="text-align: center;">Hello <i style="background-color: darkgray;">admin</i></h1>
      <h2 id="h2id" style="text-align: center;">Choose what you want to Do?</h2>
    </fieldset>
      <br>
      <br>

      <fieldset  style="background-image:url(gray.jpeg); background-repeat:repeat">
  <div class="menu">
    <ul>
      <li><a href="adminAdd.php?CategoryID=<?php  echo $CategoryID ;?>" id="mlist">Add product</a></li>
      <li><a href="adminUpdate.php" id="mlist">Update product</a></li>
      <li><a href="adminDelete.php" id="mlist">Delete product</a></li>

    </ul>
  </div>
</fieldset>
    </body>
    </html>
    