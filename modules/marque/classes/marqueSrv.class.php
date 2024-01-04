<?php
/**
* @marqueage ilay-nosy
* @submarqueage marque
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des marques
*
* @marqueage ilay-nosy
* @submarqueage marque
*/
class marqueSrv {

	/**
    * Chargement de la liste des marques (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets marques , nombre d'enregistrement
	
	 marque_id   		int(11)
	 marque_libelle  	varchar(100) 	
	 marque_code  	varchar(5) 	
	 marque_photo  	varchar(100) 	
	 marque_fichier  	varchar(100) 	
    */
    static function chargeListeMarque($sortField="marque_libelle", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeMarque = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM marque AS s";

		$zSql  = 	" SELECT p.* "; 
		
		$zSql .=	" ,COUNT(f.modele_id) AS marque_nbModele ";
		
		$zSql .=	" FROM marque AS p " ;
		
		$zSql .=	" LEFT JOIN modele AS f " ;
		$zSql .=	" 	ON f.modele_marqueId = p.marque_id ";
		$zSql .=	" GROUP BY p.marque_libelle" ;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM marque");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listeMarque = $oMarqueDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
			$record->marque_libelle = stripslashes($record->marque_libelle );

			array_push($listeMarque, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeMarque'] = $listeMarque ;
		
		return $tResult ;
	}
	

    static function chargeAllMarque() {

		$listeMarque = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT p.* ";
		$zSql .=	" FROM marque AS p " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeMarque, $record) ;
 		}

		$tResult = $listeMarque ;
		
		return $tResult ;
	}

	/**
    * Chargement d'un marque donné
	*
	* @param integer $marqueId Id de l'marque souhaitée
	* @return object $toMarque  objet marque
    */
    static function chargeMarque($marqueId) {

		// 	Chargement des données
		if (!$marqueId) {
			throw new Exception("Pas d'identifient du marque envoyé");
		}

		$zQuery = "SELECT marque_id
			, marque_libelle
			, marque_code
			FROM marque
			WHERE marque_id=$marqueId";
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iMarque = count($toMarque = $pDbw->fetchAll($zQuery));
		if ($iMarque==0) {
        	throw new Exception("Marque $marqueId non trouvée");
		}
		
		return $toMarque[0];
	}


	/**
    * Enregistrement d'un marque
	*
	* @param object $marque Objet marque
    */
    static function sauvegardeMarque($marque) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		if (!isset($marque->id) || $marque->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO marque VALUES (
			      '0'
				, ".$oCnx->quote($marque->libelle)."
				, ".$oCnx->quote($marque->code)."
				)";
				
			$oCnx->exec($zQuery);		
				
	        $id = $oCnx->lastInsertId();
		} else { //update

			$zQuery = "UPDATE marque SET \n
					marque_id=".$oCnx->quote($marque->id)."";

			if (isset($marque->libelle)) {
				$zQuery .= "\n, marque_libelle=".$oCnx->quote($marque->libelle)."";
			}
			if (isset($marque->code)) {
				$zQuery .= "\n, marque_code=".$oCnx->quote($marque->code)."";
			}

			$zQuery .= " \nWHERE marque_id=".$marque->id;
			$oCnx->exec($zQuery);

			$id = $marque->id;			
		}
		
		return $id;
	}

	/**
    * Suppression d'un marque
	*
	* @param integer Id du marque à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeMarque($marqueId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un marque
		$zQuery = "DELETE FROM marque WHERE marque_id=$marqueId";
		$rConn->exec($zQuery);

		return TRUE;
	}
	
	/**
    * Factory d'objet DAO marque
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoMarque() {

		$object = jDao::createRecord("marque~marque");
		//$object->marque_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
}

?>
