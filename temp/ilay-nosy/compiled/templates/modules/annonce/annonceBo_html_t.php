<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_d8bdd4c91314cc6e043dc55b4790e1a3($t){

return $t->_meta;
}
function template_d8bdd4c91314cc6e043dc55b4790e1a3($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des annonces</h1>

<?php if(isset($t->_vars['listeAnnonceBo'])):?>	
	<h2>Liste des annonces</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceBo_editionAnnonce');?>">Nouvel annonce </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeAnnonceBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'un annonce</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='annonceForm' name='annonceForm' action="<?php jtpl_function_html_jurl( $t,'annonce~annonceBo_sauvegardeAnnonce', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="annonce_id" name="annonce_id" value="<?php echo $t->_vars['annonce']->annonce_id; ?>">
		  <input type="hidden" id="annonce_abonnementId" name="annonce_abonnementId" value="<?php echo $t->_vars['annonce']->annonce_abonnementId; ?>">
          
		  <p class="clearfix">
			<label>S&eacute;lectionner une cat&eacute;gorie : *</label>
			<span class="champ">
            <select class="user_input1 user_input_select input_middle" name="categorieAnId" id="categorieAnId"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Cat&eacute;gorie:</option>
                <?php foreach($t->_vars['toCategorieAns'] as $t->_vars['oCategorieAn']):?>
                    <?php if($t->_vars['oCategorieAn']->categorieAn_id==$t->_vars['caid']):?>
                        <?php $t->_vars['selected']="selected";?>
                    <?php else:?>
                        <?php $t->_vars['selected']="";?>
                    <?php endif;?>
                    <option value="<?php echo $t->_vars['oCategorieAn']->categorieAn_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['oCategorieAn']->categorieAn_libelle; ?></option>
                <?php endforeach;?>
            </select>
			</span>
		  </p>
		  <p class="clearfix">
			<label>S&eacute;lectionner une rubrique : *</label>
			<span class="champ">
            <select class="user_input1 user_input_select input_middle" name="annonce_rubriqueId" id="annonce_rubriqueId"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Rubrique:</option>
                <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                    <?php if($t->_vars['oRubriques']->rubrique_id==$t->_vars['raid']):?>
                        <?php $t->_vars['selected']="selected";?>
                    <?php else:?>
                        <?php $t->_vars['selected']="";?>
                    <?php endif;?>
                    <?php $t->_vars['ident'] = "";?>
                    <?php for($t->_vars['i']=0; $t->_vars['i']< $t->_vars['oRubriques']->rubrique_level;$t->_vars['i']++):?>
                        <?php $t->_vars['ident'] = $t->_vars['ident'] . " -- " ;?>
                    <?php endfor;?>
                    
                    <option value="<?php echo $t->_vars['oRubriques']->rubrique_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['ident'];  echo $t->_vars['oRubriques']->rubrique_libelle; ?></option>
                <?php endforeach;?>
            </select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Titre de l'annonce: *</label>
			<span class="champ">
				<input style="width:548px;" class="user_input1" type="text" id="annonce_titre" name="annonce_titre" value="<?php echo $t->_vars['annonce']->annonce_titre; ?>" tmt:required="true" tmt:filters="" maxlength="70">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Titre de l'annonce: *</label>
			<span class="champ">
				<input style="width:548px;" class="user_input1" type="text" id="annonce_titre" name="annonce_titre" value="<?php echo $t->_vars['annonce']->annonce_titre; ?>" tmt:required="true" tmt:filters="" maxlength="70">
          	</span>
		  </p>
		  <p class="clearfix">
            <?php if($t->_vars['toForfait']->forfait_packId == 3):?>                                                                     
                <label>Salaire :</label>
            <?php else:?>
            	<label>Prix&nbsp;:</label>                                                                     
            <?php endif;?>                                                                    
			<span class="champ">
				<input class="user_input3" type="text" id="annonce_prix" name="annonce_prix" value="<?php echo $t->_vars['annonce']->annonce_prix; ?>" tmt:pattern="number" tmt:filters="" maxlength="50"> Ar 
                &nbsp;
				<input class="user_input1" type="text" id="annonce_prixInfo" name="annonce_prixInfo" value="<?php echo $t->_vars['annonce']->annonce_prixInfo; ?>" tmt:filters="" maxlength="20">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Ann&eacute;e&nbsp;: *</label>
			<span class="champ">
				<input style="width:50px;"  class="user_input3" type="text" id="annonce_annee" name="annonce_annee" value="<?php echo $t->_vars['annonce']->annonce_annee; ?>" tmt:pattern="number" tmt:filters="" maxlength="4">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Etat&nbsp;: *</label>
			<span class="champ">
            <select class="user_input3 user_input_select input_middle" name="annonce_etat" id="annonce_etat">			
                <option value="0">Etat&nbsp;:</option>
                <?php if($t->_vars['toForfait']->forfait_packId == 3):?>                                                                     
                    <option value="1" <?php if($t->_vars['annonce']->annonce_etat == 1):?>selected<?php endif;?>>Tr&egrave;s urgent</option>
                    <option value="2" <?php if($t->_vars['annonce']->annonce_etat == 2):?>selected<?php endif;?>>Urgent</option>
                    <option value="3" <?php if($t->_vars['annonce']->annonce_etat == 3):?>selected<?php endif;?>>D&egrave;s que possible</option>
                 <?php else:?>
                    <option value="1" <?php if($t->_vars['annonce']->annonce_etat == 1):?>selected<?php endif;?>>Neuf</option>
                    <option value="2" <?php if($t->_vars['annonce']->annonce_etat == 2):?>selected<?php endif;?>>Usag&eacute;</option>
                    <option value="3" <?php if($t->_vars['annonce']->annonce_etat == 3):?>selected<?php endif;?>>Epave</option>
                 <?php endif;?>
            </select>                                                        
			</span>
		  </p>
		  <p class="clearfix">
			<label>Action: *</label>
			<span class="champ">
            <select class="user_input4 user_input_select input_middle" name="annonce_action" id="annonce_action"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Action:</option>
                <?php if($t->_vars['toForfait']->forfait_packId == 3):?>
                    <option value="1" <?php if($t->_vars['annonce']->annonce_action == 1):?>selected<?php endif;?>>OFFRE</option>
                    <option value="2" <?php if($t->_vars['annonce']->annonce_action == 2):?>selected<?php endif;?>>DEMANDE</option>
                <?php else:?>
                    <option value="3" <?php if($t->_vars['annonce']->annonce_action == 3):?>selected<?php endif;?>>A ACHETER</option>
                    <option value="4" <?php if($t->_vars['annonce']->annonce_action == 4):?>selected<?php endif;?>>A CHERCHER</option>
                    <option value="5" <?php if($t->_vars['annonce']->annonce_action == 5):?>selected<?php endif;?>>A LOUER</option>
                    <option value="6" <?php if($t->_vars['annonce']->annonce_action == 6):?>selected<?php endif;?>>A VENDRE</option>
                    <option value="7" <?php if($t->_vars['annonce']->annonce_action == 7):?>selected<?php endif;?>>A ECHANGER</option>
                    <option value="8" <?php if($t->_vars['annonce']->annonce_action == 8):?>selected<?php endif;?>>RENCONTRE</option>
                <?php endif;?>
            </select>                                                        
			</span>
		  </p>
		  <p class="clearfix">
			<label>Offre: *</label>
			<span class="champ">
            <select class="user_input4 user_input_select input_middle" name="annonce_offreId" id="annonce_offreId"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Offre:</option>
                <option value="1" <?php if($t->_vars['annonce']->annonce_offreId == 1):?>selected<?php endif;?>>particuli&egrave;re</option>
                <option value="2" <?php if($t->_vars['annonce']->annonce_offreId == 2):?>selected<?php endif;?>>professionnelle</option>
                <option value="3" <?php if($t->_vars['annonce']->annonce_offreId == 3):?>selected<?php endif;?>>commerciale</option>
                <option value="4" <?php if($t->_vars['annonce']->annonce_offreId == 4):?>selected<?php endif;?>>de candidat</option>
            </select>                                                        
			</span>
		  </p>

		  <h2>Personne &agrave; contacter</h2>

		  <p class="clearfix">
			<label>Nom: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="annonce_contactNom" name="annonce_contactNom" value="<?php if($t->_vars['annonce']->annonce_contactNom != ""): echo $t->_vars['annonce']->annonce_contactNom;  else: echo $t->_vars['utilisateur']->utilisateur_nom;  endif;?>" tmt:required="true" tmt:filters="" maxlength="50">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Pr&eacute;nom: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="annonce_contactPrenom" name="annonce_contactPrenom" value="<?php if($t->_vars['annonce']->annonce_contactPrenom != ""): echo $t->_vars['annonce']->annonce_contactPrenom;  else: echo $t->_vars['utilisateur']->utilisateur_prenom;  endif;?>" tmt:required="true" tmt:filters="" maxlength="50">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Email: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="annonce_contactEmail" name="annonce_contactEmail" value="<?php if($t->_vars['annonce']->annonce_contactEmail != ""): echo $t->_vars['annonce']->annonce_contactEmail;  else: echo $t->_vars['utilisateur']->utilisateur_email;  endif;?>" tmt:pattern="email" tmt:required="true" tmt:filters="" maxlength="50">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Adresse: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="annonce_contactAdresse" name="annonce_contactAdresse" value="<?php if($t->_vars['annonce']->annonce_contactAdresse != ""): echo $t->_vars['annonce']->annonce_contactAdresse;  else: echo $t->_vars['utilisateur']->utilisateur_adresse;  endif;?>" tmt:required="true" tmt:filters="" maxlength="50">
          	</span>
		  </p>
                                                    
		  <p class="clearfix">
			<label>Province: *</label>
			<span class="champ">
            <select class="user_input3 user_input_select input_middle" name="provinceId" id="provinceId"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Province:</option>
                <?php foreach($t->_vars['toProvinces'] as $t->_vars['oProvinces']):?>
                    <?php if($t->_vars['oProvinces']->province_id==$t->_vars['pid']):?>
                        <?php $t->_vars['selected']="selected";?>
                    <?php else:?>
                        <?php $t->_vars['selected']="";?>
                    <?php endif;?>
                    <option value="<?php echo $t->_vars['oProvinces']->province_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['oProvinces']->province_libelle; ?></option>
                <?php endforeach;?>
            </select>
			</span>
		  </p>
		  <p class="clearfix">
			<label>Localit&eacute;: *</label>
			<span class="champ">
            <select style="width:220px;" class="user_input4 user_input_select input_middle" name="annonce_localiteId" id="annonce_localiteId"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Localit&eacute;:</option>
                <?php foreach($t->_vars['toLocalites'] as $t->_vars['oLocalites']):?>
                    <?php if($t->_vars['oLocalites']->localite_id==$t->_vars['lid']):?>
                        <?php $t->_vars['selected']="selected";?>
                    <?php else:?>
                        <?php $t->_vars['selected']="";?>
                    <?php endif;?>
                    <option value="<?php echo $t->_vars['oLocalites']->localite_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['oLocalites']->localite_code; ?> <?php echo $t->_vars['oLocalites']->localite_libelle; ?></option>
                <?php endforeach;?>
            </select>
			</span>
		  </p>
		  <p class="clearfix">
			<label>T&eacute;l&eacute;phone: *</label>
			<span class="champ">
				<input class="user_input3" type="text" id="annonce_contactTelephone" name="annonce_contactTelephone" value="<?php if($t->_vars['annonce']->annonce_contactTelephone != ""): echo $t->_vars['annonce']->annonce_contactTelephone;  else: echo $t->_vars['utilisateur']->utilisateur_telephone;  endif;?>" tmt:pattern="phone" tmt:required="true" tmt:filters="" maxlength="50">                                                        
          	</span>
		  </p>
		  <p class="clearfix">
			<label>P&eacute;riode d'appel: *</label>
			<span class="champ">
            <select class="user_input4 user_input_select input_middle" name="annonce_contactPeriodeAppel" id="annonce_contactPeriodeAppel"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">P&eacute;riode:</option>
                <option value="1" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 1):?>selected<?php endif;?>>Matin</option>
                <option value="2" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 2):?>selected<?php endif;?>>Midi</option>
                <option value="3" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 3):?>selected<?php endif;?>>Apr&egrave;s midi</option>
                <option value="4" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 4):?>selected<?php endif;?>>Soir&eacute;e</option>
                <option value="5" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 5):?>selected<?php endif;?>>Nuit</option>
                <option value="6" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 6):?>selected<?php endif;?>>La journ&eacute;e</option>
            </select>                                                        
			</span>
		  </p>

			<div class="clearer"></div>
		  <h2>Photos</h2>
                                                	
            <div class="box_inner box_end">
                <br>
                <table width="610" height="300" class="tableLP">
                    <tbody><tr class="trLPLeft">
                        <td class="tdLPLeft">
                            <table class="tableLP">
                                <tbody><tr class="trLP">
                                    <td width="360" height="290" class="tdLPBlackBorder">
                                        <div id="profileimage" class="profileimage can_edit">
                                            <img width="360" height="270" id="profile_pic" name="profile_pic" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/popup/<?php echo $t->_vars['annonce']->annonce_photo; ?>">
                                            <input type="hidden" id="picture_id" name="picture_id" value="<?php echo $t->_vars['toPhotos'][0]->photo_id; ?>">                                                                                
                                            <input type="hidden" id="picture_photo" name="picture_photo" value="<?php echo $t->_vars['toPhotos'][0]->photo_photo; ?>">                                                                                
                                            <a title="Changer de photo" id="edit_profilepicture" class="hidden_elem">
                                                Changer de photo
                                                <span id="edit_profilepicture_icon"></span>
                                            </a>
                                            <div id="profile_picture_flyout" class="flyout_menu hidden_elem flyout_menu_18 link_menu">
                                                <div class="flyout_menu_header_shadow">
                                                    <div class="flyout_menu_header clearfix">
                                                        <div class="flyout_menu_mask"></div>
                                                        <div class="flyout_menu_title">Modifier</div>
                                                    </div>
                                                </div>
                                                <div class="flyout_menu_content_shadow">
                                                    <div class="menu_content">
                                                        <div class="wrapper">
                                                            <a title="Charger une nouvelle photo" class="icon_link" id="profile_picture_upload" rel="dialog">Charger une photo</a>
                                                            <a title="Si vous le souhaitez, supprimez cette photo" class="icon_link" id="profile_picture_remove" rel="dialog">Supprimer la photo</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>          
                                        </div>                                                                      
                                    </td>
                                </tr>
                                <!--
                                <tr class="trLP">
                                    <td class="tdLPCenter"><a href="javascript:afficheImage();" class="cmtt">Voir toutes les photos</a></td>
                                </tr>
                                -->
                            </tbody></table>
                        </td>                                   
                
                        <td class="tdLPRight">
                        

                            <div class="divright">
                                <table class="tableLP">
                                    <tbody>
                                    <?php $t->_vars['i']=0;?>
                                    <?php foreach($t->_vars['toPhotos'] as $t->_vars['oPhotos']):?>
                                        <?php if($t->_vars['i'] == 0):?>
                                        <tr class="trLP">
                                            <td class="tdLP">
                                                <p class="img_thumb">
                                         <?php endif;?>       
                                                    <a id="linkthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" href="javascript:voirImg('<?php echo $t->_vars['oPhotos']->photo_photo; ?>', <?php echo $t->_vars['oPhotos']->photo_id; ?>);"><img width="90" height="68" onmouseover="voirImg('<?php echo $t->_vars['oPhotos']->photo_photo; ?>', <?php echo $t->_vars['oPhotos']->photo_id; ?>);" border="0" id="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" name="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" alt="<?php echo $t->_vars['oPhotos']->photo_photo; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/abrege/<?php echo $t->_vars['oPhotos']->photo_photo; ?>"></a>

                                        <?php if($t->_vars['i'] == 1):?>
                                                </p>
                                            </td>
                                        </tr>
                                        <?php endif;?>
                                        <?php $t->_vars['i']++;?>
                                        <?php if($t->_vars['i'] > 1 ):?>
                                            <?php $t->_vars['i']=0;?>
                                        <?php endif;?>
                                    <?php endforeach;?>

                                </tbody></table>
                            </div>
                        </td>
                    </tr>
                </tbody></table>

                <div class="clearer"></div>
            </div>

		  <p class="clearfix">
			<label>R&eacute;sum&eacute;: </label>
			<span class="champ">
				<textarea style="width:608px;height:60px;" class="user_input_select1" id="annonce_resume" name="annonce_resume" rows="5" tmt:filters="" ><?php echo $t->_vars['annonce']->annonce_resume; ?></textarea>
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Description g&eacute;n&eacute;rale: *</label>
			<span class="champ">
				<textarea style="width:608px;height:150px;" class="user_input_select1" id="annonce_description" name="annonce_description" rows="10" tmt:required="true"><?php echo $t->_vars['annonce']->annonce_description; ?></textarea>
          	</span>
		  </p>

		  <h2>Publication</h2>
          
		  <p class="clearfix" style="display: block;">
			<label>Publier:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="annonce_publier" name="annonce_publier" <?php if($t->_vars['annonce']->annonce_publier == 1):?>checked<?php endif;?> value="1">
			</span>
		  </p>	
		  <p class="clearfix" style="display: block;">
			<label>PublierHome:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="annonce_publierHome" name="annonce_publierHome" <?php if($t->_vars['annonce']->annonce_publierHome == 1):?>checked<?php endif;?> value="1">
			</span>
		  </p>	
		  <p class="clearfix" style="display: block;">
			<label>A la Une:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="annonce_laUne" name="annonce_laUne" <?php if($t->_vars['annonce']->annonce_laUne == 1):?>checked<?php endif;?> value="1">
			</span>
		  </p>	
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceBo_listeAnnonces', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>

    <?php if($t->_vars['annonce']->annonce_id != 0):?>
    <div id="generic_dialog_popup" class="generic_dialog pop_dialog hidden_elem">
        <div class="generic_dialog_popup">
            <div class="pop_container_advanced">
                <div id="pop_content" class="pop_content">
                    <h2 class="dialog_title">
                        <span>Chargez une nouvelle photo</span>
                    </h2>
                    <div class="dialog_content">
                        <div class="dialog_body">
                            <div id="profile_pic_form">
                                <form id="form_upload_profile_pic" name="form_upload_profile_pic" method="post" enctype="multipart/form-data">
                                    <input type="hidden" id="photo_id" name="photo_id" value="<?php echo $t->_vars['toPhotos'][0]->photo_id; ?>">
                                    <span>Sélectionnez un fichier image sur votre ordinateur (4&nbsp;Mo maximum)&nbsp;:</span>
                                    <div class="pfileselector">
                                        <input type="file" name="user_photo" id="user_photo" class="inputfile">
                                    </div>
                                 </form>                                                               
                                <div class="tos">
                                    Vous certifiez avoir le droit de charger et de diffuser cette photo et qu'elle est conforme aux 
                                    <a target="_blank" title="Conditions d'utilisation" href="#">Conditions d'utilisation</a>.
                                </div>
                            </div>
                            <div id="profile_pic_upload_indicator" class="profile_pic_display_none">
                                <img alt="" src="http://static.ak.fbcdn.net/rsrc.php/z5R48/hash/ejut8v2y.gif" class="img">
                                <div class="load_message">Chargement de la photo en cours</div>
                            </div>
                        </div>
                        <div class="dialog_buttons clearfix">
                            <a id="formButton_annuler" class="formButton_annuler"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>                        
    </div>

    <div id="view_pop_up" class="result_pop_up pop_up_middle hidden_elem">
        <p class="result_pop_up_top"></p>
        <div class="result_pop_up_inner">
            <p class="float_r"><a id="bt_close" title="Fermer" class="bt_close">Fermer</a></p>
            <div class="pop_up_inner">
                <span class="img_photo">
                    <img id="profile_pic_popup" name="profile_pic_popup" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/popup/<?php if($t->_vars['annonce']->annonce_photo != ""): echo $t->_vars['annonce']->annonce_photo;  else:?>nophoto.jpg<?php endif;?>" alt="<?php echo $t->_vars['annonce']->annonce_titre; ?>">
                </span>
            </div>
            <div class="result_foot">
                <?php echo $t->_vars['annonce']->annonce_titre; ?>
            </div>
        </div>
        <div class="result_pop_up_foot"></div>
    </div>                                    
    <?php endif;?>	
    
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>