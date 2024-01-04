// JavaScript Document
var g_siteProfilSADMIN=1;
var g_siteProfilADMIN =2;
var g_siteProfilMEMBRE=3;

jQuery(document).ready(function() {
	var iProfil = $('#utilisateur_profilId').val();
	$('#utilisateur_profilId').change(function(){
		var iProfil = $(this).val();
		/*
		if((iProfil != 0) && (iProfil != g_siteProfilMEMBRE))	
		{
			var html1 = $('#marqueSelect').html();
			var html2 = $('#marque').html();
			$('#marqueSelect').html('');
			$('#marqueSelect').append(html1 + html2);
			$('#marque').html('');
			var listeSelectAll = $('#listeSelectAll').val();
			$('#listeSelect').val(listeSelectAll);
		}
		if(iProfil == g_siteProfilMEMBRE){	
			var html1 = $('#marqueSelect').html();
			var html2 = $('#marque').html();
			if(html1 == ''){
				$('#marque').html('');
				$('#marque').append(html1 + html2);
				$('#marqueSelect').html('');
				$('#listeSelect').val('');
			}
		}
		*/
	});
	
	//Test d'unicité du login
	$('#utilisateur_login').change(function(){
		var currentLogin 	= CurrentLogin;										   
		var newLogin 		= $(this).val();
		
		var loginTried = newLogin;
		
		if(loginTried != currentLogin){
			$.ajax({
				 type:"POST",
				 url:j_basepath+'index.php',
				 data:"module=utilisateur&action=utilisateurBo_unicityLogin&utilisateur_login="+$(this).val(),
				 dataType:"json",
				 async:false,
				 success:function(resultat){
					 //alert('Found user = ' + resultat.foundUser);				 
					 if(resultat.foundUser){
						alert("The login (" + loginTried + ") is already used, try another please.")	 
						$('#utilisateur_login').val('');					 
					 }
				 }
			});								
		}
	});		
});
