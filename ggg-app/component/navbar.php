<?php
   include_once('script/icon.php');
   function Navbar($page) {
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
               <div class='nav-user'>
                  <hr/>
                  <button class='button-user'>
                     <div class='user-container'>
                        <img class='pfp' src='asset/pfp.png' draggable='false'/>
                        <div class='user-info'>
                           <p class='username'>username</p>
                           <p class='funds'>฿0.00</p>
                        </div>
                     </div>
                  </button>
               </div>
            </div> 
         </nav>
      ";
   }