<?php
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Headers: *");

   $mysqli = new mysqli("localhost", "root", "root", "ggg");
   
   if($mysqli === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
   }
?> 