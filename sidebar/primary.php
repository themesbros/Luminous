<?php if ( luminous_show_sidebar() ) : // Check sidebar needs to be shown. ?>

	<aside <?php hybrid_attr( 'sidebar', 'primary' ); ?>>

		<?php if ( is_active_sidebar( 'primary' ) ) : // If the sidebar has widgets. ?>

			<?php dynamic_sidebar( 'primary' ); // Displays the primary sidebar. ?>

		<?php else : // Load default widgets. ?>

			<section class="widget widget_text">
				<h3 class="widget-title"><?php _e( 'About Author', 'luminous' ); ?></h3>
				<div class="textwidget">
				<img class="about-img" src="<?php echo trailingslashit( get_template_directory_uri() ) .'images/about.jpg' ; ?>" alt="">
				Pellentesque habitant morbi tristique sentol
				netus et malesuada fames ac turpis gesta ers
			ibulum tortor quam, feugiat vitae, ultricie feta
			tempor sit amet, ante. Donec eu libero nuri
				</div>
			</section>

			<section class="widget widget_recent_entries">
				<h3 class="widget-title"><?php _e( 'Recent Posts', 'luminous' ); ?></h3>
				<ul><?php wp_get_archives('title_li=&type=postbypost&limit=5'); ?></ul>
			</section>			

			<section class="widget widget_recent_comments">
				<?php
				$recent_comments = new WP_Widget_Recent_Comments();

				$args = array(
					'title'         => __( 'Recent Comments', 'luminous' ),
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
					'before_widget' => '',
					'after_widget'  => '',
				);
				$recent_comments->widget( $args, array( 'number' => 3 ) );
				?>
			</section>

			<section class="widget widget_meta">
			    <h3 class="widget-title"><?php _e( 'Meta', 'luminous' ); ?></h3>
			    <ul>
			      <?php wp_register(); ?>
			      <li><?php wp_loginout(); ?></li>
			      <li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e( 'XHTML Friends Network', 'luminous' ); ?>"><?php _e( 'XFN', 'luminous' ); ?></abbr></a></li>
			      <li><a href="http://wordpress.org/" title="<?php _e( 'Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'luminous' ); ?>"><?php _e( 'WordPress', 'luminous' ); ?></a></li>
			      <?php wp_meta(); ?>
			    </ul>
			</section>

			<section class="widget widget_tag_cloud">
				<h3 class="widget-title"><?php _e( 'Tags', 'luminous' ); ?></h3>
				<div class="tagcloud">
					<?php wp_tag_cloud( array( 'number' => 6 ) ); ?>
				</div>
			</section>

			<section class="widget widget_search">
				<?php get_search_form(); ?>
			</section>		
						
		<?php endif; // End widgets check. ?>

	</aside><!-- #sidebar-primary -->

<?php endif; // End sidebar display check. ?>