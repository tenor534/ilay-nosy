<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_vehicule_Jx_vehicule_Jx_mysql extends jDaoRecordBase {
 public $vehicule_id;
 public $vehicule_annonceId;
 public $vehicule_origine;
 public $vehicule_marqueId;
 public $vehicule_modeleId;
 public $vehicule_version;
 public $vehicule_premiereMain;
 public $vehicule_type;
 public $vehicule_transmission;
 public $vehicule_nbCylindre;
 public $vehicule_tailleMoteur;
 public $vehicule_motricite;
 public $vehicule_carburant;
 public $vehicule_kilometrage;
 public $vehicule_nbPorte;
 public $vehicule_nbPassager;
 public $vehicule_airClimatise;
 public $vehicule_couleurExterne;
 public $vehicule_couleurInterne;
 public $vehicule_option;
 public $vehicule_garantie;
 public $vehicule_financement;
   public function getProperties() { return cDao_vehicule_Jx_vehicule_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_vehicule_Jx_vehicule_Jx_mysql::$_pkFields; }
}

class cDao_vehicule_Jx_vehicule_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'vehicule' => 
  array (
    'name' => 'vehicule',
    'realname' => 'vehicule',
    'pk' => 
    array (
      0 => 'vehicule_id',
    ),
    'fields' => 
    array (
      0 => 'vehicule_id',
      1 => 'vehicule_annonceId',
      2 => 'vehicule_origine',
      3 => 'vehicule_marqueId',
      4 => 'vehicule_modeleId',
      5 => 'vehicule_version',
      6 => 'vehicule_premiereMain',
      7 => 'vehicule_type',
      8 => 'vehicule_transmission',
      9 => 'vehicule_nbCylindre',
      10 => 'vehicule_tailleMoteur',
      11 => 'vehicule_motricite',
      12 => 'vehicule_carburant',
      13 => 'vehicule_kilometrage',
      14 => 'vehicule_nbPorte',
      15 => 'vehicule_nbPassager',
      16 => 'vehicule_airClimatise',
      17 => 'vehicule_couleurExterne',
      18 => 'vehicule_couleurInterne',
      19 => 'vehicule_option',
      20 => 'vehicule_garantie',
      21 => 'vehicule_financement',
    ),
  ),
);
   protected $_primaryTable = 'vehicule';
   protected $_selectClause='SELECT `vehicule`.`vehicule_id`, `vehicule`.`vehicule_annonceId`, `vehicule`.`vehicule_origine`, `vehicule`.`vehicule_marqueId`, `vehicule`.`vehicule_modeleId`, `vehicule`.`vehicule_version`, `vehicule`.`vehicule_premiereMain`, `vehicule`.`vehicule_type`, `vehicule`.`vehicule_transmission`, `vehicule`.`vehicule_nbCylindre`, `vehicule`.`vehicule_tailleMoteur`, `vehicule`.`vehicule_motricite`, `vehicule`.`vehicule_carburant`, `vehicule`.`vehicule_kilometrage`, `vehicule`.`vehicule_nbPorte`, `vehicule`.`vehicule_nbPassager`, `vehicule`.`vehicule_airClimatise`, `vehicule`.`vehicule_couleurExterne`, `vehicule`.`vehicule_couleurInterne`, `vehicule`.`vehicule_option`, `vehicule`.`vehicule_garantie`, `vehicule`.`vehicule_financement`';
   protected $_fromClause=' FROM `vehicule`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_vehicule_Jx_vehicule_Jx_mysql';
   public static $_properties = array (
  'vehicule_id' => 
  array (
    'name' => 'vehicule_id',
    'fieldName' => 'vehicule_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_annonceId' => 
  array (
    'name' => 'vehicule_annonceId',
    'fieldName' => 'vehicule_annonceId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_origine' => 
  array (
    'name' => 'vehicule_origine',
    'fieldName' => 'vehicule_origine',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'vehicule_marqueId' => 
  array (
    'name' => 'vehicule_marqueId',
    'fieldName' => 'vehicule_marqueId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_modeleId' => 
  array (
    'name' => 'vehicule_modeleId',
    'fieldName' => 'vehicule_modeleId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_version' => 
  array (
    'name' => 'vehicule_version',
    'fieldName' => 'vehicule_version',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'vehicule_premiereMain' => 
  array (
    'name' => 'vehicule_premiereMain',
    'fieldName' => 'vehicule_premiereMain',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_type' => 
  array (
    'name' => 'vehicule_type',
    'fieldName' => 'vehicule_type',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_transmission' => 
  array (
    'name' => 'vehicule_transmission',
    'fieldName' => 'vehicule_transmission',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_nbCylindre' => 
  array (
    'name' => 'vehicule_nbCylindre',
    'fieldName' => 'vehicule_nbCylindre',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_tailleMoteur' => 
  array (
    'name' => 'vehicule_tailleMoteur',
    'fieldName' => 'vehicule_tailleMoteur',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_motricite' => 
  array (
    'name' => 'vehicule_motricite',
    'fieldName' => 'vehicule_motricite',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_carburant' => 
  array (
    'name' => 'vehicule_carburant',
    'fieldName' => 'vehicule_carburant',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_kilometrage' => 
  array (
    'name' => 'vehicule_kilometrage',
    'fieldName' => 'vehicule_kilometrage',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_nbPorte' => 
  array (
    'name' => 'vehicule_nbPorte',
    'fieldName' => 'vehicule_nbPorte',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_nbPassager' => 
  array (
    'name' => 'vehicule_nbPassager',
    'fieldName' => 'vehicule_nbPassager',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_airClimatise' => 
  array (
    'name' => 'vehicule_airClimatise',
    'fieldName' => 'vehicule_airClimatise',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'vehicule_couleurExterne' => 
  array (
    'name' => 'vehicule_couleurExterne',
    'fieldName' => 'vehicule_couleurExterne',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'vehicule_couleurInterne' => 
  array (
    'name' => 'vehicule_couleurInterne',
    'fieldName' => 'vehicule_couleurInterne',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'vehicule_option' => 
  array (
    'name' => 'vehicule_option',
    'fieldName' => 'vehicule_option',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'vehicule_garantie' => 
  array (
    'name' => 'vehicule_garantie',
    'fieldName' => 'vehicule_garantie',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'vehicule_financement' => 
  array (
    'name' => 'vehicule_financement',
    'fieldName' => 'vehicule_financement',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'vehicule',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
);
   public static $_pkFields = array('vehicule_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `vehicule`.`vehicule_id`'.'='.intval($vehicule_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `vehicule_id`'.'='.intval($vehicule_id).'';
}
public function insert ($record){
 if($record->vehicule_id > 0 ){
    $query = 'INSERT INTO `vehicule` (
`vehicule_id`,`vehicule_annonceId`,`vehicule_origine`,`vehicule_marqueId`,`vehicule_modeleId`,`vehicule_version`,`vehicule_premiereMain`,`vehicule_type`,`vehicule_transmission`,`vehicule_nbCylindre`,`vehicule_tailleMoteur`,`vehicule_motricite`,`vehicule_carburant`,`vehicule_kilometrage`,`vehicule_nbPorte`,`vehicule_nbPassager`,`vehicule_airClimatise`,`vehicule_couleurExterne`,`vehicule_couleurInterne`,`vehicule_option`,`vehicule_garantie`,`vehicule_financement`
) VALUES (
'.intval($record->vehicule_id).', '.($record->vehicule_annonceId === null ? 'NULL' : intval($record->vehicule_annonceId)).', '.($record->vehicule_origine === null ? 'NULL' : $this->_conn->quote($record->vehicule_origine,false)).', '.($record->vehicule_marqueId === null ? 'NULL' : intval($record->vehicule_marqueId)).', '.($record->vehicule_modeleId === null ? 'NULL' : intval($record->vehicule_modeleId)).', '.($record->vehicule_version === null ? 'NULL' : $this->_conn->quote($record->vehicule_version,false)).', '.($record->vehicule_premiereMain === null ? 'NULL' : intval($record->vehicule_premiereMain)).', '.($record->vehicule_type === null ? 'NULL' : intval($record->vehicule_type)).', '.($record->vehicule_transmission === null ? 'NULL' : intval($record->vehicule_transmission)).', '.($record->vehicule_nbCylindre === null ? 'NULL' : intval($record->vehicule_nbCylindre)).', '.($record->vehicule_tailleMoteur === null ? 'NULL' : intval($record->vehicule_tailleMoteur)).', '.($record->vehicule_motricite === null ? 'NULL' : intval($record->vehicule_motricite)).', '.($record->vehicule_carburant === null ? 'NULL' : intval($record->vehicule_carburant)).', '.($record->vehicule_kilometrage === null ? 'NULL' : intval($record->vehicule_kilometrage)).', '.($record->vehicule_nbPorte === null ? 'NULL' : intval($record->vehicule_nbPorte)).', '.($record->vehicule_nbPassager === null ? 'NULL' : intval($record->vehicule_nbPassager)).', '.($record->vehicule_airClimatise === null ? 'NULL' : intval($record->vehicule_airClimatise)).', '.($record->vehicule_couleurExterne === null ? 'NULL' : $this->_conn->quote($record->vehicule_couleurExterne,false)).', '.($record->vehicule_couleurInterne === null ? 'NULL' : $this->_conn->quote($record->vehicule_couleurInterne,false)).', '.($record->vehicule_option === null ? 'NULL' : $this->_conn->quote($record->vehicule_option,false)).', '.($record->vehicule_garantie === null ? 'NULL' : $this->_conn->quote($record->vehicule_garantie,false)).', '.($record->vehicule_financement === null ? 'NULL' : $this->_conn->quote($record->vehicule_financement,false)).'
)';
}else{
    $query = 'INSERT INTO `vehicule` (
`vehicule_annonceId`,`vehicule_origine`,`vehicule_marqueId`,`vehicule_modeleId`,`vehicule_version`,`vehicule_premiereMain`,`vehicule_type`,`vehicule_transmission`,`vehicule_nbCylindre`,`vehicule_tailleMoteur`,`vehicule_motricite`,`vehicule_carburant`,`vehicule_kilometrage`,`vehicule_nbPorte`,`vehicule_nbPassager`,`vehicule_airClimatise`,`vehicule_couleurExterne`,`vehicule_couleurInterne`,`vehicule_option`,`vehicule_garantie`,`vehicule_financement`
) VALUES (
'.($record->vehicule_annonceId === null ? 'NULL' : intval($record->vehicule_annonceId)).', '.($record->vehicule_origine === null ? 'NULL' : $this->_conn->quote($record->vehicule_origine,false)).', '.($record->vehicule_marqueId === null ? 'NULL' : intval($record->vehicule_marqueId)).', '.($record->vehicule_modeleId === null ? 'NULL' : intval($record->vehicule_modeleId)).', '.($record->vehicule_version === null ? 'NULL' : $this->_conn->quote($record->vehicule_version,false)).', '.($record->vehicule_premiereMain === null ? 'NULL' : intval($record->vehicule_premiereMain)).', '.($record->vehicule_type === null ? 'NULL' : intval($record->vehicule_type)).', '.($record->vehicule_transmission === null ? 'NULL' : intval($record->vehicule_transmission)).', '.($record->vehicule_nbCylindre === null ? 'NULL' : intval($record->vehicule_nbCylindre)).', '.($record->vehicule_tailleMoteur === null ? 'NULL' : intval($record->vehicule_tailleMoteur)).', '.($record->vehicule_motricite === null ? 'NULL' : intval($record->vehicule_motricite)).', '.($record->vehicule_carburant === null ? 'NULL' : intval($record->vehicule_carburant)).', '.($record->vehicule_kilometrage === null ? 'NULL' : intval($record->vehicule_kilometrage)).', '.($record->vehicule_nbPorte === null ? 'NULL' : intval($record->vehicule_nbPorte)).', '.($record->vehicule_nbPassager === null ? 'NULL' : intval($record->vehicule_nbPassager)).', '.($record->vehicule_airClimatise === null ? 'NULL' : intval($record->vehicule_airClimatise)).', '.($record->vehicule_couleurExterne === null ? 'NULL' : $this->_conn->quote($record->vehicule_couleurExterne,false)).', '.($record->vehicule_couleurInterne === null ? 'NULL' : $this->_conn->quote($record->vehicule_couleurInterne,false)).', '.($record->vehicule_option === null ? 'NULL' : $this->_conn->quote($record->vehicule_option,false)).', '.($record->vehicule_garantie === null ? 'NULL' : $this->_conn->quote($record->vehicule_garantie,false)).', '.($record->vehicule_financement === null ? 'NULL' : $this->_conn->quote($record->vehicule_financement,false)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->vehicule_id < 1  ) $record->vehicule_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `vehicule` SET 
 `vehicule_annonceId`= '.($record->vehicule_annonceId === null ? 'NULL' : intval($record->vehicule_annonceId)).', `vehicule_origine`= '.($record->vehicule_origine === null ? 'NULL' : $this->_conn->quote($record->vehicule_origine,false)).', `vehicule_marqueId`= '.($record->vehicule_marqueId === null ? 'NULL' : intval($record->vehicule_marqueId)).', `vehicule_modeleId`= '.($record->vehicule_modeleId === null ? 'NULL' : intval($record->vehicule_modeleId)).', `vehicule_version`= '.($record->vehicule_version === null ? 'NULL' : $this->_conn->quote($record->vehicule_version,false)).', `vehicule_premiereMain`= '.($record->vehicule_premiereMain === null ? 'NULL' : intval($record->vehicule_premiereMain)).', `vehicule_type`= '.($record->vehicule_type === null ? 'NULL' : intval($record->vehicule_type)).', `vehicule_transmission`= '.($record->vehicule_transmission === null ? 'NULL' : intval($record->vehicule_transmission)).', `vehicule_nbCylindre`= '.($record->vehicule_nbCylindre === null ? 'NULL' : intval($record->vehicule_nbCylindre)).', `vehicule_tailleMoteur`= '.($record->vehicule_tailleMoteur === null ? 'NULL' : intval($record->vehicule_tailleMoteur)).', `vehicule_motricite`= '.($record->vehicule_motricite === null ? 'NULL' : intval($record->vehicule_motricite)).', `vehicule_carburant`= '.($record->vehicule_carburant === null ? 'NULL' : intval($record->vehicule_carburant)).', `vehicule_kilometrage`= '.($record->vehicule_kilometrage === null ? 'NULL' : intval($record->vehicule_kilometrage)).', `vehicule_nbPorte`= '.($record->vehicule_nbPorte === null ? 'NULL' : intval($record->vehicule_nbPorte)).', `vehicule_nbPassager`= '.($record->vehicule_nbPassager === null ? 'NULL' : intval($record->vehicule_nbPassager)).', `vehicule_airClimatise`= '.($record->vehicule_airClimatise === null ? 'NULL' : intval($record->vehicule_airClimatise)).', `vehicule_couleurExterne`= '.($record->vehicule_couleurExterne === null ? 'NULL' : $this->_conn->quote($record->vehicule_couleurExterne,false)).', `vehicule_couleurInterne`= '.($record->vehicule_couleurInterne === null ? 'NULL' : $this->_conn->quote($record->vehicule_couleurInterne,false)).', `vehicule_option`= '.($record->vehicule_option === null ? 'NULL' : $this->_conn->quote($record->vehicule_option,false)).', `vehicule_garantie`= '.($record->vehicule_garantie === null ? 'NULL' : $this->_conn->quote($record->vehicule_garantie,false)).', `vehicule_financement`= '.($record->vehicule_financement === null ? 'NULL' : $this->_conn->quote($record->vehicule_financement,false)).'
 where  `vehicule_id`'.'='.intval($record->vehicule_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>