// JavaScript Document
var g_supprvisuel 	= 1;

//Etat d'affichage des zones
function onCheck(obj)
{
	if(obj.checked)		
		$(obj).val(1);
	else
		$(obj).val(0);
	return true;
}

//Le forfait selectionné
function selectItem(obj){
	//document.creditForm.credit_forfaitId.value = $(obj).val();
	$('#credit_forfaitId').val($(obj).val());
}

jQuery(document).ready(function() {
	
	var check1 = true; 
	var check2 = false; 

	//Affiche le popup
	$("#credit_delais1").click(function(){
		 check1 = !check1;
		 check2 = !check2;			 
		 $(this).removeAttr("checked");
		 $(this).attr("checked",check1);

		 if (check1==true){
			$("#credit_delais2").removeAttr("checked");
			$('#crRecharge').removeClass("hidden_elem");			 
		 }else{
			$("#credit_delais2").attr("checked",check2);			 
			$('#crRecharge').addClass("hidden_elem");
		 }

		 $("#credit_codePIN").removeAttr("tmt:required");
		 $("#credit_password").removeAttr("tmt:required");
		 
		 $("#credit_codePIN").attr("tmt:required","true");
		 $("#credit_password").attr("tmt:required","true");		 
	});	
	$("#credit_delais2").click(function(){
		 check1 = !check1;
		 check2 = !check2;			 
		 $(this).removeAttr("checked");
		 $(this).attr("checked",check2);

		 if (check2==true){
			 $("#credit_delais1").removeAttr("checked");
			$('#crRecharge').addClass("hidden_elem");
		 }else{
			 $("#credit_delais1").attr("checked",check1);			 
			$('#crRecharge').removeClass("hidden_elem");			 
		 }
		 
		 $("#credit_codePIN").removeAttr("tmt:required");
		 $("#credit_password").removeAttr("tmt:required");
	});	
	
	//Valider le formulaire de code de recharge
	$(".formButton_valid").click(function(){

		if (!tmt_validateForm(document.creditForm)) {
			return false;			
		}
		else{
			//Vider le message d'erreur
			$('#errorMessage').html('');

			//Traitement de la photo
			var options = {
				 type:"POST",
				 url:j_basepath+'index.php?module=abonnement&action=abonnementFo_sauvegardeAbonnement',
				 success: function(msg) {
					// 'data' is an object representing the the evaluated json data
					//Change la photo de profil sur place
					//var data = $(msg).text();
					var message = "";				
					
					var obj = eval('(' + msg + ')');					
					//alert(obj.statut);
					
					if (obj.statut > 0){
						$('#errorMessage').html('');
						$('#errorMessage').attr("style", 'display: none;');
						document.location.href="index.php?module=abonnement&action=abonnementFo_abonnementList";						
					}else{
						//affiche erreur	
						//alert("Affiche une erreur");
						message = "Votre code PIN ou mot de passe est incorrect.";
						
						if(message != ""){
							$('#errorMessage').html('');
							$('#errorMessage').html('<img border="0" src="'+j_basepath+'design/front/images/v5/icon_error.gif" />&nbsp;'+message+'');
							$('#errorMessage').attr("style", '');
						}					
					}
					
					//var obj = eval('(' + "{'MSRP': 20000,'cashDown': 2000,'tradeIn': 1000}" + ')');	
					//$("#profile_pic").attr("src",""+j_basepath+"resize/utilisateur/images/detail/" + obj.imgSrc);
					
				}
			};
			$('#creditForm').ajaxSubmit(options);			

		}										  			
	});		
});