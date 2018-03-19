<?php
/**
 * Slider template part for template-front-page.php.
 *
 * @package 	Luminous
 * @subpackage  Front Page
 * @since 		1.0.0
 */
if ( false == (bool) get_theme_mod( 'slider_display', 1 ) )
	return;
?>

<div id="slider">

	<?php $slides = luminous_get_slides(); ?>

	<?php if ( ! empty( $slides ) ) : ?>

	<ul class="slider no-margin">

	<?php foreach( $slides as $slide ) : ?>

		<?php $img    = $slide['img']; // No need for isset(), cause image must be set. ?>
		<?php $title  = isset( $slide['title'] ) ? $slide['title'] : ''; ?>
		<?php $text   = isset( $slide['text'] ) ? $slide['text'] : ''; ?>
		<?php $text   = isset( $slide['text'] ) ? $slide['text'] : ''; ?>
		<?php $link_1 = isset( $slide['link_1'] ) ? $slide['link_1'] : ''; ?>
		<?php $link_2 = isset( $slide['link_2'] ) ? $slide['link_2'] : ''; ?>

		<li style="background-image: url('<?php echo esc_url( $img ); ?>');">

			<div class="slide-content">

				<div class="wrap">

				<?php if ( ! empty( $title ) ) : ?>
					<h2 class="slide-title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $text ) ) : ?>
					<p><?php echo esc_html( $text ); ?></p>
				<?php endif; ?>

				<?php echo $link_1 . $link_2; // Escaped in luminous_get_slides(). ?>

				</div><!-- .wrap -->

			</div><!-- .slide-content -->

		</li>

	<?php endforeach; ?>

	</ul><!-- .slider -->

	<?php endif; // End check if there are slides. ?>

	<?php $footer = luminous_get_slider_footer_items(); ?>

	<?php if ( ! empty( $footer ) ) : ?>

		<div id="slider-footer" class="hide-on-mobile">

			<div class="wrap">

				<div class="row">

				<?php $col_class = count( $footer ); ?>

				<?php $i = 1; ?>

				<?php foreach( $footer as $item ) : ?>

					<div class="col-1-<?php echo $col_class; ?>">

						<span class="circle"><?php echo $i++; ?></span>

						<div class="slider-footer-content">

						<?php if ( isset( $item['title'] ) ) : ?>

							<h4 class="slider-footer-title">
								<?php echo esc_html( $item['title']); ?>
							</h4>

						<?php endif;  ?>

						<?php if ( isset( $item['text'] ) ) : ?>

							<span>
								<?php echo esc_html( $item['text'] ); ?>
							</span>

						<?php endif;  ?>

						</div><!-- .slider-footer-content -->

					</div><!-- .col-1-<?php echo $col_class; ?> -->

				<?php endforeach; ?>

				</div><!-- .row -->

			</div><!-- .wrap -->

		</div><!-- #slider-footer -->

	<?php endif; // End check if slider footer is empty. ?>

</div><!-- #slider -->