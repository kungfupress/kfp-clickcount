<?php
/**
 * File: kfp-click-count/include/plugin-init.php
 *
 * @package kfp_clickcount
 */

defined( 'ABSPATH' ) || die();

add_action( 'plugins_loaded', 'kfp_clickcount_init' );
/**
 * Inicializa el plugin
 *
 * @return void
 */
function kfp_clickcount_init() {
	$translation_path = KFP_CLICKCOUNT_DIR . 'languages';
	load_plugin_textdomain( 'kfp-clickcount', false, $translation_path );
}
