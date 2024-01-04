<?php
/**
* @package prospecteo
* @subpackage commun
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
require_once (LIB_PATH.'json/JSON.php');


/**
* Zone affichant le  header du backoffice
*
* @package prospecteo
* @subpackage commun
*/
class HeaderBoZone extends jZone {
 
    protected $_tplname='commun~headerBo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
		$menusActifs = $this->getParam('menusActifs');

		$menus =array();
		$titre = "";


		//print_r($_SESSION['JELIX_USER']);
		/*
		cDaoRecord_utilisateur_Jx_utilisateurAuth_Jx_mysql Object
		(
			[id] => 1
			[profilId] => 1
			[service] => 1
			[nom] => RAKOTONDRABE
			[prenom] => Solofo Herivelo
			[email] => s.rakotondrabe@dword-consulting.com
			[login] => admin
			[password] => admin
			[statut] => 1
		)		
		*/

		//Informations utilisateur
		$canAdmin 	= ($_SESSION['JELIX_USER']->profilId != 1)? 0 : 1;
		$nom 		= $_SESSION['JELIX_USER']->nom;
		$prenom 	= $_SESSION['JELIX_USER']->prenom;

		if ($canAdmin){
		
		
			array_push($menus, array('Actualit&eacute;s','#', '_self', 
				array(	array('Toutes', jUrl::get('actualite~actualiteBo_listeActualites'), '_self')
			 )));
			array_push($menus, array('Abonnements','#', '_self', 
				array(	array('Tous', jUrl::get('abonnement~abonnementBo_listeAbonnements'), '_self'),
						array('Par membre', jUrl::get('abonnement~abonnementBo_listeAbonnementMembres'), '_self'),
						array('Packs', jUrl::get('pack~packBo_listePacks'), '_self'),
						array('Forfaits', jUrl::get('forfait~forfaitBo_listeForfaits'), '_self')
			 )));
			array_push($menus, array('Annonces','#', '_self', 
				array(	array('Par cat&eacute;gorie', jUrl::get('annonce~annonceBo_listeAnnonces'), '_self'),
						array('Par membre', jUrl::get('annonce~annonceBo_listeAnnonceMembres'), '_self'),
						array('Rubriques', jUrl::get('rubrique~rubriqueBo_listeRubriques'), '_self')
			 )));
			array_push($menus, array('Petites annonces','#', '_self', 
				array(	array('Toutes', jUrl::get('petiteAnnonce~petiteAnnonceBo_listePetiteAnnonces'), '_self')
			 )));
			array_push($menus, array('Cultures','#', '_self', 
				array(	array('Toutes', jUrl::get('culture~cultureBo_listeCultures'), '_self')
			 )));
			array_push($menus, array('Forums','#', '_self', 
				array(	array('Tous', jUrl::get('forum~forumBo_listeForums'), '_self')
			 )));
			array_push($menus, array('Newsletter','#', '_self', 
				array(	array('Toutes', jUrl::get('newsletter~newsletterBo_listeNewsletters'), '_self'),
						array('Envoi', jUrl::get('newsletter~newsletterBo_envoiNewsletters'), '_self')
			 )));
			array_push($menus, array('Pratiques','#', '_self', 
				array(	array('Toutes', jUrl::get('pratique~pratiqueBo_listePratiques'), '_self')
			 )));
			array_push($menus, array('Puplication','#', '_self', 
				array(	array('Toutes', jUrl::get('publication~publicationBo_listePublications'), '_self')
			 )));

			array_push($menus, array('Comptes','#', '_self', 
				array(	array('Profiles', jUrl::get('profil~profilBo_listeProfils'), '_self'),
						array('Users', jUrl::get('utilisateur~utilisateurBo_listeUtilisateurs'), '_self')
			 )));

			array_push($menus, array('Cr&eacute;dits','#', '_self', 
				array(	array('Tous', jUrl::get('credit~creditBo_listeCredits'), '_self'),
						array('G&eacute;neration', jUrl::get('credit~creditBo_generationCredits'), '_self')
			 )));

			array_push($menus, array('Pages de groupe','#', '_self', 
				array(	array('Toutes', jUrl::get('officiel~officielBo_listeOfficiels'), '_self')
			 )));

			array_push($menus, array('Banni&egrave;res','#', '_self', 
				array(	array('Toutes', jUrl::get('banniere~banniereBo_listeBannieres'), '_self')
			 )));

			array_push($menus, array('Param&egrave;tres','#', '_self', 
				array(	
						array('Pays', jUrl::get('pays~paysBo_listePays'), '_self'),
						array('Cat&eacute;gories d\'annonce', jUrl::get('categorieAn~categorieAnBo_listeCategorieAns'), '_self'),						
						array('Cat&eacute;gories d\'actualit&eacute;', jUrl::get('categorieAct~categorieActBo_listeCategorieActs'), '_self'),						
						array('Cat&eacute;gories de forum', jUrl::get('categorieFor~categorieForBo_listeCategorieFors'), '_self'),
						array('Groupes &amp; Pages', jUrl::get('categorieOff~categorieOffBo_listeCategorieOffs'), '_self'),
						array('Marques de v&eacute;hicule', jUrl::get('marque~marqueBo_listeMarques'), '_self'),
						array('Mod&egrave;le de v&eacute;hicule', jUrl::get('modele~modeleBo_listeModeles'), '_self')

					)));		
		}			
		array_push($menus, array('www.ilay-nosy.com','http://www.ilay-nosy.com','_blank'));


		$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        $menus = $json->encode($menus);
		$menusActifs = $json->encode($menusActifs);

		//Uniquement en mode administrateur
		if (!$canAdmin){
			if ($menusActifs[1] == "7"){
				$menusActifs[1] = 0;
			}	
			if ($menusActifs[1] == "8"){
				$menusActifs[1] = 1;
			}	
		}

		//Charge la langue en cours
		//Chargement des données
		jClasses::inc('session~sessionSrv');
		
		$idUtilisateur  = $_SESSION['JELIX_USER']->id;
		
		$this->_tpl->assign('prenom', $prenom);
		$this->_tpl->assign('nom', $nom);
		$this->_tpl->assign('titre', $titre);
		$this->_tpl->assign('menus', $menus);
		$this->_tpl->assign('menusActifs', $menusActifs);
		
	}
}
?>