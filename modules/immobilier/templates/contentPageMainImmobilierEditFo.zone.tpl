<input type="hidden" id="immobilier_id" name="immobilier_id" value="{$immobilier->immobilier_id}">
<input type="hidden" id="immobilier_annonceId" name="immobilier_annonceId" value="{$immobilier->immobilier_annonceId}">

<div class="box_inner box_annonce_carac">
    <h4>Caract&eacute;ristiques</h4>
    <div class="info_list box_end">
        <div class="info_list">
            <div class="float">
                <dl>
                    <dt>Type propri&eacute;t&eacute;&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="immobilier_typePropriete" id="immobilier_typePropriete"  tmt:invalidvalue="-1">			
                            <option value="0">Type de propri&eacute;t&eacute;:</option>
                            <option value="1" {if $immobilier->immobilier_typePropriete == 1}selected{/if}>Condominium et Appartement</option> 
                            <option value="2" {if $immobilier->immobilier_typePropriete == 2}selected{/if}>Bungalow</option> 
                            <option value="3" {if $immobilier->immobilier_typePropriete == 3}selected{/if}>Maison &agrave; &eacute;tages</option> 
                            <option value="4" {if $immobilier->immobilier_typePropriete == 4}selected{/if}>Duplex</option> 
                            <option value="5" {if $immobilier->immobilier_typePropriete == 5}selected{/if}>Triplex</option> 
                            <option value="6" {if $immobilier->immobilier_typePropriete == 6}selected{/if}>Quadruplex</option> 
                            <option value="7" {if $immobilier->immobilier_typePropriete == 7}selected{/if}>Quintuplex</option> 
                            <option value="8" {if $immobilier->immobilier_typePropriete == 8}selected{/if}>Ferme et Fermette</option> 
                            <option value="9" {if $immobilier->immobilier_typePropriete == 9}selected{/if}>Maison mobile</option> 
                            <option value="10" {if $immobilier->immobilier_typePropriete == 10}selected{/if}>Multi-logements</option> 
                            <option value="11" {if $immobilier->immobilier_typePropriete == 11}selected{/if}>Propriét&eacute; commercial &agrave; vendre</option> 
                            <option value="12" {if $immobilier->immobilier_typePropriete == 12}selected{/if}>Split-Level</option> 
                            <option value="13" {if $immobilier->immobilier_typePropriete == 13}selected{/if}>Terrain</option> 
                            <option value="14" {if $immobilier->immobilier_typePropriete == 14}selected{/if}>Loft et Studio</option> 
                            <option value="15" {if $immobilier->immobilier_typePropriete == 15}selected{/if}>6 logements</option> 
                            <option value="16" {if $immobilier->immobilier_typePropriete == 16}selected{/if}>Location commerciale et industrielle</option>                            
                            <option value="17" {if $immobilier->immobilier_typePropriete == 17}selected{/if}>Villa basse</option>                            
                        </select>  
                        ² 
                    </dd>
                </dl>
            </div>
            
            <div class="float">
                <dl>
                    <dt>Type batiment&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="immobilier_typeBatiment" id="immobilier_typeBatiment"  tmt:invalidvalue="-1">			
                            <option value="0">Type de bat&icirc;ment:</option>
                            <option value="1" {if $immobilier->immobilier_typeBatiment == 1}selected{/if}>Isol&eacute;</option>  
                            <option value="2" {if $immobilier->immobilier_typeBatiment == 2}selected{/if}>Jumel&eacute;</option>  
                            <option value="3" {if $immobilier->immobilier_typeBatiment == 3}selected{/if}>Quadrex</option>  
                            <option value="4" {if $immobilier->immobilier_typeBatiment == 4}selected{/if}>En rang&eacute;e</option>
                        </select>
                    </dd>
                </dl>
            </div>
        </div>

        <div class="clearer"></div>                                                            

        <div class="info_list more_info">
            <dl>
                <dt>Nombre de chambres&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_nbChambre" name="immobilier_nbChambre" value="{$immobilier->immobilier_nbChambre}" tmt:filters="" maxlength="250">
          	    </dd>
        	</dl>
            <dl>
                <dt>Construction&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_construction" name="immobilier_construction" value="{$immobilier->immobilier_construction}" tmt:filters="" maxlength="250">
          	    </dd>
        	</dl>
        </div>

	    <div class="clearer"></div>
        <div class="info_list more_info">
            <dl>
                <dt>Nom du cadastre&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_nbChambre" name="immobilier_nomCadastre" value="{$immobilier->immobilier_nomCadastre}" tmt:filters="" maxlength="250">
          	    </dd>
        	</dl>
            <dl>
                <dt>Certificat de localisation&nbsp;:</dt>
                <dd>
                    <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_certificatLocalisation" id="immobilier_certificatLocalisation"  tmt:invalidvalue="-1">			
                        <option value="0">Certificat de localisation:</option>    
                        <option value="1" {if $immobilier->immobilier_certificatLocalisation == 1}selected{/if}>OUI</option>
                        <option value="2" {if $immobilier->immobilier_certificatLocalisation == 2}selected{/if}>NON</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Certificat ann&eacute;e&nbsp;:</dt>
                <dd>
                    <input style="width:44px;" class="user_input1" type="text" id="immobilier_certificatAnnee" name="immobilier_certificatAnnee" value="{$immobilier->immobilier_certificatAnnee}" tmt:filters="" maxlength="4">
          	    </dd>
        	</dl>
        </div>
	</div>    
    
	<div class="clearer"></div>
    <h4>Options suppl&eacute;mentaires</h4>
    <div class="info_list box_end">
        <div class="info_list">
            <div class="float">
                <dl>
                    <dt>Foyer&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_foyer" id="immobilier_foyer"  tmt:invalidvalue="-1">			
                            <option value="0">Foyer:</option>    
                            <option value="1" {if $immobilier->immobilier_foyer == 1}selected{/if}>OUI</option>
                            <option value="2" {if $immobilier->immobilier_foyer == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Piscine&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_piscine" id="immobilier_piscine"  tmt:invalidvalue="-1">			
                            <option value="0">Piscine:</option>    
                            <option value="1" {if $immobilier->immobilier_piscine == 1}selected{/if}>OUI</option>
                            <option value="2" {if $immobilier->immobilier_piscine == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Berge / Rive&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_bergeRive" id="immobilier_bergeRive"  tmt:invalidvalue="-1">			
                            <option value="0">Berge / Rive:</option>    
                            <option value="1" {if $immobilier->immobilier_bergeRive == 1}selected{/if}>OUI</option>
                            <option value="2" {if $immobilier->immobilier_bergeRive == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Panorama&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_panorama" id="immobilier_panorama"  tmt:invalidvalue="-1">			
                            <option value="0">Panorama:</option>    
                            <option value="1" {if $immobilier->immobilier_panorama == 1}selected{/if}>OUI</option>
                            <option value="2" {if $immobilier->immobilier_panorama == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Garage&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_garage" id="immobilier_garage"  tmt:invalidvalue="-1">			
                            <option value="0">Garage:</option>    
                            <option value="1" {if $immobilier->immobilier_garage == 1}selected{/if}>OUI</option>
                            <option value="2" {if $immobilier->immobilier_garage == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
                
            </div>
            <div class="float">
                <dl>
                    <dt>Assenceur&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_ascenceur" id="immobilier_ascenceur"  tmt:invalidvalue="-1">			
                            <option value="0">Assenceur:</option>    
                            <option value="1" {if $immobilier->immobilier_ascenceur == 1}selected{/if}>OUI</option>
                            <option value="2" {if $immobilier->immobilier_ascenceur == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Climatisation&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_climatisation" id="immobilier_climatisation"  tmt:invalidvalue="-1">			
                            <option value="0">Climatisation:</option>    
                            <option value="1" {if $immobilier->immobilier_climatisation == 1}selected{/if}>OUI</option>
                            <option value="2" {if $immobilier->immobilier_climatisation == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Thermopompe&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_thermopompe" id="immobilier_thermopompe"  tmt:invalidvalue="-1">			
                            <option value="0">Thermopompe:</option>    
                            <option value="1" {if $immobilier->immobilier_thermopompe == 1}selected{/if}>OUI</option>
                            <option value="2" {if $immobilier->immobilier_thermopompe == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Sous-sol am&eacute;nag&eacute;&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_sousSolAmenage" id="immobilier_sousSolAmenage"  tmt:invalidvalue="-1">			
                            <option value="0">Sous-sol am&eacute;nag&eacute;:</option>    
                            <option value="1" {if $immobilier->immobilier_sousSolAmenage == 1}selected{/if}>OUI</option>
                            <option value="2" {if $immobilier->immobilier_sousSolAmenage == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
            </div>
        </div>
     </div> 
	<div class="clearer"></div>
    <h4>Informations / Evaluations</h4>
    <div class="info_list box_end">

        <div class="info_list more_info">
        
            <dl>
                <dt>Vente par&nbsp;:</dt>
                <dd>
                    <input style="width:188px;" class="user_input1" type="text" id="immobilier_ventePar" name="immobilier_ventePar" value="{$immobilier->immobilier_ventePar}" tmt:filters="" maxlength="100">
                </dd>
            </dl>
            <dl>
                <dt>Date occupation&nbsp;:</dt>
                <dd>
                    <input class="user_input3" type="text" id="utilisateur_dateNaissance" name="immobilier_dateOccupation" value="{$immobilier->immobilier_dateOccupation|date_format:'%d/%m/%Y'}" tmt:datepattern="DD/MM/YYYY" maxlength="10">
                    &nbsp;
                    ( jj/mm/aaaa )
                </dd>
            </dl>        
            <dl>
                <dt>Adresse&nbsp;:</dt>
                <dd>
                    <input style="width:188px;" class="user_input1" type="text" id="immobilier_adresse" name="immobilier_adresse" value="{$immobilier->immobilier_adresse}" tmt:filters="" maxlength="100">                                                                                                                                        
                </dd>
            </dl>
            <dl>
                <dt>Code Postal:</dt>
                <dd>
                    <input class="user_input5" type="text" id="immobilier_cp" name="immobilier_cp" value="" tmt:pattern="number" value="{$immobilier->immobilier_cp}" tmt:filters="" maxlength="5" >
                    &nbsp;
                    ( 00101 )
                </dd>
            </dl>
    
            <dl>
                <dt>Dimension du terrain&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_terrainDimension" name="immobilier_terrainDimension" value="{$immobilier->immobilier_terrainDimension}" tmt:filters="" maxlength="100">
                </dd>
            </dl>
            <dl>
                <dt>Superficie du terrain&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_terrainSuperficie" name="immobilier_terrainSuperficie" value="{$immobilier->immobilier_terrainSuperficie}" tmt:filters="" maxlength="100">
                </dd>
            </dl>
            <dl>
                <dt>Bat&icirc;ment dimension&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_batimentDimension" name="immobilier_batimentDimension" value="{$immobilier->immobilier_batimentDimension}" tmt:filters="" maxlength="100">
                </dd>
            </dl>
            <dl>
                <dt>Superficie habitable&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_superficieHabitable" name="immobilier_superficieHabitable" value="{$immobilier->immobilier_superficieHabitable}" tmt:filters="" maxlength="100">
                </dd>
            </dl>
            <dl>
                <dt>Evaluation disponible&nbsp;:</dt>
                <dd>
                    <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_evaluationDisponible" id="immobilier_evaluationDisponible"  tmt:invalidvalue="-1">			
                        <option value="0">Evaluation disponible:</option>    
                        <option value="1" {if $immobilier->immobilier_evaluationDisponible == 1}selected{/if}>OUI</option>
                        <option value="2" {if $immobilier->immobilier_evaluationDisponible == 2}selected{/if}>NON</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Evaluation en ann&eacute;e&nbsp;:</dt>
                <dd>
                    <input style="width:44px;" class="user_input1" type="text" id="immobilier_evaluationAnnee" name="immobilier_evaluationAnnee" value="{$immobilier->immobilier_evaluationAnnee}" tmt:filters="" maxlength="4">
                </dd>
            </dl>
            <dl>
                <dt>Evaluation du bat&icirc;ment&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_evaluationBatiment" name="immobilier_evaluationBatiment" value="{$immobilier->immobilier_evaluationBatiment}" tmt:filters="" maxlength="100">
                </dd>
            </dl>
            <dl>
                <dt>Evaluation du terrain&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_evaluationTerrain" name="immobilier_evaluationTerrain" value="{$immobilier->immobilier_evaluationTerrain}" tmt:filters="" maxlength="100">
                </dd>
            </dl>
            <dl>
                <dt>Evaluation totale&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_evaluationTotale" name="immobilier_evaluationTotale" value="{$immobilier->immobilier_evaluationTotale}" tmt:filters="" maxlength="100">
                </dd>
            </dl>
    
         </div> 
	</div>
    	
	<div class="clearer"></div>
    <h4>Informations financi&egrave;res</h4>
    <div class="info_list box_end">
    
        <div class="info_list more_info">  
            <dl>
                <dt>Bail&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_bail" name="immobilier_bail" value="{$immobilier->immobilier_bail}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
        </div>
            
	    <h3>TAXES</h3>
        <div class="info_list more_info">  
    
            <dl>
                <dt>Taxe scolaire&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_taxeScolaire" name="immobilier_taxeScolaire" value="{$immobilier->immobilier_taxeScolaire}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Taxe municipale&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_taxeMunicipal" name="immobilier_taxeMunicipal" value="{$immobilier->immobilier_taxeMunicipal}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Taxe annuelle&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_taxeAnnuelle" name="immobilier_taxeAnnuelle" value="{$immobilier->immobilier_taxeAnnuelle}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
        </div>    

	    <h3>REVENUS</h3>
		<div class="info_list more_info">  

            <dl>
                <dt>Revenu annuel&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_revenuAnnuel" name="immobilier_revenuAnnuel" value="{$immobilier->immobilier_revenuAnnuel}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Location du logement&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_locationLogement" name="immobilier_locationLogement" value="{$immobilier->immobilier_locationLogement}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
        </div>    

	    <h3>DEPENSES</h3>
		<div class="info_list more_info">  
            <dl>
                <dt>Assurance&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_assurance" name="immobilier_assurance" value="{$immobilier->immobilier_assurance}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Chauffage&nbsp;:</dt>
                <dd>
                    <select style="width:100px;" class="user_input1 user_input_select input_middle" name="immobilier_chauffage" id="immobilier_chauffage"  tmt:invalidvalue="-1">			
                        <option value="0">Evaluation disponible:</option>    
                        <option value="1" {if $immobilier->immobilier_chauffage == 1}selected{/if}>OUI</option>
                        <option value="2" {if $immobilier->immobilier_chauffage == 2}selected{/if}>NON</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Combustible / Chauffage&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_combustibleChauffage" name="immobilier_combustibleChauffage" value="{$immobilier->immobilier_combustibleChauffage}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Electricit&eacute;&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_electricite" name="immobilier_electricite" value="{$immobilier->immobilier_electricite}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Frais partag&eacute;s&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_fraisPartages" name="immobilier_fraisPartages" value="{$immobilier->immobilier_fraisPartages}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
    	</div>

	</div>
	<div class="clearer"></div>
    <h4>Description de pi&egrave;ces</h4>
    <div class="info_list box_end">
		<div class="info_list more_info">  
            
            <dl>
                <dt>Inclusion&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_inclusion" name="immobilier_inclusion" value="{$immobilier->immobilier_inclusion}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Exclusion&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_exclusion" name="immobilier_exclusion" value="{$immobilier->immobilier_exclusion}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Nombre de pi&egrave;ces&nbsp;:</dt>
                <dd>
					<input style="width:20px;" class="user_input1" type="text" id="immobilier_nbPiece" name="immobilier_nbPiece" value="{$immobilier->immobilier_nbPiece}" tmt:pattern="number" tmt:filters="" maxlength="2">
                </dd>
            </dl>
            <dl>
                <dt>Nombre salle de bain&nbsp;:</dt>
                <dd>
					<input style="width:20px;" class="user_input1" type="text" id="immobilier_nbSalleBain" name="immobilier_nbSalleBain" value="{$immobilier->immobilier_nbSalleBain}" tmt:pattern="number" tmt:filters="" maxlength="2">
                </dd>
            </dl>
            <dl>
                <dt>Nombre salle d'eau&nbsp;:</dt>
                <dd>
					<input style="width:20px;" class="user_input1" type="text" id="immobilier_nbSalleEau" name="immobilier_nbSalleEau" value="{$immobilier->immobilier_nbSalleEau}" tmt:pattern="number" tmt:filters="" maxlength="2">
                </dd>
            </dl>
            <dl>
                <dt>Hall d'entr&eacute;e&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_hallEntree" name="immobilier_hallEntree" value="{$immobilier->immobilier_hallEntree}" tmt:filters="" maxlength="150">
                </dd>
            </dl>

            <dl>
                <dt>Salle familiale&nbsp;:</dt>
                <dd>
                    <textarea style="width:448px;height:60px;" class="user_input_select1" id="immobilier_salleFamilliale" name="immobilier_salleFamilliale" rows="5" tmt:filters="" >{$immobilier->immobilier_salleFamilliale}</textarea>				
                </dd>
            </dl>
            <dl>
                <dt>Cuisine&nbsp;:</dt>
                <dd>
                    <textarea style="width:448px;height:60px;" class="user_input_select1" id="immobilier_cuisine" name="immobilier_cuisine" rows="5" tmt:filters="" >{$immobilier->immobilier_cuisine}</textarea>				
                </dd>
            </dl>
            <dl>
                <dt>Salle &agrave; manger&nbsp;:</dt>
                <dd>
                    <textarea style="width:448px;height:60px;" class="user_input_select1" id="immobilier_salleManger" name="immobilier_salleManger" rows="5" tmt:filters="" >{$immobilier->immobilier_salleManger}</textarea>				
                </dd>
            </dl>
            <dl>
                <dt>Salle d'eau&nbsp;:</dt>
                <dd>
                    <textarea style="width:448px;height:60px;" class="user_input_select1" id="immobilier_salleEau" name="immobilier_salleEau" rows="5" tmt:filters="" >{$immobilier->immobilier_salleEau}</textarea>				
                </dd>
            </dl>
            <dl>
                <dt>Salle de bain&nbsp;:</dt>
                <dd>
                    <textarea style="width:448px;height:60px;" class="user_input_select1" id="immobilier_salleBain" name="immobilier_salleBain" rows="5" tmt:filters="" >{$immobilier->immobilier_salleBain}</textarea>				
                </dd>
            </dl>
            <dl>
                <dt>Salon&nbsp;:</dt>
                <dd>
                    <textarea style="width:448px;height:60px;" class="user_input_select1" id="immobilier_salon" name="immobilier_salon" rows="5" tmt:filters="" >{$immobilier->immobilier_salon}</textarea>				
                </dd>
            </dl>
            <dl>
                <dt>Chambre principale&nbsp;:</dt>
                <dd>
                    <textarea style="width:448px;height:60px;" class="user_input_select1" id="immobilier_chambrePrincipale" name="immobilier_chambrePrincipale" rows="5" tmt:filters="" >{$immobilier->immobilier_chambrePrincipale}</textarea>				
                </dd>
            </dl>
            <dl>
                <dt>Rangement &nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_rangement" name="immobilier_rangement" value="{$immobilier->immobilier_rangement}" tmt:filters="" maxlength="150">
                </dd>
            </dl>

        </div>    

	    <h3>AUTRES CHAMBRES</h3>
		<div class="info_list more_info">  
            <dl>
                <dt>Chambre 1&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_chambreAutre1" name="immobilier_chambreAutre1" value="{$immobilier->immobilier_chambreAutre1}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Chambre 2&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_chambreAutre2" name="immobilier_chambreAutre2" value="{$immobilier->immobilier_chambreAutre2}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Chambre 3&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_chambreAutre3" name="immobilier_chambreAutre3" value="{$immobilier->immobilier_chambreAutre3}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Chambre 4&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_chambreAutre4" name="immobilier_chambreAutre4" value="{$immobilier->immobilier_chambreAutre4}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Chambre 5&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_chambreAutre5" name="immobilier_chambreAutre5" value="{$immobilier->immobilier_chambreAutre5}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Chambre 6&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_chambreAutre6" name="immobilier_chambreAutre6" value="{$immobilier->immobilier_chambreAutre6}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Chambre 7&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_chambreAutre7" name="immobilier_chambreAutre7" value="{$immobilier->immobilier_chambreAutre7}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Chambre 8&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_chambreAutre8" name="immobilier_chambreAutre8" value="{$immobilier->immobilier_chambreAutre8}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Chambre 9&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_chambreAutre9" name="immobilier_chambreAutre9" value="{$immobilier->immobilier_chambreAutre9}" tmt:filters="" maxlength="150">
                </dd>
            </dl>
            <dl>
                <dt>Chambre 10&nbsp;:</dt>
                <dd>
                    <input style="width:448px;" class="user_input1" type="text" id="immobilier_chambreAutre10" name="immobilier_chambreAutre10" value="{$immobilier->immobilier_chambreAutre10}" tmt:filters="" maxlength="150">
                </dd>
            </dl>


        </div>
 	</div>       

</div>