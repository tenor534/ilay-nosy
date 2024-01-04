<?php
/**
* @package silbrands
* @subpackage gda
* @version  1
* @author NEOV
*/

/**
* Fonctions utilitaires pour la gestion des gdas
*
* @package silbrands
* @subpackage gda
*/
class gdaSrv {

	static function updateGda($idGda, $publier)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE gda SET gda_publier =".$publier." WHERE gda_id =".$idGda;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	/**
    * Chargement de la liste des gdas (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @param int $idMarque => lister par marque
	* @return array Tableau d'objets gdas , nombre d'enregistrement
    */
    static function chargeListeGdaParMarque($sortField="marque_nom", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0, $idMarque) {

		$listeGda = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();
		$zSql = "SELECT g.*, m.marque_id, m.marque_nom, b.boisson_id, b.boisson_nom, f.format_nom FROM gda AS g, formatBoisson AS fb, boisson AS b, marque AS m, format AS f WHERE  fb.formatBoisson_id = g.gda_formatBoissonId AND boisson_id = formatBoisson_boissonId AND m.marque_id = b.boisson_marqueId AND f.format_id = fb.formatBoisson_formatId AND m.marque_id=".$idMarque;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}

		$rs = $cnx->query($zSql);
		
		//tot enregistrement
		$zQuery = "SELECT COUNT(*) AS nbEnreg FROM gda WHERE gda_formatBoissonId IN (SELECT formatBoisson_id FROM formatBoisson WHERE formatBoisson_boissonId IN (SELECT boisson_id FROM boisson WHERE boisson_marqueId=".$idMarque."))";

		$rsCount = $cnx->query($zQuery);

		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		while($record = $rs->fetch()){
			$record->gda_texteHaut 			= stripslashes($record->gda_texteHaut);
			$record->gda_texteBas 			= stripslashes($record->gda_texteBas);
			$record->gda_tabNutritionTexte 	= stripslashes($record->gda_tabNutritionTexte);
			$record->gda_tabNutritionTitre 	= stripslashes($record->gda_tabNutritionTitre);
			array_push($listeGda, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeGda'] = $listeGda;
		
		return $tResult ;

	}
	

	/**
    * Chargement de la liste des gdas (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @param int $idPays => lister par pays
	* @return array Tableau d'objets gdas , nombre d'enregistrement
    */
    static function chargeListeGdaParPays($sortField="gda_texteHaut", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0, $idPays) {

		$listeGda = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();
		$zSql = "SELECT g.*, m.marque_id, m.marque_nom, b.boisson_id, b.boisson_nom, f.format_nom FROM gda AS g, formatBoisson AS fb, boisson AS b, marque AS m, format AS f, gdaPays AS gp WHERE  fb.formatBoisson_id = g.gda_formatBoissonId AND boisson_id = formatBoisson_boissonId AND m.marque_id = b.boisson_marqueId AND f.format_id = fb.formatBoisson_formatId AND gp.gdaPays_gdaId=g.gda_id AND gp.gdaPays_paysId=".$idPays;

		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
//		echo $zSql;

		$rs = $cnx->query($zSql);
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM gda where gda_id in (select gdaPays_gdaId from gdaPays where gdaPays_paysId =".$idPays.")");

//		echo('SELECT COUNT(*) as nbEnreg FROM gda where gda_id in (select gdaPays_gdaId from gdaPays where gdaPays_paysId ='. $idPays);
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		while($record = $rs->fetch()){
			$record->gda_texteHaut 			= stripslashes($record->gda_texteHaut);
			$record->gda_texteBas 			= stripslashes($record->gda_texteBas);
			$record->gda_tabNutritionTexte 	= stripslashes($record->gda_tabNutritionTexte);
			$record->gda_tabNutritionTitre 	= stripslashes($record->gda_tabNutritionTitre);
			array_push($listeGda, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeGda'] = $listeGda;
		
		return $tResult ;

	}


/**
    * Chargement de la liste des gdas (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets gdas , nombre d'enregistrement
    */
    static function chargeListeGda($sortField="marque_nom", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeGda = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();
		$zSql = "SELECT g.*, m.marque_id, m.marque_nom, b.boisson_id, b.boisson_nom, f.format_nom FROM gda AS g, formatBoisson AS fb, boisson AS b, marque AS m, format AS f WHERE  fb.formatBoisson_id = g.gda_formatBoissonId AND boisson_id = formatBoisson_boissonId AND m.marque_id = b.boisson_marqueId AND f.format_id = fb.formatBoisson_formatId";
/*
		$zSql  = 	" SELECT g.* ";
		$zSql .=	" FROM gda AS g " ;
*/
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}

		$rs = $cnx->query($zSql);
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM gda");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		while($record = $rs->fetch()){
			$record->gda_texteHaut 			= stripslashes($record->gda_texteHaut);
			$record->gda_texteBas 			= stripslashes($record->gda_texteBas);
			$record->gda_tabNutritionTexte 	= stripslashes($record->gda_tabNutritionTexte);
			$record->gda_tabNutritionTitre 	= stripslashes($record->gda_tabNutritionTitre);
			array_push($listeGda, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeGda'] = $listeGda;
		
		return $tResult ;

	}

	
	/**
    * Chargement d'un gda donnée
	*
	* @param integer $gdaId id du gda souhaité
	* @param integer $paysId id du pays souhaité
	* @return objet gda
    */
    static function chargeGda($gdaId) {

		// 	Chargement des données
		if (!$gdaId) {
			throw new Exception("Pas d'identifiant du gda envoyé");
		}
		$zQuery = "SELECT g.*, m.marque_id, m.marque_nom, b.boisson_id, b.boisson_nom, f.format_nom FROM gda AS g, formatBoisson AS fb, boisson AS b, marque AS m, format AS f WHERE fb.formatBoisson_id = g.gda_formatBoissonId AND boisson_id=formatBoisson_boissonId AND m.marque_id = b.boisson_marqueId AND f.format_id=fb.formatBoisson_formatId AND g.gda_id = ".$gdaId;
/*
		$zQuery = "SELECT g.* FROM gda AS g WHERE g.gda_id=".$gdaId;
*/
      	$pDbw = jDb::getDbWidget();
      	$iGda = count($toGda = $pDbw->fetchAll($zQuery));
		if ($iGda == 0) {
        	throw new Exception("gda ". $gdaId . " non trouvé");
		}
		
		$toGda[0]->gda_texteHaut = stripslashes($toGda[0]->gda_texteHaut);
		$toGda[0]->gda_texteBas = stripslashes($toGda[0]->gda_texteBas);
		$toGda[0]->gda_tabNutritionTexte = stripslashes($toGda[0]->gda_tabNutritionTexte);
		$toGda[0]->gda_tabNutritionTitre = stripslashes($toGda[0]->gda_tabNutritionTitre);

		return $toGda[0];
	}

	/**
	* selectionner les marques existant dans la base
	* @param
	* @return tableau de marques
	*/
	static function getAllMarque()
	{
		$zQuery = "SELECT m.marque_id, m.marque_nom FROM marque AS m ORDER BY m.marque_nom";
      	$pDbw = jDb::getDbWidget();
      	$toMarque = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toMarque as $oMarque)
		{
			$oMarque->marque_nom = stripslashes($oMarque->marque_nom);
			array_push($tResult, $oMarque);
		}
		return $tResult;

	}

	/**
	* selectionner les boissons existant pour une marque donnée
	* @param marque id
	* @return tableau de boissons
	*/
	static function getAllBoisson($idMarque)
	{
		$zQuery = "SELECT b.boisson_id, b.boisson_nom FROM boisson AS b WHERE b.boisson_marqueId = '".$idMarque."' ORDER BY b.boisson_nom";
      	$pDbw = jDb::getDbWidget();
      	$toBoisson = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toBoisson as $oBoisson)
		{
			$oBoisson->boisson_nom = stripslashes($oBoisson->boisson_nom);
			array_push($tResult, $oBoisson);
		}
/*
		$f = $GLOBALS['gJConfig']->error_handling['logFile'];
		if(!isset($_SERVER['REMOTE_ADDR'])){ 
			 $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
		}
		$f = str_replace('%ip%', $_SERVER['REMOTE_ADDR'], $f);
		$f = str_replace('%m%', date("m"), $f);
		$f = str_replace('%Y%', date("Y"), $f);
		$f = str_replace('%d%', date("d"), $f);
		$f = str_replace('%H%', date("H"), $f);
		$sel = new jSelectorLog($f);

		error_log(date ("Y-m-d H:i:s")."\t".$_SERVER['REMOTE_ADDR']."\t[126541]".$zQuery."\n", 3,$sel->getPath());	
*/
		return $tResult;
	}

	/**
	* selectionner les formats liés à une boisson donnée
	* @param boisson id
	* @return tableau de formats
	*/
	static function getAllFormatByBoisson($idBoisson)
	{
		$zQuery = "SELECT format_id,format_nom,formatBoisson_id,formatBoisson_boissonId FROM format, formatBoisson WHERE format_id = formatBoisson_formatId AND formatBoisson_boissonId = ".$idBoisson;
      	$pDbw = jDb::getDbWidget();
      	$toFormat = $pDbw->fetchAll($zQuery);

		$tResult = array () ;
		foreach($toFormat as $oFormat)
		{
			$oFormat->format_nom = stripslashes($oFormat->format_nom);
			array_push($tResult, $oFormat);
		}
		return $tResult;
	}

	/**
	* selectionner les pays 
	* @param 
	* @return tableau de pays
	*/
	static function getAllPays($gdaId=0)
	{
		if($gdaId == 0)
			$zQuery = "SELECT p.* FROM pays AS p ORDER BY p.pays_nom";
		else
			$zQuery = "SELECT p.* FROM pays AS p, gdaPays AS gp WHERE gp.gdaPays_paysId = p.pays_id AND gp.gdaPays_gdaId =".$gdaId." ORDER BY p.pays_nom";

      	$pDbw = jDb::getDbWidget();
      	$toPays = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toPays as $oPays)
		{
			$oPays->pays_nom = stripslashes($oPays->pays_nom);
			array_push($tResult, $oPays);
		}
		return $tResult;
	}

	/**
	* selectionner les categorie 
	* @param 
	* @return tableau de categories
	*/
	static function getAllCategorie()
	{
		$zQuery = "SELECT c.* FROM categorie AS c";
      	$pDbw = jDb::getDbWidget();
      	$toCategorie = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toCategorie as $oCategorie)
		{
			$oCategorie->categorie_libelle = stripslashes($oCategorie->categorie_libelle);
			array_push($tResult, $oCategorie);
		}
		return $tResult;
	}

	/**
	* selectionner les valeurs
	* @param 
	* @return tableau de valeurs
	*/
	static function getAllValue()
	{
		$zQuery = "SELECT v.* FROM value AS v";
      	$pDbw = jDb::getDbWidget();
      	$toValue = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toValue as $oValue)
		{
			$oValue->value_libelle = stripslashes($oValue->value_libelle);
			array_push($tResult, $oValue);
		}
		return $tResult;
	}

	/**
	* selectionner les descriptions
	* @param 
	* @return tableau de description
	*/
	static function getAllDescription()
	{
		$zQuery = "SELECT d.* FROM description AS d";
      	$pDbw = jDb::getDbWidget();
      	$toDescription = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toDescription as $oDescription)
		{
			$oDescription->description_libelle = stripslashes($oDescription->description_libelle);
			array_push($tResult, $oDescription);
		}
		return $tResult;
	}
	
	/**
	* selectionner les indications pour un gda donné
	* @param id gda
	* @return tableau de indications
	*/
	static function getAllIndicationByGda($gdaId)
	{
		$zQuery = "SELECT i.* FROM indication AS i WHERE i.indication_gdaId =".$gdaId;
      	$pDbw = jDb::getDbWidget();
      	$toIndication = $pDbw->fetchAll($zQuery);
		
		return $toIndication;
	}

	/**
	* selectionner les indications pour un gda donné
	* @param id gda
	* @return tableau de indications
	*/
	static function getAllIndicationNutritionByGda($gdaId)
	{
		$zQuery = "SELECT i.* FROM indicationNutrition AS i WHERE i.indicationNutrition_gdaId=".$gdaId;
      	$pDbw = jDb::getDbWidget();
      	$toIndicationNutrition = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toIndicationNutrition as $oIndicationNutrition)
		{
			$oIndicationNutrition->indicationNutrition_quantite  = stripslashes($oIndicationNutrition->indicationNutrition_quantite );
			array_push($tResult, $oIndicationNutrition);
		}
		return $tResult;
	}


	/**
    * Enregistrement d'un gda
	*
	* @param idMarque
	* @param idBoisson
	* @param toPays (tableau de pays id)
	* @param gda
	* @param indication
	* @param indication Nutrition
	* @return false
    */
    static function sauvegardeGda($idMarque, $idBoisson, $toPays, $gda, $tIndication, $tIndicationNutrition) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		if ($gda->gda_id=='') { // insertion
			//Requette d'ajout d'un gda
			$zQuery = "INSERT INTO gda VALUES ('0', " . $oCnx->quote($gda->gda_formatBoissonId) .",". $oCnx->quote($gda->gda_texteBas).", ".$oCnx->quote($gda->gda_texteHaut).", ".$oCnx->quote($gda->gda_tabNutritionTexte).", ".$oCnx->quote($gda->gda_tabNutritionTitre).", ".$oCnx->quote($gda->gda_publier)." )";
			try {
				$oCnx->startTransaction(); 
				$oCnx->exec($zQuery);
				$oCnx->commit();						
			}catch (Exception $e) {
				$oCnx->rollback();
			}
			//prendre le dernier gda
			$zQuery = "SELECT gda_id FROM gda ORDER BY gda_id DESC LIMIT 1";
			$pDbw = jDb::getDbWidget();
			$oGda = $pDbw->fetchAll($zQuery);
			$gdaId = $oGda[0]->gda_id;


			//insertion gdaPays
			for($i= 0; $i<sizeof($toPays); $i++)
			{
				$oCnx = jDb::getConnection();
				$zQuery ="INSERT INTO gdaPays VALUES (".$oCnx->quote($gdaId).", ".$oCnx->quote($toPays[$i]).")";
				try {
					$oCnx->startTransaction(); 
					$oCnx->exec($zQuery);
					$oCnx->commit();						
				}catch (Exception $e) {
					$oCnx->rollback();
				}
			}

			//insertion indication
			foreach($tIndication as $oIndication)
			{
				$oCnx = jDb::getConnection();
				$zQuery ="INSERT INTO indication VALUES ('0', ".$oCnx->quote($oIndication->indication_valueId).", ".$oCnx->quote($oIndication->indication_categorieId)." , " .$oCnx->quote($gdaId)." , " .$oCnx->quote($oIndication->indication_quantite). ", ".$oCnx->quote($oIndication->indication_percent).", ".$oCnx->quote($oIndication->indication_publier).", ".$oCnx->quote($oIndication->indication_ordreAffichage).") ";
				try {
					$oCnx->startTransaction(); 
					$oCnx->exec($zQuery);
					$oCnx->commit();						
				}catch (Exception $e) {
					$oCnx->rollback();
				}
			}

			//insertion indication Nutrition
			foreach($tIndicationNutrition as $oIndicationNutrition)
			{
				$oCnx = jDb::getConnection();
				$zQuery ="INSERT INTO indicationNutrition VALUES ('0', ".$oCnx->quote($gdaId). ", " .$oCnx->quote($oIndicationNutrition->indicationNutrition_descriptionId)."," .$oCnx->quote($oIndicationNutrition->indicationNutrition_quantite).", " .$oCnx->quote($oIndicationNutrition->indicationNutrition_publier).", "				.$oCnx->quote($oIndicationNutrition->indicationNutrition_bold).", "				.$oCnx->quote($oIndicationNutrition->indicationNutrition_underline).", "				.$oCnx->quote($oIndicationNutrition->indicationNutrition_ordreAffichage).") ";
				try {
					$oCnx->startTransaction(); 
					$oCnx->exec($zQuery);
					$oCnx->commit();						
				}catch (Exception $e) {
					$oCnx->rollback();
				}
			}
		
		} else 
		{ //update 

			$zQuery = "UPDATE gda SET \n gda_id=".$oCnx->quote($gda->gda_id)."";

			if ($gda->gda_formatBoissonId != '') {
				$zQuery .= "\n, gda_formatBoissonId=".$oCnx->quote($gda->gda_formatBoissonId)."";
			}
			if ($gda->gda_texteBas != '') {
				$zQuery .= "\n, gda_texteBas=".$oCnx->quote($gda->gda_texteBas)."";
			}
			if ($gda->gda_texteHaut != '') {
				$zQuery .= "\n, gda_texteHaut=".$oCnx->quote($gda->gda_texteHaut)."";
			}
			if ($gda->gda_tabNutritionTexte != '') {
				$zQuery .= "\n, gda_tabNutritionTexte=".$oCnx->quote($gda->gda_tabNutritionTexte)."";
			}
			if ($gda->gda_tabNutritionTitre != '') {
				$zQuery .= "\n, gda_tabNutritionTitre=".$oCnx->quote($gda->gda_tabNutritionTitre)."";
			}
			$zQuery .= "\n, gda_publier=".$oCnx->quote($gda->gda_publier)."";
			

			$zQuery .= " \nWHERE gda_id=".$gda->gda_id;
			try {
				$oCnx->startTransaction(); 
				$oCnx->exec($zQuery);
				$oCnx->commit();						
			}catch (Exception $e) {
				$oCnx->rollback();
			}	
			
			//update pays
			$oCnx = jDb::getConnection();
			$zQuery ="DELETE FROM gdaPays WHERE gdaPays_gdaId =".$oCnx->quote($gda->gda_id)."";
			try {
				$oCnx->startTransaction(); 
				$oCnx->exec($zQuery);
				$oCnx->commit();						
			}catch (Exception $e) {
				$oCnx->rollback();
			}

			for($i= 0; $i<sizeof($toPays); $i++)
			{
				$oCnx = jDb::getConnection();
				$zQuery ="INSERT INTO gdaPays VALUES (".$oCnx->quote($gda->gda_id).", ".$oCnx->quote($toPays[$i]).")";
				try {
					$oCnx->startTransaction(); 
					$oCnx->exec($zQuery);
					$oCnx->commit();						
				}catch (Exception $e) {
					$oCnx->rollback();
				}
			}
			//update indication
			foreach($tIndication as $oIndication)
			{
				$oCnx = jDb::getConnection();
				$zQuery ="UPDATE indication SET ";
				
				$zQuery .= "\n indication_valueId=".$oCnx->quote($oIndication->indication_valueId)."";
				$zQuery .= "\n,indication_categorieId=".$oCnx->quote($oIndication->indication_categorieId)."";
				$zQuery .= "\n,indication_quantite=".$oCnx->quote($oIndication->indication_quantite)."";
				$zQuery .= "\n,indication_percent=".$oCnx->quote($oIndication->indication_percent)."";
				$zQuery .= "\n,indication_publier=".$oCnx->quote($oIndication->indication_publier)."";
				$zQuery .= "\n,indication_ordreAffichage=".$oCnx->quote($oIndication->indication_ordreAffichage)."";

				$zQuery .= " \nWHERE indication_gdaId=".$gda->gda_id." AND indication_id=".$oCnx->quote($oIndication->indication_id)."";
				try {
					$oCnx->startTransaction(); 
					$oCnx->exec($zQuery);
					$oCnx->commit();						
				}catch (Exception $e) {
					$oCnx->rollback();
				}
			}
			//update indication Nutrition
			foreach($tIndicationNutrition as $oIndicationNutrition)
			{
				$oCnx = jDb::getConnection();
				$zQuery ="UPDATE indicationNutrition SET ";
				
				$zQuery .= "\n indicationNutrition_descriptionId = ".$oCnx->quote($oIndicationNutrition->indicationNutrition_descriptionId)."";
				$zQuery .= "\n,indicationNutrition_quantite = ".$oCnx->quote($oIndicationNutrition->indicationNutrition_quantite)."";
				$zQuery .= "\n,indicationNutrition_publier = ".$oCnx->quote($oIndicationNutrition->indicationNutrition_publier)."";
				$zQuery .= "\n,indicationNutrition_bold = ".$oCnx->quote($oIndicationNutrition->indicationNutrition_bold)."";
				$zQuery .= "\n,indicationNutrition_underline = ".$oCnx->quote($oIndicationNutrition->indicationNutrition_underline)."";
				$zQuery .= "\n,indicationNutrition_ordreAffichage = ".$oCnx->quote($oIndicationNutrition->indicationNutrition_ordreAffichage)."";

				$zQuery .= " \nWHERE indicationNutrition_gdaId=".$gda->gda_id." AND indicationNutrition_id=".$oCnx->quote($oIndicationNutrition->indicationNutrition_id)."";

				try {
					$oCnx->startTransaction(); 
					$oCnx->exec($zQuery);
					$oCnx->commit();						
				}catch (Exception $e) {
					$oCnx->rollback();
				}
			}

		}
		
		return FALSE;
	}	

	/**
    * Suppression d'un gda
	*
	* @param integer Id du gda à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeGda($gdaId) {

		$rConn = jDb::getConnection();
		// 	Suppression physique des pays lié au gda
		$zQuery = "DELETE FROM gdaPays WHERE gdaPays_gdaId=$gdaId";
		$rConn->exec($zQuery);

		$rConn = jDb::getConnection();
		// 	Suppression physique des indications lié au gda
		$zQuery = "DELETE FROM indication WHERE indication_gdaId=$gdaId";
		$rConn->exec($zQuery);

		$rConn = jDb::getConnection();
		// 	Suppression physique des indications Nutrition lié au gda
		$zQuery = "DELETE FROM indicationNutrition WHERE indicationNutrition_gdaId=$gdaId";
		$rConn->exec($zQuery);

		$rConn = jDb::getConnection();
		// 	Suppression physique d'un gda
		$zQuery = "DELETE FROM gda WHERE gda_id=$gdaId";
		$rConn->exec($zQuery);

		return TRUE;
	}

	
	

}

?>
