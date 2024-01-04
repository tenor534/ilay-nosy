<?php
/**
* @package jelix
* @subpackage utils
* @version  1
* @author DWORD Consulting SARL
*/


/**
* Utilitaire pour le chargement et la r�copie de donn�es entre tableau et objets
*
* @package jelix
* @subpackage utils
*/
class jMagicLoader{

	/**
	* Transforme un tableau en objet structur�
	* Tr�s utile pour r�cup�rer les donn�es post�es par un form et avoir en 1 seule ligne de code un tableau structur�
	* Exemple d'utilisation : $client = jMagicLoader::arrayToObject($this->request->params, 'client');
	* Se base sur la convention de nomage de champs suivante :
	* <pre>
		Dans cet exemple le prefixe est "client"
		Array
		(
			[client_nom] => de vathaire
			[client_prenom] => sylvain
			[client_adresseLivraison_rue] => 19, rue fabre d'eglantin
			[client_adresseLivraison_codePostal] => 47200
			[client_adresseLivraison_ville] => MARMANDE
			[client_adresseFacturation_rue] => 10 avenue des champs �lys�s
			[client_adresseFacturation_codePostal] => 75008
			[client_adresseFacturation_ville] => PARIS
			[client_enfants_1_dateNaissance] => 28/01/2004
			[client_enfants_1_prenom] => Ana�s
			[client_enfants_2_dateNaissance] => 22/05/2007
			[client_enfants_2_prenom] => Alexandre
		)
		=> 
		stdClass Object
			(
			[nom] => de vathaire
			[prenom] => sylvain
			[adresseLivraison] => stdClass Object
				(
					[rue] => 19, rue fabre d'eglantine
					[codePostal] => 47200
					[ville] => MARMANDE
				)
			[adresseFacturation] => stdClass Object
				(
					[rue] => 10 avenue des champs �lys�s
					[codePostal] => 75008
					[ville] => PARIS
				)
			[enfants] => Array
				(
					[1] => stdClass Object
						(
							[dateNaissance] => 28/01/2004
							[prenom] => Ana�s
						)
					[2] => stdClass Object
						(
							[dateNaissance] => 22/05/2007
							[prenom] => Alexandre
						)
				)
		)
	*/
	static function arrayToObject($datas, $fieldsPrefix){
		
		if($fieldsPrefix == ''){
			throw new Exception("This function need a prefix. Each key of your array should be frexided with this prefix.");
		}
		if(substr($fieldsPrefix, strlen($fieldsPrefix)-1) == '_'){
			throw new Exception("The field prefix should not contains the last separator (_)");
		}

		$result =  new stdClass();
		$subPrefix = Array();
		
		//1 On parcours les champs et on d�termines quels sont les diff�rents prefixes
		foreach($datas as $name=>$value){
		
			if(strpos($name,$fieldsPrefix.'_') === 0){ //Si le champ commence par le prefixe
				$name = substr($name, strlen($fieldsPrefix.'_'));

				if(($posSep = strpos($name, '_')) !== FALSE){ //y un s�parateur
					$prefix = substr($name, 0, $posSep);
					array_push($subPrefix, $prefix);
				}else{
					if(is_array($result)){
						throw new Exception("Wrong field naming. Mixing Array and object for the same prefix");
					}
					$result->$name = $value;
				}
			}
		}

		//Pour chaque prefixe trouv� on fait un appel r�cursif
		foreach($subPrefix as $prefix){
			if(is_numeric($prefix)){
				if(!is_array($result)){
					foreach($result as $properties){ //Si c'est un objet il est suppos� �tre vide
						throw new Exception("Wrong field naming. Mixing Array and object for the same prefix");
					}
					$result = array();
				}
				$result[$prefix] = self::arrayToObject($datas, $fieldsPrefix.'_'.$prefix);
			}else{
				$result->$prefix = self::arrayToObject($datas, $fieldsPrefix.'_'.$prefix);
			}
		}
		return $result;		
	}



	/**
	* Initilise un objet donn� � partir des donn�es d'un autre objet
	*
	* Tr�s utile pour transf�rer  en une seule ligne de code toutes les propri�t�s membres d'un objet � un dao 
	* @param object Objet depuis lequel les donn�es vont �tre recopi�es
	* @param object Objet dans lequel les donn�es vont �tre recopi�es
	* @param string Dans l'objet objectTo les propri�t�s seront pr�fix�es avec $prefix.'_'
	* @param boolean Si true (par d�faut), seul les proprit�es communes aux 2 objets seront recopi�es
	* @return object $objectTo mis � jour
	*/
	static function objectToObject($objectFrom, $objectTo, $prefix = '', $onlyCommonProperties = TRUE){
		
		if(getType($objectFrom) != 'object') {
			throw new Exception("Le param�tre objectFrom doit �tre un objet");
		}
		if(getType($objectTo) != 'object'){
			throw new Exception("Le param�tre objectTo doit �tre un objet");
		}
		$objectToClassName = get_class($objectTo);
		foreach($objectFrom as $key => $value) {
			if (substr($key,0,strlen($prefix)+1)==$prefix.'_') {
				continue;
			}
			$prefixedKey = $prefix.'_'.$key;
			if($onlyCommonProperties){
				if(property_exists($objectToClassName, $prefix.'_'.$key)){
					$objectTo->$prefixedKey = $value;
				}
			}else{
				$objectTo->$prefixedKey = $value;
				unset($objectTo->$key);
			}
		}
		return $objectTo;
	}
}
?>
