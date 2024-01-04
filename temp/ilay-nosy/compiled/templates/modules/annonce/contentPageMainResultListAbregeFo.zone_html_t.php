<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
function template_meta_d1ce72a2b7d1cbb0af01931e6992a7a1($t){

return $t->_meta;
}
function template_d1ce72a2b7d1cbb0af01931e6992a7a1($t){
?>									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">R&eacute;sultats de votre recherche</span> 
                                      	</p>          
   										<p style="clear:both">
                                        	<span class="viewTexte">&nbsp;</span>
										</p>
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
                                    
									<p style="clear: both;height:5px;"></p>
                                    <span class="view">Affichage :</span>                                    
									<?php $t->_vars['tPost'] = array('affichage'=>'detail', 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=>1, 'nbPagination'=> $t->_vars['nbPagination'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']);?>
                                    <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', $t->_vars['tPost']);?>" class="formButton_detail<?php if($t->_vars['affichage'] == 'detail'):?>_hover<?php endif;?>">valid</a>
									<?php $t->_vars['tPost'] = array('affichage'=>'abrege', 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=>$t->_vars['page'], 'nbPagination'=> $t->_vars['nbPagination'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']);?>
                                    <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', $t->_vars['tPost']);?>" class="formButton_abrege<?php if($t->_vars['affichage'] == 'abrege'):?>_hover<?php endif;?>">valid</a>
									<?php $t->_vars['tPost'] = array('affichage'=>'photo', 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=>1, 'nbPagination'=> $t->_vars['nbPagination'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']);?>
                                    <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', $t->_vars['tPost']);?>" class="formButton_photo<?php if($t->_vars['affichage'] == 'photo'):?>_hover<?php endif;?>">valid</a>
                                    
									<p class="resultReturn">
                                   		<a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceCategorieList');?>">Retour &agrave; la liste des cat&eacute;gories</a>                                    
                                    </p>                                    
                                    
									<p style="clear: both;height:10px;"></p>
                                    
                                    <div class="ajaxZone">                                    
                                        <div class="sortableListWithPagination">
										<table class="commAnnonce expanded" cellspacing="0"  id="tableListeAnnonce" currentSortField="<?php echo $t->_vars['sortField']; ?>" currentSortDirection="<?php echo $t->_vars['sortDirection']; ?>" currentPage="<?php echo $t->_vars['page']; ?>" nbPage="<?php echo $t->_vars['nbPage']; ?>" src="<?php jtpl_function_html_jurl( $t,'commun~communBo_getZone', $t->_vars['tParams']);?>">
                                            <thead>
                                                <tr>
                                                    <?php $t->_vars['i']=0;?>
                                                    <?php foreach($t->_vars['tHead'] as $t->_vars['headFields']):?>
                                                        <?php if($t->_vars['headFields']['sortField']!=''):?>
                                                            <th class="<?php echo $t->_vars['headFields']['class']; ?>" sortField="<?php echo $t->_vars['headFields']['sortField']; ?>">
                                                            	<h4 class="mast">
                                                            	<?php echo $t->_vars['headFields']['libelle']; ?>
                                                                </h4>
                                                            </th>
                                                        <?php endif;?>
                                                    <?php endforeach;?>
                                                </tr>
                                        	</thead>
                                            <tbody>	
                                                <?php if(sizeof($t->_vars['toAnnonce'])==0):?>
                                                    <tr class="row1">
                                                        <td class="annonceBody1" colspan="6">Aucune annonce pour votre recherche</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">
                                                                    <p class="regTextPale forumFoot">&nbsp;</p>
                                                                </div>
                                                                <div class="commFoot3">
                                                                </div>
                                                            </div>                                                                                                                                              
                                                        </td>
                                                    </tr>
                                                <?php else:?>
                                                    <?php $t->_vars['i']=0;?>
                                                    <?php $t->_vars['j']=0;?>
                                                    <?php foreach($t->_vars['toAnnonce'] as $t->_vars['oAnnonce']):?>
                                                    <?php $t->_vars['tPost'] = array('anid'=>$t->_vars['oAnnonce']->annonce_id, 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=>$t->_vars['page'], 'nbPagination'=> $t->_vars['nbPagination'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']);?>                                                    
                                                    
                                                    <tr>
                                                        <td class="annonceBody0">
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>" class="blueHead">
                                                            <img width="98" height="74" border="0" alt="<?php echo $t->_vars['oAnnonce']->annonce_titre; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/abrege/<?php echo $t->_vars['oAnnonce']->annonce_photo; ?>" name="imgPrinc">
                                                            </a>
                                                        </td>
                                                        <td class="annonceBody1">
                                                            <h5><a class="titre" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>"><?php echo $t->_vars['oAnnonce']->annonce_titre; ?></a></h5>
                                                            <ul class="split">
                                                                <li>Annonce ref. <a><?php echo $t->_vars['oAnnonce']->annonce_reference; ?></a></li>
                                                                <li class="last"><?php echo $t->_vars['oAnnonce']->annonce_offre; ?></li>
                                                            </ul>
                                                        </td>
                                                        <td class="annonceBody2">
                                                            <h5><span class="nowrap"><?php if($t->_vars['oAnnonce']->annonce_prix): echo jtpl_modifier_common_format_number($t->_vars['oAnnonce']->annonce_prix, 0, ",", ' ','Ar');  else:?>N/D<?php endif;?></span><span class="supp_info"><?php echo $t->_vars['oAnnonce']->annonce_prixInfo; ?></span></h5>
                                                        </td>
                                                        <td class="annonceBody3">
                                                            <h5><?php echo $t->_vars['oAnnonce']->annonce_annee; ?> <span class="supp_info"><?php echo $t->_vars['oAnnonce']->annonce_etat; ?></span></h5>
                                                        </td>
                                                        
                                                        <td class="annonceBody5">
                                                            <p><span class="parution"><?php if($t->_vars['oAnnonce']->annonce_parution == 0):?>Aujourd'hui<?php else: echo $t->_vars['oAnnonce']->annonce_parution; ?> jour<?php if($t->_vars['oAnnonce']->annonce_parution > 1):?>s<?php endif; endif;?></span></p>
                                                        </td>                                                
                                                    </tr>    
                                                    <?php $t->_vars['j']++;?>
                                                    <?php endforeach;?>
                                                            
                                                    <?php if($t->_vars['nbPage'] > 1):?>                                        
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">                                                                
                                                                    <p class="regTextPale forumFoot">Affiche <?php echo $t->_vars['iDebutEnreg']; ?> -&gt; <?php if($t->_vars['page'] == $t->_vars['nbPage']): echo $t->_vars['iNbEnreg'];  else: echo $t->_vars['iFinEnreg'];  endif;?> sur <?php echo $t->_vars['iNbEnreg']; ?> annonce(s)</p>
                                                                </div>
                                                                <div class="commFoot3">
                                                                    <ul class="pageNumbers">
                                                                    
                                                                        <li class="firstButton"><a class="pageFirst" alt="First page" href="#">First</a></li>
                                                                        <li class="prevButton"><a class="pagePrevious" alt="Previous page" href="#">Previous</a></li>
                                                                        
                                                                        <li class="noButton"><a href="#">1</a></li>
                                                                        <li class="noButton">2</li>
                                                                        <li class="noButton"><a href="#">3</a></li>
                                                                        <li class="noButton"><a href="#">4</a></li>
                                                                        <li class="noButton"><a href="#">5</a></li>
                                                                        <li class="noButton"><a href="#">6</a></li>
                                                                        <li class="lastPage"><a href="#">7</a></li>                                            
                                                                        
                                                                        <li class="nextButton"><a class="pageNext" alt="Next page" href="#">Next</a></li>
                                                                        <li class="lastButton"><a class="pageLast" alt="Last page" href="#">Last</a></li>
                                                                        
                                                                    </ul>
                                                                </div>
                                                            </div>                                                                                                                                              
                                                        </td>
                                                    </tr>
                                                    <?php else:?>
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">
                                                                    <p class="regTextPale forumFoot">&nbsp;</p>
                                                                </div>
                                                                <div class="commFoot3">
                                                                </div>
                                                            </div>                                                                                                                                              
                                                        </td>
                                                    </tr>
                                                    <?php endif;?>
                                                    
                                                <?php endif;?>
                                            </tbody>
                                        </table>
                                        <p class="pagination">&nbsp;</p>
                                        </div>
                                    </div><?php 
}
?>