<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
function template_meta_5bee18b436562baad3463f7194eb2e44($t){

return $t->_meta;
}
function template_5bee18b436562baad3463f7194eb2e44($t){
?>									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Nos tarifs 2010</span> 
                                      	</p>          
   										<p style="clear:both">
                                        	<span class="viewTexte">Voicis nos diff&eacute;rents forfaits ainsi que leurs tarifs</span>
										</p>
									</div>
                                    
                                    <?php foreach($t->_vars['toPacks'] as $t->_vars['oPacks']):?>

                                        <?php $t->_vars['iType'] = 0;?>
                                        <?php $t->_vars['zUseCss'] = "";?>
                                
                                        
                                        <?php if($t->_vars['oPacks']->pack_id == 1):?>
                                            <?php $t->_vars['toForfaits'] = $t->_vars['toForfaitVs'];?>
                                            <?php $t->_vars['iType'] = 1;?>
                                            <?php $t->_vars['zUseCss'] = "bloc_forfait_vehicule_split";?>
                                        <?php elseif($t->_vars['oPacks']->pack_id == 2):?>
                                            <?php $t->_vars['toForfaits'] = $t->_vars['toForfaitIs'];?>
                                            <?php $t->_vars['iType'] = 1;?>
                                            <?php $t->_vars['zUseCss'] = "bloc_forfait_immobilier_split";?>
                                        <?php elseif($t->_vars['oPacks']->pack_id == 3):?>
                                            <?php $t->_vars['toForfaits'] = $t->_vars['toForfaitEs'];?>
                                            <?php $t->_vars['iType'] = 1;?>
                                            <?php $t->_vars['zUseCss'] = "bloc_forfait_emploi_split";?>
                                        <?php elseif($t->_vars['oPacks']->pack_id == 5):?>
                                            <?php $t->_vars['toForfaits'] = $t->_vars['toForfaitVis'];?>
                                            <?php $t->_vars['iType'] = 2;?>
                                            <?php $t->_vars['zUseCss'] = "bloc_forfait_visiteur_split";?>
                                        <?php else:?>
                                            <?php $t->_vars['toForfaits'] = $t->_vars['toForfaitAs'];?>
                                            <?php $t->_vars['iType'] = 3;?>
                                            <?php $t->_vars['zUseCss'] = "bloc_forfait_autres";?>
                                        <?php endif;?>
                                        <p style="clear: both;height:20px;"></p>
                                        <ul id="results">
                                            <li class="result result_express">
                                                <div class="result_title">
                                                    <h4><a href="#">PACK <?php echo $t->_vars['oPacks']->pack_libelle; ?></a></h4>
                                                    <div class="clearer"></div>
                                                </div>                                                                   
                                                                
                                                <div class="result_desc">
                                                    <div class="img_photo">
                                                        <a href="#"><img width="180" height="135" border="1" alt="PACK Visiteur" src="<?php echo $t->_vars['j_basepath']; ?>resize/pack/photos/<?php echo $t->_vars['oPacks']->pack_photo; ?>" name="imgPrinc"></a>
                                                    </div>
                                                    <div class="desc_txt">
                                                        <?php if($t->_vars['oPacks']->pack_id == 1):?>
                                                            
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
                                                        <?php elseif($t->_vars['oPacks']->pack_id == 2):?>
                                                            
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
                                                        <?php elseif($t->_vars['oPacks']->pack_id == 3):?>
                                                            
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
                                                        <?php elseif($t->_vars['oPacks']->pack_id == 4):?>
                                                            
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
                                                        <?php else:?>
                                                            
                                                            <h5>Caract&eacute;ristiques</h5>
                                                            <p>Profitez de cette offre pour consulter toutes les annonces du site avec possibilit&eacute; de voir les contacts ou les coordonn&eacute;es des annonceurs. </p>
                                                        <?php endif;?>
                                                        
                                                    </div>
                                                </div>    
                                                <div class="result_foot">
                                                    <ul>
                                                        <p class="regTextPaleNormal borderNoneInline">R&eacute;f&eacute;rence: <strong><?php echo $t->_vars['oPacks']->pack_code; ?>000<?php echo $t->_vars['oPacks']->pack_id; ?></strong></p>
                                                    </ul>
                                                </div>
                                            </li><!-- result end -->
                                                                                                                            
                                        </ul>
    
                                        <br>    
                                        <form id="creditForm" name="creditForm" action="#">
                                        <div id="forfait_paiment">   
                                        <?php $t->_vars['idForfaitChecked'] = 0;?>                                                  
                                        <?php if($t->_vars['iType'] == 1):?>
                                            <h3><?php echo $t->_vars['oPacks']->pack_libelle; ?> - EXPRESS</h3>                                                                
                                            <div class="<?php echo $t->_vars['zUseCss']; ?>" id="box_passepartout">
                                                <div class="bloc_inner">
                                                <div class="bloc_input">
                                                <?php $t->_vars['n']=1;?>                                                  
                                                <?php foreach($t->_vars['toForfaits'] as $t->_vars['oForfait']):?>
                                                    <?php if($t->_vars['n'] == 1):?>
                                                        <?php $t->_vars['checked'] = "checked";?>                                                  
                                                        <?php $t->_vars['idForfaitChecked'] = $t->_vars['oForfait']->forfait_id;?>
                                                    <?php else:?>    
                                                        <?php $t->_vars['checked'] = "";?>                                                  
                                                    <?php endif;?>	
                                                    <input disabled="disabled" type="radio" value="<?php echo $t->_vars['oForfait']->forfait_id; ?>" name="typeForfait" <?php echo $t->_vars['checked']; ?> onclick="selectItem(this);">&nbsp;<?php echo $t->_vars['oForfait']->forfait_libelle; ?> <br>
                                                    <?php $t->_vars['n']++;?>                                                  
                                                <?php endforeach;?>      
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
                                                    <?php $t->_vars['t']=sizeof($t->_vars['toForfaits']);?> 
                                                    <?php $t->_vars['i']=1;?>                                                  
                                                    <?php foreach($t->_vars['toForfaits'] as $t->_vars['oForfait']):?>
                                                        <?php echo jtpl_modifier_common_format_number($t->_vars['oForfait']->forfait_prix,0); ?>
                                                        <?php if($t->_vars['i'] < $t->_vars['t']):?><br><?php endif;?>
                                                        <?php $t->_vars['i']++;?> 
                                                    <?php endforeach;?>      
                                                </div>
                                                </div>
                                                <div class="bloc_foot"></div>
                                            </div>
                                        <?php elseif($t->_vars['iType'] == 2):?>
                                            <h3><?php echo $t->_vars['oPacks']->pack_libelle; ?> PASSE-PARTOUT</h3>                                                                
                                            <div class="<?php echo $t->_vars['zUseCss']; ?>" id="box_passepartout">
                                                <div class="bloc_inner">
                                                <div class="bloc_input">                                            
                                                <?php $t->_vars['n']=1;?>                                                  
                                                <?php foreach($t->_vars['toForfaits'] as $t->_vars['oForfait']):?>
                                                    <?php if($t->_vars['n'] == 1):?>
                                                        <?php $t->_vars['checked'] = "checked";?>                                                  
                                                        <?php $t->_vars['idForfaitChecked'] = $t->_vars['oForfait']->forfait_id;?>
                                                    <?php else:?>    
                                                        <?php $t->_vars['checked'] = "";?>                                                  
                                                    <?php endif;?>	
                                                    <input disabled="disabled" type="radio" value="<?php echo $t->_vars['oForfait']->forfait_id; ?>" name="typeForfait" <?php echo $t->_vars['checked']; ?> onclick="selectItem(this);">&nbsp;<?php echo $t->_vars['oForfait']->forfait_libelle; ?> <br>
                                                    <?php $t->_vars['n']++;?>                                                  
                                                <?php endforeach;?>      
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
                                                    <?php $t->_vars['t']=sizeof($t->_vars['toForfaits']);?> 
                                                    <?php $t->_vars['i']=1;?>                                                  
                                                    <?php foreach($t->_vars['toForfaits'] as $t->_vars['oForfait']):?>
                                                        <?php echo jtpl_modifier_common_format_number($t->_vars['oForfait']->forfait_prix,0); ?>
                                                        <?php if($t->_vars['i'] < $t->_vars['t']):?><br><?php endif;?>
                                                        <?php $t->_vars['i']++;?> 
                                                    <?php endforeach;?>      
                                                </div>
                                                </div>
                                                <div class="bloc_foot"></div>
                                            </div>
                                        <?php else:?>   
                                            <h3><?php echo $t->_vars['oPacks']->pack_libelle; ?></h3>
    
                                            <div id="box_autres_paiment" class="<?php echo $t->_vars['zUseCss']; ?>">
                                                <div class="bloc_inner">
                                                <div class="bloc_input">
                                                    <?php $t->_vars['t']=sizeof($t->_vars['toForfaits']);?> 
                                                    <?php $t->_vars['i']=1;?>
                                                    <?php $t->_vars['n']=1;?>                                                  
                                                    <?php foreach($t->_vars['toForfaits'] as $t->_vars['oForfait']):?>
                                                        <?php if($t->_vars['i'] == 1):?>
                                                            <p>
                                                        <?php endif;?>	
                                                        <?php if($t->_vars['n'] == 1):?>
                                                            <?php $t->_vars['checked'] = "checked";?>                                                  
                                                            <?php $t->_vars['idForfaitChecked'] = $t->_vars['oForfait']->forfait_id;?>
                                                        <?php else:?>    
                                                            <?php $t->_vars['checked'] = "";?>                                                  
                                                        <?php endif;?>	
                                                        <input disabled="disabled" type="radio" name="typeForfait" value="<?php echo $t->_vars['oForfait']->forfait_id; ?>" <?php echo $t->_vars['checked']; ?> onclick="selectItem(this);">&nbsp;
                                                        <?php if($t->_vars['i'] == 1 && $t->_vars['n'] != $t->_vars['t']):?><br><?php endif;?>                                                    
                                                        <?php if($t->_vars['i'] == 1 && $t->_vars['n'] == $t->_vars['t']):?></p><?php endif;?>                                                    
                                                        <?php if($t->_vars['i'] == 2):?>
                                                            </p>
                                                            <?php $t->_vars['i'] = 0;?> 
                                                        <?php endif;?>	
                                                        <?php $t->_vars['i']++;?> 
                                                        <?php $t->_vars['n']++;?> 
                                                    <?php endforeach;?>      
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
                                                    <?php $t->_vars['t']=sizeof($t->_vars['toForfaits']);?> 
                                                    <?php $t->_vars['i']=1;?>
                                                    <?php $t->_vars['n']=1;?>                                                  
                                                    <?php foreach($t->_vars['toForfaits'] as $t->_vars['oForfait']):?>
                                                        <?php $t->_vars['forfaitPrix'] = $t->_vars['oForfait']->forfait_prix + $t->_vars['oForfait']->forfait_prixPlus;?>
                                                        <?php if($t->_vars['i'] == 1):?>
                                                            <p>
                                                        <?php endif;?>	
                                                        <?php echo jtpl_modifier_common_format_number($t->_vars['forfaitPrix'], 0, ",", ' ','Ar'); ?>                                                    
                                                        <?php if($t->_vars['i'] == 1 && $t->_vars['n'] != $t->_vars['t']):?><br><?php endif;?>                                                    
                                                        <?php if($t->_vars['i'] == 1 && $t->_vars['n'] == $t->_vars['t']):?></p><?php endif;?>                                                    
                                                        <?php if($t->_vars['i'] == 2):?>
                                                            </p>
                                                            <?php $t->_vars['i'] = 0;?> 
                                                        <?php endif;?>	
                                                        <?php $t->_vars['i']++;?> 
                                                        <?php $t->_vars['n']++;?> 
                                                    <?php endforeach;?>      
                                                </div>
                                                </div>
                                                <div class="bloc_foot"></div>
                                            </div>
    
                                        <?php endif;?>                                        
                                        </div>
                                        <p style="clear: both;height:10px;"></p>
                                        </form>
									<?php endforeach;?>                                    
                                    <p style="clear: both;height:10px;"></p>
                                    <?php 
}
?>