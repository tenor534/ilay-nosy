<?php
/**
* @marqueage ilay-nosy
* @submarqueage modele
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des modeles
*
* @marqueage ilay-nosy
* @submarqueage modele
*/
class modeleSrv {

	/**
    * Chargement de la liste des modeles (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets modeles , nombre d'enregistrement
	
	 modele_id   	int(11)
	 modele_libelle  	varchar(150) 	
    */
    static function chargeListeModele($sortField="marque_code, modele_id", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeModele = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM modele AS s";
		
		$zSql  = 	" SELECT f.* ";
		$zSql .=	" ,p.marque_code ";
		
		//$zSql .=	" ,COUNT(an.annonce_modeleId) AS modele_nbAnnonce ";
		$zSql .=	" ,COUNT(ab.vehicule_modeleId) AS modele_nbVehicule ";

		$zSql .=	" FROM modele AS f " ;

		$zSql .=	" LEFT JOIN marque as p " ; 
		$zSql .=	" 	ON f.modele_marqueId = p.marque_id";

		//annonce
		//$zSql .=	" LEFT JOIN annonce AS an " ;
		//$zSql .=	" 	ON an.annonce_modeleId = f.modele_id ";
		//vehicule
		$zSql .=	" LEFT JOIN vehicule AS ab " ;
		$zSql .=	" 	ON ab.vehicule_modeleId = f.modele_id ";

		$zSql .=	" GROUP BY f.modele_libelle" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM modele");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeModele = $oModeleDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->modele_libelle = stripslashes($record->modele_libelle);
			$record->modele_code 	= stripslashes($record->modele_code);

			$record->marque_code 	= stripslashes($record->marque_code);

			array_push($listeModele, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeModele'] = $listeModele ;
		
		return $tResult ;
	}


    static function chargeAllModele() {

		$listeModele = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM modele AS r " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeModele, $record) ;
 		}

		$tResult = $listeModele ;
		
		return $tResult ;

	}	
	
    static function chargeAllModeleWithout($id) {

		$listeModele = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT f.* ";
		$zSql .=	" FROM modele AS f " ;
		$zSql .=	" WHERE f.modele_id <> $id" ;
		$zSql .=	" ORDER BY f.modele_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeModele, $record) ;
 		}

		$tResult = $listeModele ;
		return $tResult ;
	}

	/**
    * Chargement d'un modele donné
	*
	* @param integer $modeleId Id de l'modele souhaitée
	* @return object $toModele  objet modele
    */
    static function chargeModele($modeleId) {

		// 	Chargement des données
		if (!$modeleId) {
			throw new Exception("Pas d'identifient du modele envoyé");
		}

		$zQuery = "SELECT modele_id

				, modele_marqueId
				, modele_libelle
				, modele_code

			FROM modele WHERE modele_id=".$modeleId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iModele = count($toModele = $pDbw->fetchAll($zQuery));
		if ($iModele==0) {
        	throw new Exception("Modele $modeleId non trouvée");
		}

		$toModele[0]->modele_libelle 		= stripslashes($toModele[0]->modele_libelle);
		
		return $toModele[0];
	}

	/**
    * Enregistrement d'un modele
	*
	* @param object $modele Objet modele
    */
    static function sauvegardeModele($modele) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'modele
		$modele->statut = isset($modele->statut)? $modele->statut : 0;
		
		if (!isset($modele->id) || $modele->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO modele VALUES (
				'0'
				," .$modele->marqueId ."
				," .$oCnx->quote($modele->libelle) ."
				," .$oCnx->quote($modele->code) ."
				)";


				
			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE modele SET \n
					modele_id=".$oCnx->quote($modele->id)."";
					
			if (isset($modele->marqueId)) {
				$zQuery .= "\n, modele_marqueId=".$modele->marqueId."";
			}				
			if (isset($modele->libelle)) {
				$zQuery .= "\n, modele_libelle=".$oCnx->quote($modele->libelle)."";
			}
			if (isset($modele->code)) {
				$zQuery .= "\n, modele_code=".$oCnx->quote($modele->code)."";
			}

			$zQuery .= " \nWHERE modele_id=".$modele->id;
			$oCnx->exec($zQuery);
	        $id = $modele->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un modele
	*
	* @param integer Id du modele à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeModele($modeleId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un modele
		$zQuery = "DELETE FROM modele WHERE modele_id=$modeleId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un modele
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateModeleStatut($idModele, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE modele SET modele_statut ='".$statut."' WHERE modele_id =".$idModele;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO modele
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoModele() {

		$object = jDao::createRecord("modele~modele");
		//$object->modele_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une modele
	* param int $modeleId id de la modele
	* return $modele objet modele
	*/
	static function getModele($modeleId){
		$dao=jDao::create("modele~modele");
		if(!($modele=$dao->get($modeleId))){
			$dao=new jSelectorDao('modele~modele','');
			$c=$dao->getDaoRecordClass();
			$modele=new $c ();
		}
		return $modele;
	}	
	
	/**
	* selectionner les modeles existant pour un marque donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function getAllModele($idMarqueId)
	{
		$zQuery = "SELECT r.*
				FROM modele AS r 
				WHERE r.modele_marqueId = '".$idMarqueId."' 
				ORDER BY r.modele_id";
      	$pDbw = jDb::getDbWidget();
      	$toModele = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toModele as $oModele)
		{
			$oModele->modele_libelle = stripslashes($oModele->modele_libelle);
			array_push($tResult, $oModele);
		}
		return $tResult;
	}

}

?>
