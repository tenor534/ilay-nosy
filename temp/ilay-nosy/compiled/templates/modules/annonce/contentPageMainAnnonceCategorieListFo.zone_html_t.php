<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_3905aa0798eea9c1d8935311ee3f2cff($t){

return $t->_meta;
}
function template_3905aa0798eea9c1d8935311ee3f2cff($t){
?>									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Les cat&eacute;gories d'annonce</span> 
                                      	</p>          
                                        <p style="clear: both;">
                                            <span class="viewTexte">Pour rechercher des annonces, utilisez le formulaire ci-dessous ou cliquez directement sur une rubrique.</span> 
                                        </p>
									</div>
                                    
                                    
                                    <div class="ajaxZone">
									<div style="clear:both; height:5px;">&nbsp;</div>	
    
									<div id="viewCriteria">
                                    	<div class="headPan">
                                        	<span class="viewTitre">Rechercher une annonce sur Ilay NOSY</span> 
                                        </div> 
                                    	<div class="middlePan">
	                                        <div class="blank">
		                                        <div class="content">
                                        
                                        <form id="annonceForm" name="annonceForm" action="#">
                                            <div class="annonceContent">                                        
                                                <!--p class="annonceTitre">Recherche</p-->
                                                
                                                <div id="search_standard" class="annonceCriteriaLineLeft">
                                                    <div class="annonceCriteria">
                                                        <label for="forum_mot">Mot : </label><br>
                                                        <input style="width:398px;" class="user_input2 input_middle" type="text" id="mot" name="mot" value="" >
                                                    </div>                                            
                                                    <div class="annonceCriteria">
                                                        <label for="forum_type">Cat&eacute;gories : </label><br>
                                                        <select style="width:400px;height:107px;" class="user_input_select1 input_middle" size="10" id="crid" name="crid">
                                                            <?php foreach($t->_vars['toCategories'] as $t->_vars['oCategories']):?>
                                                                <?php $t->_vars['ident'] = "";?>
                                                                <?php if($t->_vars['oCategories']->level == 1):?>
                                                                    <?php $t->_vars['ident'] = "&nbsp;&nbsp;&nbsp;&nbsp;" ;?>
                                                                <?php elseif($t->_vars['oCategories']->level == 2):?>
                                                                    <?php $t->_vars['ident'] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;" ;?>                                                                
                                                                <?php endif;?>
                                                                <option value="<?php echo $t->_vars['oCategories']->id; ?>"><?php echo $t->_vars['ident'];  echo $t->_vars['oCategories']->libelle; ?></option>
                                                            <?php endforeach;?>
                                                        </select>                                           
                                                    </div>                                            
                                                </div>
                                                
                                                <div id="search_standard" class="annonceCriteriaLineRight">
                                                    <div class="annonceCriteria">
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
                                                    <div class="annonceCriteria">
                                                        <label for="forum_target">Lieu : </label><br>
                                                        <select class="user_input4 user_input_select input_middle" name="province" id="province"  tmt:invalidvalue="0" tmt:required="true">			
                                                            <option value="0">Province:</option>
                                                            <?php foreach($t->_vars['toProvinces'] as $t->_vars['oProvinces']):?>
                                                                <option value="<?php echo $t->_vars['oProvinces']->province_id; ?>"><?php echo $t->_vars['oProvinces']->province_libelle; ?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>                                            
                                                    <div class="annonceCriteria">
                                                        <label for="forum_distance">Localit&eacute; : </label><br>
                                                        <select style="width:220px;" class="user_input4 user_input_select input_middle" name="localite" id="localite">			
                                                            <option value="0">Localit&eacute;:</option>
                                                        </select>
                                                    </div>        
                                                    <div class="annonceCriteria">                                                        
                                                        <label for="forum_tri">Affichage : </label><br>
                                                        <select class="user_input4 user_input_select input_middle" id="affichage" name="affichage">
                                                            <option value="0">Affichage en :</option>
                                                            <option value="1">Detail</option>
                                                            <option value="2">Abr&eacute;g&eacute;</option>
                                                            <option value="3">Photo</option>
                                                        </select>
                                                    </div>                                            
                                                </div>
                                                <div style="clear:both;" id="search_standard">
                                                    <label for="forum_mot">Prix : </label><br>
                                                    <input style="width:150px;text-align:right;" class="user_input2 input_middle" type="text" id="prix1" name="prix1" value="" >
                                                    &nbsp;&agrave;&nbsp;
                                                    <input style="width:150px;text-align:right;" class="user_input2 input_middle" type="text" id="prix2" name="prix2" value="" tmt:greaterthan="prix1" >
                                                    &nbsp;Ar
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
									<div style="clear:both; height:5px;">&nbsp;</div>	
                            
                                        <h3>Consulter les cat&eacute;gories d'annonces</h3>                            
                            
                                        <div class="box" id="box_cat">
                                            <div class="box_inner">

                                                <div class="col3">
                                                
                                                <!-- Véhicules -->
                                                <div id="cat-vehicules-top-box" class="cat_retract">
                                                <div class="cat_box">
                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>1));?>">V&eacute;hicules</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][1]; ?>)</span></h4>
                                                    <span id="cat-vehicules" class="cat_box_action_bt">Ouvert</span>
                                                    <div class="clearer"></div>
                                                                                                    
                                                	<?php if($t->_vars['toCategorieAnRandoms'][1]['id']):?>
                                                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>1, 'anid'=>$t->_vars['toCategorieAnRandoms'][1]['id']));?>">
                                                            <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][1]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>1, 'anid'=>$t->_vars['toCategorieAnRandoms'][1]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][1]['titre']; ?></a></p>
													<?php endif;?>	                                                    
                                                    
                                                </div>
                                                <div class="cat_box_foot"></div>
                                                
                                                <div id="cat-vehicules-bottom-box" class="cat_supp">
                                                    <?php $t->_vars['i'] = 0;?>
                                                    <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                        
                                                        <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 1):?>
                                                            <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                <?php if($t->_vars['i'] == 0):?>
                                                                    <ul>
                                                                <?php else:?>    
                                                                    </ul>
                                                                    <ul>
                                                                <?php endif;?>
                                                                <li><h5><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></h5></li>
                                                             <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>                                                         
                                                                <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                             <?php endif;?>
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endif;?>
                                                            
                                                    <?php endforeach;?>
                                                    </ul>
                                                    <ul>
                                                        <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>1));?>">Toutes les rubriques</a></li>
                                                    </ul>
                                                </div><!-- cat_sup -->
                                                </div><!-- cat_retract -->
                                                
                                                        <!-- Emplois -->
                                                <div id="cat-emploi-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                
                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>2));?>">Emplois</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][2]; ?>)</span></h4>
                                                    <span id="cat-emploi" class="cat_box_action_bt">Ouvert</span>
                                                    <div class="clearer"></div>
                                                                                                    
                                                	<?php if($t->_vars['toCategorieAnRandoms'][2]['id']):?>
                                                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>2, 'anid'=>$t->_vars['toCategorieAnRandoms'][2]['id']));?>">
                                                            <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][2]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>2, 'anid'=>$t->_vars['toCategorieAnRandoms'][2]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][2]['titre']; ?></a></p>
													<?php endif;?>	                                                    
                                                    
                                                    </div>
                                                
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-emploi-bottom-box" class="cat_supp">
                                                        <?php $t->_vars['i'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 2):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                    <?php if($t->_vars['i'] == 0):?>
                                                                        <ul>
                                                                    <?php else:?>    
                                                                        </ul>
                                                                        <ul>
                                                                    <?php endif;?>
                                                                    <li><h5><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></h5></li>
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                                <?php $t->_vars['i']++;?>
                                                            <?php endif;?>                                                                
                                                        <?php endforeach;?>
                                                        </ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>2));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                </div><!-- cat_retract -->
                                                
                                                
                                                                        <!-- Électronique -->
                                                <div id="cat-electronique-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>3));?>">Electronique</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][3]; ?>)</span></h4>
                                                
                                                    <span id="cat-electronique" class="cat_box_action_bt">Ouvert</span>
                                                    <div class="clearer"></div>
                                                                                                    
                                                	<?php if($t->_vars['toCategorieAnRandoms'][3]['id']):?>
                                                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>3, 'anid'=>$t->_vars['toCategorieAnRandoms'][3]['id']));?>">
                                                            <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][3]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>3, 'anid'=>$t->_vars['toCategorieAnRandoms'][3]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][3]['titre']; ?></a></p>
													<?php endif;?>	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-electronique-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 3):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>3));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                </div><!-- cat_retract -->
                                                
                                                                        <!-- Informatique -->
                                                
                                                <div id="cat-informatique-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>4));?>">Informatique</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][4]; ?>)</span></h4>
                                                    <span id="cat-informatique" class="cat_box_action_bt">Ouvert</span>
                                                    <div class="clearer"></div>
                                                                                                    
                                                	<?php if($t->_vars['toCategorieAnRandoms'][4]['id']):?>
                                                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>4, 'anid'=>$t->_vars['toCategorieAnRandoms'][4]['id']));?>">
                                                            <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][4]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>4, 'anid'=>$t->_vars['toCategorieAnRandoms'][4]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][4]['titre']; ?></a></p>
													<?php endif;?>	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-informatique-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 4):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>4));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                </div><!-- cat_retract -->
                                                
                                                                        <!-- Rencontres -->
                                                
                                                <div id="cat-rencontres-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>5));?>">Rencontres</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][5]; ?>)</span></h4>
                                                    <span id="cat-rencontres" class="cat_box_action_bt">Ouvert</span>
                                                    <div class="clearer"></div>
                                                                                                    
                                                	<?php if($t->_vars['toCategorieAnRandoms'][5]['id']):?>
                                                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>5, 'anid'=>$t->_vars['toCategorieAnRandoms'][5]['id']));?>">
                                                            <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][5]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>5, 'anid'=>$t->_vars['toCategorieAnRandoms'][5]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][5]['titre']; ?></a></p>
													<?php endif;?>	                                                    
                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-rencontres-bottom-box" class="cat_supp">
                                                        <?php $t->_vars['i'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 5):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                    <?php if($t->_vars['i'] == 0):?>
                                                                        <ul>
                                                                    <?php else:?>    
                                                                        </ul>
                                                                        <ul>
                                                                    <?php endif;?>
                                                                    <li><h5><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></h5></li>
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>                                                         
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                                <?php $t->_vars['i']++;?>
                                                            <?php endif;?>
                                                                
                                                        <?php endforeach;?>
                                                        </ul>
                                                        <ul>                                                        
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>5));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                </div><!-- cat_retract -->
                                                
													<!-- formation -->                                                
                                                    <div id="cat-formation-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>17));?>">Formations</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][17]; ?>)</span></h4>
                                                        <span id="cat-formation" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][17]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>17, 'anid'=>$t->_vars['toCategorieAnRandoms'][17]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][17]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>17, 'anid'=>$t->_vars['toCategorieAnRandoms'][17]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][17]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-formation-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 17):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>17));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                </div><!-- col1 end -->
                                            
                                                                <!-- second col -->
                                                <div class="col3">
                                                
                                                    <!-- Immobilier -->
                                                    <div id="cat-immobilier-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>6));?>">Immobilier</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][6]; ?>)</span></h4>
                                                        <span id="cat-immobilier" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                	<?php if($t->_vars['toCategorieAnRandoms'][6]['id']):?>
                                                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>6, 'anid'=>$t->_vars['toCategorieAnRandoms'][6]['id']));?>">
                                                            <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][6]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>6, 'anid'=>$t->_vars['toCategorieAnRandoms'][6]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][6]['titre']; ?></a></p>
													<?php endif;?>	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-immobilier-bottom-box" class="cat_supp">
                                                        <?php $t->_vars['i'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 6):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                    <?php if($t->_vars['i'] == 0):?>
                                                                        <ul>
                                                                    <?php else:?>    
                                                                        </ul>
                                                                        <ul>
                                                                    <?php endif;?>
                                                                    <li><h5><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></h5></li>
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                                <?php $t->_vars['i']++;?>
                                                            <?php endif;?>                                                                
                                                        <?php endforeach;?>
                                                        </ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>6));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                                        <!-- Voyages -->
                                                    <div id="cat-equipements-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>12));?>">Equipements</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][12]; ?>)</span></h4>
                                                        <span id="cat-equipements" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][12]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>12, 'anid'=>$t->_vars['toCategorieAnRandoms'][12]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][12]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>12, 'anid'=>$t->_vars['toCategorieAnRandoms'][12]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][12]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                        
                                                    </div>
                                                
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-equipements-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 12):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>12));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                                        <!-- Voyages -->
                                                    <div id="cat-vacances-voyages-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>7));?>">Vacances/Voyages</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][7]; ?>)</span></h4>
                                                        <span id="cat-vacances-voyages" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][7]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>7, 'anid'=>$t->_vars['toCategorieAnRandoms'][7]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][7]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>7, 'anid'=>$t->_vars['toCategorieAnRandoms'][7]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][7]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                    
                                                    </div>
                                                
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-vacances-voyages-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 7):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>                                                                 
                                                                 <?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_categorieAnId != 7):?>                                                                 
                                                                        </ul>
			                                                        	</li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>7));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                                        <!-- Famille -->
                                                
                                                    <div id="cat-famille-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>8));?>">Famille</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][8]; ?>)</span></h4>
                                                        <span id="cat-famille" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][8]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>8, 'anid'=>$t->_vars['toCategorieAnRandoms'][8]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][8]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>8, 'anid'=>$t->_vars['toCategorieAnRandoms'][8]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][8]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                        
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-famille-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 8):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>8));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                                        <!-- Sports -->
                                                    <div id="cat-sports-loisirs-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>9));?>">Sports/Loisirs</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][9]; ?>)</span></h4>
                                                        <span id="cat-sports-loisirs" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][9]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>9, 'anid'=>$t->_vars['toCategorieAnRandoms'][9]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][9]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>9, 'anid'=>$t->_vars['toCategorieAnRandoms'][9]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][9]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                        
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-sports-loisirs-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 9):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                                 <?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_categorieAnId != 9):?>                                                                 
                                                                    </ul>
                                                                    </li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>9));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
													<!-- Beauté et bien être -->                                                
                                                    <div id="cat-beaute-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>18));?>">Beaut&eacute; et bien &ecirc;tre</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][18]; ?>)</span></h4>
                                                        <span id="cat-beaute" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][18]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>18, 'anid'=>$t->_vars['toCategorieAnRandoms'][18]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][18]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>18, 'anid'=>$t->_vars['toCategorieAnRandoms'][18]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][18]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                        
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-beaute-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 18):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                                 <?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_categorieAnId != 18):?>                                                                 
                                                                    </ul>
                                                                    </li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>18));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                </div><!-- col3 end -->
                                            
                                                                <!-- third col -->
                                                <div class="col3">
                                                
                                                    <!-- Ameublement -->
                                                    <div id="cat-ameublement-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>10));?>">Ameublement</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][10]; ?>)</span></h4>
                                                        <span id="cat-ameublement" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][10]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>10, 'anid'=>$t->_vars['toCategorieAnRandoms'][10]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][10]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>10, 'anid'=>$t->_vars['toCategorieAnRandoms'][10]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][10]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                    
                                                    </div>
                                                
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-ameublement-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 10):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>10));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                
                                                    </div><!-- cat_retract -->
                                                
                                                
                                                                        <!-- Outils -->
                                                    <div id="cat-outils-materiaux-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>11));?>">Outils/Mat&eacute;riaux</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][11]; ?>)</span></h4>
                                                        <span id="cat-outils-materiaux" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][11]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>11, 'anid'=>$t->_vars['toCategorieAnRandoms'][11]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][11]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>11, 'anid'=>$t->_vars['toCategorieAnRandoms'][11]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][11]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-outils-materiaux-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 11):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>11));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
													<!-- Affaires -->                                                
                                                    <div id="cat-affaire-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>16));?>">Affaires</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][16]; ?>)</span></h4>
                                                        <span id="cat-affaire" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][16]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>16, 'anid'=>$t->_vars['toCategorieAnRandoms'][16]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][16]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>16, 'anid'=>$t->_vars['toCategorieAnRandoms'][16]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][16]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-affaire-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 16):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>16));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->

                                                                        <!-- Animaux -->
                                                    <div id="cat-animaux-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="13">Animaux</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][13]; ?>)</span></h4>
                                                        <span id="cat-animaux" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][13]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>13, 'anid'=>$t->_vars['toCategorieAnRandoms'][13]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][13]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>13, 'anid'=>$t->_vars['toCategorieAnRandoms'][13]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][13]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-animaux-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 13):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                                 <?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_categorieAnId != 13):?>                                                                 
                                                                    </ul>
                                                                    </li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>13));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                                        <!-- Service -->
                                                    <div id="cat-service-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>14));?>">Service</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][14]; ?>)</span></h4>
                                                        <span id="cat-service" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][14]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>14, 'anid'=>$t->_vars['toCategorieAnRandoms'][14]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][14]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>14, 'anid'=>$t->_vars['toCategorieAnRandoms'][14]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][14]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-service-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 14):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>14));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                    <div id="cat-communautaire-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>15));?>">Communautaire</a> <span class="num">(<?php echo $t->_vars['toCategorieAnNBs'][15]; ?>)</span></h4>
                                                        <span id="cat-communautaire" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        <?php if($t->_vars['toCategorieAnRandoms'][15]['id']):?>
                                                            <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>15, 'anid'=>$t->_vars['toCategorieAnRandoms'][15]['id']));?>">
                                                                <span style="float: left; background-image: url(<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/front/<?php echo $t->_vars['toCategorieAnRandoms'][15]['photo']; ?>); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceDetail', array('cid'=>15, 'anid'=>$t->_vars['toCategorieAnRandoms'][15]['id']));?>"><?php echo $t->_vars['toCategorieAnRandoms'][15]['titre']; ?></a></p>
                                                        <?php endif;?>	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-communautaire-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        <?php $t->_vars['i'] 	 = 0;?>
                                                        <?php $t->_vars['in2'] = 0;?>
                                                        <?php foreach($t->_vars['toRubriques'] as $t->_vars['oRubriques']):?>
                                                            
                                                            <?php if($t->_vars['oRubriques']->rubrique_categorieAnId == 15):?>
                                                                <?php if($t->_vars['oRubriques']->rubrique_level == 1):?>
                                                                	<?php if($t->_vars['in2'] == 1):?>
	                                                                    <?php $t->_vars['in2'] = 0;?>
                                                                        </ul>
			                                                        	</li>
                                                                    <?php else:?>
                                                                    
                                                                    <?php endif;?>
                                                                	<?php if($t->_vars['toRubriques'][$t->_vars['i']+1]->rubrique_level == 1):?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                    <?php else:?>
	                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span>
                                                                        <ul>
                                                                        <?php $t->_vars['in2'] = 1;?>
                                                                    <?php endif;?>                                                                    
                                                                 <?php elseif($t->_vars['oRubriques']->rubrique_level == 2):?>
                                                                    <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('rid'=>$t->_vars['oRubriques']->rubrique_id));?>"><?php echo $t->_vars['oRubriques']->rubrique_libelle; ?></a> <span class="num">(<?php echo $t->_vars['oRubriques']->rubrique_nbAnnonce; ?>)</span></li>
                                                                 <?php endif;?>
                                                            <?php endif;?>                                                                
                                                            <?php $t->_vars['i']++;?>
                                                        <?php endforeach;?>
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList', array('cid'=>15));?>">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                </div><!-- col3 end -->
                                            </div>
                                            <div class="box_foot"></div>
                                        </div>
                                    </div>                                     
                                    <?php 
}
?>