$(document).ready(function() {
/*
	$('[@type=checkbox]').click(function(){
//		alert(this.name);
		if(this.checked)		
			$(this).val(1);
		else
			$(this).val(0);

		var ch_name = this.name;
		var actualite_id = ch_name.substring("actualitePublier_".length, ch_name.length);
		$.getJSON(j_basepath + "index.php",{module:"actualite", action:"actualiteBo_updateActualite", idActualite:actualite_id, publier:$(this).val()}, function(){
		});

	});
*/
});

function checkActualite(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var actualite_id = ch_name.substring("actualitePublier_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"actualite", action:"actualiteBo_updateActualite", idActualite:actualite_id, publier:$(obj).val()}, function(){
	});
	return true;
}

function checkActualiteHome(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var actualite_id = ch_name.substring("actualitePublierHome_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"actualite", action:"actualiteBo_updateActualiteHome", idActualite:actualite_id, publier:$(obj).val()}, function(){
	});
	return true;
}
function checkActualiteUne(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var actualite_id = ch_name.substring("actualiteLaUne_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"actualite", action:"actualiteBo_updateActualiteUne", idActualite:actualite_id, publier:$(obj).val()}, function(){
	});
	return true;
}
