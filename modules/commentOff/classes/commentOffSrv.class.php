<?php
/**
* @package ilay-nosy
* @subpackage commentOff
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des commentOffs
*
* @package ilay-nosy
* @subpackage commentOff
*/
class commentOffSrv {

	/**
    * Chargement de la liste des commentOffs (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets commentOffs , nombre d'enregistrement
	
	 commentOff_id   	int(11)
	 commentOff_libelle  	varchar(150)
    */
    static function chargeListeCommentOff($sortField="commentOff_dateCreation", $sortDirection="DESC",$iDebutList=0 , $iListAll = 0) {

		$listeCommentOff = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM commentOff AS s";
		
		$zSql  = 	" SELECT c.* ";
		$zSql .=	" ,a.officiel_reference ";
		
		$zSql .=	" FROM commentOff AS c " ;

		$zSql .=	" LEFT JOIN officiel as a " ; 
		$zSql .=	" 	ON c.commentOff_officielId = a.officiel_id";

		$zSql .=	" GROUP BY c.commentOff_id" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM commentOff");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeCommentOff = $oCommentOffDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->commentOff_texte 		= stripslashes($record->commentOff_texte);
			$record->officiel_reference 	= stripslashes($record->officiel_reference);

			array_push($listeCommentOff, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeCommentOff'] = $listeCommentOff ;
		
		return $tResult ;
	}


    static function chargeAllCommentOff() {

		$listeCommentOff = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT s.* ";
		$zSql .=	" FROM commentOff AS s " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCommentOff, $record) ;
 		}

		$tResult = $listeCommentOff ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un commentOff donné
	*
	* @param integer $commentOffId Id de l'commentOff souhaitée
	* @return object $toCommentOff  objet commentOff
    */
    static function chargeCommentOff($commentOffId) {

		// 	Chargement des données
		if (!$commentOffId) {
			throw new Exception("Pas d'identifient du commentOff envoyé");
		}

		$zQuery = "SELECT commentOff_id

			, commentOff_officielId
			, commentOff_utilisateurId
			, commentOff_texte
			, commentOff_dateCreation
			, commentOff_publier
			
			FROM commentOff WHERE commentOff_id=".$commentOffId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iCommentOff = count($toCommentOff = $pDbw->fetchAll($zQuery));
		if ($iCommentOff==0) {
        	throw new Exception("CommentOff $commentOffId non trouvée");
		}

		$toCommentOff[0]->commentOff_texte 			= stripslashes($toCommentOff[0]->commentOff_texte);
		
		return $toCommentOff[0];
	}

	/**
    * Enregistrement d'un commentOff
	*
	* @param object $commentOff Objet commentOff
    */
    static function sauvegardeCommentOff($commentOff) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'commentOff
		$commentOff->statut = isset($commentOff->statut)? $commentOff->statut : 0;
		
		if (!isset($commentOff->id) || $commentOff->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO commentOff VALUES (
				'0'
				," .$commentOff->officielId ."
				," .$commentOff->utilisateurId ."
				," .$oCnx->quote($commentOff->texte). "
				," .$oCnx->quote($commentOff->dateCreation). "
				," .$commentOff->publier ."
				)";
				
			$oCnx->exec($zQuery);			
			$id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE commentOff SET \n
					commentOff_id=".$oCnx->quote($commentOff->id)."";
					
			if (isset($commentOff->officielId)) {
				$zQuery .= "\n, commentOff_officielId=".$commentOff->officielId."";
			}
			if (isset($commentOff->utilisateurId)) {
				$zQuery .= "\n, commentOff_utilisateurId=".$commentOff->utilisateurId."";
			}
			if (isset($commentOff->texte)) {
				$zQuery .= "\n, commentOff_texte=".$oCnx->quote($commentOff->texte)."";
			}
			if (isset($commentOff->dateCreation)) {
				$zQuery .= "\n, commentOff_dateCreation=".$oCnx->quote($commentOff->dateCreation)."";
			}
			if (isset($commentOff->publier)) {
				$zQuery .= "\n, commentOff_publier=".$commentOff->publier."";
			}

			$zQuery .= " \nWHERE commentOff_id=".$commentOff->id;
			$oCnx->exec($zQuery);
			$id = $commentOff->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un commentOff
	*
	* @param integer Id du commentOff à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeCommentOff($commentOffId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un commentOff
		$zQuery = "DELETE FROM commentOff WHERE commentOff_id=$commentOffId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un commentOff
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateCommentOffStatut($idCommentOff, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE commentOff SET commentOff_statut ='".$statut."' WHERE commentOff_id =".$idCommentOff;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO commentOff
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoCommentOff() {

		$object = jDao::createRecord("commentOff~commentOff");
		//$object->commentOff_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une commentOff
	* param int $membreId id du membre
	* return $membre objet membre
	*/
	static function infosCommentOff($commentOffId){
		$dao=jDao::create("commentOff~commentOff");
		if(!($commentOff=$dao->get($commentOffId))){
			$dao=new jSelectorDao('commentOff~commentOff','');
			$c=$dao->getDaoRecordClass();
			$commentOff=new $c ();
		}
		return $commentOff;
	}	
	
	/**
	* selectionner les forfaits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function getAllCommentOff($idOfficielId)
	{
		$zQuery = " SELECT c.*
					FROM commentOff AS c 
					WHERE c.commentOff_officielId = '".$idOfficielId."' 
					AND c.commentOff_publier = 1  
					ORDER BY c.commentOff_dateCreation ASC";
      	$pDbw = jDb::getDbWidget();
      	$toCommentOff = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toCommentOff as $oCommentOff)
		{
			$oCommentOff->commentOff_texte = stripslashes($oCommentOff->commentOff_texte);
			array_push($tResult, $oCommentOff);
		}
		return $tResult;
	}	
	/**
	* selectionner les forfaits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function countCommentOffPerUser($idUtilisateurId)
	{
		$zQuery = " SELECT c.*
					FROM commentOff AS c 
					WHERE c.commentOff_publier = 1  
					AND c.commentOff_utilisateurId = '".$idUtilisateurId."' 
					";
      	$pDbw = jDb::getDbWidget();
      	$toCommentOff = $pDbw->fetchAll($zQuery);
		
		return sizeof($toCommentOff);
	}	
}

?>
