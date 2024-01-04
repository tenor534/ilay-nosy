<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_profil_Jx_profil_Jx_mysql extends jDaoRecordBase {
 public $profil_id;
 public $profil_libelle;
 public $profil_code;
   public function getProperties() { return cDao_profil_Jx_profil_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_profil_Jx_profil_Jx_mysql::$_pkFields; }
}

class cDao_profil_Jx_profil_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'profil' => 
  array (
    'name' => 'profil',
    'realname' => 'profil',
    'pk' => 
    array (
      0 => 'profil_id',
    ),
    'fields' => 
    array (
      0 => 'profil_id',
      1 => 'profil_libelle',
      2 => 'profil_code',
    ),
  ),
);
   protected $_primaryTable = 'profil';
   protected $_selectClause='SELECT `profil`.`profil_id`, `profil`.`profil_libelle`, `profil`.`profil_code`';
   protected $_fromClause=' FROM `profil`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_profil_Jx_profil_Jx_mysql';
   public static $_properties = array (
  'profil_id' => 
  array (
    'name' => 'profil_id',
    'fieldName' => 'profil_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'profil',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'profil_libelle' => 
  array (
    'name' => 'profil_libelle',
    'fieldName' => 'profil_libelle',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => false,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'profil',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'profil_code' => 
  array (
    'name' => 'profil_code',
    'fieldName' => 'profil_code',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => false,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'profil',
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
   public static $_pkFields = array('profil_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `profil`.`profil_id`'.'='.intval($profil_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `profil_id`'.'='.intval($profil_id).'';
}
public function insert ($record){
 if($record->profil_id > 0 ){
    $query = 'INSERT INTO `profil` (
`profil_id`,`profil_libelle`,`profil_code`
) VALUES (
'.intval($record->profil_id).', '.($record->profil_libelle === null ? 'NULL' : $this->_conn->quote($record->profil_libelle,false)).', '.($record->profil_code === null ? 'NULL' : $this->_conn->quote($record->profil_code,false)).'
)';
}else{
    $query = 'INSERT INTO `profil` (
`profil_libelle`,`profil_code`
) VALUES (
'.($record->profil_libelle === null ? 'NULL' : $this->_conn->quote($record->profil_libelle,false)).', '.($record->profil_code === null ? 'NULL' : $this->_conn->quote($record->profil_code,false)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->profil_id < 1  ) $record->profil_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `profil` SET 
 `profil_libelle`= '.($record->profil_libelle === null ? 'NULL' : $this->_conn->quote($record->profil_libelle,false)).', `profil_code`= '.($record->profil_code === null ? 'NULL' : $this->_conn->quote($record->profil_code,false)).'
 where  `profil_id`'.'='.intval($record->profil_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>