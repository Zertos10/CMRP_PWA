document.getElementById("corp").onload = function () { Localisation() };


var phone_verif = document.getElementById("phone_verif").value;
console.log(phone_verif);




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
function alternative() {
	$.ajax({
		// pensez � d�finir le chemin vers admin-ajax.php�
		// � en front via localize_script()�
		// � au moment de l'enqueue de votre script
		url: adminajax,
		data: {
			action: get_user_coords
		}
	}).done(function (data) {
		if (data.success) {
			var lat = data.data.lat;
			var lng = data.data.lng;
			console.log(lat, lng);
			// Do stuff

		}
	});
}

