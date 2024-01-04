<?php
/**
* @package ilay-nosy
* @subpackage visite
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des visite des pages
*
* @package ilay-nosy
* @subpackage visite
*/
class visiteSrv {

	/**
    * Chargement de la liste des visites (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets visites , nombre d'enregistrement
	
    <property name="visite_id" fieldname="visite_id" datatype="autoincrement"/>
    <property name="visite_serverSoftware" fieldname="visite_serverSoftware" datatype="string" required="true"/>
    <property name="visite_serverName" fieldname="visite_serverName" datatype="string" required="true"/>
    <property name="visite_serverAddr" fieldname="visite_serverAddr" datatype="string" required="true"/>
    <property name="visite_serverPort" fieldname="visite_serverPort" datatype="string" required="true"/>
    <property name="visite_remoteAddr" fieldname="visite_remoteAddr" datatype="string" required="true"/>
    <property name="visite_remotePort" fieldname="visite_remotePort" datatype="string" required="true"/>
    <property name="visite_httpRefferer" fieldname="visite_httpRefferer" datatype="string" required="true"/>
    <property name="visite_httpUserAgent" fieldname="visite_httpUserAgent" datatype="string" required="true"/>
    <property name="visite_requestMethod" fieldname="visite_requestMethod" datatype="string" required="true"/>
    <property name="visite_requestUri" fieldname="visite_requestUri" datatype="string" required="true"/>
    <property name="visite_phpSelf" fieldname="visite_phpSelf" datatype="string" required="true"/>
    <property name="visite_queryString" fieldname="visite_queryString" datatype="string" required="true"/>
    <property name="visite_date" fieldname="visite_date" datatype="date" required="true"/>
    */
    static function chargeListeVisite($sortField="visite_remoteAddr", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeVisite = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* "; 
		
		$zSql .=	" FROM visite AS c " ;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM visite");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listeVisite = $oVisiteDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->visite_libelle = stripslashes($record->visite_libelle );
			array_push($listeVisite, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeVisite'] = $listeVisite ;
		
		return $tResult ;

	}

	//With nb annonces
    static function chargeAllVisiteNB() {

		$listeVisite = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";

		$zSql .=	" ,COUNT(an.annonce_id) AS visite_nbAnnonce ";

		$zSql .=	" FROM visite AS c " ;

		$zSql .=	" LEFT JOIN rubrique AS r " ;
		$zSql .=	" 	ON r.rubrique_visiteId = c.visite_id ";
		$zSql .=	" LEFT JOIN annonce AS an " ;
		$zSql .=	" 	ON an.annonce_rubriqueId = r.rubrique_id ";

		$zSql .=	" GROUP BY c.visite_id" ;
		$zSql .=	" ORDER BY c.visite_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeVisite, $record) ;
 		}

		$tResult = $listeVisite ;
		
		return $tResult ;

	}

    static function chargeAllVisite() {

		$listeVisite = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM visite AS c " ;
		$zSql .=	" ORDER BY c.visite_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeVisite, $record) ;
 		}

		$tResult = $listeVisite ;
		
		return $tResult ;

	}


    static function chargeAllVisiteIn($inCategorie) {

		$listeVisite = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT c.* ";
		$zSql .=	" FROM visite AS c " ;
		$zSql .=	" WHERE c.visite_id IN (".$inCategorie.")" ;
		$zSql .=	" ORDER BY c.visite_libelle" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeVisite, $record) ;
 		}

		$tResult = $listeVisite ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un visite donné
	*
	* @param integer $visiteId Id de l'visite souhaitée
	* @return object $toVisite  objet visite
    */
    static function chargeVisite($visiteId) {

		// 	Chargement des données
		if (!$visiteId) {
			throw new Exception("Pas d'identifient du visite envoyé");
		}

		$zQuery = "SELECT visite_id
			, visite_libelle
			, visite_code
			FROM visite
			WHERE visite_id=$visiteId";
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iVisite = count($toVisite = $pDbw->fetchAll($zQuery));
		if ($iVisite==0) {
        	throw new Exception("Visite $visiteId non trouvée");
		}
		
		return $toVisite[0];
	}


	/**
    * Enregistrement d'un visite
	*
	* @param object $visite Objet visite
    */
    static function sauvegardeVisite($visite) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		if (!isset($visite->id) || $visite->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO visite VALUES (
			      '0'
				, ".$oCnx->quote($visite->serverSoftware)."
				, ".$oCnx->quote($visite->serverName)."
				, ".$oCnx->quote($visite->serverAddr)."
				, ".$oCnx->quote($visite->serverPort)."
				, ".$oCnx->quote($visite->remoteAddr)."
				, ".$oCnx->quote($visite->remotePort)."
				, ".$oCnx->quote($visite->httpRefferer)."
				, ".$oCnx->quote($visite->httpUserAgent)."
				, ".$oCnx->quote($visite->requestMethod)."
				, ".$oCnx->quote($visite->requestUri)."
				, ".$oCnx->quote($visite->phpSelf)."
				, ".$oCnx->quote($visite->queryString)."
				, ".$oCnx->quote($visite->date)."
				, ".$oCnx->quote($visite->userId).")";
			$oCnx->exec($zQuery);			
			
		}
		
		return $oCnx->lastInsertId();
	}

	/**
    * Suppression d'un visite
	*
	* @param integer Id du visite à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeVisite($visiteId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un visite
		$zQuery = "DELETE FROM visite WHERE visite_id=$visiteId";
		$rConn->exec($zQuery);

		return TRUE;
	}
	
	/**
    * Factory d'objet DAO visite
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoVisite() {

		$object = jDao::createRecord("visite~visite");
		//$object->visite_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* Renvoie la liste des Visite
	* @return array of object Visite
	*
	*/
    /*static function chargeListVisiteMembreAllFo() {

		$toVisites = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  visite AS p
					WHERE visite_id NOT IN (".SITE_PROFIL_SADMIN.",".SITE_PROFIL_ADMIN.")
					ORDER BY p.visite_libelle ASC";

		$toVisites = $pDbw->fetchAll($zQuery);		

		return $toVisites;
	}*/	
}

?>
