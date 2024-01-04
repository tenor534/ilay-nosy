								{*}
								{if sizeof($toOfficiels)}	
                                    {if $toOfficiels[0]->officiel_cat == 1} {*}Vehicule{*}
                                        <div id="innerpageNew">
                                            <h4 id="innerpageNewTop" style="text-decoration:blink;">Promotion jusqu'au 31 mars 2010 !!</h4>
                                            <ul class="secondaryNew">
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        <a>Ce site d' officiels class&eacute;es est ouvert aux particuliers et aux professionnels.</a>
                                                    </span>
                                                </li>      
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        <a style="color:#D00700;">Toutes les officiels sont gratuites jusqu'au 31 mars 2010.</a>
                                                    </span>
                                                </li>      
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        <a href="{jurl 'contact~contactFo_contactDemande'}">Contactez-nous</a> pour obtenir vos codes de recharge gratuits pour vos abonnements. 
                                                        Ou merci de nous envoyer un email &agrave; l'adresse : <a href="mailto:contact@ilay-nosy.com?subject=Demande de code gratuit">contact@ilay-nosy.com</a>.
                                                    </span>
                                                </li>      
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        <a style="color:#006E12;">Dans votre demande veuillez pr&eacute;ciser le PACK (ex: Vehicule, Immobilier, Emploi, Autres officiels) et le forfait (ex: 2 officiels, 5 officiels, 25 officiels ...) que vous avez choisis pour votre abonnement</a>
                                                    </span>
                                                </li>      
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        Pour toutes &eacute;ventuelles annomalies ou difficult&eacute;s (cr&eacute;ation de compte, identification, gestion d'abonnement, gestion d'officiel ...) ou autres suggestions, merci de 
                                                        <a href="{jurl 'contact~contactFo_contactDemande'}">nous contactez</a> sans h&eacute;siter. 
                                                        Ou merci de nous envoyer un email &agrave; l'adresse : <a href="mailto:contact@ilay-nosy.com?subject=Demande de code gratuit">contact@ilay-nosy.com</a>.
                                                    </span>
                                                </li>      
                                            </ul>
                                        </div>
                                        <!-- end innerpageNew -->
                                    {/if}
								{/if}

                                <!-- Officiels -->
                                <div id="innerpageNew">
                                    <h4 class="{$mast}" id="innerpageNewTop">{$topTitre}</h4>
                                    <ul class="secondaryNew">
                                    
									{assign $j=0}
                                    {foreach $toOfficiels as $oOfficiels}
	                                    {assign $tPost = array('cid'=> $oOfficiels->rubrique_categorieOffId, 'acid'=>$oOfficiels->officiel_id )}                                                                                     
                                        <li>
                                            <a href="{jurl 'officiel~officielFo_officielDetail', $tPost}" title="{$oOfficiels->officiel_titre}">
                                                <img src="{$j_basepath}resize/officiel/images/photo/{$oOfficiels->officiel_photo}" alt="{$oOfficiels->officiel_titre}" class="videoThumb">
                                            </a>
                                            <span class="announceTitle">
                                                <a href="{jurl 'officiel~officielFo_officielDetail', $tPost}" title="{$oOfficiels->officiel_titre}">{$oOfficiels->officiel_titre}</a>
                                                <br />
                                                {$oOfficiels->officiel_resume}
                                            </span>
                                            <span class="viewsComments">
                                                <span>R&eacute;f:</span> {$oOfficiels->officiel_reference} <span>Prix:</span>  {if $oOfficiels->officiel_prix}{$oOfficiels->officiel_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if} 
                                                <br>
                                                <span>Vues:</span> {$oOfficiels->officiel_visite}
                                                 - 
    		                                    <span class="date">Parue depuis : {if $oOfficiels->officiel_parution == 0}Aujourd'hui{else}{$oOfficiels->officiel_parution} jour{if $oOfficiels->officiel_parution > 1}s{/if}{/if}</span>
	                                        </span>
                                            
                                        </li>      
									{/foreach}	


                                    </ul>
                                    <div class="braftonFoot">
                                        <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        {if $oOfficiels->officiel_cat == 4} {*}Autres officiels{*}
	                                        <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'officiel~officielFo_officielResultList', array('cid'=> 777)}">Toutes les rubriques</a>
                                        {else}
	                                        <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'officiel~officielFo_officielResultList', array('cid'=> $oOfficiels->rubrique_categorieOffId)}">Toutes les rubriques</a>
                                        {/if}    
                                    </div><!-- braftonFoot:[end]-->		
                                </div>
                                <!-- end innerpageNew -->
								{*}