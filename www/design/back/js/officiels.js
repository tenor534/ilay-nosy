tmt_globalPatterns.hexa = new RegExp("[a-fA-F0-9]");

var g_supprvisuel=1;
var ServerPath;
var champs;

//Etat d'affichage des zones
var show_editPicture 		= 0;
var show_pictureFlyout 		= 0;
var show_genericDlgPopup	= 0;
var show_picturePopup		= 0;
var can_displayPopup		= 1;

function voirImg (imgSrc, id){
	$("#profile_pic").attr("src",""+j_basepath+"resize/officiel/images/popup/" + imgSrc);
	$("#picture_id").val(id);
	$("#photo_id").val(id);
	$("#picture_photo").val(imgSrc);
}

window.onbeforeunload = function(e){

	if((g_supprvisuel && $('#officiel_id').val()=="") || ($('input[@name^=fichierasuppr_b]').length>0)){
		suppr='';
		$('input[@name^=fichierasuppr_b]').each(function(index){
			if($(this).val().length>0){
				if($(this).val().toLowerCase()!=$('#officiel_photo').val().toLowerCase())
					suppr+=$(this).val();
					if(index<$('input[@name^=fichierasuppr_b]').length-1)
						suppr+=';';
			}
		});
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=officiel&action=officielBo_traitementVisuels&fl=p&process=suppr&fichier="+suppr,
			 dataType:"json",
			 async:false
		});
	}

};

jQuery(document).ready(function() {
	/*$('[@type=checkbox]').click(function(){
//		alert(this.name);
		if(this.checked)		
			$(this).val(1);
		else
			$(this).val(0);
	});*/

	if($('#officiel_photo').val()!=""){
		extension=$('#officiel_photo').val().split(['.']);
		switch(extension[extension.length-1].toLowerCase()){
			case 'swf':
				if($('.clearfix').length>1)
				$('.clearfix').gt(0).hide();
				break;
			default:
				$('.clearfix').each(function(){
					$(this).css('display','block');
				});
				break;
		}
		form=document.getElementById('officielForm');
		form.tmt_validator = new tmt_formValidator(form);
	}
	$('#champsvisuel').bind("focus",function() {
													
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=officiel&action=officielBo_traitementVisuels&fl=p&process=resize&fichier="+$(this).val(),
			 dataType:"json",
			 async:false,
			 success:function(resultat){
				$('#appercuPhoto').empty();
				$('#appercuPhoto').html(resultat.visuel);
				$('#auxvisuel').val(j_basepath+j_officiel_resize + 'photos/' +  resultat.image);
				extension=resultat.image.split(['.']);
				switch(extension[extension.length-1].toLowerCase()){
					case 'swf':
						if($('.clearfix').length>1)
						$('.clearfix').gt(0).hide();
						//$('#officiel_url').removeAttr('tmt:required');
						break;
					default:
						$('.clearfix').each(function(){
							$(this).css('display','block');
						});
						break;
				}				

				//$('#officiel_photo').val(resultat.image);
				if($('#auxvisuel').val().length>0)
					$('#officiel_photo').val($('#auxvisuel').val());

				input_h=document.createElement('input');
				input_h.type='hidden';
				$(input_h).attr({'name':'fichierasuppr_'+$('input[@name^=fichierasuppr_]').length,'value':j_basepath + j_officiel_resize + 'photos/'  + resultat.image});
				$('#officielForm').append($(input_h));
				form=document.getElementById('officielForm');
				form.tmt_validator = new tmt_formValidator(form);
			 }
		});
	});

	$('.clearfix').find('.bouton').bind('click', clickAction);
	
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
			 data:"module=officiel&action=officielBo_removePhoto&photo_id="+photo_id+"&photo_photo="+photo_photo,
			 dataType:"json",
			 async:false,
			 success:function(resultat){														 	
				$("#profile_pic").attr("src",""+j_basepath+"resize/officiel/images/popup/noPhoto.jpg");
				$("#profile_pic_popup").attr("src",""+j_basepath+"resize/officiel/images/popup/noPhoto.jpg");				
				//$("#imgthumb"+photo_id).attr("src",""+j_basepath+"resize/officiel/images/abrege/noPhoto.jpg");				
				$("#linkthumb"+photo_id).attr("href","javascript:voirImg('noPhoto.jpg', "+photo_id+");");					
				
				$("#linkthumb"+photo_id).html("");
				zHtml = '<img width="90" height="68" border="0" src="/resize/officiel/images/abrege/noPhoto.jpg" alt="noPhoto.jpg" name="imgthumb' + photo_id + '" id="imgthumb' + photo_id + '" onmouseover="voirImg(\'noPhoto.jpg\', ' + photo_id + ');">';
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
			 url:j_basepath+'index.php?module=officiel&action=officielBo_changePhoto',
			 success: function(msg) {
				// 'data' is an object representing the the evaluated json data
				//Change la photo de profil sur place
				var data 		= $(msg).text();
				var obj 		= eval('(' + data + ')');
				var photo_id 	= $('#picture_id').val();
				var src			= obj.imgSrc;

				$("#profile_pic").attr("src",""+j_basepath+"resize/officiel/images/popup/" + src);
				$("#profile_pic_popup").attr("src",""+j_basepath+"resize/officiel/images/popup/" + src);				
				$("#linkthumb"+photo_id).attr("href","javascript:voirImg('" + src + "', " + photo_id + ");");					

				//$("#imgthumb"+photo_id).attr("src",""+j_basepath+"resize/officiel/images/abrege/" + src);				
				//$("#imgthumb"+photo_id).attr("onmouseover","voirImg('" + src + "', " + photo_id + ");");					
				
				$("#linkthumb"+photo_id).html("");
				zHtml = '<img width="90" height="68" border="0" src="'+j_basepath+'resize/officiel/images/abrege/' + src + '" alt="' + src + '" name="imgthumb' + photo_id + '" id="imgthumb' + photo_id + '" onmouseover="voirImg(\'' + src + '\', ' + photo_id + ');">';
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
	
});

function clickAction(obj){
	var id = $($(obj).get(0).target).attr('id');
	$('#champsvisuel').removeClass('invalid');
	$('#errorMessage').html('');

	if(id == 'photo')
	{
		ServerPath = j_basepath + j_officiel_medias + 'photos/';
		champs = 'champsvisuel';
	}
	if(id == 'fichier')
	{
		ServerPath = j_basepath + j_officiel_medias + 'fichiers/';
		champs = 'champs_fichier';
	}
	browser();
}

function browser()
{
//	ServerPath = j_basepath + j_logo_medias;

	url=j_basepath + 'FCKeditor/editor/filemanager/browser/default/browser.html?externe=yes&champs=' + champs + '&ServerPath='+ServerPath+'&CurrentFolder=/&Connector=connectors/php/connector.php';

	var iLeft = (screen.width  - screen.width * 0.7) / 2 ;
	var iTop  = (screen.height - screen.height * 0.7) / 2 ;

	var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes" ;
	sOptions += ",width=" + screen.width * 0.7 ;
	sOptions += ",height=" + screen.height * 0.7 ;
	sOptions += ",left=" + iLeft ;
	sOptions += ",top=" + iTop ;

	window.open( url, "BrowseWindow", sOptions ) ;
}

function submitForm(form){
	g_supprvisuel=0;
	if(tmt_validateForm(form)){
		if($('#auxvisuel').val().length>0)
			$('#officiel_photo').val($('#auxvisuel').val());

		return true;
	}else{
		g_supprvisuel=1;
		return false;
	}
}