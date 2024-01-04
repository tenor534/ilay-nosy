<?php

/**

* @package ilay-nosy

* @subpackage

* @author

* @contributor

* @copyright

* @link

* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file

*/



define ('JELIX_APP_PATH', dirname (__FILE__).DIRECTORY_SEPARATOR); // don't change



define ('JELIX_APP_TEMP_PATH',    realpath(JELIX_APP_PATH.'./temp/ilay-nosy').DIRECTORY_SEPARATOR);

define ('JELIX_APP_VAR_PATH',     realpath(JELIX_APP_PATH.'./var/').DIRECTORY_SEPARATOR);

define ('JELIX_APP_LOG_PATH',     realpath(JELIX_APP_PATH.'./var/log/').DIRECTORY_SEPARATOR);

define ('JELIX_APP_CONFIG_PATH',  realpath(JELIX_APP_PATH.'./var/config/').DIRECTORY_SEPARATOR);

define ('JELIX_APP_WWW_PATH',     realpath(JELIX_APP_PATH.'./www/').DIRECTORY_SEPARATOR);

define ('JELIX_APP_CMD_PATH',     realpath(JELIX_APP_PATH.'./scripts/').DIRECTORY_SEPARATOR);



/*

Mettre le pays et la marque par défaut en paramètre dans application init.

Voir si la couleur de fond ne peut être défini via le BO. Ce serait quand même plus pratique. Voir avec Dimby.

Catégorie dans les verres : limiter à 10 caractères svp

Voir à mettre une liste déroulante sur les catégory avec une valeur par défaut et gérer les catégory par ailleurs 

Voir description des tableaux nutritionnels : deux lignes ???

Se méfier du côté dynamique de l’écart des lignes du tableau nutritionnel. Voir avec Dimby lundi matin. Me tenir au courant

*/



//BO --------------------------------------------------------------------------------------------------------

//Pagination par défaut

define('PAGINATION_NBITEMPARPAGE', 15);



//pays

/*define('PAYS_DEFAULT_ID', 207);

define('PAGINATION_NBITEMPARPAGE_PAYS', 15);*/



//FO --------------------------------------------------------------------------------------------------------

define('SITE_PORTAIL',1);

define('SITE_MEMBRE' ,2);



//define('CONVERT_PATH','/usr/bin/convert');



//PROFIL

define('SITE_PROFIL_SADMIN',1);

define('SITE_PROFIL_ADMIN' ,2);

define('SITE_PROFIL_MEMBRE_AN',3);

define('SITE_PROFIL_MEMBRE_VI',4);

define('SITE_PROFIL_MEMBRE_PR',5);

define('SITE_PROFIL_MEMBRE_CL',6);

define('SITE_PROFIL_MEMBRE_PA',7);

define('SITE_PROFIL_MEMBRE_EM',8);

define('SITE_PROFIL_MEMBRE_CA',9);



//UTILISATEUR STATUT

define('USER_STATUT_ON'  ,1);

define('USER_STATUT_OFF' ,2);

define('USER_STATUT_STBY',3);



//ABONNEMENT STATUT

define('ABONNEMENT_STATUT_ON'  ,1);

define('ABONNEMENT_STATUT_OFF' ,2);

define('ABONNEMENT_STATUT_STBY',3);



//Annonce

define('ANNONCE_PAGINATION_NBITEMPARPAGE', 8);

define('ANNONCE_PATH_MEDIAS','medias/annonce/');

define('ANNONCE_PATH_RESIZE','resize/annonce/');

define('ANNONCE_DETAIL_WIDTH',180);

define('ANNONCE_DETAIL_HEIGHT',135);

define('ANNONCE_ABREGE_WIDTH',98);

define('ANNONCE_ABREGE_HEIGHT',74);

define('ANNONCE_PHOTO_WIDTH',180);

define('ANNONCE_PHOTO_HEIGHT',135);

define('ANNONCE_POPUP_WIDTH',360);

define('ANNONCE_POPUP_HEIGHT',270);

define('ANNONCE_FRONT_WIDTH',191);

define('ANNONCE_FRONT_HEIGHT',86);

define('ANNONCE_HOME_WIDTH',469);

define('ANNONCE_HOME_HEIGHT',313);

define('ANNONCE_LEFT_WIDTH',50);

define('ANNONCE_LEFT_HEIGHT',70);



//Pack

define('PACK_PAGINATION_NBITEMPARPAGE', 10);

define('PACK_PATH_MEDIAS','medias/pack/');

define('PACK_PATH_RESIZE','resize/pack/');

define('PACK_WIDTH',180);

define('PACK_HEIGHT',135);



//Pack ID

define('PACK_VEHICULES',1);

define('PACK_IMMOBILIERS',2);

define('PACK_EMPLOIS',3);

define('PACK_ANNONCES',4);

define('PACK_VISITEURS',5);



//Categorie ID

define('CATEGORIE_VEHICULES',"1");

define('CATEGORIE_EMPLOIS',"2");

define('CATEGORIE_IMMOBILIERS',"6");

define('CATEGORIE_ANNONCES',"3,4,5,7,8,9,10,11,12,13,14,15,16,17,18");



//Rubrique Rencontre ID

define('RENCONTRE_FEMMES',"66");

define('RENCONTRE_HOMMES',"73");

define('RENCONTRE_COUPLES',"80");



//Utilisateur

define('UTILISATEUR_PAGINATION_NBITEMPARPAGE', 10);

define('UTILISATEUR_PATH_MEDIAS','medias/utilisateur/');

define('UTILISATEUR_PATH_RESIZE','resize/utilisateur/');





//Banniere : 

define('PAGINATION_NBITEMPARPAGE_BANNIERE', 10);

define('PATH_BANNIERES_MEDIAS','medias/banniere/');

define('PATH_BANNIERES_RESIZE','resize/banniere/');

define('BANNIERES_WIDTH',690);

define('BANNIERES_HEIGHT',120);

define('BANNIERES_WIDTH_LIST',100);

define('BANNIERES_HEIGHT_LIST',80);



//ACTUALITE

define('ACTUALITE_PAGINATION_NBITEMPARPAGE', 3);

define('ACTUALITE_NBPHOTOMAX', 20);

define('ACTUALITE_PATH_MEDIAS','medias/actualite/');

define('ACTUALITE_PATH_RESIZE','resize/actualite/');

define('ACTUALITE_WIDTH',469);

define('ACTUALITE_HEIGHT',313);







//RUBRIQUE : 

define('RUBRIQUE_PAGINATION_NBITEMPARPAGE', 50);





//Drapeau : 

define('PAGINATION_NBITEMPARPAGE_FLAG', 10);

define('PATH_FLAGS_MEDIAS','medias/drapeau/');

define('PATH_FLAGS_RESIZE','resize/drapeau/');

define('FLAGS_WIDTH',79);

define('FLAGS_HEIGHT',50);

define('FLAGS_WIDTH_LIST',25);

define('FLAGS_HEIGHT_LIST',13);



//Langue par défaut

define('SITE_LANGUE_DEFAULT' ,2);



define('MAIL_CONTACT','contact@ilay-nosy.com'); 

define('MAIL_CONTACT_BCC','s.rakotondrabe@dword-consulting.com');

define('MAIL_CONTACT_BCC_1','rakotondrabe@hotmail.co.uk');



?>