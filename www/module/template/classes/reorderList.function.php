<?php
	/**
	* réarranger l'ordre d'une page par rapport aux autres
	* @param int $id id de la marque
	* @param int $iNewOrder id du nouvelle du produit
	**/
	static function reorderListeMarque($id, $iNewOrder) {
	
		$oDB = jDb::getDbWidget();
		$zQuery = " SELECT * FROM marque WHERE marque_id = ".$id;
		$toProd = $oDB->fetchAll($zQuery);
		$id = $toProd[0]->marque_id;

		//Chargement des promotions
		$listeDAO = jDao::create('marque~marque');
		$conditions = jDao::createConditions();
		$conditions->addItemOrder("marque_ordreAffichage","ASC");
		$oListeMarque = $listeDAO->findBy($conditions);		
	
		$iIndexPage = 0 ;
		$toListeMarque = array () ;
		while ($oListe = $oListeMarque->fetch ()){

			if ($oListe->marque_id == $id) {
				$iIndexPage = count($toListeMarque);
			}
			array_push ($toListeMarque, $oListe) ;
		}
		
		switch ($iNewOrder) {
			case 1 :		// Descendre
				$toListeMarque[$iIndexPage]->marque_ordreAffichage++ ;
				$listeDAO->update($toListeMarque[$iIndexPage]) ;
				$toListeMarque[$iIndexPage + 1]->marque_ordreAffichage-- ;
				$listeDAO->update($toListeMarque[$iIndexPage + 1]) ;
				break ;
			case 2 :		// Monter
				$toListeMarque[$iIndexPage]->marque_ordreAffichage-- ;
				$listeDAO->update($toListeMarque[$iIndexPage]) ;
				$toListeMarque[$iIndexPage - 1]->marque_ordreAffichage++ ;
				$listeDAO->update($toListeMarque[$iIndexPage - 1]) ;
				break ;
		}
		
	}
?>