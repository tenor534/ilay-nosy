<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
function template_meta_78eb8625faa847261e18c9f2e74c8e20($t){

return $t->_meta;
}
function template_78eb8625faa847261e18c9f2e74c8e20($t){
?>									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">D&eacute;tail de l' annonce</span> 
                                      	</p>          
   										<p style="clear: both;"></p>
									</div>
                                    
									<p style="clear: both;height:5px;"></p>
									<div id="viewCriteria">
                                    	<div class="headPan"> 
                                        	<span class="viewTitre">R&eacute;capitulatif de vos crit&egrave;res</span> 
                                        </div> 
                                    	<div class="middlePan">
	                                        <div class="blank">
		                                        <div class="content">
                                                    <?php if($t->_vars['cid']):?>
                                                    <div class="criteria">
                                                        <span class="item">Cat&eacute;gorie:</span>
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=> $t->_vars['cid']));?>"><?php echo $t->_vars['zCid']; ?></a></span>
                                                    </div>
                                                    <?php endif;?>
                                                    <?php if($t->_vars['rid']):?>
                                                    <div class="criteria">
                                                        <span class="item">Rubrique:</span>
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=> $t->_vars['rid']));?>"><?php echo $t->_vars['zRid']; ?></a></span>
                                                    </div>
                                                    <?php endif;?>
                                            
                                                    <?php if($t->_vars['mot']):?>
                                                    <div class="criteria">
                                                        <span class="item">Mot:</span>
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('mot'=> $t->_vars['mot']));?>"><?php echo $t->_vars['zMot']; ?></a></span>
                                                    </div>
                                                    <?php endif;?>        
                                                    <?php if($t->_vars['crid']):?>
                                                    <div class="criteria">
                                                        <span class="item">Rubrique:</span>
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('crid'=> $t->_vars['crid']));?>"><?php echo $t->_vars['zCrid']; ?></a></span>
                                                    </div>
                                                    <?php endif;?>
                                                    <?php if($t->_vars['parution']):?>
                                                    <div class="criteria">
                                                        <span class="item">Parution:</span>
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('parution'=> $t->_vars['parution']));?>">depuis <?php echo $t->_vars['zParution']; ?></a></span>
                                                    </div>
                                                    <?php endif;?>
                                                    <?php if($t->_vars['localite']):?>
                                                    <div class="criteria">
                                                        <span class="item">Localit&eacute;:</span>
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('localite'=> $t->_vars['localite']));?>"><?php echo $t->_vars['zLocalite']; ?></a></span>
                                                    </div>
                                                    <?php endif;?>
                                                    <?php if($t->_vars['province']):?>
                                                    <div class="criteria">
                                                        <span class="item">Province:</span>
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('province'=> $t->_vars['province']));?>"><?php echo $t->_vars['zProvince']; ?></a></span>
                                                    </div>
                                                    <?php endif;?>
                                            
                                                    <?php if($t->_vars['prix2']):?>
                                                    <div class="criteria">
                                                        <span class="item">Prix entre:</span>
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2']));?>"><?php echo $t->_vars['zPrix1']; ?> et <?php echo $t->_vars['zPrix2']; ?> Ar</a></span>
                                                    </div>
                                                    <?php endif;?>
                                            
                                                    <?php if($t->_vars['affichage']):?>
                                                    <div class="criteria">
                                                        <span class="item">Affichage:</span>
                                                        <span class="value"><?php echo $t->_vars['zAffichage']; ?></span>
                                                    </div>
                                                    <?php endif;?>
	                                         	</div>       
	                                        </div>                                     
                                        </div>                                     
                                    	<div class="footPan">
                                        	<span class="viewTitre"><?php echo $t->_vars['iNbEnreg']; ?> annonce<?php if($t->_vars['iNbEnreg'] > 1):?>s<?php endif;?> trouv&eacute;e<?php if($t->_vars['iNbEnreg'] > 1):?>s<?php endif;?></span> 
                                        </div>                                     
                                    </div>                                    

                                    <div class="ajaxZone">
                                        <form enctype="multipart/form-data" id='annonceForm' name='annonceForm' action="#" method="POST" tmt:validate="true" tmt:callback="displayError">                                        
                                         	<input type="hidden" id="annonce_id" name="annonce_id" value="<?php echo $t->_vars['annonce']->annonce_id; ?>">

                                            <div id="middleCol">
                                                <div class="box" id="box_annonce">
                                                    <div class="box_inner box_end box_annonce_top">

                                                        <div id="cat_breadcrumbs">
                                                            <ul class="cat_breadcrumbs">
                                                                <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>$t->_vars['categorieAn']->categorieAn_id));?>"><?php echo $t->_vars['categorieAn']->categorieAn_libelle; ?></a></li>
                                                                <li><span>&gt;</span> <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['rubrique']->rubrique_id));?>"><?php echo $t->_vars['rubrique']->rubrique_libelle; ?></a></li>
                                                                
                                                            </ul>
                                                        </div>                                                    
                                                        <div id="view_titre">
	                                                        <h1 class="txt_arrows"><?php echo $t->_vars['annonce']->annonce_titre; ?></h1>
                                                        </div>
														<ul class="split">
                                                            <?php if($t->_vars['annonce']->annonce_id != 0):?>
                                                                <?php if($t->_vars['iFirst']):?>                                                
                                                                
                                                                    <li class="inline"><a class="link_d" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('anid'=>$t->_vars['iFirst'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=> $t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">D&eacute;but</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iBack']):?>                                                
                                                                    <li class="inline"><a class="link_p" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('anid'=>$t->_vars['iBack'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=> $t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Annonce pr&eacute;c&eacute;dente</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iNext']):?>                                                
                                                                    <li class="inline"><a class="link_s" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('anid'=>$t->_vars['iNext'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=> $t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Annonce suivante</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iLast']):?>                                                
                                                                    <li class="inline"><a class="link_f" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('anid'=>$t->_vars['iLast'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=> $t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Fin</a></li>                                                            
                                                                <?php endif;?>   
                                                            <?php endif;?>			
                                                            <li class="last inline"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=> $t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Retour &agrave; la liste</a></li>                                                            
                                                        </ul>
                                                        <div class="clearer"></div>
                                                    </div><!-- box_annonce_top end -->                                        
                                                    
                                                    <div class="box_inner box_end box_annonce_main_info">                                                    
                                                    
                                                        <div id="view_price" class="float">
                                                            <div class="info_list">
                                                            	<?php if($t->_vars['annonce']->annonce_prix != 0):?>                                                
                                                                <dl class="price">
                                                                    <dt>Prix&nbsp;:</dt>
                                                                    <dd><div id="view_prix"><?php if($t->_vars['annonce']->annonce_prix): echo jtpl_modifier_common_format_number($t->_vars['annonce']->annonce_prix, 0, ",", ' ','Ar');  else:?>N/D<?php endif;?></div> <span><?php echo $t->_vars['annonce']->annonce_prixInfo; ?></span></dd>
                                                                </dl>
                                                                <?php endif;?>
                                                                <dl class="lieu">
                                                                    <dt>Lieu&nbsp;:</dt>
                                                                        <?php $t->_vars['zprovince'] = $t->_vars['zprovince']->province_libelle;?>
                                                                        <?php $t->_vars['zlocalite'] = $t->_vars['zlocalite']->localite_code . " " . $t->_vars['zlocalite']->localite_libelle;?>
                                                                    <dd><div id="view_lieu"><?php echo $t->_vars['zprovince']; ?> <span class="date"><?php echo $t->_vars['zlocalite']; ?></span></div></dd>
                                                                </dl>
                                                                
                                                                <?php if($t->_vars['annonce']->annonce_annee != 0):?>
                                                                <dl>
                                                                    <dt>Ann&eacute;e&nbsp;:</dt>
                                                                    <dd><div id="view_annee"><?php if($t->_vars['annonce']->annonce_annee): echo $t->_vars['annonce']->annonce_annee;  else:?>N/D<?php endif;?></div></dd>
                                                                </dl>                                                
                                                                <?php endif;?>
                                                                <?php if($t->_vars['annonce']->annonce_etat != 0):?> 
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
                                                                    <dt>Etat&nbsp;:</dt>
                                                                    <dd><div id="view_etat"><?php echo $t->_vars['etat']; ?></div></dd>
                                                                </dl>
                                                                <?php endif;?>
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

                                                        <div id="view_offre" class="float_r">
                                                            <ul>
                                                                <li class="ref">Annonce r&eacute;f. <?php echo $t->_vars['annonce']->annonce_reference; ?></li>
                                                                <?php $t->_vars['offre'] = "";?>
                                                                <?php if($t->_vars['annonce']->annonce_offreId == 1): $t->_vars['offre'] = "particuli&egrave;re"; endif;?>
                                                                <?php if($t->_vars['annonce']->annonce_offreId == 2): $t->_vars['offre'] = "professionnelle"; endif;?>
                                                                <?php if($t->_vars['annonce']->annonce_offreId == 3): $t->_vars['offre'] = "commerciale"; endif;?>
                                                                <?php if($t->_vars['annonce']->annonce_offreId == 4): $t->_vars['offre'] = "de candidat"; endif;?>
                                                                <li>Offre <?php echo $t->_vars['offre']; ?></li>
                                                                <li class="date">Parue depuis <?php if($t->_vars['annonce']->annonce_parution == 0):?>aujourd'hui<?php else: echo $t->_vars['annonce']->annonce_parution; ?> jour<?php if($t->_vars['annonce']->annonce_parution > 1):?>s<?php endif; endif;?></li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- box_annonce_main_info end -->

                                                    <div class="clearer"></div>
                                                	
                                                    <?php if($t->_vars['annonce']->annonce_id):?>
                                                    <div class="box_inner box_end">
                                                        <br>
                                                        <?php if(sizeof($t->_vars['toPhotos'])>1):?>                                                        
                                                        <table width="610" height="300" class="tableLP">
                                                            <tbody><tr class="trLPLeft">
                                                                <td class="tdLPLeft">
                                                                    <table class="tableLP">
                                                                        <tbody><tr class="trLP">
                                                                            <td width="360" height="290" class="tdLPBlackBorder">
                                                                            	<div id="profileimage" class="profileimage can_edit">
                                                                                    <img width="360" height="270" id="profile_pic" name="profile_pic" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/popup/<?php echo $t->_vars['annonce']->annonce_photo; ?>">
																					<input type="hidden" id="picture_id" name="picture_id" value="<?php if(sizeof($t->_vars['toPhotos'])): echo $t->_vars['toPhotos'][0]->photo_id;  endif;?>">
																					<input type="hidden" id="picture_photo" name="picture_photo" value="<?php if(sizeof($t->_vars['toPhotos'])): echo $t->_vars['toPhotos'][0]->photo_photo;  endif;?>"> 
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
                                                                                 <?php endif;?>      <?php if($t->_vars['oPhotos']->photo_photo != "noPhoto.jpg"):?> 
	                                                                                            <a id="linkthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" href="javascript:voirImg('<?php echo $t->_vars['oPhotos']->photo_photo; ?>', <?php echo $t->_vars['oPhotos']->photo_id; ?>);"><img width="90" height="68" onMouseOver="voirImg('<?php echo $t->_vars['oPhotos']->photo_photo; ?>', <?php echo $t->_vars['oPhotos']->photo_id; ?>);" border="0" id="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" name="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" alt="<?php echo $t->_vars['oPhotos']->photo_photo; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/abrege/<?php echo $t->_vars['oPhotos']->photo_photo; ?>"></a>
                                                                                            <?php else:?>
	                                                                                            <a id="linkthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>"><img width="90" height="68" border="0" id="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" name="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" alt="<?php echo $t->_vars['oPhotos']->photo_photo; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/abrege/<?php echo $t->_vars['oPhotos']->photo_photo; ?>"></a>
                                                                                            <?php endif;?>

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
                                                        <?php else:?>
                                                        <table width="610" height="300" class="tableLP">
                                                            <tbody><tr class="trLPLeft">
                                                                <td class="tdLPLeft">
                                                                    <table class="tableLP">
                                                                        <tbody><tr class="trLP">
                                                                            <td width="360" height="290" class="tdLPBlackBorder">                                                                            
                                                                            	<div id="profileimage" class="profileimage can_edit">
                                                                                    <img width="360" height="270" id="profile_pic" name="profile_pic" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/popup/<?php echo $t->_vars['annonce']->annonce_photo; ?>">
																					<input type="hidden" id="picture_id" name="picture_id" value="<?php if(sizeof($t->_vars['toPhotos'])): echo $t->_vars['toPhotos'][0]->photo_id;  endif;?>">
																					<input type="hidden" id="picture_photo" name="picture_photo" value="<?php if(sizeof($t->_vars['toPhotos'])): echo $t->_vars['toPhotos'][0]->photo_photo;  endif;?>"> 
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
                                                                                 <?php endif;?>      <?php if($t->_vars['oPhotos']->photo_photo != "noPhoto.jpg"):?> 
	                                                                                            <a id="linkthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" href="javascript:voirImg('<?php echo $t->_vars['oPhotos']->photo_photo; ?>', <?php echo $t->_vars['oPhotos']->photo_id; ?>);"><img width="90" height="68" onMouseOver="voirImg('<?php echo $t->_vars['oPhotos']->photo_photo; ?>', <?php echo $t->_vars['oPhotos']->photo_id; ?>);" border="0" id="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" name="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" alt="<?php echo $t->_vars['oPhotos']->photo_photo; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/abrege/<?php echo $t->_vars['oPhotos']->photo_photo; ?>"></a>
                                                                                            <?php else:?>
	                                                                                            <a id="linkthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>"><img width="90" height="68" border="0" id="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" name="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" alt="<?php echo $t->_vars['oPhotos']->photo_photo; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/abrege/<?php echo $t->_vars['oPhotos']->photo_photo; ?>"></a>
                                                                                            <?php endif;?>

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
                                                        <?php endif;?>                                                                                        
                                                        <div class="clearer"></div>
                                                    </div>
                                                    <?php endif;?>
                                            
                                    				<!-- Caractéristique Debut-->   
                                                    <?php echo $t->_vars['caracteristique']; ?>
                                    				<!-- Caractéristique Fin-->                                                    
                                    				<?php if($t->_vars['annonce']->annonce_resume != ""):?>
                                                    <div id="view_resume" class="box_inner intro box_end">
                                                        <h4>R&eacute;sum&eacute;</h4>
                                                        <?php echo $t->_vars['annonce']->annonce_resume; ?>
                                                        <br><br>                                    
                                                    </div>      
                                                    <?php endif;?>                                  
                                                    <div id="view_description" class="box_inner intro box_end">
                                                        <h4>Description g&eacute;n&eacute;rale</h4>
                                                        <?php echo $t->_vars['annonce']->annonce_description; ?>
                                                        <br><br>
                                    
                                                    </div>                                        
                                                
                                                    <div id="pub-14"></div>
                                                    <div class="box_inner box_annonce_foot">
                                                        
														<ul class="split">
                                                            <?php if($t->_vars['annonce']->annonce_id != 0):?>                                                        
                                                                <?php if($t->_vars['iFirst']):?>                                                
                                                                    <li class="inline"><a class="link_d" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('anid'=>$t->_vars['iFirst'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=> $t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">D&eacute;but</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iBack']):?>                                                
                                                                    <li class="inline"><a class="link_p" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('anid'=>$t->_vars['iBack'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=> $t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Annonce pr&eacute;c&eacute;dente</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iNext']):?>                                                
                                                                    <li class="inline"><a class="link_s" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('anid'=>$t->_vars['iNext'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=> $t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Annonce suivante</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iLast']):?>                                                
                                                                    <li class="inline"><a class="link_f" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('anid'=>$t->_vars['iLast'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=> $t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Fin</a></li>                                                            
                                                                <?php endif;?>   
                                                            <?php endif;?>
                                                            <li class="last inline"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=> $t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Retour &agrave; la liste</a></li>                                                            
                                                        </ul>
                                                        
                                                        <div class="clearer"></div>
                                                    </div><!-- box_annonce_top end -->
                                                
                                                    <div class="box_foot"></div>
                                                </div>
                                            </div>                                          
                                        </form>
                                    </div>
<?php 
}
?>