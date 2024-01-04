<?php
/**
* @package dwordconsulting
* @subpackage service
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des services
*
* @package dwordconsulting
* @subpackage service
*/
class serviceSrv {

	/**
    * Chargement de la liste des services (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets services , nombre d'enregistrement
	
	 service_id   		int(11)
	 service_libelle  	varchar(100) 	
	 service_code  	varchar(5) 	
    */
    static function chargeListeService($sortField="service_libelle", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeService = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM service AS s";

		$zSql  = 	" SELECT s.* "; 
		$zSql .=	" ,COUNT(ass.assProfilServiceDroit_serviceId) AS service_nbAssociation ";
		$zSql .=	" ,COUNT(u.utilisateur_id) AS service_nbUtilisateur ";
		$zSql .=	" FROM service AS s " ;
		$zSql .=	" LEFT JOIN assProfilServiceDroit AS ass " ;
		$zSql .=	" 	ON ass.assProfilServiceDroit_serviceId = s.service_id ";
		$zSql .=	" LEFT JOIN utilisateur AS u " ;
		$zSql .=	" 	ON u.utilisateur_serviceId = s.service_id ";
		$zSql .=	" GROUP BY s.service_libelle" ;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM service");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listeService = $oServiceDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
			$record->service_libelle = stripslashes($record->service_libelle );
			array_push($listeService, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeService'] = $listeService ;
		
		return $tResult ;

	}
	

    static function chargeAllService() {

		$listeService = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT s.* ";
		$zSql .=	" FROM service AS s " ;

		$rs = $cnx->query($zSql);

		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM service");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		while($record = $rs->fetch()){
			array_push($listeService, $record) ;
 		}

		//$tResult = $listeService ;
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeService'] = $listeService;
		
		return $tResult ;

	}	
	

	/**
    * Chargement d'un service donné
	*
	* @param integer $serviceId Id de l'service souhaitée
	* @return object $toService  objet service
    */
    static function chargeService($serviceId) {

		// 	Chargement des données
		if (!$serviceId) {
			throw new Exception("Pas d'identifient du service envoyé");
		}

		$zQuery = "SELECT service_id
			, service_libelle
			, service_code
			FROM service
			WHERE service_id=$serviceId";
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iService = count($toService = $pDbw->fetchAll($zQuery));
		if ($iService==0) {
        	throw new Exception("Service $serviceId non trouvée");
		}
		
		return $toService[0];
	}


	/**
    * Enregistrement d'un service
	*
	* @param object $service Objet service
    */
    static function sauvegardeService($service) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		if (!isset($service->id) || $service->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO service VALUES (
			      '0'
				, ".$oCnx->quote($service->libelle)."
				, ".$oCnx->quote($service->code).")";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE service SET \n
					service_id=".$oCnx->quote($service->id)."";

			if (isset($service->libelle)) {
				$zQuery .= "\n, service_libelle=".$oCnx->quote($service->libelle)."";
			}
			if (isset($service->code)) {
				$zQuery .= "\n, service_code=".$oCnx->quote($service->code)."";
			}

			$zQuery .= " \nWHERE service_id=".$service->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un service
	*
	* @param integer Id du service à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeService($serviceId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un service
		$zQuery = "DELETE FROM service WHERE service_id=$serviceId";
		$rConn->exec($zQuery);

		return TRUE;
	}
	
	/**
    * Factory d'objet DAO service
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoService() {

		$object = jDao::createRecord("service~service");
		//$object->service_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
}

?>
