

</HEAD>

<BODY>
{literal}
<script language="javascript">

$( function () {


	$.getJSON(j_basepath + 'index.php?module=jintrospection&action=getAllActions',  function(actions){
		$(actions).each(function(){

			var frm = "<h3>"+this._moduleName+'~'+this._controllerName+'_'+this._name+'</h3>';
			frm +="<form jelixModule='"+this._moduleName+"' jelixAction='"+this._controllerName+'_'+this._name+"' method='POST'>";
			for(i=0;i<this._parameters.length;i++){
				frm += '<br>'+this._parameters[i]._desc+':';
/*	TODO			switch(this._parameters[i]._type){
					array, int, float, object, string, mixed, boolean
				}
*/
				frm += "<br><input type='text' name='"+this._parameters[i]._name+"'>";
			}
			frm += "<br><input type='button' class='unit' value='Launch'>";
			frm += "<div class='result'></div>";
			frm +="</form>";
			$('body').append(frm);

		});
		$('.unit').click(function(){
			$(this).parent('form').processAjaxTest();
		});

	});

	$.fn.processAjaxTest = function() {
		jelixModule = $(this).attr('jelixModule');
		jelixAction = $(this).attr('jelixAction');

		$(this).attr('action', j_basepath + 'index.php?' + 'module=' + jelixModule + '&action=' + jelixAction);
		form = $(this);

		// pass options to ajaxForm 
		$(this).ajaxSubmit(function(result){
			form.find('div').text(result);
			form.find('div').show();
		});
	};

});


</script>
<style>
.body(padding:20px);
.result{border:2px solid black;display:none}
</style>
{/literal}
</BODY>
</HTML>
