<?php
// for test in get_browser
// http://localhost/backend/account_setting/update_user.php?userID=2
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
//connect to database user table
require_once("connect.php");
// $host = "127.0.0.1";
// $user = "ggguser";
// $password = "ggguser"; 
// $database = "ggg";
// $port = 8889;

// Create a connection
// $conn = new mysqli($host, $user, $password, $database, $port);
// // var_dump($conn);
// // Check the connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } else {
//     echo "Connected to MySQL";
// }
// Check if the userID parameter is set
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Fetch user data based on userID
    $selectSql = "SELECT userID, email, password, username, bio FROM user WHERE userID = ?";
    $stmtSelect = $conn->prepare($selectSql);

    if ($stmtSelect) {
        $stmtSelect->bind_param('i', $userID);

        if ($stmtSelect->execute()) {
            $result = $stmtSelect->get_result();

            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
            } else {
                echo "User not found.";
                exit;
            }
        } else {
            echo "Error fetching user data: " . $stmtSelect->error;
            exit;
        }
      

        $stmtSelect->close();
    } else {
        echo "Error preparing select statement: " . $conn->error;
        exit;
    }
} else {
    echo "User ID not provided.";
    exit;
}

// Check if the form is submitted for updating user data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'], $_POST['userID'])) {
    // Prepare the update SQL dynamically based on form fields
    
    $userID = $_POST['userID'];
    $updateSql = "UPDATE user SET ";
    $updateParams = array();
    $paramTypes = '';
    
    foreach ($_POST as $key => $value) {
        if ($key == "userID" || $key == "submit" || $key == "image" || empty($value)) {
            continue;
        }

        $updateSql .= "$key = ?, ";
        $updateParams[] = $value;
        // $paramTypes .= 's'; 
    }

        $updateSql = rtrim($updateSql, ", ");
        $updateSql .= " WHERE userID = ?";
        $updateParams[] = $userID;
        // $paramTypes .= 'i'; 

         $stmtUpdate = $conn->prepare($updateSql);

    if ($stmtUpdate) {
        $stmtUpdate->bind_param($paramTypes, ...$updateParams);

        if ($stmtUpdate->execute()) {
            echo "User data updated successfully!";
            // Redirect or handle the session update logic here
        } else {
            echo "Error updating user data: " . $stmtUpdate->error;
        }

        $stmtUpdate->close();
    } else {
        echo "Error preparing update statement: " . $conn->error;
    }
}




// $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    <form method="post" action="upload.php" enctype="multipart/form-data">
    <!-- <form method="post" action=""> -->
        <?php
        // Display form fields dynamically based on user data columns
        if (isset($userData)) {
            foreach ($userData as $key => $value) {
                echo "<label for=\"$key\">$key:</label>";
                echo "<input type=\"text\" id=\"$key\" name=\"$key\" value=\"$value\"><br>";
            }
        }
        ?>
         <input type="hidden" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
         <input type="submit" name="submit" value="Update User">
        echo "<a href='delete_user.php?userID=" . $row['USER_ID'] . "' class='button-link'>Delete User</a>";

        <label for="upload">Upload profile</label> 
        <input type="file" class="form-control" name="image">

   <?php 
   $stmt = $conn->prepare("SELECT profilePicFile FROM user WHERE userID = ?");
   $stmt->bind_param("i", $userID); // Bind the $userID variable.
   $stmt->execute();
   $result = $stmt->get_result();
   $row = $result->fetch_assoc();
   
    
   if (isset($row['profilePicFile']) && !empty($row['profilePicFile'])) {
    // Display the user's profile picture if available
    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profilePicFile']) . '" alt="Profile picture" style="width: 50px; height: 50px; border-radius: 50%;">';
} else {
    // Display a default image or icon if no profile picture is available
    echo '<img src="/backend/friend/user%20(2).png" style="width: 50px; height: 50px; border-radius: 50%;">';
}
    ?>


       
    </form>
    <hr>
    <h3>Uploaded images</h3>
    


</body>
</html> 