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
	$("#profile_pic").attr("src",""+j_basepath+"resize/forum/images/popup/" + imgSrc);
	$("#picture_id").val(id);
	$("#photo_id").val(id);
	$("#picture_photo").val(imgSrc);
}

jQuery(document).ready(function() {

	//Positionnement du currseur sur le forum
	$('#fid').children("option").each(function() {
		if(this.index == 1){									   
			this.selected = true;			
		}
	});			


	//Changement de catégorie
	$("#fid").change(function(){
		var idCategorie  = $(this).val();	
		var indexCurrent = $('#fid option:selected').index();
		
		//var zCategorie	= $('#fid option:selected').text();		
		
		//Déplace automatiquement le curseur sur le premier forum pour la sélection d'une catégorie
		if (idCategorie==0){
			//$('#fid').pos(indexCurrent + 1);
			indexCurrent = indexCurrent + 1;
			$('#fid').children("option").each(function() {
				//alert(this.index + '-' + indexCurrent)									   
				if(this.index == indexCurrent){									   
					this.selected = true;			
				}
			});			
		}
		//alert($('#fid option:selected').index());
	});

	//Valider le formulaire d edition d'une forum
	$(".formButton_valid").click(function(){

		if (!tmt_validateForm(document.forumForm)) {
			return false;			
		}
		else{
			//Traitement du formulaire  d'forum
			$('#errorMessage').html('');
			//Récupères les données
			var fid 		= ($('#fid').val() == null)? 0 : $('#fid').val();
			var mot 		= $('#mot').val();
			var parution 	= $('#parution').val();
			var precision 	= $('#precision').val();

			document.location.href="index.php?precision="+precision+"&fid="+fid+"&mot="+mot+"&parution="+parution+"&page=1&nbPagination=10&sortField=forum_titre&sortDirection=ASC&module=forum&action=forumFo_forumSujetList";
		}		
		
	});		
	
});