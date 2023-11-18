<?php 
  require_once('connect.php');
  echo 'test';
  $data = json_decode(file_get_contents('php://input'));

  $email = mysqli_real_escape_string($conn, trim($data->email));
  $password = mysqli_real_escape_string($conn, trim($data->password));
  $confirmpassword = mysqli_real_escape_string($conn, trim($data->confirmpassword));
  $username = mysqli_real_escape_string($conn, trim($data->username));

  $q = "INSERT INTO user (email, password, username) VALUES ('$email', '$password', '$username')";
  $mysqli->query($q);
?>