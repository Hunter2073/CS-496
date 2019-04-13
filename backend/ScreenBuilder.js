var isSaved=true;
var currentProj =1;
var currentScene =1;
window.onload = function(){
	if (document.getElementById("option") != null){
	initialize();	
	}//end of if
	if (document.getElementById("Save Scene") !=null){
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
			
		});
	}//end of Change Scene if statement
	if (document.getElementById("Link Scene") !=null){
		document.getElementById("Link Scene").addEventListener("click",function(){
			//saves current scene state
			//gives the user a list of scenes and allows them to choose a scene
			//asks user which option links to that scene
			//sets the nextScene option for the indicated option in the database (UPDATE)
			
		});
	}//end of Link Scene if statement
}//end of onload function

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
			load(sceneID);
			currentScene = sceneID;
		}
	};
	xmlhttp.open("POST", "First Scene.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
}//end of initialize

//function displays all scenes of in the current project to the user and returns the selected option
function sceneSelect (){
	var ID =0;
	
	return ID;
}//end of sceneSelect

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
					if (fields[2].search("../images/")==-1){
						document.getElementById("three").value = fields[2];
					}
					else{
						document.getElementById("option").style.backgroundImage = fields[2];
					}
					break;
				case 4:
					document.getElementById("one").value = fields[0];
					document.getElementById("two").value = fields[1];
					document.getElementById("three").value = fields[2];
					if (fields[3].search("../images/")==-1){
						document.getElementById("four").value = fields[3];
					}
					else{
						document.getElementById("option").style.backgroundImage = fields[3];
					}
					break;
				case 5:
					document.getElementById("one").value = fields[0];
					document.getElementById("two").value = fields[1];
					document.getElementById("three").value = fields[2];
					document.getElementById("four").value = fields[3];
					document.getElementById("option").style.backgroundImage = fields[4];
					alert(fields[4]);//need to figure out why the BI is not changing
					break;
				default:
					alert("Something went wrong");
			}//end of switch
		}
	};
	xmlhttp.open("POST", "Load Scene.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
	currentScene=ID;
}//end of load


//function passes information off to the database to be saved (update)
function save(){
	var option1 = document.getElementsByName("option one").value;
	var option2 = document.getElementsByName("option two").value;
	var option3 = document.getElementsByName("option three").value;
	var option4 = document.getElementsByName("option four").value;
	var path = document.getElementById("main").style.backgroundImage;		
	var obj = "{"+currentScene +":" +option1.toString()+":"+option2.toString()+":"+
	option3.toString()+ ":"+option4.toString()+ ":"+path.toString()+"}";
	var obj =JSON.stringify(obj);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST", "save.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
}//end of save function

//first save is exactly the same as save, but instead of updating infor in the database
//this function inserts new data to the database
function firstSave(){
	var option1 = document.getElementsByName("option one").value;
	var option2 = document.getElementsByName("option two").value;
	var option3 = document.getElementsByName("option three").value;
	var option4 = document.getElementsByName("option four").value;
	var path = document.getElementById("main").style.backgroundImage;
					
	var obj = "{"+option1.toString()+":"+option2.toString()+":"+
	option3.toString()+ ":"+option4.toString()+ ":"+path.toString()+"}";
	var obj =JSON.stringify(obj);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("demo").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("POST", "Screen Builder Back End.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
}

//function creates a scene on the scene table with the projectID and sets current sceneID
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
	xmlhttp.open("POST", "Screen Builder Back End.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +obj);
}//end of createNewScene


//clearCurrentState sets all form values to blanks
function clearCurrentState(){
	var option1 = document.getElementsByName("option one").value ="";
	var option2 = document.getElementsByName("option two").value ="";
	var option3 = document.getElementsByName("option three").value ="";
	var option4 = document.getElementsByName("option four").value ="";
	var path = document.getElementById("main").style.backgroundImage ="";
}



//imageUpload prompts the user to select an image and stores it in the images directory
//unused -old idea
function imageUpload(){
	var x = document.getElementById("myfile");

	var prom = alert("Please select an image to upload" + x);
	
}

 

//createScene needs to call saveScene, and reset the current page (delete BI and clear options)
function createScene(){
	
	
	var divMain = document.getElementById("option");
	var para = document.createElement("p");
	var node = document.createTextNode("Hello World");
	para.appendChild(node);
	//divMain.appendChild(para);
	
	//divMain.style.backgroundImage("../images/alt.jpg");
	//divMain.style.backgroundImage = "url('../images/alt.jpg')";
	
	//alert("Test alert box");
}//end of createScene


//cahngeBI should have a message box pop up an dprompt user to upload a new image..
//then take that image and set it to (id=option div background)
function changeBI(){
	//changeBI code here
}//end of changeBI

//text option should present some basic font options (like font size, bold, etc
function textOption(){
	//textOption code here
}//end of textOption

/*
*******OLD CODE BELOW******
//createScene();
		document.getElementById("target").addEventListener("click",function (){
			//alert(string.toString());
			
			/* var obj = '{table:user}';//JSON object
			var obj =JSON.stringify(obj);
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("demo").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("POST", "Screen Builder Back End.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("x=" +obj); 
			});//end of event listener	
			
*/