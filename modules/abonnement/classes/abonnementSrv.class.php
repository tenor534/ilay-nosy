<?php
/**
* @package ilay-nosy
* @subpackage abonnement
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des abonnements
*
* @package ilay-nosy
* @subpackage abonnement
*/
class abonnementSrv {

	/**
    * Chargement de la liste des abonnements (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets abonnements , nombre d'enregistrement
	
	 abonnement_id   	int(11)
	 abonnement_libelle  	varchar(150) 	
    */
    static function chargeListeAbonnement($sortField="abonnement_reference", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeAbonnement = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM abonnement AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,f.forfait_libelle ";
		$zSql .=	" ,u.utilisateur_nom ";
		
		$zSql .=	" ,COUNT(an.annonce_abonnementId) AS abonnement_nbAnnonce ";

		$zSql .=	" FROM abonnement AS a " ;

		$zSql .=	" LEFT JOIN utilisateur as u " ; 
		$zSql .=	" 	ON a.abonnement_utilisateurId = u.utilisateur_id";
		$zSql .=	" LEFT JOIN forfait as f " ; 
		$zSql .=	" 	ON a.abonnement_forfaitId = f.forfait_id";

		//annonce
		$zSql .=	" LEFT JOIN annonce AS an " ;
		$zSql .=	" 	ON an.annonce_abonnementId = a.abonnement_id ";

		$zSql .=	" GROUP BY a.abonnement_reference" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM abonnement");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeAbonnement = $oAbonnementDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->abonnement_reference 	= stripslashes($record->abonnement_reference);

			$record->forfait_libelle 		= stripslashes($record->forfait_libelle);
			$record->utilisateur_nom 		= stripslashes($record->utilisateur_nom);

			array_push($listeAbonnement, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeAbonnement'] = $listeAbonnement ;
		
		return $tResult ;
	}


    static function chargeAllAbonnement() {

		$listeAbonnement = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM abonnement AS r " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeAbonnement, $record) ;
 		}

		$tResult = $listeAbonnement ;
		
		return $tResult ;

	}	
	
    static function chargeAllAbonnementWithout($id) {

		$listeAbonnement = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM abonnement AS r " ;
		$zSql .=	" WHERE r.abonnement_id <> $id" ;
		$zSql .=	" ORDER BY r.abonnement_reference" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeAbonnement, $record) ;
 		}

		$tResult = $listeAbonnement ;
		return $tResult ;
	}

    static function chargeAllAbonnementFree($id) {

		$listeAbonnement = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM abonnement AS r " ;
		$zSql .=	" WHERE r.abonnement_utilisateurId = " . $id ;
		$zSql .=	" AND r.abonnement_credit = 0" ;
		$zSql .=	" AND r.abonnement_statut = " . USER_STATUT_STBY;
		$zSql .=	" ORDER BY r.abonnement_reference" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeAbonnement, $record) ;
 		}

		$tResult = $listeAbonnement ;
		return $tResult ;
	}


	/**
    * Chargement d'un abonnement donné
	*
	* @param integer $abonnementId Id de l'abonnement souhaitée
	* @return object $toAbonnement  objet abonnement
    */
    static function chargeAbonnement($abonnementId) {

		// 	Chargement des données
		if (!$abonnementId) {
			throw new Exception("Pas d'identifient du abonnement envoyé");
		}

		$zQuery = "SELECT abonnement_id

				, abonnement_utilisateurId
				, abonnement_forfaitId
				, abonnement_reference
				, abonnement_dateDebut
				, abonnement_dateFin
				, abonnement_dateCreation
				, abonnement_credit
				, abonnement_creditPlus
				, abonnement_nbPlus
				, abonnement_statut

			FROM abonnement WHERE abonnement_id=".$abonnementId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iAbonnement = count($toAbonnement = $pDbw->fetchAll($zQuery));
		if ($iAbonnement==0) {
        	throw new Exception("Abonnement $abonnementId non trouvée");
		}

		$toAbonnement[0]->abonnement_reference 			= stripslashes($toAbonnement[0]->abonnement_reference);
		
		return $toAbonnement[0];
	}

	/**
    * Enregistrement d'un abonnement
	*
	* @param object $abonnement Objet abonnement
    */
    static function sauvegardeAbonnement($abonnement) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'abonnement
		$abonnement->statut = isset($abonnement->statut)? $abonnement->statut : 0;
		
		if (!isset($abonnement->id) || $abonnement->id==0) { // insertion
			

			//Requette d'ajout
			$zQuery = "INSERT INTO abonnement VALUES (
				'0'
				," .$abonnement->utilisateurId ."
				," .$abonnement->forfaitId ."
				," .$oCnx->quote($abonnement->reference). "
				," .$oCnx->quote($abonnement->dateDebut). "
				," .$oCnx->quote($abonnement->dateFin). "
				," .$oCnx->quote($abonnement->dateCreation). "
				," .$abonnement->credit ."
				," .$abonnement->creditPlus ."
				," .$abonnement->nbPlus ."
				," .$abonnement->statut ."
				)";
				
			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE abonnement SET \n
					abonnement_id=".$oCnx->quote($abonnement->id)."";
					
			if (isset($abonnement->utilisateurId)) {
				$zQuery .= "\n, abonnement_utilisateurId=".$abonnement->utilisateurId."";
			}
			if (isset($abonnement->forfaitId)) {
				$zQuery .= "\n, abonnement_forfaitId=".$abonnement->forfaitId."";
			}
			if (isset($abonnement->reference)) {
				$zQuery .= "\n, abonnement_reference=".$oCnx->quote($abonnement->reference)."";
			}
			if (isset($abonnement->dateDebut)) {
				$zQuery .= "\n, abonnement_dateDebut=".$oCnx->quote($abonnement->dateDebut)."";
			}
			if (isset($abonnement->dateFin)) {
				$zQuery .= "\n, abonnement_dateFin=".$oCnx->quote($abonnement->dateFin)."";
			}
			if (isset($abonnement->dateCreation)) {
				$zQuery .= "\n, abonnement_dateCreation=".$oCnx->quote($abonnement->dateCreation)."";
			}
			if (isset($abonnement->credit)) {
				$zQuery .= "\n, abonnement_credit=".$abonnement->credit."";
			}
			if (isset($abonnement->creditPlus)) {
				$zQuery .= "\n, abonnement_creditPlus=".$abonnement->creditPlus."";
			}
			if (isset($abonnement->nbPlus)) {
				$zQuery .= "\n, abonnement_nbPlus=".$abonnement->nbPlus."";
			}
			if (isset($abonnement->statut)) {
				$zQuery .= "\n, abonnement_statut=".$abonnement->statut."";
			}

			$zQuery .= " \nWHERE abonnement_id=".$abonnement->id;
			$oCnx->exec($zQuery);
	        $id = $abonnement->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un abonnement
	*
	* @param integer Id du abonnement à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeAbonnement($abonnementId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un abonnement
		$zQuery = "DELETE FROM abonnement WHERE abonnement_id=$abonnementId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un abonnement
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateAbonnementStatut($idAbonnement, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE abonnement SET abonnement_statut ='".$statut."' WHERE abonnement_id =".$idAbonnement;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO abonnement
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoAbonnement() {

		$object = jDao::createRecord("abonnement~abonnement");
		//$object->abonnement_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une abonnement
	* param int $abonnementId id de la abonnement
	* return $abonnement objet abonnement
	*/
	static function getAbonnement($abonnementId){
		$dao=jDao::create("abonnement~abonnement");
		if(!($abonnement=$dao->get($abonnementId))){
			$dao=new jSelectorDao('abonnement~abonnement','');
			$c=$dao->getDaoRecordClass();
			$abonnement=new $c ();
		}
		return $abonnement;
	}	
	
	
	
	/**
	* selectionner les abonnements existant pour une catégorie donnée
	* @param idForfaitId
	* @return tableau de boissons
	*/
	static function getAllAbonnement($idForfaitId)
	{
		$zQuery = "SELECT r.*
				FROM abonnement AS r 
				WHERE r.abonnement_forfaitId = '".$idForfaitId."' 
				ORDER BY r.abonnement_reference";
      	$pDbw = jDb::getDbWidget();
      	$toAbonnement = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toAbonnement as $oAbonnement)
		{
			$oAbonnement->abonnement_libelle = stripslashes($oAbonnement->abonnement_libelle);
			array_push($tResult, $oAbonnement);
		}
		return $tResult;
	}
	/**
	* Renvoie la liste des abonnements
	* @return array of object toAbonnements
	*
	*/
    static function chargeListAbonnementAllFo() {

		$toAbonnements = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  abonnement AS p
					ORDER BY p.abonnement_reference ASC";

		$toAbonnements = $pDbw->fetchAll($zQuery);		

		return $toAbonnements;
	}	

	/**
	* Renvoie la liste des abonnements
	* @return array of object toAbonnements
	* 
	*/
    static function chargeListAbonnementAllByUserFo($idUtilisateurId) {

		$toAbonnements = array();

		$pDbw = jDb::getDbWidget();

		$zSql  = 	" SELECT a.*, f.*, p.* ";
		
		$zSql .=	" ,COUNT(an.annonce_abonnementId) AS abonnement_nbAnnonce ";

		$zSql .=	" FROM abonnement AS a " ;
				
		$zSql .=	" LEFT JOIN forfait as f " ; 
		$zSql .=	" 	ON a.abonnement_forfaitId = f.forfait_id";		
		$zSql .=	" LEFT JOIN pack as p " ; 
		$zSql .=	" 	ON f.forfait_packId = p.pack_id";

		//annonce
		$zSql .=	" LEFT JOIN annonce AS an " ;
		$zSql .=	" 	ON an.annonce_abonnementId = a.abonnement_id ";
		
		$zSql .=	" GROUP BY a.abonnement_reference" ;
		
		$zSql .=	" HAVING a.abonnement_utilisateurId=".$idUtilisateurId;
		$zSql .=	" ORDER BY a.abonnement_reference ASC";

		$toAbonnements = $pDbw->fetchAll($zSql);		

		return $toAbonnements;
	}	

	/**
	* Renvoie la liste des abonnements
	* @return array of object toAbonnements
	* 
	*/
    static function chargeListAbonnementAllByUserFo2($idUtilisateurId, $statutAll=0) {

		$toAbonnements = array();

		$pDbw = jDb::getDbWidget();

		$zSql  = 	" SELECT a.*, f.*, p.* ";
		
		$zSql .=	" ,COUNT(an.annonce_abonnementId) AS abonnement_nbAnnonce ";

		$zSql .=	" FROM abonnement AS a " ;
				
		$zSql .=	" LEFT JOIN forfait as f " ;
		$zSql .=	" 	ON a.abonnement_forfaitId = f.forfait_id";
		$zSql .=	" LEFT JOIN pack as p " ;
		$zSql .=	" 	ON f.forfait_packId = p.pack_id";

		//annonce
		$zSql .=	" LEFT JOIN annonce AS an " ;
		$zSql .=	" 	ON an.annonce_abonnementId = a.abonnement_id ";
		
		$zSql .=	" GROUP BY a.abonnement_reference" ;
		
		$zSql .=	" HAVING a.abonnement_utilisateurId=".$idUtilisateurId;
		$zSql .=	" AND p.pack_id NOT IN (".PACK_VISITEURS.")";
		if($statutAll == 0){
			$zSql .=	" AND a.abonnement_statut =".ABONNEMENT_STATUT_ON;
		}
		$zSql .=	" ORDER BY a.abonnement_reference ASC";

		$toAbonnements = $pDbw->fetchAll($zSql);

		return $toAbonnements;
	}

	/**
	* Renvoie la liste des abonnements valides pour un utlisateur connecté en ligne
	* @return array of object toAbonnements
	* 
	*/
    static function chargeAllAbonnementValid($idUtilisateurId) {

		$toAbonnements = array();

		$pDbw = jDb::getDbWidget();

		$zSql  = 	" SELECT a.*, f.*, p.* ";
		
		$zSql .=	" ,COUNT(an.annonce_abonnementId) AS abonnement_nbAnnonce ";

		$zSql .=	" FROM abonnement AS a " ;
				
		$zSql .=	" LEFT JOIN forfait as f " ;
		$zSql .=	" 	ON a.abonnement_forfaitId = f.forfait_id";
		$zSql .=	" LEFT JOIN pack as p " ;
		$zSql .=	" 	ON f.forfait_packId = p.pack_id";

		//annonce
		$zSql .=	" LEFT JOIN annonce AS an " ;
		$zSql .=	" 	ON an.annonce_abonnementId = a.abonnement_id ";
		
		$zSql .=	" GROUP BY a.abonnement_reference" ;
		
		$zSql .=	" HAVING a.abonnement_utilisateurId=".$idUtilisateurId;
		//$zSql .=	" AND p.pack_id NOT IN (".PACK_VISITEURS.")";
		$zSql .=	" AND a.abonnement_statut =".ABONNEMENT_STATUT_ON;
		$zSql .=	" ORDER BY a.abonnement_reference ASC";

		$toAbonnements = $pDbw->fetchAll($zSql);

		return $toAbonnements;
	}

}

?>
