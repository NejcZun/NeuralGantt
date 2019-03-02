function success(){
	if(document.getElementById("formUsername").value === "" ||
		document.getElementById("formPassword").value === ""){
		document.getElementById("formSubmit").disabled = true;
	    document.getElementById("formSubmit").style.backgroundcolor = "#c6d6ef";
	} else {
		document.getElementById("formSubmit").disabled = false;
	}
}