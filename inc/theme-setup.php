<?php
/**
 * Sets up custom filters and actions for the theme.  This does things like sets up sidebars, menus, scripts,
 * and lots of other awesome stuff that WordPress themes do.
 */

/* Register custom image sizes. */
add_action( 'init', 'luminous_register_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'luminous_register_menus', 5 );

/* Register theme layouts. */
add_action( 'hybrid_register_layouts', 'luminous_register_layouts' );

/* Register sidebars. */
add_action( 'widgets_init', 'luminous_register_sidebars', 5 );

/* Register theme widgets. */
add_action( 'widgets_init', 'luminous_register_widgets' );

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'luminous_register_scripts' );

/* Register custom styles. */
add_action( 'wp_enqueue_scripts', 'luminous_register_styles' );

/* Filters the excerpt length. */
add_filter( 'excerpt_length', 'luminous_excerpt_length' );

/* Remove read more in excerpt */
add_filter( 'excerpt_more', 'luminous_read_more' );

/* Main theme layout */
add_filter( 'get_theme_layout', 'luminous_main_layout' );

/* Adds custom attributes to the subsidiary sidebar. */
add_filter( 'hybrid_attr_sidebar', 'luminous_sidebar_subsidiary_class', 10, 2 );

/* Modifies default comment form. */
add_filter( 'comment_form_defaults', 'luminous_comment_form' );

/* Remove gallery inline styles */
add_filter( 'use_default_gallery_style', '__return_false' );

/* Replace header class. */
add_filter( 'hybrid_attr_header', 'luminous_header_class' );

/* Add class to image link. */
add_filter( 'get_the_image', 'luminous_add_img_class' );

/* Adds class to post. */
add_filter( 'post_class', 'luminous_post_classes' );

/**
 * Registers custom image sizes for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function luminous_register_image_sizes() {

	/* Sets the 'post-thumbnail' size. */
	set_post_thumbnail_size( 150, 150, true );

	/* Widget image. */
	add_image_size( 'luminous-widget-image', 85, 85, true );

	/* Front page image size. */
	add_image_size( 'luminous-fp', 750, 335, true );

	/* Front page image size for smaller posts (2 columns). */
	add_image_size( 'luminous-fp-image-2', 555, 320 );

	/* Front page image size for smaller posts (3 columns). */
	add_image_size( 'luminous-fp-image-3', 262, 190 );

	/* Front page image size for smaller posts (4 columns). */
	add_image_size( 'luminous-fp-image-4', 255, 145 );

	/* Image size for full width pages. */
	add_image_size( 'luminous-full', 1140, 550, true );

}

/**
 * Adds support for multiple theme layouts.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function luminous_register_layouts() {

	$theme_dir = trailingslashit( get_template_directory_uri() );

    hybrid_register_layout(
        '2c-l',
        array(
            'label'              => __( '2 Columns: Content / Sidebar', 'luminous' ),
            'show_in_customizer' => true,
            'show_in_meta_box'   => true,
            'image'              => $theme_dir . 'admin/images/2c-l.png'
        )
    );

    hybrid_register_layout(
        '2c-r',
        array(
            'label'              => __( '2 Columns: Sidebar / Content', 'luminous' ),
            'show_in_customizer' => true,
            'show_in_meta_box'   => true,
         	'image'              => $theme_dir . 'admin/images/2c-r.png'
        )
    );

    hybrid_register_layout(
        '1c',
        array(
            'label'              => __( '1 Column', 'luminous' ),
            'show_in_customizer' => true,
            'show_in_meta_box'   => true,
            'image'              => $theme_dir . 'admin/images/1c.png'
        )
    );

}

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function luminous_register_menus() {
	register_nav_menu( 'primary',    _x( 'Primary',    'nav menu location', 'luminous' ) );
}

/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function luminous_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary', 'sidebar', 'luminous' ),
			'description' => __( 'The main sidebar. It is displayed on either the left or right side of the page based on the chosen layout.', 'luminous' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'subsidiary',
			'name'        => _x( 'Footer', 'sidebar', 'luminous' ),
			'description' => __( 'A sidebar located in the footer of the site. Optimized for one, two, three or four widgets (and multiples thereof).', 'luminous' )
		)
	);

}

/**
 * Registers custom widgets.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function luminous_register_widgets() {

	$theme_dir = trailingslashit( get_template_directory() );

	require_once( $theme_dir . 'inc/widget-popular-posts.php' );
	require_once( $theme_dir . 'inc/widget-work-hours.php' );
	require_once( $theme_dir . 'inc/widget-newsletter.php' );

	register_widget( 'Luminous_Widget_Popular' );
	register_widget( 'Luminous_Work_Hours' );
	register_widget( 'Luminous_Widget_Newsletter' );
}

/**
 * Enqueues scripts.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function luminous_register_scripts() {

	$theme_dir = trailingslashit( get_template_directory_uri() );
	$suffix    = hybrid_get_min_suffix();

	wp_register_script(
		'luminous-menu',
		$theme_dir . "js/responsive-nav{$suffix}.js",
		array( 'jquery' ),
		null,
		true
	);

	wp_register_script(
		'luminous-fitvids',
		$theme_dir . "js/fitvids{$suffix}.js",
		array( 'jquery' ),
		null,
		true
	);

	wp_register_script(
		'luminous-custom-js',
		$theme_dir . "js/custom{$suffix}.js",
		array( 'jquery' ),
		null,
		true
	);

	wp_register_script(
		'luminous-slider',
		$theme_dir . "js/jquery.bxslider{$suffix}.js",
		array( 'jquery' ),
		null,
		true
	);

	wp_register_script(
		'luminous-countTo',
		$theme_dir . "js/jquery.countTo{$suffix}.js",
		array( 'jquery' ),
		null,
		true
	);

	wp_register_script(
		'luminous-inview',
		$theme_dir . "js/jquery.inview{$suffix}.js",
		array( 'jquery' ),
		null,
		true
	);

	wp_register_script(
		'luminous-gmaps',
		'https://maps.googleapis.com/maps/api/js?sensor=false',
		array(),
		null,
		true
	);

	if ( is_luminous_front_page() ) {

		$display_slider = (bool) get_theme_mod( 'slider_display', 1 );

		if ( $display_slider ) {

			wp_enqueue_script( 'luminous-slider' );

			$mode  = esc_html( get_theme_mod( 'slider_mode', 'fade' ) );

			$auto  = (bool) get_theme_mod( 'slider_auto', 1 );
			$auto  = $auto == 1 ? 1 : '';

			$pause = absint( get_theme_mod( 'slider_pause', 4000 ) );

			wp_localize_script( 'luminous-custom-js', 'slider', array(
				'mode'  => $mode,
				'auto'  => $auto,
				'pause' => $pause,
			) );

		}

		$display_portfolio = (bool) get_theme_mod( 'display_portfolio', 1 );

		if ( $display_portfolio ) {

			wp_enqueue_script( 'luminous-slider' );

			$auto  = (bool) get_theme_mod( 'portfolio_auto', 1 );
			$auto  = $auto == 1 ? 1 : '';

			$pause = absint( get_theme_mod( 'portfolio_pause', 4000 ) );

			wp_localize_script( 'luminous-custom-js', 'portfolio', array(
				'auto'  => $auto,
				'pause' => $pause,
			) );

		}

		$display_countTo = (bool) get_theme_mod( 'display_countTo', 1 );

		if ( $display_countTo ) {
			wp_enqueue_script( 'luminous-countTo' );
			wp_enqueue_script( 'luminous-inview' );
		}

		$display_gmap = (bool) get_theme_mod( 'display_gmap', 1 );

		if ( $display_gmap ) {

			wp_enqueue_script( 'luminous-gmaps' );

			$latitude  = get_theme_mod( 'gmap_latitude', 40.707314 );
			$longitude = get_theme_mod( 'gmap_longitude', -74.008201 );
			$title     = get_theme_mod( 'gmap_title', __( 'Our Company Headquarters', 'luminous' ) );
			$zoom      = get_theme_mod( 'gmap_zoom', 16 );
			$gmap_icon = get_theme_mod( 'gmap_icon', 'luminous' );
			$icon      = '';

			if ( $gmap_icon == 'luminous' )
				$icon = trailingslashit( get_template_directory_uri() ) . 'images/gmap-marker.png';

			wp_localize_script( 'luminous-custom-js', 'gmap', array(
				'longitude' => esc_html( $longitude ),
				'latitude'  => esc_html( $latitude ),
				'title'     => esc_html( $title ),
				'zoom'		=> absint( $zoom ),
				'icon'      => $icon
			) );
		}

		$display_tables = get_theme_mod( 'display_tables', 1 );

		if ( $display_tables ) {

			if ( class_exists( 'Responsive_Pricing_Table' ) )
				wp_dequeue_style( 'pricing-table-style' );
		}

	} // End check if is_luminous_front_page().

	wp_enqueue_script( 'luminous-fitvids' );
	wp_enqueue_script( 'luminous-menu' );
	wp_enqueue_script( 'luminous-custom-js' );
}

/**
 * Registers custom stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function luminous_register_styles() {

	$suffix = hybrid_get_min_suffix();

	/* Load Open Sans fonts. */
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,800&subset=latin,latin-ext' );
	wp_enqueue_style( 'open-sans' );

	/* Load Font Awesome. */
	wp_register_style( 'font-awesome', trailingslashit( get_template_directory_uri() ) . "admin/css/font-awesome{$suffix}.css" );
	wp_enqueue_style( 'font-awesome' );

	/* Autoload parent theme stylesheet. */
	// if ( is_child_theme() )
	// 	wp_enqueue_style( 'parent', trailingslashit( get_template_directory_uri() ) . "style{$suffix}.css" );

	/* Load main theme style. */
	// wp_enqueue_style( 'style', get_stylesheet_uri() );

	$rtl = is_rtl() ? '-rtl' : '';
	wp_register_style(
		'style',
		trailingslashit( get_template_directory_uri() ) . "style{$rtl}{$suffix}.css"

	 );
	wp_enqueue_style ( 'style' );

}
/**
 * Adds a custom excerpt length.
 *
 * @since  1.0.0
 * @access public
 * @param  int     $length
 * @return int
 */
function luminous_excerpt_length( $length ) {
	return 60;
}

/**
 * Disables read more link ([...]) in excerpt.
 * @since 1.0.0
 * @access public
 * @param  string 	$more
 * @return string
 */
function luminous_read_more( $more ) {
	return '...';
}

/**
 * Sets default layout for theme and for individual post / page.
 *
 * @since  1.0.0
 * @access public
 * @param  string 	$layout
 * @return string
 */
function luminous_main_layout( $layout ) {

	$layout          = get_theme_mod( 'theme_layout', '2c-l' );
	$singular_layout = get_post_layout( get_the_ID() );

	if ( is_singular() && $singular_layout != 'default' )
		$layout = $singular_layout;

	$front = get_option( 'show_on_front' );

	if ( is_attachment() && wp_attachment_is_image() || is_front_page() && ( $front === 'posts' ) ) {

		if ( 'default' === $singular_layout )
			$layout = '1c';
	}

	return 'layout-' . $layout;
}

/**
 * Adds a custom class to the subsidiary and footer sidebar. This is used to determine the number of columns used to
 * display the sidebar's widgets.  This optimizes for 1, 2, and 3 columns or multiples of those values.
 *
 * Note that we're using the global $sidebars_widgets variable here. This is because core has marked
 * wp_get_sidebars_widgets() as a private function. Therefore, this leaves us with $sidebars_widgets for
 * figuring out the widget count.
 * @link http://codex.wordpress.org/Function_Reference/wp_get_sidebars_widgets
 *
 * @since  1.0.0
 * @access public
 * @param  array  $attr
 * @param  string $context
 * @return array
 */
function luminous_sidebar_subsidiary_class( $attr, $context ) {

	if ( 'subsidiary' === $context ) {

		global $sidebars_widgets;

		if ( is_array( $sidebars_widgets ) && ! empty( $sidebars_widgets[ $context ] ) ) {

			$count = count( $sidebars_widgets[ $context ] );
			$attr['class'] .= ' bottom-sidebar';

			if ( ( $count == 3 ) || $count > 3 )
				$attr['class'] .= ' sidebar-cols-3';

			elseif ( !( $count % 2 ) )
				$attr['class'] .= ' sidebar-cols-2';

			else
				$attr['class'] .= ' sidebar-cols-1';

		}
	}

	return $attr;
}


/**
 * Function adds placeholders to inputs.
 *
 * @since 1.0.0
 * @access public
 * @param  array $defaults
 * @return array
 */
function luminous_comment_form( $defaults ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$defaults['fields'] = array(

		'author' =>
			'<p class="comment-form-author">' .
			'<input id="author" placeholder="'. __( 'Name', 'luminous' ) . ( $req == 1 ? '*' : '' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30"' . $aria_req . ' /></p>',

		'email' =>
			'<p class="comment-form-email">' .
			'<input id="email" placeholder="'. __( 'Email', 'luminous' ) . ( $req == 1 ? '*' : '' ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" size="10"' . $aria_req . ' /></p>',

		'url' =>
			'<p class="comment-form-url">' .
			'<input id="url" name="url" placeholder="'. __( 'Website', 'luminous' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" /></p>'

	);

	$defaults['comment_field'] = '<p class="comment-form-comment">'.
								 '<textarea placeholder="'. __( 'Your message', 'luminous' ) .'*" id="comment" name="comment" rows="8" cols="45"'.
								 'aria-required="true"></textarea></p>';

	$defaults['comment_notes_after'] = '';

	return $defaults;
}

/**
 * Modifies hybrid_attr_header, adds class .wrap to header tag.
 *
 * @since  1.0.0
 * @access public
 * @param array $attr
 * @return array
 */
function luminous_header_class( $attr ) {
	$attr['class'] = 'wrap';
	return $attr;
}

/**
 * Adds .luminous-thumbnail class to image link.
 *
 * @since 1.0.0
 * @access public
 * @param  string 	$image
 * @return string
 */
function luminous_add_img_class( $image ) {
	$image = str_replace( '<a', '<a class="luminous-thumbnail" ', $image );
	return $image;
}

/**
 * Scans post for post thumbnail and adds class "no-post-thumbnail" if it doesn't exist to fix margins between posts.
 *
 * @since  1.0.0
 * @access public
 * @param  array $classes
 * @return array
 */
function luminous_post_classes( $classes ) {

	if ( ! has_post_thumbnail() )
		$classes[] = 'no-post-thumbnail';

	return $classes;
}

/**
 * Checks whether Luminous front page template is used.
 *
 * @since 1.0.0
 * @access public
 * @return boolean
 */
function is_luminous_front_page() {
	return is_page_template( 'template-front-page.php' );
}

/**
 * Checks whether theme should display preloader on front page.
 *
 * @since 1.0.0
 * @access public
 * @return bool
 */
function luminous_show_preloader() {
	return is_luminous_front_page() && get_theme_mod( 'show_preloader', 1 );
}

/**
 * Backward compatibility for title tag.
 *
 * @since 	1.0.0
 * @access 	public
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function luminous_render_title_tag() {
?>
<title><?php wp_title( ':', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'luminous_render_title_tag' );
}

/**
 * Count how many columns should be in #header-right, in order to display such class.
 * For example, .col-1-<?php echo $columns; ?>.
 *
 * @since  1.0.0
 * @access public
 * @param  bool $display_address
 * @param  bool $display_contact
 * @param  bool $display_social
 * @return int
 */
function luminous_header_columns_number( $display_address, $display_contact, $display_social ) {

	$columns = 0;

	if ( $display_address ) $columns++;
	if ( $display_contact ) $columns++;
	if ( $display_social ) $columns++;

	return $columns;
}

/**
 * Determines classes (widths) for #branding and #header-right number of columns.
 *
 * @since  1.0.0
 * @access public
 * @param  	int	$columns
 * @return 	array
 */
function luminous_header_classes( $columns ) {

	switch( $columns ) {
		case 1:
			$left_column  = 'col-2-3';
			$right_column = 'col-1-3';
			break;
		case 2:
			$left_column = 'col-1-2';
			$right_column = 'col-1-2';
			break;
		case 3:
			$left_column  = 'col-5-12';
			$right_column = 'col-7-12';
			break;
		default:
			$left_column  = 'col-1-1';
			$right_column = '';
	}

	return array( $left_column, $right_column );
}


/**
 * Checks whether to show primary sidebar. Sidebar will be shown unless it's 1 column layout.
 *
 * @since  1.0.0
 * @access public
 * @return boolean
 */

function luminous_show_sidebar() {

	$global_layout = esc_html( get_theme_mod( 'theme_layout', '2c-l' ) );

	if ( is_singular() ) {

		$singular_layout = hybrid_get_post_layout( get_the_ID() );

		if ( '1c' === $singular_layout || is_luminous_front_page() )
			return false;
		elseif ( '' === $singular_layout && $global_layout == '1c' )
			return false;
		else
			return true;
	}
	else return '1c' === $global_layout ? false : true;
}

/**
 * Gets all slider data from customizer (image, title, link...).
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function luminous_get_slides() {

	$slides = array();

	for ( $i = 1; $i < 11; $i++ ) :

		if ( $i < 4 )
			$def_img = trailingslashit( get_template_directory_uri() ) . "images/slide-{$i}.jpg";
		else
			$def_img = '';

		$img = get_theme_mod( "slide_img_{$i}", $def_img );

		if ( ! empty( $img ) ) {

			$slides[$i]['img'] = $img;

			/* Add title and text to array only if image of this slide is set. */
			$title = get_theme_mod( "slide_title_{$i}" );
			$text  = get_theme_mod( "slide_text_{$i}" );

			if ( ! empty( $title ) )
				$slides[$i]['title'] = $title;

			if ( ! empty( $text ) )
				$slides[$i]['text'] = $text;

			$button1 = get_theme_mod( "slide_button_1_{$i}" );

			/* Check for button URL only if button text is set. */
			if ( ! empty( $button1 ) ) {
				$button1_url = get_theme_mod( "slide_button_url_1_{$i}" );
				$button1_url = ! empty( $button1_url ) ? $button1_url : '#';

				$link_1  = '<a class="slide-link" href="'. esc_url( $button1_url ) .'">';
					$link_1 .= '<span>'. esc_html( $button1 ) .'</span>';
				$link_1 .= '</a>';

				$slides[$i]['link_1'] = $link_1;
			}

			$button2 = get_theme_mod( "slide_button_2_{$i}" );

 			if ( ! empty( $button2 ) ) {
				$button2_url = get_theme_mod( "slide_button_url_2_{$i}" );
				$button2_url = ! empty( $button2_url ) ? $button2_url : '#';

				$link_2  = '<a class="slide-link" href="'. esc_url( $button2_url ) .'">';
					$link_2 .= '<span>'. esc_html( $button2 ) .'</span>';
				$link_2 .= '</a>';

				$slides[$i]['link_2'] = $link_2;
			}

		}

	endfor;

	return $slides;
}

/**
 * Gets all data for slider footer (title, text).
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function luminous_get_slider_footer_items() {

	$all_items = array();

	$defaults = array(
		'sf_title_1' => __( 'We are trendy', 'luminous' ),
		'sf_title_2' => __( 'Consultation', 'luminous' ),
		'sf_title_3' => __( 'Free Helpline', 'luminous' ),
		'sf_title_4' => __( '24/7 Working', 'luminous' ),
		'sf_text'    => __( 'There are many variations', 'luminous' )
	);

	for ( $i = 1; $i < 5; $i++ ) :

		$sf_title = get_theme_mod( "sf_title_{$i}", $defaults["sf_title_{$i}"] );
		$sf_text  = get_theme_mod( "sf_text_{$i}", $defaults['sf_text'] );

		if ( ! empty( $sf_title ) )
			$all_items[$i]['title'] = $sf_title;

		if ( ! empty( $sf_text ) )
			$all_items[$i]['text'] = $sf_text;

	endfor;

	return $all_items;
}

/**
 * Gets all data for services (icon, title, text).
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function luminous_get_service_items() {

	$services = array();

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

	for ( $i = 1; $i < 10; $i++ ) :

		$default_icon  = isset( $defaults["icon_{$i}"] ) ? $defaults["icon_{$i}"] : '';
		$default_title = isset( $defaults["title_{$i}"] ) ? $defaults["title_{$i}"] : '';
    	$default_text  = 'In hac habitasse platea dictumst. Aliquam erat volutpat. Donec ut lorem maximus, auctor turpis eu, fringilla';

    	/* If default title is not set (works only for first 4 services), don't use default description. */
    	$default_text  = $default_title != '' ? $default_text  : '';

		$icon  = get_theme_mod( "services_icon_{$i}", $default_icon );
		$title = get_theme_mod( "services_title_{$i}", $default_title );
		$text  = get_theme_mod( "services_text_{$i}", $default_text );

		if ( $icon !== 'no-icon' )
			$services[$i]['icon'] = $icon;

		if ( ! empty( $title )  )
			$services[$i]['title'] = $title;

		if ( ! empty( $text )  )
			$services[$i]['text'] = $text;

	endfor;

	return $services;
}

/**
 * Get list of all contact forms for Contact form 7 plugin.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function luminous_get_contact_forms() {

	$forms = get_posts( array(
		'posts_per_page' => -1,
		'post_type'      => 'wpcf7_contact_form'
	) );

	$result = array();

	foreach ( $forms as $form )
		$result[$form->ID] = $form->post_title;

	return $result;
}

/**
 * Excerpt for posts in template-front-page.php
 *
 * @since  1.0.0
 * @access public
 * @return string | boolean
 */
function luminous_fp_excerpt() {

	$excerpt = get_the_excerpt();

	if ( ! empty( $excerpt ) ) {
		$words   = explode( " ", $excerpt );
		$lp_length = absint( get_theme_mod( 'posts_length', 33 ) );
		return implode( " ", array_splice( $words, 0, $lp_length ) ) . '...';
	}

	return false;
}

/**
 * Puts all categories into array.
 *
 * @since 1.0.0
 * @access public
 * @return array
 */
function luminous_categories_array() {

	$cats       = array();
	$categories = get_categories();

	$cats[0] = __( 'All Categories', 'luminous' );

	foreach( $categories as $cat ) {
		$cats[$cat->cat_ID] = $cat->cat_name;
	}

	return $cats;
}


function luminous_get_countTo_data() {

	$countTo = array();

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

		$text = get_theme_mod( "countTo_text_{$i}", $defaults["text_{$i}"] );

		/* Place from and to to array only if text is set. */
		if ( ! empty( $text ) ) {

			$countTo[$i]['text'] = $text;

			$to   = get_theme_mod( "countTo_to_{$i}", $defaults["to_{$i}"] );
			$from = get_theme_mod( "countTo_from_{$i}", 1 );

			$countTo[$i]['to']   = $to;
			$countTo[$i]['from'] = $from;
		}

	}

	return $countTo;
}

/**
 * Gets list of all pricing tables from plugin "Responsive Pricing Tables".
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function luminous_get_pricing_tables() {

	$table_array = array( __( 'You need to create tables first in plugin.', 'luminous' ) );

	if ( class_exists( 'Responsive_Pricing_Table' ) ) {

		$table_array = array(); // Delete message above.

		$tables = get_posts( array( 'post_type' => 'pricing_tables' ) );

		if ( ! empty( $tables ) ) {
			foreach( $tables as $table )
				$table_array[$table->ID] = $table->post_name;
		}
	}

	return $table_array;
}

/**
 * Gets number of packages in "Pricing Tables" of Responsive Pricing Table plugin.
 *
 * @since 	1.0.0
 * @access  public
 * @return 	int
 */
function luminous_get_package_number( $id ) {
	$number = get_post_meta( $id, '_table_packages', true );
	return ( $number == '' ) ? 0 : count( json_decode( $number ) );
}

/**
 * Get team members categories.
 *
 * @since  	1.0.0
 * @access 	public
 * @return 	array
 */
function luminous_get_team_cats() {

	$all_cats = array( 'default' => __( 'All Categories', 'luminous' ) );

	if ( class_exists( 'SmartcatTeamPlugin' ) ) {

		$cats = get_terms( 'team_member_position');

		if ( ! empty( $cats ) ) {
			foreach( $cats as $cat )
				$all_cats[$cat->term_id] = $cat->name;
		}
	}

	return $all_cats;
}
