// JavaScript Document
var g_supprvisuel 	= 1;
var c_rubrique  	= new Array();
var zProvince  = "";

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
	$("#profile_pic").attr("src",""+j_basepath+"resize/annonce/images/popup/" + imgSrc);
	$("#picture_id").val(id);
	$("#photo_id").val(id);
	$("#picture_photo").val(imgSrc);
}

jQuery(document).ready(function() {
								
	zProvince  = $('#province option:selected').text();

		//Changement de province
	$("#province").change(function(){
		var idProvince = $(this).val();	
				
		//zProvince	= $('select[@name=provinceAnId] option:selected').text();		
		zProvince	= $('#province option:selected').text();		

		if(idProvince != 0)	
		{
			$.getJSON(j_basepath + "index.php",{module:"annonce", action:"annonceFo_chargeSelectLocalite", idProvince:idProvince}, function(datas){
																																				
				if(datas != '' && datas['toLocalite'] != 0)
				{
					$('#localite').html('');
					var html = '<option value="0">Localit&eacute;:</option>';
					
					for(i=0; i< datas['toLocalite'].length; i++)
					{						
						html += '<option value="' + datas["toLocalite"][i]["localite_id"] +'">' + datas["toLocalite"][i]["localite_code"] + ' ' + datas["toLocalite"][i]["localite_libelle"] + '</option>';
					}

					$('#localite').append(html);
					$('#localite').val(0);
					
					//$('#divLocalite').show();
				}
				else
				{
					$('#localite').html('');
					
					alert('Aucune localité n\'est associée avec ce province.');
					return false;
				}
			});
		}
	});

	//Valider le formulaire d edition d'une annonce
	$(".formButton_valid").click(function(){

		if (!tmt_validateForm(document.annonceForm)) {
			return false;			
		}
		else{
			//Traitement du formulaire  d'annonce
			$('#errorMessage').html('');
			//Récupères les données
			var cid 		= 0;
			var rid 		= 0;
			var mot 		= $('#mot').val();
			var crid 		= ($('#crid').val() == null)? 0 : $('#crid').val();
			var parution 	= $('#parution').val();
			var province 	= $('#province').val();
			var localite 	= $('#localite').val();
			var affichage 	= $('#affichage').val();

			var prix1 	= $('#prix1').val();
			var prix2 	= $('#prix2').val();



			if(affichage == '1'){
				affichage = "detail";
			}else if(affichage == '2'){
				affichage = "abrege";
			}else if(affichage == '3'){
				affichage = "photo";
			}else{
				affichage = "abrege";
			}
			
			//alert("index.php?affichage="+affichage+"&cid="+cid+"&rid="+rid+"&mot="+mot+"&crid="+crid+"&parution="+parution+"&localite="+localite+"&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList");			
			document.location.href="index.php?affichage="+affichage+"&cid="+cid+"&rid="+rid+"&mot="+mot+"&crid="+crid+"&parution="+parution+"&province="+province+"&localite="+localite+"&prix1="+prix1+"&prix2="+prix2+"&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList";
									
		}		
		
	});		
	
});