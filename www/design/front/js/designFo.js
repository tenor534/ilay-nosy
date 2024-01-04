// JavaScript Document

/* document Ready */
$( function () {
	/*$("#valideGda").click(function(){
		alert("Rado");
		return false;
	});*/
	
	addEvent(window, "load", tmt_validatorInit);
	doOnLoad($("body"));
});


//Affichage des erreurs, fonction appellée par TMTValidator
function displayError(frm){		
	$('#errorMessage').html('<img border="0" src="'+j_basepath+'design/front/images/v5/icon_error.gif" />&nbsp;Certaines informations sont incompl&egrave;tes ou invalides, veuillez les compl&eacute;ter correctement.');
	$(frm).children('.errorMessage').show();
}


function doOnLoad(context){

	$('.errorMessage', context).hide();
	
	$('.sortableListWithPagination', context).sortableListWithPagination();
		
	$($('form',context).get(0)).submit(function(){
		// Valeur obligatoire pour les champs Description courte et longue FckEditor pour le form Edition Corporate
		
		
		//validation du form
		if(tmt_validateForm(this)){
			if($(this).attr('id') == 'corporateForm') {
			//alert('1ère partie');
				var contentfckLong = getFullTextsWebEditor();
								
				if(!(contentfckLong.length > 0) || contentfckLong == ''){
					if (navigator.appName != 'Microsoft Internet Explorer')
						$($($('#corporate_decriptifLong___Frame ').get(0).contentWindow).get(0).document.body.childNodes[1]).css({'border': '2px dotted red'});
					else
						$('#webEditor').css({'border': '2px dotted red'});
						//$('#errorMessage').text('Some information is incomplete or invalid, please fill properly.');
						$('#errorMessageWebEditor').text('Some information is incomplete or invalid, please fill properly.');
					
					//displayError(this);
					return false
				} else {
					if (navigator.appName != 'Microsoft Internet Explorer') {
						$($($('#corporate_decriptifLong___Frame ').get(0).contentWindow).get(0).document.body.childNodes[1]).css({'border': '0px'});
					}else
						$('#webEditor').css({'border': '0px'});
						if ($('#errorMessage').text() != '') {
							$('#errorMessageWebEditor').text('');
						}
				}

				if($('[@name=champs_fichier]').val() != '') {
					$('[@name=corporate_fichier]').val($('[@name=champs_fichier]').val());
				} 
	
			}
		} else {
			if($(this).attr('id') == 'corporateForm') {
				// Contrôle de saisie obligatoire dans Web Editor
				//alert('2èm partie');
				var contentfckLong = getFullTextsWebEditor();
				if(!(contentfckLong.length > 0) || contentfckLong == ''){
					if (navigator.appName != 'Microsoft Internet Explorer')
						$($($('#corporate_decriptifLong___Frame ').get(0).contentWindow).get(0).document.body.childNodes[1]).css({'border': '2px dotted red'});
					else
						$('#webEditor').css({'border': '2px dotted red'});
						//$('#errorMessage').text('Some information is incomplete or invalid, please fill properly.');
						if ($('#errorMessage').text() != '') {
							$('#errorMessageWebEditor').text('');
						}
				} else {
					if (navigator.appName != 'Microsoft Internet Explorer')
						$($($('#corporate_decriptifLong___Frame ').get(0).contentWindow).get(0).document.body.childNodes[1]).css({'border': '0px'});
					else
						$('#webEditor').css({'border': '0px'});
						//$('#errorMessage').text('Some information is incomplete or invalid, please fill properly.');
						if ($('#errorMessage').text() != '') {
							$('#errorMessageWebEditor').text('');
						}
				}
			}
			
			
			/*if($(this).attr('id') == 'utilisateurForm') {
				
				alert($('[@name=utilisateur_profilId]').val());
			
				if($('[@name=utilisateur_profilId]').val() == '0') {
					alert("");
					$('[@name=utilisateur_profilId]').css({'border': '2px dotted red !important'});
				}else{
					$('[@name=utilisateur_profilId]').css({'border': '1px'});
				} 
			}*/

			return false;
		}


	});



	$(".submit", context).click(function(){

		if($(this).attr('id') == 'valideGda')
		{
			var selectPublie = 0;
			var selectPublie2 = 0;
			for(i=0; i<5; i++)
			{
				if($('[@name^=publie_]')[i].value == 1)
				{
					selectPublie = 1;
					break;
				}
			}

			for(i=0; i<8; i++)
			{
				if($('[@name^=nutriPublie_]')[i].value == 1)
				{
					selectPublie2 = 1;
					break;
				}
			}
			if(selectPublie==0 || selectPublie2 ==0)
			{
				alert('You must publish at least one indication and one nutrition informations.');
				return false;
			}
		}

		$('#errorMessage').html('');									 
		$(this).parents("form").children('.errorMessage').hide();
		$($(this).parents("form").get(0)).trigger("submit");
	});
	
	$(".annuler", context).click(function(){
		window.history.back();
	});

	/*$("a[@alt=supprimer]", context).click(function(){
		return (confirm("Are you sure to delete this element?"));
	});*/

	/*$("a[@alt=supprimer]", context).click(function(){
		//return doSuppression(this);
		
		var bConfirmation = confirm("Etes-vous sûr de vouloir supprimer cet élément ?");
		if (bConfirmation){
			var a = $(this);
			t = (this.id).split('_');
			var nameTableDB = t[0]
			var id = t[1];			
			switch(nameTableDB){
				case 'newsletter':
					module = 'newsletter';
					action = 'newsletterBo_supprimerNewsletter';
					break;
				case 'subscriber':
					module = 'newsletter';
					action = 'abonneBo_supprimerAbonne';
					break;
				case 'actualite':
					module = 'newsletter';
					action = 'abonneBo_supprimerAbonne';
					break;
				default:
					module = '';
					action = '';
					break;
			}
			
			if (module!='' && action!=''){
				$.post(j_basepath+'index.php',{'module':module,'action':action,'id':id},function(){
					table = $(a).parents('.sortableListWithPagination').find('table');
					page = table.attr('currentpage');
					sortField = table.attr('currentSortField');
					sortDirection = table.attr('currentSortDirection');			
					ajaxZone = $(a).parents('.ajaxZone');
					ajaxZone.load(src, {sortField:sortField, sortDirection:sortDirection,page:page}, function(){
						doOnLoad($(this));
					});
				});
			}		
		}
		return bConfirmation;
	});*/
	/*
	$("a[@alt=radier]", context).click(function(){
//		return (confirm("Etes-vous sûr de vouloir radier ce compte ?"));
		return (confirm("Are you sure to cross off this account?"));
		
	});

	$("a[@alt=archiver]").click(function(){
//		return confirm("Etes-vous sûr de vouloir archiver ce FAP ?");
		return confirm("Are you sure to archive this FAP?");
		
	});
	*/
}



//Retourne les textes entrés dans le web editor sans les tags
function getFullTextsWebEditor(){
	
	var iframeLong=$('#corporate_decriptifLong___Frame ').get(0);
	
	// Changer en miniscule tous les caractères
	var contentfckLong=iframeLong.contentWindow.FCK.GetHTML().toLowerCase( );
	
	//alert('1 / '+contentfckLong);
	// -2 Effacer les <br>
	contentfckLong=contentfckLong.replace(/<br>/g,'');
	
	// -1 Effacer <p>&nbsp;<\/p>
	contentfckLong=contentfckLong.replace(/<p>&nbsp;<\/p>/g,'');
	
	// 1- Efface les tags simples comme <p> </p> <font> </font>
	contentfckLong=contentfckLong.replace(/<[a-zA-Z]*>/g,'');
	contentfckLong=contentfckLong.replace(/<\/[a-zA-Z]*>/g,'');

	// 2- Effacer les propriétes styles comme :  font-size: 10px; font-family: arial
	contentfckLong=contentfckLong.replace(/([a-zA-Z]*[-]?([a-zA-Z]*)?:\s\d*[a-zA-Z]*(\s)*(;)?)|([a-zA-Z]*[-]?([a-zA-Z]*)?:\s[a-zA-Z]*(\s)*(;)?)/g,'');

	// 3- effacer les saut de page, saut de ligne, retour chariot et tabulation
	contentfckLong=contentfckLong.replace(/[\f\n\r\t]*/g,'');

	// 4- effacer les &nbsp;
	contentfckLong=contentfckLong.replace(/(&)?nbsp(;)?/g,'');

	// 5- ceci est Obligatoire pour effacer le reste de la forme:   <p style="">
	contentfckLong=contentfckLong.replace(/<[a-zA-Z]*\s[a-zA-Z]*="(\s)*">/g,'');
	
	// 6- Le resultat ne contient plus de code html
	
	return contentfckLong;
}

function createMenu (menuName) {
	src = '<ul>' + createMenuItem (menuName, -1, 0, 0) + '</ul>' ;
	return (src) ;
}

function createMenuItem (menuName, parentIndex, itemIndex, level) {
	src = '' ;
	selected = '';
	//if ((menuName[itemIndex][3] != undefined) && (menuName[itemIndex][3].length > 0) &&  (menuactive[level] ) == itemIndex) {
	if ((menuName[itemIndex][3] != undefined) && (menuName[itemIndex][3].length > 0)) {
		src = '<ul>' + createMenuItem (menuName[itemIndex][3], itemIndex, 0, level + 1) + '</ul>';
	}
	
	if (parentIndex == -1) {
		if ( menuactive[level] == itemIndex ) {
			selected = ' class="select"' ;
		}
	} else {
		if ((menuactive[level] == itemIndex) && (menuactive[level - 1] == parentIndex)) {
			selected = ' class="select"' ;
		}
	}
	
	if ( itemIndex == menuName.length - 1 ) {
		src = '<li><a href="' + menuName[itemIndex][1] + '"' + selected + ' target="'+ menuName[itemIndex][2] +'">' + menuName[itemIndex][0] + '</a>\n' + src + '</li>\n' ;
	}else{
		src = '<li><a href="' + menuName[itemIndex][1] + '"' + selected + ' target="'+ menuName[itemIndex][2] +'">' + menuName[itemIndex][0] + '</a>\n' + src + '</li>\n' + createMenuItem (menuName, parentIndex, itemIndex + 1, level) ;
	}
	//alert (level + '\n-' + src) ;
	return (src) ;
}

var popUpWin=0;

function popUpWindow(URLStr, width, height) {
	if(popUpWin) {
		if(!popUpWin.closed) popUpWin.close();
	}
		
		w_left = (screen.width - width)/2;
		w_top = (screen.height - height)/2;
		
  	popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=yes,width='+width+',height='+height+',left='+w_left+', top='+w_top+',screenX='+w_left+',screenY='+w_top+'');
}
//Différence de 2 dates
function diffDate(dateDeb,dateFin,sep)
{
	// Attention, en javascript les mois commencent à zéro
	var nbj=new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	
	datedeb = dateDeb.split(sep);
	datefin = dateFin.split(sep);
		
	
	var datedeb=new Date(datedeb[2],datedeb[1],datedeb[0],00,00,00); // Année, Mois, Jour, Heure, Minutes, Secondes
	var datefin=new Date(datefin[2],datefin[1],datefin[0],00,00,00); // Vous pouvez prendre la date du jour : var datefin=new Date();
	aad=datedeb.getYear();mmd=datedeb.getMonth()+1;jjd=datedeb.getDate();hhd=datedeb.getHours();mnd=datedeb.getMinutes();ssd=datedeb.getSeconds();
	aaf=datefin.getYear();mmf=datefin.getMonth()+1;jjf=datefin.getDate();hhf=datefin.getHours();mnf=datefin.getMinutes();ssf=datefin.getSeconds();
	if(aaf<1900){aaf=aaf+1900;}
	if(aad<1900){aad=aad+1900;}
	if(aaf%4==0){nbj[2]=29;}
	if((aaf%100==0)&&(aaf%400!=0)){nbj[2]=28;}
	if(ssf<ssd){ssf=ssf+60;mnf=mnf-1;}
	if(mnf<mnd){mnf=mnf+60;hhf=hhf-1;}
	if(hhf<hhd){hhf=hhf+24;jjf=jjf-1;}
	if(jjf<jjd){jjf=jjf+nbj[mmf];mmf=mmf-1;}
	if(mmf<mmd){mmf=mmf+12;aaf=aaf-1;}
	//Diff en année,mois,jours,min,sec
	//mes=(aaf-aad)+" ans "+(mmf-mmd)+" mois "+(jjf-jjd)+" jours "+(hhf-hhd)+" heures "+(mnf-mnd)+" minutes "+(ssf-ssd)+" secondes";
	return (aaf-aad);
}
