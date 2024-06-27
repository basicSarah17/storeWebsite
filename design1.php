<?php

// Start the session if it's not already started
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start(); 

  if(isset($_SESSION['username'])){
      $UserID = $_SESSION["UserID"];
      $username = $_SESSION['username'];
  }
}


?>
<html>
<head>
  
<title>spical design</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
 <link rel="stylesheet" href="./css/designs.css">

  <script>
    function redirectToPage(url) {
      window.location.href = url;
    }
  </script>
</head>
<body>



<header>
<?php
require 'navbar.php';

?>
    <img src="./image/logo.jpeg" style="height: 150px; width: 200px;padding-left: 43%;">
 
    </header>
<br><br>
        <p><h3 style="color: #333;font-family:Lucida Handwriting;font-size: 20px;">YOU MAY UPLOAD YOUR <i style="color: #656464;">OWN DESIGN</i> FROM HERE!</h3></p>
    <form action="cart.php" method="post" enctype="multipart/form-data">
        <input style="font-family:serif; background-color: #e0dcdc;"type="file" name="fileUpload" id="fileUpload"><br><hr>
    </form>
    <p style="font-size:20px;"><b>From below </b> <i style="color: #333;font-family:Lucida Handwriting;font-size: 18px;">Select </i><b> What you Like:</b></p><br><br>
      <label style="font-size: 19px;font-family:serif;">Size: </label>
        <select id="ringss" name="rings">
        <option >5</option>
        <option >6</option>
        <option >7</option>
        <option >8</option>
        <option >9</option>
        <option >10</option>

        </select>
    <br><br>
        <label style="font-size: 19px;font-family:serif;background-color: #e0dcdc">Diamond Size: </label>
        <label><input id="small" name="p1" type="radio"><img src="./image/small.jpeg" style="width: 100px;"></label>
        <label><input id="mid" name="p1" type="radio"><img src="./image/mid.jpeg" style="width:100px"></label>
        <label><input id="lar" name="p1" type="radio"><img src="./image/lar.jpeg" style="width:100px"></label>
        <label><input id="larlar" name="p1" type="radio"><img src="./image/larlar.jpeg" style="width:100px"></label>
    <br><br>
        <label style="font-size: 19px;font-family:serif;background-color: #e0dcdc;">Diamond Shape: </label>
        <label><input id="small" name="p2" type="radio"><img src="./image/heart.jpeg" style="width: 100px;"></label>
        <label><input id="mid" name="p2" type="radio"><img src="./image/rid.jpeg" style="width:100px"></label>
        <label><input id="lar" name="p2" type="radio"><img src="./image/oval.jpeg" style="width:100px"></label>
         <label><input id="larlar" name="p2" type="radio"><img src="./image/princess.jpeg" style="width:100px"></label>
    <br><br>
        <label style="font-size: 19px;font-family:serif;background-color: #e0dcdc;">Diamond Color: </label>
        <label  style="color: silver;"><input id="dimcolor" name="c1" type="radio">SILVER</label>
        <label style="color: gold;"><input id="dimcolor" name="c1" type="radio">GOLD</label>
        <label style="color:rgb(183,110,121)"><input id="dimcolor" name="c1" type="radio">GOLDEN ROSE</label>
    
    <br><br>
        <input style="font-family:serif; background-color: #e0dcdc;" type="button" onclick="alert('Your desing have been saved💙')" value="Add To The Cart" >
        <?php   require 'chatPage.php'; ?>
</body>
</html>
</body>
