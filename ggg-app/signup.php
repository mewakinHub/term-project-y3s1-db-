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
      // (c.)Check if the user is logged in, if yes, redirect back to the store page
      // not let them switch back after login(need to sign out)
      if(isset($_SESSION['userID'])){
         header('Location: store.php');
      }
      if(isset($_POST['submit'])) {
         // Retrieve values from the submitted form (get user input)
         $email = $_POST['email'];
         $password = $_POST['password'];
         $confirmpassword = $_POST['confirmpassword'];
         $username = $_POST['username'];
         
         // Check if passwords match
         if($password != $confirmpassword) {
            Alert('Password mismatch!');
         } else {
            // (a.)Prepared statement to prevent SQL injection
            // (b.)password_hash: in the case that database breaching
            $stmt = $conn->prepare("INSERT INTO user (email, password, username) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, password_hash($password, PASSWORD_DEFAULT), $username);

            // Execute the prepared statement
            if ($stmt->execute()) {
               $_SESSION['userID'] = $email;
               header('Location: store.php');
            } else {
               Alert("Query error: " . $stmt->error);
            }
            
            // Close the prepared statement
            $stmt->close();
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