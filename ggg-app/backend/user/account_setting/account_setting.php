<?php 
session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link rel="stylesheet" href="default.css">
</head>
<body>

<div id="wrapper">
    <form action="/backend/user/account_setting/update.php" method="post" enctype="multipart/form-data">
      
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required><br>

        <label for="balance">Balance:</label>
        <input type="text" name="balance" id="balance" value="<?php echo htmlspecialchars($_SESSION['balance']); ?>" required><br>

        <label for="bio">Bio:</label>
        <textarea name="bio" id="bio" required><?php echo htmlspecialchars($_SESSION['bio']); ?></textarea><br>

        <label for="profilepic">Profile Picture:</label>
        <input type="file" name="profilepic" id="profilepic" accept="image/*"><br>
        
        <!-- Hidden field for user ID -->
        <input type="hidden" name="userid" value="<?php echo htmlspecialchars($_SESSION['ID']); ?>">

        <input type="submit" name="profileclick" value="Update Profile">
    </form>
</div>

</body>
</html>
