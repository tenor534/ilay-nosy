tmt_globalPatterns.hexa = new RegExp("[a-fA-F0-9]");
var g_supprvisuel=1;
var ServerPath;
var champs;
window.onbeforeunload = function(e){

	if((g_supprvisuel && $('[@name=marque_id]').val()=="") || ($('[@name^=fichierasuppr_]').length>0)){
		suppr='';
		$('[@name^=fichierasuppr_]').each(function(index){
			if($(this).val().length>0){
				if($(this).val().toLowerCase()!=$('[@name=marque_logo]').val().toLowerCase())
					suppr+=$(this).val();
					if(index<$('[@name^=fichierasuppr_]').length-1)
						suppr+=';';
			}
		});
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=marque&action=marqueBo_traitementVisuels&fl=l&process=suppr&fichier="+suppr,
			 dataType:"json",
			 async:false
		});
	}

	if((g_supprvisuel && $('[@name=marque_id]').val()=="") || ($('[@name^=fichierasuppr_b]').length>0)){
		suppr='';
		$('[@name^=fichierasuppr_b]').each(function(index){
			if($(this).val().length>0){
				if($(this).val().toLowerCase()!=$('[@name=marque_banniere]').val().toLowerCase())
					suppr+=$(this).val();
					if(index<$('[@name^=fichierasuppr_b]').length-1)
						suppr+=';';
			}
		});
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=marque&action=marqueBo_traitementVisuels&fl=b&process=suppr&fichier="+suppr,
			 dataType:"json",
			 async:false
		});
	}
	if((g_supprvisuel && $('[@name=marque_id]').val()=="") || ($('[@name^=fichierasuppr_v]').length>0)){
		suppr='';
		$('[@name^=fichierasuppr_v]').each(function(index){
			if($(this).val().length>0){
				if($(this).val().toLowerCase()!=$('[@name=marque_verre]').val().toLowerCase())
					suppr+=$(this).val();
					if(index<$('[@name^=fichierasuppr_v]').length-1)
						suppr+=';';
			}
		});
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=marque&action=marqueBo_traitementVisuels&fl=v&process=suppr&fichier="+suppr,
			 dataType:"json",
			 async:false
		});
	}
};
jQuery(document).ready(function() {
	$('[@type=checkbox]').click(function(){
//		alert(this.name);
		if(this.checked)		
			$(this).val(1);
		else
			$(this).val(0);
	});
	if($('[@name=marque_banniere]').val()!=""){
		extension=$('[@name=marque_banniere]').val().split(['.']);
		switch(extension[extension.length-1].toLowerCase()){
			case 'swf':
				if($('.clearfix').length>1)
				$('.clearfix').gt(0).hide();
				break;
			default:
				$('.clearfix').each(function(){
					$(this).css('display','block');
				});
				break;
		}
		form=document.getElementById('marqueForm');
		form.tmt_validator = new tmt_formValidator(form);
	}
	if($('[@name=marque_logo]').val()!=""){
		extension=$('[@name=marque_logo]').val().split(['.']);
		switch(extension[extension.length-1].toLowerCase()){
			case 'swf':
				if($('.clearfix').length>1)
				$('.clearfix').gt(0).hide();
				break;
			default:
				$('.clearfix').each(function(){
					$(this).css('display','block');
				});
				break;
		}
		form=document.getElementById('marqueForm');
		form.tmt_validator = new tmt_formValidator(form);
	}
	if($('[@name=marque_verre]').val()!=""){
		extension=$('[@name=marque_verre]').val().split(['.']);
		switch(extension[extension.length-1].toLowerCase()){
			case 'swf':
				if($('.clearfix').length>1)
				$('.clearfix').gt(0).hide();
				break;
			default:
				$('.clearfix').each(function(){
					$(this).css('display','block');
				});
				break;
		}
		form=document.getElementById('marqueForm');
		form.tmt_validator = new tmt_formValidator(form);
	}
	$('[@name=champsvisuel]').bind("focus",function() {
													
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=marque&action=marqueBo_traitementVisuels&fl=l&process=resize&fichier="+$(this).val(),
			 dataType:"json",
			 async:false,
			 success:function(resultat){
				$('#appercu').empty();
				$('#appercu').html(resultat.visuel);
				$('[@name=auxvisuel]').val(j_basepath+j_logo_resize + resultat.image);
				extension=resultat.image.split(['.']);
				switch(extension[extension.length-1].toLowerCase()){
					case 'swf':
						if($('.clearfix').length>1)
						$('.clearfix').gt(0).hide();
						//$('[@name=actualite_url]').removeAttr('tmt:required');
						break;
					default:
						$('.clearfix').each(function(){
							$(this).css('display','block');
						});
						break;
				}				

				//$('[@name=actualite_photo]').val(resultat.image);
				if($('[@name=auxvisuel]').val().length>0)
					$('[@name=marque_logo]').val($('[@name=auxvisuel]').val());

				input_h=document.createElement('input');
				input_h.type='hidden';
				$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_logo_resize + resultat.image});
				$('#marqueForm').append($(input_h));
				form=document.getElementById('marqueForm');
				form.tmt_validator = new tmt_formValidator(form);
			 }
		});
	});
//
	$('[@name=champsvisuelbanniere]').bind("focus",function() {
													
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=marque&action=marqueBo_traitementVisuels&fl=b&process=resize&fichier="+$(this).val(),
			 dataType:"json",
			 async:false,
			 success:function(resultat){
				$('#appercuBanniere').empty();
				$('#appercuBanniere').html(resultat.visuel);
				$('[@name=auxvisuelbanniere]').val(j_basepath+j_banniere_resize + resultat.image);
				extension=resultat.image.split(['.']);
				switch(extension[extension.length-1].toLowerCase()){
					case 'swf':
						if($('.clearfix').length>1)
						$('.clearfix').gt(0).hide();
						break;
					default:
						$('.clearfix').each(function(){
							$(this).css('display','block');
						});
						break;
				}				

				if($('[@name=auxvisuelbanniere]').val().length>0)
					$('[@name=marque_banniere]').val($('[@name=auxvisuelbanniere]').val());

				input_h=document.createElement('input');
				input_h.type='hidden';
				$(input_h).attr({'name':'fichierasuppr_b'+$('[@name^=fichierasuppr_b]').length,'value':j_basepath + j_banniere_resize + resultat.image});
				$('#marqueForm').append($(input_h));
				form=document.getElementById('marqueForm');
				form.tmt_validator = new tmt_formValidator(form);
			 }
		});
	});

	$('[@name=champsvisuelverre]').bind("focus", fnBrowerVerre);
//

	$('.clearfix').find('.bouton').bind('click', clickAction);


	//init colorpicker
	$("#colorPicker").click(function(){
		showColorGrid2('marque_couleur','color');
	});

	$("#colorPickerTitreGda").click(function(){
		showColorGrid2('marque_couleurTitreGda','colorTitreGda');
	});
	$("#colorPickerTxt3").click(function(){
		showColorGrid2('marque_couleurTxt3','colorTxt3');
	});
	$("#colorPickerValeur1").click(function(){
		showColorGrid2('marque_couleurValeur1','colorValeur1');
	});
	$("#colorPickerValeur2").click(function(){
		showColorGrid2('marque_couleurValeur2','colorValeur2');
	});
	$("#colorPickerValeur3").click(function(){
		showColorGrid2('marque_couleurValeur3','colorValeur3');
	});
});

function clickAction(obj){
	var id = $($(obj).get(0).target).attr('id');
	$('[@name=champsvisuel]').removeClass('invalid');
	$('[@name=champsvisuelbanniere]').removeClass('invalid');
	$('[@name=champsvisuelverre]').removeClass('invalid');
	$('#errorMessage').html('');

	if(id == 'logo')
	{
		ServerPath = j_basepath + j_logo_medias;
		champs = 'champsvisuel';
	}

	if(id == 'banniere')
	{
		ServerPath = j_basepath + j_banniere_medias;
		champs = 'champsvisuelbanniere';
	}

	if(id == 'verre')
	{
		ServerPath = j_basepath + j_verre_medias;
		champs = 'champsvisuelverre';
	}
	browser();
}

function fnBrowerVerre() {													
	if($('[@name=champsvisuelverre]').val().length>0)
	$.ajax({
		 type:"POST",
		 url:j_basepath+'index.php',
		 data:"module=marque&action=marqueBo_traitementVisuels&fl=v&process=&fichier="+ $('[@name=champsvisuelverre]').val(),
		 dataType:"json",
		 async:false,
		 success:function(resultat){
		 
			$('#appercuVerre').empty();
			if(parseInt(resultat.w)== 57 && parseInt(resultat.h)==93)
			{
				$('#appercuVerre').html(resultat.visuel);
				$('[@name=auxvisuelverre]').val(j_basepath + j_verre_medias + resultat.image);
				
				extension=resultat.image.split(['.']);
				switch(extension[extension.length-1].toLowerCase()){
					case 'swf':
						if($('.clearfix').length>1)
						$('.clearfix').gt(0).hide();
						break;
					default:
						$('.clearfix').each(function(){
							$(this).css('display','block');
						});
						break;
				}				

				if($('[@name=auxvisuelverre]').val().length>0)
					$('[@name=marque_verre]').val($('[@name=auxvisuelverre]').val());

				input_h=document.createElement('input');
				input_h.type='hidden';
				$(input_h).attr({'name':'fichierasuppr_v'+$('[@name^=fichierasuppr_v]').length,'value':j_basepath + j_verre_medias + resultat.image});
				$('#marqueForm').append($(input_h));
			}
			else{
				$('[@name=champsvisuelverre]').val('');	
				$('[@name=auxvisuelverre]').val('');
				$('[@name=marque_verre]').val('');
				$('.clearfix').find('.bouton').unbind();
				$('#zoneVerre').empty().append('<input type="text" name="champsvisuelverre" tmt:message="Please select a .jpg or .gif file. Width 57px. Height 93px." tmt:image="true" tmt:imagemaxwidth="57" tmt:imageminwidth="57" tmt:imagemaxheight="93" tmt:imageminheight="93"  tmt:required="true" style="width:300px;" value="" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="bouton" id="verre" href="javascript:;">Browse ...</a>');
				$('.clearfix').find('.bouton').unbind().bind('click', clickAction);
				$('[@name=champsvisuelverre]').bind('focus', fnBrowerVerre);
				
				alert("Glass size do not match");
				
			}

			form=document.getElementById('marqueForm');
			form.tmt_validator = new tmt_formValidator(form);

		 }
	});
}

function browser()
{
//	ServerPath = j_basepath + j_logo_medias;

	url=j_basepath + 'FCKeditor/editor/filemanager/browser/default/browser.html?externe=yes&champs=' + champs + '&ServerPath='+ServerPath+'&CurrentFolder=/&Connector=connectors/php/connector.php';

	var iLeft = (screen.width  - screen.width * 0.7) / 2 ;
	var iTop  = (screen.height - screen.height * 0.7) / 2 ;

	var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes" ;
	sOptions += ",width=" + screen.width * 0.7 ;
	sOptions += ",height=" + screen.height * 0.7 ;
	sOptions += ",left=" + iLeft ;
	sOptions += ",top=" + iTop ;

	window.open( url, "BrowseWindow", sOptions ) ;
}
function submitForm(form){
	g_supprvisuel=0;
	if(tmt_validateForm(form)){
		if($('[@name=auxvisuel]').val().length>0)
			$('[@name=marque_logo]').val($('[@name=auxvisuel]').val());
	
		if($('[@name=auxvisuelbanniere]').val().length>0)
			$('[@name=marque_banniere]').val($('[@name=auxvisuelbanniere]').val());

		if($('[@name=auxvisuelverre]').val().length>0)
			$('[@name=marque_verre]').val($('[@name=auxvisuelverre]').val());
		return true;
	}else{
		g_supprvisuel=1;
		return false;
	}
}