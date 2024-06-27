<?php
// Include your database connection file
require 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('You must login');</script>";
    } else {
        // Check if the product ID is set in the form submission
        if (isset($_POST['product_id'], $_POST['Colors'], $_POST['siz'])) {
            // Sanitize and validate form data
            $product_id = $_POST['product_id'];
            $selectedColor = $_POST['Colors'];
            $selectedSize = $_POST['siz'];
            // You should perform further validation and sanitization here

            // Include your database connection file
            require 'config.php';

            // Check if the product already exists in the cart for the current user
            $stmt_check = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
            $stmt_check->bind_param("ii", $_SESSION["UserID"], $product_id);
            $stmt_check->execute();
            $result = $stmt_check->get_result();

            if ($result->num_rows > 0) {
                // Product already exists in the cart, show alert message
                echo "<script>alert('This product is already in your cart');</script>";
            } else {
                // Prepare the SQL statement to insert into the cart table
                $stmt_insert = $conn->prepare("INSERT INTO cart (user_id, product_id, color, size) VALUES (?, ?, ?, ?)");
                $user_id = $_SESSION["UserID"];

                // Bind parameters to the prepared statement
                $stmt_insert->bind_param('iisi', $user_id, $product_id, $selectedColor, $selectedSize);

                // Set the quantity value (you can adjust this as per your requirements)
                $quantity = 1; // Default quantity

                // Execute the prepared statement
                if ($stmt_insert->execute()) {
                    // Redirect to a success page or display a success message
                    echo "<script>alert('Your product has been added💫')</script>";
                } else {
                    // Handle the insert error, you can redirect to an error page or display an error message
                    echo "Error inserting into cart table: " . $stmt_insert->error;
                }

                // Close the statement
                $stmt_insert->close();
            }

            // Close the statement and database connection
            $stmt_check->close();
            $conn->close();
        } else {
            // Handle form data validation errors
            echo "Invalid form data.";
        }
    }
}
?>


<html lang="en" dir="ltr">
<head>  
    <title>Special Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="./css/product_details.css">
</head>
<body>
    <header>
        <?php
        // Assuming navbar.php contains your navigation bar code
        require 'navbar.php';
        ?>
        <img src="./image/logo.jpeg" style="height: 150px; width: 200px;padding-left: 43%;">
    </header>
    <hr>
    <figure>
        <figcaption>

        <form  action="" method="POST">
            <?php
            if(isset($_GET['product_id'])) {
                require 'config.php'; // Include your database connection file
                $product_id = $_GET['product_id'];
                $sql = "SELECT * FROM product WHERE ProductID = '$product_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Fetch product details and display them
                    $row = $result->fetch_assoc();
                    ?>
<input type="hidden"  id="" name= "product_id" value="<?php echo $row["ProductID"]?>" />

<img src="./image/<?php echo $row['ProImage']; ?>" style="height: 250px; width: 235px;"><br>
                    <h5 style="background-color: rgb(246, 239, 230);">product Name: <i style="background-color: #fff;"><?php echo $row['ProductName']; ?></h5><br>
                    <h5 style="background-color: rgb(246, 239, 230);">product Description: <i style="background-color: #fff;"><?php echo $row['ProductDescription']; ?></h5><br>
                    <h5 style="background-color: rgb(246, 239, 230);">Price: <i style="background-color: #fff;"><?php echo $row['ProductPrice']; ?></h5><br>
                    <h5 style="background-color: rgb(246, 239, 230);">product Price Ex Vat: <i style="background-color: #fff;"><?php echo $row['PrPriceExVat']; ?></i></h5><br>
                    <h5 style="background-color: rgb(246, 239, 230);"> Product Barcode: <i style="background-color: #fff;"><?php echo $row['ProductBarCode']; ?></h5><br>
                    <label style="background-color: rgb(246, 239, 230);" for="Colors">Color :</label>
                                          
              <select id="Colors" name="Colors">
                <option value="">All</option>
                <?php
                $product_id = $_GET['product_id'];
                $sql = "SELECT * FROM color";
                // Execute the SQL query
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }
                ?>
            </select>
                    <br>
                    <label style="background-color: rgb(246, 239, 230);" for="siz">Size :</label>
                    <select id="siz" name="siz">
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                    <br><br>
                    <input style="font-family: serif; " type="submit" name="submit" value="Add to Crat">
                    <?php
                } else {
                    echo "Product not found.";
                }
            } else {
                echo "Product ID not provided.";
            }
            ?>

        </form>
        </figcaption>
    </figure>
    <?php   require 'chatPage.php'; ?>
</body>
</html>
