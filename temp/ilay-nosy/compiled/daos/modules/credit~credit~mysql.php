<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_credit_Jx_credit_Jx_mysql extends jDaoRecordBase {
 public $credit_id;
 public $credit_abonnementId;
 public $credit_forfaitId;
 public $credit_isPlus;
 public $credit_codePIN;
 public $credit_password;
 public $credit_dateUse;
   public function getProperties() { return cDao_credit_Jx_credit_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_credit_Jx_credit_Jx_mysql::$_pkFields; }
}

class cDao_credit_Jx_credit_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'credit' => 
  array (
    'name' => 'credit',
    'realname' => 'credit',
    'pk' => 
    array (
      0 => 'credit_id',
    ),
    'fields' => 
    array (
      0 => 'credit_id',
      1 => 'credit_abonnementId',
      2 => 'credit_forfaitId',
      3 => 'credit_isPlus',
      4 => 'credit_codePIN',
      5 => 'credit_password',
      6 => 'credit_dateUse',
    ),
  ),
);
   protected $_primaryTable = 'credit';
   protected $_selectClause='SELECT `credit`.`credit_id`, `credit`.`credit_abonnementId`, `credit`.`credit_forfaitId`, `credit`.`credit_isPlus`, `credit`.`credit_codePIN`, `credit`.`credit_password`, `credit`.`credit_dateUse`';
   protected $_fromClause=' FROM `credit`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_credit_Jx_credit_Jx_mysql';
   public static $_properties = array (
  'credit_id' => 
  array (
    'name' => 'credit_id',
    'fieldName' => 'credit_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'credit',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'credit_abonnementId' => 
  array (
    'name' => 'credit_abonnementId',
    'fieldName' => 'credit_abonnementId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'credit',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'credit_forfaitId' => 
  array (
    'name' => 'credit_forfaitId',
    'fieldName' => 'credit_forfaitId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'credit',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'credit_isPlus' => 
  array (
    'name' => 'credit_isPlus',
    'fieldName' => 'credit_isPlus',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'credit',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'credit_codePIN' => 
  array (
    'name' => 'credit_codePIN',
    'fieldName' => 'credit_codePIN',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'credit',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'credit_password' => 
  array (
    'name' => 'credit_password',
    'fieldName' => 'credit_password',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'credit',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'credit_dateUse' => 
  array (
    'name' => 'credit_dateUse',
    'fieldName' => 'credit_dateUse',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'datetime',
    'table' => 'credit',
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
   public static $_pkFields = array('credit_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `credit`.`credit_id`'.'='.intval($credit_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `credit_id`'.'='.intval($credit_id).'';
}
public function insert ($record){
 if($record->credit_id > 0 ){
    $query = 'INSERT INTO `credit` (
`credit_id`,`credit_abonnementId`,`credit_forfaitId`,`credit_isPlus`,`credit_codePIN`,`credit_password`,`credit_dateUse`
) VALUES (
'.intval($record->credit_id).', '.($record->credit_abonnementId === null ? 'NULL' : intval($record->credit_abonnementId)).', '.($record->credit_forfaitId === null ? 'NULL' : intval($record->credit_forfaitId)).', '.($record->credit_isPlus === null ? 'NULL' : intval($record->credit_isPlus)).', '.($record->credit_codePIN === null ? 'NULL' : $this->_conn->quote($record->credit_codePIN,false)).', '.($record->credit_password === null ? 'NULL' : $this->_conn->quote($record->credit_password,false)).', '.($record->credit_dateUse === null ? 'NULL' : $this->_conn->quote($record->credit_dateUse,false)).'
)';
}else{
    $query = 'INSERT INTO `credit` (
`credit_abonnementId`,`credit_forfaitId`,`credit_isPlus`,`credit_codePIN`,`credit_password`,`credit_dateUse`
) VALUES (
'.($record->credit_abonnementId === null ? 'NULL' : intval($record->credit_abonnementId)).', '.($record->credit_forfaitId === null ? 'NULL' : intval($record->credit_forfaitId)).', '.($record->credit_isPlus === null ? 'NULL' : intval($record->credit_isPlus)).', '.($record->credit_codePIN === null ? 'NULL' : $this->_conn->quote($record->credit_codePIN,false)).', '.($record->credit_password === null ? 'NULL' : $this->_conn->quote($record->credit_password,false)).', '.($record->credit_dateUse === null ? 'NULL' : $this->_conn->quote($record->credit_dateUse,false)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->credit_id < 1  ) $record->credit_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `credit` SET 
 `credit_abonnementId`= '.($record->credit_abonnementId === null ? 'NULL' : intval($record->credit_abonnementId)).', `credit_forfaitId`= '.($record->credit_forfaitId === null ? 'NULL' : intval($record->credit_forfaitId)).', `credit_isPlus`= '.($record->credit_isPlus === null ? 'NULL' : intval($record->credit_isPlus)).', `credit_codePIN`= '.($record->credit_codePIN === null ? 'NULL' : $this->_conn->quote($record->credit_codePIN,false)).', `credit_password`= '.($record->credit_password === null ? 'NULL' : $this->_conn->quote($record->credit_password,false)).', `credit_dateUse`= '.($record->credit_dateUse === null ? 'NULL' : $this->_conn->quote($record->credit_dateUse,false)).'
 where  `credit_id`'.'='.intval($record->credit_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>