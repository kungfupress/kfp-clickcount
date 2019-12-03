<?php
/**
 * File: kfp-click-count/include/plugin-init.php
 *
 * @package kfp_clickcount
 */

defined( 'ABSPATH' ) || die();

add_action( 'plugins_loaded', 'kfp_clickcount_textdomain' );
/**
 * Declara donde se encuentran los ficheros de traducción del plugin
 *
 * @return void
 */
function kfp_clickcount_textdomain() {
	$translation_path = 'kfp-clickcount/languages';
	load_plugin_textdomain( 'kfp-clickcount', false, $translation_path );
}
