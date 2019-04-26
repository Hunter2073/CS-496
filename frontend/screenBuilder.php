<html>
<link rel="stylesheet" href="../css/sceneBuilder.css">
<script src="../backend/ScreenBuilder.js"></script>
	<body id="chunk">
		<div class="dropdown" id="dpDIV">
			<button class="dropbtn">Scene Options</button>
			<div class="dropdown-content">
				<button class="dpDown" id="Save Scene" onclick="saveButton()">Save Scene</button><br>
				<button class="dpDown" id="Create New Scene" onclick="createButton()">Create New Scene</button><br>
				<button class="dpDown" id="Delete Scene" onclick="deleteButton()">Delete Scene</button><br>
				<form action="picUpload.php" method="post" enctype="multipart/form-data">
					Please select an image to upload
					<input type="file" name="fileToUpload"id="fileToUpload"><br>
					<input type="submit" value="Upload Image" name="submit"><br>
				</form>
				<button class="dpDown" id="Change Background" onclick="changeBIButton()">Update Background Image</button><br>
				<button class="dpDown" id="Change Scene" onclick="changeScene()">Change Scene</button>
				<button class="dpDown" id="Link Scene" onclick="sceneSelectNoGo()">Link Scene</button>
			</div>
		</div>
		<div class="main" id="option">
		<!--<button id="target">This is target</button>-->
		<p id="demo"></p>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<textarea rows="4" cols="50" id="description" placeholder="Enter the scene description here"></textarea>
			<form class="option">
				<input type="text" id="one" name="option one" placeholder="First Response" required ><br>
				<input type="text" id="two" name="option two" placeholder="Second Response" required><br>
				<input type="text" id="three" name="option three" placeholder="Third Response"><br>
				<input type="text" id="four" name="option four" placeholder="Fourth Response"><br>
			</form>
		</div>
	</body>
</html>
