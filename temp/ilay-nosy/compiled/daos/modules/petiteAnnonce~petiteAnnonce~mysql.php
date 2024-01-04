<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_petiteAnnonce_Jx_petiteAnnonce_Jx_mysql extends jDaoRecordBase {
 public $petiteAnnonce_id;
 public $petiteAnnonce_categorieAnId;
 public $petiteAnnonce_reference;
 public $petiteAnnonce_titre;
 public $petiteAnnonce_description;
 public $petiteAnnonce_prix;
 public $petiteAnnonce_prixInfo;
 public $petiteAnnonce_contact;
 public $petiteAnnonce_dateCreation;
 public $petiteAnnonce_dateModification;
 public $petiteAnnonce_affichage;
 public $petiteAnnonce_publier;
   public function getProperties() { return cDao_petiteAnnonce_Jx_petiteAnnonce_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_petiteAnnonce_Jx_petiteAnnonce_Jx_mysql::$_pkFields; }
}

class cDao_petiteAnnonce_Jx_petiteAnnonce_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'petiteAnnonce' => 
  array (
    'name' => 'petiteAnnonce',
    'realname' => 'petiteAnnonce',
    'pk' => 
    array (
      0 => 'petiteAnnonce_id',
    ),
    'fields' => 
    array (
      0 => 'petiteAnnonce_id',
      1 => 'petiteAnnonce_categorieAnId',
      2 => 'petiteAnnonce_reference',
      3 => 'petiteAnnonce_titre',
      4 => 'petiteAnnonce_description',
      5 => 'petiteAnnonce_prix',
      6 => 'petiteAnnonce_prixInfo',
      7 => 'petiteAnnonce_contact',
      8 => 'petiteAnnonce_dateCreation',
      9 => 'petiteAnnonce_dateModification',
      10 => 'petiteAnnonce_affichage',
      11 => 'petiteAnnonce_publier',
    ),
  ),
);
   protected $_primaryTable = 'petiteAnnonce';
   protected $_selectClause='SELECT `petiteAnnonce`.`petiteAnnonce_id`, `petiteAnnonce`.`petiteAnnonce_categorieAnId`, `petiteAnnonce`.`petiteAnnonce_reference`, `petiteAnnonce`.`petiteAnnonce_titre`, `petiteAnnonce`.`petiteAnnonce_description`, `petiteAnnonce`.`petiteAnnonce_prix`, `petiteAnnonce`.`petiteAnnonce_prixInfo`, `petiteAnnonce`.`petiteAnnonce_contact`, `petiteAnnonce`.`petiteAnnonce_dateCreation`, `petiteAnnonce`.`petiteAnnonce_dateModification`, `petiteAnnonce`.`petiteAnnonce_affichage`, `petiteAnnonce`.`petiteAnnonce_publier`';
   protected $_fromClause=' FROM `petiteAnnonce`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_petiteAnnonce_Jx_petiteAnnonce_Jx_mysql';
   public static $_properties = array (
  'petiteAnnonce_id' => 
  array (
    'name' => 'petiteAnnonce_id',
    'fieldName' => 'petiteAnnonce_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'petiteAnnonce_categorieAnId' => 
  array (
    'name' => 'petiteAnnonce_categorieAnId',
    'fieldName' => 'petiteAnnonce_categorieAnId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'petiteAnnonce_reference' => 
  array (
    'name' => 'petiteAnnonce_reference',
    'fieldName' => 'petiteAnnonce_reference',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'petiteAnnonce_titre' => 
  array (
    'name' => 'petiteAnnonce_titre',
    'fieldName' => 'petiteAnnonce_titre',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'petiteAnnonce_description' => 
  array (
    'name' => 'petiteAnnonce_description',
    'fieldName' => 'petiteAnnonce_description',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'text',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'petiteAnnonce_prix' => 
  array (
    'name' => 'petiteAnnonce_prix',
    'fieldName' => 'petiteAnnonce_prix',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'float',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'petiteAnnonce_prixInfo' => 
  array (
    'name' => 'petiteAnnonce_prixInfo',
    'fieldName' => 'petiteAnnonce_prixInfo',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'petiteAnnonce_contact' => 
  array (
    'name' => 'petiteAnnonce_contact',
    'fieldName' => 'petiteAnnonce_contact',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'petiteAnnonce_dateCreation' => 
  array (
    'name' => 'petiteAnnonce_dateCreation',
    'fieldName' => 'petiteAnnonce_dateCreation',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'petiteAnnonce_dateModification' => 
  array (
    'name' => 'petiteAnnonce_dateModification',
    'fieldName' => 'petiteAnnonce_dateModification',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'petiteAnnonce_affichage' => 
  array (
    'name' => 'petiteAnnonce_affichage',
    'fieldName' => 'petiteAnnonce_affichage',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'petiteAnnonce_publier' => 
  array (
    'name' => 'petiteAnnonce_publier',
    'fieldName' => 'petiteAnnonce_publier',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'petiteAnnonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
);
   public static $_pkFields = array('petiteAnnonce_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `petiteAnnonce`.`petiteAnnonce_id`'.'='.intval($petiteAnnonce_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `petiteAnnonce_id`'.'='.intval($petiteAnnonce_id).'';
}
public function insert ($record){
 if($record->petiteAnnonce_id > 0 ){
    $query = 'INSERT INTO `petiteAnnonce` (
`petiteAnnonce_id`,`petiteAnnonce_categorieAnId`,`petiteAnnonce_reference`,`petiteAnnonce_titre`,`petiteAnnonce_description`,`petiteAnnonce_prix`,`petiteAnnonce_prixInfo`,`petiteAnnonce_contact`,`petiteAnnonce_dateCreation`,`petiteAnnonce_dateModification`,`petiteAnnonce_affichage`,`petiteAnnonce_publier`
) VALUES (
'.intval($record->petiteAnnonce_id).', '.($record->petiteAnnonce_categorieAnId === null ? 'NULL' : intval($record->petiteAnnonce_categorieAnId)).', '.($record->petiteAnnonce_reference === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_reference,false)).', '.($record->petiteAnnonce_titre === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_titre,false)).', '.($record->petiteAnnonce_description === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_description,false)).', '.($record->petiteAnnonce_prix === null ? 'NULL' : doubleval($record->petiteAnnonce_prix)).', '.($record->petiteAnnonce_prixInfo === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_prixInfo,false)).', '.($record->petiteAnnonce_contact === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_contact,false)).', '.($record->petiteAnnonce_dateCreation === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_dateCreation,false)).', '.($record->petiteAnnonce_dateModification === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_dateModification,false)).', '.($record->petiteAnnonce_affichage === null ? 'NULL' : intval($record->petiteAnnonce_affichage)).', '.($record->petiteAnnonce_publier === null ? 'NULL' : intval($record->petiteAnnonce_publier)).'
)';
}else{
    $query = 'INSERT INTO `petiteAnnonce` (
`petiteAnnonce_categorieAnId`,`petiteAnnonce_reference`,`petiteAnnonce_titre`,`petiteAnnonce_description`,`petiteAnnonce_prix`,`petiteAnnonce_prixInfo`,`petiteAnnonce_contact`,`petiteAnnonce_dateCreation`,`petiteAnnonce_dateModification`,`petiteAnnonce_affichage`,`petiteAnnonce_publier`
) VALUES (
'.($record->petiteAnnonce_categorieAnId === null ? 'NULL' : intval($record->petiteAnnonce_categorieAnId)).', '.($record->petiteAnnonce_reference === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_reference,false)).', '.($record->petiteAnnonce_titre === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_titre,false)).', '.($record->petiteAnnonce_description === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_description,false)).', '.($record->petiteAnnonce_prix === null ? 'NULL' : doubleval($record->petiteAnnonce_prix)).', '.($record->petiteAnnonce_prixInfo === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_prixInfo,false)).', '.($record->petiteAnnonce_contact === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_contact,false)).', '.($record->petiteAnnonce_dateCreation === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_dateCreation,false)).', '.($record->petiteAnnonce_dateModification === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_dateModification,false)).', '.($record->petiteAnnonce_affichage === null ? 'NULL' : intval($record->petiteAnnonce_affichage)).', '.($record->petiteAnnonce_publier === null ? 'NULL' : intval($record->petiteAnnonce_publier)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->petiteAnnonce_id < 1  ) $record->petiteAnnonce_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `petiteAnnonce` SET 
 `petiteAnnonce_categorieAnId`= '.($record->petiteAnnonce_categorieAnId === null ? 'NULL' : intval($record->petiteAnnonce_categorieAnId)).', `petiteAnnonce_reference`= '.($record->petiteAnnonce_reference === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_reference,false)).', `petiteAnnonce_titre`= '.($record->petiteAnnonce_titre === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_titre,false)).', `petiteAnnonce_description`= '.($record->petiteAnnonce_description === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_description,false)).', `petiteAnnonce_prix`= '.($record->petiteAnnonce_prix === null ? 'NULL' : doubleval($record->petiteAnnonce_prix)).', `petiteAnnonce_prixInfo`= '.($record->petiteAnnonce_prixInfo === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_prixInfo,false)).', `petiteAnnonce_contact`= '.($record->petiteAnnonce_contact === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_contact,false)).', `petiteAnnonce_dateCreation`= '.($record->petiteAnnonce_dateCreation === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_dateCreation,false)).', `petiteAnnonce_dateModification`= '.($record->petiteAnnonce_dateModification === null ? 'NULL' : $this->_conn->quote($record->petiteAnnonce_dateModification,false)).', `petiteAnnonce_affichage`= '.($record->petiteAnnonce_affichage === null ? 'NULL' : intval($record->petiteAnnonce_affichage)).', `petiteAnnonce_publier`= '.($record->petiteAnnonce_publier === null ? 'NULL' : intval($record->petiteAnnonce_publier)).'
 where  `petiteAnnonce_id`'.'='.intval($record->petiteAnnonce_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>