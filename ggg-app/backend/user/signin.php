<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once('connect.php');

$errors = array();

print_r($_POST);

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Use prepared statements for better security
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
   

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Use password_verify to check the password
        if ($password === $row['password']) {
            
            $_SESSION["ID"] = $row["userID"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["balance"] = $row["balance"];
            $_SESSION["bio"] = $row["bio"];

            echo $_SESSION["username"];

            header("Location: /featured.php");
            exit();
        } else {
            echo "alert('Password not correct');";
            // header("Location: /signin.php");
            exit();
        }
    } else {
        echo "alert('User not found');";
        header("Location: /signin.php");
        exit();
    }
} else {
    echo "alert('Form not submitted');";
}
?>
