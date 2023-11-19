<!DOCTYPE html>


<html>
<head>
<link rel="stylesheet" type="text/css" href="sticky.css">
</head>

<body>
	<form action="<?= $_SERVER["PHP_SELF"]?>" method="POST">
		<b>Title</b>: <input type="text" name="title" id="title" size="30" > <br><br>
		<b>Note</b>: <textarea name="note" cols="30" rows="5" ></textarea> <br>
		<input type="submit" value="Post!" name="submit" >
	</form>
	<hr>
	<!-- Put Display Content here -->
	<div class="post">
		<div class="title">
			<?php
				// only execute after submit (check if submit is set in $_POST)
				// echo out the title from POST
				// open a file named "Sticky_note.txt"
				// write the title in the text file
				// close the text file
					if(isset($_POST["submit"])){
						$title = $_POST["title"];
						$file = fopen("sticky_note.txt", "a");
						echo $title;
						fwrite($file, "$title\n");
						fclose($file);
					}
			?>
		</div>
		<div class="note">
			<?php
			// only execute after submit (check if submit is set in $_POST)
			// echo out the note from POST
			// write the note in the text file
			// close the text file
				if(isset($_POST["submit"])){
					$note = $_POST["note"];
					$file = fopen("sticky_note.txt", "a");
					echo $note;
					fwrite($file, "$note\n");
					fclose($file);
				}
			?>
		</div>
		<div class="notefoot">
			<?php
			// only execute after submit (check if submit is set in $_POST)
			// Open the file to count totla number of notes
			// count how many notes, output: "__ notes have been made"
				if(isset($_POST["submit"])){
					$file = fopen("sticky_note.txt", "r");
					$count = 0;
					while(!feof($file)){
						$count++;
						fgets($file);
						fgets($file);
					}
					echo $count," notes have been made";
				}
			?>
		</div>
	</div>
</body>

</html>