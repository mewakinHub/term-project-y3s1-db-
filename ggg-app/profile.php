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
      <a >
         <button>Delete Account</button>
      </a>
   </main>
</body>
</html>
