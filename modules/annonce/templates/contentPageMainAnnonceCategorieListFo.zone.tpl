									<div class="viewResult">
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
                                                            {foreach $toCategories as $oCategories}
                                                                {assign $ident = ""}
                                                                {if $oCategories->level == 1}
                                                                    {assign $ident = "&nbsp;&nbsp;&nbsp;&nbsp;" }
                                                                {elseif $oCategories->level == 2}
                                                                    {assign $ident = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;" }                                                                
                                                                {/if}
                                                                <option value="{$oCategories->id}">{$ident}{$oCategories->libelle}</option>
                                                            {/foreach}
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
                                                            {foreach $toProvinces as $oProvinces}
                                                                <option value="{$oProvinces->province_id}">{$oProvinces->province_libelle}</option>
                                                            {/foreach}
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
                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>1)}">V&eacute;hicules</a> <span class="num">({$toCategorieAnNBs[1]})</span></h4>
                                                    <span id="cat-vehicules" class="cat_box_action_bt">Ouvert</span>
                                                    <div class="clearer"></div>
                                                                                                    
                                                	{if $toCategorieAnRandoms[1]['id']}
                                                        <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>1, 'anid'=>$toCategorieAnRandoms[1]['id'])}">
                                                            <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[1]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>1, 'anid'=>$toCategorieAnRandoms[1]['id'])}">{$toCategorieAnRandoms[1]['titre']}</a></p>
													{/if}	                                                    
                                                    
                                                </div>
                                                <div class="cat_box_foot"></div>
                                                
                                                <div id="cat-vehicules-bottom-box" class="cat_supp">
                                                    {assign $i = 0}
                                                    {foreach $toRubriques as $oRubriques}
                                                        {*}Véhicules{*}
                                                        {if $oRubriques->rubrique_categorieAnId == 1}
                                                            {if $oRubriques->rubrique_level == 1}
                                                                {if $i == 0}
                                                                    <ul>
                                                                {else}    
                                                                    </ul>
                                                                    <ul>
                                                                {/if}
                                                                <li><h5>{$oRubriques->rubrique_libelle}</h5></li>
                                                             {elseif  $oRubriques->rubrique_level == 2}                                                         
                                                                <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                             {/if}
                                                            {assign $i++}
                                                        {/if}
                                                            
                                                    {/foreach}
                                                    </ul>
                                                    <ul>
                                                        <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>1)}">Toutes les rubriques</a></li>
                                                    </ul>
                                                </div><!-- cat_sup -->
                                                </div><!-- cat_retract -->
                                                
                                                        <!-- Emplois -->
                                                <div id="cat-emploi-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                
                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>2)}">Emplois</a> <span class="num">({$toCategorieAnNBs[2]})</span></h4>
                                                    <span id="cat-emploi" class="cat_box_action_bt">Ouvert</span>
                                                    <div class="clearer"></div>
                                                                                                    
                                                	{if $toCategorieAnRandoms[2]['id']}
                                                        <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>2, 'anid'=>$toCategorieAnRandoms[2]['id'])}">
                                                            <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[2]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>2, 'anid'=>$toCategorieAnRandoms[2]['id'])}">{$toCategorieAnRandoms[2]['titre']}</a></p>
													{/if}	                                                    
                                                    
                                                    </div>
                                                
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-emploi-bottom-box" class="cat_supp">
                                                        {assign $i = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Emploi{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 2}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                    {if $i == 0}
                                                                        <ul>
                                                                    {else}    
                                                                        </ul>
                                                                        <ul>
                                                                    {/if}
                                                                    <li><h5>{$oRubriques->rubrique_libelle}</h5></li>
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                                {assign $i++}
                                                            {/if}                                                                
                                                        {/foreach}
                                                        </ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>2)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                </div><!-- cat_retract -->
                                                
                                                
                                                                        <!-- Électronique -->
                                                <div id="cat-electronique-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>3)}">Electronique</a> <span class="num">({$toCategorieAnNBs[3]})</span></h4>
                                                
                                                    <span id="cat-electronique" class="cat_box_action_bt">Ouvert</span>
                                                    <div class="clearer"></div>
                                                                                                    
                                                	{if $toCategorieAnRandoms[3]['id']}
                                                        <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>3, 'anid'=>$toCategorieAnRandoms[3]['id'])}">
                                                            <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[3]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>3, 'anid'=>$toCategorieAnRandoms[3]['id'])}">{$toCategorieAnRandoms[3]['titre']}</a></p>
													{/if}	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-electronique-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Electronique{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 3}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>3)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                </div><!-- cat_retract -->
                                                
                                                                        <!-- Informatique -->
                                                
                                                <div id="cat-informatique-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>4)}">Informatique</a> <span class="num">({$toCategorieAnNBs[4]})</span></h4>
                                                    <span id="cat-informatique" class="cat_box_action_bt">Ouvert</span>
                                                    <div class="clearer"></div>
                                                                                                    
                                                	{if $toCategorieAnRandoms[4]['id']}
                                                        <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>4, 'anid'=>$toCategorieAnRandoms[4]['id'])}">
                                                            <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[4]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>4, 'anid'=>$toCategorieAnRandoms[4]['id'])}">{$toCategorieAnRandoms[4]['titre']}</a></p>
													{/if}	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-informatique-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Informatique{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 4}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>4)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                </div><!-- cat_retract -->
                                                
                                                                        <!-- Rencontres -->
                                                
                                                <div id="cat-rencontres-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>5)}">Rencontres</a> <span class="num">({$toCategorieAnNBs[5]})</span></h4>
                                                    <span id="cat-rencontres" class="cat_box_action_bt">Ouvert</span>
                                                    <div class="clearer"></div>
                                                                                                    
                                                	{if $toCategorieAnRandoms[5]['id']}
                                                        <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>5, 'anid'=>$toCategorieAnRandoms[5]['id'])}">
                                                            <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[5]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>5, 'anid'=>$toCategorieAnRandoms[5]['id'])}">{$toCategorieAnRandoms[5]['titre']}</a></p>
													{/if}	                                                    
                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-rencontres-bottom-box" class="cat_supp">
                                                        {assign $i = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Véhicules{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 5}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                    {if $i == 0}
                                                                        <ul>
                                                                    {else}    
                                                                        </ul>
                                                                        <ul>
                                                                    {/if}
                                                                    <li><h5>{$oRubriques->rubrique_libelle}</h5></li>
                                                                 {elseif  $oRubriques->rubrique_level == 2}                                                         
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                                {assign $i++}
                                                            {/if}
                                                                
                                                        {/foreach}
                                                        </ul>
                                                        <ul>                                                        
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>5)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                </div><!-- cat_retract -->
                                                
													<!-- formation -->                                                
                                                    <div id="cat-formation-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>17)}">Formations</a> <span class="num">({$toCategorieAnNBs[17]})</span></h4>
                                                        <span id="cat-formation" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[17]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>17, 'anid'=>$toCategorieAnRandoms[17]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[17]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>17, 'anid'=>$toCategorieAnRandoms[17]['id'])}">{$toCategorieAnRandoms[17]['titre']}</a></p>
                                                        {/if}	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-formation-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Famille/Voyages{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 17}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>17)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                </div><!-- col1 end -->
                                            
                                                                <!-- second col -->
                                                <div class="col3">
                                                
                                                    <!-- Immobilier -->
                                                    <div id="cat-immobilier-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>6)}">Immobilier</a> <span class="num">({$toCategorieAnNBs[6]})</span></h4>
                                                        <span id="cat-immobilier" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                	{if $toCategorieAnRandoms[6]['id']}
                                                        <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>6, 'anid'=>$toCategorieAnRandoms[6]['id'])}">
                                                            <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[6]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                        </a>
                                                        <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>6, 'anid'=>$toCategorieAnRandoms[6]['id'])}">{$toCategorieAnRandoms[6]['titre']}</a></p>
													{/if}	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-immobilier-bottom-box" class="cat_supp">
                                                        {assign $i = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Immobilier{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 6}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                    {if $i == 0}
                                                                        <ul>
                                                                    {else}    
                                                                        </ul>
                                                                        <ul>
                                                                    {/if}
                                                                    <li><h5>{$oRubriques->rubrique_libelle}</h5></li>
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                                {assign $i++}
                                                            {/if}                                                                
                                                        {/foreach}
                                                        </ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>6)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                                        <!-- Voyages -->
                                                    <div id="cat-equipements-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>12)}">Equipements</a> <span class="num">({$toCategorieAnNBs[12]})</span></h4>
                                                        <span id="cat-equipements" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[12]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>12, 'anid'=>$toCategorieAnRandoms[12]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[12]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>12, 'anid'=>$toCategorieAnRandoms[12]['id'])}">{$toCategorieAnRandoms[12]['titre']}</a></p>
                                                        {/if}	                                                    
                                                        
                                                    </div>
                                                
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-equipements-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Vacances/Voyages{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 12}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>12)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                                        <!-- Voyages -->
                                                    <div id="cat-vacances-voyages-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>7)}">Vacances/Voyages</a> <span class="num">({$toCategorieAnNBs[7]})</span></h4>
                                                        <span id="cat-vacances-voyages" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[7]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>7, 'anid'=>$toCategorieAnRandoms[7]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[7]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>7, 'anid'=>$toCategorieAnRandoms[7]['id'])}">{$toCategorieAnRandoms[7]['titre']}</a></p>
                                                        {/if}	                                                    
                                                    
                                                    </div>
                                                
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-vacances-voyages-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Vacances/Voyages{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 7}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}                                                                 
                                                                 {if $toRubriques[$i+1]->rubrique_categorieAnId != 7}                                                                 
                                                                        </ul>
			                                                        	</li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>7)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                                        <!-- Famille -->
                                                
                                                    <div id="cat-famille-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>8)}">Famille</a> <span class="num">({$toCategorieAnNBs[8]})</span></h4>
                                                        <span id="cat-famille" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[8]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>8, 'anid'=>$toCategorieAnRandoms[8]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[8]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>8, 'anid'=>$toCategorieAnRandoms[8]['id'])}">{$toCategorieAnRandoms[8]['titre']}</a></p>
                                                        {/if}	                                                    
                                                        
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-famille-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Famille/Voyages{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 8}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>8)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                                        <!-- Sports -->
                                                    <div id="cat-sports-loisirs-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>9)}">Sports/Loisirs</a> <span class="num">({$toCategorieAnNBs[9]})</span></h4>
                                                        <span id="cat-sports-loisirs" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[9]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>9, 'anid'=>$toCategorieAnRandoms[9]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[9]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>9, 'anid'=>$toCategorieAnRandoms[9]['id'])}">{$toCategorieAnRandoms[9]['titre']}</a></p>
                                                        {/if}	                                                    
                                                        
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-sports-loisirs-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Sports/Loisirs{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 9}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                                 {if $toRubriques[$i+1]->rubrique_categorieAnId != 9}                                                                 
                                                                    </ul>
                                                                    </li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>9)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
													<!-- Beauté et bien être -->                                                
                                                    <div id="cat-beaute-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>18)}">Beaut&eacute; et bien &ecirc;tre</a> <span class="num">({$toCategorieAnNBs[18]})</span></h4>
                                                        <span id="cat-beaute" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[18]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>18, 'anid'=>$toCategorieAnRandoms[18]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[18]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>18, 'anid'=>$toCategorieAnRandoms[18]['id'])}">{$toCategorieAnRandoms[18]['titre']}</a></p>
                                                        {/if}	                                                    
                                                        
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-beaute-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Formation{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 18}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                                 {if $toRubriques[$i+1]->rubrique_categorieAnId != 18}                                                                 
                                                                    </ul>
                                                                    </li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>18)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                </div><!-- col3 end -->
                                            
                                                                <!-- third col -->
                                                <div class="col3">
                                                
                                                    <!-- Ameublement -->
                                                    <div id="cat-ameublement-top-box" class="cat_retract">
                                                    <div class="cat_box">
                                                
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>10)}">Ameublement</a> <span class="num">({$toCategorieAnNBs[10]})</span></h4>
                                                        <span id="cat-ameublement" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[10]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>10, 'anid'=>$toCategorieAnRandoms[10]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[10]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>10, 'anid'=>$toCategorieAnRandoms[10]['id'])}">{$toCategorieAnRandoms[10]['titre']}</a></p>
                                                        {/if}	                                                    
                                                    
                                                    </div>
                                                
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-ameublement-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Ameublement{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 10}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>10)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                
                                                    </div><!-- cat_retract -->
                                                
                                                
                                                                        <!-- Outils -->
                                                    <div id="cat-outils-materiaux-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>11)}">Outils/Mat&eacute;riaux</a> <span class="num">({$toCategorieAnNBs[11]})</span></h4>
                                                        <span id="cat-outils-materiaux" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[11]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>11, 'anid'=>$toCategorieAnRandoms[11]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[11]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>11, 'anid'=>$toCategorieAnRandoms[11]['id'])}">{$toCategorieAnRandoms[11]['titre']}</a></p>
                                                        {/if}	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-outils-materiaux-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Outils/Matériaux{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 11}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>11)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
													<!-- Affaires -->                                                
                                                    <div id="cat-affaire-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>16)}">Affaires</a> <span class="num">({$toCategorieAnNBs[16]})</span></h4>
                                                        <span id="cat-affaire" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[16]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>16, 'anid'=>$toCategorieAnRandoms[16]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[16]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>16, 'anid'=>$toCategorieAnRandoms[16]['id'])}">{$toCategorieAnRandoms[16]['titre']}</a></p>
                                                        {/if}	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-affaire-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Affaires{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 16}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>16)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->

                                                                        <!-- Animaux -->
                                                    <div id="cat-animaux-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="13">Animaux</a> <span class="num">({$toCategorieAnNBs[13]})</span></h4>
                                                        <span id="cat-animaux" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[13]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>13, 'anid'=>$toCategorieAnRandoms[13]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[13]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>13, 'anid'=>$toCategorieAnRandoms[13]['id'])}">{$toCategorieAnRandoms[13]['titre']}</a></p>
                                                        {/if}	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-animaux-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Animaux{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 13}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                                 {if $toRubriques[$i+1]->rubrique_categorieAnId != 13}                                                                 
                                                                    </ul>
                                                                    </li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>13)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                
                                                                        <!-- Service -->
                                                    <div id="cat-service-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>14)}">Service</a> <span class="num">({$toCategorieAnNBs[14]})</span></h4>
                                                        <span id="cat-service" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[14]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>14, 'anid'=>$toCategorieAnRandoms[14]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[14]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>14, 'anid'=>$toCategorieAnRandoms[14]['id'])}">{$toCategorieAnRandoms[14]['titre']}</a></p>
                                                        {/if}	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-service-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Services{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 14}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>14)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                    <div id="cat-communautaire-top-box" class="cat_retract">
                                                    <div class="cat_box">
	                                                    <h4><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>15)}">Communautaire</a> <span class="num">({$toCategorieAnNBs[15]})</span></h4>
                                                        <span id="cat-communautaire" class="cat_box_action_bt">Ouvert</span>
                                                        <div class="clearer"></div>
                                                                                                    
                                                        {if $toCategorieAnRandoms[15]['id']}
                                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>15, 'anid'=>$toCategorieAnRandoms[15]['id'])}">
                                                                <span style="float: left; background-image: url({$j_basepath}resize/annonce/images/front/{$toCategorieAnRandoms[15]['photo']}); background-position: 0px 0px;margin-left:3px;" class="icons"></span>
                                                            </a>
                                                            <p><a href="{jurl 'annonce~annonceFo_annonceDetail', array('cid'=>15, 'anid'=>$toCategorieAnRandoms[15]['id'])}">{$toCategorieAnRandoms[15]['titre']}</a></p>
                                                        {/if}	                                                    
                                                    
                                                    </div>
                                                    <div class="cat_box_foot"></div>
                                                
                                                    <div id="cat-communautaire-bottom-box" class="cat_supp">
                                                    	<ul>
                                                        {assign $i 	 = 0}
                                                        {assign $in2 = 0}
                                                        {foreach $toRubriques as $oRubriques}
                                                            {*}Communautaire{*}
                                                            {if $oRubriques->rubrique_categorieAnId == 15}
                                                                {if $oRubriques->rubrique_level == 1}
                                                                	{if $in2 == 1}
	                                                                    {assign $in2 = 0}
                                                                        </ul>
			                                                        	</li>
                                                                    {else}
                                                                    
                                                                    {/if}
                                                                	{if $toRubriques[$i+1]->rubrique_level == 1}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                    {else}
	                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span>
                                                                        <ul>
                                                                        {assign $in2 = 1}
                                                                    {/if}                                                                    
                                                                 {elseif  $oRubriques->rubrique_level == 2}
                                                                    <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$oRubriques->rubrique_id)}">{$oRubriques->rubrique_libelle}</a> <span class="num">({$oRubriques->rubrique_nbAnnonce})</span></li>
                                                                 {/if}
                                                            {/if}                                                                
                                                            {assign $i++}
                                                        {/foreach}
                                                    	</ul>
                                                        <ul>
                                                            <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>15)}">Toutes les rubriques</a></li>
                                                        </ul>
                                                    </div><!-- cat_sup -->
                                                    </div><!-- cat_retract -->
                                                </div><!-- col3 end -->
                                            </div>
                                            <div class="box_foot"></div>
                                        </div>
                                    </div>                                     
                                    