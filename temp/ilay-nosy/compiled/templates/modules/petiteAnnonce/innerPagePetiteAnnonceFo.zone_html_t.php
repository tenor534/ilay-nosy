<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.date_format.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_5c07a831920ef6169cdcc10d891ba783($t){

return $t->_meta;
}
function template_5c07a831920ef6169cdcc10d891ba783($t){
?>                                <!-- PetiteAnnonces -->
                                <div id="innerpageAnnounce">
                                    <h4 class="mast_petiteAn" id="innerpageAnnounceTop">Petites annonces</h4>

                                    <ul class="secondaryPetiteAnnounce">                                    
									<?php $t->_vars['j']=0;?>
                                    <?php foreach($t->_vars['toPetiteAnnonces'] as $t->_vars['oPetiteAnnonces']):?>
	                                    <?php $t->_vars['tPost'] = array('cid'=> $t->_vars['oPetiteAnnonces']->petiteAnnonce_categorieAnId, 'anid'=>$t->_vars['oPetiteAnnonces']->petiteAnnonce_id );?>                                                                                     
                                        <li>
                                            <span class="announceDate">
	                                            <?php echo jtpl_modifier_common_date_format($t->_vars['oPetiteAnnonces']->petiteAnnonce_dateCreation,"%H:%M:%S - %d/%m/%Y"); ?>
                                            </span>
                                            <span class="announceCategorie">
	                                            <?php echo $t->_vars['oPetiteAnnonces']->categorieAn_libelle; ?>
                                            </span>
                                            <span class="announceTitle">
                                                
                                                <a title="<?php echo $t->_vars['oPetiteAnnonces']->petiteAnnonce_description; ?>"><?php echo $t->_vars['oPetiteAnnonces']->petiteAnnonce_description; ?></a>
                                            </span>
                                            <span class="viewsComments">
                                                <span class="name">R&eacute;f:</span>&nbsp;<span class="value"><?php echo $t->_vars['oPetiteAnnonces']->petiteAnnonce_reference; ?></span> 
                                                <span class="name">Prix:</span>&nbsp;<span class="value"><?php if($t->_vars['oPetiteAnnonces']->petiteAnnonce_prix): echo jtpl_modifier_common_format_number($t->_vars['oPetiteAnnonces']->petiteAnnonce_prix, 0, ",", ' ','Ar');  else:?>N/D<?php endif;?> <?php if($t->_vars['oPetiteAnnonces']->petiteAnnonce_prixInfo): echo $t->_vars['oPetiteAnnonces']->petiteAnnonce_prixInfo;  endif;?></span> 
                                                <span class="name">Contact:</span>&nbsp;<span class="value"><?php if($t->_vars['oPetiteAnnonces']->petiteAnnonce_contact): echo $t->_vars['oPetiteAnnonces']->petiteAnnonce_contact;  else:?>N/C<?php endif;?></span>                                                  
    		                                    <span class="name">Parue depuis:</span>&nbsp;<span class="date"><?php if($t->_vars['oPetiteAnnonces']->petiteAnnonce_parution == 0):?>Aujourd'hui<?php else: echo $t->_vars['oPetiteAnnonces']->petiteAnnonce_parution; ?> jour<?php if($t->_vars['oPetiteAnnonces']->petiteAnnonce_parution > 1):?>s<?php endif; endif;?></span>
	                                        </span>
                                            
                                        </li>      
									<?php endforeach;?>	


                                    </ul>
									<?php if(count($t->_vars['toPetiteAnnonces'])):?>
                                    <div class="braftonFoot">
                                        <img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        <a rel="nofollow" title="Ajouter une petite annonce gratuitement" href="<?php jtpl_function_html_jurl( $t,'petiteAnnonce~petiteAnnonceFo_petiteAnnonceEdit', array('cid'=> 0));?>">Ajouter une petite annonce gratuitement</a>
                                    </div><!-- braftonFoot:[end]-->		
                                    <?php endif;?>    
                                    <div class="braftonFoot">
                                        <img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        <a rel="nofollow" title="Toutes les rubriques" href="<?php jtpl_function_html_jurl( $t,'petiteAnnonce~petiteAnnonceFo_petiteAnnonceList', array('cid'=> 0));?>">Toutes les rubriques</a>
                                    </div><!-- braftonFoot:[end]-->		
                                </div>
                                <!-- end innerpageAnnounce -->
<?php 
}
?>