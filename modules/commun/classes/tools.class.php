<?php
/**
* @package groupe3
* @subpackage commun
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires
*
* @package groupe3
* @subpackage commun
*/
class Tools {  

	/**
    * supprime les compilés dans temp
	*
	*/
    function cleartemp() {
   		$rep = $this->getResponse('text');
		jFile::removeDir(JELIX_APP_TEMP_PATH, false);
		return $rep;
    }
	
	/**
	* Fonction de formatage de date FR en date EN (format mysql)
	*
	* @param string $datefr Date FR : DD/MM/YYYY HH:ii:ss
	* @return string $datesql Date UK (ou NULL)
	*/
	 static function toDateTimeSQL($datetimefr) {
		$datetimefr = trim($datetimefr);
		$dt = explode(' ',$datetimefr);
		
		$datefr = $dt[0];
		$timefr = $dt[1];
		
		$d = explode('/',$datefr);
		if ($d[0]<>"") {
			$datesql = $d[2]."-".$d[1]."-".$d[0];
			return $datesql . " " . $timefr;
		}
		return "NULL";
	}

	/**
	* Fonction de formatage de date FR en date EN (format mysql)
	*
	* @param string $datefr Date FR
	* @return string $datesql Date UK (ou NULL)
	*/
	 static function toDateSQL($datefr) {
		$datefr = trim($datefr);
		$d = explode('/',$datefr);
		if ($d[0]<>"") {
			$datesql = $d[2]."-".$d[1]."-".$d[0];
			return $datesql;
		}
		return "NULL";
	}
	
	/**
	* Fonction de formatage de date format mysql en date FR
	*
	* @param string $datesql Date FR
	* @return string $datefr Date FR (ou chaîne vide)
	*/
	
	static function toDateFR($datesql) {
		$datesql = trim($datesql);
		if (strlen($datesql)>=10 && $datesql!="0000-00-00 00:00:00") {
			$datesql = substr($datesql, 0,10);
			$d = explode('-',$datesql);
			//print_r($d);
			$datefr = $d[2]."/".$d[1]."/".$d[0];
			return $datefr;
		}
		return "";
	}

	/**
	* Fonction de formatage de date UK (format mysql) en date FR
	*
	* @param string $datesql Date UK
	* @return string $dateuk Date FR (ou chaîne vide)
	*/
		
	static function toDateUK($datesql) {
		$datesql = trim($datesql);
		if (strlen($datesql)>=10 && $datesql!="0000-00-00") {
			$datesql = substr($datesql, 0,10);
			$d = explode('-',$datesql);
			$dateuk = $d[1]."/".$d[2]."/".$d[0];
			return $dateuk;
		}
		return "";
	}
	
	/**
	* Fonction pour remplacer les caractères accentués en simples caractères
	*
	* @param string $string Chaîne à traiter
	* @return string Chaîne sans accent
	*/		
	static function removeaccents($string) {
		return strtr($string, "ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêë
		ìíîïðñòóôõöøùúûüýÿ", "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeei
		iiionoooooouuuuyy");
	}

	/**
	* Fonction pour remplacer les caractères spéciaux en _
	*
	* @param string $string Chaîne à traiter
	* @return string Châine enlevée des caractèers spéciaux
	*/
	static function removeSpecialChars($string) {
		return strtr($string, "?,;.:/!§&#{[(|\\@)]=+}\$£*%><\"'", "_______________________________");
	}	
	
	/**
	* Différence de 2 dates en secondes pour une date MySQL , de la forme AAAA-MM-JJ
	*
	* @param string $date_1 Date 1
	* @param string $date_2 Date 2
	* @return integer $diff Difference entre les 2 dates
	*/
	static function dateDiff($date_1,$date_2) {
		$mktime_1= mktime(0,0,0,substr($date_1,5,2),substr($date_1,-2),substr($date_1,0,4));
		$mktime_2 = mktime(0,0,0,substr($date_2,5,2),substr($date_2,-2),substr($date_2,0,4));
		$diff = intval($mktime_1 - $mktime_2);
		return $diff;
	}

	/**
	* Formattage d'une date en format longue : Dimanche 15 janvier 2005
	*
	* @param string $strDateInput Date de la forme YYYY-MM-JJ
	* @param string $separateur Séparateur
	* @param string $langue Langue (fr/en, par défaut fr)
	* @return string $date_result Date au format long
	*/	

	static function formatToLongDate($strDateInput, $separateur, $langue  = 'fr') {	
		list($year,$month,$day)=explode($separateur,$strDateInput);	
		$strDateInput = mktime(0,0,0,$month,$day,$year);	
		$format = "w";
		$day = date($format,$strDateInput);
		$format = "n";
		$month = date($format,$strDateInput);
		
		if ($langue == 'en') {
			$tab_days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", 
							"Friday", "Saturday");
			$tab_months = array("january", "february", "march", "april", "mai", "june", "july", 
								"august", "september", "october", "november", "december");
			$date_result = $tab_days[$day] . ", " .  $tab_months[$month-1] . " " . 
			date("d",$strDateInput). ", " . date("Y",$strDateInput);		
		} else {
			$tab_days = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
			$tab_months = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", 
								"septembre", "octobre", "novembre", "décembre");
			$date_result = $tab_days[$day] . " " . date("d",$strDateInput) . " " . $tab_months[$month-1] . 
			" " . date("Y",$strDateInput);
		}
		
		return $date_result;
	} 

	/**
	* Formattage d'une date en format longue : Dimanche 15 janvier 2005, 11h 55min 53s
	*
	* @param string $strDateInput Date de la forme YYYY-MM-JJ HH:ii:ss
	* @param string $separateur Séparateur
	* @param string $langue Langue (fr/en, par défaut fr)
	* @return string $date_result Date au format long
	*/	

	static function formatToLongDateTime($strDateInput, $separateur, $langue  = 'fr', $type = "large") {	
		//Séparation de la date et du time
		list($strDate,$strTime)=explode(" ",$strDateInput);	

		list($year,$month,$day)=explode($separateur,$strDate);	
		list($hour,$min,$sec)=explode(":",$strTime);	
		
		$strDateInput = mktime($hour,$min,$sec,$month,$day,$year);	
		$format = "w";
		$day = date($format,$strDateInput);
		$format = "n";
		$month = date($format,$strDateInput);
		
		if ($langue == 'en') {
			$tab_days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", 
							"Friday", "Saturday");
			$tab_months = array("january", "february", "march", "april", "mai", "june", "july", 
								"august", "september", "october", "november", "december");
			$date_result = $tab_days[$day] . ", " .  $tab_months[$month-1] . " " . 
			date("d",$strDateInput). ", " . date("Y",$strDateInput);		
		} else {
			if($type == "large"){
				$tab_days 	= array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
				$tab_months = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
			}else{
				$tab_days 	= array("Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam");
				$tab_months = array("janv", "fév", "mars", "avril", "mai", "juin", "juil", "août", "sept", "oct", "nov", "déc");
			}						
								
			$date_result = $tab_days[$day] . " " . date("d",$strDateInput) . " " . $tab_months[$month-1] . 
			" " . date("Y",$strDateInput) . ", ".$hour."h ".$min."min ". $sec."s";
		}
		
		return $date_result;
	} 
	
	
	/**
	* Formattage d'une date en format longue sans jour : 15 janvier 2005
	*
	* @param string $strDateInput Date de la forme YYYY-MM-JJ
	* @param string $langue Langue (fr/en, par défaut fr)
	* @return string $date_result Date au format long sans jour
	*/		
	static function formatThisDate($strDateInput,$langue = 'fr') {	
		list($year,$month,$day)=explode("-",$strDateInput);	
		$strDateInput = mktime(0,0,0,$month,$day,$year);	
		$format = "w";
		$day = date($format,$strDateInput);
		$format = "n";
		$month = date($format,$strDateInput);
		
		if ($langue == 'en') {
			$tab_months = array("january", "february", "march", "april", "mai", "june", "july", "august", 
								"september", "october", "november", "december");
			$date_result = $tab_months[$month-1] . ", " . date("d",$strDateInput). ", " . date("Y",$strDateInput);		
		} else {
			$tab_months = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", 
								"septembre", "octobre", "novembre", "décembre");
			$date_result = date("d",$strDateInput) . " " . $tab_months[$month-1] . " " . date("Y",$strDateInput);
		}
			
		return $date_result;
	}
	
	
	/**
	* Formatage du parcours en km : en BD : XX.XX ( pour le BO)
	*
	* @param string $input_distance valeur originale de la distance
	* @param integer $str_search chaîne à remplacer
	* @param string $str_replace chaîne de remplacement
	* @return string $result chaîne formatée (la distance)
	*/		
	static function formatDistanceBO($input_distance,$str_search,$str_replace) {
		if (!strpos($input_distance,'.')) {
			$result = intval($input_distance)==0?'':$input_distance;
		} else {
			list($int_part,$dec_part)=explode($str_search,strval($input_distance));	
			if (intval($dec_part)==0) {
				$str_replace='';
				$dec_part='';		
			} else {
				if (substr($dec_part,-1)==0) {
					$dec_part=substr($dec_part,0,1);
				} else {
					$dec_part=substr($dec_part,0,2);
				}
			}
			//return $dec_part;
			$result = $int_part.$str_search.$dec_part >0 ? $int_part.$str_replace.$dec_part :'';	
		}	
		return $result;
	} 
	
	/**
	* Fonction d'ajout de n jour à une date donnée 
	*
	* @param string $strDate Date de la forme YYYY-MM-JJ
	* @param integer $intDays Nomber de jours à ajouter
	* @return string $nextDate Date au format YYYY-MM-JJ
	*/		
	static function addDayToDate($strDate,$intDays)	{
		list($year,$month,$day)=explode("-",$strDate);
		$mkDate = mktime(0,0,0,$month,$day + $intDays,$year);
		$nextDate  = date("Y-m-d",$mkDate);
		return $nextDate;
	}
	

	/**
	* permet de creer un repertoire par defaut mode 0777
	* @param string $_zPath
	* @param int $iMode
	*/
	static function createDirectory ($_zPath="", $_iMode = 0777) {
		if (!$_zPath){
			throw new JException ('projet~errorsGroupe3.err_repertoire_non_defini') ;			
		}else{
			if (!is_dir ($_zPath)){
				mkdir ($_zPath, $_iMode) ;
			}
			@chmod($_zPath, $_iMode) ;
		}
	}

	/**
	* Fonction d'upload et resize d'un fichier image
	* @param string $file_src image source
	* @param string $file_dest destination image
	* @param string $w_dest largeur
	* @param string $h_dest  hauteur
	* @param string $p_methode méthode (crop,force,ratio)
	**/
	static function resizeImage($file_src, $file_dest, $w_dest, $h_dest, $p_methode = "ratio")
	{	

		if (!$w_dest && !$h_dest) {
			throw new JException ('commun~errorsGroupe3.err_const_nok') ;
		}

		if(file_exists($file_src) && $file_dest)
		{	
			jClasses::inc('commun~image') ;
			$imgF = new ImageFilter;
			$imgF->loadImage($file_src);
			
			$imgF->resize($w_dest,$h_dest,$p_methode,true); //p_methode = crop, force, ratio		
			$imgF->output('JPEG',$file_dest,true);	
		}
		else{
			throw new JException ('commun~errorsGroupe3.err_source_ou_dest_nok') ;
		}
	}


	/**
	* Fonction d'upload d'un fichier 
	* @param string $file_src fichier source à charger
	* @param string $dir_path chemin de la destination
	*/
	static function uploadFile($file_src,$upload_path) {
	
		if (isset($_FILES[$file_src]["name"])&& ($_FILES[$file_src]["name"]!= "")) {
			//$file_dest_arr =str_replace(" ","_",$_FILES[$file_src]["name"]);
			$file_dest_arr =$_FILES[$file_src]["name"];
			$file_dest_arr = explode(".",$file_dest_arr);
			$str_basename= $file_dest_arr[0];
			$str_extension= $file_dest_arr[sizeof($file_dest_arr)-1];
			
			$i="";
			
			while (file_exists($upload_path.$str_basename.$i.".".$str_extension)) {
				$i++;
			}
					
			$file_dest = $str_basename.$i.".".$str_extension;
			if (strlen(trim($file_dest)) > 0)  {
				if (isset($_FILES[$file_src]["name"])) {
					if (file_exists($_FILES[$file_src]["tmp_name"])) {
						move_uploaded_file($_FILES[$file_src]["tmp_name"],$upload_path.$file_dest);
						chmod($upload_path.$file_dest,0777);
						@unlink($_FILES[$file_src]["tmp_name"]);		
							 
						return $file_dest;
				   }
				}
			}
		}
	}

	/**
	* Fonction supprime un fichier 
	* @param string $file_src fichier source à charger
	*/
	static function removeFile($file_src) {
		if (file_exists($file_src) && is_file($file_src)) {
			chmod($file_src,0777);
			@unlink($file_src);		
	   }
		return true;
	}

	/**
	* Fonction copie un fichier 
	* @param string $file_src fichier source à charger
	*/
	static function copyFile($zFileName, $zExtPathAndFile, $PATH_MEDIA, $orig_path, $dest_path) {
	
		$tFileName 	= explode(".",$zFileName);
		$zName  	= $tFileName[0];
		$zExt  		= $tFileName[1];
		
		//a attribution de nouveau nom de fichier	
		if (file_exists($dest_path.$zFileName) && is_file($dest_path.$zFileName)){
			// Initialiser le compteur d'extension de nom de fichier
			$i=1;
			while (file_exists($dest_path.$zName.'_'.str_pad($i,6,'0',STR_PAD_LEFT).'.'.$zExt) && is_file($dest_path.$zName.'_'.str_pad($i,6,'0',STR_PAD_LEFT).'.'.$zExt)) {
				$i++;
			}
			$zNewNameFile = $zName.'_'.str_pad($i,6,'0',STR_PAD_LEFT).'.'.$zExt;
			
		}else{
			$zNewNameFile = $zFileName;
		}	
		
		//b- Recherche de repertoire intermediaire
		$tExtPathAndFile  = explode($PATH_MEDIA,$zExtPathAndFile);
		if(sizeof($tExtPathAndFile)>1) {
			$tDirIntermediate = explode($zFileName,$tExtPathAndFile[1]);
			$zDirIntermediate = $tDirIntermediate[0];
		}else{
			$zDirIntermediate = NULL;
		}		
		
		//c- Copie de fichier dans le repertoire de travail avec un nouveau nom de fichier				
		if (file_exists($PATH_MEDIA.$zDirIntermediate.$zFileName) && is_file($PATH_MEDIA.$zDirIntermediate.$zFileName)){

//echo "copy($PATH_MEDIA.$zDirIntermediate.$zFileName, $dest_path.$zNewNameFile);";
			copy($PATH_MEDIA.$zDirIntermediate.$zFileName, $dest_path.$zNewNameFile);
			
		} 
		return $zNewNameFile;
	}



	/**
	* Fonction de translation de mois EN en mois FR
	*
	* @param mixed $moisEn Nom du mois EN ou sa valeur numérique modulo 12
	* @param boolean $longFormat Format long :nom complet du mois (true : par défaut) ou court
	* 			:trois premières lettres (FALSE)
	* @return string Mois
	*/
	 static function toMonthFr($moisEn, $longFormat=TRUE) {
		$monthFr = array('december'=> array("décembre","déc")
							,'january'=> array("janvier","jan")
							,'february'=> array("février","fev")
							,'march'=> array("mars","mar")
							,'april'=> array("avril","avr")
							,'may'=> array("mai","mai")
							,'june'=> array("juin","jui")
							,'july'=> array("juillet","jul")
							,'august'=> array("août","aou")
							,'september'=> array("septembre","sep")
							,'october'=> array("octobre","oct")
							,'november'=> array("novembre","nov"));
		if ($longFormat) {
		   if (is_int($moisEn)) {
		   	return $monthFr[$moisEn%12][0];
			} else {
				return $monthFr[strtolower($moisEn)][0];
			}
			
		} else {
		   if (is_int($moisEn)) {
		   	return $monthFr[$moisEn%12][1];
			} else {
				return $monthFr[strtolower($moisEn)][1];
			}
		}
	}

	/**
	* Dédoublonne un Objet/tableau associatif et/ou indexé (comme array_unique)
	*
	* @param Array/Object  $_tVar référence au Tableau d'Objets unidimensionnel ou tableau simple bidimensionnel
	* @param integeridentifiant si tenir compte des cles/index (TRUE : par défaut) ou par valeur uniquement (FALSE)
	* @return Array	$tDoubles Tableau contenant les éléments en double qu'on a supprimés du tableau en param
	*/
	static function dedoublonne(&$_tVar,$_bAssoc=TRUE)	{
	   $tDoubles = array();
	   $tTemp = $_tVar;
		foreach ($_tVar as $key=>$value) { // prendre un élément à comparer aux autres
			$iVType = gettype($value);
			if ($iVType=="array"){
		      $_value = implode("-",array_values($value));
			} elseif ($iVType=="object") {
		      $_value = implode("-",self::getElts($value, FALSE));
			}
	      foreach ($tTemp as $key1=>$value1) { // comparaison de l'élément avec tous les autres
			   if ($iVType=="array"){
			      $_value1 = implode("-",array_values($value1));
				} elseif ($iVType=="object") {
			      $_value1 = implode("-",self::getElts($value1, FALSE));
				}
				if ($_value==$_value1) {
				   if (!$_bAssoc || ($_bAssoc && $key!=$key1)) {
						$tDoubles[$key] = $_tVar[$key];
						unset($_tVar[$key]);
						unset($tTemp[$key]);
						break;
					}
				}
			}
		}
		return $tDoubles;
	}

	/**
	* Récupère dans un tableau toutes les (propriétés ou valeurs) d'un Objet
	*
	* @param Object $_tObj Objet dont les prop ou valeurs sont à recuperer
	* @param boolean $_bProp Indique si recuperer les proprietes (TRUE: par défaut) ou les valeurs (FALSE)
	* @return String	$tReturn La chaîne résultante
	*/
	static function getElts($_tObj, $_bProp=TRUE)	{
		$tReturn = array();
		foreach ($_tObj as $key=>$value) { // prendre un élément à comparer aux autres
		   if ($_bProp) { // récupérer les propriétés
				array_push($tReturn,$key);
			} else {
				array_push($tReturn,$value);
			}
		}
		return $tReturn;
	} //end of function getElts


	/**
	* Génère un hashcode
	*
	* @return String  $zHashcode La chaîne code généré
	*/
	static function generateHashCode()	{
	   $zHashcode = "";
	   srand(microtime());
	   for ($a=0; $a<20; $a++) {
	      print "coco<br>";
			if (58<=($iElt=rand(48,90)) && $iElt<=64) {
			   $a--;
			   continue;
			}
	      $zHashcode .= chr($iElt);
		}
		return $zHashcode;
	} //end of function generateHashCode


	/**
	* recherche les paametres de session
	*
	* @param String   $_zParName  Nom du parametre de session a rechercher
	* @param String   $_zDefault  Valeur par defaut
	* @return String  				Valeur finale obtenue
	*/
	static function sessParam($_zParName, $_zDefault="") {
	   if (isset($_SESSION[$_zParName])) {
	   	return $_SESSION[$_zParName];
		} else {
	   	return $_zDefault;
		}
	} //end of function generateHashCode

	/**
	* Transforme un objet en un tableau dont les clés sont les propriétés de l'objet
	*
	* @param Object   $_oFrom  Objet de départ
	* @return Array   $tTo     Tableau d'arrivée
	*/
	static function object2Array($_oFrom) {
	   $oTo= array();
	   foreach ($_oFrom as $zProp) {
	      $oTo[$zProp] = $_oFrom->$zProp;
		}
		return $oTo[$zProp];
	} //end of function generateHashCode

	/**
	* Fonction de suppression d'éléments d'un tableau unidimensionnel
	*
	* @param Array $_tArray 	Référence du tableau duquel on veut supprimer les éléments
	* @param Array $_tRem 		Tableau des éléments à supprimer
	* @param boolean $_bInd 	Booléen indiquant si on veut supprimer par index (TRUE :default) ou par clé (FALSE)
	*/
	static function remFromArray(&$_tArray, $_tRem, $_bInd=TRUE) {
		if ($_bInd) {
		   for ($a=0; $a< count($_tRem); $a++) {
		      array_splice($_tArray, $_tRem[$a], 1);
			}
		} else {
		   for ($a=0; $a< count($_tRem); $a++) {
		      $key = array_search($_tRem[$a], $_tArray);
		      unset($_tArray[$key]);
			}
		}
	}

	/**
	* encode en utf8
	* @param array un tableau ou objet
	* 
	*/
	 static function utf_encode(&$array) {
		foreach($array AS $key => &$value) {
			if (is_array($value)||is_object($value)) {
				self::utf_encode($value);
			} else {
				//$value = utf8_encode(htmlspecialchars($value));
				$value = utf8_encode($value);
			}
		}	
	}
	
	/**
	* decode en utf8
	* @param array un tableau ou objet
	* 
	*/
	 static function utf_decode(&$array) {
		foreach($array AS $key => &$value) {
			if (is_array($value)||is_object($value)) {
				self::utf_decode($value);
			} else {
				$value = utf8_decode($value);
			}
		}	
	}
	
	/**
	* stripslashes
	* @param array un tableau ou objet
	* 
	*/
	 static function delantislash(&$array) {
		foreach($array AS $key => &$value) {
			if (is_array($value)||is_object($value)) {
				self::delantislash($value);
			} else {
				$value = stripslashes($value);
			}
		}	
	}
	
	/**
	* replace minmax < >
	* @param array un tableau ou objet
	* 
	*/
	 static function replaceMinMax(&$array) {
		foreach($array AS $key => &$value) {
			if (is_array($value)||is_object($value)) {
				self::replaceMinMax($value);
			} else {
				$value = str_replace('<','&lt;', $value);
				$value = str_replace('>','&gt;', $value);
			}
		}	
	}
	
	
	/**
	* addslashes
	* @param array un tableau ou objet
	* 
	*/
	 static function addantislash(&$array) {
		foreach($array AS $key => &$value) {
			if (is_array($value)||is_object($value)) {
				self::addantislash($value);
			} else {
				$value = addslashes($value);
			}
		}	
	}

	/*
	* file d'ariane
	* @param
	* @return tableau 
	*/
	static function fileAriane($iRang=0, $item="", $lien="", $sousItem="")
	{
		$tResultat = array();
		$tResultat['0']['iRang'] = $iRang;
		$tResultat['0']['libelle'] = "accueil";
		$tResultat['0']['lien'] = jUrl::get("accueil~accueilFo_afficheAccueil");

		switch($iRang)
		{
			case 2 :
				$tResultat['1']['libelle'] = $item;
				$tResultat['1']['lien'] = $lien;
				$tResultat['2']['libelle'] = $sousItem;
				break;
			case 1 :
				$tResultat['1']['libelle'] = $item;
				break;
			default :
				break;
		}
		return $tResultat;
	}	
	/**
	* Fonction d'upload et resize d'un fichier image
	* @param string $file_src image source
	* @param string $file_dest destination image
	* @param string $w_dest largeur
	* @param string $h_dest  hauteur
	
	// Parameters need to be passed in through the URL's query string:
	// image		absolute path of local image starting with "/" (e.g. /images/toast.jpg)
	// width		maximum width of final image in pixels (e.g. 700)
	// height		maximum height of final image in pixels (e.g. 700)
	// color		(optional) background hex color for filling transparent PNGs (e.g. 900 or 16a942)
	// cropratio	(optional) ratio of width to height to crop final image (e.g. 1:1 or 3:2)
	// nocache		(optional) does not read image from the cache
	// quality		(optional, 0-100, default: 90) quality of output image
	**/
	static function resizeImage2($file_src, $file_dest, $file_bg, $w_dest, $h_dest, $im_color, $im_cropratio, $im_quality)
	{	

		if(! defined('MEMORY_TO_ALLOCATE')){
			define('MEMORY_TO_ALLOCATE',	'100M');
		}	
		if(! defined('DEFAULT_QUALITY')){
			define('DEFAULT_QUALITY',		90);
		}	
		//define('CURRENT_DIR',			dirname(__FILE__));
		//define('CACHE_DIR_NAME',		'/imagecache/');
		//define('CACHE_DIR',				CURRENT_DIR . CACHE_DIR_NAME);
		//define('DOCUMENT_ROOT',			$_SERVER['DOCUMENT_ROOT']);

		// Get the size and MIME type of the requested image
		$size	= getimagesize($file_src);
		$mime	= $size['mime'];		
		
		// Make sure that the requested file is actually an image
		if (substr($mime, 0, 6) != 'image/')
		{
			header('HTTP/1.1 400 Bad Request');
			echo 'Error: requested file is not an accepted type: ' . $file_src;
			exit();
		}else{
		
			$width			= $size[0];
			$height			= $size[1];
			
			$maxWidth		= (isset($w_dest)) ? (int) $w_dest : 0;
			$maxHeight		= (isset($h_dest)) ? (int) $h_dest : 0;
			
			if (isset($im_color))
				$color		= preg_replace('/[^0-9a-fA-F]/', '', (string) $im_color);
			else
				$color		= "ffffff";
			
			// If either a max width or max height are not specified, we default to something
			// large so the unspecified dimension isn't a constraint on our resized image.
			// If neither are specified but the color is, we aren't going to be resizing at
			// all, just coloring.
			
			if (!$maxWidth && $maxHeight)
			{
				$maxWidth	= 99999999999999;
			}
			elseif ($maxWidth && !$maxHeight)
			{
				$maxHeight	= 99999999999999;
			}
			elseif ($color && !$maxWidth && !$maxHeight)
			{
				$maxWidth	= $width;
				$maxHeight	= $height;
			}

			// If we don't have a max width or max height, OR the image is smaller than both
			// we do not want to resize it, so we simply output the original image and exit
			if ((!$maxWidth && !$maxHeight) || (!$color && $maxWidth >= $width && $maxHeight >= $height))
			{
				$data	= file_get_contents($file_src);
				
				$lastModifiedString	= gmdate('D, d M Y H:i:s', filemtime($file_src)) . ' GMT';
				$etag				= md5($data);
				
				doConditionalGet($etag, $lastModifiedString);
				
				header("Content-type: $mime");
				header('Content-Length: ' . strlen($data));
				echo $data;
				exit();
			}

			// Ratio cropping
			$offsetX	= 0;
			$offsetY	= 0;
			
			if (isset($im_cropratio))
			{
				$cropRatio		= explode(':', (string) $im_cropratio);
				if (count($cropRatio) == 2)
				{
					$ratioComputed		= $width / $height;
					$cropRatioComputed	= (float) $cropRatio[0] / (float) $cropRatio[1];
					
					if ($ratioComputed < $cropRatioComputed)
					{ // Image is too tall so we will crop the top and bottom
						$origHeight	= $height;
						$height		= $width / $cropRatioComputed;
						$offsetY	= ($origHeight - $height) / 2;
					}
					else if ($ratioComputed > $cropRatioComputed)
					{ // Image is too wide so we will crop off the left and right sides
						$origWidth	= $width;
						$width		= $height * $cropRatioComputed;
						$offsetX	= ($origWidth - $width) / 2;
					}
				}
			}

			// Setting up the ratios needed for resizing. We will compare these below to determine how to
			// resize the image (based on height or based on width)
			$xRatio		= $maxWidth / $width;
			$yRatio		= $maxHeight / $height;
			
			if ($xRatio * $height < $maxHeight)
			{ // Resize the image based on width
				$tnHeight	= ceil($xRatio * $height);
				$tnWidth	= $maxWidth;
			}
			else // Resize the image based on height
			{
				$tnWidth	= ceil($yRatio * $width);
				$tnHeight	= $maxHeight;
			}
			
			// Determine the quality of the output image
			$quality	= (isset($im_quality)) ? (int) $im_quality : DEFAULT_QUALITY;

			// Before we actually do any crazy resizing of the image, we want to make sure that we
			// haven't already done this one at these dimensions. To the cache!
			// Note, cache must be world-readable
			
			// We store our cached image filenames as a hash of the dimensions and the original filename
			/*$resizedImageSource		= $tnWidth . 'x' . $tnHeight . 'x' . $quality;
			if ($color)
				$resizedImageSource	.= 'x' . $color;
			if (isset($im_cropratio))
				$resizedImageSource	.= 'x' . (string) $im_cropratio;
			$resizedImageSource		.= '-' . $image;
			
			$resizedImage	= md5($resizedImageSource);*/
				
			//$resized		= CACHE_DIR . $resizedImage;
			$resized		= $file_dest; //MODIFIED
			
			// We don't want to run out of memory
			ini_set('memory_limit', MEMORY_TO_ALLOCATE);
			
			// Set up a blank canvas for our resized image (destination)
			$dst	= imagecreatetruecolor($tnWidth, $tnHeight);

			// Set up the appropriate image handling functions based on the original image's mime type
			switch ($size['mime'])
			{
				case 'image/gif':
					// We will be converting GIFs to PNGs to avoid transparency issues when resizing GIFs
					// This is maybe not the ideal solution, but IE6 can suck it
					$creationFunction	= 'ImageCreateFromGif';
					$outputFunction		= 'ImagePng';
					$mime				= 'image/png'; // We need to convert GIFs to PNGs
					$doSharpen			= FALSE;
					$quality			= round(10 - ($quality / 10)); // We are converting the GIF to a PNG and PNG needs a compression level of 0 (no compression) through 9
				break;
				
				case 'image/x-png':
				case 'image/png':
					$creationFunction	= 'ImageCreateFromPng';
					$outputFunction		= 'ImagePng';
					$doSharpen			= FALSE;
					$quality			= round(10 - ($quality / 10)); // PNG needs a compression level of 0 (no compression) through 9
				break;
				
				default:
					$creationFunction	= 'ImageCreateFromJpeg';
					$outputFunction	 	= 'ImageJpeg';
					$doSharpen			= TRUE;
				break;
			}
			
			// Read in the original image
			$src	= $creationFunction($file_src);

			if (in_array($size['mime'], array('image/gif', 'image/png')))
			{
				if (!$color)
				{
					// If this is a GIF or a PNG, we need to set up transparency
					imagealphablending($dst, false);
					imagesavealpha($dst, true);
				}
				else
				{
					// Fill the background with the specified color for matting purposes
					if ($color[0] == '#')
						$color = substr($color, 1);
					
					$background	= FALSE;
					
					if (strlen($color) == 6)
						$background	= imagecolorallocate($dst, hexdec($color[0].$color[1]), hexdec($color[2].$color[3]), hexdec($color[4].$color[5]));
					else if (strlen($color) == 3)
						$background	= imagecolorallocate($dst, hexdec($color[0].$color[0]), hexdec($color[1].$color[1]), hexdec($color[2].$color[2]));
					if ($background)
						imagefill($dst, 0, 0, $background);
				}
			}
			
			// Resample the original image into the resized canvas we set up earlier
			ImageCopyResampled($dst, $src, 0, 0, $offsetX, $offsetY, $tnWidth, $tnHeight, $width, $height);
			
			if ($doSharpen)
			{
				// Sharpen the image based on two things:
				//	(1) the difference between the original size and the final size
				//	(2) the final size
				$sharpness	= self::findSharp($width, $tnWidth);
				
				$sharpenMatrix	= array(
					array(-1, -2, -1),
					array(-2, $sharpness + 12, -2),
					array(-1, -2, -1)
				);
				$divisor		= $sharpness;
				$offset			= 0;
				imageconvolution($dst, $sharpenMatrix, $divisor, $offset);
			}
			

			// Merge photos
			
			$fbg	= ImageCreateFromJpeg($file_bg);
			$src	= $dst;
			
			$offsetX = ($w_dest - $tnWidth)/2;
			$offsetY = ($h_dest - $tnHeight)/2;
			
			imagecopymerge($fbg, $src, $offsetX, $offsetY, 0,0, $tnWidth, $tnHeight, 100);
			$dst = $fbg;
			
			// Write the resized image to the cache
			$outputFunction($dst, $resized, $quality);			
			
			//self::imagecopymerge_alpha($dst, $file_bg, $dst_x, $dst_y, 0, 0, $w_dest, $h_dest, 100);
			
		}
	}

	/**
	 * PNG ALPHA CHANNEL SUPPORT for imagecopymerge();
	 * This is a function like imagecopymerge but it handle alpha channel well!!!
	 **/
	static function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
		$opacity=$pct;
		// getting the watermark width
		$w = imagesx($src_im);
		// getting the watermark height
		$h = imagesy($src_im);
		
		// creating a cut resource
		$cut = imagecreatetruecolor($src_w, $src_h);
		// copying that section of the background to the cut
		imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
		// inverting the opacity
		$opacity = 100 - $opacity;
		
		// placing the watermark now
		imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
		imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity);
	} 

	static function findSharp($orig, $final) // function from Ryan Rud (http://adryrun.com)
	{
		$final	= $final * (750.0 / $orig);
		$a		= 52;
		$b		= -0.27810650887573124;
		$c		= .00047337278106508946;
		
		$result = $a + $b * $final + $c * $final * $final;
		
		return max(round($result), 0);
	} // findSharp()
	
	function doConditionalGet($etag, $lastModified)
	{
		header("Last-Modified: $lastModified");
		header("ETag: \"{$etag}\"");
			
		$if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ?
			stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) : 
			false;
		
		$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ?
			stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) :
			false;
		
		if (!$if_modified_since && !$if_none_match)
			return;
		
		if ($if_none_match && $if_none_match != $etag && $if_none_match != '"' . $etag . '"')
			return; // etag is there but doesn't match
		
		if ($if_modified_since && $if_modified_since != $lastModified)
			return; // if-modified-since is there but doesn't match
		
		// Nothing has changed since their last request - serve a 304 and exit
		header('HTTP/1.1 304 Not Modified');
		exit();
	} // doConditionalGet()
	
	
	static function genereCode($case = 1, $type = 2, $taille = 10 ) {
	
		$characts1   = 'abcdefghijklmnopqrstuvwxyz';
		$characts2   = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';	
		$characts3   = '1234567890'; 

		$characts 	 = "";
		
		switch ($case) {			
			case 0: //minuscule
				$characts 	 = $characts1;			
				break;
			case 1: //majuscule
				$characts 	 = $characts2;			
				break;
			case 2: //majuscule + min
				$characts 	 = $characts1 . $characts2;			
				break;
		} 

		switch ($type) {			
			case 0: //numérique
				$characts 	 = $characts3;			
				break;
			case 1: //alphabétique
				$characts 	 = $characts;			
				break;
			case 2: //alphanumérique
				$characts 	 = $characts . $characts3;			
				break;
		} 

		$codeAleatoire      = ''; 
		for($i=0 ; $i<$taille ; $i++)    //$taille est le nombre de caractères
		{ 
			$codeAleatoire .= substr($characts,rand()%(strlen($characts)),1); 
		}
		return $codeAleatoire;
	}

	function genere_password($length) {
        $mauvais_chars = array(34,39,44,96);
        mt_srand(time()); 
        while (strlen($var) < $length) {
                $tmp = mt_rand(33,126); 
                if (in_array($tmp,$mauvais_chars))
                        continue; 
                $var .= chr($tmp);
        } 
        return $var;
	}

	
}
?>
