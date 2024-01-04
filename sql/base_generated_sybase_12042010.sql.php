/*==============================================================*/
/* DBMS name:      MySQL 4.0                                    */
/* Created on:     12/04/2010 11:13:08                          */
/*==============================================================*/


drop index forfaitAbonnement_FK on abonnement;

drop index utilisateurAbonnement_FK on abonnement;

drop index categorieActualite_FK on actualite;

drop index abonnementAnnonce_FK on annonce;

drop index annonceCandidature2_FK on annonce;

drop index annonceEmploi2_FK on annonce;

drop index annonceImmobilier2_FK on annonce;

drop index annonceVehicule2_FK on annonce;

drop index annonceVoyage2_FK on annonce;

drop index rubriqueAnnonce_FK on annonce;

drop index annonceCandidature_FK on candidature;

drop index actualiteCommentUtilisateur_FK on commentAct;

drop index utilisateurCommentActualite_FK on commentAct;

drop index cultureCommentUtilisateur_FK on commentCult;

drop index utilisateurCommentCulture_FK on commentCult;

drop index sujetCommentaire_FK on commentFor;

drop index utilisateurCommentSujet_FK on commentFor;

drop index categorieCulture_FK on culture;

drop index annonceEmploi_FK on emploi;

drop index packForfait_FK on forfait;

drop index categorieForum_FK on forum;

drop index annonceImmobilier_FK on immobilier;

drop index annoncePhoto_FK on photo;

drop index categorieRubrique_FK on rubrique;

drop index forumSujet_FK on sujet;

drop index utilisateurSujet_FK on sujet;

drop index paysUtilisateur_FK on utilisateur;

drop index profilUtilisateur_FK on utilisateur;

drop index annonceVehicule_FK on vehicule;

drop index annonceVoyage_FK on voyage;

drop table if exists abonnement;

drop table if exists actualite;

drop table if exists annonce;

drop table if exists candidature;

drop table if exists categorieAct;

drop table if exists categorieAn;

drop table if exists categorieCult;

drop table if exists categorieFor;

drop table if exists commentAct;

drop table if exists commentCult;

drop table if exists commentFor;

drop table if exists credit;

drop table if exists culture;

drop table if exists emploi;

drop table if exists forfait;

drop table if exists forum;

drop table if exists immobilier;

drop table if exists pack;

drop table if exists pays;

drop table if exists photo;

drop table if exists profil;

drop table if exists rubrique;

drop table if exists sujet;

drop table if exists utilisateur;

drop table if exists vehicule;

drop table if exists voyage;

/*==============================================================*/
/* Table: abonnement                                            */
/*==============================================================*/
create table abonnement
(
   abonnement_id                  int                            not null,
   utilisateur_id                 int                            not null,
   forfait_id                     int                            not null,
   abonnement_reference           varchar(50)                    not null,
   abonnement_dateDebut           date,
   abonnement_dateFin             date,
   abonnement_dateCreation        datetime,
   abonnement_credit              float(8,2),
   abonnement_creditPlus          float(8,2),
   abonnement_nbPlus              int,
   abonnement_statut              bool,
   primary key (abonnement_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: forfaitAbonnement_FK                                  */
/*==============================================================*/
create index forfaitAbonnement_FK on abonnement
(
   forfait_id
);

/*==============================================================*/
/* Index: utilisateurAbonnement_FK                              */
/*==============================================================*/
create index utilisateurAbonnement_FK on abonnement
(
   utilisateur_id
);

/*==============================================================*/
/* Table: actualite                                             */
/*==============================================================*/
create table actualite
(
   actualite_id                   int                            not null,
   categorieAct_id                int                            not null,
   actualite_reference            varchar(20)                    not null,
   actualite_titre                varchar(150)                   not null,
   actualite_resume               text,
   actualite_texte                text,
   actualite_photo                varchar(100),
   actualite_dateCreation         date,
   actualite_dateModification     date,
   actualite_datePublication      datetime,
   actualite_source               varchar(100),
   actualite_vue                  int,
   actualite_fichier              varchar(100),
   actualite_publier              bool,
   primary key (actualite_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: categorieActualite_FK                                 */
/*==============================================================*/
create index categorieActualite_FK on actualite
(
   categorieAct_id
);

/*==============================================================*/
/* Table: annonce                                               */
/*==============================================================*/
create table annonce
(
   annonce_id                     int                            not null,
   vehicule_id                    int,
   immobilier_id                  int,
   abonnement_id                  int                            not null,
   emploi_id                      int,
   rubrique_id                    int                            not null,
   candidature_id                 int,
   voyage_id                      int,
   annonce_reference              varchar(20)                    not null,
   annonce_titre                  varchar(100)                   not null,
   annonce_resume                 text,
   annonce_description            text,
   annonce_prix                   float,
   annonce_annee                  int,
   annonce_etat                   smallint,
   annonce_contactNom             varchar(100),
   annonce_contactPrenom          varchar(100),
   annonce_contactEmail           varchar(50),
   annonce_contactAdresse         varchar(100),
   annonce_contactCP              varchar(10),
   annonce_contactVille           varchar(100),
   annonce_contactTelephone       varchar(20),
   annonce_contactPeriodeAppel    varchar(20),
   annonce_dateCreation           date,
   annonce_dateModification       date,
   annonce_dateDebut              date,
   annonce_dateFin                date,
   annonce_origine                int,
   annonce_action                 int,
   primary key (annonce_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: rubriqueAnnonce_FK                                    */
/*==============================================================*/
create index rubriqueAnnonce_FK on annonce
(
   rubrique_id
);

/*==============================================================*/
/* Index: annonceVehicule2_FK                                   */
/*==============================================================*/
create index annonceVehicule2_FK on annonce
(
   vehicule_id
);

/*==============================================================*/
/* Index: annonceImmobilier2_FK                                 */
/*==============================================================*/
create index annonceImmobilier2_FK on annonce
(
   immobilier_id
);

/*==============================================================*/
/* Index: annonceEmploi2_FK                                     */
/*==============================================================*/
create index annonceEmploi2_FK on annonce
(
   emploi_id
);

/*==============================================================*/
/* Index: annonceVoyage2_FK                                     */
/*==============================================================*/
create index annonceVoyage2_FK on annonce
(
   voyage_id
);

/*==============================================================*/
/* Index: annonceCandidature2_FK                                */
/*==============================================================*/
create index annonceCandidature2_FK on annonce
(
   candidature_id
);

/*==============================================================*/
/* Index: abonnementAnnonce_FK                                  */
/*==============================================================*/
create index abonnementAnnonce_FK on annonce
(
   abonnement_id
);

/*==============================================================*/
/* Table: candidature                                           */
/*==============================================================*/
create table candidature
(
   candidature_id                 int                            not null,
   annonce_id                     int                            not null,
   candidature_fonction           int                            not null,
   candidature_secteur            int,
   candidature_niveau             int,
   candidature_nature             int,
   candidature_discipline         int,
   candidature_dateDiplome        date,
   candidature_disponibilite      varchar(100),
   candidature_souhaitFonction    int,
   candidature_souhaitSecteur     int,
   candidature_souhaitLieu        varchar(100),
   primary key (candidature_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: annonceCandidature_FK                                 */
/*==============================================================*/
create index annonceCandidature_FK on candidature
(
   annonce_id
);

/*==============================================================*/
/* Table: categorieAct                                          */
/*==============================================================*/
create table categorieAct
(
   categorieAct_id                int                            not null,
   categorieAct_libelle           varchar(100)                   not null,
   categorieAct_code              varchar(10)                    not null,
   primary key (categorieAct_id)
)
type = InnoDB;

/*==============================================================*/
/* Table: categorieAn                                           */
/*==============================================================*/
create table categorieAn
(
   categorieAn_id                 int                            not null,
   categorieAn_libelle            varchar(100)                   not null,
   categorieAn_code               varchar(10),
   primary key (categorieAn_id)
)
type = InnoDB;

/*==============================================================*/
/* Table: categorieCult                                         */
/*==============================================================*/
create table categorieCult
(
   categorieCult_id               int                            not null,
   categorieCult_libelle          varchar(100),
   categorieCult_code             varchar(10),
   primary key (categorieCult_id)
)
type = InnoDB;

/*==============================================================*/
/* Table: categorieFor                                          */
/*==============================================================*/
create table categorieFor
(
   categorieFor_id                int                            not null,
   categorieFor_libelle           varchar(100)                   not null,
   categorieFor_code              varchar(10)                    not null,
   primary key (categorieFor_id)
)
type = InnoDB;

/*==============================================================*/
/* Table: commentAct                                            */
/*==============================================================*/
create table commentAct
(
   commentAct_id                  int                            not null,
   actualite_id                   int                            not null,
   utilisateur_id                 int                            not null,
   commentAct_texte               text                           not null,
   commentAct_dateCreation        datetime,
   commentAct_publier             bool,
   primary key (commentAct_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: actualiteCommentUtilisateur_FK                        */
/*==============================================================*/
create index actualiteCommentUtilisateur_FK on commentAct
(
   actualite_id
);

/*==============================================================*/
/* Index: utilisateurCommentActualite_FK                        */
/*==============================================================*/
create index utilisateurCommentActualite_FK on commentAct
(
   utilisateur_id
);

/*==============================================================*/
/* Table: commentCult                                           */
/*==============================================================*/
create table commentCult
(
   commentCult_id                 int                            not null,
   utilisateur_id                 int                            not null,
   culture_id                     int                            not null,
   commentCult_texte              text                           not null,
   commentCult_dateCreation       datetime,
   commentCult_publier            bool,
   primary key (commentCult_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: cultureCommentUtilisateur_FK                          */
/*==============================================================*/
create index cultureCommentUtilisateur_FK on commentCult
(
   culture_id
);

/*==============================================================*/
/* Index: utilisateurCommentCulture_FK                          */
/*==============================================================*/
create index utilisateurCommentCulture_FK on commentCult
(
   utilisateur_id
);

/*==============================================================*/
/* Table: commentFor                                            */
/*==============================================================*/
create table commentFor
(
   commentFor_id                  int                            not null,
   sujet_id                       int                            not null,
   utilisateur_id                 int                            not null,
   commentFor_texte               text                           not null,
   commentFor_dateCreation        datetime,
   commentFor_publier             bool,
   primary key (commentFor_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: utilisateurCommentSujet_FK                            */
/*==============================================================*/
create index utilisateurCommentSujet_FK on commentFor
(
   utilisateur_id
);

/*==============================================================*/
/* Index: sujetCommentaire_FK                                   */
/*==============================================================*/
create index sujetCommentaire_FK on commentFor
(
   sujet_id
);

/*==============================================================*/
/* Table: credit                                                */
/*==============================================================*/
create table credit
(
   credit_id                      int                            not null,
   credit_abonnementId            int                            not null,
   credit_forfaitId               int                            not null,
   credit_isPlus                  bool                           not null,
   credit_codePIN                 varchar(20)                    not null,
   credit_password                varchar(20)                    not null,
   credit_dateUse                 datetime,
   primary key (credit_id)
)
type = InnoDB;

/*==============================================================*/
/* Table: culture                                               */
/*==============================================================*/
create table culture
(
   culture_id                     int                            not null,
   categorieCult_id               int                            not null,
   culture_reference              varchar(20)                    not null,
   culture_titre                  varchar(150)                   not null,
   culture_resume                 text,
   culture_texte                  text,
   culture_photo                  varchar(100),
   culture_dateCreation           date,
   culture_dateModification       date,
   culture_datePublication        datetime,
   culture_source                 varchar(100),
   culture_vue                    int,
   culture_fichier                varchar(100),
   culture_publier                bool,
   primary key (culture_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: categorieCulture_FK                                   */
/*==============================================================*/
create index categorieCulture_FK on culture
(
   categorieCult_id
);

/*==============================================================*/
/* Table: emploi                                                */
/*==============================================================*/
create table emploi
(
   emploi_id                      int                            not null,
   annonce_id                     int                            not null,
   emploi_raisonSocial            varchar(100)                   not null,
   emploi_categorieEntreprise     int                            not null,
   emploi_adresse                 varchar(100),
   emploi_cp                      varchar(10),
   emploi_ville                   varchar(100),
   emploi_contactNom              varchar(100),
   emploi_contactPrenom           varchar(100),
   emploi_contactFonction         varchar(100),
   emploi_contactTelephone        varchar(20),
   emploi_contactEmail            varchar(50),
   emploi_url                     varchar(100),
   emploi_nbPoste                 int,
   emploi_competence              text,
   emploi_permanent               varchar(100),
   emploi_scolarite               varchar(250),
   emploi_experienceRequise       text,
   emploi_communication           varchar(100),
   primary key (emploi_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: annonceEmploi_FK                                      */
/*==============================================================*/
create index annonceEmploi_FK on emploi
(
   annonce_id
);

/*==============================================================*/
/* Table: forfait                                               */
/*==============================================================*/
create table forfait
(
   forfait_id                     int                            not null,
   pack_id                        int                            not null,
   forfait_libelle                varchar(100)                   not null,
   forfait_nbAnnonce              int,
   forfait_nbPhoto                int,
   forfait_nbCaractere            numeric(8,0),
   forfait_dureeParution          int,
   forfait_voirPhoto              bool,
   forfait_voirCoordonnee         bool,
   forfait_affichePhoto           bool,
   forfait_afficheCoordonnee      bool,
   forfait_ajoutLien              bool,
   forfait_hasPlus                bool,
   forfait_statistique            bool,
   forfait_texteMEV               bool,
   forfait_nbPhotoAdd             int,
   forfait_prix                   float(8,2),
   forfait_prixPlus               float(8,2),
   primary key (forfait_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: packForfait_FK                                        */
/*==============================================================*/
create index packForfait_FK on forfait
(
   pack_id
);

/*==============================================================*/
/* Table: forum                                                 */
/*==============================================================*/
create table forum
(
   forum_id                       int                            not null,
   categorieFor_id                int                            not null,
   forum_libelle                  varchar(255)                   not null,
   forum_description              text,
   primary key (forum_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: categorieForum_FK                                     */
/*==============================================================*/
create index categorieForum_FK on forum
(
   categorieFor_id
);

/*==============================================================*/
/* Table: immobilier                                            */
/*==============================================================*/
create table immobilier
(
   immobilier_id                  int                            not null,
   annonce_id                     int                            not null,
   immobilier_typePropriete       int                            not null,
   immobilier_typeBatiment        int                            not null,
   immobilier_nbChambre           numeric(8,0),
   immobilier_construction        varchar(20),
   immobilier_ventePar            varchar(100),
   immobilier_sousSolAmenage      bool,
   immobilier_dateOccupation      date,
   immobilier_adresse             varchar(100),
   immobilier_cp                  varchar(10),
   immobilier_terrainDimension    varchar(100),
   immobilier_terrainSuperficie   varchar(100),
   immobilier_batimentDimension   varchar(100),
   immobilier_superficieHabitable varchar(100),
   immobilier_evaluationAnnee     varchar(100),
   immobilier_evaluationTerrain   varchar(100),
   immobilier_evaluationBatiment  varchar(100),
   immobilier_evaluationTotale    varchar(100),
   immobilier_taxeAnnuelle        float,
   immobilier_chauffage           bool,
   immobilier_inclusion           varchar(250),
   immobilier_exclusion           varchar(250),
   immobilier_nbPiece             numeric(8,0),
   immobilier_nbSalleBain         numeric(8,0),
   immobilier_nbSalleEau          numeric(8,0),
   immobilier_salleFamilliale     text,
   immobilier_cuisine             text,
   immobilier_salleManger         text,
   immobilier_salleEau            text,
   immobilier_salon               text,
   immobilier_chambrePrincipale   text,
   immobilier_chambreAutres       text,
   immobilier_salleBain           text,
   primary key (immobilier_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: annonceImmobilier_FK                                  */
/*==============================================================*/
create index annonceImmobilier_FK on immobilier
(
   annonce_id
);

/*==============================================================*/
/* Table: pack                                                  */
/*==============================================================*/
create table pack
(
   pack_id                        int                            not null,
   pack_libelle                   varchar(100)                   not null,
   pack_code                      varchar(10),
   pack_photo                     varchar(100),
   pack_fichier                   varchar(100),
   primary key (pack_id)
)
type = InnoDB;

/*==============================================================*/
/* Table: pays                                                  */
/*==============================================================*/
create table pays
(
   pays_id                        int                            not null,
   pays_libelle                   varchar(100),
   pays_code                      varchar(10),
   primary key (pays_id)
)
type = InnoDB;

/*==============================================================*/
/* Table: photo                                                 */
/*==============================================================*/
create table photo
(
   photo_id                       int                            not null,
   annonce_id                     int                            not null,
   photo_photo                    varchar(100)                   not null,
   primary key (photo_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: annoncePhoto_FK                                       */
/*==============================================================*/
create index annoncePhoto_FK on photo
(
   annonce_id
);

/*==============================================================*/
/* Table: profil                                                */
/*==============================================================*/
create table profil
(
   profil_id                      int                            not null,
   profil_libelle                 varchar(100),
   profil_code                    varchar(10),
   primary key (profil_id)
)
type = InnoDB;

/*==============================================================*/
/* Table: rubrique                                              */
/*==============================================================*/
create table rubrique
(
   rubrique_id                    int                            not null,
   categorieAn_id                 int                            not null,
   rubrique_libelle               varchar(100)                   not null,
   rubrique_code                  varchar(10),
   primary key (rubrique_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: categorieRubrique_FK                                  */
/*==============================================================*/
create index categorieRubrique_FK on rubrique
(
   categorieAn_id
);

/*==============================================================*/
/* Table: sujet                                                 */
/*==============================================================*/
create table sujet
(
   sujet_id                       int                            not null,
   utilisateur_id                 int                            not null,
   forum_id                       int                            not null,
   sujet_titre                    varchar(255)                   not null,
   sujet_reference                varchar(20)                    not null,
   sujet_dateCreation             date,
   sujet_dateModification         date,
   sujet_datePublication          datetime,
   sujet_vue                      int,
   sujet_publier                  bool,
   primary key (sujet_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: forumSujet_FK                                         */
/*==============================================================*/
create index forumSujet_FK on sujet
(
   forum_id
);

/*==============================================================*/
/* Index: utilisateurSujet_FK                                   */
/*==============================================================*/
create index utilisateurSujet_FK on sujet
(
   utilisateur_id
);

/*==============================================================*/
/* Table: utilisateur                                           */
/*==============================================================*/
create table utilisateur
(
   utilisateur_id                 int                            not null,
   pays_id                        int                            not null,
   profil_id                      int                            not null,
   utilisateur_nom                varchar(100),
   utilisateur_prenom             varchar(100),
   utilisateur_civilite           int,
   utilisateur_dateNaissance      date,
   utilisateur_adresse            varchar(100),
   utilisateur_cp                 varchar(10),
   utilisateur_ville              varchar(100),
   utilisateur_fonction           varchar(50),
   utilisateur_societe            varchar(50),
   utilisateur_telephone          varchar(20),
   utilisateur_email              varchar(50),
   utilisateur_login              varchar(20),
   utilisateur_password           varchar(20),
   utilisateur_dateCreation       date,
   utilisateur_dateModification   date,
   utilisateur_statut             smallint,
   utilisateur_question           smallint,
   utilisateur_reponse            varchar(50),
   utilisateur_photo              varchar(100),
   utilisateur_url                varchar(150),
   primary key (utilisateur_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: paysUtilisateur_FK                                    */
/*==============================================================*/
create index paysUtilisateur_FK on utilisateur
(
   pays_id
);

/*==============================================================*/
/* Index: profilUtilisateur_FK                                  */
/*==============================================================*/
create index profilUtilisateur_FK on utilisateur
(
   profil_id
);

/*==============================================================*/
/* Table: vehicule                                              */
/*==============================================================*/
create table vehicule
(
   vehicule_id                    int                            not null,
   annonce_id                     int                            not null,
   vehicule_origine               varchar(100),
   vehicule_marque                int,
   vehicule_modele                int,
   vehicule_version               varchar(100),
   vehicule_premiereMain          bool,
   vehicule_type                  int,
   vehicule_transmission          int,
   vehicule_nbCylindre            int,
   vehicule_tailleMoteur          numeric(8,0),
   vehicule_motricite             int,
   vehicule_carburant             int,
   vehicule_kilometrage           numeric(8,0),
   vehicule_nbPorte               numeric(8,0),
   vehicule_nbPassager            numeric(8,0),
   vehicule_airClimatise          bool,
   vehicule_couleurExterne        varchar(20),
   vehicule_couleurInterne        varchar(20),
   vehicule_option                text,
   vehicule_garantie              bool,
   vehicule_financement           varchar(250),
   primary key (vehicule_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: annonceVehicule_FK                                    */
/*==============================================================*/
create index annonceVehicule_FK on vehicule
(
   annonce_id
);

/*==============================================================*/
/* Table: voyage                                                */
/*==============================================================*/
create table voyage
(
   voyage_id                      int                            not null,
   annonce_id                     int                            not null,
   voyage_hotel                   varchar(100),
   voyage_typeHebergement         int                            not null,
   voyage_nbEtoile                int,
   voyage_destination             varchar(100),
   voyage_ville                   varchar(100),
   voyage_planRepas               varchar(100),
   voyage_descriptionSite         text,
   voyage_modePaiement            text,
   voyage_transport               varchar(100),
   voyage_autre                   text,
   primary key (voyage_id)
)
type = InnoDB;

/*==============================================================*/
/* Index: annonceVoyage_FK                                      */
/*==============================================================*/
create index annonceVoyage_FK on voyage
(
   annonce_id
);

alter table abonnement add constraint FK_forfaitAbonnement foreign key (forfait_id)
      references forfait (forfait_id) on delete restrict on update restrict;

alter table abonnement add constraint FK_utilisateurAbonnement foreign key (utilisateur_id)
      references utilisateur (utilisateur_id) on delete restrict on update restrict;

alter table actualite add constraint FK_categorieActualite foreign key (categorieAct_id)
      references categorieAct (categorieAct_id) on delete restrict on update restrict;

alter table annonce add constraint FK_abonnementAnnonce foreign key (abonnement_id)
      references abonnement (abonnement_id) on delete restrict on update restrict;

alter table annonce add constraint FK_annonceCandidature2 foreign key (candidature_id)
      references candidature (candidature_id) on delete restrict on update restrict;

alter table annonce add constraint FK_annonceEmploi2 foreign key (emploi_id)
      references emploi (emploi_id) on delete restrict on update restrict;

alter table annonce add constraint FK_annonceImmobilier2 foreign key (immobilier_id)
      references immobilier (immobilier_id) on delete restrict on update restrict;

alter table annonce add constraint FK_annonceVehicule2 foreign key (vehicule_id)
      references vehicule (vehicule_id) on delete restrict on update restrict;

alter table annonce add constraint FK_annonceVoyage2 foreign key (voyage_id)
      references voyage (voyage_id) on delete restrict on update restrict;

alter table annonce add constraint FK_rubriqueAnnonce foreign key (rubrique_id)
      references rubrique (rubrique_id) on delete restrict on update restrict;

alter table candidature add constraint FK_annonceCandidature foreign key (annonce_id)
      references annonce (annonce_id) on delete restrict on update restrict;

alter table commentAct add constraint FK_actualiteCommentUtilisateur foreign key (actualite_id)
      references actualite (actualite_id) on delete restrict on update restrict;

alter table commentAct add constraint FK_utilisateurCommentActualite foreign key (utilisateur_id)
      references utilisateur (utilisateur_id) on delete restrict on update restrict;

alter table commentCult add constraint FK_cultureCommentUtilisateur foreign key (culture_id)
      references culture (culture_id) on delete restrict on update restrict;

alter table commentCult add constraint FK_utilisateurCommentCulture foreign key (utilisateur_id)
      references utilisateur (utilisateur_id) on delete restrict on update restrict;

alter table commentFor add constraint FK_sujetCommentaire foreign key (sujet_id)
      references sujet (sujet_id) on delete restrict on update restrict;

alter table commentFor add constraint FK_utilisateurCommentSujet foreign key (utilisateur_id)
      references utilisateur (utilisateur_id) on delete restrict on update restrict;

alter table culture add constraint FK_categorieCulture foreign key (categorieCult_id)
      references categorieCult (categorieCult_id) on delete restrict on update restrict;

alter table emploi add constraint FK_annonceEmploi foreign key (annonce_id)
      references annonce (annonce_id) on delete restrict on update restrict;

alter table forfait add constraint FK_packForfait foreign key (pack_id)
      references pack (pack_id) on delete restrict on update restrict;

alter table forum add constraint FK_categorieForum foreign key (categorieFor_id)
      references categorieFor (categorieFor_id) on delete restrict on update restrict;

alter table immobilier add constraint FK_annonceImmobilier foreign key (annonce_id)
      references annonce (annonce_id) on delete restrict on update restrict;

alter table photo add constraint FK_annoncePhoto foreign key (annonce_id)
      references annonce (annonce_id) on delete restrict on update restrict;

alter table rubrique add constraint FK_categorieRubrique foreign key (categorieAn_id)
      references categorieAn (categorieAn_id) on delete restrict on update restrict;

alter table sujet add constraint FK_forumSujet foreign key (forum_id)
      references forum (forum_id) on delete restrict on update restrict;

alter table sujet add constraint FK_utilisateurSujet foreign key (utilisateur_id)
      references utilisateur (utilisateur_id) on delete restrict on update restrict;

alter table utilisateur add constraint FK_paysUtilisateur foreign key (pays_id)
      references pays (pays_id) on delete restrict on update restrict;

alter table utilisateur add constraint FK_profilUtilisateur foreign key (profil_id)
      references profil (profil_id) on delete restrict on update restrict;

alter table vehicule add constraint FK_annonceVehicule foreign key (annonce_id)
      references annonce (annonce_id) on delete restrict on update restrict;

alter table voyage add constraint FK_annonceVoyage foreign key (annonce_id)
      references annonce (annonce_id) on delete restrict on update restrict;

