<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_utilisateur_Jx_utilisateur_Jx_mysql extends jDaoRecordBase {
 public $utilisateur_id;
 public $utilisateur_paysId;
 public $utilisateur_profilId;
 public $utilisateur_nom;
 public $utilisateur_prenom;
 public $utilisateur_civilite;
 public $utilisateur_dateNaissance;
 public $utilisateur_adresse;
 public $utilisateur_cp;
 public $utilisateur_ville;
 public $utilisateur_fonction;
 public $utilisateur_societe;
 public $utilisateur_telephone;
 public $utilisateur_email;
 public $utilisateur_login;
 public $utilisateur_password;
 public $utilisateur_dateCreation;
 public $utilisateur_dateModification;
 public $utilisateur_statut;
 public $utilisateur_question;
 public $utilisateur_reponse;
 public $utilisateur_photo;
 public $utilisateur_url;
   public function getProperties() { return cDao_utilisateur_Jx_utilisateur_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_utilisateur_Jx_utilisateur_Jx_mysql::$_pkFields; }
}

class cDao_utilisateur_Jx_utilisateur_Jx_mysql extends jDaoFactoryBase {
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
      0 => 'utilisateur_id',
      1 => 'utilisateur_paysId',
      2 => 'utilisateur_profilId',
      3 => 'utilisateur_nom',
      4 => 'utilisateur_prenom',
      5 => 'utilisateur_civilite',
      6 => 'utilisateur_dateNaissance',
      7 => 'utilisateur_adresse',
      8 => 'utilisateur_cp',
      9 => 'utilisateur_ville',
      10 => 'utilisateur_fonction',
      11 => 'utilisateur_societe',
      12 => 'utilisateur_telephone',
      13 => 'utilisateur_email',
      14 => 'utilisateur_login',
      15 => 'utilisateur_password',
      16 => 'utilisateur_dateCreation',
      17 => 'utilisateur_dateModification',
      18 => 'utilisateur_statut',
      19 => 'utilisateur_question',
      20 => 'utilisateur_reponse',
      21 => 'utilisateur_photo',
      22 => 'utilisateur_url',
    ),
  ),
);
   protected $_primaryTable = 'utilisateur';
   protected $_selectClause='SELECT `utilisateur`.`utilisateur_id`, `utilisateur`.`utilisateur_paysId`, `utilisateur`.`utilisateur_profilId`, `utilisateur`.`utilisateur_nom`, `utilisateur`.`utilisateur_prenom`, `utilisateur`.`utilisateur_civilite`, `utilisateur`.`utilisateur_dateNaissance`, `utilisateur`.`utilisateur_adresse`, `utilisateur`.`utilisateur_cp`, `utilisateur`.`utilisateur_ville`, `utilisateur`.`utilisateur_fonction`, `utilisateur`.`utilisateur_societe`, `utilisateur`.`utilisateur_telephone`, `utilisateur`.`utilisateur_email`, `utilisateur`.`utilisateur_login`, `utilisateur`.`utilisateur_password`, `utilisateur`.`utilisateur_dateCreation`, `utilisateur`.`utilisateur_dateModification`, `utilisateur`.`utilisateur_statut`, `utilisateur`.`utilisateur_question`, `utilisateur`.`utilisateur_reponse`, `utilisateur`.`utilisateur_photo`, `utilisateur`.`utilisateur_url`';
   protected $_fromClause=' FROM `utilisateur`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_utilisateur_Jx_utilisateur_Jx_mysql';
   public static $_properties = array (
  'utilisateur_id' => 
  array (
    'name' => 'utilisateur_id',
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
  'utilisateur_paysId' => 
  array (
    'name' => 'utilisateur_paysId',
    'fieldName' => 'utilisateur_paysId',
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
  'utilisateur_profilId' => 
  array (
    'name' => 'utilisateur_profilId',
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
  'utilisateur_nom' => 
  array (
    'name' => 'utilisateur_nom',
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
  'utilisateur_prenom' => 
  array (
    'name' => 'utilisateur_prenom',
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
  'utilisateur_civilite' => 
  array (
    'name' => 'utilisateur_civilite',
    'fieldName' => 'utilisateur_civilite',
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
  'utilisateur_dateNaissance' => 
  array (
    'name' => 'utilisateur_dateNaissance',
    'fieldName' => 'utilisateur_dateNaissance',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
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
  'utilisateur_adresse' => 
  array (
    'name' => 'utilisateur_adresse',
    'fieldName' => 'utilisateur_adresse',
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
  'utilisateur_cp' => 
  array (
    'name' => 'utilisateur_cp',
    'fieldName' => 'utilisateur_cp',
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
  'utilisateur_ville' => 
  array (
    'name' => 'utilisateur_ville',
    'fieldName' => 'utilisateur_ville',
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
  'utilisateur_fonction' => 
  array (
    'name' => 'utilisateur_fonction',
    'fieldName' => 'utilisateur_fonction',
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
  'utilisateur_societe' => 
  array (
    'name' => 'utilisateur_societe',
    'fieldName' => 'utilisateur_societe',
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
  'utilisateur_telephone' => 
  array (
    'name' => 'utilisateur_telephone',
    'fieldName' => 'utilisateur_telephone',
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
  'utilisateur_email' => 
  array (
    'name' => 'utilisateur_email',
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
  'utilisateur_login' => 
  array (
    'name' => 'utilisateur_login',
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
  'utilisateur_password' => 
  array (
    'name' => 'utilisateur_password',
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
  'utilisateur_dateCreation' => 
  array (
    'name' => 'utilisateur_dateCreation',
    'fieldName' => 'utilisateur_dateCreation',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
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
  'utilisateur_dateModification' => 
  array (
    'name' => 'utilisateur_dateModification',
    'fieldName' => 'utilisateur_dateModification',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
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
  'utilisateur_statut' => 
  array (
    'name' => 'utilisateur_statut',
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
  'utilisateur_question' => 
  array (
    'name' => 'utilisateur_question',
    'fieldName' => 'utilisateur_question',
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
  'utilisateur_reponse' => 
  array (
    'name' => 'utilisateur_reponse',
    'fieldName' => 'utilisateur_reponse',
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
  'utilisateur_photo' => 
  array (
    'name' => 'utilisateur_photo',
    'fieldName' => 'utilisateur_photo',
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
  'utilisateur_url' => 
  array (
    'name' => 'utilisateur_url',
    'fieldName' => 'utilisateur_url',
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
);
   public static $_pkFields = array('utilisateur_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `utilisateur`.`utilisateur_id`'.'='.intval($utilisateur_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `utilisateur_id`'.'='.intval($utilisateur_id).'';
}
public function insert ($record){
 if($record->utilisateur_id > 0 ){
    $query = 'INSERT INTO `utilisateur` (
`utilisateur_id`,`utilisateur_paysId`,`utilisateur_profilId`,`utilisateur_nom`,`utilisateur_prenom`,`utilisateur_civilite`,`utilisateur_dateNaissance`,`utilisateur_adresse`,`utilisateur_cp`,`utilisateur_ville`,`utilisateur_fonction`,`utilisateur_societe`,`utilisateur_telephone`,`utilisateur_email`,`utilisateur_login`,`utilisateur_password`,`utilisateur_dateCreation`,`utilisateur_dateModification`,`utilisateur_statut`,`utilisateur_question`,`utilisateur_reponse`,`utilisateur_photo`,`utilisateur_url`
) VALUES (
'.intval($record->utilisateur_id).', '.($record->utilisateur_paysId === null ? 'NULL' : intval($record->utilisateur_paysId)).', '.($record->utilisateur_profilId === null ? 'NULL' : intval($record->utilisateur_profilId)).', '.($record->utilisateur_nom === null ? 'NULL' : $this->_conn->quote($record->utilisateur_nom,false)).', '.($record->utilisateur_prenom === null ? 'NULL' : $this->_conn->quote($record->utilisateur_prenom,false)).', '.($record->utilisateur_civilite === null ? 'NULL' : intval($record->utilisateur_civilite)).', '.($record->utilisateur_dateNaissance === null ? 'NULL' : $this->_conn->quote($record->utilisateur_dateNaissance,false)).', '.($record->utilisateur_adresse === null ? 'NULL' : $this->_conn->quote($record->utilisateur_adresse,false)).', '.($record->utilisateur_cp === null ? 'NULL' : $this->_conn->quote($record->utilisateur_cp,false)).', '.($record->utilisateur_ville === null ? 'NULL' : $this->_conn->quote($record->utilisateur_ville,false)).', '.($record->utilisateur_fonction === null ? 'NULL' : $this->_conn->quote($record->utilisateur_fonction,false)).', '.($record->utilisateur_societe === null ? 'NULL' : $this->_conn->quote($record->utilisateur_societe,false)).', '.($record->utilisateur_telephone === null ? 'NULL' : $this->_conn->quote($record->utilisateur_telephone,false)).', '.($record->utilisateur_email === null ? 'NULL' : $this->_conn->quote($record->utilisateur_email,false)).', '.($record->utilisateur_login === null ? 'NULL' : $this->_conn->quote($record->utilisateur_login,false)).', '.($record->utilisateur_password === null ? 'NULL' : $this->_conn->quote($record->utilisateur_password,false)).', '.($record->utilisateur_dateCreation === null ? 'NULL' : $this->_conn->quote($record->utilisateur_dateCreation,false)).', '.($record->utilisateur_dateModification === null ? 'NULL' : $this->_conn->quote($record->utilisateur_dateModification,false)).', '.($record->utilisateur_statut === null ? 'NULL' : intval($record->utilisateur_statut)).', '.($record->utilisateur_question === null ? 'NULL' : intval($record->utilisateur_question)).', '.($record->utilisateur_reponse === null ? 'NULL' : $this->_conn->quote($record->utilisateur_reponse,false)).', '.($record->utilisateur_photo === null ? 'NULL' : $this->_conn->quote($record->utilisateur_photo,false)).', '.($record->utilisateur_url === null ? 'NULL' : $this->_conn->quote($record->utilisateur_url,false)).'
)';
}else{
    $query = 'INSERT INTO `utilisateur` (
`utilisateur_paysId`,`utilisateur_profilId`,`utilisateur_nom`,`utilisateur_prenom`,`utilisateur_civilite`,`utilisateur_dateNaissance`,`utilisateur_adresse`,`utilisateur_cp`,`utilisateur_ville`,`utilisateur_fonction`,`utilisateur_societe`,`utilisateur_telephone`,`utilisateur_email`,`utilisateur_login`,`utilisateur_password`,`utilisateur_dateCreation`,`utilisateur_dateModification`,`utilisateur_statut`,`utilisateur_question`,`utilisateur_reponse`,`utilisateur_photo`,`utilisateur_url`
) VALUES (
'.($record->utilisateur_paysId === null ? 'NULL' : intval($record->utilisateur_paysId)).', '.($record->utilisateur_profilId === null ? 'NULL' : intval($record->utilisateur_profilId)).', '.($record->utilisateur_nom === null ? 'NULL' : $this->_conn->quote($record->utilisateur_nom,false)).', '.($record->utilisateur_prenom === null ? 'NULL' : $this->_conn->quote($record->utilisateur_prenom,false)).', '.($record->utilisateur_civilite === null ? 'NULL' : intval($record->utilisateur_civilite)).', '.($record->utilisateur_dateNaissance === null ? 'NULL' : $this->_conn->quote($record->utilisateur_dateNaissance,false)).', '.($record->utilisateur_adresse === null ? 'NULL' : $this->_conn->quote($record->utilisateur_adresse,false)).', '.($record->utilisateur_cp === null ? 'NULL' : $this->_conn->quote($record->utilisateur_cp,false)).', '.($record->utilisateur_ville === null ? 'NULL' : $this->_conn->quote($record->utilisateur_ville,false)).', '.($record->utilisateur_fonction === null ? 'NULL' : $this->_conn->quote($record->utilisateur_fonction,false)).', '.($record->utilisateur_societe === null ? 'NULL' : $this->_conn->quote($record->utilisateur_societe,false)).', '.($record->utilisateur_telephone === null ? 'NULL' : $this->_conn->quote($record->utilisateur_telephone,false)).', '.($record->utilisateur_email === null ? 'NULL' : $this->_conn->quote($record->utilisateur_email,false)).', '.($record->utilisateur_login === null ? 'NULL' : $this->_conn->quote($record->utilisateur_login,false)).', '.($record->utilisateur_password === null ? 'NULL' : $this->_conn->quote($record->utilisateur_password,false)).', '.($record->utilisateur_dateCreation === null ? 'NULL' : $this->_conn->quote($record->utilisateur_dateCreation,false)).', '.($record->utilisateur_dateModification === null ? 'NULL' : $this->_conn->quote($record->utilisateur_dateModification,false)).', '.($record->utilisateur_statut === null ? 'NULL' : intval($record->utilisateur_statut)).', '.($record->utilisateur_question === null ? 'NULL' : intval($record->utilisateur_question)).', '.($record->utilisateur_reponse === null ? 'NULL' : $this->_conn->quote($record->utilisateur_reponse,false)).', '.($record->utilisateur_photo === null ? 'NULL' : $this->_conn->quote($record->utilisateur_photo,false)).', '.($record->utilisateur_url === null ? 'NULL' : $this->_conn->quote($record->utilisateur_url,false)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->utilisateur_id < 1  ) $record->utilisateur_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `utilisateur` SET 
 `utilisateur_paysId`= '.($record->utilisateur_paysId === null ? 'NULL' : intval($record->utilisateur_paysId)).', `utilisateur_profilId`= '.($record->utilisateur_profilId === null ? 'NULL' : intval($record->utilisateur_profilId)).', `utilisateur_nom`= '.($record->utilisateur_nom === null ? 'NULL' : $this->_conn->quote($record->utilisateur_nom,false)).', `utilisateur_prenom`= '.($record->utilisateur_prenom === null ? 'NULL' : $this->_conn->quote($record->utilisateur_prenom,false)).', `utilisateur_civilite`= '.($record->utilisateur_civilite === null ? 'NULL' : intval($record->utilisateur_civilite)).', `utilisateur_dateNaissance`= '.($record->utilisateur_dateNaissance === null ? 'NULL' : $this->_conn->quote($record->utilisateur_dateNaissance,false)).', `utilisateur_adresse`= '.($record->utilisateur_adresse === null ? 'NULL' : $this->_conn->quote($record->utilisateur_adresse,false)).', `utilisateur_cp`= '.($record->utilisateur_cp === null ? 'NULL' : $this->_conn->quote($record->utilisateur_cp,false)).', `utilisateur_ville`= '.($record->utilisateur_ville === null ? 'NULL' : $this->_conn->quote($record->utilisateur_ville,false)).', `utilisateur_fonction`= '.($record->utilisateur_fonction === null ? 'NULL' : $this->_conn->quote($record->utilisateur_fonction,false)).', `utilisateur_societe`= '.($record->utilisateur_societe === null ? 'NULL' : $this->_conn->quote($record->utilisateur_societe,false)).', `utilisateur_telephone`= '.($record->utilisateur_telephone === null ? 'NULL' : $this->_conn->quote($record->utilisateur_telephone,false)).', `utilisateur_email`= '.($record->utilisateur_email === null ? 'NULL' : $this->_conn->quote($record->utilisateur_email,false)).', `utilisateur_login`= '.($record->utilisateur_login === null ? 'NULL' : $this->_conn->quote($record->utilisateur_login,false)).', `utilisateur_password`= '.($record->utilisateur_password === null ? 'NULL' : $this->_conn->quote($record->utilisateur_password,false)).', `utilisateur_dateCreation`= '.($record->utilisateur_dateCreation === null ? 'NULL' : $this->_conn->quote($record->utilisateur_dateCreation,false)).', `utilisateur_dateModification`= '.($record->utilisateur_dateModification === null ? 'NULL' : $this->_conn->quote($record->utilisateur_dateModification,false)).', `utilisateur_statut`= '.($record->utilisateur_statut === null ? 'NULL' : intval($record->utilisateur_statut)).', `utilisateur_question`= '.($record->utilisateur_question === null ? 'NULL' : intval($record->utilisateur_question)).', `utilisateur_reponse`= '.($record->utilisateur_reponse === null ? 'NULL' : $this->_conn->quote($record->utilisateur_reponse,false)).', `utilisateur_photo`= '.($record->utilisateur_photo === null ? 'NULL' : $this->_conn->quote($record->utilisateur_photo,false)).', `utilisateur_url`= '.($record->utilisateur_url === null ? 'NULL' : $this->_conn->quote($record->utilisateur_url,false)).'
 where  `utilisateur_id`'.'='.intval($record->utilisateur_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>