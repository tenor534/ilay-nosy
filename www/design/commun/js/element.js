var g_supprvisuel = 1;
window.onbeforeunload = function(e){
	if((g_supprvisuel && $('[@name=element_id]').val()=="") || $('[@name^=fichierasuppr_]').length > 0){
		suppr='';
		$('[@name^=fichierasuppr_]').each(function(index){
			if($(this).val().length>0){
				if($(this).val().toLowerCase()!=$('[@name=element_fichierMaitre]').val().toLowerCase())
					suppr += $(this).val();
					if(index < $('[@name^=fichierasuppr_]').length-1)
						suppr += ';';
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
	/*
	if((g_supprvisuel && $('[@name=element_id]').val()=="")){
		suppr='';
		$('[@name^=fichierasuppr_]').each(function(index){
			if($(this).val().length>0){
				if($(this).val().toLowerCase()!=$('[@name=element_thumbnail]').val().toLowerCase())
					suppr+=$(this).val();
					if(index<$('[@name^=fichierasuppr_]').length-1)
						suppr+=';';
			}
		});
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=element&action=elementBo_traitementImages&type=th&process=suppr&fichier="+suppr,
			 dataType:"json",
			 async:false
		});
	}
	if((g_supprvisuel && $('[@name=element_id]').val()=="")){
		suppr='';
		$('[@name^=fichierasuppr_]').each(function(index){
			if($(this).val().length>0){
				if($(this).val().toLowerCase()!=$('[@name=element_visuel]').val().toLowerCase())
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
	if((g_supprvisuel && $('[@name=element_id]').val()=="")){
		suppr='';
		$('[@name^=fichierasuppr_]').each(function(index){
			if($(this).val().length>0){
				if($(this).val().toLowerCase()!=$('[@name=element_fichierSecondaire]').val().toLowerCase())
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
	*/

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
	$('[@name=champsvisuelsecondaire]').bind("focus", fnBrowserSecondaire);
	$('[@name=champsvisuel]').bind("focus", fnBrowserVisuel);

	$('.clearfix').find('.bouton').bind('click', clickAction);
	
});

function clickAction(obj){
	var id = $($(obj).get(0).target).attr('id');
	$('[@name=champsvisuel]').removeClass('invalid');
	$('[@name=champsvisuelmaitre]').removeClass('invalid');
	$('[@name=champsvisuelsecondaire]').removeClass('invalid');
	$('#errorMessage').html('');

	if(id == 'visuel')
	{
		ServerPath = j_basepath + j_visuel_medias;
		champs = 'champsvisuel';
	}

	if(id == 'visuelMaitre')
	{
		ServerPath = j_basepath + j_maitre_medias;
		champs = 'champsvisuelmaitre';
	}

	if(id == 'visuelSecondaire')
	{
		ServerPath = j_basepath + j_secondaire_medias;
		champs = 'champsvisuelsecondaire';
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

function cacheVisuel(zTest)
{
	if(zTest ='secondaire')
	{
		$('#appercuSecondaire')
			.empty()
			.hide();
		$('[@name=champsvisuelsecondaire]').val('');

		$('#zoneImage').empty().append('<input type="text" name="champsvisuelsecondaire" style="width:300px;" value="" readonly>&nbsp;&nbsp;&nbsp;<a class="bouton" href="javascript:;">brouwse ...</a>');
		$('.clearfix').find('.bouton').unbind().bind('click', clickAction);
		$('[@name=champsvisuelsecondaire]').bind("focus", fnBrowserSecondaire);
		$('[@name=auxvisuelsecondaire]').val('');
		$('[@name=element_fichierSecondaire]').val('');
	}
	else{
		$('#appercu')
			.empty()
			.hide();
		$('[@name=champsvisuel]').val('');

		$('#zoneVisuel').empty().append('<input type="text" name="champsvisuel" style="width:300px;" value="" readonly>&nbsp;&nbsp;&nbsp;<a class="bouton" href="javascript:;">brouwse ...</a>');
		$('.clearfix').find('.bouton').unbind().bind('click', clickAction);
		$('[@name=champsvisuel]').bind("focus", fnBrowserVisuel);
		$('[@name=auxvisuel]').val('');
		$('[@name=element_visuel]').val('');
	}
}

function supprImgOnclic()
{
	cacheVisuel('secondaire');
	return false;
}

function fnBrowserSecondaire()
{
	if($('[@name=champsvisuelsecondaire]').val().length>0)
	{
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=element&action=elementBo_traitementImages&fl=fs&process=&fichier=" + $('[@name=champsvisuelsecondaire]').val(),
			 dataType:"json",
			 async:false,
			 success:function(resultat){
				$('#appercuSecondaire').empty().html(resultat.visuel);
				$('#appercuSecondaire').show();
				$('[@name=auxvisuelsecondaire]').val(j_basepath + j_secondaire_medias + resultat.image);
				extension = resultat.image.split(['.']);
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

				if($('[@name=auxvisuelsecondaire]').val().length>0)
					$('[@name=element_fichierSecondaire]').val($('[@name=auxvisuelsecondaire]').val());
				form = document.getElementById('elementForm');
				form.tmt_validator = new tmt_formValidator(form);
			 }
		});
	}
}

function fnBrowserVisuel()
{
	if($('[@name=champsvisuel]').val().length>0)
	{
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=element&action=elementBo_traitementImages&type=vi&process=&fichier=" + $('[@name=champsvisuel]').val(),
			 dataType:"json",
			 async:false,
			 success:function(resultat){
				$('#appercu').empty().html(resultat.visuel);
				$('[@name=auxvisuel]').val(j_basepath + j_visuel_medias + resultat.image);
				$('[@name=auxvisuelthumbnail]').val(j_basepath + j_thumbnail_resize + resultat.thumbnail);
				extension = resultat.image.split(['.']);
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

				if($('[@name=auxvisuel]').val().length>0)
					$('[@name=element_visuel]').val($('[@name=auxvisuel]').val());

				if($('[@name=auxvisuelthumbnail]').val().length>0)
					$('[@name=element_thumbnail]').val($('[@name=auxvisuelthumbnail]').val());

				input_h=document.createElement('input');
				input_h.type='hidden';
				$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_thumbnail_resize + resultat.thumbnail});
				$('#elementForm').append($(input_h));

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
			 data:"module=element&action=elementBo_traitementVisuels&fl=fm&process=&fichier=" + $('[@name=champsvisuelmaitre]').val(),
			 dataType:"json",
			 async:false,
			 success:function(resultat){
				if(resultat.image == "")
				{
					$('[@name=champsvisuelmaitre]').val("");
					$('.clearfix').find('.bouton').unbind();
					$('#zoneMaitre').empty().append('<input type="text" name="champsvisuelmaitre" style="width:300px;" value="" readonly="readonly" tmt:required="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="bouton" id="visuelMaitre" href="javascript:;">Browse ...</a>');
					$('.clearfix').find('.bouton').unbind().bind('click', clickAction);
					$('[@name=champsvisuelmaitre]').bind('focus', fnBrowserMaitre);

					$('#errorMessage').empty().append('The extension of the image must be in (ai, eps, pdf, psd, jpeg, jpg, tif, tiff)');
					$('#errorMessage').show();
				}
				else
				{
					$('#appercuMaitre').empty();
					var extenstion = '';
					var ext = '';
					var titre = "";
					if(resultat.image != '')
					{
						extension = resultat.image.split(['.']);
						ext = extension[extension.length-1].toLowerCase();
						titre = resultat.image.substr(0, resultat.image.length -(ext.length + 1));
					}
					switch (ext)
					{
						case 'ai':
							$('span[@id=labElementTitre]').empty();
							$('span[@id=labElementTitre]').append(titre);
							$('#element_titre').val(titre);
							$('#divSecondaire').show();
							$('#divVisuel').css('display', 'block');
							if ($('[@name=element_visuel]').val() == '')
							{
								$('#champsvisuel').attr('tmt:required', 'true');
							}

							$('#appercuMaitre').html(resultat.visuel);
							$('#appercuMaitre').show();
							$('[@name=auxvisuelmaitre]').val(j_basepath + j_maitre_resize + resultat.image);
							$('.clearfix').each(function(){
								$(this).css('display','block');
							});
							$('#element_titre').val(resultat.image.substr(0, resultat.image.length - (ext.length + 1)));

							if($('[@name=auxvisuelmaitre]').val().length>0)
								$('[@name=element_fichierMaitre]').val($('[@name=auxvisuelmaitre]').val());

							input_h = document.createElement('input');
							input_h.type='hidden';
							$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_maitre_resize + resultat.image});
							$('#elementForm').append($(input_h));
							break;

						case 'eps':					
						case 'pdf':						
						case 'psd':
						case 'jpeg':
						case 'jpg':
						case 'tif':
						case 'tiff':
							$('span[@id=labElementTitre]').empty();
							$('span[@id=labElementTitre]').append(""+titre+"");
							$('#element_titre').val(titre);

							cacheVisuel('visuel');
							$('#divVisuel').hide();

							cacheVisuel('secondaire');
							$('#divSecondaire').hide();

							$('#appercuMaitre').html(resultat.visuel);
							$('#appercuMaitre').show();
							$('[@name=auxvisuelmaitre]').val(j_basepath + j_maitre_medias + resultat.image);
							$('[@name=auxvisuelthumbnail]').val(j_basepath + j_thumbnail_resize + resultat.thumbnail);
							$('[@name=auxvisuelsecondaire]').val(j_basepath + j_secondaire_resize + resultat.secondaire);
							$('[@name=auxvisuel]').val(j_basepath + j_visuel_resize + resultat.fichierVisuel);
							$('.clearfix').each(function(){
								$(this).css('display','block');
							});
							$('#element_titre').val(resultat.image.substr(0, resultat.image.length - (ext.length + 1)));

							if($('[@name=auxvisuelmaitre]').val().length>0)
								$('[@name=element_fichierMaitre]').val($('[@name=auxvisuelmaitre]').val());

							if($('[@name=auxvisuelthumbnail]').val().length>0)
								$('[@name=element_thumbnail]').val($('[@name=auxvisuelthumbnail]').val());
							if($('[@name=auxvisuelsecondaire]').val().length>0)
								$('[@name=element_fichierSecondaire]').val($('[@name=auxvisuelsecondaire]').val());
							if($('[@name=auxvisuel]').val().length>0)
								$('[@name=element_visuel]').val($('[@name=auxvisuel]').val());

							input_h = document.createElement('input');
							input_h.type='hidden';
							$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_thumbnail_resize + resultat.thumbnail});
							$('#elementForm').append($(input_h));

							input_h = document.createElement('input');
							input_h.type='hidden';
							$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_visuel_resize + resultat.fichierVisuel});
							$('#elementForm').append($(input_h));

							input_h = document.createElement('input');
							input_h.type='hidden';
							$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_secondaire_resize + resultat.secondaire});
							$('#elementForm').append($(input_h));
							break;

						default:
							$('[@name=champsvisuelmaitre]').val("");
							$('.clearfix').find('.bouton').unbind();
							$('#zoneMaitre').empty().append('<input type="text" name="champsvisuelmaitre" style="width:300px;" value="" readonly="readonly" tmt:required="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="bouton" id="visuelMaitre" href="javascript:;">Browse ...</a>');
							$('.clearfix').find('.bouton').unbind().bind('click', clickAction);
							$('[@name=champsvisuelmaitre]').bind('focus', fnBrowserMaitre);

							$('#errorMessage').empty().append('The extension of the image must be in (ai, eps, pdf, psd, jpeg, jpg, tif, tiff)');
							$('#errorMessage').show();
							break;						
					}
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
	
		if($('[@name=auxvisuelsecondaire]').val().length>0)
			$('[@name=element_fichierSecondaire]').val($('[@name=auxvisuelsecondaire]').val());

		if($('[@name=auxvisuel]').val().length>0)
			$('[@name=element_visuel]').val($('[@name=auxvisuel]').val());
		return true;
	}else{
		g_supprvisuel=1;
		return false;
	}
}