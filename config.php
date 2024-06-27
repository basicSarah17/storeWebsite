<?php 


// Start the session if it's not already started
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(); 

    if(isset($_SESSION['username'])){
        $UserID = $_SESSION["UserID"];
        $username = $_SESSION['username'];
    }
}


// Create connection
// Database credentials
$dbHost = 'localhost'; // or your MySQL server IP address
$dbUsername = 'root'; // your MySQL username
$dbPassword = ''; // your MySQL password
$dbName = 'sixdiamonds'; // your database name

// Attempt to connect to MySQL database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

