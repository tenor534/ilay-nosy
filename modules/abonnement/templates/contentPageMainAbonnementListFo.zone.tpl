                                    <div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Liste de vos abonnements</span> 
                                      	</p>          
   										<p style="clear:both">
                                        
	                                        {if $canAdd}                                        
                                                <span class="viewTexte">Cliquez sur le bouton "Ajouter" ci-contre pour ajouter un nouvel abonnement.</span> 
                                                <a style="clear:both; margin:-18px 0 0 550px;" href="{jurl 'abonnement~abonnementFo_abonnementPackList'}" class="formButton_add">Ajouter</a>
                                            {else}
                                                <span class="viewTexte">Vous avez encore un abonnement &agrave; r&eacute;gulariser. En attendant vous ne pouvez pas encore ajouter un nouvel abonnement.</span> 
                                            {/if}    
                                        </p>
   										<p style="clear:both"></p>	                     
                                   		{*}
                                        <h3>
                                            {if sizeof($toAbonnements)==0}
	                                        	Vous n'avez pas encore d'abonnement. Cliquez sur le bouton ci-dessus pour ajouter un forfait d'abonnement.
                                            {else}
        	                                	Voici la liste de vos abonnements selon le PACK et le Forfait que vous avez choisi.
    	                                    {/if}
                                        </h3>
                                        {*}
                                    	
									</div>
                                    <br>
									<div id="results">                                    
									<ul>
{*}                                    
[abonnement_id] => 1
[abonnement_utilisateurId] => 1
[abonnement_forfaitId] => 1
[abonnement_reference] => ab00010001
[abonnement_dateDebut] => 2010-03-01
[abonnement_dateFin] => 2010-06-01
[abonnement_dateCreation] => 2010-03-01 17:48:22
[abonnement_credit] => 0
[abonnement_creditPlus] => 0
[abonnement_nbPlus] => 0
[abonnement_statut] => 3
[forfait_id] => 1
[forfait_packId] => 1
[forfait_libelle] => 2 annonces
[forfait_nbAnnonce] => 2
[forfait_nbPhoto] => 5
[forfait_nbCaractere] => 600
[forfait_dureeParution] => 90
[forfait_voirPhoto] => 1
[forfait_voirCoordonnee] => 1
[forfait_affichePhoto] => 1
[forfait_afficheCoordonnee] => 1
[forfait_ajoutLien] => 0
[forfait_hasPlus] => 0
[forfait_statistique] => 0
[forfait_texteMEV] => 0
[forfait_nbPhotoAdd] => 0
[forfait_prix] => 3000.00
[forfait_prixPlus] => 0.00
{*}  
                                {if sizeof($toAbonnements) != 0}
                                    {assign $i=0}                                   
                                    
                                    {foreach $toAbonnements as $oAbonnement}
                                    
                                        {assign $abonnementCredit = $oAbonnement->abonnement_credit + $oAbonnement->abonnement_creditPlus}

                                        {assign $abonnementStatut = ""}
                                        {if $oAbonnement->abonnement_statut == 1}
	                                        {assign $abonnementStatut = "VALIDE"}
                                        {elseif $oAbonnement->abonnement_statut == 2}
	                                        {assign $abonnementStatut = "EXPIRE"}
                                        {else}
	                                        {assign $abonnementStatut = "INCOMPLET"}
                                        {/if}                                        

                                        {assign $tPost= array('pid'=> $oAbonnement->forfait_packId, 'fid'=> $oAbonnement->forfait_id, 'aid'=> $oAbonnement->abonnement_id)}

                                        {if $i==0}
                                            <li style="height:10px;"></li>                                                    
                                        {/if}                                                            
                                        <li class="result result_express">
                                            <div class="result_title">
												{assign $forfaitPrix = $oAbonnement->forfait_prix + $oAbonnement->forfait_prixPlus}
                                                <h4><a href="{jurl 'abonnement~abonnementFo_abonnementEdit', $tPost}">PACK {$oAbonnement->pack_libelle}</a> 
                                                <span class="price">{$forfaitPrix|format_number: 0, ",", ' ','Ariary'}<span class="price_info"></span></span></h4>
                                                <div>
                                                    <p><span class="special">Forfait: {$oAbonnement->forfait_libelle}</span></p>
                                                    <ul class="split">
                                                        <li><span>(Statut = <strong class="red">{$abonnementStatut}</strong>)</span></li>
                                                        <li class="last date">Cr&eacute;e le {$oAbonnement->abonnement_dateCreation|date_format:"%d/%m/%Y (%H:%M:%S)"}</li>
                                                    </ul>
                                                </div>
                                                <div class="clearer"></div>
                                            </div>                                        
                                            <div class="result_desc">
                                                <div class="img_photo">
													<a title="PACK {$oAbonnement->pack_libelle}" href="{jurl 'abonnement~abonnementFo_abonnementEdit', $tPost}"><img width="180" height="135" border="1" alt="{$oAbonnement->pack_libelle}" src="{$j_basepath}resize/pack/photos/{$oAbonnement->pack_photo}" name="imgPrinc"></a>
                                                </div>
                                                <div class="desc_txt">
                                                    <ul>
                                                    	<li>Date de d&eacute;but: <strong>{$oAbonnement->abonnement_dateDebut|date_format:"%d/%m/%Y"}</strong></li>
                                                        <li>Date d'expiration: <strong>{$oAbonnement->abonnement_dateFin|date_format:"%d/%m/%Y"}</strong></li>
                                                    </ul>
                                                    <ul>
                                                    	<li>Cr&eacute;dit: <strong>{$oAbonnement->abonnement_credit} Ariary</strong></li>
                                                        <li>Cr&eacute;dit+: <strong>{$oAbonnement->abonnement_creditPlus} Ariary</strong></li>
                                                    </ul>
                                                    <h5>Caract&eacute;ristiques</h5>
                                                    <p>
														{$oAbonnement->forfait_libelle}	
                                                        {if $oAbonnement->forfait_nbPhoto != 0}
	                                                        , {$oAbonnement->forfait_nbPhoto} photos
                                                        {/if}
                                                        {if $oAbonnement->forfait_nbCaractere != 0}
	                                                        , {$oAbonnement->forfait_nbCaractere} caract&egrave;res
                                                        {/if}
                                                        {if $oAbonnement->forfait_dureeParution != 0}
	                                                        , {$oAbonnement->forfait_dureeParution} jours de parution
                                                        {/if}
                                                        {if $oAbonnement->forfait_voirCoordonnee != 0}
	                                                        , voir les coordonn&eacute;es des contacts
                                                        {/if}
                                                        {if $oAbonnement->forfait_ajoutLien != 0}
	                                                        , lien internet
                                                        {/if}
                                                        {if $oAbonnement->forfait_statistique != 0}
	                                                        , statistique de consultation
                                                        {/if}
                                                        {if $oAbonnement->forfait_texteMEV != 0}
	                                                        , texte mise en valeur
                                                        {/if}
                                                        {if $oAbonnement->forfait_nbPhotoAdd != 0}
	                                                        , {$oAbonnement->forfait_nbPhotoAdd} photos additionnelles
                                                        {/if}
														.                                                        
                                                    </p>
                                                    <p class="red">                                                     
                                                        {if $abonnementCredit == 0}
                                                            <u>NB:</u>&nbsp;Vous devez cr&eacute;diter votre abonnement pour que vos coordonn&eacute;es/contacts soient visibles par plus de 3 000 visiteurs par jour.
                                                        {/if}                                        
                                                    </p>
                                                </div>
                                            </div>    
                                            <form style="visibility:hidden" id="registerForm" name="registerForm" action="#">
                                                <input type="hidden" id="pack_id" name="pack_id" value="{$oAbonnement->forfait_packId}">
                                                <input type="hidden" id="forfait_id" name="forfait_id" value="{$oAbonnement->forfait_id}">
                                                <input type="hidden" id="utilisateur_id" name="utilisateur_id" value="{$oAbonnement->abonnement_utilisateurId}">
                                                <input type="hidden" id="abonnement_id" name="abonnement_id" value="{$oAbonnement->abonnement_id}">
                                            </form>                                                      

                                            <div class="result_foot">
                                                <ul>
                                                    <p class="regTextPaleNormal borderNoneInline">R&eacute;f&eacute;rence: <strong>{$oAbonnement->abonnement_reference}</strong></p>
                                                    {if $abonnementCredit == 0}
                                                        <li class="borderLeftInline">
                                                            <a id="creditAbonnement" class="hotTopics" href="{jurl 'abonnement~abonnementFo_abonnementEdit', $tPost}">Cr&eacute;diter cet abonnement</a>
                                                        </li>
                                                    {/if}
                                                    {if $oAbonnement->abonnement_statut == 3 && $oAbonnement->abonnement_nbAnnonce == 0}
                                                        <li class="borderLeftInline">
                                                            <a id="deleteAbonnement" class="hotTopics" href="{jurl 'abonnement~abonnementFo_abonnementDelete', array('aid'=> $oAbonnement->abonnement_id)}">Suprimer cet abonnement</a>
                                                        </li>
                                                    {/if}
                                                    
                                                </ul>
                                            </div>
                                        </li><!-- result end -->

                                        {assign $i++}
                                        {/foreach}
                                    {/if}
                                        
                                    </ul>	
                                    </div>