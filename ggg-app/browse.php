<!DOCTYPE html>
<html lang="en">
<head>
   <!--Default-->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="asset/logo.png">
   <link rel="stylesheet" href="style/global.css">
   <link rel="stylesheet" href="style/variables.css">
   <?php include('component/icon.php'); ?>
   <!--Custom-->
   <title>GGG - Browse</title>
   <?php include('component/navbar.php'); ?>
   <link rel="stylesheet" href="style/navbar.css">
   <?php include('component/pageheader.php'); ?>
   <link rel="stylesheet" href="style/pageheader.css"> 
   <link rel="stylesheet" href="style/browse.css"> 
</head>
<body>
   <?php Navbar('browse') ?>
   <main>
      <?php PageHeader('Featured') ?>
      <div class="game-grid">
         <div class="card">
            <img class="poster" src="asset/Picture1.png"
               style="max-width: 180px; height: auto;" draggable="false"
            />
            <p>Baldur's Gate 3</p>
         </div>
      </div>
   </main>
</body>
</html>