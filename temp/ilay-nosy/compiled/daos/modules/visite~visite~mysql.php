<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_visite_Jx_visite_Jx_mysql extends jDaoRecordBase {
 public $visite_id;
 public $visite_serverSoftware;
 public $visite_serverName;
 public $visite_serverAddr;
 public $visite_serverPort;
 public $visite_remoteAddr;
 public $visite_remotePort;
 public $visite_httpRefferer;
 public $visite_httpUserAgent;
 public $visite_requestMethod;
 public $visite_requestUri;
 public $visite_phpSelf;
 public $visite_queryString;
 public $visite_date;
 public $visite_userId;
   public function getProperties() { return cDao_visite_Jx_visite_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_visite_Jx_visite_Jx_mysql::$_pkFields; }
}

class cDao_visite_Jx_visite_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'visite' => 
  array (
    'name' => 'visite',
    'realname' => 'visite',
    'pk' => 
    array (
      0 => 'visite_id',
    ),
    'fields' => 
    array (
      0 => 'visite_id',
      1 => 'visite_serverSoftware',
      2 => 'visite_serverName',
      3 => 'visite_serverAddr',
      4 => 'visite_serverPort',
      5 => 'visite_remoteAddr',
      6 => 'visite_remotePort',
      7 => 'visite_httpRefferer',
      8 => 'visite_httpUserAgent',
      9 => 'visite_requestMethod',
      10 => 'visite_requestUri',
      11 => 'visite_phpSelf',
      12 => 'visite_queryString',
      13 => 'visite_date',
      14 => 'visite_userId',
    ),
  ),
);
   protected $_primaryTable = 'visite';
   protected $_selectClause='SELECT `visite`.`visite_id`, `visite`.`visite_serverSoftware`, `visite`.`visite_serverName`, `visite`.`visite_serverAddr`, `visite`.`visite_serverPort`, `visite`.`visite_remoteAddr`, `visite`.`visite_remotePort`, `visite`.`visite_httpRefferer`, `visite`.`visite_httpUserAgent`, `visite`.`visite_requestMethod`, `visite`.`visite_requestUri`, `visite`.`visite_phpSelf`, `visite`.`visite_queryString`, `visite`.`visite_date`, `visite`.`visite_userId`';
   protected $_fromClause=' FROM `visite`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_visite_Jx_visite_Jx_mysql';
   public static $_properties = array (
  'visite_id' => 
  array (
    'name' => 'visite_id',
    'fieldName' => 'visite_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'visite_serverSoftware' => 
  array (
    'name' => 'visite_serverSoftware',
    'fieldName' => 'visite_serverSoftware',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_serverName' => 
  array (
    'name' => 'visite_serverName',
    'fieldName' => 'visite_serverName',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_serverAddr' => 
  array (
    'name' => 'visite_serverAddr',
    'fieldName' => 'visite_serverAddr',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_serverPort' => 
  array (
    'name' => 'visite_serverPort',
    'fieldName' => 'visite_serverPort',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_remoteAddr' => 
  array (
    'name' => 'visite_remoteAddr',
    'fieldName' => 'visite_remoteAddr',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_remotePort' => 
  array (
    'name' => 'visite_remotePort',
    'fieldName' => 'visite_remotePort',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_httpRefferer' => 
  array (
    'name' => 'visite_httpRefferer',
    'fieldName' => 'visite_httpRefferer',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_httpUserAgent' => 
  array (
    'name' => 'visite_httpUserAgent',
    'fieldName' => 'visite_httpUserAgent',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_requestMethod' => 
  array (
    'name' => 'visite_requestMethod',
    'fieldName' => 'visite_requestMethod',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_requestUri' => 
  array (
    'name' => 'visite_requestUri',
    'fieldName' => 'visite_requestUri',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_phpSelf' => 
  array (
    'name' => 'visite_phpSelf',
    'fieldName' => 'visite_phpSelf',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_queryString' => 
  array (
    'name' => 'visite_queryString',
    'fieldName' => 'visite_queryString',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_date' => 
  array (
    'name' => 'visite_date',
    'fieldName' => 'visite_date',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'visite',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'visite_userId' => 
  array (
    'name' => 'visite_userId',
    'fieldName' => 'visite_userId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'visite',
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
   public static $_pkFields = array('visite_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `visite`.`visite_id`'.'='.intval($visite_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `visite_id`'.'='.intval($visite_id).'';
}
public function insert ($record){
 if($record->visite_id > 0 ){
    $query = 'INSERT INTO `visite` (
`visite_id`,`visite_serverSoftware`,`visite_serverName`,`visite_serverAddr`,`visite_serverPort`,`visite_remoteAddr`,`visite_remotePort`,`visite_httpRefferer`,`visite_httpUserAgent`,`visite_requestMethod`,`visite_requestUri`,`visite_phpSelf`,`visite_queryString`,`visite_date`,`visite_userId`
) VALUES (
'.intval($record->visite_id).', '.($record->visite_serverSoftware === null ? 'NULL' : $this->_conn->quote($record->visite_serverSoftware,false)).', '.($record->visite_serverName === null ? 'NULL' : $this->_conn->quote($record->visite_serverName,false)).', '.($record->visite_serverAddr === null ? 'NULL' : $this->_conn->quote($record->visite_serverAddr,false)).', '.($record->visite_serverPort === null ? 'NULL' : $this->_conn->quote($record->visite_serverPort,false)).', '.($record->visite_remoteAddr === null ? 'NULL' : $this->_conn->quote($record->visite_remoteAddr,false)).', '.($record->visite_remotePort === null ? 'NULL' : $this->_conn->quote($record->visite_remotePort,false)).', '.($record->visite_httpRefferer === null ? 'NULL' : $this->_conn->quote($record->visite_httpRefferer,false)).', '.($record->visite_httpUserAgent === null ? 'NULL' : $this->_conn->quote($record->visite_httpUserAgent,false)).', '.($record->visite_requestMethod === null ? 'NULL' : $this->_conn->quote($record->visite_requestMethod,false)).', '.($record->visite_requestUri === null ? 'NULL' : $this->_conn->quote($record->visite_requestUri,false)).', '.($record->visite_phpSelf === null ? 'NULL' : $this->_conn->quote($record->visite_phpSelf,false)).', '.($record->visite_queryString === null ? 'NULL' : $this->_conn->quote($record->visite_queryString,false)).', '.($record->visite_date === null ? 'NULL' : $this->_conn->quote($record->visite_date,false)).', '.($record->visite_userId === null ? 'NULL' : intval($record->visite_userId)).'
)';
}else{
    $query = 'INSERT INTO `visite` (
`visite_serverSoftware`,`visite_serverName`,`visite_serverAddr`,`visite_serverPort`,`visite_remoteAddr`,`visite_remotePort`,`visite_httpRefferer`,`visite_httpUserAgent`,`visite_requestMethod`,`visite_requestUri`,`visite_phpSelf`,`visite_queryString`,`visite_date`,`visite_userId`
) VALUES (
'.($record->visite_serverSoftware === null ? 'NULL' : $this->_conn->quote($record->visite_serverSoftware,false)).', '.($record->visite_serverName === null ? 'NULL' : $this->_conn->quote($record->visite_serverName,false)).', '.($record->visite_serverAddr === null ? 'NULL' : $this->_conn->quote($record->visite_serverAddr,false)).', '.($record->visite_serverPort === null ? 'NULL' : $this->_conn->quote($record->visite_serverPort,false)).', '.($record->visite_remoteAddr === null ? 'NULL' : $this->_conn->quote($record->visite_remoteAddr,false)).', '.($record->visite_remotePort === null ? 'NULL' : $this->_conn->quote($record->visite_remotePort,false)).', '.($record->visite_httpRefferer === null ? 'NULL' : $this->_conn->quote($record->visite_httpRefferer,false)).', '.($record->visite_httpUserAgent === null ? 'NULL' : $this->_conn->quote($record->visite_httpUserAgent,false)).', '.($record->visite_requestMethod === null ? 'NULL' : $this->_conn->quote($record->visite_requestMethod,false)).', '.($record->visite_requestUri === null ? 'NULL' : $this->_conn->quote($record->visite_requestUri,false)).', '.($record->visite_phpSelf === null ? 'NULL' : $this->_conn->quote($record->visite_phpSelf,false)).', '.($record->visite_queryString === null ? 'NULL' : $this->_conn->quote($record->visite_queryString,false)).', '.($record->visite_date === null ? 'NULL' : $this->_conn->quote($record->visite_date,false)).', '.($record->visite_userId === null ? 'NULL' : intval($record->visite_userId)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->visite_id < 1  ) $record->visite_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `visite` SET 
 `visite_serverSoftware`= '.($record->visite_serverSoftware === null ? 'NULL' : $this->_conn->quote($record->visite_serverSoftware,false)).', `visite_serverName`= '.($record->visite_serverName === null ? 'NULL' : $this->_conn->quote($record->visite_serverName,false)).', `visite_serverAddr`= '.($record->visite_serverAddr === null ? 'NULL' : $this->_conn->quote($record->visite_serverAddr,false)).', `visite_serverPort`= '.($record->visite_serverPort === null ? 'NULL' : $this->_conn->quote($record->visite_serverPort,false)).', `visite_remoteAddr`= '.($record->visite_remoteAddr === null ? 'NULL' : $this->_conn->quote($record->visite_remoteAddr,false)).', `visite_remotePort`= '.($record->visite_remotePort === null ? 'NULL' : $this->_conn->quote($record->visite_remotePort,false)).', `visite_httpRefferer`= '.($record->visite_httpRefferer === null ? 'NULL' : $this->_conn->quote($record->visite_httpRefferer,false)).', `visite_httpUserAgent`= '.($record->visite_httpUserAgent === null ? 'NULL' : $this->_conn->quote($record->visite_httpUserAgent,false)).', `visite_requestMethod`= '.($record->visite_requestMethod === null ? 'NULL' : $this->_conn->quote($record->visite_requestMethod,false)).', `visite_requestUri`= '.($record->visite_requestUri === null ? 'NULL' : $this->_conn->quote($record->visite_requestUri,false)).', `visite_phpSelf`= '.($record->visite_phpSelf === null ? 'NULL' : $this->_conn->quote($record->visite_phpSelf,false)).', `visite_queryString`= '.($record->visite_queryString === null ? 'NULL' : $this->_conn->quote($record->visite_queryString,false)).', `visite_date`= '.($record->visite_date === null ? 'NULL' : $this->_conn->quote($record->visite_date,false)).', `visite_userId`= '.($record->visite_userId === null ? 'NULL' : intval($record->visite_userId)).'
 where  `visite_id`'.'='.intval($record->visite_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>