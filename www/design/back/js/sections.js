tmt_globalPatterns.hexa = new RegExp("[a-fA-F0-9]");
var g_supprvisuel=1;
var ServerPath;
var champs;
window.onbeforeunload = function(e){

	if((g_supprvisuel && $('[@name=section_id]').val()=="") || ($('[@name^=fichierasuppr_b]').length>0)){
		suppr='';
		$('[@name^=fichierasuppr_b]').each(function(index){
			if($(this).val().length>0){
				if($(this).val().toLowerCase()!=$('[@name=section_banniere]').val().toLowerCase())
					suppr+=$(this).val();
					if(index<$('[@name^=fichierasuppr_b]').length-1)
						suppr+=';';
			}
		});
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=section&action=sectionBo_traitementVisuels&fl=b&process=suppr&fichier="+suppr,
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
	if($('[@name=section_banniere]').val()!=""){
		extension=$('[@name=section_banniere]').val().split(['.']);
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
		form=document.getElementById('sectionForm');
		form.tmt_validator = new tmt_formValidator(form);
	}

	$('[@name=champsvisuelbanniere]').bind("focus",function() {
													
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=section&action=sectionBo_traitementVisuels&fl=b&process=resize&fichier="+$(this).val(),
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
					$('[@name=section_banniere]').val($('[@name=auxvisuelbanniere]').val());

				input_h=document.createElement('input');
				input_h.type='hidden';
				$(input_h).attr({'name':'fichierasuppr_b'+$('[@name^=fichierasuppr_b]').length,'value':j_basepath + j_banniere_resize + resultat.image});
				$('#sectionForm').append($(input_h));
				form=document.getElementById('sectionForm');
				form.tmt_validator = new tmt_formValidator(form);
			 }
		});
	});

	$('.clearfix').find('.bouton').bind('click', clickAction);
});

function clickAction(obj){
	var id = $($(obj).get(0).target).attr('id');
	$('[@name=champsvisuelbanniere]').removeClass('invalid');
	$('#errorMessage').html('');

	if(id == 'banniere')
	{
		ServerPath = j_basepath + j_banniere_medias;
		champs = 'champsvisuelbanniere';
	}

	browser();
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
		if($('[@name=auxvisuelbanniere]').val().length>0)
			$('[@name=section_banniere]').val($('[@name=auxvisuelbanniere]').val());
		return true;
	}else{
		g_supprvisuel=1;
		return false;
	}
}