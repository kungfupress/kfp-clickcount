<?php
/**
 * Plugin Name:   KFP ClickCount
 * Plugin Author: KungFuPress
 * Description:   Cuenta los clicks en enlaces o botones de tu web
 * Plugin URI:    https://github.com/kungfupress/kfp-clickcount
 * Version:       1.0.0
 * Author:        Juanan Ruiz
 * Author URI:    https://kungfupress.com/
 *
 * @package kfp_clickcount
 */

defined( 'ABSPATH' ) || die();

define( 'KFP_CLICKCOUNT_DIR', plugin_dir_path( __FILE__ ) );
define( 'KFP_CLICKCOUNT_PLUGIN_FILE', __FILE__ );
define( 'KFP_CLICKCOUNT_VERSION', '1.0.0' );

// Crea la tabla para los enlaces al activar el plugin.
require_once KFP_CLICKCOUNT_DIR . 'include/create-table.php';
// Llama al fichero JavaScript que estará vigilando la pulsación de enlaces.
require_once KFP_CLICKCOUNT_DIR . 'include/enqueue-scripts.php';
// Procesa la pulsación de un enlace mediante AJAX.
require_once KFP_CLICKCOUNT_DIR . 'include/procesa-click.php';
// Panel administrativo para ver el contenido de la tabla en el escritorio.
require_once KFP_CLICKCOUNT_DIR . 'include/admin-click-list.php';
// Shortcode para mostrar la lista de clicks en escritorio o en la web.
require_once KFP_CLICKCOUNT_DIR . 'include/public-click-list.php';
