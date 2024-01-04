<?php
/**
* @package ilay-nosy
* @subpackage petiteAnnonce
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des petiteAnnonces
*
* @package ilay-nosy
* @subpackage petiteAnnonce
*/
class petiteAnnonceSrv {


    static function chargeListePetiteAnnonceRechercheBo($cid=0, $mot="",$prix1=0, $prix2=0, $sortField="categorieAn_libelle, petiteAnnonce_reference", $sortDirection="ASC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {

		$listePetiteAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM petiteAnnonce AS s";
		
		$zSql  = 	" SELECT p.* ";

		$zSql .=	" ,c.* ";

		$zSql .=	" FROM petiteAnnonce AS p " ;

		$zSql .=	" LEFT JOIN categorieAn as c " ;
		$zSql .=	" 	ON p.petiteAnnonce_categorieAnId = c.categorieAn_id";

		$zSql .=	" GROUP BY p.petiteAnnonce_id" ;

		$zSql .=	" HAVING 0=0 ";
		
		$zClause = " ";
		if($cid != 0){
			if($cid == 777){ //Autres petiteAnnonces
				$zClause .=	" AND p.petiteAnnonce_categorieAnId IN (" . CATEGORIE_ANNONCES . ") ";
			}else{
				$zClause .=	" AND p.petiteAnnonce_categorieAnId=" . $cid ;
			}					
		}
		
		if($mot != ""){
			$zClause .=	" AND ((UPPER(p.petiteAnnonce_description) LIKE '%$mot%') OR (UPPER(p.petiteAnnonce_reference) LIKE '%$mot%'))";
		}				
		
		if ($prix2 > 0){
			$zClause .=	" AND p.petiteAnnonce_prix BETWEEN " . $prix1. " AND ". $prix2. " ";				
		}

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg 
								FROM petiteAnnonce as p 

								LEFT JOIN categorieAn as c 
									ON p.petiteAnnonce_categorieAnId = c.categorieAn_id
								WHERE 0=0 "  . $zClause);
								
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listePetiteAnnonce = $oPetiteAnnonceDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->petiteAnnonce_reference 		= stripslashes($record->petiteAnnonce_reference);
			$record->petiteAnnonce_prixInfo 		= stripslashes($record->petiteAnnonce_prixInfo);			
			$record->petiteAnnonce_titre 			= stripslashes($record->petiteAnnonce_titre);
			$record->petiteAnnonce_description 		= stripslashes($record->petiteAnnonce_description);
			$record->petiteAnnonce_contact 			= stripslashes($record->petiteAnnonce_contact);
			$record->petiteAnnonce_dateCreation 	= stripslashes($record->petiteAnnonce_dateCreation);
			$record->petiteAnnonce_dateModification	= stripslashes($record->petiteAnnonce_dateModification);

			$record->categorieAn_libelle 			= stripslashes($record->categorieAn_libelle);

			array_push($listePetiteAnnonce, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listePetiteAnnonce'] = $listePetiteAnnonce ;
		
		return $tResult ;
	}

	/**
    * Chargement de la liste des petiteAnnonces (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets petiteAnnonces , nombre d'enregistrement
	
	 petiteAnnonce_id   	int(11)
	 petiteAnnonce_libelle  	varchar(150) 	
    */
    static function chargeListePetiteAnnonceRechercheFo($cid=0, $mot="",$prix1=0, $prix2=0, $sortField="categorieAn_libelle, petiteAnnonce_reference", $sortDirection="ASC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {

		$listePetiteAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM petiteAnnonce AS s";
		
		$zSql  = 	" SELECT p.* ";

		$zSql .=	" ,c.* ";

		$zSql .=	" FROM petiteAnnonce AS p " ;

		$zSql .=	" LEFT JOIN categorieAn as c " ;
		$zSql .=	" 	ON p.petiteAnnonce_categorieAnId = c.categorieAn_id";

		$zSql .=	" GROUP BY p.petiteAnnonce_id" ;

		$zSql .=	" HAVING p.petiteAnnonce_publier = 1 ";
		
		$zClause = " ";
		if($cid != 0){
			if($cid == 777){ //Autres petiteAnnonces
				$zClause .=	" AND p.petiteAnnonce_categorieAnId IN (" . CATEGORIE_ANNONCES . ") ";
			}else{
				$zClause .=	" AND p.petiteAnnonce_categorieAnId=" . $cid ;
			}					
		}
		
		if($mot != ""){
			$zClause .=	" AND ((UPPER(p.petiteAnnonce_description) LIKE '%$mot%') OR (UPPER(p.petiteAnnonce_reference) LIKE '%$mot%'))";
		}				
		
		if ($prix2 > 0){
			$zClause .=	" AND p.petiteAnnonce_prix BETWEEN " . $prix1. " AND ". $prix2. " ";				
		}

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg 
								FROM petiteAnnonce as p 

								LEFT JOIN categorieAn as c 
									ON p.petiteAnnonce_categorieAnId = c.categorieAn_id
								WHERE 0=0 "  . $zClause);
								
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listePetiteAnnonce = $oPetiteAnnonceDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->petiteAnnonce_reference 		= stripslashes($record->petiteAnnonce_reference);
			$record->petiteAnnonce_prixInfo 		= stripslashes($record->petiteAnnonce_prixInfo);			
			$record->petiteAnnonce_titre 		= stripslashes($record->petiteAnnonce_titre);
			$record->petiteAnnonce_description 		= stripslashes($record->petiteAnnonce_description);
			$record->petiteAnnonce_contact 			= stripslashes($record->petiteAnnonce_contact);
			$record->petiteAnnonce_dateCreation 	= stripslashes($record->petiteAnnonce_dateCreation);
			$record->petiteAnnonce_dateModification	= stripslashes($record->petiteAnnonce_dateModification);

			$record->categorieAn_libelle 			= stripslashes($record->categorieAn_libelle);

			array_push($listePetiteAnnonce, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listePetiteAnnonce'] = $listePetiteAnnonce ;
		
		return $tResult ;
	}

    static function chargeAllPetiteAnnonce() {

		$listePetiteAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT p.* ";
		$zSql .=	" FROM petiteAnnonce AS p " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listePetiteAnnonce, $record) ;
 		}

		$tResult = $listePetiteAnnonce ;
		
		return $tResult ;

	}	
	
    static function chargeAllPetiteAnnonceWithout($id) {

		$listePetiteAnnonce = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT p.* ";
		$zSql .=	" FROM petiteAnnonce AS p " ;
		$zSql .=	" WHERE p.petiteAnnonce_id <> $id" ;
		$zSql .=	" ORDER BY p.petiteAnnonce_reference" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listePetiteAnnonce, $record) ;
 		}

		$tResult = $listePetiteAnnonce ;
		return $tResult ;
	}

	/**
    * Chargement d'un petiteAnnonce donné
	*
	* @param integer $petiteAnnonceId Id de l'petiteAnnonce souhaitée
	* @return object $toPetiteAnnonce  objet petiteAnnonce
    */
    static function chargePetiteAnnonce($petiteAnnonceId) {

		// 	Chargement des données
		if (!$petiteAnnonceId) {
			throw new Exception("Pas d'identifient du petiteAnnonce envoyé");
		}

		$zQuery = "SELECT petiteAnnonce_id

			, petiteAnnonce_categorieAnId
			, petiteAnnonce_reference
			, petiteAnnonce_titre
			, petiteAnnonce_description
			, petiteAnnonce_prix
			, petiteAnnonce_prixInfo
			, petiteAnnonce_contact
			, petiteAnnonce_dateCreation
			, petiteAnnonce_dateModification
			, petiteAnnonce_affichage
			, petiteAnnonce_publier

			FROM petiteAnnonce WHERE petiteAnnonce_id=".$petiteAnnonceId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iPetiteAnnonce = count($toPetiteAnnonce = $pDbw->fetchAll($zQuery));
		if ($iPetiteAnnonce==0) {
        	throw new Exception("PetiteAnnonce $petiteAnnonceId non trouvée");
		}

		$toPetiteAnnonce[0]->petiteAnnonce_reference 		= stripslashes($toPetiteAnnonce[0]->petiteAnnonce_reference);
		$toPetiteAnnonce[0]->petiteAnnonce_prixInfo 		= stripslashes($toPetiteAnnonce[0]->petiteAnnonce_prixInfo);
		$toPetiteAnnonce[0]->petiteAnnonce_titre	 		= stripslashes($toPetiteAnnonce[0]->petiteAnnonce_titre);
		$toPetiteAnnonce[0]->petiteAnnonce_description 		= stripslashes($toPetiteAnnonce[0]->petiteAnnonce_description);
		$toPetiteAnnonce[0]->petiteAnnonce_contact 			= stripslashes($toPetiteAnnonce[0]->petiteAnnonce_contact);
		$toPetiteAnnonce[0]->petiteAnnonce_dateCreation 	= stripslashes($toPetiteAnnonce[0]->petiteAnnonce_dateCreation);
		$toPetiteAnnonce[0]->petiteAnnonce_dateModification = stripslashes($toPetiteAnnonce[0]->petiteAnnonce_dateModification);
		
		return $toPetiteAnnonce[0];
	}

	/**
    * Enregistrement d'un petiteAnnonce
	*
	* @param object $petiteAnnonce Objet petiteAnnonce
    */
    static function sauvegardePetiteAnnonce($petiteAnnonce) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Publication de l'petiteAnnonce
		$petiteAnnonce->publier = isset($petiteAnnonce->publier)? $petiteAnnonce->publier : 0;
		
		if (!isset($petiteAnnonce->id) || $petiteAnnonce->id==0) { // insertion
		
		
		//print_r($petiteAnnonce);
			
			//Requette d'ajout
			$zQuery = "INSERT INTO petiteAnnonce VALUES (
				'0'								
				," .$petiteAnnonce->categorieAnId ."
				," .$oCnx->quote($petiteAnnonce->reference). "
				," .$oCnx->quote($petiteAnnonce->titre). "
				," .$oCnx->quote($petiteAnnonce->description). "
				," .$oCnx->quote($petiteAnnonce->prix) ."
				," .$oCnx->quote($petiteAnnonce->prixInfo). "
				," .$oCnx->quote($petiteAnnonce->contact). "
				," .$oCnx->quote($petiteAnnonce->dateCreation). "				
				,''				
				," .$petiteAnnonce->affichage ."
				," .$petiteAnnonce->publier ."
				)";
				//echo $zQuery;

			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE petiteAnnonce SET \n
					petiteAnnonce_id=".$oCnx->quote($petiteAnnonce->id)."";
					
			if (isset($petiteAnnonce->categorieAnId)) {
				$zQuery .= "\n, petiteAnnonce_categorieAnId=".$petiteAnnonce->categorieAnId."";
			}
			if (isset($petiteAnnonce->reference)) {
				$zQuery .= "\n, petiteAnnonce_reference=".$oCnx->quote($petiteAnnonce->reference)."";
			}
			if (isset($petiteAnnonce->titre)) {
				$zQuery .= "\n, petiteAnnonce_titre=".$oCnx->quote($petiteAnnonce->titre)."";
			}
			if (isset($petiteAnnonce->description)) {
				$zQuery .= "\n, petiteAnnonce_description=".$oCnx->quote($petiteAnnonce->description)."";
			}
			if (isset($petiteAnnonce->prix)) {
				$zQuery .= "\n, petiteAnnonce_prix='".$petiteAnnonce->prix."'";
			}
			if (isset($petiteAnnonce->prixInfo)) {
				$zQuery .= "\n, petiteAnnonce_prixInfo=".$oCnx->quote($petiteAnnonce->prixInfo)."";
			}
			if (isset($petiteAnnonce->contact)) {
				$zQuery .= "\n, petiteAnnonce_contact=".$oCnx->quote($petiteAnnonce->contact)."";
			}
			if (isset($petiteAnnonce->dateCreation)) {
				$zQuery .= "\n, petiteAnnonce_dateCreation=".$oCnx->quote($petiteAnnonce->dateCreation)."";
			}
			if (isset($petiteAnnonce->dateModification)) {
				$zQuery .= "\n, petiteAnnonce_dateModification=".$oCnx->quote($petiteAnnonce->dateModification)."";
			}
			if (isset($petiteAnnonce->affichage)) {
				$zQuery .= "\n, petiteAnnonce_affichage=".$petiteAnnonce->affichage."";
			}
			if (isset($petiteAnnonce->publier)) {
				$zQuery .= "\n, petiteAnnonce_publier=".$petiteAnnonce->publier."";
			}


			$zQuery .= " \nWHERE petiteAnnonce_id=".$petiteAnnonce->id;
			
			$oCnx->exec($zQuery);
	        $id = $petiteAnnonce->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un petiteAnnonce
	*
	* @param integer Id du petiteAnnonce à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimePetiteAnnonce($petiteAnnonceId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un petiteAnnonce
		$zQuery = "DELETE FROM petiteAnnonce WHERE petiteAnnonce_id=$petiteAnnonceId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un petiteAnnonce
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updatePetiteAnnonceStatut($idPetiteAnnonce, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE petiteAnnonce SET petiteAnnonce_statut ='".$statut."' WHERE petiteAnnonce_id =".$idPetiteAnnonce;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO petiteAnnonce
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoPetiteAnnonce() {

		$object = jDao::createRecord("petiteAnnonce~petiteAnnonce");
		//$object->petiteAnnonce_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une petiteAnnonce
	* param int $petiteAnnonceId id de la petiteAnnonce
	* return $petiteAnnonce objet petiteAnnonce
	*/
	static function getPetiteAnnonce($petiteAnnonceId){
		$dao=jDao::create("petiteAnnonce~petiteAnnonce");
		if(!($petiteAnnonce=$dao->get($petiteAnnonceId))){
			$dao=new jSelectorDao('petiteAnnonce~petiteAnnonce','');
			$c=$dao->getDaoRecordClass();
			$petiteAnnonce=new $c ();
		}
		return $petiteAnnonce;
	}	

	//With nb petiteAnnonces
    static function getRandAnByCategorie($idCategorieId) {

		$listeCategorieAn = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT an.* ";

		$zSql .=	" FROM petiteAnnonce AS an " ;

		$zSql .=	" WHERE p.petiteAnnonce_categorieAnId = " . $idCategorieId ;
		$zSql .=	" AND an.petiteAnnonce_publier = 1 " ;
		$zSql .=	" ORDER BY RAND()" ;
		$zSql .=	" LIMIT 1" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieAn, $record) ;
 		}

		$tResult = $listeCategorieAn ;
		
		return $tResult ;

	}

	//All petiteAnnonces by categorie
    static function getLastAnByCategorie($idCategorieIds, $nbFalls) {

		$listePetiteAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT an.*, c.* ";

		$zSql .=	" FROM petiteAnnonce AS an " ;

		$zSql .=	" LEFT JOIN categorieAn as c " ;
		$zSql .=	" 	ON an.petiteAnnonce_categorieAnId = c.categorieAn_id " ;

		$zSql .=	" WHERE an.petiteAnnonce_categorieAnId IN (" . $idCategorieIds . ") " ;
		$zSql .=	" AND an.petiteAnnonce_publier = 1 " ;
		$zSql .=	" ORDER BY an.petiteAnnonce_dateCreation DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;


		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listePetiteAnnonce, $record) ;
 		}

		$tResult = $listePetiteAnnonce ;
		
		return $tResult ;
	}

	//All petiteAnnonces by categorie
    static function getTopAnLaUNE($nbFalls=1) {

		$toPetiteAnnonces = array();
		
		$pDbw = jDb::getDbWidget();

		$zSql  = 	" SELECT an.*, r.* ";

		$zSql .=	" FROM petiteAnnonce AS an " ;
		
		$zSql .=	" WHERE an.petiteAnnonce_publier = 1 " ;
		$zSql .=	" ORDER BY an.petiteAnnonce_dateCreation DESC " ;
		$zSql .=	" LIMIT 0, $nbFalls ";

		$toPetiteAnnonces = $pDbw->fetchAll($zSql);		
		
		return $toPetiteAnnonces ;
	}



	/**
	* Renvoie la liste des petiteAnnonces
	* @return array of object toPetiteAnnonces
	*
	*/
    static function chargeListPetiteAnnonceAllFo() {

		$toPetiteAnnonces = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  petiteAnnonce AS p
					ORDER BY p.petiteAnnonce_reference ASC";

		$toPetiteAnnonces = $pDbw->fetchAll($zQuery);		

		return $toPetiteAnnonces;
	}		

	/**
	* Renvoie l'id max des petiteAnnonces
	* @return array of object toPetiteAnnonces
	*
	*/
    static function chargeMaxIdPetiteAnnonceFo() {

		$toPetiteAnnonces = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT MAX(p.petiteAnnonce_id) AS maxId  
					FROM  petiteAnnonce AS p";

		$toPetiteAnnonces = $pDbw->fetchAll($zQuery);		

		return $toPetiteAnnonces[0]->maxId;
	}		

	static function updatePetiteAnnonce($idPetiteAnnonce, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE petiteAnnonce SET ";

		if($publier != -1)
			$zQuery .="petiteAnnonce_publier =". $publier;
		
		$zQuery	.=" WHERE petiteAnnonce_id =". $idPetiteAnnonce;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function updatePetiteAnnonceHome($idPetiteAnnonce, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE petiteAnnonce SET ";

		if($publier != -1)
			$zQuery .="petiteAnnonce_publierHome =". $publier;
		
		$zQuery	.=" WHERE petiteAnnonce_id =". $idPetiteAnnonce;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}
	static function updatePetiteAnnonceUne($idPetiteAnnonce, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE petiteAnnonce SET ";

		if($publier != -1)
			$zQuery .="petiteAnnonce_laUne =". $publier;
		
		$zQuery	.=" WHERE petiteAnnonce_id =". $idPetiteAnnonce;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}


	static function incPetiteAnnonceVisite($idPetiteAnnonce, $visite=1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE petiteAnnonce SET petiteAnnonce_id = " . $idPetiteAnnonce;

		if($visite != -1)
			$zQuery .=", petiteAnnonce_visite = (petiteAnnonce_visite + ". $visite . ") ";
		
		$zQuery	.=" WHERE petiteAnnonce_id =". $idPetiteAnnonce;
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
