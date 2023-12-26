<?
   require_once('connect.php');
   include_once('../component/alert.php');
   session_start();
   $stmt = $conn->prepare("CALL DeleteAccount(?)");
   $stmt->bind_param("i", $userID);
   $userID = $_SESSION['userID']; 
   $result = $stmt->execute();
   if (!$result) {
      echo "Query error: " . $conn->error;
   }
   $stmt->close();
   header('Location: signout.php');
?>