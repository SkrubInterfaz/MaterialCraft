function copierIP() { // Fonction utiliser pour le bouton d'ip sur la page accueil.php
	var copyText = document.getElementById("ipserveur");
	copyText.select();
	document.execCommand("copy");
	M.toast({
		html: 'Vous avez copié l\'adresse IP du serveur !'
	});
}
$(document).ready(function () {
	$('.collapsible').collapsible();
	$('.dropdown-trigger').dropdown();
	$('.modal').modal();
});

$('#alert_close').click(function () {
	$(".modal").fadeOut("slow", function () {});
});

new WOW().init();

function bouclevote(id2, pseudo2) {
	$.post("index.php?action=voter", {
		id: id2,
		pseudo: pseudo2
	}, function (data, status) {
		console.log(data);
		if (data == "success") {
			$("#vote-success").fadeIn(500);
			setTimeout(function () {
				$("#vote-success").fadeOut(500);
			}, 5000);
			$("#btn-verif-" + id2).fadeOut(500);
			setTimeout(function () {
				$("#btn-after-" + id2).fadeIn(500);
			}, 500);
			if (document.getElementById("nbr-vote-" + pseudo2)) {
				document.getElementById("nbr-vote-" + pseudo2).innerHTML = (parseInt(document.getElementById("nbr-vote-" + pseudo2).innerHTML) + 1);
			}
		} else {
			setTimeout(function () {
				bouclevote(id2, pseudo2);
			}, 500);
		}
	});
}