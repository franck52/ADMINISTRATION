function validateForm() {
	
	let type = document.getElementById("type_elect").value;
	let code_elect = document.getElementById("code_elect").value;
	let code_elect_errors = "";
	if (type =="") {
		
		return document.getElementById("type_elect_errors").innerHTML = "ce champs est obligatoire"
	}
}