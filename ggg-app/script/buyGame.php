<?php
   require_once('connect.php');
   session_start();
   $userID = $_SESSION['userID'];
   $gameID = $_SESSION['gameID'];
   $q = "CALL BuyGame($userID, $gameID)";
   $result = $conn->query($q);
   if (!$result) {
      echo "Query error: " . $conn->error;
   }
   header('Location: ' . $_SERVER['HTTP_REFERER']);
?>