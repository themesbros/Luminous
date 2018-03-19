<?php
/**
 * Portfolio template part for template-front-page.php.
 *
 * @package 	Luminous
 * @subpackage  Front Page
 * @since 		1.0.0
 */
if ( false == (bool) get_theme_mod( 'display_portfolio', 1 ) )
	return;

$title    = get_theme_mod( 'portfolio_title', __( 'FEATURED WORKS', 'luminous' ) );
$subtitle = get_theme_mod( 'portfolio_subtitle', __( 'Some of our recent projects', 'luminous' ) );
$number   = get_theme_mod( 'portfolio_number', 6 );
?>


<div id="luminous-portfolio">

	<div class="wrap section">

	<?php if ( ! empty( $title ) || ! empty( $subtitle ) ) : ?>

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

	<?php endif; ?>

	<?php
	if ( ! class_exists( 'CCP_Plugin' ) ) {
		echo '<p class="text-center">';
		printf( __( 'In order to use this section fully you need to install %sCustom Content Portfolio%s plugin.', 'luminous' ), '<a href="' . admin_url( 'plugin-install.php?tab=search&s=custom+content+portfolio' ) . '">', '</a>' );
		echo '</p>';
	}

	$args = array(
		'post_type'      => 'portfolio_project',
		'posts_per_page' => absint( $number ),
	);
	$portfolio = new WP_Query( $args );
	?>

	<?php if ( $portfolio->have_posts() ) : ?>

		<ul class="portfolio-slider no-margin">

		<?php while( $portfolio->have_posts() ) : $portfolio->the_post(); ?>

			<li>
				<?php get_the_image( array( 'size' => 'luminous-fp-image-3', 'order' => array( 'featured', 'attachment' ) ) ); ?>
			</li>

		<?php endwhile; ?>

		</ul>

	<?php endif; ?>

	</div><!-- .wrap -->

</div><!-- #luminous-portfolio -->