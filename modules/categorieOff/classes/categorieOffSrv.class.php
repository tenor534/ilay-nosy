<?php
/**
* @package ilay-nosy
* @subpackage categorieOff
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des categorieOffs
*
* @package ilay-nosy
* @subpackage categorieOff
*/
class categorieOffSrv {

	/**
    * Chargement de la liste des categorieOffs (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets categorieOffs , nombre d'enregistrement
	
	 categorieOff_id   		int(11)
	 categorieOff_libelle  	varchar(100) 	
	 categorieOff_code  	varchar(5) 	
    */
    static function chargeListeCategorieOff($sortField="categorieOff_libelle", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeCategorieOff = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* "; 
		
		$zSql .=	" ,COUNT(a.officiel_id) AS categorieOff_nbOfficiel ";
		
		$zSql .=	" FROM categorieOff AS c " ;

		$zSql .=	" LEFT JOIN officiel AS a " ;
		$zSql .=	" 	ON a.officiel_categorieOffId = c.categorieOff_id ";
		$zSql .=	" GROUP BY c.categorieOff_id" ;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM categorieOff");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listeCategorieOff = $oCategorieOffDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
			$record->categorieOff_libelle = stripslashes($record->categorieOff_libelle );
			array_push($listeCategorieOff, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeCategorieOff'] = $listeCategorieOff ;
		
		return $tResult ;

	}

	//With nb officiels
    static function chargeAllCategorieOffNB() {

		$listeCategorieOff = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";

		$zSql .=	" ,COUNT(a.officiel_id) AS categorieOff_nbOfficiel ";

		$zSql .=	" FROM categorieOff AS c " ;

		$zSql .=	" LEFT JOIN officiel AS a " ;
		$zSql .=	" 	ON a.officiel_categorieOffId = c.categorieOff_id ";

		$zSql .=	" GROUP BY c.categorieOff_id" ;
		$zSql .=	" ORDER BY c.categorieOff_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieOff, $record) ;
 		}

		$tResult = $listeCategorieOff ;
		
		return $tResult ;

	}

    static function chargeAllCategorieOff() {

		$listeCategorieOff = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM categorieOff AS c " ;
		$zSql .=	" ORDER BY c.categorieOff_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieOff, $record) ;
 		}

		$tResult = $listeCategorieOff ;
		
		return $tResult ;

	}


    static function chargeAllCategorieOffIn($inCategorie) {

		$listeCategorieOff = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM categorieOff AS c " ;
		$zSql .=	" WHERE c.categorieOff_id IN (".$inCategorie.")" ;
		$zSql .=	" ORDER BY c.categorieOff_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieOff, $record) ;
 		}

		$tResult = $listeCategorieOff ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un categorieOff donné
	*
	* @param integer $categorieOffId Id de l'categorieOff souhaitée
	* @return object $toCategorieOff  objet categorieOff
    */
    static function chargeCategorieOff($categorieOffId) {

		// 	Chargement des données
		if (!$categorieOffId) {
			throw new Exception("Pas d'identifient du categorieOff envoyé");
		}

		$zQuery = "SELECT categorieOff_id
					, categorieOff_libelle
					, categorieOff_code
					FROM categorieOff
					WHERE categorieOff_id=$categorieOffId";
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iCategorieOff = count($toCategorieOff = $pDbw->fetchAll($zQuery));
		if ($iCategorieOff==0) {
        	throw new Exception("CategorieOff $categorieOffId non trouvée");
		}
		
		return $toCategorieOff[0];
	}


	/**
    * Enregistrement d'un categorieOff
	*
	* @param object $categorieOff Objet categorieOff
    */
    static function sauvegardeCategorieOff($categorieOff) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		if (!isset($categorieOff->id) || $categorieOff->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO categorieOff VALUES (
			      '0'
				, ".$oCnx->quote($categorieOff->libelle)."
				, ".$oCnx->quote($categorieOff->code).")";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE categorieOff SET \n
					categorieOff_id=".$oCnx->quote($categorieOff->id)."";

			if (isset($categorieOff->libelle)) {
				$zQuery .= "\n, categorieOff_libelle=".$oCnx->quote($categorieOff->libelle)."";
			}
			if (isset($categorieOff->code)) {
				$zQuery .= "\n, categorieOff_code=".$oCnx->quote($categorieOff->code)."";
			}

			$zQuery .= " \nWHERE categorieOff_id=".$categorieOff->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un categorieOff
	*
	* @param integer Id du categorieOff à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeCategorieOff($categorieOffId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un categorieOff
		$zQuery = "DELETE FROM categorieOff WHERE categorieOff_id=$categorieOffId";
		$rConn->exec($zQuery);

		return TRUE;
	}
	
	/**
    * Factory d'objet DAO categorieOff
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoCategorieOff() {

		$object = jDao::createRecord("categorieOff~categorieOff");
		//$object->categorieOff_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* Renvoie la liste des CategorieOff
	* @return array of object CategorieOff
	*
	*/
    /*static function chargeListCategorieOffMembreAllFo() {

		$toCategorieOffs = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  categorieOff AS p
					WHERE categorieOff_id NOT IN (".SITE_PROFIL_SADMIN.",".SITE_PROFIL_ADMIN.")
					ORDER BY p.categorieOff_libelle ASC";

		$toCategorieOffs = $pDbw->fetchAll($zQuery);		

		return $toCategorieOffs;
	}*/	
}

?>
