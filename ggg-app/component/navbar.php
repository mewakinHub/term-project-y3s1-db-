<script src='script/popup.js'></script>
<?php
   include_once('component/icon.php');
   function Navbar($page, $userID) {
      $conn = new mysqli('localhost','ggguser','ggguser','ggg');
      if($conn->connect_errno){
         echo $conn->connect_errno.": ".$conn->connect_error;
      }
      $q = "SELECT username, balance FROM user WHERE userID='$userID'";
      $result = $conn->query($q);
      if (!$result) {
         Alert("Query error: " . $conn->error);
      }
      else {
         $row = $result->fetch_array();
         $username = $row[0];
         $balance = $row[1];
      }
      echo "
         <nav>
            <div class='nav-wrapper'>
               <div class='nav-main'>
                  <img class='center logo' src='asset/logo.png'
                     style='max-width: 70px; height: auto;' draggable='false'
                  />
                  <div class='nav-main-buttons'>
                     <a"; if($page != 'featured') {echo " href='featured.php'";} echo "
                        class='button-wrapper' draggable='false'
                     >
                        <button class='featured"; if($page == 'featured') {echo " selected";} echo"'>
                           "; Icon('featured'); echo"
                           Featured
                        </button>
                     </a>
                     <a"; if($page != 'browse') {echo " href='browse.php'";} echo "
                        class='button-wrapper' draggable='false'
                     >
                        <button class='browse"; if($page == 'browse') {echo " selected";} echo"'>
                           "; Icon('browse'); echo"
                           Browse
                        </button>
                     </a>
                     <a"; if($page != 'library') {echo " href='library.php'";} echo "
                        class='button-wrapper' draggable='false'
                     >
                        <button class='library"; if($page == 'library') {echo " selected";} echo"'>
                           "; Icon('library'); echo"
                           Library
                        </button>
                     </a>
                     <a"; if($page != 'friends') {echo " href='friends.php'";} echo "
                        class='button-wrapper' draggable='false'
                     >
                        <button class='friends"; if($page == 'friends') {echo " selected";} echo"'>
                           "; Icon('friends'); echo"
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
                        "; Icon('adjust'); echo"
                     </div>
                  </div>
               </div>
               <div class='nav-user' onclick='togglePopup()'>
                  <hr/>
                  <button class='button-user'>
                     <div class='user-container'>
                        <img class='pfp' src='asset/pfp.png' draggable='false'/>
                        <div class='user-info'>
                           <p class='username'>$username</p>
                           <p class='funds'>฿ $balance</p>
                        </div>
                     </div>
                  </button>
               </div>
               <div class='popup' id='user-popup'>
                  <a href='script/signout.php'>
                     <p class='red'>Signout</p>
                  </a>
                  <a>
                     <p>Your profile</p>
                  </a>
                  <a>
                     <p>Funds</p>
                  </a>
               </div>
            </div> 
         </nav>
      ";
   }
?>