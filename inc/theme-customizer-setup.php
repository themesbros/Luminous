<?php

/* Theme Customizer setup. */
add_action( 'customize_register', 'luminous_customizer_options', 20 );

/**
 * Sets up the theme customizer sections, controls, and settings.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $wp_customize
 * @return void
 */
function luminous_customizer_options( $wp_customize ) {

	/* Load Font Chooser Control. */
	require_once( trailingslashit( get_template_directory() ) . 'inc/customizer-control-font-chooser.php' );
	require_once( trailingslashit( get_template_directory() ) . 'inc/customizer-control-code.php' );

	/* Load Font Awesome array. */
	require_once( 'font-awesome-array.php' );

	/* === Site Identity === */

	$wp_customize->add_setting( 'logo_icon', array(
		'default'           => 'fa-lightbulb-o',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new TB_Font_Picker(
        $wp_customize,
        'logo_icon',
        array(
			'label'    => __( 'Icon Before Site Title', 'luminous' ),
			'section'  => 'title_tagline',
			'settings' => 'logo_icon',
			'priority' => 1,
			'choices'  => $list // Defined in font-awesome-array.php.
		)
    ) );

	/* === Header Options === */

	$wp_customize->add_section( 'section_header', array(
		'title'    => __( 'Header Options', 'luminous' ),
		'priority' => 22
    ) );

	$wp_customize->add_setting( 'display_address', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_address', array(
		'label'    => __( 'Show address?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_header',
		'settings' => 'display_address',
	) );

	$wp_customize->add_setting( 'header_address_icon', array(
		'default'           => 'fa-home',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new TB_Font_Picker(
        $wp_customize,
        'header_address_icon',
        array(
			'label'    => __( 'Address Icon', 'luminous' ),
			'section'  => 'section_header',
			'settings' => 'header_address_icon',
			'choices'  => $list // Defined in font-awesome-array.php.
		)
	) );

	$wp_customize->add_setting( 'header_address', array(
		'default'           => __( '30 Lincoln Center Plaza New York, NY', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'header_address', array(
		'label'    => __( 'Your Address', 'luminous' ),
		'section'  => 'section_header',
		'settings' => 'header_address',
	) );

	$wp_customize->add_setting( 'display_contact', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_contact', array(
		'label'    => __( 'Show contact info?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_header',
		'settings' => 'display_contact',
	) );

	$wp_customize->add_setting( 'header_contact_icon', array(
		'default'           => 'fa-phone',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new TB_Font_Picker(
        $wp_customize,
        'header_contact_icon',
        array(
			'label'    => __( 'Contact Icon', 'luminous' ),
			'section'  => 'section_header',
			'settings' => 'header_contact_icon',
			'choices'  => $list // Defined in font-awesome-array.php.
		)
    ) );

	$wp_customize->add_setting( 'header_contact', array(
		'default'           => '+1 212-564-5555 contact@example.com', // Reviewers: no need for localization.
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'header_contact', array(
		'label'    => __( 'Your Contact Info:', 'luminous' ),
		'section'  => 'section_header',
		'settings' => 'header_contact',
	) );

	$wp_customize->add_setting( 'display_social', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_social', array(
		'label'       => __( 'Show Social Profiles In Header?', 'luminous' ),
		'description' => __( 'If you want to hide particular link, leave the field blank.', 'luminous' ),
		'type'        => 'checkbox',
		'section'     => 'section_header',
		'settings'    => 'display_social',
	) );


	$social_profiles = array( 'facebook', 'twitter', 'google', 'youtube', 'linkedin', 'instagram', 'pinterest', 'github', 'flickr', 'wordpress', 'codepen', 'digg', 'dribbble', 'dropbox', 'skype', 'reddit', 'stumbleupon', 'tumblr', 'vimeo' );

	foreach( $social_profiles as $profile ) {

		$default = '';

		if ( in_array( $profile, array('facebook', 'twitter', 'google', 'linkedin', 'youtube') ) )
			$default = "http://www.{$profile}.com/";

		$wp_customize->add_setting( $profile, array(
			'default'           => $default,
			'sanitize_callback' => 'esc_url_raw'
		) );

		$wp_customize->add_control( $profile, array(
			'label'    => sprintf( __( '%s URL:', 'luminous' ), ucfirst( $profile ) ),
			'section'  => 'section_header',
			'settings' => $profile,
		) );

	}

	/* === Pre-Footer Options === */

	$wp_customize->add_section( 'section_prefooter', array(
		'title'    => __( 'Pre-Footer Options', 'luminous' ),
    ) );

	$wp_customize->add_setting( 'display_pf_social', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_pf_social', array(
		'label'    => __( 'Show Social Profiles In Footer?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_prefooter',
		'settings' => 'display_pf_social',
	) );

	$wp_customize->add_setting( 'social_title', array(
		'default'           => __( 'GET SOCIAL', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'social_title', array(
		'label'    => __( 'Social Title', 'luminous' ),
		'section'  => 'section_prefooter',
		'settings' => 'social_title',
	) );

	$wp_customize->add_setting( 'display_pf_address', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_pf_address', array(
		'label'    => __( 'Show address?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_prefooter',
		'settings' => 'display_pf_address',
	) );

	$wp_customize->add_setting( 'footer_address_title', array(
		'default'           => __( 'OUR ADDRESS', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'footer_address_title', array(
		'label'    => __( 'Title', 'luminous' ),
		'section'  => 'section_prefooter',
		'settings' => 'footer_address_title',
	) );

	$wp_customize->add_setting( 'footer_address_icon', array(
		'default'           => 'fa-home',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new TB_Font_Picker(
        $wp_customize,
        'footer_address_icon',
        array(
			'label'    => __( 'Address Icon', 'luminous' ),
			'section'  => 'section_prefooter',
			'settings' => 'footer_address_icon',
			'choices'  => $list // Defined in font-awesome-array.php.
		)
	) );

	$wp_customize->add_setting( 'footer_address', array(
		'default'           => __( '30 Lincoln Center Plaza New York, NY', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'footer_address', array(
		'label'    => __( 'Your Address', 'luminous' ),
		'section'  => 'section_prefooter',
		'settings' => 'footer_address',
	) );

	$wp_customize->add_setting( 'display_pf_contact', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_pf_contact', array(
		'label'    => __( 'Show contact info?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_prefooter',
		'settings' => 'display_pf_contact',
	) );

	$wp_customize->add_setting( 'foter_contact_title', array(
		'default'           => __( 'EMERGENCY CALL', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'foter_contact_title', array(
		'label'    => __( 'Title', 'luminous' ),
		'section'  => 'section_prefooter',
		'settings' => 'foter_contact_title',
	) );

	$wp_customize->add_setting( 'footer_contact_icon', array(
		'default'           => 'fa-phone',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new TB_Font_Picker(
        $wp_customize,
        'footer_contact_icon',
        array(
			'label'    => __( 'Contact Icon', 'luminous' ),
			'section'  => 'section_prefooter',
			'settings' => 'footer_contact_icon',
			'choices'  => $list // Defined in font-awesome-array.php.
		)
    ) );

	$wp_customize->add_setting( 'footer_contact', array(
		'default'           => '+1 212-564-5555 contact@example.com', // Reviewers: no need for localization.
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'footer_contact', array(
		'label'    => __( 'Your Contact Info:', 'luminous' ),
		'section'  => 'section_prefooter',
		'settings' => 'footer_contact',
	) );

	$wp_customize->add_setting( 'display_btt', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_btt', array(
		'label'    => __( 'Show Back To Top Button?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_prefooter',
		'settings' => 'display_btt',
	) );

	/*==========================================
	=            Front Page Options            =
	==========================================*/

 	$wp_customize->add_panel( 'luminous_fp', array(
		'capability'  => 'edit_theme_options',
		'title'       => __( 'Front Page', 'luminous' ),
		'description' => __( 'In order to use these options, you must first go to "Static Front Page", and select "A static Page". Under "Front page" select the page you want to display on front page. Now go to this page (Dashboard / Pages / Page) and on the right side, under "Page Attributes / Template" select "Front Page". Go back here and set your options. ', 'luminous' ),
 	) );

 	/*----------  Slider Setup  ----------*/

 	$wp_customize->add_section( 'slider_section', array(
 		'title'	=> __( 'Slider', 'luminous' ),
 		'panel' => 'luminous_fp',
 	) );

 	$wp_customize->add_setting( 'slider_display', array(
 		'default'           => 1,
 		'sanitize_callback' => 'customizer_sanitize_checkbox'
 	) );

 	$wp_customize->add_control( 'slider_display', array(
 		'label'    => __( 'Display slider?', 'luminous' ),
 		'type'     => 'checkbox',
 		'section'  => 'slider_section',
 		'settings' => 'slider_display',
 	) );

    $wp_customize->add_setting( 'slider_mode', array(
    	'default'           => 'fade',
    	'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'slider_mode', array(
    	'type'    => 'radio',
    	'label'   => __( 'Sliding Transition', 'luminous' ),
    	'section' => 'slider_section',
        'choices' => array(
			'fade'       => __( 'Fade', 'luminous' ),
			'horizontal' => __( 'Horizontal', 'luminous' ),
			'vertical'   => __( 'Vertical', 'luminous' ),
        )
    ) );

    $wp_customize->add_setting( 'slider_auto', array(
    	'default'           => 1,
    	'sanitize_callback' => 'customizer_sanitize_checkbox'
    ) );

    $wp_customize->add_control( 'slider_auto', array(
    	'label'    => __( 'Slide automatically?', 'luminous' ),
    	'type'     => 'checkbox',
    	'section'  => 'slider_section',
    	'settings' => 'slider_auto',
    ) );

    $wp_customize->add_setting( 'slider_pause', array(
    	'default'           => 4000,
    	'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'slider_pause', array(
    	'type'    => 'range',
    	'label'   => __( 'Pause between slides', 'luminous' ),
    	'section' => 'slider_section',
        'input_attrs' => array(
    		'min'  => 1000,
    		'max'  => 15000,
    		'step' => 1000,
        )
    ) );

    for( $i = 1; $i < 11; $i++ ) :

		if ( $i < 4 ) {
			$def_img = trailingslashit( get_template_directory_uri() ) . "images/slide-{$i}.jpg";
			$slide_title = __( 'Slide Title', 'luminous' ) . ' ' . $i;
			$slide_desc  = __( 'Here goes slide title description', 'textdomain' ) . ' ' . $i;
			$button1     = __( 'Button 1', 'luminous' );
			$button2     = __( 'Button 2', 'luminous' );
			$button_url  = '#';
		}
		else {
			$def_img     = '';
			$slide_title = '';
			$slide_desc  = '';
			$button1     = '';
			$button2     = '';
			$button_url  = '';
		}

	 	$wp_customize->add_setting( "slide_img_{$i}", array(
			'default'           => $def_img,
			'sanitize_callback' => 'esc_url_raw',
 		) );

	 	$wp_customize->add_control(
	 	    new WP_Customize_Image_Control(
	 	        $wp_customize,
	 	        "slide_img_{$i}",
	 	        array(
	 				'label'    => __( 'Slide Image', 'luminous' ),
	 				'section'  => 'slider_section',
	 				'settings' => "slide_img_{$i}"
	 	        )
	 	    )
	 	);

	 	$wp_customize->add_setting( "slide_title_{$i}", array(
			'default'           => $slide_title,
			'sanitize_callback' => 'sanitize_text_field',
	 	) );

	 	$wp_customize->add_control( "slide_title_{$i}", array(
	 		'label'    => __( 'Slide Title', 'luminous' ),
	 		'section'  => 'slider_section',
	 		'settings' => "slide_title_{$i}",
	 	) );

	 	$wp_customize->add_setting( "slide_text_{$i}", array(
			'default'           => $slide_desc,
			'sanitize_callback' => 'sanitize_text_field',
	 	) );

	 	$wp_customize->add_control( "slide_text_{$i}", array(
	 		'label'    => __( 'Slide Text', 'luminous' ),
	 		'section'  => 'slider_section',
	 		'settings' => "slide_text_{$i}",
	 	) );

	 	$wp_customize->add_setting( "slide_button_1_{$i}", array(
			'default'           => $button1,
			'sanitize_callback' => 'sanitize_text_field',
	 	) );

	 	$wp_customize->add_control( "slide_button_1_{$i}", array(
	 		'label'    => __( 'Button 1 Text', 'luminous' ),
	 		'section'  => 'slider_section',
	 		'settings' => "slide_button_1_{$i}",
	 	) );

	 	$wp_customize->add_setting( "slide_button_url_1_{$i}", array(
	 		'sanitize_callback' => 'esc_url_raw',
	 	) );

	 	$wp_customize->add_control( "slide_button_url_1_{$i}", array(
	 		'label'    => __( 'Button 1 URL', 'luminous' ),
	 		'section'  => 'slider_section',
	 		'settings' => "slide_button_url_1_{$i}",
	 	) );

	 	$wp_customize->add_setting( "slide_button_2_{$i}", array(
			'default'           => $button2,
	 		'sanitize_callback' => 'sanitize_text_field',
	 	) );

	 	$wp_customize->add_control( "slide_button_2_{$i}", array(
	 		'label'    => __( 'Button 2 Text', 'luminous' ),
	 		'section'  => 'slider_section',
	 		'settings' => "slide_button_2_{$i}",
	 	) );

	 	$wp_customize->add_setting( "slide_button_url_2_{$i}", array(
	 		'sanitize_callback' => 'esc_url_raw',
	 	) );

	 	$wp_customize->add_control( "slide_button_url_2_{$i}", array(
	 		'label'    => __( 'Button 2 URL', 'luminous' ),
	 		'section'  => 'slider_section',
	 		'settings' => "slide_button_url_2_{$i}",
	 	) );

    endfor;

    /*----------  Slider Footer  ----------*/

    $wp_customize->add_section( 'slider_footer', array(
		'title'       => __( 'Slider Footer', 'luminous' ),
		'panel'       => 'luminous_fp',
		'description' => __( 'Here you can set bottom part of the slider. It can contain up to 4 items, but it will also work with less.', 'luminous' ),
    ) );

	$defaults = array(
		'sf_title_1' => __( 'We are trendy', 'luminous' ),
		'sf_title_2' => __( 'Consultation', 'luminous' ),
		'sf_title_3' => __( 'Free Helpline', 'luminous' ),
		'sf_title_4' => __( '24/7 Working', 'luminous' ),
		'sf_text'    => __( 'There are many variations', 'luminous' )
	);

    for ( $i = 1; $i < 5; $i++ ) :

    	$wp_customize->add_setting( "sf_title_{$i}", array(
    		'default'           => $defaults["sf_title_{$i}"],
    		'sanitize_callback' => 'sanitize_text_field',
    	) );

    	$wp_customize->add_control( "sf_title_{$i}", array(
    		'label'    => __( 'Title', 'luminous' ),
    		'section'  => 'slider_footer',
    		'settings' => "sf_title_{$i}",
    	) );

    	$wp_customize->add_setting( "sf_text_{$i}", array(
    		'default'           => $defaults["sf_text"],
    		'sanitize_callback' => 'sanitize_text_field',
    	) );

    	$wp_customize->add_control( "sf_text_{$i}", array(
    		'label'    => __( 'Short Text', 'luminous' ),
    		'section'  => 'slider_footer',
    		'settings' => "sf_text_{$i}",
    	) );

    endfor;

	/*----------  Services  ----------*/

	$wp_customize->add_section( 'section_services', array(
		'title' => __( 'Services', 'luminous' ),
		'panel' => 'luminous_fp',
    ) );

	$wp_customize->add_setting( 'display_services', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_services', array(
		'label'    => __( 'Display services?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_services',
		'settings' => 'display_services',
	) );

	$wp_customize->add_setting( 'services_title', array(
		'default'           => __( 'Why choose us?', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'services_title', array(
		'label'    => __( 'Services Title', 'luminous' ),
		'section'  => 'section_services',
		'settings' => 'services_title',
	) );

	$wp_customize->add_setting( 'services_subtitle', array(
		'default'           => __( 'Sed ut perspiciatis unde omnis iste natus bulka', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'services_subtitle', array(
		'label'    => __( 'Services Subtitle', 'luminous' ),
		'section'  => 'section_services',
		'settings' => 'services_subtitle',
	) );

	$wp_customize->add_setting( 'services_columns', array(
		'default'           => 4,
		'sanitize_callback' => 'absint',
    ) );

	$wp_customize->add_control( 'services_columns', array(
		'type'        => 'select',
		'label'       => __( 'Services Columns', 'luminous' ),
		'description' => __( 'Number of columns per row', 'luminous' ),
		'section'     => 'section_services',
        'choices' 	  => array(
			1 => 1,
			2 => 2,
			3 => 3,
			4 => 4,
        ),
    ) );

	$defaults = array(
		'title_1' => __( 'A REAL TIME-SAVER', 'luminous' ),
		'title_2' => __( 'FREE SUPPORT', 'luminous' ),
		'title_3' => __( 'NO ROCKET SCIENCE', 'luminous' ),
		'title_4' => __( 'SOME CORE FEATURES', 'luminous' ),
		'icon_1'  => 'fa-clock-o',
		'icon_2'  => 'fa-life-ring',
		'icon_3'  => 'fa-rocket',
		'icon_4'  => 'fa-cog',
	);

    for( $i = 1; $i < 10; $i++ ) :

		$title = isset( $defaults["title_{$i}"] ) ? $defaults["title_{$i}"] : '';
		$icon  = isset( $defaults["icon_{$i}"] ) ? $defaults["icon_{$i}"] : '';
    	$dummy_desc = 'In hac habitasse platea dictumst. Aliquam erat volutpat. Donec ut lorem maximus, auctor turpis eu, fringilla';
    	$desc  = $title != '' ? $dummy_desc : '';

		$wp_customize->add_setting( "services_icon_{$i}", array(
			'default'           => $icon,
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new TB_Font_Picker(
	        $wp_customize,
	        "services_icon_{$i}",
	        array(
				'label'    => __( 'Service Icon', 'luminous' ) . ' ' . $i ,
				'section'  => 'section_services',
				'settings' => "services_icon_{$i}",
				'choices'  => $list // Defined in font-awesome-array.php.
			)
	    ) );

		$wp_customize->add_setting( "services_title_{$i}", array(
			'default'           => $title,
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( "services_title_{$i}", array(
			'label'    => __( 'Service Title', 'luminous' ) . ' ' . $i,
			'section'  => 'section_services',
			'settings' => "services_title_{$i}",
		) );

		$wp_customize->add_setting( "services_text_{$i}", array(
			'default'           => $desc,
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( "services_text_{$i}", array(
			'label'   => __( 'Service Text', 'luminous' ) . ' ' . $i,
			'type'    => 'textarea',
			'section' => 'section_services',
		) );

   	endfor;

   	/*----------  Portfolio  ----------*/

   	$wp_customize->add_section( 'section_portfolio', array(
   		'title'	=> __( 'Portfolio', 'luminous' ),
		'description' => sprintf(
			__( 'In order to use this section fully you need to install %sCustom Content Portfolio%s plugin.', 'luminous' ),
			'<a href="' . admin_url( 'plugin-install.php?tab=search&s=custom+content+portfolio' ) . '">', '</a>' ),
   		'panel' => 'luminous_fp',
   	) );

   	$wp_customize->add_setting( 'display_portfolio', array(
   		'default'           => 1,
   		'sanitize_callback' => 'customizer_sanitize_checkbox'
   	) );

   	$wp_customize->add_control( 'display_portfolio', array(
   		'label'    => __( 'Display portfolio?', 'luminous' ),
   		'type'     => 'checkbox',
   		'section'  => 'section_portfolio',
   		'settings' => 'display_portfolio',
   	) );

	$wp_customize->add_setting( 'portfolio_title', array(
		'default'           => __( 'FEATURED WORKS', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'portfolio_title', array(
		'label'    => __( 'Portfolio Title', 'luminous' ),
		'section'  => 'section_portfolio',
		'settings' => 'portfolio_title',
	) );

	$wp_customize->add_setting( 'portfolio_subtitle', array(
		'default'           => __( 'Some of our recent projects', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'portfolio_subtitle', array(
		'label'    => __( 'Portfolio Subtitle', 'luminous' ),
		'section'  => 'section_portfolio',
		'settings' => 'portfolio_subtitle',
	) );

   	$wp_customize->add_setting( 'portfolio_auto', array(
   		'default'           => 0,
   		'sanitize_callback' => 'customizer_sanitize_checkbox'
   	) );

   	$wp_customize->add_control( 'portfolio_auto', array(
   		'label'    => __( 'Slide automatically?', 'luminous' ),
   		'type'     => 'checkbox',
   		'section'  => 'section_portfolio',
   		'settings' => 'portfolio_auto',
   	) );

   	$wp_customize->add_setting( 'portfolio_pause', array(
   		'default'           => 4000,
   		'sanitize_callback' => 'absint',
   	) );

   	$wp_customize->add_control( 'portfolio_pause', array(
   		'type'    => 'range',
   		'label'   => __( 'Pause between slides', 'luminous' ),
   		'section' => 'section_portfolio',
   	    'input_attrs' => array(
   			'min'  => 1000,
   			'max'  => 15000,
   			'step' => 1000,
   	    )
   	) );

    $wp_customize->add_setting( 'portfolio_number', array(
    	'default'           => 8,
    	'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'portfolio_number', array(
    	'label'    => __( 'Number of items to show', 'luminous' ),
    	'section'  => 'section_portfolio',
    	'settings' => 'portfolio_number',
    ) );

	/*----------  Posts  ----------*/

	$wp_customize->add_section( 'section_posts', array(
		'title' => __( 'Latest Posts', 'luminous' ),
		'panel' => 'luminous_fp',
    ) );

	$wp_customize->add_setting( 'display_posts', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_posts', array(
		'label'    => __( 'Display latest posts?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_posts',
		'settings' => 'display_posts',
	) );

	$wp_customize->add_setting( 'posts_title', array(
		'default'           => __( 'LATEST FROM BLOG', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'posts_title', array(
		'label'    => __( 'Title', 'luminous' ),
		'section'  => 'section_posts',
		'settings' => 'posts_title',
	) );

 	$wp_customize->add_setting( 'posts_subtitle', array(
		'default'           => __( 'Freshest news from our blog', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'posts_subtitle', array(
		'label'    => __( 'Subtitle', 'luminous' ),
		'section'  => 'section_posts',
		'settings' => 'posts_subtitle',
	) );

 	$wp_customize->add_setting( 'posts_number', array(
		'default'           => 2,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'posts_number', array(
		'label'    => __( 'Number of posts to show', 'luminous' ),
		'section'  => 'section_posts',
		'settings' => 'posts_number',
	) );

	$wp_customize->add_setting( 'posts_cats', array(
		'default'           => 1,
		'sanitize_callback' => 'absint',
    ) );

	$wp_customize->add_control( 'posts_cats', array(
		'label'       => __( 'Select Category', 'luminous' ),
		'description' => __( 'Choose specific category to show posts from, or leave at "All Categories" to show latest posts from all categories.', 'luminous' ),
		'type'        => 'select',
		'section'     => 'section_posts',
		'choices'     => luminous_categories_array()
    ) );

	$wp_customize->add_setting( 'post_image', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'post_image', array(
		'label'    => __( 'Display post default image?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_posts',
		'settings' => 'post_image',
	) );

 	$wp_customize->add_setting( 'posts_length', array(
		'default'           => 33,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'posts_length', array(
		'label'    => __( 'Number of words to show:', 'luminous' ),
		'section'  => 'section_posts',
		'settings' => 'posts_length',
	) );

	$wp_customize->add_setting( 'post_columns', array(
		'default'           => 2,
		'sanitize_callback' => 'absint',
    ) );

	$wp_customize->add_control( 'post_columns', array(
		'type'        => 'select',
		'label'       => __( 'Columns Number', 'luminous' ),
		'description' => __( 'In how many columns to display posts?', 'luminous' ),
		'section'     => 'section_posts',
        'choices' => array(
			2 => 2,
			3 => 3,
			4 => 4,
        ),
    ) );

	/*----------  Count To  ----------*/

	$wp_customize->add_section( 'section_countTo', array(
		'title'	=> __( 'Count To', 'luminous' ),
		'panel' => 'luminous_fp',
	) );

	$wp_customize->add_setting( 'display_countTo', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_countTo', array(
		'label'    => __( 'Display count to section?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_countTo',
		'settings' => 'display_countTo',
	) );

	$defaults = array(
		'to_1' => 3694,
		'to_2' => 82575,
		'to_3' => 121,
		'to_4' => 63,
		'text_1' => __( 'Customers', 'luminous' ),
		'text_2' => __( 'Online sales', 'luminous' ),
		'text_3' => __( 'Retailers', 'luminous' ),
		'text_4' => __( 'Years in business', 'luminous' ),
	);

	for ( $i = 1; $i < 5; $i++ ) {

		$wp_customize->add_setting( "countTo_from_{$i}", array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( "countTo_from_{$i}", array(
			'label'    => __( 'Number to count from', 'luminous' ),
			'section'  => 'section_countTo',
			'settings' => "countTo_from_{$i}",
		) );

		$wp_customize->add_setting( "countTo_to_{$i}", array(
			'default'           => $defaults["to_{$i}"],
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( "countTo_to_{$i}", array(
			'label'    => __( 'Number to count to', 'luminous' ),
			'section'  => 'section_countTo',
			'settings' => "countTo_to_{$i}",
		) );

		$wp_customize->add_setting( "countTo_text_{$i}", array(
			'default'           => $defaults["text_{$i}"],
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( "countTo_text_{$i}", array(
			'label'    => __( 'Text', 'luminous' ),
			'section'  => 'section_countTo',
			'settings' => "countTo_text_{$i}",
		) );

	}

	/*----------  Pricing Tables  ----------*/

	$wp_customize->add_section( 'section_tables', array(
		'title'       => __( 'Pricing Tables', 'luminous' ),
		'panel'       => 'luminous_fp',
		'description' => sprintf( __( 'In order to use this section, you must install %sResponsive Pricing Table%s plugin.', 'luminous' ), '<a href="' . admin_url( 'plugin-install.php?tab=search&s=responsive+pricing+table' ) . '">', '</a>' )
	) );

	$wp_customize->add_setting( 'display_tables', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_tables', array(
		'label'    => __( 'Display pricing tables', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_tables',
		'settings' => 'display_tables',
	) );

	$wp_customize->add_setting( 'tables_title', array(
		'default'           => __( 'Pricing Tables', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'tables_title', array(
		'label'    => __( 'Title', 'luminous' ),
		'section'  => 'section_tables',
		'settings' => 'tables_title',
	) );

	$wp_customize->add_setting( 'tables_subtitle', array(
		'default'           => __( 'Our hosting plans & plans', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'tables_subtitle', array(
		'label'    => __( 'Subtitle', 'luminous' ),
		'section'  => 'section_tables',
		'settings' => 'tables_subtitle',
	) );

	$wp_customize->add_setting( 'tables_list', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'tables_list', array(
		'type'    => 'select',
		'label'   => __( 'Select pricing tables you want to show.', 'luminous' ),
		'section' => 'section_tables',
	    'choices' => luminous_get_pricing_tables()
	) );

	/*----------  Meet Our Team  ----------*/

	$wp_customize->add_section( 'section_team', array(
		'title'       => __( 'Team', 'luminous' ),
		'panel'       => 'luminous_fp',
		'description' => sprintf( __( 'In order to use this section, you must install %sOur Team Showcase%s plugin.', 'luminous' ), '<a href="' . admin_url( 'plugin-install.php?tab=search&s=our+team+enhanced' ) . '">', '</a>' )
	) );

	$wp_customize->add_setting( 'display_team', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_team', array(
		'label'    => __( 'Display team?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_team',
		'settings' => 'display_team',
	) );

	$wp_customize->add_setting( 'team_title', array(
		'default'           => __( 'MEET OUR TEAM', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'team_title', array(
		'label'    => __( 'Title', 'luminous' ),
		'section'  => 'section_team',
		'settings' => 'team_title',
	) );

	$wp_customize->add_setting( 'team_subtitle', array(
		'default'           => __( 'Some of the best experts in the field', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'team_subtitle', array(
		'label'    => __( 'Subtitle', 'luminous' ),
		'section'  => 'section_team',
		'settings' => 'team_subtitle',
	) );

	$wp_customize->add_setting( 'team_cat', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'team_cat', array(
		'type'    => 'select',
		'label'   => __( 'Team Category', 'luminous' ),
		'section' => 'section_team',
	    'choices' => luminous_get_team_cats()
	) );

	$wp_customize->add_setting( 'team_number', array(
		'default'           => 4,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'team_number', array(
		'label'    => __( 'Number of team members to show', 'luminous' ),
		'section'  => 'section_team',
		'settings' => 'team_number',
	) );

	/*----------  Call to action  ----------*/

	$wp_customize->add_section( 'section_cta', array(
		'title'	=> __( 'Call To Action', 'luminous' ),
		'panel' => 'luminous_fp',
	) );

	$wp_customize->add_setting( 'display_cta', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_cta', array(
		'label'    => __( 'Display call to action?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_cta',
		'settings' => 'display_cta',
	) );

	$wp_customize->add_setting( 'cta_title', array(
		'default'           => __( 'DISCOVER A BETTER WAY OF WORKING', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cta_title', array(
		'label'    => __( 'Call to action text', 'luminous' ),
		'section'  => 'section_cta',
		'settings' => 'cta_title',
	) );

	$wp_customize->add_setting( 'cta_button_text', array(
		'default'           => __( 'SIGN UP NOW', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cta_button_text', array(
		'label'    => __( 'Button Text', 'luminous' ),
		'section'  => 'section_cta',
		'settings' => 'cta_button_text',
	) );

	$wp_customize->add_setting( 'cta_button_url', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'cta_button_url', array(
		'label'    => __( 'Button URL', 'luminous' ),
		'section'  => 'section_cta',
		'settings' => 'cta_button_url',
	) );

	/*----------  Google Map  ----------*/

	$wp_customize->add_section( 'section_gmaps', array(
		'title'	=> __( 'Google Map', 'luminous' ),
		'panel' => 'luminous_fp',
	) );

	$wp_customize->add_setting( 'display_gmap', array(
		'default'           => 1,
		'sanitize_callback' => 'customizer_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display_gmap', array(
		'label'    => __( 'Display Google Map?', 'luminous' ),
		'type'     => 'checkbox',
		'section'  => 'section_gmaps',
		'settings' => 'display_gmap',
	) );

	$wp_customize->add_setting( 'gmap_latitude', array(
		'default'           => 40.707314,
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'gmap_latitude', array(
		'label'    => __( 'Latitude', 'luminous' ),
		'section'  => 'section_gmaps',
		'settings' => 'gmap_latitude',
	) );

	$wp_customize->add_setting( 'gmap_longitude', array(
		'default'           => -74.008201,
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'gmap_longitude', array(
		'label'    => __( 'Longitude', 'luminous' ),
		'section'  => 'section_gmaps',
		'settings' => 'gmap_longitude',
	) );

	$wp_customize->add_setting( 'gmap_zoom', array(
		'default'           => 16,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'gmap_zoom', array(
		'type'    => 'range',
		'label'   => __( 'Zoom Level', 'luminous' ),
		'section' => 'section_gmaps',
	    'input_attrs' => array(
			'min'  => 0,
			'max'  => 20,
			'step' => 1,
	    )
	) );

	$wp_customize->add_setting( 'gmap_title', array(
		'default'           => __( 'Our Company Headquarters', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'gmap_title', array(
		'label'    => __( 'Title', 'luminous' ),
		'section'  => 'section_gmaps',
		'settings' => 'gmap_title',
	) );

	$wp_customize->add_setting( 'gmap_icon', array(
		'default'           => 'luminous',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'gmap_icon', array(
		'type'    => 'radio',
		'label'   => __( 'Use default or Luminous marker?', 'luminous' ),
		'section' => 'section_gmaps',
	    'choices' => array(
			'luminous' => __( 'Luminous marker', 'luminous' ),
			'default'  => __( 'Default marker', 'luminous' ),
	    )
	) );

   	/*----------  Contact  ----------*/

   	$wp_customize->add_section( 'section_contact', array(
		'title'       => __( 'Contact', 'luminous' ),
		'description' => sprintf(
			__( 'In order to use this section fully you need to install %sContact Form 7%s plugin. If you want contact form to look the same as on Luminous demo, you need to copy the code from the textarea below, %screate new form%s, name it, paste the code to the editor and save it. Reload the customizer and select it under "Select contact form below".', 'luminous' ),
			'<a href="' . admin_url( 'plugin-install.php?tab=search&s=contact+form+7' ) . '">', '</a>',
			'<a href="' . admin_url( 'admin.php?page=wpcf7-new&locale' ) . '">', '</a>'),
		'panel'       => 'luminous_fp',
   	) );

   	$wp_customize->add_setting( 'display_contact_form', array(
   		'default'           => 1,
   		'sanitize_callback' => 'customizer_sanitize_checkbox'
   	) );

   	$wp_customize->add_control( 'display_contact_form', array(
   		'label'    => __( 'Display contact form?', 'luminous' ),
   		'type'     => 'checkbox',
   		'section'  => 'section_contact',
   		'settings' => 'display_contact_form',
   	) );

   	$wp_customize->add_setting( 'contact_form', array(
		'default'           => '',
		'description'       => __( 'Select the contact form you wish to use.', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
   	) );

   	$wp_customize->add_control( 'contact_form', array(
   		'type'    => 'select',
   		'label'   => __( 'Select contact form', 'luminous' ),
   		'section' => 'section_contact',
   	    'choices' => luminous_get_contact_forms()
   	) );

	$wp_customize->add_setting( 'contact_title', array(
		'default'           => __( 'GET IN TOUCH', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'contact_title', array(
		'label'    => __( 'Contact Title', 'luminous' ),
		'section'  => 'section_contact',
		'settings' => 'contact_title',
	) );

	$wp_customize->add_setting( 'contact_subtitle', array(
		'default'           => __( 'Have a question for us?', 'luminous' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'contact_subtitle', array(
		'label'    => __( 'Contact Subtitle', 'luminous' ),
		'section'  => 'section_contact',
		'settings' => 'contact_subtitle',
	) );

	$wp_customize->add_setting( 'contact_code', array() );

	$wp_customize->add_control( new TB_Code(
        $wp_customize,
        'contact_code',
        array(
			'label'    => __( 'Code', 'luminous' ),
			'settings' => 'contact_code',
			'section'  => 'section_contact',
		)
    ) );

	/*----------  Section Ordering  ----------*/

    $wp_customize->add_section( 'section_ordering', array(
    	'title'	=> __( 'Section Ordering', 'luminous' ),
    	'panel' => 'luminous_fp',
    ) );

    $sections = array(
		'slider'    => __( 'Slider', 'luminous' ),
		'services'  => __( 'Services', 'luminous' ),
		'portfolio' => __( 'Portfolio', 'luminous' ),
		'posts'     => __( 'Latest Posts', 'luminous' ),
		'countTo'   => __( 'Count To', 'luminous' ),
		'tables'    => __( 'Pricing Tables', 'luminous' ),
		'team'      => __( 'Team', 'luminous' ),
		'cta'       => __( 'Call To Action', 'luminous' ),
		'gmap'      => __( 'Google Map', 'luminous' ),
		'contact'   => __( 'Contact', 'luminous' )
	);

    $i = 0;

    foreach( $sections as $key => $value ) {

		$wp_customize->add_setting( "section_{$i}", array(
			'default'           => $key,
			'sanitize_callback' => 'sanitize_text_field',
	    ) );

		$wp_customize->add_control( "section_{$i}", array(
			'type'    => 'select',
			'label'   => __( 'Slot', 'luminous' ) . ' ' . ++$i . ':',
			'section' => 'section_ordering',
	        'choices' => $sections
	    ) );

    }


	/*=====  End of Front Page Options  ======*/


	/*----------  Live Preview  ----------*/

	/* Load JavaScript files. */
	add_action( 'customize_preview_init', 'luminous_enqueue_customizer_scripts' );

	/* Enable live preview for WordPress theme features. */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

}


/**
 * Loads theme customizer JavaScript.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function luminous_enqueue_customizer_scripts() {

	/* Use the .min script if SCRIPT_DEBUG is turned off. */
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'luminous-customize',
		trailingslashit( get_template_directory_uri() ) . "js/theme-customizer{$suffix}.js",
		array( 'jquery', 'customize-preview' ),
		null,
		true
	);
}

/* Register customize controls scripts/styles. */
add_action( 'customize_controls_enqueue_scripts', 'luminous_customizer_enqueue', 5 );

/**
 * Loads customizer styles and scripts for custom control font picker.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function luminous_customizer_enqueue() {

    $theme_dir = trailingslashit( get_template_directory_uri() );
    $suffix    = hybrid_get_min_suffix();

    /* Register Font Awesome. */
    wp_register_style( 'font-awesome', $theme_dir . "admin/css/font-awesome{$suffix}.css" );

    /* Register font icon picker base style. */
    wp_register_style( 'fip', $theme_dir . "admin/css/jquery.fonticonpicker{$suffix}.css" );

    /* Register font icon picker theme. */
    wp_register_style( 'fip-theme', $theme_dir . "admin/css/jquery.fonticonpicker.bootstrap{$suffix}.css" );

    /* Register font icon picker js. */
	wp_register_script(
		'fip-js',
		$theme_dir . "admin/js/jquery.fonticonpicker{$suffix}.js",
		array( 'customize-controls' ),
		null,
		true
	);

    /* Register font icon picker initialization file. */
	wp_register_script(
		'fip-init',
		$theme_dir . "admin/js/fip-init{$suffix}.js",
		array( 'customize-controls' ),
		null,
		true
	);

	?>
	<style>
		[id*='customize-control-slide_img_'],
		[id*='customize-control-service_icon_'] {
			border-top: 1px solid #DDDDDD;
			padding-top: 6px;
		}

		[id*='customize-control-sf_text_'],
		[id*='customize-control-countTo_text_'] {
			border-bottom: 1px solid #DDDDDD;
			padding-bottom: 18px;
		}

		#customize-control-slide_img_1 { border-top: 0; padding-top: 0; }
		#customize-control-sf_text_4,
		#customize-control-countTo_text_4 { border-bottom: 0; }

		.contact-textarea { min-height: 200px; }
	</style>
	<?php

}


/*==============================================
=            SANITIZATION CALLBACKS            =
==============================================*/

/**
 * Sanitizes checkbox fields in customizer.
 *
 * @since 1.0.0
 * @access public
 * @param  bool 	$input
 * @return int|bool
 */
function customizer_sanitize_checkbox( $input ) {
	return ( $input == 1 ) ? 1 : false;
}

/*=====  End of SANITIZATION CALLBACKS  ======*/

?>