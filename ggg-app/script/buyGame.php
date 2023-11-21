<?php
   if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
      // Call the AddInstalledGame stored procedure
      $stmt = $conn->prepare("CALL BuyGame(?, ?)");
      $stmt->bind_param("ii", $userID, $gameID);
      $userID = $_POST['userID']; 
      $gameID = $_POST['gameID']; 
      
      if ($stmt->execute()) {
         echo "<p>Game added to installed list!</p>";
      } else {
         echo "<p>Error: " . $stmt->error . "</p>";
      }
      
      $stmt->close();
   }
?>