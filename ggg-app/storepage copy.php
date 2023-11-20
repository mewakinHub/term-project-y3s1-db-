<!DOCTYPE html>
<html lang="en">
<head>
   <!--Default-->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="asset/logo.png">
   <link rel="stylesheet" href="style/global.css">
   <link rel="stylesheet" href="style/variables.css">
   <?php include_once('component/icon.php'); ?>
   <!--Custom-->
   <title>GGG - Store Page</title>
   <link rel="stylesheet" href="style/navbar.css">
   <link rel="stylesheet" href="style/maincontent.css">
   <?php
      session_start();
      include_once('component/navbar.php');
      include_once('component/pageheader.php');  
   ?>
   <script src='script/slides.js'></script>
</head>
<body onload="currentSlide(1)">
   <?php Navbar('', $_SESSION['email']) ?>
   <main class="storepage">
      <a class="button-back" onclick="history.back()" draggable="false">
         <?php Icon('back') ?>
      </a>
      <div class="slideshow-container">
         <div class="slideshow-image">

         </div>
         <div class="mySlides fade">
            <img src="asset/pic1.png" style="width:100%">
         </div>
 
         <div class="mySlides fade">
            <img src="asset/pic2.png" style="width:100%">
         </div>
       
         <div class="mySlides fade">
            <img src="asset/pic3.png" style="width:100%">
         </div>
      </div>
      <div class="slideshow-controller">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="prev" onclick="plusSlides(-1)">&#10094;</span>
        <span class="next" onclick="plusSlides(-1)">&#10094;</span>
      </div>
   </main>
</body>
</html>