                                <!-- PetiteAnnonces -->
                                <div id="innerpageAnnounce">
                                    <h4 class="mast_petiteAn" id="innerpageAnnounceTop">Petites annonces</h4>
                                    <ul class="secondaryPetiteAnnounce">
                                    
									{assign $j=0}
                                    {foreach $toPetiteAnnonces as $oPetiteAnnonces}
	                                    {assign $tPost = array('cid'=> $oPetiteAnnonces->petiteAnnonce_categorieAnId, 'anid'=>$oPetiteAnnonces->petiteAnnonce_id )}                                                                                     
                                        <li>
                                            <span class="announceDate">
	                                            {$oPetiteAnnonces->petiteAnnonce_dateCreation|date_format:"%H:%M:%S - %d/%m/%Y"}
                                            </span>
                                            <span class="announceCategorie">
	                                            {$oPetiteAnnonces->categorieAn_libelle}
                                            </span>
                                            <span class="announceTitle">
                                                {*}<a href="{jurl 'petiteAnnonce~petiteAnnonceFo_petiteAnnonceDetail', $tPost}" title="{$oPetiteAnnonces->petiteAnnonce_titre}">{$oPetiteAnnonces->petiteAnnonce_description}</a>{*}
                                                <a title="{$oPetiteAnnonces->petiteAnnonce_description}">{$oPetiteAnnonces->petiteAnnonce_description}</a>
                                            </span>
                                            <span class="viewsComments">
                                                <span class="name">R&eacute;f:</span>&nbsp;<span class="value">{$oPetiteAnnonces->petiteAnnonce_reference}</span> 
                                                <span class="name">Prix:</span>&nbsp;<span class="value">{if $oPetiteAnnonces->petiteAnnonce_prix}{$oPetiteAnnonces->petiteAnnonce_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if} {if $oPetiteAnnonces->petiteAnnonce_prixInfo}{$oPetiteAnnonces->petiteAnnonce_prixInfo}{/if}</span> 
                                                <span class="name">Contact:</span>&nbsp;<span class="value">{if $oPetiteAnnonces->petiteAnnonce_contact}{$oPetiteAnnonces->petiteAnnonce_contact}{else}N/C{/if}</span>                                                  
    		                                    <span class="name">Parue depuis:</span>&nbsp;<span class="date">{if $oPetiteAnnonces->petiteAnnonce_parution == 0}Aujourd'hui{else}{$oPetiteAnnonces->petiteAnnonce_parution} jour{if $oPetiteAnnonces->petiteAnnonce_parution > 1}s{/if}{/if}</span>
	                                        </span>
                                            
                                        </li>      
									{/foreach}	


                                    </ul>
									{if count($toPetiteAnnonces)}
                                    <div class="braftonFoot">
                                        <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'petiteAnnonce~petiteAnnonceFo_petiteAnnonceList', array('cid'=> 0)}">Toutes les rubriques</a>
                                    </div><!-- braftonFoot:[end]-->		
                                    {/if}    
                                </div>
                                <!-- end innerpageAnnounce -->
