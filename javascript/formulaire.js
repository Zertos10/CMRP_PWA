document.getElementById("corp").onload = function () { Localisation() };


var phone_verif = document.getElementById("phone_valid").value;
var email_verif = document.getElementById("email_valid").value;
var name_verif = document.getElementById("name_valid").value;
var send_succes = document.getElementById("send_succes").value;
console.log(phone_verif);
if (typeof (phone_verif) != "undefined" && typeof (email_verif) != "undefined"  && typeof (name_verif) != "undefined" && typeof (send_succes) != "undefined")
{
	console.log("Tout va bien");
	retourRequete();
}
function retourRequete()
{
	if(phone_verif == 1) {
		$('#phone_form').css('background-color', '#941417');
	}
	if (email_verif == 1) {
		$('#email_form').css('background-color', '#941417');
	}
	if (name_verif == 1) {
		$('#name_form').css('background-color', '#941417');

	}
	if (send_succes == true) {
		alert("Formulaire envoi� avec succ�e");
	}

}


function Localisation() {
	// On v�rifie que la m�thode est impl�ment� dans le navigateur
	if (navigator.geolocation) {
		// On demande d'envoyer la position courante � la fonction callback
		navigator.geolocation.getCurrentPosition(callback, erreur);
	} else {
		// Function alternative sinon
		
	}
}
var lat = 0;
var lng = 0;
function callback(position) {
	lat = position.coords.latitude;
	lng = position.coords.longitude;
	console.log(lat, lng);
	var loc = lat + ',' + lng;


	$("#localisation").val(loc);
	

	// Do stuff
}
function erreur(error) {
	switch (error.code) {
		case error.PERMISSION_DENIED:
			console.log('L\'utilisateur a refus� la demande');
			break;
		case error.POSITION_UNAVAILABLE:
			console.log('Position ind�termin�e');
			break;
		case error.TIMEOUT:
			console.log('R�ponse trop lente');
			break;
	}
	// Function alternative
	alternative();
};

