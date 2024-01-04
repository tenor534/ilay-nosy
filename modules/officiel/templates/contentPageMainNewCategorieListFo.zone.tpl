									<div class="viewResult">
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
                                        
                                        <form id="officielForm" name="officielForm" action="#">
                                            <div class="officielContent">
                                                <!--p class="officielTitre">Recherche</p-->
                                                
                                                <div id="search_standard" class="officielCriteriaLineLeft">
                                                    <div class="officielCriteria">
                                                        <label for="forum_mot">Mot cl&eacute;: </label><br>
                                                        <input style="width:398px;" class="user_input2 input_middle" type="text" id="mot" name="mot" value="" >
                                                    </div>
                                                    <div class="officielCriteria">
                                                        <label for="forum_type">Cat&eacute;gories : </label><br>
                                                        <select style="width:400px;height:107px;" class="user_input_select1 input_middle" size="10" id="cid" name="cid">
                                                            {foreach $toCategorieOffs as $oCategories}
                                                                <option value="{$oCategories->categorieOff_id}">{$oCategories->categorieOff_libelle}</option>
                                                            {/foreach}
                                                        </select>                                           
                                                    </div>                                            
                                                </div>
                                                
                                                <div id="search_standard" class="officielCriteriaLineRight">
                                                    <div class="officielCriteria">
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
                                                    <div class="officielCriteria">                                                        
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

												{*}Première colonne{*}
                                                <div class="col3">
                                                    <!-- Catégorie -->                                                    
                                                    {foreach $toCategorieOffs1 as $oCategorieOffs}
                                                    <div id="cat-{$oCategorieOffs->categorieOff_id}-top-box" class="cat_retract">
                                                        <div class="cat_box">
                                                            <h4><a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=>$oCategorieOffs->categorieOff_id)}">{$oCategorieOffs->categorieOff_libelle}</a> <span class="num">({$toCategorieOffNBs[$oCategorieOffs->categorieOff_id]})</span></h4>
                                                            <span id="cat-{$oCategorieOffs->categorieOff_id}" class="cat_box_action_bt">Ouvert</span>
                                                            <div class="clearer"></div>                                                                                                            
                                                            {if $toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['id']}
                                                                <a href="{jurl 'officiel~officielFo_officielDetail', array('cid'=>$oCategorieOffs->categorieOff_id, 'acid'=>$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['id'])}">
                                                                    <span style="float: left; background-image: url({$j_basepath}resize/officiel/images/front/{$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                                </a>
                                                                <p><a href="{jurl 'officiel~officielFo_officielDetail', array('cid'=>$oCategorieOffs->categorieOff_id, 'acid'=>$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['id'])}">{$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['titre']}</a></p>
                                                            {/if}	                                                    
                                                            
                                                        </div>
                                                        <div class="cat_box_foot"></div>                                                
        
                                                        <div id="cat-{$oCategorieOffs->categorieOff_id}-bottom-box" class="cat_supp">
                                                            {assign $i = 0}
                                                            {foreach $toOfficiels as $oOfficiels}
                                                                {if $oOfficiels->officiel_categorieOffId == $oCategorieOffs->categorieOff_id}
	                                                                <ul><li>
    	                                                            <img src="{$j_basepath}design/front/images/v5/arrowAct_black.gif" style="float:left;"/>
																	<a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=>$oOfficiels->officiel_categorieOffId,'acid'=>$oOfficiels->officiel_id)}">{$oOfficiels->officiel_titre}</a> <span class="num"></span>
                                                                    </li></ul>
                                                                {/if}                                                                    
                                                            {/foreach}
                                                            </ul>
                                                            <ul class="allCateg">
                                                                <li><a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=>$oCategorieOffs->categorieOff_id)}">Toutes les cat&eacute;gories</a></li>
                                                            </ul>
                                                        </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                    {/foreach}
                                                </div><!-- col1 end -->
                                                
												{*}2ème colonne{*}
                                                <div class="col3">
                                                    <!-- Catégorie -->                                                    
                                                    {foreach $toCategorieOffs2 as $oCategorieOffs}
                                                    <div id="cat-{$oCategorieOffs->categorieOff_id}-top-box" class="cat_retract">
                                                        <div class="cat_box">
                                                            <h4><a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=>$oCategorieOffs->categorieOff_id)}">{$oCategorieOffs->categorieOff_libelle}</a> <span class="num">({$toCategorieOffNBs[$oCategorieOffs->categorieOff_id]})</span></h4>
                                                            <span id="cat-{$oCategorieOffs->categorieOff_id}" class="cat_box_action_bt">Ouvert</span>
                                                            <div class="clearer"></div>                                                                                                            
                                                            {if $toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['id']}
                                                                <a href="{jurl 'officiel~officielFo_officielDetail', array('cid'=>$oCategorieOffs->categorieOff_id, 'acid'=>$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['id'])}">
                                                                    <span style="float: left; background-image: url({$j_basepath}resize/officiel/images/front/{$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                                </a>
                                                                <p><a href="{jurl 'officiel~officielFo_officielDetail', array('cid'=>$oCategorieOffs->categorieOff_id, 'acid'=>$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['id'])}">{$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['titre']}</a></p>
                                                            {/if}	                                                    
                                                            
                                                        </div>
                                                        <div class="cat_box_foot"></div>                                                
        
                                                        <div id="cat-{$oCategorieOffs->categorieOff_id}-bottom-box" class="cat_supp">
                                                            {assign $i = 0}
                                                            {foreach $toOfficiels as $oOfficiels}
                                                                {if $oOfficiels->officiel_categorieOffId == $oCategorieOffs->categorieOff_id}
	                                                                <ul><li>
    	                                                            <img src="{$j_basepath}design/front/images/v5/arrowAct_black.gif" style="float:left;"/>
																	<a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=>$oOfficiels->officiel_categorieOffId,'acid'=>$oOfficiels->officiel_id)}">{$oOfficiels->officiel_titre}</a> <span class="num"></span>
                                                                    </li></ul>
                                                                {/if}                                                                    
                                                            {/foreach}
                                                            </ul>
                                                            <ul class="allCateg">
                                                                <li><a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=>$oCategorieOffs->categorieOff_id)}">Toutes les cat&eacute;gories</a></li>
                                                            </ul>
                                                        </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                    {/foreach}
                                                </div><!-- col1 end -->
                                                
												{*}3ème colonne{*}
                                                <div class="col3">
                                                    <!-- Catégorie -->                                                    
                                                    {foreach $toCategorieOffs3 as $oCategorieOffs}
                                                    <div id="cat-{$oCategorieOffs->categorieOff_id}-top-box" class="cat_retract">
                                                        <div class="cat_box">
                                                            <h4><a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=>$oCategorieOffs->categorieOff_id)}">{$oCategorieOffs->categorieOff_libelle}</a> <span class="num">({$toCategorieOffNBs[$oCategorieOffs->categorieOff_id]})</span></h4>
                                                            <span id="cat-{$oCategorieOffs->categorieOff_id}" class="cat_box_action_bt">Ouvert</span>
                                                            <div class="clearer"></div>                                                                                                            
                                                            {if $toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['id']}
                                                                <a href="{jurl 'officiel~officielFo_officielDetail', array('cid'=>$oCategorieOffs->categorieOff_id, 'acid'=>$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['id'])}">
                                                                    <span style="float: left; background-image: url({$j_basepath}resize/officiel/images/front/{$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                                </a>
                                                                <p><a href="{jurl 'officiel~officielFo_officielDetail', array('cid'=>$oCategorieOffs->categorieOff_id, 'acid'=>$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['id'])}">{$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]['titre']}</a></p>
                                                            {/if}	                                                    
                                                            
                                                        </div>
                                                        <div class="cat_box_foot"></div>                                                
        
                                                        <div id="cat-{$oCategorieOffs->categorieOff_id}-bottom-box" class="cat_supp">
                                                            {assign $i = 0}
                                                            {foreach $toOfficiels as $oOfficiels}
                                                                {if $oOfficiels->officiel_categorieOffId == $oCategorieOffs->categorieOff_id}
	                                                                <ul><li>
    	                                                            <img src="{$j_basepath}design/front/images/v5/arrowAct_black.gif" style="float:left;"/>
																	<a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=>$oOfficiels->officiel_categorieOffId,'acid'=>$oOfficiels->officiel_id)}">{$oOfficiels->officiel_titre}</a> <span class="num"></span>
                                                                    </li></ul>
                                                                {/if}                                                                    
                                                            {/foreach}
                                                            </ul>
                                                            <ul class="allCateg">
                                                                <li><a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=>$oCategorieOffs->categorieOff_id)}">Toutes les cat&eacute;gories</a></li>
                                                            </ul>
                                                        </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                    {/foreach}
                                                </div><!-- col1 end -->
                                                

                                            </div>
                                            <div class="box_foot"></div>
                                        </div>
                                    </div>                                     
                                    