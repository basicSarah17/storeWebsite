<?php
// Include the database connection file
require '../config.php';


if(!isset($_SESSION['username'] ) && !isset($_SESSION['type'] )  && $_SESSION['type'] =="admin" ){


    header( "location: ../login.php" );
    
    
    }
    
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if product_id is set and not empty
    if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
        // Sanitize input data to prevent SQL injection
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

        // Prepare and execute the SQL query to delete the product
        $sql = "DELETE FROM Product WHERE ProductID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id); // Assuming ProductID is an integer, change the "i" if necessary

        if ($stmt->execute()) {
            echo "Product deleted successfully!";
        } else {
            echo "Error deleting product: " . $stmt->error;
        }
        $stmt->close(); // Close prepared statement
    } else {
        echo "Product ID is required!";
    }
}
?>



<html lang="en" dir="ltr">
    <head>  
        <title>Admin delete Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <link rel="stylesheet" href="./css/adminDelete.css">

</head>



    <body>   
        
    <header>
    <?php

require 'navbar.php';

?>
        <img src="../image/logo.jpeg" style="height: 150px; width: 200px;padding-left: 43%;">
        </header>



      <h2 style="background-color: rgb(202, 199, 199);">Delete Product</h2>
      <fieldset>
      <form action="" method="POST">
        <label for="product_id">Product ID:</label>
        <input type="text" id="product_id" name="product_id" required><br>
        <br><br>
        <input type="submit" value="Delete Product">
      </form></fieldset>
    </body>
    </html>
    