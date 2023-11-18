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
  <?php include_once('script/icon.php'); ?>
  <!--Custom-->
  <title>GGG - Featured</title>
  <link rel="stylesheet" href="style/nav.css">
  <link rel="stylesheet" href="style/main.css">
</head>
<body>
   <nav>
      <div class='nav-wrapper'>
         <div class='nav-main'>
            <img class='center logo' src="asset/logo.png"
               style="max-width: 70px; height: auto;" draggable="false"
            />
            <div class='nav-main-buttons'>
               <a href="featured.php" class='button-wrapper' draggable="false">
                  <button class="featured selected">
                     <?php Icon('featured') ?>
                     Featured
                  </button>
               </a>
               <a href="browse.php" class='button-wrapper' draggable="false">
                  <button class="browse">
                     <?php Icon('browse') ?>
                     Browse
                  </button>
               </a>
               <a href="library.php" class='button-wrapper' draggable="false">      
                  <button class="library">
                     <?php Icon('library') ?>
                     Library
                  </button>
               </a>
               <a href="friends.php" class='button-wrapper' draggable="false">      
                  <button class="friends">
                     <?php Icon('friends') ?>
                     Friends
                  </button>
               </a>
            </div>
            <hr/>
         </div>
         <div class='nav-installed'>
            <div class='installed-header'>
               <p>Installed</p>
               <div class='iconbutton-wrapper'>
                  <?php Icon('adjust') ?>
               </div>
            </div>
         </div>
         <div class='nav-user'>
            <hr/>
            <button class='button-user'>
               <div class='user-container'>
                  <img class='pfp' src="asset/pfp.png" draggable="false"/>
                  <div class='user-info'>
                     <p class='username'>username</p>
                     <p class='funds'>฿0.00</p>
                  </div>
               </div>
            </button>
         </div>
      </div> 
   </nav>
   <main>
      
   </main>
</body>
</html>