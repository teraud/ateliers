<?php
if (!defined('_ECRIRE_INC_VERSION')) return;


function ateliers_upgrade($nom_meta_base_version, $version_cible){

    $maj = array();
	$maj['create'] = array(
		array('maj_tables', array('spip_ateliers')),
	);
	$maj['1.1.0'] = array(
		array('sql_alter',  "TABLE spip_ateliers DROP organisation_chef_de_file"),
		array('sql_alter',  "TABLE spip_ateliers DROP autres_organisations_france"),
		array('maj_tables', array('spip_ateliers')),
	);
	$maj['1.2.0'] = array(
		array('maj_tables', array('spip_ateliers')),
	);
	$maj['1.3.0'] = array(
		array('maj_tables', array('spip_ateliers')),
	);

	$maj['1.4.0'] = array(
		array('maj_tables', array('spip_ateliers')),
	);

	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

function ateliers_vider_tables($nom_meta_base_version) {
	sql_drop_table("spip_ateliers");
	effacer_meta($nom_meta_base_version);
}

?>
