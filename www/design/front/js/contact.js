var g_supprvisuel 	= 1;
var	j_basepath 		= '/www/';

function onCheck(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);
	return true;
}


jQuery(document).ready(function() {
								
	$(".formButton_valid").click(function(){
										  
		if (!tmt_validateForm(document.registerForm)) {
			return false;			
		}
		else{
			//Vider le message d'erreur	
			$('#errorMessage').html('');
			
			//Récupères les données
			user_civilite 	= $('#user_civilite option:selected').text();
			user_nom 		= $('#user_nom').val();
			user_prenom 	= $('#user_prenom').val();
			user_societe 	= $('#user_societe').val();
			user_pays 		= $('#user_pays option:selected').text();
			user_cp 		= $('#user_cp').val();
			user_email 		= $('#user_email').val();
			user_message	= $('#user_message').val();

			$.ajax({
				 type:"POST",
				 url:j_basepath+'index.php',
				 data:"module=contact&action=contactFo_sendMail&civilite="+user_civilite+"&nom="+user_nom+"&prenom="+user_prenom+"&societe="+user_societe+"&pays="+user_pays+"&cp="+user_cp+"&email="+user_email+"&message="+user_message,
				 dataType:"json",
				 async:false,
				 success:function(resultat){
					
					
					//alert("Votre demande a été bien reçue,  nous vous répondrons dans un meileur délais.");

					//Vider les controles
					$('#user_civilite').val(0);		
					$('#user_nom').val('');
					$('#user_prenom').val('');
					$('#user_societe').val('');
					$('#user_pays').val(0);
					$('#user_cp').val('');
					$('#user_email').val('');
					$('#user_message').val('');

					$('.registerContent').html('');
					
					var html = '';
					
					html += '<p>';
					html += ''+user_civilite+' <strong>'+user_prenom+' '+user_nom+'</strong>,<br>';
					html += '</p>';
					html += '<p>&nbsp;</p>';
					html += '<p>';
					html += '	Votre demande de contact a &eacute;t&eacute; bien re&ccedil;ue,  nous vous r&eacute;pondrons dans un meileur d&eacute;lai.<br>';
					html += '</p>';
					
					html += '<p>';
					html += 'Nous vous invitons &agrave; consulter la page d\'accueil en cliquant <a href="index.php?module=accueil&action=accueilFo_abord">ici</a>.<br>';
					html += '</p>';
					html += '<p>&nbsp;</p>';
					html += '<p>';
					html += '	Cordialement,<br>';
					html += '</p>';
					html += '<p>&nbsp;</p>';
					html += '<p>';
					html += '	<strong>Service Clients</strong><br>';
					html += '	<a href="mailto:contact@ilay-nosy.com">contact@ilay-nosy.com</a><br>';
					html += '</p>';

					$('.registerContent').html('');
					$('.registerContent').append(html);

					/*$('#appercu').empty();
					$('#appercu').html(resultat.visuel);
					$('#auxvisuel').val(j_basepath+j_logo_resize + resultat.image);
					extension=resultat.image.split(['.']);
					switch(extension[extension.length-1].toLowerCase()){
						case 'swf':
							if($('.clearfix').length>1)
							$('.clearfix').gt(0).hide();
							//$('#actualite_url]').removeAttr('tmt:required');
							break;
						default:
							$('.clearfix').each(function(){
								$(this).css('display','block');
							});
							break;
					}				
	
					//$('#actualite_photo]').val(resultat.image);
					if($('#auxvisuel]').val().length>0)
						$('#marque_logo]').val($('#auxvisuel]').val());
	
					input_h=document.createElement('input');
					input_h.type='hidden';
					$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_logo_resize + resultat.image});
					$('#marqueForm').append($(input_h));
					form=document.getElementById('marqueForm');
					form.tmt_validator = new tmt_formValidator(form);
					*/
				 }
			});

			//Validation du formulaire
			//document.registerForm.submit();
		}										  
		/*
		var iframe=$('#corporate_descriptifCourt___Frame').get(0);
		$('#corporate_descriptifCourt]').val(iframe.contentWindow.FCK.GetHTML());
		*/
	
		/*var iframeLong=$('#corporate_descriptifLong___Frame').get(0);
		
		$('#corporate_descriptifLong').val(iframeLong.contentWindow.FCK.GetHTML());
		*/

	});
	$(".formButton_annuler").click(function(){
										  
		//Vider le message d'erreur	
		$('#errorMessage').html('');

		//Vider les controles
		$('#user_civilite').val(0);		
		$('#user_nom').val('');
		$('#user_prenom').val('');
		$('#user_societe').val('');
		$('#user_pays').val(0);
		$('#user_cp').val('');
		$('#user_email').val('');
		$('#user_message').val('');
		
		//Remettre à l'état le css
		

	});


	/*
	$('[@id=rubrique_marqueId').change(function(){
		var idMarque = $(this).val();
		var idRubrique = $('#rubrique_id').val();
		if(idMarque != 0)
		{
			$.getJSON(j_basepath + "index.php",{module:"rubrique", action:"rubriqueBo_editeRubrique", idMarque:idMarque, idRubrique:idRubrique}, function(datas)
			{
				if(datas != '' && datas['toRubrique' != 0)
				{
					$('#rubrique_parentId').html('');
					var html = '<option value="0">select heading parent &nbsp;&nbsp;</option>';
					for(i=0; i< datas['toRubrique'.length; i++)
					{
						html += '<option value="' + datas["toRubrique"[i["rubrique_id"+'">' + datas["toRubrique"][i]["rubrique_libelle"] + '</option>';
					}
					$('#rubrique_parentId').append(html);
					$('#rubrique_parentId').val(0);					
				}
				else
				{
//					alert('No heading associated with this brand.');
					$('#rubrique_parentId').html('');
					var html = '<option value="0">No heading parent &nbsp;&nbsp;</option>';
					$('#rubrique_parentId').append(html);
					$('#rubrique_parentId').val(0);
					return false;
				}
			});
		}
	});	*/


});

function submitForm(form){
	g_supprvisuel = 0;
	if(tmt_validateForm(form)){
		return true;
	}else{
		g_supprvisuel = 1;
		return false;
	}
}