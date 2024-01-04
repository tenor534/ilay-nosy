<?php
/**
* @package @projectName@
* @subpackage @moduleName@
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des @moduleAbsName@s
*
* @package @projectName@
* @subpackage @moduleName@
*/
class @moduleName@Srv {

	/**
    * Chargement de la liste des @moduleAbsName@s (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets @moduleAbsName@s , nombre d'enregistrement

    */
    static function chargeListe@ModuleName@($sortField="@tableSortFieldName@", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$liste@NameTable@ = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT @tableChar@.* FROM @nameTable@ AS @tableChar@";
		
		$zSql  = 	" SELECT @tableChar@.@tablePK@"; 
@queryListA@

@queryListB@
		
@queryListC@

		$zSql .=	" FROM @nameTable@ AS @tableChar@ " ;

@queryListD@

@queryListE@

		$zSql .=	" GROUP BY @tableChar@.@tableSortFieldName@" ;
		
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM @nameTable@");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
		
	
		//$liste@NameTable@ = $o@NameTable@Dbw->fetchAll($zSql);
			
		while($record = $rs->fetch()){
		
@queryListF@

			array_push($liste@NameTable@, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['liste@NameTable@'] = $liste@NameTable@ ;
		
		return $tResult ;

	}
	

    static function chargeAll@ModuleName@() {

		$liste@NameTable@ = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT @tableChar@.* ";
		$zSql .=	" FROM @nameTable@ AS @tableChar@ " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($liste@NameTable@, $record) ;
 		}

		$tResult = $liste@NameTable@ ;
		
		return $tResult ;

	}

	/**
    * Chargement d'une entité @nameTable@ donnée
	*
	* @param integer $@nameTable@Id Id de l'entité @nameTable@ souhaitée
	* @return object $to@NameTable@  objet @nameTable@
    */
    static function charge@ModuleName@($@nameTable@Id) {

		// 	Chargement des données
		if (!$@nameTable@Id) {
			throw new Exception("Pas d'identifiant de l'entité @NameTable@ envoyé");
		}
		$zQuery = "SELECT @tableChar@.@tablePK@
@queryChargeA@		
			FROM @nameTable@ AS @tableChar@ WHERE @tableChar@.@tablePK@=".$@nameTable@Id;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$i@NameTable@ = count($to@NameTable@ = $pDbw->fetchAll($zQuery));
		if ($i@NameTable@==0) {
        	throw new Exception("@NameTable@ $@nameTable@Id non trouvée");
		}

@queryChargeB@		
		
		return $to@NameTable@[0];
	}


	/**
    * Enregistrement d'une entité  @nameTable@
	*
	* @param object $@nameTable@ Objet @nameTable@
    */
    static function sauvegarde@ModuleName@($@nameTable@) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'entité @nameTable@
		$@nameTable@->statut = isset($@nameTable@->statut)? $@nameTable@->statut : 0;
		
		if (!isset($@nameTable@->id) || $@nameTable@->id==0) { // insertion
			
			//Requette d'ajout
			$zQuery = "INSERT INTO @nameTable@ VALUES (
				'0'
@querySaveA@		
				)";
				
			$oCnx->exec($zQuery);			
			
		} else { //update

			$zQuery = "UPDATE @nameTable@ SET \n
					societe_id=".$oCnx->quote($@nameTable@->id)."";

@querySaveB@		

			$zQuery .= " \nWHERE @tablePK@=".$@nameTable@->id;
			$oCnx->exec($zQuery);
		}
		
		return FALSE;
	}

	/**
    * Suppression d'une entité @nameTable@
	*
	* @param integer Id de l'entité @nameTable@ à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprime@ModuleName@($@nameTable@Id) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un societe
		$zQuery = "DELETE FROM @nameTable@ WHERE @tablePK@=$@nameTable@Id";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'une entité @nameTable@
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function update@ModuleName@Statut($id@NameTable@, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE @nameTable@ SET @nameTable@_statut ='".$statut."' WHERE @tablePK@ =".$id@NameTable@;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO @NameTable@
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDao@ModuleName@() {

		$object = jDao::createRecord("@nameTable@~@nameTable@");
		//ex : $object->@nameTable@_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
}

?>
