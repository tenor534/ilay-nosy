<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
function template_meta_0743116f8c36f3615b73a885fe0c5534($t){

return $t->_meta;
}
function template_0743116f8c36f3615b73a885fe0c5534($t){
?>									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Edition d'une annonce</span> 
                                      	</p>          
   										<p style="clear: both;"></p>
									</div>

                                    <div class="ajaxZone">
                                        <form enctype="multipart/form-data" id='annonceForm' name='annonceForm' action="#" method="POST" tmt:validate="true" tmt:callback="displayError">                                        
                                         	<input type="hidden" id="annonce_id" name="annonce_id" value="<?php echo $t->_vars['annonce']->annonce_id; ?>">
                                         	<input type="hidden" id="annonce_abonnementId" name="annonce_abonnementId" value="<?php echo $t->_vars['annonce']->annonce_abonnementId; ?>">
                                            
                                         	<input type="hidden" id="annonce_laUne" name="annonce_laUne" value="<?php echo $t->_vars['annonce']->annonce_laUne; ?>">


                                            <div id="middleCol">
                                                <div class="box" id="box_annonce">
                                                    <div class="box_inner box_end box_annonce_top">

                                                        <div id="cat_breadcrumbs">
                                                            <ul class="cat_breadcrumbs">
                                                            		<?php $t->_vars['categorieAn'] = "";?>
                                                                    <?php foreach($t->_vars['toCategorieAns'] as $t->_vars['oCategorieAn']):?>
                                                                        <?php if($t->_vars['oCategorieAn']->categorieAn_id==$t->_vars['caid']):?>
                                                                            <?php $t->_vars['categorieAn'] = $t->_vars['oCategorieAn']->categorieAn_libelle;?>
                                                                        <?php endif;?>
                                                                    <?php endforeach;?>
                                                                    
                                                            		<?php $t->_vars['rubrique'] = "";?>
                                                                    <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                                        <?php if($t->_vars['oRubriques']->rubrique_id==$t->_vars['raid']):?>
                                                                            <?php $t->_vars['rubrique'] = $t->_vars['oRubriques']->rubrique_libelle;?>
                                                                        <?php endif;?>
                                                                    <?php endforeach;?>
                                                            
                                                                <li><a href="#"><?php echo $t->_vars['categorieAn']; ?></a></li>
                                                                <li><span>&gt;</span> <a href="#"><?php echo $t->_vars['rubrique']; ?></a></li>
                                                                
                                                            </ul>
                                                        </div>
                                                    
                                                        <div id="categ_rubrique">
                                                            <div id="edit_categorie">
                                                                <p style="clear: both;"></p>
                                                                <label for="forum_parue">S&eacute;lectionner une cat&eacute;gorie : </label><br>
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
                                                            </div>      
                                                            <div id="edit_rubrique">
                                                                <p style="clear: both;"></p>
                                                                <label for="forum_parue">S&eacute;lectionner une rubrique : </label><br>
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
                                                            </div>      
                                                      	</div>                                                        
                                                    
                                                    
                                                        <div id="view_titre">
	                                                        <h1 class="txt_arrows"><?php echo $t->_vars['annonce']->annonce_titre; ?></h1>
                                                        </div>
                                                        <div id="edit_titre">
					   										<p style="clear: both;"></p>
                                                            <label for="user_nom">Titre de l'annonce: *</label><br>
                                                            <input style="width:548px;" class="user_input1" type="text" id="annonce_titre" name="annonce_titre" value="<?php echo $t->_vars['annonce']->annonce_titre; ?>" tmt:required="true" tmt:filters="" maxlength="70">
                                                        </div>
                                                
														<ul class="split">
                                                            <?php if($t->_vars['annonce']->annonce_id != 0):?>
                                                                <?php if($t->_vars['iFirst']):?>                                                
                                                                    <li class="inline"><a class="link_d" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceEdit', array('anid'=>$t->_vars['iFirst'], 'page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>">D&eacute;but</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iBack']):?>                                                
                                                                    <li class="inline"><a class="link_p" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceEdit', array('anid'=>$t->_vars['iBack'], 'page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>">Annonce pr&eacute;c&eacute;dente</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iNext']):?>                                                
                                                                    <li class="inline"><a class="link_s" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceEdit', array('anid'=>$t->_vars['iNext'], 'page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>">Annonce suivante</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iLast']):?>                                                
                                                                    <li class="inline"><a class="link_f" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceEdit', array('anid'=>$t->_vars['iLast'], 'page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>">Fin</a></li>                                                            
                                                                <?php endif;?>   
                                                            <?php endif;?>			
                                                            <li class="" id="link_edit"><a href="#">Editer</a></li>                                                            
                                                            <li class="inline" id="link_view"><a href="#">Visualiser</a></li>                                                            
                                                            <li class="last inline"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceList', array('page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>">Retour à la liste</a></li>                                                            
                                                        </ul>
                                                        <div class="clearer"></div>
                                                    </div><!-- box_annonce_top end -->                                        
                                                    
                                                    <div class="box_inner box_end box_annonce_main_info">                                                    
                                                    
                                                        <div id="view_price" class="float">
                                                            <div class="info_list">
                                                
                                                                <dl class="price">
                                                                    <dt>Prix&nbsp;:</dt>
                                                                    <dd><div id="view_prix"><?php if($t->_vars['annonce']->annonce_prix): echo jtpl_modifier_common_format_number($t->_vars['annonce']->annonce_prix, 0, ",", ' ','Ar');  else:?>N/D<?php endif;?></div><span id="view_prixInfo"><?php echo $t->_vars['annonce']->annonce_prixInfo; ?></span></dd>
                                                                </dl>
                                                                <dl class="lieu">
                                                                    <dt>Lieu&nbsp;:</dt>
																	<?php $t->_vars['province'] = "";?>
                                                                    <?php foreach($t->_vars['toProvinces'] as $t->_vars['oProvinces']):?>
                                                                        <?php if($t->_vars['oProvinces']->province_id==$t->_vars['pid']):?>
                                                                            <?php $t->_vars['province'] = $t->_vars['oProvinces']->province_libelle;?>
                                                                        <?php endif;?>
                                                                    <?php endforeach;?>
																	<?php $t->_vars['localite'] = "";?>
                                                                    <?php foreach($t->_vars['toLocalites'] as $t->_vars['oLocalites']):?>
                                                                        <?php if($t->_vars['oLocalites']->localite_id==$t->_vars['lid']):?>
                                                                            <?php $t->_vars['localite'] = $t->_vars['oLocalites']->localite_code . " " . $t->_vars['oLocalites']->localite_libelle;?>
                                                                        <?php endif;?>
                                                                    <?php endforeach;?>
                                                                    <dd><div id="view_lieu"><?php echo $t->_vars['province']; ?> <span class="date"><?php echo $t->_vars['localite']; ?></span></div></dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Année&nbsp;:</dt>
                                                                    <dd><div id="view_annee"><?php if($t->_vars['annonce']->annonce_annee): echo $t->_vars['annonce']->annonce_annee;  else:?>N/D<?php endif;?></div></dd>
                                                                </dl>                                                
                                                                <dl>
                                                                    <?php $t->_vars['etat'] = "";?>
                                                                    <?php if($t->_vars['toForfait']->forfait_packId != 3):?>                                                                     
                                                                        <?php if($t->_vars['annonce']->annonce_etat == 1): $t->_vars['etat'] = "Neuf"; endif;?>
                                                                        <?php if($t->_vars['annonce']->annonce_etat == 2): $t->_vars['etat'] = "Usag&eacute;"; endif;?>
                                                                        <?php if($t->_vars['annonce']->annonce_etat == 3): $t->_vars['etat'] = "Epave"; endif;?>
                                                                        <?php if($t->_vars['annonce']->annonce_etat == 0): $t->_vars['etat'] = "S/O"; endif;?>
                                                                     <?php else:?>
                                                                        <?php if($t->_vars['annonce']->annonce_etat == 1): $t->_vars['etat'] = "Tr&egrave;s urgent"; endif;?>
                                                                        <?php if($t->_vars['annonce']->annonce_etat == 2): $t->_vars['etat'] = "Urgent"; endif;?>
                                                                        <?php if($t->_vars['annonce']->annonce_etat == 3): $t->_vars['etat'] = "D&egrave;s que possible"; endif;?>
                                                                        <?php if($t->_vars['annonce']->annonce_etat == 0): $t->_vars['etat'] = "S/O"; endif;?>
                                                                     <?php endif;?>   
                                                                    <dt>État&nbsp;:</dt>
                                                                    <dd><div id="view_etat"><?php echo $t->_vars['etat']; ?></div></dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="edit_price" class="float">
                                                            <div class="info_list">
                                                
                                                                <dl class="price">
                                                                    <?php if($t->_vars['toForfait']->forfait_packId == 3):?>                                                                     
                                                                        <dt>Salaire :</dt>
                                                                     <?php else:?>
																		<dt>Prix&nbsp;:</dt>                                                                     
                                                                     <?php endif;?>                                                                    
                                                                    <dd>
                                                                    	<input class="user_input3" type="text" id="annonce_prix" name="annonce_prix" value="<?php echo $t->_vars['annonce']->annonce_prix; ?>" tmt:pattern="number" tmt:filters="" maxlength="50"> Ar 
                                                                    	<span>
	                                                                        <input class="user_input1" type="text" id="annonce_prixInfo" name="annonce_prixInfo" value="<?php echo $t->_vars['annonce']->annonce_prixInfo; ?>" tmt:filters="" maxlength="20">
                                                                        </span>
                                                                    </dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Année&nbsp;:</dt>
                                                                    <dd><input style="width:50px;"  class="user_input3" type="text" id="annonce_annee" name="annonce_annee" value="<?php echo $t->_vars['annonce']->annonce_annee; ?>" tmt:pattern="number" tmt:filters="" maxlength="4"></dd>
                                                                </dl>
                                                
                                                                <dl>
                                                                    <dt>État&nbsp;:</dt>
                                                                    <dd>
                                                                        <select class="user_input3 user_input_select input_middle" name="annonce_etat" id="annonce_etat">			
                                                                            <option value="0">État&nbsp;:</option>
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
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                
                                                        <div id="view_action" class="float_r">
                                                            <ul>
                                                                <?php $t->_vars['action'] = "";?>
                                                                <?php if($t->_vars['toForfait']->forfait_packId == 3):?>
                                                                    <?php if($t->_vars['annonce']->annonce_action == 1): $t->_vars['action'] = "OFFRE"; endif;?>
                                                                    <?php if($t->_vars['annonce']->annonce_action == 2): $t->_vars['action'] = "DEMANDE"; endif;?>
                                                                <?php else:?>    
                                                                    <?php if($t->_vars['annonce']->annonce_action == 3): $t->_vars['action'] = "A ACHETER"; endif;?>
                                                                    <?php if($t->_vars['annonce']->annonce_action == 4): $t->_vars['action'] = "A CHERCHER"; endif;?>
                                                                    <?php if($t->_vars['annonce']->annonce_action == 5): $t->_vars['action'] = "A LOUER"; endif;?>
                                                                    <?php if($t->_vars['annonce']->annonce_action == 6): $t->_vars['action'] = "A VENDRE"; endif;?>
                                                                    <?php if($t->_vars['annonce']->annonce_action == 7): $t->_vars['action'] = "A ECHANGER"; endif;?>
                                                                    <?php if($t->_vars['annonce']->annonce_action == 8): $t->_vars['action'] = "RENCONTRE"; endif;?>
                                                               	<?php endif;?>     
                                                                <li><strong><?php echo $t->_vars['action']; ?></strong></li>
                                                            </ul>
                                                        </div>
                                                        <div id="edit_action" class="float_r">
                                                            <label for="actionId">Action : </label><br>
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
                                                        </div>

                                                        <div id="view_offre" class="float_r">
                                                            <ul>
                                                                <li class="ref">Annonce r&eacute;f. an0000000</li>
                                                                <?php $t->_vars['offre'] = "";?>
                                                                <?php if($t->_vars['annonce']->annonce_offreId == 1): $t->_vars['offre'] = "particuli&egrave;re"; endif;?>
                                                                <?php if($t->_vars['annonce']->annonce_offreId == 2): $t->_vars['offre'] = "professionnelle"; endif;?>
                                                                <?php if($t->_vars['annonce']->annonce_offreId == 3): $t->_vars['offre'] = "commerciale"; endif;?>
                                                                <?php if($t->_vars['annonce']->annonce_offreId == 4): $t->_vars['offre'] = "de candidat"; endif;?>
                                                                <li>Offre <?php echo $t->_vars['offre']; ?></li>
                                                                <li class="date">Parue depuis aujourd'hui</li>
                                                            </ul>
                                                        </div>
                                                        <div id="edit_offre" class="float_r">
                                                            <label for="offreId">Offre : </label><br>
                                                            <select class="user_input4 user_input_select input_middle" name="annonce_offreId" id="annonce_offreId"  tmt:invalidvalue="0" tmt:required="true">			
                                                                <option value="0">Offre:</option>
                                                                <option value="1" <?php if($t->_vars['annonce']->annonce_offreId == 1):?>selected<?php endif;?>>particuli&egrave;re</option>
                                                                <option value="2" <?php if($t->_vars['annonce']->annonce_offreId == 2):?>selected<?php endif;?>>professionnelle</option>
                                                                <option value="3" <?php if($t->_vars['annonce']->annonce_offreId == 3):?>selected<?php endif;?>>commerciale</option>
                                                                <option value="4" <?php if($t->_vars['annonce']->annonce_offreId == 4):?>selected<?php endif;?>>de candidat</option>
                                                            </select>                                                        
                                                        </div>

                                                    </div><!-- box_annonce_main_info end -->                                                                                                                                               
                                                    <div id="edit_contact" class="box_inner box_end intro box_annonce_main_info">                                                    
                                                        <h4>Personne &agrave; contacter</h4>
														<br>
                                                        <div id="view_contact1" class="float">
                                                            <div class="info_list">
                                                                <dl>
                                                                    <dt>Nom&nbsp;:</dt>
                                                                    <dd><input class="user_input1" type="text" id="annonce_contactNom" name="annonce_contactNom" value="<?php if($t->_vars['annonce']->annonce_contactNom != ""): echo $t->_vars['annonce']->annonce_contactNom;  else: echo $t->_vars['utilisateur']->utilisateur_nom;  endif;?>" tmt:required="true" tmt:filters="" maxlength="50"></dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Pr&eacute;nom&nbsp;:</dt>
                                                                    <dd><input class="user_input1" type="text" id="annonce_contactPrenom" name="annonce_contactPrenom" value="<?php if($t->_vars['annonce']->annonce_contactPrenom != ""): echo $t->_vars['annonce']->annonce_contactPrenom;  else: echo $t->_vars['utilisateur']->utilisateur_prenom;  endif;?>" tmt:required="true" tmt:filters="" maxlength="50"></dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Email&nbsp;:</dt>
                                                                    <dd><input class="user_input1" type="text" id="annonce_contactEmail" name="annonce_contactEmail" value="<?php if($t->_vars['annonce']->annonce_contactEmail != ""): echo $t->_vars['annonce']->annonce_contactEmail;  else: echo $t->_vars['utilisateur']->utilisateur_email;  endif;?>" tmt:pattern="email" tmt:required="true" tmt:filters="" maxlength="50"></dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Adresse&nbsp;:</dt>
                                                                    <dd><input class="user_input1" type="text" id="annonce_contactAdresse" name="annonce_contactAdresse" value="<?php if($t->_vars['annonce']->annonce_contactAdresse != ""): echo $t->_vars['annonce']->annonce_contactAdresse;  else: echo $t->_vars['utilisateur']->utilisateur_adresse;  endif;?>" tmt:required="true" tmt:filters="" maxlength="50"></dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        <div id="view_contact2" class="float_r">
                                                            <label for="actionId">Localit&eacute; : </label><br>
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
                                                            <br>
                                                            
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
                                                            <br>
                                                            
                                                        </div>
                                                        <div class="float_r">
                                                            <label for="annonce_contactTelephone">T&eacute;l&eacute;phone : </label><br>
															<input class="user_input3" type="text" id="annonce_contactTelephone" name="annonce_contactTelephone" value="<?php if($t->_vars['annonce']->annonce_contactTelephone != ""): echo $t->_vars['annonce']->annonce_contactTelephone;  else: echo $t->_vars['utilisateur']->utilisateur_telephone;  endif;?>" tmt:pattern="phone" tmt:required="true" tmt:filters="" maxlength="50">                                                        
														</div>                                                            
                                                        <div class="float_r">
                                                            <label for="periodeId">P&eacute;riode d'appel : </label><br>
                                                            <select class="user_input4 user_input_select input_middle" name="annonce_contactPeriodeAppel" id="annonce_contactPeriodeAppel"  tmt:invalidvalue="0" tmt:required="true">			
                                                                <option value="0">P&eacute;riode:</option>
                                                                <option value="1" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 1):?>selected<?php endif;?>>Matin</option>
                                                                <option value="2" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 2):?>selected<?php endif;?>>Midi</option>
                                                                <option value="3" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 3):?>selected<?php endif;?>>Apr&egrave;s midi</option>
                                                                <option value="4" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 4):?>selected<?php endif;?>>Soir&eacute;e</option>
                                                                <option value="5" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 5):?>selected<?php endif;?>>Nuit</option>
                                                                <option value="6" <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 6):?>selected<?php endif;?>>La journ&eacute;e</option>
                                                            </select>                                                        
                                                        </div>
                                                    </div>    

                                                    <div class="clearer"></div>
                                                	
                                                    <?php if($t->_vars['annonce']->annonce_id):?>
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
                                                    <?php else:?>
                                                    <div id="edit_photo" class="box_inner intro box_end intro box_annonce_main_info">
                                                        <h4>Photos</h4>
                                                        <br>
                                                        <div id="view_contact1" class="float">
                                                            <div class="info_list">                                                
                                                                <?php $t->_vars['nbPhoto'] = $t->_vars['toForfait']->forfait_nbPhoto;?>            
                                                                <?php for($t->_vars['i']=0; $t->_vars['i']<$t->_vars['nbPhoto'];$t->_vars['i']++):?>
                                                                	<?php $t->_vars['it'] = $t->_vars['i']+1;?>
                                                                    <dl>
                                                                        <dt>Photo&nbsp;<?php echo $t->_vars['it']; ?>&nbsp;:</dt>
                                                                        <dd>
                                                                        <?php if($t->_vars['i'] == 0):?>
                                                                        	<?php $t->_vars['tmtRequired'] = " tmt:required=\"true\"";?>
                                                                        <?php else:?>
                                                                        	<?php $t->_vars['tmtRequired'] = "";?>
                                                                        <?php endif;?>
                                                                        <input type="file" name="annonce_photo<?php echo $t->_vars['i']; ?>" id="annonce_photo<?php echo $t->_vars['i']; ?>" <?php echo $t->_vars['tmtRequired']; ?> class="inputfile">
                                                                    </dl>
                                                                <?php endfor;?>                                                        
                                                            </div>
                                                      	</div>      

                                                        
                                                        <?php $t->_vars['nbPhotoAdd'] = $t->_vars['toForfait']->forfait_nbPhotoAdd;?>                                                                    
                                                        <?php if($t->_vars['nbPhotoAdd'] > 0):?>
	                                                        <div class="clearer"></div>
                                                            <h4>Photos additionnelles</h4>                                                                                                                    
                                                            <br>
                                                            <div id="view_contact1" class="float">
                                                                <div class="info_list">                                                
                                                                    <?php for($t->_vars['i']=0; $t->_vars['i']<$t->_vars['nbPhotoAdd'];$t->_vars['i']++):?>
                                                                        <?php $t->_vars['it'] = $t->_vars['i']+1;?>
                                                                        <dl>
                                                                            <dt>Photo&nbsp;<?php echo $t->_vars['it']; ?>&nbsp;:</dt>
                                                                            <dd>
                                                                            <input type="file" name="annonce_photoAdd<?php echo $t->_vars['i']; ?>" id="annonce_photoAdd<?php echo $t->_vars['i']; ?>" class="inputfile">
                                                                        </dl>
                                                                    <?php endfor;?>                                                        
                                                                </div>
                                                            </div>                                                            
                                                        <?php endif;?>
                                                        
                                                        <div class="clearer"></div>
                                                  	</div>      
                                                    <?php endif;?>
                                            
                                    				<!-- Caractéristique Debut-->
                                                    <?php echo $t->_vars['caracteristique']; ?>	
                                    				<!-- Caractéristique Fin-->                                                    
                                    
                                                    <div id="view_resume" class="box_inner intro box_end">
                                                        <h4>R&eacute;sum&eacute;</h4>
                                                        <?php echo $t->_vars['annonce']->annonce_resume; ?>
                                                        <br><br>
                                    
                                                    </div>                                        
                                                    <div id="edit_resume" class="box_inner intro box_end">
                                                        <h4>R&eacute;sum&eacute;</h4>
														<textarea style="width:608px;height:60px;" class="user_input_select1" id="annonce_resume" name="annonce_resume" rows="5" tmt:filters="" ><?php echo $t->_vars['annonce']->annonce_resume; ?></textarea>				
                                                        <br><br>
                                    
                                                    </div>                                        
                                                    <div id="view_description" class="box_inner intro box_end">
                                                        <h4>Description g&eacute;n&eacute;rale</h4>
                                                        <?php echo $t->_vars['annonce']->annonce_description; ?>
                                                        <br><br>
                                    
                                                    </div>                                        
                                                    <div id="edit_description" class="box_inner intro box_end">
                                                        <h4>Description g&eacute;n&eacute;rale</h4>                                                        
														<textarea style="width:608px;height:150px;" class="user_input_select1" id="annonce_description" name="annonce_description" rows="10" tmt:required="true"><?php echo $t->_vars['annonce']->annonce_description; ?></textarea>				
                                                        <br><br>
                                    
                                                    </div>                                        

                                                    <div id="edit_publication" class="box_inner intro box_end">
                                                        <h4>Publication</h4>                                                       
                                                        <br>
                                                        <div id="view_contact1" class="float">
                                                            <div class="info_list">                                                
                                                                <dl>
                                                                    <dt>Publier&nbsp;:</dt>
                                                                    <dd>
                                                                    <input class="radio" type="checkbox" id="annonce_publier" name="annonce_publier" <?php if($t->_vars['annonce']->annonce_publier == 1):?>checked<?php endif;?> value="1">
                                                                    </dd>
                                                                </dl>
                                                            </div>                                                
                                                            <div class="info_list">                                                
                                                                <dl>
                                                                    <dt>Accueil&nbsp;:</dt>
                                                                    <d>
                                                                    <input class="radio" type="checkbox" id="annonce_publierHome" name="annonce_publierHome" <?php if($t->_vars['annonce']->annonce_publierHome == 1):?>checked<?php endif;?> value="1">                                                                    
                                                                    &nbsp;( publier cette annonce en page d'acceuil de fa&ccedil;on al&eacute;atoire )
                                                                    </d>
                                                                </dl>
                                                                
                                                            </div>
                                                        </div>            
                                                  	</div>      
                                                
                                                    <div id="pub-14"></div>
                                                    <div class="box_inner box_annonce_foot">
                                                        
														<ul class="split">
                                                            <?php if($t->_vars['annonce']->annonce_id != 0):?>                                                        
                                                                <?php if($t->_vars['iFirst']):?>                                                
                                                                    <li class="inline"><a class="link_d" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceEdit', array('anid'=>$t->_vars['iFirst'], 'page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>">D&eacute;but</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iBack']):?>                                                
                                                                    <li class="inline"><a class="link_p" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceEdit', array('anid'=>$t->_vars['iBack'], 'page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>">Annonce pr&eacute;c&eacute;dente</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iNext']):?>                                                
                                                                    <li class="inline"><a class="link_s" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceEdit', array('anid'=>$t->_vars['iNext'], 'page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>">Annonce suivante</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iLast']):?>                                                
                                                                    <li class="inline"><a class="link_f" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceEdit', array('anid'=>$t->_vars['iLast'], 'page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>">Fin</a></li>                                                            
                                                                <?php endif;?>   
                                                            <?php endif;?>
                                                            <li class="last inline"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceList', array('page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>">Retour à la liste</a></li>                                                            
                                                        </ul>
                                                        
                                                        <div class="clearer"></div>
                                                    </div><!-- box_annonce_top end -->
                                                
                                                    <div class="box_foot"></div>
                                                </div>
                                            </div>
                                          
                                            <a href="#" class="formButton_valid">Valider</a>                                    
                                            <p style="clear: both;height:5px;"></p>                                                                        
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
									<?php endif;?>	<?php 
}
?>