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
  
<title>6diamonds</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
 <link rel="stylesheet" href="./css/design.css">

  <script>
    function redirectToPage(url) {
      window.location.href = url;
    }
  </script>
  <header>
<?php
require 'navbar.php';

?>
    <img src="./image/logo.jpeg" style="height: 150px; width: 200px;padding-left: 43%;">
 
    </header>
</head>
<body>

<br><br>
<br>
  <div>
    <div class="content">
      <div class="square-container">

        <div class="square" onclick="redirectToPage('design1.php')">
          <img src="./image/ringno.jpeg" alt="Ring">
          <div class="caption">Rings</div>
        </div>
        
        <div class="square" onclick="redirectToPage('design1.php')">
          <img src="./image/neckno.jpeg" alt="Necklace">
          <div class="caption">Necklaces</div>
        </div>

        <div class="square" onclick="redirectToPage('design1.php')">
          <img src="./image/earringno.jpeg" alt="Earring">
          <div class="caption">Earrings</div>
        </div>

        <div class="square" onclick="redirectToPage('design1.php')">
          <img src="./image/barno.jpg" alt="Bracelet">
          <div class="caption">Bracelets</div>
        </div>

      </div>
    </div>
  </div>
  <script>
    function redirectToPage(url) {
      window.location.href = url;
    }
  </script>
</body>
</html>