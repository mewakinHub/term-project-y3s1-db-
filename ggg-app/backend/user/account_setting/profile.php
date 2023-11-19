<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>

    <?php
    // Check if $userData is defined before rendering the form
    if (isset($userData)) {
    ?>
    <form action="backend/user/account_setting/update.php" method="post" enctype="multipart/form-data">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $userData['email']; ?>" readonly>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>" readonly>

        <label for="balance">Balance:</label>
        <input type="text" id="balance" name="balance" value="<?php echo $userData['balance']; ?>" readonly>

        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio" readonly><?php echo $userData['bio']; ?></textarea>

        <label for="profilepic">Profile Picture:</label>
        <?php
        if (!empty($userData['profilePicFile'])) {
            echo '<img src="' . $userData['profilePicFile'] . '" alt="Profile Picture" style="max-width: 200px; height: auto;"><br>';
        } else {
            echo 'No profile picture available.<br>';
        }
        ?>

        <input type="file" id="profilepic" name="profilepic" accept="image/*" readonly>

        <input type="submit" name="submit" value="Edit Profile">
    </form>
    <?php
    } else {
        echo "User data not available.";
    }
    ?>
</body>
</html>