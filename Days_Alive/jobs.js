/**
* Author: Matt Hannah
* Purpose: This file is for validation of Enquiry Form enquire.html
* Created: 26 Sept 2014
* Last updated: 24 Sept 2013
*  
*/
function validate() {
	var errMsg = ""; //error message								
	var result = true; //error boolean
	var alpha = /^[a-zA-Z() ]+$/;
	var datepattern1 = /\d{2}\/\d{2}\/\d{2}$/;
	var datepattern2 = /\d{2}\/\d{2}\/\d{4}$/;
	var emailpattern = /\S@\S/;
	
	/*get values from the form*/
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var date = document.getElementById("bday").value;
	var street = document.getElementById("street").value;
	var town = document.getElementById("town").value;
	var state = document.getElementById("state").value;
	var postcode = document.getElementById("postcode").value;
	var email = document.getElementById("email").value;
	var phone = document.getElementById("phone").value;
	var skill1 = document.getElementById("skill1");
	var skill2 = document.getElementById("skill2");
	var skill3 = document.getElementById("skill3");
	var skill4 = document.getElementById("skill4");
	var skill5 = document.getElementById("skill5");
	var skill6 = document.getElementById("skill6");
	var skill7 = document.getElementById("skill7");
	var otherskills = document.getElementById("otherskills").value;
	
	/* Rule #1 - First name: maximum of 15 characters, alphabetical only */
	if (firstname.length > 15) {
		errMsg += "First name must be a maximum of 15 characters.\n";
		result = false;
	}
	if (!alpha.test(firstname)) {
		errMsg += "First name must be alphabetical only.\n";
		result = false;
	}
	
	/* Rule #2 - Last name: maximum of 25 characters, alphabetical only */
	if (lastname.length > 25) {
		errMsg += "Last name must be a maximum of 25 characters.\n";
		result = false;
	}
	if (!alpha.test(lastname)) {
		errMsg += "Last name must be alphabetical only.\n";
		result = false;
	}
	
	/* Rule #3 - Date of birth: dd/mm/yy or dd/mm/yyyy */
	if (date.match(datepattern1) || date.match(datepattern2)) {
		//do nothing
	}
	else {
		errMsg += "Date must be in the format: dd/mm/yy or dd/mm/yyyy.\n";
		result = false;
	}
	
	/* Rule #4 - Street address: maximum of 50 characters */
	if (street.length > 50) {
		errMsg += "Street address must be a maximum of 50 characters.\n";
		result = false;
	}
	
	/* Rule #5 - Suburb/town: maximum of 25 characters */
	if (town.length > 25) {
		errMsg += "Suburb/town must be a maximum of 25 characters.\n";
		result = false;
	}
	
	/* Rule #6 -  Postcode must be 4 digits and the selected state must match the first digit of the postcode*/
	if (postcode.length != 4) {
		errMsg += "Postcode must be 4 digits long.\n";
		result = false;
	}
	else {
		var tmp = postcode[0]; //first digit of postcode
		switch(state) { //case statements for each state
			case "VIC": 
				if(tmp == 3 || tmp == 8) {
					//do nothing
				}
				else {
					errMsg += "VIC postcode must start with 3 or 8.\n";
					result = false;				
				}
				break;
			case "NSW": 
				if(tmp == 1 || tmp == 2) {
					//do nothing
				}
				else {
					errMsg += "NSW postcode must start with 1 or 2.\n";
					result = false;				
				}
				break;
			case "QLD": 
				if(tmp == 4 || tmp == 9) {
					//do nothing
				}
				else {
					errMsg += "QLD postcode must start with 4 or 9.\n";
					result = false;				
				}
				break;
			case "ACT":
			case "NT": 
				if(tmp != 0) {
					errMsg += state + " postcode must start with 0.\n";
					result = false;				
				}
				break;
			case "WA": 
				if(tmp != 6) {
					errMsg += "WA postcode must start with 6.\n";
					result = false;				
				}
				break;
			case "SA": 
				if(tmp != 5) {
					errMsg += "SA postcode must start with 5.\n";
					result = false;				
				}
				break;
			case "TAS": 
				if(tmp != 7) {
					errMsg += "TAS postcode must start with 7.\n";
					result = false;				
				}
				break;
		}
	}
	
	/* Rule #7 - Email in format: {name}@{url} */
	if(!email.match(emailpattern)) {
		errMsg += "Email must be in format name@url.\n";
		result = false;
	}
	
	/* Rule #8 - Phone number: exactly 10 digits */
	if (phone.length != 10) {
		errMsg += "Phone number must be 10 digits long.\n";
		result = false;
	}

	/* Rule #9 - At least one skill must be selected */
	if (!skill1.checked && !skill2.checked && !skill3.checked && !skill4.checked && !skill5.checked && !skill6.checked && !skill7.checked) {
		errMsg += "You must have at least one skill.\n";
		result = false;
	}	
	
	/* Rule #10 - Other skills must be filled out if other is selected */
	if (skill7.checked && otherskills.trim() == "") { //trim removes spaces
		errMsg += "Other skills must be filled out.\n";
		result = false;
	}

	if (errMsg != ""){   //only show error message if there is one.
		alert(errMsg);
	}
	return result;
}

function store_user(){
	//get values and assign them to a localStorage attribute.
	//we use the same name for the attribute and the element id to avoid confusion
	localStorage.jobtitle = document.getElementById("jobName").innerHTML;
	localStorage.jobref = document.getElementById("refNo").innerHTML;
	//added for testing–remove later
}

function prefill_form(){
	//if localStorage for username is not empty
	document.getElementById("jobtitle").value = localStorage.jobtitle;
	document.getElementById("jobref").value = localStorage.jobref;
}
/* link HTML elements to corresponding event function */
function init() {
	var enquire = document.getElementById("enquire");//link the variable to the HTML form element
	enquire.onsubmit = validate;	/* assigns functions to corresponding events */
	prefill_form();
}
	  
window.onload = init;

