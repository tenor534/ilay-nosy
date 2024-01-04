									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Nos tarifs 2010</span> 
                                      	</p>          
   										<p style="clear:both">
                                        	<span class="viewTexte">Voicis nos diff&eacute;rents forfaits ainsi que leurs tarifs</span>
										</p>
									</div>
                                    
                                    {foreach $toPacks as $oPacks}

                                        {assign $iType = 0}
                                        {assign $zUseCss = ""}
                                
                                        {*}Type de template forfait à utiliser{*}
                                        {if $oPacks->pack_id == 1}
                                            {assign $toForfaits = $toForfaitVs}
                                            {assign $iType = 1}
                                            {assign $zUseCss = "bloc_forfait_vehicule_split"}
                                        {elseif $oPacks->pack_id == 2}
                                            {assign $toForfaits = $toForfaitIs}
                                            {assign $iType = 1}
                                            {assign $zUseCss = "bloc_forfait_immobilier_split"}
                                        {elseif $oPacks->pack_id == 3}
                                            {assign $toForfaits = $toForfaitEs}
                                            {assign $iType = 1}
                                            {assign $zUseCss = "bloc_forfait_emploi_split"}
                                        {elseif $oPacks->pack_id == 5}
                                            {assign $toForfaits = $toForfaitVis}
                                            {assign $iType = 2}
                                            {assign $zUseCss = "bloc_forfait_visiteur_split"}
                                        {else}
                                            {assign $toForfaits = $toForfaitAs}
                                            {assign $iType = 3}
                                            {assign $zUseCss = "bloc_forfait_autres"}
                                        {/if}
                                        <p style="clear: both;height:20px;"></p>
                                        <ul id="results">
                                            <li class="result result_express">
                                                <div class="result_title">
                                                    <h4><a href="#">PACK {$oPacks->pack_libelle}</a></h4>
                                                    <div class="clearer"></div>
                                                </div>                                                                   
                                                                
                                                <div class="result_desc">
                                                    <div class="img_photo">
                                                        <a href="#"><img width="180" height="135" border="1" alt="PACK Visiteur" src="{$j_basepath}resize/pack/photos/{$oPacks->pack_photo}" name="imgPrinc"></a>
                                                    </div>
                                                    <div class="desc_txt">
                                                        {if $oPacks->pack_id == 1}
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
                                                        {elseif $oPacks->pack_id == 2}
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
                                                        {elseif $oPacks->pack_id == 3}
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
                                                        {elseif $oPacks->pack_id == 4}
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
                                                                <br>
                                                                <strong><u>...</u></strong>
                                                                <br>
                                                                 
                                                                 
                                                            </p>
                                                        {else}
                                                            {*}PACK_VISITEURS{*}
                                                            <h5>Caract&eacute;ristiques</h5>
                                                            <p>Profitez de cette offre pour consulter toutes les officiels du site avec possibilit&eacute; de voir les contacts ou les coordonn&eacute;es des officielurs. </p>
                                                        {/if}
                                                        
                                                    </div>
                                                </div>    
                                                <div class="result_foot">
                                                    <ul>
                                                        <p class="regTextPaleNormal borderNoneInline">R&eacute;f&eacute;rence: <strong>{$oPacks->pack_code}000{$oPacks->pack_id}</strong></p>
                                                    </ul>
                                                </div>
                                            </li><!-- result end -->
                                                                                                                            
                                        </ul>
    
                                        <br>    
                                        <form id="creditForm" name="creditForm" action="#">
                                        <div id="forfait_paiment">   
                                        {assign $idForfaitChecked = 0}                                                  
                                        {if $iType == 1}
                                            <h3>{$oPacks->pack_libelle} - EXPRESS</h3>                                                                
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
                                                    <input disabled="disabled" type="radio" value="{$oForfait->forfait_id}" name="typeForfait" {$checked} onclick="selectItem(this);">&nbsp;{$oForfait->forfait_libelle} <br>
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
                                            <h3>{$oPacks->pack_libelle} PASSE-PARTOUT</h3>                                                                
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
                                                    <input disabled="disabled" type="radio" value="{$oForfait->forfait_id}" name="typeForfait" {$checked} onclick="selectItem(this);">&nbsp;{$oForfait->forfait_libelle} <br>
                                                    {assign $n++}                                                  
                                                {/foreach}      
                                                </div>
                                                <div class="bloc_desc">
                                                    <br><span class="separateur">&nbsp;</span> toutes les officiels <span class="separateur">&nbsp;</span> contacts des officielurs <br>
                                                    <span class="separateur">&nbsp;</span> coordonn&eacute;es de officielurs
                                                    <br>
                                            
                                                    <br><span class="separateur">&nbsp;</span> toutes les officiels <span class="separateur">&nbsp;</span> contacts des officielurs <br>
                                                    <span class="separateur">&nbsp;</span> coordonn&eacute;es de officielurs<br>
                                                    <span class="separateur">&nbsp;</span> Alerts officiels
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
                                            <h3>{$oPacks->pack_libelle}</h3>
    
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
                                                        <input disabled="disabled" type="radio" name="typeForfait" value="{$oForfait->forfait_id}" {$checked} onclick="selectItem(this);">&nbsp;
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
                                                    2 officiels ( 5 photos - 3 mois de parution)<br>
                                                    2 officiels &agrave; valeur ajout&eacute;e (9 photos)
                                                    </p>
                                                    <p>
                                                    5 officiels ( 5 photos - 3 mois de parution)<br>
                                                    5 officiels &agrave; valeur ajout&eacute;e (9 photos)
                                                    </p>
                                                    <p>
                                                    25 officiels ( 5 photos - 3 mois de parution)<br>
                                                    25 officiels &agrave; valeur ajout&eacute;e (10 photos)
                                                    </p>
                                                    <p>
                                                    50 officiels ( 5 photos - 3 mois de parution)<br>
                                                    50 officiels &agrave; valeur ajout&eacute;e (10 photos)
                                                    </p>
                                                    <p>
                                                    10 officiels 5 photos - 3 mois de parution)
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
                                        <p style="clear: both;height:10px;"></p>
                                        </form>
									{/foreach}                                    
                                    <p style="clear: both;height:10px;"></p>
                                    