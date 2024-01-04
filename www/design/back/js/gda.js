tmt_globalPatterns.chiffreLet = new RegExp("[.,<>0-9]");
jQuery(document).ready(function() {
	tmt_globalRules.minimumSelected = function(fieldNode){
		if(parseInt(fieldNode.options.length) < fieldNode.getAttribute("tmt:minimumSelected")){
			return false;
		}
		return true;
	}
	
	var iMarque = $('[@name=idMarque]').val();
	if(iMarque != 0 && iMarque != '')
	{
		$('#divBoisson').show();
		$('#divFormat').show();
		$('#divgda').show();
	}
	
	$('[@type=checkbox]').click(function(){
		if(this.checked)		
			$(this).val(1);
		else
			$(this).val(0);
	});

	$('[@name=idMarque]').change(function(){
		var idMarque = $(this).val();
		if(idMarque != 0)	
		{
			$.getJSON(j_basepath + "index.php",{module:"gda", action:"gdaBo_editeBoisson", idMarque:idMarque}, function(datas){
				if(datas != '' && datas['toBoisson'] != 0)
				{
					$('#idBoisson').html('');
					var html = '<option value="0">select</option>';
					for(i=0; i< datas['toBoisson'].length; i++)
					{
						html += '<option value="' + datas["toBoisson"][i]["boisson_id"]+'">' + datas["toBoisson"][i]["boisson_nom"] + '</option>';
					}
					$('#idBoisson').append(html);
					$('#idBoisson').val(0);
					
					$('#divBoisson').show();
				}
				else
				{
					alert('No flavour associated with this brand.');
					return false;
				}
			});
		}
	});

	//chargement du departement correspondant a la region selectionn√©e (ONCHANGE)
	jQuery('#region').change(function(){
		
		$('#departement').removeOption(/./);
		$('#departement').addOption(0,'--DÈpartement--',false);
		iRegionId = $(this).val();
		
		$.getJSON(j_basepath+'index.php?module=contact&action=contactFo_chargeListeDepartements',{region:iRegionId},function(toDepartements){
			
			var select = $('#departement');
			
			$(select).each(function(){
				var o = this.options;
				var oL = o.length;
				
				for (department_id in toDepartements){
					//alert(toDepartements[department_id].departement_nom);
					$('#departement').addOption(toDepartements[department_id].departement_id,toDepartements[department_id].departement_nom ,false);
					//$('#departement').addOption(toDepartements[department_id].departement_id,toDepartements[department_id].departement_nom ,false);
					//$('#departement').val(toDepartements[department_id].department_id);
					
				}
			});
			
		});
	});

	$('[@name=idBoisson]').change(function(){
		var idBoisson = $(this).val();
		if(idBoisson !=0)
		{
			$.getJSON(j_basepath + "index.php",{module:"gda", action:"gdaBo_editeFormat", idBoisson:idBoisson}, function(datas){
				if(datas != '' && datas['toFormat'] != 0)
				{
					$('#idFormat').html('');
					var html = '<option value="0">select</option>';
					for(i=0; i< datas['toFormat'].length; i++)
					{
						html += '<option value="' + datas["toFormat"][i]["formatBoisson_id"]+'">' + datas["toFormat"][i]["format_nom"] + '</option>';
					}
					$('#idFormat').append(html);
					$('#idFormat').val(0);
					$('#divFormat').show();
					$('#divgda').show();
				}
				else
				{
					alert('No format associated with this flavour.');
				}
			});
		}
	});
	$("#idPays1").multiSelect("#idPays2", {trigger: "#add", afterMove:moveLeft });
	$("#idPays2").multiSelect("#idPays1", {trigger: "#rem", afterMove:moveRight});

});
function moveLeft () {
	$("#fun_idPays1").funMultiSelect ("#fun_idPays2");
	
	$('#idPays2').sortOptions();
	codeAs='';
	$('#idPays2').find('option').each(function(index){
		if($(this).val()!= null){
			codeAs+=$(this).val();
			if(index<$('#idPays2 option').length-1){
				codeAs+=',';
			}
		}
	});
	
	$('#listeSelect').val(codeAs);
	
	
	return true;
}

function moveRight () {
	$("#fun_idPays2").funMultiSelect ("#fun_idPays1");
	$('#idPays1').sortOptions();
	codeAs='';
	$('#idPays2').find('option').each(function(index){
		if($(this).val()!= null){
			codeAs+=$(this).val();
			if(index<$('#idPays2 option').length-1){
				codeAs+=',';
			}
		}
	});
	
	$('#listeSelect').val(codeAs);
	


	return true;
}
