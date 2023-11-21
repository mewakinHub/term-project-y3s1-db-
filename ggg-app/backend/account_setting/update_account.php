<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("connect.php");

// Check if the script is accessed through an HTTP request
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $userID = isset($_POST["userID"]) ? $_POST["userID"] : null;

    // Your logic for handling the user ID and updating user data
    if ($userID) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $username = $_POST["username"];
        // $balance = $_POST["balance"];
        $bio = $_POST["bio"];

        // Validate input, you can add more validation as needed
        $sql = "UPDATE user SET email=?, password=?, username=?, bio=? WHERE userID=?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssssi", $email, $password, $username, $bio, $userID);

            if ($stmt->execute()) {
                header("Location: /backend/account_setting/update_account.php?userID=$userID");
                exit;
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
        } else {
            echo "<p>Error preparing statement: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>User ID not provided.</p>";
        exit;
    }
} else {
    $userID = isset($_GET["userID"]) ? $_GET["userID"] : null;

    // Your logic for displaying the form
    if ($userID) {
        $sql = "SELECT  userID, email, password, username, bio FROM user WHERE userID=?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $userID);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $userData = $result->fetch_assoc();
                } else {
                    echo "<p>User not found.</p>";
                    // You might want to handle the case where the user is not found
                }
            } else {
                echo "<p>Error executing statement: " . $stmt->error . "</p>";
            }
    
            $stmt->close();
        } else {
            echo "<p>Error preparing statement: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>User ID not provided.</p>";
        exit;
    }
}

$conn->close();
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

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <?php
        // Display form fields dynamically based on user data columns
        if (isset($userData)) {
            foreach ($userData as $key => $value) {
                echo "<label for=\"$key\">$key:</label>";
                echo "<input type=\"text\" id=\"$key\" name=\"$key\" value=\"$value\"><br>";
            }
        }
        ?>
        <input type="hidden" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
        <input type="submit" name="submit" value="Update User">
    </form>

    <?php
    // Display delete link
    if (isset($userData['userID'])) {
        echo "<a href='delete_user.php?userID=" . $userData['userID'] . "' class='button-link'>Delete User</a>";
    }
    ?>

    <label for="upload">Upload profile</label> 
    <input type="file" class="form-control" name="image">

    <?php 
    // Display user profile picture
    if (isset($userData['profilePicFile']) && !empty($userData['profilePicFile'])) {
        echo '<img src="data:image/jpeg;base64,' . base64_encode($userData['profilePicFile']) . '" alt="Profile picture" style="width: 50px; height: 50px; border-radius: 50%;">';
    } else {
        echo '<img src="/backend/friend/user%20(2).png" style="width: 50px; height: 50px; border-radius: 50%;">';
    }
    ?>

    <hr>
    <h3>Uploaded images</h3>
</body>
</html>
