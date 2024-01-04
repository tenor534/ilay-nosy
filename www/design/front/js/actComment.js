// JavaScript Document
jQuery(document).ready(function() {

	//Desactive button : Ajouter
	$('#formButton_ok').addClass("hidden_elem");		
	$('#errorMessage').removeAttr("style");
	$('#errorMessage').addClass("hidden_elem");		

	//Ajouter un nouveau commentaire
	$("#formButton_add").click(function(){

		tbody = $('.commTopic').find('#tbodyComment');
		
		tr = jQuery('<tr id="lineAdd"></tr>');
		td1 = jQuery('<td></td>');
		td2 = jQuery('<td></td>');

		//Attributs
		td1.attr("class", 'threadBody1');		
		td2.attr("class", 'threadBody2');
		td2.attr("id", 'threadBody2');
		
		//Recueil info User
		var acid 		 = $('#acid').val();
		var id 		 	 = $('#userId').val();
		var login 		 = $('#userLogin').val();
		var photo 		 = $('#userPhoto').val();
		var dateCreation = $('#userDateCreation').val();
		var nbComment	 = $('#userNbComment').val();
		
		var strTd1 = '';
		strTd1 += '<table>';
		strTd1 += '	<tbody><tr>';
		strTd1 += '		<td class="threadAvatar">';
		strTd1 += '		<a href="#">';
		strTd1 += '		<img width="80" height="60" border="0" alt="'+login+'" src="'+j_basepath+'resize/utilisateur/images/abrege/'+photo+'" name="">';
		strTd1 += '		</a>';
		strTd1 += '		</td>';
		strTd1 += '		<td class="avatarRightWrap">';
		strTd1 += '			<p class="avatarRightFirst"><a href="#" class="crumbsBlue avatarRight">'+login+'</a></p>';
		strTd1 += '				<p class="regTextPale avatarRight">'+nbComment+' message';
		
		if(nbComment > 1){
			strTd1 += 's';
		}
		strTd1 += '				</p>';
		strTd1 += '			<p class="commMember avatarRight">Membre depuis  '+dateCreation+'</p>';
		strTd1 += '			<p class="regTextPale avatarRight"></p>';
		strTd1 += '			<p class="regTextPale avatarRight"></p>';
		strTd1 += '		</td>';
		strTd1 += '	</tr>';
		strTd1 += '</tbody></table>';
				
		var strTd2 = '';
		
		strTd2 += '<p>';
		strTd2 += '	<textarea style="width:445px;height:100px;" class="user_input_select1" id="userComment" name="userComment" rows="5" tmt:required="true"></textarea>';
		strTd2 += '</p>';

		//Contenus
		content1 = jQuery(strTd1);
		content2 = jQuery(strTd2);
		
		//Add contenu
		td1.html(content1);
		td2.html(content2);
		
		//Append
		tr.append(td1);		
		tr.append(td2);				
		
		tbody.append(tr);				

		//Desactive button : Ajouter
		$('#formButton_add').addClass("hidden_elem");
		$('#formButton_ok').removeClass("hidden_elem");			
		

	});		
	
	//Valider le nouveau commentaire
	$("#formButton_ok").click(function(){

		//Recueil info User
		var comment_actualiteId 	 = $('#acid').val();
		var comment_utilisateurId 	 = $('#userId').val();
		var comment_texte	 	 	 = $('#userComment').val();

		//alert(document.newsForm.userComment.value);

		if(document.newsForm.userComment.value.length == 0){
			$('#errorMessage').html('Votre commentaire est vide');
			$('#userComment').addClass('invalid');
			$('#errorMessage').removeClass("hidden_elem");		
			return false;			
		}
		else{
			//Traitement du formulaire  d'annonce
			$('#userComment').removeClass('invalid');
			$('#errorMessage').html('');
			$('#errorMessage').addClass("hidden_elem");		
	
			$.ajax({
				 type:"POST",
				 url:j_basepath+'index.php',
				 data:"module=actualite&action=actualiteFo_actualiteAddComment&comment_actualiteId="+comment_actualiteId+"&comment_utilisateurId="+comment_utilisateurId+"&comment_texte="+comment_texte,
				 dataType:"json",
				 async:false,
				 success:function(datas){
	
					if(datas != '' && datas['commentAct'] != 0)
					{
						var html = '';
						
						html += '<p>'+datas["commentAct"]["texte"]+'</p>';
						html += '<ul>';
						html += '	<p class="regTextPaleNormal borderNoneInline">Publié le: '+datas["commentAct"]["dateCreation"]+'</p>';
						html += '	<li class="borderLeftInline">';
						html += '		<a href="#" class="hotTopics">Signaler un abus</a>';
						html += '	</li>';
						html += '</ul>';
	
						$('#threadBody2').html('');
						$('#threadBody2').append(html);
	
						//Desactive button : Ajouter
						$('#formButton_ok').addClass("hidden_elem");		
						$('#formButton_add').removeClass("hidden_elem");			
						
						//#lineAdd
						$('#lineAdd').removeAttr("id");
						$('#threadBody2').removeAttr("id");						
					}
					else
					{
	
						return false;
					}
				}
			});
		}
	});			
});