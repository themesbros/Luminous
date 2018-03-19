<?php
/**
 * Team template part for template-front-page.php.
 *
 * @package 	Luminous
 * @subpackage 	Front Page
 * @since 		1.0.0
 */
if ( false == (bool) get_theme_mod( 'display_team', 1 ) )
	return;

$title    = get_theme_mod( 'team_title', __( 'MEET OUR TEAM', 'luminous' ) );
$subtitle = get_theme_mod( 'team_subtitle', __( 'Some of the best experts in the field', 'luminous' ) );
$number   = get_theme_mod( 'team_number', 4 );
?>

<div id="luminous-team">

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
	if ( ! class_exists( 'SmartcatTeamPlugin' ) ) {
		echo '<p class="text-center">';
		printf( __( 'In order to use this section, you must install %sOur Team Showcase%s plugin.', 'luminous' ), '<a href="' . admin_url( 'plugin-install.php?tab=search&s=our+team+enhanced' ) . '">', '</a>' );
		echo '</p>';
	}

	$args = array(
		'post_type'      => 'team_member',
		'posts_per_page' => absint( $number ),
	);
	$team = new WP_Query( $args );
	?>

	<?php if ( $team->have_posts() ) : $i = 0; ?>

		<div class="row">

		<?php $number = count( $team->posts ); ?>

		<?php while( $team->have_posts() ) : $team->the_post(); ?>

			<?php $class = $i % 2 == 0 ? 'even' : 'odd'; ?>

			<div class="col-1-<?php echo $number . ' ' . $class; ?>">

				<div class="team-inside">

					<span class="img-wrapper">
					<?php $image = get_the_image( array(
						'size'         => 'full',
						'link_to_post' => false,
						'order'        => array( 'featured', 'attachment' ) ) );
					?>
					</span>

					<div class="team-member-info">
						<h5><?php the_title(); ?></h5>
						<span><?php echo get_post_meta( get_the_ID(), 'team_member_title', true ); ?></span>
					</div><!-- .team-member-info -->

				</div><!-- .team-inside -->

			</div><!-- .col-1-4 -->

		<?php $i++; endwhile; ?>

		</div><!-- .row -->

	<?php endif; ?>

	</div><!-- .wrap -->

</div><!-- #luminous-team -->