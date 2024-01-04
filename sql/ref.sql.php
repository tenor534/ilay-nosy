-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Ven 12 Février 2010 à 20:00
-- Version du serveur: 5.0.45
-- Version de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de données: `dwordconsulting`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `activite`
-- 

CREATE TABLE `activite` (
  `activite_id` int(11) NOT NULL,
  `activite_groupeId` int(11) NOT NULL,
  `activite_libelle` varchar(100) NOT NULL,
  `activite_description` text,
  `activite_publier` tinyint(4) NOT NULL,
  `activite_ordreAffichage` int(11) NOT NULL,
  PRIMARY KEY  (`activite_id`),
  KEY `assGroupeActivite_FK` (`activite_groupeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `activite`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `assActivitePage`
-- 

CREATE TABLE `assActivitePage` (
  `assActivitePage_activiteId` int(11) NOT NULL,
  `assActivitePage_pageId` int(11) NOT NULL,
  PRIMARY KEY  (`assActivitePage_activiteId`,`assActivitePage_pageId`),
  KEY `assActivitePage_FK` (`assActivitePage_activiteId`),
  KEY `assActivitePage2_FK` (`assActivitePage_pageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `assActivitePage`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `assProfilServiceDroit`
-- 

CREATE TABLE `assProfilServiceDroit` (
  `assProfilServiceDroit_droitId` int(11) NOT NULL,
  `assProfilServiceDroit_profilId` int(11) NOT NULL,
  `assProfilServiceDroit_serviceId` int(11) NOT NULL,
  PRIMARY KEY  (`assProfilServiceDroit_droitId`,`assProfilServiceDroit_profilId`,`assProfilServiceDroit_serviceId`),
  KEY `assProfilServiceDroit_assProfilServiceDroit_FK` (`assProfilServiceDroit_droitId`),
  KEY `assProfilServiceDroit_assProfilServiceDroit2_FK` (`assProfilServiceDroit_profilId`),
  KEY `assProfilServiceDroit_assProfilServiceDroit3_FK` (`assProfilServiceDroit_serviceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `assProfilServiceDroit`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `droit`
-- 

CREATE TABLE `droit` (
  `droit_id` int(11) NOT NULL auto_increment,
  `droit_libelle` varchar(100) NOT NULL,
  `droit_code` varchar(10) NOT NULL,
  PRIMARY KEY  (`droit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `droit`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `groupe`
-- 

CREATE TABLE `groupe` (
  `groupe_id` int(11) NOT NULL,
  `groupe_langueId` int(11) NOT NULL,
  `groupe_libelle` varchar(100) NOT NULL,
  `groupe_description` text,
  PRIMARY KEY  (`groupe_id`),
  KEY `assLangueGroupe_FK` (`groupe_langueId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `groupe`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `langue`
-- 

CREATE TABLE `langue` (
  `langue_id` int(11) NOT NULL auto_increment,
  `langue_libelle` varchar(100) NOT NULL,
  `langue_code` varchar(5) NOT NULL,
  `langue_flag` varchar(100) NOT NULL,
  PRIMARY KEY  (`langue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Contenu de la table `langue`
-- 

INSERT INTO `langue` (`langue_id`, `langue_libelle`, `langue_code`, `langue_flag`) VALUES 
(1, 'Français', 'FR', 'france_79_50_1.jpg'),
(2, 'Malagasy', 'MG', 'madagascar_79_50_1.jpg'),
(3, 'Anglais', 'UK', 'uk_79_50_1.jpg'),
(4, 'Espagnol', 'ESP', 'espagne_79_50.jpg'),
(5, 'Italien', 'IT', 'italie_79_50.jpg');

-- --------------------------------------------------------

-- 
-- Structure de la table `page`
-- 

CREATE TABLE `page` (
  `page_id` int(11) NOT NULL,
  `page_sectionId` int(11) NOT NULL,
  `page_titre` varchar(255) NOT NULL,
  `page_resume` text,
  `page_dateCreation` date default NULL,
  `page_texte` text,
  `page_dateModification` date default NULL,
  `page_datePublication` date default NULL,
  `page_document` varchar(100) default NULL,
  `page_typeDocument` int(11) default NULL,
  `page_publier` tinyint(1) NOT NULL,
  `page_ordreAffichage` int(11) default NULL,
  PRIMARY KEY  (`page_id`),
  KEY `assSectionPage_FK` (`page_sectionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `page`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `pays`
-- 

CREATE TABLE `pays` (
  `pays_id` int(11) NOT NULL auto_increment,
  `pays_libelle` varchar(100) NOT NULL,
  `pays_code` varchar(10) NOT NULL,
  PRIMARY KEY  (`pays_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=216 ;

-- 
-- Contenu de la table `pays`
-- 

INSERT INTO `pays` (`pays_id`, `pays_libelle`, `pays_code`) VALUES 
(4, 'Algeria', ''),
(5, 'Germany', ''),
(9, 'Saoudi Arabia', ''),
(30, 'Bulgaria', ''),
(49, 'Croatia', ''),
(51, 'Denmark', ''),
(64, 'Finland', ''),
(65, 'France', ''),
(66, 'Gabon', ''),
(69, 'Ghana', ''),
(70, 'Greece', 'GRE'),
(76, 'France Guyana', 'FRG'),
(79, 'Hungary', ''),
(82, 'Iraq', ''),
(83, 'Iran', ''),
(84, 'Ireland', ''),
(87, 'Italy', ''),
(100, 'Liberia', ''),
(104, 'Luxembourg', ''),
(111, 'Malta', ''),
(112, 'Marocco', ''),
(115, 'Mauritius', ''),
(119, 'Monaco', ''),
(128, 'Norway', ''),
(133, 'Pakistan', ''),
(143, 'Qatar', ''),
(144, 'Roumania', ''),
(150, 'Saint Martin', ''),
(161, 'Slovakia', ''),
(167, 'Switzerland', ''),
(174, 'Czech Republic', ''),
(180, 'Tunisia', ''),
(189, 'Vietnam', ''),
(207, 'Netherlands, The', ''),
(208, 'Austria', ''),
(209, 'Martinique', ''),
(211, 'Mayotte', ''),
(212, 'Sweden', ''),
(213, 'Dutch Antilles', ''),
(214, 'Guadeloupe', ''),
(215, 'Réunion', '');

-- --------------------------------------------------------

-- 
-- Structure de la table `profil`
-- 

CREATE TABLE `profil` (
  `profil_id` int(11) NOT NULL auto_increment,
  `profil_libelle` varchar(100) NOT NULL,
  `profil_code` varchar(10) NOT NULL,
  PRIMARY KEY  (`profil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Contenu de la table `profil`
-- 

INSERT INTO `profil` (`profil_id`, `profil_libelle`, `profil_code`) VALUES 
(1, 'Super Administrateur', 'SADMI'),
(2, 'Administrateur', 'ADMIN'),
(3, 'Collaborateur', 'COL');

-- --------------------------------------------------------

-- 
-- Structure de la table `section`
-- 

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL auto_increment,
  `section_langueId` int(11) NOT NULL,
  `section_libelle` varchar(100) NOT NULL,
  `section_description` text,
  `section_banniere` varchar(100) default NULL,
  `section_publier` int(11) NOT NULL,
  `section_ordreAffichage` int(11) NOT NULL,
  PRIMARY KEY  (`section_id`),
  KEY `assLangueSection_FK` (`section_langueId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Contenu de la table `section`
-- 

INSERT INTO `section` (`section_id`, `section_langueId`, `section_libelle`, `section_description`, `section_banniere`, `section_publier`, `section_ordreAffichage`) VALUES 
(1, 1, 'Accueil', NULL, 'Banner Oasis_690_120_1.jpg ', 0, 0),
(2, 1, 'Présentation', NULL, 'Banner Energade_690_120_1.jpg', 0, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `service`
-- 

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL auto_increment,
  `service_libelle` varchar(100) NOT NULL,
  `service_code` varchar(10) NOT NULL,
  PRIMARY KEY  (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Contenu de la table `service`
-- 

INSERT INTO `service` (`service_id`, `service_libelle`, `service_code`) VALUES 
(1, 'Administration', 'ADMIN'),
(2, 'Informatique', 'INFO'),
(3, 'Comptabilité', 'CPT'),
(4, 'Client', 'CLT');

-- --------------------------------------------------------

-- 
-- Structure de la table `session`
-- 

CREATE TABLE `session` (
  `session_id` int(11) NOT NULL auto_increment,
  `session_langueId` int(11) NOT NULL,
  `session_utilisateurId` int(11) NOT NULL,
  `session_sectionId` int(11) NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Contenu de la table `session`
-- 

INSERT INTO `session` (`session_id`, `session_langueId`, `session_utilisateurId`, `session_sectionId`) VALUES 
(2, 1, 2, 0),
(3, 4, 1, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `utilisateur`
-- 

CREATE TABLE `utilisateur` (
  `utilisateur_id` int(11) NOT NULL auto_increment,
  `utilisateur_paysId` int(11) NOT NULL,
  `utilisateur_serviceId` int(11) NOT NULL,
  `utilisateur_profilId` int(11) NOT NULL,
  `utilisateur_nom` varchar(100) NOT NULL,
  `utilisateur_prenom` varchar(100) default NULL,
  `utilisateur_fonction` varchar(50) default NULL,
  `utilisateur_societe` varchar(50) default NULL,
  `utilisateur_telephone` varchar(20) default NULL,
  `utilisateur_email` varchar(50) default NULL,
  `utilisateur_login` varchar(20) NOT NULL,
  `utilisateur_password` varchar(20) NOT NULL,
  `utilisateur_dateCreation` date default NULL,
  `utilisateur_statut` smallint(6) NOT NULL,
  PRIMARY KEY  (`utilisateur_id`),
  KEY `utilisateur_assServiceUtilisateur_FK` (`utilisateur_serviceId`),
  KEY `utilisateur_assProfilUtilisateur_FK` (`utilisateur_profilId`),
  KEY `utilisateur_assPaysUtilisateur_FK` (`utilisateur_paysId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `utilisateur`
-- 

INSERT INTO `utilisateur` (`utilisateur_id`, `utilisateur_paysId`, `utilisateur_serviceId`, `utilisateur_profilId`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_fonction`, `utilisateur_societe`, `utilisateur_telephone`, `utilisateur_email`, `utilisateur_login`, `utilisateur_password`, `utilisateur_dateCreation`, `utilisateur_statut`) VALUES 
(1, 65, 1, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 'Genaral Manager', 'DWORD Contulting SARL', '00261340472815', 's.rakotondrabe@dword-consulting.com', 'admin', 'admin', '2009-04-19', 1);

-- 
-- Contraintes pour les tables exportées
-- 

-- 
-- Contraintes pour la table `activite`
-- 
ALTER TABLE `activite`
  ADD CONSTRAINT `FK_assGroupeActivite` FOREIGN KEY (`activite_groupeId`) REFERENCES `groupe` (`groupe_id`);

-- 
-- Contraintes pour la table `assActivitePage`
-- 
ALTER TABLE `assActivitePage`
  ADD CONSTRAINT `FK_assActivitePage` FOREIGN KEY (`assActivitePage_activiteId`) REFERENCES `activite` (`activite_id`),
  ADD CONSTRAINT `FK_assActivitePage2` FOREIGN KEY (`assActivitePage_pageId`) REFERENCES `page` (`page_id`);

-- 
-- Contraintes pour la table `assProfilServiceDroit`
-- 
ALTER TABLE `assProfilServiceDroit`
  ADD CONSTRAINT `FK_assProfilServiceDroit` FOREIGN KEY (`assProfilServiceDroit_droitId`) REFERENCES `droit` (`droit_id`),
  ADD CONSTRAINT `FK_assProfilServiceDroit2` FOREIGN KEY (`assProfilServiceDroit_profilId`) REFERENCES `profil` (`profil_id`),
  ADD CONSTRAINT `FK_assProfilServiceDroit3` FOREIGN KEY (`assProfilServiceDroit_serviceId`) REFERENCES `service` (`service_id`);

-- 
-- Contraintes pour la table `groupe`
-- 
ALTER TABLE `groupe`
  ADD CONSTRAINT `FK_assLanqueGroupe` FOREIGN KEY (`groupe_langueId`) REFERENCES `langue` (`langue_id`);

-- 
-- Contraintes pour la table `page`
-- 
ALTER TABLE `page`
  ADD CONSTRAINT `FK_assSectionPage` FOREIGN KEY (`page_sectionId`) REFERENCES `section` (`section_id`);

-- 
-- Contraintes pour la table `section`
-- 
ALTER TABLE `section`
  ADD CONSTRAINT `FK_assLangueSection` FOREIGN KEY (`section_langueId`) REFERENCES `langue` (`langue_id`);

-- 
-- Contraintes pour la table `utilisateur`
-- 
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_assPaysUtilisateur` FOREIGN KEY (`utilisateur_paysId`) REFERENCES `pays` (`pays_id`),
  ADD CONSTRAINT `FK_assProfilUtilisateur` FOREIGN KEY (`utilisateur_profilId`) REFERENCES `profil` (`profil_id`),
  ADD CONSTRAINT `FK_assServiceUtilisateur` FOREIGN KEY (`utilisateur_serviceId`) REFERENCES `service` (`service_id`);
