var user = document.querySelector('#login');
user.addEventListener('keyup', function(){
	// e.preventDefault();
	var u_times = document.querySelector('.u_times');
	var u_check = document.querySelector('.u_check');
	if (user.value.length==0 || user.value.length<5) {
		user.style.border='1px solid red';
		u_times.style.display= 'block';
		u_check.style.display= 'none';
		return false;
	}else{
		user.style.border='1px solid green';
		u_times.style.display= 'none';
		u_check.style.display= 'block';

	}

} )


var password = document.querySelector('#pwd');
password.addEventListener('keyup', function(){
	// e.preventDefault();
	var p_times = document.querySelector('.p_times');
	var p_check = document.querySelector('.p_check');
	if (password.value.length==0 || password.value.length<8) {
		password.style.border='1px solid red';
		p_times.style.display= 'block';
		p_check.style.display= 'none';
		return false;
	}else{
		user.style.border='1px solid green';
		p_times.style.display= 'none';
		p_check.style.display= 'block';

	}

} )
function validate(){
	if (user.value==0 || user.value.length<5) {
		document.getElementById('errors').innerHTML="Le nom d'utilisateur est invalide!";
		return false;	
	} else if (user.value.includes("-") ||user.value.includes("@") ||user.value.includes("/")
		||user.value.includes("?")||user.value.includes("#")||user.value.includes(" ")
		||user.value.includes(";") ||user.value.includes(",") ||user.value.includes("$")) {
		document.getElementById('errors').innerHTML="mauvais format du nom d'utilisateur !";
		return false;
	}
	 else if(password.value ==0 || password.value.length<8) {
		document.getElementById('errors').innerHTML="mauvais format du mot de passe!";
		return false;

	}else{
		//console.log("connexion okey, felicitation!");
		document.getElementById('errors').innerHTML="connexion...";
	    // alert("connexion okey, felicitation!");
		// return false;
	}
}
