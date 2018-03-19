<?php
/**
 * Services template part for template-front-page.php.
 *
 * @package 	Luminous
 * @subpackage 	Front Page
 * @since 		1.0.0
 */
if ( false == (bool) get_theme_mod( 'display_services', 1 ) )
	return;

$title    = get_theme_mod( 'services_title', __( 'WHY CHOOSE US', 'luminous' ) );
$subtitle = get_theme_mod( 'services_subtitle', __( 'Sed ut perspiciatis unde omnis iste natus bulka', 'luminous' ) );
$columns  = absint( get_theme_mod( 'services_columns', 4 ) );
?>

<div id="services" class="wrap section">

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

	<?php $services = luminous_get_service_items(); ?>

	<?php $count = count( $services ); $i = 1; ?>

	<div class="row">

	<?php foreach( $services as $service ) : ?>

		<div class="service text-center col-1-<?php echo $columns; ?>">

		<?php if ( ! empty( $service['icon'] ) ) : ?>
			<i class="fa <?php echo esc_html( $service['icon'] ); ?>"></i>
		<?php endif; ?>

		<?php if ( ! empty( $service['title'] ) ) : ?>
			<h4 class="service-title">
				<?php echo esc_html( $service['title'] ); ?>
			</h4>
		<?php endif; ?>

		<?php if ( ! empty( $service['text'] ) ) : ?>
			<p><?php echo esc_html( $service['text'] ); ?></p>
		<?php endif; ?>

		</div><!-- .service-item -->

		<?php if ( $i % $columns == 0 && $i !== $count ) : ?>
			</div><div class="row">
		<?php endif; ?>

	<?php $i++; endforeach; ?>

	</div><!-- .row -->

</div><!-- #services -->

