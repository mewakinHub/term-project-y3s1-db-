<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    

    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    // Check if the login input is an email or a username
    $column = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    // Prepare and execute a SELECT query using a prepared statement
    $query = "SELECT id, username, email, password FROM user_form WHERE $column = ?";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $login);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];

            if ($password == $hashed_password) { // Compare hashed password
                // Password is correct, set session and redirect
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                header('Location: home.php');
                exit();
            } else {
                $message = 'Incorrect password!';
            }
        } else {
            $message = 'User not found!';
        }
    } else {
        die("Query preparation failed: " . mysqli_error($conn));
    }

    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

   <!-- Bootstrap CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/login.css">

</head>

<style>
  body {
    font-family: 'FontAwesome';
  }
</style>

<body>

   <div class="form-container">

      <form action="" method="post" enctype="multipart/form-data">
         <h3>Login now</h3>
         <?php
         if (isset($message)) {
            echo '<div class="message">' . $message . '</div>';
         }
         ?>
         <!-- Input for Email or Username -->
         <div class="col-lg-12 d-flex justify-content-start">
            <label class="col-form-label">Email or Username</label>
         </div>
         <input type="text" name="login" placeholder="Enter email or username" class="box form-control" required>

         <!-- Input for Password -->
         <div class="col-lg-12 d-flex justify-content-start">
            <label class="col-form-label">Password</label>
         </div>
         <input type="password" name="password" placeholder="Enter password" class="box form-control" required>

         <!-- Submit button -->
         <input type="submit" name="submit" value="Login now" class="btn">

         <hr style="border: 2px solid gray;">

         <!-- Go to the registration page -->
         <p>Don't have an account? <a href="register.php">Register now</a></p>
      </form>

   </div>

</body>

</html>
