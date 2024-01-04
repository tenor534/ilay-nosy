<?php  require_once ( JELIX_LIB_DAO_PATH .'jDaoBase.class.php');

class cDaoRecord_forfait_Jx_forfait_Jx_mysql extends jDaoRecordBase {
 public $forfait_id;
 public $forfait_packId;
 public $forfait_libelle;
 public $forfait_nbAnnonce;
 public $forfait_nbPhoto;
 public $forfait_nbCaractere;
 public $forfait_dureeParution;
 public $forfait_voirPhoto;
 public $forfait_voirCoordonnee;
 public $forfait_affichePhoto;
 public $forfait_afficheCoordonnee;
 public $forfait_ajoutLien;
 public $forfait_hasPlus;
 public $forfait_statistique;
 public $forfait_texteMEV;
 public $forfait_nbPhotoAdd;
 public $forfait_prix;
 public $forfait_prixPlus;
   public function getProperties() { return cDao_forfait_Jx_forfait_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_forfait_Jx_forfait_Jx_mysql::$_pkFields; }
}

class cDao_forfait_Jx_forfait_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'forfait' => 
  array (
    'name' => 'forfait',
    'realname' => 'forfait',
    'pk' => 
    array (
      0 => 'forfait_id',
    ),
    'fields' => 
    array (
      0 => 'forfait_id',
      1 => 'forfait_packId',
      2 => 'forfait_libelle',
      3 => 'forfait_nbAnnonce',
      4 => 'forfait_nbPhoto',
      5 => 'forfait_nbCaractere',
      6 => 'forfait_dureeParution',
      7 => 'forfait_voirPhoto',
      8 => 'forfait_voirCoordonnee',
      9 => 'forfait_affichePhoto',
      10 => 'forfait_afficheCoordonnee',
      11 => 'forfait_ajoutLien',
      12 => 'forfait_hasPlus',
      13 => 'forfait_statistique',
      14 => 'forfait_texteMEV',
      15 => 'forfait_nbPhotoAdd',
      16 => 'forfait_prix',
      17 => 'forfait_prixPlus',
    ),
  ),
);
   protected $_primaryTable = 'forfait';
   protected $_selectClause='SELECT `forfait`.`forfait_id`, `forfait`.`forfait_packId`, `forfait`.`forfait_libelle`, `forfait`.`forfait_nbAnnonce`, `forfait`.`forfait_nbPhoto`, `forfait`.`forfait_nbCaractere`, `forfait`.`forfait_dureeParution`, `forfait`.`forfait_voirPhoto`, `forfait`.`forfait_voirCoordonnee`, `forfait`.`forfait_affichePhoto`, `forfait`.`forfait_afficheCoordonnee`, `forfait`.`forfait_ajoutLien`, `forfait`.`forfait_hasPlus`, `forfait`.`forfait_statistique`, `forfait`.`forfait_texteMEV`, `forfait`.`forfait_nbPhotoAdd`, `forfait`.`forfait_prix`, `forfait`.`forfait_prixPlus`';
   protected $_fromClause=' FROM `forfait`';
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_forfait_Jx_forfait_Jx_mysql';
   public static $_properties = array (
  'forfait_id' => 
  array (
    'name' => 'forfait_id',
    'fieldName' => 'forfait_id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_packId' => 
  array (
    'name' => 'forfait_packId',
    'fieldName' => 'forfait_packId',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_libelle' => 
  array (
    'name' => 'forfait_libelle',
    'fieldName' => 'forfait_libelle',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => true,
  ),
  'forfait_nbAnnonce' => 
  array (
    'name' => 'forfait_nbAnnonce',
    'fieldName' => 'forfait_nbAnnonce',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_nbPhoto' => 
  array (
    'name' => 'forfait_nbPhoto',
    'fieldName' => 'forfait_nbPhoto',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_nbCaractere' => 
  array (
    'name' => 'forfait_nbCaractere',
    'fieldName' => 'forfait_nbCaractere',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_dureeParution' => 
  array (
    'name' => 'forfait_dureeParution',
    'fieldName' => 'forfait_dureeParution',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_voirPhoto' => 
  array (
    'name' => 'forfait_voirPhoto',
    'fieldName' => 'forfait_voirPhoto',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_voirCoordonnee' => 
  array (
    'name' => 'forfait_voirCoordonnee',
    'fieldName' => 'forfait_voirCoordonnee',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_affichePhoto' => 
  array (
    'name' => 'forfait_affichePhoto',
    'fieldName' => 'forfait_affichePhoto',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_afficheCoordonnee' => 
  array (
    'name' => 'forfait_afficheCoordonnee',
    'fieldName' => 'forfait_afficheCoordonnee',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_ajoutLien' => 
  array (
    'name' => 'forfait_ajoutLien',
    'fieldName' => 'forfait_ajoutLien',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_hasPlus' => 
  array (
    'name' => 'forfait_hasPlus',
    'fieldName' => 'forfait_hasPlus',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_statistique' => 
  array (
    'name' => 'forfait_statistique',
    'fieldName' => 'forfait_statistique',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_texteMEV' => 
  array (
    'name' => 'forfait_texteMEV',
    'fieldName' => 'forfait_texteMEV',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_nbPhotoAdd' => 
  array (
    'name' => 'forfait_nbPhotoAdd',
    'fieldName' => 'forfait_nbPhotoAdd',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_prix' => 
  array (
    'name' => 'forfait_prix',
    'fieldName' => 'forfait_prix',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'needsQuotes' => false,
  ),
  'forfait_prixPlus' => 
  array (
    'name' => 'forfait_prixPlus',
    'fieldName' => 'forfait_prixPlus',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'int',
    'table' => 'forfait',
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
   public static $_pkFields = array('forfait_id');
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `forfait`.`forfait_id`'.'='.intval($forfait_id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `forfait_id`'.'='.intval($forfait_id).'';
}
public function insert ($record){
 if($record->forfait_id > 0 ){
    $query = 'INSERT INTO `forfait` (
`forfait_id`,`forfait_packId`,`forfait_libelle`,`forfait_nbAnnonce`,`forfait_nbPhoto`,`forfait_nbCaractere`,`forfait_dureeParution`,`forfait_voirPhoto`,`forfait_voirCoordonnee`,`forfait_affichePhoto`,`forfait_afficheCoordonnee`,`forfait_ajoutLien`,`forfait_hasPlus`,`forfait_statistique`,`forfait_texteMEV`,`forfait_nbPhotoAdd`,`forfait_prix`,`forfait_prixPlus`
) VALUES (
'.intval($record->forfait_id).', '.($record->forfait_packId === null ? 'NULL' : intval($record->forfait_packId)).', '.($record->forfait_libelle === null ? 'NULL' : $this->_conn->quote($record->forfait_libelle,false)).', '.($record->forfait_nbAnnonce === null ? 'NULL' : intval($record->forfait_nbAnnonce)).', '.($record->forfait_nbPhoto === null ? 'NULL' : intval($record->forfait_nbPhoto)).', '.($record->forfait_nbCaractere === null ? 'NULL' : intval($record->forfait_nbCaractere)).', '.($record->forfait_dureeParution === null ? 'NULL' : intval($record->forfait_dureeParution)).', '.($record->forfait_voirPhoto === null ? 'NULL' : intval($record->forfait_voirPhoto)).', '.($record->forfait_voirCoordonnee === null ? 'NULL' : intval($record->forfait_voirCoordonnee)).', '.($record->forfait_affichePhoto === null ? 'NULL' : intval($record->forfait_affichePhoto)).', '.($record->forfait_afficheCoordonnee === null ? 'NULL' : intval($record->forfait_afficheCoordonnee)).', '.($record->forfait_ajoutLien === null ? 'NULL' : intval($record->forfait_ajoutLien)).', '.($record->forfait_hasPlus === null ? 'NULL' : intval($record->forfait_hasPlus)).', '.($record->forfait_statistique === null ? 'NULL' : intval($record->forfait_statistique)).', '.($record->forfait_texteMEV === null ? 'NULL' : intval($record->forfait_texteMEV)).', '.($record->forfait_nbPhotoAdd === null ? 'NULL' : intval($record->forfait_nbPhotoAdd)).', '.($record->forfait_prix === null ? 'NULL' : intval($record->forfait_prix)).', '.($record->forfait_prixPlus === null ? 'NULL' : intval($record->forfait_prixPlus)).'
)';
}else{
    $query = 'INSERT INTO `forfait` (
`forfait_packId`,`forfait_libelle`,`forfait_nbAnnonce`,`forfait_nbPhoto`,`forfait_nbCaractere`,`forfait_dureeParution`,`forfait_voirPhoto`,`forfait_voirCoordonnee`,`forfait_affichePhoto`,`forfait_afficheCoordonnee`,`forfait_ajoutLien`,`forfait_hasPlus`,`forfait_statistique`,`forfait_texteMEV`,`forfait_nbPhotoAdd`,`forfait_prix`,`forfait_prixPlus`
) VALUES (
'.($record->forfait_packId === null ? 'NULL' : intval($record->forfait_packId)).', '.($record->forfait_libelle === null ? 'NULL' : $this->_conn->quote($record->forfait_libelle,false)).', '.($record->forfait_nbAnnonce === null ? 'NULL' : intval($record->forfait_nbAnnonce)).', '.($record->forfait_nbPhoto === null ? 'NULL' : intval($record->forfait_nbPhoto)).', '.($record->forfait_nbCaractere === null ? 'NULL' : intval($record->forfait_nbCaractere)).', '.($record->forfait_dureeParution === null ? 'NULL' : intval($record->forfait_dureeParution)).', '.($record->forfait_voirPhoto === null ? 'NULL' : intval($record->forfait_voirPhoto)).', '.($record->forfait_voirCoordonnee === null ? 'NULL' : intval($record->forfait_voirCoordonnee)).', '.($record->forfait_affichePhoto === null ? 'NULL' : intval($record->forfait_affichePhoto)).', '.($record->forfait_afficheCoordonnee === null ? 'NULL' : intval($record->forfait_afficheCoordonnee)).', '.($record->forfait_ajoutLien === null ? 'NULL' : intval($record->forfait_ajoutLien)).', '.($record->forfait_hasPlus === null ? 'NULL' : intval($record->forfait_hasPlus)).', '.($record->forfait_statistique === null ? 'NULL' : intval($record->forfait_statistique)).', '.($record->forfait_texteMEV === null ? 'NULL' : intval($record->forfait_texteMEV)).', '.($record->forfait_nbPhotoAdd === null ? 'NULL' : intval($record->forfait_nbPhotoAdd)).', '.($record->forfait_prix === null ? 'NULL' : intval($record->forfait_prix)).', '.($record->forfait_prixPlus === null ? 'NULL' : intval($record->forfait_prixPlus)).'
)';
}
   $result = $this->_conn->exec ($query);
   if($result){
      if($record->forfait_id < 1  ) $record->forfait_id= $this->_conn->lastInsertId();
    return $result;
 }else return false;
}
public function update ($record){
   $query = 'UPDATE `forfait` SET 
 `forfait_packId`= '.($record->forfait_packId === null ? 'NULL' : intval($record->forfait_packId)).', `forfait_libelle`= '.($record->forfait_libelle === null ? 'NULL' : $this->_conn->quote($record->forfait_libelle,false)).', `forfait_nbAnnonce`= '.($record->forfait_nbAnnonce === null ? 'NULL' : intval($record->forfait_nbAnnonce)).', `forfait_nbPhoto`= '.($record->forfait_nbPhoto === null ? 'NULL' : intval($record->forfait_nbPhoto)).', `forfait_nbCaractere`= '.($record->forfait_nbCaractere === null ? 'NULL' : intval($record->forfait_nbCaractere)).', `forfait_dureeParution`= '.($record->forfait_dureeParution === null ? 'NULL' : intval($record->forfait_dureeParution)).', `forfait_voirPhoto`= '.($record->forfait_voirPhoto === null ? 'NULL' : intval($record->forfait_voirPhoto)).', `forfait_voirCoordonnee`= '.($record->forfait_voirCoordonnee === null ? 'NULL' : intval($record->forfait_voirCoordonnee)).', `forfait_affichePhoto`= '.($record->forfait_affichePhoto === null ? 'NULL' : intval($record->forfait_affichePhoto)).', `forfait_afficheCoordonnee`= '.($record->forfait_afficheCoordonnee === null ? 'NULL' : intval($record->forfait_afficheCoordonnee)).', `forfait_ajoutLien`= '.($record->forfait_ajoutLien === null ? 'NULL' : intval($record->forfait_ajoutLien)).', `forfait_hasPlus`= '.($record->forfait_hasPlus === null ? 'NULL' : intval($record->forfait_hasPlus)).', `forfait_statistique`= '.($record->forfait_statistique === null ? 'NULL' : intval($record->forfait_statistique)).', `forfait_texteMEV`= '.($record->forfait_texteMEV === null ? 'NULL' : intval($record->forfait_texteMEV)).', `forfait_nbPhotoAdd`= '.($record->forfait_nbPhotoAdd === null ? 'NULL' : intval($record->forfait_nbPhotoAdd)).', `forfait_prix`= '.($record->forfait_prix === null ? 'NULL' : intval($record->forfait_prix)).', `forfait_prixPlus`= '.($record->forfait_prixPlus === null ? 'NULL' : intval($record->forfait_prixPlus)).'
 where  `forfait_id`'.'='.intval($record->forfait_id).'
';
   return $this->_conn->exec ($query);
 }
}
?>