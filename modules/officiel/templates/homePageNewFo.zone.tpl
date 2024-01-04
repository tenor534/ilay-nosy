							<div id="homepageNew">
                 				<h3>Actualit&eacute;s</h3> 
								{assign $i = 0}         
                                {foreach $toCategorieOffs as $oCategories}
                                    {if $i > 0}                                             
										<div class="articleSeparator"></div>                            
                                    {/if}                                                                         
                 					
                                    <h4>{$oCategories->categorieOff_libelle}</h4>                                                  
                                                                        
                                    {assign $j = 0}         
                                    {foreach $toOfficiels as $oOfficiels}
                                    	{if $oOfficiels->officiel_categorieOffId == $oCategories->categorieOff_id}
	                                        {assign $tPost = array('cid'=> $oOfficiels->officiel_categorieOffId, 'acid'=>$oOfficiels->officiel_id )}
                                            <div class="article {if $j > 0}borderBlue{/if}">
                                                <div class="articleTitle">                                  		
                                                    <a title="{$oOfficiels->officiel_titre}" href="{jurl 'officiel~officielFo_officielDetail', $tPost}">
                                                        <img src="{$j_basepath}resize/officiel/images/left/{$oOfficiels->officiel_photo}" alt="{$oOfficiels->officiel_titre}"/>
                                                    </a>
                                                    <a title="{$oOfficiels->officiel_titre}" href="{jurl 'officiel~officielFo_officielDetail', $tPost}">{$oOfficiels->officiel_titre}</a>
                                                    &nbsp;
                                                    {$oOfficiels->officiel_resume}
                                                    {*}<p class="date">{$oOfficiels->officiel_datePublication|date_format:"%d/%m/%Y (%H:%M:%S)"}</p>{*}
                                                    <p class="date">{$oOfficiels->officiel_datePublication}</p>
                                                </div>
                                            </div>                                        
                                            {assign $j++}         
                                        {/if}
                                    {/foreach}    
                                    
                                    <div class="braftonFoot">
                                        <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        <a rel="nofollow" title="Afficher d'autres articles" href="{jurl 'officiel~officielFo_officielResultList', array('cid'=> $oCategories->categorieOff_id)}">Afficher d'autres articles</a>                                        
                                    </div><!-- braftonFoot:[end]-->
                                    
									{assign $i++}         
                                {/foreach}
               				 </div><!-- end innerpageBlog -->                            
