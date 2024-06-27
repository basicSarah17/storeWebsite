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




















  

    <?php   require 'chatPage.php'; ?>
</body>

</html>