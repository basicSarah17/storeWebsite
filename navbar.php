<!-- navbar.php -->
<?php
// Start the session if it's not already started
if (session_status() !== PHP_SESSION_ACTIVE) {
     
}
?>
    <nav> 
        <ul> 
            <li><a href="index.php">Home</a></li> 
            <li><a href="product.php">Products</a></li> 
            <li><a href="design.php">Design</a></li>
            <li><a href="cart.php">Cart</a></li> 

            
            <li><a href="orderList.php">Orders</a></li> 
            <?php
    
            // Check if the user is logged in
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="login.php">Login</a></li>';
            }
            ?>
        </ul> 
    </nav> 

    
 
