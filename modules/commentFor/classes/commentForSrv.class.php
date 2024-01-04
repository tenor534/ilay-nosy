<?php
/**
* @package ilay-nosy
* @subpackage commentFor
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des commentFors
*
* @package ilay-nosy
* @subpackage commentFor
*/
class commentForSrv {

	/**
    * Chargement de la liste des commentFors (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets commentFors , nombre d'enregistrement
	
	 commentFor_id   	int(11)
	 commentFor_libelle  	varchar(150)
    */
    static function chargeListeCommentFor($sortField="commentFor_dateCreation", $sortDirection="DESC",$iDebutList=0 , $iListAll = 0) {

		$listeCommentFor = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM commentFor AS s";
		
		$zSql  = 	" SELECT c.* ";
		$zSql .=	" ,a.sujet_reference ";
		
		$zSql .=	" FROM commentFor AS c " ;

		$zSql .=	" LEFT JOIN sujet as a " ; 
		$zSql .=	" 	ON c.commentFor_sujetId = a.sujet_id";

		$zSql .=	" GROUP BY c.commentFor_id" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM commentFor");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeCommentFor = $oCommentForDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->commentFor_texte 		= stripslashes($record->commentFor_texte);
			$record->sujet_reference 	= stripslashes($record->sujet_reference);

			array_push($listeCommentFor, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeCommentFor'] = $listeCommentFor ;
		
		return $tResult ;
	}


    static function chargeAllCommentFor() {

		$listeCommentFor = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT s.* ";
		$zSql .=	" FROM commentFor AS s " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCommentFor, $record) ;
 		}

		$tResult = $listeCommentFor ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un commentFor donné
	*
	* @param integer $commentForId Id de l'commentFor souhaitée
	* @return object $toCommentFor  objet commentFor
    */
    static function chargeCommentFor($commentForId) {

		// 	Chargement des données
		if (!$commentForId) {
			throw new Exception("Pas d'identifient du commentFor envoyé");
		}

		$zQuery = "SELECT commentFor_id

			, commentFor_sujetId
			, commentFor_utilisateurId
			, commentFor_texte
			, commentFor_dateCreation
			, commentFor_publier
			
			FROM commentFor WHERE commentFor_id=".$commentForId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iCommentFor = count($toCommentFor = $pDbw->fetchAll($zQuery));
		if ($iCommentFor==0) {
        	throw new Exception("CommentFor $commentForId non trouvée");
		}

		$toCommentFor[0]->commentFor_texte 			= stripslashes($toCommentFor[0]->commentFor_texte);
		
		return $toCommentFor[0];
	}

	/**
    * Enregistrement d'un commentFor
	*
	* @param object $commentFor Objet commentFor
    */
    static function sauvegardeCommentFor($commentFor) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'commentFor
		$commentFor->statut = isset($commentFor->statut)? $commentFor->statut : 0;
		
		if (!isset($commentFor->id) || $commentFor->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO commentFor VALUES (
				'0'
				," .$commentFor->sujetId ."
				," .$commentFor->utilisateurId ."
				," .$oCnx->quote($commentFor->texte). "
				," .$oCnx->quote($commentFor->dateCreation). "
				," .$commentFor->publier ."
				)";
				
			$oCnx->exec($zQuery);			
			$id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE commentFor SET \n
					commentFor_id=".$oCnx->quote($commentFor->id)."";
					
			if (isset($commentFor->sujetId)) {
				$zQuery .= "\n, commentFor_sujetId=".$commentFor->sujetId."";
			}
			if (isset($commentFor->utilisateurId)) {
				$zQuery .= "\n, commentFor_utilisateurId=".$commentFor->utilisateurId."";
			}
			if (isset($commentFor->texte)) {
				$zQuery .= "\n, commentFor_texte=".$oCnx->quote($commentFor->texte)."";
			}
			if (isset($commentFor->dateCreation)) {
				$zQuery .= "\n, commentFor_dateCreation=".$oCnx->quote($commentFor->dateCreation)."";
			}
			if (isset($commentFor->publier)) {
				$zQuery .= "\n, commentFor_publier=".$commentFor->publier."";
			}

			$zQuery .= " \nWHERE commentFor_id=".$commentFor->id;
			$oCnx->exec($zQuery);
			$id = $commentFor->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un commentFor
	*
	* @param integer Id du commentFor à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeCommentFor($commentForId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un commentFor
		$zQuery = "DELETE FROM commentFor WHERE commentFor_id=$commentForId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un commentFor
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateCommentForStatut($idCommentFor, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE commentFor SET commentFor_statut ='".$statut."' WHERE commentFor_id =".$idCommentFor;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO commentFor
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoCommentFor() {

		$object = jDao::createRecord("commentFor~commentFor");
		//$object->commentFor_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une commentFor
	* param int $membreId id du membre
	* return $membre objet membre
	*/
	static function infosCommentFor($commentForId){
		$dao=jDao::create("commentFor~commentFor");
		if(!($commentFor=$dao->get($commentForId))){
			$dao=new jSelectorDao('commentFor~commentFor','');
			$c=$dao->getDaoRecordClass();
			$commentFor=new $c ();
		}
		return $commentFor;
	}	
	
	/**
	* selectionner les forfaits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function getAllCommentFor($idSujetId, $sortDirection="ASC")
	{
		$zQuery = " SELECT c.*, u.* 
					FROM commentFor AS c 
					LEFT JOIN utilisateur AS u 
						ON c.commentFor_utilisateurId = u.utilisateur_id 
					WHERE c.commentFor_sujetId = '".$idSujetId."' 
					AND c.commentFor_publier = 1  
					ORDER BY c.commentFor_dateCreation " . $sortDirection;
      	$pDbw = jDb::getDbWidget();
      	$toCommentFor = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toCommentFor as $oCommentFor)
		{
			$oCommentFor->commentFor_texte = stripslashes($oCommentFor->commentFor_texte);
			array_push($tResult, $oCommentFor);
		}
		return $tResult;
	}	
	
	
	/**
	* selectionner les forfaits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function getAllCommentForByForum($idForumId, $sortDirection="DESC")
	{
		$zQuery = " SELECT c.*, u.* 
					FROM commentFor AS c 					
					LEFT JOIN utilisateur AS u 
						ON c.commentFor_utilisateurId = u.utilisateur_id 
					LEFT JOIN sujet AS s 
						ON c.commentFor_sujetId = s.sujet_id 
					WHERE s.sujet_forumId = '".$idForumId."' 
						AND c.commentFor_publier = 1 
					ORDER BY c.commentFor_dateCreation " . $sortDirection;
      	$pDbw = jDb::getDbWidget();
      	$toCommentFor = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toCommentFor as $oCommentFor)
		{
			$oCommentFor->commentFor_texte = stripslashes($oCommentFor->commentFor_texte);
			array_push($tResult, $oCommentFor);
		}
		return $tResult;
	}	
	/**
	* selectionner les forfaits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function countCommentForPerUser($idUtilisateurId, $sortDirection="ASC")
	{
		$zQuery = " SELECT c.* 
					FROM commentFor AS c 
					WHERE c.commentFor_publier = 1  
					AND c.commentFor_utilisateurId = '".$idUtilisateurId."' 
					ORDER BY c.commentFor_dateCreation " . $sortDirection;
					
      	$pDbw = jDb::getDbWidget();
      	$toCommentFor = $pDbw->fetchAll($zQuery);
		
		return sizeof($toCommentFor);
	}	
}

?>
