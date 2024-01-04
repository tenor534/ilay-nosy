
								<div id="innerpageAnnounce">
                                    <h4>Fiche de l'annonceur</h4>
                                    
                                    {assign $can_view_annonce = 0}
                                    {if $is_annonceur_abonne == 1}
	                                    {assign $can_view_annonce = 1}
                                    {else}
	                                    {if $is_user_connected == 1 && $is_abonnement_valid == 1}	
	                                        {assign $can_view_annonce = 1}
                                        {/if}
                                    {/if}

									{if $can_view_annonce == 1}				
                                        <div class="info_list more_info">
                                            <span class="titre">{$annonce->annonce_contactPrenom} {$annonce->annonce_contactNom}</span>
                                            <dl>
                                                <dt>Email:</dt>
                                                <dd><a href="mailto:{$annonce->annonce_contactEmail}">{$annonce->annonce_contactEmail}</a></dd>
                                            </dl>
                                            <dl>
                                                <dt>Adresse:</dt>
                                                <dd>{$annonce->annonce_contactAdresse}</dd>
                                            </dl>
                                            <dl>
                                                <dt>CP:</dt>
                                                <dd>{$localite->localite_code} {$localite->localite_libelle}</dd>
                                            </dl>
                                            <dl>
                                                <dt>Ville:</dt>
                                                <dd>{$province->province_libelle}</dd>
                                            </dl>
                                            <dl>
                                                <dt>T&eacute;l.:</dt>
                                                <dd><strong>{$annonce->annonce_contactTelephone}</strong></dd>
                                            </dl>
                                            <dl>
                                                <dt>P&eacute;riode:</dt>
                                                <dd><span style="color:#0083B7;">                                            
                                                    
                                                    {if $annonce->annonce_contactPeriodeAppel == 1}
                                                        Tous les matins (08h-12h)
                                                    {elseif $annonce->annonce_contactPeriodeAppel == 2}
                                                        Tous les midis (12h-14h)
                                                    {elseif $annonce->annonce_contactPeriodeAppel == 3}
                                                        Tous les apr&egrave;s-midi (14h-17h)
                                                    {elseif $annonce->annonce_contactPeriodeAppel == 4}
                                                        Toutes les soir&eacute;es (17h-20h)
                                                    {elseif $annonce->annonce_contactPeriodeAppel == 5}
                                                        Toutes les nuits (20h-00h)
                                                    {elseif $annonce->annonce_contactPeriodeAppel == 6}
                                                        Toute la journ&eacute;e (07h-20h)
                                                    {else}
                                                        Toute la journ&eacute;e (07h-20h)
                                                    {/if}
                                                    
                                                    </span>                                                
                                                </dd>
                                            </dl>
                                        </div>
                                    {else}    
                                        <div class="info_list more_info">
                                            <span class="titre">Cher visiteur,</span>
                                            {if $is_user_connected == 0 && $is_abonnement_valid == 0}
                                            <dl>
                                                <d>
    	                                           	<p>
        	                                            Vous devez &ecirc;tre un membre connect&eacute; et abonn&eacute; pour voir les informations sur cet annonceur.                                                
                                                    </p>
                                                    <p>
	                                                    <a href="{jurl 'commun~communFo_login'}">Identifiez-vous ici</a>.
                                                    </p>
                                                    <br />
                                                    <p>
	                                                    Si vous n'&ecirc;tes pas encore membre du site, veuillez <a href="{jurl 'commun~communFo_register'}">cr&eacute;er un compte membre</a>.
                                                    </p>

                                                </d>
                                            </dl>
                                            {elseif $is_user_connected == 1 && $is_abonnement_valid == 0}
                                            <dl>
                                                <d>
    	                                           	<p>
        	                                            Vous devez vous abonner &agrave; un forfait pour voir les informations sur cet annonceur.                                                
                                                    </p>
                                                    <p>
	                                                    <a href="{jurl 'abonnement~abonnementFo_abonnementList'}">Abonnez-vous ici</a>.
                                                    </p>
                                                </d>
                                            </dl>
                                            {/if}
                                      	</div>                                    
                                    {/if}    
                                    {*}
                                    <div class="separator"></div>
                                    <form action="#" name="annonceForm" id="annonceForm">
										<a class="formButton_contactAnnonce" title="Ecrire à l'annonceur : uniquement pour les abonnés">valid</a>
									</form>
                                    <div class="braftonFoot">
                                        <img style="display: inline;" src="images/v5/arrowMore.gif">
                                        <a href="/news/" title="Voir toutes les annonces de cet annonceur" rel="nofollow">Voir toutes les annonces de cet annonceur</a>
                                    </div><!-- braftonFoot:[end]-->		
                                    {*}
                                </div>