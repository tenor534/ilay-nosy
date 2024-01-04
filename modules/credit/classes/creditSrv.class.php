<?php
/**
* @package ilay-nosy
* @subpackage credit
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des credits
*
* @package ilay-nosy
* @subpackage credit
*/
class creditSrv {

	/**
    * Chargement de la liste des credits (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets credits , nombre d'enregistrement
	
	 credit_id   	int(11)
	 credit_libelle  	varchar(150) 	
    */
    static function chargeListeCredit($sortField="forfait_libelle, credit_id", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeCredit = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM credit AS s";
		
		$zSql  = 	" SELECT c.* ";

		$zSql .=	" ,f.forfait_libelle ";

		$zSql .=	" FROM credit AS c " ;

		$zSql .=	" LEFT JOIN forfait as f " ; 
		$zSql .=	" 	ON c.credit_forfaitId = f.forfait_id";

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM credit");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeCredit = $oCreditDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->credit_codePIN 	= stripslashes($record->credit_codePIN);
			$record->credit_password 	= stripslashes($record->credit_password);

			array_push($listeCredit, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeCredit'] = $listeCredit ;
		
		return $tResult ;
	}


    static function chargeAllCredit() {

		$listeCredit = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM credit AS r " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCredit, $record) ;
 		}

		$tResult = $listeCredit ;
		
		return $tResult ;

	}	
	
    static function chargeAllCreditWithout($id) {

		$listeCredit = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM credit AS c " ;
		$zSql .=	" WHERE f.credit_id <> $id" ;
		$zSql .=	" ORDER BY f.credit_id" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCredit, $record) ;
 		}

		$tResult = $listeCredit ;
		return $tResult ;
	}

	/**
    * Chargement d'un credit donné
	*
	* @param integer $creditId Id de l'credit souhaitée
	* @return object $toCredit  objet credit
    */
    static function chargeCredit($creditId) {

		// 	Chargement des données
		if (!$creditId) {
			throw new Exception("Pas d'identifient du credit envoyé");
		}

		$zQuery = "SELECT credit_id

				, credit_abonnementId
				, credit_forfaitId
				, credit_isPlus
				, credit_codePIN
				, credit_password
				, credit_dateUse

			FROM credit WHERE credit_id=".$creditId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iCredit = count($toCredit = $pDbw->fetchAll($zQuery));
		if ($iCredit==0) {
        	throw new Exception("Credit $creditId non trouvée");
		}

		$toCredit[0]->credit_codePIN 		= stripslashes($toCredit[0]->credit_codePIN);
		$toCredit[0]->credit_password 		= stripslashes($toCredit[0]->credit_password);
		
		return $toCredit[0];
	}

	/**
    * Enregistrement d'un credit
	*
	* @param object $credit Objet credit
    */
    static function sauvegardeCredit($credit) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'credit
		$credit->statut = isset($credit->statut)? $credit->statut : 0;
		
		if (!isset($credit->id) || $credit->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO credit VALUES (
				'0'
				," .$credit->abonnementId ."
				," .$credit->forfaitId ."
				," .$credit->isPlus ."
				," .$oCnx->quote($credit->codePIN) ."
				," .$oCnx->quote($credit->password) ."
				," .$oCnx->quote($credit->dateUse) ."
				)";
				
			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE credit SET \n
					credit_id=".$oCnx->quote($credit->id)."";
					
			if (isset($credit->abonnementId)) {
				$zQuery .= "\n, credit_abonnementId=".$credit->abonnementId."";
			}				
			if (isset($credit->forfaitId)) {
				$zQuery .= "\n, credit_forfaitId=".$credit->forfaitId."";
			}				
			if (isset($credit->isPlus)) {
				$zQuery .= "\n, credit_isPlus=".$credit->isPlus."";
			}				
			if (isset($credit->codePIN)) {
				$zQuery .= "\n, credit_codePIN=".$oCnx->quote($credit->codePIN)."";
			}
			if (isset($credit->password)) {
				$zQuery .= "\n, credit_password=".$oCnx->quote($credit->password)."";
			}
			if (isset($credit->dateUse)) {
				$zQuery .= "\n, credit_dateUse=".$oCnx->quote($credit->dateUse)."";
			}

			$zQuery .= " \nWHERE credit_id=".$credit->id;
			$oCnx->exec($zQuery);
	        $id = $credit->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un credit
	*
	* @param integer Id du credit à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeCredit($creditId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un credit
		$zQuery = "DELETE FROM credit WHERE credit_id=$creditId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un credit
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateCreditStatut($idCredit, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE credit SET credit_statut ='".$statut."' WHERE credit_id =".$idCredit;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO credit
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoCredit() {

		$object = jDao::createRecord("credit~credit");
		//$object->credit_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une credit
	* param int $creditId id de la credit
	* return $credit objet credit
	*/
	static function getCredit($creditId){
		$dao=jDao::create("credit~credit");
		if(!($credit=$dao->get($creditId))){
			$dao=new jSelectorDao('credit~credit','');
			$c=$dao->getDaoRecordClass();
			$credit=new $c ();
		}
		return $credit;
	}		
	
	/**
	* selectionner les credits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function getAllCredit($idForfaitId)
	{
		$zQuery = "SELECT c.*
				FROM credit AS c 
				WHERE c.credit_forfaitId = '".$idForfaitId."' 
				ORDER BY c.credit_id";
      	$pDbw = jDb::getDbWidget();
      	$toCredit = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toCredit as $oCredit)
		{
			$oCredit->credit_codePIN = stripslashes($oCredit->credit_codePIN);
			$oCredit->credit_password = stripslashes($oCredit->credit_password);
			array_push($tResult, $oCredit);
		}
		return $tResult;
	}

	/**
    * Chargement d'un credit donné
	*
	* @param integer $creditId Id de l'credit souhaitée
	* @return object $toCredit  objet credit
    */
    static function validCredit($forfaitId, $codePIN, $password) {

		// 	Chargement des données
		$zQuery = "SELECT credit_id
				, credit_abonnementId
				, credit_forfaitId
				, credit_isPlus
				, credit_codePIN
				, credit_password
				, credit_dateUse

				FROM credit 
					WHERE credit_forfaitId=" . $forfaitId . " 
					AND credit_codePIN = '" . $codePIN . "' 
					AND credit_password = '" . $password . "'
					AND credit_dateUse IS NULL";					
      	$pDbw = jDb::getDbWidget();
      	
		if (count($toCredit = $pDbw->fetchAll($zQuery))){
			return $toCredit[0]->credit_id;
		}else{
			return 0;
		}
	}

}

?>
