-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Mar 20 Avril 2010 à 11:47
-- Version du serveur: 5.0.45
-- Version de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de données: `ilayNosy`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `marque`
-- 

CREATE TABLE `marque` (
  `marque_id` int(11) NOT NULL auto_increment,
  `marque_libelle` varchar(100) NOT NULL,
  `marque_code` varchar(10) default NULL,
  PRIMARY KEY  (`marque_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- 
-- Contraintes pour les tables exportées
-- 

-- 
-- Structure de la table `modele`
-- 

CREATE TABLE `modele` (
  `modele_id` int(11) NOT NULL auto_increment,
  `modele_marqueId` int(11) NOT NULL,
  `modele_libelle` varchar(100) NOT NULL,
  `modele_code` varchar(10) default NULL,
  PRIMARY KEY  (`modele_id`),
  KEY `marqueModele_FK` (`modele_marqueId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=217 ;


-- 
-- Contraintes pour la table `modele`
-- 
ALTER TABLE `modele`
  ADD CONSTRAINT `FK_marqueModele` FOREIGN KEY (`modele_marqueId`) REFERENCES `marque` (`marque_id`);

-- 
-- Contenu de la table `marque`
-- 

INSERT INTO `marque` (`marque_id`, `marque_libelle`, `marque_code`) VALUES 
(1, 'Antananarivo', 'ANTA'),
(2, 'Antsiranana', 'ANTS'),
(3, 'Fianarantsoa', 'FIAN'),
(4, 'Mahajanga', 'MAHA'),
(5, 'Toamasina', 'TOAM'),
(6, 'Toliara', 'TOLI');

-- 
-- Contenu de la table `modele`
-- 

INSERT INTO `modele` (`modele_id`, `modele_marqueId`, `modele_libelle`, `modele_code`) VALUES 
(1, 1, 'Ambatolampy', '104'),
(2, 1, 'Ambatomanga', '116'),
(216, 6, 'Tsivory', '603');

-- --------------------------------------------------------


