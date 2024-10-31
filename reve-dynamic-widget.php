<?php
/*
Plugin Name:		Reve Dynamic Widget
Version:			1.7.0
Description:		Add any text, HTML, CSS, Javascript and/or PHP code, and show it in the pages you want.
Author:				Fernando Reve
Author URI:			https://promostudio.es
Plugin URI: 		https://promostudio.es
Text Domain:		reve-dynamic-widget
Domain Path:		languages/
License:			GPL2 
*/
if ( !defined('ABSPATH') ) exit;


/*
** The plugin constants 
*/
define ('REVEDW_VERSION', '1.7.0');								// The current plugin version
define ('REVEDW_ABSPATH', plugin_dir_path( __FILE__ ) );		// Absolute plugin path with slash(/)
define ('REVEDW_RELPATH', plugin_basename( REVEDW_ABSPATH ) );	// reve-dynamic-widget
define ('REVEDW_BASEID', 'revedw');								// The widget base_id defined in class
define ('REVEDW_ADMIN', is_admin() );							// If is an admin page


/*
** Registers the widget class
** Used by widgets_init hook	
*/
if ( !function_exists('revedw_register_widgets') ):
	
	add_action('widgets_init', 'revedw_register_widgets');
	
	function revedw_register_widgets() {
		
		require_once( REVEDW_ABSPATH.'reve-dynamic-widget-class.php');
		register_widget('Reve_Dynamic_Widget');	
		
	} // :/function

endif;


/*
** Sets the text domain (translation ready)
** Used by plugins_loaded hook
*/ 
if ( !function_exists('revedw_load_textdomain') ):
	
	add_action('plugins_loaded','revedw_load_textdomain');

	function revedw_load_textdomain() {
		
		// Loads the text domain at languages directory:
		$languages_rel_path =  REVEDW_RELPATH .'/languages';
		load_plugin_textdomain( 'reve-dynamic-widget', false, $languages_rel_path);
		
	} // :/function

endif;


/*
** Checks automatic upgrades from repository
** Used by upgrader_process_complete hook
*/ 
if ( !function_exists('revedw_check_upgrade') ):

	add_action( 'upgrader_process_complete', 'revedw_check_upgrade',10, 2);
 
	function revedw_check_upgrade ( $upgrader_object, $options ) {
	
		$upgrade = false;

		$plugin_basename = plugin_basename( __FILE__ );

    	if ($options['action'] == 'update' && $options['type'] == 'plugin' ):
			if ( in_array( $plugin_basename, $options['plugins'] ) == true ) $upgrade = true;
		endif;

		return $upgrade;
	
	} // :/function

endif;