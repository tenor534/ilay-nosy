<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_df259202834a0acec95cb4bfeafff9c5($t){

return $t->_meta;
}
function template_df259202834a0acec95cb4bfeafff9c5($t){
?>									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Les cat&eacute;gories d'actualit&eacute;s</span> 
                                      	</p>          
                                        <p style="clear: both;">
                                            <span class="viewTexte">Pour rechercher des actualit&eacute;s, utilisez le formulaire ci-dessous ou cliquez directement sur une actualit&eacute;.</span> 
                                        </p>
									</div>
                                    
                                    <div class="ajaxZone">
									<div style="clear:both; height:5px;">&nbsp;</div>
    
									<div id="viewCriteria">
                                    	<div class="headPan">
                                        	<span class="viewTitre">Rechercher une actualit&eacute; sur Ilay NOSY</span>
                                        </div>
                                    	<div class="middlePan">
	                                        <div class="blank">
		                                        <div class="content">
                                        
                                        <form id="actualiteForm" name="actualiteForm" action="#">
                                            <div class="actualiteContent">
                                                <!--p class="actualiteTitre">Recherche</p-->
                                                
                                                <div id="search_standard" class="actualiteCriteriaLineLeft">
                                                    <div class="actualiteCriteria">
                                                        <label for="forum_mot">Mot cl&eacute;: </label><br>
                                                        <input style="width:398px;" class="user_input2 input_middle" type="text" id="mot" name="mot" value="" >
                                                    </div>
                                                    <div class="actualiteCriteria">
                                                        <label for="forum_type">Cat&eacute;gories : </label><br>
                                                        <select style="width:400px;height:107px;" class="user_input_select1 input_middle" size="10" id="cid" name="cid">
                                                            <?php foreach($t->_vars['toCategorieActs'] as $t->_vars['oCategories']):?>
                                                                <option value="<?php echo $t->_vars['oCategories']->categorieAct_id; ?>"><?php echo $t->_vars['oCategories']->categorieAct_libelle; ?></option>
                                                            <?php endforeach;?>
                                                        </select>                                           
                                                    </div>                                            
                                                </div>
                                                
                                                <div id="search_standard" class="actualiteCriteriaLineRight">
                                                    <div class="actualiteCriteria">
                                                        <label for="forum_parue">Parue depuis : </label><br>
                                                        <select class="user_input4 user_input_select input_middle" id="parution" name="parution">
                                                            <option value="0" selected="selected">Toute</option>
                                                            <option value="1">1 jour</option>
                                                            <option value="2">2 jours</option>
                                                            <option value="3">3 jours</option>
                                                            <option value="4">1 semaine</option>
                                                            <option value="5">2 semaines</option>
                                                            <option value="6">1 mois</option>
                                                            <option value="7">2 mois</option>
                                                        </select>
                                                    </div>                                            
                                                    <div class="actualiteCriteria">                                                        
                                                        <label for="forum_tri">Affichage : </label><br>
                                                        <select class="user_input4 user_input_select input_middle" id="affichage" name="affichage">
                                                            <option value="0">Affichage en :</option>
                                                            <option value="1">Detail</option>
                                                            <option value="2">Abr&eacute;g&eacute;</option>
                                                            <option value="3">Photo</option>
                                                        </select>
                                                    </div>                                            
                                                </div>
                                                <div style="clear:both"></div>	
                                                <a href="#" class="formButton_valid">valid</a>
                                                <br />
                                                <br />
                                            </div>
                                            <p class="errorMessage" id="errorMessage"></p>
                                        </form>                                       
	                                         	</div>       
	                                        </div>                                     
                                        </div>                                     
                                    	<div class="footPan">
                                        	<span class="viewTitre">&nbsp;</span> 
                                        </div>                                     
                                    </div>                                    
									<div style="clear:both; height:10px;">&nbsp;</div>	
                            
                                        <h3>Consulter les cat&eacute;gories d'actualit&eacute;s</h3>
                            
                                        <div class="box" id="box_cat">
                                            <div class="box_inner">

												
                                                <div class="col3">
                                                    <!-- Catégorie -->                                                    
                                                    <?php foreach($t->_vars['toCategorieActs1'] as $t->_vars['oCategorieActs']):?>
                                                    <div id="cat-<?php echo $t->_vars['oCategorieActs']->categorieAct_id; ?>-top-box" class="cat_retract">
                                                        <div class="cat_box">
                                                            <h4><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id));?>"><?php echo $t->_vars['oCategorieActs']->categorieAct_libelle; ?></a> <span class="num">(<?php echo $t->_vars['toCategorieActNBs'][$t->_vars['oCategorieActs']->categorieAct_id]; ?>)</span></h4>
                                                            <span id="cat-<?php echo $t->_vars['oCategorieActs']->categorieAct_id; ?>" class="cat_box_action_bt">Ouvert</span>
                                                            <div class="clearer"></div>                                                                                                            
                                                            <?php if($t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['id']):?>
                                                                <a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id, 'acid'=>$t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['id']));?>">
                                                                    <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/actualite/images/front/<?php echo $t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                                </a>
                                                                <p><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id, 'acid'=>$t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['id']));?>"><?php echo $t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['titre']; ?></a></p>
                                                            <?php endif;?>	                                                    
                                                            
                                                        </div>
                                                        <div class="cat_box_foot"></div>                                                
        
                                                        <div id="cat-<?php echo $t->_vars['oCategorieActs']->categorieAct_id; ?>-bottom-box" class="cat_supp">
                                                            <?php $t->_vars['i'] = 0;?>
                                                            <?php foreach($t->_vars['toActualites'] as $t->_vars['oActualites']):?>
                                                                <?php if($t->_vars['oActualites']->actualite_categorieActId == $t->_vars['oCategorieActs']->categorieAct_id):?>
	                                                                <ul><li>
    	                                                            <img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowAct_black.gif" style="float:left;"/>
																	<a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=>$t->_vars['oActualites']->actualite_categorieActId,'acid'=>$t->_vars['oActualites']->actualite_id));?>"><?php echo $t->_vars['oActualites']->actualite_titre; ?></a> <span class="num"></span>
                                                                    </li></ul>
                                                                <?php endif;?>                                                                    
                                                            <?php endforeach;?>
                                                            </ul>
                                                            <ul class="allCateg">
                                                                <li><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id));?>">Toutes les cat&eacute;gories</a></li>
                                                            </ul>
                                                        </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                    <?php endforeach;?>
                                                </div><!-- col1 end -->
                                                
												
                                                <div class="col3">
                                                    <!-- Catégorie -->                                                    
                                                    <?php foreach($t->_vars['toCategorieActs2'] as $t->_vars['oCategorieActs']):?>
                                                    <div id="cat-<?php echo $t->_vars['oCategorieActs']->categorieAct_id; ?>-top-box" class="cat_retract">
                                                        <div class="cat_box">
                                                            <h4><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id));?>"><?php echo $t->_vars['oCategorieActs']->categorieAct_libelle; ?></a> <span class="num">(<?php echo $t->_vars['toCategorieActNBs'][$t->_vars['oCategorieActs']->categorieAct_id]; ?>)</span></h4>
                                                            <span id="cat-<?php echo $t->_vars['oCategorieActs']->categorieAct_id; ?>" class="cat_box_action_bt">Ouvert</span>
                                                            <div class="clearer"></div>                                                                                                            
                                                            <?php if($t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['id']):?>
                                                                <a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id, 'acid'=>$t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['id']));?>">
                                                                    <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/actualite/images/front/<?php echo $t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                                </a>
                                                                <p><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id, 'acid'=>$t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['id']));?>"><?php echo $t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['titre']; ?></a></p>
                                                            <?php endif;?>	                                                    
                                                            
                                                        </div>
                                                        <div class="cat_box_foot"></div>                                                
        
                                                        <div id="cat-<?php echo $t->_vars['oCategorieActs']->categorieAct_id; ?>-bottom-box" class="cat_supp">
                                                            <?php $t->_vars['i'] = 0;?>
                                                            <?php foreach($t->_vars['toActualites'] as $t->_vars['oActualites']):?>
                                                                <?php if($t->_vars['oActualites']->actualite_categorieActId == $t->_vars['oCategorieActs']->categorieAct_id):?>
	                                                                <ul><li>
    	                                                            <img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowAct_black.gif" style="float:left;"/>
																	<a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=>$t->_vars['oActualites']->actualite_categorieActId,'acid'=>$t->_vars['oActualites']->actualite_id));?>"><?php echo $t->_vars['oActualites']->actualite_titre; ?></a> <span class="num"></span>
                                                                    </li></ul>
                                                                <?php endif;?>                                                                    
                                                            <?php endforeach;?>
                                                            </ul>
                                                            <ul class="allCateg">
                                                                <li><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id));?>">Toutes les cat&eacute;gories</a></li>
                                                            </ul>
                                                        </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                    <?php endforeach;?>
                                                </div><!-- col1 end -->
                                                
												
                                                <div class="col3">
                                                    <!-- Catégorie -->                                                    
                                                    <?php foreach($t->_vars['toCategorieActs3'] as $t->_vars['oCategorieActs']):?>
                                                    <div id="cat-<?php echo $t->_vars['oCategorieActs']->categorieAct_id; ?>-top-box" class="cat_retract">
                                                        <div class="cat_box">
                                                            <h4><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id));?>"><?php echo $t->_vars['oCategorieActs']->categorieAct_libelle; ?></a> <span class="num">(<?php echo $t->_vars['toCategorieActNBs'][$t->_vars['oCategorieActs']->categorieAct_id]; ?>)</span></h4>
                                                            <span id="cat-<?php echo $t->_vars['oCategorieActs']->categorieAct_id; ?>" class="cat_box_action_bt">Ouvert</span>
                                                            <div class="clearer"></div>                                                                                                            
                                                            <?php if($t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['id']):?>
                                                                <a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id, 'acid'=>$t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['id']));?>">
                                                                    <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/actualite/images/front/<?php echo $t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                                </a>
                                                                <p><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteDetail', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id, 'acid'=>$t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['id']));?>"><?php echo $t->_vars['toCategorieActRandoms'][$t->_vars['oCategorieActs']->categorieAct_id]['titre']; ?></a></p>
                                                            <?php endif;?>	                                                    
                                                            
                                                        </div>
                                                        <div class="cat_box_foot"></div>                                                
        
                                                        <div id="cat-<?php echo $t->_vars['oCategorieActs']->categorieAct_id; ?>-bottom-box" class="cat_supp">
                                                            <?php $t->_vars['i'] = 0;?>
                                                            <?php foreach($t->_vars['toActualites'] as $t->_vars['oActualites']):?>
                                                                <?php if($t->_vars['oActualites']->actualite_categorieActId == $t->_vars['oCategorieActs']->categorieAct_id):?>
	                                                                <ul><li>
    	                                                            <img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/arrowAct_black.gif" style="float:left;"/>
																	<a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=>$t->_vars['oActualites']->actualite_categorieActId,'acid'=>$t->_vars['oActualites']->actualite_id));?>"><?php echo $t->_vars['oActualites']->actualite_titre; ?></a> <span class="num"></span>
                                                                    </li></ul>
                                                                <?php endif;?>                                                                    
                                                            <?php endforeach;?>
                                                            </ul>
                                                            <ul class="allCateg">
                                                                <li><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteResultList', array('cid'=>$t->_vars['oCategorieActs']->categorieAct_id));?>">Toutes les cat&eacute;gories</a></li>
                                                            </ul>
                                                        </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                    <?php endforeach;?>
                                                </div><!-- col1 end -->
                                                

                                            </div>
                                            <div class="box_foot"></div>
                                        </div>
                                    </div>                                     
                                    <?php 
}
?>