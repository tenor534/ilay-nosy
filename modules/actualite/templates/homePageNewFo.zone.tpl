							<div id="homepageNew">
                 				<h3>Actualit&eacute;s</h3> 
								{assign $i = 0}         
                                {foreach $toCategorieActs as $oCategories}
                                    {if $i > 0}                                             
										<div class="articleSeparator"></div>                            
                                    {/if}                                                                         
                 					
                                    <h4>{$oCategories->categorieAct_libelle}</h4>                                                  
                                                                        
                                    {assign $j = 0}         
                                    {foreach $toActualites as $oActualites}
                                    	{if $oActualites->actualite_categorieActId == $oCategories->categorieAct_id}
	                                        {assign $tPost = array('cid'=> $oActualites->actualite_categorieActId, 'acid'=>$oActualites->actualite_id )}
                                            <div class="article {if $j > 0}borderBlue{/if}">
                                                <div class="articleTitle">
													{if $oActualites->actualite_photo != ""}						                      		
                                                    <a title="{$oActualites->actualite_titre}" href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">
                                                        <img src="{$j_basepath}resize/actualite/images/left/{$oActualites->actualite_photo}" alt="{$oActualites->actualite_titre}"/>
                                                    </a>
													{/if}		
                                                    <a title="{$oActualites->actualite_titre}" href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">{$oActualites->actualite_titre}</a>
                                                     <br /> 
                                                    {$oActualites->actualite_resume}
                                                    {*}<p class="date">{$oActualites->actualite_datePublication|date_format:"%d/%m/%Y (%H:%M:%S)"}</p>{*}
                                                    <p class="date">{$oActualites->actualite_datePublication}</p>
                                                </div>
                                            </div>                                        
                                            {assign $j++}         
                                        {/if}
                                    {/foreach}    
                                    
                                    <div class="braftonFoot">
                                        <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        <a rel="nofollow" title="Afficher d'autres articles" href="{jurl 'actualite~actualiteFo_actualiteResultList', array('cid'=> $oCategories->categorieAct_id)}">Afficher d'autres articles</a>                                        
                                    </div><!-- braftonFoot:[end]-->
                                    
									{assign $i++}         
                                {/foreach}
               				 </div><!-- end innerpageBlog -->                            
