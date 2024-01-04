<?php
/**
* @package ilay-nosy
* @subpackage officiel
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des officiels
*
* @package ilay-nosy
* @subpackage officiel
*/
class officielSrv {

	/**
    * Chargement de la liste des officiels (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets officiels , nombre d'enregistrement
	
	 officiel_id   	int(11)
	 officiel_libelle  	varchar(150) 	
    */
    static function chargeListeOfficielRechercheFo($cid=0, $mot="", $parution=0, $sortField="categorieOff_libelle ASC, officiel_datePublication", $sortDirection="DESC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {

		$listeOfficiel = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM officiel AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,c.* ";
		
		$zSql .=	" ,COUNT(p.photo_officielId) AS officiel_nbPhoto ";
		$zSql .=	" ,COUNT(k.commentOff_officielId) AS officiel_nbComment ";

		$zSql .=	" FROM officiel AS a " ;

		$zSql .=	" LEFT JOIN categorieOff as c " ; 
		$zSql .=	" 	ON a.officiel_categorieOffId = c.categorieOff_id";

		//photo
		$zSql .=	" LEFT JOIN photoOff AS p " ;
		$zSql .=	" 	ON p.photo_officielId = a.officiel_id ";
		//commentaire
		$zSql .=	" LEFT JOIN commentOff AS k " ;
		$zSql .=	" 	ON k.commentOff_officielId = a.officiel_id ";

		$zSql .=	" GROUP BY a.officiel_id" ;

		$zSql .=	" HAVING 0=0 ";
		
		//Clauses
		$zClause = " ";
		
		//Catégories
		if($cid != 0){
			$zClause .=	" AND a.officiel_categorieOffId=" . $cid ;
		}				
			
		//Mots clés
		if($mot != ""){
			$zClause .=	" AND ((UPPER(a.officiel_titre) LIKE '%$mot%') OR (UPPER(a.officiel_reference) LIKE '%$mot%') OR (UPPER(a.officiel_resume) LIKE '%$mot%'))";
		}				
		
		if($parution != 0){
		
			switch($parution){
				case 1: //1jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.officiel_datePublication) <= 1";
					break;
				case 2: //2jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.officiel_datePublication) <= 2";
					break;
				case 3: //3jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.officiel_datePublication) <= 3";
					break;
				case 4: //1semaine
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.officiel_datePublication) <= 8";
					break;
				case 5: //2semaines
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.officiel_datePublication) <= 15";
					break;
				case 6: //1mois
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.officiel_datePublication) <= 30";
					break;
				case 7: //2 mois
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.officiel_datePublication) <= 61";
					break;
			}
		}		

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT a.*, c.*  
								FROM officiel as a 

								LEFT JOIN categorieOff as c 
									ON a.officiel_categorieOffId = c.categorieOff_id
								LEFT JOIN commentOff AS k
									ON k.commentOff_officielId = a.officiel_id 
								GROUP BY a.officiel_id 
								HAVING 0=0 "  . $zClause);
								
								
		$recordCount = $rsCount->fetchAll() ;
		$iNbEnreg = sizeof($recordCount) ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeOfficiel = $oOfficielDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->officiel_reference 	= stripslashes($record->officiel_reference);
			$record->officiel_titre 		= stripslashes($record->officiel_titre);
			$record->officiel_resume 		= stripslashes($record->officiel_resume);
			$record->officiel_texte 		= stripslashes($record->officiel_texte);			
			$record->officiel_photo 		= stripslashes($record->officiel_photo);
			$record->officiel_source 		= stripslashes($record->officiel_source);
			$record->officiel_fichier 		= stripslashes($record->officiel_fichier);

			$record->categorieOff_libelle 	= stripslashes($record->categorieOff_libelle);
			$record->categorieOff_code 		= stripslashes($record->categorieOff_code);

			array_push($listeOfficiel, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeOfficiel'] = $listeOfficiel ;
		
		return $tResult ;
	}

    static function chargeListeOfficiel($cid=0, $sortField="categorieOff_libelle ASC, officiel_datePublication", $sortDirection="DESC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {

		$listeOfficiel = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM officiel AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,c.* ";
		
		$zSql .=	" ,COUNT(p.photo_officielId) AS officiel_nbPhoto ";
		$zSql .=	" ,COUNT(k.commentOff_officielId) AS officiel_nbComment ";

		$zSql .=	" FROM officiel AS a " ;

		$zSql .=	" LEFT JOIN categorieOff as c " ; 
		$zSql .=	" 	ON a.officiel_categorieOffId = c.categorieOff_id";

		//photo
		$zSql .=	" LEFT JOIN photoOff AS p " ;
		$zSql .=	" 	ON p.photo_officielId = a.officiel_id ";
		//commentaire
		$zSql .=	" LEFT JOIN commentOff AS k " ;
		$zSql .=	" 	ON k.commentOff_officielId = a.officiel_id ";

		$zSql .=	" GROUP BY a.officiel_id" ;

		$zSql .=	" HAVING 0=0 ";
		
		$zClause = " ";
		if($cid != 0){
			$zClause .=	" AND a.officiel_categorieOffId=" . $cid ;
		}	

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg 
								FROM officiel as a 

								LEFT JOIN categorieOff as c 
									ON a.officiel_categorieOffId = c.categorieOff_id
								LEFT JOIN commentOff AS k
									ON k.commentOff_officielId = a.officiel_id
								WHERE 0=0 "  . $zClause);
								
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeOfficiel = $oOfficielDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){

			$record->officiel_reference 	= stripslashes($record->officiel_reference);
			$record->officiel_titre 		= stripslashes($record->officiel_titre);
			$record->officiel_resume 		= stripslashes($record->officiel_resume);
			$record->officiel_texte 		= stripslashes($record->officiel_texte);			
			$record->officiel_photo 		= stripslashes($record->officiel_photo);
			$record->officiel_source 		= stripslashes($record->officiel_source);
			$record->officiel_fichier 		= stripslashes($record->officiel_fichier);

			$record->categorieOff_libelle 	= stripslashes($record->categorieOff_libelle);
			$record->categorieOff_code 		= stripslashes($record->categorieOff_code);

			array_push($listeOfficiel, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeOfficiel'] = $listeOfficiel ;
		
		return $tResult ;
	}

    static function chargeAllOfficiel() {

		$listeOfficiel = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM officiel AS a " ;
		$zSql .=	" WHERE 0=0 " ;
		$zSql .=	" 	AND a.officiel_publier = 1 " ;
		$zSql .=	" ORDER BY a.officiel_datePublication DESC" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeOfficiel, $record) ;
 		}

		$tResult = $listeOfficiel ;
		
		return $tResult ;

	}	
	
    static function chargeAllOfficielWithout($id) {

		$listeOfficiel = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM officiel AS aa " ;
		$zSql .=	" WHERE a.officiel_id <> $id" ;
		$zSql .=	" 	AND a.officiel_publier = 1 " ;
		$zSql .=	" ORDER BY a.officiel_datePublication DESC" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeOfficiel, $record) ;
 		}

		$tResult = $listeOfficiel ;
		return $tResult ;
	}

	/**
    * Chargement d'un officiel donné
	*
	* @param integer $officielId Id de l'officiel souhaitée
	* @return object $toOfficiel  objet officiel
    */
    static function chargeOfficiel($officielId) {

		// 	Chargement des données
		if (!$officielId) {
			throw new Exception("Pas d'identifient du officiel envoyé");
		}

		$zQuery = "SELECT officiel_id

			, officiel_categorieOffId
			, officiel_reference
			, officiel_titre
			, officiel_resume
			, officiel_texte
			, officiel_photo
			, officiel_dateCreation
			, officiel_dateModification
			, officiel_datePublication
			, officiel_source
			, officiel_vue
			, officiel_fichier
			, officiel_visite
			, officiel_publier
			, officiel_publierHome
			, officiel_laUne

			FROM officiel WHERE officiel_id=".$officielId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iOfficiel = count($toOfficiel = $pDbw->fetchAll($zQuery));
		if ($iOfficiel==0) {
        	throw new Exception("Officiel $officielId non trouvée");
		}

		$toOfficiel[0]->officiel_reference 	= stripslashes($toOfficiel[0]->officiel_reference);
		$toOfficiel[0]->officiel_titre 		= stripslashes($toOfficiel[0]->officiel_titre);
		$toOfficiel[0]->officiel_resume 		= stripslashes($toOfficiel[0]->officiel_resume);
		$toOfficiel[0]->officiel_texte 		= stripslashes($toOfficiel[0]->officiel_texte);			
		$toOfficiel[0]->officiel_photo 		= stripslashes($toOfficiel[0]->officiel_photo);
		$toOfficiel[0]->officiel_source 		= stripslashes($toOfficiel[0]->officiel_source);
		$toOfficiel[0]->officiel_fichier 		= stripslashes($toOfficiel[0]->officiel_fichier);
		
		return $toOfficiel[0];
	}

	/**
    * Enregistrement d'un officiel
	*
	* @param object $officiel Objet officiel
    */
    static function sauvegardeOfficiel($officiel) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'officiel
		$officiel->statut = isset($officiel->statut)? $officiel->statut : 0;
		
		if (!isset($officiel->id) || $officiel->id==0) { // insertion
		
		
		//print_r($officiel);
			
			//Requette d'ajout
			$zQuery = "INSERT INTO officiel VALUES (
				'0'
				," .$officiel->categorieOffId ."
				," .$oCnx->quote($officiel->reference). "
				," .$oCnx->quote($officiel->titre). "
				," .$oCnx->quote($officiel->resume). "
				," .$oCnx->quote($officiel->texte). "
				," .$oCnx->quote($officiel->photo). "
				," .$oCnx->quote($officiel->dateCreation). "
				," .$oCnx->quote($officiel->dateModification). "
				," .$oCnx->quote($officiel->datePublication). "
				," .$oCnx->quote($officiel->source). "
				," .$officiel->vue ."
				," .$oCnx->quote($officiel->fichier). "
				," .$officiel->visite ."
				," .$officiel->publier ."
				," .$officiel->publierHome ."
				," .$officiel->laUne ."
				)";
				//echo $zQuery;

			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE officiel SET \n
					officiel_id=".$oCnx->quote($officiel->id)."";
					
			if (isset($officiel->categorieOffId)) {
				$zQuery .= "\n, officiel_categorieOffId=".$officiel->categorieOffId."";
			}
			if (isset($officiel->reference)) {
				$zQuery .= "\n, officiel_reference=".$oCnx->quote($officiel->reference)."";
			}
			if (isset($officiel->titre)) {
				$zQuery .= "\n, officiel_titre=".$oCnx->quote($officiel->titre)."";
			}
			if (isset($officiel->resume)) {
				$zQuery .= "\n, officiel_resume=".$oCnx->quote($officiel->resume)."";
			}			
			if (isset($officiel->texte)) {
				$zQuery .= "\n, officiel_texte=".$oCnx->quote($officiel->texte)."";
			}			
			if (isset($officiel->photo)) {
				$zQuery .= "\n, officiel_photo=".$oCnx->quote($officiel->photo)."";
			}
			
			if (isset($officiel->dateCreation)) {
				$zQuery .= "\n, officiel_dateCreation=".$oCnx->quote($officiel->dateCreation)."";
			}
			if (isset($officiel->dateModification)) {
				$zQuery .= "\n, officiel_dateModification=".$oCnx->quote($officiel->dateModification)."";
			}
			if (isset($officiel->datePublication)) {
				$zQuery .= "\n, officiel_datePublication=".$oCnx->quote($officiel->datePublication)."";
			}					
			if (isset($officiel->source)) {
				$zQuery .= "\n, officiel_source=".$oCnx->quote($officiel->source)."";
			}			
			if (isset($officiel->vue)) {
				$zQuery .= "\n, officiel_vue=".$officiel->vue."";
			}			
			if (isset($officiel->fichier)) {
				$zQuery .= "\n, officiel_fichier=".$oCnx->quote($officiel->fichier)."";
			}			
			if (isset($officiel->visite)) {
				$zQuery .= "\n, officiel_visite=".$officiel->visite."";
			}
			if (isset($officiel->publier)) {
				$zQuery .= "\n, officiel_publier=".$officiel->publier."";
			}
			if (isset($officiel->publierHome)) {
				$zQuery .= "\n, officiel_publierHome=".$officiel->publierHome."";
			}
			if (isset($officiel->laUne)) {
				$zQuery .= "\n, officiel_laUne=".$officiel->laUne."";
			}

			$zQuery .= " \nWHERE officiel_id=".$officiel->id;
			
			$oCnx->exec($zQuery);
	        $id = $officiel->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un officiel
	*
	* @param integer Id du officiel à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeOfficiel($officielId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un officiel
		$zQuery = "DELETE FROM officiel WHERE officiel_id=$officielId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un officiel
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateOfficielStatut($idOfficiel, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE officiel SET officiel_statut ='".$statut."' WHERE officiel_id =".$idOfficiel;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO officiel
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoOfficiel() {

		$object = jDao::createRecord("officiel~officiel");
		//$object->officiel_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une officiel
	* param int $officielId id de la officiel
	* return $officiel objet officiel
	*/
	static function getOfficiel($officielId){
		$dao=jDao::create("officiel~officiel");
		if(!($officiel=$dao->get($officielId))){
			$dao=new jSelectorDao('officiel~officiel','');
			$c=$dao->getDaoRecordClass();
			$officiel=new $c ();
		}
		return $officiel;
	}	
	
	
	
	/**
	* selectionner les officiels existant pour une catégorie donnée
	* @param idForfaitId
	* @return tableau de boissons
	*/
	static function getAllOfficiel($idCategorieOffId)
	{
		$zQuery = "SELECT a.*
				FROM officiel AS a 
				WHERE a.officiel_categorieOffId = '".$idCategorieOffId."' 
				ORDER BY a.officiel_datePublication DESC";
      	$pDbw = jDb::getDbWidget();
      	$toOfficiel = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toOfficiel as $oOfficiel)
		{
			$oOfficiel->officiel_libelle = stripslashes($oOfficiel->officiel_libelle);
			array_push($tResult, $oOfficiel);
		}
		return $tResult;
	}

	//With nb officiels
    static function getRandActByCategorie($idCategorieId) {

		$listeCategorieOff = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM officiel AS a " ;
		$zSql .=	" WHERE a.officiel_categorieOffId = " . $idCategorieId ;
		$zSql .=	" 	AND a.officiel_publier = 1 " ;
		$zSql .=	" ORDER BY RAND()" ;
		$zSql .=	" LIMIT 1" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieOff, $record) ;
 		}

		$tResult = $listeCategorieOff ;
		
		return $tResult ;

	}

	//All officiels with limit
    static function getLastAct($nbFalls) {

		$listeOfficiel = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.*";

		$zSql .=	" FROM officiel AS a " ;

		$zSql .=	" WHERE 0=0 " ;
		$zSql .=	" 	AND a.officiel_publier = 1 " ;
		$zSql .=	" 	AND a.officiel_publierHome = 1 " ;
		$zSql .=	" ORDER BY a.officiel_datePublication DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeOfficiel, $record) ;
 		}

		$tResult = $listeOfficiel ;
		
		return $tResult ;
	}

	//All officiels by categorie
    static function getLastActByCategorie($idCategorieIds, $nbFalls) {

		$listeOfficiel = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.*";

		$zSql .=	" FROM officiel AS a " ;

		$zSql .=	" WHERE a.officiel_categorieOffId IN (" . $idCategorieIds . ") " ;
		$zSql .=	" ORDER BY a.officiel_datePublication DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeOfficiel, $record) ;
 		}

		$tResult = $listeOfficiel ;
		
		return $tResult ;
	}


	//All officiels by categorie
    static function getTopActLaUNE($nbFalls=1) {

		$toOfficiels = array();
		
		$pDbw = jDb::getDbWidget();

		$zSql  = 	" SELECT a.*";
		$zSql .=	" FROM officiel AS a " ;		
		$zSql .=	" WHERE a.officiel_laUne = 1 " ;
		$zSql .=	" 	AND a.officiel_publier = 1 " ;
		$zSql .=	" 	AND a.officiel_publierHome = 1 " ;
		$zSql .=	" ORDER BY a.officiel_datePublication DESC " ;
		$zSql .=	" LIMIT 0, $nbFalls ";

		$toOfficiels = $pDbw->fetchAll($zSql);		
		
		return $toOfficiels ;
	}



	/**
	* Renvoie la liste des officiels
	* @return array of object toOfficiels
	*
	*/
    static function chargeListOfficielAllFo() {

		$toOfficiels = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  officiel AS p
					ORDER BY p.officiel_datePublication DESC";
					
		$toOfficiels = $pDbw->fetchAll($zQuery);		

		return $toOfficiels;
	}	
	
	static function updateOfficiel($idOfficiel, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE officiel SET ";

		if($publier != -1)
			$zQuery .="officiel_publier =". $publier;
		
		$zQuery	.=" WHERE officiel_id =". $idOfficiel;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function updateOfficielHome($idOfficiel, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE officiel SET ";

		if($publier != -1)
			$zQuery .="officiel_publierHome =". $publier;
		
		$zQuery	.=" WHERE officiel_id =". $idOfficiel;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function updateOfficielUne($idOfficiel, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE officiel SET ";

		if($publier != -1)
			$zQuery .="officiel_laUne =". $publier;
		
		$zQuery	.=" WHERE officiel_id =". $idOfficiel;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}


	static function incOfficielVisite($idOfficiel, $visite=1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE officiel SET officiel_id = " . $idOfficiel;

		if($visite != -1)
			$zQuery .=", officiel_visite = (officiel_visite + ". $visite . ") ";
		
		$zQuery	.=" WHERE officiel_id =". $idOfficiel;
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
