<!DOCTYPE html>
<html lang="en">
<head>
   <!--Default-->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="asset/logo.png">
   <link rel="stylesheet" href="style/global.css">
   <link rel="stylesheet" href="style/variables.css">
   <?php
      require_once('script/connect.php');
      include_once('component/icon.php');
      include_once('component/alert.php');
   ?>
   <!--Custom-->
   <title>GGG - Manage Account</title>
   <link rel="stylesheet" href="style/navbar.css">
   <link rel="stylesheet" href="style/pageheader.css">
   <link rel="stylesheet" href="style/maincontent.css">
   <link rel="stylesheet" href="style/profile.css">
   <?php
      session_start();
      include_once('component/navbar.php');
      if(!isset($_SESSION['userID'])){
         header('Location: signin.php');
      }
      $userID = $_SESSION['userID'];
      $q = "SELECT email, username, password FROM user WHERE userID='$userID'";
      $result = $conn->query($q);
      if (!$result) {
         Alert("Query error: " . $conn->error);
      }
      else {
         while ($row = $result->fetch_array()) {
            $email = $row[0];
            $username = $row[1];
            $password = $row[2];
         } 
      }
      if(isset($_POST['submit'])){
         if (isset($_FILES['pfp']) && $_FILES['pfp']['error'] === UPLOAD_ERR_OK) {
            $pfp = file_get_contents($_FILES['pfp']['tmp_name']);
         } else {
               // No poster image uploaded, display a message and a button to go back
               echo "<p>No pfp image uploaded. Please go back to the previous page.</p>";
               echo "<button onclick='history.go(-1);'>Go Back</button>";
               exit;
         }
         $stmt = $conn->prepare("CALL UpdateAccount(?, ?, ?, ?, ?)");
         $stmt->bind_param("issss", $userID, $pfp, $email, $username, $password);
         $userID = $_SESSION['userID']; 
         $email = $_POST['email'];
         $username = $_POST['username'];
         $password = $_POST['password'];
         $result = $stmt->execute();
         if (!$result) {
            echo "Query error: " . $conn->error;
         }
         $stmt->close();
      }
   ?>
</head>
<body>
   <?php Navbar('', $_SESSION['userID']) ?>
   <main class="profile">
      <h1>Manage Account</h1>
      <hr/>
      <div class="acc-container">
         <form action="script/updateAccount.php" method="post">
            <div class="entry">
               <label for="pfp"><h4>Picture</h4></label>
               <input type="file" id="pfp" name="pfp" accept="image/*">
            </div>
            <div class="entry">
               <label for="email"><h4>Email</h4></label>
               <input type="text" id="email" name="email" value="<?php echo $email;?>">
            </div>
            <div class="entry">
               <label for="username"><h4>Username</h4></label>
               <input type="text" id="username" name="username" value="<?php echo $username;?>">
            </div>
            <div class="entry">
               <label for="password"><h4>Password</h4></label>
               <input class="doubleleft" type="password" id="password" name="password" placeholder="Password" required>
               <input class="doubleright" type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm password" required>
            </div>
            <button type="submit" name="submit" value="submit">Apply changes</button>
         </form>
      </div>
   </main>
</body>
</html>
