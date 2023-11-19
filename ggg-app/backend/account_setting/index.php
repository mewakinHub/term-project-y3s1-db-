<?php require_once('connect.php');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
	<title>Upload image, display, edit and delete in PHP </title>
</head>
<body>
<div class="container_display">
		<span style="float:right;"><a href="upload.php"><button class="btn-primary">Upload New image </button></a></span>
		<br><br>
	<?php 
	if(isset($_GET['image_success']))
		{
		echo '<div class="success">Image Uploaded successfully</div>'; 
		}

		if(isset($_GET['action']))
		{
    $action=$_GET['action'];
	if($action=='saved')
	{
		echo '<div class="success">Saved </div>'; 
	}
	elseif($action=='deleted')
	{
		echo '<div class="success">Image Deleted Successfully ... </div>'; 
	}
		}
	?>
	<table cellpadding="10">
		<tr>
			<th> Image</th>
			<th>Title</th>
			<th>Action</th>
		</tr>
		<?php $res=mysqli_query($db,"SELECT * from user ORDER by id DESC");
			while($row=mysqli_fetch_array($res)) 
			{
				echo '<tr> 
                  <td><img src="uploads/'.$row['profilePicFile'].'" height="200"></td> 
                  <td>'.$row['title'].'</td> 
                  <td><a href="edit.php?id='.$row['id'].'"><button class="btn-primary">Edit </button></a>
                  	<br> <br>
                  	 <a href=\'delete.php?id='.$row['id'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><button class="btn-primary btn_del">Delete</button></a>
                  </td> 
				</tr>';
} ?>
		
	</table>
	</div>
</body>
</html>