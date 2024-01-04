<?php
/**
* @package ilay-nosy
* @subpackage pays
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des payss
*
* @package ilay-nosy
* @subpackage pays
*/
class paysSrv {

	/**
    * Chargement de la liste des payss (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets payss , nombre d'enregistrement
	
	 pays_id   		int(11)
	 pays_libelle  	varchar(100) 	
	 pays_code  	varchar(5) 	
    */
    static function chargeListePays($sortField="pays_libelle", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listePays = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM pays AS s";

		$zSql  = 	" SELECT p.* "; 
		$zSql .=	" ,COUNT(e.expert_id) AS pays_nbExpert ";
		$zSql .=	" ,COUNT(so.societe_id) AS pays_nbSociete ";
		$zSql .=	" ,COUNT(ca.cabinet_id) AS pays_nbCabinet ";
		$zSql .=	" ,COUNT(u.utilisateur_id) AS pays_nbUtilisateur ";
		$zSql .=	" FROM pays AS p " ;
		$zSql .=	" LEFT JOIN expert AS e " ;
		$zSql .=	" 	ON e.expert_paysId = p.pays_id ";
		$zSql .=	" LEFT JOIN societe AS so " ;
		$zSql .=	" 	ON so.societe_paysId = p.pays_id ";
		$zSql .=	" LEFT JOIN cabinet AS ca " ;
		$zSql .=	" 	ON ca.cabinet_paysId = p.pays_id ";
		$zSql .=	" LEFT JOIN utilisateur AS u " ;
		$zSql .=	" 	ON u.utilisateur_paysId = p.pays_id ";
		$zSql .=	" GROUP BY p.pays_libelle" ;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM pays");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE_PAYS ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listePays = $oPaysDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
			$record->pays_libelle = stripslashes($record->pays_libelle );
			array_push($listePays, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listePays'] = $listePays ;
		
		return $tResult ;

	}
	

    static function chargeAllPays() {

		$listePays = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT s.* ";
		$zSql .=	" FROM pays AS s " ;
		$zSql .= 	" ORDER BY pays_libelle ASC " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listePays, $record) ;
 		}

		$tResult = $listePays ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un pays donné
	*
	* @param integer $paysId Id de l'pays souhaitée
	* @return object $toPays  objet pays
    */
    static function chargePays($paysId) {

		// 	Chargement des données
		if (!$paysId) {
			throw new Exception("Pas d'identifient du pays envoyé");
		}

		$zQuery = "SELECT pays_id
			, pays_libelle
			, pays_code
			FROM pays
			WHERE pays_id=$paysId";
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iPays = count($toPays = $pDbw->fetchAll($zQuery));
		if ($iPays==0) {
        	throw new Exception("Pays $paysId non trouvée");
		}
		
		return $toPays[0];
	}


	/**
    * Enregistrement d'un pays
	*
	* @param object $pays Objet pays
    */
    static function sauvegardePays($pays) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		if (!isset($pays->id) || $pays->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO pays VALUES (
			      '0'
				, ".$oCnx->quote($pays->libelle)."
				, ".$oCnx->quote($pays->code).")";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE pays SET \n
					pays_id=".$oCnx->quote($pays->id)."";

			if (isset($pays->libelle)) {
				$zQuery .= "\n, pays_libelle=".$oCnx->quote($pays->libelle)."";
			}
			if (isset($pays->code)) {
				$zQuery .= "\n, pays_code=".$oCnx->quote($pays->code)."";
			}

			$zQuery .= " \nWHERE pays_id=".$pays->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un pays
	*
	* @param integer Id du pays à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimePays($paysId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un pays
		$zQuery = "DELETE FROM pays WHERE pays_id=$paysId";
		$rConn->exec($zQuery);

		return TRUE;
	}
	
	/**
    * Factory d'objet DAO pays
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoPays() {

		$object = jDao::createRecord("pays~pays");
		//$object->pays_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* Renvoie la liste des pays
	* @return array of object pays
	*
	*/
    static function chargeListPaysAllFo() {

		$toPays = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  pays AS p
					ORDER BY p.pays_libelle ASC";

		$toPays = $pDbw->fetchAll($zQuery);		

		return $toPays;
	}	
}

?>
