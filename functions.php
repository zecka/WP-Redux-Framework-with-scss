<?php
	
/*
 * Load Redux Frameweok
 *
 *
 */
 

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/redux-framework/ReduxCore/framework.php' ) ) {
    require_once( get_template_directory() . '/inc/redux-framework/ReduxCore/framework.php' );
}
if ( !isset( $huni_options ) && file_exists( dirname( __FILE__ ) . '/configs/admin/redux-config.php' ) ) {
    require_once( get_template_directory() . '/configs/admin/redux-config.php' );
}



add_action('wp_enqueue_scripts', 'rwss_enqueue_scripts');
function rwss_enqueue_scripts(){
	wp_enqueue_style('main', get_template_directory_uri().'/assets/css/main.css');
}
