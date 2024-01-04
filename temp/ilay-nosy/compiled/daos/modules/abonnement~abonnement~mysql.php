<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_abonnement_Jx_abonnement_Jx_mysql extends jDaoRecordBase {
 public $abonnement_id;
 public $abonnement_utilisateurId;
 public $abonnement_forfaitId;
 public $abonnement_reference;
 public $abonnement_dateDebut;
 public $abonnement_dateFin;
 public $abonnement_dateCreation;
 public $abonnement_credit;
 public $abonnement_creditPlus;
 public $abonnement_nbPlus;
 public $abonnement_statut;
   public function getProperties() { return cDao_abonnement_Jx_abonnement_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_abonnement_Jx_abonnement_Jx_mysql::$_pkFields; }
}

class cDao_abonnement_Jx_abonnement_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'abonnement' => 
  array (
    'name' => 'abonnement',
    'realname' => 'abonnement',
    'pk' => 
    array (
      0 => 'abonnement_id',
    ),
    'fields' => 
    array (
      0 => 'abonnement_id',
      1 => 'abonnement_utilisateurId',
      2 => 'abonnement_forfaitId',
      3 => 'abonnement_reference',
      4 => 'abonnement_dateDebut',
      5 => 'abonnement_dateFin',
      6 => 'abonnement_dateCreation',
      7 => 'abonnement_credit',
      8 => 'abonnement_creditPlus',
      9 => 'abonnement_nbPlus',
      10 => 'abonnement_statut',
    ),
  ),
);
   protected $_primaryTable = 'abonnement';
   protected $_selectClause='SELECT `abonnement`.`abonnement_id`, `abonnement`.`abonnement_utilisateurId`, `abonnement`.`abonnement_forfaitId`, `abonnement`.`abonnement_reference`, `abonnement`.`abonnement_dateDebut`, `abonnement`.`abonnement_dateFin`, `abonnement`.`abonnement_dateCreation`, `abonnement`.`abonnement_credit`, `abonnement`.`abonnement_creditPlus`, `abonnement`.`abonnement_nbPlus`, `abonnement`.`abonnement_statut`';
   protected $_fromClause=' FROM `abonnement`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_abonnement_Jx_abonnement_Jx_mysql';
   public static $_properties = array (
  'abonnement_id' => 
  array (
    'name' => 'abonnement_id',
    'fieldName' => 'abonnement_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'abonnement',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'abonnement_utilisateurId' => 
  array (
    'name' => 'abonnement_utilisateurId',
    'fieldName' => 'abonnement_utilisateurId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'abonnement',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'abonnement_forfaitId' => 
  array (
    'name' => 'abonnement_forfaitId',
    'fieldName' => 'abonnement_forfaitId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'abonnement',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'abonnement_reference' => 
  array (
    'name' => 'abonnement_reference',
    'fieldName' => 'abonnement_reference',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'abonnement',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'abonnement_dateDebut' => 
  array (
    'name' => 'abonnement_dateDebut',
    'fieldName' => 'abonnement_dateDebut',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'abonnement',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'abonnement_dateFin' => 
  array (
    'name' => 'abonnement_dateFin',
    'fieldName' => 'abonnement_dateFin',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'abonnement',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'abonnement_dateCreation' => 
  array (
    'name' => 'abonnement_dateCreation',
    'fieldName' => 'abonnement_dateCreation',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'abonnement',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'abonnement_credit' => 
  array (
    'name' => 'abonnement_credit',
    'fieldName' => 'abonnement_credit',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'abonnement',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'abonnement_creditPlus' => 
  array (
    'name' => 'abonnement_creditPlus',
    'fieldName' => 'abonnement_creditPlus',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'abonnement',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'abonnement_nbPlus' => 
  array (
    'name' => 'abonnement_nbPlus',
    'fieldName' => 'abonnement_nbPlus',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'abonnement',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'abonnement_statut' => 
  array (
    'name' => 'abonnement_statut',
    'fieldName' => 'abonnement_statut',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'abonnement',
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
   public static $_pkFields = array('abonnement_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `abonnement`.`abonnement_id`'.'='.intval($abonnement_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `abonnement_id`'.'='.intval($abonnement_id).'';
}
public function insert ($record){
 if($record->abonnement_id > 0 ){
    $query = 'INSERT INTO `abonnement` (
`abonnement_id`,`abonnement_utilisateurId`,`abonnement_forfaitId`,`abonnement_reference`,`abonnement_dateDebut`,`abonnement_dateFin`,`abonnement_dateCreation`,`abonnement_credit`,`abonnement_creditPlus`,`abonnement_nbPlus`,`abonnement_statut`
) VALUES (
'.intval($record->abonnement_id).', '.($record->abonnement_utilisateurId === null ? 'NULL' : intval($record->abonnement_utilisateurId)).', '.($record->abonnement_forfaitId === null ? 'NULL' : intval($record->abonnement_forfaitId)).', '.($record->abonnement_reference === null ? 'NULL' : $this->_conn->quote($record->abonnement_reference,false)).', '.($record->abonnement_dateDebut === null ? 'NULL' : $this->_conn->quote($record->abonnement_dateDebut,false)).', '.($record->abonnement_dateFin === null ? 'NULL' : $this->_conn->quote($record->abonnement_dateFin,false)).', '.($record->abonnement_dateCreation === null ? 'NULL' : $this->_conn->quote($record->abonnement_dateCreation,false)).', '.($record->abonnement_credit === null ? 'NULL' : intval($record->abonnement_credit)).', '.($record->abonnement_creditPlus === null ? 'NULL' : intval($record->abonnement_creditPlus)).', '.($record->abonnement_nbPlus === null ? 'NULL' : intval($record->abonnement_nbPlus)).', '.($record->abonnement_statut === null ? 'NULL' : intval($record->abonnement_statut)).'
)';
}else{
    $query = 'INSERT INTO `abonnement` (
`abonnement_utilisateurId`,`abonnement_forfaitId`,`abonnement_reference`,`abonnement_dateDebut`,`abonnement_dateFin`,`abonnement_dateCreation`,`abonnement_credit`,`abonnement_creditPlus`,`abonnement_nbPlus`,`abonnement_statut`
) VALUES (
'.($record->abonnement_utilisateurId === null ? 'NULL' : intval($record->abonnement_utilisateurId)).', '.($record->abonnement_forfaitId === null ? 'NULL' : intval($record->abonnement_forfaitId)).', '.($record->abonnement_reference === null ? 'NULL' : $this->_conn->quote($record->abonnement_reference,false)).', '.($record->abonnement_dateDebut === null ? 'NULL' : $this->_conn->quote($record->abonnement_dateDebut,false)).', '.($record->abonnement_dateFin === null ? 'NULL' : $this->_conn->quote($record->abonnement_dateFin,false)).', '.($record->abonnement_dateCreation === null ? 'NULL' : $this->_conn->quote($record->abonnement_dateCreation,false)).', '.($record->abonnement_credit === null ? 'NULL' : intval($record->abonnement_credit)).', '.($record->abonnement_creditPlus === null ? 'NULL' : intval($record->abonnement_creditPlus)).', '.($record->abonnement_nbPlus === null ? 'NULL' : intval($record->abonnement_nbPlus)).', '.($record->abonnement_statut === null ? 'NULL' : intval($record->abonnement_statut)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->abonnement_id < 1  ) $record->abonnement_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `abonnement` SET 
 `abonnement_utilisateurId`= '.($record->abonnement_utilisateurId === null ? 'NULL' : intval($record->abonnement_utilisateurId)).', `abonnement_forfaitId`= '.($record->abonnement_forfaitId === null ? 'NULL' : intval($record->abonnement_forfaitId)).', `abonnement_reference`= '.($record->abonnement_reference === null ? 'NULL' : $this->_conn->quote($record->abonnement_reference,false)).', `abonnement_dateDebut`= '.($record->abonnement_dateDebut === null ? 'NULL' : $this->_conn->quote($record->abonnement_dateDebut,false)).', `abonnement_dateFin`= '.($record->abonnement_dateFin === null ? 'NULL' : $this->_conn->quote($record->abonnement_dateFin,false)).', `abonnement_dateCreation`= '.($record->abonnement_dateCreation === null ? 'NULL' : $this->_conn->quote($record->abonnement_dateCreation,false)).', `abonnement_credit`= '.($record->abonnement_credit === null ? 'NULL' : intval($record->abonnement_credit)).', `abonnement_creditPlus`= '.($record->abonnement_creditPlus === null ? 'NULL' : intval($record->abonnement_creditPlus)).', `abonnement_nbPlus`= '.($record->abonnement_nbPlus === null ? 'NULL' : intval($record->abonnement_nbPlus)).', `abonnement_statut`= '.($record->abonnement_statut === null ? 'NULL' : intval($record->abonnement_statut)).'
 where  `abonnement_id`'.'='.intval($record->abonnement_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>