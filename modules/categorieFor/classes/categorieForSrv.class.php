<?php
/**
* @package ilay-nosy
* @subpackage categorieFor
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des categorieFors
*
* @package ilay-nosy
* @subpackage categorieFor
*/
class categorieForSrv {

	/**
    * Chargement de la liste des categorieFors (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets categorieFors , nombre d'enregistrement
	
	 categorieFor_id   		int(11)
	 categorieFor_libelle  	varchar(100) 	
	 categorieFor_code  	varchar(5) 	
    */
    static function chargeListeCategorieFor($sortField="categorieFor_libelle", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeCategorieFor = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* "; 
		
		$zSql .=	" ,COUNT(r.forum_id) AS categorieFor_nbRubrique ";
		
		$zSql .=	" FROM categorieFor AS c " ;

		$zSql .=	" LEFT JOIN forum AS r " ;
		$zSql .=	" 	ON r.forum_categorieForId = c.categorieFor_id ";
		$zSql .=	" GROUP BY c.categorieFor_libelle" ;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM categorieFor");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listeCategorieFor = $oCategorieForDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
			$record->categorieFor_libelle = stripslashes($record->categorieFor_libelle );
			array_push($listeCategorieFor, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeCategorieFor'] = $listeCategorieFor ;
		
		return $tResult ;

	}

	//With nb sujets
    static function chargeAllCategorieForNB() {

		$listeCategorieFor = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";

		$zSql .=	" ,COUNT(an.sujet_id) AS categorieFor_nbSujet ";

		$zSql .=	" FROM categorieFor AS c " ;

		$zSql .=	" LEFT JOIN forum AS r " ;
		$zSql .=	" 	ON r.forum_categorieForId = c.categorieFor_id ";
		$zSql .=	" LEFT JOIN sujet AS an " ;
		$zSql .=	" 	ON an.sujet_forumId = r.forum_id ";

		$zSql .=	" GROUP BY c.categorieFor_id" ;
		$zSql .=	" ORDER BY c.categorieFor_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieFor, $record) ;
 		}

		$tResult = $listeCategorieFor ;
		
		return $tResult ;

	}

    static function chargeAllCategorieFor() {

		$listeCategorieFor = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM categorieFor AS c " ;
		$zSql .=	" ORDER BY c.categorieFor_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieFor, $record) ;
 		}

		$tResult = $listeCategorieFor ;
		
		return $tResult ;

	}


    static function chargeAllCategorieForIn($inCategorie) {

		$listeCategorieFor = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM categorieFor AS c " ;
		$zSql .=	" WHERE c.categorieFor_id IN (".$inCategorie.")" ;
		$zSql .=	" ORDER BY c.categorieFor_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieFor, $record) ;
 		}

		$tResult = $listeCategorieFor ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un categorieFor donné
	*
	* @param integer $categorieForId Id de l'categorieFor souhaitée
	* @return object $toCategorieFor  objet categorieFor
    */
    static function chargeCategorieFor($categorieForId) {

		// 	Chargement des données
		if (!$categorieForId) {
			throw new Exception("Pas d'identifient du categorieFor envoyé");
		}

		$zQuery = "SELECT categorieFor_id
			, categorieFor_libelle
			, categorieFor_code
			FROM categorieFor
			WHERE categorieFor_id=$categorieForId";
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iCategorieFor = count($toCategorieFor = $pDbw->fetchAll($zQuery));
		if ($iCategorieFor==0) {
        	throw new Exception("CategorieFor $categorieForId non trouvée");
		}
		
		return $toCategorieFor[0];
	}


	/**
    * Enregistrement d'un categorieFor
	*
	* @param object $categorieFor Objet categorieFor
    */
    static function sauvegardeCategorieFor($categorieFor) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		if (!isset($categorieFor->id) || $categorieFor->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO categorieFor VALUES (
			      '0'
				, ".$oCnx->quote($categorieFor->libelle)."
				, ".$oCnx->quote($categorieFor->code).")";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE categorieFor SET \n
					categorieFor_id=".$oCnx->quote($categorieFor->id)."";

			if (isset($categorieFor->libelle)) {
				$zQuery .= "\n, categorieFor_libelle=".$oCnx->quote($categorieFor->libelle)."";
			}
			if (isset($categorieFor->code)) {
				$zQuery .= "\n, categorieFor_code=".$oCnx->quote($categorieFor->code)."";
			}

			$zQuery .= " \nWHERE categorieFor_id=".$categorieFor->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un categorieFor
	*
	* @param integer Id du categorieFor à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeCategorieFor($categorieForId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un categorieFor
		$zQuery = "DELETE FROM categorieFor WHERE categorieFor_id=$categorieForId";
		$rConn->exec($zQuery);

		return TRUE;
	}
	
	/**
    * Factory d'objet DAO categorieFor
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoCategorieFor() {

		$object = jDao::createRecord("categorieFor~categorieFor");
		//$object->categorieFor_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* Renvoie la liste des CategorieFor
	* @return array of object CategorieFor
	*
	*/
    /*static function chargeListCategorieForMembreAllFo() {

		$toCategorieFors = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  categorieFor AS p
					WHERE categorieFor_id NOT IN (".SITE_PROFIL_SADMIN.",".SITE_PROFIL_ADMIN.")
					ORDER BY p.categorieFor_libelle ASC";

		$toCategorieFors = $pDbw->fetchAll($zQuery);		

		return $toCategorieFors;
	}*/	
}

?>
