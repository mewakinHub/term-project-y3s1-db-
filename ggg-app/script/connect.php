<?php
   $mysqli = new mysqli('localhost','ggguser','ggguser','ggg');
   if($mysqli->connect_errno){
      echo $mysqli->connect_errno.": ".$mysqli->connect_error;
   }
?>