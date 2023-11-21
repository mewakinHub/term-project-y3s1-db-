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
      if(!isset($_SESSION['userID'])){
         header('Location: signin.php');
      } 
   ?>
   <script src='script/cardPopup.js'></script>
</head>
<body>
   <?php Navbar('library', $_SESSION['userID']) ?>
   <main>
      <div class="header">
         <h1 class="hidable">Library</h1>
         <div class="searchbox-wrapper">
            <div class="inputicon-container searchicon">
               <input type="text" name="searchlibrary" placeholder="Search Library" maxlength="32" class="iconned">
               <svg fill="none" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                  <path fill="currentColor" d="M764.522-134.913 523.848-375.587q-29.761 21.044-65.434 33.065-35.672 12.022-76.292 12.022-102.187 0-173.861-71.674Q136.587-473.848 136.587-576q0-102.152 71.674-173.826Q279.935-821.5 382.087-821.5q102.152 0 173.826 71.674 71.674 71.674 71.674 173.861 0 40.859-12.022 76.292-12.021 35.434-33.065 64.956l240.913 241.152-58.891 58.652ZM382.087-413.5q67.848 0 115.174-47.326Q544.587-508.152 544.587-576q0-67.848-47.326-115.174Q449.935-738.5 382.087-738.5q-67.848 0-115.174 47.326Q219.587-643.848 219.587-576q0 67.848 47.326 115.174Q314.239-413.5 382.087-413.5Z"></path>
               </svg>
            </div>
         </div>
         <div class="iconbutton-wrapper"><svg fill="none" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
               <path fill="currentColor" d="M480-120q-17 0-28.5-11.5T440-160v-160q0-17 11.5-28.5T480-360q17 0 28.5 11.5T520-320v40h280q17 0 28.5 11.5T840-240q0 17-11.5 28.5T800-200H520v40q0 17-11.5 28.5T480-120Zm-320-80q-17 0-28.5-11.5T120-240q0-17 11.5-28.5T160-280h160q17 0 28.5 11.5T360-240q0 17-11.5 28.5T320-200H160Zm160-160q-17 0-28.5-11.5T280-400v-40H160q-17 0-28.5-11.5T120-480q0-17 11.5-28.5T160-520h120v-40q0-17 11.5-28.5T320-600q17 0 28.5 11.5T360-560v160q0 17-11.5 28.5T320-360Zm160-80q-17 0-28.5-11.5T440-480q0-17 11.5-28.5T480-520h320q17 0 28.5 11.5T840-480q0 17-11.5 28.5T800-440H480Zm160-160q-17 0-28.5-11.5T600-640v-160q0-17 11.5-28.5T640-840q17 0 28.5 11.5T680-800v40h120q17 0 28.5 11.5T840-720q0 17-11.5 28.5T800-680H680v40q0 17-11.5 28.5T640-600Zm-480-80q-17 0-28.5-11.5T120-720q0-17 11.5-28.5T160-760h320q17 0 28.5 11.5T520-720q0 17-11.5 28.5T480-680H160Z"></path>
            </svg>
         </div>
      </div>
      <hr class='hr-header'/>
      <div class="game-grid">
      <?php 
            $q = "SELECT g.gameID, g.poster, g.name, o.playtime FROM own o
                  JOIN game g ON o.gameID = g.gameID
                  WHERE o.userID = '".$_SESSION['userID']."' AND o.installed = 1";
            $result = $conn->query($q);
            if (!$result) {
               Alert("Query error: " . $conn->error);
            }
            else {
               while ($row = $result->fetch_array()) {
                  echo '
                  <div class="card">
                     <a href="script/updatePlayTime.php?gameID='.$row[0].'">
                        <img class="game-poster" draggable="false"
                           src="data:image/png;base64,'.base64_encode($row[1]).'"
                        />
                        <p class="game-name webkitclamp">'.$row[2].'</p>
                     </a>
                     <div class="card-sub">
                        <p class="card-sub-p">'.$row[3].' hours played
                        </p>
                        <div class="button-icon dots" onclick="'; echo"cardPopup('card-popup$row[0]')"; echo'">';
                           Icon('dotsHori');
                        echo '
                        </div>
                     </div>
                     <div class="popup card-installed" id="card-popup'.$row[0].'">
                        <a href="script/updatePlayTime.php?gameID='.$row[0].'">
                           <p>Launch game</p>
                        </a>
                        <a href="storepage.php?gameID='.$row[0].'">
                           <p>Visit store page</p>
                        </a>
                        <a href="script/uninstallGame.php?gameID='.$row[0].'">
                           <p>Uninstall</p>
                        </a>
                     </div>
                  </div>
                  ';
               }
            }
         ?>
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
                  <div class="card disabled">
                     <a  onclick="'; echo"cardPopup('card-popup$row[0]')"; echo'">
                        <img class="game-poster" draggable="false"
                           src="data:image/png;base64,'.base64_encode($row[1]).'"
                        />
                        <p class="game-name webkitclamp">'.$row[2].'</p>
                     </a>
                     <div class="card-sub">
                        <p class="card-sub-p">Not installed</p>
                        <div class="button-icon dots"  onclick="'; echo"cardPopup('card-popup$row[0]')"; echo'">';
                           Icon('dotsHori');
                        echo '
                        </div>
                     </div>
                     <div class="popup card-uninstalled" id="card-popup'.$row[0].'">
                        <a href="storepage.php?gameID='.$row[0].'">
                           <p>Visit store page</p>
                        </a>
                        <a href="script/installGame.php?gameID='.$row[0].'">
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