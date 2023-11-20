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
   <title>GGG - Friends</title>
   <link rel="stylesheet" href="style/navbar.css">
   <link rel="stylesheet" href="style/pageheader.css">
   <?php
      session_start();
      include_once('component/navbar.php');
      include_once('component/pageheader.php');  
   ?>
</head>
<body>
   <?php Navbar('friends', $_SESSION['email']) ?>
   <main>
      <?php PageHeader('Friends') ?>
   </main>
</body>
</html>