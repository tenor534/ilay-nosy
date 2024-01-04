							{if sizeof($toAnnonces)}
                                {assign $j=0}
                                {foreach $toAnnonces as $oAnnonces}                                
                                <div class="row" id="mainNews">
                                    <div class="header">
                                        <h3 class="{$oAnnonces->annonce_h3}">{$oAnnonces->annonce_topTitre}</h3>
                                    </div><!-- header:[end] -->
                                    {assign $tPost = array('cid'=> $oAnnonces->rubrique_categorieAnId, 'anid'=>$oAnnonces->annonce_id )}                                                                                                                     
                                    <div class="singleColumnBig">
                                        <a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}" title="{$oAnnonces->annonce_titre}">
                                            <h2>{$oAnnonces->annonce_titre}</h2>
                                        </a>
                                        <a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}" title="{$oAnnonces->annonce_titre}">
                                          <img width="469" height="313" src="{$j_basepath}resize/annonce/images/home/{$oAnnonces->annonce_photo}" alt="{$oAnnonces->annonce_titre}">
                                        </a>
                                        <span class="viewsComments">
                                            <span>R&eacute;f:</span> {$oAnnonces->annonce_reference} <span>Prix:</span>  {if $oAnnonces->annonce_prix}{$oAnnonces->annonce_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if} <span>Vues:</span> {$oAnnonces->annonce_visite} fois
                                            <p class="date">Parue depuis : {if $oAnnonces->annonce_parution == 0}Aujourd'hui{else}{$oAnnonces->annonce_parution} jour{if $oAnnonces->annonce_parution > 1}s{/if}{/if}</p>
                                        </span>
                                    </div><!-- :[end] -->
                                    {*}
                                    <div class="singleColumnBig">
                                        {if $oAnnonces->annonce_resume != ""}
                                        <p class="resume">
                                            {$oAnnonces->annonce_resume} 
                                        </p>
                                        {/if}
                                        <p>
                                            {$oAnnonces->annonce_description}
                                            <a class="read" href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">&raquo; Consulter l'annonce...</a>
                                        </p>
                                        <p>&nbsp;</p>
                                    </div><!-- :[end] -->
					                {*}
                                </div><!-- mainStory:[end] -->                         
                                {/foreach}
                            {/if}
