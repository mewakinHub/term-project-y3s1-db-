<?php
   require_once('connect.php');
   session_start();
   $userID = $_SESSION['userID'];
   $gameID = $_SESSION['gameID'];
   $q = "CALL BuyGame($userID, $gameID)";
   $stmt->bind_param("ii", $userID, $gameID);
   $result = $stmt->execute();
   if (!$result) {
      echo "Query error: " . $conn->error;
   }
   $stmt->close();
   header('Location: ' . $_SERVER['HTTP_REFERER']);
?>