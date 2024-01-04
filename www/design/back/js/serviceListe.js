function checkService(obj)
{
	
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var service_id = ch_name.substring("servicePublier_".length + 1, ch_name.length);
	//alert('Regardez dans www\design\back\js\serviceListe.js : service ID='+service_id+' value='+$(obj).val());
	//alert(j_basepath); // donne /jelix/sillbrands/www/
	//alert($(obj).val());
	$.getJSON(j_basepath + "index.php",{module:"service", action:"serviceBo_updateService", idService:service_id, publier:$(obj).val()});
	
	return true;
	
}

function upDown(id,ordre) {
		hOrdre = ordre - 1;
		bOrdre =  ordre + 1;
		$.getJSON("index.php?module=service&action=serviceBo_gereOrdre",{service_id:id,service_ordre:ordre},			
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
