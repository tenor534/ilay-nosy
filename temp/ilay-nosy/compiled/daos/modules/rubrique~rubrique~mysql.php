<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_rubrique_Jx_rubrique_Jx_mysql extends jDaoRecordBase {
 public $rubrique_id;
 public $rubrique_parentId;
 public $rubrique_categorieAnId;
 public $rubrique_level;
 public $rubrique_path;
 public $rubrique_libelle;
 public $rubrique_code;
 public $rubrique_sortCode;
   public function getProperties() { return cDao_rubrique_Jx_rubrique_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_rubrique_Jx_rubrique_Jx_mysql::$_pkFields; }
}

class cDao_rubrique_Jx_rubrique_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'rubrique' => 
  array (
    'name' => 'rubrique',
    'realname' => 'rubrique',
    'pk' => 
    array (
      0 => 'rubrique_id',
    ),
    'fields' => 
    array (
      0 => 'rubrique_id',
      1 => 'rubrique_parentId',
      2 => 'rubrique_categorieAnId',
      3 => 'rubrique_level',
      4 => 'rubrique_path',
      5 => 'rubrique_libelle',
      6 => 'rubrique_code',
      7 => 'rubrique_sortCode',
    ),
  ),
);
   protected $_primaryTable = 'rubrique';
   protected $_selectClause='SELECT `rubrique`.`rubrique_id`, `rubrique`.`rubrique_parentId`, `rubrique`.`rubrique_categorieAnId`, `rubrique`.`rubrique_level`, `rubrique`.`rubrique_path`, `rubrique`.`rubrique_libelle`, `rubrique`.`rubrique_code`, `rubrique`.`rubrique_sortCode`';
   protected $_fromClause=' FROM `rubrique`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_rubrique_Jx_rubrique_Jx_mysql';
   public static $_properties = array (
  'rubrique_id' => 
  array (
    'name' => 'rubrique_id',
    'fieldName' => 'rubrique_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'rubrique',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'rubrique_parentId' => 
  array (
    'name' => 'rubrique_parentId',
    'fieldName' => 'rubrique_parentId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'rubrique',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'rubrique_categorieAnId' => 
  array (
    'name' => 'rubrique_categorieAnId',
    'fieldName' => 'rubrique_categorieAnId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'rubrique',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'rubrique_level' => 
  array (
    'name' => 'rubrique_level',
    'fieldName' => 'rubrique_level',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'rubrique',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'rubrique_path' => 
  array (
    'name' => 'rubrique_path',
    'fieldName' => 'rubrique_path',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'rubrique',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'rubrique_libelle' => 
  array (
    'name' => 'rubrique_libelle',
    'fieldName' => 'rubrique_libelle',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'rubrique',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'rubrique_code' => 
  array (
    'name' => 'rubrique_code',
    'fieldName' => 'rubrique_code',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'rubrique',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'rubrique_sortCode' => 
  array (
    'name' => 'rubrique_sortCode',
    'fieldName' => 'rubrique_sortCode',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'rubrique',
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
   public static $_pkFields = array('rubrique_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `rubrique`.`rubrique_id`'.'='.intval($rubrique_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `rubrique_id`'.'='.intval($rubrique_id).'';
}
public function insert ($record){
 if($record->rubrique_id > 0 ){
    $query = 'INSERT INTO `rubrique` (
`rubrique_id`,`rubrique_parentId`,`rubrique_categorieAnId`,`rubrique_level`,`rubrique_path`,`rubrique_libelle`,`rubrique_code`,`rubrique_sortCode`
) VALUES (
'.intval($record->rubrique_id).', '.($record->rubrique_parentId === null ? 'NULL' : intval($record->rubrique_parentId)).', '.($record->rubrique_categorieAnId === null ? 'NULL' : intval($record->rubrique_categorieAnId)).', '.($record->rubrique_level === null ? 'NULL' : intval($record->rubrique_level)).', '.($record->rubrique_path === null ? 'NULL' : $this->_conn->quote($record->rubrique_path,false)).', '.($record->rubrique_libelle === null ? 'NULL' : $this->_conn->quote($record->rubrique_libelle,false)).', '.($record->rubrique_code === null ? 'NULL' : $this->_conn->quote($record->rubrique_code,false)).', '.($record->rubrique_sortCode === null ? 'NULL' : $this->_conn->quote($record->rubrique_sortCode,false)).'
)';
}else{
    $query = 'INSERT INTO `rubrique` (
`rubrique_parentId`,`rubrique_categorieAnId`,`rubrique_level`,`rubrique_path`,`rubrique_libelle`,`rubrique_code`,`rubrique_sortCode`
) VALUES (
'.($record->rubrique_parentId === null ? 'NULL' : intval($record->rubrique_parentId)).', '.($record->rubrique_categorieAnId === null ? 'NULL' : intval($record->rubrique_categorieAnId)).', '.($record->rubrique_level === null ? 'NULL' : intval($record->rubrique_level)).', '.($record->rubrique_path === null ? 'NULL' : $this->_conn->quote($record->rubrique_path,false)).', '.($record->rubrique_libelle === null ? 'NULL' : $this->_conn->quote($record->rubrique_libelle,false)).', '.($record->rubrique_code === null ? 'NULL' : $this->_conn->quote($record->rubrique_code,false)).', '.($record->rubrique_sortCode === null ? 'NULL' : $this->_conn->quote($record->rubrique_sortCode,false)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->rubrique_id < 1  ) $record->rubrique_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `rubrique` SET 
 `rubrique_parentId`= '.($record->rubrique_parentId === null ? 'NULL' : intval($record->rubrique_parentId)).', `rubrique_categorieAnId`= '.($record->rubrique_categorieAnId === null ? 'NULL' : intval($record->rubrique_categorieAnId)).', `rubrique_level`= '.($record->rubrique_level === null ? 'NULL' : intval($record->rubrique_level)).', `rubrique_path`= '.($record->rubrique_path === null ? 'NULL' : $this->_conn->quote($record->rubrique_path,false)).', `rubrique_libelle`= '.($record->rubrique_libelle === null ? 'NULL' : $this->_conn->quote($record->rubrique_libelle,false)).', `rubrique_code`= '.($record->rubrique_code === null ? 'NULL' : $this->_conn->quote($record->rubrique_code,false)).', `rubrique_sortCode`= '.($record->rubrique_sortCode === null ? 'NULL' : $this->_conn->quote($record->rubrique_sortCode,false)).'
 where  `rubrique_id`'.'='.intval($record->rubrique_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>