<?php
/**
* @package ilay-nosy
* @subpackage sujet
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des sujets
*
* @package ilay-nosy
* @subpackage sujet
*/
class sujetSrv {

	/**
    * Chargement de la liste des sujets (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets sujets , nombre d'enregistrement
	
	 $cid, 
	 $fid, 
	 $mot, 
	 $parution, 
	 $precision,
	 $sortField, 
	 $sortDirection, 
	 $iDebutListe, 
	 0, 
	 $nbPagination	
    */
    static function chargeListeSujetRechercheFo($fid=0, $mot="", $parution=0, $precision=0, $sortField="sujet_datePublication", $sortDirection="DESC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {

		$listeSujet = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM sujet AS s";
		
		$zSql  = 	" SELECT s.* ";
		$zSql .=	" ,c.* ";
		$zSql .=	" ,u.* ";
		
		$zSql .=	" FROM sujet AS s " ;

		//commentaire
		$zSql .=	" LEFT JOIN commentFor AS c " ;
		$zSql .=	" 	ON c.commentFor_sujetId = s.sujet_id ";

		//utilisateur
		$zSql .=	" LEFT JOIN utilisateur AS u " ;
		$zSql .=	" 	ON u.utilisateur_id = s.sujet_utilisateurId ";

		$zSql .=	" GROUP BY s.sujet_id" ;

		$zSql .=	" HAVING 0=0 ";
		
		//Clauses
		$zClause = " ";
		
		//Catégories
		if($fid != 0){
			$zClause .=	" AND s.sujet_forumId=" . $fid ;
		}				
			
		//Mots clés
		if($mot != ""){
			if($precision == 1){ //Dans les sujet
				$zClause .=	" AND (UPPER(s.sujet_titre) LIKE '%$mot%')";
			}elseif($precision == 2){ //Dans les messages
				$zClause .=	" AND (UPPER(c.commentFor_texte) LIKE '%$mot%')";
			}else{
				$zClause .=	" AND ((UPPER(s.sujet_titre) LIKE '%$mot%') OR (UPPER(s.sujet_reference) LIKE '%$mot%') OR (UPPER(c.commentFor_texte) LIKE '%$mot%'))";
			}	
		}				
		
		if($parution != 0){
		
			switch($parution){
				case 1: //1jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(s.sujet_datePublication) <= 1";
					break;
				case 2: //2jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(s.sujet_datePublication) <= 2";
					break;
				case 3: //3jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(s.sujet_datePublication) <= 3";
					break;
				case 4: //1semaine
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(s.sujet_datePublication) <= 8";
					break;
				case 5: //2semaines
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(s.sujet_datePublication) <= 15";
					break;
				case 6: //1mois
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(s.sujet_datePublication) <= 30";
					break;
				case 7: //2 mois
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(s.sujet_datePublication) <= 61";
					break;
			}
		}		

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT s.*, c.*  
								FROM sujet as s 

								LEFT JOIN commentFor AS c
									ON c.commentFor_sujetId = s.sujet_id 
								GROUP BY s.sujet_id 
								HAVING 0=0 "  . $zClause);
								
								
		$recordCount = $rsCount->fetchAll() ;
		$iNbEnreg = sizeof($recordCount) ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeSujet = $oSujetDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->sujet_titre 		= stripslashes($record->sujet_titre);

			array_push($listeSujet, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeSujet'] = $listeSujet ;
		
		return $tResult ;
	}

    static function chargeListeSujet($cid=0, $sortField="forum_libelle ASC, sujet_datePublication", $sortDirection="DESC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {

		$listeSujet = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM sujet AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,c.* ";
		
		$zSql .=	" ,COUNT(p.photo_sujetId) AS sujet_nbPhoto ";
		$zSql .=	" ,COUNT(k.commentAct_sujetId) AS sujet_nbComment ";

		$zSql .=	" FROM sujet AS a " ;

		$zSql .=	" LEFT JOIN forum as c " ; 
		$zSql .=	" 	ON a.sujet_forumId = c.forum_id";

		//photo
		$zSql .=	" LEFT JOIN photoAct AS p " ;
		$zSql .=	" 	ON p.photo_sujetId = a.sujet_id ";
		//commentaire
		$zSql .=	" LEFT JOIN commentAct AS k " ;
		$zSql .=	" 	ON k.commentAct_sujetId = a.sujet_id ";

		$zSql .=	" GROUP BY a.sujet_id" ;

		$zSql .=	" HAVING 0=0 ";
		
		$zClause = " ";
		if($cid != 0){
			$zClause .=	" AND a.sujet_forumId=" . $cid ;
		}	

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg 
								FROM sujet as a 

								LEFT JOIN forum as c 
									ON a.sujet_forumId = c.forum_id
								LEFT JOIN commentAct AS k
									ON k.commentAct_sujetId = a.sujet_id
								WHERE 0=0 "  . $zClause);
								
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeSujet = $oSujetDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){

			$record->sujet_reference 	= stripslashes($record->sujet_reference);
			$record->sujet_titre 		= stripslashes($record->sujet_titre);
			$record->sujet_resume 		= stripslashes($record->sujet_resume);
			$record->sujet_texte 		= stripslashes($record->sujet_texte);			
			$record->sujet_photo 		= stripslashes($record->sujet_photo);
			$record->sujet_source 		= stripslashes($record->sujet_source);
			$record->sujet_fichier 		= stripslashes($record->sujet_fichier);

			$record->forum_libelle 	= stripslashes($record->forum_libelle);
			$record->forum_code 		= stripslashes($record->forum_code);

			array_push($listeSujet, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeSujet'] = $listeSujet ;
		
		return $tResult ;
	}

    static function chargeAllSujet() {

		$listeSujet = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM sujet AS a " ;
		$zSql .=	" WHERE 0=0 " ;
		$zSql .=	" 	AND a.sujet_publier = 1 " ;
		$zSql .=	" ORDER BY a.sujet_datePublication DESC" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeSujet, $record) ;
 		}

		$tResult = $listeSujet ;
		
		return $tResult ;

	}	
	
    static function chargeAllSujetWithout($id) {

		$listeSujet = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM sujet AS aa " ;
		$zSql .=	" WHERE a.sujet_id <> $id" ;
		$zSql .=	" 	AND a.sujet_publier = 1 " ;
		$zSql .=	" ORDER BY a.sujet_datePublication DESC" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeSujet, $record) ;
 		}

		$tResult = $listeSujet ;
		return $tResult ;
	}

	/**
    * Chargement d'un sujet donné
	*
	* @param integer $sujetId Id de l'sujet souhaitée
	* @return object $toSujet  objet sujet
    */
    static function chargeSujet($sujetId) {

		// 	Chargement des données
		if (!$sujetId) {
			throw new Exception("Pas d'identifient du sujet envoyé");
		}

		$zQuery = "SELECT sujet_id

			, sujet_utilisateurId
			, sujet_forumId
			
			, sujet_titre
			, sujet_reference
			, sujet_dateCreation
			, sujet_dateModification
			, sujet_datePublication
			, sujet_vue
			, sujet_publier

			FROM sujet WHERE sujet_id=".$sujetId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iSujet = count($toSujet = $pDbw->fetchAll($zQuery));
		if ($iSujet==0) {
        	throw new Exception("Sujet $sujetId non trouvée");
		}

		$toSujet[0]->sujet_reference 	= stripslashes($toSujet[0]->sujet_reference);
		$toSujet[0]->sujet_titre 		= stripslashes($toSujet[0]->sujet_titre);
		
		return $toSujet[0];
	}

	/**
    * Enregistrement d'un sujet
	*
	* @param object $sujet Objet sujet
    */
    static function sauvegardeSujet($sujet) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'sujet
		$sujet->statut = isset($sujet->statut)? $sujet->statut : 0;
		
		if (!isset($sujet->id) || $sujet->id==0) { // insertion
		
		
		//print_r($sujet);
			
			//Requette d'ajout
			$zQuery = "INSERT INTO sujet VALUES (
				'0'
				," .$sujet->utilisateurId ."
				," .$sujet->forumId ."
				," .$oCnx->quote($sujet->titre). "
				," .$oCnx->quote($sujet->reference). "
				," .$oCnx->quote($sujet->dateCreation). "
				," .$oCnx->quote($sujet->dateModification). "
				," .$oCnx->quote($sujet->datePublication). "
				," .$sujet->vue ."
				," .$sujet->publier ."
				)";
				//echo $zQuery;

			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE sujet SET \n
					sujet_id=".$oCnx->quote($sujet->id)."";
					
			if (isset($sujet->utilisateurId)) {
				$zQuery .= "\n, sujet_utilisateurId=".$sujet->utilisateurId."";
			}
			if (isset($sujet->forumId)) {
				$zQuery .= "\n, sujet_forumId=".$sujet->forumId."";
			}

			if (isset($sujet->titre)) {
				$zQuery .= "\n, sujet_titre=".$oCnx->quote($sujet->titre)."";
			}
			if (isset($sujet->reference)) {
				$zQuery .= "\n, sujet_reference=".$oCnx->quote($sujet->reference)."";
			}
			if (isset($sujet->dateCreation)) {
				$zQuery .= "\n, sujet_dateCreation=".$oCnx->quote($sujet->dateCreation)."";
			}
			if (isset($sujet->dateModification)) {
				$zQuery .= "\n, sujet_dateModification=".$oCnx->quote($sujet->dateModification)."";
			}
			if (isset($sujet->datePublication)) {
				$zQuery .= "\n, sujet_datePublication=".$oCnx->quote($sujet->datePublication)."";
			}					

			if (isset($sujet->vue)) {
				$zQuery .= "\n, sujet_vue=".$sujet->vue."";
			}			
			if (isset($sujet->publier)) {
				$zQuery .= "\n, sujet_publier=".$sujet->publier."";
			}

			$zQuery .= " \nWHERE sujet_id=".$sujet->id;
			
			$oCnx->exec($zQuery);
	        $id = $sujet->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un sujet
	*
	* @param integer Id du sujet à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeSujet($sujetId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un sujet
		$zQuery = "DELETE FROM sujet WHERE sujet_id=$sujetId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un sujet
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateSujetStatut($idSujet, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE sujet SET sujet_statut ='".$statut."' WHERE sujet_id =".$idSujet;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO sujet
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoSujet() {

		$object = jDao::createRecord("sujet~sujet");
		//$object->sujet_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une sujet
	* param int $sujetId id de la sujet
	* return $sujet objet sujet
	*/
	static function getSujet($sujetId){
		$dao=jDao::create("sujet~sujet");
		if(!($sujet=$dao->get($sujetId))){
			$dao=new jSelectorDao('sujet~sujet','');
			$c=$dao->getDaoRecordClass();
			$sujet=new $c ();
		}
		return $sujet;
	}	
	
	
	
	/**
	* selectionner les sujets existant pour une catégorie donnée
	* @param idForfaitId
	* @return tableau de boissons
	*/
	static function getAllSujet($idForumId)
	{
		$zQuery = "SELECT a.*
				FROM sujet AS a 
				WHERE a.sujet_forumId = '".$idForumId."' 
				ORDER BY a.sujet_datePublication DESC";
      	$pDbw = jDb::getDbWidget();
      	$toSujet = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toSujet as $oSujet)
		{
			$oSujet->sujet_titre = stripslashes($oSujet->sujet_titre);
			array_push($tResult, $oSujet);
		}
		return $tResult;
	}

	//With nb sujets
    static function getRandActByCategorie($idCategorieId) {

		$listeForum = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM sujet AS a " ;
		$zSql .=	" WHERE a.sujet_forumId = " . $idCategorieId ;
		$zSql .=	" 	AND a.sujet_publier = 1 " ;
		$zSql .=	" ORDER BY RAND()" ;
		$zSql .=	" LIMIT 1" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeForum, $record) ;
 		}

		$tResult = $listeForum ;
		
		return $tResult ;

	}

	//All sujets with limit
    static function getLastAct($nbFalls) {

		$listeSujet = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.*";

		$zSql .=	" FROM sujet AS a " ;

		$zSql .=	" WHERE 0=0 " ;
		$zSql .=	" 	AND a.sujet_publier = 1 " ;
		$zSql .=	" 	AND a.sujet_publierHome = 1 " ;
		$zSql .=	" ORDER BY a.sujet_datePublication DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeSujet, $record) ;
 		}

		$tResult = $listeSujet ;
		
		return $tResult ;
	}

	//All sujets by categorie
    static function getLastActByCategorie($idCategorieIds, $nbFalls) {

		$listeSujet = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.*";

		$zSql .=	" FROM sujet AS a " ;

		$zSql .=	" WHERE a.sujet_forumId IN (" . $idCategorieIds . ") " ;
		$zSql .=	" ORDER BY a.sujet_datePublication DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeSujet, $record) ;
 		}

		$tResult = $listeSujet ;
		
		return $tResult ;
	}


	//All sujets by categorie
    static function getTopActLaUNE($nbFalls=1) {

		$toSujets = array();
		
		$pDbw = jDb::getDbWidget();

		$zSql  = 	" SELECT a.*";
		$zSql .=	" FROM sujet AS a " ;		
		$zSql .=	" WHERE a.sujet_laUne = 1 " ;
		$zSql .=	" 	AND a.sujet_publier = 1 " ;
		$zSql .=	" 	AND a.sujet_publierHome = 1 " ;
		$zSql .=	" ORDER BY a.sujet_datePublication DESC " ;
		$zSql .=	" LIMIT 0, $nbFalls ";

		$toSujets = $pDbw->fetchAll($zSql);		
		
		return $toSujets ;
	}



	/**
	* Renvoie la liste des sujets
	* @return array of object toSujets
	*
	*/
    static function chargeListSujetAllFo() {

		$toSujets = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  sujet AS p
					ORDER BY p.sujet_datePublication DESC";
					
		$toSujets = $pDbw->fetchAll($zQuery);		

		return $toSujets;
	}	
	
	static function updateSujet($idSujet, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE sujet SET ";

		if($publier != -1)
			$zQuery .="sujet_publier =". $publier;
		
		$zQuery	.=" WHERE sujet_id =". $idSujet;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function updateSujetHome($idSujet, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE sujet SET ";

		if($publier != -1)
			$zQuery .="sujet_publierHome =". $publier;
		
		$zQuery	.=" WHERE sujet_id =". $idSujet;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function updateSujetUne($idSujet, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE sujet SET ";

		if($publier != -1)
			$zQuery .="sujet_laUne =". $publier;
		
		$zQuery	.=" WHERE sujet_id =". $idSujet;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}


	static function incSujetVisite($idSujet, $visite=1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE sujet SET sujet_id = " . $idSujet;

		if($visite != -1)
			$zQuery .=", sujet_visite = (sujet_visite + ". $visite . ") ";
		
		$zQuery	.=" WHERE sujet_id =". $idSujet;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}
}

?>
