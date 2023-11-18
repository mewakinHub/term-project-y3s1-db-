<!DOCTYPE html>
<html lang="en">
<head>
  <!--Defaults-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="asset/logo.png">
  <link rel="stylesheet" href="style/global.css">
  <link rel="stylesheet" href="style/variables.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!--Custom-->
  <title>Login</title>
  <link rel="stylesheet" href="style/signin.css">
  <?php include_once('script/icon.php'); ?>
</head>
<body>
  <main id="signin">
      <div id="signin-container">
         <img id="logofull" src="asset/logofull.png"
         style="max-width: 200px; height: auto;"
         />
         <h2 class="signin-message text-center">Welcome!</h2>
         <form class="form-signin" autocomplete="off">
            <div class="inputicon-container email">
               <input class="input-iconned"
                  type='text' name='email' placeholder='E-mail'
               />
               <?php Icon('mail') ?>
            </div>
            <div class="inputicon-container password">
               <input class="input-iconned"
                  type='password' name='password' placeholder='Password' 
               />
               <?php Icon('key') ?>
            </div>
            <button type="submit">Sign in</button>
         </form>
         <button id="signup" type="button">Create account</button>
      </div>
   </main>
</body>
</html>