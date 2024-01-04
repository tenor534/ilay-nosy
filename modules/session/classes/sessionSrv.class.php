<?php
/**
* @package dwordconsulting
* @subpackage session
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des sessions
*
* @package dwordconsulting
* @subpackage session
*/
class sessionSrv {

	/**
    * Chargement de la liste des sessions (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets sessions , nombre d'enregistrement

    */
    static function chargeListeSession($sortField="session_id", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeSession = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM session AS s";
		
		$zSql  = 	" SELECT s.session_id"; 
		$zSql .=	" ,s.session_langueId ";
		$zSql .=	" ,s.session_utilisateurId ";
		$zSql .=	" ,s.session_sectionId ";


		$zSql .=	" FROM session AS s " ;





		$zSql .=	" GROUP BY s.session_id" ;
		
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM session");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$listeSession = $oSessionDbw->fetchAll($zSql);
			
		while($record = $rs->fetch()){
		


			array_push($listeSession, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeSession'] = $listeSession ;
		
		return $tResult ;

	}
	

    static function chargeAllSession() {

		$listeSession = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT s.* ";
		$zSql .=	" FROM session AS s " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeSession, $record) ;
 		}

		$tResult = $listeSession ;
		
		return $tResult ;

	}

	/**
    * Chargement d'une entité session donnée
	*
	* @param integer $sessionId Id de l'entité session souhaitée
	* @return object $toSession  objet session
    */
    static function chargeSession($sessionId) {

		// 	Chargement des données
		if (!$sessionId) {
			throw new Exception("Pas d'identifiant de l'entité Session envoyé");
		}
		$zQuery = "SELECT s.session_id
				, s.session_langueId		
				, s.session_utilisateurId				
				, s.session_sectionId				
			FROM session AS s WHERE s.session_id=".$sessionId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iSession = count($toSession = $pDbw->fetchAll($zQuery));
		if ($iSession==0) {
        	throw new Exception("Session $sessionId non trouvée");
		}

		
		
		return $toSession[0];
	}


	/**
    * Enregistrement d'une entité  session
	*
	* @param object $session Objet session
    */
    static function sauvegardeSession($session) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'entité session
		$session->statut = isset($session->statut)? $session->statut : 0;
		
		if (!isset($session->id) || $session->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO session VALUES (
				'0'
				," .$session->langueId . "
				," .$session->utilisateurId . "		
				," .$session->sectionId . "		
				)";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE session SET \n
					session_id=".$oCnx->quote($session->id)."";

			if (isset($session->langueId)) {
				$zQuery .= "\n, session_langueId=".$session->langueId."";
			}
			if (isset($session->utilisateurId)) {
				$zQuery .= "\n, session_utilisateurId=".$session->utilisateurId."";
			}		
			if (isset($session->sectionId)) {
				$zQuery .= "\n, session_sectionId=".$session->sectionId."";
			}		

			$zQuery .= " \nWHERE session_id=".$session->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'une entité session
	*
	* @param integer Id de l'entité session à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeSession($sessionId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'une entité session
		$zQuery = "DELETE FROM session WHERE session_id=$sessionId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'une entité session
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateSessionStatut($idSession, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE session SET session_statut ='".$statut."' WHERE session_id =".$idSession;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO Session
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoSession() {

		$object = jDao::createRecord("session~session");
		//ex : $object->session_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}

	/**
    * MAJ ou Enregistrement d'une nouvelle session utilisateur	
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function updateSessionUser($idLangue, $idUtilisateur, $idSection=0) {

		//Cherche la session de l'utilisateur en cours
		$zQuery = "	SELECT *				
					FROM session AS s 
					WHERE s.session_utilisateurId=".$idUtilisateur;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iSession = count($toSession = $pDbw->fetchAll($zQuery));

		$oCnx = jDb::getConnection();
		if ($iSession == 0) {
			//Requette d'ajout
			$zQuery = "INSERT INTO session VALUES (
				'0'
				," .$idLangue . "
				," .$idUtilisateur . "		
				," .$idSection . "		
				)";				
			$oCnx->exec($zQuery);			
		}else{
			//Update
			$zQuery ="UPDATE session SET session_langueId ='".$idLangue."', session_sectionId ='".$idSection."' WHERE session_utilisateurId =".$idUtilisateur;
			try {
				//$oCnx->startTransaction(); 
				$oCnx->exec($zQuery);
				//$oCnx->commit();
			}catch (Exception $e) {
				//$oCnx->rollback();
			}				
		}
	}

	/**
    * Cherche la langue selon l'idUtilisateur en cours	
	*
    */
    static function getLangueFromUser($idUtilisateur) {

		//Cherche la session de l'utilisateur en cours
		$zQuery = "	SELECT *				
					FROM session AS s 
					WHERE s.session_utilisateurId=".$idUtilisateur;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iSession = count($toSession = $pDbw->fetchAll($zQuery));
		
		$idLangue = 0;
		if ($iSession != 0) {
			$idLangue = $toSession[0]->session_langueId;			
		}
		
		return $idLangue;
	}

	/**
    * Cherche la section selon l'idUtilisateur en cours	
	*
    */
    static function getSectionFromUser($idUtilisateur) {

		//Cherche la session de l'utilisateur en cours
		$zQuery = "	SELECT *				
					FROM session AS s 
					WHERE s.session_utilisateurId=".$idUtilisateur;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iSession = count($toSession = $pDbw->fetchAll($zQuery));
		
		$idSection = 0;
		if ($iSession != 0) {
			$idSection = $toSession[0]->session_sectionId;			
		}
		
		return $idSection;
	}


}

?>
