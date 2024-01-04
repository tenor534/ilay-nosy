function checkCorporate(obj)
{
	
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var corporate_id = ch_name.substring("corporate_Publier_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"corporate", action:"corporateBo_updateCorporate", idCorporate:corporate_id, publier:$(obj).val(), cible:0});
	
	return true;
	
}

function checkRightCorporate(obj)
{
	
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var corporate_id = ch_name.substring("corporate_PublierRight_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"corporate", action:"corporateBo_updateCorporate", idCorporate:corporate_id, publier:$(obj).val(),cible:1});
	
	return true;
	
}

function upDown(id,ordre) {
		hOrdre = ordre - 1;
		bOrdre =  ordre + 1;
		$.getJSON("index.php?module=corporate&action=corporateBo_gereOrdre",{corporate_id:id,corporate_ordre:ordre},			
		function(data){				
			$('#affichage_'+id).html(data[0].newOrder);
			down = '<img src="design/back/images/arrow_down.gif" border="0" title="Down" style="cursor:pointer;" onclick="upDown('+id+','+bOrdre+');"/>';
			up = '<img src="design/back/images/arrow_up.gif" border="0" title="Up" style="cursor:pointer;" onclick="upDown('+id+','+hOrdre+');"/>';			
			if(data[0].newOrder==1)
				$('#td_'+id).html(down);
			else
				$('#td_'+id).html(down+'&nbsp;'+up);
		
	});
}
