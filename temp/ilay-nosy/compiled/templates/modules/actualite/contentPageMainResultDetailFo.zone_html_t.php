<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_b0e6fc3bb5237a47605bfc07eb95bc18($t){

return $t->_meta;
}
function template_b0e6fc3bb5237a47605bfc07eb95bc18($t){
?>									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">D&eacute;tail de l' actualit&eacute;</span> 
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
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=> $t->_vars['cid']));?>"><?php echo $t->_vars['zCid']; ?></a></span>
                                                    </div>
                                                    <?php endif;?>
                                            
                                                    <?php if($t->_vars['mot']):?>
                                                    <div class="criteria">
                                                        <span class="item">Mot:</span>
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('mot'=> $t->_vars['mot']));?>"><?php echo $t->_vars['zMot']; ?></a></span>
                                                    </div>
                                                    <?php endif;?>        
                                                    <?php if($t->_vars['parution']):?>
                                                    <div class="criteria">
                                                        <span class="item">Parution:</span>
                                                        <span class="value"><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('parution'=> $t->_vars['parution']));?>">depuis <?php echo $t->_vars['zParution']; ?></a></span>
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
                                        	<span class="viewTitre"><?php echo $t->_vars['iNbEnreg']; ?> actualit&eacute;<?php if($t->_vars['iNbEnreg'] > 1):?>s<?php endif;?> trouv&eacute;e<?php if($t->_vars['iNbEnreg'] > 1):?>s<?php endif;?></span> 
                                        </div>                                     
                                    </div>                                    

                                    <div class="ajaxZone">
                                        <form enctype="multipart/form-data" id='actualiteForm' name='actualiteForm' action="#" method="POST" tmt:validate="true" tmt:callback="displayError">                                        
                                         	<input type="hidden" id="actualite_id" name="actualite_id" value="<?php echo $t->_vars['actualite']->actualite_id; ?>">

                                            <div id="middleCol">
                                                <div class="box" id="box_annonce">
                                                    <div class="box_inner box_end box_annonce_top">

                                                        <div id="cat_breadcrumbs">
                                                            <ul class="cat_breadcrumbs">
                                                                <li><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=>$t->_vars['categorieAct']->categorieAct_id));?>"><?php echo $t->_vars['categorieAct']->categorieAct_libelle; ?></a></li>
                                                            </ul>
                                                        </div>                                                    
                                                        <div id="view_titre">
	                                                        <h1 class="txt_arrows"><?php echo $t->_vars['actualite']->actualite_titre; ?></h1>
                                                        </div>
														<ul class="split">
                                                            <?php if($t->_vars['actualite']->actualite_id != 0):?>
                                                                <?php if($t->_vars['iFirst']):?>                                                
                                                                
                                                                    <li class="inline"><a class="link_d" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('acid'=>$t->_vars['iFirst'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'mot'=> $t->_vars['mot'], 'parution'=> $t->_vars['parution'], 'page'=>$t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">D&eacute;but</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iBack']):?>                                                
                                                                    <li class="inline"><a class="link_p" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('acid'=>$t->_vars['iBack'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'mot'=> $t->_vars['mot'], 'parution'=> $t->_vars['parution'], 'page'=>$t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Actualit&eacute; pr&eacute;c&eacute;dente</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iNext']):?>                                                
                                                                    <li class="inline"><a class="link_s" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('acid'=>$t->_vars['iNext'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'mot'=> $t->_vars['mot'], 'parution'=> $t->_vars['parution'], 'page'=>$t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Actualit&eacute; suivante</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iLast']):?>                                                
                                                                    <li class="inline"><a class="link_f" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('acid'=>$t->_vars['iLast'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'mot'=> $t->_vars['mot'], 'parution'=> $t->_vars['parution'], 'page'=>$t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Fin</a></li>                                                            
                                                                <?php endif;?>   
                                                            <?php endif;?>			
                                                            <li class="last inline"><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'mot'=> $t->_vars['mot'], 'parution'=> $t->_vars['parution'], 'page'=>$t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Retour &agrave; la liste</a></li>                                                            
                                                        </ul>
                                                        <div class="clearer"></div>
                                                    </div><!-- box_annonce_top end -->                                        
                                                    
                                                    <div class="box_inner box_end box_annonce_main_info">                                                    
                                                    
                                                        <div id="view_price" class="float">
                                                            <div class="info_list">                                                
                                                                <dl class="lieu">
                                                                    <dt>Parue le&nbsp;:</dt>
                                                                    <dd><div id="view_lieu"><span class="date"><?php echo $t->_vars['actualite']->actualite_datePublication; ?></span></div></dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Source&nbsp;:</dt>
                                                                    <dd><div id="view_annee"><?php echo $t->_vars['actualite']->actualite_source; ?></div></dd>
                                                                </dl>                                                
                                                            </div>
                                                        </div>
                                                                                                        
                                                        <div id="view_offre" class="float_r">
                                                            <ul>
                                                                <li class="ref">Actualite r&eacute;f. <?php echo $t->_vars['actualite']->actualite_reference; ?></li>
                                                                <li class="date">Vue : <strong><?php echo $t->_vars['actualite']->actualite_visite; ?></strong> fois</li>
                                                                <li class="date">Commentaire : <strong><?php echo $t->_vars['actualite']->actualite_nbComment; ?></strong></li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- box_actualite_main_info end -->
													<?php if($t->_vars['actualite']->actualite_photo != ""):?>		
                                                    <div id="view_resume" class="box_inner intro box_end">
                                                        <!--h4>R&eacute;sum&eacute;</h4-->
														<div id="appercuPhoto" style=" text-align:center; margin:5px 0; background-color:#FDFCFB;overflow:auto; width:100%;">
                                                        	<img width="469" height="313" align="absmiddle" src="<?php echo $t->_vars['j_basepath']; ?>resize/actualite/photos/<?php echo $t->_vars['actualite']->actualite_photo; ?>">
                                                        </div>                                    
                                                    </div>                                        
													<?php endif;?>	
                                                    <div class="clearer"></div>
                                                	
                                                    <?php if($t->_vars['actualite']->actualite_id):?>
                                                    <?php if(sizeof($t->_vars['toPhotos'])):?>
                                                    <div class="box_inner box_end">
                                                        <h4>Autres photos</h4>
                                                        <table width="610" height="300" class="tableLP">
                                                            <tbody><tr class="trLPLeft">
                                                                <td class="tdLPLeft">
                                                                    <table class="tableLP">
                                                                        <tbody><tr class="trLP">
                                                                            <td width="360" height="290" class="tdLPBlackBorder">
                                                                            	<div id="profileimage" class="profileimage can_edit">
                                                                                    <img width="360" height="270" id="profile_pic" name="profile_pic" src="<?php echo $t->_vars['j_basepath']; ?>resize/actualite/images/popup/<?php echo $t->_vars['toPhotos'][0]->photo_photo; ?>">
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
                                                                                 <?php endif;?>      <?php if($t->_vars['oPhotos']->photo_photo != "noPhoto.jpg"):?> 
	                                                                                            <a id="linkthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" href="javascript:voirImg('<?php echo $t->_vars['oPhotos']->photo_photo; ?>', <?php echo $t->_vars['oPhotos']->photo_id; ?>);"><img width="90" height="68" onMouseOver="voirImg('<?php echo $t->_vars['oPhotos']->photo_photo; ?>', <?php echo $t->_vars['oPhotos']->photo_id; ?>);" border="0" id="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" name="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" alt="<?php echo $t->_vars['oPhotos']->photo_photo; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/actualite/images/abrege/<?php echo $t->_vars['oPhotos']->photo_photo; ?>"></a>
                                                                                            <?php else:?>
	                                                                                            <a id="linkthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>"><img width="90" height="68" border="0" id="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" name="imgthumb<?php echo $t->_vars['oPhotos']->photo_id; ?>" alt="<?php echo $t->_vars['oPhotos']->photo_photo; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/actualite/images/abrege/<?php echo $t->_vars['oPhotos']->photo_photo; ?>"></a>
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
                                                        <div class="clearer"></div>
                                                    </div>
                                                    <?php endif;?>
                                                    <?php endif;?>
                                            
                                    				<!-- Caractéristique Debut-->                                                    	
                                    				<!-- Caractéristique Fin-->                                                    
                                    
                                                    <div id="view_resume" class="box_inner intro box_end">
                                                        <h4>R&eacute;sum&eacute;</h4>
                                                        <?php echo $t->_vars['actualite']->actualite_resume; ?>
                                                        <br><br>
                                    
                                                    </div>                                        
                                                    <div id="view_description" class="box_inner intro box_end">
                                                        <h4>Description g&eacute;n&eacute;rale</h4>
                                                        <?php echo $t->_vars['actualite']->actualite_texte; ?>
                                                        <br><br>
                                    
                                                    </div>                                        
                                                
                                                    <div id="pub-14"></div>
                                                    <div class="box_inner box_annonce_foot">
                                                        
														<ul class="split">
                                                            <?php if($t->_vars['actualite']->actualite_id != 0):?>                                                        
                                                                <?php if($t->_vars['iFirst']):?>                                                
                                                                    <li class="inline"><a class="link_d" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('acid'=>$t->_vars['iFirst'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'mot'=> $t->_vars['mot'], 'parution'=> $t->_vars['parution'], 'page'=>$t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">D&eacute;but</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iBack']):?>                                                
                                                                    <li class="inline"><a class="link_p" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('acid'=>$t->_vars['iBack'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'mot'=> $t->_vars['mot'], 'parution'=> $t->_vars['parution'], 'page'=>$t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Actualit&eacute; pr&eacute;c&eacute;dente</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iNext']):?>                                                
                                                                    <li class="inline"><a class="link_s" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('acid'=>$t->_vars['iNext'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'mot'=> $t->_vars['mot'], 'parution'=> $t->_vars['parution'], 'page'=>$t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Actualit&eacute; suivante</a></li>                                                            
                                                                <?php endif;?>   
                                                                <?php if($t->_vars['iLast']):?>                                                
                                                                    <li class="inline"><a class="link_f" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('acid'=>$t->_vars['iLast'], 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'mot'=> $t->_vars['mot'], 'parution'=> $t->_vars['parution'], 'page'=>$t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Fin</a></li>                                                            
                                                                <?php endif;?>   
                                                            <?php endif;?>
                                                            <li class="last inline"><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'mot'=> $t->_vars['mot'], 'parution'=> $t->_vars['parution'], 'page'=>$t->_vars['page'], 'sortField'=> $t->_vars['sortField'], 'sortDirection'=> $t->_vars['sortDirection']));?>">Retour &agrave; la liste</a></li>                                                            
                                                        </ul>
                                                        
                                                        <div class="clearer"></div>
                                                    </div><!-- box_actualite_top end -->
                                                
                                                    <div class="box_foot"></div>
                                                </div>
                                            </div>                                          
                                        </form>
                                    </div>
<?php 
}
?>