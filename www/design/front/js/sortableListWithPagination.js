$.fn.sortableListWithPagination = function() {
	$(this).each(function(){
		table = $(this).find('table');
		currentSortField = table.attr('currentSortField');
		currentSortDirection = table.attr('currentSortDirection');
		src = table.attr('src');
		currentPage = table.attr('currentPage');
		
		nbPage = table.attr('nbPage');
		if(currentSortField==undefined || currentSortDirection==undefined || src==undefined || currentPage==undefined || nbPage==undefined){
			alert("Le tag table doit avoir les attributs src, currentSortField, currentSortDirection, currentPage et nbPage");
			return true;
		}

		//Gestion de la pagination
		if(nbPage> 1){
			//1 pagination = $(this).find('.pagination');
			pagination = $(this).find('.pageNumbers');
			if(!pagination.length){
				//alert("La table doit être suivie d'un paragraphe de classe pagination");
				return false;
			}
			pagination.empty();
			//2 pagination.append('PAGE :&nbsp;&nbsp;&nbsp;')
			
			currentPage = new Number(currentPage);
			nbPage = new Number(nbPage);

			if(currentPage > 1){
				/*
				lien = jQuery("<a><<</a>");
				lien.attr("href", '#');
				pagination.append(lien);
				pagination.append("&nbsp;&nbsp;");
				*/
				li = jQuery('<li class="firstButton"></li>');
				lien = jQuery("<a>1</a>");
				lien.attr("class", 'pageFirst');
				lien.attr("alt", 'First page');
				lien.attr("href", '#');
				li.html(lien);
				pagination.append(li);								

				li = jQuery('<li class="prevButton"></li>');
				lien = jQuery("<a>Previous</a>");
				lien.attr("class", 'pagePrevious');
				lien.attr("alt", 'Previous page');
				lien.attr("href", '#');
				li.html(lien);
				pagination.append(li);								
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
				/*
				lien = jQuery("<a>"+i+"</a>");
				lien.attr("href", '#');
				if(i==currentPage){
					lien.addClass("currentPage")
				}
				pagination.append(lien);
				//alert (stop) ;
				if(i!=stop){
					pagination.append(" - ");
				}
				*/
				lien = jQuery("<a>" + i + "</a>");
				lien.attr("alt", 'page ' + i);
				lien.attr("href", '#');
				if(i==currentPage){
					lien.addClass("pageCurrent")
				}

				//alert (stop) ;
				if(i!=stop){
					li = jQuery('<li class="noButton"></li>');
				}else{
					li = jQuery('<li class="lastPage"></li>');
				}
				li.html(lien);
				pagination.append(li);								
			}

			if(currentPage < nbPage){
				/*lien = jQuery("<a>>></a>");
				lien.attr("href", '#');
				pagination.append("&nbsp;&nbsp;");
				pagination.append(lien);
				pagination.append("&nbsp;&nbsp;");
				*/
				li = jQuery('<li class="nextButton"></li>');
				lien = jQuery("<a>Next</a>");
				lien.attr("class", 'pageNext');
				lien.attr("alt", 'Next page');
				lien.attr("href", '#');
				li.html(lien);
				pagination.append(li);

				li = jQuery('<li class="lastButton"></li>');
				lien = jQuery("<a>"+stop+"</a>");
				lien.attr("class", 'pageLast');
				lien.attr("alt", 'Last page');
				lien.attr("href", '#');
				li.html(lien);
				pagination.append(li);								
			}


			//$(this).find('.pagination > A').click(function(){
			$(this).find('.pageNumbers li a').click(function(){
														   
			//$(".pagination > A", $(this)).click(function(){
														   
				page = $(this).text();
				//alert(page);										   
				currentPage = new Number(table.attr('currentPage'));
				//alert(currentPage);
				if(page==currentPage){ //on est déjà sur la bonne page
					return false;
				}
				if(page == 'Previous'){
					page=currentPage-1;
				}
				if(page == 'Next'){
					page=currentPage+1;
				}
				//alert(page);

				table = $(this).parents('.sortableListWithPagination').find('table');
				sortField = table.attr('currentSortField');
				sortDirection = table.attr('currentSortDirection');
				
				ajaxZone = $(this).parents('#contentPageMain');
				ajaxZone.load(src, {sortField:sortField, sortDirection:sortDirection,page:page}, function(){
					doOnLoad($(this));
				});

				return false;
			});

		}


		//Gestion du tri
		//Si il n'y a qu'une seule ligne dans le tableau, on ne fait rien
		if($(this).find('tbody').find('tr').length == 1){
			return;
		}
		//On applique les styles et évènements sur chaque th
		$(this).find('th').each(function(){
			sortField = $(this).attr('sortField');
			if(sortField!= undefined){
				if(sortField == currentSortField){
					if(currentSortDirection == 'DESC'){
						$(this).addClass('sortUp');
					}else{
						$(this).addClass('sortDown');
					}
				}else{
					$(this).addClass('sortable');
				}
				$(this).click(function(){
									   
									   
					sortField = $(this).attr('sortField');
					table = $(this).parents('.sortableListWithPagination').find('table');
					currentSortField = table.attr('currentSortField');
					currentSortDirection = table.attr('currentSortDirection');
					src = table.attr('src');
					
					if(sortField == currentSortField){
						if(currentSortDirection == 'DESC'){
							sortDirection = 'ASC';
						}else{
							sortDirection = 'DESC';
						}
					}else{
						sortDirection = 'ASC';
					}
					//$('#contentPageMain').html('');
					//src = '/projets/ilay-nosy/www/index.php?zone=annonce~contentPageMainAnnonceListFo&aid=2&module=commun&action=communBo_getZone';
					
					$(this).parents('#contentPageMain').load(src, {sortField:sortField, sortDirection:sortDirection}, function(){
					//$('#contentPageMain').load(src, {sortField:sortField, sortDirection:sortDirection}, function(){
						doOnLoad($(this));
					});					
					/*$(this).parents('.ajaxZone').load(src, {sortField:sortField, sortDirection:sortDirection}, function(){
						doOnLoad($(this));
					});*/					
				});
			}
		});
	});
};

