window.onload = function(){
	if (document.getElementById("option") != null){
		//createScene();
		
		
	}//end of if
	if (document.getElementById("dpDIV") !=null){
		if (document.getElementsByClassName("dpDown") >0){
			var dropOptions = document.getElementsByClassName("dpDown");
			
		}//end of if statement
	}//end of dpDIV if statement
	
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
//saveScene needs to grab backgroundImage and all text options and pass them to the database...
//without changing the current page
function saveScene(){
	//saveScene code here
}//end of saveScene

//deleteScene code should clean the current page of all BI and text options, maybe alert?
function deleteScene(){
	//deleteScene code here
}//end of deleteScene

//cahngeBI should have a message box pop up an dprompt user to upload a new image..
//then take that image and set it to (id=option div background)
function changeBI(){
	//changeBI code here
}//end of changeBI

//text option should present some basic font options (like font size, bold, etc
function textOption(){
	//textOption code here
}//end of textOption


