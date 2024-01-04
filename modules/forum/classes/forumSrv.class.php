<?php
/**
* @package ilay-nosy
* @subpackage forum
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des forums
*
* @package ilay-nosy
* @subpackage forum
*/
class forumSrv {

	/**
    * Chargement de la liste des forums (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets forums , nombre d'enregistrement
	
	 forum_id   	int(11)
	 forum_libelle  	varchar(150) 	
    */
    static function chargeListeForum($sortField="forum_sortCode", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeForum = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM forum AS s";
		
		$zSql  = 	" SELECT r.* ";
		$zSql .=	" ,c.categorieFor_code ";
		
		$zSql .=	" ,COUNT(an.sujet_forumId) AS forum_nbSujet ";

		$zSql .=	" FROM forum AS r " ;

		$zSql .=	" LEFT JOIN categorieFor as c " ; 
		$zSql .=	" 	ON r.forum_categorieForId = c.categorieFor_id";

		//sujet
		$zSql .=	" LEFT JOIN sujet AS an " ;
		$zSql .=	" 	ON an.sujet_forumId = r.forum_id ";

		$zSql .=	" GROUP BY r.forum_id" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM forum");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".RUBRIQUE_PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeForum = $oForumDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->forum_level 	= stripslashes($record->forum_level);
			$record->forum_path 		= stripslashes($record->forum_path);
			$record->forum_libelle 	= stripslashes($record->forum_libelle);
			$record->forum_description 		= stripslashes($record->forum_description);

			$record->categorieFor_code 	= stripslashes($record->categorieFor_code);

			array_push($listeForum, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeForum'] = $listeForum ;
		
		return $tResult ;
	}



	/**
    * Chargement de la liste des forums (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets forums , nombre d'enregistrement
	
	 forum_id   	int(11)
	 forum_libelle  	varchar(150) 	
    */
    static function chargeListeCategorieForum($sortField="forum_sortCode", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeForum = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM forum AS s";
		
		$zSql  = 	" SELECT r.* ";
		$zSql .=	" ,c.categorieFor_code ";
		
		$zSql .=	" ,COUNT(an.sujet_forumId) AS forum_nbSujet ";

		$zSql .=	" FROM forum AS r " ;

		$zSql .=	" LEFT JOIN categorieFor as c " ; 
		$zSql .=	" 	ON r.forum_categorieForId = c.categorieFor_id";

		//sujet
		$zSql .=	" LEFT JOIN sujet AS an " ;
		$zSql .=	" 	ON an.sujet_forumId = r.forum_id ";

		$zSql .=	" GROUP BY r.forum_id" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM forum");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".RUBRIQUE_PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeForum = $oForumDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->forum_level 	= stripslashes($record->forum_level);
			$record->forum_path 		= stripslashes($record->forum_path);
			$record->forum_libelle 	= stripslashes($record->forum_libelle);
			$record->forum_description 		= stripslashes($record->forum_description);

			$record->categorieFor_code 	= stripslashes($record->categorieFor_code);

			array_push($listeForum, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeForum'] = $listeForum ;
		
		return $tResult ;
	}

    static function chargeAllForum() {

		$listeForum = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM forum AS r " ;
		$zSql .=	" ORDER BY r.forum_sortCode" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeForum, $record) ;
 		}

		$tResult = $listeForum ;
		
		return $tResult ;

	}	
	
    static function chargeAllForumWithout($id) {

		$listeForum = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM forum AS r " ;
		$zSql .=	" WHERE r.forum_id <> $id" ;
		$zSql .=	" ORDER BY r.forum_path" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeForum, $record) ;
 		}

		$tResult = $listeForum ;
		return $tResult ;
	}

	/**
    * Chargement d'un forum donné
	*
	* @param integer $forumId Id de l'forum souhaitée
	* @return object $toForum  objet forum
    */
    static function chargeForum($forumId) {

		// 	Chargement des données
		if (!$forumId) {
			throw new Exception("Pas d'identifient du forum envoyé");
		}

		$zQuery = "SELECT forum_id

				, forum_parentId
				, forum_categorieForId
				, forum_level
				, forum_path
				, forum_libelle
				, forum_description
				, forum_sortCode

			FROM forum WHERE forum_id=".$forumId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iForum = count($toForum = $pDbw->fetchAll($zQuery));
		if ($iForum==0) {
        	throw new Exception("Forum $forumId non trouvée");
		}

		$toForum[0]->forum_level 			= stripslashes($toForum[0]->forum_level);
		$toForum[0]->forum_path 			= stripslashes($toForum[0]->forum_path);
		$toForum[0]->forum_libelle 		= stripslashes($toForum[0]->forum_libelle);
		$toForum[0]->forum_description			= stripslashes($toForum[0]->forum_description);
		
		return $toForum[0];
	}

	/**
    * Enregistrement d'un forum
	*
	* @param object $forum Objet forum
    */
    static function sauvegardeForum($forum) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'forum
		$forum->statut = isset($forum->statut)? $forum->statut : 0;
		
		if (!isset($forum->id) || $forum->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO forum VALUES (
				'0'
				," .$forum->parentId ."
				," .$forum->categorieForId ."
				," .$oCnx->quote($forum->level). "
				," .$oCnx->quote($forum->path). "
				," .$oCnx->quote($forum->libelle). "
				," .$oCnx->quote($forum->description). "
				," .$oCnx->quote($forum->sortCode). "				
				)";
				
			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE forum SET \n
					forum_id=".$oCnx->quote($forum->id)."";
					
			if (isset($forum->parentId)) {
				$zQuery .= "\n, forum_parentId=".$forum->parentId."";
			}
			if (isset($forum->categorieForId)) {
				$zQuery .= "\n, forum_categorieForId=".$forum->categorieForId."";
			}
			if (isset($forum->level)) {
				$zQuery .= "\n, forum_level=".$oCnx->quote($forum->level)."";
			}
			if (isset($forum->path)) {
				$zQuery .= "\n, forum_path=".$oCnx->quote($forum->path)."";
			}
			if (isset($forum->libelle)) {
				$zQuery .= "\n, forum_libelle=".$oCnx->quote($forum->libelle)."";
			}
			if (isset($forum->description)) {
				$zQuery .= "\n, forum_description=".$oCnx->quote($forum->description)."";
			}
			if (isset($forum->sortCode)) {
				$zQuery .= "\n, forum_sortCode=".$oCnx->quote($forum->sortCode)."";
			}

			$zQuery .= " \nWHERE forum_id=".$forum->id;
			$oCnx->exec($zQuery);
	        $id = $forum->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un forum
	*
	* @param integer Id du forum à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeForum($forumId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un forum
		$zQuery = "DELETE FROM forum WHERE forum_id=$forumId";
		$rConn->exec($zQuery);

		return TRUE;
	}

	/**
    * Update le statut d'un forum
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateForumStatut($idForum, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE forum SET forum_statut ='".$statut."' WHERE forum_id =".$idForum;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO forum
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoForum() {

		$object = jDao::createRecord("forum~forum");
		//$object->forum_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une forum
	* param int $forumId id de la forum
	* return $forum objet forum
	*/
	static function getForum($forumId){
		$dao=jDao::create("forum~forum");
		if(!($forum=$dao->get($forumId))){
			$dao=new jSelectorDao('forum~forum','');
			$c=$dao->getDaoRecordClass();
			$forum=new $c ();
		}
		return $forum;
	}	
	
	/**
	* renvoit les infos d'une forum
	* param int $forumId id de la forum
	* return $forum objet forum
	*/
	static function getForumFrere($parentId){
		$zQuery = "SELECT r.*
				FROM forum AS r 
				WHERE r.forum_parentId = '".$parentId."' 
				ORDER BY r.forum_sortCode DESC";
      	$pDbw = jDb::getDbWidget();
      	$toForum = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toForum as $oForum)
		{
			$oForum->forum_libelle = stripslashes($oForum->forum_libelle);
			array_push($tResult, $oForum);
		}
		return $tResult;
	}		
	
	/**
	* selectionner les forums existant pour une catégorie donnée
	* @param idCategorieForId
	* @return tableau de boissons
	*/
	static function getAllForum($idCategorieForId)
	{
		$zQuery = "SELECT r.*
				FROM forum AS r 
				WHERE r.forum_categorieForId = '".$idCategorieForId."' 
				ORDER BY r.forum_sortCode";
      	$pDbw = jDb::getDbWidget();
      	$toForum = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toForum as $oForum)
		{
			$oForum->forum_libelle = stripslashes($oForum->forum_libelle);
			array_push($tResult, $oForum);
		}
		return $tResult;
	}

	/**
	* selectionner les forums existant pour une catégorie donnée
	* @param idCategorieForId
	* @return tableau de boissons
	*/
	static function updateAllForumChildren($forum, $newParent, $originalForum, $orginalSortCodeLength )
	{
		//Get the connexion
		$oCnx = jDb::getConnection();

		$zQuery = "UPDATE forum SET ";
		$zQuery.= "forum_sortCode = CONCAT('$forum->sortCode', RIGHT(forum_sortCode, LENGTH(forum_sortCode) - $orginalSortCodeLength)), ";
		//$zQuery.= "forum_level = forum_level + ($forum->level - $originalForum->forum_level), ";
		$zQuery.= "forum_path = CONCAT('$newParent->forum_path', SUBSTRING(forum_path,POSITION(CONCAT('/', '$forum->id','/') IN forum_path)  +1)) ";
		$zQuery.= "WHERE forum_sortCode LIKE '".$originalForum->forum_sortCode.":%' ";

		$oCnx->exec($zQuery);
	}

	static function updateAllForumAffected($orginalSortCodeRoot, $orginalSortCodeLength, $orginalSortCodeEnd )
	{
		//Get the connexion
		$oCnx = jDb::getConnection();

		$zQuery = "UPDATE forum SET ";
		$zQuery.= "forum_sortCode = CONCAT('$orginalSortCodeRoot', LPAD(SUBSTRING(forum_sortCode,$orginalSortCodeLength -3+1,3) - 1, 3, '0'), RIGHT(forum_sortCode, LENGTH(forum_sortCode) -$orginalSortCodeLength)) ";
		$zQuery.= "WHERE LEFT(forum_sortCode, $orginalSortCodeLength -3) = '$orginalSortCodeRoot' ";
		$zQuery.= "AND SUBSTRING(forum_sortCode, $orginalSortCodeLength -3+1,3)  > $orginalSortCodeEnd ";

		$oCnx->exec($zQuery);
	}
	
	/**
	* Recalcule le sortcode (Remonte d'un cran) toutes les forums impactées par la suppression de la la forum $deletedSortCode
	*/
	function updateSortCodeOnSuppression($deletedSortCode){
	
		$oCnx = jDb::getConnection();

		$orginalSortCodeLength 	= strlen($deletedSortCode);
		$orginalSortCodeRoot 	= substr($deletedSortCode, 0, strlen($deletedSortCode) - 3);
		$orginalSortCodeEnd 	= intval(substr($deletedSortCode, strlen($deletedSortCode) - 3,3));
	
		//On met à jour tous les pages et leurs enfants dont l'ordre a été MAJ du fait de la suppression de l'page modifié.
		$zQuery = "UPDATE forum SET ";
		$zQuery.= "forum_sortCode = CONCAT('$orginalSortCodeRoot', LPAD(SUBSTRING(forum_sortCode,$orginalSortCodeLength -3+1,3) - 1, 3, '0'), SUBSTRING(forum_sortCode, $orginalSortCodeLength + 1)) ";
		$zQuery.= "WHERE LEFT(forum_sortCode, $orginalSortCodeLength -3) = '$orginalSortCodeRoot' ";
		$zQuery.= "AND SUBSTRING(forum_sortCode, $orginalSortCodeLength -3+1,3)  > $orginalSortCodeEnd ;";
	
		$oCnx->exec($zQuery);
	}
	


}

?>
