$(document).ready(function() {
	$('#idMarque').change(function(){
		var iMarque = $(this).val();
		if(iMarque != 0)
		{
			$('[@name=formEltMarque]').submit();
		}
	});

	$('#idRubrique').change(function(){
		var iRubrique = $(this).val();
		if(iRubrique != 0)
		{
			$('[@name=formEltRubrique]').submit();
		}
	});
});

function checkElement(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var element_id = ch_name.substring("elementPublier_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"element", action:"elementBo_updateElement", idElement:element_id, publier:$(obj).val()}, function(){
	});
	return true;
}
