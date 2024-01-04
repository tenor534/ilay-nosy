var g_supprvisuel = 1;
var champs='';
var ServerPath = '';
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
	if((g_supprvisuel && $('[@name=element_id]').val()=="") || ($('[@name^=fichierasuppr_]').length>0)){
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
	if($('[@name=chooseThumbnail]').val() == 1 && $('[@name=element_thumbnail]').val()=='')
	{
		$('[@name=champsvisuelthumbnail]').attr('tmt:required', 'true');
	}
	
	if( $('[@name=chooseMaitre]').val() == 1 && $('[@name=element_fichierMaitre]').val()=="")
	{
		$('[@name=champsvisuelmaitre]').attr('tmt:required', 'true');
	}

	
	$('input[@name=thumbnailchoose]').click(function(){
		var iAffiche = $(this).val();
		if(iAffiche == 1)
		{
			$('#fichierthumbnail').show();
			$('[@name=champsvisuelthumbnail]').attr('tmt:required', 'true');
			$('#fichierthumbnailurl').hide();
			$('[@name=element_thumbnailURL]').removeAttr('tmt:required');
			$('[@name=element_thumbnailURL]').val('');
			$('#appercuThumbnail').empty().hide();
		}else{
			$('[@name=element_thumbnailURL]').attr('tmt:required', 'true');
			$('#fichierthumbnailurl').show();

			$('#fichierthumbnail').hide();
			$('#appercuThumbnail').hide();
			$('[@name=champsvisuelthumbnail]').val("");
			$('.clearfix').find('.bouton').unbind();
			$('#zoneThumbnail').empty().append('<input type="text" name="champsvisuelthumbnail" style="width:300px;" value="" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="bouton" id="visuelThumbnail" href="javascript:;">Browse ...</a>');
			$('.clearfix').find('.bouton').unbind().bind('click', clickAction);
			$('[@name=champsvisuelthumbnail]').bind('focus', fnBrowserThumbnail);

			$('[@name=element_thumbnail]').val('');
			$('[@name=auxvisuelthumbnail]').val('');
		}
		form=document.getElementById('elementForm');
		form.tmt_validator = new tmt_formValidator(form);
	});

	$('input[@name=choose]').click(function(){
		var iAffiche = $(this).val();
		if(iAffiche == 3)//url
		{
			$('#fichierMaitreUrl').show();
			$('[@name=element_fichierMaitreURL]').attr('tmt:required', 'true');

			$('#fichierEncart').hide();
			$('[@name=element_encart]').val('');
			$('[@name=element_encart]').removeAttr('tmt:required');
			$('#appercuEncart').empty().hide();

			$('#appercuMaitre').empty().hide();
			$('[@name=champsvisuelmaitre]').removeAttr('tmt:required');
			$('#fichierMaitre').hide();
			$('[@name=element_fichierMaitre]').val('');
			$('[@name=auxvisuelmaitre]').val('');
//			loadFile('iwflash','', 'a',1);
		}
		if(iAffiche == 2)
		{
			$('#fichierEncart').show();
			$('[@name=element_encart]').attr('tmt:required', 'true');

			$('#appercuMaitre').empty().hide();
			$('[@name=champsvisuelmaitre]').removeAttr('tmt:required');
			$('#fichierMaitre').hide();
			$('[@name=element_fichierMaitre]').val('');
			$('[@name=auxvisuelmaitre]').val('');
			
			$('#fichierMaitreUrl').hide();
			$('[@name=element_fichierMaitreURL]').removeAttr('tmt:required');
			$('[@name=element_fichierMaitreURL]').val('');
//			loadFile('iwflash','', 'a',1);
		}
		if(iAffiche == 1)
		{
			$('.clearfix').find('.bouton').unbind();
			$('#zoneMaitre').empty().append('<input type="text" name="champsvisuelmaitre" style="width:300px;" value="" readonly="readonly">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="bouton" id="visuelMaitre" href="javascript:;">Browse ...</a>');
			$('.clearfix').find('.bouton').unbind().bind('click', clickAction);
			$('[@name=champsvisuelmaitre]').bind('focus', fnBrowserMaitre);
			$('#fichierMaitre').show();
			$('[@name=champsvisuelmaitre]').attr('tmt:required', 'true');
			
			$('[@name=element_encart]').val('');
			$('[@name=element_encart]').removeAttr('tmt:required');
			$('#fichierEncart').hide();
			$('#appercuEncart').empty().hide();
			$('#appercuMaitre').empty().hide();

			$('[@name=element_fichierMaitreURL]').removeAttr('tmt:required');
			$('[@name=element_fichierMaitreURL]').val('');
			$('#fichierMaitreUrl').hide();
		}
		form=document.getElementById('elementForm');
		form.tmt_validator = new tmt_formValidator(form);
	});

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
	if($('[@name=element_thumbnail]').val() != ""){
		extension=$('[@name=element_thumbnail]').val().split(['.']);
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

	// variables pour les vidéos
	var fileLoaded = false;
	var currentState = '0';
});

function afficheUrlVideo(obj)
{
	loadFileUrl("iwflash2", {file:$(obj).val()});
//	loadFile("iwflash2", '', $(obj).val(), 1);
}

function afficheImage(obj)
{
	$('#appercuThumbnailUrl').empty();
	$('#appercuThumbnailUrl').append('<img src="'+$(obj).val()+'" />');
	$('#appercuThumbnailUrl').show();
	return true;
}

function afficheFlash(obj)
{
	$('#appercuEncart').empty();
	$('#appercuEncart').html($(obj).val());
	$('#appercuEncart').show();
	return true;
}

function fnBrowserThumbnail()
{
	if($('[@name=champsvisuelthumbnail]').val().length>0)
	{
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=element&action=elementBo_traitementImages&type=th&elt=4&process=&fichier=" + $('[@name=champsvisuelthumbnail]').val(),
			 dataType:"json",
			 async:false,
			 success:function(resultat)
			 {
				if(resultat.thumbnail != undefined && resultat.thumbnail != "")
				{

					$('#appercuThumbnail').empty();
					var extenstion = '';
					var ext = '';
					extension = resultat.image.split(['.']);
					ext = extension[extension.length-1].toLowerCase();

					$('#appercuThumbnail').html(resultat.visuel);
					$('#appercuThumbnail').show();
					$('[@name=auxvisuelthumbnail]').val(j_basepath + j_thumbnail_resize + resultat.thumbnail);
					$('.clearfix').each(function(){
						$(this).css('display','block');
					});

					if($('[@name=auxvisuelthumbnail]').val().length > 0)
						$('[@name=element_thumbnail]').val($('[@name=auxvisuelthumbnail]').val());

					input_h = document.createElement('input');
					input_h.type='hidden';
					$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_thumbnail_resize + resultat.thumbnail});
					$('#elementForm').append($(input_h));
				}
				else{
					$('[@name=champsvisuelthumbnail]').val("");
					$('.clearfix').find('.bouton').unbind();
					$('#zoneThumbnail').empty().append('<input type="text" name="champsvisuelthumbnail" style="width:300px;" value="" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="bouton" id="visuelThumbnail" href="javascript:;">Browse ...</a>');
					$('.clearfix').find('.bouton').unbind().bind('click', clickAction);
					$('[@name=champsvisuelthumbnail]').bind('focus', fnBrowserThumbnail);

					$('#errorMessage').empty().append('The extension is not supported.');
					$('#errorMessage').show();
				}
				form = document.getElementById('elementForm');
				form.tmt_validator = new tmt_formValidator(form);
			 }
		});
		$('#fichierthumbnailurl').hide();
		$('[@name=element_thumbnailURL]').val('');
		$('[@name=element_thumbnailURL]').removeAttr('tmt:required');

	}
}

function clickAction(obj){
	var id = $($(obj).get(0).target).attr('id');
	$('[@name=champsvisuelmaitre]').removeClass('invalid');
	$('[@name=champsvisuelthumbnail]').removeClass('invalid');
	$('#errorMessage').html('');

	if(id=="visuelMaitre")
	{
		ServerPath = j_basepath + j_flv_medias;
		champs = 'champsvisuelmaitre';
	}
	if(id=="visuelThumbnail")
	{
		ServerPath = j_basepath + j_thumbnail_video_medias;
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

function fnBrowserMaitre()
{
	if($('[@name=champsvisuelmaitre]').val().length>0)
	{
		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=element&action=elementBo_traitementVisuels&type=fm&elt=4&process=&fichier=" + $('[@name=champsvisuelmaitre]').val(),
			 dataType:"json",
			 async:false,
			 success:function(resultat)
			 {
				if(resultat.image != "")
				{
					$('#appercuMaitre').empty();
					var extenstion = '';
					var ext = '';
					extension = resultat.image.split(['.']);
					ext = extension[extension.length-1].toLowerCase();
					loadFile("iwflash", "", resultat.visuel, 1 );

					$('#appercuMaitre').show();
					$('[@name=auxvisuelmaitre]').val(j_basepath + j_video_resize + resultat.image);
					$('.clearfix').each(function(){
						$(this).css('display','block');
					});

					if($('[@name=auxvisuelmaitre]').val().length > 0)
						$('[@name=element_fichierMaitre]').val($('[@name=auxvisuelmaitre]').val());

					input_h = document.createElement('input');
					input_h.type='hidden';
					$(input_h).attr({'name':'fichierasuppr_'+$('[@name^=fichierasuppr_]').length,'value':j_basepath + j_video_resize + resultat.image});
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

		if($('[@name=auxvisuelthumbnail]').val().length>0)
			$('[@name=element_thumbnail]').val($('[@name=auxvisuelthumbnail]').val());
		return true;
	}else{
		g_supprvisuel=1;
		return false;
	}
}

/*-------------------------------------------------------------------
Player javascript API
-------------------------------------------------------------------*/
function sendEvent(swf,typ,prm) { 
	thisMovie(swf).sendEvent(typ,prm); 
};

function getUpdate(typ,pr1,pr2,pid) {
	if(pid != "null") {
		if((typ == "state")&&(pr1 != undefined)) { 
			currentState = pr1; 
			if((currentState=="0")&&(fileLoaded)) {				
				fileLoaded = false;
				// configurer suivant le debit de la la connexion
				setTimeout("sendEvent('iwflash', 'playitem', 0)", 150); 	
			}
		}
	}
};

function thisMovie(movieName) {
	return document[movieName];
};

function loadFileUrl(swf, file) {
	thisMovie(swf).loadFile(file); 
};

function loadFile(swf,img, file,type) {
	type = parseInt(type,10);
	if(img != '')
		obj = {'image':j_basepath + 'resize/visuel/' + img, 'file':j_basepath + 'resize/video/' + file};
	else
		obj = {'image':'','file':j_basepath + 'resize/video/' + file};

	thisMovie(swf).loadFile(obj); 
	sendEvent(swf, 'playitem', 0);
	fileLoaded = true;
};

function getLength(swf) { 
	return thisMovie(swf).getLength(); 
};

function addItem(swf,obj,idx) {
	thisMovie(swf).addItem(obj,idx);
};

function removeItem(swf,idx) {
	thisMovie(swf).removeItem(idx);
};

function itemData(swf,idx) { 
	var obj = thisMovie(swf).itemData(idx);
	var txt = "";
	for(var i in obj) { 
		txt += i+": "+ obj[i] +"\n";
	}
};

