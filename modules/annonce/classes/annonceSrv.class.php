<?php
/**
* @package ilay-nosy
* @subpackage annonce
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires pour la gestion des annonces
*
* @package ilay-nosy
* @subpackage annonce
*/
class annonceSrv {


    static function chargeListeAnnonceRechercheBo($cid=0, $rid=0, $mot="", $crid=0, $parution=0, $province=0, $localite=0, $prix1=0, $prix2=0, $sortField="categorieAn_libelle, annonce_titre", $sortDirection="ASC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {


		$listeAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM annonce AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,r.* ";
		$zSql .=	" ,c.* ";
		$zSql .=	" ,p.* ";
		$zSql .=	" ,l.* ";
		
		$zSql .=	" ,COUNT(p.photo_annonceId) AS annonce_nbPhoto ";

		$zSql .=	" FROM annonce AS a " ;

		$zSql .=	" LEFT JOIN rubrique as r " ; 
		$zSql .=	" 	ON a.annonce_rubriqueId = r.rubrique_id";
		$zSql .=	" LEFT JOIN categorieAn as c " ; 
		$zSql .=	" 	ON r.rubrique_categorieAnId = c.categorieAn_id";

		$zSql .=	" LEFT JOIN localite as l " ; 
		$zSql .=	" 	ON a.annonce_localiteId = l.localite_id";

		//annonce
		$zSql .=	" LEFT JOIN photo AS p " ;
		$zSql .=	" 	ON p.photo_annonceId = a.annonce_id ";

		$zSql .=	" GROUP BY a.annonce_id" ;

		$zSql .=	" HAVING p.photo_photo <> 'noPhoto.jpg'";
		
		$zClause = " ";
		if($cid != 0){
			if($cid == 777){ //Autres annonces
				$zClause .=	" AND r.rubrique_categorieAnId IN (" . CATEGORIE_ANNONCES . ") ";
			}else{
				$zClause .=	" AND r.rubrique_categorieAnId=" . $cid ;
			}		
		}elseif($rid != 0){

			//cas ou $rid est une rubrique parent, dans ce cas il faut tenir compte des fils
			$zSqlRubrique = "SELECT `rubrique_id`, `rubrique_path` FROM `rubrique` WHERE `rubrique_path` LIKE '%/".$rid."/%'";
			$rsRubrique   = $cnx->query($zSqlRubrique);
			$iRubriqueIds = "0";
			while($recordRubrique = $rsRubrique->fetch()){				
				$iRubriqueIds .= "," . $recordRubrique->rubrique_id;
			}			
			$zClause .=	" AND a.annonce_rubriqueId IN(" . $iRubriqueIds .") ";		
			
			
		}else{
			if($mot != ""){
				$zClause .=	" AND ((UPPER(a.annonce_titre) LIKE '%$mot%') OR (UPPER(a.annonce_reference) LIKE '%$mot%') OR (UPPER(a.annonce_resume) LIKE '%$mot%'))";
			}				
			if($crid != "0"){
			
				$type  = substr($crid,0,1);
				$value = substr($crid,1,strlen($crid)-1);
			
				if($type == "c"){
					$zClause .=	" AND r.rubrique_categorieAnId=" . $value ;
				}elseif($type == "r"){
					$zClause .=	" AND a.annonce_rubriqueId=" . $value ;
				}								
			}			
			
			if ($prix2 > 0){
				$zClause .=	" AND a.annonce_prix BETWEEN " . $prix1. " AND ". $prix2. " ";				
			}
			
			if($parution != 0){
			
				switch($parution){
					case 1: //1jour
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 1";
						break;
					case 2: //2jour
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 2";
						break;
					case 3: //3jour
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 3";
						break;
					case 4: //1semaine
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 8";
						break;
					case 5: //2semaines
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 15";
						break;
					case 6: //1mois
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 30";
						break;
					case 7: //2 mois
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 61";
						break;							
				}
			}		
			if($localite != 0){
				$zClause .=	" AND a.annonce_localiteId=" . $localite ;
			}		
			if($province != 0){
				$zClause .=	" AND l.localite_provinceId=" . $province ;
			}		
		}	

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg 
								FROM annonce as a 

								LEFT JOIN rubrique as r 
									ON a.annonce_rubriqueId = r.rubrique_id
								LEFT JOIN categorieAn as c 
									ON r.rubrique_categorieAnId = c.categorieAn_id
								LEFT JOIN localite as l  
									ON a.annonce_localiteId = l.localite_id 

								WHERE 0=0 "  . $zClause);
								
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeAnnonce = $oAnnonceDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->annonce_reference 		= stripslashes($record->annonce_reference);
			$record->annonce_titre 			= stripslashes($record->annonce_titre);
			$record->annonce_resume 		= stripslashes($record->annonce_resume);
			$record->annonce_prixInfo 		= stripslashes($record->annonce_prixInfo);			
			$record->annonce_description 	= stripslashes($record->annonce_description);
			$record->annonce_contactNom 	= stripslashes($record->annonce_contactNom);
			$record->annonce_contactPrenom 	= stripslashes($record->annonce_contactPrenom);
			$record->annonce_contactEmail 	= stripslashes($record->annonce_contactEmail);
			$record->annonce_contactAdresse = stripslashes($record->annonce_contactAdresse);
			$record->annonce_photo 			= stripslashes($record->annonce_photo);
			$record->annonce_origine 		= stripslashes($record->annonce_origine);

			$record->rubrique_libelle 		= stripslashes($record->rubrique_libelle);
			$record->categorieAn_libelle 	= stripslashes($record->categorieAn_libelle);

			array_push($listeAnnonce, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeAnnonce'] = $listeAnnonce ;
		
		return $tResult ;
	}


	/**
    * Chargement de la liste des annonces (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets annonces , nombre d'enregistrement
	
	 annonce_id   	int(11)
	 annonce_libelle  	varchar(150) 	
    */
    static function chargeListeAnnonce($sortField="abonnement_reference, annonce_reference", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM annonce AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,ab.abonnement_reference ";
		$zSql .=	" ,r.rubrique_libelle ";
		
		$zSql .=	" ,COUNT(p.photo_annonceId) AS annonce_nbPhoto ";

		$zSql .=	" FROM annonce AS a " ;

		$zSql .=	" LEFT JOIN rubrique as r " ; 
		$zSql .=	" 	ON a.annonce_rubriqueId = r.rubrique_id";
		$zSql .=	" LEFT JOIN abonnement as ab " ; 
		$zSql .=	" 	ON a.annonce_abonnementId = ab.abonnement_id";

		//annonce
		$zSql .=	" LEFT JOIN photo AS p " ;
		$zSql .=	" 	ON p.photo_annonceId = a.annonce_id ";

		$zSql .=	" GROUP BY a.annonce_reference" ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg FROM annonce");
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".ANNONCE_PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeAnnonce = $oAnnonceDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->annonce_reference 		= stripslashes($record->annonce_reference);
			$record->annonce_titre 			= stripslashes($record->annonce_titre);
			$record->annonce_resume 		= stripslashes($record->annonce_resume);
			$record->annonce_prixInfo 		= stripslashes($record->annonce_prixInfo);
			$record->annonce_description 	= stripslashes($record->annonce_description);
			$record->annonce_contactNom 	= stripslashes($record->annonce_contactNom);
			$record->annonce_contactPrenom 	= stripslashes($record->annonce_contactPrenom);
			$record->annonce_contactEmail 	= stripslashes($record->annonce_contactEmail);
			$record->annonce_contactAdresse = stripslashes($record->annonce_contactAdresse);
			$record->annonce_photo 			= stripslashes($record->annonce_photo);
			$record->annonce_origine 		= stripslashes($record->annonce_origine);
			

			$record->abonnement_reference 	= stripslashes($record->abonnement_reference);
			$record->rubrique_libelle 		= stripslashes($record->rubrique_libelle);

			array_push($listeAnnonce, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeAnnonce'] = $listeAnnonce ;
		
		return $tResult ;
	}

	/**
    * Chargement de la liste des annonces (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets annonces , nombre d'enregistrement
	
	 annonce_id   	int(11)
	 annonce_libelle  	varchar(150) 	
    */
    static function chargeListeAnnonceFo($iUtilisateurId=0, $iAbonnementId=0, $sortField="abonnement_reference, annonce_reference", $sortDirection="ASC",$iDebutList=0 , $iListAll = 0) {

		$listeAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM annonce AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,ab.abonnement_reference ";
		$zSql .=	" ,ab.abonnement_utilisateurId ";
		$zSql .=	" ,r.rubrique_libelle ";
		
		$zSql .=	" ,COUNT(p.photo_annonceId) AS annonce_nbPhoto ";

		$zSql .=	" FROM annonce AS a " ;

		$zSql .=	" LEFT JOIN rubrique as r " ; 
		$zSql .=	" 	ON a.annonce_rubriqueId = r.rubrique_id";
		$zSql .=	" LEFT JOIN abonnement as ab " ; 
		$zSql .=	" 	ON a.annonce_abonnementId = ab.abonnement_id";

		//annonce
		$zSql .=	" LEFT JOIN photo AS p " ;
		$zSql .=	" 	ON p.photo_annonceId = a.annonce_id ";

		$zSql .=	" GROUP BY a.annonce_id" ;

		$zSql .=	" HAVING a.annonce_abonnementId=" . $iAbonnementId ;
		$zSql .=	" AND ab.abonnement_utilisateurId=" . $iUtilisateurId ;
		$zSql .=	" AND a.annonce_publier = 1 ";
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg 
								FROM annonce as a 
								LEFT JOIN abonnement as ab 
									ON a.annonce_abonnementId = ab.abonnement_id 
								WHERE annonce_abonnementId=" . $iAbonnementId . " 
									AND ab.abonnement_utilisateurId=" . $iUtilisateurId);
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutList.",".ANNONCE_PAGINATION_NBITEMPARPAGE ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeAnnonce = $oAnnonceDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->annonce_reference 		= stripslashes($record->annonce_reference);
			$record->annonce_titre 			= stripslashes($record->annonce_titre);
			$record->annonce_resume 		= stripslashes($record->annonce_resume);
			$record->annonce_prixInfo 		= stripslashes($record->annonce_prixInfo);			
			$record->annonce_description 	= stripslashes($record->annonce_description);
			$record->annonce_contactNom 	= stripslashes($record->annonce_contactNom);
			$record->annonce_contactPrenom 	= stripslashes($record->annonce_contactPrenom);
			$record->annonce_contactEmail 	= stripslashes($record->annonce_contactEmail);
			$record->annonce_contactAdresse = stripslashes($record->annonce_contactAdresse);
			$record->annonce_photo 			= stripslashes($record->annonce_photo);
			$record->annonce_origine 			= stripslashes($record->annonce_origine);

			$record->abonnement_reference 	= stripslashes($record->abonnement_reference);
			$record->rubrique_libelle 		= stripslashes($record->rubrique_libelle);

			array_push($listeAnnonce, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeAnnonce'] = $listeAnnonce ;
		
		return $tResult ;
	}


	/**
    * Chargement de la liste des annonces (utile pour le BO)
	* @param string $sortField non du champ pour le tri
	* @param string $sortDirection direction du tri soit "ASC" soit "DESC"
	* @param int $iListAll 1 => lister sans LIMIT, 0 Avec critere LIMIT
	* @return array Tableau d'objets annonces , nombre d'enregistrement
	
	 annonce_id   	int(11)
	 annonce_libelle  	varchar(150) 	
    */
    static function chargeListeAnnonceRechercheFo($cid=0, $rid=0, $mot="", $crid=0, $parution=0, $province=0, $localite=0, $prix1=0, $prix2=0, $sortField="categorieAn_libelle, annonce_titre", $sortDirection="ASC", $iDebutListe=0, $iListAll=0, $nbPagination=5) {


		$listeAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		//$zSql  = 	" SELECT s.* FROM annonce AS s";
		
		$zSql  = 	" SELECT a.* ";
		$zSql .=	" ,r.* ";
		$zSql .=	" ,c.* ";
		$zSql .=	" ,p.* ";
		$zSql .=	" ,l.* ";
		
		$zSql .=	" ,COUNT(p.photo_annonceId) AS annonce_nbPhoto ";

		$zSql .=	" FROM annonce AS a " ;

		$zSql .=	" LEFT JOIN rubrique as r " ; 
		$zSql .=	" 	ON a.annonce_rubriqueId = r.rubrique_id";
		$zSql .=	" LEFT JOIN categorieAn as c " ; 
		$zSql .=	" 	ON r.rubrique_categorieAnId = c.categorieAn_id";

		$zSql .=	" LEFT JOIN localite as l " ; 
		$zSql .=	" 	ON a.annonce_localiteId = l.localite_id";

		//annonce
		$zSql .=	" LEFT JOIN photo AS p " ;
		$zSql .=	" 	ON p.photo_annonceId = a.annonce_id ";

		$zSql .=	" GROUP BY a.annonce_id" ;

		$zSql .=	" HAVING p.photo_photo <> 'noPhoto.jpg'";
		$zSql .=	" AND a.annonce_publier = 1 ";
		
		$zClause = " ";
		if($cid != 0){
			if($cid == 777){ //Autres annonces
				$zClause .=	" AND r.rubrique_categorieAnId IN (" . CATEGORIE_ANNONCES . ") ";
			}else{
				$zClause .=	" AND r.rubrique_categorieAnId=" . $cid ;
			}		
		}elseif($rid != 0){

			//cas ou $rid est une rubrique parent, dans ce cas il faut tenir compte des fils
			$zSqlRubrique = "SELECT `rubrique_id`, `rubrique_path` FROM `rubrique` WHERE `rubrique_path` LIKE '%/".$rid."/%'";
			$rsRubrique   = $cnx->query($zSqlRubrique);
			$iRubriqueIds = "0";
			while($recordRubrique = $rsRubrique->fetch()){				
				$iRubriqueIds .= "," . $recordRubrique->rubrique_id;
			}			
			$zClause .=	" AND a.annonce_rubriqueId IN(" . $iRubriqueIds .") ";		
			
			
		}else{
			if($mot != ""){
				$zClause .=	" AND ((UPPER(a.annonce_titre) LIKE '%$mot%') OR (UPPER(a.annonce_reference) LIKE '%$mot%') OR (UPPER(a.annonce_resume) LIKE '%$mot%'))";
			}				
			if($crid != "0"){
			
				$type  = substr($crid,0,1);
				$value = substr($crid,1,strlen($crid)-1);
			
				if($type == "c"){
					$zClause .=	" AND r.rubrique_categorieAnId=" . $value ;
				}elseif($type == "r"){
					$zClause .=	" AND a.annonce_rubriqueId=" . $value ;
				}								
			}			
			
			if ($prix2 > 0){
				$zClause .=	" AND a.annonce_prix BETWEEN " . $prix1. " AND ". $prix2. " ";				
			}
			
			if($parution != 0){
			
				switch($parution){
					case 1: //1jour
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 1";
						break;
					case 2: //2jour
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 2";
						break;
					case 3: //3jour
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 3";
						break;
					case 4: //1semaine
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 8";
						break;
					case 5: //2semaines
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 15";
						break;
					case 6: //1mois
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 30";
						break;
					case 7: //2 mois
						$zClause .=	" AND TO_DAYS(NOW()) - TO_DAYS(a.annonce_dateDebut) <= 61";
						break;							
				}
			}		
			if($localite != 0){
				$zClause .=	" AND a.annonce_localiteId=" . $localite ;
			}		
			if($province != 0){
				$zClause .=	" AND l.localite_provinceId=" . $province ;
			}		
		}	

		$zSql .=	" " . $zClause ;
		
		// Ordre de tri
		$zSql .= " ORDER BY $sortField $sortDirection " ;
		
		//echo $zSql;
		
		//tot enregistrement
		$rsCount = $cnx->query("SELECT COUNT(*) as nbEnreg 
								FROM annonce as a 

								LEFT JOIN rubrique as r 
									ON a.annonce_rubriqueId = r.rubrique_id
								LEFT JOIN categorieAn as c 
									ON r.rubrique_categorieAnId = c.categorieAn_id
								LEFT JOIN localite as l  
									ON a.annonce_localiteId = l.localite_id 

								WHERE 0=0 AND a.annonce_publier = 1 "  . $zClause);
								
		$recordCount = $rsCount->fetch() ;
		$iNbEnreg = $recordCount->nbEnreg ; 
		
		if ($iListAll == 0){
			$zSql .= " LIMIT ".$iDebutListe.",".$nbPagination ;
		}
		
		$rs = $cnx->query($zSql);
	
		//$listeAnnonce = $oAnnonceDbw->fetchAll($zSql);
		
		while($record = $rs->fetch()){
		
			$record->annonce_reference 		= stripslashes($record->annonce_reference);
			$record->annonce_titre 			= stripslashes($record->annonce_titre);
			$record->annonce_resume 		= stripslashes($record->annonce_resume);
			$record->annonce_prixInfo 		= stripslashes($record->annonce_prixInfo);			
			$record->annonce_description 	= stripslashes($record->annonce_description);
			$record->annonce_contactNom 	= stripslashes($record->annonce_contactNom);
			$record->annonce_contactPrenom 	= stripslashes($record->annonce_contactPrenom);
			$record->annonce_contactEmail 	= stripslashes($record->annonce_contactEmail);
			$record->annonce_contactAdresse = stripslashes($record->annonce_contactAdresse);
			$record->annonce_photo 			= stripslashes($record->annonce_photo);
			$record->annonce_origine 		= stripslashes($record->annonce_origine);

			$record->rubrique_libelle 		= stripslashes($record->rubrique_libelle);
			$record->categorieAn_libelle 	= stripslashes($record->categorieAn_libelle);

			array_push($listeAnnonce, $record) ;
 		}
		
		$tResult['iNbEnreg'] = $iNbEnreg ;
		$tResult['listeAnnonce'] = $listeAnnonce ;
		
		return $tResult ;
	}


    static function chargeAllAnnonce() {

		$listeAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM annonce AS r " ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeAnnonce, $record) ;
 		}

		$tResult = $listeAnnonce ;
		
		return $tResult ;

	}	
	
    static function chargeAllAnnonceWithout($id) {

		$listeAnnonce = array () ;
		$tResult = array () ;
		
		$id = ($id)? $id : 0;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT r.* ";
		$zSql .=	" FROM annonce AS r " ;
		$zSql .=	" WHERE r.annonce_id <> $id" ;
		$zSql .=	" ORDER BY r.annonce_reference" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeAnnonce, $record) ;
 		}

		$tResult = $listeAnnonce ;
		return $tResult ;
	}

	/**
    * Chargement d'un annonce donné
	*
	* @param integer $annonceId Id de l'annonce souhaitée
	* @return object $toAnnonce  objet annonce
    */
    static function chargeAnnonce($annonceId) {

		// 	Chargement des données
		if (!$annonceId) {
			throw new Exception("Pas d'identifient du annonce envoyé");
		}

		$zQuery = "SELECT annonce_id

			, annonce_abonnementId
			, annonce_rubriqueId
			, annonce_localiteId
			, annonce_reference
			, annonce_titre
			, annonce_resume
			, annonce_description
			, annonce_offreId
			, annonce_prix
			, annonce_prixInfo
			, annonce_annee
			, annonce_etat
			, annonce_contactNom
			, annonce_contactPrenom
			, annonce_contactEmail
			, annonce_contactAdresse
			, annonce_contactTelephone
			, annonce_contactPeriodeAppel
			, annonce_dateCreation
			, annonce_dateModification
			, annonce_dateDebut
			, annonce_dateFin
			, annonce_origine
			, annonce_action
			, annonce_visite
			, annonce_dateVisite
			, annonce_publier
			, annonce_publierHome
			, annonce_laUne
			, annonce_photo

			FROM annonce WHERE annonce_id=".$annonceId;
		//echo $zQuery;	
      	$pDbw = jDb::getDbWidget();
      	$iAnnonce = count($toAnnonce = $pDbw->fetchAll($zQuery));
		if ($iAnnonce==0) {
        	throw new Exception("Annonce $annonceId non trouvée");
		}

		$toAnnonce[0]->annonce_reference 		= stripslashes($toAnnonce[0]->annonce_reference);
		$toAnnonce[0]->annonce_titre 			= stripslashes($toAnnonce[0]->annonce_titre);
		$toAnnonce[0]->annonce_resume 			= stripslashes($toAnnonce[0]->annonce_resume);
		$toAnnonce[0]->annonce_prixInfo 		= stripslashes($toAnnonce[0]->annonce_prixInfo);
		$toAnnonce[0]->annonce_description 		= stripslashes($toAnnonce[0]->annonce_description);
		$toAnnonce[0]->annonce_contactNom 		= stripslashes($toAnnonce[0]->annonce_contactNom);
		$toAnnonce[0]->annonce_contactPrenom 	= stripslashes($toAnnonce[0]->annonce_contactPrenom);
		$toAnnonce[0]->annonce_contactEmail 	= stripslashes($toAnnonce[0]->annonce_contactEmail);
		$toAnnonce[0]->annonce_contactAdresse	= stripslashes($toAnnonce[0]->annonce_contactAdresse);
		$toAnnonce[0]->annonce_photo 			= stripslashes($toAnnonce[0]->annonce_photo);
		$toAnnonce[0]->annonce_origine 			= stripslashes($toAnnonce[0]->annonce_origine);
		
		return $toAnnonce[0];
	}

	/**
    * Enregistrement d'un annonce
	*
	* @param object $annonce Objet annonce
    */
    static function sauvegardeAnnonce($annonce) {

		//Get the connexion
		$oCnx = jDb::getConnection();
		
		//Classe utilitaire
		jClasses::inc('commun~tools');
		
		//Statut de l'annonce
		$annonce->statut = isset($annonce->statut)? $annonce->statut : 0;
		
		if (!isset($annonce->id) || $annonce->id==0) { // insertion
		
		
		//print_r($annonce);
			
			//Requette d'ajout
			$zQuery = "INSERT INTO annonce VALUES (
				'0'
				," .$annonce->abonnementId ."
				," .$annonce->rubriqueId ."
				," .$annonce->localiteId ."
				," .$oCnx->quote($annonce->reference). "
				," .$oCnx->quote($annonce->titre). "
				," .$oCnx->quote($annonce->resume). "
				," .$oCnx->quote($annonce->description). "
				," .$annonce->offreId ."
				," .$oCnx->quote($annonce->prix) ."
				," .$oCnx->quote($annonce->prixInfo). "
				," .$oCnx->quote($annonce->annee) ."
				," .$oCnx->quote($annonce->etat) ."
				," .$oCnx->quote($annonce->contactNom). "
				," .$oCnx->quote($annonce->contactPrenom). "
				," .$oCnx->quote($annonce->contactEmail). "
				," .$oCnx->quote($annonce->contactAdresse). "
				," .$oCnx->quote($annonce->contactTelephone). "
				," .$oCnx->quote($annonce->contactPeriodeAppel). "
				," .$oCnx->quote($annonce->dateCreation). "
				," .$oCnx->quote($annonce->dateModification). "
				," .$oCnx->quote($annonce->dateDebut). "
				," .$oCnx->quote($annonce->dateFin). "
				," .$oCnx->quote($annonce->origine) ."
				," .$annonce->action ."
				," .$annonce->visite ."
				," .$oCnx->quote($annonce->dateVisite). "
				," .$annonce->publier ."
				," .$annonce->publierHome ."
				," .$annonce->laUne ."
				," .$oCnx->quote($annonce->photo). "
				)";
				//echo $zQuery;

			$oCnx->exec($zQuery);			
	        $id = $oCnx->lastInsertId();
			
		} else { //update

			$zQuery = "UPDATE annonce SET \n
					annonce_id=".$oCnx->quote($annonce->id)."";
					
			if (isset($annonce->abonnementId)) {
				$zQuery .= "\n, annonce_abonnementId=".$annonce->abonnementId."";
			}
			if (isset($annonce->rubriqueId)) {
				$zQuery .= "\n, annonce_rubriqueId=".$annonce->rubriqueId."";
			}
			if (isset($annonce->localiteId)) {
				$zQuery .= "\n, annonce_localiteId=".$annonce->localiteId."";
			}
			if (isset($annonce->reference)) {
				$zQuery .= "\n, annonce_reference=".$oCnx->quote($annonce->reference)."";
			}
			if (isset($annonce->titre)) {
				$zQuery .= "\n, annonce_titre=".$oCnx->quote($annonce->titre)."";
			}
			if (isset($annonce->resume)) {
				$zQuery .= "\n, annonce_resume=".$oCnx->quote($annonce->resume)."";
			}
			if (isset($annonce->description)) {
				$zQuery .= "\n, annonce_description=".$oCnx->quote($annonce->description)."";
			}
			if (isset($annonce->offreId)) {
				$zQuery .= "\n, annonce_offreId=".$annonce->offreId."";
			}
			if (isset($annonce->prix)) {
				$zQuery .= "\n, annonce_prix='".$annonce->prix."'";
			}
			if (isset($annonce->prixInfo)) {
				$zQuery .= "\n, annonce_prixInfo=".$oCnx->quote($annonce->prixInfo)."";
			}
			if (isset($annonce->annee)) {
				$zQuery .= "\n, annonce_annee='".$annonce->annee."'";
			}
			if (isset($annonce->etat)) {
				$zQuery .= "\n, annonce_etat=".$annonce->etat."";
			}
			if (isset($annonce->contactNom)) {
				$zQuery .= "\n, annonce_contactNom=".$oCnx->quote($annonce->contactNom)."";
			}
			if (isset($annonce->contactPrenom)) {
				$zQuery .= "\n, annonce_contactPrenom=".$oCnx->quote($annonce->contactPrenom)."";
			}
			if (isset($annonce->contactEmail)) {
				$zQuery .= "\n, annonce_contactEmail=".$oCnx->quote($annonce->contactEmail)."";
			}
			if (isset($annonce->contactAdresse)) {
				$zQuery .= "\n, annonce_contactAdresse=".$oCnx->quote($annonce->contactAdresse)."";
			}
			if (isset($annonce->contactCP)) {
				$zQuery .= "\n, annonce_contactCP=".$oCnx->quote($annonce->contactCP)."";
			}
			if (isset($annonce->contactVille)) {
				$zQuery .= "\n, annonce_contactVille=".$oCnx->quote($annonce->contactVille)."";
			}
			if (isset($annonce->contactTelephone)) {
				$zQuery .= "\n, annonce_contactTelephone=".$oCnx->quote($annonce->contactTelephone)."";
			}
			if (isset($annonce->contactPeriodeAppel)) {
				$zQuery .= "\n, annonce_contactPeriodeAppel=".$oCnx->quote($annonce->contactPeriodeAppel)."";
			}
			if (isset($annonce->dateCreation)) {
				$zQuery .= "\n, annonce_dateCreation=".$oCnx->quote($annonce->dateCreation)."";
			}
			if (isset($annonce->dateModification)) {
				$zQuery .= "\n, annonce_dateModification=".$oCnx->quote($annonce->dateModification)."";
			}
			if (isset($annonce->dateDebut)) {
				$zQuery .= "\n, annonce_dateDebut=".$oCnx->quote($annonce->dateDebut)."";
			}
			if (isset($annonce->dateFin)) {
				$zQuery .= "\n, annonce_dateFin=".$oCnx->quote($annonce->dateFin)."";
			}
			if (isset($annonce->origine)) {
				$zQuery .= "\n, annonce_origine=".$oCnx->quote($annonce->origine)."";
			}
			if (isset($annonce->action)) {
				$zQuery .= "\n, annonce_action=".$annonce->action."";
			}
			if (isset($annonce->visite)) {
				$zQuery .= "\n, annonce_visite=".$annonce->visite."";
			}

			if (isset($annonce->dateVisite)) {
				$zQuery .= "\n, annonce_dateVisite=".$oCnx->quote($annonce->dateVisite)."";
			}
			if (isset($annonce->publier)) {
				$zQuery .= "\n, annonce_publier=".$annonce->publier."";
			}

			if (isset($annonce->publierHome)) {
				$zQuery .= "\n, annonce_publierHome=".$annonce->publierHome."";
			}
			if (isset($annonce->laUne)) {
				$zQuery .= "\n, annonce_laUne=".$annonce->laUne."";
			}

			if (isset($annonce->photo)) {
				$zQuery .= "\n, annonce_photo=".$oCnx->quote($annonce->photo)."";
			}

			$zQuery .= " \nWHERE annonce_id=".$annonce->id;
			
			$oCnx->exec($zQuery);
	        $id = $annonce->id;
		}
		
		return $id;
	}

	/**
    * Suppression d'un annonce
	*
	* @param integer Id du annonce à supprimer
	* @return boolean/ string TRUE si suppression OK, message d'erreur si non
    */
	static function supprimeAnnonce($annonceId) {

		$rConn = jDb::getConnection();

		// 	Suppression physique d'un annonce
		$zQuery = "DELETE FROM annonce WHERE annonce_id=$annonceId";
		$rConn->exec($zQuery);

		return TRUE;
	}


	/**
    * Update le statut d'un annonce
	*
	* @return object $object l'objet DAORecord initialisé
    */
	static function updateAnnonceStatut($idAnnonce, $statut)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE annonce SET annonce_statut ='".$statut."' WHERE annonce_id =".$idAnnonce;
		try {
			//$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			//$oCnx->commit();
		}catch (Exception $e) {
			//$oCnx->rollback();
		}
	}
	
	/**
    * Factory d'objet DAO annonce
	*
	* @return object $object l'objet DAORecord initialisé
    */
    static function getDaoAnnonce() {

		$object = jDao::createRecord("annonce~annonce");
		//$object->annonce_dateCrea  = date("Y-m-d H:i:s");
		return $object;
	}
	
	/**
	* renvoit les infos d'une annonce
	* param int $annonceId id de la annonce
	* return $annonce objet annonce
	*/
	static function getAnnonce($annonceId){
		$dao=jDao::create("annonce~annonce");
		if(!($annonce=$dao->get($annonceId))){
			$dao=new jSelectorDao('annonce~annonce','');
			$c=$dao->getDaoRecordClass();
			$annonce=new $c ();
		}
		return $annonce;
	}	
	
	
	
	/**
	* selectionner les annonces existant pour une catégorie donnée
	* @param idForfaitId
	* @return tableau de boissons
	*/
	static function getAllAnnonce($idAbonnementId)
	{
		$zQuery = "SELECT r.*
				FROM annonce AS r 
				WHERE r.annonce_abonnementId = '".$idAbonnementId."' 
				ORDER BY r.annonce_reference";
      	$pDbw = jDb::getDbWidget();
      	$toAnnonce = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toAnnonce as $oAnnonce)
		{
			$oAnnonce->annonce_libelle = stripslashes($oAnnonce->annonce_libelle);
			array_push($tResult, $oAnnonce);
		}
		return $tResult;
	}

	//With nb annonces
    static function getRandAnByCategorie($idCategorieId) {

		$listeCategorieAn = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT an.* ";

		$zSql .=	" FROM annonce AS an " ;

		$zSql .=	" LEFT JOIN rubrique AS r " ;
		$zSql .=	" 	ON an.annonce_rubriqueId = r.rubrique_id ";
		$zSql .=	" WHERE r.rubrique_categorieAnId = " . $idCategorieId ;
		$zSql .=	" AND an.annonce_publier = 1 " ;
		$zSql .=	" ORDER BY RAND()" ;
		$zSql .=	" LIMIT 1" ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeCategorieAn, $record) ;
 		}

		$tResult = $listeCategorieAn ;
		
		return $tResult ;

	}

	//All annonces by categorie
    static function getLastAnByCategorie($idCategorieIds, $nbFalls) {

		$listeAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();

		$zSql  = 	" SELECT an.*, r.* ";

		$zSql .=	" FROM annonce AS an " ;

		$zSql .=	" LEFT JOIN rubrique AS r " ;
		$zSql .=	" 	ON an.annonce_rubriqueId = r.rubrique_id ";
		$zSql .=	" WHERE r.rubrique_categorieAnId IN (" . $idCategorieIds . ") " ;
		$zSql .=	" AND an.annonce_publier = 1 " ;
		$zSql .=	" ORDER BY an.annonce_dateDebut DESC, an.annonce_id DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;


		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeAnnonce, $record) ;
 		}

		$tResult = $listeAnnonce ;
		
		return $tResult ;
	}


	//All annonces by rubrique
    static function getLastAnByRubrique($idRubriqueId, $nbFalls=3) {

		$listeAnnonce = array () ;
		$tResult = array () ;
		
		$cnx = jDb::getConnection();


		//cas ou $rid est une rubrique parent, dans ce cas il faut tenir compte des fils
		$zSqlRubrique = "SELECT `rubrique_id`, `rubrique_path` FROM `rubrique` WHERE `rubrique_path` LIKE '%/".$idRubriqueId."/%'";
		$rsRubrique   = $cnx->query($zSqlRubrique);
		$iRubriqueIds = "0";
		while($recordRubrique = $rsRubrique->fetch()){				
			$iRubriqueIds .= "," . $recordRubrique->rubrique_id;
		}			

		$zSql  = 	" SELECT an.*, r.* ";

		$zSql .=	" FROM annonce AS an " ;

		$zSql .=	" LEFT JOIN rubrique AS r " ;
		$zSql .=	" 	ON an.annonce_rubriqueId = r.rubrique_id ";
		$zSql .=	" WHERE r.rubrique_id IN (" . $iRubriqueIds . ") " ;
		$zSql .=	" AND an.annonce_publier = 1 " ;
		$zSql .=	" ORDER BY an.annonce_dateDebut DESC " ;
		$zSql .=	" LIMIT 0, " . $nbFalls ;

		$rs = $cnx->query($zSql);
		
		while($record = $rs->fetch()){
			array_push($listeAnnonce, $record) ;
 		}

		$tResult = $listeAnnonce ;
		
		return $tResult ;
	}

	//All annonces by categorie
    static function getTopAnLaUNE($nbFalls=1) {

		$toAnnonces = array();
		
		$pDbw = jDb::getDbWidget();

		$zSql  = 	" SELECT an.*, r.* ";

		$zSql .=	" FROM annonce AS an " ;
		
		$zSql .=	" LEFT JOIN rubrique AS r " ;
		$zSql .=	" 	ON an.annonce_rubriqueId = r.rubrique_id ";

		$zSql .=	" WHERE an.annonce_laUne = 1 " ;
		$zSql .=	" AND an.annonce_publier = 1 " ;
		$zSql .=	" ORDER BY an.annonce_dateDebut DESC, an.annonce_id DESC " ;
		$zSql .=	" LIMIT 0, $nbFalls ";

		$toAnnonces = $pDbw->fetchAll($zSql);		
		
		return $toAnnonces ;
	}



	/**
	* Renvoie la liste des annonces
	* @return array of object toAnnonces
	*
	*/
    static function chargeListAnnonceAllFo() {

		$toAnnonces = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  annonce AS p
					ORDER BY p.annonce_reference ASC";

		$toAnnonces = $pDbw->fetchAll($zQuery);		

		return $toAnnonces;
	}	
	
	/**
	* Renvoie la liste des provinces
	* @return array of object toProvinces
	*
	*/
    static function chargeListProvinceAllFo() {

		$toProvinces = array();

		$pDbw = jDb::getDbWidget();

		$zQuery = " SELECT p.* 
					FROM  province AS p
					ORDER BY p.province_libelle ASC";

		$toProvinces = $pDbw->fetchAll($zQuery);		

		return $toProvinces;
	}	

	/**
	* selectionner les localités existant pour une province donnée
	* @param idProvinceId
	* @return tableau de boissons
	*/
	static function getAllLocalite($idProvinceId)
	{
		$zQuery = "SELECT l.*
				FROM localite AS l 
				WHERE l.localite_provinceId = '".$idProvinceId."' 
				ORDER BY l.localite_libelle";
      	$pDbw = jDb::getDbWidget();
      	$toLocalite = $pDbw->fetchAll($zQuery);
		
		$tResult = array () ;
		foreach($toLocalite as $oLocalite)
		{
			$oLocalite->localite_libelle = stripslashes($oLocalite->localite_libelle);
			array_push($tResult, $oLocalite);
		}
		return $tResult;
	}
	
	/**
	* renvoit les infos d'une province
	* param int $provinceId id de la annonce
	* return $annonce objet annonce
	*/
	static function getProvince($provinceId){
	
		$zQuery = "SELECT l.*
				FROM province AS l 
				WHERE l.province_id = '".$provinceId."'";
      	$pDbw = jDb::getDbWidget();
      	$toProvince = $pDbw->fetchAll($zQuery);		
		$toProvince[0]->province_libelle = stripslashes($toProvince[0]->province_libelle);
		
		$tResult = $toProvince[0];
		return $tResult;
	}	

	/**
	* renvoit les infos d'une localite
	* param int $localiteId id de la annonce
	* return $annonce objet annonce
	*/
	static function getLocalite($localiteId){
	
		$zQuery = "SELECT l.*
				FROM localite AS l 
				WHERE l.localite_id = '".$localiteId."'";
      	$pDbw = jDb::getDbWidget();
      	$toLocalite = $pDbw->fetchAll($zQuery);		
		$toLocalite[0]->localite_libelle = stripslashes($toLocalite[0]->localite_libelle);
		
		$tResult = $toLocalite[0];
		return $tResult;
	}	
	
	static function updateAnnonce($idAnnonce, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE annonce SET ";

		if($publier != -1)
			$zQuery .="annonce_publier =". $publier;
		
		$zQuery	.=" WHERE annonce_id =". $idAnnonce;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}

	static function updateAnnonceHome($idAnnonce, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE annonce SET ";

		if($publier != -1)
			$zQuery .="annonce_publierHome =". $publier;
		
		$zQuery	.=" WHERE annonce_id =". $idAnnonce;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}
	static function updateAnnonceUne($idAnnonce, $publier=-1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE annonce SET ";

		if($publier != -1)
			$zQuery .="annonce_laUne =". $publier;
		
		$zQuery	.=" WHERE annonce_id =". $idAnnonce;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}


	static function incAnnonceVisite($idAnnonce, $visite=1)
	{
		$oCnx = jDb::getConnection();
		$zQuery ="UPDATE annonce SET annonce_id = " . $idAnnonce;

		if($visite != -1)
			$zQuery .=", annonce_visite = (annonce_visite + ". $visite . ") ";
		
		$zQuery	.=" WHERE annonce_id =". $idAnnonce;
		try {
			$oCnx->startTransaction(); 
			$oCnx->exec($zQuery);
			$oCnx->commit();						
		}catch (Exception $e) {
			$oCnx->rollback();
		}
	}
}

?>
