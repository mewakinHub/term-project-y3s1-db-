<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "LetMeSell";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";


$query = "SELECT * FROM Customer";

echo $query;

echo "<b> <center>Database Output</center> </b> <br> <br>";

if ($result = $conn->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $field1name = $row["Customer_ID"];
        $field2name = $row["Fname"];
        $field3name = $row["Lname"];
        
        echo '<b>'.$field1name."\t".$field2name."\t".$field3name.'</b><br />';
        
    }

/*freeresultset*/
$result->free();
}

mysqli_close($conn);

?>

