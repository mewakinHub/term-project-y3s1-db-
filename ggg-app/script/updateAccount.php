<?
   require_once('connect.php');
   session_start();
   $stmt = $conn->prepare("CALL UpdateAccount(?, ?, ?, ?)");
   $stmt->bind_param("isss", $userID, $email, $username, $password);
   $userID = $_SESSION['userID']; 
   $email = $_POST['email'];
   $username = $_POST['username'];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   $result = $stmt->execute();
   if (!$result) {
      echo "Query error: " . $conn->error;
   }
   $stmt->close();
   header('Location: ' . $_SERVER['HTTP_REFERER']);
?>