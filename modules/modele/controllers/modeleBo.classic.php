<?php
/**
* @marqueage ilay-nosy
* @submarqueage modele
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les modeles
* @marqueage ilay-nosy
* @submarqueage modele
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class modeleBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des modeles
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
    */
    function listeModeles() {
		jClasses::inc('modele~modeleSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_MODELE);
		$rep->bodyTpl = 'modele~modeleBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeModeleBo", "modele~listeModeleBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionModele() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/modeles.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_MODELE);
		
		//Template � utiliser
		$rep->bodyTpl = 'modele~modeleBo';

		//R�cup�ration des param�tres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('modele_id')) {
			$this->modele_id = $this->intParam('modele_id');
		}else{
			$this->modele_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','modele~listeModeleBo.zone'));

		//Chargement des donn�es
		jClasses::inc('modele~modeleSrv');
		
		if ($this->modele_id != 0) {
			try {
				$modele = modeleSrv::chargeModele($this->modele_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$modele = modeleSrv::getDaoModele();
			$modele->modele_statut = USER_STATUT_ON;			
		}

		$tParams = array('modele_id'=> $this->modele_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		//categorieAn
		jClasses::inc('marque~marqueSrv');
		$listeMarque = marqueSrv::chargeAllmarque();
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign("listeMarque", $listeMarque);		
		$rep->body->assign('modele', $modele);													
		$rep->body->assign("modele_id", $this->modele_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls modele sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeModele() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$modele = jMagicLoader::arrayToObject($this->request->params, 'modele');

		//R�cup�ration des param�tres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('modeleSrv');

		//Save
		$id = modeleSrv::sauvegardeModele($modele);

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'modele~modeleBo_listeModeles';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls modele supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeModele() {

		//R�cup�ration des param�tres
		$modeleId = $this->intParam('modele_id',0, FALSE);
		if ($modeleId == 0) {
			throw new Exception('Invalid parameter modele_id');
		}

		//Suppression
		jClasses::inc('modeleSrv');
		modeleSrv::supprimeModele($modeleId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'modele~modeleBo_listeModeles';
        
        return $rep;
    }
	
	/**
    * Charge la liste de rubprique pour la cat�gorie d'annonce en cours
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls modele supprim�e, redirige vers la page de liste des actualit�s
    */
	function showModele(){
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('modele~modeleSrv');
		$idMarqueId = $this->intParam('idMarqueId', 0, true);
		
		$toModele = modeleSrv::getAllModele($idMarqueId);
		if(sizeof($toModele)>0)
		{
			$tModele = array();
			foreach($toModele as $oModele)
			{
				$oModele->modele_libelle = htmlentities($oModele->modele_libelle);
				$oModele->modele_code = htmlentities($oModele->modele_code);
				array_push($tModele, $oModele);
			}
			$result = array('toModele' => $tModele);
		}
		else
			$result = array('toModele' => 0);

		$rep->datas = $result;
		return $rep;	
	}
	
	
}
?>
