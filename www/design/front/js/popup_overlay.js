// JavaScript Document
// Appel jquery

/* 
	$(document).ready(function() {});
	$(function() {});
*/
var id = "";
$(function() {
		   
	var wwidth = document.documentElement.clientWidth;
	var wheight = document.documentElement.clientHeight;
	
	if( wheight < $(document).height() ) {
		wheight = $(document).height();
	}

	$('.open-popup').click(function() {
									
		var zFichier = $("[@name=tF]").val();
		$('#mask_overlay')
			.css({opacity:'0.6', width: wwidth + 'px', height: wheight + 'px'})
			.show();
		
		if($.browser.msie) {
			$('form').css({visibility: 'visible'});
			//$('form').css({visibility: 'hidden'});
		}
			
		$('.popup').show();
		id = '#' + zFichier.toLowerCase();
		$(id).show();
	});
	
	$('.close-popup').click(function() {
		if(id != "")
			$(id).hide();

		$('#mask_overlay').hide();
		$('.popup').hide();
		
		if($.browser.msie) {
			$('form').css({visibility: 'visible'});
		}
	});

});

function envoiMail(obj)
{
	if(!tmt_validateForm(obj))
	{
		return false;
	}else{
		var eId = $('[@name=eId]').val();
		var email = $('[@name=email]').val();
		var subject = $('[@name=subject]').val();
		var message = $('[@name=message]').val();
		var zFichier = $("[@name=cf]").val();
		var tString = zFichier.split("/");
		var tF = tString[0];
		var fN = tString[1];

		$.ajax({
			type:"post",
			url:j_basepath+"index.php?module=element&action=elementFo_sendMail" ,
			data:"email="+email+"&subject="+subject+"&message="+message+"&tF="+tF+"&fN="+fN+"&eId="+eId,
			success:function(data){
				data = eval('('+data+')');
				if(data.msg == true)
				{
					$('#errorMessage').empty();
					$('#blocRightSend').hide('slow', function(){
						$('#messageRetour').empty();
						$('#messageRetour').append('Your mail are sended with success.');
						$('#messageRetour').show();
					});
					if (typeof(iTimeoutID) != 'undefined') {
						clearTimeout(iTimeoutID);
					}
					iTimeoutID = setTimeout(function(){
						$('#messageRetour').hide('slow',function(){
							$('input[@name=email]').val('enter email adress recipient');
							$('input[@name=subject]').val('subject');
							$('textarea[@name=message]').val('your message here...');
							$('#blocRightSend').show('slow', function(){
								$('#mask_overlay').hide();
								$('.popup').hide();
								if($.browser.msie) {
									$('form').css({visibility: 'visible'});
								}
							});
						});				
					}, 3000, 'JavaScript');
				}else{
					$('#blocRightSend').hide('slow', function(){
						$('#messageRetour').empty();
						$('#messageRetour').append("Your mail aren't sended correctly.");
						$('#messageRetour').show();
					});
					if (typeof(iTimeoutID) != 'undefined') {
						clearTimeout(iTimeoutID);
					}
					iTimeoutID = setTimeout(function(){
						$('#messageRetour').hide('slow',function(){
							$('#blocRightSend').show('slow', function(){
							});
						});				
					}, 3000, 'JavaScript');
				}
			}
		});
		return false;
	}
}