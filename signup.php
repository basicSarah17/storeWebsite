
<html lang="en" dir="ltr">
    <head>  
  <title>Sign Up</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    
 <link rel="stylesheet" href="./css/signup.css">


</head>
<body>


<header>
<?php
require 'navbar.php';

?>
    <img src="./image/logo.jpeg" style="height: 150px; width: 200px;padding-left: 43%;">
 
    </header>
  <div class="container">
    <h2>Sign Up</h2>
    <form action="signup.php" method="post" autocomplete="off">
            <label for="userName">UserName:</label>
            <input type="text" name="userName" required><br>
            <label for="userPass">Password:</label>
            <input type="password" name="userPass" required><br>
            <label for="confirmpassword">Confirm Password:</label>
            <input type="password" name="confirmpassword" required><br>
            <label for="userAddress">Address:</label>
            <input type="text" name="userAddress" required><br>
            <label for="userEmail">Email:</label>
            <input type="email" name="userEmail" required><br>
            <label for="userTel">Phone Number:</label>
            <input type="text" name="userTel" required><br>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    <p>Already have an account? <a href="login.php">login</a></p>
  </div>

  <?php
// Include the database connection file
require 'config.php';

if(isset($_POST["submit"])) {
    $username = $_POST["userName"];
    $password = $_POST["userPass"];
    $confirmpassword = $_POST["confirmpassword"];
    $Address = $_POST["userAddress"];
    $email = $_POST["userEmail"];
    $phoneNumber = $_POST["userTel"];

    // Check if username or email already exists
    $duplicate = mysqli_query($conn, "SELECT * FROM User WHERE UserName ='$username' OR UserEmail ='$email'");
    if(mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username or Email has already been taken'); </script>";
    } else {
        if($password == $confirmpassword) {
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind the INSERT statement using prepared statement
            $stmt = $conn->prepare("INSERT INTO User (UserName, UserPass, UserAddress, UserEmail, UserTel, UserRol) VALUES (?, ?, ?, ?, ?, 'customer')");
            $stmt->bind_param("sssss", $username, $hashedPassword, $Address, $email, $phoneNumber);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script> alert('Sign up successful'); </script>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close(); // Close the prepared statement
        } else {
            echo "<script> alert('Passwords do not match'); </script>";
        }
    }
}
$conn->close(); // Close database connection
?>



?>

</body>
</html>