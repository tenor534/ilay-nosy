$(document).ready(function() {
/*
	$('[@type=checkbox]').click(function(){
//		alert(this.name);
		if(this.checked)		
			$(this).val(1);
		else
			$(this).val(0);

		var ch_name = this.name;
		var page_id = ch_name.substring("pagePublier_".length, ch_name.length);
		$.getJSON(j_basepath + "index.php",{module:"page", action:"pageBo_updatePage", idPage:page_id, publier:$(this).val()}, function(){
		});

	});
*/
});

function checkPage(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var page_id = ch_name.substring("pagePublier_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"page", action:"pageBo_updatePage", idPage:page_id, publier:$(obj).val()}, function(){
	});
	return true;
}