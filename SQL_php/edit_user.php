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
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Fetch user data based on userID
    $selectSql = "SELECT * FROM user WHERE userID = ?";
    $stmtSelect = $mysqli->prepare($selectSql);

    if ($stmtSelect) {
        $stmtSelect->bind_param('i', $userID);

        if ($stmtSelect->execute()) {
            $result = $stmtSelect->get_result();

            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
            } else {
                echo "User not found.";
                exit;
            }
        } else {
            echo "Error fetching user data: " . $stmtSelect->error;
            exit;
        }

        $stmtSelect->close();
    } else {
        echo "Error preparing select statement: " . $mysqli->error;
        exit;
    }
} else {
    echo "User ID not provided.";
    exit;
}

// Check if the form is submitted for updating user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare the update SQL dynamically based on form fields
    $updateSql = "UPDATE user SET ";
    $updateParams = array();

    foreach ($_POST as $key => $value) {
        // Skip fields that are not meant for updating or are empty
        if ($key == "userID" || empty($value)) {
            continue;
        }

        $updateSql .= "$key = ?, ";
        $updateParams[] = $value;
    }

    // Remove the trailing comma and space from the update SQL
    $updateSql = rtrim($updateSql, ", ");

    // Add the WHERE clause for the userID
    $updateSql .= " WHERE userID = ?";
    $updateParams[] = $userID;

    // Prepare and execute the dynamic update statement
    $stmtUpdate = $mysqli->prepare($updateSql);

    if ($stmtUpdate) {
        // Dynamically bind parameters based on form fields
        $bindTypes = str_repeat("s", count($updateParams));
        $stmtUpdate->bind_param($bindTypes, ...$updateParams);

        if ($stmtUpdate->execute()) {
            echo "User data updated successfully!";
            // Redirect back to admin.php
            header("Location: admin.php");
            exit;
        } else {
            echo "Error updating user data: " . $stmtUpdate->error;
        }

        $stmtUpdate->close();
    } else {
        echo "Error preparing update statement: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    <form method="post" action="">
        <?php
        // Display form fields dynamically based on user data columns
        foreach ($userData as $key => $value) {
            echo "<label for=\"$key\">$key:</label>";
            echo "<input type=\"text\" id=\"$key\" name=\"$key\" value=\"$value\"><br>";
        }
        ?>

        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
        <input type="submit" value="Update User">
    </form>
</body>
</html>
