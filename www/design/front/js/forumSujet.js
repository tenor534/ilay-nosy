// JavaScript Document
/*
function addSujet(){
	var tbody = $('#tableListeSujet').find('#tbodyComment');
	var curTbodyInnerHtml = tbody.html();

	tbody.html('');		
	
	tr     = jQuery('<tr id="lineAdd"></tr>');
	trSave = jQuery(curTbodyInnerHtml);
	
	td1 = jQuery('<td></td>');
	td2 = jQuery('<td></td>');
	td3 = jQuery('<td></td>');
	td4 = jQuery('<td></td>');

	//Attributs
	td1.attr("class", 'forumBody0');		
	td2.attr("class", 'forumBody2');
	td3.attr("class", 'forumBody4');
	td4.attr("class", 'forumBody3');

	td1.attr("id", 'forumBody0');
	
	//Recueil info User
	var acid 		 = $('#acid').val();
	var id 		 	 = $('#userId').val();
	var login 		 = $('#userLogin').val();
	var photo 		 = $('#userPhoto').val();
	var dateCreation = $('#userDateCreation').val();
	var nbComment	 = $('#userNbComment').val();
	
	var strTd1 = '<input style="width:288px;" class="user_input1" type="text" id="userSujet" name="userSujet" value="" maxlength="100">';
	var strTd2 = '<p>0</p>';
	var strTd3 = '<a class="lastPost" href="#">'+login+'</a>';
	var strTd4 = '<p></p>';

	//Contenus
	content1 = jQuery(strTd1);
	content2 = jQuery(strTd2);
	content3 = jQuery(strTd3);
	content4 = jQuery(strTd4);
	
	//Add contenu
	td1.html(content1);
	td2.html(content2);
	td3.html(content3);
	td4.html(content4);
	
	//Append
	tr.append(td1);		
	tr.append(td2);				
	tr.append(td3);				
	tr.append(td4);				
	
	tbody.append(tr);
	tbody.append(trSave);				

	//Desactive button : Ajouter
	$('#formButton_add').addClass("hidden_elem");
	$('#formButton_ok').removeClass("hidden_elem");	
}
function validSujet(){
	//Recueil info User
	var sujet_forumId 	 	 = $('#fid').val();
	var sujet_utilisateurId  = $('#userId').val();
	var sujet_titre	 	 	 = $('#userSujet').val();

	//alert(document.newsForm.userComment.value);

	if(document.newsForm.userSujet.value.length == 0){
		$('#errorMessage').html('Votre sujet est vide');
		$('#userSujet').addClass('invalid');
		$('#errorMessage').removeClass("hidden_elem");		
		return false;			
	}
	else{
		//Traitement du formulaire  d'annonce
		$('#userSujet').removeClass('invalid');
		$('#errorMessage').html('');
		$('#errorMessage').addClass("hidden_elem");		

		$.ajax({
			 type:"POST",
			 url:j_basepath+'index.php',
			 data:"module=forum&action=forumFo_forumAddSujet&sujet_forumId="+sujet_forumId+"&sujet_utilisateurId="+sujet_utilisateurId+"&sujet_titre="+sujet_titre,
			 dataType:"json",
			 async:false,
			 success:function(datas){

				if(datas != '' && datas['sujet'] != 0)
				{
					var html = '<a class="blueHead" href="index.php?fid='+sujet_forumId+'&sid='+datas["sujet"]["id"]+'&module=forum&action=forumFo_forumMessageList">'+datas["sujet"]["titre"]+'</a>';

					$('#forumBody0').html('');
					$('#forumBody0').append(html);

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
}
*/
jQuery(document).ready(function() {

	//Desactive button : Ajouter
	$('#formButton_ok').addClass("hidden_elem");		
	$('#errorMessage').removeAttr("style");
	$('#errorMessage').attr("style", 'float:left;margin-left:300px;');		
	$('#errorMessage').addClass("hidden_elem");		
	
	//Ajouter un nouveau commentaire	
	$("#formButton_add").click(function(){

		var tbody = $('#tableListeSujet').find('#tbodyComment');
		var curTbodyInnerHtml = tbody.html();

		tbody.html('');		
		
		tr     = jQuery('<tr id="lineAdd"></tr>');
		trSave = jQuery(curTbodyInnerHtml);
		
		td1 = jQuery('<td></td>');
		td2 = jQuery('<td></td>');
		td3 = jQuery('<td></td>');
		td4 = jQuery('<td></td>');

		//Attributs
		td1.attr("class", 'forumBody0');		
		td2.attr("class", 'forumBody2');
		td3.attr("class", 'forumBody4');
		td4.attr("class", 'forumBody3');

		td1.attr("id", 'forumBody0');
		
		//Recueil info User
		var acid 		 = $('#acid').val();
		var id 		 	 = $('#userId').val();
		var login 		 = $('#userLogin').val();
		var photo 		 = $('#userPhoto').val();
		var dateCreation = $('#userDateCreation').val();
		var nbComment	 = $('#userNbComment').val();
		
		var strTd1 = '<input style="width:288px;" class="user_input1" type="text" id="userSujet" name="userSujet" value="" maxlength="100">';
		var strTd2 = '<p>0</p>';
		var strTd3 = '<a class="lastPost" href="#">'+login+'</a>';
		var strTd4 = '<p></p>';

		//Contenus
		content1 = jQuery(strTd1);
		content2 = jQuery(strTd2);
		content3 = jQuery(strTd3);
		content4 = jQuery(strTd4);
		
		//Add contenu
		td1.html(content1);
		td2.html(content2);
		td3.html(content3);
		td4.html(content4);
		
		//Append
		tr.append(td1);		
		tr.append(td2);				
		tr.append(td3);				
		tr.append(td4);				
		
		tbody.append(tr);
		tbody.append(trSave);				

		//Desactive button : Ajouter
		$('#formButton_add').addClass("hidden_elem");
		$('#formButton_ok').removeClass("hidden_elem");	
	});		
	
	//Valider le nouveau commentaire
	$("#formButton_ok").click(function(){

		//Recueil info User
		var sujet_forumId 	 	 = $('#fid').val();
		var sujet_utilisateurId  = $('#userId').val();
		var sujet_titre	 	 	 = $('#userSujet').val();

		//alert(document.newsForm.userComment.value);

		if(document.newsForm.userSujet.value.length == 0){
			$('#errorMessage').html('Votre sujet est vide');
			$('#userSujet').addClass('invalid');
			$('#errorMessage').removeClass("hidden_elem");		
			return false;			
		}
		else{
			//Traitement du formulaire  d'annonce
			$('#userSujet').removeClass('invalid');
			$('#errorMessage').html('');
			$('#errorMessage').addClass("hidden_elem");		
	
			$.ajax({
				 type:"POST",
				 url:j_basepath+'index.php',
				 data:"module=forum&action=forumFo_forumAddSujet&sujet_forumId="+sujet_forumId+"&sujet_utilisateurId="+sujet_utilisateurId+"&sujet_titre="+sujet_titre,
				 dataType:"json",
				 async:false,
				 success:function(datas){
	
					if(datas != '' && datas['sujet'] != 0)
					{
						var html = '<a class="blueHead" href="index.php?fid='+sujet_forumId+'&sid='+datas["sujet"]["id"]+'&module=forum&action=forumFo_forumMessageList">'+datas["sujet"]["titre"]+'</a>';
	
						$('#forumBody0').html('');
						$('#forumBody0').append(html);
	
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