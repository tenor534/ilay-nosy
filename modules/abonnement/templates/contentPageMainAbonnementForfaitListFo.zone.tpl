                                    <div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Ajouter un nouvel abonnement - choix du forfait</span> 
                                      	</p>          
   										<p style="clear:both">
                                        	<span class="viewTexte">Vous avez choisi le Pack <b>{$toPack->pack_libelle}</b>. Maintenant s&eacute;lectionnez le forfait qui vous convient.</span> 
                                        </p>
 									</div>
                                    <p class="return">
                                        <a href="{jurl 'abonnement~abonnementFo_abonnementPackList'}">Retour &agrave; la liste des packs</a>                                    
                                    </p>                                    
                                    <ul id="results">
                                        <li class="result result_express">
                                            <div class="result_title">
                                                <h4><a href="#">PACK {$toPack->pack_libelle}</a></h4>
                                                <div class="clearer"></div>
                                            </div>                                                                   
                                                            
                                            <div class="result_desc">
                                                <div class="img_photo">
                                                    <a href="#"><img width="180" height="135" border="1" alt="PACK Visiteur" src="{$j_basepath}resize/pack/photos/{$toPack->pack_photo}" name="imgPrinc"></a>
                                                </div>
                                                <div class="desc_txt">
                                                    {if $toPack->pack_id == 1}
                                                    	{*}PACK_VEHICULES{*}
	                                                    <h5>Caract&eacute;ristiques</h5>
	                                                    <p>
                                                            <strong><u>Autos</u></strong>
                                                            <br>
                                                               Collection
                                                             - Autos
                                                             - Camions
                                                             - Minifourgonnettes
                                                             - Utilitaires sport
                                                             - Voitures de prestige ...
                                                            <br> 
                                                            <strong><u>R&eacute;cr&eacute;atifs</u></strong>
                                                            <br>
                                                             A&eacute;riens
                                                             - Marins
                                                             - Motoneiges
                                                             - Motos
                                                             - R&eacute;cr&eacute;atifs
                                                             - VTT ...
                                                            <br> 
                                                            <strong><u>Autres</u></strong>
                                                            <br>
                                                             Equipements
                                                             - Machineries commerciales/agricoles
                                                             - Moto - Pi&egrave;ces/acc./v&ecirc;tements
                                                             - Pi&egrave;ces automobiles
                                                             - Pneus/roues
                                                             - Remorques
                                                             - Service/entretien
                                                             - Divers ...
                                                        </p>
                                                    {elseif $toPack->pack_id == 2}
                                                    	{*}PACK_IMMOBILIERS{*}
	                                                    <p>
                                                            <strong><u>Achat/Vente</u></strong>
                                                            <br>
                                                             Chalets
                                                             - Commercial/Industriel
                                                             - Entreprises
                                                             - Fermes
                                                             - Immeubles &agrave; revenus
                                                             - R&eacute;sidentiel
                                                             - Terrains ...
                                                            <br>
                                                            <strong><u>Location</u></strong>
                                                            <br>
                                                            Chalets
                                                             - Colocataires
                                                             - Commercial
                                                             - Garages/entrep&ocirc;ts
                                                             - Logements
                                                             - R&eacute;sidence pour a&icirc;n&eacute;s ...
                                                            <br>
                                                            <strong><u>Services</u></strong>
                                                            <br>
                                                            Construction/r&eacute;novation
                                                             - Courtage immobilier
                                                             - D&eacute;m&eacute;nagement/entreposage
                                                             - D&eacute;neigement/terrassement ...
                                                        </p>
                                                    {elseif $toPack->pack_id == 3}
                                                    	{*}PACK_EMPLOIS{*}
	                                                    <h5>Caract&eacute;ristiques</h5>
	                                                    <p>
                                                            <strong><u>Carri&egrave;res et Professions</u></strong>
                                                            <br>
                                                            Achats/qualit&eacute;
                                                             - Administration/gestion
                                                             - Assurances/services financiers
                                                             - Automobile/transport
                                                             - Commerce de d&eacute;tail
                                                             - Comptabilit&eacute;/finance
                                                             - Droit
                                                             - Education/formation
                                                             - G&eacute;nie/sciences
                                                             - Marketing/communication
                                                             - M&eacute;tiers
                                                             - Production/manutention
                                                             - Ressources humaines
                                                             - Sant&eacute;/services sociaux
                                                             - Soutien administratif
                                                             - Technologies
                                                             - Tourisme/h&ocirc;tellerie/restauration
                                                             - Vente/service &agrave; la client&egrave;le ....
                                                            <br>
                                                            <strong><u>Particulier &agrave; Particulier</u></strong>
                                                            <br>
                                                             Particulier &agrave; Particulier
                                                             - Artistes/musiciens
                                                             - Domestique/domicile
                                                             - Divers .....
                                                        </p>
                                                    {elseif $toPack->pack_id == 4}
                                                    	{*}PACK_ANNONCES{*}
	                                                    <h5>Caract&eacute;ristiques</h5>
	                                                    <p>
                                                            <strong><u>Ammeublement</u></strong>
                                                            <br>
                                                            Articles m&eacute;nagers
                                                             - Arts/antiquit&eacute;s
                                                             - D&eacute;coration
                                                             - Electrom&eacute;nagers
                                                             - Mobilier bureau
                                                             - Mobilier jardin
                                                             - Mobilier maison ...
                                                            <br>
                                                            <strong><u>Outils et mat&eacute;riaux</u></strong>
                                                            <br>
                                                            Bois de chauffage
                                                             - Equipements de chauffage
                                                             - Equipements professionnels
                                                             - Equipements saisonniers
                                                             - Horticulture/jardinage
                                                             - Mat&eacute;riaux de construction ...
                                                            <br>
                                                            <strong><u>Animaux</u></strong>
                                                            <br>
                                                            Accessoires/&eacute;levage/toilettage
                                                             - Chats
                                                             - Chiens
                                                             - Insectes
                                                             - Oiseaux
                                                             - Poissons/aquatique
                                                             - Reptiles
                                                             - Animaux de compagnie
                                                             - Chevaux
                                                             - Ferme/&eacute;levage ...
                                                            <br>
                                                            <strong><u>Familles</u></strong>
                                                            <br>
                                                            Bijoux/accessoires
                                                             - Garderies
                                                             - Jouets
                                                             - Maternit&eacute;
                                                             - V&ecirc;tements/chaussures ...
                                                            <br>
                                                            <strong><u>Elecronique</u></strong>
                                                            <br>
                                                            Audio
                                                             - Consoles de jeux-Consoles
                                                             - Consoles de jeux-Jeux
                                                             - DVD, Num&eacute;rique et Vid&eacute;o
                                                             - Electronique ...
                                                            <br>
                                                            <strong><u>Informatique</u></strong>
                                                            <br>
                                                            Jeux (ordinateur)
                                                             - Logiciels
                                                             - Ordinateurs de table
                                                             - Ordinateurs-P&eacute;riph&eacute;riques
                                                             - Ordinateurs-Pi&egrave;ces
                                                             - Ordinateurs-Services
                                                             - Portables ...
                                                            <br>
                                                            <strong><u>Services</u></strong>
                                                            <br>
                                                            Astrologie/voyance
                                                             - Cellulaire/t&eacute;l&eacute;phonie
                                                             - Co-voiturage ...
                                                             - Construction/r&eacute;novation
                                                             - Cours/ateliers/formations
                                                             - Courtage immobilier
                                                             - D&eacute;m&eacute;nagement/entreposage
                                                             - D&eacute;neigement/terrassement
                                                             - Garderies
                                                             - Mariage/planification
                                                             - Massoth&eacute;rapie
                                                             - M&eacute;decine naturelle
                                                             - Opportunit&eacute;s d'affaires/associ&eacute;s
                                                             - Sant&eacute;/beaut&eacute;/alimentation
                                                             - Services domestiques
                                                             - Services financiers/l&eacute;gaux/ass
                                                             - Ventes de garage/puces/encans ...
                                                            <br>
                                                            <strong><u>Rencontres</u></strong>
                                                            <br>
                                                            Femme cherche homme
                                                             - Homme cherche femme
                                                             - Femme cherche femme
                                                             - Homme cherche homme
                                                             - Femme cherche couple
                                                             - Homme cherche couple ...
                                                            <br>
                                                            <strong><u>Communautaire</u></strong>
                                                            <br>
                                                             A donner
                                                             - Avis/souhaits/perdu/trouv&eacute;
                                                             - Soutien
                                                             
                                                             
                                                        </p>
                                                    {else}
                                                    	{*}PACK_VISITEURS{*}
	                                                    <h5>Caract&eacute;ristiques</h5>
	                                                    <p>Profitez de cette offre pour consulter toutes les annonces du site avec possibilit&eacute; de voir les contacts ou les coordonn&eacute;es des annonceurs. </p>
                                                    {/if}
                                                    
                                                </div>
                                            </div>    
                                            <div class="result_foot">
                                                <ul>
                                                    <p class="regTextPaleNormal borderNoneInline">R&eacute;f&eacute;rence: <strong>{$toPack->pack_code}000{$toPack->pack_id}</strong></p>
                                                </ul>
                                            </div>
                                        </li><!-- result end -->
                                                                                                                        
                                    </ul>

                                    <br>    
									<form id="creditForm" name="creditForm" action="#">
                                    <div id="forfait_paiment">   
                                    {assign $idForfaitChecked = 0}                                                  
                                    {if $iType == 1}
                                    	<h3>{$toPack->pack_libelle} - EXPRESS</h3>                                                                
										<div class="{$zUseCss}" id="box_passepartout">
                                            <div class="bloc_inner">
                                            <div class="bloc_input">
                                            {assign $n=1}                                                  
                                            {foreach $toForfaits as $oForfait}
                                                {if $n == 1}
                                                    {assign $checked = "checked"}                                                  
				                                    {assign $idForfaitChecked = $oForfait->forfait_id}
                                                {else}    
                                                    {assign $checked = ""}                                                  
                                                {/if}	
                                                <input type="radio" value="{$oForfait->forfait_id}" name="typeForfait" {$checked} onclick="selectItem(this);">&nbsp;{$oForfait->forfait_libelle} <br>
	                                            {assign $n++}                                                  
                                          	{/foreach}      
                                            </div>
                                            
                                            <div class="bloc_desc">
                                                <br><span class="separateur">&nbsp;</span> 5 photos <span class="separateur">&nbsp;</span> 3 mois de parution <br>
                                                <span class="separateur">&nbsp;</span> 600 caract&egrave;res <span class="separateur">&nbsp;</span> Statistiques de consultation
                                                <br><br>
                                        
                                                <span class="separateur">&nbsp;</span> 5 photos <span class="separateur">&nbsp;</span> 3 mois de parution<br>
                                                <span class="separateur">&nbsp;</span> 1000 caract&egrave;res<br>
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
                                            {assign $n=1}                                                  
                                            {foreach $toForfaits as $oForfait}
                                                {if $n == 1}
                                                    {assign $checked = "checked"}                                                  
				                                    {assign $idForfaitChecked = $oForfait->forfait_id}
                                                {else}    
                                                    {assign $checked = ""}                                                  
                                                {/if}	
                                                <input type="radio" value="{$oForfait->forfait_id}" name="typeForfait" {$checked} onclick="selectItem(this);">&nbsp;{$oForfait->forfait_libelle} <br>
	                                            {assign $n++}                                                  
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
                                                    <input type="radio" name="typeForfait" value="{$oForfait->forfait_id}" {$checked} onclick="selectItem(this);">&nbsp;
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
                                    <div class="viewResult">
   										<p style="clear:both">&nbsp;</p>
   										<p style="clear:both">
                                        	<span class="viewTexte">Cr&eacute;ditez votre abonnement : Introduisez le <strong>code PIN</strong> et le <strong>mot de passe</strong> inscrits sur votre ticket pr&eacute;pay&eacute;e.</span> 
                                        </p>
 									</div>
                                    <br>    
                                   	<h3>Cr&eacute;ditez votre abonnement sur Ilay NOSY</h3>
                                    <input type="hidden" id="credit_id" name="credit_id" value="0" />
                                    <input type="hidden" id="credit_packId" name="credit_packId" value="{$toPack->pack_id}" />
                                    <input type="hidden" id="credit_forfaitId" name="credit_forfaitId" value="{$idForfaitChecked}" />
                                    <div class="creditContent">                                        
                                        <div id="delais">
                                            <label class="delais">Maintenant:</label>
                                            <input class="radio" type="checkbox" id="credit_delais1" name="credit_delais1" value="1" checked="checked">
                                            <br>
                                            <label class="delais">Plutard:</label>
                                            <input class="radio" type="checkbox" id="credit_delais2" name="credit_delais2" value="1">
                                        </div>
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