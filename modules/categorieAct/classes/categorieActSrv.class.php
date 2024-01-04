<?php
/**
* @package ilay-nosy
* @subpackage categorieAct
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des categorieActs
*
* @package ilay-nosy
* @subpackage categorieAct
*/
class categorieActSrv {

	/**
    * Chargement de la liste des categorieActs (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets categorieActs , nombre d'enregistrement
	
	 categorieAct_id   		int(11)
	 categorieAct_libelle  	varchar(100) 	
	 categorieAct_code  	varchar(5) 	
    */
    static function chargeListeCategorieAct($sortField="categorieAct_libelle", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeCategorieAct = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* "; 
		
		$zSql .=	" ,COUNT(a.actualite_id) AS categorieAct_nbActualite ";
		
		$zSql .=	" FROM categorieAct AS c " ;

		$zSql .=	" LEFT JOIN actualite AS a " ;
		$zSql .=	" 	ON a.actualite_categorieActId = c.categorieAct_id ";
		$zSql .=	" GROUP BY c.categorieAct_id" ;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM categorieAct");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listeCategorieAct = $oCategorieActDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
			$record->categorieAct_libelle = stripslashes($record->categorieAct_libelle );
			array_push($listeCategorieAct, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeCategorieAct'] = $listeCategorieAct ;
		
		return $tResult ;

	}

	//With nb actualites
    static function chargeAllCategorieActNB() {

		$listeCategorieAct = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";

		$zSql .=	" ,COUNT(a.actualite_id) AS categorieAct_nbActualite ";

		$zSql .=	" FROM categorieAct AS c " ;

		$zSql .=	" LEFT JOIN actualite AS a " ;
		$zSql .=	" 	ON a.actualite_categorieActId = c.categorieAct_id ";

		$zSql .=	" GROUP BY c.categorieAct_id" ;
		$zSql .=	" ORDER BY c.categorieAct_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieAct, $record) ;
 		}

		$tResult = $listeCategorieAct ;
		
		return $tResult ;

	}

    static function chargeAllCategorieAct() {

		$listeCategorieAct = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM categorieAct AS c " ;
		$zSql .=	" ORDER BY c.categorieAct_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieAct, $record) ;
 		}

		$tResult = $listeCategorieAct ;
		
		return $tResult ;

	}


    static function chargeAllCategorieActIn($inCategorie) {

		$listeCategorieAct = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM categorieAct AS c " ;
		$zSql .=	" WHERE c.categorieAct_id IN (".$inCategorie.")" ;
		$zSql .=	" ORDER BY c.categorieAct_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieAct, $record) ;
 		}

		$tResult = $listeCategorieAct ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un categorieAct donné
	*
	* @param integer $categorieActId Id de l'categorieAct souhaitée
	* @return object $toCategorieAct  objet categorieAct
    */
    static function chargeCategorieAct($categorieActId) {

		// 	Chargement des données
		if (!$categorieActId) {
			throw new Exception("Pas d'identifient du categorieAct envoyé");
		}

		$zQuery = "SELECT categorieAct_id
					, categorieAct_libelle
					, categorieAct_code
					FROM categorieAct
					WHERE categorieAct_id=$categorieActId";
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iCategorieAct = count($toCategorieAct = $pDbw->fetchAll($zQuery));
		if ($iCategorieAct==0) {
        	throw new Exception("CategorieAct $categorieActId non trouvée");
		}
		
		return $toCategorieAct[0];
	}


	/**
    * Enregistrement d'un categorieAct
	*
	* @param object $categorieAct Objet categorieAct
    */
    static function sauvegardeCategorieAct($categorieAct) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		if (!isset($categorieAct->id) || $categorieAct->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO categorieAct VALUES (
			      '0'
				, ".$oCnx->quote($categorieAct->libelle)."
				, ".$oCnx->quote($categorieAct->code).")";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE categorieAct SET \n
					categorieAct_id=".$oCnx->quote($categorieAct->id)."";

			if (isset($categorieAct->libelle)) {
				$zQuery .= "\n, categorieAct_libelle=".$oCnx->quote($categorieAct->libelle)."";
			}
			if (isset($categorieAct->code)) {
				$zQuery .= "\n, categorieAct_code=".$oCnx->quote($categorieAct->code)."";
			}

			$zQuery .= " \nWHERE categorieAct_id=".$categorieAct->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un categorieAct
	*
	* @param integer Id du categorieAct à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeCategorieAct($categorieActId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un categorieAct
		$zQuery = "DELETE FROM categorieAct WHERE categorieAct_id=$categorieActId";
		$rConn->exec($zQuery);

		return TRUE;
	}
	
	/**
    * Factory d'objet DAO categorieAct
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoCategorieAct() {

		$object = jDao::createRecord("categorieAct~categorieAct");
		//$object->categorieAct_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* Renvoie la liste des CategorieAct
	* @return array of object CategorieAct
	*
	*/
    /*static function chargeListCategorieActMembreAllFo() {

		$toCategorieActs = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  categorieAct AS p
					WHERE categorieAct_id NOT IN (".SITE_PROFIL_SADMIN.",".SITE_PROFIL_ADMIN.")
					ORDER BY p.categorieAct_libelle ASC";

		$toCategorieActs = $pDbw->fetchAll($zQuery);		

		return $toCategorieActs;
	}*/	
}

?>
