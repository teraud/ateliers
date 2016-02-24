<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

/* pour que le pipeline ne rale pas ! */
function ateliers_autoriser(){}

/**
 * Autorisation à créer un atelier
 *
 * @param string $faire
 * @param string $type
 * @param int $id
 * @param array $qui
 * @param array $opts
 * @return bool
 */
function autoriser_atelier_creer_dist($faire,$type,$id,$qui,$opts){
    return (in_array($qui['statut'], array('0minirezo', '1comite', '6forum')) AND sql_countsel('spip_rubriques') > 0);
}

/**
 * Autorisation à modifier un atelier
 *
  * @param string $faire
 * @param string $type
 * @param int $id
 * @param array $qui
 * @param array $opts
 * @return bool
 */
function autoriser_atelier_modifier_dist($faire,$type,$id,$qui,$opts){
	/* on regarde si la personne connectee est un auteur lie a ce partenaire */
	if (sql_getfetsel('id_auteur', 'spip_auteurs_liens', 'id_auteur='.intval($qui['id_auteur']).' AND id_objet='.intval($id).' AND objet="'.$type.'"')) {
		return true;
	}
	if ($qui['statut']=='0minirezo' AND !$qui['restreint'])
		return true;
	return false;
}

/**
 * Autorisation à supprimer un atelier
 *
 * @param string $faire
 * @param string $type
 * @param int $id
 * @param array $qui
 * @param array $opts
 * @return bool
 */
function autoriser_atelier_supprimer_dist($faire,$type,$id,$qui,$opts){
	return ($qui['statut']=='0minirezo' AND !$qui['restreint']);
}

?>
