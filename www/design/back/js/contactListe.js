$(document).ready(function() {
	/* Utilisé pour afficher liste contact par marque */
	$('[@name=idMarque]').change(function(){
		var idMarque = $(this).val();
		if(idMarque != 0)	
		{
			$('[@name=selMarque]').submit();
		}
	});
});

function checkContact(obj)
{
	
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var contact_id = ch_name.substring("contactPublier_".length + 1, ch_name.length);
	//alert('Regardez dans www\design\back\js\contactListe.js : contact ID='+contact_id+' value='+$(obj).val());
	//alert(j_basepath); // donne /jelix/sillbrands/www/
	//alert($(obj).val());
	$.getJSON(j_basepath + "index.php",{module:"contact", action:"contactBo_updateContact", idContact:contact_id, publier:$(obj).val()});
	
	return true;
	
}

function upDown(id,mrq_id,ordre) {
		hOrdre = ordre - 1;
		bOrdre =  ordre + 1;
		$.getJSON("index.php?module=contact&action=contactBo_gereOrdre",{contact_id:id,marque_id:mrq_id,contact_ordre:ordre},			
		function(data){				
			$('#affichage_'+id).html(data[0].newOrder);
			down = '<img src="design/back/images/arrow_down.gif" border="0" title="Down" style="cursor:pointer;" onclick="upDown('+id+','+mrq_id+','+bOrdre+');"/>';
			up = '<img src="design/back/images/arrow_up.gif" border="0" title="Up" style="cursor:pointer;" onclick="upDown('+id+','+mrq_id+','+hOrdre+');"/>';			
			if(data[0].newOrder==1)
				$('#td_'+id).html(down);
			else
				$('#td_'+id).html(down+'&nbsp;'+up);
		
	});
}
