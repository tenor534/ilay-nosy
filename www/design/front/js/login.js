var g_supprvisuel 	= 1;

function onCheck(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);
	return true;
}


jQuery(document).ready(function() {
								
	$(".formButton_login").click(function(){
										  
		if (!tmt_validateForm(document.loginForm)) {
			return false;			
		}
		else{
			//Vider le message d'erreur	
			$('#errorMessage').html('');
			
			//Récupères les données
			user_email 		= $('#user_email').val();
			user_password	= $('#user_password').val();

			$.ajax({
				 type:"POST",
				 url:j_basepath+'index.php',
				 data:"module=commun&action=communFo_connexion&email="+user_email+"&password="+user_password,
				 dataType:"json",
				 async:false,
				 success:function(resultat){														 	
					var message = "";
					//alert(resultat.statut);
					switch (resultat.statut) {
						case 0: 
							message = "Votre identifiant ou mot de passe est incorrect.";
							break;
						case "1": 
							//document.location.href="index.php?module=accueil&action=accueilFo_abord";
							document.location.href="index.php?module=membre&action=membreFo_tableBord";
							break;
						case "2": 
							message = "Votre compte a &eacute;t&eacute; d&eacute;sactiv&eacute;. <br>Veuillez contacter le Service Clients en cliquant <a href='mailto:contact@ilay-nosy.com'>ici</a> pour plus d'informations.";
							break;
						case "3": 
							message = "Votre compte nouvellement cr&eacute;&eacute; est en attente de confirmation. <br>Veuillez contacter le Service Clients en cliquant <a href='mailto:contact@ilay-nosy.com'>ici</a> pour plus d'informations.";
							break;
					}

					if(message != ""){
						$('#errorMessage').html('');
						$('#errorMessage').html('<img border="0" src="'+j_basepath+'design/front/images/v5/icon_error.gif" />&nbsp;'+message+'');
					}					
				 }
			});

			//Validation du formulaire
			//document.registerForm.submit();
		}										  
		/*
		var iframe=$('#corporate_descriptifCourt___Frame').get(0);
		$('#corporate_descriptifCourt').val(iframe.contentWindow.FCK.GetHTML());
		*/
	
		/*var iframeLong=$('#corporate_descriptifLong___Frame').get(0);
		
		$('#corporate_descriptifLong').val(iframeLong.contentWindow.FCK.GetHTML());
		*/

	});
});