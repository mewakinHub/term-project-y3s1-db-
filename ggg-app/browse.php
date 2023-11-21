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
   <title>GGG - Browse</title>
   <link rel="stylesheet" href="style/navbar.css">
   <link rel="stylesheet" href="style/pageheader.css"> 
   <link rel="stylesheet" href="style/maincontent.css"> 
   <?php
      session_start();
      include_once('component/navbar.php');
      include_once('component/pageheader.php');
      if(!isset($_SESSION['userID'])){
         header('Location: signin.php');
      }
   ?>
</head>
<body>
   <?php Navbar('browse', $_SESSION['userID']) ?>
   <main class="browse">
      <?php PageHeader('Browse') ?>
      <div class="game-grid">
         <?php 
            $q = "SELECT gameID, poster, name, price FROM game";
            $result = $conn->query($q);
            if (!$result) {
               Alert("Query error: " . $conn->error);
            }
            else {
               while ($row = $result->fetch_array()) {
                  echo '
                  <a class="card" href="storepage.php?gameID='.$row[0].'">
                     <img class="game-poster" draggable="false"
                        src="data:image/png;base64,'.base64_encode($row[1]).'"
                     />
                     <p class="game-name webkitclamp">'.$row[2].'</p>
                     <div class="card-sub">
                        <p class="game-price">฿ '.$row[3].'</p>
                     </div>
                  </a>
                  ';
               }
            }
         ?>
      </div>
   </main>
</body>
</html>