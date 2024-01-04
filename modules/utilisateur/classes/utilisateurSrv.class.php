<?php
/**
* @package ilay-nosy
* @subpackage utilisateur
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des utilisateurs
*
* @package ilay-nosy
* @subpackage utilisateur
*/
class utilisateurSrv {

	/**
    * Chargement de la liste des utilisateurs (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets utilisateurs , nombre d'enregistrement
	
	 utilisateur_id   	int(11)
	 utilisateur_libelle  	varchar(150) 	
    */
    static function chargeListeUtilisateur($sortField="utilisateur_nom", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeUtilisateur = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM utilisateur AS s";
		
		$zSql  = 	" SELECT u.* ";
		$zSql .=	" ,p.profil_code ";
		$zSql .=	" ,pa.pays_code ";
		
		$zSql .=	" ,COUNT(cc.commentCult_utilisateurId) AS utilisateur_nbCC ";
		$zSql .=	" ,COUNT(ca.commentAct_utilisateurId) AS utilisateur_nbCA ";
		$zSql .=	" ,COUNT(ab.abonnement_utilisateurId) AS utilisateur_nbAB ";

		$zSql .=	" FROM utilisateur AS u " ;

		$zSql .=	" LEFT JOIN profil as p " ; 
		$zSql .=	" 	ON u.utilisateur_profilId = p.profil_id";
		$zSql .=	" LEFT JOIN pays as pa " ; 
		$zSql .=	" 	ON u.utilisateur_paysId = pa.pays_id";


		//commentCult
		$zSql .=	" LEFT JOIN commentCult AS cc " ;
		$zSql .=	" 	ON cc.commentCult_utilisateurId = u.utilisateur_id ";
		//commentAct
		$zSql .=	" LEFT JOIN commentAct AS ca " ;
		$zSql .=	" 	ON ca.commentAct_utilisateurId = u.utilisateur_id ";
		//abonnement
		$zSql .=	" LEFT JOIN abonnement AS ab " ;
		$zSql .=	" 	ON ab.abonnement_utilisateurId = u.utilisateur_id ";

		$zSql .=	" GROUP BY u.utilisateur_id" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM utilisateur");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeUtilisateur = $oUtilisateurDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->utilisateur_nom 			= stripslashes($record->utilisateur_nom);
			$record->utilisateur_prenom 		= stripslashes($record->utilisateur_prenom);
			$record->utilisateur_fonction 		= stripslashes($record->utilisateur_fonction);
			$record->utilisateur_dateNaissance 	= stripslashes($record->utilisateur_dateNaissance);
			
			$record->utilisateur_adresse 		= stripslashes($record->utilisateur_adresse);
			$record->utilisateur_cp 			= stripslashes($record->utilisateur_cp);
			$record->utilisateur_ville 			= stripslashes($record->utilisateur_ville);
			
			$record->utilisateur_societe 		= stripslashes($record->utilisateur_societe);
			$record->utilisateur_telephone 		= stripslashes($record->utilisateur_telephone);
			$record->utilisateur_email 			= stripslashes($record->utilisateur_email);
			$record->utilisateur_login 			= stripslashes($record->utilisateur_login);
			$record->utilisateur_password 		= stripslashes($record->utilisateur_password);
			$record->utilisateur_dateCreation 	= stripslashes($record->utilisateur_dateCreation);
			$record->utilisateur_dateModification 	= stripslashes($record->utilisateur_dateModification);

			$record->utilisateur_reponse 		= stripslashes($record->utilisateur_reponse);
			$record->utilisateur_photo 			= stripslashes($record->utilisateur_photo);
			$record->utilisateur_url 			= stripslashes($record->utilisateur_url);

			$record->profil_code 				= stripslashes($record->profil_code);
			$record->pays_code 					= stripslashes($record->pays_code);

			array_push($listeUtilisateur, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeUtilisateur'] = $listeUtilisateur ;
		
		return $tResult ;
	}


    static function chargeAllUtilisateur() {

		$listeUtilisateur = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT s.* ";
		$zSql .=	" FROM utilisateur AS s " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeUtilisateur, $record) ;
 		}

		$tResult = $listeUtilisateur ;
		
		return $tResult ;

	}

	/**
    * Chargement d'un utilisateur donné
	*
	* @param integer $utilisateurId Id de l'utilisateur souhaitée
	* @return object $toUtilisateur  objet utilisateur
    */
    static function chargeUtilisateur($utilisateurId) {

		// 	Chargement des données
		if (!$utilisateurId) {
			throw new Exception("Pas d'identifient du utilisateur envoyé");
		}

		$zQuery = "SELECT utilisateur_id

			, utilisateur_paysId
			, utilisateur_profilId
			, utilisateur_nom
			, utilisateur_prenom
			, utilisateur_civilite
			, utilisateur_dateNaissance
			, utilisateur_adresse
			, utilisateur_cp
			, utilisateur_ville
			, utilisateur_fonction
			, utilisateur_societe
			, utilisateur_telephone
			, utilisateur_email
			, utilisateur_login
			, utilisateur_password
			, utilisateur_dateCreation
			, utilisateur_dateModification
			, utilisateur_statut
			, utilisateur_question
			, utilisateur_reponse
			, utilisateur_photo
			, utilisateur_url			
			
			FROM utilisateur WHERE utilisateur_id=".$utilisateurId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iUtilisateur = count($toUtilisateur = $pDbw->fetchAll($zQuery));
		if ($iUtilisateur==0) {
        	throw new Exception("Utilisateur $utilisateurId non trouvée");
		}

		$toUtilisateur[0]->utilisateur_nom 				= stripslashes($toUtilisateur[0]->utilisateur_nom);
		$toUtilisateur[0]->utilisateur_prenom 			= stripslashes($toUtilisateur[0]->utilisateur_prenom);
		$toUtilisateur[0]->utilisateur_fonction 		= stripslashes($toUtilisateur[0]->utilisateur_fonction);
		$toUtilisateur[0]->utilisateur_dateNaissance	= stripslashes($toUtilisateur[0]->utilisateur_dateNaissance);
		
		$toUtilisateur[0]->utilisateur_adresse 			= stripslashes($toUtilisateur[0]->utilisateur_adresse);
		$toUtilisateur[0]->utilisateur_cp 				= stripslashes($toUtilisateur[0]->utilisateur_cp);
		$toUtilisateur[0]->utilisateur_ville 			= stripslashes($toUtilisateur[0]->utilisateur_ville);
		
		$toUtilisateur[0]->utilisateur_societe 			= stripslashes($toUtilisateur[0]->utilisateur_societe);
		$toUtilisateur[0]->utilisateur_telephone 		= stripslashes($toUtilisateur[0]->utilisateur_telephone);
		$toUtilisateur[0]->utilisateur_email 			= stripslashes($toUtilisateur[0]->utilisateur_email);
		$toUtilisateur[0]->utilisateur_login 			= stripslashes($toUtilisateur[0]->utilisateur_login);
		$toUtilisateur[0]->utilisateur_password 		= stripslashes($toUtilisateur[0]->utilisateur_password);
		$toUtilisateur[0]->utilisateur_dateCreation 	= stripslashes($toUtilisateur[0]->utilisateur_dateCreation);
		$toUtilisateur[0]->utilisateur_dateModification = stripslashes($toUtilisateur[0]->utilisateur_dateModification);
		
		$toUtilisateur[0]->utilisateur_reponse 			= stripslashes($toUtilisateur[0]->utilisateur_reponse);
		$toUtilisateur[0]->utilisateur_photo 			= stripslashes($toUtilisateur[0]->utilisateur_photo);
		$toUtilisateur[0]->utilisateur_url 				= stripslashes($toUtilisateur[0]->utilisateur_url);
		
		return $toUtilisateur[0];
	}

	/**
    * Enregistrement d'un utilisateur
	*
	* @param object $utilisateur Objet utilisateur
    */
    static function sauvegardeUtilisateur($utilisateur) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'utilisateur
		$utilisateur->statut = isset($utilisateur->statut)? $utilisateur->statut : 0;
		
		if (!isset($utilisateur->id) || $utilisateur->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO utilisateur VALUES (
				'0'
				," .$utilisateur->paysId ."
				," .$utilisateur->profilId ."
				," .$oCnx->quote($utilisateur->nom). "
				," .$oCnx->quote($utilisateur->prenom). "
				," .$utilisateur->civilite ."
				," .$oCnx->quote($utilisateur->dateNaissance). "
				," .$oCnx->quote($utilisateur->adresse). "
				," .$oCnx->quote($utilisateur->cp). "
				," .$oCnx->quote($utilisateur->ville). "
				," .$oCnx->quote($utilisateur->fonction). "
				," .$oCnx->quote($utilisateur->societe). "
				," .$oCnx->quote($utilisateur->telephone). "
				," .$oCnx->quote($utilisateur->email). "
				," .$oCnx->quote($utilisateur->login). "
				," .$oCnx->quote($utilisateur->password). "
				," .$oCnx->quote($utilisateur->dateCreation). "
				," .$oCnx->quote($utilisateur->dateModification). "
				," .$utilisateur->statut ."
				," .$utilisateur->question ."
				," .$oCnx->quote($utilisateur->reponse). "
				," .$oCnx->quote($utilisateur->photo). "
				," .$oCnx->quote($utilisateur->url). "
				)";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE utilisateur SET \n
					utilisateur_id=".$oCnx->quote($utilisateur->id)."";
					
			if (isset($utilisateur->paysId)) {
				$zQuery .= "\n, utilisateur_paysId=".$utilisateur->paysId."";
			}
			if (isset($utilisateur->profilId)) {
				$zQuery .= "\n, utilisateur_profilId=".$utilisateur->profilId."";
			}
			if (isset($utilisateur->nom)) {
				$zQuery .= "\n, utilisateur_nom=".$oCnx->quote($utilisateur->nom)."";
			}
			if (isset($utilisateur->prenom)) {
				$zQuery .= "\n, utilisateur_prenom=".$oCnx->quote($utilisateur->prenom)."";
			}
			if (isset($utilisateur->civilite)) {
				$zQuery .= "\n, utilisateur_civilite=".$utilisateur->civilite."";
			}
			if (isset($utilisateur->dateNaissance)) {
				$zQuery .= "\n, utilisateur_dateNaissance=".$oCnx->quote($utilisateur->dateNaissance)."";
			}
			if (isset($utilisateur->adresse)) {
				$zQuery .= "\n, utilisateur_adresse=".$oCnx->quote($utilisateur->adresse)."";
			}
			if (isset($utilisateur->cp)) {
				$zQuery .= "\n, utilisateur_cp=".$oCnx->quote($utilisateur->cp)."";
			}
			if (isset($utilisateur->ville)) {
				$zQuery .= "\n, utilisateur_ville=".$oCnx->quote($utilisateur->ville)."";
			}
			if (isset($utilisateur->fonction)) {
				$zQuery .= "\n, utilisateur_fonction=".$oCnx->quote($utilisateur->fonction)."";
			}
			if (isset($utilisateur->societe)) {
				$zQuery .= "\n, utilisateur_societe=".$oCnx->quote($utilisateur->societe)."";
			}
			if (isset($utilisateur->telephone)) {
				$zQuery .= "\n, utilisateur_telephone=".$oCnx->quote($utilisateur->telephone)."";
			}
			if (isset($utilisateur->email)) {
				$zQuery .= "\n, utilisateur_email=".$oCnx->quote($utilisateur->email)."";
			}
			if (isset($utilisateur->login)) {
				$zQuery .= "\n, utilisateur_login=".$oCnx->quote($utilisateur->login)."";
			}
			if (isset($utilisateur->password)) {
				$zQuery .= "\n, utilisateur_password=".$oCnx->quote($utilisateur->password)."";
			}						
			if (isset($utilisateur->statut)) {
				$zQuery .= "\n, utilisateur_statut=".$utilisateur->statut."";
			}
			if (isset($utilisateur->question)) {
				$zQuery .= "\n, utilisateur_question=".$utilisateur->question."";
			}
			if (isset($utilisateur->reponse)) {
				$zQuery .= "\n, utilisateur_reponse=".$oCnx->quote($utilisateur->reponse)."";
			}						
			if (isset($utilisateur->photo)) {
				$zQuery .= "\n, utilisateur_photo=".$oCnx->quote($utilisateur->photo)."";
			}						
			if (isset($utilisateur->url)) {
				$zQuery .= "\n, utilisateur_url=".$oCnx->quote($utilisateur->url)."";
			}						

			$zQuery .= " \nWHERE utilisateur_id=".$utilisateur->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'un utilisateur
	*
	* @param integer Id du utilisateur à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeUtilisateur($utilisateurId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un utilisateur
		$zQuery = "DELETE FROM utilisateur WHERE utilisateur_id=$utilisateurId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un utilisateur
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateUtilisateurStatut($idUtilisateur, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE utilisateur SET utilisateur_statut ='".$statut."' WHERE utilisateur_id =".$idUtilisateur;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO utilisateur
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoUtilisateur() {

		$object = jDao::createRecord("utilisateur~utilisateur");
		//$object->utilisateur_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* Connexion d'un membre dans le Site
	*
	* param string $login
	* param string $mdp
	* return boolean 
	*/
	static function connexionMembre($email,$password){
		$dao=jDao::create('utilisateur~utilisateur');
		$conditions=jDao::createConditions();
		$conditions->addCondition("utilisateur_email", "=", $email);
		$conditions->addCondition("utilisateur_password", "=", $password);
		//$conditions->addCondition("utilisateur_statut", "eq", 1);
		$rs = $dao->findBy($conditions);
		if(($utilisateur=$rs->fetch())!=FALSE){
			
			//Check le statut : 1=activé, 2=desactivé, 3=en attente de confirmation
			switch ($utilisateur->utilisateur_statut){
				case 1:
						$_SESSION['SESSION_MEMBRE_ID']			= $utilisateur->utilisateur_id;
						$_SESSION['SESSION_MEMBRE_PROFIL_ID']	= $utilisateur->utilisateur_profilId;
						$_SESSION['SESSION_MEMBRE_NOM']			= $utilisateur->utilisateur_nom;
						$_SESSION['SESSION_MEMBRE_PRENOM']		= $utilisateur->utilisateur_prenom;
						break;
				case 2:
						break;
				case 3:
						break;
			}			
			return ($utilisateur->utilisateur_statut); // : 1 ou 2 ou 3
		}
		return 0;
	}
		
	/**
	* renvoit les infos d'un membre
	* param int $membreId id du membre
	* return $membre objet membre
	*/
	static function infosMembre($utilisateurId){
		$dao=jDao::create("utilisateur~utilisateur");
		if(!($utilisateur=$dao->get($utilisateurId))){
			$dao=new jSelectorDao('utilisateur~utilisateur','');
			$c=$dao->getDaoRecordClass();
			$utilisateur=new $c ();
		}
		return $utilisateur;
	}	
	
	/**
	* Test  l'unicité d'un login, existence proprement dite
	*
	* param string $login
	* return boolean 
	*/
	static function unicityUtilisateurLogin($login){
		$dao=jDao::create('utilisateur~utilisateur');
		$conditions=jDao::createConditions();
		$conditions->addCondition("utilisateur_login", "like", $login);
		$rs = $dao->findBy($conditions);
		if(($utilisateur=$rs->fetch())!=FALSE){
			return 1;
		}
		return 0;
	}	

	/**
	* Test  l'unicité du mail , existence proprement dite
	*
	* param string $email
	* return boolean 
	*/
	static function unicityUtilisateurEmail($email){
		$dao=jDao::create('utilisateur~utilisateur');
		$conditions=jDao::createConditions();
		$conditions->addCondition("utilisateur_email", "=", $email);
		$rs = $dao->findBy($conditions);
		if(($utilisateur=$rs->fetch())!=FALSE){
			return 1;
		}
		return 0;
	}	

	/**
    * Enregistrement d'un utilisateur Membre via FO
	*
	* @param object $utilisateur Objet utilisateur
    */
    static function sauvegardeMembre($utilisateur) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'utilisateur
		$utilisateur->statut = isset($utilisateur->statut)? $utilisateur->statut : 0;
		
		if (!isset($utilisateur->id) || $utilisateur->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO utilisateur VALUES (
				 " .$utilisateur->id ."
				," .$utilisateur->paysId ."
				," .$utilisateur->profilId ."				
				," .$oCnx->quote($utilisateur->nom). "
				," .$oCnx->quote($utilisateur->prenom)." 	
				," .$utilisateur->civilite ."
				," .$oCnx->quote($utilisateur->dateNaissance)." 
				," .$oCnx->quote($utilisateur->adresse)." 
				," .$oCnx->quote($utilisateur->cp)." 
				," .$oCnx->quote($utilisateur->ville)." 							
				," .$oCnx->quote($utilisateur->fonction)." 
				," .$oCnx->quote($utilisateur->societe)." 						
				," .$oCnx->quote($utilisateur->telephone)." 								
				," .$oCnx->quote($utilisateur->email). " 
				," .$oCnx->quote($utilisateur->login)." 
				," .$oCnx->quote($utilisateur->password)." 
				," .$oCnx->quote($utilisateur->dateCreation)." 
				," .$oCnx->quote($utilisateur->dateModification)." 
				," .$utilisateur->statut." 				
				," .$utilisateur->question." 				
				," .$oCnx->quote($utilisateur->reponse)." 
				," .$oCnx->quote($utilisateur->photo)." 
				," .$oCnx->quote($utilisateur->url)." 
				)";
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE utilisateur SET \n
					utilisateur_id=".$oCnx->quote($utilisateur->id)."";		
					
			if (isset($utilisateur->paysId)) {
				$zQuery .= "\n, utilisateur_paysId=".$utilisateur->paysId."";
			}
			if (isset($utilisateur->profilId)) {
				$zQuery .= "\n, utilisateur_profilId=".$utilisateur->profilId."";
			}
			if (isset($utilisateur->nom)) {
				$zQuery .= "\n, utilisateur_nom=".$oCnx->quote($utilisateur->nom)."";
			}
			if (isset($utilisateur->prenom)) {
				$zQuery .= "\n, utilisateur_prenom=".$oCnx->quote($utilisateur->prenom)."";
			}
			if (isset($utilisateur->civilite)) {
				$zQuery .= "\n, utilisateur_civilite=".$utilisateur->civilite."";
			}
			if (isset($utilisateur->dateNaissance)) {
				$zQuery .= "\n, utilisateur_dateNaissance=".$oCnx->quote($utilisateur->dateNaissance)."";
			}
			if (isset($utilisateur->adresse)) {
				$zQuery .= "\n, utilisateur_adresse=".$oCnx->quote($utilisateur->adresse)."";
			}
			if (isset($utilisateur->cp)) {
				$zQuery .= "\n, utilisateur_cp=".$oCnx->quote($utilisateur->cp)."";
			}
			if (isset($utilisateur->ville)) {
				$zQuery .= "\n, utilisateur_ville=".$oCnx->quote($utilisateur->ville)."";
			}
			if (isset($utilisateur->fonction)) {
				$zQuery .= "\n, utilisateur_fonction=".$oCnx->quote($utilisateur->fonction)."";
			}
			if (isset($utilisateur->societe)) {
				$zQuery .= "\n, utilisateur_societe=".$oCnx->quote($utilisateur->societe)."";
			}
			if (isset($utilisateur->telephone)) {
				$zQuery .= "\n, utilisateur_telephone=".$oCnx->quote($utilisateur->telephone)."";
			}			
			if (isset($utilisateur->email)) {
				$zQuery .= "\n, utilisateur_email=".$oCnx->quote($utilisateur->email)."";
			}
			if (isset($utilisateur->login)) {
				$zQuery .= "\n, utilisateur_login=".$oCnx->quote($utilisateur->login)."";
			}
			if (isset($utilisateur->password)) {
				$zQuery .= "\n, utilisateur_password=".$oCnx->quote($utilisateur->password)."";
			}
			if (isset($utilisateur->dateCreation)) {
				$zQuery .= "\n, utilisateur_dateCreation=".$oCnx->quote($utilisateur->dateCreation)."";
			}
			if (isset($utilisateur->dateModification)) {
				$zQuery .= "\n, utilisateur_dateModification=".$oCnx->quote($utilisateur->dateModification)."";
			}
			if (isset($utilisateur->statut)) {
				$zQuery .= "\n, utilisateur_statut=".$utilisateur->statut."";
			}
			if (isset($utilisateur->question)) {
				$zQuery .= "\n, utilisateur_question=".$utilisateur->question."";
			}
			if (isset($utilisateur->reponse)) {
				$zQuery .= "\n, utilisateur_reponse=".$oCnx->quote($utilisateur->reponse)."";
			}
			if (isset($utilisateur->photo)) {
				$zQuery .= "\n, utilisateur_photo=".$oCnx->quote($utilisateur->photo)."";
			}
			if (isset($utilisateur->url)) {
				$zQuery .= "\n, utilisateur_url=".$oCnx->quote($utilisateur->url)."";
			}
			$zQuery .= " \nWHERE utilisateur_id=".$utilisateur->id;
			$oCnx->exec($zQuery);
		}		
		return true;
	}
	
}

?>
