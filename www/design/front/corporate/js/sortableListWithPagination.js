// JavaScript Document

/* document Ready */
$( function () {
	//addEvent(window, "load", tmt_validatorInit);
	doOnLoad($("div"));
});    


function doOnLoad(context){
	$(".sortableListWithPagination", context).sortableListWithPagination();
	
	$('.errorMessage',context).hide();
	
}

$.fn.sortableListWithPagination = function() {  
	$(this).each(function(){ 
		table = $(this).find('div');
		iDebutEnreg = table.attr('iDebutEnreg');
		currentPage = table.attr('currentPage');
		nbPage = table.attr('nbPage');
		src = table.attr('src');		
		
		if( src==undefined || currentPage==undefined || nbPage==undefined){
			//alert("Le tag div doit avoir les attributs iDebutEnreg, iLimit, src,currentPage et nbPage");
			alert("The tag div should have attributs iDebutEnreg, iLimit, src,currentPage and nbPage");
			return false;
		}  
		//Gestion de la pagination 1
		if(nbPage> 1){
			//pagination = $(this).find('.pagination');
			//pagination = $(this).find('.linkPages');
			pagination = $(".linkPages");

			if(!pagination.length){
				alert("The DIV must be followed by a paragraph of pagination class");
				return false;
			}
			pagination.empty();
			pagination.append('&nbsp;&nbsp;&nbsp;')
			
			currentPage = new Number(currentPage);
			nbPage = new Number(nbPage);
			
			if(currentPage > 1){
				//lien = jQuery("<a id='prec'><img tittle='prec' id='prec' src='design/front/images/design/arrow.grey2.right.gif' alt='précédente' /></a>");
				lien = $("<a alt='prev' style='text-decoration:none'><<</a>");
				lien.attr("href", '#');
				pagination.append(lien);
				pagination.append("&nbsp;&nbsp;");   
			}
			
			
			start =1;
			stop = nbPage;
			if(nbPage > 10){
				start = currentPage -5;
				stop = currentPage + 5;
				if(start<=0){
					stop += -start+1;
					start=1;
				}
				if(stop > nbPage){
					start += nbPage-stop;
					if(start<=0){
						start=1;
					}
					stop = nbPage;
				}
			}

			for(i=start; i<=stop;i++){
				lien = $("<a alt="+i+">"+i+"</a>");
				lien.attr("href", '#');
				if(i==currentPage){
					lien.addClass("selected")
				}
				pagination.append(lien);
				
				if(i!=stop){
					// separateur de numéro de page
					pagination.append(" | ");
				}
				
			}
			
			if(currentPage < nbPage){
				
				//lien = jQuery("<a id='suiv'><img tittle='suiv' id='suiv' src='design/front/images/design/arrow.grey2.left.gif' alt='suivante' /></a>");
				//lien = jQuery("<a alt='next'>Suivante</a>");
				lien = $("<a alt='next' style='text-decoration:none'>>></a>");
				lien.attr("href", '#');
				pagination.append("&nbsp;&nbsp;");
				pagination.append(lien);
				
			}
			
			
			$("span.linkPages").prepend("&nbsp;&nbsp;Pages");
			
			//$(this).find('.linkPages > A').click(function(){
			$("span.linkPages > A").click(function(){
				// prendre le N°page séléctionnée
				page = $(this).attr('alt');
				currentPage = new Number(table.attr('currentPage'));
				
				if(page==currentPage){ //on est déjà sur la bonne page
					return false;
				}
				
				if(page == 'prev'){
					page=currentPage-1;
				}
				if(page == 'next'){
					page=currentPage+1;
				}
				
				//ajaxZone = $(this).parents('.ajaxZone');
				ajaxZone = $("div.ajaxZone");
				ajaxZone.load(src, {iDebutEnreg:iDebutEnreg, page:page}, function(){
					//doOnLoad($(this));
					doOnLoad($(this));
				});
			   
			   //alert('Page selected = '+page+' - Current page = '+currentPage+' - Limit = '+iLimit+' - Debut Enreg = '+iDebutEnreg+', src='+src);
				return false;
		   });

		}
		
	});
};

