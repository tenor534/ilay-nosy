<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des accueils
*
* @package ilay-nosy
* @subpackage accueil
*/
class accueilSrv {

	static function updateAccueil($idAccueil, $publier)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE accueil SET accueil_publier =".$publier." WHERE accueil_id =".$idAccueil;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}
	/**
	* réarranger l'ordre d'une page par rapport aux autres
	* @param int $id id de la accueil
	* @param int $iNewOrder id du nouvelle du produit
	**/
	static function reorderListeAccueil($id, $iNewOrder) {
	
		$oDB = jDb::getDbWidget();
		/*
		$zQuery = " SELECT * FROM accueil WHERE accueil_id = ".$id;
		$toProd = $oDB->fetchAll($zQuery);
		$id = $toProd[0]->accueil_id;

		//Chargement des promotions
		$listeDAO = jDao::create('accueil~accueil');
		$conditions = jDao::createConditions();
		$conditions->addItemOrder("accueil_prenom","ASC");
		$conditions->addItemOrder("accueil_nom","ASC");
		$oListeAccueil = $listeDAO->findBy($conditions);		
	
		$iIndexPage = 0 ;
		$toListeAccueil = array () ;
		while ($oListe = $oListeAccueil->fetch ()){

			if ($oListe->accueil_id == $id) {
				$iIndexPage = count($toListeAccueil);
			}
			array_push ($toListeAccueil, $oListe) ;
		}
		
		switch ($iNewOrder) {
			case 1 :		// Descendre
				$toListeAccueil[$iIndexPage]->accueil_ordreAffichage++ ;
				$listeDAO->update($toListeAccueil[$iIndexPage]) ;
				$toListeAccueil[$iIndexPage + 1]->accueil_ordreAffichage-- ;
				$listeDAO->update($toListeAccueil[$iIndexPage + 1]) ;
				break ;
			case 2 :		// Monter
				$toListeAccueil[$iIndexPage]->accueil_ordreAffichage-- ;
				$listeDAO->update($toListeAccueil[$iIndexPage]) ;
				$toListeAccueil[$iIndexPage - 1]->accueil_ordreAffichage++ ;
				$listeDAO->update($toListeAccueil[$iIndexPage - 1]) ;
				break ;
		}
		*/
		
	}
	/**
    * Chargement de la liste des accueils (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets accueils , nombre d'enregistrement
    */
    static function chargeListeAccueil($sortField="accueil_prenom", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeAccueil = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql = "SELECT m.* FROM accueil AS m ";

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}

		$rs = $cnx->query($zSql);
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM accueil");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		while($record = $rs->fetch()){
		
			$record->accueil_prenom = stripslashes($record->accueil_prenom);
			$record->accueil_nom = stripslashes($record->accueil_nom);

			array_push($listeAccueil, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeAccueil'] = $listeAccueil;
		//print_r($tResult);
		return $tResult ;

	}

	/**
    * Enregistrement d'une accueil
	*
	* @param accueil
	* @return false
    */
    static function sauvegardeAccueil($accueil) {

		jClasses::inc('commun~tools');
		//Tools::addantislash($accueil);

		//Get the connexion
		$oCnx = jDb::getConnection();

		if (!isset($accueil->id) || $accueil->id==0) { // insertion
			//Requette d'ajout			
			$zQuery = "INSERT INTO accueil ";
			$zQuery .= "(accueil_id,accueil_serviceId,accueil_prenom,accueil_nom,";
			$zQuery .= "accueil_adresse,accueil_codePostal,accueil_ville,";
			$zQuery .= "accueil_pays,accueil_email,accueil_telephone,accueil_publier)";
			$zQuery .= "VALUES ('0', " . $oCnx->quote($accueil->service) .",". $oCnx->quote($accueil->prenom). "," .$oCnx->quote($accueil->nom)." ," ;
			$zQuery .= $oCnx->quote($accueil->adresse). " , ". $oCnx->quote($accueil->codePostal)." , ".$oCnx->quote($accueil->ville)."," ;
			$zQuery .= $oCnx->quote($accueil->pays).", ".$oCnx->quote($accueil->email)." ," .$oCnx->quote($accueil->telephone)." ," .$oCnx->quote($accueil->publier)." )";
		} else 
		{ //update
			$zQuery = "UPDATE accueil SET \n	accueil_id=".$oCnx->quote($accueil->id)." ";
			if (isset($accueil->service)) {
				$zQuery .= "\n, accueil_serviceId=".$oCnx->quote($accueil->service)."";
			}
			if (isset($accueil->nom)) {
				$zQuery .= "\n, accueil_nom=".$oCnx->quote($accueil->nom)."";
			}
			if (isset($accueil->prenom)) {
				$zQuery .= "\n, accueil_prenom=".$oCnx->quote($accueil->prenom)."";
			}
			if (isset($accueil->adresse)) {
				$zQuery .= "\n, accueil_adresse=".$oCnx->quote($accueil->adresse)."";
			}
			if (isset($accueil->codePostal)) {
				$zQuery .= "\n, accueil_codePostal=".$oCnx->quote($accueil->codePostal)."";
			}
			if (isset($accueil->ville)) {
				$zQuery .= "\n, accueil_ville=".$oCnx->quote($accueil->ville)."";
			}
			if (isset($accueil->pays)) {
				$zQuery .= "\n, accueil_pays=".$oCnx->quote($accueil->pays)."";
			}
			if (isset($accueil->email)) {
				$zQuery .= "\n, accueil_email=".$oCnx->quote($accueil->email)."";
			}
			if (isset($accueil->telephone)) {
				$zQuery .= "\n, accueil_telephone=".$oCnx->quote($accueil->telephone)."";
			}
			$zQuery .= "\n, accueil_publier=".$oCnx->quote($accueil->publier)."";


			$zQuery .= " \nWHERE accueil_id=".$accueil->id;
			

		}


		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//echo ('COMMIT'); die;
			$oCnx->commit();						
		}catch (Exception $e) {
			print_r($accueil);
			//echo ('ROLLBACK'); die;
			$oCnx->rollback();
		}			
			
		
		return FALSE;
	}


	/**
    * Suppression d'une accueil
	*
	* @param integer Id de la accueil à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeAccueil($accueilId) {

		$rConn = jDb::getConnection();
		// 	Suppression physique d'une accueil
		$zQuery = "DELETE FROM accueil WHERE accueil_id=".$accueilId." ";
		$rConn->exec($zQuery);
		
		try {
			$rConn->startTransaction(); 
			$rConn->exec($zQuery);
			echo('DELETE TO COMMIT'); //die;
			$rConn->commit();						
		}catch (Exception $e) {
			echo('DELETE TO ROLLBACK'); die;
			$rConn->rollback();
		}			

		return TRUE;
	}
	
	
	/**
    * Chargement d'une accueil donnée
	*
	* @param integer $accueilId Id de la accueil souhaitée
	* @return objet accueil
    */
    static function chargeAccueil($accueilId) {
		// 	Chargement des données
		if (!$accueilId) {
			throw new Exception("No identifient sent!");
		}

		$zQuery = "select accueil_id,accueil_serviceId,accueil_prenom,accueil_nom,accueil_adresse,accueil_codePostal,accueil_ville,";
		$zQuery .= "accueil_pays,accueil_email,accueil_telephone,accueil_publier FROM accueil WHERE accueil_id=".$accueilId;
      	$pDbw = jDb::getDbWidget();
		
      	$iAccueil = count($toAccueil = $pDbw->fetchAll($zQuery));

		if ($iAccueil==0) {
        	throw new Exception("Accueil ". $accueilId . " not found!");
		}

		//$toAccueil[0]->accueil_id 			= stripslashes ( $toAccueil[0]->accueil_id ) ;
		//$toAccueil[0]->accueil_serviceId 	= stripslashes ( $toAccueil[0]->accueil_serviceId ) ;
		$toAccueil[0]->accueil_prenom 		= stripslashes ( $toAccueil[0]->accueil_prenom ) ;
		$toAccueil[0]->accueil_nom 			= stripslashes ( $toAccueil[0]->accueil_nom ) ;
		$toAccueil[0]->accueil_adresse 		= stripslashes ( $toAccueil[0]->accueil_adresse ) ;
		$toAccueil[0]->accueil_codePostal 	= stripslashes ( $toAccueil[0]->accueil_codePostal ) ;
		$toAccueil[0]->accueil_ville 		= stripslashes ( $toAccueil[0]->accueil_ville ) ;
		$toAccueil[0]->accueil_pays 		= stripslashes ( $toAccueil[0]->accueil_pays ) ; 		
		$toAccueil[0]->accueil_email 		= stripslashes ( $toAccueil[0]->accueil_email ) ; 		
		$toAccueil[0]->accueil_telephone 	= stripslashes ( $toAccueil[0]->accueil_telephone ) ; 		
		$toAccueil[0]->accueil_publier 		= stripslashes ( $toAccueil[0]->accueil_publier ) ; 					

		return $toAccueil[0];
	}


	/**
	*  Prendre la liste des services existants
	*
	*/
	static function getAllService()
	{
		$zQuery = "SELECT s.service_id, s.service_libelle, s.service_ordreAffichage, s.service_publier from service AS s order by s.service_libelle ASC ";
      	$pDbw = jDb::getDbWidget();
      	$toService = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toService as $oService)
		{
			$oService->service_libelle = stripslashes($oService->service_libelle);
			array_push($tResult, $oService);
		}
		
		return $tResult;

	}
	
	
	/**
    * Factory d'objet DAO format
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoAccueil() {

		$object = jDao::createRecord("accueil~accueil");
		//$object->format_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}


	/**
	* Renvoie la liste des accueils
	* @return array of object accueil
	*
	*/
		/*
    static function chargeListeAccueilFo() {
		$pDbw = jDb::getDbWidget();
		$zQuery = "SELECT accueil.* FROM  accueil 
			INNER JOIN boisson ON boisson.boisson_accueilId = accueil.accueil_id 
			INNER JOIN formatBoisson ON formatBoisson.formatBoisson_boissonId = boisson.boisson_id 
			INNER JOIN gda ON gda.gda_formatBoissonId = formatBoisson.formatBoisson_id 
			WHERE accueil_publier=1 AND gda.gda_publier = 1 
			GROUP BY accueil.accueil_id 
			ORDER BY accueil_ordreAffichage ASC ";
		$toAccueils = $pDbw->fetchAll($zQuery);		
		return $toAccueils ;
		return '';
	}
		*/

	/**
    * Chargement d'une accueil donnée en FO
	*
	* @param integer $accueilId Id de la accueil souhaitée
	* @return objet accueil
    */
		/*
    static function chargeAccueilFo($accueilId) {
		$zQuery = sprintf("SELECT * FROM accueil 
			INNER JOIN boisson ON boisson.boisson_accueilId = accueil.accueil_id  
			INNER JOIN formatBoisson ON formatBoisson.formatBoisson_boissonId = boisson.boisson_id 
			INNER JOIN format ON format.format_id = formatBoisson.formatBoisson_formatId 
			INNER JOIN gda ON gda.gda_formatBoissonId = formatBoisson.formatBoisson_id WHERE accueil_publier=1 AND accueil_id=%d AND gda.gda_publier=1 " ,$accueilId);
      	$pDbw = jDb::getDbWidget();
		$oAccueil = NULL;
      	
		if (count($toAccueil = $pDbw->fetchAll($zQuery))){
			$oAccueil = $toAccueil[0];
		}
		return $oAccueil;
		return '';
	}
		*/

	/**
    * Chargement d'une accueil par defaut en FO
	* @return objet accueil
    */
		/*
    static function chargeAccueilFoParDefaut() {
	
		$zQuery = "SELECT accueil.accueil_id FROM  accueil 
			INNER JOIN boisson ON boisson.boisson_accueilId = accueil.accueil_id 
			INNER JOIN formatBoisson ON formatBoisson.formatBoisson_boissonId = boisson.boisson_id 
			INNER JOIN gda ON gda.gda_formatBoissonId = formatBoisson.formatBoisson_id 
			WHERE accueil_publier=1 AND gda.gda_publier = 1 
			GROUP BY accueil.accueil_id 
			ORDER BY accueil_ordreAffichage ASC 
			LIMIT 0,1 ";

		$pDbw = jDb::getDbWidget();
		$oAccueil = NULL;      	
		if (count($toAccueil = $pDbw->fetchAll($zQuery))){
			$oAccueil = $toAccueil[0];
		}
		return $oAccueil;
		return '';
	}
		*/ 
}

?>
