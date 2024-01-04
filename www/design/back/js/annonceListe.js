$(document).ready(function() {
/*
	$('[@type=checkbox]').click(function(){
//		alert(this.name);
		if(this.checked)		
			$(this).val(1);
		else
			$(this).val(0);

		var ch_name = this.name;
		var annonce_id = ch_name.substring("annoncePublier_".length, ch_name.length);
		$.getJSON(j_basepath + "index.php",{module:"annonce", action:"annonceBo_updateAnnonce", idAnnonce:annonce_id, publier:$(this).val()}, function(){
		});

	});
*/
});

function checkAnnonce(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var annonce_id = ch_name.substring("annoncePublier_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"annonce", action:"annonceBo_updateAnnonce", idAnnonce:annonce_id, publier:$(obj).val()}, function(){
	});
	return true;
}

function checkAnnonceHome(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var annonce_id = ch_name.substring("annoncePublierHome_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"annonce", action:"annonceBo_updateAnnonceHome", idAnnonce:annonce_id, publier:$(obj).val()}, function(){
	});
	return true;
}
function checkAnnonceUne(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var annonce_id = ch_name.substring("annonceLaUne_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"annonce", action:"annonceBo_updateAnnonceUne", idAnnonce:annonce_id, publier:$(obj).val()}, function(){
	});
	return true;
}
