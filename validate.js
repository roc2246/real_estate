//Stores the form and its textboxes
const contact = document.contact; //Whole form

const emailTxtBox = document.contact.email; //Email
const subject = document.contact.subject; //subject
const message = document.contact.message; //Message


//Sets the valid text inputs	
const regexEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
const regexSub = /^(?!\s*$).+/;
const regexMssg = /^(?!\s*$).+/;

/////////////////Sets up the arrays with regex and textfields
var inputs = [];
inputs.push(emailTxtBox, subject, message);

var regex = [];
regex.push(regexEmail, regexSub, regexMssg);

//Prevents form submission
function preventSubmit(form) {
	form.setAttribute("action", "");
	form.setAttribute("onsubmit", "return false;");
}

//Enables form submission
function enableSubmit(form, refreshTo) {
	form.setAttribute("action", refreshTo);
	form.setAttribute("onsubmit", "return true;");
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
function submitForm (form) {
		for(let i = 0; i<inputs.length; i++){
			if(regex[i].test(inputs[i].value)){
				if(regex[i] = regexEmail && regex[inputs.length-1].test(inputs[inputs.length-1].value)){
				  loadMssg();
				}
				enableSubmit(form, "contact.php");
			}else if (!regex[i].test(inputs[i].value)){
				alert("Please fill out a valid " + inputs[i].getAttribute("name") + ".");
				inputs[i].focus();
				inputs[i].select();
				preventSubmit(form);
			}
		
		}
	}




