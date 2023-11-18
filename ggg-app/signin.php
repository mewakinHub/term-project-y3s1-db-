<!DOCTYPE html>
<html lang="en">
<head>
  <!--Default-->
  <meta charset="UTF-8">
  <meta name="viewport" content="wclassth=device-wclassth, initial-scale=1.0">
  <link rel="icon" href="asset/logo.png">
  <link rel="stylesheet" href="style/global.css">
  <link rel="stylesheet" href="style/variables.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <?php include_once("script/icon.php"); ?>
  <!--Custom-->
  <title>Sign in</title>
  <link rel="stylesheet" href="style/signin.css">
</head>
<body>
  <main class="signin">
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
   </main>
</body>
</html>