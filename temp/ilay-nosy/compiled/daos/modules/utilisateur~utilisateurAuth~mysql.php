<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_utilisateur_Jx_utilisateurAuth_Jx_mysql extends jDaoRecordBase {
 public $id;
 public $profilId;
 public $nom;
 public $prenom;
 public $email;
 public $login;
 public $password;
 public $statut;
   public function getProperties() { return cDao_utilisateur_Jx_utilisateurAuth_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_utilisateur_Jx_utilisateurAuth_Jx_mysql::$_pkFields; }
}

class cDao_utilisateur_Jx_utilisateurAuth_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'utilisateur' => 
  array (
    'name' => 'utilisateur',
    'realname' => 'utilisateur',
    'pk' => 
    array (
      0 => 'utilisateur_id',
    ),
    'fields' => 
    array (
      0 => 'id',
      1 => 'profilId',
      2 => 'nom',
      3 => 'prenom',
      4 => 'email',
      5 => 'login',
      6 => 'password',
      7 => 'statut',
    ),
  ),
);
   protected $_primaryTable = 'utilisateur';
   protected $_selectClause='SELECT `utilisateur`.`utilisateur_id` as `id`, `utilisateur`.`utilisateur_profilId` as `profilId`, `utilisateur`.`utilisateur_nom` as `nom`, `utilisateur`.`utilisateur_prenom` as `prenom`, `utilisateur`.`utilisateur_email` as `email`, `utilisateur`.`utilisateur_login` as `login`, `utilisateur`.`utilisateur_password` as `password`, `utilisateur`.`utilisateur_statut` as `statut`';
   protected $_fromClause=' FROM `utilisateur`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_utilisateur_Jx_utilisateurAuth_Jx_mysql';
   public static $_properties = array (
  'id' => 
  array (
    'name' => 'id',
    'fieldName' => 'utilisateur_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'utilisateur',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'profilId' => 
  array (
    'name' => 'profilId',
    'fieldName' => 'utilisateur_profilId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'utilisateur',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'nom' => 
  array (
    'name' => 'nom',
    'fieldName' => 'utilisateur_nom',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'utilisateur',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'prenom' => 
  array (
    'name' => 'prenom',
    'fieldName' => 'utilisateur_prenom',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'utilisateur',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'email' => 
  array (
    'name' => 'email',
    'fieldName' => 'utilisateur_email',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'utilisateur',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'login' => 
  array (
    'name' => 'login',
    'fieldName' => 'utilisateur_login',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'utilisateur',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'password' => 
  array (
    'name' => 'password',
    'fieldName' => 'utilisateur_password',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => false,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'utilisateur',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'statut' => 
  array (
    'name' => 'statut',
    'fieldName' => 'utilisateur_statut',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'utilisateur',
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
   public static $_pkFields = array('id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `utilisateur`.`utilisateur_id`'.'='.intval($id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `utilisateur_id`'.'='.intval($id).'';
}
public function insert ($record){
 if($record->id > 0 ){
    $query = 'INSERT INTO `utilisateur` (
`utilisateur_id`,`utilisateur_profilId`,`utilisateur_nom`,`utilisateur_prenom`,`utilisateur_email`,`utilisateur_login`,`utilisateur_password`,`utilisateur_statut`
) VALUES (
'.intval($record->id).', '.($record->profilId === null ? 'NULL' : intval($record->profilId)).', '.($record->nom === null ? 'NULL' : $this->_conn->quote($record->nom,false)).', '.($record->prenom === null ? 'NULL' : $this->_conn->quote($record->prenom,false)).', '.($record->email === null ? 'NULL' : $this->_conn->quote($record->email,false)).', '.($record->login === null ? 'NULL' : $this->_conn->quote($record->login,false)).', '.($record->password === null ? 'NULL' : $this->_conn->quote($record->password,false)).', '.($record->statut === null ? 'NULL' : intval($record->statut)).'
)';
}else{
    $query = 'INSERT INTO `utilisateur` (
`utilisateur_profilId`,`utilisateur_nom`,`utilisateur_prenom`,`utilisateur_email`,`utilisateur_login`,`utilisateur_password`,`utilisateur_statut`
) VALUES (
'.($record->profilId === null ? 'NULL' : intval($record->profilId)).', '.($record->nom === null ? 'NULL' : $this->_conn->quote($record->nom,false)).', '.($record->prenom === null ? 'NULL' : $this->_conn->quote($record->prenom,false)).', '.($record->email === null ? 'NULL' : $this->_conn->quote($record->email,false)).', '.($record->login === null ? 'NULL' : $this->_conn->quote($record->login,false)).', '.($record->password === null ? 'NULL' : $this->_conn->quote($record->password,false)).', '.($record->statut === null ? 'NULL' : intval($record->statut)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->id < 1  ) $record->id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `utilisateur` SET 
 `utilisateur_profilId`= '.($record->profilId === null ? 'NULL' : intval($record->profilId)).', `utilisateur_nom`= '.($record->nom === null ? 'NULL' : $this->_conn->quote($record->nom,false)).', `utilisateur_prenom`= '.($record->prenom === null ? 'NULL' : $this->_conn->quote($record->prenom,false)).', `utilisateur_email`= '.($record->email === null ? 'NULL' : $this->_conn->quote($record->email,false)).', `utilisateur_login`= '.($record->login === null ? 'NULL' : $this->_conn->quote($record->login,false)).', `utilisateur_password`= '.($record->password === null ? 'NULL' : $this->_conn->quote($record->password,false)).', `utilisateur_statut`= '.($record->statut === null ? 'NULL' : intval($record->statut)).'
 where  `utilisateur_id`'.'='.intval($record->id).'
';
   return $this->_conn->exec ($query);
 }
 function getByLoginPassword ($login, $password){
    $__query =  $this->_selectClause.$this->_fromClause.$this->_whereClause;
$__query .=' WHERE  `utilisateur`.`utilisateur_login` '.'='.$this->_conn->quote($login).' AND `utilisateur`.`utilisateur_password` '.($password === null ? 'IS NULL' : '='.$this->_conn->quote($password,false)).'';
    $__rs = $this->_conn->limitQuery($__query,0,1);
    $__rs->setFetchMode(8,'cDaoRecord_utilisateur_Jx_utilisateurAuth_Jx_mysql');
    return $__rs->fetch();
}
 function getByLogin ($login){
    $__query =  $this->_selectClause.$this->_fromClause.$this->_whereClause;
$__query .=' WHERE  `utilisateur`.`utilisateur_login` '.'='.$this->_conn->quote($login).'';
    $__rs = $this->_conn->limitQuery($__query,0,1);
    $__rs->setFetchMode(8,'cDaoRecord_utilisateur_Jx_utilisateurAuth_Jx_mysql');
    return $__rs->fetch();
}
 function updatePassword ($login, $password){
    $__query = 'UPDATE `utilisateur` SET 
 `utilisateur_password`= '.$this->_conn->quote($password).'';
$__query .=' WHERE  `utilisateur_login` '.'='.$this->_conn->quote($login).'';
    return $this->_conn->exec ($__query);
}
 function deleteByLogin ($login){
    $__query = 'DELETE FROM `utilisateur` ';
$__query .=' WHERE  `utilisateur_login` '.'='.$this->_conn->quote($login).'';
    return $this->_conn->exec ($__query);
}
 function findByLogin ($pattern){
    $__query =  $this->_selectClause.$this->_fromClause.$this->_whereClause;
$__query .=' WHERE  `utilisateur`.`utilisateur_login` '.'LIKE'.$this->_conn->quote($pattern).' ORDER BY `utilisateur`.`utilisateur_login` asc';
    $__rs = $this->_conn->query($__query);
    $__rs->setFetchMode(8,'cDaoRecord_utilisateur_Jx_utilisateurAuth_Jx_mysql');
    return $__rs;
}
 function findAll (){
    $__query =  $this->_selectClause.$this->_fromClause.$this->_whereClause;
$__query .=' WHERE   1=1  ORDER BY `utilisateur`.`utilisateur_login` asc';
    $__rs = $this->_conn->query($__query);
    $__rs->setFetchMode(8,'cDaoRecord_utilisateur_Jx_utilisateurAuth_Jx_mysql');
    return $__rs;
}
}
?>