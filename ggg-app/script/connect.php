<?php
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
   $conn = new mysqli('localhost','ggguser','ggguser','ggg');
   if($conn->connect_errno){
      echo $conn->connect_errno.": ".$conn->connect_error;
   }
?>