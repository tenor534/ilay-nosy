<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.date_format.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_c9530d144fc5df0d8d961b984f9de17c($t){

return $t->_meta;
}
function template_c9530d144fc5df0d8d961b984f9de17c($t){
?>								<!-- Flash actualit&eacute;s -->
                                <div id="innerpageNew">
                                    <h4>Flash actualit&eacute;</h4>

                                    <ul class="secondaryNew">                                    
                                    <?php foreach($t->_vars['toActualites'] as $t->_vars['oActualites']):?>
                                        <?php $t->_vars['tPost'] = array('cid'=> $t->_vars['oActualites']->actualite_categorieActId, 'acid'=>$t->_vars['oActualites']->actualite_id );?>
                                        <li>
                                        	<span class="heure">&raquo; <?php echo jtpl_modifier_common_date_format($t->_vars['oActualites']->actualite_datePublication,"%Hh %M"); ?></span> 
                                        	<span class="titre"><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', $t->_vars['tPost']);?>"><?php echo $t->_vars['oActualites']->actualite_titre; ?></a> </span>
                                        </li>
                                    <?php endforeach;?>   	                                        
                                    </ul>

                                    <div class="braftonFoot">
                                        <img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        <a rel="nofollow" title="Afficher d'autres articles" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteCategorieList');?>">Afficher d'autres articles</a>
                                    </div><!-- braftonFoot:[end]-->		
                                </div>
<?php 
}
?>