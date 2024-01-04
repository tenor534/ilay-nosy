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
(1, 'Véhicules', 'VEHIC'),
(2, 'Emplois', 'EMPLO'),
(3, 'Electronique', 'ELECT'),
(4, 'Informatique', 'INFO'),
(5, 'Rencontres','RENC'),
(6, 'Immobilier', 'IMMO'),
(7, 'Vacances/Voyages', 'VACVO'),
(8, 'Famille', 'FAMI'),
(9, 'Sports/Loisirs', 'SPORT'),
(10, 'Ameublement', 'AMME'),
(11, 'Outils/Matériaux', 'OUTI'),
(12, 'Equipements', 'EQUIP'),
(13, 'Animaux', 'ANIM'),
(14, 'Services', 'SRV'),
(15, 'Communautaire', 'COMMU'),
(16, 'Affaires', 'ARTAN'),
(17, 'Formations', 'FORM'),
(18, 'Beauté et bien être', 'BEAUT');




-- 
-- Contenu de la table `rubrique`
-- 

INSERT INTO `rubrique` (`rubrique_id`, `rubrique_parentId`, `rubrique_categorieAnId`, `rubrique_level`, `rubrique_path`, `rubrique_libelle`, `rubrique_code`) 
VALUES 
(1, 0, 1, 1, '/1/', 'Automobiles', 'AUTO'),
(2, 0, 2, 1, '/2/', 'Antiques/collection', 'ANTIC'),
(3, 0, 2, 1, '/3/', 'Camions', 'CAMI'),
(5, 1, 2, 2, '/1/5/', 'Autres modèles', 'AUTRM'),
(4, 5, 2, 3, '/1/5/4/', 'Modèles populaires', 'MODPO');



-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Ven 05 Mars 2010 à 12:23
-- Version du serveur: 5.0.45
-- Version de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de données: `ilayNosy`
-- 

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
  `rubrique_sortCode` varchar(255) NOT NULL,
  PRIMARY KEY  (`rubrique_id`),
  KEY `categorieRubrique_FK` (`rubrique_categorieAnId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- 
-- Contenu de la table `rubrique`
-- 


INSERT INTO `rubrique` (`rubrique_id`, `rubrique_parentId`, `rubrique_categorieAnId`, `rubrique_level`, `rubrique_path`, `rubrique_libelle`, `rubrique_code`, `rubrique_sortCode`) VALUES 
(1, 0, 1, 1, '/1/', 'Autos', 'AUTO', '001'),
(2, 1, 1, 2, '/1/2/', 'Antiques/collection', 'ANTIC', '001:001'),
(3, 1, 1, 2, '/1/3/', 'Camions légers', 'CAMI', '001:002'),
(4, 1, 1, 2, '/1/4/', 'Camions lourds', 'CAMLO', '001:003'),
(5, 1, 1, 2, '/1/5/', 'Minifourgonnettes', 'MINIF', '001:004'),
(6, 1, 1, 2, '/1/6/', 'Modèles populaires', 'MODPO', '001:005'),
(7, 1, 1, 2, '/1/7/', 'Utilitaires sport', 'UTISP', '001:006'),
(8, 1, 1, 2, '/1/8/', 'Voitures de prestige', 'VOIPR', '001:007'),
(9, 0, 1, 1, '/9/', 'Récréatifs', 'RECRE', '002'),
(10, 9, 1, 2, '/9/10/', 'Aériens', 'AERIE', '002:001'),
(11, 9, 1, 2, '/9/11/', 'Marins', 'MARI', '002:002'),
(12, 9, 1, 2, '/9/12/', 'Motos', 'MOTOS', '002:003'),
(13, 9, 1, 2, '/9/13/', 'Récréatifs', 'REMOR', '002:004'),
(14, 9, 1, 2, '/9/14/', 'VTT', 'VTT', '002:005'),
(15, 0, 1, 1, '/15/', 'Autres', 'AUTRE', '003'),
(16, 15, 1, 2, '/15/16/', 'Equipements', 'EQUIP', '003:001'),
(17, 15, 1, 2, '/15/17/', 'Machineries commerciales/agricoles', 'MACH', '003:002'),
(18, 15, 1, 2, '/15/18/', 'Moto - Pièces/acc./vêtements', 'MOTP', '003:003'),
(19, 15, 1, 2, '/15/19/', 'Pièces automobiles', 'PIECA', '003:004'),
(20, 15, 1, 2, '/15/20/', 'Pneus/roues', 'PNEU', '003:005'),
(21, 15, 1, 2, '/15/21/', 'Remorques', 'REMOR', '003:006'),
(22, 15, 1, 2, '/15/22/', 'Service/entretien', 'SERVI', '003:007'),
(23, 15, 1, 2, '/15/23/', 'Divers', 'DIVER', '003:008'),
(24, 0, 2, 1, '/24/', 'Carrières et Professions', 'CARPR', '004'),
(25, 24, 2, 2, '/24/25/', 'Achats/qualité', 'ACHQU', '004:001'),
(26, 24, 2, 2, '/24/26/', 'Administration/gestion', 'ADMIG', '004:002'),
(27, 24, 2, 2, '/24/27/', 'Artistique', 'ARTIS', '004:003'),
(28, 24, 2, 2, '/24/28/', 'Assurances/services financiers', 'ASSUF', '004:004'),
(29, 24, 2, 2, '/24/29/', 'Automobile/transport', 'AUTOT', '004:005'),
(30, 24, 2, 2, '/24/30/', 'Commerce de détail', 'COMDE', '004:006'),
(31, 24, 2, 2, '/24/31/', 'Comptabilité/finance', 'COMPF', '004:007'),
(32, 24, 2, 2, '/24/32/', 'Construction', 'CONST', '004:008'),
(33, 24, 2, 2, '/24/33/', 'Design', 'DESIG', '004:009'),
(34, 24, 2, 2, '/24/34/', 'Droit', 'DROIT', '004:010'),
(35, 24, 2, 2, '/24/35/', 'Education/formation', 'EDUCF', '004:011'),
(36, 24, 2, 2, '/24/36/', 'Génie/sciences', 'GENSC', '004:012'),
(37, 24, 2, 2, '/24/37/', 'Marketing/communication', 'MKTCO', '004:013'),
(38, 24, 2, 2, '/24/38/', 'Métiers', 'METIE', '004:014'),
(39, 24, 2, 2, '/24/39/', 'Production/manutentionP', 'PRODM', '004:015'),
(40, 24, 2, 2, '/24/40/', 'Ressources humaines', 'RESSH', '004:016'),
(41, 24, 2, 2, '/24/41/', 'Santé/services sociaux', 'SANTS', '004:017'),
(42, 24, 2, 2, '/24/42/', 'Securite', 'SECU', '004:018'),
(43, 24, 2, 2, '/24/43/', 'Services financiers', 'SRVFI', '004:019'),
(44, 24, 2, 2, '/24/44/', 'Soutien administratif', 'SOUTA', '004:020'),
(45, 24, 2, 2, '/24/45/', 'Technologies', 'TECHN', '004:021'),
(46, 24, 2, 2, '/24/46/', 'Tourisme/hôtellerie/restauration', 'THR', '004:022'),
(47, 24, 2, 2, '/24/47/', 'Transport', 'TRANS', '004:023'),
(48, 24, 2, 2, '/24/48/', 'Travail de bureau', 'TRAVB', '004:024'),
(49, 24, 2, 2, '/24/49/', 'Ventes/service à la clientèle', 'VESEC', '004:025'),
(50, 0, 2, 1, '/50/', 'Particulier à Particulier', 'PARTP', '005'),
(51, 50, 2, 2, '/50/51/', 'Artistes/musiciens', 'ARTM', '005:001'),
(52, 50, 2, 2, '/50/52/', 'Domestique/domicile', 'DOMD', '005:002'),
(53, 50, 2, 2, '/50/53/', 'Divers', 'DIVER', '005:003');
-- 
-- Contraintes pour les tables exportées
-- 

-- 
-- Contraintes pour la table `rubrique`
-- 
ALTER TABLE `rubrique`
  ADD CONSTRAINT `FK_categorieRubrique` FOREIGN KEY (`rubrique_categorieAnId`) REFERENCES `categoriean` (`categorieAn_id`);




