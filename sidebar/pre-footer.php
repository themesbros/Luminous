<div id="pre-footer">

	<div class="wrap">

		<div class="row">

		<?php
		$display_address = absint( get_theme_mod( 'display_pf_address', 1 ) );
		$display_contact = absint( get_theme_mod( 'display_pf_contact', 1 ) );
		$display_social  = absint( get_theme_mod( 'display_pf_social', 1 ) );
		$display_btt     = absint( get_theme_mod( 'display_btt', 1 ) );

		$columns         = luminous_header_columns_number( $display_address, $display_contact, $display_social );
		$classes         = luminous_header_classes( $columns );

		$branding_class  = $classes[0];
		$header_r_class  = $classes[1];
	 	?>

			<?php if ( $display_address ) : ?>

				<?php $address = get_theme_mod( 'footer_address', __( '30 Lincoln Center Plaza New York, NY', 'luminous' ) ); ?>

				<div class="pf-box col-1-<?php echo $columns; ?>">

					<?php $title = get_theme_mod( 'footer_address_title', __( 'OUR ADDRESS', 'luminous' ) ); ?>

					<?php if ( ! empty( $title ) ) : ?>
						<h3 class="widget-title"><?php echo esc_html( $title ); ?></h3>
					<?php endif; ?>

					<div>
						<?php $address_icon = get_theme_mod( 'footer_address_icon', 'fa-home' ); ?>
						<?php if ( $address_icon !== 'no-icon' ) : ?>
							<i class="fa <?php echo esc_html( $address_icon ); ?>"></i>
						<?php endif;  ?>

						<p><?php echo esc_html( $address ); ?></p>
					</div>
				</div>

			<?php endif; ?>

			<?php if ( $display_social ) : ?>

				<div class="pf-box col-1-<?php echo $columns; ?>">

					<?php $title = get_theme_mod( 'social_title', __( 'GET SOCIAL', 'luminous' ) ); ?>

					<?php if ( ! empty( $title ) ) : ?>
						<h3 class="widget-title"><?php echo esc_html( $title ); ?></h3>
					<?php endif; ?>

					<?php $social_profiles = array( 'facebook', 'twitter', 'google', 'youtube', 'linkedin', 'instagram', 'pinterest', 'github', 'flickr', 'wordpress', 'codepen', 'digg', 'dribbble', 'dropbox', 'skype', 'reddit', 'stumbleupon', 'tumblr', 'vimeo' ); ?>

					<ul class="social">

						<?php foreach( $social_profiles as $profile ) : ?>

							<?php
							$default = '';
							if ( in_array( $profile, array('facebook', 'twitter', 'google', 'linkedin', 'youtube') ) )
								$default = "http://www.{$profile}.com/";
							?>

							<?php $url = get_theme_mod( $profile, $default ); ?>

							<?php if ( ! empty( $url ) ) : ?>

								<li data-profile="<?php echo $profile; ?>">
									<a href="<?php echo esc_url( $url ); ?>" title="<?php echo __( 'We on', 'luminous' ) . ' ' . ucfirst( $profile ); ?> ">
										<span class="screen-reader-text"><?php echo ucfirst( $profile ); ?></span>
									</a>
								</li>

							<?php endif; ?>

						<?php endforeach; ?>

					</ul><!-- .social-footer -->

				</div><!-- .col-1-<?php echo $columns; ?> -->

			<?php endif; ?>

			<?php if ( $display_contact ) : ?>

				<?php $address = get_theme_mod( 'footer_contact', __( '+1 212-564-5555 contact@example.com', 'luminous' ) ); ?>

				<div class="pf-box col-1-<?php echo $columns; ?>">

					<?php $title = get_theme_mod( 'foter_contact_title', __( 'EMERGENCY CALL', 'luminous' ) ); ?>

					<?php if ( ! empty( $title ) ) : ?>
						<h3 class="widget-title"><?php echo esc_html( $title ); ?></h3>
					<?php endif; ?>

					<div>
						<?php $address_icon = get_theme_mod( 'footer_contact_icon', 'fa-home' ); ?>
						<?php if ( $address_icon !== 'no-icon' ) : ?>
							<i class="fa <?php echo esc_html( $address_icon ); ?>"></i>
						<?php endif;  ?>

						<p><?php echo esc_html( $address ); ?></p>
					</div>
				</div>

			<?php endif; ?>

			<?php if ( $display_btt ) : ?>

				<a id="back-to-top" title="<?php _e( 'Back to top', 'luminous' ); ?>" class="fa fa-angle-up" href="#header">
					<span class="screen-reader-text"><?php _e( 'Back to top', 'luminous' ); ?></span>
				</a>

			<?php endif; ?>

		</div><!-- .row -->

	</div><!-- .wrap -->

</div><!-- #sidebar-footer -->