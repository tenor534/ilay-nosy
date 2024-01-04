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
			pagination = $(this).find('.pagination');
			if(!pagination.length){
				//alert("La table doit être suivie d'un paragraphe de classe pagination");
				return false;
			}
			pagination.empty();
			pagination.append('PAGE :&nbsp;&nbsp;&nbsp;')
			
			currentPage = new Number(currentPage);
			nbPage = new Number(nbPage);

			if(currentPage > 1){
				lien = jQuery("<a><<</a>");
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
			}

			if(currentPage < nbPage){
				lien = jQuery("<a>>></a>");
				lien.attr("href", '#');
				pagination.append("&nbsp;&nbsp;");
				pagination.append(lien);
			}


			$(this).find('.pagination > A').click(function(){
			//$(".pagination > A", $(this)).click(function(){
				page = $(this).text();
				currentPage = new Number(table.attr('currentPage'));
				if(page==currentPage){ //on est déjà sur la bonne page
					return false;
				}
				if(page == '<<'){
					page=currentPage-1;
				}
				if(page == '>>'){
					page=currentPage+1;
				}
				table = $(this).parents('.sortableListWithPagination').find('table');
				sortField = table.attr('currentSortField');
				sortDirection = table.attr('currentSortDirection');
				
				ajaxZone = $(this).parents('.ajaxZone');
//alert(sortField + " -- " + sortDirection + " -- " + src + " --- " + page);
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

					$(this).parents('.ajaxZone').load(src, {sortField:sortField, sortDirection:sortDirection}, function(){
						doOnLoad($(this));
					});
					
				});
			}
		});
	});
};

