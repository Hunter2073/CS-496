var isSaved=true;
window.onload = function(){
	if (document.getElementById("option") != null){
		
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
			if (isSaved)[
				save();
				clearCurrentState();
				isSaved=false;
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
	if (document.getElementById("Change Background Image") !=null){
		document.getElementById("Change Background Image").addEventListener("click",function(){
			//Prompt use to upload a new picture
			//updates the info from the database
			//change the css of the current scene
		});
	}//end of Change Background image if statement
	
}

//function passes information off to the database to be saved (update)
function save(){
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

//clearCurrentState sets all form values to blanks
function clearCurrentState(){
	var option1 = document.getElementsByName("option one").value ="";
	var option2 = document.getElementsByName("option two").value ="";
	var option3 = document.getElementsByName("option three").value ="";
	var option4 = document.getElementsByName("option four").value ="";
	var path = document.getElementById("main").style.backgroundImage ="";
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


