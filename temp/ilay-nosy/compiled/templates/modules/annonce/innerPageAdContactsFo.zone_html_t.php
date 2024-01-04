<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_ddfb071051470d02e37743c56b8b8fe2($t){

return $t->_meta;
}
function template_ddfb071051470d02e37743c56b8b8fe2($t){
?>
								<div id="innerpageAnnounce">
                                    <h4>Fiche de l'annonceur</h4>
                                    
                                    <?php $t->_vars['can_view_annonce'] = 0;?>
                                    <?php if($t->_vars['is_annonceur_abonne'] == 1):?>
	                                    <?php $t->_vars['can_view_annonce'] = 1;?>
                                    <?php else:?>
	                                    <?php if($t->_vars['is_user_connected'] == 1 && $t->_vars['is_abonnement_valid'] == 1):?>	
	                                        <?php $t->_vars['can_view_annonce'] = 1;?>
                                        <?php endif;?>
                                    <?php endif;?>

									<?php if($t->_vars['can_view_annonce'] == 1):?>				
                                        <div class="info_list more_info">
                                            <span class="titre"><?php echo $t->_vars['annonce']->annonce_contactPrenom; ?> <?php echo $t->_vars['annonce']->annonce_contactNom; ?></span>
                                            <dl>
                                                <dt>Email:</dt>
                                                <dd><a href="mailto:<?php echo $t->_vars['annonce']->annonce_contactEmail; ?>"><?php echo $t->_vars['annonce']->annonce_contactEmail; ?></a></dd>
                                            </dl>
                                            <dl>
                                                <dt>Adresse:</dt>
                                                <dd><?php echo $t->_vars['annonce']->annonce_contactAdresse; ?></dd>
                                            </dl>
                                            <dl>
                                                <dt>CP:</dt>
                                                <dd><?php echo $t->_vars['localite']->localite_code; ?> <?php echo $t->_vars['localite']->localite_libelle; ?></dd>
                                            </dl>
                                            <dl>
                                                <dt>Ville:</dt>
                                                <dd><?php echo $t->_vars['province']->province_libelle; ?></dd>
                                            </dl>
                                            <dl>
                                                <dt>T&eacute;l.:</dt>
                                                <dd><strong><?php echo $t->_vars['annonce']->annonce_contactTelephone; ?></strong></dd>
                                            </dl>
                                            <dl>
                                                <dt>P&eacute;riode:</dt>
                                                <dd><span style="color:#0083B7;">                                            
                                                    
                                                    <?php if($t->_vars['annonce']->annonce_contactPeriodeAppel == 1):?>
                                                        Tous les matins (08h-12h)
                                                    <?php elseif($t->_vars['annonce']->annonce_contactPeriodeAppel == 2):?>
                                                        Tous les midis (12h-14h)
                                                    <?php elseif($t->_vars['annonce']->annonce_contactPeriodeAppel == 3):?>
                                                        Tous les apr&egrave;s-midi (14h-17h)
                                                    <?php elseif($t->_vars['annonce']->annonce_contactPeriodeAppel == 4):?>
                                                        Toutes les soir&eacute;es (17h-20h)
                                                    <?php elseif($t->_vars['annonce']->annonce_contactPeriodeAppel == 5):?>
                                                        Toutes les nuits (20h-00h)
                                                    <?php elseif($t->_vars['annonce']->annonce_contactPeriodeAppel == 6):?>
                                                        Toute la journ&eacute;e (07h-20h)
                                                    <?php else:?>
                                                        Toute la journ&eacute;e (07h-20h)
                                                    <?php endif;?>
                                                    
                                                    </span>                                                
                                                </dd>
                                            </dl>
                                        </div>
                                    <?php else:?>    
                                        <div class="info_list more_info">
                                            <span class="titre">Cher visiteur,</span>
                                            <?php if($t->_vars['is_user_connected'] == 0 && $t->_vars['is_abonnement_valid'] == 0):?>
                                            <dl>
                                                <d>
    	                                           	<p>
        	                                            Vous devez &ecirc;tre un membre connect&eacute; et abonn&eacute; pour voir les informations sur cet annonceur.                                                
                                                    </p>
                                                    <p>
	                                                    <a href="<?php jtpl_function_html_jurl( $t,'commun~communFo_login');?>">Identifiez-vous ici</a>.
                                                    </p>
                                                    <br />
                                                    <p>
	                                                    Si vous n'&ecirc;tes pas encore membre du site, veuillez <a href="<?php jtpl_function_html_jurl( $t,'commun~communFo_register');?>">cr&eacute;er un compte membre</a>.
                                                    </p>

                                                </d>
                                            </dl>
                                            <?php elseif($t->_vars['is_user_connected'] == 1 && $t->_vars['is_abonnement_valid'] == 0):?>
                                            <dl>
                                                <d>
    	                                           	<p>
        	                                            Vous devez vous abonner &agrave; un forfait pour voir les informations sur cet annonceur.                                                
                                                    </p>
                                                    <p>
	                                                    <a href="<?php jtpl_function_html_jurl( $t,'abonnement~abonnementFo_abonnementList');?>">Abonnez-vous ici</a>.
                                                    </p>
                                                </d>
                                            </dl>
                                            <?php endif;?>
                                      	</div>                                    
                                    <?php endif;?>    
                                    
                                </div><?php 
}
?>