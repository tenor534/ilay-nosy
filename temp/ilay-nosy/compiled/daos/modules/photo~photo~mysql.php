<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_photo_Jx_photo_Jx_mysql extends jDaoRecordBase {
 public $photo_id;
 public $photo_annonceId;
 public $photo_photo;
   public function getProperties() { return cDao_photo_Jx_photo_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_photo_Jx_photo_Jx_mysql::$_pkFields; }
}

class cDao_photo_Jx_photo_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'photo' => 
  array (
    'name' => 'photo',
    'realname' => 'photo',
    'pk' => 
    array (
      0 => 'photo_id',
    ),
    'fields' => 
    array (
      0 => 'photo_id',
      1 => 'photo_annonceId',
      2 => 'photo_photo',
    ),
  ),
);
   protected $_primaryTable = 'photo';
   protected $_selectClause='SELECT `photo`.`photo_id`, `photo`.`photo_annonceId`, `photo`.`photo_photo`';
   protected $_fromClause=' FROM `photo`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_photo_Jx_photo_Jx_mysql';
   public static $_properties = array (
  'photo_id' => 
  array (
    'name' => 'photo_id',
    'fieldName' => 'photo_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'photo',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'photo_annonceId' => 
  array (
    'name' => 'photo_annonceId',
    'fieldName' => 'photo_annonceId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'photo',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'photo_photo' => 
  array (
    'name' => 'photo_photo',
    'fieldName' => 'photo_photo',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'photo',
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
   public static $_pkFields = array('photo_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `photo`.`photo_id`'.'='.intval($photo_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `photo_id`'.'='.intval($photo_id).'';
}
public function insert ($record){
 if($record->photo_id > 0 ){
    $query = 'INSERT INTO `photo` (
`photo_id`,`photo_annonceId`,`photo_photo`
) VALUES (
'.intval($record->photo_id).', '.($record->photo_annonceId === null ? 'NULL' : intval($record->photo_annonceId)).', '.($record->photo_photo === null ? 'NULL' : $this->_conn->quote($record->photo_photo,false)).'
)';
}else{
    $query = 'INSERT INTO `photo` (
`photo_annonceId`,`photo_photo`
) VALUES (
'.($record->photo_annonceId === null ? 'NULL' : intval($record->photo_annonceId)).', '.($record->photo_photo === null ? 'NULL' : $this->_conn->quote($record->photo_photo,false)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->photo_id < 1  ) $record->photo_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `photo` SET 
 `photo_annonceId`= '.($record->photo_annonceId === null ? 'NULL' : intval($record->photo_annonceId)).', `photo_photo`= '.($record->photo_photo === null ? 'NULL' : $this->_conn->quote($record->photo_photo,false)).'
 where  `photo_id`'.'='.intval($record->photo_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>