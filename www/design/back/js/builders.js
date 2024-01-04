tmt_globalPatterns.chiffreLet = new RegExp("[.,<>0-9]");
jQuery(document).ready(function() {
	tmt_globalRules.minimumSelected = function(fieldNode){
		if(parseInt(fieldNode.options.length) < fieldNode.getAttribute("tmt:minimumSelected")){
			return false;
		}
		return true;
	}

	var iBase = $('[@name=idBase]').val();
	if(iBase != 0 && iBase != '')
	{
		$('#divTable').show();
		$('#divBuilder').show();
	}


	$('[@type=checkbox]').click(function(){
		if(this.checked)		
			$(this).val(1);
		else
			$(this).val(0);
	});

	$('[@name=idBase]').change(function(){
													// get options
		var o = this.options;
		var idBase   = $(this).val();
		
		//Nom de la base en cours
		var nameBase = o[idBase].text;		
		
		$('[@name=base]').val(nameBase);
		
		$('#divBuilder').hide();

		if(idBase != 0)	
		{
			$.getJSON(j_basepath + "index.php",{module:"builder", action:"builderBo_editeTable", nameBase:nameBase}, function(datas){
				if(datas != '' && datas['toTable'] != 0)
				{
					$('#idTable').html('');
					var html = '<option value="0">select</option>';
					for(i=0; i< datas['toTable'].length; i++)
					{
						html += '<option value="' + datas["toTable"][i]["table_id"]+'">' + datas["toTable"][i]["table_nom"] + '</option>';
					}
					$('#idTable').append(html);
					$('#idTable').val(0);
					
					$('#divTable').show();
				}
				else
				{
					alert('No table associated with this base.');
					$('#divTable').hide();
					//$('#divBuilder').hide();
					return false;
				}
			});
		}else{
			$('#divTable').hide();
			//$('#divBuilder').hide();
			return false;
		}
	});

	$('[@name=idTable]').change(function(){
		var o = this.options;
		var idTable = $(this).val();
		
		//Nom de la base en cours
		var nameBase = $('[@name=base]').val();

		//Nom de la table en cours
		var nameTable = o[idTable].text;

		$('[@name=table]').val(nameTable);
		$('[@name=builder_nomProject]').val(nameBase);
		$('[@name=builder_nomModule]').val(nameTable);
		$('[@name=builder_nomAbsModule]').val(nameTable);
		
		if(idTable !=0)
		{
			$.getJSON(j_basepath + "index.php",{module:"builder", action:"builderBo_editeBuilder", nameBase:nameBase, nameTable:nameTable}, function(datas){
				if(datas != '' && datas['toColumn'] != 0)
				{					
					//Affichage des colonnes
					$('#idBuilder').html('');										
					var html = '';					
					for(i=0; i< datas['toColumn'].length; i++)
					{
						var it = i%2+1; 
						var j = i + 1;
						html += '<tr class="row' + it + '">'; 

						    html += '<input type="hidden" name="idColTab'+ j +'" value="' + datas["toColumn"][i]["column_field"] + '">';							

							html += '<td width="20%" class="color2">' + datas["toColumn"][i]["column_field"] + '</td>';							  
							html += '<td width="20%" class="color2">' + datas["toColumn"][i]["column_type"] + '</td>';							  
							html += '<td width="20%" class="color2 _center">' + datas["toColumn"][i]["column_null"] + '</td>';							  
							html += '<td width="20%" class="color2 _center">' + datas["toColumn"][i]["column_key"] + '</td>';							  
							html += '<td width="20%" class="color2 _center">' + datas["toColumn"][i]["column_default"] + '</td>';							  
							html += '<td width="20%" class="color2">' + datas["toColumn"][i]["column_extra"] + '</td>';							  
							
							html += '<td width="20%" class="color2">' + datas["toColumn"][i]["column_table_name"] + '</td>';							  
							html += '<td width="20%" class="color2">' + datas["toColumn"][i]["column_column_name"] + '</td>';							  
							html += '<td width="20%" class="color2 _center">' + '<input type="checkbox"  name="idColumnTableShow'+ j + '" value=""/>' + '</td>';							  
							
						 html += '</tr>';
					}
					$('#idBuilder').append(html);
					$('[@name=nbColTab]').val(j);


					//Affichage de l'option  : colonne de tri dans la liste
					$('#idSortField').html('');										
					var html = '<option value="0" selected> Select</option>';					
					for(i=0; i< datas['toColumn'].length; i++)
					{
						var it = i + 1;
						html += '<option value="' + it + '">' + datas["toColumn"][i]["column_field"] + '</option>';
					}
					$('#idSortField').append(html);

					//Affichage des colonnes de références
					$('#idListeParentTable').html('');										
					var html = '';					
					var j = 1;	
					for(i=0; i< datas['toColumn'].length; i++)
					{
						if(datas["toColumn"][i]["column_key"] == 'MUL'){
							var it = i%2+1; 
							html += '<tr class="row' + it + '">'; 							
							
							    html += '<input type="hidden" name="idTabRef'+ j +'" value="' + datas["toColumn"][i]["column_field"] + '/' + datas["toColumn"][i]["column_table_name"] + '/' + datas["toColumn"][i]["column_column_name"] + '">';							
								html += '<td width="20%" class="color2">' + datas["toColumn"][i]["column_field"] + '</td>';							  
								html += '<td width="20%" class="color2">' + datas["toColumn"][i]["column_table_name"] + '</td>';							  
								html += '<td width="20%" class="color2">' + datas["toColumn"][i]["column_column_name"] + '</td>';							  							
								html += '<td width="20%" class="color2 _center">';
								html += '<select name="idListeParentTableChamp'+ j +'" id="idListeParentTableChamp'+ j +'" class="libelle" tmt:invalidvalue="0" tmt:required="true">'; 
								
								for(k=0; k< datas['toColumn'][i]["column_table_toColumn"].length; k++)
								{
									var kt = k + 1;
									html += '<option value="' + kt + '">' + datas["toColumn"][i]["column_table_toColumn"][k]["column_field"] + '</option>';
								}								
								html += '</select>'; 
								html += '</td>';							  
								html += '<td width="20%" class="color2 _center">' + '<input type="text" style="width:50px;" name="idListeParentTableChar'+ j + '" tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="" maxlength="5">' + '</td>';							  
								html += '<td width="20%" class="color2 _center">' + '<input type="checkbox"  name="idListeParentTableShow'+ j + '" value=""/>' + '</td>';							  																
							 html += '</tr>';
							 j++;
						}
					}
					$('#idListeParentTable').append(html);
					
					var nbTabRef = j - 1;
					$('[@name=nbTabRef]').val(nbTabRef);

					//Affichage des tables de dépendences
					$('#idListeChildTable').html('');
					var html = '';					
					for(i=0; i< datas['toChildTable'].length; i++)
					{
						var it = i%2+1; 
						var j = i + 1;
						html += '<tr class="row' + it + '">'; 

						    html += '<input type="hidden" name="idTabDep'+ j +'" value="' + datas["toChildTable"][i]["table_name"] + '/' + datas["toChildTable"][i]["referenced_table_name"] + '/' + datas["toChildTable"][i]["referenced_column_name"] + '">';							

							html += '<td width="20%" class="color2">' + datas["toChildTable"][i]["table_name"] + '</td>';							  
							html += '<td width="20%" class="color2">' + datas["toChildTable"][i]["referenced_table_name"] + '</td>';							  
							html += '<td width="20%" class="color2">' + datas["toChildTable"][i]["referenced_column_name"] + '</td>';							  
							html += '<td width="20%" class="color2">' + '<input type="text" style="width:50px;" name="idListeChildTableChar'+ j + '" tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="" maxlength="5">' + '</td>';							  
							
						 html += '</tr>';
					}					
					$('#idListeChildTable').append(html);

					var nbTabDep = j;
					$('[@name=nbTabDep]').val(nbTabDep);


					$('#divBuilder').show();
				}
				else
				{
					alert('No column associated with this table.');
				}
			});
		}else{
			$('#idBuilder').html('');					
			$('#divBuilder').hide();
		}
	});


	$('[@name=idSortField]').change(function(){
		var o = this.options;
		var idSortField = $(this).val();

		//Nom de la colonne de tri en cours
		var nameSortField = o[idSortField].text;

		$('[@name=sortField]').val(nameSortField);
	});


	//Génération de module
	$(".bouton").click(function(){		
								
		var nameProject 	= $('[@name=builder_nomProject]').val();
		var nameBase    	= $('[@name=base]').val();
		var nameTable   	= $('[@name=table]').val();
		var nameModule  	= $('[@name=builder_nomModule]').val();
		var nameAbsModule 	= $('[@name=builder_nomAbsModule]').val();
		
		//Page de liste
		var nameSortField 	= $('[@name=sortField]').val();



		//Liste des tables de référence
		var nbColTab = $('[@name=nbColTab]').val();
		var strColTab = '';		

		if(nbColTab > 0){
			for(i=1; i<= nbColTab; i++){				
			
				//Détermine si on affiche ou pas dans la liste?
				var obj = $('[@name=idColumnTableShow'+i+']');				
				if(obj.is(':checked')){
			
					//Ouverture
					strColTab += '[';
								   
					//Référence table			   
					strColTab += $('[@name=idColTab'+i+']').val();
					
					//Fermeture
					strColTab += ']';
				}
			}
		}
		alert(strColTab);

		//Liste des tables de référence
		var nbTabRef = $('[@name=nbTabRef]').val();
		var strTabRef = '';		

		if(nbTabRef > 0){
			for(i=1; i<= nbTabRef; i++){							

				//Détermine si on en tient compte ou pas?
				var obj = $('[@name=idListeParentTableShow'+i+']');				
				if(obj.is(':checked')){
					//Ouverture
					strTabRef += '[';
								   
					//Référence table			   
					strTabRef += $('[@name=idTabRef'+i+']').val();
					
					//Le champ référence à afficher
					var obj = $('[@name=idListeParentTableChamp'+i+']');				
					var idSortField = obj.val();								
					obj.find('option').each(function(index){
						if($(this).val() == idSortField){
							strTabRef += '/' + $(this).text();
							
						}else{
							strTabRef += '';				
						}
					});

					//Caractère
					strTabRef += '/' + $('[@name=idListeParentTableChar'+i+']').val();				
					//Fermeture
					strTabRef += ']';
				}				
			}
		}
		alert(strTabRef);
		
		//Liste des tables de dépendence
		var nbTabDep = $('[@name=nbTabDep]').val();
		var strTabDep = '';		

		if(nbTabDep > 0){
			for(i=1; i<= nbTabDep; i++){							
				//Ouverture
				strTabDep += '[';
							   
				//Référence table			   
				strTabDep += $('[@name=idTabDep'+i+']').val();
				
				//Caractère
				strTabDep += '/' + $('[@name=idListeChildTableChar'+i+']').val();				
				
				//Fermeture
				strTabDep += ']';				
			}
		}
		alert(strTabDep);
		
		//Les constantes menu response		
		var strConstMenu1 = $('[@name=idConstMenu1]').val();
		var strConstMenu2 = $('[@name=idConstMenu2]').val();
		//Concat
		var strConstMenu = '[' + strConstMenu1 + ']' + '[' + strConstMenu2 + ']';
		
		
		//Total param
		var strParams = strColTab + '&' + strTabRef + '&' + strTabDep + '&' + strConstMenu;

		//Lancer la génération
		alert('Génération du module ' + nameModule + ' pour la table ['+ nameTable +'] de la base {'+ nameBase +'}');
		
		if(nameBase !="" && nameTable !="" && nameModule !="")
		{
			$.getJSON(j_basepath + "index.php",{module:"builder", action:"builderBo_genereBuilder", nameBase:nameBase, nameTable:nameTable, nameModule:nameModule, nameProject:nameProject, nameAbsModule:nameAbsModule, nameSortField:nameSortField, strParams:strParams}, function(datas){
				if(datas != '' && datas['toTemplates'] != 0)
				{								
				}
				else
				{
					alert('No template generated with this table.');
				}
			});
		}else{
			//$('#idBuilder').html('');					
			//$('#divBuilder').hide();
		}
		
		//Fin de la génération
		alert('Génération terminée');		
		
		/*
		var iframe=$('#corporate_descriptifCourt___Frame').get(0);
		$('[@name=corporate_descriptifCourt]').val(iframe.contentWindow.FCK.GetHTML());
		*/
	
		/*var iframeLong=$('#corporate_descriptifLong___Frame').get(0);
		
		$('[@name=corporate_descriptifLong]').val(iframeLong.contentWindow.FCK.GetHTML());
		*/

	});
	//$("#idPays1").multiSelect("#idPays2", {trigger: "#add", afterMove:moveLeft });
	//$("#idPays2").multiSelect("#idPays1", {trigger: "#rem", afterMove:moveRight});

});

/*function moveLeft () {
	$("#fun_idPays1").funMultiSelect ("#fun_idPays2");
	
	$('#idPays2').sortOptions();
	codeAs='';
	$('#idPays2').find('option').each(function(index){
		if($(this).val()!= null){
			codeAs+=$(this).val();
			if(index<$('#idPays2 option').length-1){
				codeAs+=',';
			}
		}
	});
	
	$('#listeSelect').val(codeAs);
	
	
	return true;
}

function moveRight () {
	$("#fun_idPays2").funMultiSelect ("#fun_idPays1");
	$('#idPays1').sortOptions();
	codeAs='';
	$('#idPays2').find('option').each(function(index){
		if($(this).val()!= null){
			codeAs+=$(this).val();
			if(index<$('#idPays2 option').length-1){
				codeAs+=',';
			}
		}
	});
	
	$('#listeSelect').val(codeAs);
	


	return true;
}
*/