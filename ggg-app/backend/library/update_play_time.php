<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");

$userID = $_SESSION['userID'];
$gameID = $_SESSION['gameID'];

if (isset($_POST['playButton'])) {
    $userID = $_POST['userID'];
    $gameID = $_POST['gameID'];


    $callProcedure = "CALL UpdatePlaytime($userID, $gameID)";
    mysqli_query($connection, $callProcedure);

    // Redirect back to the game details page or another appropriate page
    // header("Location: library.php?gameID=$gameID");
    exit();
}
?>