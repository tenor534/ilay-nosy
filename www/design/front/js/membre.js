var g_supprvisuel 	= 1;
var currentEmail 	= "";

//Etat d'affichage des zones
var show_editPicture 		= 0;
var show_pictureFlyout 		= 0;
var show_genericDlgPopup	= 0;
var show_picturePopup		= 0;
var can_displayPopup		= 1;

function onCheck(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);
	return true;
}


jQuery(document).ready(function() {
								
	//Save data
	zPays 			= $('#user_pays').val();
	zProfil 		= $('#user_profil').val();
	zNom 			= $('#user_nom').val();
	zPrenom 		= $('#user_prenom').val();
	zCivilite 		= $('#user_civilite').val();
	zDateNaissance 	= $('#user_dateNaissance').val();
	zAdresse 		= $('#user_adresse').val();
	zCP 			= $('#user_cp').val();
	zVille 			= $('#user_ville').val();
	zFonction 		= $('#user_fonction').val();
	zSociete 		= $('#user_societe').val();
	zTelephone 		= $('#user_telephone').val();
	zEmail 			= $('#user_email').val();
	zLogin 			= $('#user_login').val();
	zPassword 		= $('#user_password').val();
	zQuestion 		= $('#user_question').val();
	zReponse 		= $('#user_reponse').val();
	zPhoto 			= $('#user_photo').val();					
	zUrl 			= $('#user_url').val();


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
							 //currentEmail = newEmail;
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

	/*$("#profileimage").hover(function(){	
		$('#edit_profilepicture').removeClass();
	});*/
	
	$("#profileimage").hover(function(){
		if(show_pictureFlyout == 0){
			$('#edit_profilepicture').removeClass();
			show_editPicture = 1;
			can_displayPopup = 1;
		}
	},function(){
   		$('#edit_profilepicture').addClass("hidden_elem");
		show_editPicture = 0;
	});	

	//Affiche le popup
	$("#profileimage").click(function(){
		if((can_displayPopup == 1) && (show_pictureFlyout == 0)&&(show_genericDlgPopup == 0)){
			$('#view_pop_up').removeClass("hidden_elem");
			show_picturePopup = 1;
		}
	});	

	//Ferme le popup
	$("#bt_close").click(function(){
		//Reste caché
		$('#view_pop_up').addClass("hidden_elem");
		show_picturePopup 	= 0;
	});	


	$("#edit_profilepicture").click(function(){
		//Reste visible
		$('#profile_picture_flyout').removeClass("hidden_elem");
		//Reste caché
   		$('#edit_profilepicture').addClass("hidden_elem");
		show_editPicture 	= 0;
		show_pictureFlyout 	= 1;
		can_displayPopup 	= 0;
	});	


	$("#profile_picture_flyout").click(function(){
		//Reste caché
		$('#profile_picture_flyout').addClass("hidden_elem");			
		show_editPicture 	= 0;
		show_pictureFlyout 	= 0;
	});


	$("#profile_picture_upload").click(function(){
		//Affiche le popup
		$('#generic_dialog_popup').removeClass("hidden_elem");
		show_genericDlgPopup = 1;
	});

	$("#profile_picture_remove").click(function(){
		//ID du membre, pour supprimer la photo
		user_id 			= $('#user_id').val();
		user_profilPhoto 	= $('#user_profilPhoto').val();
		
		//alert("Suppression dela photo "+ user_profilPhoto +" pour le membre : " + user_id);

		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=utilisateur&action=utilisateurFo_removePhoto&user_id="+user_id+"&user_profilPhoto="+user_profilPhoto,
			 dataType:"json",
			 async:false,
			 success:function(resultat){														 	
				$("#profile_pic").attr("src",""+j_basepath+"resize/utilisateur/images/detail/noPhoto.jpg");
				$("#profile_pic_popup").attr("src",""+j_basepath+"resize/utilisateur/images/popup/noPhoto.jpg");				
				$('#user_photo').val('');
			}
		});

	});

	$("#user_photo").change(function(){
			
		//Traitement de la photo	
		var options = {
			 type:"POST",
			 url:j_basepath+'index.php?module=utilisateur&action=utilisateurFo_changePhoto',
			 success: function(msg) {
				// 'data' is an object representing the the evaluated json data
				//Change la photo de profil sur place
				var data = $(msg).text();
				var obj = eval('(' + data + ')');				
				//var obj = eval('(' + "{'MSRP': 20000,'cashDown': 2000,'tradeIn': 1000}" + ')');

				$("#profile_pic").attr("src",""+j_basepath+"resize/utilisateur/images/detail/" + obj.imgSrc);
				$("#profile_pic_popup").attr("src",""+j_basepath+"resize/utilisateur/images/popup/" + obj.imgSrc);
				
				$('#user_photo').val('');
				//Hidden
				$('#user_profilPhoto').val(obj.imgSrc);
				

				//Patienter le client
				//var formInnerHtml = $("#profile_pic_form").html();
								
				/*html = '';
				html += '<span>Veuillez patientez, votre photo est encours de traitement</span>';
				$('#profile_pic_form').html('');			
				$('#profile_pic_form').append(html);*/	
								
				//Ferme le popup
				$('#generic_dialog_popup').addClass("hidden_elem");
				show_genericDlgPopup = 0;			

				/*$('#profile_pic_form').html('');			
				$('#profile_pic_form').append(formInnerHtml);*/									
			}
		};
		$('#form_upload_profile_pic').ajaxSubmit(options);


		/*$('#form_upload_profile_pic').ajaxSubmit({
			 type:"POST",
			 url:j_basepath+'index.php?module=utilisateur&action=utilisateurFo_changePhoto',
			 success: function(msg) {

				//Change la photo de profil sur place
				var data = $(msg).text();
				var obj = eval('(' + data + ')');				
				//var obj = eval('(' + "{'MSRP': 20000,'cashDown': 2000,'tradeIn': 1000}" + ')');

				$("#profile_pic").attr("src",""+j_basepath+"resize/utilisateur/images/detail/" + obj.imgSrc);
				$("#profile_pic_popup").attr("src",""+j_basepath+"resize/utilisateur/images/popup/" + obj.imgSrc);
				
				$('#user_photo').val('');
				//Hidden
				$('#user_profilPhoto').val(obj.imgSrc);
				

				//Patienter le client
				//var formInnerHtml = $("#profile_pic_form").html();
								
				//html = '';
				//html += '<span>Veuillez patientez, votre photo est encours de traitement</span>';
				//$('#profile_pic_form').html('');			
				//$('#profile_pic_form').append(html);	
								
				//Ferme le popup
				$('#generic_dialog_popup').addClass("hidden_elem");
				show_genericDlgPopup = 0;			

				//$('#profile_pic_form').html('');			
				//$('#profile_pic_form').append(formInnerHtml);									
			}
		});*/
		
	});
	
	$("#formButton_annuler").click(function(){
		//Ferme le popup
		if(show_genericDlgPopup == 1){
			$('#generic_dialog_popup').addClass("hidden_elem");
			show_genericDlgPopup = 0;
		}
	});


	$(".formButton_modifier").click(function(){

		if (!tmt_validateForm(document.registerForm)) {
			return false;			
		}
		else{
			//Vider le message d'erreur	
			$('#errorMessage').html('');			

			$('#registerForm').ajaxSubmit({
				 type:"POST",
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
					
					$('#contentPageMain').html('');
					
					var html = '';
					
					html += '<p>';
					html += ''+user_civilite+' <strong>'+user_prenom+' '+user_nom+'</strong>,<br>';
					html += '</p>';
					html += '<p>&nbsp;</p>';
					html += '<p>';
					html += '	La modification de votre profil sur le site Ilay NOSY a été prise en compte par le système.<br>';
					html += '</p>';

					html += '<p>';
					html += '	Nous vous remercions de votre vonfiance!<br>';
					html += '</p>';

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

					$('#contentPageMain').html('');
					$('#contentPageMain').append(html);					

					document.location.href="index.php?module=membre&action=membreFo_profilDetail";

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