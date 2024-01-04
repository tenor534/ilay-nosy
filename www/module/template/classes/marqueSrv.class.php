<?php
/**
* @package silbrands
* @subpackage marque
* @version  1
* @author NEOV
*/

/**
* Fonctions utilitaires pour la gestion des marques
*
* @package silbrands
* @subpackage marque
*/
class marqueSrv {

	static function updateMarque($idMarque, $publier=-1, $publierExtranet=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE marque SET ";

		if($publier != -1)
			$zQuery .="marque_publier =". $publier;
		
		if($publierExtranet != -1)
			$zQuery .="marque_publierExtranet =". $publierExtranet;
		
		$zQuery	.=" WHERE marque_id =". $idMarque;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}
	/**
	* réarranger l'ordre d'une page par rapport aux autres
	* @param int $id id de la marque
	* @param int $iNewOrder id du nouvelle du produit
	**/
	static function reorderListeMarque($id, $iNewOrder) {
	
		$oDB = jDb::getDbWidget();
		$zQuery = " SELECT * FROM marque WHERE marque_id = ".$id;
		$toProd = $oDB->fetchAll($zQuery);
		$id = $toProd[0]->marque_id;

		//Chargement des promotions
		$listeDAO = jDao::create('marque~marque');
		$conditions = jDao::createConditions();
		$conditions->addItemOrder("marque_ordreAffichage","ASC");
		$oListeMarque = $listeDAO->findBy($conditions);		
	
		$iIndexPage = 0 ;
		$toListeMarque = array () ;
		while ($oListe = $oListeMarque->fetch ()){

			if ($oListe->marque_id == $id) {
				$iIndexPage = count($toListeMarque);
			}
			array_push ($toListeMarque, $oListe) ;
		}
		
		switch ($iNewOrder) {
			case 1 :		// Descendre
				$toListeMarque[$iIndexPage]->marque_ordreAffichage++ ;
				$listeDAO->update($toListeMarque[$iIndexPage]) ;
				$toListeMarque[$iIndexPage + 1]->marque_ordreAffichage-- ;
				$listeDAO->update($toListeMarque[$iIndexPage + 1]) ;
				break ;
			case 2 :		// Monter
				$toListeMarque[$iIndexPage]->marque_ordreAffichage-- ;
				$listeDAO->update($toListeMarque[$iIndexPage]) ;
				$toListeMarque[$iIndexPage - 1]->marque_ordreAffichage++ ;
				$listeDAO->update($toListeMarque[$iIndexPage - 1]) ;
				break ;
		}
		
	}
	/**
    * Chargement de la liste des marques (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets marques , nombre d'enregistrement
    */
    static function chargeListeMarque($sortField="marque_ordreAffichage", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeMarque = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();
/*
		$zSql  = 	" SELECT m.* ";
		$zSql .=	" FROM marque AS m " ;
*/
		$zSql = "SELECT m.*, count(b.boisson_marqueId) as nbBoisson FROM marque AS m left join boisson as b on m.marque_id = b.boisson_marqueId GROUP BY m.marque_id ";

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}

		$rs = $cnx->query($zSql);
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM marque");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		while($record = $rs->fetch()){
		
			$record->marque_nom = stripslashes($record->marque_nom);
			$record->marque_texte = stripslashes($record->marque_texte);

			array_push($listeMarque, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeMarque'] = $listeMarque;
		
		return $tResult ;

	}

	/**
    * Enregistrement d'une marque
	*
	* @param marque
	* @return false
    */
    static function sauvegardeMarque($marque) {

		jClasses::inc('commun~tools');

		//Tools::addantislash($marque);

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		if (!isset($marque->id) || $marque->id==0) { // insertion
			$ordreAffichage = 1;
			
			$zQuery = "SELECT marque_ordreAffichage FROM marque ORDER BY marque_ordreAffichage DESC limit 1";
			$pDbw = jDb::getDbWidget();
			$iMarque = count($toMarque = $pDbw->fetchAll($zQuery));
			if ($iMarque != 0) {
				$ordreAffichage = $toMarque[0]->marque_ordreAffichage + 1;
			}
			
			//Requette d'ajout			
			$zQuery = "INSERT INTO marque VALUES ('0', " . $oCnx->quote($marque->nom) .",". $oCnx->quote($marque->logo). "," .$oCnx->quote($marque->banniere)." ," .$oCnx->quote($marque->couleur). " , ". $oCnx->quote($marque->texte)." , ".$oCnx->quote($marque->verre)."," .$oCnx->quote($ordreAffichage).", ".$oCnx->quote($marque->publier)." ," .$oCnx->quote($marque->couleurTitreGda)." ," .$oCnx->quote($marque->couleurTxt3)." ," .$oCnx->quote($marque->couleurValeur1)." ," .$oCnx->quote($marque->couleurValeur2)."," .$oCnx->quote($marque->couleurValeur3)."," .$oCnx->quote($marque->texteExtranet)." ," .$oCnx->quote($marque->publierExtranet)." )";
		} else 
		{ //update
			$zQuery = "UPDATE marque SET \n	marque_id=".$oCnx->quote($marque->id)."";

			if (isset($marque->nom)) {
				$zQuery .= "\n, marque_nom=".$oCnx->quote($marque->nom)."";
			}
			if (isset($marque->logo)) {
				$zQuery .= "\n, marque_logo=".$oCnx->quote($marque->logo)."";
			}
			if (isset($marque->banniere)) {
				$zQuery .= "\n, marque_banniere=".$oCnx->quote($marque->banniere)."";
			}
			if (isset($marque->couleur)) {
				$zQuery .= "\n, marque_couleur=".$oCnx->quote($marque->couleur)."";
			}
			if (isset($marque->texte)) {
				$zQuery .= "\n, marque_texte=".$oCnx->quote($marque->texte)."";
			}
			if (isset($marque->verre)) {
				$zQuery .= "\n, marque_verre=".$oCnx->quote($marque->verre)."";
			}
			if (isset($marque->ordreAffichage)) {
				//$zQuery .= "\n, marque_ordreAffichage=".$oCnx->quote($marque->ordreAffichage)."";
			}
			$zQuery .= "\n, marque_publier=".$oCnx->quote($marque->publier)."";

			if (isset($marque->couleurTitreGda)) {
				$zQuery .= "\n, marque_couleurTitreGda=".$oCnx->quote($marque->couleurTitreGda)."";
			}
			if (isset($marque->couleurTxt3)) {
				$zQuery .= "\n, marque_couleurTxt3=".$oCnx->quote($marque->couleurTxt3)."";
			}
			if (isset($marque->couleurValeur1)) {
				$zQuery .= "\n, marque_couleurValeur1=".$oCnx->quote($marque->couleurValeur1)."";
			}
			if (isset($marque->couleurValeur2)) {
				$zQuery .= "\n, marque_couleurValeur2=".$oCnx->quote($marque->couleurValeur2)."";
			}
			if (isset($marque->couleurValeur3)) {
				$zQuery .= "\n, marque_couleurValeur3=".$oCnx->quote($marque->couleurValeur3)."";
			}
			if (isset($marque->texteExtranet)) {
				$zQuery .= "\n, marque_texteExtranet=".$oCnx->quote($marque->texteExtranet)."";
			}
			$zQuery .= "\n, marque_publierExtranet=".$oCnx->quote($marque->publierExtranet)."";

			$zQuery .= " \nWHERE marque_id=".$marque->id;
		}


		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}			
			
		
		return FALSE;
	}

	/**
    * Chargement d'une marque donnée
	*
	* @param integer $marqueId Id de la marque souhaitée
	* @return objet marque
    */
    static function chargeMarque($marqueId) {

		// 	Chargement des données
		if (!$marqueId) {
			throw new Exception("Pas d'identifiant de la marque envoyée");
		}

		$zQuery = "SELECT marque_id
			, marque_nom
			, marque_logo
			, marque_banniere
			, marque_couleur
			, marque_texte
			, marque_verre
			, marque_ordreAffichage
			, marque_publier
			, marque_couleurTitreGda
			, marque_couleurTxt3
			, marque_couleurValeur1
			, marque_couleurValeur2
			, marque_couleurValeur3
			, marque_texteExtranet
			, marque_publierExtranet
			FROM marque WHERE marque_id=".$marqueId;

      	$pDbw = jDb::getDbWidget();
      	$iMarque = count($toMarque = $pDbw->fetchAll($zQuery));
		
		if ($iMarque==0) {
        	throw new Exception("Marque ". $marqueId . " non trouvée");
		}

		$toMarque[0]->marque_nom = stripslashes($toMarque[0]->marque_nom);
		$toMarque[0]->marque_texte = stripslashes($toMarque[0]->marque_texte);

		return $toMarque[0];
	}

	/**
    * Suppression d'une marque
	*
	* @param integer Id de la marque à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeMarque($marqueId) {

		$zSQL= "SELECT marque_id, marque_ordreAffichage FROM marque WHERE marque_ordreAffichage >(SELECT marque_ordreAffichage FROM marque WHERE marque_id =".$marqueId.")";
      	$pDbw = jDb::getDbWidget();
      	$toMarque = $pDbw->fetchAll($zSQL);


		$rConn = jDb::getConnection();
		// 	Suppression physique d'une marque
		$zQuery = "DELETE FROM marque WHERE marque_id=".$marqueId." AND marque_id NOT IN (SELECT boisson_marqueId FROM boisson)";
		$rConn->exec($zQuery);

		foreach ($toMarque as $oMarque)
		{
			$iOrdre = $oMarque->marque_ordreAffichage - 1;
			$zSql = "UPDATE marque SET marque_ordreAffichage=" . $iOrdre . " WHERE marque_id = " . $oMarque->marque_id;
			$rConn = jDb::getConnection();
			$rConn->exec($zSql);
		}

		return TRUE;
	}

	/**
	* Renvoie la liste des marques
	* @return array of object marque
	*
	*/
    static function chargeListeMarqueFo() {
		$pDbw = jDb::getDbWidget();
		$zQuery = "SELECT marque.* FROM  marque 
			INNER JOIN boisson ON boisson.boisson_marqueId = marque.marque_id 
			INNER JOIN formatBoisson ON formatBoisson.formatBoisson_boissonId = boisson.boisson_id 
			INNER JOIN gda ON gda.gda_formatBoissonId = formatBoisson.formatBoisson_id 
			WHERE marque_publier=1 AND gda.gda_publier = 1 
			GROUP BY marque.marque_id 
			ORDER BY marque_ordreAffichage ASC ";
		$toMarques = $pDbw->fetchAll($zQuery);		
		return $toMarques ;

	}

	/**
	* Renvoie la liste des marques
	* @return array of object marque
	*
	*/
    static function chargeListeMarqueByUserFo($iMembreId) {
		$pDbw = jDb::getDbWidget();
		$zQuery = "SELECT m.* 
			FROM  marque AS m
			INNER JOIN utilisateurMarque AS um 
				ON um.utilisateurMarque_marqueId = m.marque_id 
			WHERE m.marque_publierExtranet=1 AND um.utilisateurMarque_utilisateurId = $iMembreId 
			ORDER BY marque_ordreAffichage ASC ";
		$toMarques = $pDbw->fetchAll($zQuery);		
		return $toMarques ;

	}

	/**
	* Renvoie la liste des marques
	* @return array of object marque
	*
	*/
    static function chargeListeMarqueAllFo() {
		$pDbw = jDb::getDbWidget();
		$zQuery = "SELECT m.* 
			FROM  marque AS m
			WHERE m.marque_publierExtranet=1 
			ORDER BY m.marque_ordreAffichage ASC ";
		$toMarques = $pDbw->fetchAll($zQuery);		
		return $toMarques ;

	}
	

	/**
    * Chargement d'une marque donnée en FO
	*
	* @param integer $marqueId Id de la marque souhaitée
	* @return objet marque
    */
    static function chargeMarqueFo($marqueId) {
		$zQuery = sprintf("SELECT * FROM marque 
			INNER JOIN boisson ON boisson.boisson_marqueId = marque.marque_id  
			INNER JOIN formatBoisson ON formatBoisson.formatBoisson_boissonId = boisson.boisson_id 
			INNER JOIN format ON format.format_id = formatBoisson.formatBoisson_formatId 
			INNER JOIN gda ON gda.gda_formatBoissonId = formatBoisson.formatBoisson_id WHERE marque_publier=1 AND marque_id=%d AND gda.gda_publier=1 " ,$marqueId);
      	$pDbw = jDb::getDbWidget();
		$oMarque = NULL;
      	
		if (count($toMarque = $pDbw->fetchAll($zQuery))){
			$oMarque = $toMarque[0];
		}
		return $oMarque;
	}

	/**
    * Chargement d'une marque par defaut en FO
	* @return objet marque
    */
    static function chargeMarqueFoParDefaut() {
		/*$zQuery = "SELECT marque.marque_id, pays.pays_id, boisson.boisson_id, format.format_id FROM marque 
		INNER JOIN boisson ON boisson.boisson_marqueId = marque.marque_id  
		INNER JOIN formatBoisson ON formatBoisson.formatBoisson_boissonId = boisson.boisson_id 
		INNER JOIN format ON format.format_id = formatBoisson.formatBoisson_formatId 
		INNER JOIN gda ON gda.gda_formatBoissonId = formatBoisson.formatBoisson_id 
		INNER JOIN gdaPays ON gdaPays.gdaPays_gdaId = gda.gda_id  
		INNER JOIN pays ON pays.pays_id = gdaPays.gdaPays_paysId   
		WHERE marque.marque_publier=1 AND gda.gda_publier=1 
		ORDER BY marque_ordreAffichage, pays_nom, boisson_nom, format_nom Limit 0,1 ";*/
		
		$zQuery = "SELECT marque.marque_id FROM  marque 
			INNER JOIN boisson ON boisson.boisson_marqueId = marque.marque_id 
			INNER JOIN formatBoisson ON formatBoisson.formatBoisson_boissonId = boisson.boisson_id 
			INNER JOIN gda ON gda.gda_formatBoissonId = formatBoisson.formatBoisson_id 
			WHERE marque_publier=1 AND gda.gda_publier = 1 
			GROUP BY marque.marque_id 
			ORDER BY marque_ordreAffichage ASC 
			LIMIT 0,1 ";

		$pDbw = jDb::getDbWidget();
		$oMarque = NULL;      	
		if (count($toMarque = $pDbw->fetchAll($zQuery))){
			$oMarque = $toMarque[0];
		}
		return $oMarque;
	}


	/**
    * Chargement de la liste des marques (utile pour le BO) par contact
	* @param string $contactId non du champ pour le tri
	* @return array Tableau d'objets contacts
    */
	static function chargeListeMarqueAssoc($contactId = 0, $selected=0){

		$listeMarque = array () ;
		
		$contactId = ($contactId)? $contactId : 0;

		//$pDbw = jDb::getDbWidget();		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT m.marque_id, m.marque_nom ";
		$zSql .=	" FROM marque AS m " ;
		//$zSql .=	" WHERE marque_publier = 1 " ;
		//$zSql .=	" AND marque_publierExtranet = 1 " ;
		
		
		if( $selected == 1 ) {	//Contact selected
			$zSql .=	" INNER JOIN contactMarque AS cm " ;
			$zSql .=	" ON cm.contactMarque_marqueId = m.marque_id ";
			$zSql .=	" WHERE cm.contactMarque_contactId = $contactId" ;
			$zSql .= " ORDER BY m.marque_nom " ;
			
		} else {				//Contact free
			$zSql .=	" WHERE m.marque_id NOT IN (" ;
			$zSql .= 	" SELECT cm.contactMarque_marqueId ";
			$zSql .=	" FROM contactMarque AS cm " ;
			$zSql .=	" WHERE cm.contactMarque_contactId = $contactId" ;
			$zSql .=	" )" ;
			$zSql .= " ORDER BY m.marque_nom " ;
		}
				
		$rs = $cnx->query($zSql);
		while($record = $rs->fetch()){
			$record->marque_nom = stripslashes($record->marque_nom);
			array_push($listeMarque, $record) ;
 		}

		return $listeMarque ;
	}	


	/**
    * Chargement de la liste des formats (utile pour le BO) par boisson
	* @param string $boissonId non du champ pour le tri
	* @return array Tableau d'objets marques , nombre d'enregistrement
    */
	static function chargeListeMarqueUtilisateurAssoc($utilisateurId = 0, $selected=0){

		$listeMarque = array () ;
		
		$utilisateurId = ($utilisateurId)? $utilisateurId : 0;

		//$pDbw = jDb::getDbWidget();		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT f.marque_id, f.marque_nom ";
		$zSql .=	" FROM marque AS f " ;
		
		if( $selected == 1 ) {	//Marque selected
			$zSql .=	" INNER JOIN utilisateurMarque AS um " ;
			$zSql .=	" ON um.utilisateurMarque_marqueId = f.marque_id ";
			$zSql .=	" WHERE um.utilisateurMarque_utilisateurId = $utilisateurId" ;
			// Ordre de tri
			$zSql .= " ORDER BY f.marque_nom " ;		
		} else {				//Marque free
			$zSql .=	" WHERE f.marque_id NOT IN (" ;
			$zSql .= 	" SELECT um.utilisateurMarque_marqueId ";
			$zSql .=	" FROM utilisateurMarque AS um " ;
			$zSql .=	" WHERE um.utilisateurMarque_utilisateurId = $utilisateurId" ;
			$zSql .=	" )" ;
		}		

	
		//$listeMarque = $pDbw->fetchAll($zSql);
		$rs = $cnx->query("$zSql");

		while($record = $rs->fetch()){
			$record->marque_nom = stripslashes($record->marque_nom);
			array_push($listeMarque, $record) ;
 		}
				
		return $listeMarque ;
	}
	
}

?>
