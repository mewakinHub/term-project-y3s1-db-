<?php
   require_once('connect.php');
   session_start(); 
   $stmt = $conn->prepare("CALL TopUpBalance(?, ?)");
   $stmt->bind_param("ii", $userID, $gameID);
   $userID = $_SESSION['userID'];
   $topUpAmount = $_POST['topUpAmount'];
   $result = $stmt->execute();
   if (!$result) {
      echo "Query error: " . $conn->error;
   }
   $stmt->close();
   header('Location: ' . $_SERVER['HTTP_REFERER']);
?>