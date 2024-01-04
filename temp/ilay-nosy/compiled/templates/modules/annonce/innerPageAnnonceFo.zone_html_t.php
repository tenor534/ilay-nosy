<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
function template_meta_22a5d860f73eac1414c521a2f8de773b($t){

return $t->_meta;
}
function template_22a5d860f73eac1414c521a2f8de773b($t){
?>								

                                <!-- Annonces -->
                                <div id="innerpageAnnounce">
                                    <h4 class="<?php echo $t->_vars['mast']; ?>" id="innerpageAnnounceTop"><?php echo $t->_vars['topTitre']; ?></h4>
                                    <ul class="secondaryAnnounce">
                                    
									<?php $t->_vars['j']=0;?>
                                    <?php foreach($t->_vars['toAnnonces'] as $t->_vars['oAnnonces']):?>
	                                    <?php $t->_vars['tPost'] = array('cid'=> $t->_vars['oAnnonces']->rubrique_categorieAnId, 'anid'=>$t->_vars['oAnnonces']->annonce_id );?>                                                                                     
                                        <li>
                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>" title="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>">
                                                <img src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/photo/<?php echo $t->_vars['oAnnonces']->annonce_photo; ?>" alt="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>" class="videoThumb">
                                            </a>
                                            <span class="announceTitle">
                                                <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>" title="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>"><?php echo $t->_vars['oAnnonces']->annonce_titre; ?></a>
                                                <br />
                                                <?php echo $t->_vars['oAnnonces']->annonce_resume; ?>
                                            </span>
                                            <span class="viewsComments">
                                                <span>R&eacute;f:</span> <?php echo $t->_vars['oAnnonces']->annonce_reference; ?> <span>Prix:</span>  <?php if($t->_vars['oAnnonces']->annonce_prix): echo jtpl_modifier_common_format_number($t->_vars['oAnnonces']->annonce_prix, 0, ",", ' ','Ar');  else:?>N/D<?php endif;?> 
                                                <br>
                                                <span>Vues:</span> <?php echo $t->_vars['oAnnonces']->annonce_visite; ?>
                                                 - 
    		                                    <span class="date">Parue depuis : <?php if($t->_vars['oAnnonces']->annonce_parution == 0):?>Aujourd'hui<?php else: echo $t->_vars['oAnnonces']->annonce_parution; ?> jour<?php if($t->_vars['oAnnonces']->annonce_parution > 1):?>s<?php endif; endif;?></span>
	                                        </span>
                                            
                                        </li>      
									<?php endforeach;?>	


                                    </ul>
									<?php if(count($t->_vars['toAnnonces'])):?>
                                    <div class="braftonFoot">
                                        <img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        <?php if($t->_vars['oAnnonces']->annonce_cat == 4):?> 
	                                        <a rel="nofollow" title="Toutes les rubriques" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=> 777));?>">Toutes les rubriques</a>
                                        <?php else:?>
	                                        <a rel="nofollow" title="Toutes les rubriques" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=> $t->_vars['oAnnonces']->rubrique_categorieAnId));?>">Toutes les rubriques</a>
                                        <?php endif;?>    
                                    </div><!-- braftonFoot:[end]-->		
                                    <?php endif;?>    
                                </div>
                                <!-- end innerpageAnnounce -->
<?php 
}
?>