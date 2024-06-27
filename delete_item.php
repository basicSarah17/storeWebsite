<?php
// Assuming you have a database connection established
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["item_id"])) {
    $item_id = $_POST["item_id"];

    // Perform the deletion operation based on the item ID
    // Update the code below with your specific logic to delete the item from the cart
    $sql = "DELETE FROM cart WHERE product_id = '$item_id'"; // Example query

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        http_response_code(200); // Send a success status code
        echo "Item deleted successfully";
    } else {
        // Error occurred while deleting the item
        http_response_code(500); // Send an error status code
        echo "Error deleting item: " . $conn->error;
    }
} else {
    // Invalid request
    http_response_code(400); // Send a bad request status code
    echo "Invalid request";
}
?>