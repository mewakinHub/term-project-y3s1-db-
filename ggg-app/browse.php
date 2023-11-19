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
   <title>GGG - Browse</title>
   <?php include_once('component/navbar.php'); ?>
   <link rel="stylesheet" href="style/navbar.css">
   <?php include_once('component/pageheader.php'); ?>
   <link rel="stylesheet" href="style/pageheader.css"> 
   <link rel="stylesheet" href="style/maincontent.css"> 
</head>
<body>
   <?php Navbar('browse') ?>
   <main class="browse">
      <?php PageHeader('Browse') ?>
      <div class="game-grid">
         <div class="card">
            <img class="game-poster" draggable="false"
               src="asset/Picture1.png"
            />
            <p class="game-name">Baldur's Gate 3</p>
            <div class="game-sub">
               <p class="game-price">฿ 1699.00</p>
            </div>
         </div>
         
      </div>
   </main>
</body>
</html>