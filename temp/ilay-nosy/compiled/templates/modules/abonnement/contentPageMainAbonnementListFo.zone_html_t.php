<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.date_format.php');
function template_meta_d47beb43ff9e790d3bce740cd1b634f7($t){

return $t->_meta;
}
function template_d47beb43ff9e790d3bce740cd1b634f7($t){
?>                                    <div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Liste de vos abonnements</span> 
                                      	</p>          
   										<p style="clear:both">
                                        
	                                        <?php if($t->_vars['canAdd']):?>                                        
                                                <span class="viewTexte">Cliquez sur le bouton "Ajouter" ci-contre pour ajouter un nouvel abonnement.</span> 
                                                <a style="clear:both; margin:-18px 0 0 550px;" href="<?php jtpl_function_html_jurl( $t,'abonnement~abonnementFo_abonnementPackList');?>" class="formButton_add">Ajouter</a>
                                            <?php else:?>
                                                <span class="viewTexte">Vous avez encore un abonnement &agrave; r&eacute;gulariser. En attendant vous ne pouvez pas encore ajouter un nouvel abonnement.</span> 
                                            <?php endif;?>    
                                        </p>
   										<p style="clear:both"></p>	                     
                                   		
                                    	
									</div>
                                    <br>
									<div id="results">                                    
									<ul>
  
                                <?php if(sizeof($t->_vars['toAbonnements']) != 0):?>
                                    <?php $t->_vars['i']=0;?>                                   
                                    
                                    <?php foreach($t->_vars['toAbonnements'] as $t->_vars['oAbonnement']):?>
                                    
                                        <?php $t->_vars['abonnementCredit'] = $t->_vars['oAbonnement']->abonnement_credit + $t->_vars['oAbonnement']->abonnement_creditPlus;?>

                                        <?php $t->_vars['abonnementStatut'] = "";?>
                                        <?php if($t->_vars['oAbonnement']->abonnement_statut == 1):?>
	                                        <?php $t->_vars['abonnementStatut'] = "VALIDE";?>
                                        <?php elseif($t->_vars['oAbonnement']->abonnement_statut == 2):?>
	                                        <?php $t->_vars['abonnementStatut'] = "EXPIRE";?>
                                        <?php else:?>
	                                        <?php $t->_vars['abonnementStatut'] = "INCOMPLET";?>
                                        <?php endif;?>                                        

                                        <?php $t->_vars['tPost']= array('pid'=> $t->_vars['oAbonnement']->forfait_packId, 'fid'=> $t->_vars['oAbonnement']->forfait_id, 'aid'=> $t->_vars['oAbonnement']->abonnement_id);?>

                                        <?php if($t->_vars['i']==0):?>
                                            <li style="height:10px;"></li>                                                    
                                        <?php endif;?>                                                            
                                        <li class="result result_express">
                                            <div class="result_title">
												<?php $t->_vars['forfaitPrix'] = $t->_vars['oAbonnement']->forfait_prix + $t->_vars['oAbonnement']->forfait_prixPlus;?>
                                                <h4><a href="<?php jtpl_function_html_jurl( $t,'abonnement~abonnementFo_abonnementEdit', $t->_vars['tPost']);?>">PACK <?php echo $t->_vars['oAbonnement']->pack_libelle; ?></a> 
                                                <span class="price"><?php echo jtpl_modifier_common_format_number($t->_vars['forfaitPrix'], 0, ",", ' ','Ariary'); ?><span class="price_info"></span></span></h4>
                                                <div>
                                                    <p><span class="special">Forfait: <?php echo $t->_vars['oAbonnement']->forfait_libelle; ?></span></p>
                                                    <ul class="split">
                                                        <li><span>(Statut = <strong class="red"><?php echo $t->_vars['abonnementStatut']; ?></strong>)</span></li>
                                                        <li class="last date">Cr&eacute;e le <?php echo jtpl_modifier_common_date_format($t->_vars['oAbonnement']->abonnement_dateCreation,"%d/%m/%Y (%H:%M:%S)"); ?></li>
                                                    </ul>
                                                </div>
                                                <div class="clearer"></div>
                                            </div>                                        
                                            <div class="result_desc">
                                                <div class="img_photo">
													<a title="PACK <?php echo $t->_vars['oAbonnement']->pack_libelle; ?>" href="<?php jtpl_function_html_jurl( $t,'abonnement~abonnementFo_abonnementEdit', $t->_vars['tPost']);?>"><img width="180" height="135" border="1" alt="<?php echo $t->_vars['oAbonnement']->pack_libelle; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/pack/photos/<?php echo $t->_vars['oAbonnement']->pack_photo; ?>" name="imgPrinc"></a>
                                                </div>
                                                <div class="desc_txt">
                                                    <ul>
                                                    	<li>Date de d&eacute;but: <strong><?php echo jtpl_modifier_common_date_format($t->_vars['oAbonnement']->abonnement_dateDebut,"%d/%m/%Y"); ?></strong></li>
                                                        <li>Date d'expiration: <strong><?php echo jtpl_modifier_common_date_format($t->_vars['oAbonnement']->abonnement_dateFin,"%d/%m/%Y"); ?></strong></li>
                                                    </ul>
                                                    <ul>
                                                    	<li>Cr&eacute;dit: <strong><?php echo $t->_vars['oAbonnement']->abonnement_credit; ?> Ariary</strong></li>
                                                        <li>Cr&eacute;dit+: <strong><?php echo $t->_vars['oAbonnement']->abonnement_creditPlus; ?> Ariary</strong></li>
                                                    </ul>
                                                    <h5>Caract&eacute;ristiques</h5>
                                                    <p>
														<?php echo $t->_vars['oAbonnement']->forfait_libelle; ?>	
                                                        <?php if($t->_vars['oAbonnement']->forfait_nbPhoto != 0):?>
	                                                        , <?php echo $t->_vars['oAbonnement']->forfait_nbPhoto; ?> photos
                                                        <?php endif;?>
                                                        <?php if($t->_vars['oAbonnement']->forfait_nbCaractere != 0):?>
	                                                        , <?php echo $t->_vars['oAbonnement']->forfait_nbCaractere; ?> caract&egrave;res
                                                        <?php endif;?>
                                                        <?php if($t->_vars['oAbonnement']->forfait_dureeParution != 0):?>
	                                                        , <?php echo $t->_vars['oAbonnement']->forfait_dureeParution; ?> jours de parution
                                                        <?php endif;?>
                                                        <?php if($t->_vars['oAbonnement']->forfait_voirCoordonnee != 0):?>
	                                                        , voir les coordonn&eacute;es des contacts
                                                        <?php endif;?>
                                                        <?php if($t->_vars['oAbonnement']->forfait_ajoutLien != 0):?>
	                                                        , lien internet
                                                        <?php endif;?>
                                                        <?php if($t->_vars['oAbonnement']->forfait_statistique != 0):?>
	                                                        , statistique de consultation
                                                        <?php endif;?>
                                                        <?php if($t->_vars['oAbonnement']->forfait_texteMEV != 0):?>
	                                                        , texte mise en valeur
                                                        <?php endif;?>
                                                        <?php if($t->_vars['oAbonnement']->forfait_nbPhotoAdd != 0):?>
	                                                        , <?php echo $t->_vars['oAbonnement']->forfait_nbPhotoAdd; ?> photos additionnelles
                                                        <?php endif;?>
														.                                                        
                                                    </p>
                                                    <p class="red">                                                     
                                                        <?php if($t->_vars['abonnementCredit'] == 0):?>
                                                            <u>NB:</u>&nbsp;Vous devez cr&eacute;diter votre abonnement pour que vos coordonn&eacute;es/contacts soient visibles par plus de 3 000 visiteurs par jour.
                                                        <?php endif;?>                                        
                                                    </p>
                                                </div>
                                            </div>    
                                            <form style="visibility:hidden" id="registerForm" name="registerForm" action="#">
                                                <input type="hidden" id="pack_id" name="pack_id" value="<?php echo $t->_vars['oAbonnement']->forfait_packId; ?>">
                                                <input type="hidden" id="forfait_id" name="forfait_id" value="<?php echo $t->_vars['oAbonnement']->forfait_id; ?>">
                                                <input type="hidden" id="utilisateur_id" name="utilisateur_id" value="<?php echo $t->_vars['oAbonnement']->abonnement_utilisateurId; ?>">
                                                <input type="hidden" id="abonnement_id" name="abonnement_id" value="<?php echo $t->_vars['oAbonnement']->abonnement_id; ?>">
                                            </form>                                                      

                                            <div class="result_foot">
                                                <ul>
                                                    <p class="regTextPaleNormal borderNoneInline">R&eacute;f&eacute;rence: <strong><?php echo $t->_vars['oAbonnement']->abonnement_reference; ?></strong></p>
                                                    <?php if($t->_vars['abonnementCredit'] == 0):?>
                                                        <li class="borderLeftInline">
                                                            <a id="creditAbonnement" class="hotTopics" href="<?php jtpl_function_html_jurl( $t,'abonnement~abonnementFo_abonnementEdit', $t->_vars['tPost']);?>">Cr&eacute;diter cet abonnement</a>
                                                        </li>
                                                    <?php endif;?>
                                                    <?php if($t->_vars['oAbonnement']->abonnement_statut == 3 && $t->_vars['oAbonnement']->abonnement_nbAnnonce == 0):?>
                                                        <li class="borderLeftInline">
                                                            <a id="deleteAbonnement" class="hotTopics" href="<?php jtpl_function_html_jurl( $t,'abonnement~abonnementFo_abonnementDelete', array('aid'=> $t->_vars['oAbonnement']->abonnement_id));?>">Suprimer cet abonnement</a>
                                                        </li>
                                                    <?php endif;?>
                                                    
                                                </ul>
                                            </div>
                                        </li><!-- result end -->

                                        <?php $t->_vars['i']++;?>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                        
                                    </ul>	
                                    </div><?php 
}
?>