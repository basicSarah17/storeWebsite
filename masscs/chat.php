<?php
session_start();
include '../config.php';


// Fetching messages from the database
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_chat_msg') {
    // Assuming you have a valid database connection in $conn (from dbconnection.php)

    // Validate UserID to prevent SQL injection
    if (!isset($_GET['UserID']) || !is_numeric($_GET['UserID'])) {
        echo "Invalid project ID";
        exit();
    }
    $UserID = mysqli_real_escape_string($conn, $_GET['UserID']);

    // Select query
    $sqlSelect = "SELECT  *  FROM chat  WHERE UserID = $UserID";


    // Run the query
    $resultSelect = mysqli_query($conn, $sqlSelect) or die('Query failed: ' . mysqli_error($conn));
    $msg = "";
    while ($line = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {

if($line["type"]==0){
        $msg .= '      
 
        <li class="message-data2  ">
        
 <div class="message-data2  ">

   <span class="message-data-name"><i class="fa fa-circle online"></i> ' . htmlspecialchars($line["username"])  . '</span>
  
 </div>
 <span class="message-data-time">' . $line["chatdate"] . '</span>
</li>

<li>

 <div class="message other-message ">' . htmlspecialchars($line["msg"]) . '
  
 </div>
</li>';

}else{

$msg .= '      
 
<li>
<div class="message-data  ">

<span class="message-data-time"><i class="fa fa-circle online"></i> ' . htmlspecialchars($line["chatdate"])  . '</span>

</div>

</li>

<li>

<div class="message my-message ">' . htmlspecialchars($line["msg"]) . '

</div>
</li>';



}


    }












    echo $msg;
    exit(); // Stop execution after sending the messages
}


// Fetching users from the database
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_user') {
    // Assuming you have a valid database connection in $conn (from dbconnection.php)

    // Initialize an array to store added UserIDs
    $addedUsers = array();

    // Select query
    $sqlSelect = "SELECT * FROM chat";

    // Run the query
    $resultSelect = mysqli_query($conn, $sqlSelect) or die('Query failed: ' . mysqli_error($conn));
    $users = "";
    while ($line = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {
        $userID = $line["UserID"];
        $USERNAME = $line["username"];
        // Check if the UserID has already been added
        if (!in_array($userID, $addedUsers)) {
            $addedUsers[] = $userID; // Add the UserID to the added users array
            $users .= '      
 <li>
 <div class="message-data" onclick="showUserID(' . $userID . ', \'' . htmlspecialchars($USERNAME) . '\')">
   <span class="message-data-name" style="cursor: pointer;"><i class="fa fa-circle online"></i> ' . htmlspecialchars($USERNAME) . '</span>
   <span class="message-data-time" style="cursor: pointer;">' . $line["chatdate"] . '</span>
 </div>
</li>';
        }
    }

    echo $users;
    exit(); // Stop execution after sending the users
}








// Fetching messages from the database
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_user2') {
    // Assuming you have a valid database connection in $conn (from dbconnection.php)

  

    // Select query
    $sqlSelect = "SELECT  *  FROM chat  ";


    // Run the query
    $resultSelect = mysqli_query($conn, $sqlSelect) or die('Query failed: ' . mysqli_error($conn));
    $msg = "";
    while ($line = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {


        $user .= '      
 <li>
 <div class="message-data">
   <span class="message-data-name"><i class="fa fa-circle online"></i> ' . htmlspecialchars($line["username"])  . '</span>
   <span class="message-data-time">' . $line["chatdate"] . '</span>
 </div>

</li>

<li>
 </div>
</li>';
    }

    echo $msg;
    exit(); // Stop execution after sending the messages
}

// ...

// Sending messages (from engprojectmanagemnt.php)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'set_chat_msg') {
    // Prevent SQL injection
    $msg = mysqli_real_escape_string($conn, $_GET["msg"]);
    $dt = date("Y-m-d H:i:s");
    $user = mysqli_real_escape_string($conn, $_GET["name"]);
    $UserID = mysqli_real_escape_string($conn, $_GET["UserID"]);
    // Insert new message into the chat table
    $type = 1;
    $sqlInsert = "INSERT INTO chat (USERNAME, CHATDATE, MSG,UserID,type) VALUES ('$user', '$dt', '$msg','$UserID','$type')";
    $resultInsert = mysqli_query($conn, $sqlInsert);

    if (!$resultInsert) {
        die('Query failed: ' . mysqli_error($conn));
    }

    echo "Message sent successfully"; // Send a response back to engprojectmanagemnt.php
}
