<div class="box_inner box_annonce_carac">
    <h4>Caract&eacute;ristiques</h4>
    <div class="info_list box_end">
        <div class="info_list">
            <div class="float">
                <dl>
                    <dt>Type propri&eacute;t&eacute;&nbsp;:</dt>
                    <dd>
                        {if $immobilier->immobilier_typePropriete == 0}N/D{/if} 
                        {if $immobilier->immobilier_typePropriete == 1}Condominium et Appartement{/if} 
                        {if $immobilier->immobilier_typePropriete == 2}Bungalow{/if} 
                        {if $immobilier->immobilier_typePropriete == 3}Maison &agrave; &eacute;tages{/if} 
                        {if $immobilier->immobilier_typePropriete == 4}Duplex{/if} 
                        {if $immobilier->immobilier_typePropriete == 5}Triplex{/if} 
                        {if $immobilier->immobilier_typePropriete == 6}Quadruplex{/if} 
                        {if $immobilier->immobilier_typePropriete == 7}Quintuplex{/if} 
                        {if $immobilier->immobilier_typePropriete == 8}Ferme et Fermette{/if} 
                        {if $immobilier->immobilier_typePropriete == 9}Maison mobile{/if} 
                        {if $immobilier->immobilier_typePropriete == 10}Multi-logements{/if} 
                        {if $immobilier->immobilier_typePropriete == 11}Propriét&eacute; commercial &agrave; vendre{/if} 
                        {if $immobilier->immobilier_typePropriete == 12}Split-Level{/if} 
                        {if $immobilier->immobilier_typePropriete == 13}Terrain{/if} 
                        {if $immobilier->immobilier_typePropriete == 14}Loft et Studio{/if} 
                        {if $immobilier->immobilier_typePropriete == 15}6 logements{/if} 
                        {if $immobilier->immobilier_typePropriete == 16}Location commerciale et industrielle{/if}                            
                        {if $immobilier->immobilier_typePropriete == 17}Villa basse{/if}                            
                    </dd>
                </dl>
            </div>
            
            <div class="float">
                <dl>
                    <dt>Type batiment&nbsp;:</dt>
                    <dd>
                        {if $immobilier->immobilier_typeBatiment == 0}N/D{/if} 
                        {if $immobilier->immobilier_typeBatiment == 1}Isol&eacute;{/if}  
                        {if $immobilier->immobilier_typeBatiment == 2}Jumel&eacute;{/if}  
                        {if $immobilier->immobilier_typeBatiment == 3}Quadrex{/if}  
                        {if $immobilier->immobilier_typeBatiment == 4}En rang&eacute;e{/if}
                    </dd>
                </dl>
            </div>
        </div>

        <div class="clearer"></div>                                                            

        <div class="info_list more_info">
            {if strlen($immobilier->immobilier_nbChambre) != 0}
            <dl>
                <dt>Nombre de chambres&nbsp;:</dt>
                <dd>
	                {$immobilier->immobilier_nbChambre}
          	    </dd>
        	</dl>
            {/if}
            {if strlen($immobilier->immobilier_construction) != 0}
            <dl>
                <dt>Construction&nbsp;:</dt>
                <dd>
	                {$immobilier->immobilier_construction}
          	    </dd>
        	</dl>
            {/if}
        </div>

	    <div class="clearer"></div>
        <div class="info_list more_info">
            {if strlen($immobilier->immobilier_nomCadastre) != 0}
            <dl>
                <dt>Nom du cadastre&nbsp;:</dt>
                <dd>
	                {$immobilier->immobilier_nomCadastre}
          	    </dd>
        	</dl>
            {/if}
            {if $immobilier->immobilier_certificatLocalisation != 0}
            <dl>
                <dt>Certificat de localisation&nbsp;:</dt>
                <dd>
                    {if $immobilier->immobilier_certificatLocalisation == 1}OUI{/if}
                	{if $immobilier->immobilier_certificatLocalisation == 2}NON{/if}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_certificatAnnee) != 0}
            <dl>
                <dt>Certificat ann&eacute;e&nbsp;:</dt>
                <dd>
	                {$immobilier->immobilier_certificatAnnee}
          	    </dd>
        	</dl>
            {/if}
        </div>
	</div>    
    
	<div class="clearer"></div>
    <h4>Options suppl&eacute;mentaires</h4>

        
    <table class="tbl_results">
    <thead>
        <tr>
            <th scope="col">Foyer</th>
            <th scope="col">Piscine</th>
            <th scope="col">Berge / Rive</th>
            <th scope="col">Panorama</th>
            <th class="last" scope="col">Garage</th>
        </tr>
    </thead>
    <tbody>
        <tr class="tbl_header_foot">
            <td></td>
            <td class="last" colspan="5"></td>
        </tr>
        <tr>
            <td>{$immobilier->immobilier_foyer}</td>
            <td>{$immobilier->immobilier_piscine}</td>
            <td>{$immobilier->immobilier_bergeRive}</td>
            <td>{$immobilier->immobilier_panorama}</td>
            <td class="last">{$immobilier->immobilier_garage}</td>
        </tr>
    </tbody>
    </table>
    
    <table class="tbl_results">
    <thead>
        <tr>
            <th scope="col">Assenceur</th>
            <th scope="col">Climatisation</th>
            <th scope="col">Thermopompe</th>
            <th class="last" scope="col">Sous-sol am&eacute;nag&eacute;</th>
        </tr>
    </thead>
    <tbody>
        <tr class="tbl_header_foot">
            <td></td>
            <td class="last" colspan="5"></td>
        </tr>
        <tr>
            <td>{$immobilier->immobilier_ascenceur}</td>
            <td>{$immobilier->immobilier_climatisation}</td>
            <td>{$immobilier->immobilier_thermopompe}</td>
            <td class="last">{$immobilier->immobilier_sousSolAmenage}</td>
        </tr>
    </tbody>
    </table>

                                                        
	<div class="clearer"></div>
    <h4>Informations / Evaluations</h4>
    <div class="info_list box_end">

        <div class="info_list more_info">
        
            {if  strlen($immobilier->immobilier_ventePar) != 0}
            <dl>
                <dt>Vente par&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_ventePar}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_dateOccupation) != 0}
            <dl>
                <dt>Date occupation&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_dateOccupation|date_format:"%d/%m/%Y"}
                </dd>
            </dl>        
            {/if}
            {if  strlen($immobilier->immobilier_adresse) != 0}
            <dl>
                <dt>Adresse&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_adresse}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_cp) != 0}
            <dl>
                <dt>Code Postal:</dt>
                <dd>
					{$immobilier->immobilier_cp}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_terrainDimension) != 0}    
            <dl>
                <dt>Dimension du terrain&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_terrainDimension}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_terrainSuperficie) != 0}
            <dl>
                <dt>Superficie du terrain&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_terrainSuperficie}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_batimentDimension) != 0}
            <dl>
                <dt>Bat&icirc;ment dimension&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_batimentDimension}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_superficieHabitable) != 0}
            <dl>
                <dt>Superficie habitable&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_superficieHabitable}
                </dd>
            </dl>
            {/if}
            {if  $immobilier->immobilier_evaluationDisponible != 0}
            <dl>
                <dt>Evaluation disponible&nbsp;:</dt>
                <dd>
                    {if $immobilier->immobilier_evaluationDisponible == 0}N/D{/if}
                    {if $immobilier->immobilier_evaluationDisponible == 1}OUI{/if}
                    {if $immobilier->immobilier_evaluationDisponible == 2}NON{/if}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_evaluationAnnee) != 0}
            <dl>
                <dt>Evaluation en ann&eacute;e&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_evaluationAnnee}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_evaluationBatiment) != 0}
            <dl>
                <dt>Evaluation du bat&icirc;ment&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_evaluationBatiment}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_evaluationTerrain) != 0}
            <dl>
                <dt>Evaluation du terrain&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_evaluationTerrain}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_evaluationTotale) != 0}
            <dl>
                <dt>Evaluation totale&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_evaluationTotale}
                </dd>
            </dl>
            {/if}
    
         </div> 
	</div>
    	
    {if  strlen($immobilier->immobilier_bail) || strlen($immobilier->immobilier_taxeScolaire) || strlen($immobilier->immobilier_taxeMunicipal) || strlen($immobilier->immobilier_taxeAnnuelle) || strlen($immobilier->immobilier_revenuAnnuel) || strlen($immobilier->immobilier_locationLogement) || strlen($immobilier->immobilier_assurance) || $immobilier->immobilier_chauffage || strlen($immobilier->immobilier_combustibleChauffage) || strlen($immobilier->immobilier_electricite) || strlen($immobilier->immobilier_fraisPartages)}
	<div class="clearer"></div>
    <h4>Informations financi&egrave;res</h4>
    <div class="info_list box_end">
    
        {if  strlen($immobilier->immobilier_bail) != 0}
        <div class="info_list more_info">
            <dl>
                <dt>Bail&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_bail}
                </dd>
            </dl>
        </div>
        {/if}
           
        {if  strlen($immobilier->immobilier_taxeScolaire) || strlen($immobilier->immobilier_taxeMunicipal) || strlen($immobilier->immobilier_taxeAnnuelle)}
	    <h3>TAXES</h3>
        <div class="info_list more_info">
    
            {if  strlen($immobilier->immobilier_taxeScolaire) != 0}
            <dl>
                <dt>Taxe scolaire&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_taxeScolaire}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_taxeMunicipal) != 0}
            <dl>
                <dt>Taxe municipale&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_taxeMunicipal}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_taxeAnnuelle) != 0}
            <dl>
                <dt>Taxe annuelle&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_taxeAnnuelle}
                </dd>
            </dl>
            {/if}
        </div>    
        {/if}

        {if  strlen($immobilier->immobilier_revenuAnnuel) || strlen($immobilier->immobilier_locationLogement)}
	    <h3>REVENUS</h3>
		<div class="info_list more_info">  

            {if  strlen($immobilier->immobilier_revenuAnnuel) != 0}
            <dl>
                <dt>Revenu annuel&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_revenuAnnuel}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_locationLogement) != 0}
            <dl>
                <dt>Location du logement&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_locationLogement}
                </dd>
            </dl>
            {/if}
        </div>    
        {/if}

        {if  strlen($immobilier->immobilier_assurance) || $immobilier->immobilier_chauffage || strlen($immobilier->immobilier_combustibleChauffage) || strlen($immobilier->immobilier_electricite) || strlen($immobilier->immobilier_fraisPartages)}
	    <h3>DEPENSES</h3>
		<div class="info_list more_info">  
            {if  strlen($immobilier->immobilier_assurance) != 0}
            <dl>
                <dt>Assurance&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_assurance}
                </dd>
            </dl>
            {/if}
            {if  $immobilier->immobilier_chauffage != 0}
            <dl>
                <dt>Chauffage&nbsp;:</dt>
                <dd>
                    {if $immobilier->immobilier_chauffage == 0}N/D{/if}
                    {if $immobilier->immobilier_chauffage == 1}OUI{/if}
                	{if $immobilier->immobilier_chauffage == 2}NON{/if}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_combustibleChauffage) != 0}
            <dl>
                <dt>Combustible / Chauffage&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_combustibleChauffage}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_electricite) != 0}
            <dl>
                <dt>Electricit&eacute;&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_electricite}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_fraisPartages) != 0}
            <dl>
                <dt>Frais partag&eacute;s&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_fraisPartages}
                </dd>
            </dl>
            {/if}
    	</div>
       {/if}

	</div>
    {/if}
	<div class="clearer"></div>
    <h4>Description de pi&egrave;ces</h4>
    <div class="info_list box_end">
		<div class="info_list more_info">              
            {if  strlen($immobilier->immobilier_inclusion) != 0}
            <dl>
                <dt>Inclusion&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_inclusion}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_exclusion) != 0}
            <dl>
                <dt>Exclusion&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_exclusion}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_nbPiece) != 0}
            <dl>
                <dt>Nombre de pi&egrave;ces&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_nbPiece}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_nbSalleBain) != 0}
            <dl>
                <dt>Nombre salle de bain&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_nbSalleBain}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_nbSalleEau) != 0}
            <dl>
                <dt>Nombre salle d'eau&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_nbSalleEau}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_hallEntree) != 0}
            <dl>
                <dt>Hall d'entr&eacute;e&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_hallEntree}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_salleFamilliale) != 0}
            <dl>
                <dt>Salle familiale&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_salleFamilliale}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_cuisine) != 0}
            <dl>
                <dt>Cuisine&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_cuisine}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_salleManger) != 0}
            <dl>
                <dt>Salle &agrave; manger&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_salleManger}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_salleEau) != 0}
            <dl>
                <dt>Salle d'eau&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_salleEau}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_salleBain) != 0}
            <dl>
                <dt>Salle de bain&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_salleBain}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_salon) != 0}
            <dl>
                <dt>Salon&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_salon}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_chambrePrincipale) != 0}
            <dl>
                <dt>Chambre principale&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambrePrincipale}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_rangement) != 0}
            <dl>
                <dt>Rangement &nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_rangement}
                </dd>
            </dl>
            {/if}
        </div>    
	
    	{if strlen($immobilier->immobilier_chambreAutre1) || strlen($immobilier->immobilier_chambreAutre2) ||  strlen($immobilier->immobilier_chambreAutre3) ||  strlen($immobilier->immobilier_chambreAutre4) || strlen($immobilier->immobilier_chambreAutre5) ||  strlen($immobilier->immobilier_chambreAutre6) ||  strlen($immobilier->immobilier_chambreAutre7) ||    strlen($immobilier->immobilier_chambreAutre8) ||  strlen($immobilier->immobilier_chambreAutre9) ||  strlen($immobilier->immobilier_chambreAutre10)}
	    <h3>AUTRES CHAMBRES</h3>
		<div class="info_list more_info">  
            {if  strlen($immobilier->immobilier_chambreAutre1) != 0}
            <dl>
                <dt>Chambre 1&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambreAutre1}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_chambreAutre2) != 0}
            <dl>
                <dt>Chambre 2&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambreAutre2}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_chambreAutre3) != 0}
            <dl>
                <dt>Chambre 3&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambreAutre3}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_chambreAutre4) != 0}
            <dl>
                <dt>Chambre 4&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambreAutre4}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_chambreAutre5) != 0}
            <dl>
                <dt>Chambre 5&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambreAutre5}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_chambreAutre6) != 0}
            <dl>
                <dt>Chambre 6&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambreAutre6}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_chambreAutre7) != 0}
            <dl>
                <dt>Chambre 7&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambreAutre7}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_chambreAutre8) != 0}
            <dl>
                <dt>Chambre 8&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambreAutre8}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_chambreAutre9) != 0}
            <dl>
                <dt>Chambre 9&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambreAutre9}
                </dd>
            </dl>
            {/if}
            {if  strlen($immobilier->immobilier_chambreAutre10) != 0}
            <dl>
                <dt>Chambre 10&nbsp;:</dt>
                <dd>
					{$immobilier->immobilier_chambreAutre10}
                </dd>
            </dl>
            {/if}
        </div>
        {/if}
 	</div>       

</div>