<!DOCTYPE html>
<html lang="en">
<head>
   <!--Default-->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="asset/logo.png">
   <link rel="stylesheet" href="style/global.css">
   <link rel="stylesheet" href="style/variables.css">
   <?php include("component/icon.php"); ?>
   <!--Custom-->
   <title>GGG - Sign in</title>
   <link rel="stylesheet" href="style/signin.css">
</head>
<body class="signin">
   <div class="signin-container">
      <img class="logofull" src="asset/logofull.png"
         style="max-width: 185px; height: auto;" draggable="false"
      />
      <div class="message-container">
         <h2 class="text-center">Welcome!</h2>
      </div>
      <form class="form-signin" action="featured.php">
         <div class="inputicon-container email">
            <input class="input-iconned"
               type="text" name="email" placeholder="E-mail" required
            />
            <?php Icon("mail") ?>
         </div>
         <div class="inputicon-container password">
            <input class="input-iconned"
               type="password" name="password" placeholder="Password" required
            />
            <?php Icon("key") ?>
         </div>
         <button type="submit">Sign in</button>
      </form>
      <a href="signup.php" draggable="false">
         <button class="button-signup" type="button">Create account</button>
      </a>
   </div>
</body>
</html>