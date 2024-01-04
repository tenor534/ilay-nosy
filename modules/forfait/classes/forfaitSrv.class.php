<?php
/**
* @package ilay-nosy
* @subpackage forfait
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des forfaits
*
* @package ilay-nosy
* @subpackage forfait
*/
class forfaitSrv {

	/**
    * Chargement de la liste des forfaits (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets forfaits , nombre d'enregistrement
	
	 forfait_id   	int(11)
	 forfait_libelle  	varchar(150) 	
    */
    static function chargeListeForfait($sortField="pack_code, forfait_id", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeForfait = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM forfait AS s";
		
		$zSql  = 	" SELECT f.* ";
		$zSql .=	" ,p.pack_code ";
		
		//$zSql .=	" ,COUNT(an.annonce_forfaitId) AS forfait_nbAnnonce ";
		$zSql .=	" ,COUNT(ab.abonnement_forfaitId) AS forfait_nbAbonnement ";

		$zSql .=	" FROM forfait AS f " ;

		$zSql .=	" LEFT JOIN pack as p " ; 
		$zSql .=	" 	ON f.forfait_packId = p.pack_id";

		//annonce
		//$zSql .=	" LEFT JOIN annonce AS an " ;
		//$zSql .=	" 	ON an.annonce_forfaitId = f.forfait_id ";
		//abonnement
		$zSql .=	" LEFT JOIN abonnement AS ab " ;
		$zSql .=	" 	ON ab.abonnement_forfaitId = f.forfait_id ";

		$zSql .=	" GROUP BY f.forfait_libelle" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM forfait");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeForfait = $oForfaitDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->forfait_libelle 	= stripslashes($record->forfait_libelle);

			$record->pack_code 	= stripslashes($record->pack_code);

			array_push($listeForfait, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeForfait'] = $listeForfait ;
		
		return $tResult ;
	}


    static function chargeAllForfait() {

		$listeForfait = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM forfait AS r " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeForfait, $record) ;
 		}

		$tResult = $listeForfait ;
		
		return $tResult ;

	}	
	
    static function chargeAllForfaitWithout($id) {

		$listeForfait = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT f.* ";
		$zSql .=	" FROM forfait AS f " ;
		$zSql .=	" WHERE f.forfait_id <> $id" ;
		$zSql .=	" ORDER BY f.forfait_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeForfait, $record) ;
 		}

		$tResult = $listeForfait ;
		return $tResult ;
	}

	/**
    * Chargement d'un forfait donné
	*
	* @param integer $forfaitId Id de l'forfait souhaitée
	* @return object $toForfait  objet forfait
    */
    static function chargeForfait($forfaitId) {

		// 	Chargement des données
		if (!$forfaitId) {
			throw new Exception("Pas d'identifient du forfait envoyé");
		}

		$zQuery = "SELECT forfait_id

				, forfait_packId
				, forfait_libelle
				, forfait_nbAnnonce
				, forfait_nbPhoto
				, forfait_nbCaractere
				, forfait_dureeParution
				, forfait_voirPhoto
				, forfait_voirCoordonnee
				, forfait_affichePhoto
				, forfait_afficheCoordonnee
				, forfait_ajoutLien
				, forfait_hasPlus
				, forfait_statistique
				, forfait_texteMEV
				, forfait_nbPhotoAdd
				, forfait_prix
				, forfait_prixPlus

			FROM forfait WHERE forfait_id=".$forfaitId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iForfait = count($toForfait = $pDbw->fetchAll($zQuery));
		if ($iForfait==0) {
        	throw new Exception("Forfait $forfaitId non trouvée");
		}

		$toForfait[0]->forfait_libelle 		= stripslashes($toForfait[0]->forfait_libelle);
		
		return $toForfait[0];
	}

	/**
    * Enregistrement d'un forfait
	*
	* @param object $forfait Objet forfait
    */
    static function sauvegardeForfait($forfait) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'forfait
		$forfait->statut = isset($forfait->statut)? $forfait->statut : 0;
		
		if (!isset($forfait->id) || $forfait->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO forfait VALUES (
				'0'
				," .$forfait->packId ."
				," .$oCnx->quote($forfait->libelle) ."
				," .$forfait->nbAnnonce ."
				," .$forfait->nbPhoto ."
				," .$forfait->nbCaractere ."
				," .$forfait->dureeParution ."
				," .$forfait->voirPhoto ."
				," .$forfait->voirCoordonnee ."
				," .$forfait->affichePhoto ."
				," .$forfait->afficheCoordonnee ."
				," .$forfait->ajoutLien ."
				," .$forfait->hasPlus ."
				," .$forfait->statistique ."
				," .$forfait->texteMEV ."
				," .$forfait->nbPhotoAdd ."
				," .$forfait->prix ."
				," .$forfait->prixPlus ."
				)";


				
			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE forfait SET \n
					forfait_id=".$oCnx->quote($forfait->id)."";
					
			if (isset($forfait->packId)) {
				$zQuery .= "\n, forfait_packId=".$forfait->packId."";
			}				
			if (isset($forfait->libelle)) {
				$zQuery .= "\n, forfait_libelle=".$oCnx->quote($forfait->libelle)."";
			}
			if (isset($forfait->nbAnnonce)) {
				$zQuery .= "\n, forfait_nbAnnonce=".$forfait->nbAnnonce."";
			}
			if (isset($forfait->nbPhoto)) {
				$zQuery .= "\n, forfait_nbPhoto=".$forfait->nbPhoto."";
			}
			if (isset($forfait->nbCaractere)) {
				$zQuery .= "\n, forfait_nbCaractere=".$forfait->nbCaractere."";
			}
			if (isset($forfait->dureeParution)) {
				$zQuery .= "\n, forfait_dureeParution=".$forfait->dureeParution."";
			}
			if (isset($forfait->voirPhoto)) {
				$zQuery .= "\n, forfait_voirPhoto=".$forfait->voirPhoto."";
			}
			if (isset($forfait->voirCoordonnee)) {
				$zQuery .= "\n, forfait_voirCoordonnee=".$forfait->voirCoordonnee."";
			}
			if (isset($forfait->affichePhoto)) {
				$zQuery .= "\n, forfait_affichePhoto=".$forfait->affichePhoto."";
			}
			if (isset($forfait->afficheCoordonnee)) {
				$zQuery .= "\n, forfait_afficheCoordonnee=".$forfait->afficheCoordonnee."";
			}
			if (isset($forfait->ajoutLien)) {
				$zQuery .= "\n, forfait_ajoutLien=".$forfait->ajoutLien."";
			}
			if (isset($forfait->hasPlus)) {
				$zQuery .= "\n, forfait_hasPlus=".$forfait->hasPlus."";
			}
			if (isset($forfait->statistique)) {
				$zQuery .= "\n, forfait_statistique=".$forfait->statistique."";
			}
			if (isset($forfait->texteMEV)) {
				$zQuery .= "\n, forfait_texteMEV=".$forfait->texteMEV."";
			}
			if (isset($forfait->nbPhotoAdd)) {
				$zQuery .= "\n, forfait_nbPhotoAdd=".$forfait->nbPhotoAdd."";
			}
			if (isset($forfait->prix)) {
				$zQuery .= "\n, forfait_prix=".$forfait->prix."";
			}
			if (isset($forfait->prixPlus)) {
				$zQuery .= "\n, forfait_prixPlus=".$forfait->prixPlus."";
			}

			$zQuery .= " \nWHERE forfait_id=".$forfait->id;
			$oCnx->exec($zQuery);
	        $id = $forfait->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un forfait
	*
	* @param integer Id du forfait à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeForfait($forfaitId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un forfait
		$zQuery = "DELETE FROM forfait WHERE forfait_id=$forfaitId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un forfait
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateForfaitStatut($idForfait, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE forfait SET forfait_statut ='".$statut."' WHERE forfait_id =".$idForfait;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO forfait
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoForfait() {

		$object = jDao::createRecord("forfait~forfait");
		//$object->forfait_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une forfait
	* param int $forfaitId id de la forfait
	* return $forfait objet forfait
	*/
	static function getForfait($forfaitId){
		$dao=jDao::create("forfait~forfait");
		if(!($forfait=$dao->get($forfaitId))){
			$dao=new jSelectorDao('forfait~forfait','');
			$c=$dao->getDaoRecordClass();
			$forfait=new $c ();
		}
		return $forfait;
	}	
	
	/**
	* selectionner les forfaits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function getAllForfait($idPackId)
	{
		$zQuery = "SELECT r.*
				FROM forfait AS r 
				WHERE r.forfait_packId = '".$idPackId."' 
				ORDER BY r.forfait_id";
      	$pDbw = jDb::getDbWidget();
      	$toForfait = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toForfait as $oForfait)
		{
			$oForfait->forfait_libelle = stripslashes($oForfait->forfait_libelle);
			array_push($tResult, $oForfait);
		}
		return $tResult;
	}

}

?>
