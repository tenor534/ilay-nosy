function openBrWindow(theURL,winName,features) 
{
	pop = window.open(theURL,winName,features);
	var windowX = (screen.width/2)-(600/2);
	pop.moveTo(windowX,0);
	pop.focus();
}

function popupMail()
{
	var zFichier = $("[@name=choose_format]").val();
	var tString = zFichier.split("/");

	var url = $('[@name=urlPopup]').val();
	var tF = tString[0];
	var fN = tString[1];
	var mId = $('[@name=mId]').val();
	var rId = $('[@name=rId]').val();
	var eId = $('[@name=eId]').val();
	url = url + '&tF=' + tF + '&fN='+ fN + '&mId=' + mId + '&rId=' + rId + '&eId=' + eId;
	openBrWindow(url,'','scrollbars=yes,width=615,height=510');
}

function envoiMail(obj)
{
	if(!tmt_validateForm(obj))
	{
		return false;
	}
	var eId = $('[@name=eId]').val();
	var email = $('[@name=email]').val();
	var subject = $('[@name=subject]').val();
	var message = $('[@name=message]').val();
	var zFichier = $("[@name=choose_format]").val();
	var tString = zFichier.split("/");
	var tF = tString[0];
	var fN = tString[1];

	$.ajax({
		type:"post",
		url:j_basepath+"index.php?module=element&action=elementFo_sendMail" ,
		data:"email="+email+"&subject="+subject+"&message="+message+"&tF="+tF+"&fN="+fN+"&eId="+eId,
		success:function(data){
			$('#Schweppes').hide('slow', function(){
				$('#messageRetour').show();
			});
			if (typeof(iTimeoutID) != 'undefined') {
				clearTimeout(iTimeoutID);
			}
			iTimeoutID = setTimeout(function(){
				$('#messageRetour').hide('slow',function(){
					$('#formPopup').find('input[@type=text]').each(function(){
						$(this).val('');
					});
					$('textarea[@name=message]').val('');
					$('#Schweppes').show('slow', function(){
						window.close();				
					});
				});				
			}, 3000, 'JavaScript');
		}
	});
	return false;
}