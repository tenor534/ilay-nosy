<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_annonce_Jx_annonce_Jx_mysql extends jDaoRecordBase {
 public $annonce_id;
 public $annonce_abonnementId;
 public $annonce_rubriqueId;
 public $annonce_localiteId;
 public $annonce_reference;
 public $annonce_titre;
 public $annonce_resume;
 public $annonce_description;
 public $annonce_offreId;
 public $annonce_prix;
 public $annonce_prixInfo;
 public $annonce_annee;
 public $annonce_etat;
 public $annonce_contactNom;
 public $annonce_contactPrenom;
 public $annonce_contactEmail;
 public $annonce_contactAdresse;
 public $annonce_contactTelephone;
 public $annonce_contactPeriodeAppel;
 public $annonce_dateCreation;
 public $annonce_dateModification;
 public $annonce_dateDebut;
 public $annonce_dateFin;
 public $annonce_origine;
 public $annonce_action;
 public $annonce_visite;
 public $annonce_dateVisite;
 public $annonce_publier;
 public $annonce_publierHome;
 public $annonce_laUne;
 public $annonce_photo;
   public function getProperties() { return cDao_annonce_Jx_annonce_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_annonce_Jx_annonce_Jx_mysql::$_pkFields; }
}

class cDao_annonce_Jx_annonce_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'annonce' => 
  array (
    'name' => 'annonce',
    'realname' => 'annonce',
    'pk' => 
    array (
      0 => 'annonce_id',
    ),
    'fields' => 
    array (
      0 => 'annonce_id',
      1 => 'annonce_abonnementId',
      2 => 'annonce_rubriqueId',
      3 => 'annonce_localiteId',
      4 => 'annonce_reference',
      5 => 'annonce_titre',
      6 => 'annonce_resume',
      7 => 'annonce_description',
      8 => 'annonce_offreId',
      9 => 'annonce_prix',
      10 => 'annonce_prixInfo',
      11 => 'annonce_annee',
      12 => 'annonce_etat',
      13 => 'annonce_contactNom',
      14 => 'annonce_contactPrenom',
      15 => 'annonce_contactEmail',
      16 => 'annonce_contactAdresse',
      17 => 'annonce_contactTelephone',
      18 => 'annonce_contactPeriodeAppel',
      19 => 'annonce_dateCreation',
      20 => 'annonce_dateModification',
      21 => 'annonce_dateDebut',
      22 => 'annonce_dateFin',
      23 => 'annonce_origine',
      24 => 'annonce_action',
      25 => 'annonce_visite',
      26 => 'annonce_dateVisite',
      27 => 'annonce_publier',
      28 => 'annonce_publierHome',
      29 => 'annonce_laUne',
      30 => 'annonce_photo',
    ),
  ),
);
   protected $_primaryTable = 'annonce';
   protected $_selectClause='SELECT `annonce`.`annonce_id`, `annonce`.`annonce_abonnementId`, `annonce`.`annonce_rubriqueId`, `annonce`.`annonce_localiteId`, `annonce`.`annonce_reference`, `annonce`.`annonce_titre`, `annonce`.`annonce_resume`, `annonce`.`annonce_description`, `annonce`.`annonce_offreId`, `annonce`.`annonce_prix`, `annonce`.`annonce_prixInfo`, `annonce`.`annonce_annee`, `annonce`.`annonce_etat`, `annonce`.`annonce_contactNom`, `annonce`.`annonce_contactPrenom`, `annonce`.`annonce_contactEmail`, `annonce`.`annonce_contactAdresse`, `annonce`.`annonce_contactTelephone`, `annonce`.`annonce_contactPeriodeAppel`, `annonce`.`annonce_dateCreation`, `annonce`.`annonce_dateModification`, `annonce`.`annonce_dateDebut`, `annonce`.`annonce_dateFin`, `annonce`.`annonce_origine`, `annonce`.`annonce_action`, `annonce`.`annonce_visite`, `annonce`.`annonce_dateVisite`, `annonce`.`annonce_publier`, `annonce`.`annonce_publierHome`, `annonce`.`annonce_laUne`, `annonce`.`annonce_photo`';
   protected $_fromClause=' FROM `annonce`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_annonce_Jx_annonce_Jx_mysql';
   public static $_properties = array (
  'annonce_id' => 
  array (
    'name' => 'annonce_id',
    'fieldName' => 'annonce_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_abonnementId' => 
  array (
    'name' => 'annonce_abonnementId',
    'fieldName' => 'annonce_abonnementId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_rubriqueId' => 
  array (
    'name' => 'annonce_rubriqueId',
    'fieldName' => 'annonce_rubriqueId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_localiteId' => 
  array (
    'name' => 'annonce_localiteId',
    'fieldName' => 'annonce_localiteId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_reference' => 
  array (
    'name' => 'annonce_reference',
    'fieldName' => 'annonce_reference',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_titre' => 
  array (
    'name' => 'annonce_titre',
    'fieldName' => 'annonce_titre',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_resume' => 
  array (
    'name' => 'annonce_resume',
    'fieldName' => 'annonce_resume',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_description' => 
  array (
    'name' => 'annonce_description',
    'fieldName' => 'annonce_description',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_offreId' => 
  array (
    'name' => 'annonce_offreId',
    'fieldName' => 'annonce_offreId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_prix' => 
  array (
    'name' => 'annonce_prix',
    'fieldName' => 'annonce_prix',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'float',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_prixInfo' => 
  array (
    'name' => 'annonce_prixInfo',
    'fieldName' => 'annonce_prixInfo',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_annee' => 
  array (
    'name' => 'annonce_annee',
    'fieldName' => 'annonce_annee',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_etat' => 
  array (
    'name' => 'annonce_etat',
    'fieldName' => 'annonce_etat',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_contactNom' => 
  array (
    'name' => 'annonce_contactNom',
    'fieldName' => 'annonce_contactNom',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_contactPrenom' => 
  array (
    'name' => 'annonce_contactPrenom',
    'fieldName' => 'annonce_contactPrenom',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_contactEmail' => 
  array (
    'name' => 'annonce_contactEmail',
    'fieldName' => 'annonce_contactEmail',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_contactAdresse' => 
  array (
    'name' => 'annonce_contactAdresse',
    'fieldName' => 'annonce_contactAdresse',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_contactTelephone' => 
  array (
    'name' => 'annonce_contactTelephone',
    'fieldName' => 'annonce_contactTelephone',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_contactPeriodeAppel' => 
  array (
    'name' => 'annonce_contactPeriodeAppel',
    'fieldName' => 'annonce_contactPeriodeAppel',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_dateCreation' => 
  array (
    'name' => 'annonce_dateCreation',
    'fieldName' => 'annonce_dateCreation',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_dateModification' => 
  array (
    'name' => 'annonce_dateModification',
    'fieldName' => 'annonce_dateModification',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_dateDebut' => 
  array (
    'name' => 'annonce_dateDebut',
    'fieldName' => 'annonce_dateDebut',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_dateFin' => 
  array (
    'name' => 'annonce_dateFin',
    'fieldName' => 'annonce_dateFin',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_origine' => 
  array (
    'name' => 'annonce_origine',
    'fieldName' => 'annonce_origine',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_action' => 
  array (
    'name' => 'annonce_action',
    'fieldName' => 'annonce_action',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_visite' => 
  array (
    'name' => 'annonce_visite',
    'fieldName' => 'annonce_visite',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_dateVisite' => 
  array (
    'name' => 'annonce_dateVisite',
    'fieldName' => 'annonce_dateVisite',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'datetime',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'annonce_publier' => 
  array (
    'name' => 'annonce_publier',
    'fieldName' => 'annonce_publier',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_publierHome' => 
  array (
    'name' => 'annonce_publierHome',
    'fieldName' => 'annonce_publierHome',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_laUne' => 
  array (
    'name' => 'annonce_laUne',
    'fieldName' => 'annonce_laUne',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'annonce',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'annonce_photo' => 
  array (
    'name' => 'annonce_photo',
    'fieldName' => 'annonce_photo',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'annonce',
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
   public static $_pkFields = array('annonce_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `annonce`.`annonce_id`'.'='.intval($annonce_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `annonce_id`'.'='.intval($annonce_id).'';
}
public function insert ($record){
 if($record->annonce_id > 0 ){
    $query = 'INSERT INTO `annonce` (
`annonce_id`,`annonce_abonnementId`,`annonce_rubriqueId`,`annonce_localiteId`,`annonce_reference`,`annonce_titre`,`annonce_resume`,`annonce_description`,`annonce_offreId`,`annonce_prix`,`annonce_prixInfo`,`annonce_annee`,`annonce_etat`,`annonce_contactNom`,`annonce_contactPrenom`,`annonce_contactEmail`,`annonce_contactAdresse`,`annonce_contactTelephone`,`annonce_contactPeriodeAppel`,`annonce_dateCreation`,`annonce_dateModification`,`annonce_dateDebut`,`annonce_dateFin`,`annonce_origine`,`annonce_action`,`annonce_visite`,`annonce_dateVisite`,`annonce_publier`,`annonce_publierHome`,`annonce_laUne`,`annonce_photo`
) VALUES (
'.intval($record->annonce_id).', '.($record->annonce_abonnementId === null ? 'NULL' : intval($record->annonce_abonnementId)).', '.($record->annonce_rubriqueId === null ? 'NULL' : intval($record->annonce_rubriqueId)).', '.($record->annonce_localiteId === null ? 'NULL' : intval($record->annonce_localiteId)).', '.($record->annonce_reference === null ? 'NULL' : $this->_conn->quote($record->annonce_reference,false)).', '.($record->annonce_titre === null ? 'NULL' : $this->_conn->quote($record->annonce_titre,false)).', '.($record->annonce_resume === null ? 'NULL' : $this->_conn->quote($record->annonce_resume,false)).', '.($record->annonce_description === null ? 'NULL' : $this->_conn->quote($record->annonce_description,false)).', '.($record->annonce_offreId === null ? 'NULL' : intval($record->annonce_offreId)).', '.($record->annonce_prix === null ? 'NULL' : doubleval($record->annonce_prix)).', '.($record->annonce_prixInfo === null ? 'NULL' : $this->_conn->quote($record->annonce_prixInfo,false)).', '.($record->annonce_annee === null ? 'NULL' : intval($record->annonce_annee)).', '.($record->annonce_etat === null ? 'NULL' : intval($record->annonce_etat)).', '.($record->annonce_contactNom === null ? 'NULL' : $this->_conn->quote($record->annonce_contactNom,false)).', '.($record->annonce_contactPrenom === null ? 'NULL' : $this->_conn->quote($record->annonce_contactPrenom,false)).', '.($record->annonce_contactEmail === null ? 'NULL' : $this->_conn->quote($record->annonce_contactEmail,false)).', '.($record->annonce_contactAdresse === null ? 'NULL' : $this->_conn->quote($record->annonce_contactAdresse,false)).', '.($record->annonce_contactTelephone === null ? 'NULL' : $this->_conn->quote($record->annonce_contactTelephone,false)).', '.($record->annonce_contactPeriodeAppel === null ? 'NULL' : intval($record->annonce_contactPeriodeAppel)).', '.($record->annonce_dateCreation === null ? 'NULL' : $this->_conn->quote($record->annonce_dateCreation,false)).', '.($record->annonce_dateModification === null ? 'NULL' : $this->_conn->quote($record->annonce_dateModification,false)).', '.($record->annonce_dateDebut === null ? 'NULL' : $this->_conn->quote($record->annonce_dateDebut,false)).', '.($record->annonce_dateFin === null ? 'NULL' : $this->_conn->quote($record->annonce_dateFin,false)).', '.($record->annonce_origine === null ? 'NULL' : $this->_conn->quote($record->annonce_origine,false)).', '.($record->annonce_action === null ? 'NULL' : intval($record->annonce_action)).', '.($record->annonce_visite === null ? 'NULL' : intval($record->annonce_visite)).', '.($record->annonce_dateVisite === null ? 'NULL' : $this->_conn->quote($record->annonce_dateVisite,false)).', '.($record->annonce_publier === null ? 'NULL' : intval($record->annonce_publier)).', '.($record->annonce_publierHome === null ? 'NULL' : intval($record->annonce_publierHome)).', '.($record->annonce_laUne === null ? 'NULL' : intval($record->annonce_laUne)).', '.($record->annonce_photo === null ? 'NULL' : $this->_conn->quote($record->annonce_photo,false)).'
)';
}else{
    $query = 'INSERT INTO `annonce` (
`annonce_abonnementId`,`annonce_rubriqueId`,`annonce_localiteId`,`annonce_reference`,`annonce_titre`,`annonce_resume`,`annonce_description`,`annonce_offreId`,`annonce_prix`,`annonce_prixInfo`,`annonce_annee`,`annonce_etat`,`annonce_contactNom`,`annonce_contactPrenom`,`annonce_contactEmail`,`annonce_contactAdresse`,`annonce_contactTelephone`,`annonce_contactPeriodeAppel`,`annonce_dateCreation`,`annonce_dateModification`,`annonce_dateDebut`,`annonce_dateFin`,`annonce_origine`,`annonce_action`,`annonce_visite`,`annonce_dateVisite`,`annonce_publier`,`annonce_publierHome`,`annonce_laUne`,`annonce_photo`
) VALUES (
'.($record->annonce_abonnementId === null ? 'NULL' : intval($record->annonce_abonnementId)).', '.($record->annonce_rubriqueId === null ? 'NULL' : intval($record->annonce_rubriqueId)).', '.($record->annonce_localiteId === null ? 'NULL' : intval($record->annonce_localiteId)).', '.($record->annonce_reference === null ? 'NULL' : $this->_conn->quote($record->annonce_reference,false)).', '.($record->annonce_titre === null ? 'NULL' : $this->_conn->quote($record->annonce_titre,false)).', '.($record->annonce_resume === null ? 'NULL' : $this->_conn->quote($record->annonce_resume,false)).', '.($record->annonce_description === null ? 'NULL' : $this->_conn->quote($record->annonce_description,false)).', '.($record->annonce_offreId === null ? 'NULL' : intval($record->annonce_offreId)).', '.($record->annonce_prix === null ? 'NULL' : doubleval($record->annonce_prix)).', '.($record->annonce_prixInfo === null ? 'NULL' : $this->_conn->quote($record->annonce_prixInfo,false)).', '.($record->annonce_annee === null ? 'NULL' : intval($record->annonce_annee)).', '.($record->annonce_etat === null ? 'NULL' : intval($record->annonce_etat)).', '.($record->annonce_contactNom === null ? 'NULL' : $this->_conn->quote($record->annonce_contactNom,false)).', '.($record->annonce_contactPrenom === null ? 'NULL' : $this->_conn->quote($record->annonce_contactPrenom,false)).', '.($record->annonce_contactEmail === null ? 'NULL' : $this->_conn->quote($record->annonce_contactEmail,false)).', '.($record->annonce_contactAdresse === null ? 'NULL' : $this->_conn->quote($record->annonce_contactAdresse,false)).', '.($record->annonce_contactTelephone === null ? 'NULL' : $this->_conn->quote($record->annonce_contactTelephone,false)).', '.($record->annonce_contactPeriodeAppel === null ? 'NULL' : intval($record->annonce_contactPeriodeAppel)).', '.($record->annonce_dateCreation === null ? 'NULL' : $this->_conn->quote($record->annonce_dateCreation,false)).', '.($record->annonce_dateModification === null ? 'NULL' : $this->_conn->quote($record->annonce_dateModification,false)).', '.($record->annonce_dateDebut === null ? 'NULL' : $this->_conn->quote($record->annonce_dateDebut,false)).', '.($record->annonce_dateFin === null ? 'NULL' : $this->_conn->quote($record->annonce_dateFin,false)).', '.($record->annonce_origine === null ? 'NULL' : $this->_conn->quote($record->annonce_origine,false)).', '.($record->annonce_action === null ? 'NULL' : intval($record->annonce_action)).', '.($record->annonce_visite === null ? 'NULL' : intval($record->annonce_visite)).', '.($record->annonce_dateVisite === null ? 'NULL' : $this->_conn->quote($record->annonce_dateVisite,false)).', '.($record->annonce_publier === null ? 'NULL' : intval($record->annonce_publier)).', '.($record->annonce_publierHome === null ? 'NULL' : intval($record->annonce_publierHome)).', '.($record->annonce_laUne === null ? 'NULL' : intval($record->annonce_laUne)).', '.($record->annonce_photo === null ? 'NULL' : $this->_conn->quote($record->annonce_photo,false)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->annonce_id < 1  ) $record->annonce_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `annonce` SET 
 `annonce_abonnementId`= '.($record->annonce_abonnementId === null ? 'NULL' : intval($record->annonce_abonnementId)).', `annonce_rubriqueId`= '.($record->annonce_rubriqueId === null ? 'NULL' : intval($record->annonce_rubriqueId)).', `annonce_localiteId`= '.($record->annonce_localiteId === null ? 'NULL' : intval($record->annonce_localiteId)).', `annonce_reference`= '.($record->annonce_reference === null ? 'NULL' : $this->_conn->quote($record->annonce_reference,false)).', `annonce_titre`= '.($record->annonce_titre === null ? 'NULL' : $this->_conn->quote($record->annonce_titre,false)).', `annonce_resume`= '.($record->annonce_resume === null ? 'NULL' : $this->_conn->quote($record->annonce_resume,false)).', `annonce_description`= '.($record->annonce_description === null ? 'NULL' : $this->_conn->quote($record->annonce_description,false)).', `annonce_offreId`= '.($record->annonce_offreId === null ? 'NULL' : intval($record->annonce_offreId)).', `annonce_prix`= '.($record->annonce_prix === null ? 'NULL' : doubleval($record->annonce_prix)).', `annonce_prixInfo`= '.($record->annonce_prixInfo === null ? 'NULL' : $this->_conn->quote($record->annonce_prixInfo,false)).', `annonce_annee`= '.($record->annonce_annee === null ? 'NULL' : intval($record->annonce_annee)).', `annonce_etat`= '.($record->annonce_etat === null ? 'NULL' : intval($record->annonce_etat)).', `annonce_contactNom`= '.($record->annonce_contactNom === null ? 'NULL' : $this->_conn->quote($record->annonce_contactNom,false)).', `annonce_contactPrenom`= '.($record->annonce_contactPrenom === null ? 'NULL' : $this->_conn->quote($record->annonce_contactPrenom,false)).', `annonce_contactEmail`= '.($record->annonce_contactEmail === null ? 'NULL' : $this->_conn->quote($record->annonce_contactEmail,false)).', `annonce_contactAdresse`= '.($record->annonce_contactAdresse === null ? 'NULL' : $this->_conn->quote($record->annonce_contactAdresse,false)).', `annonce_contactTelephone`= '.($record->annonce_contactTelephone === null ? 'NULL' : $this->_conn->quote($record->annonce_contactTelephone,false)).', `annonce_contactPeriodeAppel`= '.($record->annonce_contactPeriodeAppel === null ? 'NULL' : intval($record->annonce_contactPeriodeAppel)).', `annonce_dateCreation`= '.($record->annonce_dateCreation === null ? 'NULL' : $this->_conn->quote($record->annonce_dateCreation,false)).', `annonce_dateModification`= '.($record->annonce_dateModification === null ? 'NULL' : $this->_conn->quote($record->annonce_dateModification,false)).', `annonce_dateDebut`= '.($record->annonce_dateDebut === null ? 'NULL' : $this->_conn->quote($record->annonce_dateDebut,false)).', `annonce_dateFin`= '.($record->annonce_dateFin === null ? 'NULL' : $this->_conn->quote($record->annonce_dateFin,false)).', `annonce_origine`= '.($record->annonce_origine === null ? 'NULL' : $this->_conn->quote($record->annonce_origine,false)).', `annonce_action`= '.($record->annonce_action === null ? 'NULL' : intval($record->annonce_action)).', `annonce_visite`= '.($record->annonce_visite === null ? 'NULL' : intval($record->annonce_visite)).', `annonce_dateVisite`= '.($record->annonce_dateVisite === null ? 'NULL' : $this->_conn->quote($record->annonce_dateVisite,false)).', `annonce_publier`= '.($record->annonce_publier === null ? 'NULL' : intval($record->annonce_publier)).', `annonce_publierHome`= '.($record->annonce_publierHome === null ? 'NULL' : intval($record->annonce_publierHome)).', `annonce_laUne`= '.($record->annonce_laUne === null ? 'NULL' : intval($record->annonce_laUne)).', `annonce_photo`= '.($record->annonce_photo === null ? 'NULL' : $this->_conn->quote($record->annonce_photo,false)).'
 where  `annonce_id`'.'='.intval($record->annonce_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>