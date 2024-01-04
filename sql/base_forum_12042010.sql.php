-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Lun 12 Avril 2010 à 12:30
-- Version du serveur: 5.0.45
-- Version de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de données: `ilayNosy`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `categorieFor`
-- 

CREATE TABLE `categorieFor` (
  `categorieFor_id` int(11) NOT NULL auto_increment,
  `categorieFor_libelle` varchar(100) NOT NULL,
  `categorieFor_code` varchar(10) NOT NULL,
  PRIMARY KEY  (`categorieFor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `categorieFor`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `commentFor`
-- 

CREATE TABLE `commentFor` (
  `commentFor_id` int(11) NOT NULL auto_increment,
  `commentFor_sujetId` int(11) NOT NULL,
  `commentFor_utilisateurId` int(11) NOT NULL,
  `commentFor_texte` text NOT NULL,
  `commentFor_dateCreation` datetime default NULL,
  `commentFor_publier` tinyint(1) default NULL,
  PRIMARY KEY  (`commentFor_id`),
  KEY `utilisateurCommentSujet_FK` (`commentFor_utilisateurId`),
  KEY `sujetCommentaire_FK` (`commentFor_sujetId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `commentFor`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `forum`
-- 

CREATE TABLE `forum` (
  `forum_id` int(11) NOT NULL auto_increment,
  `forum_categorieForId` int(11) NOT NULL,
  `forum_libelle` varchar(255) NOT NULL,
  `forum_description` text,
  PRIMARY KEY  (`forum_id`),
  KEY `categorieForum_FK` (`forum_categorieForId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `forum`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `sujet`
-- 

CREATE TABLE `sujet` (
  `sujet_id` int(11) NOT NULL auto_increment,
  `sujet_utilisateurId` int(11) NOT NULL,
  `sujet_forumId` int(11) NOT NULL,
  `sujet_titre` varchar(255) NOT NULL,
  `sujet_reference` varchar(20) NOT NULL,
  `sujet_dateCreation` date default NULL,
  `sujet_dateModification` date default NULL,
  `sujet_datePublication` datetime default NULL,
  `sujet_vue` int(11) default NULL,
  `sujet_publier` tinyint(1) default NULL,
  PRIMARY KEY  (`sujet_id`),
  KEY `forumSujet_FK` (`sujet_forumId`),
  KEY `utilisateurSujet_FK` (`sujet_utilisateurId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `sujet`
-- 


-- 
-- Contraintes pour les tables exportées
-- 

-- 
-- Contraintes pour la table `commentFor`
-- 
ALTER TABLE `commentFor`
  ADD CONSTRAINT `FK_sujetCommentaire` FOREIGN KEY (`commentFor_sujetId`) REFERENCES `sujet` (`sujet_id`),
  ADD CONSTRAINT `FK_utilisateurCommentSujet` FOREIGN KEY (`commentFor_utilisateurId`) REFERENCES `utilisateur` (`utilisateur_id`);

-- 
-- Contraintes pour la table `forum`
-- 
ALTER TABLE `forum`
  ADD CONSTRAINT `FK_categorieForum` FOREIGN KEY (`forum_categorieForId`) REFERENCES `categoriefor` (`categorieFor_id`);

-- 
-- Contraintes pour la table `sujet`
-- 
ALTER TABLE `sujet`
  ADD CONSTRAINT `FK_forumSujet` FOREIGN KEY (`sujet_forumId`) REFERENCES `forum` (`forum_id`),
  ADD CONSTRAINT `FK_utilisateurSujet` FOREIGN KEY (`sujet_utilisateurId`) REFERENCES `utilisateur` (`utilisateur_id`);
