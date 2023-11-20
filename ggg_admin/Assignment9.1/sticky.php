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
			if (isset($_POST["submit"])) {
			// echo out the title from POST		
			echo $_POST["title"];
			// open a file named "Sticky_note.txt"
			$file = fopen("Sticky_note.txt", "a");
			// write the title in the text file
			fwrite($file, $_POST['title'] . "\n"); // Append a newline after the title
			// close the text file
			fclose($file);
			}
			?>
		</div>
		<div class="note">
			<?php
			// only execute after submit (check if submit is set in $_POST)
			if (isset($_POST["submit"])) {
			// echo out the note from POST
			echo $_POST["note"];
			// write the note in the text file
			$file = fopen("Sticky_note.txt", "a");
			fwrite($file, $_POST['note']."\n"); //using <br /> is more relevent to web browser
			// close the text file
			fclose($file);
			}
			?>
		</div>
		<div class="notefoot">
			<?php
			// only execute after submit (check if submit is set in $_POST)
			if (isset($_POST["submit"])) {
				// Open the file to count totla number of notes
				$file = fopen("Sticky_note.txt", "r");
				// count how many notes, output: "__ notes have been made"
				if ($file) {
					$count = 0; //init
		
					// Loop through each line and increment the count
					while (!feof($file)) {
						$line = fgets($file); //get one line and increment pointer to the next line.
						if ($line !== false) { //whether fget successfully read a line but does not consider whther the line is empty or not
							$count++;
						}
				}
				echo $count." notes have been made";
				fclose($file);
				}
			}
			?>
		</div>
	</div>
</body>

</html>

<!-- 
$file = fopen("example.txt", "r");

if ($file) {
    while (!feof($file)) {
        $line = fgets($file);
        if ($line !== false) {
            // Process the line
            echo $line;
        }
    }
    fclose($file);
} else {
    echo "Error opening the file.";
} 
-->
<!--  fgets is used to read one line of text from the file during each iteration of the loop. It reads a line, increments the file pointer to the next line, and repeats until the end of the file is reached. This allows you to process the content of the file line by line, which is particularly useful when you want to count the number of lines or perform actions on each line individually. -->
<!-- In this example, the loop continues to read lines from the file until feof returns true, indicating that the end of the file has been reached. This way, you can process the entire file without knowing its length in advance. -->
<!-- feof is used to determine if the file pointer has reached the end of the file. It returns true if the pointer is at the end of the file and false if it's not. -->



