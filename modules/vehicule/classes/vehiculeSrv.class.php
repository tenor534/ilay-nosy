<?php
/**
* @package ilay-nosy
* @subpackage vehicule
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des vehicules
*
* @package ilay-nosy
* @subpackage vehicule
*/
class vehiculeSrv {

	/**
    * Chargement d'un vehicule donné
	*
	* @param integer $annonceId Id de l'annonce souhaitée
	* @return object $toVehicule  objet vehicule
    */
    static function chargeVehicule($annonceId) {

		// 	Chargement des données
		if (!$annonceId) {
			throw new Exception("Pas d'identifient du vehicule envoyé");
		}

		$zQuery = "SELECT vehicule_id

				, vehicule_annonceId
				, vehicule_origine
				, vehicule_marqueId
				, vehicule_modeleId
				, vehicule_version
				, vehicule_premiereMain
				, vehicule_type
				, vehicule_transmission
				, vehicule_nbCylindre
				, vehicule_tailleMoteur
				, vehicule_motricite
				, vehicule_carburant
				, vehicule_kilometrage
				, vehicule_nbPorte
				, vehicule_nbPassager
				, vehicule_airClimatise
				, vehicule_couleurExterne
				, vehicule_couleurInterne
				, vehicule_option
				, vehicule_garantie
				, vehicule_financement
			
			FROM vehicule WHERE vehicule_annonceId=".$annonceId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iVehicule = count($toVehicule = $pDbw->fetchAll($zQuery));
		if ($iVehicule==0) {
			$toVehicule[0] = self::getDaoVehicule();
        	//throw new Exception("Vehicule pour l'annonce $annonceId non trouvée");
		}

		$toVehicule[0]->vehicule_origine 			= stripslashes($toVehicule[0]->vehicule_origine);
		$toVehicule[0]->vehicule_version 			= stripslashes($toVehicule[0]->vehicule_version);
		$toVehicule[0]->vehicule_couleurExterne 	= stripslashes($toVehicule[0]->vehicule_couleurExterne);
		$toVehicule[0]->vehicule_couleurInterne 	= stripslashes($toVehicule[0]->vehicule_couleurInterne);
		$toVehicule[0]->vehicule_option 			= stripslashes($toVehicule[0]->vehicule_option);
		$toVehicule[0]->vehicule_garantie 			= stripslashes($toVehicule[0]->vehicule_garantie);
		$toVehicule[0]->vehicule_financement 		= stripslashes($toVehicule[0]->vehicule_financement);
		
		return $toVehicule[0];
	}

	/**
    * Enregistrement d'un vehicule
	*
	* @param object $vehicule Objet vehicule
    */
    static function sauvegardeVehicule($vehicule) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'vehicule
		$vehicule->statut = isset($vehicule->statut)? $vehicule->statut : 0;
		
		if (!isset($vehicule->id) || $vehicule->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO vehicule VALUES (
			
				'0'
				," .$vehicule->annonceId ."
				," .$oCnx->quote($vehicule->origine). "
				," .$vehicule->marqueId ."
				," .$vehicule->modeleId ."
				," .$oCnx->quote($vehicule->version). "
				," .$vehicule->premiereMain ."
				," .$vehicule->type ."
				," .$vehicule->transmission ."
				," .$oCnx->quote($vehicule->nbCylindre) ."
				," .$oCnx->quote($vehicule->tailleMoteur) ."
				," .$vehicule->motricite ."
				," .$vehicule->carburant ."
				," .$oCnx->quote($vehicule->kilometrage) ."
				," .$oCnx->quote($vehicule->nbPorte) ."
				," .$oCnx->quote($vehicule->nbPassager) ."
				," .$vehicule->airClimatise ."
				," .$oCnx->quote($vehicule->couleurExterne). "
				," .$oCnx->quote($vehicule->couleurInterne). "
				," .$oCnx->quote($vehicule->option). "
				," .$oCnx->quote($vehicule->garantie). "
				," .$oCnx->quote($vehicule->financement). "

				)";
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE vehicule SET \n
					vehicule_id=".$oCnx->quote($vehicule->id)."";
					
				if (isset($vehicule->annonceId)) {
					$zQuery .= "\n, vehicule_annonceId=".$vehicule->annonceId."";
				}
				if (isset($vehicule->origine)) {
					$zQuery .= "\n, vehicule_origine=".$oCnx->quote($vehicule->origine)."";
				}
				if (isset($vehicule->marqueId)) {
					$zQuery .= "\n, vehicule_marqueId=".$vehicule->marqueId."";
				}
				if (isset($vehicule->modeleId)) {
					$zQuery .= "\n, vehicule_modeleId=".$vehicule->modeleId."";}
				
				if (isset($vehicule->version)) {
					$zQuery .= "\n, vehicule_version=".$oCnx->quote($vehicule->version)."";
				}
				if (isset($vehicule->premiereMain)) {
					$zQuery .= "\n, vehicule_premiereMain=".$vehicule->premiereMain."";
				}
				if (isset($vehicule->type)) {
					$zQuery .= "\n, vehicule_type=".$vehicule->type."";
				}
				if (isset($vehicule->transmission)) {
					$zQuery .= "\n, vehicule_transmission=".$vehicule->transmission."";
				}
				if (isset($vehicule->nbCylindre)) {
					$zQuery .= "\n, vehicule_nbCylindre=".$oCnx->quote($vehicule->nbCylindre)."";
				}
				if (isset($vehicule->tailleMoteur)) {
					$zQuery .= "\n, vehicule_tailleMoteur=".$oCnx->quote($vehicule->tailleMoteur)."";
				}
				if (isset($vehicule->motricite)) {
					$zQuery .= "\n, vehicule_motricite=".$vehicule->motricite."";
				}
				if (isset($vehicule->carburant)) {
					$zQuery .= "\n, vehicule_carburant=".$vehicule->carburant."";
				}
				if (isset($vehicule->kilometrage)) {
					$zQuery .= "\n, vehicule_kilometrage=".$oCnx->quote($vehicule->kilometrage)."";
				}
				if (isset($vehicule->nbPorte)) {
					$zQuery .= "\n, vehicule_nbPorte=".$oCnx->quote($vehicule->nbPorte)."";
				}
				if (isset($vehicule->nbPassager)) {
					$zQuery .= "\n, vehicule_nbPassager=".$oCnx->quote($vehicule->nbPassager)."";
				}
				if (isset($vehicule->airClimatise)) {
					$zQuery .= "\n, vehicule_airClimatise=".$vehicule->airClimatise."";
				}
				if (isset($vehicule->couleurExterne)) {
					$zQuery .= "\n, vehicule_couleurExterne=".$oCnx->quote($vehicule->couleurExterne)."";
				}
				if (isset($vehicule->couleurInterne)) {
					$zQuery .= "\n, vehicule_couleurInterne=".$oCnx->quote($vehicule->couleurInterne)."";
				}
				if (isset($vehicule->option)) {
					$zQuery .= "\n, vehicule_option=".$oCnx->quote($vehicule->option)."";
				}
				if (isset($vehicule->garantie)) {
					$zQuery .= "\n, vehicule_garantie=".$oCnx->quote($vehicule->garantie)."";
				}
				if (isset($vehicule->financement)) {
					$zQuery .= "\n, vehicule_financement=".$oCnx->quote($vehicule->financement)."";
				}

			$zQuery .= " \nWHERE vehicule_id=".$vehicule->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un vehicule
	*
	* @param integer Id du vehicule à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeVehicule($annonceId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un vehicule
		$zQuery = "DELETE FROM vehicule WHERE vehicule_annonceId=$annonceId";
		$rConn->exec($zQuery);

		return TRUE;
	}

	/**
    * Factory d'objet DAO vehicule
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoVehicule() {

		$object = jDao::createRecord("vehicule~vehicule");
		//$object->vehicule_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
}
?>