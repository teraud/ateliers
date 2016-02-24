<?php

/**
 * Ajouter les ateliers sur les vues de rubriques
 *
 * @param 
 * @return 
**/
function ateliers_affiche_enfants($flux) {
	if ($e = trouver_objet_exec($flux['args']['exec'])
	  AND $e['type'] == 'rubrique'
	  AND $e['edition'] == false) {
		  
		$id_rubrique = $flux['args']['id_rubrique'];
		
		if ($id_rubrique == 47) {
			
			$bouton = '';
			if (autoriser('creeratelierdans','rubrique', $id_rubrique)) {
				$bouton .= icone_verticale(_T('atelier:icone_creer_atelier'), generer_url_ecrire('atelier_edit', "id_rubrique=$id_rubrique"), "atelier-24.png", "new", 'right')
						. "<br class='nettoyeur' />";
			}

			$lister_objets = charger_fonction('lister_objets','inc');	
			$flux['data'] .= $lister_objets('ateliers',array('titre'=>_T('atelier:titre_ateliers_rubrique') , 'id_rubrique'=>$id_rubrique, 'par'=>'nom'));
			$flux['data'] .= $bouton;
			
		}
  			
	}

	return $flux;
}

function ateliers_affiche_milieu($flux) {
	$texte = "";
	$e = trouver_objet_exec($flux['args']['exec']);

	// auteurs sur les ateliers
	if ($e['type'] == 'atelier' AND !$e['edition']) {
		$texte = recuperer_fond('prive/objets/editer/liens', array(
			'table_source' => 'auteurs',
			'objet' => $e['type'],
			'id_objet' => $flux['args'][$e['id_table_objet']],
			#'editable'=>autoriser('associerauteurs',$e['type'],$e['id_objet'])?'oui':'non'
		));
	}

	if ($texte) {
		if ($p=strpos($flux['data'],"<!--affiche_milieu-->"))
			$flux['data'] = substr_replace($flux['data'],$texte,$p,0);
		else
			$flux['data'] .= $texte;
	}
	
	return $flux;
}
?>
