// JavaScript Document
var g_supprvisuel 	= 1;
var c_rubrique  	= new Array();
var zCategorie = "";
var zProvince  = "";

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

function checkAnnonce(obj)
{	
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var annonce_id = ch_name.substring("annoncePublier_".length, ch_name.length);
	
	//alert(ch_name + " : annonce_id = " + annonce_id + ", publier=" + $(obj).val());
	
	$.getJSON(j_basepath + "index.php",{module:"annonce", action:"annonceFo_updateAnnonce", idAnnonce:annonce_id, publier:$(obj).val()});	
	
	return true;	
}

function voirImg (imgSrc, id){
	$("#profile_pic").attr("src",""+j_basepath+"resize/annonce/images/popup/" + imgSrc);
	$("#picture_id").val(id);
	$("#photo_id").val(id);
	$("#picture_photo").val(imgSrc);
}

//Le forfait selectionné
function selectItem(obj){
	//document.annonceForm.annonce_forfaitId.value = $(obj).val();
	$('#annonce_forfaitId').val($(obj).val());
}

/* cible: selection abonnement */
function selectAbonnement(obj){
	var aid = $(obj).val();
	zUrl = j_basepath + 'index.php?aid='+aid+'&module=annonce&action=annonceFo_annonceList';			
	document.location.href = zUrl;
}

//Ajoute  affiche le formulaire d'ajout d'annonce
function addAnnonce(){

	if (!tmt_validateForm(document.annonceForm)) {
		return false;			
	}
	else{
		//Submit the form
		var form 	= document.forms["annonceForm"];
		form.action	= 'index.php?module=annonce&action=annonceFo_annonceEdit';			
		form.submit();		
	}										  			
}		


jQuery(document).ready(function() {
								
	zCategorie = $('#categorieAnId option:selected').text();
	zProvince  = $('#provinceId option:selected').text();

	//Par defaut on affiche les zone en mode saisie
	$('#cat_breadcrumbs').addClass("hidden_elem");		

	$('#link_edit').addClass("hidden_elem");		
	$('#link_view').removeClass("hidden_elem");		

	$('#link_edit2').addClass("hidden_elem");		
	$('#link_view2').removeClass("hidden_elem");		

	$('#view_titre').addClass("hidden_elem");		
	$('#edit_titre').removeClass("hidden_elem");	
	
	$('#view_action').addClass("hidden_elem");			
	$('#view_offre').addClass("hidden_elem");			
	$('#view_price').addClass("hidden_elem");			
	
	$('#view_resume').addClass("hidden_elem");			
	$('#view_description').addClass("hidden_elem");				

	
	//Ajoute  affiche le formulaire d'ajout d'annonce
	$("#link_edit").click(function(){

		$('#link_edit').addClass("hidden_elem");		
   		$('#link_edit').removeClass("inline");		
   		$('#link_view').removeClass("hidden_elem");		
   		$('#link_view').addClass("inline");		

		$('#link_edit2').addClass("hidden_elem");		
   		$('#link_edit2').removeClass("inline");		
   		$('#link_view2').removeClass("hidden_elem");		
   		$('#link_view2').addClass("inline");		


		$('#cat_breadcrumbs').addClass("hidden_elem");		
		
		$('#categ_rubrique').removeClass("hidden_elem");		
		
		$('#edit_contact').removeClass("hidden_elem");				

		$('#view_titre').addClass("hidden_elem");		
   		$('#edit_titre').removeClass("hidden_elem");		
		
		$('#view_action').addClass("hidden_elem");			
		$('#edit_action').removeClass("hidden_elem");			

		$('#view_offre').addClass("hidden_elem");			
		$('#edit_offre').removeClass("hidden_elem");			

		$('#view_price').addClass("hidden_elem");			
		$('#edit_price').removeClass("hidden_elem");		
		
		$('#view_resume').addClass("hidden_elem");			
		$('#edit_resume').removeClass("hidden_elem");			

		$('#view_description').addClass("hidden_elem");			
		$('#edit_description').removeClass("hidden_elem");			
		
	});		

	$("#link_view").click(function(){
								   
		if (!tmt_validateForm(document.annonceForm)) {
			return false;			
		}
		else{
			
			//		
			$('#link_view').addClass("hidden_elem");		
			$('#link_view').removeClass("inline");		
			$('#link_edit').removeClass("hidden_elem");		
			$('#link_edit').addClass("inline");		
	
			$('#link_view2').addClass("hidden_elem");		
			$('#link_view2').removeClass("inline");		
			$('#link_edit2').removeClass("hidden_elem");		
			$('#link_edit2').addClass("inline");			

			$('#cat_breadcrumbs').removeClass("hidden_elem");		
			$('#categ_rubrique').addClass("hidden_elem");		
			
			$('#view_titre').html('');
			$('#view_titre').html( '<h1 class="txt_arrows">' + $('#annonce_titre').val() + '</h1>');
	
			//$('#an_titre').val($('#annonce_titre').val());
			
			$('#edit_contact').addClass("hidden_elem");				
	
			$('#edit_titre').addClass("hidden_elem");				
			$('#view_titre').removeClass("hidden_elem");		

			$('#view_action,').removeClass("hidden_elem");			
			$('#edit_action').addClass("hidden_elem");			
			
			$('#view_offre').removeClass("hidden_elem");			
			$('#edit_offre').addClass("hidden_elem");			
			
			$('#view_price').removeClass("hidden_elem");			
			$('#edit_price').addClass("hidden_elem");			

			$('#view_resume').removeClass("hidden_elem");			
			$('#edit_resume').addClass("hidden_elem");			
	
			$('#view_description').removeClass("hidden_elem");			
			$('#edit_description').addClass("hidden_elem");					
		}										  			
	});		

	//Changement de catégorie
	$("#categorieAnId").change(function(){
		var idCategorie = $(this).val();	
		
		//zCategorie	= $('select[@name=categorieAnId] option:selected').text();		
		zCategorie	= $('#categorieAnId option:selected').text();		

		if(idCategorie != 0)	
		{
			$.getJSON(j_basepath + "index.php",{module:"rubrique", action:"rubriqueFo_chargeSelectRubrique", idCategorie:idCategorie}, function(datas){
																																				
				if(datas != '' && datas['toRubrique'] != 0)
				{
					//contenant tt les rubriques
					c_rubrique  	= new Array();
					
					$('#annonce_rubriqueId').html('');
					var html = '<option value="0">Rubrique :</option>';
					
					for(i=0; i< datas['toRubrique'].length; i++)
					{						
						var indent = "";
						for (id=0; id<datas["toRubrique"][i]["rubrique_level"]; id++){
							indent += " -- ";	
						}					
						//if(datas["toRubrique"][i]["rubrique_id"] != idRubrique){
							html += '<option value="' + datas["toRubrique"][i]["rubrique_id"] +'">' + indent + datas["toRubrique"][i]["rubrique_libelle"] + '</option>';
						//}
						c_rubrique[i] = indent + datas["toRubrique"][i]["rubrique_libelle"];
					}

					$('#annonce_rubriqueId').append(html);
					$('#annonce_rubriqueId').val(0);
					
					//$('#divRubrique').show();
				}
				else
				{
					$('#annonce_rubriqueId').html('');
					
					alert('Aucune rubrique n\'est associée avec cette catégorie.');
					return false;
				}
			});
		}
	});

	//Changement de rubrique
	$("#annonce_rubriqueId").change(function(){
		var idRubrique = $(this).val();				
		
		var zRubrique	= $('#annonce_rubriqueId option:selected').text();		
		var zFilAriane = '';
		//alert(zRubrique);
		//Recalcule la file d'ariane
		//alert(zCategorie);
		//alert(zRubrique);

		zFilAriane  	+= '<ul class="cat_breadcrumbs">';
		zFilAriane 	 	+= '<li><a href="#">'+zCategorie+'</a></li>';
		
		if(idRubrique != "0"){
			//alert(zFilAriane);
			//zRubrique de la forme	' --  -- Minifourgonnettes'
			pre = zRubrique.substr(0, 8);
			
			//alert("pre=" + pre);
			
			if(pre == ' --  -- '){
				//Rubrique intérmédiaire
				pos = 0;
				for(i=0; i<c_rubrique.length; i++){
					if(c_rubrique[i] == zRubrique){
						pos = i;
					} 
				}
				
				//alert(pos);				
				pos_int = 0;
				for(i=pos; i>=0; i--){
					pre_ = c_rubrique[i].substr(0, 8);
					if(pre_ != ' --  -- '){
						pos_int = i;
						break;
					} 
				}
				//alert(pos_int);

				zRubrique_ = c_rubrique[pos_int].replace(' -- ', '');
				zFilAriane 	 	+= '<li><span>&gt;</span> <a href="#">'+zRubrique_+'</a></li>';			
				//alert(zFilAriane);
			}
			zRubrique = zRubrique.replace(' -- ', '');
			zRubrique = zRubrique.replace(' -- ', '');
			zFilAriane 	 	+= '<li><span>&gt;</span> <a href="#">'+zRubrique+'</a></li>';
		}
		zFilAriane  	+= '</ul>';
		//$('input[@name=an_filAriane]').val(zFilAriane);		
		//$('#an_filAriane').val(zFilAriane);		
		
		$('#cat_breadcrumbs').html('');
		$('#cat_breadcrumbs').html(zFilAriane);
		
	});		
	
	//Changement de action
	$("#annonce_action").change(function(){
		var idAction = $(this).val();				
		
		var zAction	= $('#annonce_action option:selected').text();		
		var zHtmlOrigine  = '';

		switch(idAction) {
			case "1":
				zAction = "<strong>OFFRE</strong>";
				break;
			case "2":
				zAction = "<strong>DEMANDE</strong>";
				break;
			case "3":
				zAction = "<strong>A ACHETER</strong>";
				break;
			case "4":
				zAction = "<strong>A RECHERCHER</strong>";
				break;
			case "5":
				zAction = "<strong>A LOUER</strong>";
				break;
			case "6":
				zAction = "<strong>A VENDRE</strong>";
				break;
			case "7":
				zAction = "<strong>A ECHANGER</strong>";
				break;
			case "8":
				zAction = "<strong>RENCONTRE</strong>";
				break;
			default:
				zAction = "<strong>A ECHANGER</strong>";
				break;
		}
		
		zHtmlOrigine   = '';
		zHtmlOrigine  += '<ul>';
		zHtmlOrigine  += '	<li>' + zAction + '</li>';
		zHtmlOrigine  += '</ul>';

		$('#view_action').html('');
		$('#view_action').html(zHtmlOrigine);		
		//$('#an_actionId').val(idAction);		
	});		

	//Changement de offre
	$("#annonce_offreId").change(function(){
		var idOffre = $(this).val();				
		
		var zOffre	= $('#annonce_offreId option:selected').text();		
		var zHtmlOrigine  = '';
		
		zHtmlOrigine   = '';
		zHtmlOrigine  += '<ul>';
		zHtmlOrigine  += '	<li class="ref">Annonce r&eacute;f. an0000000</li>';
		zHtmlOrigine  += '	<li>Offre ' + zOffre + '</li>';
		zHtmlOrigine  += '	<li class="date">Parue depuis aujourd\'hui</li>';
		zHtmlOrigine  += '</ul>';

		$('#view_offre').html('');
		$('#view_offre').html(zHtmlOrigine);
		//$('#an_offreId').val(idOffre);
	});		

		//Changement de province
	$("#provinceId").change(function(){
		var idProvince = $(this).val();	
		
		//zProvince	= $('select[@name=provinceAnId] option:selected').text();		
		zProvince	= $('#provinceId option:selected').text();		

		if(idProvince != 0)	
		{
			$.getJSON(j_basepath + "index.php",{module:"annonce", action:"annonceFo_chargeSelectLocalite", idProvince:idProvince}, function(datas){
																																				
				if(datas != '' && datas['toLocalite'] != 0)
				{
					$('#annonce_localiteId').html('');
					var html = '<option value="0">Localit&eacute;:</option>';
					
					for(i=0; i< datas['toLocalite'].length; i++)
					{						
						html += '<option value="' + datas["toLocalite"][i]["localite_id"] +'">' + datas["toLocalite"][i]["localite_code"] + ' ' + datas["toLocalite"][i]["localite_libelle"] + '</option>';
					}

					$('#annonce_localiteId').append(html);
					$('#annonce_localiteId').val(0);
					
					//$('#divLocalite').show();
				}
				else
				{
					$('#annonce_localiteId').html('');
					
					alert('Aucune localité n\'est associée avec ce province.');
					return false;
				}
			});
		}
	});

	//Changement de province
	$("#annonce_localiteId").change(function(){
		var idLocalite = $(this).val();	
		var zLocalite	= $('#annonce_localiteId option:selected').text();		

		var html   = '';
		
		html  += zProvince + ' <span class="date">' + zLocalite + '</span>';

		$('#view_lieu').html('');
		$('#view_lieu').html(html);		
		//$('#an_localiteId').val(idLocalite);		
	});

	//Changement de prix
	$("#annonce_prix").change(function(){
		var zPrix = ($(this).val()!="")?$(this).val():"N/D";	
		
		$('#view_prix').html('');
		$('#view_prix').html(zPrix + ' Ariary');		
		//$('#an_prix').val(zPrix);						
	});	

	//Changement de prixInfo
	$("#annonce_prixInfo").change(function(){
		var zPrixInfo = ($(this).val()!="")?$(this).val():"";	
		
		$('#view_prixInfo').html('');
		$('#view_prixInfo').html(zPrixInfo);		
	});	
	
	//Changement de annee
	$("#annonce_annee").change(function(){
		var zAnnee = ($(this).val()!="")?$(this).val():"N/D";	

		$('#view_annee').html('');
		$('#view_annee').html(zAnnee);		
		//$('#an_annee').val(zAnnee);						
	});	

	//Changement de etat
	$("#annonce_etat").change(function(){
		var idEtat = $(this).val();	
		var zEtat	= $('#annonce_etat option:selected').text();		
		var zEtat = (idEtat != "0")? zEtat : "S/O";	

		var html   = '';
		
		html  += ' <span class="date">' + zEtat + '</span>';

		$('#view_etat').html('');
		$('#view_etat').html(html);		
		//$('#an_etat').val(idEtat);		
	});

	//Changement de resume
	$("#annonce_resume").change(function(){
		var zResume = $(this).val();	

		$('#view_resume').html('');
		$('#view_resume').html('<h4>R&eacute;sum&eacute;</h4>' + zResume + '<br><br>');		
		//$('#an_resume').val(zResume);						
	});	

	//Changement de description
	$("#annonce_description").change(function(){
		var zDescription = $(this).val();	

		$('#view_description').html('');
		$('#view_description').html('<h4>Description g&eacute;n&eacute;rale</h4>' + zDescription + '<br><br>');		
		//$('#an_description').val(zDescription);						
	});	


	//Valider le formulaire d edition d'une annonce
	$(".formButton_valid").click(function(){

		if (!tmt_validateForm(document.annonceForm)) {
			return false;			
		}
		else{
			//Traitement du formulaire  d'annonce
			$('#errorMessage').html('');
			
			var options = {
				 type:"POST",
				 url:j_basepath+'index.php?module=annonce&action=annonceFo_sauvegardeAnnonce',
				 success: function(msg) {
					var message = "";				
					var id = $('#annonce_id').val();	
					
					if(id == 0){
						var data = $(msg).text();
						var obj = eval('(' + data + ')');				
					}else{
						var obj = eval('(' + msg + ')');					
					}
				
					//alert(obj.statut);				
					//alert(obj.statut);

					if (obj.statut > 0){
						$('#errorMessage').html('');
						var aid = $('#annonce_abonnementId').val();	
						document.location.href="index.php?aid=" + aid + "&module=annonce&action=annonceFo_annonceList";						
					}else{
						//affiche erreur	
						//alert("Affiche une erreur");
						message = "Vos données comportent des erreurs.";
						
						if(message != ""){
							$('#errorMessage').html('');
							$('#errorMessage').html('<img border="0" src="'+j_basepath+'design/front/images/v5/icon_error.gif" />&nbsp;'+message+'');
						}					
					}
				}
			};
			$('#annonceForm').ajaxSubmit(options);			
				
		}										  			
	});		
	
	/**************************************************************************************/
	/*----------------------------- TRAITEMENT D'IMAGE -----------------------------------*/
	/**************************************************************************************/
	
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
			//$('#view_pop_up').removeClass("hidden_elem");
			//show_picturePopup = 1;
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
		//ID de la photo, pour supprimer la photo
		photo_id 		= $('#picture_id').val();
		photo_photo 	= $('#picture_photo').val();
		
		//alert("Suppression dela photo "+ photo_profilPhoto +" pour le membre : " + photo_id);

		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=annonce&action=annonceFo_removePhoto&photo_id="+photo_id+"&photo_photo="+photo_photo,
			 dataType:"json",
			 async:false,
			 success:function(resultat){														 	
				$("#profile_pic").attr("src",""+j_basepath+"resize/annonce/images/popup/noPhoto.jpg");
				$("#profile_pic_popup").attr("src",""+j_basepath+"resize/annonce/images/popup/noPhoto.jpg");				
				//$("#imgthumb"+photo_id).attr("src",""+j_basepath+"resize/annonce/images/abrege/noPhoto.jpg");				
				$("#linkthumb"+photo_id).attr("href","javascript:voirImg('noPhoto.jpg', "+photo_id+");");					
				
				$("#linkthumb"+photo_id).html("");
				zHtml = '<img width="90" height="68" border="0" src="/resize/annonce/images/abrege/noPhoto.jpg" alt="noPhoto.jpg" name="imgthumb' + photo_id + '" id="imgthumb' + photo_id + '" onmouseover="voirImg(\'noPhoto.jpg\', ' + photo_id + ');">';
				$("#linkthumb"+photo_id).append(zHtml);
				
				
				//$("#imgthumb"+photo_id).removeAttr("onmouseover");					
				//$("#imgthumb"+photo_id).attr("onmouseover","voirImg('noPhoto.jpg', " + photo_id + ");");					
				$('#photo_photo').val('');
			}
		});

	});

	$("#user_photo").change(function(){
			
		//Traitement de la photo	
		var options = {
			 type:"POST",
			 url:j_basepath+'index.php?module=annonce&action=annonceFo_changePhoto',
			 success: function(msg) {
				// 'data' is an object representing the the evaluated json data
				//Change la photo de profil sur place
				var data 		= $(msg).text();
				var obj 		= eval('(' + data + ')');
				var photo_id 	= $('#picture_id').val();
				var src			= obj.imgSrc;
				
				//var obj = eval('(' + "{'MSRP': 20000,'cashDown': 2000,'tradeIn': 1000}" + ')');

				$("#profile_pic").attr("src",""+j_basepath+"resize/annonce/images/popup/" + src);
				$("#profile_pic_popup").attr("src",""+j_basepath+"resize/annonce/images/popup/" + src);				
				$("#linkthumb"+photo_id).attr("href","javascript:voirImg('" + src + "', " + photo_id + ");");					

				//$("#imgthumb"+photo_id).attr("src",""+j_basepath+"resize/annonce/images/abrege/" + src);				
				//$("#imgthumb"+photo_id).attr("onmouseover","voirImg('" + src + "', " + photo_id + ");");					
				
				$("#linkthumb"+photo_id).html("");
				zHtml = '<img width="90" height="68" border="0" src="/resize/annonce/images/abrege/' + src + '" alt="' + src + '" name="imgthumb' + photo_id + '" id="imgthumb' + photo_id + '" onmouseover="voirImg(\'' + src + '\', ' + photo_id + ');">';
				$("#linkthumb"+photo_id).append(zHtml);

				$('#user_photo').val('');
				//Hidden
				$('#picture_photo').val(src);

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
	});
	
	$("#formButton_annuler").click(function(){
		//Ferme le popup
		if(show_genericDlgPopup == 1){
			$('#generic_dialog_popup').addClass("hidden_elem");
			show_genericDlgPopup = 0;
		}
	});
	
	/*-------------------------------------------------------------*/
	//Changement de marque
	$("#vehicule_marqueId").change(function(){
		var idMarque = $(this).val();	
		
		zMarque	= $('#vehicule_marqueId option:selected').text();		

		if(idMarque != 0)	
		{
			$.getJSON(j_basepath + "index.php",{module:"modele", action:"modeleFo_chargeSelectModele", idMarque:idMarque}, function(datas){
																																				
				if(datas != '' && datas['toModele'] != 0)
				{
					//contenant tt les modeles
					c_modele  	= new Array();
					
					$('#vehicule_modeleId').html('');
					var html = '<option value="0">Mod&egrave;le :</option>';
					
					for(i=0; i< datas['toModele'].length; i++)
					{						
						var indent = "";
						for (id=0; id<datas["toModele"][i]["modele_level"]; id++){
							indent += " -- ";	
						}					
						//if(datas["toModele"][i]["modele_id"] != idModele){
							html += '<option value="' + datas["toModele"][i]["modele_id"] +'">' + indent + datas["toModele"][i]["modele_libelle"] + '</option>';
						//}
						c_modele[i] = indent + datas["toModele"][i]["modele_libelle"];
					}

					$('#vehicule_modeleId').append(html);
					$('#vehicule_modeleId').val(0);
					
					//$('#divModele').show();
				}
				else
				{
					$('#vehicule_modeleId').html('');
					
					alert('Aucun modele n\'est associé avec cette marque.');
					return false;
				}
			});
		}
	});

	
	
});