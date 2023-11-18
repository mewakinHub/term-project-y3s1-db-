<?php
$host = "127.0.0.1";
$user = "user";
$password = "userggg"; 
$database = "ggg";
$port = 8889;

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


session_start();

echo "<h1>Login Successfully</h1>";

$sql = "SELECT * FROM `user`";
$result = $conn->query($sql);

if ($result) {
    
    echo "<h3>Account Information</h3>";
    echo "<table border='1'>
            <tr>
                <th>email</th>
                <th>username</th>
                <th>password</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['email']}</td>
                <td>{$row['username']}</td>
                <td>{$row['password']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p style='color: red;'>Error fetching data from the database: " . $conn->error . "</p>";
}

$conn->close();
?>
