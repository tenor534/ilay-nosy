-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Dim 14 Février 2010 à 09:45
-- Version du serveur: 5.0.45
-- Version de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de données: `nosy`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- 
-- Contenu de la table `pays`
-- 

INSERT INTO `pays` (`pays_id`, `pays_code`, `pays_libelle`) VALUES 
(0, 'AF', 'Afghanistan'),
(0, 'ZA', 'Afrique du Sud'),
(0, 'AL', 'Albanie'),
(0, 'DZ', 'Algérie'),
(0, 'DE', 'Allemagne'),
(0, 'AD', 'Andorre'),
(0, 'AO', 'Angola'),
(0, 'AI', 'Anguilla'),
(0, 'AQ', 'Antarctique'),
(0, 'AG', 'Antigua-et-Barbuda'),
(0, 'AN', 'Antilles néerlandaises'),
(0, 'SA', 'Arabie saoudite'),
(0, 'AR', 'Argentine'),
(0, 'AM', 'Arménie'),
(0, 'AW', 'Aruba'),
(0, 'AU', 'Australie'),
(0, 'PS', 'Autorité palestinienne'),
(0, 'AT', 'Autriche'),
(0, 'AZ', 'Azerbaïdjan'),
(0, 'BS', 'Bahamas'),
(0, 'BH', 'Bahreïn'),
(0, 'BD', 'Bangladesh'),
(0, 'BB', 'Barbade'),
(0, 'BY', 'Bélarus'),
(0, 'BE', 'Belgique'),
(0, 'BZ', 'Belize'),
(0, 'BJ', 'Bénin'),
(0, 'BM', 'Bermudes'),
(0, 'BT', 'Bhoutan'),
(0, 'BO', 'Bolivie'),
(0, 'BA', 'Bosnie-Herzégovine'),
(0, 'BW', 'Botswana'),
(0, 'BV', 'Bouvet (île)'),
(0, 'BR', 'Brésil'),
(0, 'BN', 'Brunei'),
(0, 'BG', 'Bulgarie'),
(0, 'BF', 'Burkina Faso'),
(0, 'BI', 'Burundi'),
(0, 'KY', 'Caïmans (îles)'),
(0, 'KH', 'Cambodge'),
(0, 'CM', 'Cameroun'),
(0, 'CA', 'Canada'),
(0, 'CV', 'Cap-Vert'),
(0, 'CL', 'Chili'),
(0, 'CN', 'Chine'),
(0, 'CX', 'Christmas (île)'),
(0, 'CY', 'Chypre'),
(0, 'VA', 'Cité du Vatican'),
(0, 'CC', 'Cocos-Keeling (îles)'),
(0, 'CO', 'Colombie'),
(0, 'KM', 'Comores'),
(0, 'CG', 'Congo'),
(0, 'CD', 'Congo (RDC)'),
(0, 'CK', 'Cook (îles)'),
(0, 'KR', 'Corée'),
(0, 'KP', 'Corée du Nord'),
(0, 'CR', 'Costa Rica'),
(0, 'CI', 'Côte d\'Ivoire'),
(0, 'HR', 'Croatie'),
(0, 'CU', 'Cuba'),
(0, 'DK', 'Danemark'),
(0, 'UM', 'Dépendances américaines du Pacifique'),
(0, 'DJ', 'Djibouti'),
(0, 'DM', 'Dominique'),
(0, 'EG', 'Égypte'),
(0, 'AE', 'Émirats arabes unis'),
(0, 'EC', 'Équateur'),
(0, 'ER', 'Érythrée'),
(0, 'ES', 'Espagne'),
(0, 'EE', 'Estonie'),
(0, 'US', 'États-Unis'),
(0, 'ET', 'Éthiopie'),
(0, 'MK', 'Ex-République yougoslave de Macédoine'),
(0, 'FK', 'Falkland (îles) (îles Malouines)'),
(0, 'FO', 'Féroé (îles)'),
(0, 'FJ', 'Fidji (îles)'),
(0, 'FI', 'Finlande'),
(0, 'FR', 'France'),
(0, 'GA', 'Gabon'),
(0, 'GM', 'Gambie'),
(0, 'GE', 'Géorgie'),
(0, 'GS', 'Géorgie du Sud et Sandwich du Sud (îles)'),
(0, 'GH', 'Ghana'),
(0, 'GI', 'Gibraltar'),
(0, 'GR', 'Grèce'),
(0, 'GD', 'Grenade'),
(0, 'GL', 'Groenland'),
(0, 'GP', 'Guadeloupe'),
(0, 'GU', 'Guam'),
(0, 'GT', 'Guatemala'),
(0, 'GG', 'Guernesey'),
(0, 'GN', 'Guinée'),
(0, 'GQ', 'Guinée équatoriale'),
(0, 'GW', 'Guinée-Bissau'),
(0, 'GY', 'Guyana'),
(0, 'GF', 'Guyane française'),
(0, 'HT', 'Haïti'),
(0, 'HM', 'Heard et McDonald (îles)'),
(0, 'HN', 'Honduras'),
(0, 'HU', 'Hongrie'),
(0, 'IN', 'Inde'),
(0, 'ID', 'Indonésie'),
(0, 'IQ', 'Irak'),
(0, 'IR', 'Iran'),
(0, 'IE', 'Irlande'),
(0, 'IS', 'Islande'),
(0, 'IL', 'Israël'),
(0, 'IT', 'Italie'),
(0, 'JM', 'Jamaïque'),
(0, 'JP', 'Japon'),
(0, 'JE', 'Jersey'),
(0, 'JO', 'Jordanie'),
(0, 'KZ', 'Kazakhstan'),
(0, 'KE', 'Kenya'),
(0, 'KG', 'Kirghizistan'),
(0, 'KI', 'Kiribati'),
(0, 'KW', 'Koweït'),
(0, 'RE', 'La Réunion'),
(0, 'LA', 'Laos'),
(0, 'LS', 'Lesotho'),
(0, 'LV', 'Lettonie'),
(0, 'LB', 'Liban'),
(0, 'LR', 'Libéria'),
(0, 'LY', 'Libye'),
(0, 'LI', 'Liechtenstein'),
(0, 'LT', 'Lituanie'),
(0, 'LU', 'Luxembourg'),
(0, 'MG', 'Madagascar'),
(0, 'MW', 'Malawi'),
(0, 'MY', 'Malaysia'),
(0, 'MV', 'Maldives'),
(0, 'ML', 'Mali'),
(0, 'MT', 'Malte'),
(0, 'IM', 'Man (île de)'),
(0, 'MP', 'Mariannes du Nord (îles)'),
(0, 'MA', 'Maroc'),
(0, 'MH', 'Marshall (îles)'),
(0, 'MQ', 'Martinique'),
(0, 'MU', 'Maurice'),
(0, 'MR', 'Mauritanie'),
(0, 'YT', 'Mayotte'),
(0, 'MX', 'Mexique'),
(0, 'FM', 'Micronésie'),
(0, 'MD', 'Moldavie'),
(0, 'MC', 'Monaco'),
(0, 'MN', 'Mongolie'),
(0, 'ME', 'Monténégro'),
(0, 'MS', 'Montserrat'),
(0, 'MZ', 'Mozambique'),
(0, 'MM', 'Myanmar'),
(0, 'NA', 'Namibie'),
(0, 'NR', 'Nauru'),
(0, 'NP', 'Népal'),
(0, 'NI', 'Nicaragua'),
(0, 'NE', 'Niger'),
(0, 'NG', 'Nigeria'),
(0, 'NU', 'Niue'),
(0, 'NF', 'Norfolk (île)'),
(0, 'NO', 'Norvège'),
(0, 'NC', 'Nouvelle-Calédonie'),
(0, 'NZ', 'Nouvelle-Zélande'),
(0, 'OM', 'Oman'),
(0, 'UG', 'Ouganda'),
(0, 'UZ', 'Ouzbékistan'),
(0, 'PK', 'Pakistan'),
(0, 'PW', 'Palau'),
(0, 'PA', 'Panama'),
(0, 'PG', 'Papouasie-Nouvelle-Guinée'),
(0, 'PY', 'Paraguay'),
(0, 'NL', 'Pays-Bas'),
(0, 'PE', 'Pérou'),
(0, 'PH', 'Philippines'),
(0, 'PN', 'Pitcairn (îles)'),
(0, 'PL', 'Pologne'),
(0, 'PF', 'Polynésie française'),
(0, 'PR', 'Porto Rico'),
(0, 'PT', 'Portugal'),
(0, 'QA', 'Qatar'),
(0, 'HK', 'RAS de Hong Kong'),
(0, 'MO', 'RAS de Macao'),
(0, 'CF', 'République Centrafricaine'),
(0, 'DO', 'République dominicaine'),
(0, 'CZ', 'République tchèque'),
(0, 'RO', 'Roumanie'),
(0, 'UK', 'Royaume-Uni'),
(0, 'RU', 'Russie'),
(0, 'RW', 'Rwanda'),
(0, 'SH', 'Sainte-Hélène'),
(0, 'LC', 'Sainte-Lucie'),
(0, 'KN', 'Saint-Kitts-et-Nevis'),
(0, 'SM', 'Saint-Marin'),
(0, 'PM', 'Saint-Pierre-et-Miquelon'),
(0, 'VC', 'Saint-Vincent-et-les Grenadines'),
(0, 'SB', 'Salomon (îles)'),
(0, 'SV', 'Salvador'),
(0, 'WS', 'Samoa'),
(0, 'AS', 'Samoa américaines'),
(0, 'ST', 'São Tomé et Príncipe'),
(0, 'SN', 'Sénégal'),
(0, 'RS', 'Serbie'),
(0, 'SC', 'Seychelles'),
(0, 'SL', 'Sierra Leone'),
(0, 'SG', 'Singapour'),
(0, 'SK', 'Slovaquie'),
(0, 'SI', 'Slovénie'),
(0, 'SO', 'Somalie'),
(0, 'SD', 'Soudan'),
(0, 'LK', 'Sri Lanka'),
(0, 'SE', 'Suède'),
(0, 'CH', 'Suisse'),
(0, 'SR', 'Suriname'),
(0, 'SJ', 'Svalbard et Jan Mayen (îles)'),
(0, 'SZ', 'Swaziland'),
(0, 'SY', 'Syrie'),
(0, 'TJ', 'Tadjikistan'),
(0, 'TW', 'Taiwan'),
(0, 'TZ', 'Tanzanie'),
(0, 'TD', 'Tchad'),
(0, 'TF', 'Terres australes et antarctiques françaises'),
(0, 'IO', 'Territoire britannique (océan Indien)'),
(0, 'TH', 'Thaïlande'),
(0, 'TP', 'Timor-Leste (Timor-Oriental)'),
(0, 'TG', 'Togo'),
(0, 'TK', 'Tokelau'),
(0, 'TO', 'Tonga'),
(0, 'TT', 'Trinité-et-Tobago'),
(0, 'TN', 'Tunisie'),
(0, 'TM', 'Turkménistan'),
(0, 'TC', 'Turks et Caicos (îles)'),
(0, 'TR', 'Turquie'),
(0, 'TV', 'Tuvalu'),
(0, 'UA', 'Ukraine'),
(0, 'UY', 'Uruguay'),
(0, 'VU', 'Vanuatu'),
(0, 'VE', 'Venezuela'),
(0, 'VI', 'Vierges (îles), États-Unis'),
(0, 'VG', 'Vierges britanniques (îles)'),
(0, 'VN', 'Vietnam'),
(0, 'WF', 'Wallis-et-Futuna'),
(0, 'YE', 'Yémen'),
(0, 'ZM', 'Zambie'),
(0, 'ZW', 'Zimbabwe');


-- --------------------------------------------------------

-- 
-- Structure de la table `profil`
-- 

CREATE TABLE `profil` (
  `profil_id` int(11) NOT NULL auto_increment,
  `profil_libelle` varchar(100) NOT NULL,
  `profil_code` varchar(10) NOT NULL,
  PRIMARY KEY  (`profil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

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
-- Structure de la table `utilisateur`
-- 

CREATE TABLE `utilisateur` (
  `utilisateur_id` int(11) NOT NULL auto_increment,
  `utilisateur_paysId` int(11) NOT NULL,
  `utilisateur_profilId` int(11) NOT NULL,
  `utilisateur_nom` varchar(100) NOT NULL,
  `utilisateur_prenom` varchar(100) default NULL,
  `utilisateur_sexe` int(11) NOT NULL,
  `utilisateur_dateNaissance` date default NULL,
  `utilisateur_adresse` varchar(100) NOT NULL,
  `utilisateur_cp` varchar(10) NOT NULL,
  `utilisateur_ville` varchar(100) NOT NULL,
  `utilisateur_fonction` varchar(50) default NULL,
  `utilisateur_societe` varchar(50) default NULL,
  `utilisateur_telephone` varchar(20) default NULL,
  `utilisateur_email` varchar(50) default NULL,
  `utilisateur_login` varchar(20) NOT NULL,
  `utilisateur_password` varchar(20) NOT NULL,
  `utilisateur_dateCreation` date default NULL,
  `utilisateur_dateModification` date default NULL,
  `utilisateur_statut` smallint(6) NOT NULL,
  `utilisateur_question` int(11) NOT NULL,
  `utilisateur_reponse` varchar(50) default NULL,
  `utilisateur_photo` varchar(100) default NULL,
  `utilisateur_url` varchar(150) default NULL,
  PRIMARY KEY  (`utilisateur_id`),
  KEY `utilisateur_assProfilUtilisateur_FK` (`utilisateur_profilId`),
  KEY `utilisateur_assPaysUtilisateur_FK` (`utilisateur_paysId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `utilisateur`
-- 

INSERT INTO `utilisateur` (`utilisateur_id`, `utilisateur_paysId`, `utilisateur_profilId`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_sexe`, `utilisateur_dateNaissance`, `utilisateur_adresse`, `utilisateur_cp`, `utilisateur_ville`, `utilisateur_fonction`, `utilisateur_societe`, `utilisateur_telephone`, `utilisateur_email`, `utilisateur_login`, `utilisateur_password`, `utilisateur_dateCreation`, `utilisateur_dateModification`, `utilisateur_statut`, `utilisateur_question`, `utilisateur_reponse`, `utilisateur_photo`, `utilisateur_url`) VALUES 
(1, 65, 1, 'RAKOTONDRABE', 'Solofo Herivelo', 0, '1975-04-19', '23, rue de Naples', '75008', 'Paris VIII', 'Genaral Manager', 'DWORD Contulting SARL', '0033340472815', 's.rakotondrabe@dword-consulting.com', 'admin', 'admin', '2009-04-19', '2010-02-12', 1, 2, 'Réponse à la question', 'photo1.jpg', 'www.dword-consulting.com'),
(2, 64, 2, 'Razafindrakoto', 'Tianarivo Lalasoa ', 1, '1976-11-10', '', '', '', NULL, NULL, NULL, 'tl.razafindrakoto@gmail.com', '', '1234567', NULL, NULL, 1, 0, NULL, NULL, NULL);

-- 
-- Contraintes pour les tables exportées
-- 

-- 
-- Contraintes pour la table `utilisateur`
-- 
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_assPaysUtilisateur` FOREIGN KEY (`utilisateur_paysId`) REFERENCES `pays` (`pays_id`),
  ADD CONSTRAINT `FK_assProfilUtilisateur` FOREIGN KEY (`utilisateur_profilId`) REFERENCES `profil` (`profil_id`);
