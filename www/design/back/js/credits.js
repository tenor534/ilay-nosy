// JavaScript Document
tmt_globalPatterns.chiffreLet = new RegExp("[.,<>0-9]");
jQuery(document).ready(function() {
								
	tmt_globalRules.minimumSelected = function(fieldNode){
		
		if(parseInt(fieldNode.options.length) < fieldNode.getAttribute("tmt:minimumSelected")){
			return false;
		}
		return true;
	}
	
	
	$("#generation").click(function(){
		//Le forfait utilisé
		var idForfait 	= $('#credit_forfaitId').val();
		//Code plus ou simple
		var isPlus 		= ($('input[name=credit_isPlus]').is(':checked'))? 1 : 0;

		//Nombre de code à générer
		var nbCode 		= $('#credit_nbCode').val();		
		
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=credit&action=creditBo_generateCredits&idForfait="+idForfait+"&isPlus="+isPlus+"&nbCode="+nbCode,
			 dataType:"json",
			 async:false,
			 success:function(datas){														 	


				if(datas != '' && datas['toCredit'] != 0)
				{
					var html = '';

					$('#createdCode').html('');
					for(i=0; i< datas['toCredit'].length; i++)
					{
						html += '<tr class="row{$i++%2+1}">'; 
						html += '<td width="20%" class="color2 _center">' + datas["toCredit"][i]["id"] + '</td>';
						html += '<td width="20%" class="color2 _center">' + datas["toCredit"][i]["codePIN"] + '</td>';
						html += '<td width="20%" class="color2 _center">' + datas["toCredit"][i]["password"] + '</td>';
						html += '<td width="20%" class="color2 _center">' + datas["toCredit"][i]["montant"] + '</td>';
						html += '</tr>';
					}
					$('#createdCode').append(html);
				}
				else
				{
						var html = '';
						$('#createdCode').html('');
						html += '<tr class="row{$i++%2+1}">'; 
						html += '<td width="20%" class="color2 _center">n&eacute;ant</td>';
						html += '<td width="20%" class="color2 _center">n&eacute;ant</td>';
						html += '<td width="20%" class="color2 _center">n&eacute;ant</td>';
						html += '<td width="20%" class="color2 _center">n&eacute;ant</td>';
						html += '</tr>';
						$('#createdCode').append(html);
						
					return false;
				}


/*
				$("#profile_pic").attr("src",""+j_basepath+"resize/utilisateur/images/detail/nophoto.jpg");
				$("#profile_pic_popup").attr("src",""+j_basepath+"resize/utilisateur/images/popup/nophoto.jpg");				
				$('#user_photo').val('');
			*/	
				
			}
		});
		

	});
});