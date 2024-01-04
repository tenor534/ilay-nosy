// JavaScript Document
var g_supprvisuel 	= 1;

//Etat d'affichage des zones

function onCheck(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);
	return true;
}

function voirImg (imgSrc, id){
	$("#profile_pic").attr("src",""+j_basepath+"resize/actualite/images/popup/" + imgSrc);
	$("#picture_id").val(id);
	$("#photo_id").val(id);
	$("#picture_photo").val(imgSrc);
}

jQuery(document).ready(function() {

	//Valider le formulaire d edition d'une actualite
	$(".formButton_valid").click(function(){

		if (!tmt_validateForm(document.actualiteForm)) {
			return false;			
		}
		else{
			//Traitement du formulaire  d'actualite
			$('#errorMessage').html('');
			//Récupères les données
			var cid 		= ($('#cid').val() == null)? 0 : $('#cid').val();
			var mot 		= $('#mot').val();
			var parution 	= $('#parution').val();
			var affichage 	= $('#affichage').val();

			if(affichage == '1'){
				affichage = "detail";
			}else if(affichage == '2'){
				affichage = "abrege";
			}else if(affichage == '3'){
				affichage = "photo";
			}else{
				affichage = "abrege";
			}
			
			document.location.href="index.php?affichage="+affichage+"&cid="+cid+"&mot="+mot+"&parution="+parution+"&page=1&nbPagination=10&sortField=actualite_titre&sortDirection=ASC&module=actualite&action=actualiteFo_actualiteResultList";
									
		}		
		
	});		
	
});