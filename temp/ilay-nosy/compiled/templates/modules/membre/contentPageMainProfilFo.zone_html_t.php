<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.date_format.php');
function template_meta_7996825dc5417b2c97487aeb5747cbca($t){

return $t->_meta;
}
function template_7996825dc5417b2c97487aeb5747cbca($t){
?>									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Edition de votre profil</span> 
                                      	</p>          
   										<p style="clear: both;">
                                        	<span class="viewTexte">Informations sur votre profil.</span>
                                        </p>
									</div>
                                    
									<form id="registerForm" name="registerForm" action="#">
	                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_id; ?>">
	                                    <input type="hidden" id="user_profil" name="user_profil" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_profilId; ?>">
	                                    <input type="hidden" id="user_login" name="user_login" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_login; ?>">
	                                    <input type="hidden" id="user_curEmail" name="user_curEmail" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_email; ?>">
	                                    <input type="hidden" id="user_profilPhoto" name="user_profilPhoto" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_photo; ?>">
	                                    <input type="hidden" id="user_statut" name="user_statut" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_statut; ?>">

                                        <div class="registerContent">                                      	
                                        
	                                        <div class="blankSeparator"></div> 
                                            <p class="registerTitre">Informations personnelles</p>

                                            <div class="registerContainer">
                                                <div class="registerLabel">
                                                    <label for="user_nom">Photo: </label>
                                                </div>
                                                <div class="registerControl">                                                
                                                    <!--div class="img_photo">
                                                        <img width="180" height="135" border="1" name="imgPrinc" src="<?php echo $t->_vars['j_basepath']; ?>resize/utilisateur/images/detail/<?php echo $t->_vars['toUtilisateur']->utilisateur_photo; ?>" alt="Dodge ram 1500 20929829">	    
                                                    </div-->                 
                                                    <div class="profileimage can_edit" id="profileimage">
                                                        <img id="profile_pic" name="profile_pic" src="<?php echo $t->_vars['j_basepath']; ?>resize/utilisateur/images/detail/<?php if($t->_vars['toUtilisateur']->utilisateur_photo != ""): echo $t->_vars['toUtilisateur']->utilisateur_photo;  else:?>nophoto.jpg<?php endif;?>" alt="<?php echo $t->_vars['toUtilisateur']->utilisateur_prenom; ?> <?php echo $t->_vars['toUtilisateur']->utilisateur_nom; ?>">	    
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
                                                                        <a title="Charger une nouvelle photo de profil" class="icon_link" id="profile_picture_upload" rel="dialog" href="#">Charger une photo</a>
                                                                        <a title="Si vous le souhaitez, supprimez votre photo de profil" class="icon_link" id="profile_picture_remove" rel="dialog" href="#">Supprimer la photo</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                                                                   
                                                                                                                                                            
                                                </div>	
                                            </div>
                                            
                                            <div class="registerContainer">
                                                <div class="registerLabel">
                                                    <label for="user_civilite">Civilit&eacute;: </label>
                                                    <label for="user_nom">Nom: *</label>
                                                    <label for="user_prenom">Pr&eacute;nom: *</label>
                                                    <label for="user_dateNaissance">Date de naissance: *</label>
                                                    <label for="user_pays">Pays de r&eacute;sidence:</label>
                                                    <label for="user_adresse">Adresse: *</label>
                                                    <label for="user_cp">Code postal: *</label>
                                                    <label for="user_ville">Ville: *</label>
                                                    <label for="user_fonction">Fonction: </label>
                                                    <label for="user_societe">Soci&eacute;t&eacute;: </label>
                                                    <label for="user_telephone">T&eacute;l&eacute;phone: * </label>
                                                    <label for="user_url">Url: </label>
                                                </div>
                                                <div class="registerControl">
                                                    <select class="user_input3 user_input_select input_middle" id="user_civilite" name="user_civilite">
                                                        <option value="0" <?php if($t->_vars['toUtilisateur']->utilisateur_civilite == 0):?>selected<?php endif;?>>Monsieur</option>
                                                        <option value="1" <?php if($t->_vars['toUtilisateur']->utilisateur_civilite == 1):?>selected<?php endif;?>>Madame</option>
                                                        <option value="2" <?php if($t->_vars['toUtilisateur']->utilisateur_civilite == 2):?>selected<?php endif;?>>Mademoiselle</option>
                                                    </select><br>
                                                    <input class="user_input1" type="text" id="user_nom" name="user_nom" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_nom; ?>" tmt:required="true" tmt:filters="" maxlength="50"><br>
                                                    <input class="user_input1" type="text" id="user_prenom" name="user_prenom" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_prenom; ?>" tmt:required="true" tmt:filters="" maxlength="50" ><br>
                                                    
                                                    <input class="user_input3" type="text" id="user_dateNaissance" name="user_dateNaissance" value="<?php echo jtpl_modifier_common_date_format($t->_vars['toUtilisateur']->utilisateur_dateNaissance,'%d/%m/%Y'); ?>" tmt:required="true" tmt:datepattern="DD/MM/YYYY" maxlength="10"><br>
        
                                                    <select class="user_input1 user_input_select input_middle" id="user_pays" name="user_pays">
                                                    <?php for($t->_vars['i']=0; $t->_vars['i']<sizeof($t->_vars['toPays']);$t->_vars['i']++):?>                                                      
                                                        <option value="<?php echo $t->_vars['toPays'][$t->_vars['i']]->pays_id; ?>" <?php if($t->_vars['toUtilisateur']->utilisateur_paysId == $t->_vars['toPays'][$t->_vars['i']]->pays_id):?>selected<?php endif;?>><?php echo $t->_vars['toPays'][$t->_vars['i']]->pays_libelle; ?></option>
                                                    <?php endfor;?>
                                                    </select><br>
                                                    <input class="user_input1" type="text" id="user_adresse" name="user_adresse" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_adresse; ?>" tmt:required="true" tmt:filters="" maxlength="100"><br>                                            
                                                    <input class="user_input5" type="text" id="user_cp" name="user_cp" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_cp; ?>" tmt:required="true"  tmt:pattern="number" tmt:filters="" maxlength="5" ><br>
                                                    <input class="user_input2" type="text" id="user_ville" name="user_ville" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_ville; ?>" tmt:required="true" tmt:filters="" maxlength="100"><br>                                            
                                                    
                                                    <input class="user_input2" type="text" id="user_fonction" name="user_fonction" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_fonction; ?>" tmt:filters="" maxlength="50"><br>                                            
                                                    <input class="user_input2" type="text" id="user_societe" name="user_societe" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_societe; ?>" tmt:filters="" maxlength="50"><br>                                            
                                                    <input class="user_input2" type="text" id="user_telephone" name="user_telephone" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_telephone; ?>" tmt:required="true"  tmt:pattern="phone" tmt:filters="" maxlength="50"><br>                                            
        
                                                    <input class="user_input2" type="text" id="user_url" name="user_url" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_url; ?>" tmt:filters="" maxlength="50">                                            
                                                    
                                                </div>	
                                            </div>    
                                            
	                                        <div class="blankSeparator"></div> 
	                                        <div class="articleSeparator"></div> 
											
                                            <div class="profileCompte">
                                                <p class="registerTitre">Compte d'acc&egrave;s</p>
                                                
                                                <div class="registerContainer">
                                                    <div class="registerLabel">
                                                        <label for="user_email">Adresse email: *</label>
                                                        <label for="user_password">Mot de passe: *</label>
                                                        <label for="user_password2">Retaper mot de passe: *</label>
                                                    </div>
                                                    <div class="registerControl">
                                                        <input class="user_input2" type="text" id="user_email" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_email; ?>" name="user_email" tmt:required="true" tmt:pattern="email" tmt:filters="" maxlength="50" >                                                        
                                                        <input class="user_input2" type="password" id="user_password" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_password; ?>" name="user_password" tmt:required="true" tmt:twoequal="user_password2" tmt:filters="" maxlength="50" >
                                                        <input class="user_input2" type="password" id="user_password2" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_password; ?>" name="user_password2" tmt:required="true" tmt:twoequal="user_password" tmt:filters="" maxlength="50" >
                                                    </div>	
                                                </div>
                                                        <div id="message_email_flyout" class="hidden_elem">
                                                            <div id="innerpageAnnounce">
                                                                <h4 id="innerpageAnnounceTop" class="mast_immobilier">Gestion de profil</h4>
                                                                <ul class="secondaryAnnounce">
                                                                
                                                                    <li style="text-align:center;">
                                                                    <img class="" alt="Votre email est en cours de v&eacute;rification. Merci de patienter." src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v7/loading_spin_FR_blak.gif">
                                                                    </li>
                                                                    <li style="text-align:center;">
                                                                        <span class="announceTitle">
                                                                            Votre email est en cours de v&eacute;rification. Merci de patienter.
                                                                        </span>
                                                                    </li>      
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div id="message_email_duplicate_flyout" class="hidden_elem">
                                                            <div id="innerpageAnnounce">
                                                                <h4 id="innerpageAnnounceTop" class="mast_immobilier">Gestion de profil</h4>
                                                                <ul class="secondaryAnnounce">
                                                                
                                                                    <li style="text-align:center;">
                                                                    <img width="10" height="30" class="" alt="L'adresse email est déjà utilisée, réessayez avec une autre." src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v7/exclamation.gif">
                                                                    </li>
                                                                    <li style="text-align:center;">
                                                                        <span class="announceTitle">
                                                                        <img class="icon_error" src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/icon_error.gif">
                                                                        L'adresse email est déjà utilisée, réessayez avec une autre.
                                                                        </span>
                                                                    </li>      
                                                                    <li style="text-align:right;">
                                                                        <span class="announceTitle">
                                                                           <a id="formButtonOk" class="formButton_ok"> </a>
                                                                        </span>
                                                                    </li>      
                                                                </ul>
                                                            </div>
                                                        </div>
                                            </div>
                                            
                                            <div class="blankSeparator"></div> 
	                                        <div class="articleSeparator"></div> 
                                            <p class="registerTitre">En cas d'oubli de votre compte ou mot de passe</p>

                                            <div class="registerContainer">
                                                <div class="registerLabel">
                                                    <label for="user_question">Question secr&egrave;te:</label>
                                                    <label for="user_reponse">Votre r&eacute;ponse: *</label>
                                                </div>
                                                <div class="registerControl">                                                
                                                    <select style="width:320px" class="user_input1 user_input_select input_middle" id="user_question" name="user_question">
                                                        <option value="1" <?php if($t->_vars['toUtilisateur']->utilisateur_question == 1):?>selected<?php endif;?>>Quel est le sport que vous avez préféré pratiquer?</option>
                                                        <option value="2" <?php if($t->_vars['toUtilisateur']->utilisateur_question == 2):?>selected<?php endif;?>>Quel est votre livre préféré ?</option>
                                                        <option value="3" <?php if($t->_vars['toUtilisateur']->utilisateur_question == 3):?>selected<?php endif;?>>Quel est le nom de famille de votre musicien préféré ?</option>
                                                        <option value="4" <?php if($t->_vars['toUtilisateur']->utilisateur_question == 4):?>selected<?php endif;?>>Quelle était la marque de votre première voiture ?</option>
                                                    </select>
                                                    <input class="user_input1" type="text" id="user_reponse" name="user_reponse" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_reponse; ?>"  tmt:required="true">
                                                    
                                                </div>	
											</div>
	                                        <div class="blankSeparator"></div> 
	                                        <div class="articleSeparator"></div> 
                                            <a class="formButton_modifier">valid</a>
                                            
                                            <div style="height:5px;"></div>
                                            
                                        </div>
								 		<p class="errorMessage" id="errorMessage"></p>                                          
									</form>
                                    
                                    
                                    <div id="generic_dialog_popup" class="generic_dialog pop_dialog hidden_elem">
                                        <div class="generic_dialog_popup">
                                            <div class="pop_container_advanced">
                                                <div id="pop_content" class="pop_content">
                                                    <h2 class="dialog_title">
                                                        <span>Chargez votre photo de profil</span>
                                                    </h2>
                                                    <div class="dialog_content">
                                                        <div class="dialog_body">
                                                            <div id="profile_pic_form">
			                                                    <form id="form_upload_profile_pic" name="form_upload_profile_pic" method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $t->_vars['toUtilisateur']->utilisateur_id; ?>">                                                                                
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
                <img id="profile_pic_popup" name="profile_pic_popup" src="<?php echo $t->_vars['j_basepath']; ?>resize/utilisateur/images/popup/<?php if($t->_vars['toUtilisateur']->utilisateur_photo != ""): echo $t->_vars['toUtilisateur']->utilisateur_photo;  else:?>nophoto.jpg<?php endif;?>" alt="<?php echo $t->_vars['toUtilisateur']->utilisateur_prenom; ?> <?php echo $t->_vars['toUtilisateur']->utilisateur_nom; ?>">
            </span>
        </div>
        <div class="result_foot">
        	<?php echo $t->_vars['toUtilisateur']->utilisateur_prenom; ?> <?php echo $t->_vars['toUtilisateur']->utilisateur_nom; ?>
        </div>
    </div>
    <div class="result_pop_up_foot"></div>
</div>                                    
                                    <?php 
}
?>