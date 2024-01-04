-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Jeu 04 Mars 2010 à 12:34
-- Version du serveur: 5.0.45
-- Version de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de données: `ilayNosy`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `abonnement`
-- 

CREATE TABLE `abonnement` (
  `abonnement_id` int(11) NOT NULL auto_increment,
  `abonnement_utilisateurId` int(11) NOT NULL,
  `abonnement_forfaitId` int(11) NOT NULL,
  `abonnement_reference` varchar(50) NOT NULL,
  `abonnement_dateDebut` date default NULL,
  `abonnement_dateFin` date default NULL,
  `abonnement_dateCreation` datetime default NULL,
  `abonnement_credit` float NOT NULL,
  `abonnement_creditPlus` float NOT NULL,
  `abonnement_nbPlus` int(11) NOT NULL,
  `abonnement_statut` tinyint(1) default NULL,
  PRIMARY KEY  (`abonnement_id`),
  KEY `forfaitAbonnement_FK` (`abonnement_forfaitId`),
  KEY `utilisateurAbonnement_FK` (`abonnement_utilisateurId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Contenu de la table `abonnement`
-- 

INSERT INTO `abonnement` (`abonnement_id`, `abonnement_utilisateurId`, `abonnement_forfaitId`, `abonnement_reference`, `abonnement_dateDebut`, `abonnement_dateFin`, `abonnement_dateCreation`, `abonnement_credit`, `abonnement_creditPlus`, `abonnement_nbPlus`, `abonnement_statut`) VALUES 
(1, 1, 1, 'ab00010001', '2010-03-01', '2010-06-01', '2010-03-01 17:48:22', 3000, 0, 0, 1),
(2, 1, 3, 'ab00010003', '2010-02-01', '2010-05-01', '2010-01-01 10:48:22', 8000, 0, 0, 1),
(3, 1, 22, 'ab1221267638821', '2010-03-03', '2010-06-03', '2010-03-03 18:53:41', 8000, 6000, 1, 1),
(4, 1, 6, 'ab161267646810', '2010-03-03', '2010-06-03', '2010-03-03 21:06:50', 5000, 0, 0, 1),
(5, 1, 11, 'ab1111267647213', '2010-03-03', '2010-06-03', '2010-03-03 21:13:33', 8000, 0, 0, 1);

-- --------------------------------------------------------

-- 
-- Structure de la table `actualite`
-- 

CREATE TABLE `actualite` (
  `actualite_id` int(11) NOT NULL auto_increment,
  `actualite_categorieActId` int(11) NOT NULL,
  `actualite_reference` varchar(20) NOT NULL,
  `actualite_titre` varchar(150) NOT NULL,
  `actualite_resume` text,
  `actualite_texte` text,
  `actualite_photo` varchar(100) default NULL,
  `actualite_dateCreation` date default NULL,
  `actualite_dateModification` date default NULL,
  `actualite_datePublication` datetime default NULL,
  `actualite_source` varchar(100) default NULL,
  `actualite_vue` int(11) default NULL,
  `actualite_fichier` varchar(100) default NULL,
  `actualite_visite` int(11) NOT NULL,
  `actualite_publier` tinyint(1) default NULL,
  PRIMARY KEY  (`actualite_id`),
  KEY `categorieActualite_FK` (`actualite_categorieActId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `actualite`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `annonce`
-- 

CREATE TABLE `annonce` (
  `annonce_id` int(11) NOT NULL auto_increment,
  `annonce_abonnementId` int(11) NOT NULL,
  `annonce_rubriqueId` int(11) NOT NULL,
  `annonce_reference` varchar(20) NOT NULL,
  `annonce_titre` varchar(100) NOT NULL,
  `annonce_resume` text,
  `annonce_description` text,
  `annonce_prix` float default NULL,
  `annonce_annee` int(11) default NULL,
  `annonce_etat` smallint(6) default NULL,
  `annonce_contactNom` varchar(100) default NULL,
  `annonce_contactPrenom` varchar(100) default NULL,
  `annonce_contactEmail` varchar(50) default NULL,
  `annonce_contactAdresse` varchar(100) default NULL,
  `annonce_contactCP` varchar(10) NOT NULL,
  `annonce_contactVille` varchar(100) NOT NULL,
  `annonce_contactTelephone` varchar(20) default NULL,
  `annonce_contactPeriodeAppel` varchar(20) default NULL,
  `annonce_dateCreation` date default NULL,
  `annonce_dateModification` date default NULL,
  `annonce_dateDebut` date default NULL,
  `annonce_dateFin` date default NULL,
  `annonce_origine` int(11) default NULL,
  `annonce_action` int(11) default NULL,
  `annonce_visite` int(11) NOT NULL,
  PRIMARY KEY  (`annonce_id`),
  KEY `abonnementAnnonce_FK` (`annonce_abonnementId`),
  KEY `rubriqueAnnonce_FK` (`annonce_rubriqueId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `annonce`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `candidature`
-- 

CREATE TABLE `candidature` (
  `candidature_id` int(11) NOT NULL auto_increment,
  `candidature_annonceId` int(11) NOT NULL,
  `candidature_fonction` int(11) NOT NULL,
  `candidature_secteur` int(11) default NULL,
  `candidature_niveau` int(11) default NULL,
  `candidature_nature` int(11) default NULL,
  `candidature_discipline` int(11) default NULL,
  `candidature_dateDiplome` date default NULL,
  `candidature_disponibilite` varchar(100) default NULL,
  `candidature_souhaitFonction` int(11) default NULL,
  `candidature_souhaitSecteur` int(11) default NULL,
  `candidature_souhaitLieu` varchar(100) default NULL,
  PRIMARY KEY  (`candidature_id`),
  KEY `annonceCandidature_FK` (`candidature_annonceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `candidature`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `categorieAct`
-- 

CREATE TABLE `categorieAct` (
  `categorieAct_id` int(11) NOT NULL auto_increment,
  `categorieAct_libelle` varchar(100) NOT NULL,
  `categorieAct_code` varchar(10) NOT NULL,
  PRIMARY KEY  (`categorieAct_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `categorieAct`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `categorieAn`
-- 

CREATE TABLE `categorieAn` (
  `categorieAn_id` int(11) NOT NULL auto_increment,
  `categorieAn_libelle` varchar(100) NOT NULL,
  `categorieAn_code` varchar(10) default NULL,
  PRIMARY KEY  (`categorieAn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Contenu de la table `categorieAn`
-- 

INSERT INTO `categorieAn` (`categorieAn_id`, `categorieAn_libelle`, `categorieAn_code`) VALUES 
(1, 'Art, Antiquités', 'ARTAN'),
(2, 'Automobiles, Utilitaires', 'AUTOU'),
(3, 'Auto : Pièces, Accessoires', 'AUTOP'),
(4, 'Bateaux, Voile, Nautisme', 'BATVN'),
(5, 'Beauté, Bien-être, Parfums', 'BEAEP'),
(6, 'Bébé, Puériculture', 'BEBPU'),
(7, 'Bijoux, Montres', 'BIJMO'),
(8, 'Céramiques, Verres', 'CERVE');

-- --------------------------------------------------------

-- 
-- Structure de la table `categorieCult`
-- 

CREATE TABLE `categorieCult` (
  `categorieCult_id` int(11) NOT NULL auto_increment,
  `categorieCult_libelle` varchar(100) default NULL,
  `categorieCult_code` varchar(10) default NULL,
  PRIMARY KEY  (`categorieCult_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `categorieCult`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `commentAct`
-- 

CREATE TABLE `commentAct` (
  `commentAct_id` int(11) NOT NULL auto_increment,
  `commentAct_actualiteId` int(11) NOT NULL,
  `commentAct_utilisateurId` int(11) NOT NULL,
  `commentAct_texte` text NOT NULL,
  `commentAct_dateCreation` datetime default NULL,
  `commentAct_publier` tinyint(1) default NULL,
  PRIMARY KEY  (`commentAct_id`),
  KEY `actualiteCommentUtilisateur_FK` (`commentAct_actualiteId`),
  KEY `utilisateurCommentActualite_FK` (`commentAct_utilisateurId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `commentAct`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `commentCult`
-- 

CREATE TABLE `commentCult` (
  `commentCult_id` int(11) NOT NULL auto_increment,
  `commentCult_utilisateurId` int(11) NOT NULL,
  `commentCult_cultureId` int(11) NOT NULL,
  `commentCult_texte` text NOT NULL,
  `commentCult_dateCreation` datetime default NULL,
  `commentCult_publier` tinyint(1) default NULL,
  PRIMARY KEY  (`commentCult_id`),
  KEY `cultureCommentUtilisateur_FK` (`commentCult_cultureId`),
  KEY `utilisateurCommentCulture_FK` (`commentCult_utilisateurId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `commentCult`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `credit`
-- 

CREATE TABLE `credit` (
  `credit_id` int(11) NOT NULL auto_increment,
  `credit_abonnementId` int(11) NOT NULL default '0',
  `credit_forfaitId` int(11) NOT NULL,
  `credit_isPlus` tinyint(1) NOT NULL default '0',
  `credit_codePIN` varchar(20) NOT NULL,
  `credit_password` varchar(20) NOT NULL,
  `credit_dateUse` datetime default NULL,
  PRIMARY KEY  (`credit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=207 ;

-- 
-- Contenu de la table `credit`
-- 

INSERT INTO `credit` (`credit_id`, `credit_abonnementId`, `credit_forfaitId`, `credit_isPlus`, `credit_codePIN`, `credit_password`, `credit_dateUse`) VALUES 
(1, 0, 1, 1, 'NONMTWZE', '41858147038965', NULL),
(2, 0, 1, 1, 'DUDSDIJI', '67412361418125', NULL),
(3, 0, 1, 1, 'VOLQZULQ', '87254143898925', NULL),
(4, 0, 1, 1, 'VEFETSLM', '03236743674949', NULL),
(5, 0, 1, 1, 'LSHMNOLU', '29498381630165', NULL),
(6, 0, 1, 1, 'NOHSDONM', '01636745056105', NULL),
(7, 0, 1, 1, 'NIRKLSTE', '27232981498321', NULL),
(8, 0, 1, 1, 'HUNQFGZK', '01234501432929', NULL),
(9, 0, 1, 1, 'LEZQFMPW', '49474787434505', NULL),
(10, 0, 1, 1, 'TYPKLSZG', '45496923658529', NULL),
(11, 0, 1, 1, 'QFANQZQT', '92781610343816', NULL),
(12, 0, 1, 1, 'CLINMBOJ', '16345476301854', NULL),
(13, 0, 1, 1, 'IBKHWHSB', '98905836107050', NULL),
(14, 0, 1, 1, 'QLCLGFIZ', '14361816567432', NULL),
(15, 0, 1, 1, 'IFWRYRSZ', '78543634105676', NULL),
(16, 0, 1, 1, 'KFUNWRYN', '58543212309252', NULL),
(17, 0, 1, 1, 'KBAVWBAX', '10723238967876', NULL),
(18, 0, 1, 1, 'CLEVGHQP', '12325476143070', NULL),
(19, 0, 1, 1, 'OXWDCNWR', '94743856709416', NULL),
(20, 0, 1, 1, 'YHGHCBGP', '72125672789470', NULL),
(21, 0, 1, 1, 'HGNETGJY', '63252927658987', NULL),
(22, 0, 1, 1, 'LIVMFWZA', '45016701458927', NULL),
(23, 0, 1, 1, 'DSBMJOJY', '81496101410501', NULL),
(24, 0, 1, 1, 'JURSVWRG', '67812763014347', NULL),
(25, 0, 1, 1, 'BMXGPCLO', '27092745294769', NULL),
(26, 0, 1, 1, 'VMHEXCZY', '85416101230383', NULL),
(27, 0, 1, 1, 'TALQHUVU', '89830569656387', NULL),
(28, 0, 1, 1, 'TUJIXCLC', '05870925234529', NULL),
(29, 0, 1, 1, 'BYHCLUZG', '65652583436761', NULL),
(30, 0, 1, 1, 'XGBMBOBM', '83836143430921', NULL),
(31, 0, 1, 1, 'SVOZILEX', '16509612329610', NULL),
(32, 0, 1, 1, 'YVARSTSZ', '72521434341052', NULL),
(33, 0, 1, 1, 'ITOVKHAD', '18541674903610', NULL),
(34, 0, 1, 1, 'YJWDMBQD', '58725238309830', NULL),
(35, 0, 1, 1, 'INSZIJSH', '32529614903832', NULL),
(36, 0, 1, 1, 'CHMVYFEF', '18903238567698', NULL),
(37, 0, 1, 1, 'WRGBMJKD', '94567830127058', NULL),
(38, 0, 1, 1, 'EJUPUDSN', '36125836583038', NULL),
(39, 0, 1, 1, 'KFADKLKH', '10363012785856', NULL),
(40, 0, 1, 1, 'WFMLCXMH', '94727490765434', NULL),
(41, 0, 1, 1, 'ROVOVSLS', '25838529452721', NULL),
(42, 0, 1, 1, 'ROBIBYNE', '61032509498541', NULL),
(43, 0, 1, 1, 'PQZSVSFM', '23012309852345', NULL),
(44, 0, 1, 1, 'HANWVEDU', '67236929618521', NULL),
(45, 0, 1, 1, 'BAJEXGZI', '25078189210309', NULL),
(46, 0, 1, 1, 'JGFIJMVW', '89090929892345', NULL),
(47, 0, 1, 1, 'JWBUNIRS', '25454749816789', NULL),
(48, 0, 1, 1, 'VGLEBKTC', '43276383096101', NULL),
(49, 0, 1, 1, 'BURIBKBU', '07452981676907', NULL),
(50, 0, 1, 1, 'DGTSNQHG', '87290345876565', NULL),
(51, 0, 1, 1, 'JCNEFSLK', '09616327270569', NULL),
(52, 0, 1, 1, 'HCZMJQPM', '49218387496189', NULL),
(53, 0, 1, 1, 'VOXQZYBS', '07018921872701', NULL),
(54, 0, 1, 1, 'HEDIZODO', '27418785216385', NULL),
(55, 0, 1, 1, 'BUZKFAZA', '29472907830589', NULL),
(56, 0, 1, 1, 'TETWNYDK', '09498561838583', NULL),
(57, 0, 1, 1, 'XCJOXKJE', '65810983216923', NULL),
(58, 0, 1, 1, 'LARKXCHE', '49072961658147', NULL),
(59, 0, 1, 1, 'JGVQPSTO', '45032105254103', NULL),
(60, 0, 1, 1, 'PSFKNQDM', '41890125890767', NULL),
(61, 0, 1, 0, 'HKXIPWDQ', '87632549034923', NULL),
(62, 0, 1, 0, 'BERINGHE', '69650367214545', NULL),
(63, 0, 1, 0, 'ZQVARWPA', '03674529616749', NULL),
(64, 0, 1, 0, 'ZKRARETM', '67874563032969', NULL),
(65, 0, 1, 0, 'XEDKBYRU', '63050145490785', NULL),
(66, 0, 1, 0, 'RQPIJYNU', '01074947892703', NULL),
(67, 0, 1, 0, 'XAJOJOVU', '23878901698187', NULL),
(68, 0, 1, 0, 'XKZWFYXO', '41890527238961', NULL),
(69, 0, 1, 0, 'JQRKDIZU', '05858947492927', NULL),
(70, 0, 1, 0, 'XUDUHIDU', '83496565476329', NULL),
(71, 0, 1, 0, 'KZIDEHMD', '74181634945450', NULL),
(72, 0, 1, 0, 'YFMNOVEN', '16781254549698', NULL),
(73, 0, 1, 0, 'IRQNIBQZ', '32541416967278', NULL),
(74, 0, 1, 0, 'SZUFYPSJ', '52525494369896', NULL),
(75, 0, 1, 0, 'STONODIF', '70765416709050', NULL),
(76, 0, 1, 0, 'IHIZGNCN', '10929294525834', NULL),
(77, 0, 1, 0, 'OHGFMZWL', '32305852501856', NULL),
(78, 0, 1, 0, 'SJUXOJGD', '96301210581892', NULL),
(79, 0, 1, 0, 'MTIXKZAL', '16323690521230', NULL),
(80, 0, 1, 0, 'SRKTOROP', '50561298745898', NULL),
(81, 0, 1, 0, 'ZKFUXKVY', '83276543850789', NULL),
(82, 0, 1, 0, 'NGBUVSJK', '25830145854389', NULL),
(83, 0, 1, 0, 'RADMBCLC', '25496567456981', NULL),
(84, 0, 1, 0, 'JIFWTQZA', '81610969290965', NULL),
(85, 0, 1, 0, 'NQDARMLU', '07630369812127', NULL),
(86, 0, 1, 0, 'JGNWHEVY', '41414767416161', NULL),
(87, 0, 1, 0, 'JEVEVKFW', '01218907636743', NULL),
(88, 0, 1, 0, 'ZEVKJKNI', '89070785074349', NULL),
(89, 0, 1, 0, 'NUZCRUBK', '63612387274503', NULL),
(90, 0, 1, 0, 'TWVYTOXM', '05654183014387', NULL),
(91, 0, 1, 1, 'VYHQRCTQ', '27212941870169', NULL),
(92, 0, 1, 1, 'VILCVUHI', '25832947298785', NULL),
(93, 0, 1, 1, 'DYNCBODM', '47814123092369', NULL),
(94, 0, 1, 1, 'JATGPWJC', '05094747634503', NULL),
(95, 0, 1, 1, 'RYLYJCNA', '83218123016587', NULL),
(96, 0, 1, 1, 'JSZAPKTE', '45054305452521', NULL),
(97, 0, 1, 1, 'ZGHGZMHE', '25074383052383', NULL),
(98, 0, 1, 1, 'NYHABELC', '69618369638181', NULL),
(99, 0, 1, 1, 'BIFEJSBQ', '01894703674507', NULL),
(100, 0, 1, 1, 'VUTSLSHC', '05034709896925', NULL),
(101, 0, 1, 1, 'VMVONMBQ', '65610347078161', NULL),
(102, 0, 1, 1, 'VERMJQJE', '21256909854961', NULL),
(103, 0, 1, 1, 'RIDKPCVG', '05094781872589', NULL),
(104, 0, 1, 1, 'LEBUHGBS', '01052325818761', NULL),
(105, 0, 1, 1, 'NIVSXKBM', '81874589296905', NULL),
(106, 0, 1, 1, 'RCDWDCZG', '41672787272369', NULL),
(107, 0, 1, 1, 'TYJSPCTS', '43650723216161', NULL),
(108, 0, 1, 1, 'DQHEZSRC', '69472745290123', NULL),
(109, 0, 1, 1, 'NMHCBYZM', '21074165032741', NULL),
(110, 0, 1, 1, 'XIRILMLS', '41252147270369', NULL),
(111, 0, 1, 0, 'VCBCBYZW', '83232525618787', NULL),
(112, 0, 1, 0, 'PYHMXIVS', '41496747236327', NULL),
(113, 0, 1, 0, 'FSPCJEFK', '07658127098347', NULL),
(114, 0, 1, 0, 'ZIZGRGVG', '61416787054789', NULL),
(115, 0, 1, 0, 'RERITIXM', '85052581232563', NULL),
(116, 0, 1, 0, 'HOLMVEHQ', '63076341416945', NULL),
(117, 0, 1, 0, 'BCFMPEVI', '23634769236509', NULL),
(118, 0, 1, 0, 'HMNKHMFI', '07698747052161', NULL),
(119, 0, 1, 0, 'JYHUBAPI', '41832943472529', NULL),
(120, 0, 1, 0, 'XWNODSLQ', '25636783874941', NULL),
(121, 0, 1, 0, 'LAVQVIHI', '49452523250969', NULL),
(122, 0, 1, 0, 'XORORGJI', '29612169418723', NULL),
(123, 0, 1, 0, 'ZUHGTCVC', '25218941256501', NULL),
(124, 0, 1, 0, 'FQHEHITC', '41498583830725', NULL),
(125, 0, 1, 0, 'DGXIVUZE', '69234501070549', NULL),
(126, 0, 1, 0, 'PQXKXQRA', '49296345436583', NULL),
(127, 0, 1, 0, 'PELUPIZG', '07018701810107', NULL),
(128, 0, 1, 0, 'ZYVSZCHU', '81672545438503', NULL),
(129, 0, 1, 0, 'FOVIRGZG', '23492965852781', NULL),
(130, 0, 1, 0, 'LCXKLKPM', '63258529436989', NULL),
(131, 0, 1, 0, 'HEVEHUNW', '23056525874163', NULL),
(132, 0, 1, 0, 'PWNYRCLU', '69694349272543', NULL),
(133, 0, 1, 0, 'BIBALMBI', '29050129878787', NULL),
(134, 0, 1, 0, 'NCDQZYNU', '29236123454327', NULL),
(135, 0, 1, 0, 'NEFUZOVA', '45856963254509', NULL),
(136, 0, 1, 0, 'VEDYLUZE', '89496161212141', NULL),
(137, 0, 1, 0, 'VIHEFOHM', '23432385696963', NULL),
(138, 0, 1, 0, 'PQREZANS', '63234389838747', NULL),
(139, 0, 1, 0, 'ZYRKJKRU', '43478909470769', NULL),
(140, 0, 1, 0, 'TGLMJOZS', '61618941654347', NULL),
(141, 0, 1, 0, 'FQZWTOTM', '43898985214387', NULL),
(142, 0, 1, 0, 'BWPUNKJQ', '87616381074763', NULL),
(143, 0, 1, 0, 'DOHUXSDY', '61296527494545', NULL),
(144, 0, 1, 0, 'DOVGNMFU', '69234301016547', NULL),
(145, 0, 1, 0, 'ZANWDYFS', '89410761892163', NULL),
(146, 0, 1, 0, 'JEZWZMVI', '03472309094109', NULL),
(147, 0, 1, 0, 'BULQZOPW', '21454507890781', NULL),
(148, 0, 1, 0, 'JUBKRIBW', '05616385452989', NULL),
(149, 0, 1, 0, 'FWRWTKBY', '83632529812985', NULL),
(150, 0, 1, 0, 'FQXEVAPO', '81256547250303', NULL),
(151, 0, 1, 0, 'DAHCRKNA', '67272701410327', NULL),
(152, 0, 1, 0, 'FCFQFMHI', '81858187056909', NULL),
(153, 0, 1, 0, 'RGFABSTY', '69616107438723', NULL),
(154, 0, 1, 0, 'TADULCVS', '29050529832981', NULL),
(155, 0, 1, 0, 'DSNWLQZC', '81812705098767', NULL),
(156, 0, 1, 0, 'TEJKXKRY', '29290345050707', NULL),
(157, 0, 1, 0, 'TQVADQRK', '47634109850763', NULL),
(158, 0, 1, 0, 'RKTUXMFW', '43218185096763', NULL),
(159, 0, 1, 0, 'VOXSZABG', '43850589454923', NULL),
(160, 0, 1, 0, 'BUHCNEPU', '85278907096329', NULL),
(161, 0, 1, 0, 'HGHAPUXC', '49878309478565', NULL),
(162, 0, 1, 0, 'ZEXWRYHU', '67278101852325', NULL),
(163, 0, 1, 0, 'RGNYLOTM', '81818363450763', NULL),
(164, 0, 1, 0, 'FUTOTERC', '81696969676761', NULL),
(165, 0, 1, 0, 'JETUDETY', '67012163870541', NULL),
(166, 0, 1, 0, 'RCPUJUXW', '89878147838109', NULL),
(167, 0, 1, 0, 'BELCNYVW', '81852503036581', NULL),
(168, 0, 1, 0, 'RMDSHQNS', '67058507494109', NULL),
(169, 0, 1, 0, 'PWVGPAJM', '25656525636301', NULL),
(170, 0, 1, 0, 'HENQLUNC', '63278505052765', NULL),
(171, 0, 1, 0, 'ZCREFIZU', '45636129056781', NULL),
(172, 0, 1, 0, 'LOLIPCBS', '83690181410925', NULL),
(173, 0, 1, 0, 'JMXEBALK', '83034189896169', NULL),
(174, 0, 1, 0, 'FETUHQFQ', '07816503492583', NULL),
(175, 0, 1, 0, 'DMZOHCRI', '07414385612505', NULL),
(176, 0, 1, 0, 'FCTUJQLE', '85212723036301', NULL),
(177, 0, 1, 0, 'LKLIPILE', '45654907034325', NULL),
(178, 0, 1, 0, 'FERIRUTM', '27818369614709', NULL),
(179, 0, 1, 0, 'ZSLAVIZG', '67210509256343', NULL),
(180, 0, 1, 0, 'LMVEJIRW', '01470947474927', NULL),
(181, 0, 1, 1, 'XSNKRYTE', '45252181232145', NULL),
(182, 0, 1, 1, 'RGTIRQFU', '61216149838361', NULL),
(183, 0, 1, 1, 'XWDIPMZQ', '01472707274341', NULL),
(184, 0, 1, 1, 'NETGJYFO', '25292765898789', NULL),
(185, 0, 1, 1, 'VMFWZALE', '01670145892749', NULL),
(186, 0, 1, 1, 'BMJOJYRY', '49610141050163', NULL),
(187, 0, 1, 1, 'RSVWRGTW', '81276301434721', NULL),
(188, 0, 1, 1, 'XGPCLODY', '09274529476985', NULL),
(189, 0, 1, 1, 'HEXCZYZG', '41610123038323', NULL),
(190, 0, 1, 1, 'LQHUVUXS', '83056965638749', NULL),
(191, 0, 1, 1, 'JIXCLCBK', '87092523452925', NULL),
(192, 0, 1, 1, 'HCLUZGNE', '65258343676103', NULL),
(193, 0, 1, 1, 'BMBOBMTE', '83614343092145', NULL),
(194, 0, 1, 1, 'FUXKVYZM', '27654385078941', NULL),
(195, 0, 1, 1, 'BUVSJKZQ', '83014585438943', NULL),
(196, 0, 1, 1, 'DMBCLCDY', '49656745698121', NULL),
(197, 0, 1, 1, 'FWTQZANA', '61096929096589', NULL),
(198, 0, 1, 1, 'DARMLUZA', '63036981212741', NULL),
(199, 0, 1, 1, 'NWHEVYPI', '41476741616141', NULL),
(200, 0, 1, 1, 'VEVKFWJA', '21890763674385', NULL),
(201, 0, 1, 1, 'VKJKNIRE', '07078507434927', NULL),
(202, 0, 1, 0, 'ZCRUBKZK', '61238727450301', NULL),
(203, 0, 22, 1, 'ERMDILMN', '70381656129636', NULL),
(204, 0, 22, 1, 'IDETOLCV', '56749676941212', '2010-03-03 21:01:30'),
(205, 0, 6, 1, 'HYJMZQRO', '29612123036741', '2010-03-03 21:08:47'),
(206, 0, 11, 1, 'CTWJYTSH', '18707038303038', '2010-03-03 21:13:33');

-- --------------------------------------------------------

-- 
-- Structure de la table `culture`
-- 

CREATE TABLE `culture` (
  `culture_id` int(11) NOT NULL auto_increment,
  `culture_categorieCultId` int(11) NOT NULL,
  `culture_reference` varchar(20) NOT NULL,
  `culture_titre` varchar(150) NOT NULL,
  `culture_resume` text,
  `culture_texte` text,
  `culture_photo` varchar(100) default NULL,
  `culture_dateCreation` date default NULL,
  `culture_dateModification` date default NULL,
  `culture_datePublication` datetime default NULL,
  `culture_source` varchar(100) default NULL,
  `culture_vue` int(11) default NULL,
  `culture_fichier` varchar(100) default NULL,
  `culture_visite` int(11) NOT NULL,
  `culture_publier` tinyint(1) default NULL,
  PRIMARY KEY  (`culture_id`),
  KEY `categorieCulture_FK` (`culture_categorieCultId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `culture`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `emploi`
-- 

CREATE TABLE `emploi` (
  `emploi_id` int(11) NOT NULL auto_increment,
  `emploi_annonceId` int(11) NOT NULL,
  `emploi_raisonSocial` varchar(100) NOT NULL,
  `emploi_categorieEntreprise` int(11) NOT NULL,
  `emploi_adresse` varchar(100) default NULL,
  `emploi_cp` varchar(10) default NULL,
  `emploi_ville` varchar(100) default NULL,
  `emploi_contactNom` varchar(100) default NULL,
  `emploi_contactPrenom` varchar(100) default NULL,
  `emploi_contactFonction` varchar(100) default NULL,
  `emploi_contactTelephone` varchar(20) default NULL,
  `emploi_contactEmail` varchar(50) default NULL,
  `emploi_url` varchar(100) default NULL,
  `emploi_nbPoste` int(11) default NULL,
  `emploi_competence` text,
  `emploi_permanent` varchar(100) default NULL,
  `emploi_scolarite` varchar(250) default NULL,
  `emploi_experienceRequise` text,
  `emploi_communication` varchar(100) default NULL,
  PRIMARY KEY  (`emploi_id`),
  KEY `annonceEmploi_FK` (`emploi_annonceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `emploi`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `forfait`
-- 

CREATE TABLE `forfait` (
  `forfait_id` int(11) NOT NULL auto_increment,
  `forfait_packId` int(11) NOT NULL,
  `forfait_libelle` varchar(100) NOT NULL,
  `forfait_nbAnnonce` int(11) default NULL,
  `forfait_nbPhoto` int(11) default NULL,
  `forfait_nbCaractere` decimal(8,0) default NULL,
  `forfait_dureeParution` int(11) default NULL,
  `forfait_voirPhoto` tinyint(1) default NULL,
  `forfait_voirCoordonnee` tinyint(1) default NULL,
  `forfait_affichePhoto` tinyint(1) default NULL,
  `forfait_afficheCoordonnee` tinyint(1) default NULL,
  `forfait_ajoutLien` tinyint(1) default NULL,
  `forfait_hasPlus` tinyint(1) default NULL,
  `forfait_statistique` tinyint(1) default NULL,
  `forfait_texteMEV` tinyint(1) default NULL,
  `forfait_nbPhotoAdd` int(11) default NULL,
  `forfait_prix` float(8,2) default NULL,
  `forfait_prixPlus` float(8,2) default NULL,
  PRIMARY KEY  (`forfait_id`),
  KEY `packForfait_FK` (`forfait_packId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- 
-- Contenu de la table `forfait`
-- 

INSERT INTO `forfait` (`forfait_id`, `forfait_packId`, `forfait_libelle`, `forfait_nbAnnonce`, `forfait_nbPhoto`, `forfait_nbCaractere`, `forfait_dureeParution`, `forfait_voirPhoto`, `forfait_voirCoordonnee`, `forfait_affichePhoto`, `forfait_afficheCoordonnee`, `forfait_ajoutLien`, `forfait_hasPlus`, `forfait_statistique`, `forfait_texteMEV`, `forfait_nbPhotoAdd`, `forfait_prix`, `forfait_prixPlus`) VALUES 
(1, 1, '2 annonces', 2, 5, '600', 90, 1, 1, 1, 1, 0, 0, 0, 0, 0, 3000.00, 0.00),
(2, 1, '5 annonces', 5, 5, '600', 90, 1, 1, 1, 1, 0, 0, 1, 0, 0, 5000.00, 0.00),
(3, 1, '25 annonces', 25, 5, '1000', 90, 1, 1, 1, 1, 1, 0, 1, 0, 0, 8000.00, 0.00),
(4, 1, '50 annonces', 50, 5, '1000', 90, 1, 1, 1, 1, 1, 0, 1, 0, 0, 12000.00, 0.00),
(5, 2, '2 annonces', 2, 5, '600', 90, 1, 1, 1, 1, 0, 0, 0, 0, 0, 3000.00, 0.00),
(6, 2, '5 annonces', 5, 5, '600', 90, 1, 1, 1, 1, 0, 0, 1, 0, 0, 5000.00, 0.00),
(7, 2, '25 annonces', 25, 5, '1000', 90, 1, 1, 1, 1, 1, 0, 1, 0, 0, 8000.00, 0.00),
(8, 2, '50 annonces', 50, 5, '1000', 90, 1, 1, 1, 1, 1, 0, 1, 0, 0, 12000.00, 0.00),
(9, 3, '2 annonces', 2, 5, '600', 90, 1, 1, 1, 1, 0, 0, 0, 0, 0, 3000.00, 0.00),
(10, 3, '5 annonces', 5, 5, '600', 90, 1, 1, 1, 1, 0, 0, 1, 0, 0, 5000.00, 0.00),
(11, 3, '25 annonces', 25, 5, '1000', 90, 1, 1, 1, 1, 1, 0, 1, 0, 0, 8000.00, 0.00),
(12, 3, '50 annonces', 50, 5, '1000', 90, 1, 1, 1, 1, 1, 0, 1, 0, 0, 12000.00, 0.00),
(13, 5, '1 mois', 0, 0, '600', 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3000.00, 0.00),
(14, 5, '3 mois', 0, 0, '600', 90, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5000.00, 0.00),
(15, 5, '6 mois', 0, 0, '1000', 180, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8000.00, 0.00),
(16, 5, '12 mois', 0, 0, '1000', 360, 0, 0, 0, 0, 0, 0, 0, 0, 0, 12000.00, 0.00),
(17, 4, 'BRONZE 2 annonces', 2, 5, '600', 90, 1, 1, 1, 1, 0, 0, 0, 0, 0, 2000.00, 0.00),
(18, 4, 'BRONZE+ 2 annonces', 2, 5, '600', 90, 1, 1, 1, 1, 0, 0, 1, 0, 4, 2000.00, 1000.00),
(19, 4, 'ARGENT 5 annonces', 5, 5, '600', 90, 1, 1, 1, 1, 0, 0, 0, 0, 0, 5000.00, 0.00),
(20, 4, 'ARGENT+ 5 annonces', 5, 5, '600', 90, 1, 1, 1, 1, 0, 0, 1, 1, 4, 5000.00, 3000.00),
(21, 4, 'OR 25 annonces', 25, 5, '1000', 90, 1, 1, 1, 1, 1, 0, 0, 0, 0, 8000.00, 0.00),
(22, 4, 'OR+ 25 annonces', 25, 5, '1000', 90, 1, 1, 1, 1, 1, 1, 1, 1, 5, 8000.00, 6000.00),
(23, 4, 'PLATINE 50 annonces', 50, 5, '1000', 90, 1, 1, 1, 1, 1, 0, 0, 0, 0, 12000.00, 0.00),
(24, 4, 'PLATINE+ 50 annonces', 50, 5, '1000', 90, 1, 1, 1, 1, 1, 1, 1, 1, 5, 12000.00, 10000.00),
(25, 4, 'PELE-MELE 10 annonces', 10, 5, '600', 90, 1, 1, 1, 1, 1, 0, 1, 0, 0, 10000.00, 0.00);

-- --------------------------------------------------------

-- 
-- Structure de la table `immobilier`
-- 

CREATE TABLE `immobilier` (
  `immobilier_id` int(11) NOT NULL auto_increment,
  `immobilier_annonceId` int(11) NOT NULL,
  `immobilier_typePropriete` int(11) NOT NULL,
  `immobilier_typeBatiment` int(11) NOT NULL,
  `immobilier_nbChambre` decimal(8,0) default NULL,
  `immobilier_construction` varchar(20) default NULL,
  `immobilier_ventePar` varchar(100) default NULL,
  `immobilier_sousSolAmenage` tinyint(1) default NULL,
  `immobilier_dateOccupation` date default NULL,
  `immobilier_adresse` varchar(100) default NULL,
  `immobilier_cp` varchar(10) default NULL,
  `immobilier_terrainDimension` varchar(100) default NULL,
  `immobilier_terrainSuperficie` varchar(100) default NULL,
  `immobilier_batimentDimension` varchar(100) default NULL,
  `immobilier_superficieHabitable` varchar(100) default NULL,
  `immobilier_evaluationAnnee` varchar(100) default NULL,
  `immobilier_evaluationTerrain` varchar(100) default NULL,
  `immobilier_evaluationBatiment` varchar(100) default NULL,
  `immobilier_evaluationTotale` varchar(100) default NULL,
  `immobilier_taxeAnnuelle` float default NULL,
  `immobilier_chauffage` tinyint(1) default NULL,
  `immobilier_inclusion` varchar(250) default NULL,
  `immobilier_exclusion` varchar(250) default NULL,
  `immobilier_nbPiece` decimal(8,0) default NULL,
  `immobilier_nbSalleBain` decimal(8,0) default NULL,
  `immobilier_nbSalleEau` decimal(8,0) default NULL,
  `immobilier_salleFamilliale` text,
  `immobilier_cuisine` text,
  `immobilier_salleManger` text,
  `immobilier_salleEau` text,
  `immobilier_salon` text,
  `immobilier_chambrePrincipale` text,
  `immobilier_chambreAutres` text,
  `immobilier_salleBain` text,
  PRIMARY KEY  (`immobilier_id`),
  KEY `annonceImmobilier_FK` (`immobilier_annonceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `immobilier`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `pack`
-- 

CREATE TABLE `pack` (
  `pack_id` int(11) NOT NULL auto_increment,
  `pack_libelle` varchar(100) NOT NULL,
  `pack_code` varchar(10) default NULL,
  `pack_photo` varchar(100) default NULL,
  `pack_fichier` varchar(100) NOT NULL,
  PRIMARY KEY  (`pack_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Contenu de la table `pack`
-- 

INSERT INTO `pack` (`pack_id`, `pack_libelle`, `pack_code`, `pack_photo`, `pack_fichier`) VALUES 
(1, 'VEHICULES', 'VEHIC', 'vehicule_180_135.jpg', 'neov_000001.pdf'),
(2, 'IMMOBILIERS', 'IMMO', 'immobilier_180_135.jpg', 'neov_000002.pdf'),
(3, 'EMPLOIS', 'EMPLO', 'emploi_180_135.jpg', 'neov_000003.pdf'),
(4, 'AUTRES ANNONCES', 'AUANO', 'annonce_180_135.jpg', 'neov_000004.pdf'),
(5, 'VISITEURS', 'VISIT', 'visiteur_180_135.jpg', 'neov_000005.pdf');

-- --------------------------------------------------------

-- 
-- Structure de la table `pays`
-- 

CREATE TABLE `pays` (
  `pays_id` int(11) NOT NULL auto_increment,
  `pays_libelle` varchar(100) default NULL,
  `pays_code` varchar(10) default NULL,
  PRIMARY KEY  (`pays_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=243 ;

-- 
-- Contenu de la table `pays`
-- 

INSERT INTO `pays` (`pays_id`, `pays_libelle`, `pays_code`) VALUES 
(1, 'Afghanistan', 'AF'),
(2, 'Afrique du Sud', 'ZA'),
(3, 'Albanie', 'AL'),
(4, 'Algérie', 'DZ'),
(5, 'Allemagne', 'DE'),
(6, 'Andorre', 'AD'),
(7, 'Angola', 'AO'),
(8, 'Anguilla', 'AI'),
(9, 'Antarctique', 'AQ'),
(10, 'Antigua-et-Barbuda', 'AG'),
(11, 'Antilles néerlandaises', 'AN'),
(12, 'Arabie saoudite', 'SA'),
(13, 'Argentine', 'AR'),
(14, 'Arménie', 'AM'),
(15, 'Aruba', 'AW'),
(16, 'Australie', 'AU'),
(17, 'Autorité palestinienne', 'PS'),
(18, 'Autriche', 'AT'),
(19, 'Azerbaïdjan', 'AZ'),
(20, 'Bahamas', 'BS'),
(21, 'Bahreïn', 'BH'),
(22, 'Bangladesh', 'BD'),
(23, 'Barbade', 'BB'),
(24, 'Bélarus', 'BY'),
(25, 'Belgique', 'BE'),
(26, 'Belize', 'BZ'),
(27, 'Bénin', 'BJ'),
(28, 'Bermudes', 'BM'),
(29, 'Bhoutan', 'BT'),
(30, 'Bolivie', 'BO'),
(31, 'Bosnie-Herzégovine', 'BA'),
(32, 'Botswana', 'BW'),
(33, 'Bouvet (île)', 'BV'),
(34, 'Brésil', 'BR'),
(35, 'Brunei', 'BN'),
(36, 'Bulgarie', 'BG'),
(37, 'Burkina Faso', 'BF'),
(38, 'Burundi', 'BI'),
(39, 'Caïmans (îles)', 'KY'),
(40, 'Cambodge', 'KH'),
(41, 'Cameroun', 'CM'),
(42, 'Canada', 'CA'),
(43, 'Cap-Vert', 'CV'),
(44, 'Chili', 'CL'),
(45, 'Chine', 'CN'),
(46, 'Christmas (île)', 'CX'),
(47, 'Chypre', 'CY'),
(48, 'Cité du Vatican', 'VA'),
(49, 'Cocos-Keeling (îles)', 'CC'),
(50, 'Colombie', 'CO'),
(51, 'Comores', 'KM'),
(52, 'Congo', 'CG'),
(53, 'Congo (RDC)', 'CD'),
(54, 'Cook (îles)', 'CK'),
(55, 'Corée', 'KR'),
(56, 'Corée du Nord', 'KP'),
(57, 'Costa Rica', 'CR'),
(58, 'Côte d''Ivoire', 'CI'),
(59, 'Croatie', 'HR'),
(60, 'Cuba', 'CU'),
(61, 'Danemark', 'DK'),
(62, 'Dépendances américaines du Pacifique', 'UM'),
(63, 'Djibouti', 'DJ'),
(64, 'Dominique', 'DM'),
(65, 'Égypte', 'EG'),
(66, 'Émirats arabes unis', 'AE'),
(67, 'Équateur', 'EC'),
(68, 'Érythrée', 'ER'),
(69, 'Espagne', 'ES'),
(70, 'Estonie', 'EE'),
(71, 'États-Unis', 'US'),
(72, 'Éthiopie', 'ET'),
(73, 'Ex-République yougoslave de Macédoine', 'MK'),
(74, 'Falkland (îles) (îles Malouines)', 'FK'),
(75, 'Féroé (îles)', 'FO'),
(76, 'Fidji (îles)', 'FJ'),
(77, 'Finlande', 'FI'),
(78, 'France', 'FR'),
(79, 'Gabon', 'GA'),
(80, 'Gambie', 'GM'),
(81, 'Géorgie', 'GE'),
(82, 'Géorgie du Sud et Sandwich du Sud (îles)', 'GS'),
(83, 'Ghana', 'GH'),
(84, 'Gibraltar', 'GI'),
(85, 'Grèce', 'GR'),
(86, 'Grenade', 'GD'),
(87, 'Groenland', 'GL'),
(88, 'Guadeloupe', 'GP'),
(89, 'Guam', 'GU'),
(90, 'Guatemala', 'GT'),
(91, 'Guernesey', 'GG'),
(92, 'Guinée', 'GN'),
(93, 'Guinée équatoriale', 'GQ'),
(94, 'Guinée-Bissau', 'GW'),
(95, 'Guyana', 'GY'),
(96, 'Guyane française', 'GF'),
(97, 'Haïti', 'HT'),
(98, 'Heard et McDonald (îles)', 'HM'),
(99, 'Honduras', 'HN'),
(100, 'Hongrie', 'HU'),
(101, 'Inde', 'IN'),
(102, 'Indonésie', 'ID'),
(103, 'Irak', 'IQ'),
(104, 'Iran', 'IR'),
(105, 'Irlande', 'IE'),
(106, 'Islande', 'IS'),
(107, 'Israël', 'IL'),
(108, 'Italie', 'IT'),
(109, 'Jamaïque', 'JM'),
(110, 'Japon', 'JP'),
(111, 'Jersey', 'JE'),
(112, 'Jordanie', 'JO'),
(113, 'Kazakhstan', 'KZ'),
(114, 'Kenya', 'KE'),
(115, 'Kirghizistan', 'KG'),
(116, 'Kiribati', 'KI'),
(117, 'Koweït', 'KW'),
(118, 'La Réunion', 'RE'),
(119, 'Laos', 'LA'),
(120, 'Lesotho', 'LS'),
(121, 'Lettonie', 'LV'),
(122, 'Liban', 'LB'),
(123, 'Libéria', 'LR'),
(124, 'Libye', 'LY'),
(125, 'Liechtenstein', 'LI'),
(126, 'Lituanie', 'LT'),
(127, 'Luxembourg', 'LU'),
(128, 'Madagascar', 'MG'),
(129, 'Malawi', 'MW'),
(130, 'Malaysia', 'MY'),
(131, 'Maldives', 'MV'),
(132, 'Mali', 'ML'),
(133, 'Malte', 'MT'),
(134, 'Man (île de)', 'IM'),
(135, 'Mariannes du Nord (îles)', 'MP'),
(136, 'Maroc', 'MA'),
(137, 'Marshall (îles)', 'MH'),
(138, 'Martinique', 'MQ'),
(139, 'Maurice', 'MU'),
(140, 'Mauritanie', 'MR'),
(141, 'Mayotte', 'YT'),
(142, 'Mexique', 'MX'),
(143, 'Micronésie', 'FM'),
(144, 'Moldavie', 'MD'),
(145, 'Monaco', 'MC'),
(146, 'Mongolie', 'MN'),
(147, 'Monténégro', 'ME'),
(148, 'Montserrat', 'MS'),
(149, 'Mozambique', 'MZ'),
(150, 'Myanmar', 'MM'),
(151, 'Namibie', 'NA'),
(152, 'Nauru', 'NR'),
(153, 'Népal', 'NP'),
(154, 'Nicaragua', 'NI'),
(155, 'Niger', 'NE'),
(156, 'Nigeria', 'NG'),
(157, 'Niue', 'NU'),
(158, 'Norfolk (île)', 'NF'),
(159, 'Norvège', 'NO'),
(160, 'Nouvelle-Calédonie', 'NC'),
(161, 'Nouvelle-Zélande', 'NZ'),
(162, 'Oman', 'OM'),
(163, 'Ouganda', 'UG'),
(164, 'Ouzbékistan', 'UZ'),
(165, 'Pakistan', 'PK'),
(166, 'Palau', 'PW'),
(167, 'Panama', 'PA'),
(168, 'Papouasie-Nouvelle-Guinée', 'PG'),
(169, 'Paraguay', 'PY'),
(170, 'Pays-Bas', 'NL'),
(171, 'Pérou', 'PE'),
(172, 'Philippines', 'PH'),
(173, 'Pitcairn (îles)', 'PN'),
(174, 'Pologne', 'PL'),
(175, 'Polynésie française', 'PF'),
(176, 'Porto Rico', 'PR'),
(177, 'Portugal', 'PT'),
(178, 'Qatar', 'QA'),
(179, 'RAS de Hong Kong', 'HK'),
(180, 'RAS de Macao', 'MO'),
(181, 'République Centrafricaine', 'CF'),
(182, 'République dominicaine', 'DO'),
(183, 'République tchèque', 'CZ'),
(184, 'Roumanie', 'RO'),
(185, 'Royaume-Uni', 'UK'),
(186, 'Russie', 'RU'),
(187, 'Rwanda', 'RW'),
(188, 'Sainte-Hélène', 'SH'),
(189, 'Sainte-Lucie', 'LC'),
(190, 'Saint-Kitts-et-Nevis', 'KN'),
(191, 'Saint-Marin', 'SM'),
(192, 'Saint-Pierre-et-Miquelon', 'PM'),
(193, 'Saint-Vincent-et-les Grenadines', 'VC'),
(194, 'Salomon (îles)', 'SB'),
(195, 'Salvador', 'SV'),
(196, 'Samoa', 'WS'),
(197, 'Samoa américaines', 'AS'),
(198, 'São Tomé et Príncipe', 'ST'),
(199, 'Sénégal', 'SN'),
(200, 'Serbie', 'RS'),
(201, 'Seychelles', 'SC'),
(202, 'Sierra Leone', 'SL'),
(203, 'Singapour', 'SG'),
(204, 'Slovaquie', 'SK'),
(205, 'Slovénie', 'SI'),
(206, 'Somalie', 'SO'),
(207, 'Soudan', 'SD'),
(208, 'Sri Lanka', 'LK'),
(209, 'Suède', 'SE'),
(210, 'Suisse', 'CH'),
(211, 'Suriname', 'SR'),
(212, 'Svalbard et Jan Mayen (îles)', 'SJ'),
(213, 'Swaziland', 'SZ'),
(214, 'Syrie', 'SY'),
(215, 'Tadjikistan', 'TJ'),
(216, 'Taiwan', 'TW'),
(217, 'Tanzanie', 'TZ'),
(218, 'Tchad', 'TD'),
(219, 'Terres australes et antarctiques françaises', 'TF'),
(220, 'Territoire britannique (océan Indien)', 'IO'),
(221, 'Thaïlande', 'TH'),
(222, 'Timor-Leste (Timor-Oriental)', 'TP'),
(223, 'Togo', 'TG'),
(224, 'Tokelau', 'TK'),
(225, 'Tonga', 'TO'),
(226, 'Trinité-et-Tobago', 'TT'),
(227, 'Tunisie', 'TN'),
(228, 'Turkménistan', 'TM'),
(229, 'Turks et Caicos (îles)', 'TC'),
(230, 'Turquie', 'TR'),
(231, 'Tuvalu', 'TV'),
(232, 'Ukraine', 'UA'),
(233, 'Uruguay', 'UY'),
(234, 'Vanuatu', 'VU'),
(235, 'Venezuela', 'VE'),
(236, 'Vierges (îles), États-Unis', 'VI'),
(237, 'Vierges britanniques (îles)', 'VG'),
(238, 'Vietnam', 'VN'),
(239, 'Wallis-et-Futuna', 'WF'),
(240, 'Yémen', 'YE'),
(241, 'Zambie', 'ZM'),
(242, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

-- 
-- Structure de la table `photo`
-- 

CREATE TABLE `photo` (
  `photo_id` int(11) NOT NULL auto_increment,
  `photo_annonceId` int(11) NOT NULL,
  `photo_photo` varchar(100) NOT NULL,
  PRIMARY KEY  (`photo_id`),
  KEY `annoncePhoto_FK` (`photo_annonceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `photo`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `profil`
-- 

CREATE TABLE `profil` (
  `profil_id` int(11) NOT NULL auto_increment,
  `profil_libelle` varchar(100) default NULL,
  `profil_code` varchar(10) default NULL,
  PRIMARY KEY  (`profil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Contenu de la table `profil`
-- 

INSERT INTO `profil` (`profil_id`, `profil_libelle`, `profil_code`) VALUES 
(1, 'Super Administrateur', 'SADMI'),
(2, 'Administrateur', 'ADMIN'),
(3, 'Annonceur', 'ANNON'),
(4, 'Visiteur', 'VISIT'),
(5, 'Prestataire', 'PREST'),
(6, 'Client', 'CLI'),
(7, 'Partenaire', 'PART'),
(8, 'Employeur', 'EMPL'),
(9, 'Candidat', 'CAND');

-- --------------------------------------------------------

-- 
-- Structure de la table `rubrique`
-- 

CREATE TABLE `rubrique` (
  `rubrique_id` int(11) NOT NULL auto_increment,
  `rubrique_parentId` int(11) NOT NULL,
  `rubrique_categorieAnId` int(11) NOT NULL,
  `rubrique_level` int(11) NOT NULL,
  `rubrique_path` varchar(255) NOT NULL,
  `rubrique_libelle` varchar(100) NOT NULL,
  `rubrique_code` varchar(10) default NULL,
  PRIMARY KEY  (`rubrique_id`),
  KEY `categorieRubrique_FK` (`rubrique_categorieAnId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Contenu de la table `rubrique`
-- 

INSERT INTO `rubrique` (`rubrique_id`, `rubrique_parentId`, `rubrique_categorieAnId`, `rubrique_level`, `rubrique_path`, `rubrique_libelle`, `rubrique_code`) VALUES 
(1, 0, 2, 1, '/1/', 'Automobiles', 'AUTO'),
(2, 0, 2, 1, '/2/', 'Antiques/collection', 'ANTIC'),
(3, 0, 2, 1, '/3/', 'Camions', 'CAMI'),
(4, 5, 2, 3, '/1/5/4/', 'Modèles populaires', 'MODPO'),
(5, 1, 2, 2, '/1/5/', 'Autres modèles', 'AUTRM');

-- --------------------------------------------------------

-- 
-- Structure de la table `utilisateur`
-- 

CREATE TABLE `utilisateur` (
  `utilisateur_id` int(11) NOT NULL auto_increment,
  `utilisateur_paysId` int(11) NOT NULL,
  `utilisateur_profilId` int(11) NOT NULL,
  `utilisateur_nom` varchar(100) default NULL,
  `utilisateur_prenom` varchar(100) default NULL,
  `utilisateur_civilite` int(11) default NULL,
  `utilisateur_dateNaissance` date default NULL,
  `utilisateur_adresse` varchar(100) default NULL,
  `utilisateur_cp` varchar(10) default NULL,
  `utilisateur_ville` varchar(100) default NULL,
  `utilisateur_fonction` varchar(50) default NULL,
  `utilisateur_societe` varchar(50) default NULL,
  `utilisateur_telephone` varchar(20) default NULL,
  `utilisateur_email` varchar(50) default NULL,
  `utilisateur_login` varchar(20) default NULL,
  `utilisateur_password` varchar(20) default NULL,
  `utilisateur_dateCreation` date default NULL,
  `utilisateur_dateModification` date default NULL,
  `utilisateur_statut` smallint(6) default NULL,
  `utilisateur_question` smallint(6) default NULL,
  `utilisateur_reponse` varchar(50) default NULL,
  `utilisateur_photo` varchar(100) default NULL,
  `utilisateur_url` varchar(150) default NULL,
  PRIMARY KEY  (`utilisateur_id`),
  KEY `paysUtilisateur_FK` (`utilisateur_paysId`),
  KEY `profilUtilisateur_FK` (`utilisateur_profilId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Contenu de la table `utilisateur`
-- 

INSERT INTO `utilisateur` (`utilisateur_id`, `utilisateur_paysId`, `utilisateur_profilId`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_civilite`, `utilisateur_dateNaissance`, `utilisateur_adresse`, `utilisateur_cp`, `utilisateur_ville`, `utilisateur_fonction`, `utilisateur_societe`, `utilisateur_telephone`, `utilisateur_email`, `utilisateur_login`, `utilisateur_password`, `utilisateur_dateCreation`, `utilisateur_dateModification`, `utilisateur_statut`, `utilisateur_question`, `utilisateur_reponse`, `utilisateur_photo`, `utilisateur_url`) VALUES 
(1, 65, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 0, '1970-01-01', '23, rue de Naples', '75008', 'Paris VIII', 'Genaral Manager', 'DWORD Contulting SARL', '0033340472815', 's.rakotondrabe@dword-consulting.com', 'admin', 'admin', '2009-04-19', '2010-03-02', 1, 2, 'Réponse à la question', '4.jpg', 'www.dword-consulting.com'),
(2, 64, 2, 'Razafindrakoto', 'Tianarivo Lalasoa ', 1, '1976-11-10', '', '', '', NULL, NULL, NULL, 'tl.razafindrakoto@gmail.com', '', '1234567', NULL, NULL, 1, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Structure de la table `vehicule`
-- 

CREATE TABLE `vehicule` (
  `vehicule_id` int(11) NOT NULL auto_increment,
  `vehicule_annonceId` int(11) NOT NULL,
  `vehicule_origine` varchar(100) default NULL,
  `vehicule_marque` int(11) default NULL,
  `vehicule_modele` int(11) default NULL,
  `vehicule_version` varchar(100) default NULL,
  `vehicule_premiereMain` tinyint(1) default NULL,
  `vehicule_type` int(11) default NULL,
  `vehicule_transmission` int(11) default NULL,
  `vehicule_nbCylindre` int(11) default NULL,
  `vehicule_tailleMoteur` decimal(8,0) default NULL,
  `vehicule_motricite` int(11) default NULL,
  `vehicule_carburant` int(11) default NULL,
  `vehicule_kilometrage` decimal(8,0) default NULL,
  `vehicule_nbPorte` decimal(8,0) default NULL,
  `vehicule_nbPassager` decimal(8,0) default NULL,
  `vehicule_airClimatise` tinyint(1) default NULL,
  `vehicule_couleurExterne` varchar(20) default NULL,
  `vehicule_couleurInterne` varchar(20) default NULL,
  `vehicule_option` text,
  `vehicule_garantie` tinyint(1) default NULL,
  `vehicule_financement` varchar(250) default NULL,
  PRIMARY KEY  (`vehicule_id`),
  KEY `annonceVehicule_FK` (`vehicule_annonceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `vehicule`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `voyage`
-- 

CREATE TABLE `voyage` (
  `voyage_id` int(11) NOT NULL auto_increment,
  `voyage_annonceId` int(11) NOT NULL,
  `voyage_hotel` varchar(100) default NULL,
  `voyage_typeHebergement` int(11) NOT NULL,
  `voyage_nbEtoile` int(11) default NULL,
  `voyage_destination` varchar(100) default NULL,
  `voyage_ville` varchar(100) default NULL,
  `voyage_planRepas` varchar(100) default NULL,
  `voyage_descriptionSite` text,
  `voyage_modePaiement` text,
  `voyage_transport` varchar(100) default NULL,
  `voyage_autre` text,
  PRIMARY KEY  (`voyage_id`),
  KEY `annonceVoyage_FK` (`voyage_annonceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `voyage`
-- 


-- 
-- Contraintes pour les tables exportées
-- 

-- 
-- Contraintes pour la table `abonnement`
-- 
ALTER TABLE `abonnement`
  ADD CONSTRAINT `FK_forfaitAbonnement` FOREIGN KEY (`abonnement_forfaitId`) REFERENCES `forfait` (`forfait_id`),
  ADD CONSTRAINT `FK_utilisateurAbonnement` FOREIGN KEY (`abonnement_utilisateurId`) REFERENCES `utilisateur` (`utilisateur_id`);

-- 
-- Contraintes pour la table `actualite`
-- 
ALTER TABLE `actualite`
  ADD CONSTRAINT `FK_categorieActualite` FOREIGN KEY (`actualite_categorieActId`) REFERENCES `categorieact` (`categorieAct_id`);

-- 
-- Contraintes pour la table `annonce`
-- 
ALTER TABLE `annonce`
  ADD CONSTRAINT `FK_abonnementAnnonce` FOREIGN KEY (`annonce_abonnementId`) REFERENCES `abonnement` (`abonnement_id`),
  ADD CONSTRAINT `FK_rubriqueAnnonce` FOREIGN KEY (`annonce_rubriqueId`) REFERENCES `rubrique` (`rubrique_id`);

-- 
-- Contraintes pour la table `candidature`
-- 
ALTER TABLE `candidature`
  ADD CONSTRAINT `FK_annonceCandidature` FOREIGN KEY (`candidature_annonceId`) REFERENCES `annonce` (`annonce_id`);

-- 
-- Contraintes pour la table `commentAct`
-- 
ALTER TABLE `commentAct`
  ADD CONSTRAINT `FK_actualiteCommentUtilisateur` FOREIGN KEY (`commentAct_actualiteId`) REFERENCES `actualite` (`actualite_id`),
  ADD CONSTRAINT `FK_utilisateurCommentActualite` FOREIGN KEY (`commentAct_utilisateurId`) REFERENCES `utilisateur` (`utilisateur_id`);

-- 
-- Contraintes pour la table `commentCult`
-- 
ALTER TABLE `commentCult`
  ADD CONSTRAINT `FK_cultureCommentUtilisateur` FOREIGN KEY (`commentCult_cultureId`) REFERENCES `culture` (`culture_id`),
  ADD CONSTRAINT `FK_utilisateurCommentCulture` FOREIGN KEY (`commentCult_utilisateurId`) REFERENCES `utilisateur` (`utilisateur_id`);

-- 
-- Contraintes pour la table `culture`
-- 
ALTER TABLE `culture`
  ADD CONSTRAINT `FK_categorieCulture` FOREIGN KEY (`culture_categorieCultId`) REFERENCES `categoriecult` (`categorieCult_id`);

-- 
-- Contraintes pour la table `emploi`
-- 
ALTER TABLE `emploi`
  ADD CONSTRAINT `FK_annonceEmploi` FOREIGN KEY (`emploi_annonceId`) REFERENCES `annonce` (`annonce_id`);

-- 
-- Contraintes pour la table `forfait`
-- 
ALTER TABLE `forfait`
  ADD CONSTRAINT `FK_packForfait` FOREIGN KEY (`forfait_packId`) REFERENCES `pack` (`pack_id`);

-- 
-- Contraintes pour la table `immobilier`
-- 
ALTER TABLE `immobilier`
  ADD CONSTRAINT `FK_annonceImmobilier` FOREIGN KEY (`immobilier_annonceId`) REFERENCES `annonce` (`annonce_id`);

-- 
-- Contraintes pour la table `photo`
-- 
ALTER TABLE `photo`
  ADD CONSTRAINT `FK_annoncePhoto` FOREIGN KEY (`photo_annonceId`) REFERENCES `annonce` (`annonce_id`);

-- 
-- Contraintes pour la table `rubrique`
-- 
ALTER TABLE `rubrique`
  ADD CONSTRAINT `FK_categorieRubrique` FOREIGN KEY (`rubrique_categorieAnId`) REFERENCES `categoriean` (`categorieAn_id`);

-- 
-- Contraintes pour la table `utilisateur`
-- 
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_paysUtilisateur` FOREIGN KEY (`utilisateur_paysId`) REFERENCES `pays` (`pays_id`),
  ADD CONSTRAINT `FK_profilUtilisateur` FOREIGN KEY (`utilisateur_profilId`) REFERENCES `profil` (`profil_id`);

-- 
-- Contraintes pour la table `vehicule`
-- 
ALTER TABLE `vehicule`
  ADD CONSTRAINT `FK_annonceVehicule` FOREIGN KEY (`vehicule_annonceId`) REFERENCES `annonce` (`annonce_id`);

-- 
-- Contraintes pour la table `voyage`
-- 
ALTER TABLE `voyage`
  ADD CONSTRAINT `FK_annonceVoyage` FOREIGN KEY (`voyage_annonceId`) REFERENCES `annonce` (`annonce_id`);
