<?php
// Include the database connection file
require '../config.php';


 
if(!isset($_SESSION['username'] ) && !isset($_SESSION['type'] )  && $_SESSION['type'] =="admin" ){


header( "location: ../login.php" );


}

if ($_SERVER["REQUEST_METHOD"] == "GET") {


    if(!isset($_GET['CategoryID']))
    {
        header( "location: index.php" );
    }
    else{
    $CategoryID=$_GET['CategoryID'];
        
    }
    
    
    
    }



// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file upload field is not empty and has no upload errors
    if (!empty($_FILES['productimage']['name']) && $_FILES['productimage']['error'] === UPLOAD_ERR_OK) {
        // Get form data

        $CategoryID=$_POST['CategoryID'];
        $Colors=$_POST['Colors'];
        $productName = $_POST['productname'];
        $productDescription = $_POST['productDescription'];
        $productPrice = $_POST['productprice'];
        $prPriceExVat = $_POST['productPriceExVat'];
        $FieldDiscountPercentage = $_POST['FieldDiscountPercentage'];
        $ProductBarCode = $_POST['ProductBarCode'];
	

        // File upload handling
        $fileTmpPath = $_FILES['productimage']['tmp_name'];
        $fileName = basename($_FILES['productimage']['name']);
        $fileSize = $_FILES['productimage']['size'];
        $fileType = $_FILES['productimage']['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Generate a unique filename to avoid overwriting existing files
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // Directory where uploaded files will be saved
        $uploadDirectory = "../image/";

        // Move the uploaded file to the desired location
        $uploadPath = $uploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            // File upload successful, proceed with database insertion

            $sql = "INSERT INTO Product (productName, ProductDescription, ProductBarCode, ProductPrice, PrPriceExVat, FieldDiscountPercentage, PrColor, CategoryID, ProImage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdiissss", $productName, $productDescription, $ProductBarCode, $productPrice, $prPriceExVat, $FieldDiscountPercentage, $Colors, $CategoryID, $newFileName);
           
            if ($stmt->execute()) {
                echo "Product added successfully!";
            } else {
                echo "Error adding product: " . $stmt->error;
            }
            $stmt->close(); // Close prepared statement
        } else {
            echo "Error uploading file!";
        }
    } else {
        echo "Please select a file to upload!";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>  
    <title>Admin add Page</title>
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

    <h2 style="background-color: rgb(202, 199, 199);">Add Product</h2>
    <fieldset>
        <form action="adminAdd.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="CategoryID" name="CategoryID" required value="<?php echo $CategoryID  ; ?>" ><br>

        
        <label for="productname">Product Name:</label>
        <input type="text" id="productname" name="productname" required ="required"><br>
        <br>    <br>
        <label for="productDescription">Product description:</label>
        <input type="text" id="productDescription" name="productDescription" required><br>
        <br>    <br>
        <label for="productprice">Product Price:</label>
        <input type="number" id="productprice" name="productprice" required><br>
        <br>    <br>
        <label for="productPriceExVat">Product price ex vat:</label>
        <input type="number" id="productPriceExVat" name="productPriceExVat" required><br>
        <br>    <br>
        <label for="FieldDiscountPercentage">Field Discount Percentage:</label>
        <input type="text" id="FieldDiscountPercentage" name="FieldDiscountPercentage" required><br>
        <br>    <br>
        <label for="productimage">Product Image:</label>
            <input type="file" id="productimage" name="productimage" required><br>
            <br><br>
        <label for="ProductBarCode">Product barcode:</label>
        <input type="text" id="ProductBarCode" name="ProductBarCode" required><br>
        <br>    <br>
        <label for="Colors">Colors:</label>
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
            </select>

            <br><br>
            <input type="submit" value="Add Product">
        </form>
    </fieldset>
</body>
</html>
