<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_ada1fcbd4e6d9791ab192d62253202a9($t){

return $t->_meta;
}
function template_ada1fcbd4e6d9791ab192d62253202a9($t){
?>							 <div id="homepageContact">
                 				<h3>Nous contacter</h3>                                
                                <div class="article">
	                                
                                	<div class="articleTitle borderGrey">
	                                	<img class="incArrow" src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v6/icn-arrow.gif"/>
                                        <span class="incTexte">
                                        	Tél.: <a>039 14 262 25</a>
                                        </span>   
                                    </div>   
                                	<div class="articleTitle borderGrey">
	                                	<img class="incArrow" src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v6/icn-arrow.gif"/>
                                        <span class="incTexte">
                                        	<a href="mailto:contact@ilay-nosy.com?subject=annonce">contact@ilay-nosy.com</a>
                                        </span>   
                                    </div>    
                                	<div class="articleTitle borderGrey">
	                                	<img class="incArrow" src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v6/icn-arrow.gif"/>
                                        <span class="incTexte">
											<a href="<?php jtpl_function_html_jurl( $t,'contact~contactFo_contactDemande');?>">Nous contacter</a>
                                        </span>
                                  	</div>
								</div>	                                    
               				 </div>
<?php 
}
?>