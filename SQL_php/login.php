<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <div>
        <h2>Login</h2>
        <?php
            // Enable error reporting for debugging purposes
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
		
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve values from the submitted form
				$username = $_POST['username'];
				$password = $_POST['password'];

				if ($username == 'admin' && $password == 'admin') {
                    // if correct, redirect to admin.php
					header("Location: admin.php");
					exit();
				} else {
					echo "<p>Incorrect username or password.</p>";
				}
			}
        ?>

        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <br>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

