jQuery(document).ready(function() {		/* cible: selection pays */	$('.selectPays').change(function(){		if (parseInt($(this).val(),10) != 0){			zUrl = j_basepath + 'index.php?eId=2&mId='+$('#mId').val()+'&pId='+$(this).val()+'&module=marque&action=default_index';					} else {			zUrl = j_basepath + 'index.php?eId=1&mId='+$('#mId').val()+'&module=marque&action=default_index';					}		document.location.href = zUrl;	});	/* cible: selection boisson */	$('.selectBoisson').change(function(){		if (parseInt($(this).val(),10) != 0){			zUrl = j_basepath + 'index.php?eId=3&mId='+$('#mId').val()+'&pId='+$('#pId').val()+'&bId='+$(this).val()+'&module=marque&action=default_index';		} else {			zUrl = j_basepath + 'index.php?eId=2&mId='+$('#mId').val()+'&pId='+$('#pId').val()+'&module=marque&action=default_index';		}		document.location.href = zUrl;	});	/* cible: selection format */	$('.selectFormat').change(function(){		if (parseInt($(this).val(),10) != 0){			zUrl = j_basepath + 'index.php?eId=4&mId='+$('#mId').val()+'&pId='+$('#pId').val()+'&bId='+$('#bId').val()+'&fId='+$(this).val()+'&module=marque&action=default_index';		} else {			zUrl = j_basepath + 'index.php?eId=3&mId='+$('#mId').val()+'&pId='+$('#pId').val()+'&bId='+$('#bId').val()+'&module=marque&action=default_index';		}		document.location.href = zUrl;	});	});