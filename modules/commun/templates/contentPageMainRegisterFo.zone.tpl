							<div class="row" id="mainRegister">
	                            <div class="header">
                                	<h3>Cr&eacute;ation d' une session Ilay NOSY</h3>
                                </div><!-- header:[end] -->
                                <div class="singleColumnBig">
									<p class="registerList">
                                    	Cr&eacute;er un compte est totalement gratuit pour devenir <strong>membre</strong> sur le site Ilay NOSY.
                                    </p>
                                    <p> 
										Devenir membre vous permet de profiter d'une foule d'avantages exclusifs! Vous pourrez ainsi...
                                    </p>

                                    <ul class="registerList">
                                        <li><span class="puce">&raquo; </span><span class="titre">Contacter ou envoyer des courriels aux annonceurs;</span></li>
                                        <li><span class="puce">&raquo; </span><span class="titre">Placer des annonces sur le service d'annonces class&eacute;es le moins cher &agrave; MADAGASCAR;</span></li>
                                        <li><span class="puce">&raquo; </span><span class="titre">Publier vos articles &agrave; vendre ou vos services &agrave; offrir &agrave; l'&eacute;chelle malgache en quelques minutes;</span></li>
                                        <li><span class="puce">&raquo; </span><span class="titre">Profiter d'un bassin de plus de 4 000 visiteurs uniques par jour qui consultent plus de 300 000 de pages par mois;</span></li>
                                        <li><span class="puce">&raquo; </span><span class="titre">Publier gratuitement vos annonces.</span></li>
                                        <li><span class="puce">&raquo; </span><span class="titre">...</span></li>
                                    </ul>

                                   	<h3>Cr&eacute;er une session sur Ilay NOSY</h3>
									<div class="ajaxZone">
									<form id="registerForm" name="registerForm" method="POST" tmt:validate="true" tmt:callback="displayError" enctype="multipart/form-data">
	                                    <input type="hidden" name="user_id" value="0">
	                                    <input type="hidden" name="user_profil" value="3">
	                                    <input type="hidden" name="user_login" value="">

                                        <div class="registerContent">                                        
                                            <p class="registerTitre">Nouveau sur Ilay NOSY?</p>                                            

                                            <label for="user_civilite">Civilit&eacute;: </label><br>
                                            <select class="user_input3 user_input_select input_middle" id="user_civilite" name="user_civilite">
                                            	<option value="0">Monsieur</option>
                                            	<option value="1">Madame</option>
                                            	<option value="2">Mademoiselle</option>
                                            </select><br>
                                            <label for="user_nom">Nom: *</label><br>
                                            <input class="user_input1" type="text" id="user_nom" name="user_nom" value="" tmt:required="true" tmt:filters="" maxlength="50"><br>
                                            <label for="user_prenom">Pr&eacute;nom: *</label><br>
                                            <input class="user_input1" type="text" id="user_prenom" name="user_prenom" value="" tmt:required="true" tmt:filters="" maxlength="50" ><br>
                                            
                                            <label for="user_dateNaissance">Date de naissance: *</label><br>
                                            <input class="user_input3" type="text" id="user_dateNaissance" name="user_dateNaissance" value="" tmt:required="true" tmt:datepattern="DD/MM/YYYY" maxlength="10">&nbsp;jj/mm/aaaa<br>

                                            <label for="user_pays">Pays de r&eacute;sidence:</label><br>
                                            <select class="user_input1 user_input_select input_middle" id="user_pays" name="user_pays">
                                            {for $i=0; $i<sizeof($toPays);$i++}  
                                            
	                                            <option value="{$toPays[$i]->pays_id}" {if $toPays[$i]->pays_id == '128'}selected{/if}>{$toPays[$i]->pays_libelle}</option>
                                            {/for}
                                            </select><br>
                                            <label for="user_nom">Adresse: *</label><br>
                                            <input class="user_input1" type="text" id="user_adresse" name="user_adresse" value="" tmt:required="true" tmt:filters="" maxlength="100"><br>                                            
                                            <label for="user_cp">Code postal: *</label><br>
                                            <input class="user_input5" type="text" id="user_cp" name="user_cp" value="" tmt:required="true"  tmt:pattern="number" tmt:filters="" maxlength="5" ><br>
                                            <label for="user_nom">Ville: *</label><br>
                                            <input class="user_input2" type="text" id="user_ville" name="user_ville" value="" tmt:required="true" tmt:filters="" maxlength="100"><br>                                            
                                            
                                            <label for="user_nom">Fonction: </label><br>
                                            <input class="user_input2" type="text" id="user_fonction" name="user_fonction" value="" tmt:filters="" maxlength="50"><br>                                            
                                            <label for="user_nom">Soci&eacute;t&eacute;: </label><br>
                                            <input class="user_input2" type="text" id="user_societe" name="user_societe" value="" tmt:filters="" maxlength="50"><br>                                            
                                            <label for="user_nom">T&eacute;l&eacute;phone: * </label><br>
                                            <input class="user_input2" type="text" id="user_telephone" name="user_telephone" value="" tmt:required="true"  tmt:pattern="phone" tmt:filters="" maxlength="50"><br>                                            

                                            <label for="user_nom">Url: </label><br>
                                            <input class="user_input2" type="text" id="user_url" name="user_url" value="" tmt:filters="" maxlength="50"><br>                                            
                                            <label for="user_nom">Photo: </label><br>
                                            <!--input class="user_file" type="file" id="user_photo" name="user_photo" value="" tmt:pattern="filepath_jpg_gif" tmt:message="Veuillez t&eacute;l&eacute;charger la photo en format 'jpg'"  size="50" maxlength="50"><br-->                                             
                                            <input class="user_file" type="file" id="user_photo" name="user_photo" maxlength="50"><br>                                             
                                            
	                                        <div class="blankSeparator"></div> 
	                                        <div class="articleSeparator"></div> 
                                            
											<div class="profileCompte">
                                                <p class="registerTitre">Compte d'acc&egrave;s</p>
                                                {*}			
                                                <label for="user_profil">Profil: </label><br>
                                                <select class="user_input2 user_input_select input_middle" id="user_profil" name="user_profil">
                                                {for $i=0; $i<sizeof($toProfilMembres);$i++}  
                                                    <option value="{$toProfilMembres[$i]->profil_id}">{$toProfilMembres[$i]->profil_libelle}</option>
                                                
                                                {/for}
                                                </select><br>
                                                {*}
                                                <label for="user_email">Adresse email: *</label><br>
                                                <input class="user_input2" type="text" id="user_email" value="" name="user_email" tmt:required="true" tmt:pattern="email" tmt:filters="" maxlength="50" ><br>                                                                    

                                                <div id="message_email_flyout" class="hidden_elem">
                                                    <div id="innerpageAnnounce">
                                                        <h4 id="innerpageAnnounceTop" class="mast_immobilier">Gestion de profil</h4>
                                                        <ul class="secondaryAnnounce">
                                                        
                                                            <li style="text-align:center;">
                                                            <img class="" alt="Votre email est en cours de v&eacute;rification. Merci de patienter." src="{$j_basepath}design/front/images/v7/loading_spin_FR_blak.gif">
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
                                                            <img width="10" height="30" class="" alt="L'adresse email est déjà utilisée, réessayez avec une autre." src="{$j_basepath}design/front/images/v7/exclamation.gif">
                                                            </li>
                                                            <li style="text-align:center;">
                                                                <span class="announceTitle">
	                                                            <img class="icon_error" src="{$j_basepath}design/front/images/v5/icon_error.gif">
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

                                                <label for="user_password">Mot de passe: *</label><br>
                                                <input class="user_input2" type="password" id="user_password" value="" name="user_password" tmt:required="true" tmt:twoequal="user_password2" tmt:filters="" maxlength="50" ><br>
                                                <label for="user_password2">Retaper mot de passe: *</label><br>
                                                <input class="user_input2" type="password" id="user_password2" value="" name="user_password2" tmt:required="true" tmt:twoequal="user_password" tmt:filters="" maxlength="50" ><br>
                                            </div>
                                            
	                                        <div class="blankSeparator"></div> 
	                                        <div class="articleSeparator"></div> 
                                            <p class="registerTitre">En cas d'oubli de votre compte ou mot de passe</p>

                                            <label for="user_question">Question secr&egrave;te:</label><br>
                                            <select style="width:320px" class="user_input1 user_input_select input_middle" id="user_question" name="user_question">
                                                <option value="1" >Quel est le sport que vous avez préféré pratiquer?</option>                   
                                                <option value="2" >Quel est votre livre préféré ?</option>                   
                                                <option value="3" >Quel est le nom de famille de votre musicien préféré ?</option>                   
                                                <option value="4" >Quelle était la marque de votre première voiture ?</option>                   
                                            </select><br>
                                            <label for="user_reponse">Votre r&eacute;ponse: *</label><br>
                                            <input class="user_input1" type="text" id="user_reponse" name="user_reponse" value=""  tmt:required="true"><br>

	                                        <div class="blankSeparator"></div> 
	                                        <div class="articleSeparator"></div> 
                                            En cliquant sur le bouton "j'accepte" ci-dessous, je certifie que j'ai lu et accepter
                                            les termes des documents suivants : <br />
                                            
                                            <ul class="registerList">
                                                <li><span class="puce">&raquo; </span><span class="titre">conditions d'utilisation de <strong>Ilay NOSY</strong></span></li>
                                                <li><span class="puce">&raquo; </span><span class="titre">donn&eacute;es personnelles</span></li>
                                            </ul>
                                            <p>
											et que j'accepte de recevoir de la part de Ilay NOSY les emails ou des notifications en rapport avec mon compte et mes crit&egrave;res de recherche.
                                            </p>
                                            <a class="formButton_accept">valid</a>                                            
                                            <br style="clear:both"><div style="height:10px;"></div>
                                        </div>
								 		<p class="errorMessage" id="errorMessage"></p>                                          
                                        <div class="articleSeparator"></div> 
                                        <div class="registerContent">
	                                        <p class="registerTitre">Vous disposez d&eacute;j&agrave; d'un compte Ilay NOSY! ?</p>
                                            <a href="{jurl 'commun~communFo_login'}" class="formButton_login">valid</a>
                                            {*}
                                            <br><br>
                                            <p><a href="{jurl 'commun~communFo_lostPassword'}">Mot de passe oubli&eacute;?</a></p>
                                            {*}
                                            <br><br>
                                            <p></p>
                                        </div>
									</form>         
                                    </div>                                                                     
                                </div><!-- :[end] -->                        		
                            </div><!-- reelFilNews:[end] -->  