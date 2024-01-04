							<div id="homepageNew">
                 				<h3 class="mast_rencontre">Rencontres</h3>                  
                                
                                {*}
                 				<h4>Femmes</h4>                  
                                {assign $j=0}
                                {foreach $toOfficielFemmes as $oOfficiels}
	                                {assign $tPost = array('cid'=> $oOfficiels->rubrique_categorieOffId, 'acid'=>$oOfficiels->officiel_id )}
                                    <div class="article {if $j > 0}borderBlue{/if}">
                                        <div class="articleTitle">                                  		
                                            <a title="{$oOfficiels->officiel_titre}" href="{jurl 'officiel~officielFo_officielDetail', $tPost}">
                                                <img src="{$j_basepath}resize/officiel/images/left/{$oOfficiels->officiel_photo}" alt="{$oOfficiels->officiel_titre}"/>
                                            </a>
                                            <a title="{$oOfficiels->officiel_titre}" href="{jurl 'officiel~officielFo_officielDetail', $tPost}">{$oOfficiels->officiel_titre}</a>
                                            &nbsp;
                                            {$oOfficiels->officiel_resume}
                                            <p class="date">Parue depuis : {if $oOfficiels->officiel_parution == 0}Aujourd'hui{else}{$oOfficiels->officiel_parution} jour{if $oOfficiels->officiel_parution > 1}s{/if}{/if}</p>
                                        </div>
                                    </div>
                                {assign $j++}
                                {/foreach}
                                <div class="braftonFoot">
                                	<img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'officiel~officielFo_officielResultList', array('rid'=> 66)}">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
		
                                <div class="articleSeparator"></div>                            
                 				<h4>Hommes</h4>                  

                                {assign $j=0}
                                {foreach $toOfficielHommes as $oOfficiels}
	                                {assign $tPost = array('cid'=> $oOfficiels->rubrique_categorieOffId, 'acid'=>$oOfficiels->officiel_id )}
                                    <div class="article {if $j > 0}borderBlue{/if}">
                                        <div class="articleTitle">                                  		
                                            <a title="{$oOfficiels->officiel_titre}" href="{jurl 'officiel~officielFo_officielDetail', $tPost}">
                                                <img src="{$j_basepath}resize/officiel/images/left/{$oOfficiels->officiel_photo}" alt="{$oOfficiels->officiel_titre}"/>
                                            </a>
                                            <a title="{$oOfficiels->officiel_titre}" href="{jurl 'officiel~officielFo_officielDetail', $tPost}">{$oOfficiels->officiel_titre}</a>
                                            &nbsp;
                                            {$oOfficiels->officiel_resume}
                                            <p class="date">Parue depuis : {if $oOfficiels->officiel_parution == 0}Aujourd'hui{else}{$oOfficiels->officiel_parution} jour{if $oOfficiels->officiel_parution > 1}s{/if}{/if}</p>
                                        </div>
                                    </div>
                                {assign $j++}
                                {/foreach}
                                <div class="braftonFoot">
                                	<img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'officiel~officielFo_officielResultList', array('rid'=> 73)}">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
                                
                                <div class="articleSeparator"></div>                            
                                
                 				<h4>Couples</h4>                  

                                {assign $j=0}
                                {foreach $toOfficielCouples as $oOfficiels}
	                                {assign $tPost = array('cid'=> $oOfficiels->rubrique_categorieOffId, 'acid'=>$oOfficiels->officiel_id )}
                                    <div class="article {if $j > 0}borderBlue{/if}">
                                        <div class="articleTitle">                                  		
                                            <a title="{$oOfficiels->officiel_titre}" href="{jurl 'officiel~officielFo_officielDetail', $tPost}">
                                                <img src="{$j_basepath}resize/officiel/images/left/{$oOfficiels->officiel_photo}" alt="{$oOfficiels->officiel_titre}"/>
                                            </a>
                                            <a title="{$oOfficiels->officiel_titre}" href="{jurl 'officiel~officielFo_officielDetail', $tPost}">{$oOfficiels->officiel_titre}</a>
                                            &nbsp;
                                            {$oOfficiels->officiel_resume}
                                            <p class="date">Parue depuis : {if $oOfficiels->officiel_parution == 0}Aujourd'hui{else}{$oOfficiels->officiel_parution} jour{if $oOfficiels->officiel_parution > 1}s{/if}{/if}</p>
                                        </div>
                                    </div>
                                {assign $j++}
                                {/foreach}
                                <div class="braftonFoot">
                                	<img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'officiel~officielFo_officielResultList', array('rid'=> 80)}">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
                                {*}
               				 </div><!-- end innerpageBlog -->                            
