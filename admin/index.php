<html lang="en" dir="ltr">

<head>
  <title>Admin Page</title>
  <link rel="stylesheet" href="./css/admin.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
</head>

<body>
  <header>
    


  <?php
require '../config.php';



if(!isset($_SESSION['username'] ) && !isset($_SESSION['type'] )  && $_SESSION['type'] =="admin" ){


  header( "location: ../login.php" );
  
  
  }
  


require 'navbar.php';

?>




    <img src="../image/logo.jpeg" style="height: 150px; width: 200px;padding-left: 43%;">
  </header>
  <br><br>
  <fieldset>
  <h1 style="text-align: center;">Hello <i style="background-color: darkgray;">admin</i></h1>
    <h2 id="h2id" style="text-align: center;">Choose the product you want</h2>
  </fieldset>
  <br>
  <br>
  <fieldset style="background-image:url(gray.jpeg); background-repeat:repeat">
    <div class="menu">
      <ul>


        <?php
  
        require '../config.php';
        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
             
              echo '  <li><a href="earringAUD.php?CategoryID=' . $row['CategoryID'] . '" id="mlist">'.$row['CategoryName'] . ' </a></li> ';
              
            }
        } else {
            echo "No products found.";
        }
        $conn->close(); // Close database connection
        ?>




      
 
      </ul>
    </div>
  </fieldset>


</body>

</html>