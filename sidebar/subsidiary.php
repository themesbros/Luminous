<?php if ( is_active_sidebar( 'subsidiary' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebar', 'subsidiary' ); ?>>

		<div class="wrap">
				
			<?php dynamic_sidebar( 'subsidiary' ); // Displays the subsidiary sidebar. ?>

		</div><!-- .wrap -->

	</aside><!-- #sidebar-subsidiary -->

<?php else : // Load default widgets. ?>

	<aside itemtype="http://schema.org/WPSideBar" itemscope="itemscope" role="complementary" class="sidebar sidebar-cols-3" id="sidebar-subsidiary">	
		
		<div class="wrap">

			<?php
			the_widget(
				'Luminous_Work_Hours',
				array(
					'title'      => __( 'Busines Hours', 'luminous' ),
					'subtitle'   => __( 'Our current working business hours, you can reach us any day!', 'luminous' ),
					'days'       => __( 'Monday - Friday', 'luminous' ),
					'work_hours' => '7:00 - 17:00',
					'sat'        => __( 'Saturday', 'luminous' ),
					'sat_hours'  => '8:30 - 16:00',
					'sun'        => __( 'Sunday', 'luminous' ),
					'sun_hours'  => '9.30 - 14.00',
				),
				array(
					'before_widget' => '<section class="widget luminous_office_hours">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>'
				)
			);
			?>		

			<section class="widget widget_recent_entries">
				<h3 class="widget-title"><?php _e( 'Recent Posts', 'luminous' ); ?></h3>
				<ul><?php wp_get_archives('title_li=&type=postbypost&limit=7'); ?></ul>
			</section>
 		
			<?php
			the_widget(
				'Luminous_Widget_Newsletter',
				array(
					'api_key'     => 'fake-api-key',
					'title'       => __( 'Newsletter', 'luminous' ),
					'text'        => __( "Join the 1,000's of customers who have signed up, just enter your email address.", 'luminous' ),
					'list'        => 'def',
					'button_text' => __( 'Sign Up', 'luminous' ),
					
				),
				array(
					'before_widget' => '<section class="widget luminous_widget_newsletter">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>'
				)
			);
			?>

		</div><!-- .wrap -->

	</aside>

<?php endif; // End widgets check. ?>