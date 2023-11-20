<!DOCTYPE html>
<html lang="en">
<head>
   <!--Default-->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="asset/logo.png">
   <link rel="stylesheet" href="style/global.css">
   <link rel="stylesheet" href="style/variables.css">
   <?php include_once('component/icon.php'); include_once('component/alert.php'); ?>
   <?php include_once('component/icon.php'); ?>
   <!--Custom-->
   <title>GGG - Store Page</title>
   <?php include_once('component/navbar.php'); ?>
@ -15,12 +15,12 @@
   <link rel="stylesheet" href="style/maincontent.css">
</head>
<body>
   <?php Navbar('') ?>
   <?php Navbar('', '') ?>
   <main class="storepage">
      <a class="button-back" onclick="history.back()" draggable="false">
         <?php Icon('back') ?>
      </a>
   </main>
</body>
</html>