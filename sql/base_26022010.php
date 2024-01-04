-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Ven 26 Février 2010 à 22:17
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
  `abonnement_statut` tinyint(1) default NULL,
  PRIMARY KEY  (`abonnement_id`),
  KEY `forfaitAbonnement_FK` (`abonnement_forfaitId`),
  KEY `utilisateurAbonnement_FK` (`abonnement_utilisateurId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `abonnement`
-- 


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
  `annonce_forfaitId` int(11) NOT NULL,
  `annonce_utilisateurId` int(11) NOT NULL,
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
  KEY `utilisateurAnnonce_FK` (`annonce_utilisateurId`),
  KEY `forfaitAnnonce_FK` (`annonce_forfaitId`),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `forfait`
-- 

INSERT INTO `forfait` (`forfait_id`, `forfait_packId`, `forfait_libelle`, `forfait_nbAnnonce`, `forfait_nbPhoto`, `forfait_nbCaractere`, `forfait_dureeParution`, `forfait_voirPhoto`, `forfait_voirCoordonnee`, `forfait_affichePhoto`, `forfait_afficheCoordonnee`, `forfait_ajoutLien`, `forfait_hasPlus`, `forfait_statistique`, `forfait_texteMEV`, `forfait_nbPhotoAdd`, `forfait_prix`, `forfait_prixPlus`) VALUES 
(1, 1, 'Vehicule Express', 5, 5, '600', 65, 1, 1, 1, 1, 1, 1, 1, 0, 2, 5000.00, 2000.00);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Contenu de la table `pack`
-- 

INSERT INTO `pack` (`pack_id`, `pack_libelle`, `pack_code`, `pack_photo`, `pack_fichier`) VALUES 
(1, 'Vehicule', 'VEHIC', 'Bracelets manchette en peau de serpent_690_120.jpg', 'Arrêt Dugain I_000001.docx'),
(2, 'Immobilier', 'IMMO', 'IMG_0122_690_4.jpg', 'neov.pdf'),
(3, 'Epmloi', 'EMPL', '12139_1179303560119_1154046871_30504516_5674690_n_690_120.jpg', '001.jpg');

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
(1, 65, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 0, '0000-00-00', '23, rue de Naples', '75008', 'Paris VIII', 'Genaral Manager', 'DWORD Contulting SARL', '0033340472815', 's.rakotondrabe@dword-consulting.com', 'admin', 'admin', '2009-04-19', '2010-02-12', 1, 2, 'Réponse à la question', '4.jpg', 'www.dword-consulting.com'),
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
  ADD CONSTRAINT `FK_forfaitAnnonce` FOREIGN KEY (`annonce_forfaitId`) REFERENCES `forfait` (`forfait_id`),
  ADD CONSTRAINT `FK_rubriqueAnnonce` FOREIGN KEY (`annonce_rubriqueId`) REFERENCES `rubrique` (`rubrique_id`),
  ADD CONSTRAINT `FK_utilisateurAnnonce` FOREIGN KEY (`annonce_utilisateurId`) REFERENCES `utilisateur` (`utilisateur_id`);

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
