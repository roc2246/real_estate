//Add to ASSETS later

//Stores location of page
var page = window.location.pathname;

/////////////////Sets up the arrays with regex and textfields
var inputs = [];
var regex = [];


//For Assigning Form, Input, and Regex variables
var uploads = document.uploads;
var editListing = document.editListing;

function txtBoxes(form){
	var image = form.image;
	var adress = form.adress;
	var price = form.price;

	inputs.push(image, adress, price);
	return inputs;

}

function regexAssign(){
	var regexImage = /^.*\.(jpg|jpeg|gif|JPG|png|PNG)$/;
	var regexAdress = /^(?!\s*$).+/;
	var regexPrice = /^(?!\s*$).+/;
	
	regex.push(regexImage, regexAdress, regexPrice);
	return regex;
}



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
	var regexTest = [];
	txtBoxes(form);
	regexAssign();
	function everyOne(){
		for(let i = 0; i<inputs.length; i++){
			if(regex[i].test(inputs[i].value) == true){
		  regexTest.push(regex[i].test(inputs[i].value));
			} else{
				continue;
			}
		}
	}

    everyOne();

	if(regexTest.length == inputs.length){
		 if(typeof regexEmail !== 'undefined'){
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
		regex = [];
	}
	
}





