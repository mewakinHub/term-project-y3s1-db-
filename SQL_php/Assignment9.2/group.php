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
					// Retrieve the form data
					$groupcode = $_POST['groupcode'];
					$groupname = $_POST['groupname'];
					$remark = $_POST['remark'];
					$url = $_POST['url'];
					$insert = array(
						$groupcode, $groupname, $remark, $url
					);

					// insert data
					$query = "INSERT INTO USERGROUP (USERGROUP_CODE, USERGROUP_NAME, USERGROUP_REMARK, USERGROUP_URL) 
					VALUES ('$insert[0]', '$insert[1]', '$insert[2]', '$insert[3]')";

					if (!$mysqli->query($query)) {
						echo "INSERT failed. Error: " .$mysqli->error;
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
					$result=$mysqli->query($q); //whole table(i.e. show tables)
					if(!$result){
						echo "Select failed. Error: ".$mysqli->error ;
						return false;
					}
				while($row=$result->fetch_array()){ ?> 
                <tr>
                    <td><?php echo $row['USERGROUP_CODE'];?></td> 
                    <td><?php echo $row['USERGROUP_NAME']; ?></td>
                    <td><?php echo $row['USERGROUP_REMARK']; ?></td>
                    <td><?php echo $row['USERGROUP_URL']; ?></td>
                    <td><a href='edit_group.php?id=<?php echo $row['USERGROUP_ID'];?>'><img src="images/Modify.png" width="24" height="24"></a></td>
                    <td><a href='delinfo.php?id=<?php echo $row['USERGROUP_ID'];?>'> <img src="images/Delete.png" width="24" height="24"></a></td>
                </tr>                               
				<?php } ?>

			<?php
			// count the no. of entries
				$count_query = "SELECT * FROM USERGROUP";
				$count_result = $mysqli->query($count_query);
				if ($count_result) {
					$countrow = $count_result->num_rows;
					echo "<tr><td colspan='6' style='text-align: right;'> Total " . $countrow. " records </td></tr>";
				} else {
					echo "Query fialed: " . $mysqli->error;
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

<!-- The require() function copies all of the text from a given file into the file that uses the include function. -->
<!-- To summarize, the primary difference is the error handling behavior:

- include allows the script to continue running even if the included file has issues (generates a warning).
- require stops the script's execution if the included file is not found or has errors (generates a fatal error).
Additionally, you can use _once variants (e.g., include_once and require_once) to ensure that a file is included only once in the script, which can be helpful in preventing redefinition of functions or re-inclusion of configuration files.
 -->

 <!-- The fetch_array method is used to fetch a row of data from a result set obtained from a MySQL database query and return it as an array. -->