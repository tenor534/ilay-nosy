-- 
-- Contenu de la table `categorieFor`
-- 

INSERT INTO `categorieFor` (`categorieFor_id`, `categorieFor_libelle`, `categorieFor_code`) VALUES 
(0, 'Actualité et médias', 'ACTU'),
(0, 'Art et culture', 'ART'),  
(0, 'Célébrités', 'CELE'),  
(0, 'Charme', 'CHAR'),  
(0, 'Communication', 'COMM'),  
(0, 'Divertissements', 'DIV'),  
(0, 'Informatique', 'INFO'),  
(0, 'Internet', 'INTE'),
(0, 'Jeux', 'JEU'),  
(0, 'Loisirs', 'LOIS'),  
(0, 'Santé', 'SANT'),
(0, 'Société', 'SOCI'),
(0, 'Sport', 'SPOR'), 
(0, 'Vie pratique', 'VIE'),  
(0, 'Webmaster', 'WEB');  

-- 
-- Contenu de la table `forum`
-- 

INSERT INTO `forum` (`forum_id`, `forum_parentId`, `forum_categorieForId`, `forum_level`, `forum_path`, `forum_libelle`, `forum_description`, `forum_sortCode`) 
VALUES 
(0, 0, 1, 1, '/1/', 'Divers', '', '001'),
(0, 0, 1, 1, '/2/', 'Economie', '', '002'),
(0, 0, 1, 1, '/3/', 'Informations', '', '003'),
(0, 0, 1, 1, '/4/', 'Journaux', '', '004'),
(0, 0, 1, 1, '/5/', 'Magazines', '', '005'),
(0, 0, 1, 1, '/6/', 'Politique', '', '006'),
(0, 0, 1, 1, '/7/', 'Télévision', '', '007'),

(0, 0, 2, 1, '/8/', 'Arts plastiques', '', '008'),
(0, 0, 2, 1, '/9/', 'Culture générale', '', '009'),
(0, 0, 2, 1, '/10/', 'Littérature et philosophie', '', '010'),
(0, 0, 2, 1, '/11/', 'Sciences générales', '', '011'),
(0, 0, 2, 1, '/12/', 'Sciences occultes', '', '012'),

(0, 0, 3, 1, '/13/', 'Acteurs', '', '013'),
(0, 0, 3, 1, '/14/', 'Autres artistes', '', '014'),
(0, 0, 3, 1, '/15/', 'Chanteurs et musiciens', '', '015'),
(0, 0, 3, 1, '/16/', 'People', '', '016'),
(0, 0, 3, 1, '/17/', 'Sportifs', '', '017'),
(0, 0, 3, 1, '/18/', 'Top modèles', '', '018'),

(0, 0, 4, 1, '/19/', 'Amateur', '', '019'),
(0, 0, 4, 1, '/20/', 'Célébrités', '', '020'),
(0, 0, 4, 1, '/21/', 'Divers', '', '021'),
(0, 0, 4, 1, '/22/', 'Erotisme', '', '022'),
(0, 0, 4, 1, '/23/', 'Photos', '', '023'),
(0, 0, 4, 1, '/24/', 'Rencontres', '', '024'),
(0, 0, 4, 1, '/25/', 'Videos', '', '025'),

(0, 0, 5, 1, '/26/', 'Chat', '', '026'),
(0, 0, 5, 1, '/27/', 'Divers', '', '027'),
(0, 0, 5, 1, '/28/', 'Psychologie', '', '028'),
(0, 0, 5, 1, '/29/', 'Radio', '', '029'),
(0, 0, 5, 1, '/30/', 'Téléphonie mobile', '', '030'),

(0, 0, 6, 1, '/31/', 'Bande dessinée', '', '031'),
(0, 0, 6, 1, '/32/', 'Cinéma', '', '032'),
(0, 0, 6, 1, '/33/', 'Divers', '', '033'),
(0, 0, 6, 1, '/34/', 'Humour', '', '034'),
(0, 0, 6, 1, '/35/', 'Manga', '', '035'),
(0, 0, 6, 1, '/36/', 'Musique', '', '036'),
(0, 0, 6, 1, '/37/', 'Télévision', '', '037'),

(0, 0, 7, 1, '/38/', 'Achat et vente', '', '038'),
(0, 0, 7, 1, '/39/', 'Généralités', '', '039'),
(0, 0, 7, 1, '/40/', 'Lecteurs mp3', '', '040'),
(0, 0, 7, 1, '/41/', 'Logiciels', '', '041'),
(0, 0, 7, 1, '/42/', 'Macintosh', '', '042'),
(0, 0, 7, 1, '/43/', 'Matériel', '', '043'),
(0, 0, 7, 1, '/44/', 'Multimedia', '', '044'),
(0, 0, 7, 1, '/45/', 'Programmation', '', '045'),
(0, 0, 7, 1, '/46/', 'Système exploitation', '', '046'),
(0, 0, 7, 1, '/47/', 'Underground', '', '047'),

(0, 0, 8, 1, '/48/', 'Aides et tutoriaux', '', '048'),
(0, 0, 8, 1, '/49/', 'Divers', '', '049'),
(0, 0, 8, 1, '/50/', 'Haut débit', '', '050'),
(0, 0, 8, 1, '/51/', 'Peer to peer', '', '051'),
(0, 0, 8, 1, '/52/', 'Réseaux', '', '052'),
(0, 0, 8, 1, '/53/', 'Sécurité', '', '053'),

(0, 0, 9, 1, '/54/', 'Divers', '', '054'),
(0, 0, 9, 1, '/55/', 'En ligne', '', '055'),
(0, 0, 9, 1, '/56/', 'Jeux de rôle', '', '056'),
(0, 0, 9, 1, '/57/', 'Jeux videos', '', '057'),
(0, 0, 9, 1, '/58/', 'Loteries et casinos', '', '058'),

(0, 0, 10, 1, '/59/', 'Animaux', '', '059'),
(0, 0, 10, 1, '/60/', 'Automobile', '', '060'),
(0, 0, 10, 1, '/61/', 'Bricolage', '', '061'),
(0, 0, 10, 1, '/62/', 'Danse', '', '062'),
(0, 0, 10, 1, '/63/', 'Divers', '', '063'),
(0, 0, 10, 1, '/64/', 'Gastronomie', '', '064'),
(0, 0, 10, 1, '/65/', 'La mode', '', '065'),
(0, 0, 10, 1, '/66/', 'Nature', '', '066'),
(0, 0, 10, 1, '/67/', 'Photographie', '', '067'),
(0, 0, 10, 1, '/68/', 'Sorties', '', '068'),
(0, 0, 10, 1, '/69/', 'Tourisme', '', '069'),

(0, 0, 11, 1, '/70/', 'Conseils pratiques', '', '070'),
(0, 0, 11, 1, '/71/', 'Diététique', '', '071'),
(0, 0, 11, 1, '/72/', 'Esthétique', '', '072'),
(0, 0, 11, 1, '/73/', 'Handicap', '', '073'),
(0, 0, 11, 1, '/74/', 'Médecine', '', '074'),
(0, 0, 11, 1, '/75/', 'Optique', '', '075'),
(0, 0, 11, 1, '/76/', 'Sexologie', '', '076'),

(0, 0, 12, 1, '/77/', 'Communauté', '', '077'),
(0, 0, 12, 1, '/78/', 'Ecologie', '', '078'),
(0, 0, 12, 1, '/79/', 'Emploi', '', '079'),
(0, 0, 12, 1, '/80/', 'Femmes', '', '080'),
(0, 0, 12, 1, '/81/', 'Général', '', '081'),
(0, 0, 12, 1, '/82/', 'Politique', '', '082'),
(0, 0, 12, 1, '/83/', 'Religion', '', '083'),
(0, 0, 12, 1, '/84/', 'Sexualité', '', '084'),

(0, 0, 13, 1, '/85/', 'Actualité', '', '085'),
(0, 0, 13, 1, '/86/', 'Autres sports', '', '086'),
(0, 0, 13, 1, '/87/', 'Basketball', '', '087'),
(0, 0, 13, 1, '/88/', 'Football', '', '088'),
(0, 0, 13, 1, '/89/', 'Général', '', '089'),
(0, 0, 13, 1, '/90/', 'Rugby', '', '090'),
(0, 0, 13, 1, '/91/', 'Tennis', '', '091'),

(0, 0, 14, 1, '/92/', 'Achat et vente', '', '092'),
(0, 0, 14, 1, '/93/', 'Aide scolaire', '', '093'),
(0, 0, 14, 1, '/94/', 'Assurances', '', '094'),
(0, 0, 14, 1, '/95/', 'Divers', '', '095'),
(0, 0, 14, 1, '/96/', 'Famille', '', '096'),
(0, 0, 14, 1, '/97/', 'Législation', '', '097'),
(0, 0, 14, 1, '/98/', 'Maison', '', '098'),
(0, 0, 14, 1, '/99/', 'Petites annonces', '', '099'),

(0, 0, 15, 1, '/100/', 'Divers', '', '100'),
(0, 0, 15, 1, '/101/', 'Graphisme', '', '101'),
(0, 0, 15, 1, '/102/', 'Hébergement', '', '102'),
(0, 0, 15, 1, '/103/', 'Progammation', '', '103'),
(0, 0, 15, 1, '/104/', 'Référencement', '', '104'),
(0, 0, 15, 1, '/105/', 'Régies publicitaires', '', '105');
