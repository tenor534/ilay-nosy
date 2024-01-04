<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class accueilFoCtrl extends jController {
    /**
    *
    */
	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array();

	//Affiche la page d'acceil publique	
	function abord()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		//$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/accueilListe.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyHome.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		
		//Template utilisé
		$rep->bodyTpl = 'accueil~accueilGlobalFo';

		//Ajout des zones visibles:
		//Actualite
		$rep->body->assignZone('homePageNew', 'actualite~homePageNewFo');		
		$rep->body->assignZone('innerPageNew', 'actualite~innerPageNewFo');	
		
		$rep->body->assignZone('contentPageMainAdverts', 'publication~contentPageMainPublicationsFo');	
		$rep->body->assignZone('contentPageMainAnnounces', 'annonce~contentPageMainAnnouncesFo');	
		//$rep->body->assignZone('contentPageMainNews', 'actualite~contentPageMainNewsFo');	
		//$rep->body->assignZone('contentPageReelFilNews', 'actualite~contentPageReelFilNewsFo');				

		//Culture
		$rep->body->assignZone('homePageCulture', 'culture~homePageCultureFo');		

		//Forum
		$rep->body->assignZone('homePageForum', 'forum~homePageForumFo');		

		//Annonce
		$rep->body->assignZone('homePageAnnonceRencontre', 'annonce~homePageAnnonceFo');		
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		

		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		//Pratique
		$rep->body->assignZone('innerPagePratique', 'pratique~innerPagePratiqueFo');		

		//Projet
		$rep->body->assignZone('innerPageProjet', 'projet~innerPageProjetFo');		

		//Publication
		$rep->body->assignZone('leftPageHowTop', 'publication~leftPageHowTopFo');		
		$rep->body->assignZone('leftPageContactTop', 'publication~leftPageContactTopFo');		
		$rep->body->assignZone('leftPageAdsTop', 'publication~leftPageAdsTopFo');		
		$rep->body->assignZone('leftPageAds', 'publication~leftPageAdsFo');		
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		



		//$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo');		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page d'acceil publique	: UnderConstruction
	function underConstruction()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		//$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/accueilListe.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyHome.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		
		//Template utilisé
		$rep->bodyTpl = 'accueil~accueilUConstructFo';

		//Ajout des zones visibles:
		//Actualite
		$rep->body->assignZone('homePageNew', 'actualite~homePageNewFo');		
		$rep->body->assignZone('innerPageNew', 'actualite~innerPageNewFo');	
		
		$rep->body->assignZone('contentPageMainAdverts', 'publication~contentPageMainPublicationsFo');	
		$rep->body->assignZone('contentPageMainAnnounces', 'annonce~contentPageMainAnnouncesFo');	

		//Culture
		$rep->body->assignZone('homePageCulture', 'culture~homePageCultureFo');		

		//Forum
		$rep->body->assignZone('homePageForum', 'forum~homePageForumFo');		

		//Annonce
		$rep->body->assignZone('homePageAnnonceRencontre', 'annonce~homePageAnnonceFo');		
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		

		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		//Pratique
		$rep->body->assignZone('innerPagePratique', 'pratique~innerPagePratiqueFo');		

		//Projet
		$rep->body->assignZone('innerPageProjet', 'projet~innerPageProjetFo');		

		//Publication
		$rep->body->assignZone('leftPageHowTop', 'publication~leftPageHowTopFo');		
		$rep->body->assignZone('leftPageContactTop', 'publication~leftPageContactTopFo');		
		$rep->body->assignZone('leftPageAdsTop', 'publication~leftPageAdsTopFo');		
		$rep->body->assignZone('leftPageAds', 'publication~leftPageAdsFo');		
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
        
        return $rep;
	}

	/*function accueilByBrand() {
	
		global $gJConfig;
	
        $rep = $this->getResponse('htmlFo');

		$rep->bodyTpl = 'accueil~accueilByBrandFo';
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/front/membre/js/expand.js');

		//Id du brand en cours
		$mId = $this->intParam('mId','',true);
		
		
		//class brand
		jClasses::inc('marque~marqueSrv');
		$oMarque = marqueSrv::chargeMarque($mId);
		//Affiche le nom de la brand
		$rep->body->assign("marqueTitre", $oMarque->marque_nom);
		
		//Affiche le texte de la brand	
		$rep->body->assign("marqueTexteExtranet", $oMarque->marque_texteExtranet);

		//class brand
		jClasses::inc('element~elementSrv');
		$toElement = elementSrv::chargeListeElementByMarque("element_dateModification", "DESC", 0, $mId);
		$lastDateUpdate = "";
		if(isset($toElement["listeElement"][0]->element_dateModification)){
			$lastDateUpdate = $toElement["listeElement"][0]->element_dateModification;
		}	
		$rep->body->assign("lastDateUpdate", $lastDateUpdate);
		
		
		// Existe-t-il un Contact pour la marque choisie, cacher bloc contact si il n'y en a pas
		jClasses::inc('contact~contactSrv');
		$bContactParMarqueExiste = contactSrv::contactExistePourCetteMarqueFO($mId);
		
		//Assignation des zones
		$rep->body->assignZone("headerExtranet", "commun~headerFoExtranet", array('mId'=>$mId));
		$rep->body->assignZone("filAriane", "commun~filArianeFo", array('mId'=>$mId));
		$rep->body->assignZone("listeRubrique", "rubrique~listeRubriqueFo", array('mId'=>$mId));			
		$rep->body->assignZone("logoutForm", "commun~logoutFo");
		$rep->body->assignZone("thisSection", "rubrique~thisSectionFo", array('mId'=>$mId));
		$rep->body->assignZone("blocGda", "gda~blocGdaFo");
		$rep->body->assignZone("blocContact", "contact~blocContactFo", array('mId'=>$mId)); 
		$rep->body->assignZone("rightContent", "corporate~rightContentFo", array('mId'=>$mId));
		
        return $rep;
    }*/
	
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
