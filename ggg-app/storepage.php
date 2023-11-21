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
   <title>GGG - Store Page</title>
   <link rel="stylesheet" href="style/navbar.css">
   <link rel="stylesheet" href="style/maincontent.css">
   <link rel="stylesheet" href="style/storepage.css">
   <?php
      session_start();
      include_once('component/navbar.php');
      include_once('component/pageheader.php');
      if(!isset($_SESSION['userID'])){
         header('Location: signin.php');
      }   
      $gameID = $_GET['gameID'];
      $_SESSION['gameID'] = $gameID;
   ?>
   <script src='script/slides.js'></script>
</head>
<body onload="currentSlide(1)">
   <?php Navbar('', $_SESSION['userID']) ?>
   <main class="storepage">
      <a class="button-icon back" onclick="history.back()" draggable="false">
         <?php Icon('back') ?>
      </a>
      <div class="header-container">
         <div class="slideshow-container">
            <div class="slideshow-image">
               <?php
                  $q = "SELECT file FROM media WHERE gameID='$gameID'";
                  $result = $conn->query($q);
                  if (!$result) {
                     Alert("Query error: " . $conn->error);
                  }
                  else {
                     while ($row = $result->fetch_array()) {
                        echo'
                        <div class="mySlides fade">
                           <img src="data:image/png;base64,'.base64_encode($row[0]).'">
                        </div>';
                     }
                  }
               ?>
            </div>
            <div class="slideshow-controller">
               <span class="prev button-icon" onclick="plusSlides(-1)">
                  <?php Icon('arrowLeft'); ?>
               </span>
                  <?php
                     $q = "SELECT file FROM media WHERE gameID='$gameID'";
                     $result = $conn->query($q);
                     $count = mysqli_num_rows($result);
                     if (!$result) {
                        Alert("Query error: " . $conn->error);
                     }
                     else {
                        for($i = 1; $i <= $count; $i++){
                           echo '
                           <span class="dot-wrapper" onclick="currentSlide('.$i.')">
                              <div class="dot"></div>
                           </span>';
                        }
                     }
                  ?>
               <span class="next button-icon" onclick="plusSlides(1)">
                  <?php Icon('arrowRight'); ?>
               </span>
             </div>
         </div>
         <div class="subheader-container">
            <h1 class="title webkitclamp">
               <?php
                  $q = "SELECT name FROM game
                        WHERE game.gameID = '$gameID'";
                  $result = $conn->query($q);
                  $count = mysqli_num_rows($result);
                  if (!$result) {
                     Alert("Query error: " . $conn->error);
                  }
                  else {
                     while ($row = $result->fetch_array()) {
                        echo "$row[0]";
                     }
                  }
               ?>
            </h1>
            <span class="buy-container flex-row">
               <?php
                  $q = "SELECT * FROM own WHERE userID='".$_SESSION['userID']."' and gameID='$gameID'";
                  $result = $conn->query($q);
                  if (!$result) {
                     Alert("Query error: " . $conn->error);
                  }
                  else {
                     $row = $result->fetch_array();
                     if (!$row) {
                        echo "
               <form action='script/buyGame.php'>
                  <button type='submit'>BUY NOW</button>
               </form>
                        ";
                     }
                     else {
                         echo "
                  <button class='button-off'>You own this game.</button>
                        ";
                     }
                  }
               ?>
               <h3>฿ 
                  <?php
                     $q = "SELECT price FROM game
                           WHERE game.gameID = '$gameID'";
                     $result = $conn->query($q);
                     if (!$result) {
                        Alert("Query error: " . $conn->error);
                     }
                     else {
                        while ($row = $result->fetch_array()) {
                           echo "$row[0]";
                        }
                     }
                  ?>
               </h3>
            </span>
            <div class="grid-info">
               <span>Tags:</span>
               <h5>
                  <?php
                     $q = "SELECT tag.name FROM tag
                           INNER JOIN game_tag ON game_tag.tagID = tag.tagID
                           WHERE game_tag.gameID = '$gameID'";
                     $result = $conn->query($q);
                     $count = mysqli_num_rows($result);
                     if (!$result) {
                        Alert("Query error: " . $conn->error);
                     }
                     else {
                        while ($row = $result->fetch_array()) {
                           echo "$row[0]";
                           if ($count != 1) {
                              echo ", ";
                              $count--;
                           }
                        }
                     }
                  ?>
               </h5>
               <span>Developer:</span>
               <h5>
                  <?php
                     $q = "SELECT studio.name FROM studio
                           INNER JOIN game_studio ON game_studio.studioID = studio.studioID
                           WHERE game_studio.gameID = '$gameID' AND type='developer'";
                     $result = $conn->query($q);
                     $count = mysqli_num_rows($result);
                     if (!$result) {
                        Alert("Query error: " . $conn->error);
                     }
                     else {
                        while ($row = $result->fetch_array()) {
                           echo "$row[0]";
                           if ($count != 1) {
                              echo ", ";
                              $count--;
                           }
                        }
                     }
                  ?>
               </h5>
               <span>Publisher:</span>
               <h5>
                  <?php
                     $q = "SELECT studio.name FROM studio
                           INNER JOIN game_studio ON game_studio.studioID = studio.studioID
                           WHERE game_studio.gameID = '$gameID' AND type='publisher'";
                     $result = $conn->query($q);
                     $count = mysqli_num_rows($result);
                     if (!$result) {
                        Alert("Query error: " . $conn->error);
                     }
                     else {
                        while ($row = $result->fetch_array()) {
                           echo "$row[0]";
                           if ($count != 1) {
                              echo ", ";
                              $count--;
                           }
                        }
                     }
                  ?>
               </h5>
               <span>Release Date:</span>
               <h5>
                  <?php
                     $q = "SELECT releaseDate FROM game
                           WHERE game.gameID = '$gameID'";
                     $result = $conn->query($q);
                     if (!$result) {
                        Alert("Query error: " . $conn->error);
                     }
                     else {
                        while ($row = $result->fetch_array()) {
                           echo "$row[0]";
                        }
                     }
                  ?>
               </h5>
            </div>
         </div>
      </div>
      <hr/>
      <div class="description">
         <h5>
            <?php
               $q = "SELECT shortDesc FROM game
                     WHERE game.gameID = '$gameID'";
               $result = $conn->query($q);
               if (!$result) {
                  Alert("Query error: " . $conn->error);
               }
               else {
                  while ($row = $result->fetch_array()) {
                     echo "$row[0]";
                  }
               }
            ?>
         </h5>
         <br>
         <?php
            $q = "SELECT description FROM game
                  WHERE game.gameID = '$gameID'";
            $result = $conn->query($q);
            if (!$result) {
               Alert("Query error: " . $conn->error);
            }
            else {
               while ($row = $result->fetch_array()) {
                  echo "$row[0]";
               }
            }
         ?>
         <br>
      </div>
   </main>
</body>
</html>