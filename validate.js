/////////////////Sets up the arrays with regex and textfields
var inputs = [];
var regex = [];

if(window.location.pathname == "/real_estate/contact.php"){
  //Textboxes and regex for contact page
  const contact = document.contact; 
  const emailTxtBox = document.contact.email; 
  const subject = document.contact.subject;
  const message = document.contact.message; 

  const regexEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  const regexSub = /^(?!\s*$).+/;
  const regexMssg = /^(?!\s*$).+/;

  inputs.push(emailTxtBox, subject, message);
  regex.push(regexEmail, regexSub, regexMssg);
} else if(window.location.pathname == "/real_estate/newProperty.php"){
  //Textboxes and regex for managing available properties
  const uploads = document.uploads;
  const image = document.uploads.image;
  const adress = document.uploads.adress;
  const price = document.uploads.price;

  const regexImage = /^(?!\s*$).+/;
  const regexAdress = /^(?!\s*$).+/;
  const regexPrice = /^(?!\s*$).+/;

  inputs.push(image, adress, price);
  regex.push(regexImage, regexAdress, regexPrice);
}
//// Put the following in the "assets" workspace ////

//Displays loading message whn email is sending
function loadMssg(){
	let status = document.createElement("h4");
	status.id="sendMssg";
	document.getElementsByTagName("form")[0].appendChild(status);
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
function submitForm (form, refreshTo) {
	function everyOne(txtValue){
		for(let i = 0; i<inputs.length; i++){
			if(regex[i].test(txtValue.value) == true){
		  return regex[i].test(txtValue.value);
			} else{
				continue;
			}
		}
	}

	if(inputs.every(everyOne)==true){
		 if(typeof regexEmail != undefined){
			loadMssg();
		}
		form.setAttribute("action", refreshTo);
		form.setAttribute("onsubmit", "return true;");
	}else{
		for(let i = 0; i<inputs.length; i++){
			if(!regex[i].test(inputs[i].value)){
		    alert("Please fill out a valid " +inputs[i].getAttribute("name")+".");
			inputs[i].focus();
			inputs[i].select();
		    }
	    }
		form.setAttribute("action", "");
	    form.setAttribute("onsubmit", "return false;");
	}
}





