<?php
session_start();

$host = "127.0.0.1";
$user = "user";
$password = "userggg";
$database = "ggg";
$port = 8889;

// Create a connection
$conn = new mysqli($host, $user, $password, $database, $port);

 
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL";
}
$_SESSION['user_id'] == 20; 



echo "<pre>Session variables in 'updated.php': ";
print_r($_SESSION);
echo "</pre>";

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
// include 'config.php'; // Make sure this points to your actual configuration file
// $_SESSION['user_id'] == 20;
$user_id = $_SESSION['user_id'];

if (isset($_POST['update_profile'])) {
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));
   $old_pass = $_POST['old_pass'];
   
   // Update email
   mysqli_query($conn, "UPDATE `user` SET email = '$update_email' WHERE userID = '$user_id'") or die('query failed');
   
   // Update password
   if (!empty($update_pass) && !empty($new_pass) && !empty($confirm_pass)) {
      if ($update_pass == $old_pass) {
         if ($new_pass == $confirm_pass) {
            mysqli_query($conn, "UPDATE `user` SET password = '$new_pass' WHERE userID = '$user_id'") or die('query failed');
            echo 'Password updated successfully!';
         } else {
            echo 'New password and confirm password do not match!';
         }
      } else {
         echo 'Old password does not match!';
      }
   }
   
   // Update profile picture
   if(file_exists("upload/ .$FILES['profilePicFile']['name'])){
      $filename = $_FILES['profilePicFile']['name']:
      $_SESSION['status'] = "Image already Exists ".$filename;
      header("Location: account_setting.php");
   }
   else 
   {
      $q = "
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update profile</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="update-profile">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>Update profile</h3>
      <img src="path_to_default_image.jpg"> <!-- Replace with the path to the default image -->
      <div class="flex">
         <div class="inputBox">
            <span>Your email:</span>
            <input type="email" name="update_email" value="" class="box form-control">
            <span>Update your pic:</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box form-control">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="">
            <span>Old password:</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box form-control">
            <span>New password:</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box form-control">
            <span>Confirm password:</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box form-control">
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a href="home.php" class="delete-btn">go back</a>
   </form>
</div>

</body>
</html>

<!-- 
//     if (!isset($_SESSION["userID"])) {
//         die("User ID is not set in the session.");
//     }

// $userid = $_SESSION["userID"];

// // Assuming you're using $mysqli in connect.php
// $email = $mysqli->real_escape_string($_POST['email']);
// $username = $mysqli->real_escape_string($_POST['username']);
// $balance = floatval($_POST['balance']); // Assuming balance is a float
// $bio = $mysqli->real_escape_string($_POST['bio']);
// $profilePicPath = NULL; // This should be set to the file path if a file was uploaded

// // Code for handling file upload would go here...

// // Prepare the update statement
// $q = "UPDATE user SET email = ?, username = ?, balance = ?, bio = ?, profilePicFile = ? WHERE userID = ?";

// if ($stmt = $mysqli->prepare($q)) {
//     $stmt->bind_param('ssdsbi', $email, $username, $balance, $bio, $profilePicPath, $userid);
//     if ($stmt->execute()) {
//         if ($stmt->affected_rows > 0) {
//             echo "Profile updated successfully!";
//         } else {
//             echo "No changes made to the profile.";
//         }
//     } else {
//         echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//     }
//     $stmt->close();
// } else {
//     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
// }

// $mysqli->close();
// ?> -->
