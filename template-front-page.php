<?php
/**
 * Template Name: Front Page
 */

get_header();

	/* Default section order. */
    $default_sections = array(
		'slider',
		'services',
		'portfolio',
		'posts',
		'countTo',
		'tables',
		'team',
		'cta',
		'gmap',
		'contact'
	);

    $sections = array();

    $i = 0;

    foreach( $default_sections as $section ) {
    	$sections[] = esc_html( get_theme_mod( "section_{$i}", $default_sections[$i] ) );
    	$i++;
    }

    $sections = array_unique( $sections );

    foreach( $sections as $section )
    	get_template_part( "template", "parts/{$section}" );

?>

<?php get_footer(); ?>