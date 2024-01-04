								{*}
								{if sizeof($toActualites)}	
                                    {if $toActualites[0]->actualite_cat == 1} {*}Vehicule{*}
                                        <div id="innerpageNew">
                                            <h4 id="innerpageNewTop" style="text-decoration:blink;">Promotion jusqu'au 31 mars 2010 !!</h4>
                                            <ul class="secondaryNew">
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        <a>Ce site d' actualites class&eacute;es est ouvert aux particuliers et aux professionnels.</a>
                                                    </span>
                                                </li>      
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        <a style="color:#D00700;">Toutes les actualites sont gratuites jusqu'au 31 mars 2010.</a>
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
                                                        <a style="color:#006E12;">Dans votre demande veuillez pr&eacute;ciser le PACK (ex: Vehicule, Immobilier, Emploi, Autres actualites) et le forfait (ex: 2 actualites, 5 actualites, 25 actualites ...) que vous avez choisis pour votre abonnement</a>
                                                    </span>
                                                </li>      
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        Pour toutes &eacute;ventuelles annomalies ou difficult&eacute;s (cr&eacute;ation de compte, identification, gestion d'abonnement, gestion d'actualite ...) ou autres suggestions, merci de 
                                                        <a href="{jurl 'contact~contactFo_contactDemande'}">nous contactez</a> sans h&eacute;siter. 
                                                        Ou merci de nous envoyer un email &agrave; l'adresse : <a href="mailto:contact@ilay-nosy.com?subject=Demande de code gratuit">contact@ilay-nosy.com</a>.
                                                    </span>
                                                </li>      
                                            </ul>
                                        </div>
                                        <!-- end innerpageNew -->
                                    {/if}
								{/if}

                                <!-- Actualites -->
                                <div id="innerpageNew">
                                    <h4 class="{$mast}" id="innerpageNewTop">{$topTitre}</h4>
                                    <ul class="secondaryNew">
                                    
									{assign $j=0}
                                    {foreach $toActualites as $oActualites}
	                                    {assign $tPost = array('cid'=> $oActualites->rubrique_categorieActId, 'acid'=>$oActualites->actualite_id )}                                                                                     
                                        <li>
                                            <a href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}" title="{$oActualites->actualite_titre}">
                                                <img src="{$j_basepath}resize/actualite/images/photo/{$oActualites->actualite_photo}" alt="{$oActualites->actualite_titre}" class="videoThumb">
                                            </a>
                                            <span class="announceTitle">
                                                <a href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}" title="{$oActualites->actualite_titre}">{$oActualites->actualite_titre}</a>
                                                <br />
                                                {$oActualites->actualite_resume}
                                            </span>
                                            <span class="viewsComments">
                                                <span>R&eacute;f:</span> {$oActualites->actualite_reference} <span>Prix:</span>  {if $oActualites->actualite_prix}{$oActualites->actualite_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if} 
                                                <br>
                                                <span>Vues:</span> {$oActualites->actualite_visite}
                                                 - 
    		                                    <span class="date">Parue depuis : {if $oActualites->actualite_parution == 0}Aujourd'hui{else}{$oActualites->actualite_parution} jour{if $oActualites->actualite_parution > 1}s{/if}{/if}</span>
	                                        </span>
                                            
                                        </li>      
									{/foreach}	


                                    </ul>
                                    <div class="braftonFoot">
                                        <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        {if $oActualites->actualite_cat == 4} {*}Autres actualites{*}
	                                        <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'actualite~actualiteFo_actualiteResultList', array('cid'=> 777)}">Toutes les rubriques</a>
                                        {else}
	                                        <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'actualite~actualiteFo_actualiteResultList', array('cid'=> $oActualites->rubrique_categorieActId)}">Toutes les rubriques</a>
                                        {/if}    
                                    </div><!-- braftonFoot:[end]-->		
                                </div>
                                <!-- end innerpageNew -->
								{*}