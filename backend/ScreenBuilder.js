/*
eat my ass
*/
var isSaved=true;
var currentProj =1;
var currentScene;
window.onload = function(){
	if (document.getElementById("option") != null){
	initialize();	
	}//end of if
	/* if (document.getElementById("Save Scene") !=null){
		document.getElementById("Save Scene").addEventListener("click",function(){
			//save scene sends current information to database
			save();
			isSaved=true;
		});
	}//end of Save Scene if statement
	if (document.getElementById("Create New Scene") !=null){
		document.getElementById("Create New Scene").addEventListener("click",function(){
			//Create new sends current information to database
			//Also needs to clear all current fields
			if (isSaved){
				save();
				clearCurrentState();
				isSaved=false;
				createNewScene();
			}
			else{
				firstSave();
				clearCurrentState();
			}
		});
	}//end of Create New Scene if statement
	if (document.getElementById("Delete Scene") !=null){
		document.getElementById("Delete Scene").addEventListener("click",function(){
			//Delete Scene prompts the user to make sure they want to delete everything
			//removes the info from the database
			//Also needs to clear all current fields
			if (confirm('Are you sure you want to delete the scene?')) {
				isSaved=false;
				clearCurrentState();
			}//end of confirm if
		});
	}//end of delete scene if statement
	if (document.getElementById("Change Background") !=null){
		document.getElementById("Change Background").addEventListener("click",function(){
			
			//user should have uploaded a picture, ask them what they want the background to be
			//updates the info from the database
			//change the css of the current scene
			var target = prompt ("Choose an image to be the backgound image","sample.jpg");
			if (target.indexOf(".")==-1){
				alert("Please select a file with a file extension");
			}//end of if statement
			if (target.indexOf("<")!=-1||target.indexOf("<")!=-1||target.indexOf("$")!=-1){
				alert("Please do not use special characters");
				target="";
			}//end of if statement
			target = target.trim();
			if (target !=""){
				var endTarget = "../images/" + target;
				document.getElementById("option").style.backgroundImage(endTarget);
			}
		});
	}//end of Change Background image if statement
	if (document.getElementById("Change Scene") !=null){
		document.getElementById("Change Scene").addEventListener("click",function(){
			//saves current scene state
			//gives the user a list of scenes and allows them to choose a scene
			//load chosen scene
			//requests the information from the database and populates all the fields
			if(confirm("Would you like to save your current progress?")){
				save();
			}
			sceneSelect();
			//var targetScene = sceneSelect();
			//alert(targetScene);
			//load(targetScene);
		});
	}//end of Change Scene if statement
	if (document.getElementById("Link Scene") !=null){
		document.getElementById("Link Scene").addEventListener("click",function(){
			//saves current scene state
			//gives the user a list of scenes and allows them to choose a scene
			//asks user which option links to that scene
			//sets the nextScene option for the indicated option in the database (UPDATE)
			
		});
	}//end of Link Scene if statement */
}//end of onLoad function
//function called when users click to save
function saveButton(){
	//should test if the user is saving a new scene and if so, they need to enter a scene title
	//maybe call first save
	if(isSaved){
		save();
	}
	else{
		firstSave();
		isSaved=true;
	}
}
//function called when users create a new scene. simply clears screen
function createButton(){
	//Also needs to clear all current fields
	if(confirm("Would you like to save your current progress?")){
		save();
	}
	if (isSaved){
		clearCurrentState();
		isSaved=false;
		//createNewScene();
	}
	else{
		firstSave();
		clearCurrentState();
	}
}

//need to remove scene from database
function deleteButton(){
	//Delete Scene prompts the user to make sure they want to delete everything
	//removes the info from the database
	//Also needs to clear all current fields
	if (confirm('Are you sure you want to delete the scene?')) {
		var obj = currentScene;
		isSaved=false;
		clearCurrentState();
		obj =JSON.stringify(obj);
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST", "delete.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("x=" +obj);
		currentScene=null;
	}//end of confirm if
	else{
		alert("Nothing has been deleted");
	}
}
//prompts the user for a background image and changes the current background image
function changeBIButton(){
	//user should have uploaded a picture, ask them what they want the background to be
	//updates the info from the database
	//change the css of the current scene
	var target = prompt ("Choose an image to be the backgound image","sample.jpg");
	if (target.indexOf(".")==-1){
		alert("Please select a file with a file extension");
	}//end of if statement
	if (target.indexOf("<")!=-1||target.indexOf("<")!=-1||target.indexOf("$")!=-1){
		alert("Please do not use special characters");
		target="";
	}//end of if statement
	target = target.trim();
	if (target !=""){
		var endTarget = 'url("../images/' + target+'")';
		document.getElementById("option").style.backgroundImage = endTarget;
	}
}
//function calls the sceneChangeGo function and asks users to save
function changeScene(){
	//alert("We made it");
	if(confirm("Would you like to save your current progress?")){
		save();
	}
	sceneSelectGo();
}
//function called to initiate the linking of scenes
function linkScene(id){
	//saves current scene state
	//gives the user a list of scenes and allows them to choose a scene
	//asks user which option links to that scene
	//sets the nextScene option for the indicated option in the database (UPDATE)
	var opt = prompt("Which option number would you like to link a scene to?","Numbers from 1,2,3,4");
	opt = opt + ":"+id.toString()+":"+currentScene.toString();
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//document.getElementById("demo").innerHTML = this.responseText;
			alert(this.responseText);
		}
	};
	xmlhttp.open("POST", "linkScene.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +opt);
}

//initialize loads the first scene of the selected project
//project is selected before reaching the page. passed through sessions (hopefully)
function initialize(){
	//calls to find the current project, return the firstScene field
	//call load(firstScene);
	var proj = currentProj;
	var sceneID;
	var obj = "{" + proj+"}";
	var obj =JSON.stringify(obj);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var num =[0,1,2,3,4,5,6,7,8,9];
			sceneID = this.responseText;
			for (var i=0;i<num.length;i++){
				if (sceneID.indexOf(i)!=-1){
					var target = sceneID.indexOf(i);
					if (sceneID.indexOf(target+1)!=-1);{
						var target2 = sceneID.indexOf(i+1);
						if (sceneID.charAt(target)!=sceneID.charAt(target2)){
							sceneID = sceneID.charAt(target)+sceneID.charAt(target2);
						}
					}
				}
			}
			//alert(sceneID);
			load(sceneID);
			currentScene = sceneID;
			
		}
	};
	xmlhttp.open("POST", "firstScene.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
}//end of initialize

//function displays all scenes of in the current project to the user and returns the selected option
function sceneSelectGo (){
	//var ID;
	//clear current page to show all scenes
	var chunk =document.getElementById("chunk");
	while (chunk.firstChild) {
		chunk.removeChild(chunk.firstChild);
	}
	//now page is clear, get all scenes from database
	var obj = "{"+currentProj +"}";
	var obj =JSON.stringify(obj);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//this is raw output from PHP 
			var preFull = this.responseText;
			//alert(preFull);
			//make a JSON object array
			var sso = JSON.parse(preFull);
			//access like this
			// var sceneOneId = sso[0].sceneID;

			var theForm = document.createElement("form");
			theForm.setAttribute('name',"Scene Select");
			theForm.setAttribute('id','New Form');
			//created a form a object
			var order=0;
			for (var i=0;i<sso.length;i++){
				//create a form and append the SQL queries
				order+=1;
				var theInput = document.createElement("input");
				theInput.setAttribute('type','radio');
				theInput.setAttribute('name','scene');
				theInput.setAttribute('value',sso[i].sceneID);
				var textVal = document.createTextNode(order + " " + sso[i].SceneTitle);
				var para = document.createElement("p");
				para.appendChild(textVal);
				theForm.appendChild(theInput);
				theForm.appendChild(para);
			}
			var but = document.createElement("input");
			but.setAttribute("type","button");
			//but.setAttribute("name","scene");
			but.setAttribute("onclick","GetUserSceneSelection()");
			but.innerHTML="Submit";
			theForm.appendChild(but);
			document.getElementById("chunk").appendChild(theForm);
			
		};
	}
	xmlhttp.open("POST", "sceneSelect.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
	//return ID;
}//end of sceneSelect

//getUserSceneSelection is for the sceneSelect prompt
function GetUserSceneSelection(){
	
	//var userSelection = ("input[name='scene']:checked'").value;
	var userSelect = document.getElementById("New Form").querySelector('input[name="scene"]:checked').value;
	//clear current page to show all scenes
	var chunk =document.getElementById("chunk");
	while (chunk.firstChild) {
		chunk.removeChild(chunk.firstChild);
	}
	reBuild();
	//alert(userSelect);
	//BuildScreenBuilderHTMLObjects()
	load(userSelect);
	
}//end of NewFUn

//alternate to sceneSelectGo, but does not go to the scene user's select at the end
function sceneSelectNoGo(){
	var chunk =document.getElementById("chunk");
	while (chunk.firstChild) {
		chunk.removeChild(chunk.firstChild);
	}
	//now page is clear, get all scenes from database
	var obj = "{"+currentProj +"}";
	var obj =JSON.stringify(obj);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//this is raw output from PHP 
			var preFull = this.responseText;
			//alert(preFull);
			//make a JSON object array
			var sso = JSON.parse(preFull);
			//access like this
			// var sceneOneId = sso[0].sceneID;

			var theForm = document.createElement("form");
			theForm.setAttribute('name',"Scene Select");
			theForm.setAttribute('id','New Form');
			//created a form a object
			var order=0;
			for (var i=0;i<sso.length;i++){
				//create a form and append the SQL queries
				order+=1;
				var theInput = document.createElement("input");
				theInput.setAttribute('type','radio');
				theInput.setAttribute('name','scene');
				theInput.setAttribute('value',sso[i].sceneID);
				var textVal = document.createTextNode(order + " " + sso[i].SceneTitle);
				var para = document.createElement("p");
				para.appendChild(textVal);
				theForm.appendChild(theInput);
				theForm.appendChild(para);
			}
			var but = document.createElement("input");
			but.setAttribute("type","button");
			//but.setAttribute("name","scene");
			but.setAttribute("onclick","subSceneLink()");
			but.innerHTML="Submit";
			theForm.appendChild(but);
			document.getElementById("chunk").appendChild(theForm);
			
		};
	}
	xmlhttp.open("POST", "sceneSelect.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
	//return ID;
}//end of sceneSelect
//sub function to sceneSelectNoGo
function subSceneLink(){
	var userSelect = document.getElementById("New Form").querySelector('input[name="scene"]:checked').value;
	//clear current page to show all scenes
	var chunk =document.getElementById("chunk");
	while (chunk.firstChild) {
		chunk.removeChild(chunk.firstChild);
	}
	reBuild();
	load(currentScene);
	linkScene(userSelect);
}


//function rebuilds the initial html layout of Screen Builder.php
//must still have Body id='chunk' and nothing in that body
function reBuild(){
	var chunk = document.getElementById("chunk");
	var dpDIV = document.createElement("div");
	dpDIV.setAttribute('class','dropdown');
	dpDIV.setAttribute('id','dpDIV');
	
	var Scenes = document.createElement("button");
	Scenes.setAttribute('class','dropbtn');
	Scenes.innerHTML="Scenes";
	
	var dpDIVChild = document.createElement("div");
	dpDIVChild.setAttribute('class','dropdown-content');
	
	var SaveScene = document.createElement("button");
	SaveScene.setAttribute('class','dpDown');
	SaveScene.setAttribute('id','SaveScene');
	SaveScene.setAttribute('onclick','saveButton()');
	SaveScene.innerHTML="Save Scene";
	
	var CreateNewScene = document.createElement("button");
	CreateNewScene.setAttribute('class','dpDown');
	CreateNewScene.setAttribute('id','Create New Scene');
	CreateNewScene.setAttribute('onclick','createButton()');
	CreateNewScene.innerHTML="Create New Scene";
	
	var DeleteScene = document.createElement("button");
	DeleteScene.setAttribute('class','dpDown');
	DeleteScene.setAttribute('id','Delete Scene');
	DeleteScene.setAttribute('onclick','deleteButton()');
	DeleteScene.innerHTML="Delete Scene";
	
	var picForm = document.createElement("form");
	picForm.setAttribute('action','pic upload.php');
	picForm.setAttribute('method','post');
	picForm.setAttribute('enctype','multipart/form-data');
	picForm.innerHTML="Please select an image to upload";
	
	var fileSelect = document.createElement("input");
	fileSelect.setAttribute('type','file');
	fileSelect.setAttribute('name','fileToUpload');
	fileSelect.setAttribute('id','fileToUpload');
	
	var fileSubmit = document.createElement("input");
	fileSubmit.setAttribute('type','submit');
	fileSubmit.setAttribute('value','Upload Image');
	fileSubmit.setAttribute('name','submit');
	
	var ChangeBackground = document.createElement("button");
	ChangeBackground.setAttribute('class','dpDown');
	ChangeBackground.setAttribute('id','Change Background');
	ChangeBackground.setAttribute('onclick','changeBIButton()');
	ChangeBackground.innerHTML="Update Background Image";
	
	var ChangeScene = document.createElement("button");
	ChangeScene.setAttribute('class','dpDown');
	ChangeScene.setAttribute('id','Change Scene');
	ChangeScene.setAttribute('onclick','changeScene()');
	ChangeScene.innerHTML="Change Scene";
	
	var LinkScene = document.createElement("button");
	LinkScene.setAttribute('class','dpDown');
	LinkScene.setAttribute('id','Link Scene');
	LinkScene.setAttribute('onclick','sceneSelectNoGo();');
	LinkScene.innerHTML="Link Scene";
	
	picForm.appendChild(fileSelect);
	picForm.appendChild(fileSubmit);
	dpDIVChild.appendChild(SaveScene);
	dpDIVChild.appendChild(CreateNewScene);
	dpDIVChild.appendChild(DeleteScene);
	dpDIVChild.appendChild(picForm);
	dpDIVChild.appendChild(ChangeBackground);
	dpDIVChild.appendChild(ChangeScene);
	dpDIVChild.appendChild(LinkScene);
	dpDIV.appendChild(Scenes);
	dpDIV.appendChild(dpDIVChild);
	chunk.appendChild(dpDIV);
	//above this is all of the dropdown menu stuff
	//below is the rest of the document
	
	var optionDiv = document.createElement("div");
	optionDiv.setAttribute('class','main');
	optionDiv.setAttribute('id','option');
	/* var target = document.createElement("button");
	target.setAttribute('id','target');
	target.innerHTML="This is target"; */
	var para = document.createElement("p");
	para.setAttribute('id','demo');
	var desc = document.createElement("textarea");
	desc.setAttribute('rows','4');
	desc.setAttribute('cols','50');
	desc.setAttribute('id','description');
	desc.setAttribute('placeholder','Enter the scene description here');
	var optionForm = document.createElement("form");
	optionForm.setAttribute('class','option');
	var opt1 = document.createElement("input");
	opt1.setAttribute('type','text');
	opt1.setAttribute('id','one');
	opt1.setAttribute('name','option one');
	opt1.setAttribute('placeholder','First Response');
	opt1.required=true;
	var opt2 = document.createElement("input");
	opt2.setAttribute('type','text');
	opt2.setAttribute('id','two');
	opt2.setAttribute('name','option two');
	opt2.setAttribute('placeholder','Second Response');
	opt2.required=true;
	var opt3 = document.createElement("input");
	opt3.setAttribute('type','text');
	opt3.setAttribute('id','three');
	opt3.setAttribute('name','option three');
	opt3.setAttribute('placeholder','Third Response');
	var opt4 = document.createElement("input");
	opt4.setAttribute('type','text');
	opt4.setAttribute('id','four');
	opt4.setAttribute('name','option four');
	opt4.setAttribute('placeholder','Fourth Response');
	
	optionForm.appendChild(opt1);
	optionForm.appendChild(opt2);
	optionForm.appendChild(opt3);
	optionForm.appendChild(opt4);
	
	//optionDiv.appendChild(target);
	optionDiv.appendChild(para);
	optionDiv.appendChild(desc);
	optionDiv.appendChild(optionForm);
	chunk.appendChild(optionDiv);
}

//function takes a sceneID and populates the all fields with the chosen scene
function load (ID){
	var fields = [];
	var proj = currentProj;
	var obj = "{" + proj +":" + ID+"}";
	var obj =JSON.stringify(obj);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//document.getElementById("demo").innerHTML = this.responseText;
			var preArray = this.responseText;
			//alert(preArray);
			//document.getElementById("demo").innerHTML =preArray;
			fields = preArray.split("+");
			fields.shift();
			for (var i=0;i<fields.length;i++){
				fields[i] = fields[i].replace(/[\\]/g, "");
			}
			var len = fields.length;
			
			switch (len){
				case 2:
					document.getElementById("one").value = fields[0];
					document.getElementById("two").value = fields[1];
					break;
				case 3:
					document.getElementById("one").value = fields[0];
					document.getElementById("two").value = fields[1];
					if (fields[2].search("../images/")!=-1){
						document.getElementById("option").style.backgroundImage = "url("+fields[2]+")";
					}
					else if (fields[2].search(":")!=-1){
						document.getElementById("description").value = fields[2];
					}
					else{
						document.getElementById("three").value = fields[2];
					}
					break;
				case 4:
					document.getElementById("one").value = fields[0];
					document.getElementById("two").value = fields[1];
					//find what fields[2] is
					if (fields[2].search("../images/")!=-1){
						document.getElementById("option").style.backgroundImage = "url("+fields[2].toString()+")";
					}
					else if (fields[2].search(":")!=-1){
						document.getElementById("description").value = fields[2];
					}
					else{
						document.getElementById("three").value = fields[2];
					}//end of fields[2]
					//find out what fields[3] is
					if (fields[3].search("../images/")!=-1){
						document.getElementById("option").style.backgroundImage = "url("+fields[3].toString()+")";
						alert(fields[3]);
					}
					else if (fields[3].search(":")==-1){
						document.getElementById("description").value = fields[3];
					}
					else{
						document.getElementById("four").value = fields[3];
					}
					break;
				case 5:
					document.getElementById("one").value = fields[0];
					document.getElementById("two").value = fields[1];
					document.getElementById("three").value = fields[2];
					//find what fields[3] is
					if (fields[3].search("../images/")!=-1){
						var temp = "url("+fields[3].toString()+")";
						document.getElementById("option").style.backgroundImage = temp;
					}
					else if (fields[3].search(":")!=-1){
						document.getElementById("description").value = fields[3];
					}
					else{
						document.getElementById("four").value = fields[3];
					}//end of fields[3]
					//find out what fields[4] is
					if (fields[4].search("../images/")!=-1){
						document.getElementById("option").style.backgroundImage = "url("+fields[4].toString()+")";
						
					}
					else if (fields[4].search(":")==-1){
						document.getElementById("description").value = fields[4];
					}
					else{
						document.getElementById("four").value = fields[4];
					}//end of fields[4]
					break;
				case 6:
					document.getElementById("one").value = fields[0];
					document.getElementById("two").value = fields[1];
					document.getElementById("three").value = fields[2];
					document.getElementById("four").value = fields[3];
					document.getElementById("description").value = fields[4];
					fields[5] = '"'+fields[5];
					document.getElementById("option").style.backgroundImage ="url("+fields[5].toString()+")";
					//document.getElementById("option").style.height="10px";
					break;
				default:
					alert("Something went wrong");
			}//end of switch
		}
	};
	xmlhttp.open("POST", "loadScene.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
	currentScene=ID;
}//end of load

//function passes information off to the database to be saved (update)
function save(){
	var option1 = document.getElementById("one").value;
	var option2 = document.getElementById("two").value;
	var option3 = document.getElementById("three").value;
	var option4 = document.getElementById("four").value;
	var description = document.getElementById("description").value;
	var path = document.getElementById("option").style.backgroundImage;		
	if (option3!=""&&option4!=""&&description!=""&&path!=""){
		var obj = "{"+currentScene +";" +option1+";"+option2+";"+option3+ ";"+option4+ ";"+description + ";" +path+"}";
	}//everything is present
	else if (option3!=""&&option4!=""&&description!=""&&path==""){
		var obj = "{"+currentScene +";" +option1+";"+option2+";"+option3+ ";"+option4+ ";"+description +"}";
	}//everything but background Image is present
	else if(option3!=""&&option4!=""&&description==""&&path!=""){
		var obj = "{"+currentScene +";" +option1+";"+option2+";"+option3+ ";"+option4+  ";" +path+"}";
	}//everything but the description is present
	else if(option3!=""&&option4==""&&description!=""&&path!=""){
		var obj = "{"+currentScene +";" +option1+";"+option2+";"+option3+ ";"+description + ";" +path+"}";
	}//everything but option 4 is present
	else if (option3==""&&option4==""&&description!=""&&path!=""){
		var obj = "{"+currentScene +";" +option1+";"+option2+";"+description + ";" +path+"}";
	}//option 3 & 4 are missing
	else if (option3!=""&&option4!=""&&description==""&&path==""){
		var obj = "{"+currentScene +";" +option1+";"+option2+";"+option3+ ";"+option4+ "}";
	}//background image and description is missing
	else if (option3==""&&option4==""&&description==""&&path==""){
		var obj = "{"+currentScene +";" +option1+";"+option2+"}";
	}//everything is absent
	else{
		alert("Something went wrong with saving");
	}//something went wrong obviously
	//alert (obj);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if(this.responseText==""){
				alert("Save was successful");
			}
			else{
				alert("Save was not successful");
			}
		}
	};
	xmlhttp.open("POST", "save.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
}//end of save function

//first save is exactly the same as save, but instead of updating infor in the database
//this function inserts new data to the database
function firstSave(){
	var option1 = document.getElementById("one").value;
	var option2 = document.getElementById("two").value;
	var option3 = document.getElementById("three").value;
	var option4 = document.getElementById("four").value;
	var desc = document.getElementById("description").value;
	var path = document.getElementById("option").style.backgroundImage;
	var name = prompt("What would you like to name your scene?","Scene Name Here");
					
	var obj = "{"+currentProj+":"+name+":"+option1+":"+option2+ ":"+option3+ ":"+option4+":"+desc+":"+path+"}";
	var obj =JSON.stringify(obj);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			currentScene =this.responseText;
			//alert(this.responseText);
		}
	};
	xmlhttp.open("POST", "firstSave.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
}

//function creates a scene on the scene table with the projectID and sets current sceneID
//i think this won't be used
function createNewScene(){
	
/* 	var obj = "{"+option1.toString()+":"+option2.toString()+":"+
	option3.toString()+ ":"+option4.toString()+ ":"+path.toString()+"}";
	var obj =JSON.stringify(obj); */
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("demo").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("POST", "screenBuilderBackEnd.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
}//end of createNewScene

//clearCurrentState sets all form values to blanks
function clearCurrentState(){
	document.getElementById("one").value ="";
	document.getElementById("two").value ="";
	document.getElementById("three").value ="";
	document.getElementById("four").value ="";
	document.getElementById("description").value="";
	document.getElementById("option").style.backgroundImage ="url(../images/white.png)";
}
