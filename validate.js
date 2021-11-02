//Stores location of page
var page = window.location.pathname;

/////////////////Sets up the arrays with regex and textfields
var inputs = [];
var regex = [];


//Textboxes and regex for managing available properties
var uploads = document.uploads;
var editListing = document.editListing;

function txtBoxes(form){
	var image = form.image;
	var adress = form.adress;
	var price = form.price;

	inputs.push(image, adress, price);
	return inputs;

}


var regexImage = /^(?!\s*$).+/;
var regexAdress = /^(?!\s*$).+/;
var regexPrice = /^(?!\s*$).+/;



regex.push(regexImage, regexAdress, regexPrice);


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
	txtBoxes(form);
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
		inputs = [];
	}
	
}





