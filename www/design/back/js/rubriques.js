// JavaScript Document
tmt_globalPatterns.chiffreLet = new RegExp("[.,<>0-9]");
jQuery(document).ready(function() {
								
	tmt_globalRules.minimumSelected = function(fieldNode){
		
		if(parseInt(fieldNode.options.length) < fieldNode.getAttribute("tmt:minimumSelected")){
			return false;
		}
		return true;
	}
	
	var idCategorieAnId = $('#rubrique_categorieAnId').val();
	var idRubrique 		= $('#rubrique_id').val();
	
	if(idCategorieAnId != 0 && idCategorieAnId != '')
	{
		$('#divRubrique').show();
	}

	$('#rubrique_categorieAnId').change(function(){
		var idCategorieAnId = $(this).val();
		if(idCategorieAnId != 0)	
		{
			$.getJSON(j_basepath + "index.php",{module:"rubrique", action:"rubriqueBo_showRubrique", idCategorieAnId:idCategorieAnId}, function(datas){
				if(datas != '' && datas['toRubrique'] != 0)
				{
					$('#rubrique_parentId').html('');
					var html = '<option value="0">Racine</option>';
					
					for(i=0; i< datas['toRubrique'].length; i++)
					{						
						var indent = "";
						for (id=0; id<datas["toRubrique"][i]["rubrique_level"]; id++){
							indent += " - ";	
						}
					
						if(datas["toRubrique"][i]["rubrique_id"] != idRubrique){
							html += '<option value="' + datas["toRubrique"][i]["rubrique_id"] +'">' + indent + datas["toRubrique"][i]["rubrique_libelle"] + '</option>';
						}
					}
					$('#rubrique_parentId').append(html);
					$('#rubrique_parentId').val(0);
					$('#divRubrique').show();
				}
				else
				{
					alert('Aucune rubrique n\'est associée à cette catégorie d\'annonce.');

					$('#rubrique_parentId').html('');
					var html = '<option value="0">Racine</option>';
					$('#rubrique_parentId').append(html);
					$('#rubrique_parentId').val(0);
					$('#divRubrique').show();

					return false;
				}
			});
		}
	});
});