<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_a65ded0c4e160f5b88eeb0445dd1d5a3($t){

return $t->_meta;
}
function template_a65ded0c4e160f5b88eeb0445dd1d5a3($t){
?>							<div id="homepageNew">
                 				<h3>Actualit&eacute;s</h3> 
								<?php $t->_vars['i'] = 0;?>         
                                <?php foreach($t->_vars['toCategorieActs'] as $t->_vars['oCategories']):?>
                                    <?php if($t->_vars['i'] > 0):?>                                             
										<div class="articleSeparator"></div>                            
                                    <?php endif;?>                                                                         
                 					
                                    <h4><?php echo $t->_vars['oCategories']->categorieAct_libelle; ?></h4>                                                  
                                                                        
                                    <?php $t->_vars['j'] = 0;?>         
                                    <?php foreach($t->_vars['toActualites'] as $t->_vars['oActualites']):?>
                                    	<?php if($t->_vars['oActualites']->actualite_categorieActId == $t->_vars['oCategories']->categorieAct_id):?>
	                                        <?php $t->_vars['tPost'] = array('cid'=> $t->_vars['oActualites']->actualite_categorieActId, 'acid'=>$t->_vars['oActualites']->actualite_id );?>
                                            <div class="article <?php if($t->_vars['j'] > 0):?>borderBlue<?php endif;?>">
                                                <div class="articleTitle">
													<?php if($t->_vars['oActualites']->actualite_photo != ""):?>						                      		
                                                    <a title="<?php echo $t->_vars['oActualites']->actualite_titre; ?>" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', $t->_vars['tPost']);?>">
                                                        <img src="<?php echo $t->_vars['j_basepath']; ?>resize/actualite/images/left/<?php echo $t->_vars['oActualites']->actualite_photo; ?>" alt="<?php echo $t->_vars['oActualites']->actualite_titre; ?>"/>
                                                    </a>
													<?php endif;?>		
                                                    <a title="<?php echo $t->_vars['oActualites']->actualite_titre; ?>" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', $t->_vars['tPost']);?>"><?php echo $t->_vars['oActualites']->actualite_titre; ?></a>
                                                     <br /> 
                                                    <?php echo $t->_vars['oActualites']->actualite_resume; ?>
                                                    
                                                    <p class="date"><?php echo $t->_vars['oActualites']->actualite_datePublication; ?></p>
                                                </div>
                                            </div>                                        
                                            <?php $t->_vars['j']++;?>         
                                        <?php endif;?>
                                    <?php endforeach;?>    
                                    
                                    <div class="braftonFoot">
                                        <img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        <a rel="nofollow" title="Afficher d'autres articles" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=> $t->_vars['oCategories']->categorieAct_id));?>">Afficher d'autres articles</a>                                        
                                    </div><!-- braftonFoot:[end]-->
                                    
									<?php $t->_vars['i']++;?>         
                                <?php endforeach;?>
               				 </div><!-- end innerpageBlog -->                            
<?php 
}
?>