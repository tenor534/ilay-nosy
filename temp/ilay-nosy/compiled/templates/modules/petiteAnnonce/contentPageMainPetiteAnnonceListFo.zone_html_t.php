<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.date_format.php');
function template_meta_91f9b5be484fc77c0b2f638569b7c246($t){

return $t->_meta;
}
function template_91f9b5be484fc77c0b2f638569b7c246($t){
?>									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Les petites annonces</span> 
                                      	</p>          

   										<p style="clear:both">
                                            
                                            <?php $t->_vars['nbUsedPetiteAnnonce'] = $t->_vars['iNbEnreg'];?>
                                            
                                            <span class="viewTexte">Choisissez une cat&eacute;gorie pour visualiser la liste des petites annonces correspondantes.</span> 
                                             <br>   
                                            <?php if($t->_vars['nbUsedPetiteAnnonce'] > 0 ):?>
                                             	<span class="viewTexte"><?php echo $t->_vars['nbUsedPetiteAnnonce']; ?> annonce(s) pour cette cat&eacute;gorie.</span>
                                            <?php else:?>   
                                                 <span class="viewTexte red">Aucune annonce trouv&eacute;e.</span>
                                             <?php endif;?>   
                                         </p>
									</div>
                                    
                                    <form id="annonceForm" name="annonceForm" action="#" method="post">
                                    	<input type="hidden" id="cid" name="cid" value="<?php echo $t->_vars['cid']; ?>" />
                                    	<input type="hidden" id="anid" name="anid" value="0" />
                                    	<input type="hidden" id="page" name="page" value="<?php echo $t->_vars['page']; ?>" />
                                        <div style="clear: both;" class="annonceContent">                                        
                                            <!--p class="annonceTitre">Recherche</p-->
                                            <div id="search_standard" class="annonceCriteriaLine">
                                                <div class="annonceCriteria">
                                                    <label for="forum_parue">S&eacute;lectionner une cat&eacute;gorie d'annonce: </label><br>
                                                    <select style="width:600px;" class="user_input1 user_input_select input_middle" name="petiteAnnonce_categorieAnId" id="petiteAnnonce_categorieAnId" onchange="selectCategorieAn(this);">			
                                                        <option value="0">Cat&eacute;gories d'annonces</option>
                                                        <?php foreach($t->_vars['listeCategorieAn'] as $t->_vars['olisteCategorieAn']):?>
                                                            <?php if($t->_vars['olisteCategorieAn']->categorieAn_id==$t->_vars['cid']):?>
                                                                <?php $t->_vars['selected']="selected";?>
                                                            <?php else:?>
                                                                <?php $t->_vars['selected']="";?>
                                                            <?php endif;?>
                                                            <option value="<?php echo $t->_vars['olisteCategorieAn']->categorieAn_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['olisteCategorieAn']->categorieAn_libelle; ?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </form>
									<p style="clear: both;height:5px;"></p>
                                                                      			
                                        <p style="clear: both;height:5px;"></p>                                                                        
                                        <a href="javascript:addPetiteAnnonce();" class="formButton_add">Ajouter</a>                                    
                                        
									<p style="clear: both;height:10px;"></p>
                                    
                                    <div class="ajaxZone">                                    
                                        <div class="sortableListWithPagination">
										<table class="commPetiteAnnonce expanded" cellspacing="0"  id="tableListePetiteAnnonce" currentSortField="<?php echo $t->_vars['sortField']; ?>" currentSortDirection="<?php echo $t->_vars['sortDirection']; ?>" currentPage="<?php echo $t->_vars['page']; ?>" nbPage="<?php echo $t->_vars['nbPage']; ?>" src="<?php jtpl_function_html_jurl( $t,'commun~communBo_getZone', $t->_vars['tParams']);?>">
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
                                                <?php if(sizeof($t->_vars['toPetiteAnnonce'])==0):?>
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
                                                    <?php foreach($t->_vars['toPetiteAnnonce'] as $t->_vars['oPetiteAnnonce']):?>
                                                    <?php $t->_vars['tPost']= array('petiteAnnonce_id'=> $t->_vars['oPetiteAnnonce']->petiteAnnonce_id, 'page'=>$t->_vars['page']);?>                                                    
                                                    
                                                    <tr>
                                                        <td class="annonceBody0">
                                                            <a class="parution">
                                                            <?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_reference; ?>
                                                            </a>
                                                        </td>
                                                        <td class="annonceBody1">
                                                        	<?php if($t->_vars['cid'] == 0):?>
	                                                        <span class="announceCategorie">
					                                            <?php echo $t->_vars['oPetiteAnnonce']->categorieAn_libelle; ?>                                            
                                                            </span>
                                                            <?php endif;?>
                                                            <span class="announceDescription">
	                                                            <?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_description; ?>
                                                                <h5 style="color:#023755; margin-top:5px;"><span class="nowrap">Prix:&nbsp;<?php if($t->_vars['oPetiteAnnonce']->petiteAnnonce_prix): echo jtpl_modifier_common_format_number($t->_vars['oPetiteAnnonce']->petiteAnnonce_prix, 0, ",", ' ','Ar');  else:?>N/D<?php endif;?></span><span class="supp_info"><?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_prixInfo; ?></span></h5>
                                                                <span style="color:#000">Contact:&nbsp;<?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_contact; ?></span>
                                                            </span>
                                                        </td>
                                                        
                                                        <td class="annonceBody5">
                                                            <p><span class="parution"><?php echo jtpl_modifier_common_date_format($t->_vars['oPetiteAnnonce']->petiteAnnonce_dateCreation,"%d/%m/%Y (%H:%M:%S)"); ?></span></p>
                                                        </td> 
                                                                                                       
                                                    </tr>    
                                                    <?php $t->_vars['j']++;?>
                                                    <?php endforeach;?>
                                                            
                                                    <?php if($t->_vars['nbPage'] > 1):?>                                        
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static" style="width: 260px;">
                                                                    <p class="regTextPale forumFoot">Affiche <?php echo $t->_vars['iDebutEnreg']; ?> -&gt; <?php echo $t->_vars['iFinEnreg']; ?> sur <?php echo $t->_vars['iNbEnreg']; ?> annonce(s)</p>
                                                                </div>
                                                                <div class="commFoot3" style="width: 370px;">
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