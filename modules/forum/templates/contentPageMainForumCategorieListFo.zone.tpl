									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Les forums</span> 
                                      	</p>          
                                        <p style="clear: both;">
                                            <span class="viewTexte">Pour rechercher des sujets/th&egrave;mes, utilisez le formulaire ci-dessous ou cliquez directement sur un forum</span> 
                                        </p>
									</div>
                                    
                                    <div class="ajaxZone">
                                        <div style="clear:both; height:5px;">&nbsp;</div>
        
                                        <div id="viewCriteria">
                                            <div class="headPan">
                                                <span class="viewTitre">Rechercher des sujets dans un forum sur Ilay NOSY</span>
                                            </div>
                                            <div class="middlePan">
                                                <div class="blank">
                                                    <div class="content">
                                            
                                                        <form id="forumForm" name="forumForm" action="#">
                                                            <div class="forumContent">
                                                                <!--p class="forumTitre">Recherche</p-->
                                                                
                                                                <div id="search_standard" class="forumCriteriaLineLeft">
                                                                    <div class="forumCriteria">
                                                                        <label for="forum_mot">Mot cl&eacute;: </label><br>
                                                                        <input style="width:398px;" class="user_input2 input_middle" type="text" id="mot" name="mot" value="" tmt:required="true" >
                                                                    </div>
                                                                    <div class="forumCriteria">
                                                                        <label for="forum_type">Forums : </label><br>
                                                                        <select style="width:400px;height:107px;" class="user_input_select1 input_middle" size="10" id="fid" name="fid" tmt:required="true">
                                                                            {foreach $toCategorieFors as $oCategories}
                                                                                <option value="0">{$oCategories->categorieFor_libelle}</option>
	                                                                            {foreach $toForums as $oForums}
    							                                                	{if $oForums->forum_categorieForId == $oCategories->categorieFor_id}
		                                                                                <option value="{$oForums->forum_id}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$oForums->forum_libelle}</option>
                                                                                    {/if}
	                                                                            {/foreach}
                                                                            {/foreach}
                                                                        </select>                                  
                                                                    </div>
                                                                </div>
                                                                
                                                                <div id="search_standard" class="forumCriteriaLineRight">
                                                                    <div class="forumCriteria">
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
                                                                    <div class="forumCriteria">                                                        
                                                                        <label for="forum_tri">Pr&eacute;cision : </label><br>
                                                                        <select class="user_input4 user_input_select input_middle" id="precision" name="precision">
                                                                        
                                                                            <option value="0">Pr&eacute;cision : </option>
                                                                            <option value="1">Dans les sujets</option>
                                                                            <option value="2">Dans les messages</option>
                                                                            {*}<option value="3">Parmis les auteurs</option>{*}
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
                                        <h3>Consulter les forums class&eacute;s par cat&eacute;gories</h3>
                                        <table class="commForum">
                                            <tbody>
                                                <tr>
                                                    <td class="forumHead1">
                                                        <h4 class="mast">
                                                            Forums
                                                        </h4>
                                                    </td>
                                                    <td class="forumHead2">
                                                        <h4 class="mast">
                                                            Sujets
                                                        </h4>
                                                    </td>
                                                    <td class="forumHead2">
                                                        <h4 class="mast">
                                                            R&eacute;ponses
                                                        </h4>
                                                    </td>
                                                    <td class="forumHead3">
                                                        <h4 class="mast">
                                                            Derni&egrave;re r&eacute;ponse
                                                        </h4>
                                                    </td>
                                                </tr>
                                                {foreach $toCategorieFors as $oCategories}
                                                    <tr>
                                                        <td class="forumCateg0">
                                                            <h4 class="mastCateg">
                                                                {$oCategories->categorieFor_libelle}
                                                            </h4>
                                                        </td>
                                                        <td class="forumCateg2">&nbsp;</td>
                                                        <td class="forumCateg2">&nbsp;</td>
                                                        <td class="forumCateg3">&nbsp;</td>
                                                    </tr>
                                                    
                                                    {foreach $toForums as $oForums}
                                                    	{if $oForums->forum_categorieForId == $oCategories->categorieFor_id}
                                                            {assign $tPost = array('fid'=>$oForums->forum_id, 'cid'=> $oCategories->categorieFor_id)}
                                                            <tr>
                                                                <td class="forumBody1">
                                                                    <a class="blueHead" href="{jurl 'forum~forumFo_forumSujetList', $tPost}">{$oForums->forum_libelle}</a>
                                                                    <p class="regTextPale">{$oForums->forum_description}</p>
                                                                </td>
                                                                <td class="forumBody2">
                                                                    <p>{$oForums->forum_nbSujet}</p>
                                                                </td>
                                                                <td class="forumBody2">
                                                                    <p>{$oForums->forum_nbReponse}</p>
                                                                </td>
                                                                <td class="forumBody3">                                                                
                                                                	<p><a class="lastPost" href="{jurl 'forum~forumFo_forumMessageList', array('fid'=>$oForums->forum_id, 'sid'=>$oForums->forum_commentlastId)}">{$oForums->forum_commentlastDate|date_format:"%d/%m/%Y (%H:%M:%S)"}</a></p>
                                                                	<a class="lastPost" href="#">{$oForums->forum_commentlastUser}</a>
                                                                    {if $oForums->forum_commentlastId}
                                                                        <a class="reviewPost" href="{jurl 'forum~forumFo_forumMessageList', array('fid'=>$oForums->forum_id, 'sid'=>$oForums->forum_commentlastId)}"> ... lire</a>
                                                                    {/if}
                                                                </td>
                                                            </tr>
                                                        {/if}
                                                    {/foreach}
                                                {/foreach}
                
                                                <tr class="commFoot">
                                                    <td>
                                                        <p class="regTextPale forumFoot">&nbsp;</p>
                                                    </td>
                                                    <td class="" colspan="3">&nbsp;                                                    
                                                    </td>
                                                </tr>                            
                                                
                                            </tbody>
                                        </table>
                                        
                                   </div>     
                            
                                        
                                                                      
                                    