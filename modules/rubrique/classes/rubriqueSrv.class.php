<?php
/**
* @package ilay-nosy
* @subpackage rubrique
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des rubriques
*
* @package ilay-nosy
* @subpackage rubrique
*/
class rubriqueSrv {

	/**
    * Chargement de la liste des rubriques (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets rubriques , nombre d'enregistrement
	
	 rubrique_id   	int(11)
	 rubrique_libelle  	varchar(150) 	
    */
    static function chargeListeRubrique($sortField="rubrique_sortCode", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeRubrique = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM rubrique AS s";
		
		$zSql  = 	" SELECT r.* ";
		$zSql .=	" ,c.categorieAn_code ";
		
		$zSql .=	" ,COUNT(an.annonce_rubriqueId) AS rubrique_nbAnnonce ";

		$zSql .=	" FROM rubrique AS r " ;

		$zSql .=	" LEFT JOIN categorieAn as c " ; 
		$zSql .=	" 	ON r.rubrique_categorieAnId = c.categorieAn_id";

		//annonce
		$zSql .=	" LEFT JOIN annonce AS an " ;
		$zSql .=	" 	ON ( an.annonce_rubriqueId = r.rubrique_id  AND an.annonce_publier = 1)";

		$zSql .=	" GROUP BY r.rubrique_id" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM rubrique");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".RUBRIQUE_PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeRubrique = $oRubriqueDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->rubrique_level 	= stripslashes($record->rubrique_level);
			$record->rubrique_path 		= stripslashes($record->rubrique_path);
			$record->rubrique_libelle 	= stripslashes($record->rubrique_libelle);
			$record->rubrique_code 		= stripslashes($record->rubrique_code);

			$record->categorieAn_code 	= stripslashes($record->categorieAn_code);

			array_push($listeRubrique, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeRubrique'] = $listeRubrique ;
		
		return $tResult ;
	}



	/**
    * Chargement de la liste des rubriques (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets rubriques , nombre d'enregistrement
	
	 rubrique_id   	int(11)
	 rubrique_libelle  	varchar(150) 	
    */
    static function chargeListeCategorieRubrique($sortField="rubrique_sortCode", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeRubrique = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM rubrique AS s";
		
		$zSql  = 	" SELECT r.* ";
		$zSql .=	" ,c.categorieAn_code ";
		
		$zSql .=	" ,COUNT(an.annonce_rubriqueId) AS rubrique_nbAnnonce ";

		$zSql .=	" FROM rubrique AS r " ;

		$zSql .=	" LEFT JOIN categorieAn as c " ; 
		$zSql .=	" 	ON r.rubrique_categorieAnId = c.categorieAn_id";

		//annonce
		$zSql .=	" LEFT JOIN annonce AS an " ;
		$zSql .=	" 	ON an.annonce_rubriqueId = r.rubrique_id ";

		$zSql .=	" GROUP BY r.rubrique_id" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM rubrique");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".RUBRIQUE_PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeRubrique = $oRubriqueDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->rubrique_level 	= stripslashes($record->rubrique_level);
			$record->rubrique_path 		= stripslashes($record->rubrique_path);
			$record->rubrique_libelle 	= stripslashes($record->rubrique_libelle);
			$record->rubrique_code 		= stripslashes($record->rubrique_code);

			$record->categorieAn_code 	= stripslashes($record->categorieAn_code);

			array_push($listeRubrique, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeRubrique'] = $listeRubrique ;
		
		return $tResult ;
	}

    static function chargeAllRubrique() {

		$listeRubrique = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM rubrique AS r " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeRubrique, $record) ;
 		}

		$tResult = $listeRubrique ;
		
		return $tResult ;

	}	
	
    static function chargeAllRubriqueWithout($id) {

		$listeRubrique = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM rubrique AS r " ;
		$zSql .=	" WHERE r.rubrique_id <> $id" ;
		$zSql .=	" ORDER BY r.rubrique_path" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeRubrique, $record) ;
 		}

		$tResult = $listeRubrique ;
		return $tResult ;
	}

	/**
    * Chargement d'un rubrique donné
	*
	* @param integer $rubriqueId Id de l'rubrique souhaitée
	* @return object $toRubrique  objet rubrique
    */
    static function chargeRubrique($rubriqueId) {

		// 	Chargement des données
		if (!$rubriqueId) {
			throw new Exception("Pas d'identifient du rubrique envoyé");
		}

		$zQuery = "SELECT rubrique_id

				, rubrique_parentId
				, rubrique_categorieAnId
				, rubrique_level
				, rubrique_path
				, rubrique_libelle
				, rubrique_code
				, rubrique_sortCode

			FROM rubrique WHERE rubrique_id=".$rubriqueId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iRubrique = count($toRubrique = $pDbw->fetchAll($zQuery));
		if ($iRubrique==0) {
        	throw new Exception("Rubrique $rubriqueId non trouvée");
		}

		$toRubrique[0]->rubrique_level 			= stripslashes($toRubrique[0]->rubrique_level);
		$toRubrique[0]->rubrique_path 			= stripslashes($toRubrique[0]->rubrique_path);
		$toRubrique[0]->rubrique_libelle 		= stripslashes($toRubrique[0]->rubrique_libelle);
		$toRubrique[0]->rubrique_code			= stripslashes($toRubrique[0]->rubrique_code);
		
		return $toRubrique[0];
	}

	/**
    * Enregistrement d'un rubrique
	*
	* @param object $rubrique Objet rubrique
    */
    static function sauvegardeRubrique($rubrique) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'rubrique
		$rubrique->statut = isset($rubrique->statut)? $rubrique->statut : 0;
		
		if (!isset($rubrique->id) || $rubrique->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO rubrique VALUES (
				'0'
				," .$rubrique->parentId ."
				," .$rubrique->categorieAnId ."
				," .$oCnx->quote($rubrique->level). "
				," .$oCnx->quote($rubrique->path). "
				," .$oCnx->quote($rubrique->libelle). "
				," .$oCnx->quote($rubrique->code). "
				," .$oCnx->quote($rubrique->sortCode). "				
				)";
				
			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE rubrique SET \n
					rubrique_id=".$oCnx->quote($rubrique->id)."";
					
			if (isset($rubrique->parentId)) {
				$zQuery .= "\n, rubrique_parentId=".$rubrique->parentId."";
			}
			if (isset($rubrique->categorieAnId)) {
				$zQuery .= "\n, rubrique_categorieAnId=".$rubrique->categorieAnId."";
			}
			if (isset($rubrique->level)) {
				$zQuery .= "\n, rubrique_level=".$oCnx->quote($rubrique->level)."";
			}
			if (isset($rubrique->path)) {
				$zQuery .= "\n, rubrique_path=".$oCnx->quote($rubrique->path)."";
			}
			if (isset($rubrique->libelle)) {
				$zQuery .= "\n, rubrique_libelle=".$oCnx->quote($rubrique->libelle)."";
			}
			if (isset($rubrique->code)) {
				$zQuery .= "\n, rubrique_code=".$oCnx->quote($rubrique->code)."";
			}
			if (isset($rubrique->sortCode)) {
				$zQuery .= "\n, rubrique_sortCode=".$oCnx->quote($rubrique->sortCode)."";
			}

			$zQuery .= " \nWHERE rubrique_id=".$rubrique->id;
			$oCnx->exec($zQuery);
	        $id = $rubrique->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un rubrique
	*
	* @param integer Id du rubrique à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeRubrique($rubriqueId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un rubrique
		$zQuery = "DELETE FROM rubrique WHERE rubrique_id=$rubriqueId";
		$rConn->exec($zQuery);

		return TRUE;
	}

	/**
    * Update le statut d'un rubrique
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateRubriqueStatut($idRubrique, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE rubrique SET rubrique_statut ='".$statut."' WHERE rubrique_id =".$idRubrique;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO rubrique
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoRubrique() {

		$object = jDao::createRecord("rubrique~rubrique");
		//$object->rubrique_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une rubrique
	* param int $rubriqueId id de la rubrique
	* return $rubrique objet rubrique
	*/
	static function getRubrique($rubriqueId){
		$dao=jDao::create("rubrique~rubrique");
		if(!($rubrique=$dao->get($rubriqueId))){
			$dao=new jSelectorDao('rubrique~rubrique','');
			$c=$dao->getDaoRecordClass();
			$rubrique=new $c ();
		}
		return $rubrique;
	}	
	
	/**
	* renvoit les infos d'une rubrique
	* param int $rubriqueId id de la rubrique
	* return $rubrique objet rubrique
	*/
	static function getRubriqueFrere($parentId){
		$zQuery = "SELECT r.*
				FROM rubrique AS r 
				WHERE r.rubrique_parentId = '".$parentId."' 
				ORDER BY r.rubrique_sortCode DESC";
      	$pDbw = jDb::getDbWidget();
      	$toRubrique = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toRubrique as $oRubrique)
		{
			$oRubrique->rubrique_libelle = stripslashes($oRubrique->rubrique_libelle);
			array_push($tResult, $oRubrique);
		}
		return $tResult;
	}		
	
	/**
	* selectionner les rubriques existant pour une catégorie donnée
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function getAllRubrique($idCategorieAnId)
	{
		$zQuery = "SELECT r.*
				FROM rubrique AS r 
				WHERE r.rubrique_categorieAnId = '".$idCategorieAnId."' 
				ORDER BY r.rubrique_sortCode";
      	$pDbw = jDb::getDbWidget();
      	$toRubrique = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toRubrique as $oRubrique)
		{
			$oRubrique->rubrique_libelle = stripslashes($oRubrique->rubrique_libelle);
			array_push($tResult, $oRubrique);
		}
		return $tResult;
	}

	/**
	* selectionner les rubriques existant pour une catégorie donnée
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function updateAllRubriqueChildren($rubrique, $newParent, $originalRubrique, $orginalSortCodeLength )
	{
		//Get the connexion
		$oCnx = jDb::getConnection();

		$zQuery = "UPDATE rubrique SET ";
		$zQuery.= "rubrique_sortCode = CONCAT('$rubrique->sortCode', RIGHT(rubrique_sortCode, LENGTH(rubrique_sortCode) - $orginalSortCodeLength)), ";
		//$zQuery.= "rubrique_level = rubrique_level + ($rubrique->level - $originalRubrique->rubrique_level), ";
		$zQuery.= "rubrique_path = CONCAT('$newParent->rubrique_path', SUBSTRING(rubrique_path,POSITION(CONCAT('/', '$rubrique->id','/') IN rubrique_path)  +1)) ";
		$zQuery.= "WHERE rubrique_sortCode LIKE '".$originalRubrique->rubrique_sortCode.":%' ";

		$oCnx->exec($zQuery);
	}

	static function updateAllRubriqueAffected($orginalSortCodeRoot, $orginalSortCodeLength, $orginalSortCodeEnd )
	{
		//Get the connexion
		$oCnx = jDb::getConnection();

		$zQuery = "UPDATE rubrique SET ";
		$zQuery.= "rubrique_sortCode = CONCAT('$orginalSortCodeRoot', LPAD(SUBSTRING(rubrique_sortCode,$orginalSortCodeLength -3+1,3) - 1, 3, '0'), RIGHT(rubrique_sortCode, LENGTH(rubrique_sortCode) -$orginalSortCodeLength)) ";
		$zQuery.= "WHERE LEFT(rubrique_sortCode, $orginalSortCodeLength -3) = '$orginalSortCodeRoot' ";
		$zQuery.= "AND SUBSTRING(rubrique_sortCode, $orginalSortCodeLength -3+1,3)  > $orginalSortCodeEnd ";

		$oCnx->exec($zQuery);
	}
	
	/**
	* Recalcule le sortcode (Remonte d'un cran) toutes les rubriques impactées par la suppression de la la rubrique $deletedSortCode
	*/
	function updateSortCodeOnSuppression($deletedSortCode){
	
		$oCnx = jDb::getConnection();

		$orginalSortCodeLength 	= strlen($deletedSortCode);
		$orginalSortCodeRoot 	= substr($deletedSortCode, 0, strlen($deletedSortCode) - 3);
		$orginalSortCodeEnd 	= intval(substr($deletedSortCode, strlen($deletedSortCode) - 3,3));
	
		//On met à jour tous les pages et leurs enfants dont l'ordre a été MAJ du fait de la suppression de l'page modifié.
		$zQuery = "UPDATE rubrique SET ";
		$zQuery.= "rubrique_sortCode = CONCAT('$orginalSortCodeRoot', LPAD(SUBSTRING(rubrique_sortCode,$orginalSortCodeLength -3+1,3) - 1, 3, '0'), SUBSTRING(rubrique_sortCode, $orginalSortCodeLength + 1)) ";
		$zQuery.= "WHERE LEFT(rubrique_sortCode, $orginalSortCodeLength -3) = '$orginalSortCodeRoot' ";
		$zQuery.= "AND SUBSTRING(rubrique_sortCode, $orginalSortCodeLength -3+1,3)  > $orginalSortCodeEnd ;";
	
		$oCnx->exec($zQuery);
	}
	


}

?>
