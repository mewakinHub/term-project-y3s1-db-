<?
   require_once('connect.php');
   function Alert() {
      echo "<script>if(confirm('Password mismatch!')){document.location.href='../profile.php'};</script>";
   }
   session_start();
   $stmt = $conn->prepare("CALL UpdateAccount(?, ?, ?, ?)");
   $stmt->bind_param("isss", $userID, $email, $username, $password);
   $userID = $_SESSION['userID']; 
   $email = $_POST['email'];
   $username = $_POST['username'];
   $confirmpassword = $_POST['confirmpassword'];
   $password = $_POST['password'];
   if ($password != $confirmpassword) {
      Alert();
   }
   else {
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $result = $stmt->execute();
      if (!$result) {
         echo "Query error: " . $conn->error;
      }
      $stmt->close();
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }
?>