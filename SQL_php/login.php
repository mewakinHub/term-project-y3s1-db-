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
            $servername = "localhost";
            $username = "admin";
            $password = "admin";
            $database = "ggg";

            // Create a connection
            $mysqli = new mysqli($servername, $username, $password, $database);

            // Check the connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }
            session_start();

            // Enable error reporting for debugging purposes
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
		
			if (isset($_POST['submit'])) {
                // Retrieve values from the submitted form
                $username = mysqli_real_escape_string($mysqli, $_POST['username']);
                $password = mysqli_real_escape_string($mysqli, $_POST['password']);


				if ($username == 'admin' && $password == 'admin') {
                    $_SESSION["admin_loggedin"] = true;
                    // Regenerate session ID to prevent session fixation
                    session_regenerate_id(true);

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

            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>
</html>

