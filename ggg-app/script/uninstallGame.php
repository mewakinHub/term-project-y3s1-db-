<?php
   require_once('connect.php');
   session_start(); 
   $stmt = $conn->prepare("CALL UninstallGame(?, ?)");
   $stmt->bind_param("ii", $userID, $gameID);
   $userID = $_SESSION['userID']; 
   $gameID = $_GET['gameID'];
   $result = $stmt->execute();
   if (!$result) {
      echo "Query error: " . $conn->error;
   }
   $stmt->close();
   header('Location: ' . $_SERVER['HTTP_REFERER']);
?>