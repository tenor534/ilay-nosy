							{if sizeof($toActualites)}
                                {assign $j=0}
                                {foreach $toActualites as $oActualites}                                
                                <div class="row" id="mainNews">
                                    <div class="header">
                                        <h3 class="{$oActualites->actualite_h3}">{$oActualites->actualite_topTitre}</h3>
                                    </div><!-- header:[end] -->
                                    {assign $tPost = array('cid'=> $oActualites->rubrique_categorieActId, 'acid'=>$oActualites->actualite_id )}                                                                                                                     
                                    <div class="singleColumnBig">
                                        <a href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}" title="{$oActualites->actualite_titre}">
                                            <h2>{$oActualites->actualite_titre}</h2>
                                        </a>
                                        <a href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}" title="{$oActualites->actualite_titre}">
                                          <img width="469" height="313" src="{$j_basepath}resize/actualite/images/home/{$oActualites->actualite_photo}" alt="{$oActualites->actualite_titre}">
                                        </a>
                                        <span class="viewsComments">
                                            <span>R&eacute;f:</span> {$oActualites->actualite_reference} <span>Prix:</span>  {if $oActualites->actualite_prix}{$oActualites->actualite_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if} <span>Vues:</span> {$oActualites->actualite_visite} fois
                                            <p class="date">Parue depuis : {if $oActualites->actualite_parution == 0}Aujourd'hui{else}{$oActualites->actualite_parution} jour{if $oActualites->actualite_parution > 1}s{/if}{/if}</p>
                                        </span>
                                    </div><!-- :[end] -->
                                    <div class="singleColumnBig">
                                        {if $oActualites->actualite_resume != ""}
                                        <p class="resume">
                                            {$oActualites->actualite_resume} 
                                        </p>
                                        {/if}
                                        <p>
                                            {$oActualites->actualite_description}
                                            <a class="read" href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">&raquo; Consulter l'actualite...</a>
                                        </p>
                                        <p>&nbsp;</p>
                                    </div><!-- :[end] -->
                
                                </div><!-- mainStory:[end] -->                         
                                {/foreach}
                            {/if}
