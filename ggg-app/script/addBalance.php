<?php
   require_once('connect.php');
   session_start(); 
   $stmt = $conn->prepare("CALL AddBalance(?, ?)");
   $stmt->bind_param("ii", $userID, $topUpAmount);
   $userID = $_SESSION['userID'];
   $topUpAmount = $_GET['topUpAmount'];
   $result = $stmt->execute();
   if (!$result) {
      echo "Query error: " . $conn->error;
   }
   $stmt->close();
   header('Location: ' . $_SERVER['HTTP_REFERER']);
?>