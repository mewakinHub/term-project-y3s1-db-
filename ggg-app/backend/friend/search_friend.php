<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("connect.php");
$searchErr = '';
$user_details = '';

if (isset($_POST['save'])) {
    if (!empty($_POST['search'])) {
        $search = $_POST['search'];
        $search = "%$search%"; // Add the wildcards here

        // Prepare the SQL statement with placeholders to prevent SQL injection
        $stmt = $con->prepare("SELECT * FROM user WHERE email LIKE :search OR username LIKE :search");
        // Bind the search query parameters
        $stmt->bindParam(':search', $search);
        $stmt->execute();
        $user_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($user_details);
    } else {
        $searchErr = "Please enter the information";
    }
}
?>
<html>
<head>
<title>Search User</title>
<link rel="stylesheet" href="bootstrap.css" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap-theme.css" crossorigin="anonymous">
<style>
.container{
    width:70%;
    height:30%;
    padding:20px;
}
</style>
</head>

<body>
    <div class="container">
    <h3><u>PHP MySQL Search User and Display Results</u></h3>
    <br/><br/>
    <form class="form-horizontal" action="#" method="post">
    <div class="row">
        <div class="form-group">
            <label class="control-label col-sm-4" for="search"><b>Search User Information:</b></label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="search" placeholder="Search by email or username">
            </div>
            <div class="col-sm-2">
              <button type="submit" name="save" class="btn btn-success btn-sm">Submit</button>
            </div>
        </div>
        <div class="form-group">
            <span class="error" style="color:red;">* <?php echo $searchErr;?></span>
        </div>
        
    </div>
    </form>
    <br/><br/>
    <h3><u>Search Result</u></h3><br/>
    <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Balance</th>
            <th>Bio</th>
          </tr>
        </thead>
        <tbody>
                <?php
                 if(!$user_details) {
                    echo '<tr><td colspan="5">No data found</td></tr>';
                 } else {
                    foreach($user_details as $key => $value) {
                        ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['username']; ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td><?php echo $value['balance']; ?></td>
                        <td><?php echo $value['bio']; ?></td>
                    </tr>
                        
                        <?php
                    }
                    
                 }
                ?>
         </tbody>
      </table>
    </div>
</div>
<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap.min.js"></script>
</body>
</html>
