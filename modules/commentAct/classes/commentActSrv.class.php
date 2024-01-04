<?php
/**
* @package ilay-nosy
* @subpackage commentAct
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des commentActs
*
* @package ilay-nosy
* @subpackage commentAct
*/
class commentActSrv {

	/**
    * Chargement de la liste des commentActs (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets commentActs , nombre d'enregistrement
	
	 commentAct_id   	int(11)
	 commentAct_libelle  	varchar(150)
    */
    static function chargeListeCommentAct($sortField="commentAct_dateCreation", $sortDirection="DESC",$iDebutList=0 , $iListAll = 0) {

		$listeCommentAct = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM commentAct AS s";
		
		$zSql  = 	" SELECT c.* ";
		$zSql .=	" ,a.actualite_reference ";
		
		$zSql .=	" FROM commentAct AS c " ;

		$zSql .=	" LEFT JOIN actualite as a " ; 
		$zSql .=	" 	ON c.commentAct_actualiteId = a.actualite_id";

		$zSql .=	" GROUP BY c.commentAct_id" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM commentAct");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeCommentAct = $oCommentActDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->commentAct_texte 		= stripslashes($record->commentAct_texte);
			$record->actualite_reference 	= stripslashes($record->actualite_reference);

			array_push($listeCommentAct, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeCommentAct'] = $listeCommentAct ;
		
		return $tResult ;
	}


    static function chargeAllCommentAct() {

		$listeCommentAct = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT s.* ";
		$zSql .=	" FROM commentAct AS s " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCommentAct, $record) ;
 		}

		$tResult = $listeCommentAct ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un commentAct donné
	*
	* @param integer $commentActId Id de l'commentAct souhaitée
	* @return object $toCommentAct  objet commentAct
    */
    static function chargeCommentAct($commentActId) {

		// 	Chargement des données
		if (!$commentActId) {
			throw new Exception("Pas d'identifient du commentAct envoyé");
		}

		$zQuery = "SELECT commentAct_id

			, commentAct_actualiteId
			, commentAct_utilisateurId
			, commentAct_texte
			, commentAct_dateCreation
			, commentAct_publier
			
			FROM commentAct WHERE commentAct_id=".$commentActId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iCommentAct = count($toCommentAct = $pDbw->fetchAll($zQuery));
		if ($iCommentAct==0) {
        	throw new Exception("CommentAct $commentActId non trouvée");
		}

		$toCommentAct[0]->commentAct_texte 			= stripslashes($toCommentAct[0]->commentAct_texte);
		
		return $toCommentAct[0];
	}

	/**
    * Enregistrement d'un commentAct
	*
	* @param object $commentAct Objet commentAct
    */
    static function sauvegardeCommentAct($commentAct) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'commentAct
		$commentAct->statut = isset($commentAct->statut)? $commentAct->statut : 0;
		
		if (!isset($commentAct->id) || $commentAct->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO commentAct VALUES (
				'0'
				," .$commentAct->actualiteId ."
				," .$commentAct->utilisateurId ."
				," .$oCnx->quote($commentAct->texte). "
				," .$oCnx->quote($commentAct->dateCreation). "
				," .$commentAct->publier ."
				)";
				
			$oCnx->exec($zQuery);			
			$id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE commentAct SET \n
					commentAct_id=".$oCnx->quote($commentAct->id)."";
					
			if (isset($commentAct->actualiteId)) {
				$zQuery .= "\n, commentAct_actualiteId=".$commentAct->actualiteId."";
			}
			if (isset($commentAct->utilisateurId)) {
				$zQuery .= "\n, commentAct_utilisateurId=".$commentAct->utilisateurId."";
			}
			if (isset($commentAct->texte)) {
				$zQuery .= "\n, commentAct_texte=".$oCnx->quote($commentAct->texte)."";
			}
			if (isset($commentAct->dateCreation)) {
				$zQuery .= "\n, commentAct_dateCreation=".$oCnx->quote($commentAct->dateCreation)."";
			}
			if (isset($commentAct->publier)) {
				$zQuery .= "\n, commentAct_publier=".$commentAct->publier."";
			}

			$zQuery .= " \nWHERE commentAct_id=".$commentAct->id;
			$oCnx->exec($zQuery);
			$id = $commentAct->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un commentAct
	*
	* @param integer Id du commentAct à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeCommentAct($commentActId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un commentAct
		$zQuery = "DELETE FROM commentAct WHERE commentAct_id=$commentActId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un commentAct
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateCommentActStatut($idCommentAct, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE commentAct SET commentAct_statut ='".$statut."' WHERE commentAct_id =".$idCommentAct;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO commentAct
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoCommentAct() {

		$object = jDao::createRecord("commentAct~commentAct");
		//$object->commentAct_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une commentAct
	* param int $membreId id du membre
	* return $membre objet membre
	*/
	static function infosCommentAct($commentActId){
		$dao=jDao::create("commentAct~commentAct");
		if(!($commentAct=$dao->get($commentActId))){
			$dao=new jSelectorDao('commentAct~commentAct','');
			$c=$dao->getDaoRecordClass();
			$commentAct=new $c ();
		}
		return $commentAct;
	}	
	
	/**
	* selectionner les forfaits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function getAllCommentAct($idActualiteId)
	{
		$zQuery = " SELECT c.*
					FROM commentAct AS c 
					WHERE c.commentAct_actualiteId = '".$idActualiteId."' 
					AND c.commentAct_publier = 1  
					ORDER BY c.commentAct_dateCreation ASC";
      	$pDbw = jDb::getDbWidget();
      	$toCommentAct = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toCommentAct as $oCommentAct)
		{
			$oCommentAct->commentAct_texte = stripslashes($oCommentAct->commentAct_texte);
			array_push($tResult, $oCommentAct);
		}
		return $tResult;
	}	
	/**
	* selectionner les forfaits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function countCommentActPerUser($idUtilisateurId)
	{
		$zQuery = " SELECT c.*
					FROM commentAct AS c 
					WHERE c.commentAct_publier = 1  
					AND c.commentAct_utilisateurId = '".$idUtilisateurId."' 
					";
      	$pDbw = jDb::getDbWidget();
      	$toCommentAct = $pDbw->fetchAll($zQuery);
		
		return sizeof($toCommentAct);
	}	
}

?>
