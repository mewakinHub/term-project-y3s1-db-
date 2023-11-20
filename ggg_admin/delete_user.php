<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$database = "ggg";

// Create a connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($mysqli->errno) {
    echo("Connection failed: " . $mysqli->connect_error);
}

// Check if the userID parameter is set
if(isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Prepare and execute the DELETE statement(stmt = statement)
    $deleteSql = "DELETE FROM user WHERE userID = ?"; //'?' is placeholder
    $stmt = $mysqli->prepare($deleteSql);
    $stmt->bind_param('i', $userID); //'i' = integer, binds to placeholder

    if ($stmt->execute()) {
        //redirect back to previous page
		header("Location: admin.php");
        //(assuming delete_user.php is included in another file)
        // header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$mysqli->close();
?>


<?php
	$id = $_GET['id']; //group
	$userid = $_GET['userid'];
	require_once('connect.php');
	if (isset($id)) {
		$q="DELETE FROM USERGROUP where USERGROUP_ID=$id";
			if(!$mysqli->query($q)){
				echo "DELETE failed. Error: ".$mysqli->error ;
		   }
		   $mysqli->close();
		   //redirect
		   header("Location: group.php");
	}
	elseif(isset($userid)) {
		$q="DELETE FROM USER where USER_ID=$userid";
			if(!$mysqli->query($q)){
				echo "DELETE failed. Error: ".$mysqli->error ;
		   }
		   $mysqli->close();
		   //redirect
		   header("Location: user.php");
	}
?>
