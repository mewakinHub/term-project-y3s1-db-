<!-- edit_studio.php -->
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

session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Check if the studioID parameter is set
if (isset($_GET['id'])) {
    $studioID = $_GET['id'];

    // Fetch studio data based on studioID
    $selectSql = "SELECT studioID, name FROM studio WHERE studioID = ?";
    $stmtSelect = $mysqli->prepare($selectSql);

    if ($stmtSelect) {
        $stmtSelect->bind_param('i', $studioID);

        if ($stmtSelect->execute()) {
            $result = $stmtSelect->get_result();

            if ($result->num_rows > 0) {
                $studioData = $result->fetch_assoc();
            } else {
                echo "Studio not found.";
                exit;
            }
        } else {
            echo "Error fetching studio data: " . $stmtSelect->error;
            exit;
        }

        $stmtSelect->close();
    } else {
        echo "Error preparing select statement: " . $mysqli->error;
        exit;
    }
} else {
    echo "Studio ID not provided.";
    exit;
}

// Check if the form is submitted for updating studio data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'], $_POST['studioID'])) {
    // Prepare the update SQL dynamically based on form fields

    $studioID = $_POST['studioID'];
    $updateSql = "UPDATE studio SET ";
    $updateParams = array();
    $paramTypes = '';

    foreach ($_POST as $key => $value) {
        if ($key == "studioID" || $key == "submit" || empty($value)) {
            continue;
        }

        $updateSql .= "$key = ?, ";
        $updateParams[] = $value;
        $paramTypes .= 's';
    }

    $updateSql = rtrim($updateSql, ", ");
    $updateSql .= " WHERE studioID = ?";
    $updateParams[] = $studioID;
    $paramTypes .= 'i';

    $stmtUpdate = $mysqli->prepare($updateSql);

    if ($stmtUpdate) {
        $stmtUpdate->bind_param($paramTypes, ...$updateParams);

        if ($stmtUpdate->execute()) {
            echo "Studio data updated successfully!";
            // Redirect or handle the session update logic here
        } else {
            echo "Error updating studio data: " . $stmtUpdate->error;
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
    <title>Edit Studio</title>
</head>
<body>

    <h1>Edit Studio</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        // Display form fields dynamically based on studio data columns
        if (isset($studioData)) {
            foreach ($studioData as $key => $value) {
                echo "<label for=\"$key\">$key:</label>";
                echo "<input type=\"text\" id=\"$key\" name=\"$key\" value=\"$value\"><br>";
            }
        }
        ?>
        <input type="hidden" name="studioID" value="<?php echo isset($studioID) ? $studioID : ''; ?>">
        <input type="submit" name="submit" value="Update Studio">
        <a href='delete_studio.php?id=<?php echo $studioID; ?>' class='delete-btn' onclick='return confirmDelete();'>Delete Studio</a>
    </form>

</body>
</html>
