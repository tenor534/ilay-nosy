							<div id="homepageAnnounce">
                 				<h3 class="mast_rencontre">Rencontres</h3>                  
                                
                                
                 				<h4>Femmes</h4>                  
                                {assign $j=0}
                                {foreach $toAnnonceFemmes as $oAnnonces}
	                                {assign $tPost = array('cid'=> $oAnnonces->rubrique_categorieAnId, 'anid'=>$oAnnonces->annonce_id )}
                                    <div class="article {if $j > 0}borderBlue{/if}">
                                        <div class="articleTitle">                                  		
                                            <a title="{$oAnnonces->annonce_titre}" href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">
                                                <img src="{$j_basepath}resize/annonce/images/left/{$oAnnonces->annonce_photo}" alt="{$oAnnonces->annonce_titre}"/>
                                            </a>
                                            <a title="{$oAnnonces->annonce_titre}" href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">{$oAnnonces->annonce_titre}</a>
                                            &nbsp;
                                            {$oAnnonces->annonce_resume}
                                            <p class="date">Parue depuis : {if $oAnnonces->annonce_parution == 0}Aujourd'hui{else}{$oAnnonces->annonce_parution} jour{if $oAnnonces->annonce_parution > 1}s{/if}{/if}</p>
                                        </div>
                                    </div>
                                {assign $j++}
                                {/foreach}
                                <div class="braftonFoot">
                                	<img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=> 66)}">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
		
                                <div class="articleSeparator"></div>                            
                 				<h4>Hommes</h4>                  

                                {assign $j=0}
                                {foreach $toAnnonceHommes as $oAnnonces}
	                                {assign $tPost = array('cid'=> $oAnnonces->rubrique_categorieAnId, 'anid'=>$oAnnonces->annonce_id )}
                                    <div class="article {if $j > 0}borderBlue{/if}">
                                        <div class="articleTitle">                                  		
                                            <a title="{$oAnnonces->annonce_titre}" href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">
                                                <img src="{$j_basepath}resize/annonce/images/left/{$oAnnonces->annonce_photo}" alt="{$oAnnonces->annonce_titre}"/>
                                            </a>
                                            <a title="{$oAnnonces->annonce_titre}" href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">{$oAnnonces->annonce_titre}</a>
                                            &nbsp;
                                            {$oAnnonces->annonce_resume}
                                            <p class="date">Parue depuis : {if $oAnnonces->annonce_parution == 0}Aujourd'hui{else}{$oAnnonces->annonce_parution} jour{if $oAnnonces->annonce_parution > 1}s{/if}{/if}</p>
                                        </div>
                                    </div>
                                {assign $j++}
                                {/foreach}
                                <div class="braftonFoot">
                                	<img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=> 73)}">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
                                
                                <div class="articleSeparator"></div>                            
                                
                 				<h4>Couples</h4>                  

                                {assign $j=0}
                                {foreach $toAnnonceCouples as $oAnnonces}
	                                {assign $tPost = array('cid'=> $oAnnonces->rubrique_categorieAnId, 'anid'=>$oAnnonces->annonce_id )}
                                    <div class="article {if $j > 0}borderBlue{/if}">
                                        <div class="articleTitle">                                  		
                                            <a title="{$oAnnonces->annonce_titre}" href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">
                                                <img src="{$j_basepath}resize/annonce/images/left/{$oAnnonces->annonce_photo}" alt="{$oAnnonces->annonce_titre}"/>
                                            </a>
                                            <a title="{$oAnnonces->annonce_titre}" href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">{$oAnnonces->annonce_titre}</a>
                                            &nbsp;
                                            {$oAnnonces->annonce_resume}
                                            <p class="date">Parue depuis : {if $oAnnonces->annonce_parution == 0}Aujourd'hui{else}{$oAnnonces->annonce_parution} jour{if $oAnnonces->annonce_parution > 1}s{/if}{/if}</p>
                                        </div>
                                    </div>
                                {assign $j++}
                                {/foreach}
                                <div class="braftonFoot">
                                	<img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                    <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=> 80)}">Toutes les rubriques</a>
                                </div><!-- braftonFoot:[end]-->
               				 </div><!-- end innerpageBlog -->                            
