<?php
/**
* @package jelix
* @subpackage utils
* @version  1
* @author DWORD Consulting SARL
*/


/**
* Utilitaire pour le chargement et la récopie de données entre tableau et objets
*
* @package jelix
* @subpackage utils
*/
class jMagicLoader{

	/**
	* Transforme un tableau en objet structuré
	* Trés utile pour récupérer les données postées par un form et avoir en 1 seule ligne de code un tableau structuré
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
			[client_adresseFacturation_rue] => 10 avenue des champs élysés
			[client_adresseFacturation_codePostal] => 75008
			[client_adresseFacturation_ville] => PARIS
			[client_enfants_1_dateNaissance] => 28/01/2004
			[client_enfants_1_prenom] => Anaïs
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
					[rue] => 10 avenue des champs élysés
					[codePostal] => 75008
					[ville] => PARIS
				)
			[enfants] => Array
				(
					[1] => stdClass Object
						(
							[dateNaissance] => 28/01/2004
							[prenom] => Anaïs
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
		
		//1 On parcours les champs et on détermines quels sont les différents prefixes
		foreach($datas as $name=>$value){
		
			if(strpos($name,$fieldsPrefix.'_') === 0){ //Si le champ commence par le prefixe
				$name = substr($name, strlen($fieldsPrefix.'_'));

				if(($posSep = strpos($name, '_')) !== FALSE){ //y un séparateur
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

		//Pour chaque prefixe trouvé on fait un appel récursif
		foreach($subPrefix as $prefix){
			if(is_numeric($prefix)){
				if(!is_array($result)){
					foreach($result as $properties){ //Si c'est un objet il est supposé être vide
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
	* Initilise un objet donné à partir des données d'un autre objet
	*
	* Trés utile pour transférer  en une seule ligne de code toutes les propriétés membres d'un objet à un dao 
	* @param object Objet depuis lequel les données vont être recopiées
	* @param object Objet dans lequel les données vont être recopiées
	* @param string Dans l'objet objectTo les propriétés seront préfixées avec $prefix.'_'
	* @param boolean Si true (par défaut), seul les propritées communes aux 2 objets seront recopiées
	* @return object $objectTo mis à jour
	*/
	static function objectToObject($objectFrom, $objectTo, $prefix = '', $onlyCommonProperties = TRUE){
		
		if(getType($objectFrom) != 'object') {
			throw new Exception("Le paramètre objectFrom doit être un objet");
		}
		if(getType($objectTo) != 'object'){
			throw new Exception("Le paramètre objectTo doit être un objet");
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
