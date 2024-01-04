<?php
/**
* @package ilay-nosy
* @subpackage pack
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des packs
*
* @package ilay-nosy
* @subpackage pack
*/
class packSrv {

	/**
    * Chargement de la liste des packs (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets packs , nombre d'enregistrement
	
	 pack_id   		int(11)
	 pack_libelle  	varchar(100) 	
	 pack_code  	varchar(5) 	
	 pack_photo  	varchar(100) 	
	 pack_fichier  	varchar(100) 	
    */
    static function chargeListePack($sortField="pack_libelle", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listePack = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM pack AS s";

		$zSql  = 	" SELECT p.* "; 
		
		$zSql .=	" ,COUNT(f.forfait_id) AS pack_nbForfait ";
		
		$zSql .=	" FROM pack AS p " ;
		
		$zSql .=	" LEFT JOIN forfait AS f " ;
		$zSql .=	" 	ON f.forfait_packId = p.pack_id ";
		$zSql .=	" GROUP BY p.pack_libelle" ;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM pack");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listePack = $oPackDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
			$record->pack_libelle = stripslashes($record->pack_libelle );
			$record->pack_photo = stripslashes($record->pack_photo );
			$record->pack_fichier = stripslashes($record->pack_fichier );
			array_push($listePack, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listePack'] = $listePack ;
		
		return $tResult ;

	}
	

    static function chargeAllPack() {

		$listePack = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT p.* ";
		$zSql .=	" FROM pack AS p " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listePack, $record) ;
 		}

		$tResult = $listePack ;
		
		return $tResult ;
	}

	/**
    * Chargement d'un pack donné
	*
	* @param integer $packId Id de l'pack souhaitée
	* @return object $toPack  objet pack
    */
    static function chargePack($packId) {

		// 	Chargement des données
		if (!$packId) {
			throw new Exception("Pas d'identifient du pack envoyé");
		}

		$zQuery = "SELECT pack_id
			, pack_libelle
			, pack_code
			, pack_photo
			, pack_fichier
			FROM pack
			WHERE pack_id=$packId";
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iPack = count($toPack = $pDbw->fetchAll($zQuery));
		if ($iPack==0) {
        	throw new Exception("Pack $packId non trouvée");
		}
		
		return $toPack[0];
	}


	/**
    * Enregistrement d'un pack
	*
	* @param object $pack Objet pack
    */
    static function sauvegardePack($pack) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		if (!isset($pack->id) || $pack->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO pack VALUES (
			      '0'
				, ".$oCnx->quote($pack->libelle)."
				, ".$oCnx->quote($pack->code)."
				, ".$oCnx->quote($pack->photo)."
				, ".$oCnx->quote($pack->fichier)."				
				)";
				
			$oCnx->exec($zQuery);		
				
	        $id = $oCnx->lastInsertId();
		} else { //update

			$zQuery = "UPDATE pack SET \n
					pack_id=".$oCnx->quote($pack->id)."";

			if (isset($pack->libelle)) {
				$zQuery .= "\n, pack_libelle=".$oCnx->quote($pack->libelle)."";
			}
			if (isset($pack->code)) {
				$zQuery .= "\n, pack_code=".$oCnx->quote($pack->code)."";
			}
			if (isset($pack->photo)) {
				$zQuery .= "\n, pack_photo=".$oCnx->quote($pack->photo)."";
			}
			if (isset($pack->fichier)) {
				$zQuery .= "\n, pack_fichier=".$oCnx->quote($pack->fichier)."";
			}

			$zQuery .= " \nWHERE pack_id=".$pack->id;
			$oCnx->exec($zQuery);

			$id = $pack->id;			
		}
		
		return $id;
	}

	/**
    * Suppression d'un pack
	*
	* @param integer Id du pack à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimePack($packId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un pack
		$zQuery = "DELETE FROM pack WHERE pack_id=$packId";
		$rConn->exec($zQuery);

		return TRUE;
	}
	
	/**
    * Factory d'objet DAO pack
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoPack() {

		$object = jDao::createRecord("pack~pack");
		//$object->pack_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
}

?>
