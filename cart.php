<?php
// Include your database connection file
require 'config.php';

$cartItems = array();
if(!isset($_SESSION['username'])){


    echo "<script>alert('you must login'); </script>";
 

    
    }
  
 else{


$user_id = $_SESSION["UserID"];

$cartItemsQuery = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$cartItemsQuery->bind_param('i', $user_id);
$cartItemsQuery->execute();
$cartItemsResult = $cartItemsQuery->get_result();

// Store the fetched cart items in an array

while ($row = $cartItemsResult->fetch_assoc()) {
    $cartItems[] = $row;
}

// Close the cart items query
$cartItemsQuery->close();
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="./css/cart.css">
</head>
<body>
    <header>
        <?php require 'navbar.php'; ?>
        <img src="./image/logo.jpeg" style="height: 150px; width: 200px; padding-left: 43%;" alt="Logo">
    </header>

    <div class="shopping-cart">
        <!-- Title -->
        <div class="title">
            Shopping Bag
        </div>

        <!-- Cart items -->
        <?php foreach ($cartItems as $item):
            $product_id = $item['product_id'];
            $sql = "SELECT * FROM product WHERE ProductID = '$product_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Fetch product details and display them
                $row = $result->fetch_assoc();

                $color = $row["PrColor"];

                $sql2 = "SELECT * FROM color WHERE id = '$color'";
                $result2 = $conn->query($sql2);
                $color = $result2->fetch_assoc();
            ?>
                <div class="item" id="item_<?php echo $row['ProductID']; ?>">
                    <div class="image">
                        <img src="./image/<?php echo $row['ProImage']; ?>" alt="<?php echo $row['ProductName']; ?>" style="height: 70px; width: 70px" alt="Logo">
                    </div>
                    <div class="description">
                        <span>Name: <?php echo $row['ProductName']; ?></span>
                        <span>Color: <?php echo $color['name']; ?></span>
                        <span>Size: <?php echo $item['size']; ?></span>
                    </div>
                    <div class="quantity">
                        <button onclick="decrementQuantity(<?php echo $row['ProductID']; ?>)">-</button>
                        <input type="number" id="quantity_<?php echo $row['ProductID']; ?>" value="<?php echo $item['Quantity']; ?>" disabled>
                        <button onclick="incrementQuantity(<?php echo $row['ProductID']; ?>)">+</button>
                    </div>
                    <div class="total-price" id="totalPrice_<?php echo $row['ProductID']; ?>">
                        <?php echo $row['ProductPrice'] * $item['Quantity']; ?> SR
                    </div>
                    <div class="delete-btn">
                        <a href="cart.php"> <button onclick="deleteCartItem(<?php echo $row['ProductID']; ?>)">Delete</button></a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="item">Cart is empty</div>;
            <?php
            }
        endforeach; ?>

        <?php if (count($cartItems) > 0) { ?>
            <a href="order.php" style="text-decoration: none; color: inherit; justify-content: center; display: inline-flex; color: #fff; background: silver; padding: 14px 16px; text-decoration: none; justify-content: center; text-align: center; display: block;">Buy</a>
        <?php } ?>
    </div>

    <script>
        function incrementQuantity(productId) {
            var quantityInput = document.getElementById('quantity_' + productId);
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateTotalPrice(productId);
        }

        function decrementQuantity(productId) {
            var quantityInput = document.getElementById('quantity_' + productId);
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateTotalPrice(productId);
            }
        }

        function updateTotalPrice(productId) {
            var quantityInput = document.getElementById('quantity_' + productId);
            var totalPriceElement = document.getElementById('totalPrice_' + productId);
            var productPrice = parseFloat('<?php echo $row['ProductPrice']; ?>');
            var quantity = parseInt(quantityInput.value);
            totalPriceElement.textContent = (productPrice * quantity) + ' SR';
         updateQuantityInDatabase(productId, quantity) 
        }



        function updateQuantityInDatabase(productId, newQuantity) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;
            if (response === 'success') {
                console.log('Quantity updated successfully');
            } else {
                console.log('Failed to update quantity');
            }
        }
    };
    xhttp.open('POST', 'update_quantity.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    // Construct the form data
    var formData = 'productId=' + productId + '&newQuantity=' + newQuantity;
    xhttp.send(formData);
}


    </script>




<script>
    function deleteCartItem(itemId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "delete_item.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var itemElement = document.getElementById("item_" + itemId);
                if (itemElement) {
                    itemElement.parentNode.removeChild(itemElement);
                }
            } else {
                console.error("Error deleting item: " + xhr.responseText);
            }
        }
    };
    xhr.send("item_id=" + itemId);
}
</script>



        <?php   require 'chatPage.php'; ?>
</body>
</html>

