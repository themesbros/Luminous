<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>

<?php wp_head(); ?>

</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<header <?php hybrid_attr( 'header' ); ?>>

		<div class="row">

			<?php
			$display_address = absint( get_theme_mod( 'display_address', 1 ) );
			$display_contact = absint( get_theme_mod( 'display_contact', 1 ) );
			$display_social  = absint( get_theme_mod( 'display_social', 1 ) );

			$columns         = luminous_header_columns_number( $display_address, $display_contact, $display_social );
			$classes         = luminous_header_classes( $columns );
			$branding_class  = $classes[0];
			$header_r_class  = $classes[1];
			?>

			<div id="branding" class="<?php echo $branding_class; ?>">

			<?php $icon = get_theme_mod( 'logo_icon', 'fa-lightbulb-o' ); ?>

			<?php if ( $icon !== 'no-icon' ) : ?>
				<i class="fa <?php echo esc_html( $icon ); ?>"></i>
				<div id="branding-inner">
			<?php endif; ?>

				<?php hybrid_site_title(); ?>
				<?php hybrid_site_description(); ?>

			<?php echo ( $icon !== 'no-icon' ) ? '</div><!-- #branding-inner -->' : ''; ?>

			</div><!-- #branding -->

			<?php if ( $header_r_class !== '' ) : ?>

				<div id="header-right" class="<?php echo $header_r_class; ?>">

					<div class="row">

						<a id="toggle-primary-menu" href="#"></a>

						<?php if ( $display_social ) : ?>
							<a id="toggle-social-menu" href="#"></a>
						<?php endif; ?>

						<?php if ( $display_address ) : ?>

							<?php $address = get_theme_mod( 'header_address', __( '30 Lincoln Center Plaza New York, NY', 'luminous' ) ); ?>

							<div class="header-info col-1-<?php echo $columns; ?>">

								<?php $address_icon = get_theme_mod( 'header_address_icon', 'fa-home' ); ?>
								<?php if ( $address_icon !== 'no-icon' ) : ?>
									<i class="fa <?php echo esc_html( $address_icon ); ?>"></i>
								<?php endif;  ?>

								<span><?php echo esc_html( $address ); ?></span>
							</div>

						<?php endif; ?>

						<?php if ( $display_contact ) : ?>

							<?php $contact = get_theme_mod( 'header_contact', '+1 212-564-5555 contact@example.com' );  /* Reviewers: no need for localization here. */ ?>

							<div class="header-info col-1-<?php echo $columns; ?>">
								<?php $contact_icon = get_theme_mod( 'header_contact_icon', 'fa-phone' ); ?>
								<?php if ( $contact_icon !== 'no-icon' ) : ?>
									<i class="fa <?php echo esc_html( $contact_icon ); ?>"></i>
								<?php endif; ?>
								<span><?php echo esc_html( $contact ); ?></span>
							</div>

						<?php endif; ?>

						<?php if ( $display_social ) : ?>

							<div class="header-social col-1-<?php echo $columns; ?>">

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
												<a href="<?php echo esc_url( $url ); ?>" title="<?php echo ucfirst( $profile ); ?> ">
													<span class="screen-reader-text"><?php echo $profile; ?></span>
												</a>
											</li>

										<?php endif; ?>

									<?php endforeach; ?>

								</ul><!-- .social -->

							</div><!-- .col-1-<?php echo $columns; ?> -->

						<?php endif; ?>

					</div><!-- .row -->

				</div><!-- #header-right -->

			<?php endif; // End check for #header-right class. ?>

		</div><!-- .row -->

	</header><!-- #header -->

	<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

	<div id="main" class="wrap">

	<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>