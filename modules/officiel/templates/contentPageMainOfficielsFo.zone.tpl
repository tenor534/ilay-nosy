							{if sizeof($toOfficiels)}
                                {assign $j=0}
                                {foreach $toOfficiels as $oOfficiels}                                
                                <div class="row" id="mainNews">
                                    <div class="header">
                                        <h3 class="{$oOfficiels->officiel_h3}">{$oOfficiels->officiel_topTitre}</h3>
                                    </div><!-- header:[end] -->
                                    {assign $tPost = array('cid'=> $oOfficiels->rubrique_categorieOffId, 'acid'=>$oOfficiels->officiel_id )}                                                                                                                     
                                    <div class="singleColumnBig">
                                        <a href="{jurl 'officiel~officielFo_officielDetail', $tPost}" title="{$oOfficiels->officiel_titre}">
                                            <h2>{$oOfficiels->officiel_titre}</h2>
                                        </a>
                                        <a href="{jurl 'officiel~officielFo_officielDetail', $tPost}" title="{$oOfficiels->officiel_titre}">
                                          <img width="469" height="313" src="{$j_basepath}resize/officiel/images/home/{$oOfficiels->officiel_photo}" alt="{$oOfficiels->officiel_titre}">
                                        </a>
                                        <span class="viewsComments">
                                            <span>R&eacute;f:</span> {$oOfficiels->officiel_reference} <span>Prix:</span>  {if $oOfficiels->officiel_prix}{$oOfficiels->officiel_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if} <span>Vues:</span> {$oOfficiels->officiel_visite} fois
                                            <p class="date">Parue depuis : {if $oOfficiels->officiel_parution == 0}Aujourd'hui{else}{$oOfficiels->officiel_parution} jour{if $oOfficiels->officiel_parution > 1}s{/if}{/if}</p>
                                        </span>
                                    </div><!-- :[end] -->
                                    <div class="singleColumnBig">
                                        {if $oOfficiels->officiel_resume != ""}
                                        <p class="resume">
                                            {$oOfficiels->officiel_resume} 
                                        </p>
                                        {/if}
                                        <p>
                                            {$oOfficiels->officiel_description}
                                            <a class="read" href="{jurl 'officiel~officielFo_officielDetail', $tPost}">&raquo; Consulter l'officiel...</a>
                                        </p>
                                        <p>&nbsp;</p>
                                    </div><!-- :[end] -->
                
                                </div><!-- mainStory:[end] -->                         
                                {/foreach}
                            {/if}
