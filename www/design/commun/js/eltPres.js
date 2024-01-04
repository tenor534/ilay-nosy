var g_supprvisuel = 1;
window.onbeforeunload = function(e){
	if((g_supprvisuel && $('[@name=element_id]').val()=="") || ($('[@name^=fichierasuppr_]').length>0)){
		suppr='';
		$('[@name^=fichierasuppr_]').each(function(index){
			if($(this).val().length>0){
				if($(this).val().toLowerCase()!=$('[@name=element_fichierMaitre]').val().toLowerCase())
					suppr+=$(this).val();
					if(index<$('[@name^=fichierasuppr_]').length-1)
						suppr+=';';
			}
		});
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=element&action=elementBo_traitementVisuels&fl=fm&process=suppr&fichier="+suppr,
			 dataType:"json",
			 async:false
		});
	}
};
function onCheck(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);
	return true;
}

jQuery(document).ready(function() {

	$('[@id=selectMarque]').change(function(){
		var idMarque = $(this).val();
		if(idMarque != 0)
		{
			$.getJSON(j_basepath + "index.php",{module:"element", action:"elementBo_editeElement", idMarque:idMarque}, function(datas){
				if(datas != '' && datas['toRubrique'] != 0)
				{
					$('#selectRubrique').html('');
					var html = '<option value="0">select heading &nbsp;&nbsp;&nbsp;</option>';
					for(i=0; i< datas['toRubrique'].length; i++)
					{
						html += '<option value="' + datas["toRubrique"][i]["rubrique_id"]+'">' + datas["toRubrique"][i]["rubrique_libelle"] + '</option>';
					}
					$('#selectRubrique').append(html);
					$('#selectRubrique').val(0);
					
				}
				else
				{
					alert('No heading associated with this brand.');
					$('#selectRubrique').html('');
					var html = '<option value="0">select heading &nbsp;&nbsp;&nbsp;</option>';
					$('#selectRubrique').append(html);
					$('#selectRubrique').val(0);
					return false;
				}
			});
		}
	});

	if($('[@name=element_fichierMaitre]').val() != ""){
		extension=$('[@name=element_fichierMaitre]').val().split(['.']);
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
		form=document.getElementById('elementForm');
		form.tmt_validator = new tmt_formValidator(form);
	}

	$('[@name=champsvisuelmaitre]').bind("focus", fnBrowserMaitre);
	$('[@name=champsvisuelthumbnail]').bind("focus", fnBrowserThumbnail);
	$('.clearfix').find('.bouton').bind('click', clickAction);

});

function afficheFlash(obj)
{
	$('#appercuencart').empty();
	$('#appercuencart').html($(obj).val());
	$('#appercuencart').show();
	return true;
}

function clickAction(obj){
	var id = $($(obj).get(0).target).attr('id');
	$('[@name=champsvisuelmaitre]').removeClass('invalid');
	$('#errorMessage').html('');

	if(id == 'visuelMaitre')
	{
		ServerPath = j_basepath + j_maitre_medias;
		champs = 'champsvisuelmaitre';
	}
	if(id == 'visuelThumbnail')
	{
		ServerPath = j_basepath + j_thumbnail_medias;
		champs = 'champsvisuelthumbnail';
	}

	browser();
}

function browser()
{
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

function fnBrowserThumbnail()
{
	if($('[@name=champsvisuelthumbnail]').val().length > 0)
	{
		$.ajax({
			 type:"POST",
			 url:j_basepath + 'index.php',
			 data:"module=element&action=elementBo_traitementThumbnail&fl=ft&elt=2&process=&fichier=" + $('[@name=champsvisuelthumbnail]').val(),
			 dataType:"json",
			 async:false,
			 success:function(resultat)
			 {
				if(resultat.image != "")
				{
					$('#appercuThumbnail').empty().append(resultat.image);
					$('#appercuThumbnail').show();
					$('[@name=auxvisuelthumbnail]').val(j_basepath + j_maitre_medias + resultat.thumbnail);
					$('.clearfix').each(function(){
						$(this).css('display','block');
					});

					if($('[@name=auxvisuelthumbnail]').val().length > 0)
						$('[@name=element_thumbnail]').val($('[@name=auxvisuelthumbnail]').val());

					input_h = document.createElement('input');
					input_h.type='hidden';
					$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_thumbnail_resize + resultat.thumbnail});
					$('#elementForm').append($(input_h));
				}else
				{
					$('[@name=champsvisuelthumbnail]').val("");
					$('.clearfix').find('.bouton').unbind();
					$('#zoneThumbnail').empty().append('<input type="text" name="champsvisuelthumbnail" style="width:300px;" value="" readonly="readonly" tmt:required="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="bouton" id="visuelThumbnail" href="javascript:;">Browse ...</a>');
					$('.clearfix').find('.bouton').unbind().bind('click', clickAction);
					$('[@name=champsvisuelthumbnail]').bind('focus', fnBrowserThumbnail);

					$('#errorMessage').empty().append('The extension is not supported.');
					$('#errorMessage').show();
				}
				form = document.getElementById('elementForm');
				form.tmt_validator = new tmt_formValidator(form);
			}
		});
	}
}

function fnBrowserMaitre()
{
	if($('[@name=champsvisuelmaitre]').val().length>0)
	{
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=element&action=elementBo_traitementVisuels&fl=fm&elt=2&process=&fichier=" + $('[@name=champsvisuelmaitre]').val(),
			 dataType:"json",
			 async:false,
			 success:function(resultat)
			 {
				if(resultat.image != "")
				{
					$('#appercuMaitre').empty();
					var extension = resultat.image.split(['.']);
					var ext = extension[extension.length-1].toLowerCase();
					$('#appercuMaitre').empty().append(resultat.visuel);
					$('#appercuMaitre').show();
					$('[@name=auxvisuelmaitre]').val(j_basepath + j_maitre_medias + resultat.image);
					$('.clearfix').each(function(){
						$(this).css('display','block');
					});

					if($('[@name=auxvisuelmaitre]').val().length > 0)
						$('[@name=element_fichierMaitre]').val($('[@name=auxvisuelmaitre]').val());

					input_h = document.createElement('input');
					input_h.type='hidden';
					$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_maitre_medias + resultat.image});
					$('#elementForm').append($(input_h));
				}
				else{
					$('[@name=champsvisuelmaitre]').val("");
					$('.clearfix').find('.bouton').unbind();
					$('#zoneMaitre').empty().append('<input type="text" name="champsvisuelmaitre" style="width:300px;" value="" readonly="readonly" tmt:required="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="bouton" id="visuelMaitre" href="javascript:;">Browse ...</a>');
					$('.clearfix').find('.bouton').unbind().bind('click', clickAction);
					$('[@name=champsvisuelmaitre]').bind('focus', fnBrowserMaitre);

					$('#errorMessage').empty().append('The extension is not supported.');
					$('#errorMessage').show();
				}
				form = document.getElementById('elementForm');
				form.tmt_validator = new tmt_formValidator(form);
			 }
		});
	}
}

function submitForm(form){
	g_supprvisuel=0;
	if(tmt_validateForm(form)){
		if($('[@name=auxvisuelmaitre]').val().length>0)
			$('[@name=element_fichierMaitre]').val($('[@name=auxvisuelmaitre]').val());
		return true;
	}else{
		g_supprvisuel=1;
		return false;
	}
}