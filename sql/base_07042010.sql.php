-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Jeu 08 Avril 2010 à 22:10
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Contenu de la table `abonnement`
-- 

INSERT INTO `abonnement` (`abonnement_id`, `abonnement_utilisateurId`, `abonnement_forfaitId`, `abonnement_reference`, `abonnement_dateDebut`, `abonnement_dateFin`, `abonnement_dateCreation`, `abonnement_credit`, `abonnement_creditPlus`, `abonnement_nbPlus`, `abonnement_statut`) VALUES 
(1, 1, 1, 'ab00010001', '2010-03-01', '2010-06-01', '2010-03-01 17:48:22', 3000, 0, 0, 1),
(2, 1, 3, 'ab00010003', '2010-02-01', '2010-05-01', '2010-01-01 10:48:22', 8000, 0, 0, 1),
(3, 1, 22, 'ab1221267638821', '2010-03-03', '2010-06-03', '2010-03-03 18:53:41', 8000, 6000, 1, 1),
(4, 1, 6, 'ab161267646810', '2010-03-03', '2010-06-03', '2010-03-03 21:06:50', 5000, 0, 0, 1),
(5, 1, 11, 'ab1111267647213', '2010-03-03', '2010-06-03', '2010-03-03 21:13:33', 8000, 0, 0, 1),
(7, 3, 1, 'ab311268812478', '2010-03-18', '2010-06-18', '2010-03-17 08:54:38', 3000, 0, 0, 1),
(8, 3, 20, 'ab3201268897569', NULL, NULL, '2010-03-18 08:32:49', 0, 0, 0, 3),
(9, 4, 2, 'ab421270021188', '2010-03-31', '2010-07-01', '2010-03-31 09:39:48', 5000, 0, 0, 1);

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
  `actualite_publierHome` tinyint(11) default NULL,
  `actualite_laUne` tinyint(11) default NULL,
  PRIMARY KEY  (`actualite_id`),
  KEY `categorieActualite_FK` (`actualite_categorieActId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `actualite`
-- 

INSERT INTO `actualite` (`actualite_id`, `actualite_categorieActId`, `actualite_reference`, `actualite_titre`, `actualite_resume`, `actualite_texte`, `actualite_photo`, `actualite_dateCreation`, `actualite_dateModification`, `actualite_datePublication`, `actualite_source`, `actualite_vue`, `actualite_fichier`, `actualite_visite`, `actualite_publier`, `actualite_publierHome`, `actualite_laUne`) VALUES 
(1, 2, 'ac000000000001', 'Titre de l''actualité', 'dfsdfsd', 'sdfsdf', 'IMG_02581.JPG', '2010-04-08', '2010-04-08', '2008-10-12 05:12:45', 'AFP', 0, 'Annonce Edition.docx', 0, 1, 1, 1);

-- --------------------------------------------------------

-- 
-- Structure de la table `annonce`
-- 

CREATE TABLE `annonce` (
  `annonce_id` int(11) NOT NULL auto_increment,
  `annonce_abonnementId` int(11) NOT NULL,
  `annonce_rubriqueId` int(11) NOT NULL,
  `annonce_localiteId` int(11) NOT NULL,
  `annonce_reference` varchar(20) NOT NULL,
  `annonce_titre` varchar(100) NOT NULL,
  `annonce_resume` text,
  `annonce_description` text,
  `annonce_offreId` int(11) NOT NULL,
  `annonce_prix` float default NULL,
  `annonce_prixInfo` varchar(100) default NULL,
  `annonce_annee` int(11) default NULL,
  `annonce_etat` smallint(6) default NULL,
  `annonce_contactNom` varchar(100) default NULL,
  `annonce_contactPrenom` varchar(100) default NULL,
  `annonce_contactEmail` varchar(50) default NULL,
  `annonce_contactAdresse` varchar(100) default NULL,
  `annonce_contactTelephone` varchar(20) default NULL,
  `annonce_contactPeriodeAppel` int(11) NOT NULL,
  `annonce_dateCreation` date default NULL,
  `annonce_dateModification` date default NULL,
  `annonce_dateDebut` datetime default NULL,
  `annonce_dateFin` date default NULL,
  `annonce_origine` varchar(100) default NULL,
  `annonce_action` int(11) default NULL,
  `annonce_visite` int(11) NOT NULL,
  `annonce_dateVisite` datetime default NULL,
  `annonce_publier` int(11) NOT NULL default '0',
  `annonce_publierHome` tinyint(1) NOT NULL default '0',
  `annonce_laUne` tinyint(1) NOT NULL default '0',
  `annonce_photo` varchar(100) NOT NULL,
  PRIMARY KEY  (`annonce_id`),
  KEY `abonnementAnnonce_FK` (`annonce_abonnementId`),
  KEY `rubriqueAnnonce_FK` (`annonce_rubriqueId`),
  KEY `localiteAnnonce_FK` (`annonce_localiteId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- Contenu de la table `annonce`
-- 

INSERT INTO `annonce` (`annonce_id`, `annonce_abonnementId`, `annonce_rubriqueId`, `annonce_localiteId`, `annonce_reference`, `annonce_titre`, `annonce_resume`, `annonce_description`, `annonce_offreId`, `annonce_prix`, `annonce_prixInfo`, `annonce_annee`, `annonce_etat`, `annonce_contactNom`, `annonce_contactPrenom`, `annonce_contactEmail`, `annonce_contactAdresse`, `annonce_contactTelephone`, `annonce_contactPeriodeAppel`, `annonce_dateCreation`, `annonce_dateModification`, `annonce_dateDebut`, `annonce_dateFin`, `annonce_origine`, `annonce_action`, `annonce_visite`, `annonce_dateVisite`, `annonce_publier`, `annonce_publierHome`, `annonce_laUne`, `annonce_photo`) VALUES 
(1, 2, 6, 2, 'an00000001', 'Mercedes 300D Turbo', 'dfsdf éééééééééééééééé', ' dfsdf àààààààààààààà', 1, 6e+006, NULL, 2000, 2, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 3, '2010-03-07', NULL, '2010-03-07 00:00:00', '2010-06-07', '', 5, 9, NULL, 1, 0, 0, ''),
(2, 2, 6, 3, 'an00000002', 'Mercedes 300D Turbo', 'dfsdf éééééééééééééééé', ' dfsdf àààààààààààààà', 1, 6e+006, NULL, 2000, 2, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 3, '2010-03-07', '2010-03-10', '2010-03-07 00:00:00', '2010-06-07', '', 5, 9, NULL, 1, 0, 0, ''),
(3, 2, 4, 3, 'an00000003', 'Mercedes Benz 1514 10T', 'fsdfsdf  eeeeeeeeeéééééééééééééééééééééééééàààààààààààààààà', 'sdfsdf éééééééééééééééééééééél'' asdfsdfà  ', 3, 2e+007, NULL, 2000, 2, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 1, '2010-03-07', '2010-03-10', '2010-03-07 00:00:00', '2010-06-07', '', 6, 5, NULL, 1, 0, 0, ''),
(4, 1, 7, 4, 'an00000004', 'Hyunday Sonata Elegance', 'sdfsdfsdééééééééééééééééé  voici une belle description d''  usine àààààààà', 'dfsdf\nsdfsdf\nsdfsdf\nsdfsdf\nsdfsdf', 1, 0, 'ferme', 0, 0, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 4, '2010-03-07', '2010-03-25', '2010-03-07 00:00:00', '2010-06-07', '', 4, 10, NULL, 1, 0, 0, ''),
(5, 1, 2, 2, 'an00000005', 'Toyota Camry Espadon', 'La perception des droits d''auteur se corse avec l''évolution des nouvelles technologies. L''utilisation des chansons pour les sonneries d''accueil de certains opérateurs mobiles constitue tout de même une aubaine pour les quelques artistes qui y sont proposés.', 'Certes, il ne s''excuse pas d?être obligé d''enclencher les sanctions contre les dirigeants transitoires, mais il juge simplement que les sanctions seront difficiles à éviter au cas où la Transition ne met pas rapidement en oeuvre l?application des accords politiques signés à Maputo et à Addis-Abeba. Andry Rajoelina et les siens ont donc jusqu?à aujourd?hui minuit pour changer d?avis sinon, demain, l?Union africaine appliquera les mesures qu?elle a déjà détaillées lors de la réunion du Conseil Paix et Sécurité, le 19 février dernier.\n« La décision d''imposer des sanctions a été prise. Lorsque le CPS se réunira, il ne discutera pas de l''imposition ou non des sanctions », a précisé Ramtane Lamamra, la semaine dernière. Cela indique une volonté d?aller au bout d?une logique qui a été affirmée tout au long de l?implication de la médiation internationale dans la résolution de la crise : celle de la politique du bâton et de la carotte, des sanctions dans le cas où les dirigeants transitoires n?appliquent pas le plan de sortie de crise concocté à Addis-Abeba, des aides financières dans le cas contraire. ', 2, 4.5e+007, 'négociable', 2009, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 6, '2010-03-07', '2010-03-16', '2010-03-07 00:00:00', '2010-06-07', '', 6, 16, NULL, 1, 1, 1, ''),
(6, 2, 5, 4, 'an00000006', 'Peugeot 504 Berline', 'éééééééééééééé', 'ééééééééééééééééééééé©Ã©', 3, 8e+006, NULL, 1978, 2, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 5, '2010-03-07', '2010-03-10', '2010-03-07 00:00:00', '2010-06-07', '', 6, 5, NULL, 1, 0, 0, ''),
(7, 2, 5, 4, 'an00000007', 'Peugeot 504 Berline', 'ferferf', 'zfzefzdf', 3, 8e+006, NULL, 1978, 2, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 5, '2010-03-07', '2010-03-10', '2010-03-07 00:00:00', '2010-06-07', '', 5, 6, NULL, 1, 0, 0, ''),
(8, 2, 5, 4, 'an00000008', 'Peugeot 504 Berline', 'Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©', 'Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©Ã©', 3, 8e+006, NULL, 1978, 2, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 5, '2010-03-07', NULL, '2010-03-07 00:00:00', '2010-06-07', '', 5, 6, NULL, 1, 0, 0, ''),
(9, 2, 3, 5, 'an00000009', 'Peugeot 504 Berline', 'sdsfdsféééééééé', 'ééééé', 1, 8e+006, NULL, 1978, 2, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 6, '2010-03-07', '2010-03-07', '2010-03-07 00:00:00', '2010-06-07', '', 5, 6, NULL, 0, 0, 0, ''),
(10, 2, 6, 2, 'an00000010', 'Mitsubishi Pajero', 'ééééééééé', 'ééééééééééééééé', 3, 160000, NULL, 2000, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 3, '2010-03-07', NULL, '2010-03-07 00:00:00', '2010-06-07', '', 4, 5, NULL, 1, 0, 0, ''),
(11, 5, 26, 3, 'an00000011', 'Secrétaire de direction', 'ééééééééééé', 'éééééééééééééé', 2, 400000, 'mensuel', 2010, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 6, '2010-03-07', '2010-03-16', '2010-03-07 00:00:00', '2010-06-07', '', 1, 4, NULL, 1, 0, 0, ''),
(12, 2, 6, 2, 'an00000012', 'Toyota Hiace 15 Places', 'Pt mdfhqsfhqsdfh  ééé', 'fqsdfqsdmfjqsoidf lmsdkfjqsod foqsidfjqs dfoiqsdjf ééééééééééééééé', 1, 1.6e+007, NULL, 2002, 2, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 1, '2010-03-08', NULL, '2010-03-08 00:00:00', '2010-06-08', '', 5, 8, NULL, 1, 0, 0, ''),
(13, 3, 160, 2, 'an00000013', 'A vendre un armoire de première classe', 'réqumé mdfkjqskdf', 'qlsdfj qsldfjqsmdf', 3, 40000, NULL, 1985, 2, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 4, '2010-03-10', NULL, '2010-03-10 00:00:00', '2010-06-10', '', 6, 2, NULL, 1, 1, 0, ''),
(14, 3, 164, 1, 'an00000014', 'Belle armoire ', 'sdfsdf', 'sdfsdf', 1, 1.4e+006, NULL, 2002, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 3, '2010-03-10', NULL, '2010-03-10 00:00:00', '2010-06-10', '', 6, 4, NULL, 0, 0, 0, ''),
(15, 3, 163, 3, 'an00000015', 'Armoire de classement', 'gdf éééé sdfsdf ', 'sdfsdf qsdfsqdf éééé', 2, 2.5e+006, NULL, 2005, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 4, '2010-03-10', NULL, '2010-03-10 00:00:00', '2010-06-10', '', 5, 3, NULL, 1, 1, 0, ''),
(16, 4, 95, 4, 'an00000016', 'Belle villa à étage', 'fsdfsd éééé', 'fsdfsdf', 3, 1e+008, NULL, 2000, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 6, '2010-03-11', NULL, '2010-03-11 00:00:00', '2010-06-11', '', 6, 3, NULL, 1, 0, 0, ''),
(17, 4, 91, 3, 'an00000017', 'Maison à louer', 'dfsdfsdf', 'sdfs', 1, 1e+006, NULL, 2000, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 6, '2010-03-11', NULL, '2010-03-11 00:00:00', '2010-06-11', '', 5, 10, NULL, 0, 0, 0, ''),
(18, 4, 95, 3, 'an00000018', 'Résidentiel', 'dfsdf', 'sdfsdf', 2, 5e+008, NULL, 1990, 2, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 6, '2010-03-11', NULL, '2010-03-11 00:00:00', '2010-06-11', '', 6, 5, NULL, 1, 0, 0, ''),
(19, 2, 8, 4, 'an00000019', 'Mitsubishi Pajero VX', 'sdfsdf', 'sdfsd', 1, 4e+007, NULL, 2006, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 's.rakotondrabe@dword-consulting.com', '23, rue de Naples', '0033340472815', 4, '2010-03-13', NULL, '2010-03-13 00:00:00', '2010-06-13', '', 6, 13, NULL, 0, 0, 0, ''),
(20, 4, 98, 17, 'an00000020', 'Des appartements à louer', 'fsqfdsdfsdf', 'dfqsfdsdfqsdfqsdf ééégégég', 3, 200000, 'par mois', 2010, 1, 'RATOVO', 'Haja', 'haja@ratovo.net', '45, avenue de l''indépendance', '0320456853', 6, '2010-03-16', NULL, '2010-03-16 00:00:00', '2010-06-16', '', 5, 10, NULL, 1, 1, 0, ''),
(21, 4, 100, 14, 'an00000021', 'Lifting séjour agréable', 'sdfsdfsdf', 'dfqsf ééé   fdfgdf', 1, 400000, 'par jour', 0, 0, 'RANDRIA', 'Baboul', 'haja@free.fr', 'Lot VC 32 bis J Ankadifotsy', '00340415246', 6, '2010-03-16', NULL, '2010-03-16 00:00:00', '2010-06-16', '', 5, 7, NULL, 1, 1, 0, ''),
(22, 4, 100, 14, 'an00000022', 'Lifting séjour agréable', 'sdfsdfsdf', 'dfqsf ééé   fdfgdf', 1, 400000, 'par jour', 0, 0, 'RANDRIA', 'Baboul', 'haja@free.fr', 'Lot VC 32 bis J Ankadifotsy', '00340415246', 6, '2010-03-16', NULL, '2010-03-16 00:00:00', '2010-06-16', '', 5, 7, NULL, 1, 1, 0, ''),
(23, 7, 5, 176, 'an0000000023', 'Renault Trafic', 'Résumé Résumé Résumé', 'Description générale Description générale Description générale', 3, 1.5e+007, 'négociable', 2002, 2, 'Horace', 'GRANT', 'grant@hotmail.fr', 'Lot VB 73 Ter G Ambatoroka', '00261340512536', 6, '2010-03-17', NULL, '2010-03-17 00:00:00', '2010-06-17', '', 6, 14, NULL, 1, 0, 0, ''),
(24, 7, 5, 176, 'an0000000024', 'Renault Express  Urgent', 'RésuméRésuméRésuméRésuméRésumé RésuméRésumé', 'Description générale Description générale Description générale', 1, 1e+007, 'négociable', 2000, 1, 'Horace', 'GRANT', 'grant@hotmail.fr', 'Lot VB 73 Ter G Ambatoroka', '00261340512536', 6, '2010-03-17', NULL, '2010-03-17 00:00:00', '2010-06-17', '', 6, 16, NULL, 1, 0, 1, ''),
(25, 8, 73, 118, 'an0000000025', 'Cherche une relation serieuse avec une jeune fille Malgache', 'Jh quarantaine, Franco-suisse , non buveur , non fumeur, 1m75, cadre , gentil , souriant, amoureux , chretien , celibataire , cherche une relation serieuse avec une jeune fille Malgache , belle et sexy ,\nréponse assurée avec des photos , ', 'Jh quarantaine, Franco-suisse , non buveur , non fumeur, 1m75, cadre , gentil , souriant, amoureux , chretien , celibataire , cherche une relation serieuse avec une jeune fille Malgache , belle et sexy ,\nréponse assurée avec des photos ', 1, 0, '', 0, 0, 'Horace', 'GRANT', 'grant@hotmail.fr', 'Lot VB 73 Ter G Ambatoroka', '00261340512536', 6, '2010-03-18', '2010-03-18', '2010-03-18 00:00:00', '2010-06-18', '', 8, 14, NULL, 1, 0, 0, ''),
(26, 8, 67, 15, 'an0000000026', 'cherche un ami etranger ou malgache entre 60 a 67ans', 'Une femme malgche cherche un ami etranger ou malgache entre 60 a 67ans pours casser solitude', 'Une femme malgche cherche un ami etranger ou malgache entre 60 a 67ans pours casser solitude', 1, 0, '', 0, 0, 'Horace', 'GRANT', 'srhelsah@gmail.com', 'Lot VB 73 Ter G Ambatoroka', '00261340512536', 6, '2010-03-18', NULL, '2010-03-18 00:00:00', '2010-06-18', '', 8, 5, NULL, 1, 0, 0, ''),
(27, 8, 84, 16, 'an0000000027', 'Nous recherchons une femme pour ménage à trois', ' un jeune couple malgche cherche un ami etranger ou malgache entre 60 a 67ans pours casser solitude\r\n', ' un jeune couple malgche cherche un ami etranger ou malgache entre 60 a 67ans pours casser solitude\r\n un jeune couple malgche cherche un ami etranger ou malgache entre 60 a 67ans pours casser solitude\r\n un jeune couple malgche cherche un ami etranger ou malgache entre 60 a 67ans pours casser solitude\r\n', 3, 0, '', 0, 0, 'Horace', 'GRANT', 'grant@hotmail.fr', 'Lot VB 73 Ter G Ambatoroka', '00261340512536', 4, '2010-03-18', '2010-03-25', '2010-03-18 00:00:00', '2010-06-18', '', 8, 5, NULL, 0, 0, 0, ''),
(28, 9, 6, 15, 'an0000000028', 'Renault Express vitrée', '', 'A vendre urgent, une belle Renault Express.....', 1, 1.2e+007, 'négociable', 1998, 2, 'TATAMA', 'Ivony', 'grant@yahoo.fr', 'Lot ...', '00261340556895', 6, '2010-03-31', NULL, '2010-03-31 00:00:00', '2010-07-01', '', 6, 2, NULL, 1, 1, 1, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Contenu de la table `categorieAct`
-- 

INSERT INTO `categorieAct` (`categorieAct_id`, `categorieAct_libelle`, `categorieAct_code`) VALUES 
(1, 'Actualité internationale', 'ACINT'),
(2, 'Actualité nationale', 'ACNAT'),
(3, 'Sport', 'SPORT'),
(4, 'Culture', 'CULTU'),
(5, 'Economie', 'ECONO'),
(6, 'Femme', 'FEMME'),
(7, 'Divers', 'DIVER'),
(8, 'High tech', 'HIGHT'),
(9, 'Monde', 'MONDE'),
(10, 'Société', 'SOCIE'),
(11, 'Météo', 'METEO');

-- --------------------------------------------------------

-- 
-- Structure de la table `categorieAn`
-- 

CREATE TABLE `categorieAn` (
  `categorieAn_id` int(11) NOT NULL auto_increment,
  `categorieAn_libelle` varchar(100) NOT NULL,
  `categorieAn_code` varchar(10) default NULL,
  PRIMARY KEY  (`categorieAn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- 
-- Contenu de la table `categorieAn`
-- 

INSERT INTO `categorieAn` (`categorieAn_id`, `categorieAn_libelle`, `categorieAn_code`) VALUES 
(1, 'Véhicules', 'VEHIC'),
(2, 'Emplois', 'EMPLO'),
(3, 'Electronique', 'ELECT'),
(4, 'Informatique', 'INFO'),
(5, 'Rencontres', 'RENC'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=259 ;

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
(206, 0, 11, 1, 'CTWJYTSH', '18707038303038', '2010-03-03 21:13:33'),
(207, 0, 1, 0, 'IZWLSXUR', '92103894967212', '2010-03-18 08:32:01'),
(208, 0, 2, 0, 'UVQTCZCZ', '72123054163698', '2010-03-31 09:43:00'),
(209, 0, 2, 0, 'UTMZYBIH', '18505094581816', NULL),
(210, 0, 2, 0, 'GJAVORGN', '98329274941274', NULL),
(211, 0, 2, 0, 'SLUHIJUZ', '94507430185490', NULL),
(212, 0, 2, 0, 'WJMTYLUL', '58363452747434', NULL),
(213, 0, 2, 0, 'QROXWXCP', '12303674123896', NULL),
(214, 0, 2, 0, 'QTKXSBQZ', '12389856745676', NULL),
(215, 0, 2, 0, 'EHKLQRCX', '58361254187416', NULL),
(216, 0, 2, 0, 'AHILELUL', '14549838781410', NULL),
(217, 0, 2, 0, 'QHUHWFSV', '58925038583698', NULL),
(218, 0, 2, 0, 'APITUREZ', '76181876701290', NULL),
(219, 0, 2, 0, 'YNSLGNCD', '16781834583696', NULL),
(220, 0, 2, 0, 'SBGHWJER', '72963834323838', NULL),
(221, 0, 2, 0, 'MZQPATWL', '58989010543696', NULL),
(222, 0, 2, 0, 'UHWLOPIZ', '92547478981438', NULL),
(223, 0, 2, 0, 'MFWBOPED', '90943494125052', NULL),
(224, 0, 2, 0, 'IJARUZIX', '32789650185652', NULL),
(225, 0, 2, 0, 'QNEFCPIV', '34301214965034', NULL),
(226, 0, 2, 0, 'AXCJKPUR', '14909052961014', NULL),
(227, 0, 2, 0, 'ELOJIJUP', '92389254725010', NULL),
(228, 0, 2, 0, 'QRAJSBSX', '70309412183494', NULL),
(229, 0, 2, 0, 'MZMXMDWB', '12503698141250', NULL),
(230, 0, 2, 0, 'MPMRULIV', '32903652721876', NULL),
(231, 0, 2, 0, 'UZODQXIZ', '74129630905618', NULL),
(232, 0, 2, 0, 'SBALIZAT', '76765672549254', NULL),
(233, 0, 2, 0, 'MDQTQVWP', '32745850525072', NULL),
(234, 0, 2, 0, 'YJSJUVSF', '92129890743832', NULL),
(235, 0, 2, 0, 'KXQTOPOR', '50587452781472', NULL),
(236, 0, 2, 0, 'QPUZCFKN', '74389230783490', NULL),
(237, 0, 2, 0, 'IJSNYBCD', '96103638929298', NULL),
(238, 0, 2, 0, 'URGPUFIF', '14321490981212', NULL),
(239, 0, 2, 0, 'CHEZWFOL', '52707452301492', NULL),
(240, 0, 2, 0, 'EJSBCLOH', '96385612969018', NULL),
(241, 0, 2, 0, 'UTMXEXQD', '56127656165674', NULL),
(242, 0, 2, 0, 'CPEBORYP', '12529092947438', NULL),
(243, 0, 2, 0, 'YXYXYVCJ', '74109654381832', NULL),
(244, 0, 2, 0, 'SLWLCDOV', '56185076569636', NULL),
(245, 0, 2, 0, 'QTSBKVOR', '96741018187890', NULL),
(246, 0, 2, 0, 'QFWFEPQD', '38147812745452', NULL),
(247, 0, 2, 0, 'SDSHGXWN', '94987290541216', NULL),
(248, 0, 2, 0, 'AHAFUROF', '12729690325494', NULL),
(249, 0, 2, 0, 'GTCRSFQD', '90385074105838', NULL),
(250, 0, 2, 0, 'MPCDKLEF', '92127098525658', NULL),
(251, 0, 2, 0, 'MLENELAZ', '78323474527632', NULL),
(252, 0, 2, 0, 'EPYLQVGV', '52523032181414', NULL),
(253, 0, 2, 0, 'CNCFEDYZ', '16365658543074', NULL),
(254, 0, 2, 0, 'KNYFQPYP', '10163816921478', NULL),
(255, 0, 2, 0, 'INUJUPGF', '90509814527236', NULL),
(256, 0, 2, 0, 'YDAXSJSD', '14709096769830', NULL),
(257, 0, 2, 0, 'ODCBOJOP', '50781652325678', NULL),
(258, 0, 2, 0, 'UBEFINKR', '14187638743054', NULL);

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
(3, 1, '25 annonces', 25, 5, '1000', 90, 1, 1, 1, 1, 1, 0, 1, 0, 4, 8000.00, 0.00),
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
-- Structure de la table `localite`
-- 

CREATE TABLE `localite` (
  `localite_id` int(11) NOT NULL auto_increment,
  `localite_provinceId` int(11) NOT NULL,
  `localite_libelle` varchar(100) NOT NULL,
  `localite_code` varchar(10) default NULL,
  PRIMARY KEY  (`localite_id`),
  KEY `provinceLocalite_FK` (`localite_provinceId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=217 ;

-- 
-- Contenu de la table `localite`
-- 

INSERT INTO `localite` (`localite_id`, `localite_provinceId`, `localite_libelle`, `localite_code`) VALUES 
(1, 1, 'Ambatolampy', '104'),
(2, 1, 'Ambatomanga', '116'),
(3, 1, 'Ambohibary Sambaina', '110'),
(4, 1, 'Ambohidratrimo', '105'),
(5, 1, 'Ambohimiadana', '106'),
(6, 1, 'Ampefy', '118'),
(7, 1, 'Analavory', '117'),
(8, 1, 'Andoharanofotsy', '102'),
(9, 1, 'Andramasina', '106'),
(10, 1, 'Andranonahoatra', '102'),
(11, 1, 'Anjozorobe', '107'),
(12, 1, 'Ankazobe', '108'),
(13, 1, 'Ankazomiriotra', '113'),
(14, 1, 'Antananarivo', '101'),
(15, 1, 'Antananarivo, Ambanidia', '101'),
(16, 1, 'Antananarivo, Ambohimanarina', '101'),
(17, 1, 'Antananarivo, Analakely', '101'),
(18, 1, 'Antananarivo, Andafiavaratra', '101'),
(19, 1, 'Antananarivo, Andravoahangy', '101'),
(20, 1, 'Antananarivo, Antanimena', '101'),
(21, 1, 'Antananarivo, Fiadanana', '101'),
(22, 1, 'Antananarivo, Tsaralalàna', '101'),
(23, 1, 'Antanetibe', '107'),
(24, 1, 'Antanifotsy', '109'),
(25, 1, 'Antsirabe', '110'),
(26, 1, 'Antsirabe, Asabotsy', '110'),
(27, 1, 'Arivonimamo', '112'),
(28, 1, 'Babetville Sakay', '119'),
(29, 1, 'Behenjy', '104'),
(30, 1, 'Betafo', '113'),
(31, 1, 'Faratsiho', '114'),
(32, 1, 'Fenoarivo', '115'),
(33, 1, 'Fihaonana', '108'),
(34, 1, 'Imerintsiatosika', '112'),
(35, 1, 'Ivato, Aéroport', '105'),
(36, 1, 'Mahitsy', '105'),
(37, 1, 'Mandoto', '113'),
(38, 1, 'Manjakandriana', '116'),
(39, 1, 'Mantasoa', '116'),
(40, 1, 'Miarinarivo', '117'),
(41, 1, 'Soavinandriana', '118'),
(42, 1, 'Talala Volonondry', '103'),
(43, 1, 'Tsiroanomandidy', '119'),
(44, 2, 'Ambadiangezoka', '205'),
(45, 2, 'Ambanja', '203'),
(46, 2, 'Ambilobe', '204'),
(47, 2, 'Ampanefena', '209'),
(48, 2, 'Andapa', '205'),
(49, 2, 'Anivorano Nord', '201'),
(50, 2, 'Antalaha', '206'),
(51, 2, 'Antsiranana', '201'),
(52, 2, 'Dzamandzar', '207'),
(53, 2, 'Jofreville', '202'),
(54, 2, 'Nosy Be', '207'),
(55, 2, 'Sambava', '208'),
(56, 2, 'Vohémar', '209'),
(57, 3, 'Alakamisy Itenina', '301'),
(58, 3, 'Alarobia Vohiposa', '305'),
(59, 3, 'Ambalavao', '303'),
(60, 3, 'Ambatofinandrahana', '304'),
(61, 3, 'Ambinanindrano', '306'),
(62, 3, 'Ambohimahasoa', '305'),
(63, 3, 'Ambohimanga Sud', '312'),
(64, 3, 'Amborompotsy', '304'),
(65, 3, 'Ambositra', '306'),
(66, 3, 'Ambovombe', '323'),
(67, 3, 'Ampasimanjeva', '316'),
(68, 3, 'Ankaramena', '303'),
(69, 3, 'Ankarinoro', '308'),
(70, 3, 'Antsenavolo', '317'),
(71, 3, 'Befotaka Sud', '318'),
(72, 3, 'Fandriana', '308'),
(73, 3, 'Farafangana', '309'),
(74, 3, 'Fiadanana', '308'),
(75, 3, 'Fianarantsoa', '301'),
(76, 3, 'Fianarantsoa, Tsianolondroa', '301'),
(77, 3, 'Fort Carnot', '310'),
(78, 3, 'Iakora', '311'),
(79, 3, 'Ifanadiana', '312'),
(80, 3, 'Ihosy', '313'),
(81, 3, 'Ikalamavony', '314'),
(82, 3, 'Ilaka', '306'),
(83, 3, 'Ivohibe', '315'),
(84, 3, 'Kianjavato', '317'),
(85, 3, 'Mahasoabe', '302'),
(86, 3, 'Mahazoarivo', '308'),
(87, 3, 'Manakara Sud', '316'),
(88, 3, 'Manampatrana', '310'),
(89, 3, 'Mananjary', '317'),
(90, 3, 'Midongy Sud', '318'),
(91, 3, 'Nosy Varika', '319'),
(92, 3, 'Ranohira', '313'),
(93, 3, 'Ranomafana', '312'),
(94, 3, 'Ranomena', '320'),
(95, 3, 'Sahamadio Fisakana', '308'),
(96, 3, 'Sahasinaka', '316'),
(97, 3, 'Sandrandahy', '308'),
(98, 3, 'Tanambao Mananjary', '317'),
(99, 3, 'Vangaindrano', '320'),
(100, 3, 'Vohilava', '317'),
(101, 3, 'Vohipeno', '321'),
(102, 3, 'Vondrozo', '322'),
(103, 4, 'Ambato-boeni', '403'),
(104, 4, 'Ambatomaintsy', '404'),
(105, 4, 'Anahidrano', '407'),
(106, 4, 'Analalava', '405'),
(107, 4, 'Andriamena', '421'),
(108, 4, 'Andriba', '412'),
(109, 4, 'Antonibe', '405'),
(110, 4, 'Antsakabary', '409'),
(111, 4, 'Antsalova', '406'),
(112, 4, 'Antsohihy', '407'),
(113, 4, 'Bealanana', '408'),
(114, 4, 'Befandriana Nord', '409'),
(115, 4, 'Besalampy', '410'),
(116, 4, 'Boanamary', '402'),
(117, 4, 'Kandreho', '412'),
(118, 4, 'Madirovalo', '403'),
(119, 4, 'Maevatanàna', '412'),
(120, 4, 'Mahajanga', '401'),
(121, 4, 'Mahajanga, Mahabibo', '401'),
(122, 4, 'Mahajanga Maritime', '401'),
(123, 4, 'Mahatsinjo', '412'),
(124, 4, 'Mahazoma', '412'),
(125, 4, 'Maintirano', '413'),
(126, 4, 'Mampikony', '414'),
(127, 4, 'Mandritsara', '415'),
(128, 4, 'Maromandia', '405'),
(129, 4, 'Marovoay', '416'),
(130, 4, 'Mitsinjo', '417'),
(131, 4, 'Morafenobe', '418'),
(132, 4, 'Namakia', '417'),
(133, 4, 'Port Bergé', '419'),
(134, 4, 'Sitampiky', '403'),
(135, 4, 'Soalala', '420'),
(136, 4, 'Tambohorano', '413'),
(137, 4, 'Tsaramandroso', '403'),
(138, 4, 'Tsaratanàna', '421'),
(139, 5, 'Ambatondrazaka', '503'),
(140, 5, 'Ambatosoratra', '503'),
(141, 5, 'Ambila Lemaitso', '508'),
(142, 5, 'Ambinanindrano Est', '510'),
(143, 5, 'Amboasary Mla', '514'),
(144, 5, 'Amboavory', '503'),
(145, 5, 'Ambohijanahary', '504'),
(146, 5, 'Amparafaravola', '504'),
(147, 5, 'Andaingo', '514'),
(148, 5, 'Andilamena', '505'),
(149, 5, 'Andilanatoby', '503'),
(150, 5, 'Anivorano Est', '508'),
(151, 5, 'Anjiro', '514'),
(152, 5, 'Anosibe an''Ala', '506'),
(153, 5, 'Antanambo', '507'),
(154, 5, 'Brickaville', '508'),
(155, 5, 'Fenerive Est', '509'),
(156, 5, 'Foulpointe', '502'),
(157, 5, 'Ilaka Est', '517'),
(158, 5, 'Imerimandroso', '503'),
(159, 5, 'Mahanoro', '510'),
(160, 5, 'Manakambahiny', '503'),
(161, 5, 'Mananara Nord', '511'),
(162, 5, 'Maroantsetra', '512'),
(163, 5, 'Marolambo', '513'),
(164, 5, 'Masomeloka', '510'),
(165, 5, 'Moramanga', '514'),
(166, 5, 'Morarano Chrome', '503'),
(167, 5, 'Perinet', '514'),
(168, 5, 'Ranomafana Est', '508'),
(169, 5, 'Sainte-Marie', '515'),
(170, 5, 'Soanierana Ivongo', '516'),
(171, 5, 'Station Alaotra', '503'),
(172, 5, 'Tanambe', '504'),
(173, 5, 'Toamasina', '501'),
(174, 5, 'Toamasina, Ambolomadinika', '501'),
(175, 5, 'Toamasina, Anjoma', '501'),
(176, 5, 'Toamasina, Maritime', '501'),
(177, 5, 'Vatomandry', '517'),
(178, 5, 'Vavatenina', '518'),
(179, 6, 'Ambalolahy', '617'),
(180, 6, 'Amboasary Sud', '603'),
(181, 6, 'Ambovombe', '604'),
(182, 6, 'Ampanihy Ouest', '605'),
(183, 6, 'Ankavandra', '617'),
(184, 6, 'Ankazoabo', '606'),
(185, 6, 'Ankilizato', '615'),
(186, 6, 'Antanimora', '604'),
(187, 6, 'Befandriana Sud', '618'),
(188, 6, 'Bekily', '607'),
(189, 6, 'Bekitro', '607'),
(190, 6, 'Belo Tsiribihina', '608'),
(191, 6, 'Beloha', '604'),
(192, 6, 'Benenitra', '610'),
(193, 6, 'Beraketa', '620'),
(194, 6, 'Berevo', '608'),
(195, 6, 'Beroroha', '611'),
(196, 6, 'Betioky', '612'),
(197, 6, 'Betroka', '613'),
(198, 6, 'Bezaha', '612'),
(199, 6, 'Ejeda', '605'),
(200, 6, 'Isoanala', '613'),
(201, 6, 'Mahabo', '615'),
(202, 6, 'Malaimbandy', '615'),
(203, 6, 'Manambaro', '614'),
(204, 6, 'Mandabe', '615'),
(205, 6, 'Manja', '616'),
(206, 6, 'Manombo', '602'),
(207, 6, 'Miandrivazo', '617'),
(208, 6, 'Morombe', '618'),
(209, 6, 'Morondava', '619'),
(210, 6, 'Sakaraha', '620'),
(211, 6, 'Tanandava', '618'),
(212, 6, 'Tolagnaro', '614'),
(213, 6, 'Toliara', '601'),
(214, 6, 'Toliary Sanfily', '601'),
(215, 6, 'Tsihombe', '621'),
(216, 6, 'Tsivory', '603');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=323 ;

-- 
-- Contenu de la table `photo`
-- 

INSERT INTO `photo` (`photo_id`, `photo_annonceId`, `photo_photo`) VALUES 
(1, 1, '1612111_1.jpg'),
(2, 1, '12122935_1.jpg'),
(3, 1, 'noPhoto.jpg'),
(4, 1, 'noPhoto.jpg'),
(5, 1, 'noPhoto.jpg'),
(6, 2, 'mb_300d_cplt_piece_0691091_-1.jpg'),
(7, 2, 'mb_300d_cplt_piece_0691091_-1.jpg'),
(8, 2, 'noPhoto.jpg'),
(9, 2, 'noPhoto.jpg'),
(10, 2, 'noPhoto.jpg'),
(11, 3, '28376581_1.jpg'),
(12, 3, 'Mese+Lusaka.jpg'),
(13, 4, 'HYSO0607.jpg'),
(14, 4, 'rendering-2010-hyundai-sonata-yf-1.jpg'),
(15, 4, '2009_Hyundai_Sonata_dash.jpg'),
(16, 4, '2009_Hyundai_Sonata_dash.jpg'),
(17, 5, '2007 Toyota Camry Hybrid.jpg'),
(18, 5, '05936_2009_Toyota_Camry.jpg'),
(19, 5, '0601_naias_03+2007_toyota_camry_se+front_interior_view.jpg'),
(20, 9, 'peugeot-504-34575.jpg'),
(21, 10, 'IM-1878-PAJERO-3-4-AVANT.jpg'),
(22, 11, 'v_dita_von_teese_s.jpg'),
(23, 9, 'noPhoto.jpg'),
(24, 9, 'noPhoto.jpg'),
(25, 9, 'noPhoto.jpg'),
(26, 9, 'noPhoto.jpg'),
(27, 9, 'noPhoto.jpg'),
(28, 9, 'noPhoto.jpg'),
(29, 9, 'noPhoto.jpg'),
(30, 9, 'noPhoto.jpg'),
(31, 3, '35250927_1.jpg'),
(32, 3, 'noPhoto.jpg'),
(33, 3, 'noPhoto.jpg'),
(34, 3, 'noPhoto.jpg'),
(35, 3, 'noPhoto.jpg'),
(36, 3, 'noPhoto.jpg'),
(37, 3, 'noPhoto.jpg'),
(38, 2, 'noPhoto.jpg'),
(39, 2, 'noPhoto.jpg'),
(40, 2, 'noPhoto.jpg'),
(41, 2, 'noPhoto.jpg'),
(42, 1, 'noPhoto.jpg'),
(43, 1, 'noPhoto.jpg'),
(44, 1, 'noPhoto.jpg'),
(45, 1, 'noPhoto.jpg'),
(46, 4, 'noPhoto.jpg'),
(47, 5, 'ToyotaCamrySportivo.jpg'),
(48, 5, 'noPhoto.jpg'),
(49, 12, '260_2_toyota_hiace_van_opt.jpg'),
(50, 12, 'Toyota_Hiace_(fifth_generation)_(Grand_Cabin)_(front),_Kuala_Lumpur.jpg'),
(51, 12, '24129-toyota-hi_ace-occasion.jpg'),
(52, 12, 'ToyotaHiace.jpg'),
(53, 12, 'noPhoto.jpg'),
(54, 12, 'noPhoto.jpg'),
(55, 12, 'noPhoto.jpg'),
(56, 12, 'noPhoto.jpg'),
(57, 12, 'noPhoto.jpg'),
(58, 6, '504.jpg'),
(59, 6, 'Peugeot-504.jpg'),
(60, 6, 'noPhoto.jpg'),
(61, 6, 'noPhoto.jpg'),
(62, 6, 'noPhoto.jpg'),
(63, 6, 'noPhoto.jpg'),
(64, 6, 'noPhoto.jpg'),
(65, 6, 'noPhoto.jpg'),
(66, 6, 'noPhoto.jpg'),
(67, 10, 'mitsu_pajero_2006_arr.jpg'),
(68, 10, 'mitsu_pajero_2006_arr1.jpg'),
(69, 10, 'IM-1878-PAJERO-3-4-AVANT.jpg'),
(70, 10, 'mitsu_pajero_2006_av.jpg'),
(71, 10, 'mitsu_pajero_2006_banq2.jpg'),
(72, 10, 'mitsu_pajero_2006_pro_3p.jpg'),
(73, 10, 'mitsu_pajero_2006_pro_5p.jpg'),
(74, 10, 'mitsu_pajero_2006_tdb.jpg'),
(75, 11, 'noPhoto.jpg'),
(76, 11, 'noPhoto.jpg'),
(77, 11, 'noPhoto.jpg'),
(78, 11, 'noPhoto.jpg'),
(79, 7, 'peugeot-504-34575.jpg'),
(80, 7, 'noPhoto.jpg'),
(81, 7, 'noPhoto.jpg'),
(82, 7, 'noPhoto.jpg'),
(83, 7, 'noPhoto.jpg'),
(84, 7, 'noPhoto.jpg'),
(85, 7, 'noPhoto.jpg'),
(86, 7, 'noPhoto.jpg'),
(87, 7, 'noPhoto.jpg'),
(88, 8, 'Peugeot-504.jpg'),
(89, 8, 'noPhoto.jpg'),
(90, 8, 'noPhoto.jpg'),
(91, 8, 'noPhoto.jpg'),
(92, 8, 'noPhoto.jpg'),
(93, 8, 'noPhoto.jpg'),
(94, 8, 'noPhoto.jpg'),
(95, 8, 'noPhoto.jpg'),
(96, 8, 'noPhoto.jpg'),
(97, 13, '56-armoire-mariage-normande-depoque-transition-1.jpg'),
(98, 13, 'noPhoto.jpg'),
(99, 13, 'noPhoto.jpg'),
(100, 13, 'noPhoto.jpg'),
(101, 13, 'noPhoto.jpg'),
(102, 13, 'noPhoto.jpg'),
(103, 13, 'noPhoto.jpg'),
(104, 13, 'noPhoto.jpg'),
(105, 13, 'noPhoto.jpg'),
(106, 13, 'noPhoto.jpg'),
(107, 14, '46717034photo-armoire-022-jpg.jpg'),
(108, 14, '96060716photo-armoire-021-jpg.jpg'),
(109, 14, 'noPhoto.jpg'),
(110, 14, 'noPhoto.jpg'),
(111, 14, 'noPhoto.jpg'),
(112, 14, 'noPhoto.jpg'),
(113, 14, 'noPhoto.jpg'),
(114, 14, 'noPhoto.jpg'),
(115, 14, 'noPhoto.jpg'),
(116, 14, 'noPhoto.jpg'),
(117, 15, '02640866-photo-armoire-dressing-infini.jpg'),
(118, 15, 'noPhoto.jpg'),
(119, 15, 'noPhoto.jpg'),
(120, 15, 'noPhoto.jpg'),
(121, 15, 'noPhoto.jpg'),
(122, 15, 'noPhoto.jpg'),
(123, 15, 'noPhoto.jpg'),
(124, 15, 'noPhoto.jpg'),
(125, 15, 'noPhoto.jpg'),
(126, 15, 'noPhoto.jpg'),
(127, 16, 'maison-a-vendre,a-lille-face.jpg'),
(128, 17, 'maison_martin_valliame_saint_andre_02.JPG'),
(129, 18, 'maison-81000.gif'),
(130, 18, 'maison-a-vendre,a-lille-face.jpg'),
(131, 18, 'Pont_sur_Sambre_La_Vieille_Maison_HD1_big.jpg'),
(132, 18, 'noPhoto.jpg'),
(133, 18, 'noPhoto.jpg'),
(134, 16, 'noPhoto.jpg'),
(135, 16, 'noPhoto.jpg'),
(136, 16, 'noPhoto.jpg'),
(137, 16, 'noPhoto.jpg'),
(138, 19, 'Mitsubishi_Pajero_001.jpg'),
(139, 19, 'mitsu_pajero_2006_arr1.jpg'),
(140, 19, 'noPhoto.jpg'),
(141, 19, 'noPhoto.jpg'),
(142, 19, 'noPhoto.jpg'),
(143, 19, 'noPhoto.jpg'),
(144, 19, 'noPhoto.jpg'),
(145, 19, 'noPhoto.jpg'),
(146, 19, 'noPhoto.jpg'),
(147, 20, 'a-34825.jpg'),
(148, 20, 'interieur_02.jpg'),
(149, 20, 'interieur-maison-ocean2.jpg'),
(150, 21, 'nng_images.jpg'),
(151, 21, 'interieur_021.jpg'),
(152, 21, 'interieur-maison-ocean21.jpg'),
(153, 21, 'maison-deco-interieur-360100.jpg'),
(154, 21, 'nng_images1.jpg'),
(155, 22, 'maison1.jpg'),
(156, 22, 'interieur_022.jpg'),
(157, 22, 'noPhoto.jpg'),
(158, 22, 'noPhoto.jpg'),
(159, 22, 'noPhoto.jpg'),
(160, 23, '49941.jpg'),
(161, 23, '01447276-photo-renault-trafic-combi-trafic-l1h1-1000-1-9-dci-80.jpg'),
(162, 23, '1950250_3.jpg'),
(163, 23, 'noPhoto.jpg'),
(164, 23, 'noPhoto.jpg'),
(165, 24, '27302_Renault_Express.jpg'),
(166, 24, '27303_Renault_Express.jpg'),
(167, 24, '2207108_1.jpg'),
(168, 24, '2596215_2.jpg'),
(169, 24, '2596215_1.jpg'),
(170, 25, 'Picture00021.jpg'),
(171, 25, 'Picture0009.jpg'),
(172, 25, 'Picture0020.jpg'),
(173, 25, 'Picture0025.jpg'),
(174, 25, 'noPhoto.jpg'),
(175, 25, 'noPhoto.jpg'),
(176, 25, 'noPhoto.jpg'),
(177, 25, 'noPhoto.jpg'),
(178, 25, 'noPhoto.jpg'),
(179, 26, 'SEHENO ANDRIANANTENAINA4.jpg'),
(180, 26, 'ZO HERILALAINA7.jpg'),
(181, 26, 'noPhoto.jpg'),
(182, 26, 'noPhoto.jpg'),
(183, 26, 'noPhoto.jpg'),
(184, 26, 'noPhoto.jpg'),
(185, 26, 'noPhoto.jpg'),
(186, 26, 'noPhoto.jpg'),
(187, 26, 'noPhoto.jpg'),
(188, 27, 'DSCN5683.JPG'),
(189, 27, '399606_920.jpg'),
(190, 27, '296191_920.jpg'),
(191, 27, '21963_106111502738494_100000189354582_158954_514388_n.jpg'),
(192, 27, '363904_920.jpg'),
(193, 27, '21963_105841476098830_100000189354582_151237_5813833_n.jpg'),
(194, 27, 'SEHENO ANDRIANANTENAINA.jpg'),
(195, 27, 'noPhoto.jpg'),
(196, 27, 'noPhoto.jpg'),
(197, 28, '8710505_1.jpg'),
(198, 28, '9326325_2.jpg'),
(199, 28, '2596215_2.jpg'),
(200, 28, 'noPhoto.jpg'),
(201, 28, 'noPhoto.jpg'),
(202, 1, 'noPhoto.jpg'),
(203, 1, 'noPhoto.jpg'),
(204, 1, 'noPhoto.jpg'),
(205, 1, 'noPhoto.jpg'),
(206, 1, 'noPhoto.jpg'),
(207, 1, 'noPhoto.jpg'),
(208, 1, 'noPhoto.jpg'),
(209, 1, 'noPhoto.jpg'),
(210, 1, 'noPhoto.jpg'),
(211, 1, 'noPhoto.jpg'),
(212, 1, 'noPhoto.jpg'),
(213, 1, 'noPhoto.jpg'),
(214, 1, 'noPhoto.jpg'),
(215, 1, 'noPhoto.jpg'),
(216, 1, 'noPhoto.jpg'),
(217, 1, 'noPhoto.jpg'),
(218, 1, 'noPhoto.jpg'),
(219, 1, 'noPhoto.jpg'),
(220, 1, 'noPhoto.jpg'),
(221, 1, 'noPhoto.jpg'),
(222, 1, 'noPhoto.jpg'),
(223, 1, 'noPhoto.jpg'),
(224, 1, 'noPhoto.jpg'),
(225, 1, 'noPhoto.jpg'),
(226, 1, 'noPhoto.jpg'),
(227, 1, 'noPhoto.jpg'),
(228, 1, 'noPhoto.jpg'),
(229, 1, 'noPhoto.jpg'),
(230, 1, 'noPhoto.jpg'),
(231, 1, 'noPhoto.jpg'),
(232, 1, 'noPhoto.jpg'),
(233, 1, 'noPhoto.jpg'),
(234, 1, 'noPhoto.jpg'),
(235, 1, 'noPhoto.jpg'),
(236, 1, 'noPhoto.jpg'),
(237, 1, 'noPhoto.jpg'),
(238, 1, 'noPhoto.jpg'),
(239, 1, 'noPhoto.jpg'),
(240, 1, 'noPhoto.jpg'),
(241, 1, 'noPhoto.jpg'),
(242, 1, 'noPhoto.jpg'),
(243, 1, 'noPhoto.jpg'),
(244, 1, 'noPhoto.jpg'),
(245, 1, 'noPhoto.jpg'),
(246, 1, 'noPhoto.jpg'),
(247, 1, 'noPhoto.jpg'),
(248, 1, 'noPhoto.jpg'),
(249, 1, 'noPhoto.jpg'),
(250, 1, 'noPhoto.jpg'),
(251, 1, 'noPhoto.jpg'),
(252, 1, 'noPhoto.jpg'),
(253, 1, 'noPhoto.jpg'),
(254, 1, 'noPhoto.jpg'),
(255, 1, 'noPhoto.jpg'),
(256, 1, 'noPhoto.jpg'),
(257, 1, 'noPhoto.jpg'),
(258, 1, 'noPhoto.jpg'),
(259, 1, 'noPhoto.jpg'),
(260, 1, 'noPhoto.jpg'),
(261, 1, 'noPhoto.jpg'),
(262, 1, 'noPhoto.jpg'),
(263, 1, 'noPhoto.jpg'),
(264, 1, 'noPhoto.jpg'),
(265, 1, 'noPhoto.jpg'),
(266, 1, 'noPhoto.jpg'),
(267, 1, 'noPhoto.jpg'),
(268, 1, 'noPhoto.jpg'),
(269, 1, 'noPhoto.jpg'),
(270, 1, 'noPhoto.jpg'),
(271, 1, 'noPhoto.jpg'),
(272, 1, 'noPhoto.jpg'),
(273, 1, 'noPhoto.jpg'),
(274, 1, 'noPhoto.jpg'),
(275, 1, 'noPhoto.jpg'),
(276, 1, 'noPhoto.jpg'),
(277, 1, 'noPhoto.jpg'),
(278, 1, 'noPhoto.jpg'),
(279, 1, 'noPhoto.jpg'),
(280, 1, 'noPhoto.jpg'),
(281, 1, 'noPhoto.jpg'),
(282, 1, 'noPhoto.jpg'),
(283, 1, 'noPhoto.jpg'),
(284, 1, 'noPhoto.jpg'),
(285, 1, 'noPhoto.jpg'),
(286, 1, 'noPhoto.jpg'),
(287, 1, 'noPhoto.jpg'),
(288, 1, 'noPhoto.jpg'),
(289, 1, 'noPhoto.jpg'),
(290, 1, 'noPhoto.jpg'),
(291, 1, 'noPhoto.jpg'),
(292, 1, 'noPhoto.jpg'),
(293, 1, 'noPhoto.jpg'),
(294, 1, 'noPhoto.jpg'),
(295, 1, 'noPhoto.jpg'),
(296, 1, 'noPhoto.jpg'),
(297, 1, 'noPhoto.jpg'),
(298, 1, 'noPhoto.jpg'),
(299, 1, 'noPhoto.jpg'),
(300, 1, 'noPhoto.jpg'),
(301, 1, 'noPhoto.jpg'),
(302, 1, 'noPhoto.jpg'),
(303, 1, 'noPhoto.jpg'),
(304, 1, 'noPhoto.jpg'),
(305, 1, 'noPhoto.jpg'),
(306, 1, 'noPhoto.jpg'),
(307, 1, 'noPhoto.jpg'),
(308, 1, 'noPhoto.jpg'),
(309, 1, 'noPhoto.jpg'),
(310, 1, 'noPhoto.jpg'),
(311, 1, 'noPhoto.jpg'),
(312, 1, 'noPhoto.jpg'),
(313, 1, 'noPhoto.jpg'),
(314, 1, 'noPhoto.jpg'),
(315, 1, 'noPhoto.jpg'),
(316, 1, 'noPhoto.jpg'),
(317, 1, 'noPhoto.jpg'),
(318, 1, 'noPhoto.jpg'),
(319, 1, 'noPhoto.jpg'),
(320, 1, 'noPhoto.jpg'),
(321, 1, 'noPhoto.jpg'),
(322, 1, 'noPhoto.jpg');

-- --------------------------------------------------------

-- 
-- Structure de la table `photoAct`
-- 

CREATE TABLE `photoAct` (
  `photo_id` int(11) NOT NULL auto_increment,
  `photo_actualiteId` int(11) NOT NULL,
  `photo_photo` varchar(100) NOT NULL,
  PRIMARY KEY  (`photo_id`),
  KEY `actualitePhoto_FK` (`photo_actualiteId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- 
-- Contenu de la table `photoAct`
-- 

INSERT INTO `photoAct` (`photo_id`, `photo_actualiteId`, `photo_photo`) VALUES 
(1, 1, 'IMG_02581.JPG'),
(2, 1, 'IMG_0260.JPG'),
(3, 1, 'IMG_0262.JPG'),
(4, 1, 'noPhoto.jpg'),
(5, 1, 'noPhoto.jpg'),
(6, 1, 'noPhoto.jpg'),
(7, 1, 'noPhoto.jpg'),
(8, 1, 'noPhoto.jpg'),
(9, 1, 'noPhoto.jpg'),
(10, 1, 'noPhoto.jpg'),
(11, 1, 'noPhoto.jpg'),
(12, 1, 'noPhoto.jpg'),
(13, 1, 'noPhoto.jpg'),
(14, 1, 'noPhoto.jpg'),
(15, 1, 'noPhoto.jpg'),
(16, 1, 'noPhoto.jpg'),
(17, 1, 'noPhoto.jpg'),
(18, 1, 'noPhoto.jpg'),
(19, 1, 'noPhoto.jpg'),
(20, 1, 'noPhoto.jpg');

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
-- Structure de la table `province`
-- 

CREATE TABLE `province` (
  `province_id` int(11) NOT NULL auto_increment,
  `province_libelle` varchar(100) NOT NULL,
  `province_code` varchar(10) default NULL,
  PRIMARY KEY  (`province_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Contenu de la table `province`
-- 

INSERT INTO `province` (`province_id`, `province_libelle`, `province_code`) VALUES 
(1, 'Antananarivo', 'ANTA'),
(2, 'Antsiranana', 'ANTS'),
(3, 'Fianarantsoa', 'FIAN'),
(4, 'Mahajanga', 'MAHA'),
(5, 'Toamasina', 'TOAM'),
(6, 'Toliara', 'TOLI');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=270 ;

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
(53, 50, 2, 2, '/50/53/', 'Divers', 'DIVER', '005:003'),
(54, 0, 3, 1, '/54/', 'Audio', 'AUDIO', '006'),
(55, 0, 3, 1, '/55/', 'Consoles de jeux-Consoles', 'CONJC', '007'),
(56, 0, 3, 1, '/56/', 'DVD, Numérique et Vidéo', 'DVDNV', '008'),
(57, 0, 3, 1, '/57/', 'Electronique', 'ELECT', '009'),
(58, 0, 4, 1, '/58/', 'Accessoires informatique', 'ACCIN', '010'),
(59, 0, 4, 1, '/59/', 'Jeux', 'JEUX', '011'),
(60, 0, 4, 1, '/60/', 'Logiciels', 'LOGIC', '012'),
(61, 0, 4, 1, '/61/', 'Ordinateurs de table', 'ORDIT', '013'),
(62, 0, 4, 1, '/62/', 'Ordinateurs-Périphériques', 'ORDIP', '014'),
(63, 0, 4, 1, '/63/', 'Ordinateurs-Pièces', 'ORDIE', '015'),
(64, 0, 4, 1, '/64/', 'Ordinateurs-Services', 'ORDIS', '016'),
(65, 0, 4, 1, '/65/', 'Portables', 'PORTA', '017'),
(66, 0, 5, 1, '/66/', 'Je suis une femme', 'FEMME', '018'),
(67, 66, 5, 2, '/66/67/', 'Une relation amoureuse sérieuse', 'AMOUR', '018:001'),
(68, 66, 5, 2, '/66/68/', 'Une amitié', 'AMITI', '018:002'),
(69, 66, 5, 2, '/66/69/', 'Un(e) correspondant(e)', 'CORES', '018:003'),
(70, 66, 5, 2, '/66/70/', 'Une rencontre', 'RENC', '018:004'),
(71, 66, 5, 2, '/66/71/', 'Des partenaires de sport ou de jeu', 'PART', '018:005'),
(72, 66, 5, 2, '/66/72/', 'Des compagnons de voyage', 'COMPA', '018:006'),
(73, 0, 5, 1, '/73/', 'Je suis un homme', 'HOMME', '019'),
(74, 73, 5, 2, '/73/74/', 'Une relation amoureuse sérieuse', 'RELAT', '019:001'),
(75, 73, 5, 2, '/73/75/', 'Une amitié', 'AMITI', '019:002'),
(76, 73, 5, 2, '/73/76/', 'Un(e) correspondant(e)', 'CORES', '019:003'),
(77, 73, 5, 2, '/73/77/', 'Une rencontre', 'RENC', '019:004'),
(78, 73, 5, 2, '/73/78/', 'Des partenaires de sport ou de jeu', 'PART', '019:005'),
(79, 73, 5, 2, '/73/79/', 'Des compagnons de voyage', 'COMPA', '019:006'),
(80, 0, 5, 1, '/80/', 'Nous sommes un couple', 'COUPL', '020'),
(81, 80, 5, 2, '/80/81/', 'Une relation amoureuse sérieuse', 'RELAT', '020:001'),
(82, 80, 5, 2, '/80/82/', 'Une amitié', 'AMITI', '020:002'),
(83, 80, 5, 2, '/80/83/', 'Un(e) correspondant(e)', 'CORES', '020:003'),
(84, 80, 5, 2, '/80/84/', 'Une rencontre', 'RENC', '020:004'),
(85, 80, 5, 2, '/80/85/', 'Des partenaires de sport ou de jeu', 'PART', '020:005'),
(86, 80, 5, 2, '/80/86/', 'Des compagnons de voyage', 'COMPA', '020:006'),
(87, 0, 6, 1, '/87/', 'Achat/Vente', 'ACHAT', '021'),
(88, 87, 6, 2, '/87/88/', 'Chalets', 'CHALE', '021:001'),
(89, 87, 6, 2, '/87/89/', 'Commercial/Industriel', 'COMME', '021:002'),
(90, 87, 6, 2, '/87/90/', 'Condos', 'CONDO', '021:003'),
(91, 87, 6, 2, '/87/91/', 'Maisons', 'MAISO', '021:004'),
(92, 87, 6, 2, '/87/92/', 'Entreprises', 'ENTRE', '021:005'),
(93, 87, 6, 2, '/87/93/', 'Fermes', 'FERME', '021:006'),
(94, 87, 6, 2, '/87/94/', 'Immeubles à revenus', 'IMMRE', '021:007'),
(95, 87, 6, 2, '/87/95/', 'Résidentiel', 'RESID', '021:008'),
(96, 87, 6, 2, '/87/96/', 'Terrains', 'TERRE', '021:009'),
(97, 0, 6, 1, '/97/', 'Location', 'LOCAT', '022'),
(98, 97, 6, 2, '/97/98/', 'Appartements', 'APPAR', '022:001'),
(99, 97, 6, 2, '/97/99/', 'Chalets', 'CHALE', '022:002'),
(100, 97, 6, 2, '/97/100/', 'Chambres', 'CHAM', '022:003'),
(101, 97, 6, 2, '/97/101/', 'Colocataires', 'COLO', '022:004'),
(102, 97, 6, 2, '/97/102/', 'Commercial', 'COMM', '022:005'),
(103, 97, 6, 2, '/97/103/', 'Industriel', 'INDU', '022:006'),
(104, 97, 6, 2, '/97/104/', 'Garages/entrepôts', 'GARAG', '022:007'),
(105, 97, 6, 2, '/97/105/', 'Logements à long terme', 'LOGT1', '022:008'),
(106, 97, 6, 2, '/97/106/', 'Logements à court terme', 'LOGT2', '022:009'),
(107, 97, 6, 2, '/97/107/', 'Maisons', 'MAISO', '022:010'),
(108, 97, 6, 2, '/97/108/', 'Résidence pour aînés', 'RESID', '022:011'),
(109, 97, 6, 2, '/97/109/', 'Salles de receptions', 'SALLE', '022:012'),
(110, 97, 6, 2, '/97/110/', 'Salles de conférence', 'CONF', '022:013'),
(111, 97, 6, 2, '/97/111/', 'Services d agent immobilier', 'SRVIM', '022:014'),
(112, 97, 6, 2, '/97/112/', 'Terrains', 'TERRE', '022:015'),
(113, 0, 6, 1, '/113/', 'Services', 'SERVI', '023'),
(114, 113, 6, 2, '/113/114/', 'Construction/rénovation', 'CONST', '023:001'),
(115, 113, 6, 2, '/113/115/', 'Courtage immobilier', 'COURT', '023:002'),
(116, 113, 6, 2, '/113/116/', 'Déménagement/entreposage', 'DEME', '023:003'),
(117, 113, 6, 2, '/113/117/', 'Déneigement/terrassement', 'DENEI', '023:004'),
(118, 0, 7, 1, '/118/', 'Vacances Madagascar', 'VACA', '024'),
(119, 118, 7, 2, '/118/119/', 'Forfaits', 'FORFA', '024:001'),
(120, 118, 7, 2, '/118/120/', 'Hébergement', 'HEBER', '024:002'),
(121, 0, 8, 1, '/121/', 'Bijoux/accessoires', 'BIJOU', '025'),
(122, 0, 8, 1, '/122/', 'Garderies', 'GARDE', '026'),
(123, 0, 8, 1, '/123/', 'Jouets', 'JOUE', '027'),
(124, 0, 8, 1, '/124/', 'Maternité', 'MATER', '028'),
(125, 0, 8, 1, '/125/', 'Services entretien menager', 'SRVE', '029'),
(126, 0, 8, 1, '/126/', 'Vêtements/chaussures', 'VETEM', '030'),
(127, 0, 9, 1, '/127/', 'Art', 'ART', '031'),
(128, 0, 9, 1, '/128/', 'Activités/évènements', 'ACTIV', '032'),
(129, 0, 9, 1, '/129/', 'Collections/passe-temps', 'COLLE', '033'),
(130, 0, 9, 1, '/130/', 'Films', 'FILM', '034'),
(131, 0, 9, 1, '/131/', 'Livres', 'LIVRE', '035'),
(132, 0, 9, 1, '/132/', 'Musique-CD/disques', 'MUSI', '036'),
(133, 0, 9, 1, '/133/', 'Musique-Equipements', 'MUSE', '037'),
(134, 0, 9, 1, '/134/', 'Musique-Instruments', 'MUSEI', '038'),
(135, 0, 9, 1, '/135/', 'Photo', 'PHOTO', '039'),
(136, 0, 9, 1, '/136/', 'Spectacles', 'SPEC', '040'),
(137, 0, 9, 1, '/137/', 'Sports', 'SPORT', '041'),
(138, 137, 9, 2, '/137/138/', 'Balle/ballon/raquette', 'SPBA', '041:001'),
(139, 137, 9, 2, '/137/139/', 'Camping/plein air', 'CAMP', '041:002'),
(140, 137, 9, 2, '/137/140/', 'Chasse & pêche', 'CHASS', '041:003'),
(141, 137, 9, 2, '/137/141/', 'Equitation', 'EQUIT', '041:004'),
(142, 137, 9, 2, '/137/142/', 'Exerciseur', 'EXERC', '041:005'),
(143, 137, 9, 2, '/137/143/', 'Golf', 'GOLF', '041:006'),
(144, 137, 9, 2, '/137/144/', 'Hockey', 'HOCK', '041:007'),
(145, 137, 9, 2, '/137/145/', 'Nautique', 'NAUTI', '041:008'),
(146, 135, 9, 2, '/135/146/', 'Skate', 'SKAT', '039:001'),
(147, 137, 9, 2, '/137/147/', 'planches à voile', 'PLAN', '041:009'),
(148, 137, 9, 2, '/137/148/', 'Vélos', 'VELO', '041:010'),
(149, 0, 10, 1, '/149/', 'Articles ménagers', 'ARTIC', '042'),
(150, 0, 10, 1, '/150/', 'Arts/antiquités', 'ART', '043'),
(151, 0, 10, 1, '/151/', 'Cadres et peintures', 'CADRE', '044'),
(152, 0, 10, 1, '/152/', 'Décoration', 'DECO', '045'),
(153, 0, 10, 1, '/153/', 'Eclairage', 'ECLAI', '046'),
(154, 0, 10, 1, '/154/', 'Electroménagers', 'ELECT', '047'),
(155, 0, 10, 1, '/155/', 'Equipements de chauffage', 'EQUIP', '048'),
(156, 0, 10, 1, '/156/', 'Mobilier bureau', 'MOBB', '049'),
(157, 0, 10, 1, '/157/', 'Mobilier enfants', 'MOBE', '050'),
(158, 0, 10, 1, '/158/', 'Mobilier jardin', 'MOBJ', '051'),
(159, 0, 10, 1, '/159/', 'Mobilier maison', 'MOBM', '052'),
(160, 159, 10, 2, '/159/160/', 'Armoire/bibliothèque', 'ARMO', '052:001'),
(161, 159, 10, 2, '/159/161/', 'Fauteuil/pouf', 'FAUT', '052:002'),
(162, 159, 10, 2, '/159/162/', 'Futon', 'Futon', '052:003'),
(163, 159, 10, 2, '/159/163/', 'Mobilier chambre', 'MOBC', '052:004'),
(164, 159, 10, 2, '/159/164/', 'Mobilier cuisine', 'MOBC', '052:005'),
(165, 159, 10, 2, '/159/165/', 'Mobilier salon', 'MOBS', '052:006'),
(166, 159, 10, 2, '/159/166/', 'Sofa-lit', 'SOFA', '052:007'),
(167, 159, 10, 2, '/159/167/', 'Autres', 'AUTRE', '052:008'),
(168, 0, 10, 1, '/168/', 'Rangement', 'RANG', '053'),
(169, 0, 10, 1, '/169/', 'Salle de bain', 'SALLE', '054'),
(170, 0, 10, 1, '/170/', 'Spas', 'SPAS', '055'),
(171, 0, 10, 1, '/171/', 'Stores et rideaux ', 'STORE', '056'),
(172, 0, 11, 1, '/172/', 'Amenagement exterieur', 'AMENA', '057'),
(173, 0, 11, 1, '/173/', 'Bois de chauffage', 'BOIS', '058'),
(174, 0, 11, 1, '/174/', 'Electrique', 'ELECT', '059'),
(175, 0, 11, 1, '/175/', 'Equipements de chauffage', 'EQUIP', '060'),
(176, 0, 11, 1, '/176/', 'Equipements professionnels', 'EQUIP', '061'),
(177, 0, 11, 1, '/177/', 'Equipements saisonniers', 'EQUIP', '062'),
(178, 0, 11, 1, '/178/', 'Horticulture/jardinage', 'HORTI', '063'),
(179, 0, 11, 1, '/179/', 'Matériaux de construction', 'MATER', '064'),
(180, 0, 11, 1, '/180/', 'Matière première', 'MATER', '065'),
(181, 0, 11, 1, '/181/', 'Outils', 'OUTI', '066'),
(182, 0, 11, 1, '/182/', 'Plomberie', 'PLOMB', '067'),
(183, 0, 11, 1, '/183/', 'Portes et fenêtres', 'PORTE', '068'),
(184, 0, 11, 1, '/184/', 'Tapis et plancher', 'TAPIS', '069'),
(185, 0, 11, 1, '/185/', 'Textiles', 'TEXT', '070'),
(186, 0, 11, 1, '/186/', 'Toiture', 'TOITU', '071'),
(187, 0, 12, 1, '/187/', 'Bureautique', 'EQUIP', '072'),
(188, 0, 12, 1, '/188/', 'Commercial', 'COMME', '073'),
(189, 0, 12, 1, '/189/', 'Communication', 'COMM', '074'),
(190, 0, 12, 1, '/190/', 'Industrielles', 'INDU', '075'),
(191, 0, 12, 1, '/191/', 'Restauration', 'REST', '076'),
(192, 0, 12, 1, '/192/', 'Santé', 'SANTE', '077'),
(193, 0, 12, 1, '/193/', 'Scolaire', 'SCOL', '078'),
(194, 0, 12, 1, '/194/', 'Securité', 'SECU', '079'),
(195, 0, 12, 1, '/195/', 'Soins professionnel', 'SOINS', '080'),
(196, 0, 12, 1, '/196/', 'Transport', 'TRANS', '081'),
(197, 0, 12, 1, '/197/', 'Ventilation', 'VENTI', '082'),
(198, 0, 13, 1, '/198/', 'Accessoires/élevage/toilettage', 'ACCES', '083'),
(199, 0, 13, 1, '/199/', 'Bêtes', 'BETE', '084'),
(200, 199, 13, 2, '/199/200/', 'Chats', 'CHAT', '084:002'),
(201, 199, 13, 2, '/199/201/', 'Chiens', 'CHIEN', '084:001'),
(202, 199, 13, 2, '/199/202/', 'Insectes', 'INSEC', '084:003'),
(203, 199, 13, 2, '/199/203/', 'Oiseaux', 'OISE', '084:004'),
(204, 199, 13, 2, '/199/204/', 'Poissons/aquatique', 'POISS', '084:005'),
(205, 199, 13, 2, '/199/205/', 'Reptiles', 'REPT', '084:006'),
(206, 199, 13, 2, '/199/206/', 'Animaux de compagnie', 'ANIMC', '084:007'),
(207, 199, 13, 2, '/199/207/', 'Chevaux', 'CHEV', '084:008'),
(208, 199, 13, 2, '/199/208/', 'Ferme/élevage', 'FERME', '084:009'),
(209, 0, 14, 1, '/209/', 'Affichage publicitaire', 'AFFIC', '085'),
(210, 0, 14, 1, '/210/', 'Agent hypothécaire', 'AGTH', '086'),
(211, 0, 14, 1, '/211/', 'Amenagement paysager', 'AMENA', '087'),
(212, 0, 14, 1, '/212/', 'Assurances', 'ASSUR', '088'),
(213, 0, 14, 1, '/213/', 'Astrologie/voyance', 'ASTRO', '089'),
(214, 0, 14, 1, '/214/', 'Cellulaire/téléphonie', 'CELL', '090'),
(215, 0, 14, 1, '/215/', 'Co-voiturage', 'COVO', '091'),
(216, 0, 14, 1, '/216/', 'Comptabilité', 'CMPT', '092'),
(217, 0, 14, 1, '/217/', 'Conception publicitaire', 'CONC', '093'),
(218, 0, 14, 1, '/218/', 'Construction/rénovation', 'CONSR', '094'),
(219, 0, 14, 1, '/219/', 'Cours/ateliers/formations', 'COURS', '095'),
(220, 0, 14, 1, '/220/', 'Courtage immobilier', 'COURT', '096'),
(221, 0, 14, 1, '/221/', 'Déménagement/entreposage', 'DEME', '097'),
(222, 0, 14, 1, '/222/', 'Terrassement', 'TERRA', '098'),
(223, 0, 14, 1, '/223/', 'Financement', 'FINAN', '099'),
(224, 0, 14, 1, '/224/', 'Garderies', 'GARD', '100'),
(225, 0, 14, 1, '/225/', 'Juridique', 'JURID', '101'),
(226, 0, 14, 1, '/226/', 'Mariage/planification', 'MARIA', '102'),
(227, 0, 14, 1, '/227/', 'Massothérapie', 'MASSO', '103'),
(228, 0, 14, 1, '/228/', 'Médecine naturelle', 'MEDNA', '104'),
(229, 0, 14, 1, '/229/', 'Opportunités d''affaires/associés', 'OPPRT', '105'),
(230, 0, 14, 1, '/230/', 'Peinture', 'PEINT', '106'),
(231, 0, 14, 1, '/231/', 'Photographe d''  évènements', 'PHOT', '107'),
(232, 0, 14, 1, '/232/', 'Santé/beauté/alimentation', 'SANTE', '108'),
(233, 0, 14, 1, '/233/', 'Services agents immobiliers', 'SRVAI', '109'),
(234, 0, 14, 1, '/234/', 'Services domestiques', 'SRVDO', '110'),
(235, 0, 14, 1, '/235/', 'Services financiers/légaux/ass.', 'SRVFL', '111'),
(236, 0, 14, 1, '/236/', 'Services de maintenance', 'SRVMA', '112'),
(237, 0, 14, 1, '/237/', 'Services matrimoniaux', 'SRVMT', '113'),
(238, 0, 14, 1, '/238/', 'Traiteur', 'TRAIT', '114'),
(239, 0, 14, 1, '/239/', 'Ventes de garage/puces/encans', 'VENTE', '115'),
(240, 0, 15, 1, '/240/', 'A donner', 'ADON', '116'),
(241, 0, 15, 1, '/241/', 'Avis/souhaits/perdu/trouvé', 'ASPT', '117'),
(242, 0, 15, 1, '/242/', 'Soutien communautaire', 'SOUTI', '118'),
(243, 0, 16, 1, '/243/', 'Entreprises', 'ENT', '119'),
(244, 0, 16, 1, '/244/', 'Franchises', 'FRANC', '120'),
(245, 0, 16, 1, '/245/', 'Investissement', 'INVST', '121'),
(246, 0, 16, 1, '/246/', 'Opportunites', 'OPPOR', '122'),
(247, 0, 16, 1, '/247/', 'Partenariat', 'PARTE', '123'),
(248, 0, 17, 1, '/248/', 'Cours de cuisine', 'CUIS', '124'),
(249, 0, 17, 1, '/249/', 'Cours de massage', 'MASSA', '125'),
(250, 0, 17, 1, '/250/', 'Cours de musique', 'MUSI', '126'),
(251, 0, 17, 1, '/251/', 'Cours d'' arts', 'ARTS', '127'),
(252, 0, 17, 1, '/252/', 'Cours informatique', 'INFO', '128'),
(253, 0, 17, 1, '/253/', 'Cours linguistique', 'LING', '129'),
(254, 0, 17, 1, '/254/', 'Développement personnel', 'DEVP', '130'),
(255, 0, 17, 1, '/255/', 'Autres...', 'AUTRE', '131'),
(256, 0, 18, 1, '/256/', 'Parfum', 'PARF', '132'),
(257, 0, 18, 1, '/257/', 'Produits de beaute', 'PRDBE', '133'),
(258, 0, 18, 1, '/258/', 'Produits minceurs', 'MINC', '134'),
(259, 0, 18, 1, '/259/', 'Produits naturelles', 'NATUR', '135'),
(260, 0, 18, 1, '/260/', 'Services Coiffure', 'COIFF', '136'),
(261, 0, 18, 1, '/261/', 'Services de détentes', 'DETEN', '137'),
(262, 0, 18, 1, '/262/', 'Services de styliste', 'STYLE', '138'),
(263, 0, 18, 1, '/263/', 'Services Diétetiste', 'DIETE', '139'),
(264, 0, 18, 1, '/264/', 'Services d esthéticienne', 'ESTHE', '140'),
(265, 0, 18, 1, '/265/', 'Services Entraineur personnel', 'ENTPE', '141'),
(266, 0, 18, 1, '/266/', 'Services Epilation', 'EPILE', '142'),
(267, 0, 18, 1, '/267/', 'Services Medecines naturelles', 'MEDNA', '143'),
(268, 0, 18, 1, '/268/', 'Services Pose d'' ongles', 'ONGLE', '144'),
(269, 0, 18, 1, '/269/', 'Autres...A', 'AUTRE', '145');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Contenu de la table `utilisateur`
-- 

INSERT INTO `utilisateur` (`utilisateur_id`, `utilisateur_paysId`, `utilisateur_profilId`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_civilite`, `utilisateur_dateNaissance`, `utilisateur_adresse`, `utilisateur_cp`, `utilisateur_ville`, `utilisateur_fonction`, `utilisateur_societe`, `utilisateur_telephone`, `utilisateur_email`, `utilisateur_login`, `utilisateur_password`, `utilisateur_dateCreation`, `utilisateur_dateModification`, `utilisateur_statut`, `utilisateur_question`, `utilisateur_reponse`, `utilisateur_photo`, `utilisateur_url`) VALUES 
(1, 65, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 0, '1970-01-01', '23, rue de Naples', '75008', 'Paris VIII', 'Genaral Manager', 'DWORD Contulting SARL', '0033340472815', 's.rakotondrabe@dword-consulting.com', 'admin', 'admin', '2009-04-19', '2010-03-14', 1, 2, 'Réponse à la question', 'Picture0025.jpg', 'www.dword-consulting.com'),
(2, 64, 2, 'Razafindrakoto', 'Tianarivo Lalasoa ', 1, '1976-11-10', '', '', '', NULL, NULL, NULL, 'tl.razafindrakoto@gmail.com', '', '1234567', NULL, NULL, 1, 0, NULL, 'image msn.jpg', NULL),
(3, 128, 3, 'Horace', 'GRANT', 0, '1986-05-02', 'Lot VB 73 Ter G Ambatoroka', '00101', 'Antananarivo', '', '', '00261340512536', 'grant@hotmail.fr', '', '123456', '2010-03-17', '2010-03-17', 1, 2, 'exact', '3.jpg', ''),
(4, 128, 3, 'TATAMA', 'Ivony', 1, '1987-05-12', 'Lot ...', '00101', 'Antananarivo', '', '', '00261340556895', 'grant@yahoo.fr', '', '123456', '2010-03-31', '2010-03-31', 1, 2, 'dfsdfsdf', '26210_1373515545403_1457236095_992564_6937501_n.jpg', '');

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
-- Structure de la table `visite`
-- 

CREATE TABLE `visite` (
  `visite_id` int(11) NOT NULL auto_increment,
  `visite_serverSoftware` varchar(250) default NULL,
  `visite_serverName` varchar(250) default NULL,
  `visite_serverAddr` varchar(250) default NULL,
  `visite_serverPort` varchar(250) default NULL,
  `visite_remoteAddr` varchar(250) default NULL,
  `visite_remotePort` varchar(250) default NULL,
  `visite_httpRefferer` varchar(250) default NULL,
  `visite_httpUserAgent` varchar(250) default NULL,
  `visite_requestMethod` varchar(250) default NULL,
  `visite_requestUri` varchar(250) default NULL,
  `visite_phpSelf` varchar(250) default NULL,
  `visite_queryString` varchar(250) default NULL,
  `visite_date` datetime NOT NULL,
  `visite_userId` int(11) NOT NULL,
  PRIMARY KEY  (`visite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=218 ;

-- 
-- Contenu de la table `visite`
-- 

INSERT INTO `visite` (`visite_id`, `visite_serverSoftware`, `visite_serverName`, `visite_serverAddr`, `visite_serverPort`, `visite_remoteAddr`, `visite_remotePort`, `visite_httpRefferer`, `visite_httpUserAgent`, `visite_requestMethod`, `visite_requestUri`, `visite_phpSelf`, `visite_queryString`, `visite_date`, `visite_userId`) VALUES 
(1, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49306', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-27 11:30:07', 1),
(2, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49394', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-27 11:32:52', 0),
(3, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49403', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_login', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_login', '2010-03-27 11:33:01', 0),
(4, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49406', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 11:33:04', 0),
(5, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49458', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 11:36:33', 0),
(6, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49534', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 11:40:16', 0),
(7, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49582', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 11:42:16', 0),
(8, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49616', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 11:43:35', 0),
(9, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49647', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 11:44:34', 0),
(10, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49684', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 11:46:06', 0),
(11, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49710', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 11:46:55', 0),
(12, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50082', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 12:14:53', 0),
(13, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51750', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:06:44', 0),
(14, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51774', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:07:40', 0),
(15, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51794', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php', '/projets/ilay-nosy/www/index.php', '', '2010-03-27 14:08:17', 0),
(16, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51798', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_login', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_login', '2010-03-27 14:08:20', 0),
(17, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51812', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-27 14:08:52', 3),
(18, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51822', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_tableBord', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_tableBord', '2010-03-27 14:09:00', 3),
(19, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51825', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-27 14:09:03', 3),
(20, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51881', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:12:24', 3),
(21, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51912', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:14:15', 3),
(22, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51947', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:16:04', 3),
(23, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '51985', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:18:03', 3),
(24, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52003', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:18:21', 3),
(25, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52020', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:18:48', 0),
(26, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52046', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:20:13', 3),
(27, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52067', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:21:00', 3),
(28, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52088', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:21:42', 3),
(29, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52106', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:21:55', 0),
(30, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52140', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:24:22', 3),
(31, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52148', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:24:26', 3),
(32, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52161', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:24:42', 0),
(33, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52187', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:26:20', 3),
(34, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52259', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:31:04', 3),
(35, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52283', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:31:46', 3),
(36, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52303', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:32:17', 3),
(37, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52327', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:33:10', 3),
(38, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52357', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:34:22', 3),
(39, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52384', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:35:49', 3),
(40, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52404', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:36:23', 3),
(41, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52458', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-27 14:39:52', 3),
(42, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52480', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:40:24', 3),
(43, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52543', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:43:42', 3),
(44, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52606', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:46:13', 3),
(45, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52645', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:47:34', 3),
(46, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52668', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:48:01', 3),
(47, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '52695', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:49:16', 3),
(48, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53076', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 14:59:31', 3),
(49, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53134', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:00:54', 3),
(50, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53319', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:03:11', 3),
(51, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53344', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:03:58', 3),
(52, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53444', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:06:59', 3),
(53, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53522', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:12:25', 3),
(54, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53539', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:12:39', 3),
(55, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53556', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:12:59', 3),
(56, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53582', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:13:47', 3),
(57, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53606', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:14:44', 3),
(58, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53623', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:15:01', 3),
(59, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53653', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:16:17', 3),
(60, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53672', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:16:47', 3),
(61, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53707', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:18:48', 3),
(62, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53714', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:18:54', 3),
(63, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53732', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:19:38', 3),
(64, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53771', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:21:32', 3),
(65, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53790', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:21:57', 3),
(66, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53849', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:24:38', 3),
(67, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53851', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:24:39', 3),
(68, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53900', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:25:59', 3),
(69, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53936', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:26:59', 3),
(70, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53977', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:01', 0),
(71, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53986', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:16', 0),
(72, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53988', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:17', 0),
(73, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53996', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:34', 0),
(74, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54001', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:34', 0),
(75, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54002', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:35', 0),
(76, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54003', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:35', 0),
(77, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54004', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:35', 0),
(78, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54005', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:36', 0),
(79, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54006', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:36', 0),
(80, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54007', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:37', 0),
(81, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54008', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:37', 0),
(82, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54009', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:38', 0),
(83, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54013', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:39', 0),
(84, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54015', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:40', 0),
(85, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54018', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:40', 0),
(86, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54014', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:41', 0),
(87, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54019', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:42', 0),
(88, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54020', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-27 15:28:42', 0),
(89, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54069', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_tableBord', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_tableBord', '2010-03-27 15:31:04', 3),
(90, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54071', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-27 15:31:08', 3),
(91, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54143', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-27 15:36:25', 3),
(92, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54187', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-27 15:38:30', 3),
(93, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54204', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_login', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_login', '2010-03-27 15:38:43', 0),
(94, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54210', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-27 15:38:59', 3),
(95, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54211', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_tableBord', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_tableBord', '2010-03-27 15:39:01', 3),
(96, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54212', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-27 15:39:03', 3),
(97, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54244', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-27 15:40:13', 3),
(98, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54270', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-27 15:40:47', 3),
(99, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '56410', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-27 17:52:41', 3),
(100, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50762', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-29 11:38:16', 3),
(101, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50779', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 YFF35 Firefox/3.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-29 11:38:18', 3),
(102, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50882', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/', '/projets/ilay-nosy/www/index.php', '', '2010-03-30 12:10:46', 0),
(103, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50915', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/', '/projets/ilay-nosy/index.php', '', '2010-03-30 12:12:35', 0),
(104, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50934', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/', '/projets/ilay-nosy/index.php', '', '2010-03-30 12:12:57', 0),
(105, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50938', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceTarifList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceTarifList', '2010-03-30 12:13:01', 0),
(106, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50043', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceTarifList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceTarifList', '2010-03-30 13:08:48', 0),
(107, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50064', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php', '/projets/ilay-nosy/www/index.php', '', '2010-03-30 13:10:26', 0),
(108, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53686', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/', '/projets/ilay-nosy/index.php', '', '2010-03-31 09:02:03', 0),
(109, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53781', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php', '/projets/ilay-nosy/www/index.php', '', '2010-03-31 09:08:13', 0),
(110, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53790', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceCategorieList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceCategorieList', '2010-03-31 09:08:18', 0),
(111, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53791', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_tableBord', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_tableBord', '2010-03-31 09:08:20', 0),
(112, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53798', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceTarifList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceTarifList', '2010-03-31 09:08:21', 0),
(113, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '53889', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 09:12:37', 0),
(114, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54023', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 09:14:04', 0),
(115, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54053', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 09:14:30', 0),
(116, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54074', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?cid=5&anid=25&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'cid=5&anid=25&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:14:55', 0),
(117, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54091', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=27&affichage=abrege&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=27&affichage=abrege&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:15:14', 0),
(118, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54112', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=25&affichage=abrege&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=25&affichage=abrege&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:15:43', 0),
(119, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54115', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=26&affichage=abrege&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=26&affichage=abrege&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:15:46', 0),
(120, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54121', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?affichage=abrege&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'affichage=abrege&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:16:00', 0),
(121, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54135', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?affichage=detail&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'affichage=detail&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:16:10', 0),
(122, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54141', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?affichage=photo&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=5&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'affichage=photo&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=5&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:16:20', 0);
INSERT INTO `visite` (`visite_id`, `visite_serverSoftware`, `visite_serverName`, `visite_serverAddr`, `visite_serverPort`, `visite_remoteAddr`, `visite_remotePort`, `visite_httpRefferer`, `visite_httpUserAgent`, `visite_requestMethod`, `visite_requestUri`, `visite_phpSelf`, `visite_queryString`, `visite_date`, `visite_userId`) VALUES 
(123, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54143', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?affichage=abrege&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=9&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'affichage=abrege&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=9&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:16:25', 0),
(124, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54145', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?affichage=photo&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'affichage=photo&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:16:27', 0),
(125, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54149', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?affichage=detail&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=9&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'affichage=detail&cid=5&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=9&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:16:29', 0),
(126, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54148', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceCategorieList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceCategorieList', '2010-03-31 09:16:32', 0),
(127, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54159', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceCategorieList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceCategorieList', '2010-03-31 09:16:45', 0),
(128, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54178', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?cid=1&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'cid=1&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:17:20', 0),
(129, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54191', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?affichage=detail&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'affichage=detail&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:17:33', 0),
(130, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54207', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?affichage=abrege&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=5&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'affichage=abrege&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=5&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:17:45', 0),
(131, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54208', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:17:47', 0),
(132, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54211', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=4&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=9&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=4&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&nbPagination=9&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:17:55', 0),
(133, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54219', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=1&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=1&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:09', 0),
(134, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54222', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=12&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=12&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:14', 0),
(135, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54234', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=4&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=4&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:30', 0),
(136, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54236', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=1&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=1&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:35', 0),
(137, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54238', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=2&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=2&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:37', 0),
(138, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54240', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=3&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=3&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:39', 0),
(139, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54244', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=10&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=10&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:41', 0),
(140, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54245', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=19&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=19&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:45', 0),
(141, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54246', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=6&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=6&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:49', 0),
(142, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54256', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=7&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=7&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:52', 0),
(143, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54258', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=8&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=8&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:55', 0),
(144, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54261', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=9&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=9&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:18:57', 0),
(145, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54265', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=24&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=24&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:19:01', 0),
(146, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54277', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=23&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=23&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:19:09', 0),
(147, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54282', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=24&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=24&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:19:11', 0),
(148, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54291', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=9&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=9&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:20:03', 0),
(149, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54294', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=24&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=24&affichage=photo&cid=1&rid=0&mot=&crid=0&parution=0&province=0&localite=0&prix1=0&prix2=0&page=1&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:20:05', 0),
(150, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54365', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 09:28:54', 0),
(151, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54368', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_login', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_login', '2010-03-31 09:28:59', 0),
(152, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54370', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_tableBord', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_tableBord', '2010-03-31 09:29:05', 0),
(153, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54372', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceCategorieList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceCategorieList', '2010-03-31 09:29:10', 0),
(154, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54383', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?mot=Peugeot&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'mot=Peugeot&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:30:17', 0),
(155, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54390', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?stat=1&module=static&action=staticFo_staticPage', '/projets/ilay-nosy/www/index.php', 'stat=1&module=static&action=staticFo_staticPage', '2010-03-31 09:30:38', 0),
(156, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54417', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?stat=2&module=static&action=staticFo_staticPage', '/projets/ilay-nosy/www/index.php', 'stat=2&module=static&action=staticFo_staticPage', '2010-03-31 09:31:04', 0),
(157, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54426', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=contact&action=contactFo_contactDemande', '/projets/ilay-nosy/www/index.php', 'module=contact&action=contactFo_contactDemande', '2010-03-31 09:31:14', 0),
(158, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54432', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?stat=5&module=static&action=staticFo_staticPage', '/projets/ilay-nosy/www/index.php', 'stat=5&module=static&action=staticFo_staticPage', '2010-03-31 09:31:27', 0),
(159, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54438', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?stat=4&module=static&action=staticFo_staticPage', '/projets/ilay-nosy/www/index.php', 'stat=4&module=static&action=staticFo_staticPage', '2010-03-31 09:31:41', 0),
(160, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54445', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?stat=3&module=static&action=staticFo_staticPage', '/projets/ilay-nosy/www/index.php', 'stat=3&module=static&action=staticFo_staticPage', '2010-03-31 09:31:56', 0),
(161, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54455', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=contact&action=contactFo_contactDemande', '/projets/ilay-nosy/www/index.php', 'module=contact&action=contactFo_contactDemande', '2010-03-31 09:32:21', 0),
(162, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54460', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?stat=3&module=static&action=staticFo_staticPage', '/projets/ilay-nosy/www/index.php', 'stat=3&module=static&action=staticFo_staticPage', '2010-03-31 09:32:29', 0),
(163, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54466', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_login', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_login', '2010-03-31 09:33:34', 0),
(164, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54469', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_register', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_register', '2010-03-31 09:33:40', 0),
(165, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54509', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 09:36:43', 0),
(166, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54512', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=commun&action=communFo_login', '/projets/ilay-nosy/www/index.php', 'module=commun&action=communFo_login', '2010-03-31 09:36:47', 0),
(167, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54518', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 09:36:58', 4),
(168, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54523', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_tableBord', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_tableBord', '2010-03-31 09:37:08', 4),
(169, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54527', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-31 09:37:18', 4),
(170, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54536', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-31 09:37:27', 4),
(171, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54573', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_profilDetail', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_profilDetail', '2010-03-31 09:38:44', 4),
(172, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54579', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceList', '2010-03-31 09:38:52', 4),
(173, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54582', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=abonnement&action=abonnementFo_abonnementList', '/projets/ilay-nosy/www/index.php', 'module=abonnement&action=abonnementFo_abonnementList', '2010-03-31 09:39:02', 4),
(174, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54587', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=abonnement&action=abonnementFo_abonnementPackList', '/projets/ilay-nosy/www/index.php', 'module=abonnement&action=abonnementFo_abonnementPackList', '2010-03-31 09:39:10', 4),
(175, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54590', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?pid=1&module=abonnement&action=abonnementFo_abonnementForfaitList', '/projets/ilay-nosy/www/index.php', 'pid=1&module=abonnement&action=abonnementFo_abonnementForfaitList', '2010-03-31 09:39:20', 4),
(176, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54597', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=abonnement&action=abonnementFo_abonnementList', '/projets/ilay-nosy/www/index.php', 'module=abonnement&action=abonnementFo_abonnementList', '2010-03-31 09:39:49', 4),
(177, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54599', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceList', '2010-03-31 09:39:54', 4),
(178, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54601', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=abonnement&action=abonnementFo_abonnementList', '/projets/ilay-nosy/www/index.php', 'module=abonnement&action=abonnementFo_abonnementList', '2010-03-31 09:39:56', 4),
(179, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54605', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?pid=1&fid=2&aid=9&module=abonnement&action=abonnementFo_abonnementEdit', '/projets/ilay-nosy/www/index.php', 'pid=1&fid=2&aid=9&module=abonnement&action=abonnementFo_abonnementEdit', '2010-03-31 09:40:32', 4),
(180, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54637', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=abonnement&action=abonnementFo_abonnementList', '/projets/ilay-nosy/www/index.php', 'module=abonnement&action=abonnementFo_abonnementList', '2010-03-31 09:43:02', 4),
(181, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54655', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceList', '2010-03-31 09:44:27', 4),
(182, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54657', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?aid=9&module=annonce&action=annonceFo_annonceList', '/projets/ilay-nosy/www/index.php', 'aid=9&module=annonce&action=annonceFo_annonceList', '2010-03-31 09:44:32', 4),
(183, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54659', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'POST', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceEdit', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceEdit', '2010-03-31 09:44:35', 4),
(184, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54705', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?aid=9&module=annonce&action=annonceFo_annonceList', '/projets/ilay-nosy/www/index.php', 'aid=9&module=annonce&action=annonceFo_annonceList', '2010-03-31 09:47:30', 4),
(185, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54708', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=28&page=1&aid=9&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceEdit', '/projets/ilay-nosy/www/index.php', 'anid=28&page=1&aid=9&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceEdit', '2010-03-31 09:47:34', 4),
(186, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54721', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=28&page=1&aid=9&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceEdit', '/projets/ilay-nosy/www/index.php', 'anid=28&page=1&aid=9&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceEdit', '2010-03-31 09:48:14', 4),
(187, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54736', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceCategorieList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceCategorieList', '2010-03-31 09:48:28', 4),

(188, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54746', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?affichage=abrege&cid=0&rid=0&mot=&crid=0&parution=0&province=1&localite=15&prix1=&prix2=&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '/projets/ilay-nosy/www/index.php', 'affichage=abrege&cid=0&rid=0&mot=&crid=0&parution=0&province=1&localite=15&prix1=&prix2=&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceResultList', '2010-03-31 09:48:42', 4),
(189, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54752', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?anid=28&affichage=abrege&cid=0&rid=0&mot=&crid=0&parution=0&province=1&localite=15&prix1=0&prix2=0&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'anid=28&affichage=abrege&cid=0&rid=0&mot=&crid=0&parution=0&province=1&localite=15&prix1=0&prix2=0&page=1&nbPagination=10&sortField=annonce_titre&sortDirection=ASC&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:48:52', 4),
(190, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54764', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=membre&action=membreFo_tableBord', '/projets/ilay-nosy/www/index.php', 'module=membre&action=membreFo_tableBord', '2010-03-31 09:49:10', 4),
(191, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54766', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceList', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceList', '2010-03-31 09:49:13', 4),
(192, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54768', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?aid=9&module=annonce&action=annonceFo_annonceList', '/projets/ilay-nosy/www/index.php', 'aid=9&module=annonce&action=annonceFo_annonceList', '2010-03-31 09:49:16', 4),
(193, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54772', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'POST', '/projets/ilay-nosy/www/index.php?module=annonce&action=annonceFo_annonceEdit', '/projets/ilay-nosy/www/index.php', 'module=annonce&action=annonceFo_annonceEdit', '2010-03-31 09:49:27', 4),
(194, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54774', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 09:49:31', 4),
(195, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54794', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 09:50:02', 4),
(196, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54806', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?cid=1&anid=28&module=annonce&action=annonceFo_annonceDetail', '/projets/ilay-nosy/www/index.php', 'cid=1&anid=28&module=annonce&action=annonceFo_annonceDetail', '2010-03-31 09:50:10', 4),
(197, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54822', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 09:51:24', 4),
(198, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '54982', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 10:04:02', 4),
(199, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '55016', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 10:07:16', 4),
(200, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '55037', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 10:07:58', 4),
(201, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '55060', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 10:08:54', 4),
(202, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '55094', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 10:09:23', 4),
(203, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '55112', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 10:10:49', 4),
(204, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '55217', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 10:17:23', 4),
(205, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '55224', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 10:17:26', 4),
(206, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '55969', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?module=accueil&action=accueilFo_abord', '/projets/ilay-nosy/www/index.php', 'module=accueil&action=accueilFo_abord', '2010-03-31 11:05:39', 4),
(207, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '55983', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?stat=1&module=static&action=staticFo_staticPage', '/projets/ilay-nosy/www/index.php', 'stat=1&module=static&action=staticFo_staticPage', '2010-03-31 11:05:52', 4),
(208, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49227', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', 'GET', '/projets/ilay-nosy/www/index.php?stat=1&module=static&action=staticFo_staticPage', '/projets/ilay-nosy/www/index.php', 'stat=1&module=static&action=staticFo_staticPage', '2010-03-31 15:04:01', 4),
(209, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49260', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?stat=1&module=static&action=staticFo_staticPage', '/projets/ilay-nosy/www/index.php', 'stat=1&module=static&action=staticFo_staticPage', '2010-03-31 15:04:27', 0),
(210, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49266', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2)', 'GET', '/projets/ilay-nosy/www/index.php?stat=1&module=static&action=staticFo_staticPage', '/projets/ilay-nosy/www/index.php', 'stat=1&module=static&action=staticFo_staticPage', '2010-03-31 15:04:37', 0),
(211, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49554', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.9) Gecko/20100315 Firefox/3.5.9', 'GET', '/projets/ilay-nosy/', '/projets/ilay-nosy/index.php', '', '2010-04-06 14:25:41', 0),
(212, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '49566', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.9) Gecko/20100315 Firefox/3.5.9', 'GET', '/projets/ilay-nosy/', '/projets/ilay-nosy/index.php', '', '2010-04-06 14:25:43', 0),
(213, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50503', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.9) Gecko/20100315 Firefox/3.5.9', 'POST', '/projets/ilay-nosy/www/index.php', '/projets/ilay-nosy/www/index.php', '', '2010-04-08 16:39:11', 0),
(214, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50542', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.9) Gecko/20100315 Firefox/3.5.9', 'POST', '/projets/ilay-nosy/www/index.php?module=actualite&action=actualiteFo_changePhoto', '/projets/ilay-nosy/www/index.php', 'module=actualite&action=actualiteFo_changePhoto', '2010-04-08 16:44:12', 0),
(215, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50569', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.9) Gecko/20100315 Firefox/3.5.9', 'POST', '/projets/ilay-nosy/www/index.php?module=actualite&action=actualiteFo_changePhoto', '/projets/ilay-nosy/www/index.php', 'module=actualite&action=actualiteFo_changePhoto', '2010-04-08 16:45:18', 0),
(216, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50581', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.9) Gecko/20100315 Firefox/3.5.9', 'POST', '/projets/ilay-nosy/www/index.php?module=actualite&action=actualiteFo_changePhoto', '/projets/ilay-nosy/www/index.php', 'module=actualite&action=actualiteFo_changePhoto', '2010-04-08 16:46:20', 0),
(217, 'Apache/2.2.6 (Win32) PHP/5.2.5', 'localhost', '127.0.0.1', '81', '127.0.0.1', '50608', '', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.9) Gecko/20100315 Firefox/3.5.9', 'POST', '/projets/ilay-nosy/www/index.php?module=actualite&action=actualiteFo_changePhoto', '/projets/ilay-nosy/www/index.php', 'module=actualite&action=actualiteFo_changePhoto', '2010-04-08 16:47:29', 0);

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
  ADD CONSTRAINT `FK_localiteAnnonce` FOREIGN KEY (`annonce_localiteId`) REFERENCES `localite` (`localite_id`),
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
-- Contraintes pour la table `localite`
-- 
ALTER TABLE `localite`
  ADD CONSTRAINT `FK_provinceLocalite` FOREIGN KEY (`localite_provinceId`) REFERENCES `province` (`province_id`);

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
