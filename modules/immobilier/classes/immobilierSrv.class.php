<?php
/**
* @package ilay-nosy
* @subpackage immobilier
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des immobiliers
*
* @package ilay-nosy
* @subpackage immobilier
*/
class immobilierSrv {

	/**
    * Chargement d'un immobilier donné
	*
	* @param integer $annonceId Id de l'annonce souhaitée
	* @return object $toImmobilier  objet immobilier
    */
    static function chargeImmobilier($annonceId) {

		// 	Chargement des données
		if (!$annonceId) {
			throw new Exception("Pas d'identifient du immobilier envoyé");
		}

		$zQuery = "SELECT immobilier_id

				, immobilier_annonceId
				, immobilier_typePropriete
				, immobilier_typeBatiment
				, immobilier_nbChambre
				, immobilier_construction
				, immobilier_foyer
				, immobilier_piscine
				, immobilier_bergeRive
				, immobilier_panorama
				, immobilier_garage
				, immobilier_ascenceur
				, immobilier_climatisation
				, immobilier_thermopompe
				, immobilier_ventePar
				, immobilier_sousSolAmenage
				, immobilier_nomCadastre
				, immobilier_certificatLocalisation
				, immobilier_certificatAnnee
				, immobilier_dateOccupation
				, immobilier_adresse
				, immobilier_cp
				, immobilier_terrainDimension
				, immobilier_terrainSuperficie
				, immobilier_batimentDimension
				, immobilier_superficieHabitable
				, immobilier_evaluationAnnee
				, immobilier_evaluationTerrain
				, immobilier_evaluationBatiment
				, immobilier_evaluationTotale
				, immobilier_evaluationDisponible
				, immobilier_taxeScolaire
				, immobilier_taxeMunicipal
				, immobilier_taxeAnnuelle
				, immobilier_revenuAnnuel
				, immobilier_locationLogement
				, immobilier_assurance
				, immobilier_combustibleChauffage
				, immobilier_electricite
				, immobilier_fraisPartages
				, immobilier_chauffage				
				, immobilier_inclusion
				, immobilier_exclusion
				, immobilier_nbPiece
				, immobilier_nbSalleBain
				, immobilier_nbSalleEau
				, immobilier_bail
				, immobilier_hallEntree
				, immobilier_salleFamilliale
				, immobilier_cuisine
				, immobilier_salleManger
				, immobilier_salleEau
				, immobilier_salon
				, immobilier_chambrePrincipale
				, immobilier_chambreAutre1
				, immobilier_chambreAutre2
				, immobilier_chambreAutre3
				, immobilier_chambreAutre4
				, immobilier_chambreAutre5
				, immobilier_chambreAutre6
				, immobilier_chambreAutre7
				, immobilier_chambreAutre8
				, immobilier_chambreAutre9
				, immobilier_chambreAutre10
				, immobilier_salleBain
				, immobilier_rangement				
			
			FROM immobilier WHERE immobilier_annonceId=".$annonceId;
		
      	$pDbw = jDb::getDbWidget();
      	$iImmobilier = count($toImmobilier = $pDbw->fetchAll($zQuery));
		if ($iImmobilier==0) {
			$toImmobilier[0] = self::getDaoImmobilier();
        	//throw new Exception("Immobilier pour l'annonce $annonceId non trouvée");
		}

		$toImmobilier[0]->immobilier_nbChambre				= stripslashes($toImmobilier[0]->immobilier_nbChambre);
		$toImmobilier[0]->immobilier_construction			= stripslashes($toImmobilier[0]->immobilier_construction);
		$toImmobilier[0]->immobilier_ventePar				= stripslashes($toImmobilier[0]->immobilier_ventePar);
		$toImmobilier[0]->immobilier_nomCadastre			= stripslashes($toImmobilier[0]->immobilier_nomCadastre);
		$toImmobilier[0]->immobilier_certificatAnnee		= stripslashes($toImmobilier[0]->immobilier_certificatAnnee);
		$toImmobilier[0]->immobilier_adresse				= stripslashes($toImmobilier[0]->immobilier_adresse);
		$toImmobilier[0]->immobilier_cp						= stripslashes($toImmobilier[0]->immobilier_cp);
		$toImmobilier[0]->immobilier_terrainDimension		= stripslashes($toImmobilier[0]->immobilier_terrainDimension);
		$toImmobilier[0]->immobilier_terrainSuperficie		= stripslashes($toImmobilier[0]->immobilier_terrainSuperficie);
		$toImmobilier[0]->immobilier_batimentDimension		= stripslashes($toImmobilier[0]->immobilier_batimentDimension);
		$toImmobilier[0]->immobilier_superficieHabitable	= stripslashes($toImmobilier[0]->immobilier_superficieHabitable);
		$toImmobilier[0]->immobilier_evaluationAnnee		= stripslashes($toImmobilier[0]->immobilier_evaluationAnnee);
		$toImmobilier[0]->immobilier_evaluationTerrain		= stripslashes($toImmobilier[0]->immobilier_evaluationTerrain);
		$toImmobilier[0]->immobilier_evaluationBatiment		= stripslashes($toImmobilier[0]->immobilier_evaluationBatiment);
		$toImmobilier[0]->immobilier_evaluationTotale		= stripslashes($toImmobilier[0]->immobilier_evaluationTotale);
		$toImmobilier[0]->immobilier_taxeScolaire			= stripslashes($toImmobilier[0]->immobilier_taxeScolaire);
		$toImmobilier[0]->immobilier_taxeMunicipal			= stripslashes($toImmobilier[0]->immobilier_taxeMunicipal);
		$toImmobilier[0]->immobilier_revenuAnnuel			= stripslashes($toImmobilier[0]->immobilier_revenuAnnuel);
		$toImmobilier[0]->immobilier_locationLogement		= stripslashes($toImmobilier[0]->immobilier_locationLogement);
		$toImmobilier[0]->immobilier_assurance				= stripslashes($toImmobilier[0]->immobilier_assurance);
		$toImmobilier[0]->immobilier_combustibleChauffage	= stripslashes($toImmobilier[0]->immobilier_combustibleChauffage);
		$toImmobilier[0]->immobilier_electricite			= stripslashes($toImmobilier[0]->immobilier_electricite);
		$toImmobilier[0]->immobilier_fraisPartages			= stripslashes($toImmobilier[0]->immobilier_fraisPartages);
		$toImmobilier[0]->immobilier_inclusion				= stripslashes($toImmobilier[0]->immobilier_inclusion);
		$toImmobilier[0]->immobilier_exclusion				= stripslashes($toImmobilier[0]->immobilier_exclusion);
		$toImmobilier[0]->immobilier_bail					= stripslashes($toImmobilier[0]->immobilier_bail);
		$toImmobilier[0]->immobilier_hallEntree				= stripslashes($toImmobilier[0]->immobilier_hallEntree);
		$toImmobilier[0]->immobilier_salleFamilliale		= stripslashes($toImmobilier[0]->immobilier_salleFamilliale);
		$toImmobilier[0]->immobilier_cuisine				= stripslashes($toImmobilier[0]->immobilier_cuisine);
		$toImmobilier[0]->immobilier_salleManger			= stripslashes($toImmobilier[0]->immobilier_salleManger);
		$toImmobilier[0]->immobilier_salleEau				= stripslashes($toImmobilier[0]->immobilier_salleEau);
		$toImmobilier[0]->immobilier_salon					= stripslashes($toImmobilier[0]->immobilier_salon);
		$toImmobilier[0]->immobilier_chambrePrincipale		= stripslashes($toImmobilier[0]->immobilier_chambrePrincipale);
		$toImmobilier[0]->immobilier_chambreAutre1			= stripslashes($toImmobilier[0]->immobilier_chambreAutre1);
		$toImmobilier[0]->immobilier_chambreAutre2			= stripslashes($toImmobilier[0]->immobilier_chambreAutre2);
		$toImmobilier[0]->immobilier_chambreAutre3			= stripslashes($toImmobilier[0]->immobilier_chambreAutre3);
		$toImmobilier[0]->immobilier_chambreAutre4			= stripslashes($toImmobilier[0]->immobilier_chambreAutre4);
		$toImmobilier[0]->immobilier_chambreAutre5			= stripslashes($toImmobilier[0]->immobilier_chambreAutre5);
		$toImmobilier[0]->immobilier_chambreAutre6			= stripslashes($toImmobilier[0]->immobilier_chambreAutre6);
		$toImmobilier[0]->immobilier_chambreAutre7			= stripslashes($toImmobilier[0]->immobilier_chambreAutre7);
		$toImmobilier[0]->immobilier_chambreAutre8			= stripslashes($toImmobilier[0]->immobilier_chambreAutre8);
		$toImmobilier[0]->immobilier_chambreAutre9			= stripslashes($toImmobilier[0]->immobilier_chambreAutre9);
		$toImmobilier[0]->immobilier_chambreAutre10			= stripslashes($toImmobilier[0]->immobilier_chambreAutre10);
		$toImmobilier[0]->immobilier_salleBain				= stripslashes($toImmobilier[0]->immobilier_salleBain);
		$toImmobilier[0]->immobilier_rangement				= stripslashes($toImmobilier[0]->immobilier_rangement);					
		
		return $toImmobilier[0];
	}

	/**
    * Enregistrement d'un immobilier
	*
	* @param object $immobilier Objet immobilier
    */
    static function sauvegardeImmobilier($immobilier) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'immobilier
		$immobilier->statut = isset($immobilier->statut)? $immobilier->statut : 0;
		
		if (!isset($immobilier->id) || $immobilier->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO immobilier VALUES (
						
				'0'
				," .$oCnx->quote($immobilier->annonceId). "
				," .$oCnx->quote($immobilier->typePropriete). "
				," .$oCnx->quote($immobilier->typeBatiment). "
				," .$oCnx->quote($immobilier->nbChambre). "
				," .$oCnx->quote($immobilier->construction). "
				," .$oCnx->quote($immobilier->foyer). "
				," .$oCnx->quote($immobilier->piscine). "
				," .$oCnx->quote($immobilier->bergeRive). "
				," .$oCnx->quote($immobilier->panorama). "
				," .$oCnx->quote($immobilier->garage). "
				," .$oCnx->quote($immobilier->ascenceur). "
				," .$oCnx->quote($immobilier->climatisation). "
				," .$oCnx->quote($immobilier->thermopompe). "
				," .$oCnx->quote($immobilier->ventePar). "
				," .$oCnx->quote($immobilier->sousSolAmenage). "
				," .$oCnx->quote($immobilier->nomCadastre). "
				," .$oCnx->quote($immobilier->certificatLocalisation). "
				," .$oCnx->quote($immobilier->certificatAnnee). "
				," .$oCnx->quote($immobilier->dateOccupation). "
				," .$oCnx->quote($immobilier->adresse). "
				," .$oCnx->quote($immobilier->cp). "
				," .$oCnx->quote($immobilier->terrainDimension). "
				," .$oCnx->quote($immobilier->terrainSuperficie). "
				," .$oCnx->quote($immobilier->batimentDimension). "
				," .$oCnx->quote($immobilier->superficieHabitable). "
				," .$oCnx->quote($immobilier->evaluationAnnee). "
				," .$oCnx->quote($immobilier->evaluationTerrain). "
				," .$oCnx->quote($immobilier->evaluationBatiment). "
				," .$oCnx->quote($immobilier->evaluationTotale). "
				," .$oCnx->quote($immobilier->evaluationDisponible). "
				," .$oCnx->quote($immobilier->taxeScolaire). "
				," .$oCnx->quote($immobilier->taxeMunicipal). "
				," .$oCnx->quote($immobilier->taxeAnnuelle). "
				," .$oCnx->quote($immobilier->revenuAnnuel). "
				," .$oCnx->quote($immobilier->locationLogement). "
				," .$oCnx->quote($immobilier->assurance). "
				," .$oCnx->quote($immobilier->combustibleChauffage). "
				," .$oCnx->quote($immobilier->electricite). "
				," .$oCnx->quote($immobilier->fraisPartages). "
				," .$oCnx->quote($immobilier->chauffage). "
				," .$oCnx->quote($immobilier->inclusion). "
				," .$oCnx->quote($immobilier->exclusion). "
				," .$oCnx->quote($immobilier->nbPiece). "
				," .$oCnx->quote($immobilier->nbSalleBain). "
				," .$oCnx->quote($immobilier->nbSalleEau). "
				," .$oCnx->quote($immobilier->bail). "
				," .$oCnx->quote($immobilier->hallEntree). "
				," .$oCnx->quote($immobilier->salleFamilliale). "
				," .$oCnx->quote($immobilier->cuisine). "
				," .$oCnx->quote($immobilier->salleManger). "
				," .$oCnx->quote($immobilier->salleEau). "
				," .$oCnx->quote($immobilier->salon). "
				," .$oCnx->quote($immobilier->chambrePrincipale). "
				," .$oCnx->quote($immobilier->chambreAutre1). "
				," .$oCnx->quote($immobilier->chambreAutre2). "
				," .$oCnx->quote($immobilier->chambreAutre3). "
				," .$oCnx->quote($immobilier->chambreAutre4). "
				," .$oCnx->quote($immobilier->chambreAutre5). "
				," .$oCnx->quote($immobilier->chambreAutre6). "
				," .$oCnx->quote($immobilier->chambreAutre7). "
				," .$oCnx->quote($immobilier->chambreAutre8). "
				," .$oCnx->quote($immobilier->chambreAutre9). "
				," .$oCnx->quote($immobilier->chambreAutre10). "
				," .$oCnx->quote($immobilier->salleBain). "
				," .$oCnx->quote($immobilier->rangement). "		

				)";
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE immobilier SET \n
					immobilier_id=".$oCnx->quote($immobilier->id)."";
					
			if (isset($immobilier->annonceId)) {
				$zQuery .= "\n, immobilier_annonceId=".$oCnx->quote($immobilier->annonceId)."";
			}
			if (isset($immobilier->typePropriete)) {
				$zQuery .= "\n, immobilier_typePropriete=".$oCnx->quote($immobilier->typePropriete)."";
			}
			if (isset($immobilier->typeBatiment)) {
				$zQuery .= "\n, immobilier_typeBatiment=".$oCnx->quote($immobilier->typeBatiment)."";
			}
			if (isset($immobilier->nbChambre)) {
				$zQuery .= "\n, immobilier_nbChambre=".$oCnx->quote($immobilier->nbChambre)."";
			}
			if (isset($immobilier->construction)) {
				$zQuery .= "\n, immobilier_construction=".$oCnx->quote($immobilier->construction)."";
			}
			if (isset($immobilier->foyer)) {
				$zQuery .= "\n, immobilier_foyer=".$oCnx->quote($immobilier->foyer)."";
			}
			if (isset($immobilier->piscine)) {
				$zQuery .= "\n, immobilier_piscine=".$oCnx->quote($immobilier->piscine)."";
			}
			if (isset($immobilier->bergeRive)) {
				$zQuery .= "\n, immobilier_bergeRive=".$oCnx->quote($immobilier->bergeRive)."";
			}
			if (isset($immobilier->panorama)) {
				$zQuery .= "\n, immobilier_panorama=".$oCnx->quote($immobilier->panorama)."";
			}
			if (isset($immobilier->garage)) {
				$zQuery .= "\n, immobilier_garage=".$oCnx->quote($immobilier->garage)."";
			}
			if (isset($immobilier->ascenceur)) {
				$zQuery .= "\n, immobilier_ascenceur=".$oCnx->quote($immobilier->ascenceur)."";
			}
			if (isset($immobilier->climatisation)) {
				$zQuery .= "\n, immobilier_climatisation=".$oCnx->quote($immobilier->climatisation)."";
			}
			if (isset($immobilier->thermopompe)) {
				$zQuery .= "\n, immobilier_thermopompe=".$oCnx->quote($immobilier->thermopompe)."";
			}
			if (isset($immobilier->ventePar)) {
				$zQuery .= "\n, immobilier_ventePar=".$oCnx->quote($immobilier->ventePar)."";
			}
			if (isset($immobilier->sousSolAmenage)) {
				$zQuery .= "\n, immobilier_sousSolAmenage=".$oCnx->quote($immobilier->sousSolAmenage)."";
			}
			if (isset($immobilier->nomCadastre)) {
				$zQuery .= "\n, immobilier_nomCadastre=".$oCnx->quote($immobilier->nomCadastre)."";
			}
			if (isset($immobilier->certificatLocalisation)) {
				$zQuery .= "\n, immobilier_certificatLocalisation=".$oCnx->quote($immobilier->certificatLocalisation)."";
			}
			if (isset($immobilier->certificatAnnee)) {
				$zQuery .= "\n, immobilier_certificatAnnee=".$oCnx->quote($immobilier->certificatAnnee)."";
			}
			if (isset($immobilier->dateOccupation)) {
				$zQuery .= "\n, immobilier_dateOccupation=".$oCnx->quote($immobilier->dateOccupation)."";
			}
			if (isset($immobilier->adresse)) {
				$zQuery .= "\n, immobilier_adresse=".$oCnx->quote($immobilier->adresse)."";
			}
			if (isset($immobilier->cp)) {
				$zQuery .= "\n, immobilier_cp=".$oCnx->quote($immobilier->cp)."";
			}
			if (isset($immobilier->terrainDimension)) {
				$zQuery .= "\n, immobilier_terrainDimension=".$oCnx->quote($immobilier->terrainDimension)."";
			}
			if (isset($immobilier->terrainSuperficie)) {
				$zQuery .= "\n, immobilier_terrainSuperficie=".$oCnx->quote($immobilier->terrainSuperficie)."";
			}
			if (isset($immobilier->batimentDimension)) {
				$zQuery .= "\n, immobilier_batimentDimension=".$oCnx->quote($immobilier->batimentDimension)."";
			}
			if (isset($immobilier->superficieHabitable)) {
				$zQuery .= "\n, immobilier_superficieHabitable=".$oCnx->quote($immobilier->superficieHabitable)."";
			}
			if (isset($immobilier->evaluationAnnee)) {
				$zQuery .= "\n, immobilier_evaluationAnnee=".$oCnx->quote($immobilier->evaluationAnnee)."";
			}
			if (isset($immobilier->evaluationTerrain)) {
				$zQuery .= "\n, immobilier_evaluationTerrain=".$oCnx->quote($immobilier->evaluationTerrain)."";
			}
			if (isset($immobilier->evaluationBatiment)) {
				$zQuery .= "\n, immobilier_evaluationBatiment=".$oCnx->quote($immobilier->evaluationBatiment)."";
			}
			if (isset($immobilier->evaluationTotale)) {
				$zQuery .= "\n, immobilier_evaluationTotale=".$oCnx->quote($immobilier->evaluationTotale)."";
			}
			if (isset($immobilier->evaluationDisponible)) {
				$zQuery .= "\n, immobilier_evaluationDisponible=".$oCnx->quote($immobilier->evaluationDisponible)."";
			}
			if (isset($immobilier->taxeScolaire)) {
				$zQuery .= "\n, immobilier_taxeScolaire=".$oCnx->quote($immobilier->taxeScolaire)."";
			}
			if (isset($immobilier->taxeMunicipal)) {
				$zQuery .= "\n, immobilier_taxeMunicipal=".$oCnx->quote($immobilier->taxeMunicipal)."";
			}
			if (isset($immobilier->taxeAnnuelle)) {
				$zQuery .= "\n, immobilier_taxeAnnuelle=".$oCnx->quote($immobilier->taxeAnnuelle)."";
			}
			if (isset($immobilier->revenuAnnuel)) {
				$zQuery .= "\n, immobilier_revenuAnnuel=".$oCnx->quote($immobilier->revenuAnnuel)."";
			}
			if (isset($immobilier->locationLogement)) {
				$zQuery .= "\n, immobilier_locationLogement=".$oCnx->quote($immobilier->locationLogement)."";
			}
			if (isset($immobilier->assurance)) {
				$zQuery .= "\n, immobilier_assurance=".$oCnx->quote($immobilier->assurance)."";
			}
			if (isset($immobilier->combustibleChauffage)) {
				$zQuery .= "\n, immobilier_combustibleChauffage=".$oCnx->quote($immobilier->combustibleChauffage)."";
			}
			if (isset($immobilier->electricite)) {
				$zQuery .= "\n, immobilier_electricite=".$oCnx->quote($immobilier->electricite)."";
			}
			if (isset($immobilier->fraisPartages)) {
				$zQuery .= "\n, immobilier_fraisPartages=".$oCnx->quote($immobilier->fraisPartages)."";
			}
			if (isset($immobilier->chauffage)) {
				$zQuery .= "\n, immobilier_chauffage=".$oCnx->quote($immobilier->chauffage)."";
			}
			if (isset($immobilier->inclusion)) {
				$zQuery .= "\n, immobilier_inclusion=".$oCnx->quote($immobilier->inclusion)."";
			}
			if (isset($immobilier->exclusion)) {
				$zQuery .= "\n, immobilier_exclusion=".$oCnx->quote($immobilier->exclusion)."";
			}
			if (isset($immobilier->nbPiece)) {
				$zQuery .= "\n, immobilier_nbPiece=".$oCnx->quote($immobilier->nbPiece)."";
			}
			if (isset($immobilier->nbSalleBain)) {
				$zQuery .= "\n, immobilier_nbSalleBain=".$oCnx->quote($immobilier->nbSalleBain)."";
			}
			if (isset($immobilier->nbSalleEau)) {
				$zQuery .= "\n, immobilier_nbSalleEau=".$oCnx->quote($immobilier->nbSalleEau)."";
			}
			if (isset($immobilier->bail)) {
				$zQuery .= "\n, immobilier_bail=".$oCnx->quote($immobilier->bail)."";
			}
			if (isset($immobilier->hallEntree)) {
				$zQuery .= "\n, immobilier_hallEntree=".$oCnx->quote($immobilier->hallEntree)."";
			}
			if (isset($immobilier->salleFamilliale)) {
				$zQuery .= "\n, immobilier_salleFamilliale=".$oCnx->quote($immobilier->salleFamilliale)."";
			}
			if (isset($immobilier->cuisine)) {
				$zQuery .= "\n, immobilier_cuisine=".$oCnx->quote($immobilier->cuisine)."";
			}
			if (isset($immobilier->salleManger)) {
				$zQuery .= "\n, immobilier_salleManger=".$oCnx->quote($immobilier->salleManger)."";
			}
			if (isset($immobilier->salleEau)) {
				$zQuery .= "\n, immobilier_salleEau=".$oCnx->quote($immobilier->salleEau)."";
			}
			if (isset($immobilier->salon)) {
				$zQuery .= "\n, immobilier_salon=".$oCnx->quote($immobilier->salon)."";
			}
			if (isset($immobilier->chambrePrincipale)) {
				$zQuery .= "\n, immobilier_chambrePrincipale=".$oCnx->quote($immobilier->chambrePrincipale)."";
			}
			if (isset($immobilier->chambreAutre1)) {
				$zQuery .= "\n, immobilier_chambreAutre1=".$oCnx->quote($immobilier->chambreAutre1)."";
			}
			if (isset($immobilier->chambreAutre2)) {
				$zQuery .= "\n, immobilier_chambreAutre2=".$oCnx->quote($immobilier->chambreAutre2)."";
			}
			if (isset($immobilier->chambreAutre3)) {
				$zQuery .= "\n, immobilier_chambreAutre3=".$oCnx->quote($immobilier->chambreAutre3)."";
			}
			if (isset($immobilier->chambreAutre4)) {
				$zQuery .= "\n, immobilier_chambreAutre4=".$oCnx->quote($immobilier->chambreAutre4)."";
			}
			if (isset($immobilier->chambreAutre5)) {
				$zQuery .= "\n, immobilier_chambreAutre5=".$oCnx->quote($immobilier->chambreAutre5)."";
			}
			if (isset($immobilier->chambreAutre6)) {
				$zQuery .= "\n, immobilier_chambreAutre6=".$oCnx->quote($immobilier->chambreAutre6)."";
			}
			if (isset($immobilier->chambreAutre7)) {
				$zQuery .= "\n, immobilier_chambreAutre7=".$oCnx->quote($immobilier->chambreAutre7)."";
			}
			if (isset($immobilier->chambreAutre8)) {
				$zQuery .= "\n, immobilier_chambreAutre8=".$oCnx->quote($immobilier->chambreAutre8)."";
			}
			if (isset($immobilier->chambreAutre9)) {
				$zQuery .= "\n, immobilier_chambreAutre9=".$oCnx->quote($immobilier->chambreAutre9)."";
			}
			if (isset($immobilier->chambreAutre10)) {
				$zQuery .= "\n, immobilier_chambreAutre10=".$oCnx->quote($immobilier->chambreAutre10)."";
			}
			if (isset($immobilier->salleBain)) {
				$zQuery .= "\n, immobilier_salleBain=".$oCnx->quote($immobilier->salleBain)."";
			}
			if (isset($immobilier->rangement)) {
				$zQuery .= "\n, immobilier_rangement=".$oCnx->quote($immobilier->rangement)."";		
			}	

			$zQuery .= " \nWHERE immobilier_id=".$immobilier->id;
			
			//echo "$zQuery";
			
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un immobilier
	*
	* @param integer Id du immobilier à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeImmobilier($annonceId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un immobilier
		$zQuery = "DELETE FROM immobilier WHERE immobilier_annonceId=$annonceId";
		$rConn->exec($zQuery);

		return TRUE;
	}

	/**
    * Factory d'objet DAO immobilier
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoImmobilier() {

		$object = jDao::createRecord("immobilier~immobilier");
		//$object->immobilier_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
}
?>