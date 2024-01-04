                                    <div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Edition de votre abonnement - forfait</span> 
                                      	</p>          
   										<p style="clear:both">
											<span class="viewTexte">Vous avez choisi le Pack <b>{$toPack->pack_libelle} : {$toForfait->forfait_libelle}</b>.</span> 
                                        </p>
 									</div>
                                    
								    <p class="return">
                                   		<a href="{jurl 'abonnement~abonnementFo_abonnementList'}">Retour &agrave; la liste de vos abonnements</a>                                    
                                    </p>                                    
                                    <ul id="results">
                                        {assign $abonnementCredit = $toAbonnement->abonnement_credit + $toAbonnement->abonnement_creditPlus}

                                        {assign $abonnementStatut = ""}
                                        {if $toAbonnement->abonnement_statut == 1}
	                                        {assign $abonnementStatut = "VALIDE"}
                                        {elseif $toAbonnement->abonnement_statut == 2}
	                                        {assign $abonnementStatut = "EXPIRE"}
                                        {else}
	                                        {assign $abonnementStatut = "INCOMPLET"}
                                        {/if}                                        

                                        <li class="result result_express">
                                            <div class="result_title">
												{assign $forfaitPrix = $toForfait->forfait_prix + $toForfait->forfait_prixPlus}
                                                <h4><a href="#">PACK {$toPack->pack_libelle}</a> <span class="price">{$forfaitPrix|format_number: 0, ",", ' ','Ariary'}<span class="price_info"></span></span></h4>
                                                <div>
                                                    <p><span class="special">Forfait: {$toForfait->forfait_libelle}</span></p>
                                                    <ul class="split">
                                                        <li><span>(Statut = <strong class="red">{$abonnementStatut}</strong>)</span></li>
                                                        <li class="last date">Cr&eacute;e le {$toAbonnement->abonnement_dateCreation|date_format:"%d/%m/%Y (%H:%M:%S)"}</li>
                                                    </ul>
                                                </div>
                                                <div class="clearer"></div>
                                            </div>                                        
                                            <div class="result_desc">
                                                <div class="img_photo">
                                                    <img width="180" height="135" border="1" alt="{$toPack->pack_libelle}" src="{$j_basepath}resize/pack/photos/{$toPack->pack_photo}" name="imgPrinc">
                                                </div>
                                                <div class="desc_txt">
                                                    <ul>
                                                    	<li>Date de d&eacute;but: <strong>{$toAbonnement->abonnement_dateDebut|date_format:"%d/%m/%Y"}</strong></li>
                                                        <li>Date d'expiration: <strong>{$toAbonnement->abonnement_dateFin|date_format:"%d/%m/%Y"}</strong></li>
                                                    </ul>
                                                    <ul>
                                                    	<li>Cr&eacute;dit: <strong>{$toAbonnement->abonnement_credit|format_number: 0, ",", ' ','Ar'}</strong></li>
                                                        <li>Cr&eacute;dit+: <strong>{$toAbonnement->abonnement_creditPlus|format_number: 0, ",", ' ','Ar'}</strong></li>
                                                    </ul>
                                                    <h5>Caract&eacute;ristiques</h5>
                                                    <p>
														{$toForfait->forfait_libelle}	
                                                        {if $toForfait->forfait_nbPhoto != 0}
	                                                        , {$toForfait->forfait_nbPhoto} photos
                                                        {/if}
                                                        {if $toForfait->forfait_nbCaractere != 0}
	                                                        , {$toForfait->forfait_nbCaractere} caract&egrave;res
                                                        {/if}
                                                        {if $toForfait->forfait_dureeParution != 0}
	                                                        , {$toForfait->forfait_dureeParution} jours de parution
                                                        {/if}
                                                        {if $toForfait->forfait_voirCoordonnee != 0}
	                                                        , voir les coordonn&eacute;es des contacts
                                                        {/if}
                                                        {if $toForfait->forfait_ajoutLien != 0}
	                                                        , lien internet
                                                        {/if}
                                                        {if $toForfait->forfait_statistique != 0}
	                                                        , statistique de consultation
                                                        {/if}
                                                        {if $toForfait->forfait_texteMEV != 0}
	                                                        , texte mise en valeur
                                                        {/if}
                                                        {if $toForfait->forfait_nbPhotoAdd != 0}
	                                                        , {$toForfait->forfait_nbPhotoAdd} photos additionnelles
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
                                            <div class="result_foot">
                                                <ul>
                                                    <p class="regTextPaleNormal borderNoneInline">R&eacute;f&eacute;rence: <strong>{$toAbonnement->abonnement_reference}</strong></p>
                                                </ul>
                                            </div>
                                        </li><!-- result end -->
                                                                                                                        
                                    </ul>
                                    
                                    <div id="forfait_paiment">   
                                    {if $iType == 1}
                                    	<h3>{$toPack->pack_libelle} - EXPRESS</h3>                                                                
										<div class="{$zUseCss}" id="box_passepartout">
                                            <div class="bloc_inner">
                                            <div class="bloc_input">
                                            
                                            {foreach $toForfaits as $oForfait}
	                                            {if $oForfait->forfait_id == $toForfait->forfait_id}
	                                                <input type="radio" value="{$oForfait->forfait_id}" name="typeForfait" checked>
                                                {else}
        	                                        <input disabled type="radio" value="{$oForfait->forfait_id}" name="typeForfait">
    	                                        {/if}
                                                 {$oForfait->forfait_libelle} <br>
                                          	{/foreach}      
                                            </div>
                                            
                                            <div class="bloc_desc">
                                                <br><span class="separateur">&nbsp;</span> 5 photos <span class="separateur">&nbsp;</span> 3 mois de parution <br>
                                                <span class="separateur">&nbsp;</span> 600 caractères <span class="separateur">&nbsp;</span> Statistiques de consultation
                                                <br><br>
                                        
                                                <span class="separateur">&nbsp;</span> 5 photos <span class="separateur">&nbsp;</span> 3 mois de parution<br>
                                                <span class="separateur">&nbsp;</span> 1000 caractères<br>
                                                <span class="separateur">&nbsp;</span> Statistiques de consultation <span class="separateur">&nbsp;</span> Lien internet
                                            </div>                                            
                                            <div class="bloc_prix">
                                            	{assign $t=sizeof($toForfaits)} 
                                            	{assign $i=1}                                                  
                                                {foreach $toForfaits as $oForfait}
                                                    {$oForfait->forfait_prix|format_number:0}
                                                    {if $i < $t}<br>{/if}
                                                    {assign $i++} 
                                                {/foreach}      
                                            </div>
                                            </div>
                                            <div class="bloc_foot"></div>
                                        </div>
                                    {elseif $iType == 2}
                                    	<h3>{$toPack->pack_libelle} PASSE-PARTOUT</h3>                                                                
										<div class="{$zUseCss}" id="box_passepartout">
                                            <div class="bloc_inner">
                                            <div class="bloc_input">
                                            
                                            {foreach $toForfaits as $oForfait}
	                                            {if $oForfait->forfait_id == $toForfait->forfait_id}
	                                                <input type="radio" value="{$oForfait->forfait_id}" name="typeForfait" checked>
                                                {else}
        	                                        <input disabled type="radio" value="{$oForfait->forfait_id}" name="typeForfait">
    	                                        {/if}
                                                 {$oForfait->forfait_libelle} <br>
                                          	{/foreach}      
                                            </div>
                                            <div class="bloc_desc">
                                                <br><span class="separateur">&nbsp;</span> toutes les annonces <span class="separateur">&nbsp;</span> contacts des annonceurs <br>
                                                <span class="separateur">&nbsp;</span> coordonn&eacute;es de annonceurs
                                                <br>
                                        
                                                <br><span class="separateur">&nbsp;</span> toutes les annonces <span class="separateur">&nbsp;</span> contacts des annonceurs <br>
                                                <span class="separateur">&nbsp;</span> coordonn&eacute;es de annonceurs<br>
                                                <span class="separateur">&nbsp;</span> Alerts annonces
                                            </div>
                                            <div class="bloc_prix">
                                            	{assign $t=sizeof($toForfaits)} 
                                            	{assign $i=1}                                                  
                                                {foreach $toForfaits as $oForfait}
                                                    {$oForfait->forfait_prix|format_number:0}
                                                    {if $i < $t}<br>{/if}
                                                    {assign $i++} 
                                                {/foreach}      
                                            </div>
                                            </div>
                                            <div class="bloc_foot"></div>
                                        </div>
                                    {else}   
                                    	<h3>{$toPack->pack_libelle}</h3>

										<div id="box_autres_paiment" class="{$zUseCss}">
                                            <div class="bloc_inner">
                                            <div class="bloc_input">
                                            	{assign $t=sizeof($toForfaits)} 
                                            	{assign $i=1}
                                                {assign $n=1}                                                  
                                                {foreach $toForfaits as $oForfait}
                                                	{if $i == 1}
                                                    	<p>
                                                    {/if}	
                                                	{if $n == 1}
		                                                {assign $checked = "checked"}                                                  
					                                    {assign $idForfaitChecked = $oForfait->forfait_id}
                                                    {else}    
		                                                {assign $checked = ""}                                                  
                                                    {/if}	
                                                    
                                                    {if $oForfait->forfait_id == $toForfait->forfait_id}
                                                        <input type="radio" value="{$oForfait->forfait_id}" name="typeForfait" checked>&nbsp;
                                                    {else}
                                                        <input disabled type="radio" value="{$oForfait->forfait_id}" name="typeForfait">&nbsp;
                                                    {/if}
                                                    
                                                   	
                                                    
                                                    {if $i == 1 && $n != $t}<br>{/if}                                                    
                                                    {if $i == 1 && $n == $t}</p>{/if}                                                    
                                                	{if $i == 2}
                                                    	</p>
	                                                    {assign $i = 0} 
                                                    {/if}	
                                                    {assign $i++} 
                                                    {assign $n++} 
                                                {/foreach}      
                                            </div>
                                        
                                            <div class="bloc_desc">
                                                <p>
                                                2 annonces ( 5 photos - 3 mois de parution)<br>
                                                2 annonces &agrave; valeur ajout&eacute;e (9 photos)
                                                </p>
                                                <p>
                                                5 annonces ( 5 photos - 3 mois de parution)<br>
                                                5 annonces &agrave; valeur ajout&eacute;e (9 photos)
                                                </p>
                                                <p>
                                                25 annonces ( 5 photos - 3 mois de parution)<br>
                                                25 annonces &agrave; valeur ajout&eacute;e (10 photos)
                                                </p>
                                                <p>
                                                50 annonces ( 5 photos - 3 mois de parution)<br>
                                                50 annonces &agrave; valeur ajout&eacute;e (10 photos)
                                                </p>
                                                <p>
                                                10 annonces 5 photos - 3 mois de parution)
                                                </p>
                                            </div>
                                            <div class="bloc_prix">
                                            	{assign $t=sizeof($toForfaits)} 
                                            	{assign $i=1}
                                                {assign $n=1}                                                  
                                                {foreach $toForfaits as $oForfait}
                                                	{assign $forfaitPrix = $oForfait->forfait_prix + $oForfait->forfait_prixPlus}
                                                	{if $i == 1}
                                                    	<p>
                                                    {/if}	
                                                    {$forfaitPrix|format_number: 0, ",", ' ','Ar'}                                                    
                                                    {if $i == 1 && $n != $t}<br>{/if}                                                    
                                                    {if $i == 1 && $n == $t}</p>{/if}                                                    
                                                	{if $i == 2}
                                                    	</p>
	                                                    {assign $i = 0} 
                                                    {/if}	
                                                    {assign $i++} 
                                                    {assign $n++} 
                                                {/foreach}      
                                            </div>
                                            </div>
                                            <div class="bloc_foot"></div>
                                        </div>

                                    {/if}                                        
                                    </div>
                                    <br>
                                    
                                    {if $toAbonnement->abonnement_statut == 3}                                    
                                        <div class="viewResult">
                                            <h3>Cr&eacute;ditez votre abonnement : Introduisez le <strong>code PIN</strong> et le <strong>mot de passe</strong> inscrits sur votre ticket pr&eacute;pay&eacute;e.</h3>
                                        </div>
                                        <br>    
                                        <h3>Cr&eacute;ditez votre abonnement sur Ilay NOSY</h3>

                                        <form id="creditForm" name="creditForm" action="#">
                                            <input type="hidden" id="credit_id" name="credit_id" value="{$toAbonnement->abonnement_id}" />
                                            <input type="hidden" id="credit_packId" name="credit_packId" value="{$toPack->pack_id}" />
                                            <input type="hidden" id="credit_forfaitId" name="credit_forfaitId" value="{$toForfait->forfait_id}" />
                                            <div class="creditContent">                                        
                                                {*}
                                                <div id="delais">
                                                    <label class="delais">Maintenant:</label>
                                                    <input class="radio" type="checkbox" id="credit_delais1" name="credit_delais1" value="1" checked="checked">
                                                    <br>
                                                    <label class="delais">Plutard:</label>
                                                    <input class="radio" type="checkbox" id="credit_delais2" name="credit_delais2" value="1">
                                                </div>                                            
                                                {*}
                                                <br>
                                                <div id="crRecharge">
                                                    <label for="credit_codePIN">code PIN: </label>
                                                    <input class="user_input2" type="text" id="credit_codePIN" value="" name="credit_codePIN" tmt:required="true">
                                                    <br>
                                                    <label for="credit_password">Mot de passe:</label>
                                                    <input class="user_input2" type="password" id="credit_password" value="" name="credit_password" tmt:required="true">
                                                </div>       
                                                <div class="clearer"></div>
                                                <a class="formButton_valid">valid</a>
		                                        <div class="clearer"></div>
										 		<p class="errorMessage" id="errorMessage"></p>                                          
                                                <br><br>
                                            </div>
                                        </form>
                                    {/if}      

