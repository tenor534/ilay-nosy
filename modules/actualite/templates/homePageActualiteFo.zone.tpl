							<div id="homepageNew">
                 				<h3 class="mast_rencontre">Rencontres</h3>                  
                                
                                {*}
                 				<h4>Femmes</h4>                  
                                {assign $j=0}
                                {foreach $toActualiteFemmes as $oActualites}
	                                {assign $tPost = array('cid'=> $oActualites->rubrique_categorieActId, 'acid'=>$oActualites->actualite_id )}
                                    <div class="article {if $j > 0}borderBlue{/if}">
                                        <div class="articleTitle">                                  		
                                            <a title="{$oActualites->actualite_titre}" href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">
                                                <img src="{$j_basepath}resize/actualite/images/left/{$oActualites->actualite_photo}" alt="{$oActualites->actualite_titre}"/>
                                            </a>
                                            <a title="{$oActualites->actualite_titre}" href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">{$oActualites->actualite_titre}</a>
                                            &nbsp;
                                            {$oActualites->actualite_resume}
                                            <p class="date">Parue depuis : {if $oActualites->actualite_parution == 0}Aujourd'hui{else}{$oActualites->actualite_parution} jour{if $oActualites->actualite_parution > 1}s{/if}{/if}</p>
                                        </div>
                                    </div>
                                {assign $j++}
                                {/foreach}
                                <div class="braftonFoot">
                                	<img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'actualite~actualiteFo_actualiteResultList', array('rid'=> 66)}">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
		
                                <div class="articleSeparator"></div>                            
                 				<h4>Hommes</h4>                  

                                {assign $j=0}
                                {foreach $toActualiteHommes as $oActualites}
	                                {assign $tPost = array('cid'=> $oActualites->rubrique_categorieActId, 'acid'=>$oActualites->actualite_id )}
                                    <div class="article {if $j > 0}borderBlue{/if}">
                                        <div class="articleTitle">                                  		
                                            <a title="{$oActualites->actualite_titre}" href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">
                                                <img src="{$j_basepath}resize/actualite/images/left/{$oActualites->actualite_photo}" alt="{$oActualites->actualite_titre}"/>
                                            </a>
                                            <a title="{$oActualites->actualite_titre}" href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">{$oActualites->actualite_titre}</a>
                                            &nbsp;
                                            {$oActualites->actualite_resume}
                                            <p class="date">Parue depuis : {if $oActualites->actualite_parution == 0}Aujourd'hui{else}{$oActualites->actualite_parution} jour{if $oActualites->actualite_parution > 1}s{/if}{/if}</p>
                                        </div>
                                    </div>
                                {assign $j++}
                                {/foreach}
                                <div class="braftonFoot">
                                	<img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'actualite~actualiteFo_actualiteResultList', array('rid'=> 73)}">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
                                
                                <div class="articleSeparator"></div>                            
                                
                 				<h4>Couples</h4>                  

                                {assign $j=0}
                                {foreach $toActualiteCouples as $oActualites}
	                                {assign $tPost = array('cid'=> $oActualites->rubrique_categorieActId, 'acid'=>$oActualites->actualite_id )}
                                    <div class="article {if $j > 0}borderBlue{/if}">
                                        <div class="articleTitle">                                  		
                                            <a title="{$oActualites->actualite_titre}" href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">
                                                <img src="{$j_basepath}resize/actualite/images/left/{$oActualites->actualite_photo}" alt="{$oActualites->actualite_titre}"/>
                                            </a>
                                            <a title="{$oActualites->actualite_titre}" href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">{$oActualites->actualite_titre}</a>
                                            &nbsp;
                                            {$oActualites->actualite_resume}
                                            <p class="date">Parue depuis : {if $oActualites->actualite_parution == 0}Aujourd'hui{else}{$oActualites->actualite_parution} jour{if $oActualites->actualite_parution > 1}s{/if}{/if}</p>
                                        </div>
                                    </div>
                                {assign $j++}
                                {/foreach}
                                <div class="braftonFoot">
                                	<img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'actualite~actualiteFo_actualiteResultList', array('rid'=> 80)}">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
                                {*}
               				 </div><!-- end innerpageBlog -->                            
