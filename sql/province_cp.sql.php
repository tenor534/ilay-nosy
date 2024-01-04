-- 
-- Structure de la table `province`
-- 

CREATE TABLE `province` (
  `province_id` int(11) NOT NULL auto_increment,
  `province_libelle` varchar(100) NOT NULL,
  `province_code` varchar(10) default NULL,
  PRIMARY KEY  (`province_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

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


CREATE TABLE `localite` (
  `localite_id` int(11) NOT NULL auto_increment,
  `localite_provinceId` int(11) NOT NULL,
  `localite_libelle` varchar(100) NOT NULL,
  `localite_code` varchar(10) default NULL,
  PRIMARY KEY  (`localite_id`)
  KEY `provinceLocalite_FK` (`localite_provinceId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

ALTER TABLE `localite`
  ADD CONSTRAINT `FK_provinceLocalite` FOREIGN KEY (`localite_provinceId`) REFERENCES `province` (`province_id`);


INSERT INTO `localite` (`localite_id`, `localite_provinceId`, `localite_libelle`, `localite_code`) VALUES 
(1, 1, 'Ambatolampy', '104'),
(2, 1, 'Ambatomanga', '116'),
(3, 1, 'Ambohibary Sambaina', '110'),
(4, 1, 'Ambohidratrimo', '105'),
(5, 1, 'Ambohimiadana', '106');


ALTER TABLE `annonce`
  ADD CONSTRAINT `FK_localiteAnnonce` FOREIGN KEY (`annonce_localiteId`) REFERENCES `localite` (`localite_id`);


