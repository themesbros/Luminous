<?php
/**
 * Call to action template part for template-front-page.php.
 *
 * @package 	Luminous
 * @subpackage  Front Page
 * @since 		1.0.0
 */
if ( false == (bool) get_theme_mod( 'display_cta', 1 ) )
	return;
?>

<div id="cta">

	<div class="wrap">

		<?php $title  = get_theme_mod( 'cta_title', __( 'DISCOVER A BETTER WAY OF WORKING', 'luminous' ) ); ?>
		<?php $button = get_theme_mod( 'cta_button_text', __( 'SIGN UP NOW', 'luminous' ) ) ?>
		<?php $link   = get_theme_mod( 'cta_button_url', '#' ); ?>

		<?php if ( ! empty( $title ) ) : ?>
			<h3><?php echo esc_html( $title ); ?></h3>
		<?php endif; ?>

		<?php if ( ! empty( $button ) ) : ?>
			<a href="<?php echo ! empty( $link ) ? esc_url( $link ) : '#'; ?>"><?php echo esc_html( $button ); ?></a>
		<?php endif; ?>

	</div><!-- .wrap -->

</div><!-- #cta -->