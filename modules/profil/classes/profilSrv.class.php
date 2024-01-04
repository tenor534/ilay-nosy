<?php
/**
* @package ilay-nosy
* @subpackage profil
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des profils
*
* @package ilay-nosy
* @subpackage profil
*/
class profilSrv {

	/**
    * Chargement de la liste des profils (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets profils , nombre d'enregistrement
	
	 profil_id   		int(11)
	 profil_libelle  	varchar(100) 	
	 profil_code  	varchar(5) 	
    */
    static function chargeListeProfil($sortField="profil_libelle", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeProfil = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM profil AS s";

		$zSql  = 	" SELECT p.* "; 
		
		//$zSql .=	" ,COUNT(ass.assProfilServiceDroit_profilId) AS profil_nbAssociation ";
		$zSql .=	" ,COUNT(u.utilisateur_id) AS profil_nbUtilisateur ";
		
		$zSql .=	" FROM profil AS p " ;
		//$zSql .=	" LEFT JOIN assProfilServiceDroit AS ass " ;
		//$zSql .=	" 	ON ass.assProfilServiceDroit_profilId = p.profil_id ";
		$zSql .=	" LEFT JOIN utilisateur AS u " ;
		$zSql .=	" 	ON u.utilisateur_profilId = p.profil_id ";
		$zSql .=	" GROUP BY p.profil_libelle" ;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM profil");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listeProfil = $oProfilDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
			$record->profil_libelle = stripslashes($record->profil_libelle );
			array_push($listeProfil, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeProfil'] = $listeProfil ;
		
		return $tResult ;

	}
	

    static function chargeAllProfil() {

		$listeProfil = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT s.* ";
		$zSql .=	" FROM profil AS s " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeProfil, $record) ;
 		}

		$tResult = $listeProfil ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un profil donné
	*
	* @param integer $profilId Id de l'profil souhaitée
	* @return object $toProfil  objet profil
    */
    static function chargeProfil($profilId) {

		// 	Chargement des données
		if (!$profilId) {
			throw new Exception("Pas d'identifient du profil envoyé");
		}

		$zQuery = "SELECT profil_id
			, profil_libelle
			, profil_code
			FROM profil
			WHERE profil_id=$profilId";
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iProfil = count($toProfil = $pDbw->fetchAll($zQuery));
		if ($iProfil==0) {
        	throw new Exception("Profil $profilId non trouvée");
		}
		
		return $toProfil[0];
	}


	/**
    * Enregistrement d'un profil
	*
	* @param object $profil Objet profil
    */
    static function sauvegardeProfil($profil) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		if (!isset($profil->id) || $profil->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO profil VALUES (
			      '0'
				, ".$oCnx->quote($profil->libelle)."
				, ".$oCnx->quote($profil->code).")";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE profil SET \n
					profil_id=".$oCnx->quote($profil->id)."";

			if (isset($profil->libelle)) {
				$zQuery .= "\n, profil_libelle=".$oCnx->quote($profil->libelle)."";
			}
			if (isset($profil->code)) {
				$zQuery .= "\n, profil_code=".$oCnx->quote($profil->code)."";
			}

			$zQuery .= " \nWHERE profil_id=".$profil->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un profil
	*
	* @param integer Id du profil à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeProfil($profilId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un profil
		$zQuery = "DELETE FROM profil WHERE profil_id=$profilId";
		$rConn->exec($zQuery);

		return TRUE;
	}
	
	/**
    * Factory d'objet DAO profil
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoProfil() {

		$object = jDao::createRecord("profil~profil");
		//$object->profil_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* Renvoie la liste des Profil
	* @return array of object Profil
	*
	*/
    static function chargeListProfilMembreAllFo() {

		$toProfils = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  profil AS p
					WHERE profil_id NOT IN (".SITE_PROFIL_SADMIN.",".SITE_PROFIL_ADMIN.")
					ORDER BY p.profil_libelle ASC";

		$toProfils = $pDbw->fetchAll($zQuery);		

		return $toProfils;
	}	
}

?>
