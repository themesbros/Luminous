<?php

/* Get the template directory and make sure it has a trailing slash. */
$theme_dir = trailingslashit( get_template_directory() );

/* Load the Hybrid Core framework and launch it. */
require_once( $theme_dir . 'library/hybrid.php' );
new Hybrid();

/* Set up the theme early. */
add_action( 'after_setup_theme', 'luminous_theme_setup', 5 );

/**
 * The theme setup function.  This function sets up support for various WordPress and framework functionality.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function luminous_theme_setup() {

	$theme_dir = trailingslashit( get_template_directory() );

	/* Load files. */
	require_once( $theme_dir . 'inc/theme-setup.php' );
	require_once( $theme_dir . 'inc/theme-customizer-setup.php' );
	require_once( $theme_dir . 'inc/recommended-plugins.php' );

	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 1140 );

	/* Theme layouts. */
	add_theme_support( 'theme-layouts', array( 'default' => '2c-l' ) );

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Breadcrumbs. */
	add_theme_support( 'breadcrumb-trail' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/* From wp 4.1 support for title tag. */
	add_theme_support( 'title-tag' );

	/* Support for Custom Content Portfolio. */
	add_theme_support( 'custom-content-portfolio' );

}