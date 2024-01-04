$(document).ready(function() {
/*
	$('[@type=checkbox]').click(function(){
//		alert(this.name);
		if(this.checked)		
			$(this).val(1);
		else
			$(this).val(0);

		var ch_name = this.name;
		var marque_id = ch_name.substring("marquePublier_".length, ch_name.length);
		$.getJSON(j_basepath + "index.php",{module:"marque", action:"marqueBo_updateMarque", idMarque:marque_id, publier:$(this).val()}, function(){
		});

	});
*/
});

function checkMarque(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var marque_id = ch_name.substring("marquePublier_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"marque", action:"marqueBo_updateMarque", idMarque:marque_id, publier:$(obj).val()}, function(){
	});
	return true;
}

function checkMarqueExtranet(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var marque_id = ch_name.substring("marquePublierExtranet_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"marque", action:"marqueBo_updateMarque", idMarque:marque_id, publierExtranet:$(obj).val()}, function(){
	});
	return true;
}
