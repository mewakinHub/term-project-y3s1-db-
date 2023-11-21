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
   <title>GGG - Library</title>
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
   <script src='script/cardPopup.js'></script>
</head>
<body>
   <?php Navbar('library', $_SESSION['userID']) ?>
   <main>
      <?php PageHeader('Library') ?>
      <div class="game-grid">
         <?php 
            $q = "SELECT g.gameID, g.poster, g.name FROM own o
                  JOIN game g ON o.gameID = g.gameID
                  WHERE o.userID = '".$_SESSION['userID']."' AND o.installed = 0";
            $result = $conn->query($q);
            if (!$result) {
               Alert("Query error: " . $conn->error);
            }
            else {
               while ($row = $result->fetch_array()) {
                  echo '
                  <div class="card disabled" onclick="cardPopup()">
                     <a>
                        <img class="game-poster" draggable="false"
                           src="data:image/png;base64,'.base64_encode($row[1]).'"
                        />
                        <p class="game-name webkitclamp">'.$row[2].'</p>
                     </a>
                     <div class="card-sub">
                        <p class="card-sub-p">Not installed</p>
                        <div class="button-icon dots">';
                           Icon('dotsHori');
                        echo '
                        </div>
                     </div>
                     <div class="popup" id="card-popup">
                        <a href="storepage.php?gameID='.$row[0].'">
                           <p>Visit store page</p>
                        </a>
                        <a>
                           <p>Install</p>
                        </a>
                     </div>
                  </div>
                  ';
               }
            }
         ?>
      </div>
   </main>
</body>
</html>