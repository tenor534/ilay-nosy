jQuery(document).ready(function() {
		//$('[@name=corporate_decriptifCourt]').attr('tmt:required','true');
		//$('[@name=corporate_decriptifCourt]').attr('tmt:invalidvalue','<br>');
		
		$("input[@name='corporate_publier']").click(function() { 
			if (this.checked == true) $(this).val(1); 
			else $(this).val(0); 
		});
		
		$("input[@name='corporate_publierRightColumn']").click(function() { 
			if (this.checked == true) $(this).val(1); 
			else $(this).val(0); 
		});
		
		$(".clearfix").find('.bouton').click(function(){
			browser($(this).prev('input[@type=text]').attr('name'));
		});

		$(".submit").click(function(){
			/*
			var iframe=$('#corporate_descriptifCourt___Frame').get(0);
			$('[@name=corporate_descriptifCourt]').val(iframe.contentWindow.FCK.GetHTML());
			*/
		
			/*var iframeLong=$('#corporate_descriptifLong___Frame').get(0);
			
			$('[@name=corporate_descriptifLong]').val(iframeLong.contentWindow.FCK.GetHTML());
			*/

		});
});


function browser(champs){
	ServerPath = j_basepath+j_corporate_medias;
	url=j_basepath+'FCKeditor/editor/filemanager/browser/default/browser.html?externe=yes&champs='+champs+'&ServerPath='+ServerPath+'&CurrentFolder=/&Connector=connectors/php/connector.php';

	var iLeft = (screen.width  - screen.width * 0.7) / 2 ;
	var iTop  = (screen.height - screen.height * 0.7) / 2 ;

	var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes" ;
	sOptions += ",width=" + screen.width * 0.7 ;
	sOptions += ",height=" + screen.height * 0.7 ;
	sOptions += ",left=" + iLeft ;
	sOptions += ",top=" + iTop ;

	window.open( url, "BrowseWindow", sOptions ) ;
}




