    //////////Variables///////////////////////////////////////////

//Stores the form and its textboxes
var contact = document.contact; //Whole form
var subject = document.contact.subject; //subject
var emailTxtBox = document.contact.email; //Email
var message = document.contact.message; //Message

//Sets the valid text inputs	

var regexEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

//Sets where to refresh
var refreshTo = "contact.php";

//////////Prevent and enable form submission///////////////////

//Prevents form submission
function preventSubmit() {
	contact.setAttribute("action", "");
	contact.setAttribute("onsubmit", "return false;");
}

//Enables form submission
function enableSubmit() {
	contact.setAttribute("action", refreshTo);
	contact.setAttribute("onsubmit", "return true;");
}

//Displays loading message whn email is sending
function loadMssg(){

	if (document.readyState !== "loading") {
		document.getElementById("sendMssg").innerHTML="Sending...";
		} else{
		document.getElementById("sendMssg").style.visibility="hidden";
		}

	if (document.getElementById("sent")) {
		document.getElementById("sent").remove();
	}
}

//////////Checks for errors upon submission///////////////////
function submitForm () {
	if (regexEmail.test(emailTxtBox.value) && subject.value !="" && message.value !="") {
		loadMssg();
		enableSubmit();
	
	} else if (!regexEmail.test(emailTxtBox.value)){
		alert("Please enter a valid email address.");
		emailTxtBox.focus();
		emailTxtBox.select();
		preventSubmit();
	} else if (subject.value ==""){
		alert("Please enter a subject.");
		subject.focus();
		subject.select();
		preventSubmit();
	}else if (message.value ==""){
		alert("Please enter a message.");
		message.focus();
		message.select();
		preventSubmit();
	}
}


