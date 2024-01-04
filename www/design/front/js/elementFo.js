jQuery(document).ready(function() {
	var cf = $("[@name=choose_format]").val();
	$("[@name=cf]").val(cf);
	var tString = cf.split("/");
	$("[@name=tF]").val(tString[0]);
	$("[@name=fN]").val(tString[1]);
});


function selectFormat(obj) {
	var cf = $(obj).val();
	$("[@name=cf]").val(cf);
	var tString = cf.split("/");
	$("[@name=tF]").val(tString[0]);
	$("[@name=fN]").val(tString[1]);
	return true;
}

function saveToDisk()
{
	var zFichier = $("[@name=cf]").val();
	var tString = zFichier.split("/");
	$("[@name=tF]").val(tString[0]);
	$("[@name=fN]").val(tString[1]);

	$("[@name=downloadFichier]").submit();
//	return true;
}