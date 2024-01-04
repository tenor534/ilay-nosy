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
/* Table: forum                                                 */
/*==============================================================*/
create table forum
(
   forum_id                       int                            not null,
   forum_categorieForId           int                            not null,
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
   forum_categorieForId
);
/*==============================================================*/
/* Table: sujet                                                 */
/*==============================================================*/
create table sujet
(
   sujet_id                       int                            not null,
   sujet_utilisateurId                 int                            not null,
   sujet_forumId                       int                            not null,
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
   sujet_forumId
);

/*==============================================================*/
/* Index: utilisateurSujet_FK                                   */
/*==============================================================*/
create index utilisateurSujet_FK on sujet
(
   sujet_utilisateurId
);

/*==============================================================*/
/* Table: commentFor                                            */
/*==============================================================*/
create table commentFor
(
   commentFor_id                  int                            not null,
   commentFor_sujetId             int                            not null,
   commentFor_utilisateurId       int                            not null,
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
   commentFor_utilisateurId
);

/*==============================================================*/
/* Index: sujetCommentaire_FK                                   */
/*==============================================================*/
create index sujetCommentaire_FK on commentFor
(
   commentFor_sujetId
);

alter table forum add constraint FK_categorieForum foreign key (forum_categorieForId)
      references categorieFor (categorieFor_id) on delete restrict on update restrict;
      
alter table sujet add constraint FK_forumSujet foreign key (sujet_forumId)
      references forum (forum_id) on delete restrict on update restrict;
      
alter table sujet add constraint FK_utilisateurSujet foreign key (sujet_utilisateurId)
      references utilisateur (utilisateur_id) on delete restrict on update restrict;
      
alter table commentFor add constraint FK_sujetCommentaire foreign key (commentFor_sujetId)
      references sujet (sujet_id) on delete restrict on update restrict;
      
alter table commentFor add constraint FK_utilisateurCommentSujet foreign key (commentFor_utilisateurId)
      references utilisateur (utilisateur_id) on delete restrict on update restrict;  
      


