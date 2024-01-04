<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
function template_meta_ce50ebc6df81f8006ebe86f69ace281f($t){

return $t->_meta;
}
function template_ce50ebc6df81f8006ebe86f69ace281f($t){
?>							<?php if(sizeof($t->_vars['toAnnonces'])):?>
                                <?php $t->_vars['j']=0;?>
                                <?php foreach($t->_vars['toAnnonces'] as $t->_vars['oAnnonces']):?>                                
                                <div class="row" id="mainNews">
                                    <div class="header">
                                        <h3 class="<?php echo $t->_vars['oAnnonces']->annonce_h3; ?>"><?php echo $t->_vars['oAnnonces']->annonce_topTitre; ?></h3>
                                    </div><!-- header:[end] -->
                                    <?php $t->_vars['tPost'] = array('cid'=> $t->_vars['oAnnonces']->rubrique_categorieAnId, 'anid'=>$t->_vars['oAnnonces']->annonce_id );?>                                                                                                                     
                                    <div class="singleColumnBig">
                                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>" title="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>">
                                            <h2><?php echo $t->_vars['oAnnonces']->annonce_titre; ?></h2>
                                        </a>
                                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>" title="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>">
                                          <img width="469" height="313" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/home/<?php echo $t->_vars['oAnnonces']->annonce_photo; ?>" alt="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>">
                                        </a>
                                        <span class="viewsComments">
                                            <span>R&eacute;f:</span> <?php echo $t->_vars['oAnnonces']->annonce_reference; ?> <span>Prix:</span>  <?php if($t->_vars['oAnnonces']->annonce_prix): echo jtpl_modifier_common_format_number($t->_vars['oAnnonces']->annonce_prix, 0, ",", ' ','Ar');  else:?>N/D<?php endif;?> <span>Vues:</span> <?php echo $t->_vars['oAnnonces']->annonce_visite; ?> fois
                                            <p class="date">Parue depuis : <?php if($t->_vars['oAnnonces']->annonce_parution == 0):?>Aujourd'hui<?php else: echo $t->_vars['oAnnonces']->annonce_parution; ?> jour<?php if($t->_vars['oAnnonces']->annonce_parution > 1):?>s<?php endif; endif;?></p>
                                        </span>
                                    </div><!-- :[end] -->
                                    
                                </div><!-- mainStory:[end] -->                         
                                <?php endforeach;?>
                            <?php endif;?>
<?php 
}
?>