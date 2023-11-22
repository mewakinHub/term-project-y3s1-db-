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
      if(isset($_SESSION['userID'])){
         header('Location: store.php');
      }
      if(isset($_POST['submit'])) {
         $email = mysqli_real_escape_string($conn, $_POST['email']);
         $password = mysqli_real_escape_string($conn, $_POST['password']);

         $stmt = $conn->prepare("SELECT * FROM user WHERE email=?");
         $stmt->bind_param("s", $email);
         $stmt->execute();
         $result = $stmt->get_result();

         if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];
    
            if (password_verify($password, $hashedPassword)) {
               $_SESSION['userID'] = $user['userID'];
               header('Location: store.php');
            } else {
               Alert('Invalid E-mail or Password');
            }
         } else {
               Alert('Invalid E-mail or Password');
         }
    
         $stmt->close();
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