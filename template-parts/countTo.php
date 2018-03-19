<?php
/**
 * Count-to template part for template-front-page.php.
 *
 * @package 	Luminous
 * @subpackage  Front Page
 * @since 		1.0.0
 */
if ( false == (bool) get_theme_mod( 'display_countTo', 1 ) )
	return;
?>

<div id="countTo" class="section">

	<div class="wrap text-center">

		<div class="row">

		<?php $counters = luminous_get_countTo_data(); ?>

		<?php $class = count( $counters ); ?>

		<?php foreach( $counters as $counter ) : ?>

			<div class="col-1-<?php echo $class; ?>">
				<p><span data-from="<?php echo absint( $counter['from'] ); ?>" data-to="<?php echo absint( $counter['to'] ); ?>"><?php echo absint( $counter['from'] ); ?></span><?php echo esc_html( $counter['text'] ); ?></p>
			</div>

		<?php endforeach; ?>

		</div>


	</div><!-- .wrap -->

</div><!-- #countTo -->