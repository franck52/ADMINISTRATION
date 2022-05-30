var nom_rep1 = document.querySelector('#rep1');
var nom_rep2 = document.querySelector('#rep2');
var textarea = document.querySelector('#textarea1');

var n1 = document.querySelector('#n1');
var n2 = document.querySelector('#n2');
var n3 = document.querySelector('#n3');
var n4 = document.querySelector('#n4');
var n5 = document.querySelector('#n5');
// n1.addEventListener('keyup', function(){
// 	// e.preventDefault();
// 	var u_times = document.querySelector('.u_times');
// 	var u_check = document.querySelector('.u_check');
// 	if (n1.value.length==0 || n1.value.length<5) {
// 		n1.style.border='1px solid red';
// 		u_times.style.display= 'block';
// 		u_check.style.display= 'none';
// 		return false;
// 	}else{
// 		user.style.border='1px solid green';
// 		u_times.style.display= 'none';
// 		u_check.style.display= 'block';

// 	}

// } )

var erros = document.getElementById('erros');
var errors2 = document.getElementById('erros2');
function soumettre(){
	if (nom_rep1.value==0 || nom_rep1.value.length<5) {
		document.getElementById('errors').innerHTML="Le nom d'utilisateur 1 est invalide!";
		return false;	
	}
	 else if(nom_rep2.value ==0 || nom_rep2.value.length<5) {
		document.getElementById('errors').innerHTML="Le nom d'utilisateur 2 est invalide!";
		return false;

	}else if(textarea.value ==0 || textarea.value.length<50){
		document.getElementById('errors').innerHTML="le contenu du PV est trop court!";
		return false;

	}
	else{
		console.log("connexion okey, felicitation!");
	    // alert("connexion okey, felicitation!");
	    document.getElementById('errors').innerHTML="PV enregistré!";
		 return false;
	}
}

function validation(){
	if (n1.value==0 || n1.value<0) {
		document.getElementById('errors2').innerHTML="nombre de voix null ou blanc doit etre supperieur à zéro!";
		return false;	
	}
	else{
		console.log("connexion okey, felicitation!");
	    // alert("connexion okey, felicitation!");
	    document.getElementById('errors2').innerHTML="Données enregistrées!";
		 return false;
	}
}