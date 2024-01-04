<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.date_format.php');
function template_meta_e739e0d4de85cc998a2f73edcc90b79d($t){

return $t->_meta;
}
function template_e739e0d4de85cc998a2f73edcc90b79d($t){
?>									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Liste de vos annonces</span> 
                                      	</p>          

   										<p style="clear:both">
                                            <?php $t->_vars['nbForfaitAnnonce'] = 0;?>
                                            <?php foreach($t->_vars['listeAbonnement'] as $t->_vars['olisteAbonnement']):?>
                                                <?php if($t->_vars['olisteAbonnement']->abonnement_id==$t->_vars['aid']):?>
                                                    <?php $t->_vars['nbForfaitAnnonce'] = $t->_vars['olisteAbonnement']->forfait_nbAnnonce;?>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                            
                                            
                                            <?php $t->_vars['nbUsedAnnonce'] = $t->_vars['iNbEnreg'];?>
                                            
                                            
                                            <?php $t->_vars['nbFreeAnnonce'] = $t->_vars['nbForfaitAnnonce'] - $t->_vars['nbUsedAnnonce'];?>
                                            <span class="viewTexte">Voici la liste de vos annonces selon l'abonnement que vous avez choisi.</span> 
                                                
                                            <?php if($t->_vars['nbFreeAnnonce'] > 0 ):?>
                                                <?php if($t->_vars['nbForfaitAnnonce']):?>
                                                   <span class="viewTexte">Vous pouvez encore ajouter <?php echo $t->_vars['nbFreeAnnonce']; ?> annonce(s) pour cet abonnement.</span>
                                                <?php endif;?>    
                                            <?php else:?>   
                                                <?php if($t->_vars['nbUsedAnnonce']):?>
                                                   <span class="viewTexte red">Vous avez atteint votre limite (<?php echo $t->_vars['nbForfaitAnnonce']; ?>) d'ajout d'annonces pour cet abonnement.</span>
                                                <?php endif;?>    
                                             <?php endif;?>   
                                         </p>
									</div>
                                    
                                    <form id="annonceForm" name="annonceForm" action="#" method="post">
                                    	<input type="hidden" id="aid" name="aid" value="<?php echo $t->_vars['aid']; ?>" />
                                    	<input type="hidden" id="anid" name="anid" value="0" />
                                    	<input type="hidden" id="page" name="page" value="<?php echo $t->_vars['page']; ?>" />
                                        <div style="clear: both;" class="annonceContent">                                        
                                            <!--p class="annonceTitre">Recherche</p-->
                                            <div id="search_standard" class="annonceCriteriaLine">
                                                <div class="annonceCriteria">
                                                    <label for="forum_parue">S&eacute;lectionner un abonnement: </label><br>
                                                    <select style="width:600px;" class="user_input1 user_input_select input_middle" name="annonce_abonnementId" id="annonce_abonnementId"  tmt:invalidvalue="0" tmt:required="true" onchange="selectAbonnement(this);">			
                                                        <option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                        <?php foreach($t->_vars['listeAbonnement'] as $t->_vars['olisteAbonnement']):?>
                                                            <?php if($t->_vars['olisteAbonnement']->abonnement_id==$t->_vars['aid']):?>
                                                                <?php $t->_vars['selected']="selected";?>
                                                            <?php else:?>
                                                                <?php $t->_vars['selected']="";?>
                                                            <?php endif;?>
                                                            <option value="<?php echo $t->_vars['olisteAbonnement']->abonnement_id; ?>" <?php echo $t->_vars['selected']; ?>>PACK : <?php echo $t->_vars['olisteAbonnement']->pack_libelle; ?> (<?php echo $t->_vars['olisteAbonnement']->forfait_libelle; ?>) - R&eacute;f. <?php echo $t->_vars['olisteAbonnement']->abonnement_reference; ?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </form>
									<p style="clear: both;height:5px;"></p>
                                   <?php if($t->_vars['nbFreeAnnonce'] > 0 ):?>                                   			
                                        <p style="clear: both;height:5px;"></p>                                                                        
                                        <a href="javascript:addAnnonce();" class="formButton_add">Ajouter</a>                                    
                                    <?php endif;?>    
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
                                                        <td class="annonceBody1" colspan="6">Aucune annonce enregistr&eacute;e</td>
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
                                                    <?php $t->_vars['tPost']= array('annonce_id'=> $t->_vars['oAnnonce']->annonce_id, 'page'=>$t->_vars['page']);?>                                                    
                                                    
                                                    <tr>
                                                        <td class="annonceBody0">
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceEdit', array('anid'=>$t->_vars['oAnnonce']->annonce_id, 'page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>" class="blueHead">
                                                            <img width="98" height="74" border="0" alt="<?php echo $t->_vars['oAnnonce']->annonce_titre; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/abrege/<?php echo $t->_vars['oAnnonce']->annonce_photo; ?>" name="imgPrinc">
                                                            </a>
                                                        </td>
                                                        <td class="annonceBody1">
                                                            <h5><a class="titre" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceEdit', array('anid'=>$t->_vars['oAnnonce']->annonce_id, 'page'=>$t->_vars['page'], 'aid'=>$t->_vars['aid'], 'sortField'=>$t->_vars['sortField'], 'sortDirection'=>$t->_vars['sortDirection']));?>"><?php echo $t->_vars['oAnnonce']->annonce_titre; ?></a></h5>
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
                                                        <td class="annonceBody4">
															<p><input type="checkbox" name="annoncePublier_<?php echo $t->_vars['oAnnonce']->annonce_id; ?>" value="<?php echo $t->_vars['oAnnonce']->annonce_publier; ?>" <?php if($t->_vars['oAnnonce']->annonce_publier == 1):?>checked<?php endif;?> onclick="return checkAnnonce(this);"></p>
                                                        </td>
                                                        <td class="annonceBody5">
                                                            <p><span class="parution"><?php echo jtpl_modifier_common_date_format($t->_vars['oAnnonce']->annonce_dateDebut,"%d/%m/%Y"); ?></span></p>
                                                        </td>                                                
                                                    </tr>    
                                                    <?php $t->_vars['j']++;?>
                                                    <?php endforeach;?>
                                                            
                                                    <?php if($t->_vars['nbPage'] > 1):?>                                        
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">
                                                                    <p class="regTextPale forumFoot">Affiche <?php echo $t->_vars['iDebutEnreg']; ?> -&gt; <?php echo $t->_vars['iFinEnreg']; ?> sur <?php echo $t->_vars['iNbEnreg']; ?> annonce(s)</p>
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