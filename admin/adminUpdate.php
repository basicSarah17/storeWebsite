<?php
// Include the database connection file
require '../config.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) && !isset($_SESSION['type']) && $_SESSION['type'] !== "admin") {
    header("location: ../login.php");
    exit; // Stop further execution
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if product_id is set and not empty
    if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
        // Sanitize input data to prevent SQL injection
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        
        // Update the product's data in the database
        $sql = "UPDATE product SET ";

        // Check if new ProImage file is uploaded
        if (!empty($_FILES['productimage']['name']) && $_FILES['productimage']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['productimage']['tmp_name'];
            $fileName = basename($_FILES['productimage']['name']);
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadDirectory = "../image/";
            $uploadPath = $uploadDirectory . $newFileName;
            
            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                $sql .= "ProImage = '{$newFileName}', ";
            } else {
                echo "Error uploading file!";
            }
        }

        // Check and update other fields
        if (isset($_POST['productname']) && !empty($_POST['productname'])) {
            $productname = mysqli_real_escape_string($conn, $_POST['productname']);
            $sql .= "productName = '{$productname}', ";
        }

        if (isset($_POST['productDescription']) && !empty($_POST['productDescription'])) {
            $productDescription = mysqli_real_escape_string($conn, $_POST['productDescription']);
            $sql .= "ProductDescription = '{$productDescription}', ";
        }

        if (isset($_POST['productprice']) && !empty($_POST['productprice'])) {
            $productprice = mysqli_real_escape_string($conn, $_POST['productprice']);
            $sql .= "ProductPrice = '{$productprice}', ";
        }

        if (isset($_POST['productPriceExVat']) && !empty($_POST['productPriceExVat'])) {
            $productPriceExVat = mysqli_real_escape_string($conn, $_POST['productPriceExVat']);
            $sql .= "PrPriceExVat = '{$productPriceExVat}', ";
        }

        if (isset($_POST['Colors']) && !empty($_POST['Colors'])) {
            $productColor = mysqli_real_escape_string($conn, $_POST['Colors']);
            $sql .= "PrColor = '{$productColor}', ";
        }

        if (isset($_POST['ProductBarCode']) && !empty($_POST['ProductBarCode'])) {
            $ProductBarCode = mysqli_real_escape_string($conn, $_POST['ProductBarCode']);
            $sql .= "ProductBarCode = '{$ProductBarCode}', ";
        }

        // Remove the trailing comma and space
        $sql = rtrim($sql, ", ");

        // Add the WHERE clause
        $sql .= " WHERE ProductID = '{$product_id}'";

        // Execute the update query
        if (mysqli_query($conn, $sql)) {
            echo "Product updated successfully!";
        } else {
            echo "Error updating product: " . mysqli_error($conn);
        }
    } else {
        echo "Product ID is required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>  
    <title>Admin Update Page</title>
    <link rel="stylesheet" href="./css/adminAdd.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
</head>
<body> 
    <header>
    <?php
        require 'navbar.php';
    ?>
        <img src="../image/logo.jpeg" style="height: 150px; width: 200px;padding-left: 43%;">
    </header>

    <h2 style="background-color: rgb(202, 199, 199);">Update Product</h2>
    <fieldset>
        <form action="adminUpdate.php" method="POST" enctype="multipart/form-data">
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" required><br><br>
            
            <label for="productimage">Product Image:</label>
            <input type="file" id="productimage" name="productimage"><br><br>
            
            <label for="productname">Product Name:</label>
            <input type="text" id="productname" name="productname"><br><br>
            
            <label for="productDescription">Product Description:</label>
            <input type="text" id="productDescription" name="productDescription"><br><br>
            
            <label for="productprice">New Product Price:</label>
            <input type="number" id="productprice" name="productprice"><br><br>
            
            <label for="productPriceExVat">Product price ex vat:</label>
            <input type="number" id="productPriceExVat" name="productPriceExVat"><br><br>
            
            <label for="Colors"> Colors:</label>
            <select id="Colors" name="Colors" required>
       
           
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
            </select><br><br>
            
            <label for="ProductBarCode">Product Barcode:</label>
            <input type="text" id="ProductBarCode" name="ProductBarCode"><br><br>
            
            <input type="submit" value="Modify Product">
        </form>
    </fieldset>
</body>
</html>
