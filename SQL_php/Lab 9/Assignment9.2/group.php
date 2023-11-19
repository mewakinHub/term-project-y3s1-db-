<?php require_once('connect.php'); ?> 
<!DOCTYPE html>
<html>
<head>
<title>CSS326 Sample</title>
<link rel="stylesheet" href="default.css">
</head>
<body>
<div id="wrapper"> 
	<?php include 'header.php'; ?>
	<div id="div_main">
		<div id="div_left">
				
		</div>
		<div id="div_content" class="usergroup">
			<!--%%%%% Main block %%%%-->
			<?php 
				if(isset($_POST['submit'])) {
					// groupcode, groupname, remark, url should be inserted to USERGROUP table
					$groupcode = $_POST['groupcode'];
					$groupname = $_POST['groupname'];
					$remark = $_POST['remark'];
					$url = $_POST['url'];
					$q = "INSERT INTO usergroup (USERGROUP_CODE, USERGROUP_NAME, USERGROUP_REMARK, USERGROUP_URL)
								VALUES ('$groupcode', '$groupname', '$remark', '$url');";
					$result = $mysqli->query($q);
					if(!$result) {
						echo "Query failed: ".$mysqli->error;
					}
				}
			?>
			<h2>User Group</h2>			
			<table>
                <col width="10%">
                <col width="20%">
                <col width="30%">
                <col width="30%">
                <col width="5%">
                <col width="5%">

                <tr>
                    <th>Group Code</th> 
                    <th>Group Name</th>
                    <th>Remark</th>
                    <th>URL</th>
                    <th>Edit</th>
                    <th>Del</th>
                </tr>
				 <?php
				 	$q="select * from USERGROUP";
					$result=$mysqli->query($q);
					if(!$result){
						echo "Select failed. Error: ".$mysqli->error ;
						return false;
					}
				  while($row=$result->fetch_array()){ ?>
                 <tr>
                    <td><?echo $row['USERGROUP_CODE'];?></td> 
                    <td><?echo $row['USERGROUP_NAME'];?></td>
                    <td><?echo $row['USERGROUP_REMARK'];?></td>
                    <td><?echo $row['USERGROUP_URL'];?></td>
                    <td><a href='edit_group.php?id=<?=$row['USERGROUP_ID'];?>'><img src="images/Modify.png" width="24" height="24"></td>
                    <td><a href='delinfo.php?id=<?=$row['USERGROUP_ID'];?>'> <img src="images/Delete.png" width="24" height="24"></a></td>
                </tr>                               
				<?php } ?>

			<?php 
			// count the no. of entries
				$q = "SELECT * FROM usergroup;";
				$result = $mysqli->query($q);
				if(!$result) {
					echo "Query failed. Error: ".$mysqli->error;
				}
				else {
					$count = $result->num_rows;
					echo "<tr><td colspan='100%' style='text-align: right;'>Total $count records</td></tr>";
				}
			?>
            </table>	
				
		</div> <!-- end div_content -->
		
	</div> <!-- end div_main -->
	
	<div id="div_footer">  
		
	</div>

</div>
</body>
</html>


