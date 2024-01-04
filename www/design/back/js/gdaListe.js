$(document).ready(function() {
/*
	$('[@type=checkbox]').click(function(){
//		alert(this.name);
		if(this.checked)		
			$(this).val(1);
		else
			$(this).val(0);

		var ch_name = this.name;
		var gda_id = ch_name.substring("gdaPublier_".length, ch_name.length);
		$.getJSON(j_basepath + "index.php",{module:"gda", action:"gdaBo_updateGda", idGda:gda_id, publier:$(this).val()}, function(){
		});

	});
*/
	$('#idPays').change(function(){
		var idPays = $(this).val();
		if(idPays != 0)	
		{
			$('[@name=selPays]').submit();
		}	
	});

	$('#idMarque').change(function(){
		var idMarque = $(this).val();
		if(idMarque != 0)
		{
			$('[@name=selMarque]').submit();
		}
	});
});

function checkGda(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var gda_id = ch_name.substring("gdaPublier_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"gda", action:"gdaBo_updateGda", idGda:gda_id, publier:$(obj).val()}, function(){
	});
	return true;
}
