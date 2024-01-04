<?php
/**
* @package ilay-nosy
* @subpackage categorieAn
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des categorieAns
*
* @package ilay-nosy
* @subpackage categorieAn
*/
class categorieAnSrv {

	/**
    * Chargement de la liste des categorieAns (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets categorieAns , nombre d'enregistrement
	
	 categorieAn_id   		int(11)
	 categorieAn_libelle  	varchar(100) 	
	 categorieAn_code  	varchar(5) 	
    */
    static function chargeListeCategorieAn($sortField="categorieAn_libelle", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeCategorieAn = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* "; 
		
		$zSql .=	" ,COUNT(r.rubrique_id) AS categorieAn_nbRubrique ";
		
		$zSql .=	" FROM categorieAn AS c " ;

		$zSql .=	" LEFT JOIN rubrique AS r " ;
		$zSql .=	" 	ON r.rubrique_categorieAnId = c.categorieAn_id ";
		$zSql .=	" GROUP BY c.categorieAn_libelle" ;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM categorieAn");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listeCategorieAn = $oCategorieAnDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
			$record->categorieAn_libelle = stripslashes($record->categorieAn_libelle );
			array_push($listeCategorieAn, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeCategorieAn'] = $listeCategorieAn ;
		
		return $tResult ;

	}

	//With nb annonces
    static function chargeAllCategorieAnNB() {

		$listeCategorieAn = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";

		$zSql .=	" ,COUNT(an.annonce_id) AS categorieAn_nbAnnonce ";

		$zSql .=	" FROM categorieAn AS c " ;

		$zSql .=	" LEFT JOIN rubrique AS r " ;
		$zSql .=	" 	ON r.rubrique_categorieAnId = c.categorieAn_id ";
		$zSql .=	" LEFT JOIN annonce AS an " ;
		$zSql .=	" 	ON (an.annonce_rubriqueId = r.rubrique_id AND an.annonce_publier = 1)";

		$zSql .=	" GROUP BY c.categorieAn_id" ;
		$zSql .=	" ORDER BY c.categorieAn_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieAn, $record) ;
 		}

		$tResult = $listeCategorieAn ;
		
		return $tResult ;

	}

    static function chargeAllCategorieAn() {

		$listeCategorieAn = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM categorieAn AS c " ;
		$zSql .=	" ORDER BY c.categorieAn_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieAn, $record) ;
 		}

		$tResult = $listeCategorieAn ;
		
		return $tResult ;

	}


    static function chargeAllCategorieAnIn($inCategorie) {

		$listeCategorieAn = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM categorieAn AS c " ;
		$zSql .=	" WHERE c.categorieAn_id IN (".$inCategorie.")" ;
		$zSql .=	" ORDER BY c.categorieAn_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieAn, $record) ;
 		}

		$tResult = $listeCategorieAn ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un categorieAn donné
	*
	* @param integer $categorieAnId Id de l'categorieAn souhaitée
	* @return object $toCategorieAn  objet categorieAn
    */
    static function chargeCategorieAn($categorieAnId) {

		// 	Chargement des données
		if (!$categorieAnId) {
			throw new Exception("Pas d'identifient du categorieAn envoyé");
		}

		$zQuery = "SELECT categorieAn_id
			, categorieAn_libelle
			, categorieAn_code
			FROM categorieAn
			WHERE 0=0 ";
			
			if($categorieAnId == 777){ //Autres annonces
				$zQuery .=	" AND categorieAn_id IN (" . CATEGORIE_ANNONCES . ") ";
			}else{
				$zQuery .=	" AND categorieAn_id = " . $categorieAnId;
			}	
			
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iCategorieAn = count($toCategorieAn = $pDbw->fetchAll($zQuery));
		if ($iCategorieAn==0) {
        	throw new Exception("CategorieAn $categorieAnId non trouvée");
		}

		if($categorieAnId == 777){ //Autres annonces
			$toCategorieAn[0]->categorieAn_libelle = "Autres annonces";
		}		
		return $toCategorieAn[0];
	}


	/**
    * Enregistrement d'un categorieAn
	*
	* @param object $categorieAn Objet categorieAn
    */
    static function sauvegardeCategorieAn($categorieAn) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		if (!isset($categorieAn->id) || $categorieAn->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO categorieAn VALUES (
			      '0'
				, ".$oCnx->quote($categorieAn->libelle)."
				, ".$oCnx->quote($categorieAn->code).")";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE categorieAn SET \n
					categorieAn_id=".$oCnx->quote($categorieAn->id)."";

			if (isset($categorieAn->libelle)) {
				$zQuery .= "\n, categorieAn_libelle=".$oCnx->quote($categorieAn->libelle)."";
			}
			if (isset($categorieAn->code)) {
				$zQuery .= "\n, categorieAn_code=".$oCnx->quote($categorieAn->code)."";
			}

			$zQuery .= " \nWHERE categorieAn_id=".$categorieAn->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un categorieAn
	*
	* @param integer Id du categorieAn à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeCategorieAn($categorieAnId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un categorieAn
		$zQuery = "DELETE FROM categorieAn WHERE categorieAn_id=$categorieAnId";
		$rConn->exec($zQuery);

		return TRUE;
	}
	
	/**
    * Factory d'objet DAO categorieAn
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoCategorieAn() {

		$object = jDao::createRecord("categorieAn~categorieAn");
		//$object->categorieAn_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* Renvoie la liste des CategorieAn
	* @return array of object CategorieAn
	*
	*/
    /*static function chargeListCategorieAnMembreAllFo() {

		$toCategorieAns = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  categorieAn AS p
					WHERE categorieAn_id NOT IN (".SITE_PROFIL_SADMIN.",".SITE_PROFIL_ADMIN.")
					ORDER BY p.categorieAn_libelle ASC";

		$toCategorieAns = $pDbw->fetchAll($zQuery);		

		return $toCategorieAns;
	}*/	
}

?>
