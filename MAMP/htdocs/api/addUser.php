<?php
  require_once('header.php');
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];
  if ($password != $confirmpassword) {
    echo "Password is mismatched!";
  }
  else {
    $q = "INSERT INTO user (email, password, username) VALUES
          ('$email', '$password', '$username');";
    $result = $mysqli->query($q);
    if(!$result) {
      echo "Query failed. Error: ".$mysqli->error;
    }
    else {
      echo "User added";
    } 
  }
?>