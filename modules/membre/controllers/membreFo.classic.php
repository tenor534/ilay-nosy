<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class membreFoCtrl extends jController {
    /**
    *
    */
	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('connexion.membre'=>true));

	//Affiche la page d'acceil publique	
	function tableBord()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		//$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/membre.js');					
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		
		//Template utilisé
		$rep->bodyTpl = 'membre~membreTableFo';

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		//Annonce
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		
		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		$zUrl = jUrl::get('membre~membreFo_tableBord');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span>Tableau de bord'));		
		$rep->body->assignZone('contentPageMain', 'membre~contentPageMainTableFo');	

		$rep->body->assign('zMemberWrap', 'member_table');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page d'acceil publique	
	function profilDetail()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/membre.js');					
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyRegister.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembreDiv.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		
		//Template utilisé
		$rep->bodyTpl = 'membre~membreTableFo';

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		//Annonce
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		
		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		$zUrl = jUrl::get('membre~membreFo_profilDetail');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span>D&eacute;tail de votre profil'));		
		$rep->body->assignZone('contentPageMain', 'membre~contentPageMainProfilFo');	

		$rep->body->assign('zMemberWrap', 'member_profil');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page d'acceil publique	
	function annonceList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		//$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/membre.js');					
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		
		//Template utilisé
		$rep->bodyTpl = 'membre~membreTableFo';

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		//Annonce
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		
		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		$zUrl = jUrl::get('membre~membreFo_annonceList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span>Vos annonces'));		
		$rep->body->assignZone('contentPageMain', 'membre~contentPageMainAnnonceListFo');	

		$rep->body->assign('zMemberWrap', 'member_annonce');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	/**
	 * Connexion à l'espace utilisateur
	 *
	 * Reçoit en paramètre le login et le mot de passe du membre
	 */
	function connexionUtilisateur(){
		$rep=$this->getResponse('redirect');
		//jClasses::inc('accueil~accueilSrv');
		jClasses::inc('utilisateur~utilisateurSrv');
		if(utilisateurSrv::connexionMembre($this->Param('login','',true),$this->Param('password','',true))){
			//$rep->params=array("errconnexion"=>0);
			//$rep->action='accueil~accueilFo_accueilBrand';
			echo "charger=ok";
		}else{
			//$rep->params=array("errconnexion"=>1);
			//$rep->action='accueil~accueilFo_accueil';
			echo "charger=nok";
		}
		die();
		return $rep;
	}	
}
?>
