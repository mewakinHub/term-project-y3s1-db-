<?php
// session_start(); 
// echo "<pre>Session variables in 'featured.php': ";
// print_r($_SESSION);
// echo "</pre>";
session_start();
include_once('component/navbar.php');

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username']; 
} else {
  $username = 'Guest'; 
}
include_once('component/navbar.php');  // Include the navbar component here
include_once('component/icon.php'); 
// $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';
?>


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
   <?php include_once('component/icon.php'); ?>
   <!--Custom-->
   <title>GGG - Featured</title>
   <?php include_once('component/navbar.php'); ?>
   <link rel="stylesheet" href="style/navbar.css">
   <link rel="stylesheet" href="style/main.css">
</head>
<body>

<?php
include_once('component/navbar.php');
Navbar('featured', $username); ?>
   <main class='featured'>
      <div class='header'>
         <p>Featured</p>
         <div class='searchbox-wrapper'>
            <div class='inputicon-container searchicon'>
              <input type='text' name='searchstore' placeholder='Search store' maxLength='32' class='iconned'/>
              <?php Icon('search') ?>
            </div>
         </div>
      </div>
      <hr/>
   </main>
</body>
</html>
