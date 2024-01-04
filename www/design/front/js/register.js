var g_supprvisuel 	= 1;
var currentEmail 	= "";

function onCheck(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);
	return true;
}


jQuery(document).ready(function() {

	//Le mail entrée : par défaut = vide
	currentEmail 	= $('#user_email').val();
								
	//Test d'unicité du email
	$('#user_email').change(function(){
		var newEmail 		= $(this).val();						

		if(newEmail != ""){
			if(newEmail != currentEmail){
								
				//Affiche un popup d'attente
				$('#message_email_flyout').removeClass("hidden_elem");
				
				$.ajax({
					 type:"POST",
					 url:j_basepath+'index.php',
					 data:"module=utilisateur&action=utilisateurBo_unicityEmail&utilisateur_email="+$(this).val(),
					 dataType:"json",
					 async:false,
					 success:function(resultat){
						 //alert('Found user = ' + resultat.foundUser);				 
						 
						//Reste caché
						$('#message_email_flyout').addClass("hidden_elem");
						 
						 if(resultat.foundUser == '1'){
							//alert("l'adresse email (" + newEmail + ") est déjà utilisée, réessayez avec une autre.")	 							
							//Affiche un popup d'attente
							$('#message_email_duplicate_flyout').removeClass("hidden_elem");
							$('#user_email').val('');					 
						 }else{
							 currentEmail = newEmail;
						 }
					 }
				});								
			}
		}
	});		


	$("#formButtonOk").click(function(){
		//Reste caché
		$('#message_email_duplicate_flyout').addClass("hidden_elem");									  
	});		

	$(".formButton_accept").click(function(){
										  
		if (!tmt_validateForm(document.registerForm)) {
			return false;			
		}
		else{
			//Vider le message d'erreur	
			$('#errorMessage').html('');			

			$('#registerForm').ajaxSubmit({
				 url:j_basepath+'index.php?module=utilisateur&action=utilisateurFo_sauvegardeMembre',
				 success: function(data) {
					// 'data' is an object representing the the evaluated json data
					
					//Reset all
					/*$('#user_pays').val(0);
					$('#user_profil').val(0);
					$('#user_nom').val('');
					$('#user_prenom').val('');
					$('#user_civilite').val(0);
					$('#user_dateNaissance').val('');
					$('#user_cp').val('');
					$('#user_ville').val('');
					$('#user_fonction').val('');
					$('#user_societe').val('');
					$('#user_telephone').val('');
					$('#user_email').val('');
					$('#user_password').val('');
					$('#user_question').val('');
					$('#user_reponse').val('');
					$('#user_photo').val('');					
					$('#user_url').val('');*/
					
					user_civilite 	= $('#user_civilite option:selected').text();
					user_profil 	= $('#user_profil').val();
					user_nom 		= $('#user_nom').val();
					user_prenom 	= $('#user_prenom').val();			
					
					$('.singleColumnBig').html('');
					
					var html = '';
					
					html += '<p>';
					html += ''+user_civilite+' <strong>'+user_prenom+' '+user_nom+'</strong>,<br>';
					html += '</p>';
					html += '<p>&nbsp;</p>';
					html += '<p>';
					html += '	Merci pour votre inscription  sur le site Ilay NOSY.<br>';
					html += '</p>';
					html += '<p>';
					html += '	Connectez-vous pour placer et publier gratuitement vos annonces sur le service d\'annonces classées à l\'échelle malgache en quelques minutes en cliquant <a href="'+j_basepath+'index.php?module=commun&action=communFo_login">ici</a>.<br>';
					html += '</p>';					

					//Le texte suivant dépend du profil d'inscription
					switch(user_profil){
						//Annonce
						case "3":
						case "4":
							html += '<p>';
							html += 'Nous vous invitons &agrave; consulter la page des annonces et ajouter vos propres annonces en cliquant <a href="'+j_basepath+'index.php?module=annonce&action=annonceFo_annonceCategorieList">ici</a>.<br>';
							html += '</p>';
							break;
						//Projet	
						case "5":
						case "6":
						case "7":
							html += '<p>';
							html += 'Nous vous invitons &agrave; consulter la page <strong>ProgOnline</strong> en cliquant <a href="'+j_basepath+'index.php?module=projet&action=projetFo_listCategorie">ici</a>.<br>';
							html += '</p>';
							break;
						//Emploi	
						case "8":
						case "9":
							html += '<p>';
							html += 'Nous vous invitons &agrave; consulter la page des annonces et ajouter vos propres annonces dans la rubrique <strong>Emploi</strong> en cliquant <a href="'+j_basepath+'index.php?module=annonce&action=annonceFo_listCategorie">ici</a>.<br>';
							html += '</p>';
							break;
						default:
							html += '<p>';
							html += 'Nous vous invitons &agrave; consulter la page d\'accueil en cliquant <a href="'+j_basepath+'index.php?module=accueil&action=accueilFo_abord">ici</a>.<br>';
							html += '</p>';
							break;
					}

					html += '<p>&nbsp;</p>';
					html += '<p>';
					html += '	Cordialement,<br>';
					html += '</p>';
					html += '<p>&nbsp;</p>';
					html += '<p>';
					html += '	<strong>Service Clients</strong><br>';
					html += '	<a href="mailto:contact@ilay-nosy.com">contact@ilay-nosy.com</a><br>';
					html += '	T&eacute;l.: (261) 03 40 47 28 15<br>';
					html += '</p>';

					$('.singleColumnBig').html('');
					$('.singleColumnBig').append(html);					
					
				}
			});



			/*$.ajax({
				 type:"POST",
				 url:j_basepath+'index.php',
				 data:"module=utilisateur&action=utilisateurFo_sauvegardeMembre&user_paysId="+user_paysId+"&user_profilId="+user_profilId+"&user_nom="+user_nom+"&user_prenom="+user_prenom+"&user_civilite="+user_civilite+"&user_dateNaissance="+user_dateNaissance+"&user_cp="+user_cp+"&user_ville="+user_ville+"&user_fonction="+user_fonction+"&user_societe="+user_societe+"&user_telephone="+user_telephone+"&user_email="+user_email+"&user_password="+user_password+"&user_question="+user_question+"&user_reponse="+user_reponse+"&user_photo="+user_photo+"&user_url="+user_url,
				 dataType:"json",
				 async:false,
				 success:function(resultat){														 	
					var message = "";
					alert("IIII");
					switch (resultat.statut) {
						case 0: 
							message = "Votre identifiant ou mot de passe est incorrect.";
							break;
						case "1": 
							document.location.href="index.php?module=accueil&action=accueilFo_abord";
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
			});*/

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