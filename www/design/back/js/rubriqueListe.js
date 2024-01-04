$(document).ready(function() {
	$('#idMarque').change(function(){
		var idMarque = $(this).val();
		if(idMarque != 0)
		{
			$('[@name=selMarque]').submit();
		}
	});
	$('#idRubrique').change(function(){
		var idRubrique = $(this).val();
		if(idRubrique != 0)
		{
			$('[@name=selRubrique]').submit();
		}
	});
	$('#idSousRubrique').change(function(){
		var idRubrique = $(this).val();
		if(idRubrique != 0)
		{
			$('[@name=selSousRubrique]').submit();
		}
	});
});

function onSupprime(obj, id, level)
{
	var a = $(obj);
	$.getJSON(j_basepath + "index.php",{module:"rubrique", action:"rubriqueBo_testRubriqueFils", idRubrique:id}, function(datas){
		if(parseInt(datas.value, 10) == -1)
		{
			if(confirm("One or more headings are linked to this heading. Are you sure to delete it? "))
			{
				$.getJSON(j_basepath + "index.php",{module:"rubrique", action:"rubriqueBo_testRubrique", idRubrique:id}, function(datas){
					if(parseInt(datas.value, 10) == -1)
					{
						alert("You can't delete this heading because any element are linked in.");
						return false;
					}else{
						window.document.location.href = j_basepath + "index.php?module=rubrique&action=rubriqueBo_supprimeRubrique&idRubrique="+id+"&level="+level;
					}
				});
			}else{
				return false;
			}
		}else{
			if(confirm("Are you sure to delete this heading?"))
			{
				$.getJSON(j_basepath + "index.php",{module:"rubrique", action:"rubriqueBo_testRubrique", idRubrique:id}, function(datas){
					if(parseInt(datas.value, 10) == -1)
					{
						alert("You can't delete this heading because any element are linked in.");
						return false;
					}else{
						window.document.location.href = j_basepath + "index.php?module=rubrique&action=rubriqueBo_supprimeRubrique&idRubrique="+id+"&level="+level;
					}
				});
			}else{
				return false;
			}
		}
	});
	/*
	if(confirm("Are you sure to delete this element?"))
	{
		$.getJSON(j_basepath + "index.php",{module:"rubrique", action:"rubriqueBo_testRubrique", idRubrique:id}, function(datas){
			if(parseInt(datas.value, 10) == -1)
			{
				alert("You can't delete this heading because any element are linked in.");
			}else{
				window.document.location.href = j_basepath + "index.php?module=rubrique&action=rubriqueBo_supprimeRubrique&idRubrique="+id;
			}
		});
		return true;
	}else
	{
		return false;
	}
	*/
}


function checkRubrique(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);

	var ch_name = obj.name;
	var rubrique_id = ch_name.substring("rubriquePublier_".length, ch_name.length);
	$.getJSON(j_basepath + "index.php",{module:"rubrique", action:"rubriqueBo_updateRubrique", idRubrique:rubrique_id, publier:$(obj).val()}, function(){
	});
	return true;
}


