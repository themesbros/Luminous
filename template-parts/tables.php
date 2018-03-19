<?php
/**
 * Pricing tables template part for template-front-page.php.
 *
 * @package 	Luminous
 * @subpackage  Front Page
 * @since 		1.0.0
 */

if ( false == (bool) get_theme_mod( 'display_tables', 1 ) )
	return;

$title     = get_theme_mod( 'tables_title', __( 'Pricing Tables', 'luminous' ) );
$subtitle  = get_theme_mod( 'tables_subtitle', __( 'Our hosting plans & plans', 'luminous' ) );
$tables_id = (int) get_theme_mod( 'tables_list' );
$class     = luminous_get_package_number( $tables_id );
?>

<div id="luminous-pricing-tables" class="wrap section table-count-<?php echo $class; ?>">

	<div class="row">

		<div class="section-info text-center">

		<?php if ( ! empty( $title ) ) : ?>
			<h2 class="section-title text-center"><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>

		<?php if ( ! empty( $subtitle ) ) : ?>
			<p class="section-description text-center"><?php echo esc_html( $subtitle ); ?></p>
	 	<?php endif; ?>

			<div class="hr">
	 			<i class="fa fa-skyatlas"></i>
			</div>

		</div><!-- .section-info -->

	</div><!-- .row -->

	<?php

	if ( ! class_exists( 'Responsive_Pricing_Table' ) ) {
		echo '<p class="text-center">';
		printf( __( 'In order to use this section, you must install %sResponsive Pricing Table%s plugin.', 'luminous' ), '<a href="' . admin_url( 'plugin-install.php?tab=search&s=responsive+pricing+table' ) . '">', '</a>' );
		echo '</p>';

	}

	if ( $tables_id > 0 )
		echo do_shortcode( '[show_pricing_table table_id="'. $tables_id .'"]' );
	?>

</div><!-- #luminous-pricing-tables -->
