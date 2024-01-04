<?php
/**
* @package ilay-nosy
* @subpackage actualite
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des actualites
*
* @package ilay-nosy
* @subpackage actualite
*/
class actualiteSrv {

	/**
    * Chargement de la liste des actualites (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets actualites , nombre d'enregistrement
	
	 actualite_id   	int(11)
	 actualite_libelle  	varchar(150) 	
    */
    static function chargeListeActualiteRechercheFo($cid=0, $mot="", $parution=0, $sortField="categorieAct_libelle ASC, actualite_datePublication", $sortDirection="DESC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {

		$listeActualite = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM actualite AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,c.* ";
		
		$zSql .=	" ,COUNT(p.photo_actualiteId) AS actualite_nbPhoto ";
		$zSql .=	" ,COUNT(k.commentAct_actualiteId) AS actualite_nbComment ";

		$zSql .=	" FROM actualite AS a " ;

		$zSql .=	" LEFT JOIN categorieAct as c " ; 
		$zSql .=	" 	ON a.actualite_categorieActId = c.categorieAct_id";

		//photo
		$zSql .=	" LEFT JOIN photoAct AS p " ;
		$zSql .=	" 	ON p.photo_actualiteId = a.actualite_id ";
		//commentaire
		$zSql .=	" LEFT JOIN commentAct AS k " ;
		$zSql .=	" 	ON k.commentAct_actualiteId = a.actualite_id ";

		$zSql .=	" GROUP BY a.actualite_id" ;

		$zSql .=	" HAVING 0=0 ";
		
		//Clauses
		$zClause = " ";
		
		//Catégories
		if($cid != 0){
			$zClause .=	" AND a.actualite_categorieActId=" . $cid ;
		}				
			
		//Mots clés
		if($mot != ""){
			$zClause .=	" AND ((UPPER(a.actualite_titre) LIKE '%$mot%') OR (UPPER(a.actualite_reference) LIKE '%$mot%') OR (UPPER(a.actualite_resume) LIKE '%$mot%'))";
		}				
		
		if($parution != 0){
		
			switch($parution){
				case 1: //1jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.actualite_datePublication) <= 1";
					break;
				case 2: //2jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.actualite_datePublication) <= 2";
					break;
				case 3: //3jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.actualite_datePublication) <= 3";
					break;
				case 4: //1semaine
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.actualite_datePublication) <= 8";
					break;
				case 5: //2semaines
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.actualite_datePublication) <= 15";
					break;
				case 6: //1mois
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.actualite_datePublication) <= 30";
					break;
				case 7: //2 mois
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.actualite_datePublication) <= 61";
					break;
			}
		}		

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT a.*, c.*  
								FROM actualite as a 

								LEFT JOIN categorieAct as c 
									ON a.actualite_categorieActId = c.categorieAct_id
								LEFT JOIN commentAct AS k
									ON k.commentAct_actualiteId = a.actualite_id 
								GROUP BY a.actualite_id 
								HAVING 0=0 "  . $zClause);
								
								
		$recordCount = $rsCount->fetchAll() ;
		$iNbEnreg = sizeof($recordCount) ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeActualite = $oActualiteDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->actualite_reference 	= stripslashes($record->actualite_reference);
			$record->actualite_titre 		= stripslashes($record->actualite_titre);
			$record->actualite_resume 		= stripslashes($record->actualite_resume);
			$record->actualite_texte 		= stripslashes($record->actualite_texte);			
			$record->actualite_photo 		= stripslashes($record->actualite_photo);
			$record->actualite_source 		= stripslashes($record->actualite_source);
			$record->actualite_fichier 		= stripslashes($record->actualite_fichier);

			$record->categorieAct_libelle 	= stripslashes($record->categorieAct_libelle);
			$record->categorieAct_code 		= stripslashes($record->categorieAct_code);

			array_push($listeActualite, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeActualite'] = $listeActualite ;
		
		return $tResult ;
	}

    static function chargeListeActualite($cid=0, $sortField="categorieAct_libelle ASC, actualite_datePublication", $sortDirection="DESC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {

		$listeActualite = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM actualite AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,c.* ";
		
		$zSql .=	" ,COUNT(p.photo_actualiteId) AS actualite_nbPhoto ";
		$zSql .=	" ,COUNT(k.commentAct_actualiteId) AS actualite_nbComment ";

		$zSql .=	" FROM actualite AS a " ;

		$zSql .=	" LEFT JOIN categorieAct as c " ; 
		$zSql .=	" 	ON a.actualite_categorieActId = c.categorieAct_id";

		//photo
		$zSql .=	" LEFT JOIN photoAct AS p " ;
		$zSql .=	" 	ON p.photo_actualiteId = a.actualite_id ";
		//commentaire
		$zSql .=	" LEFT JOIN commentAct AS k " ;
		$zSql .=	" 	ON k.commentAct_actualiteId = a.actualite_id ";

		$zSql .=	" GROUP BY a.actualite_id" ;

		$zSql .=	" HAVING 0=0 ";
		
		$zClause = " ";
		if($cid != 0){
			$zClause .=	" AND a.actualite_categorieActId=" . $cid ;
		}	

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg 
								FROM actualite as a 

								LEFT JOIN categorieAct as c 
									ON a.actualite_categorieActId = c.categorieAct_id
								LEFT JOIN commentAct AS k
									ON k.commentAct_actualiteId = a.actualite_id
								WHERE 0=0 "  . $zClause);
								
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeActualite = $oActualiteDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){

			$record->actualite_reference 	= stripslashes($record->actualite_reference);
			$record->actualite_titre 		= stripslashes($record->actualite_titre);
			$record->actualite_resume 		= stripslashes($record->actualite_resume);
			$record->actualite_texte 		= stripslashes($record->actualite_texte);			
			$record->actualite_photo 		= stripslashes($record->actualite_photo);
			$record->actualite_source 		= stripslashes($record->actualite_source);
			$record->actualite_fichier 		= stripslashes($record->actualite_fichier);

			$record->categorieAct_libelle 	= stripslashes($record->categorieAct_libelle);
			$record->categorieAct_code 		= stripslashes($record->categorieAct_code);

			array_push($listeActualite, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeActualite'] = $listeActualite ;
		
		return $tResult ;
	}

    static function chargeAllActualite() {

		$listeActualite = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM actualite AS a " ;
		$zSql .=	" WHERE 0=0 " ;
		$zSql .=	" 	AND a.actualite_publier = 1 " ;
		$zSql .=	" ORDER BY a.actualite_datePublication DESC" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeActualite, $record) ;
 		}

		$tResult = $listeActualite ;
		
		return $tResult ;

	}	
	
    static function chargeAllActualiteWithout($id) {

		$listeActualite = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM actualite AS aa " ;
		$zSql .=	" WHERE a.actualite_id <> $id" ;
		$zSql .=	" 	AND a.actualite_publier = 1 " ;
		$zSql .=	" ORDER BY a.actualite_datePublication DESC" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeActualite, $record) ;
 		}

		$tResult = $listeActualite ;
		return $tResult ;
	}

	/**
    * Chargement d'un actualite donné
	*
	* @param integer $actualiteId Id de l'actualite souhaitée
	* @return object $toActualite  objet actualite
    */
    static function chargeActualite($actualiteId) {

		// 	Chargement des données
		if (!$actualiteId) {
			throw new Exception("Pas d'identifient du actualite envoyé");
		}

		$zQuery = "SELECT actualite_id

			, actualite_categorieActId
			, actualite_reference
			, actualite_titre
			, actualite_resume
			, actualite_texte
			, actualite_photo
			, actualite_dateCreation
			, actualite_dateModification
			, actualite_datePublication
			, actualite_source
			, actualite_vue
			, actualite_fichier
			, actualite_visite
			, actualite_publier
			, actualite_publierHome
			, actualite_laUne

			FROM actualite WHERE actualite_id=".$actualiteId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iActualite = count($toActualite = $pDbw->fetchAll($zQuery));
		if ($iActualite==0) {
        	throw new Exception("Actualite $actualiteId non trouvée");
		}

		$toActualite[0]->actualite_reference 	= stripslashes($toActualite[0]->actualite_reference);
		$toActualite[0]->actualite_titre 		= stripslashes($toActualite[0]->actualite_titre);
		$toActualite[0]->actualite_resume 		= stripslashes($toActualite[0]->actualite_resume);
		$toActualite[0]->actualite_texte 		= stripslashes($toActualite[0]->actualite_texte);			
		$toActualite[0]->actualite_photo 		= stripslashes($toActualite[0]->actualite_photo);
		$toActualite[0]->actualite_source 		= stripslashes($toActualite[0]->actualite_source);
		$toActualite[0]->actualite_fichier 		= stripslashes($toActualite[0]->actualite_fichier);
		
		return $toActualite[0];
	}

	/**
    * Enregistrement d'un actualite
	*
	* @param object $actualite Objet actualite
    */
    static function sauvegardeActualite($actualite) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'actualite
		$actualite->statut = isset($actualite->statut)? $actualite->statut : 0;
		
		if (!isset($actualite->id) || $actualite->id==0) { // insertion
		
		
		//print_r($actualite);
			
			//Requette d'ajout
			$zQuery = "INSERT INTO actualite VALUES (
				'0'
				," .$actualite->categorieActId ."
				," .$oCnx->quote($actualite->reference). "
				," .$oCnx->quote($actualite->titre). "
				," .$oCnx->quote($actualite->resume). "
				," .$oCnx->quote($actualite->texte). "
				," .$oCnx->quote($actualite->photo). "
				," .$oCnx->quote($actualite->dateCreation). "
				," .$oCnx->quote($actualite->dateModification). "
				," .$oCnx->quote($actualite->datePublication). "
				," .$oCnx->quote($actualite->source). "
				," .$actualite->vue ."
				," .$oCnx->quote($actualite->fichier). "
				," .$actualite->visite ."
				," .$actualite->publier ."
				," .$actualite->publierHome ."
				," .$actualite->laUne ."
				)";
				//echo $zQuery;

			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE actualite SET \n
					actualite_id=".$oCnx->quote($actualite->id)."";
					
			if (isset($actualite->categorieActId)) {
				$zQuery .= "\n, actualite_categorieActId=".$actualite->categorieActId."";
			}
			if (isset($actualite->reference)) {
				$zQuery .= "\n, actualite_reference=".$oCnx->quote($actualite->reference)."";
			}
			if (isset($actualite->titre)) {
				$zQuery .= "\n, actualite_titre=".$oCnx->quote($actualite->titre)."";
			}
			if (isset($actualite->resume)) {
				$zQuery .= "\n, actualite_resume=".$oCnx->quote($actualite->resume)."";
			}			
			if (isset($actualite->texte)) {
				$zQuery .= "\n, actualite_texte=".$oCnx->quote($actualite->texte)."";
			}			
			if (isset($actualite->photo)) {
				$zQuery .= "\n, actualite_photo=".$oCnx->quote($actualite->photo)."";
			}
			
			if (isset($actualite->dateCreation)) {
				$zQuery .= "\n, actualite_dateCreation=".$oCnx->quote($actualite->dateCreation)."";
			}
			if (isset($actualite->dateModification)) {
				$zQuery .= "\n, actualite_dateModification=".$oCnx->quote($actualite->dateModification)."";
			}
			if (isset($actualite->datePublication)) {
				$zQuery .= "\n, actualite_datePublication=".$oCnx->quote($actualite->datePublication)."";
			}					
			if (isset($actualite->source)) {
				$zQuery .= "\n, actualite_source=".$oCnx->quote($actualite->source)."";
			}			
			if (isset($actualite->vue)) {
				$zQuery .= "\n, actualite_vue=".$actualite->vue."";
			}			
			if (isset($actualite->fichier)) {
				$zQuery .= "\n, actualite_fichier=".$oCnx->quote($actualite->fichier)."";
			}			
			if (isset($actualite->visite)) {
				$zQuery .= "\n, actualite_visite=".$actualite->visite."";
			}
			if (isset($actualite->publier)) {
				$zQuery .= "\n, actualite_publier=".$actualite->publier."";
			}
			if (isset($actualite->publierHome)) {
				$zQuery .= "\n, actualite_publierHome=".$actualite->publierHome."";
			}
			if (isset($actualite->laUne)) {
				$zQuery .= "\n, actualite_laUne=".$actualite->laUne."";
			}

			$zQuery .= " \nWHERE actualite_id=".$actualite->id;
			
			$oCnx->exec($zQuery);
	        $id = $actualite->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un actualite
	*
	* @param integer Id du actualite à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeActualite($actualiteId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un actualite
		$zQuery = "DELETE FROM actualite WHERE actualite_id=$actualiteId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un actualite
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateActualiteStatut($idActualite, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE actualite SET actualite_statut ='".$statut."' WHERE actualite_id =".$idActualite;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO actualite
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoActualite() {

		$object = jDao::createRecord("actualite~actualite");
		//$object->actualite_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une actualite
	* param int $actualiteId id de la actualite
	* return $actualite objet actualite
	*/
	static function getActualite($actualiteId){
		$dao=jDao::create("actualite~actualite");
		if(!($actualite=$dao->get($actualiteId))){
			$dao=new jSelectorDao('actualite~actualite','');
			$c=$dao->getDaoRecordClass();
			$actualite=new $c ();
		}
		return $actualite;
	}	
	
	
	
	/**
	* selectionner les actualites existant pour une catégorie donnée
	* @param idForfaitId
	* @return tableau de boissons
	*/
	static function getAllActualite($idCategorieActId)
	{
		$zQuery = "SELECT a.*
				FROM actualite AS a 
				WHERE a.actualite_categorieActId = '".$idCategorieActId."' 
				ORDER BY a.actualite_datePublication DESC";
      	$pDbw = jDb::getDbWidget();
      	$toActualite = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toActualite as $oActualite)
		{
			$oActualite->actualite_libelle = stripslashes($oActualite->actualite_libelle);
			array_push($tResult, $oActualite);
		}
		return $tResult;
	}

	//With nb actualites
    static function getRandActByCategorie($idCategorieId) {

		$listeCategorieAct = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM actualite AS a " ;
		$zSql .=	" WHERE a.actualite_categorieActId = " . $idCategorieId ;
		$zSql .=	" 	AND a.actualite_publier = 1 " ;
		$zSql .=	" ORDER BY RAND()" ;
		$zSql .=	" LIMIT 1" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieAct, $record) ;
 		}

		$tResult = $listeCategorieAct ;
		
		return $tResult ;

	}

	//All actualites with limit
    static function getLastAct($nbFalls) {

		$listeActualite = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.*";

		$zSql .=	" FROM actualite AS a " ;

		$zSql .=	" WHERE 0=0 " ;
		$zSql .=	" 	AND a.actualite_publier = 1 " ;
		$zSql .=	" 	AND a.actualite_publierHome = 1 " ;
		$zSql .=	" ORDER BY a.actualite_datePublication DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeActualite, $record) ;
 		}

		$tResult = $listeActualite ;
		
		return $tResult ;
	}

	//All actualites by categorie
    static function getLastActByCategorie($idCategorieIds, $nbFalls) {

		$listeActualite = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.*";

		$zSql .=	" FROM actualite AS a " ;

		$zSql .=	" WHERE a.actualite_categorieActId IN (" . $idCategorieIds . ") " ;
		$zSql .=	" ORDER BY a.actualite_datePublication DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeActualite, $record) ;
 		}

		$tResult = $listeActualite ;
		
		return $tResult ;
	}


	//All actualites by categorie
    static function getTopActLaUNE($nbFalls=1) {

		$toActualites = array();
		
		$pDbw = jDb::getDbWidget();

		$zSql  = 	" SELECT a.*";
		$zSql .=	" FROM actualite AS a " ;		
		$zSql .=	" WHERE a.actualite_laUne = 1 " ;
		$zSql .=	" 	AND a.actualite_publier = 1 " ;
		$zSql .=	" 	AND a.actualite_publierHome = 1 " ;
		$zSql .=	" ORDER BY a.actualite_datePublication DESC " ;
		$zSql .=	" LIMIT 0, $nbFalls ";

		$toActualites = $pDbw->fetchAll($zSql);		
		
		return $toActualites ;
	}



	/**
	* Renvoie la liste des actualites
	* @return array of object toActualites
	*
	*/
    static function chargeListActualiteAllFo() {

		$toActualites = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  actualite AS p
					ORDER BY p.actualite_datePublication DESC";
					
		$toActualites = $pDbw->fetchAll($zQuery);		

		return $toActualites;
	}	
	
	static function updateActualite($idActualite, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE actualite SET ";

		if($publier != -1)
			$zQuery .="actualite_publier =". $publier;
		
		$zQuery	.=" WHERE actualite_id =". $idActualite;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function updateActualiteHome($idActualite, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE actualite SET ";

		if($publier != -1)
			$zQuery .="actualite_publierHome =". $publier;
		
		$zQuery	.=" WHERE actualite_id =". $idActualite;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function updateActualiteUne($idActualite, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE actualite SET ";

		if($publier != -1)
			$zQuery .="actualite_laUne =". $publier;
		
		$zQuery	.=" WHERE actualite_id =". $idActualite;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}


	static function incActualiteVisite($idActualite, $visite=1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE actualite SET actualite_id = " . $idActualite;

		if($visite != -1)
			$zQuery .=", actualite_visite = (actualite_visite + ". $visite . ") ";
		
		$zQuery	.=" WHERE actualite_id =". $idActualite;
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
