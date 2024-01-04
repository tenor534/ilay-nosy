$(document).ready(function() {
	
	//export des utilisateurs
	$("#bt_exporter").click(function(){
		document.location.href='index.php?module=utilisateur&action=utilisateurBo_exporterListe';
		return false;
	});	

});

