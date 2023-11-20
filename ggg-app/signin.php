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
   <title>GGG - Sign in</title>
   <link rel="stylesheet" href="style/signin.css">
   <?php 
      session_start();
      if(isset($_POST['submit'])) {
         $email = $_POST['email'];
         $password = $_POST['password'];
         $q = "SELECT password FROM user WHERE email='$email'";
         $result = $conn->query($q);
         if (!$result) {
            Alert("Query error: " . $conn->error);
         }
         else {
            $row = $result->fetch_array();
            if (!$row) {
               Alert('Invalid E-mail or Password');
            }
            else {
               $correctpassword = $row[0];
               if ($password != $correctpassword) {
                  Alert('Invalid E-mail or Password');
               }
               else{
                  $_SESSION['email'] = $email;
                  header('Location: featured.php');
               }
            }
         }
      }
   ?>
</head>
<body class="signin">
   <div class="signin-container">
      <img class="logofull" src="asset/logofull.png"
         style="max-width: 185px; height: auto;" draggable="false"
      />
      <div class="message-container">
         <h2 class="text-center">Welcome!</h2>
      </div>
      <form class="form-signin" action="signin.php" method="post">
         <div class="inputicon-container email">
            <input class="input-iconned"
               type="email" name="email" placeholder="E-mail" required
            />
            <?php Icon("mail") ?>
         </div>
         <div class="inputicon-container password">
            <input class="input-iconned"
               type="password" name="password" placeholder="Password" required
            />
            <?php Icon("key") ?>
         </div>
         <button type="submit" value="submit" name="submit">Sign in</button>
      </form>
      <a href="signup.php" draggable="false">
         <button class="button-signup" type="button">Create account</button>
      </a>
   </div>
</body>
</html>