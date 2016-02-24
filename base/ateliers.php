<?php
if (!defined('_ECRIRE_INC_VERSION')) return;


function ateliers_declarer_tables_objets_sql($tables){
	$tables['spip_ateliers'] = array(
	
		'principale' => "oui",
		'field'=> array(
			"id_atelier"	=> "bigint(21) NOT NULL",
			"id_ue_edition"	=> "bigint(21) NOT NULL DEFAULT 0",
			"id_rubrique"	=> "bigint(21) NOT NULL DEFAULT 0",
			"date" => "date DEFAULT '0000-00-00' NOT NULL",
			"nom_referent"	=> "tinytext DEFAULT '' NOT NULL",
			"prenom_referent"	=> "tinytext DEFAULT '' NOT NULL",
			"organisation_referent"	=> "tinytext DEFAULT '' NOT NULL",
			"adresse_referent"	=> "tinytext DEFAULT '' NOT NULL",
			"code_postal_referent"	=> "tinytext DEFAULT '' NOT NULL",
			"ville_referent"	=> "tinytext DEFAULT '' NOT NULL",
			"email_referent"	=> "tinytext DEFAULT '' NOT NULL",
			"telephone_referent"	=> "varchar(20) DEFAULT '' NOT NULL",
			
			"id_organisation"	=> "bigint(21) NOT NULL",
			"complement_autres_organisations"	=> "text DEFAULT '' NOT NULL",
			"partenaires_internationaux"	=> "text DEFAULT '' NOT NULL",
			
			"titre_court"  => "tinytext DEFAULT '' NOT NULL",
			"presentation"	=> "text DEFAULT '' NOT NULL",
			"presentation_generale"	=> "text DEFAULT '' NOT NULL",
			"documents_complementaires"	=> "text DEFAULT '' NOT NULL",
			"temps" => "tinyint NOT NULL DEFAULT 0",
			"nombre_places_valide"	=> "bigint(21) NOT NULL DEFAULT 0",
			"nombre_places_total"	=> "bigint(21) NOT NULL DEFAULT 0",
			"statut" => "varchar(255) DEFAULT '0' NOT NULL",
			"maj"	=> "TIMESTAMP"
		),
		'key' => array(
			"PRIMARY KEY"	=> "id_atelier",
			"KEY id_rubrique" => "id_rubrique",
		),
		'titre' => "titre_court AS titre",

		'champs_editables' => array(
			"nom_referent", "prenom_referent", "organisation_referent", "adresse_referent", "code_postal_referent", "ville_referent",
			"email_referent", "telephone_referent", "complement_autres_organisations", "partenaires_internationaux",
			"titre_court", "presentation", "presentation_generale", "documents_complementaires", "temps"
		),
		
		'champs_contenu' => array(
			"nom_referent", "prenom_referent", "organisation_referent", "adresse_referent", "code_postal_referent", "ville_referent",
			"email_referent", "telephone_referent", "complement_autres_organisations", "partenaires_internationaux",
			"titre_court", "presentation", "presentation_generale", "documents_complementaires", "temps"
		),
		
		'statut'=> array(
			array(
				'champ' => 'statut',
				'publie' => 'publie',
				'previsu' => 'publie,prop,prepa',
				'post_date' => 'date',
				'exception' => array('statut','tout')
			)
		),
		'statut_textes_instituer' => 	array(
			'prepa' => 'texte_statut_en_cours_redaction',
			'prop' => 'texte_statut_propose_evaluation',
			'publie' => 'texte_statut_publie',
			'refuse' => 'texte_statut_refuse',
			'poubelle' => 'texte_statut_poubelle',
		),
		'texte_changer_statut' => 'atelier:texte_changer_statut',
		'tables_jointures' => array()
		
	);

	$tables[]['tables_jointures'][]= 'ateliers_liens';
	$tables[]['tables_jointures'][]= 'ateliers';

	return $tables;
}

function ateliers_declarer_tables_interfaces($interfaces) {
	$interfaces['table_des_tables']['ateliers'] = 'ateliers';
	
	$interfaces['table_des_traitements']['PRESENTATION_GENERALE'][]= "safehtml(".str_replace("%s","interdit_html(%s)",_TRAITEMENT_RACCOURCIS).")";
	$interfaces['table_des_traitements']['DOCUMENTS_COMPLEMENTAIRES'][]= "safehtml(".str_replace("%s","interdit_html(%s)",_TRAITEMENT_RACCOURCIS).")";
	

	return $interfaces;
}



?>
