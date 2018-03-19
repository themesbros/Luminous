<?php
/**
 * Contact template part for template-front-page.php.
 *
 * @package 	Luminous
 * @subpackage  Front Page
 * @since 		1.0.0
 */
if ( false == (bool) get_theme_mod( 'display_contact_form', 1 ) )
	return;

$title    = get_theme_mod( 'contact_title', __( 'GET IN TOUCH', 'luminous' ) );
$subtitle = get_theme_mod( 'contact_subtitle', __( 'Have a question for us?', 'luminous' ) );
$form     = get_theme_mod( 'contact_form' );
?>

<div id="contact-form" class="wrap section">

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
	if ( ! class_exists( 'WPCF7' ) ) {
		echo '<p class="text-center">';
		printf( __( 'In order to use this section fully you need to install %sContact Form 7%s plugin.', 'luminous' ), '<a href="' . admin_url( 'plugin-install.php?tab=search&s=contact+form+7' ) . '">', '</a>' );
		echo '</p>';
	}
	 ?>

	<?php echo ! empty( $form ) ? do_shortcode( '[contact-form-7 id="' . esc_html( $form ) .'"]' ) : ''; ?>

</div><!-- #contact-form -->