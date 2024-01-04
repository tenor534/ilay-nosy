var g_supprvisuel = 1;

function onCheck(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);
	return true;
}


jQuery(document).ready(function() {


	$('[@id=rubrique_marqueId]').change(function(){
		var idMarque = $(this).val();
		var idRubrique = $('#rubrique_id').val();
		if(idMarque != 0)
		{
			$.getJSON(j_basepath + "index.php",{module:"rubrique", action:"rubriqueBo_editeRubrique", idMarque:idMarque, idRubrique:idRubrique}, function(datas)
			{
				if(datas != '' && datas['toRubrique'] != 0)
				{
					$('#rubrique_parentId').html('');
					var html = '<option value="0">select heading parent &nbsp;&nbsp;</option>';
					for(i=0; i< datas['toRubrique'].length; i++)
					{
						html += '<option value="' + datas["toRubrique"][i]["rubrique_id"]+'">' + datas["toRubrique"][i]["rubrique_libelle"] + '</option>';
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
	});	
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