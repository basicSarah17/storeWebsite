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
 <link rel="stylesheet" href="./css/product.css">

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
<br>


  <div>
    <div class="content">
      <div class="square-container">
      <?php
            require 'config.php';
            $sql = "SELECT * FROM category";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                  echo ' <div class="square"> <a href="product_List.php?product_id=' . $row['CategoryID'] . '" class="product-link"> ' ;
                  echo '<img src="./image/' . $row['CategoryImage'] . '" alt="' . $row['CategoryImage'] . '">';
                  echo '   <div class="caption">  <a href="product_List.php?product_id=' . $row['CategoryID'] . '" class="product-link"> '.$row['CategoryName'] . '    </a>                 </div>' ;
                  echo ' </a>   </div>' ;

                  
                }
            } else {
                echo "No products found.";
            }
            $conn->close(); // Close database connection
            ?>
      </div>
    </div>
  </div>
</body>
</html>