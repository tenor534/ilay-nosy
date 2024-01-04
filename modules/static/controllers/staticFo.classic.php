<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class staticFoCtrl extends jController {
    /**
    *
    */
	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array(
								 'staticPage'=>array('connexion.membre'=>false),
								 'workPage'=>array('connexion.membre'=>false)
								 );

	//Affiche la page de présentation de la société
	function staticPage()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/presentation.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListAbrege.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');

		
		//Template utilisé
		$rep->bodyTpl = 'static~staticTableFo';

		//Param
		if ($this->param('stat')) {
			$this->stat = $this->param('stat');
		}else{
			$this->stat = "1";
		}

		//Param
		$tParams = array('stat'=> $this->stat);

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

		switch($this->stat){
			case 1: //Présentation
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyPresentation.css');

				$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Pr&eacute;sentation de ilay Nosy'));		
				$rep->body->assign('titlePageMain', 'Pr&eacute;sentation de ilay Nosy');	
				$rep->body->assignZone('contentPageMain', 'static~contentPageMainPresentationFo', $tParams);	
				break;		
			case 2: //Liens
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyLien.css');

				$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Les liens utiles'));		
				$rep->body->assign('titlePageMain', 'Les liens utiles');	
				$rep->body->assignZone('contentPageMain', 'static~contentPageMainLiensFo', $tParams);	
				break;		
			case 3: //FAQ

				//$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/mainTools.js');			
				$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/faq.js');			
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyFaq.css');

				$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'FAQ'));		
				$rep->body->assign('titlePageMain', 'FAQ');	
				$rep->body->assignZone('contentPageMain', 'static~contentPageMainFAQFo', $tParams);	
				break;		
			case 4: //Conditions
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyCondition.css');

				$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Conditions d\' utilisation du site'));		
				$rep->body->assign('titlePageMain', 'Conditions d\' utilisation du site');	
				$rep->body->assignZone('contentPageMain', 'static~contentPageMainConditionsFo', $tParams);	
				break;		
			case 5: //Plan
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyPlan.css');

				$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Plan du site'));		
				$rep->body->assign('titlePageMain', 'Plan du site');	
				$rep->body->assignZone('contentPageMain', 'static~contentPageMainPlanFo', $tParams);	
				break;		
		}



		$rep->body->assign('zMemberWrap', 'member_static');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}
	//Affiche la page d'attente
	function workPage()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/presentation.js');			

		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListAbrege.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyPresentation.css');

		
		//Template utilisé
		$rep->bodyTpl = 'static~workTableFo';

		//Param
		$tParams = array();

		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		//Ajout des zones visibles:
		$rep->body->assign('titlePageMain', 'Site en maintenance');	
		$rep->body->assignZone('contentPageMain', 'static~contentPageMainWorkFo', $tParams);	
		$rep->body->assignZone('bootWorkFoot', 'commun~bootWorkFootFo', $tParams);	
        return $rep;
	}
}
?>
