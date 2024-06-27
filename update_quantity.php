<?php
// Include your database connection file
require 'config.php';

// Check if product ID and new quantity are provided
if (isset($_POST['productId']) && isset($_POST['newQuantity'])) {
    $productId = $_POST['productId'];
    $newQuantity = $_POST['newQuantity'];

    // Update the quantity in the database
    $sql = "UPDATE cart SET Quantity = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $newQuantity, $productId);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'missing_parameters';
}
?>
