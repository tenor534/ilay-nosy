<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_518212f1c5e194de8f20b7b4d7e637ca($t){

return $t->_meta;
}
function template_518212f1c5e194de8f20b7b4d7e637ca($t){
?>							<div id="homepageAnnounce">
                 				<h3 class="mast_rencontre">Rencontres</h3>                  
                                
                                
                 				<h4>Femmes</h4>                  
                                <?php $t->_vars['j']=0;?>
                                <?php foreach($t->_vars['toAnnonceFemmes'] as $t->_vars['oAnnonces']):?>
	                                <?php $t->_vars['tPost'] = array('cid'=> $t->_vars['oAnnonces']->rubrique_categorieAnId, 'anid'=>$t->_vars['oAnnonces']->annonce_id );?>
                                    <div class="article <?php if($t->_vars['j'] > 0):?>borderBlue<?php endif;?>">
                                        <div class="articleTitle">                                  		
                                            <a title="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>">
                                                <img src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/left/<?php echo $t->_vars['oAnnonces']->annonce_photo; ?>" alt="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>"/>
                                            </a>
                                            <a title="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>"><?php echo $t->_vars['oAnnonces']->annonce_titre; ?></a>
                                            &nbsp;
                                            <?php echo $t->_vars['oAnnonces']->annonce_resume; ?>
                                            <p class="date">Parue depuis : <?php if($t->_vars['oAnnonces']->annonce_parution == 0):?>Aujourd'hui<?php else: echo $t->_vars['oAnnonces']->annonce_parution; ?> jour<?php if($t->_vars['oAnnonces']->annonce_parution > 1):?>s<?php endif; endif;?></p>
                                        </div>
                                    </div>
                                <?php $t->_vars['j']++;?>
                                <?php endforeach;?>
                                <div class="braftonFoot">
                                	<img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=> 66));?>">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
		
                                <div class="articleSeparator"></div>                            
                 				<h4>Hommes</h4>                  

                                <?php $t->_vars['j']=0;?>
                                <?php foreach($t->_vars['toAnnonceHommes'] as $t->_vars['oAnnonces']):?>
	                                <?php $t->_vars['tPost'] = array('cid'=> $t->_vars['oAnnonces']->rubrique_categorieAnId, 'anid'=>$t->_vars['oAnnonces']->annonce_id );?>
                                    <div class="article <?php if($t->_vars['j'] > 0):?>borderBlue<?php endif;?>">
                                        <div class="articleTitle">                                  		
                                            <a title="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>">
                                                <img src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/left/<?php echo $t->_vars['oAnnonces']->annonce_photo; ?>" alt="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>"/>
                                            </a>
                                            <a title="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>"><?php echo $t->_vars['oAnnonces']->annonce_titre; ?></a>
                                            &nbsp;
                                            <?php echo $t->_vars['oAnnonces']->annonce_resume; ?>
                                            <p class="date">Parue depuis : <?php if($t->_vars['oAnnonces']->annonce_parution == 0):?>Aujourd'hui<?php else: echo $t->_vars['oAnnonces']->annonce_parution; ?> jour<?php if($t->_vars['oAnnonces']->annonce_parution > 1):?>s<?php endif; endif;?></p>
                                        </div>
                                    </div>
                                <?php $t->_vars['j']++;?>
                                <?php endforeach;?>
                                <div class="braftonFoot">
                                	<img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=> 73));?>">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
                                
                                <div class="articleSeparator"></div>                            
                                
                 				<h4>Couples</h4>                  

                                <?php $t->_vars['j']=0;?>
                                <?php foreach($t->_vars['toAnnonceCouples'] as $t->_vars['oAnnonces']):?>
	                                <?php $t->_vars['tPost'] = array('cid'=> $t->_vars['oAnnonces']->rubrique_categorieAnId, 'anid'=>$t->_vars['oAnnonces']->annonce_id );?>
                                    <div class="article <?php if($t->_vars['j'] > 0):?>borderBlue<?php endif;?>">
                                        <div class="articleTitle">                                  		
                                            <a title="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>">
                                                <img src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/left/<?php echo $t->_vars['oAnnonces']->annonce_photo; ?>" alt="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>"/>
                                            </a>
                                            <a title="<?php echo $t->_vars['oAnnonces']->annonce_titre; ?>" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', $t->_vars['tPost']);?>"><?php echo $t->_vars['oAnnonces']->annonce_titre; ?></a>
                                            &nbsp;
                                            <?php echo $t->_vars['oAnnonces']->annonce_resume; ?>
                                            <p class="date">Parue depuis : <?php if($t->_vars['oAnnonces']->annonce_parution == 0):?>Aujourd'hui<?php else: echo $t->_vars['oAnnonces']->annonce_parution; ?> jour<?php if($t->_vars['oAnnonces']->annonce_parution > 1):?>s<?php endif; endif;?></p>
                                        </div>
                                    </div>
                                <?php $t->_vars['j']++;?>
                                <?php endforeach;?>
                                <div class="braftonFoot">
                                	<img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=> 80));?>">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
               				 </div><!-- end innerpageBlog -->                            
<?php 
}
?>