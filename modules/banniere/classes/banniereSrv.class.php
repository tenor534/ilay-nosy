<?php
/**
* @package ilay-nosy
* @subpackage banniere
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des bannieres
*
* @package ilay-nosy
* @subpackage banniere
*/
class banniereSrv {

	/**
    * Chargement de la liste des bannieres (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets bannieres , nombre d'enregistrement
	
	 banniere_id   	int(11)
	 banniere_libelle  	varchar(150) 	
    */
    static function chargeListeBanniereRechercheFo($cid=0, $mot="", $parution=0, $sortField="categorieAct_libelle ASC, banniere_dateDebutPub", $sortDirection="DESC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {

		$listeBanniere = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM banniere AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,c.* ";
		
		$zSql .=	" ,COUNT(p.photo_banniereId) AS banniere_nbPhoto ";
		$zSql .=	" ,COUNT(k.commentAct_banniereId) AS banniere_nbComment ";

		$zSql .=	" FROM banniere AS a " ;

		$zSql .=	" LEFT JOIN categorieAct as c " ; 
		$zSql .=	" 	ON a.banniere_categorieActId = c.categorieAct_id";

		//photo
		$zSql .=	" LEFT JOIN photoAct AS p " ;
		$zSql .=	" 	ON p.photo_banniereId = a.banniere_id ";
		//commentaire
		$zSql .=	" LEFT JOIN commentAct AS k " ;
		$zSql .=	" 	ON k.commentAct_banniereId = a.banniere_id ";

		$zSql .=	" GROUP BY a.banniere_id" ;

		$zSql .=	" HAVING 0=0 ";
		
		//Clauses
		$zClause = " ";
		
		//Catégories
		if($cid != 0){
			$zClause .=	" AND a.banniere_categorieActId=" . $cid ;
		}				
			
		//Mots clés
		if($mot != ""){
			$zClause .=	" AND ((UPPER(a.banniere_titre) LIKE '%$mot%') OR (UPPER(a.banniere_reference) LIKE '%$mot%') OR (UPPER(a.banniere_resume) LIKE '%$mot%'))";
		}				
		
		if($parution != 0){
		
			switch($parution){
				case 1: //1jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.banniere_dateDebutPub) <= 1";
					break;
				case 2: //2jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.banniere_dateDebutPub) <= 2";
					break;
				case 3: //3jour
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.banniere_dateDebutPub) <= 3";
					break;
				case 4: //1semaine
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.banniere_dateDebutPub) <= 8";
					break;
				case 5: //2semaines
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.banniere_dateDebutPub) <= 15";
					break;
				case 6: //1mois
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.banniere_dateDebutPub) <= 30";
					break;
				case 7: //2 mois
					$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.banniere_dateDebutPub) <= 61";
					break;
			}
		}		

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT a.*, c.*  
								FROM banniere as a 

								LEFT JOIN categorieAct as c 
									ON a.banniere_categorieActId = c.categorieAct_id
								LEFT JOIN commentAct AS k
									ON k.commentAct_banniereId = a.banniere_id 
								GROUP BY a.banniere_id 
								HAVING 0=0 "  . $zClause);
								
								
		$recordCount = $rsCount->fetchAll() ;
		$iNbEnreg = sizeof($recordCount) ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeBanniere = $oBanniereDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->banniere_reference 	= stripslashes($record->banniere_reference);
			$record->banniere_titre 		= stripslashes($record->banniere_titre);
			$record->banniere_resume 		= stripslashes($record->banniere_resume);
			$record->banniere_texte 		= stripslashes($record->banniere_texte);			
			$record->banniere_photo 		= stripslashes($record->banniere_photo);
			$record->banniere_source 		= stripslashes($record->banniere_source);
			$record->banniere_fichier 		= stripslashes($record->banniere_fichier);

			$record->categorieAct_libelle 	= stripslashes($record->categorieAct_libelle);
			$record->categorieAct_code 		= stripslashes($record->categorieAct_code);

			array_push($listeBanniere, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeBanniere'] = $listeBanniere ;
		
		return $tResult ;
	}

    static function chargeListeBanniere($cid=0, $sortField="banniere_dateDebutPub", $sortDirection="DESC", $iDebutListe=0, $iListAll=0, $nbPagination=15) {

		$listeBanniere = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();
		
		$zSql  = 	" SELECT a.* ";		
		$zSql .=	" FROM banniere AS a " ;

		$zSql .=	" WHERE 0=0 ";
		
		$zClause = " ";
		//if($cid != 0){
		//	$zClause .=	" AND a.banniere_categorieActId=" . $cid ;
		//}	

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg 
								FROM banniere as a 
								WHERE 0=0 "  . $zClause);
								
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeBanniere = $oBanniereDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){

			$record->banniere_nom 	= stripslashes($record->banniere_nom);
			$record->banniere_logo 		= stripslashes($record->banniere_logo);
			$record->banniere_banniere 		= stripslashes($record->banniere_banniere);
			$record->banniere_url 		= stripslashes($record->banniere_url);			

			array_push($listeBanniere, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeBanniere'] = $listeBanniere ;
		
		return $tResult ;
	}

    static function chargeAllBanniere() {

		$listeBanniere = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM banniere AS a " ;
		$zSql .=	" WHERE 0=0 " ;
		$zSql .=	" 	AND a.banniere_publier = 1 " ;
		$zSql .=	" ORDER BY a.banniere_dateDebutPub DESC" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeBanniere, $record) ;
 		}

		$tResult = $listeBanniere ;
		
		return $tResult ;

	}	
	
    static function chargeAllBanniereWithout($id) {

		$listeBanniere = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM banniere AS aa " ;
		$zSql .=	" WHERE a.banniere_id <> $id" ;
		$zSql .=	" 	AND a.banniere_publier = 1 " ;
		$zSql .=	" ORDER BY a.banniere_dateDebutPub DESC" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeBanniere, $record) ;
 		}

		$tResult = $listeBanniere ;
		return $tResult ;
	}

	/**
    * Chargement d'un banniere donné
	*
	* @param integer $banniereId Id de l'banniere souhaitée
	* @return object $toBanniere  objet banniere
    */
    static function chargeBanniere($banniereId) {

		// 	Chargement des données
		if (!$banniereId) {
			throw new Exception("Pas d'identifient du banniere envoyé");
		}

		$zQuery = "SELECT banniere_id
			, banniere_nom
			, banniere_logo
			, banniere_banniere
			, banniere_typeZone
			, banniere_height
			, banniere_width
			, banniere_weight
			, banniere_url
			, banniere_typeLink
			, banniere_dateCreation
			, banniere_dateModification
			, banniere_dateDebutPub
			, banniere_dateFinPub
			, banniere_vue
			, banniere_click
			, banniere_publierHome
			, banniere_publierInternal			

			FROM banniere WHERE banniere_id=".$banniereId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iBanniere = count($toBanniere = $pDbw->fetchAll($zQuery));
		if ($iBanniere==0) {
        	throw new Exception("Banniere $banniereId non trouvée");
		}

		$toBanniere[0]->banniere_nom 		= stripslashes($toBanniere[0]->banniere_nom);
		$toBanniere[0]->banniere_logo 		= stripslashes($toBanniere[0]->banniere_logo);
		$toBanniere[0]->banniere_banniere 	= stripslashes($toBanniere[0]->banniere_banniere);
		$toBanniere[0]->banniere_url 		= stripslashes($toBanniere[0]->banniere_url);			
		
		return $toBanniere[0];
	}

	/**
    * Enregistrement d'un banniere
	*
	* @param object $banniere Objet banniere
    */
    static function sauvegardeBanniere($banniere) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'banniere
		$banniere->statut = isset($banniere->statut)? $banniere->statut : 0;
		
		if (!isset($banniere->id) || $banniere->id==0) { // insertion
		
		
		//print_r($banniere);
			
			//Requette d'ajout
			$zQuery = "INSERT INTO banniere VALUES (
				'0'

				," .$oCnx->quote($banniere->nom). "
				," .$oCnx->quote($banniere->logo). "
				," .$oCnx->quote($banniere->banniere). "	

				," .$banniere->typeZone ."
				," .$banniere->height ."
				," .$banniere->width ."
				," .$banniere->weight ."
				
				," .$oCnx->quote($banniere->url). "
				
				," .$banniere->typeLink ."
				
				," .$oCnx->quote($banniere->dateCreation). "
				," .$oCnx->quote($banniere->dateModification). "
				," .$oCnx->quote($banniere->dateDebutPub). "
				," .$oCnx->quote($banniere->dateFinPub). "
				
				," .$banniere->vue ."
				," .$banniere->click ."
				," .$banniere->publierHome ."
				," .$banniere->publierInternal."
				
				
				)";
				//echo $zQuery;

			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE banniere SET \n
					banniere_id=".$oCnx->quote($banniere->id)."";
					
			if (isset($banniere->nom)) {
				$zQuery .= "\n, banniere_nom=".$oCnx->quote($banniere->nom)."";
			}
			if (isset($banniere->logo)) {
				$zQuery .= "\n, banniere_logo=".$oCnx->quote($banniere->logo)."";
			}
			if (isset($banniere->banniere)) {
				$zQuery .= "\n, banniere_banniere=".$oCnx->quote($banniere->banniere)."";
			}
			if (isset($banniere->typeZone)) {
				$zQuery .= "\n, banniere_typeZone=".$banniere->typeZone."";
			}
			if (isset($banniere->height)) {
				$zQuery .= "\n, banniere_height=".$banniere->height."";
			}
			if (isset($banniere->width)) {
				$zQuery .= "\n, banniere_width=".$banniere->width."";
			}
			if (isset($banniere->weight)) {
				$zQuery .= "\n, banniere_weight=".$banniere->weight."";
			}
			if (isset($banniere->url)) {
				$zQuery .= "\n, banniere_url=".$oCnx->quote($banniere->url)."";
			}
			if (isset($banniere->typeLink)) {
				$zQuery .= "\n, banniere_typeLink=".$banniere->typeLink."";
			}
			if (isset($banniere->dateCreation)) {
				$zQuery .= "\n, banniere_dateCreation=".$oCnx->quote($banniere->dateCreation)."";
			}
			if (isset($banniere->dateModification)) {
				$zQuery .= "\n, banniere_dateModification=".$oCnx->quote($banniere->dateModification)."";
			}
			if (isset($banniere->dateDebutPub)) {
				$zQuery .= "\n, banniere_dateDebutPub=".$oCnx->quote($banniere->dateDebutPub)."";
			}
			if (isset($banniere->dateFinPub)) {
				$zQuery .= "\n, banniere_dateFinPub=".$oCnx->quote($banniere->dateFinPub)."";
			}
			if (isset($banniere->vue)) {
				$zQuery .= "\n, banniere_vue=".$banniere->vue."";
			}
			if (isset($banniere->click)) {
				$zQuery .= "\n, banniere_click=".$banniere->click."";
			}
			if (isset($banniere->publierHome)) {
				$zQuery .= "\n, banniere_publierHome=".$banniere->publierHome."";
			}
			if (isset($banniere->publierInternal)) {
				$zQuery .= "\n, banniere_publierInternal=".$banniere->publierInternal."";
			}

			$zQuery .= " \nWHERE banniere_id=".$banniere->id;
			
			$oCnx->exec($zQuery);
	        $id = $banniere->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un banniere
	*
	* @param integer Id du banniere à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeBanniere($banniereId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un banniere
		$zQuery = "DELETE FROM banniere WHERE banniere_id=$banniereId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un banniere
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateBanniereStatut($idBanniere, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE banniere SET banniere_statut ='".$statut."' WHERE banniere_id =".$idBanniere;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO banniere
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoBanniere() {

		$object = jDao::createRecord("banniere~banniere");
		//$object->banniere_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une banniere
	* param int $banniereId id de la banniere
	* return $banniere objet banniere
	*/
	static function getBanniere($banniereId){
		$dao=jDao::create("banniere~banniere");
		if(!($banniere=$dao->get($banniereId))){
			$dao=new jSelectorDao('banniere~banniere','');
			$c=$dao->getDaoRecordClass();
			$banniere=new $c ();
		}
		return $banniere;
	}	
	
	
	
	/**
	* selectionner les bannieres existant pour une catégorie donnée
	* @param idForfaitId
	* @return tableau de boissons
	*/
	static function getAllBanniere($idCategorieActId)
	{
		$zQuery = "SELECT a.*
				FROM banniere AS a 
				WHERE a.banniere_categorieActId = '".$idCategorieActId."' 
				ORDER BY a.banniere_dateDebutPub DESC";
      	$pDbw = jDb::getDbWidget();
      	$toBanniere = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toBanniere as $oBanniere)
		{
			$oBanniere->banniere_libelle = stripslashes($oBanniere->banniere_libelle);
			array_push($tResult, $oBanniere);
		}
		return $tResult;
	}

	//With nb bannieres
    static function getRandActByCategorie($idCategorieId) {

		$listeCategorieAct = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.* ";
		$zSql .=	" FROM banniere AS a " ;
		$zSql .=	" WHERE a.banniere_categorieActId = " . $idCategorieId ;
		$zSql .=	" 	AND a.banniere_publier = 1 " ;
		$zSql .=	" ORDER BY RAND()" ;
		$zSql .=	" LIMIT 1" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieAct, $record) ;
 		}

		$tResult = $listeCategorieAct ;
		
		return $tResult ;

	}

	//All bannieres with limit
    static function getLastAct($nbFalls) {

		$listeBanniere = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.*";

		$zSql .=	" FROM banniere AS a " ;

		$zSql .=	" WHERE 0=0 " ;
		$zSql .=	" 	AND a.banniere_publier = 1 " ;
		$zSql .=	" 	AND a.banniere_publierHome = 1 " ;
		$zSql .=	" ORDER BY a.banniere_dateDebutPub DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeBanniere, $record) ;
 		}

		$tResult = $listeBanniere ;
		
		return $tResult ;
	}

	//All bannieres by categorie
    static function getLastActByCategorie($idCategorieIds, $nbFalls) {

		$listeBanniere = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT a.*";

		$zSql .=	" FROM banniere AS a " ;

		$zSql .=	" WHERE a.banniere_categorieActId IN (" . $idCategorieIds . ") " ;
		$zSql .=	" ORDER BY a.banniere_dateDebutPub DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeBanniere, $record) ;
 		}

		$tResult = $listeBanniere ;
		
		return $tResult ;
	}


	//All bannieres by categorie
    static function getTopActLaUNE($nbFalls=1) {

		$toBannieres = array();
		
		$pDbw = jDb::getDbWidget();

		$zSql  = 	" SELECT a.*";
		$zSql .=	" FROM banniere AS a " ;		
		$zSql .=	" WHERE a.banniere_laUne = 1 " ;
		$zSql .=	" 	AND a.banniere_publier = 1 " ;
		$zSql .=	" 	AND a.banniere_publierHome = 1 " ;
		$zSql .=	" ORDER BY a.banniere_dateDebutPub DESC " ;
		$zSql .=	" LIMIT 0, $nbFalls ";

		$toBannieres = $pDbw->fetchAll($zSql);		
		
		return $toBannieres ;
	}



	/**
	* Renvoie la liste des bannieres
	* @return array of object toBannieres
	*
	*/
    static function chargeListBanniereAllFo() {

		$toBannieres = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  banniere AS p
					ORDER BY p.banniere_dateDebutPub DESC";
					
		$toBannieres = $pDbw->fetchAll($zQuery);		

		return $toBannieres;
	}	
	
	static function updateBanniere($idBanniere, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE banniere SET ";

		if($publier != -1)
			$zQuery .="banniere_publier =". $publier;
		
		$zQuery	.=" WHERE banniere_id =". $idBanniere;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function updateBanniereHome($idBanniere, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE banniere SET ";

		if($publier != -1)
			$zQuery .="banniere_publierHome =". $publier;
		
		$zQuery	.=" WHERE banniere_id =". $idBanniere;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}
	static function updateBanniereInternal($idBanniere, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE banniere SET ";

		if($publier != -1)
			$zQuery .="banniere_publierInternal =". $publier;
		
		$zQuery	.=" WHERE banniere_id =". $idBanniere;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function updateBanniereUne($idBanniere, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE banniere SET ";

		if($publier != -1)
			$zQuery .="banniere_laUne =". $publier;
		
		$zQuery	.=" WHERE banniere_id =". $idBanniere;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}


	static function incBanniereVisite($idBanniere, $visite=1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE banniere SET banniere_id = " . $idBanniere;

		if($visite != -1)
			$zQuery .=", banniere_visite = (banniere_visite + ". $visite . ") ";
		
		$zQuery	.=" WHERE banniere_id =". $idBanniere;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function incBanniereClick($idBanniere, $click=1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE banniere SET banniere_id = " . $idBanniere;

		if($click != -1)
			$zQuery .=", banniere_click = (banniere_click + ". $click . ") ";
		
		$zQuery	.=" WHERE banniere_id =". $idBanniere;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}
	static function incBanniereVue($idBanniere, $vue=1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE banniere SET banniere_id = " . $idBanniere;

		if($vue != -1)
			$zQuery .=", banniere_vue = (banniere_vue + ". $vue . ") ";
		
		$zQuery	.=" WHERE banniere_id =". $idBanniere;
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
