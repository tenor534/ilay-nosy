                                    <div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Ajouter un nouvel abonnement</span> 
                                      	</p>          
   										<p style="clear:both">
		                                    {assign $nbPack = sizeof($toPacks)}    
                                        	<span class="viewTexte">Cliquez sur un des {$nbPack} PACKS afin de vous procurer le forfait appropri&eacute;.</span> 
                                        </p>
 									</div>
								    <p class="return">
                                   		<a href="{jurl 'abonnement~abonnementFo_abonnementList'}">Retour &agrave; la liste de vos abonnements</a>                                    
                                    </p>                                    
									<ul id="results">
									{foreach $toPacks as $oPack}
                                        {assign $tPost= array('pid'=> $oPack->pack_id)}
                                        <li class="result result_express">
                                            <div class="result_title">
                                                <h4><a href="{jurl 'abonnement~abonnementFo_abonnementForfaitList', $tPost}">PACK {$oPack->pack_libelle}</a></h4>
                                                <div class="clearer"></div>
                                            </div>                                        
                                            <div class="result_desc">
                                                <div class="img_photo">
                                                    <a href="{jurl 'abonnement~abonnementFo_abonnementForfaitList', $tPost}"><img width="180" height="135" border="1" alt="PACK Visiteur" src="{$j_basepath}resize/pack/photos/{$oPack->pack_photo}" name="imgPrinc"></a>
                                                </div>
                                                <div class="desc_txt">
                                                    {if $oPack->pack_id == 1}
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
                                                    {elseif $oPack->pack_id == 2}
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
                                                    {elseif $oPack->pack_id == 3}
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
                                                    {elseif $oPack->pack_id == 4}
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
                                                    <p class="regTextPaleNormal borderNoneInline">R&eacute;f&eacute;rence: <strong>{$oPack->pack_code}000{$oPack->pack_id}</strong></p>
                                                    <li class="borderLeftInline">                                                    
                                                        <a class="hotTopics" href="{jurl 'abonnement~abonnementFo_abonnementForfaitList', $tPost}">Choisir ce PACK</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li><!-- result end -->
									{/foreach}	
                                    </ul>