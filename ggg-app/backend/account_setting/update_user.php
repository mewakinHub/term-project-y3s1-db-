<?php
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userID'], $_GET['userID'])) {
    // Prepare the update SQL dynamically based on form fields
    
    $userID = $_POST['userID'];
    $updateSql = "UPDATE user SET ";
    $updateParams = array();
    foreach ($_POST as $key => $value) {
        // Skip fields that are not meant for updating or are empty
        if ($key == "userID" || empty($value)) {
            continue;
        }

        $updateSql .= "$key = ?, ";
        $updateParams[] = $value;
    }

    
    $updateSql = rtrim($updateSql, ", ");

    $updateSql .= " WHERE userID = ?";
    $updateParams[] = $userID;

    $stmtUpdate = $conn->prepare($updateSql);

    if ($stmtUpdate) {
        
        $bindTypes = str_repeat("s", count($updateParams));
        $stmtUpdate->bind_param($bindTypes, ...$updateParams);

        if ($stmtUpdate->execute()) {
            echo "User data updated successfully!";
            // Redirect back to admin.php
            // header("Location: admin.php");
            $_SESSION["ID"] = $new_user_id;
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $username;
            $_SESSION["balance"] = 0;
            $_SESSION["bio"] = '';

            $userID = $_SESSION["ID"]; 
            exit;
        } else {
            echo "Error updating user data: " . $stmtUpdate->error;
        }

        $stmtUpdate->close();
    } else {
        echo "Error preparing update statement: " . $mysqli->error;
    }
}



$conn->close();
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
        <input type="submit" value="Update User">
        echo "<a href='delete_user.php?userID=" . $row['USER_ID'] . "' class='button-link'>Delete User</a>";

        <label for="upload">Upload profile</label> 
        <input type="file" class="form-control" name="image">
<?php 
    if (isset($userData['profilePicFile'])) {
        // Assuming the image data is in $userData['profilePicFile']
        $imageData = $userData['profilePicFile'];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        // Use finfo::buffer to determine the MIME type of the image data
        $mimeType = $finfo->buffer($imageData);
        // Output the image using base64 encoding
        echo '<img src="data:' . $mimeType . ';base64,' . base64_encode($imageData) . '" alt="Profile Picture" style="max-width: 100%; height: auto;"/>';
    }
?>
       
    </form>
    <hr>
    <h3>Uploaded images</h3>
    


</body>
</html>