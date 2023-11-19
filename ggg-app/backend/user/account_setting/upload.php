<?

session_start();
require("connect.php");

//profile 
if (isset($_FILES["image"]) && $_FILES["image"]["error"]== 0){
    $image = $_FILES["image"]["tmp_name"];
    $imgContent = file_get_contents($image);

    $stmt = $conn->prepare("UPDATE INTO user(profilePicFile) VALUES(?)");
    $stmt -> execute([$imgContent]);

    if ($stmt){
             $_SESSION["success"] = "Image uploaded successfully";
             header("Location: update_user.php");
    } else { 
        $_SESSION["error"] = "Please select an image file to upload.";
        header("Location: update_user.php");
    }
}
?>