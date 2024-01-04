jQuery(document).ready(function() {

		if ($("#search").val() =='') $("#search").val('Type some keywords...');
	
		$("#search").click(function() {	
			if ( ( $('[@name=search]').val() == 'Type some keywords...') ) {
				$('[@name=search]').val('');
			}
		});
		
		
		$("#btn_search").click(function() {	
			if ( ( $('[@name=search]').val() == 'Type some keywords...') ) {
				alert('You should type some keywords!');
				return false;
			}
			var zForm = $("[@name=form_search]");
			zForm.submit();			
		});
		
});





