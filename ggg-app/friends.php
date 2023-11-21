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
   <title>GGG - Friends</title>
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
</head>
<body>
   <?php Navbar('friends', $_SESSION['userID']) ?>
   <main>
      <div class="header">
         <h1>Friends</h1>
         <div class="searchbox-wrapper hidden">
            <div class="inputicon-container searchicon">
               <input type="text" name="searchstore" placeholder="Search Store" maxlength="32" class="iconned">
               <svg fill="none" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                  <path fill="currentColor" d="M764.522-134.913 523.848-375.587q-29.761 21.044-65.434 33.065-35.672 12.022-76.292 12.022-102.187 0-173.861-71.674Q136.587-473.848 136.587-576q0-102.152 71.674-173.826Q279.935-821.5 382.087-821.5q102.152 0 173.826 71.674 71.674 71.674 71.674 173.861 0 40.859-12.022 76.292-12.021 35.434-33.065 64.956l240.913 241.152-58.891 58.652ZM382.087-413.5q67.848 0 115.174-47.326Q544.587-508.152 544.587-576q0-67.848-47.326-115.174Q449.935-738.5 382.087-738.5q-67.848 0-115.174 47.326Q219.587-643.848 219.587-576q0 67.848 47.326 115.174Q314.239-413.5 382.087-413.5Z">
               </path>
            </svg>
            </div>
         </div>
      </div>
   </main>
</body>
</html>