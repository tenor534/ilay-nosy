<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class abonnementFoCtrl extends jController {
    /**
    *
    */
	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('connexion.membre'=>true));


	//Affiche la page de liste des abonnements membre	
	function abonnementList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/abonnement.js');					
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');

		
		//Template utilisé
		$rep->bodyTpl = 'abonnement~abonnementTableFo';

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

		$zUrl = jUrl::get('abonnement~abonnementFo_abonnementList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span>Vos abonnements'));		
		$rep->body->assignZone('contentPageMain', 'abonnement~contentPageMainAbonnementListFo');	

		$rep->body->assign('zMemberWrap', 'member_abonnement');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Affiche la liste des packs à selectionner
	function abonnementPackList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/abonnement.js');					
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnouncePack.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');

		
		//Template utilisé
		$rep->bodyTpl = 'abonnement~abonnementTableFo';

		//Paramètres
		$this->pid 	= $this->intParam('pid', 0);
		$this->fid 	= $this->intParam('fid', 0);
		$this->aid 	= $this->intParam('aid', 0);

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

		$zUrl1 = jUrl::get('membre~membreFo_membreTableBord');
		$zUrl2 = jUrl::get('abonnement~abonnementFo_abonnementList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl1.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span><a href="'.$zUrl2.'">Vos abonnements</a><span>&nbsp;&raquo;&nbsp;</span>Les PACKS'));		
		$rep->body->assignZone('contentPageMain', 'abonnement~contentPageMainAbonnementPackListFo');	

		$rep->body->assign('zMemberWrap', 'member_abonnement');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page de sélection d'un forfait pour un pack donné en paramètre	
	function abonnementForfaitList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/abonnement.js');					
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnouncePack.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');

		
		//Template utilisé
		$rep->bodyTpl = 'abonnement~abonnementTableFo';

		//Paramètres
		$this->pid 	= $this->intParam('pid', 0);

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

		$zUrl1 = jUrl::get('membre~membreFo_membreTableBord');
		$zUrl2 = jUrl::get('abonnement~abonnementFo_abonnementList');
		$zUrl3 = jUrl::get('abonnement~abonnementFo_abonnementPackList');		
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl1.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span><a href="'.$zUrl2.'">Votre abonnement</a><span>&nbsp;&raquo;&nbsp;</span><a href="'.$zUrl3.'">Les PACKS</a><span>&nbsp;&raquo;&nbsp;</span>Les forfaits'));		
		$rep->body->assignZone('contentPageMain', 'abonnement~contentPageMainAbonnementForfaitListFo', array('pid'=>$this->pid));	

		$rep->body->assign('zMemberWrap', 'member_abonnement');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page d'édition d'un abonnement membre	
	function abonnementEdit()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/abonnement.js');					
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnouncePack.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');

		
		//Template utilisé
		$rep->bodyTpl = 'abonnement~abonnementTableFo';

		//Paramètres
		$this->pid 	= $this->intParam('pid', 0);
		$this->fid 	= $this->intParam('fid', 0);
		$this->aid 	= $this->intParam('aid', 0);

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

		$zUrl1 = jUrl::get('membre~membreFo_membreTableBord');
		$zUrl2 = jUrl::get('abonnement~abonnementFo_abonnementList');
		$zUrl3 = jUrl::get('abonnement~abonnementFo_abonnementPackList');		
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl1.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span><a href="'.$zUrl2.'">Votre abonnement</a><span>&nbsp;&raquo;&nbsp;</span><a href="'.$zUrl3.'">Les PACKS</a><span>&nbsp;&raquo;&nbsp;</span>Les forfaits'));		
		$rep->body->assignZone('contentPageMain', 'abonnement~contentPageMainAbonnementEditFo', array('pid'=>$this->pid, 'fid'=>$this->fid, 'aid'=>$this->aid));	

		$rep->body->assign('zMemberWrap', 'member_abonnement');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	/**
    * Enregistrement des données d'un membre utilisateur
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'un membre
	* Une fois ls utilisateur sauvegardée, redirige vers la page de liste des membres
    */
    function sauvegardeAbonnement() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('credit~creditSrv');	
		jClasses::inc('forfait~forfaitSrv');	
		jClasses::inc('abonnement~abonnementSrv');

		$result 	= array();
		$iReturn 	= true;

		//Récupération des paramètres
		$this->request_utf8_decode();
		$abonnement = jMagicLoader::arrayToObject($this->request->params, 'credit');


		$abonnement->delais1 = $this->param('credit_delais1', 0, true);
		$abonnement->delais2 = $this->param('credit_delais2', 0, true);

		$forfaitId 	= $abonnement->forfaitId;
		$codePIN 	= $abonnement->codePIN;
		$password 	= $abonnement->password;
		
		//Régularisation
		if($abonnement->id){

			//Teste la valididé du crédit			
			$idCredit = creditSrv::validCredit($forfaitId, $codePIN, $password);

			//Crédit valide
			if($idCredit){
				//Update credit dateUse
				$credit = creditSrv::chargeCredit($idCredit);				
				$credit->id 		= $idCredit;
				$credit->dateUse 	= date("Y-m-d H:i:s");				
				$iReturn = creditSrv::sauvegardeCredit($credit);						
				
				//Retrieves info from forfait
				$forfait = forfaitSrv::chargeForfait($forfaitId);				
				
				//Update Abonnement				
				$nbDuree = $forfait->forfait_dureeParution / 30;
				
				$abonnement->id				= $abonnement->id;
				$abonnement->dateDebut		= date("Y-m-d");
				$abonnement->dateFin		= date("Y-m-d", strtotime('+'. $nbDuree .' month'));
				$abonnement->credit			= $forfait->forfait_prix;
				$abonnement->creditPlus		= $forfait->forfait_prixPlus;
				$abonnement->nbPlus			= $forfait->forfait_hasPlus;
				$abonnement->statut			= 1;
				
				//Enregistrement
				$iReturn = abonnementSrv::sauvegardeAbonnement($abonnement);				
			}else{
				//Non valide
				$iReturn = 0;
			}
		
		}else{//Création nouvel abonnement			

			if($abonnement->delais1 == 1){
			//Abonnement Maintenant			
				
				//Teste la valididé du crédit			
				$idCredit = creditSrv::validCredit($forfaitId, $codePIN, $password);
				
				if($idCredit){
					//Update credit dateUse
					$credit = creditSrv::chargeCredit($idCredit);				
					$credit->id 		= $idCredit;
					$credit->dateUse 	= date("Y-m-d H:i:s");				
					$iReturn = creditSrv::sauvegardeCredit($credit);						
					
					//Retrieves info from forfait
					$forfait = forfaitSrv::chargeForfait($forfaitId);				
					
					//Insert Abonnement				
					$nbDuree = $forfait->forfait_dureeParution / 30;

					$abonnement->id				= 0;
					$abonnement->utilisateurId	= $_SESSION['SESSION_MEMBRE_ID'];
					$abonnement->forfaitId		= $abonnement->forfaitId;
					$abonnement->reference		= "ab" . $abonnement->utilisateurId . $abonnement->forfaitId . time() ;
					$abonnement->dateDebut		= date("Y-m-d");
					$abonnement->dateFin		= date("Y-m-d", strtotime('+'. $nbDuree .' month'));
					$abonnement->dateCreation	= date("Y-m-d H:i:s");
					$abonnement->credit			= $forfait->forfait_prix;
					$abonnement->creditPlus		= $forfait->forfait_prixPlus;
					$abonnement->nbPlus			= $forfait->forfait_hasPlus;
					$abonnement->statut			= 1;

					//Enregistrement
					$iReturn = abonnementSrv::sauvegardeAbonnement($abonnement);							
				}else{
					$iReturn = 0;
				}								
			}else{
			//Abonnement Plutard
				$abonnement->id				= 0;
				$abonnement->utilisateurId	= $_SESSION['SESSION_MEMBRE_ID'];
				$abonnement->forfaitId		= $abonnement->forfaitId;
				$abonnement->reference		= "ab" . $abonnement->utilisateurId . $abonnement->forfaitId . time() ;
				$abonnement->dateDebut		= NULL;
				$abonnement->dateFin		= NULL;
				$abonnement->dateCreation	= date("Y-m-d H:i:s");
				$abonnement->credit			= 0;
				$abonnement->creditPlus		= 0;
				$abonnement->nbPlus			= 0;
				$abonnement->statut			= 3;
				
				//Enregistrement
				$iReturn = abonnementSrv::sauvegardeAbonnement($abonnement);
				
			}
		}	

		//Paramètres
		$result = array("statut"=>$iReturn);
		
		$rep->datas = $result;
		return $rep;
    }
	

	//Supprime un abonnement et le redirige vers la page de liste des abonnement d'un membre	
	function abonnementDelete()
	{
		global $gJConfig;
		$rep = $this->getResponse('redirect');
		$rep->action  = 'abonnement~abonnementFo_abonnementList';

		//Paramètres
		$abonnementId 	= $this->intParam('aid', 0);

		//Suppression
		jClasses::inc('abonnementSrv');
		abonnementSrv::supprimeAbonnement($abonnementId);

		//$rep->params = $tParams;
        
        return $rep;
	}

	/*function accueilByBrand() {
	
		global $gJConfig;
	
        $rep = $this->getResponse('htmlFo');

		$rep->bodyTpl = 'accueil~accueilByBrandFo';
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/front/abonnement/js/expand.js');

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
	 * Reçoit en paramètre le login et le mot de passe du abonnement
	 */
	function connexionUtilisateur(){
		$rep=$this->getResponse('redirect');
		//jClasses::inc('accueil~accueilSrv');
		jClasses::inc('utilisateur~utilisateurSrv');
		if(utilisateurSrv::connexionAbonnement($this->Param('login','',true),$this->Param('password','',true))){
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
