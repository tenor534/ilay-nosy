jQuery(document).ready(function() {
	$('[@name=idMarque]').change(function(){
		var idMarque = $(this).val();
		if(idMarque != 0)	
		{
			$('[@name=selMarque]').submit();
		}
	});
});