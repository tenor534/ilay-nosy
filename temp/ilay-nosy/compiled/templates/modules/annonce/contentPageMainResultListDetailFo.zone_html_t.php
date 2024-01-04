<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.date_format.php');
function template_meta_359b4b57771060c247ae112a52ca411f($t){

return $t->_meta;
}
function template_359b4b57771060c247ae112a52ca411f($t){
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
									<?php $t->_vars['tPost'] = array('affichage'=>'detail', 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=>$t->_vars['page'], 'nbPagination'=> $t->_vars['nbPagination'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']);?>
                                    <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', $t->_vars['tPost']);?>" class="formButton_detail<?php if($t->_vars['affichage'] == 'detail'):?>_hover<?php endif;?>">valid</a>
									<?php $t->_vars['tPost'] = array('affichage'=>'abrege', 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=>1, 'nbPagination'=> $t->_vars['nbPagination'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']);?>
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
                                            <tbody>
                                                <?php if(sizeof($t->_vars['toAnnonce'])==0):?>
                                                    <tr class="row1">
                                                        <td class="annonceBody1" colspan="6" align="center">Aucune annonce pour votre recherche</td>
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
													<div id="results">
									                <ul>
                                                    
                                                        <?php $t->_vars['i']=0;?>
                                                        <?php $t->_vars['j']=0;?>
                                                        <?php foreach($t->_vars['toAnnonce'] as $t->_vars['oAnnonce']):?>
                                                        <?php $t->_vars['tPost'] = array('anid'=>$t->_vars['oAnnonce']->annonce_id, 'affichage'=> $t->_vars['affichage'], 'cid'=> $t->_vars['cid'], 'rid'=> $t->_vars['rid'], 'mot'=> $t->_vars['mot'], 'crid'=> $t->_vars['crid'], 'parution'=> $t->_vars['parution'], 'province'=> $t->_vars['province'], 'localite'=> $t->_vars['localite'], 'prix1'=> $t->_vars['prix1'], 'prix2'=> $t->_vars['prix2'], 'page'=>$t->_vars['page'], 'nbPagination'=> $t->_vars['nbPagination'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']);?>                                                    
                                                        <?php if($t->_vars['i']==0):?>
                                                        	<li style="height:10px;"></li>                                                    
                                                        <?php endif;?>                                                            
                                                        <li class="result result_express">
                                                            <div class="result_title">
                                                                <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>"><?php echo $t->_vars['oAnnonce']->annonce_titre; ?></a> <span class="price"><?php if($t->_vars['oAnnonce']->annonce_prix): echo jtpl_modifier_common_format_number($t->_vars['oAnnonce']->annonce_prix, 0, ",", ' ','Ar');  else:?>N/D<?php endif;?><span class="price_info"> <?php echo $t->_vars['oAnnonce']->annonce_prixInfo; ?></span></span></h4>
                                                                <div>
                                                                    <p><span class="special">Forfait <?php echo $t->_vars['oAnnonce']->annonce_pack; ?></span></p>
                                                                    <ul class="split">
                                                                        <li><span><?php echo $t->_vars['oAnnonce']->annonce_province; ?> (<?php echo $t->_vars['oAnnonce']->annonce_localite; ?>)</span></li>
                                                                        <li class="last date">Parue le <?php echo jtpl_modifier_common_date_format($t->_vars['oAnnonce']->annonce_dateDebut,"%d/%m/%Y"); ?></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="clearer"></div>
                                                            </div>
                                                        
                                                            <div class="result_desc">
                                                                <div class="img_photo">
                                                                    <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>"><img width="180" height="135" border="1" name="imgPrinc<?php echo $t->_vars['oAnnonce']->annonce_id; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/photo/<?php echo $t->_vars['oAnnonce']->annonce_photo; ?>" alt="<?php echo $t->_vars['oAnnonce']->annonce_titre; ?>"></a>
                                                                    <div class="extra_etiquette"><?php echo $t->_vars['oAnnonce']->annonce_nbPhoto; ?> photo<?php if($t->_vars['oAnnonce']->annonce_nbPhoto > 1):?>s<?php endif;?></div>	    
                                                                </div>
                                                                <div class="desc_txt">
                                                                    <ul><li>Année&nbsp;: <strong><?php echo $t->_vars['oAnnonce']->annonce_annee; ?></strong></li><li>État&nbsp;: <strong><?php echo $t->_vars['oAnnonce']->annonce_etat; ?></strong></li></ul>
                                                                    <div class="intro">
                                                                        <p><?php echo $t->_vars['oAnnonce']->annonce_resume; ?> <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>">(pour plus de détails)</a></p>
                                                                    </div>
                                                                    <h5>Caractéristiques</h5>
                                                                    <p><?php echo $t->_vars['oAnnonce']->annonce_description; ?></p>
                                                                </div>
                                                            </div>    
                                                            <div class="result_foot">
                                                                <ul>
                                                                    <p class="regTextPaleNormal borderNoneInline">Référence: <strong><?php echo $t->_vars['oAnnonce']->annonce_reference; ?></strong></p>
                                                                    <li class="borderLeftInline">
                                                                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>" class="hotTopics">Offre de <?php echo $t->_vars['oAnnonce']->annonce_offre; ?></a>
                                                                    </li>
                                                                </ul>
                                                                <ul class="split float_r">
                                                                    <li class="last"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>" class="bt_add" onclick="">Voir l'annonce</a></li>
                                                                    
                                                                </ul>
                                                            </div>
                                                        </li><!-- result end -->
                                                        <?php $t->_vars['i']++;?>
 														<?php endforeach;?>
															
                                                        <!-- result end -->
                                                    </ul>
                                                    </div>

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
                                        </div>
                                    </div><?php 
}
?>