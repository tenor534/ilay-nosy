<?php
/**
* @package ilay-nosy
* @subpackage contact
* @version  1
* @author ILAY NOSY Consulting SARL
*/

/**
* Contrôleur FO pour les contacts
* @package ilay-nosy
* @subpackage contact
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class contactFoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array(
							 'contactDemande'=>array('connexion.membre'=>false)
							);

 
	/**
    * Affiche la liste des contacts
    */
    function contactDemande() {
		global $gJConfig;
		//jClasses::inc('contact~contactSrv');

        $rep = $this->getResponse('htmlFo');
		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/contact.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListAbrege.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyContact.css');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->bodyTpl = 'contact~contactTableFo';

		//Param
		$tParams = array('page'=> $this->page);

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

		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Nous contacter'));		
		$rep->body->assignZone("contentPageMain", "contact~contentPageMainFormFo", $tParams);

        return $rep;
    }


	/**
    * Affiche la liste des contacts
    */
    function listeContacts() {
		jClasses::inc('contact~contactSrv');

        $rep = $this->getResponse('htmlFo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlFoResponse::MENU_GROUPE, HtmlFoResponse::MENU_GROUPE_LISTE);
		$rep->bodyTpl = 'contact~contactFo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeContactFo", "contact~listeContactFo", $tParams);

		$canAdmin = ($_SESSION['JELIX_USER']->profilId != 1)? 0 : 1;
		$rep->body->assign("canAdmin", $canAdmin);

        return $rep;
    }

	/**
    * Affichage le détail d'une entité contact en mode edition 
	* Recoit l'id de l'entité en paramètre
    */
    function editionContact() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlFo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/contacts.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlFoResponse::MENU_GROUPE, HtmlFoResponse::MENU_GROUPE_LISTE);
		
		//Template à utiliser
		$rep->bodyTpl = 'contact~contactFo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('contact_id')) {
			$this->contact_id = $this->intParam('contact_id');
		}else{
			$this->contact_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','contact~listeContactFo.zone'));

		//Chargement des données
		jClasses::inc('contact~contactSrv');
		
		if ($this->contact_id != 0) {
			try {
				$contact = contactSrv::chargeContact($this->contact_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$contact = contactSrv::getDaoContact();
			$contact->contact_statut = USER_STATUT_ON;			
		}

		$tParams = array('contact_id'=> $this->contact_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);


		//Langue
		jClasses::inc('langue~langueSrv');
		$listeLangues = langueSrv::chargeAllLangue();
							
		$rep->body->assign('tParams', $tParams);
		
		$rep->body->assign("listeLangues", $listeLangues);
		
		$rep->body->assign('contact', $contact);													
		$rep->body->assign("contact_id", $this->contact_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une entité contact
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une contact
	* Une fois une entité contact sauvegardée, redirige vers la page de liste des contacts
    */
    function sauvegardeContact() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$contact = jMagicLoader::arrayToObject($this->request->params, 'contact');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('contactSrv');
		contactSrv::sauvegardeContact($contact);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'contact~contactFo_listeContacts';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une entité contact donnée
	* 
	* Recoit l'id de l'entité en paramètre
	* Une fois l'entité supprimée, redirige vers la page de liste des contacts
    */
    function supprimeContact() {

		//Récupération des paramètres
		$contactId = $this->intParam('contact_id',0, FALSE);
		if ($contactId == 0) {
			throw new Exception('Invalid parameter contact_id');
		}

		//Suppression
		jClasses::inc('contactSrv');
		contactSrv::supprimeContact($contactId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'contact~contactFo_listeContacts';
        
        return $rep;
    }

	/**
    * Envoi d'un email
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une contact
	* Une fois une entité contact sauvegardée, redirige vers la page de liste des contacts
    */
    function sendMail() {
		//Préparation de la réponse
		global $gJConfig;
	    $rep = $this->getResponse('json');

		jClasses::inc('commun~mailSrv');		

		//Récupération des paramètres
		$zCivilite 	= $this->param('civilite', '', true);
		$zNom 		= $this->param('nom', '', true);
		$zPrenom 	= $this->param('prenom', '', true);
		$zSociete 	= $this->param('societe', '', true);
		$zPays 		= $this->param('pays', '', true);
		$zCP 		= $this->param('cp', '', true);
		$zEmail 	= $this->param('email', '', true);
		$zMessage 	= $this->param('message', '', true);
		
		
		//Mail de confirmation pour l'internaute
		
		//Template à utiliser
		/*$repTpl = $this->getResponse('htmlFo');
		
		$repTpl->bodyTpl = 'contact~contactMailClientFo';		
		$repTpl->body->assign('user_civilite', $zCivilite);													
		$repTpl->body->assign('user_nom', $zNom);													
		$repTpl->body->assign('user_prenom', $zPrenom);													
		$repTpl->body->assign('user_societe', $zSociete);													
		$repTpl->body->assign('user_pays', $zPays);													
		$repTpl->body->assign('user_cp', $zCP);													
		$repTpl->body->assign('user_email', $zEmail);													
		$repTpl->body->assign('user_message', $zMessage);*/
			
		$zMailTo 	= $zEmail;
		$zToNom 	= $zPrenom . ' ' . $zNom;
		$zSujet 	= "Votre demande de contact sur ilay-nosy.com a bien été re&ccedil;ue";	

		$tplCorps 	= "";
		$selecteur 	= "contact~contactMailClientFo"; 
		//$tplCorps	= $repTpl->body->fetch($repTpl->bodyTpl);
		//$selecteur 	= ""; 
		$paramCorps = array(
				'zCivilite' => $zCivilite,
				'zNom' => $zNom,
				'zPrenom' => $zPrenom,
				'zSociete' => $zSociete,
				'zPays' => $zPays,
				'zCP' => $zCP,
				'zEmail' => $zEmail,
				'zMessage' => $zMessage
			);
		//$paramCorps = array();	
			
		$html = true;
		$zFromMail = MAIL_CONTACT;
		$zFromNom =  "ILAY NOSY Service Client " ;
		$zBcc = array( MAIL_CONTACT_BCC, MAIL_CONTACT_BCC_1);			
		
		//ST BY
		try{
			$msg = mailSrv::envoiEmail($zFromMail, $zFromNom, $zMailTo, $zToNom, $zSujet, $tplCorps, $selecteur, $paramCorps, $html, '', array(), $zBcc);
			
			$rep->datas = array('msg'=>$msg);
			
		}catch(Exception $e){
			$rep->datas = array('msg' => $e->getCode());
			return $rep;
		}

		//Mial d'alert pour l'administrateur : MAIL_CONTACT
		$zMailTo 	= MAIL_CONTACT;
		$zToNom 	= 'Administrateur';
		$zSujet 	= "Voici une nouvelle demande de contact sur ilay-nosy.com de $zPrenom $zNom";	

		$tplCorps 	= "";
		$selecteur 	= "contact~contactMailAdminFo"; 

		$html = true;
		$zFromMail = MAIL_CONTACT;
		$zFromNom =  "ILAY NOSY Service Client " ;
		$zBcc = array();			
		
		try{
			$msg2 = mailSrv::envoiEmail($zFromMail, $zFromNom, $zMailTo, $zToNom, $zSujet, $tplCorps, $selecteur, $paramCorps, $html, '', array(), $zBcc);			
			//$rep->datas = array('msg'=>$msg);
			
		}catch(Exception $e){
			//$rep->datas = array('msg' => $e->getCode());
			//return $rep;
		}


		/*
		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'contact~contactFo_listeContacts';
		$rep->params = $tParams;
		*/
        
        return $rep;        
    }
}
?>
