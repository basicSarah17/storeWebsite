

















<?php
// Include your database connection file
require 'config.php';


if(!isset($_SESSION['username'])){


  echo "<script>alert('you must login'); </script>";

  header( "location: index.php" );
  
  }


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the product ID is set in the form submission
    if (1) {
        // Sanitize and validate form data
        $city = $_POST['city'];
        $Street = $_POST['Street'];;
        $Neighborhood = $_POST['Neighborhood'];
        $Housenumber = $_POST['Housenumber'];
        $Morelocationinfo = $_POST['Morelocationinfo'];
        $payment=$_POST['payment'];
        $user_id = $_SESSION["UserID"];
        $Statue="waiting";
        $stmt = $conn->prepare("INSERT INTO deliveryaddress (city, Street, Neighborhood, Housenumber,Morelocationinfo) VALUES (?, ?, ?, ?,?)");
        $stmt->bind_param('sssss', $city, $Street, $Neighborhood, $Housenumber,$Morelocationinfo);
        // Execute the prepared statement
        if ($stmt->execute()) {
        
            $address= mysqli_insert_id($conn);
            $stmt1= $conn->prepare("INSERT INTO customerorders (CustomerID, Statue, PaymentMethod, adress_id) VALUES (?, ?, ?, ?)");
            $stmt1->bind_param('issi', $user_id, $Statue,$payment, $address );
            $stmt1->execute();
            $order_id= mysqli_insert_id($conn);
            $cartItemsQuery = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
            $cartItemsQuery->bind_param('i', $user_id);
            $cartItemsQuery->execute();
            $cartItemsResult = $cartItemsQuery->get_result();
            // Store the fetched cart items in an array
            $cartItems = array();
            $stmt = $conn->prepare("INSERT INTO orderdetails (order_id, product_id, Quantity, size,Price) VALUES (?, ?, ?, ?,?)");
            
            
            while ($row = $cartItemsResult->fetch_assoc()) {
            
              $Quantity=1;
              $product_id=$row['product_id'];
              $size=$row['size'];
              $Price=1;
            
              $stmt->bind_param('iiiii',$order_id, $user_id, $product_id, $size, $Price);
                    
              $stmt->execute();
            

            }
            

            $stmt = $conn->prepare("DELETE  FROM cart WHERE user_id = ?");
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            // Close the cart items query
            $cartItemsQuery->close();

            echo "<script>alert('Your product has been added💫 with ID:')</script>";
          
            
        } else {
         
            echo "Error inserting into cart table: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        // Handle form data validation errors
        echo "Invalid form data.";
    }
}

?>


<!DOCTYPE html>
<html lang ="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
  
  <title>Multi Step Form</title>
  <title>order</title>

  <style>

@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  outline: none;
  font-family: 'Poppins', sans-serif;
}

::selection{
  color: #fff;
  background: #444;
}
.container{
 
  background: #fff;
  text-align: center;
  border-radius: 5px;
  padding: 50px 35px 10px 35px;


}

.shopping-cart {
    width: 750px;
 
    margin: 80px auto;
   
    box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);
    border-radius: 6px;


    
    border: 5px solid silver;



   
    display: flex;
    flex-direction: column;
  }

@media (max-width: 800px) {
    .container-cart {
      width: 100%;
      height: auto;
      overflow: hidden;
    }
    .item {
      height: auto;
      flex-wrap: wrap;
      justify-content: center;
    }
    .image img {
      width: 50%;
    }
    .image,
    .quantity,
    .description {
      
      
    }
    .buttons {
      margin-right: 20px;
    }
  }
  .total-price {
    width: 83px;
    padding-top: 27px;
    text-align: center;
    font-size: 16px;
    color: #E1E8EE;
    font-weight: 300;
  }
.container header{
  font-size: 35px;
  font-weight: 600;
  margin: 0 0 30px 0;
}
.container .form-outer{
  width: 100%;
  overflow: hidden;
}
.container .form-outer form{
  display: flex; 
  width: 400%;
}
.form-outer form .page{
  width: 25%;
  transition: margin-left 0.3s ease-in-out;
}
.form-outer form .page .title{
  text-align: left;
  font-size: 25px;
  font-weight: 500;
}
.form-outer form .page .field{
                                                      
  height: 45px;
  margin: 45px 0;
  display: flex;
  position: relative;
}
form .page .field .label{
  position: absolute;
  top: -30px;
  font-weight: 500;
}
form .page .field input{
  height: 100%;
  width: 100%;
  border: 1px solid lightgrey;
  border-radius: 5px;
  padding-left: 15px;
  font-size: 18px;
}
form .page .field select{
  width: 100%;
  height: 100%;;
  padding-left: 10px;
  font-size: 17px;
  font-weight: 500;
}
form .page .field button{
  width: 100%;
  height: calc(100% + 5px);
  border: none;
  background: #444;
  margin-top: -20px;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  font-size: 18px;
  font-weight: 500;
  letter-spacing: 1px;
  text-transform: uppercase;
  transition: 0.5s ease;
}
form .page .field button:hover{
  background: #000;
}
form .page .btns button{
  margin-top: -20px!important;
}
form .page .btns button.prev{
  margin-right: 3px;
  font-size: 17px;
}
form .page .btns button.next{
  margin-left: 3px;
}
.container .progress-bar{
  display: flex;
  margin: 40px 0;
  user-select: none;
}
.container .progress-bar .step{
  position: relative;
  text-align: center;
  width: 100%;
}
.container .progress-bar .step p{
  font-size: 18px;
  font-weight: 500;
  color: #000;
  margin-bottom: 8px;
  transition: 0.2s;
}
.progress-bar .step p.active{
  color: blue;
}
.progress-bar .step .bullet{
  height: 25px;
  width: 25px;
  border: 2px solid #000;
  display: inline-block;
  border-radius: 50%;
  position: relative;
  transition: 0.2s;
  font-weight: 500;
  font-size: 17px;
  line-height: 25px;
}
.progress-bar .step .bullet.active{
  border-color: #444;
  background: #444;
}
.progress-bar .step .bullet span{
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}
.progress-bar .step .bullet.active span{
  display: none;
}
.progress-bar .step .bullet:before,
.progress-bar .step .bullet:after{
  position: absolute;
  content: '';
  bottom: 11px;
  right: -51px;
  height: 3px;
  width: 44px;
  background: #262626;
}
.progress-bar .step .bullet.active:after{
  background: #444;
  transform: scaleX(0);
  transform-origin: left;
  animation: animate 0.3s linear forwards;
}
@keyframes animate {
  100%{
    transform: scaleX(1);
  }
}
.progress-bar .step:last-child .bullet:before,
.progress-bar .step:last-child .bullet:after{
  display: none;
}
.progress-bar .step p.active{
  color: #444;
  transition: 0.2s linear;
}
.progress-bar .step .check{
  position: absolute;
  left: 50%;
  top: 70%;
  font-size: 15px;
  transform: translate(-50%, -50%);
  display: none;
}
.progress-bar .step .check.active{
  display: block;
  color: #fff;
}


body { 
background-color: #f5f5f5; 
} 

header { 
background-color: #333; 
color: #fff; 
}

footer { 
background-color: #333; 
color: #fff; }


h1 {
  color: white;
}

h2 {
  color:white;
}

label {
  display: white;
  margin-bottom: 5px;
  color: white;
}

input[type="text"], select {
  width: 250px;
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button[type="submit"], input[type="submit"] {
  padding: 10px 20px;
  background-color:white;
  color: black;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button[type="submit"]:hover, input[type="submit"]:hover {
  background-color: black;
}
form {
  margin-bottom: 30px;
}
div.relative {
  position: relative;
  left: 15;
  width: 400px;
  height: 700px;
  border: 5px solid silver;
}

div.absolute {
  position: absolute;
  top: 250px;
  right: 15;
  width: 400px;
  height: 400px;
  border: 5px solid silver;
}
body{
background-color:gray;
}
nav ul { 
        list-style-type: none; 
        margin: 0; 
        padding: 0; 
        background-color: #444; 
        overflow: hidden; 
        text-align: center; 
    } 
 
    nav ul li { 
        display: inline-flex; 
    } 
 
    nav ul li a { 
        display: inline-flex; 
        color: #fff; 
        padding: 14px 16px; 
        text-decoration: none;
        justify-content: center;
        text-align: center;
        margin-right: 50px;
        margin-left: 50px; 
    } 
 
    nav ul li a:hover { 
        background-color: #555; 
    } 

.product-link .product-link {
        text-decoration: none; /* Remove underline */
        color: inherit; /* Inherit text color from parent */
        display: block; /* Make the link a block element for spacing */
    }
  </style>
  </head>
<body>


    <header>
        <?php require 'navbar.php'; ?>
        <img src="./image/logo.jpeg" style="height: 150px; width: 200px; padding-left: 43%;" alt="Logo">
    </header>

    <div class="shopping-cart">
  <div class="container">
    <header>All Order </header>
  
    <div class="form-outer">
       
    <table class="table table-striped">
        <thead>
            <tr>
                <th style='width: 100px;
                  ;' >#</th>
                <th >Order Date</th>
                <th scope="col">Statue Order </th>
                <th scope="col">Total Price</th>
              
             
            </tr>
        </thead>
        <tbody>
            <?php
            // Pagination logic




             
        $CustomerID= $user_id = $_SESSION["UserID"];


        $sql = "SELECT * FROM customerorders WHERE CustomerID = '$CustomerID'";
        // Execute the SQL query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr style='width: 150px;
                    height: 70px;
                    border: 1px solid black;'>";
                    echo "<td  style='width: 150px;
                  ;'>" . $row['OrderID'] . "</td>";
                    echo "<td style='width: 150px;
                    ;' >" . $row['OrderDate'] . "</td>";
                

                    $OrderID=  $row['OrderID'];
                    $sql2 = "SELECT * FROM orderdetails WHERE order_id = '$OrderID'";
                    // Execute the SQL query
                    $result2 = $conn->query($sql2);
                    $Total=0;
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $Total+=$row2['Price'];

                        }

                    }


if($row['Statue']=="waiting")
{

    echo "<td style='width: 150px;color:green
    ;' > Success</td>";
   
}
else
{
    echo "<td style='width: 150px;
                    ;' >" . $row['Statue'] . "</td>";
   
}
                    
echo "<td style='width: 150px;
;' >" . $Total . "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No products found</td></tr>";
            }
          
            ?>
        </tbody>
    </table>


      </div>
  </div>       
  </div>

  <?php   require 'chatPage.php'; ?>


  </script>
</body>
</html>







