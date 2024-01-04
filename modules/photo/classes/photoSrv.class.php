<?php
/**
* @package ilay-nosy
* @subpackage photo
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des photos
*
* @package ilay-nosy
* @subpackage photo
*/
class photoSrv {

	/**
    * Chargement de la liste des photos (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets photos , nombre d'enregistrement
	
	 photo_id   	int(11)
	 photo_libelle  	varchar(150) 	
    */
    static function chargeListePhoto($sortField="photo_photo", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listePhoto = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM photo AS s";
		
		$zSql  = 	" SELECT p.* ";
		$zSql .=	" ,a.annonce_reference ";
		
		$zSql .=	" FROM photo AS p " ;

		$zSql .=	" LEFT JOIN annonce as a " ; 
		$zSql .=	" 	ON p.photo_annonceId = a.annonce_id";

		$zSql .=	" GROUP BY p.photo_id" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM photo");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listePhoto = $oPhotoDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->photo_photo 		= stripslashes($record->photo_photo);

			$record->annonce_reference 	= stripslashes($record->annonce_reference);

			array_push($listePhoto, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listePhoto'] = $listePhoto ;
		
		return $tResult ;
	}


    static function chargeAllPhoto() {

		$listePhoto = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT s.* ";
		$zSql .=	" FROM photo AS s " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listePhoto, $record) ;
 		}

		$tResult = $listePhoto ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un photo donné
	*
	* @param integer $photoId Id de l'photo souhaitée
	* @return object $toPhoto  objet photo
    */
    static function chargePhoto($photoId) {

		// 	Chargement des données
		if (!$photoId) {
			throw new Exception("Pas d'identifient du photo envoyé");
		}

		$zQuery = "SELECT photo_id

			, photo_annonceId
			, photo_photo
			
			FROM photo WHERE photo_id=".$photoId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iPhoto = count($toPhoto = $pDbw->fetchAll($zQuery));
		if ($iPhoto==0) {
        	throw new Exception("Photo $photoId non trouvée");
		}

		$toPhoto[0]->photo_photo 			= stripslashes($toPhoto[0]->photo_photo);
		
		return $toPhoto[0];
	}

	/**
    * Enregistrement d'un photo
	*
	* @param object $photo Objet photo
    */
    static function sauvegardePhoto($photo) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'photo
		$photo->statut = isset($photo->statut)? $photo->statut : 0;
		
		if (!isset($photo->id) || $photo->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO photo VALUES (
				'0'
				," .$photo->annonceId ."
				," .$oCnx->quote($photo->photo). "
				)";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE photo SET \n
					photo_id=".$oCnx->quote($photo->id)."";
					
			if (isset($photo->annonceId)) {
				$zQuery .= "\n, photo_annonceId=".$photo->annonceId."";
			}
			if (isset($photo->photo)) {
				$zQuery .= "\n, photo_photo=".$oCnx->quote($photo->photo)."";
			}

			$zQuery .= " \nWHERE photo_id=".$photo->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un photo
	*
	* @param integer Id du photo à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimePhoto($photoId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un photo
		$zQuery = "DELETE FROM photo WHERE photo_id=$photoId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un photo
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updatePhotoStatut($idPhoto, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE photo SET photo_statut ='".$statut."' WHERE photo_id =".$idPhoto;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO photo
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoPhoto() {

		$object = jDao::createRecord("photo~photo");
		//$object->photo_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une photo
	* param int $membreId id du membre
	* return $membre objet membre
	*/
	static function infosPhoto($photoId){
		$dao=jDao::create("photo~photo");
		if(!($photo=$dao->get($photoId))){
			$dao=new jSelectorDao('photo~photo','');
			$c=$dao->getDaoRecordClass();
			$photo=new $c ();
		}
		return $photo;
	}	
	
	/**
	* selectionner les forfaits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function getAllPhoto($idAnnonceId)
	{
		$zQuery = "SELECT r.*
				FROM photo AS r 
				WHERE r.photo_annonceId = '".$idAnnonceId."' 
				ORDER BY r.photo_id";
      	$pDbw = jDb::getDbWidget();
      	$toPhoto = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toPhoto as $oPhoto)
		{
			$oPhoto->photo_photo = stripslashes($oPhoto->photo_photo);
			array_push($tResult, $oPhoto);
		}
		return $tResult;
	}	

	/**
	* selectionner les forfaits existant pour un pack donné
	* @param idCategorieAnId
	* @return tableau de boissons
	*/
	static function getAllPhotoActive($idAnnonceId)
	{
		$zQuery = "SELECT r.*
				FROM photo AS r 
				WHERE r.photo_annonceId = '".$idAnnonceId."' 
				AND r.photo_photo <> 'noPhoto.jpg' 
				ORDER BY r.photo_id";
      	$pDbw = jDb::getDbWidget();
      	$toPhoto = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toPhoto as $oPhoto)
		{
			$oPhoto->photo_photo = stripslashes($oPhoto->photo_photo);
			array_push($tResult, $oPhoto);
		}
		return $tResult;
	}	

}

?>
