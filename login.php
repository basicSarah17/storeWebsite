



<?php
// Include the database connection file
require 'config.php';


// Initialize variables for storing login credentials
$usernameemail = "";
$password = "";
if(isset($_POST["submit"])) {
    // Get username or email and password from form
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
   

    // Check if the username/email exists in the User table
    $query = "SELECT * FROM User WHERE UserName = ? OR UserEmail = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $usernameemail, $usernameemail);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['UserPass'];
        
        // Verify the password
        if(password_verify($password, $hashedPassword)) {
            // Password is correct, create session and redirect to dashboard or home page
       
          
            $_SESSION['loggedin'] = true;
          
            $_SESSION['username'] = $row['UserName'];
            $_SESSION["UserID"] = $row["UserID"];


if($row['UserRol']== "admin") {
      // Redirect to dashboard page
      $_SESSION['rol'] = "admin";
    header('Location: admin/index.php');
}
else{
    
  // Redirect to dashboard or home page
  header("Location: index.php");
}


          
            exit();
        } else {
            // Password is incorrect
            echo "<script> alert('Invalid username/email or password'); </script>";
        }
    } else {
        // Username/email not found
        echo "<script> alert('Invalid username/email or password'); </script>";
    }

    $stmt->close(); // Close prepared statement
}

$conn->close(); // Close database connection
?>



<html lang="en" dir="ltr">
    <head>  
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>





<header>
<?php
require 'navbar.php';

?>
    <img src="./image/logo.jpeg" style="height: 150px; width: 200px;padding-left: 43%;">
 
    </header>

    <fieldset style="background-image:url(gray.jpeg); background-repeat:repeat"><legend class="cursive">User Information</legend>

        <div class="login-container">
            <h2>Login</h2>
            <form action="" method="post" autocomplete="off">
                <label for="usernameemail">Username or email:</label><br>
                <input type="text" name="usernameemail" id="usernameemail" required><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" required><br>
                <br>
                <button type="submit" name="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Create an account</a></p>
        </div>
    </fieldset>

</body>
</html>