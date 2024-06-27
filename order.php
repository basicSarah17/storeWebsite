
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
            
              $Quantity=$row['Quantity'];
              $product_id=$row['product_id'];
              $size=$row['size'];

              $Price=0;
              $sql3 = "SELECT * FROM product WHERE ProductID = '$product_id'";
              $result3 = $conn->query($sql3);

              if ($result3->num_rows > 0) {
                  // Fetch product details and display them
                  $row2 = $result3->fetch_assoc();
                  $Price+=$Quantity*$row2["ProductPrice"];
              }
                 


             
            
              $stmt->bind_param('iiiii',$order_id,$product_id, $Quantity, $size, $Price);
                    
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
    <header>Order Form</header>
    <div class= "progress-bar">
      <div class="step">
        <p>House Address</p>
        <div class="bullet">
          <span>1</span>
      </div>
      <div class="check fas fa-check">
      </div>
    </div>
      <div class="step">
        <p>Payment</p>
        <div class="bullet">
          <span>2</span>
      </div>
      <div class="check fas fa-check">
      </div>  
      </div>
    </div>
    <div class="form-outer">
      <form action="" method="post">
        <div class="page slidepage">
          <div class="title">Basic Info:</div>
         
          <div class="field">
            <div class="label"> City</div>
            <select id="citySelect" name="city" class="select">
       
        <option valuselecte="Riyadh">Riyadh</option>
        <option value="Jeddah">Jeddah</option>
        <option value="Mecca">Mecca</option>
        <option value="Medina">Medina</option>
        <option value="Dammam">Dammam</option>
        <option value="Khobar">Khobar</option>
        <option value="Taif">Taif</option>
        <option value="Tabuk">Tabuk</option>
        <option value="Hail">Hail</option>
        <option value="Najran">Najran</option>
        <option value="Jizan">Jizan</option>
        <option value="Al-Ahsa">Al-Ahsa</option>
        <option value="Buraidah">Buraidah</option>
        <option value="Khamis Mushait">Khamis Mushait</option>
        <option value="Abha">Abha</option>
        <option value="Yanbu">Yanbu</option>
        <option value="Al Jubail">Al Jubail</option>
        <option value="Arar">Arar</option>
        <option value="Sakakah">Sakakah</option>
        <option value="Jubail Industrial City">Jubail Industrial City</option>
        <option value="Hafr Al-Batin">Hafr Al-Batin</option>
        <option value="Al-Kharj">Al-Kharj</option>
        <option value="Qatif">Qatif</option>
        <option value="Dhahran">Dhahran</option>
        <option value="Al Qunfudhah">Al Qunfudhah</option>
        <option value="Al Majma'ah">Al Majma'ah</option>
        <option value="Hofuf">Hofuf</option>
        <option value="Ras Tanura">Ras Tanura</option>
        <option value="Al Bukayriyah">Al Bukayriyah</option>
        <option value="Umluj">Umluj</option>
        <option value="Al Quaiyah">Al Quaiyah</option>
        <option value="Duba">Duba</option>
        <option value="Turaif">Turaif</option>
        <option value="Thadiq">Thadiq</option>
        <option value="Rabigh">Rabigh</option>
        <option value="Rahimah">Rahimah</option>
        <option value="As Sulayyil">As Sulayyil</option>
        <option value="Ar Rass">Ar Rass</option>
        <option value="Qaisumah">Qaisumah</option>
        <option value="Muzahmiyya">Muzahmiyya</option>
        <option value="Badr">Badr</option>
        <option value="Ad Dilam">Ad Dilam</option>
        <option value="Turabah">Turabah</option>
        <option value="Al Wajh">Al Wajh</option>
        <option value="Al Jumum">Al Jumum</option>
        <option value="Dubai">Dubai</option>
        <option value="Abu Dhabi">Abu Dhabi</option>
        <optgroup label="Cities in Saudi Arabia (Continued)">
            <option value="Al Khafji">Al Khafji</option>
            <option value="Al Lith">Al Lith</option>
            <option value="Al Qaisumah">Al Qaisumah</option>
            <option value="Al-Ula">Al-Ula</option>
            <option value="Al-'Ula">Al-'Ula</option>
            <option value="Al-Wajh">Al-Wajh</option>
            <option value="Badaya">Badaya</option>
            <option value="Bariq">Bariq</option>
            <option value="Bisha">Bisha</option>
            <option value="Buqayq">Buqayq</option>
            <option value="Dhurma">Dhurma</option>
            <option value="Diriyah">Diriyah</option>
            <option value="Duba">Duba</option>
            <option value="Dumat Al-Jandal">Dumat Al-Jandal</option>
            <option value="Gurayat">Gurayat</option>
            <option value="Jazan">Jazan</option>
            <option value="Khafji">Khafji</option>
            <option value="Kharj">Kharj</option>
            <option value="Khurma">Khurma</option>
            <option value="Mecca">Mecca</option>
            <option value="Mizhirah">Mizhirah</option>
            <option value="Najran">Najran</option>
            <option value="Qaryat Al-Ulya">Qaryat Al-Ulya</option>
            <option value="Qassim">Qassim</option>
            <option value="Qurayyat">Qurayyat</option>
            <option value="Ras Tanura">Ras Tanura</option>
            <option value="Riyadh">Riyadh</option>
            <option value="Sabya">Sabya</option>
            <option value="Safwa">Safwa</option>
            <option value="Sajir">Sajir</option>
            <option value="Sakakah">Sakakah</option>
            <option value="Shaqraa">Shaqraa</option>
            <option value="Sharorah">Sharorah</option>
            <option value="Tabarjal">Tabarjal</option>
            <option value="Tarut">Tarut</option>
            <option value="Thadiq">Thadiq</option>
            <option value="Thuqbah">Thuqbah</option>
            <option value="Turaif">Turaif</option>
            <option value="Udhailiyah">Udhailiyah</option>
            <option value="Umluj">Umluj</option>
            <option value="Unayzah">Unayzah</option>
            <option value="Yanbu">Yanbu</option>
            <option value="Zulfi">Zulfi</option>
        </optgroup>
    </select>
          </div>
         
          <div class="field">
            <div class="label"> Street</div>
            <input type="text" required name="Street" id="street" />
          </div>
          <div class="field">
            <div class="label"> Neighborhood</div>
            <input type="text" requiredd name="Neighborhood">
          </div>
          <div class="field">
            <div class="label"> House number</div>
            <input type="text" required name= "Housenumber">
          </div>
          <div class="field">
            <div class="label">More location info:</div>
            <input type="text" required name= "Morelocationinfo">
          </div>
          <div class="field nextBtn">
            <button type="button"  >Next</button>
          </div>
          </div>

      
      

       
          <div class="page">
            <div class="title"> payment  </div>
            
            <div class="field">
              <div class="label">select the payment type you like</div>
              <select id="payment" name="payment">
                <option>Cash</option>
              
              </select>
            </div>
            <div class="field btns">
              <button type="button" class="prev-1 prev">Previous</button>
              <button type="submit" class="submit next">submit</button>
            </div>
            </div>
        
      
        </form>  
      </div>
  </div>       
  </div>
  <?php   require 'chatPage.php'; ?>
  <script >




const slidePage = document.querySelector(".slidepage");
const firstNextBtn = document.querySelector(".nextBtn");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");

const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");
let max = 2;
let current = 1;

prevBtnSec.addEventListener("click", function (){
  slidePage.style.marginLeft = "0%";
  bullet[current - 1].classList.remove("active");
  progressText[current - 1].classList.remove("active");
  progressCheck[current - 1].classList.remove("active");
  current -= 1;
})

firstNextBtn.addEventListener("click", function (){
  slidePage.style.marginLeft = "-25%";
  bullet[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  current += 1;
})

submitBtn.addEventListener("click", function (){
  

})




  </script>
</body>
</html>