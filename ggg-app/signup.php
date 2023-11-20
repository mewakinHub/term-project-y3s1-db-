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
   <title>GGG - Sign up</title>
   <link rel="stylesheet" href="style/signin.css">
   <?php 
      session_start();
      if(isset($_POST['submit'])) {
         $email = $_POST['email'];
         $password = $_POST['password'];
         $confirmpassword = $_POST['confirmpassword'];
         $username = $_POST['username'];
         if($password != $confirmpassword) {
            Alert('Password mismatch!');
         }
         else {
            $q = "INSERT INTO user (email, password, username) VALUES ('$email', '$password', '$username')";
            $result = $conn->query($q);
            if (!$result) {
               Alert("Query error: " . $conn->error);
            }
            else {
               $_SESSION['email'] = $email;
               header('Location: featured.php');
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
         <a class="button-icon" href="signin.php" draggable="false">
            <?php Icon('back') ?>
         </a>
         <h2 class="signin-message text-center">Create account</h2>
      </div>
      <form class="form-signin" action="signup.php" method="post">
         <div class="inputicon-container email">
            <input class="input-iconned"
               type='email' name='email' placeholder='E-mail' required
            />
            <?php Icon('mail') ?>
         </div>
         <div class="inputicon-container password">
            <input class="input-iconned"
               type='password' name='password' placeholder='Password' required
            />
            <?php Icon('key') ?>
         </div>
         <div class="inputicon-container password">
            <input class="input-iconned"
               type='password' name='confirmpassword' placeholder='Confirm Password' required
            />
            <?php Icon('key') ?>
         </div>
         <div class="inputicon-container username">
            <input class="input-iconned"
               type='text' name='username' placeholder='Display Name' 
            />
            <?php Icon('id') ?>
         </div>
         <button type="submit" value="submit" name="submit">Sign up</button>
      </form>
   </div>
</body>
</html>