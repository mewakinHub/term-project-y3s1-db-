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
   <link rel="stylesheet" href="style/funds.css">
   <?php
      session_start();
      include_once('component/navbar.php');
   ?>
   <script src='script/cardPopup.js'></script>
</head>
<body>
   <?php Navbar('', $_SESSION['userID']) ?>
   <main class="funds">
      <div class="funds-container">
         <h2>Current balance</h2>
         <?php
            $q = "SELECT balance FROM user WHERE userID=".$_SESSION['userID']."";
            $result = $conn->query($q);
            if (!$result) {
               Alert("Query error: " . $conn->error);
            }
            else {
               $row = $result->fetch_array();
               echo "<h1>฿ $row[0]</h1>";
            }
         ?>
         <a href="script/addBalance.php?topUpAmount=100">
            <button>Add ฿100</button>
         </a>
         <a href="script/addBalance.php?topUpAmount=150">
            <button>Add ฿150</button>
         </a>
         <a href="script/addBalance.php?topUpAmount=300">
            <button>Add ฿300</button>
         </a>
         <a href="script/addBalance.php?topUpAmount=500">
            <button>Add ฿500</button>
         </a>
         <a href="script/addBalance.php?topUpAmount=1000">
            <button>Add ฿1000</button>
         </a>
      </div>
   </main>
</body>
</html>