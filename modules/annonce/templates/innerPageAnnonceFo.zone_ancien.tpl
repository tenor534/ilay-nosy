								{*if sizeof($toAnnonces)}	
                                    {if $toAnnonces[0]->annonce_cat == 1} {*}{*}Vehicule{*}{*}
                                        <div id="innerpageAnnounce">
                                            <h4 id="innerpageAnnounceTop" style="text-decoration:blink;">Gratuit jusqu'au 31 décembre 2010 !!</h4>
                                            <ul class="secondaryAnnounce">
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px; font-size:14px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        <strong style="color:#003366;">Url du site : </strong><a style="font-size:14px;" href="http://www.ilay-nosy.com">http://www.ilay-nosy.com</a>
                                                    </span>
                                                </li>      
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        <a>Ce site d' annonces class&eacute;es est ouvert aux particuliers et aux professionnels.</a>
                                                    </span>
                                                </li>      
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        <a style="color:#D00700;">Toutes les annonces sont gratuites jusqu'au 31 d&eacute;cembre 2010.</a>
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
                                                        <a style="color:#006E12;">Dans votre demande veuillez pr&eacute;ciser le PACK (ex: Vehicule, Immobilier, Emploi, Autres annonces) et le forfait (ex: 2 annonces, 5 annonces, 25 annonces ...) que vous avez choisis pour votre abonnement</a>
                                                    </span>
                                                </li>      
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        Pour toutes &eacute;ventuelles annomalies ou difficult&eacute;s (cr&eacute;ation de compte, identification, gestion d'abonnement, gestion d'annonce ...) ou autres suggestions, merci de 
                                                        <a href="{jurl 'contact~contactFo_contactDemande'}">nous contactez</a> sans h&eacute;siter. 
                                                        Ou merci de nous envoyer un email &agrave; l'adresse : <a href="mailto:contact@ilay-nosy.com?subject=Demande de code gratuit">contact@ilay-nosy.com</a>.
                                                    </span>
                                                </li>      
                                                <li>
                                                    <span class="announceTitle" style="margin-left:5px;">
	                                                    <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                                        Formulaire d'ajout/édition d'une annonce à nous retourner : <a href="ilaynosy-annonce-form.docx">formulaire</a>.
                                                    </span>
                                                </li>      
                                            </ul>
                                        </div>
                                        <!-- end innerpageAnnounce -->
                                    {/if}
								{/if*}

                                <!-- Annonces -->
                                <div id="innerpageAnnounce">
                                    <h4 class="{$mast}" id="innerpageAnnounceTop">{$topTitre}</h4>
                                    <ul class="secondaryAnnounce">
                                    
									{assign $j=0}
                                    {foreach $toAnnonces as $oAnnonces}
	                                    {assign $tPost = array('cid'=> $oAnnonces->rubrique_categorieAnId, 'anid'=>$oAnnonces->annonce_id )}                                                                                     
                                        <li>
                                            <a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}" title="{$oAnnonces->annonce_titre}">
                                                <img src="{$j_basepath}resize/annonce/images/photo/{$oAnnonces->annonce_photo}" alt="{$oAnnonces->annonce_titre}" class="videoThumb">
                                            </a>
                                            <span class="announceTitle">
                                                <a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}" title="{$oAnnonces->annonce_titre}">{$oAnnonces->annonce_titre}</a>
                                                <br />
                                                {$oAnnonces->annonce_resume}
                                            </span>
                                            <span class="viewsComments">
                                                <span>R&eacute;f:</span> {$oAnnonces->annonce_reference} <span>Prix:</span>  {if $oAnnonces->annonce_prix}{$oAnnonces->annonce_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if} 
                                                <br>
                                                <span>Vues:</span> {$oAnnonces->annonce_visite}
                                                 - 
    		                                    <span class="date">Parue depuis : {if $oAnnonces->annonce_parution == 0}Aujourd'hui{else}{$oAnnonces->annonce_parution} jour{if $oAnnonces->annonce_parution > 1}s{/if}{/if}</span>
	                                        </span>
                                            
                                        </li>      
									{/foreach}	


                                    </ul>
									{if count($toAnnonces)}
                                    <div class="braftonFoot">
                                        <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        {if $oAnnonces->annonce_cat == 4} {*}Autres annonces{*}
	                                        <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=> 777)}">Toutes les rubriques</a>
                                        {else}
	                                        <a rel="nofollow" title="Toutes les rubriques" href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=> $oAnnonces->rubrique_categorieAnId)}">Toutes les rubriques</a>
                                        {/if}    
                                    </div><!-- braftonFoot:[end]-->		
                                    {/if}    
                                </div>
                                <!-- end innerpageAnnounce -->
