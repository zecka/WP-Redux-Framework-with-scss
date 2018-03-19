<?php

/**
 * ReduxFramework Config File (used for theme options)
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored. Then you can get with global $theme_options
$opt_name = "rwss_options";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

 $args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'				 => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'			=> $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'		  => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'				  => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'		 => true,
	// Show the sections below the admin menu item or not
	'menu_title'			  => __( 'Theme Options', $theme->get( 'TextDomain' ) ),
	'page_title'			  => __( 'Theme Options', $theme->get( 'TextDomain' ) ),
	);
	
Redux::setArgs( $opt_name, $args );




/* -------------------------------------
			REDUX SECTIONS
--------------------------------------- */

Redux::setSection($opt_name, array(
	'title'			=>  __('Variables',  $theme->get( 'TextDomain' ) ),
	'id'			=> 'variables',
	'fields'		=> array(
		array(
			'title'		=> __('Primary color',  $theme->get( 'TextDomain' ) ),
			'id'		=> 'primary-color',
			'type'		=> 'color',
			'default'	=> '#ff0000',
		),
		array(
			'title'		=> __('Secondary color',  $theme->get( 'TextDomain' ) ),
			'id'		=> 'secondary-color',
			'type'		=> 'color',
			'default'	=> '#00ff00',
		),
		array(
			'title'			=> __('Hide Header', $theme->get( 'TextDomain' )),
			'id'			=>	'hide-header',
			'type'			=>	'switch',
			'default'   	=> false,
			'description'	=> 'Hide header on all pages"',
		),
	)
));


/* ----------------------------------------------------
	Compile scss to css on Redux Framwork option save
----------------------------------------------------- */
add_action('redux/options/rwss_options/saved', 'rwss_redux_save_option');
function rwss_redux_save_option(){
	
	global $rwss_options;  // This is your opt_name.
	
	require( get_template_directory(). '/inc/scssphp/scss.inc.php' ); // path to scssphp library

	// Here we override variable of scss with value from theme options
	$variables=array(
		"primary-color" => $rwss_options['primary-color'],
		"secondary-color" => $rwss_options['secondary-color'],
		"hide-header" => ($rwss_options['hide-header'])? 'true' : 'false',
		"is-redux" => true,
	);
	$inputFilename=get_template_directory() . '/assets/sass/style.scss';
	$outputFilename='main.css';
	$inputPath=get_template_directory() . '/assets/sass/';
	$outputPath=get_template_directory() . '/assets/css/';
	
	$compiler = new Leafo\ScssPhp\Compiler();
	$compiler->addImportPath($inputPath);
	$compiler->setVariables($variables);
	$input = file_get_contents($inputFilename);
	$compiler->setVariables($variables);
	$output = $compiler->compile($input);
	file_put_contents($outputPath.$outputFilename, $output);	
	
}


