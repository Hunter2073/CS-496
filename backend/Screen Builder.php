<html>
<link rel="stylesheet" href="../css/SceneBuilder.css">
<script src="ScreenBuilder.js"></script>
<?php
	//include 'Screen Builder Back End.php';
?>
	
<!--so need to make a call to the database, or file system to find out how many projects there are to generate...
how many bullet points are needed-->
	<body> 
		<div class="dropdown" id="dpDIV">
			<button class="dropbtn">Scenes</button>
			<div class="dropdown-content">
				<button class="dpDown" id="Save Scene">Save Scene</button><br>
				<button class="dpDown" id="Create New Scene">Create New Scene</button><br>
				<button class="dpDown" id="Delete Scene">Delete Scene</button><br>
				<form action="pic upload.php" method="post" enctype="multipart/form-data">
					Please select an image to upload
					<input type="file" name="fileToUpload"id="fileToUpload"><br>
					<input type="submit" value="Upload Image" name="submit"><br>
				</form>
				<button class="dpDown" id="Change Background">Update Background Image</button><br>
				<button class="dpDown" id="Text Options">Text Options</button>
				<button class="dpDown" id="Change Scene">Change Scene</button>
				<button class="dpDown" id="Link Scene">Link Scene</button>
			</div>
		</div>
		<div class="main" id="option">
		<button id="target">This is target</button>
		<p id="demo"></p>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<form class="option">
				<input type="text" id="one" name="option one" placeholder="First Response" required ><br>
				<input type="text" id="two" name="option two" placeholder="Second Response" required><br>
				<input type="text" id="three" name="option three" placeholder="Third Response"><br>
				<input type="text" id="four" name="option four" placeholder="Fourth Response"><br>
			</form>
		</div>
	</body>
</html>