<?php
/**
 * Posts template part for template-front-page.php.
 *
 * @package 	Luminous
 * @subpackage 	Front Page
 * @since 		1.0.0
 */
if ( false == (bool) get_theme_mod( 'display_posts', 1 ) )
	return;
?>

<div id="luminous-posts" class="section wrap">

	<?php
	$title     = esc_html( get_theme_mod( 'posts_title', __( 'LATEST FROM BLOG', 'luminous' ) ) );
	$subtitle  = esc_html( get_theme_mod( 'posts_subtitle', __( 'Freshest news from our blog', 'luminous' ) ) );

	$lp_number = absint( get_theme_mod( 'posts_number', 2 ) );
	$lp_cat    = absint( get_theme_mod( 'posts_cats', 1 ) );
	$lp_img    = absint( get_theme_mod( 'post_image', 1 ) );
	$lp_cols   = absint( get_theme_mod( 'post_columns', 2 ) );

	?>

	<?php if ( ! empty( $title ) && ! empty( $subtitle ) ) : ?>

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

	<?php endif; ?>

	<?php

	$query_args = array(
		'post_type'           => 'post',
		'posts_per_page'      => $lp_number,
		'category__in'        => $lp_cat,
		'ignore_sticky_posts' => true
	);

	$query = new WP_Query( $query_args );

	$img_url = ( true == $lp_img ) ? trailingslashit( get_template_directory_uri() ) . 'images/default-image.jpg' : false;

	$i = 0;	?>

	<div class="row">

	<?php if ( $query->have_posts() ) : ?>

		<?php while ( $query->have_posts() ) : $query->the_post(); $i++; ?>

			<div class="col-1-<?php echo $lp_cols; ?>">

				<?php get_the_image(
					array(
						'size'    => "luminous-fp-image-{$lp_cols}",
						'caption' => true,
						'default' => $img_url,
						'order'   => array( 'featured', 'attachment', 'default' ),
					) );
				?>

				<?php if ( has_post_thumbnail() || $lp_img ) : ?>
					<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php endif; ?>

				<h4 class="lp-title">
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
				</h4>

				<p><?php echo luminous_fp_excerpt(); ?></p>

				<a class="read-more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read Article', 'luminous' ); ?></a>

			</div>

			<?php if ( $i % $lp_cols == 0 && $i !== $lp_number ) : ?>

				</div><div class="row">

			<?php endif; ?>

		<?php endwhile; ?>

	<?php endif; ?>

	</div><!-- .row -->

</div><!-- #luminous-latest-posts -->