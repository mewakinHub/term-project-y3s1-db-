<?
   require_once('connect.php');
   session_start(); 
   $stmt = $conn->prepare("CALL UpdatePlaytime(?, ?)");
   $stmt->bind_param("ii", $userID, $gameID);
   $userID = $_SESSION['userID']; 
   $gameID = $_GET['gameID'];
   $result = $stmt->execute();
   if (!$result) {
      echo "Query error: " . $conn->error;
   }
   header('Location: ' . $_SERVER['HTTP_REFERER']);
?>