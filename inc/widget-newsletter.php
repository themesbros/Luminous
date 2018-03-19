<?php

class Luminous_Widget_Newsletter extends WP_Widget {
	
	function __construct() {
				
		$widget_options = array( 
			'classname'   => 'luminous_widget_newsletter', 
			'description' => __( 'Displays Mailchimp newsletter form.', 'luminous' ) 
		);		

		parent::__construct( 
			'Luminous_Widget_Newsletter', 'Luminous - ' . __( 'Newsletter', 'luminous' ), 
			$widget_options
		);	
		
		add_action( 'wp_ajax_add_to_mailchimp_list', array( $this, 'add_to_mailchimp_list' ) );
		add_action( 'wp_ajax_nopriv_add_to_mailchimp_list', array( $this, 'add_to_mailchimp_list' ) );						
	}
		
	function form( $instance ) {

		$fields      = false;   // Hide all fields by default except api key. When api key is entered, other fields will be shown.
		$lists       = array(); // User created mailchimp lists.
		$api_key     = isset( $instance['api_key'] ) ? esc_attr( $instance['api_key'] ) : ''; 	
		$title       = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Sign Up Today - Free', 'luminous' );
		$text        = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : __( 'Get latest news directly to your inbox!', 'luminous' ); 
		$activeList  = isset( $instance['list'] ) ? esc_attr( $instance['list'] ) : ''; 			
		$button_text = isset( $instance['button_text'] ) ? esc_attr( $instance['button_text'] ) : __( 'Sign Up', 'luminous');	
		$doptin      = isset( $instance['doptin'] ) ? (bool) $instance['doptin'] : false;

		if ( ! empty( $api_key ) ) {	

	 		/* Load Mailchimp API. */
			require_once( trailingslashit( get_template_directory() ) .'inc/mailchimp.php' );			
			$mc    = new Luminous_Mailchimp_API( $api_key );
			$lists = $mc->get_lists();

			if ( is_array( $lists ) ) {
				$fields = true;	
			} else {				
				echo '<p style="color: red; font-weight: bold;">'. __( 'Incorrect API key!', 'luminous' ) .'</p>';
			}

		} 
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'api_key' ); ?>"><?php _e( 'Api Key:', 'luminous' ); ?></label> 
			<small>
				<a target="_blank" href="https://admin.mailchimp.com/account/api-key-popup">
				<?php _e( '(Grab it here!)', 'luminous' ); ?>
				</a>
			</small>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'api_key' ); ?>" name="<?php echo $this->get_field_name( 'api_key' ); ?>" value="<?php echo $api_key; ?>" />
		</p>	

		<?php if ( $fields ) :
	
		?>
		
		<p>	
			<label for="<?php echo $this->get_field_id( 'list' ); ?>">
				<?php _e( 'Select List:', 'luminous' ); ?>
			</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'list' ); ?>" name="<?php echo $this->get_field_name( 'list' ); ?>">		
				<?php if ( ! empty( $lists ) ) : ?>
					<?php foreach( $lists as $id => $name ) : ?>
						<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $id, $activeList ); ?>><?php echo esc_attr( $name ); ?></option>
					<?php endforeach; ?>					
				<?php endif; ?>
			</select>			
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'luminous' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Subscribe Text:', 'luminous' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $text ); ?></textarea>		
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>">
				<?php _e( 'Subscribe Button Text:', 'luminous' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" value="<?php echo $button_text; ?>" />
		</p>	

		<?php endif;
		
	}
	
	function update( $new_instance, $old_instance ) {
 
		$instance = $old_instance; 
		
		$instance['api_key']     = esc_html( $new_instance['api_key'] ); 

		/**
		 * MC api key needs to have a hyphen in it, otherwise Mailchimp class will throw an error if checking on some random   string.
		*/
		if ( strpos( $instance['api_key'], '-' ) == false ) { 
			$instance['api_key'] = $instance['api_key'] . '-';
		}

		$instance['list']        = isset( $new_instance['list'] ) ? strip_tags( $new_instance['list'] ) : ''; 
		$instance['title']       = isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : __( 'Newsletter', 'luminous' ); 
		$instance['text']        = isset( $new_instance['text'] ) ? strip_tags( $new_instance['text'] ) : __( 'Get latest news directly to your inbox!', 'luminous' );
		$instance['button_text'] = isset( $new_instance['button_text'] ) ? strip_tags( $new_instance['button_text'] ) : __( 'Sign Up', 'luminous' ); 

		$luminous_mc_data = 'luminous_mailchimp_data';		
		delete_option( $luminous_mc_data );		
		
		$mc_data = array( 
			'api_key'      => $instance['api_key'], 
			'active_list'  => $instance['list'],
		);

		add_option( $luminous_mc_data, $mc_data ); 		

	    return $instance;
	}
	
	function widget( $args, $instance ) {
	
		extract( $args );
		
		$api_key     = isset( $instance['api_key'] ) ? strip_tags( $instance['api_key'] ) : '';
		$title       = isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : '';
		$text        = isset( $instance['text'] ) ? strip_tags( $instance['text'] ) : '';
		$list_id     = isset( $instance['list'] ) ? strip_tags( $instance['list'] ) : '';
		$button_text = isset( $instance['button_text'] ) ? strip_tags( $instance['button_text'] ) : '';
		
		echo $before_widget;
						
		if ( ! empty( $title ) )
			echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;									
		if ( ! empty( $api_key ) && ! empty( $list_id ) ) {
			
			/* Don't load mailchimp.js on demo page, it will enable form submission, and throw error in debug.log. */
			if ( $api_key !== 'fake-api-key' ) {

				$suffix = hybrid_get_min_suffix();

				wp_enqueue_script( 'luminous-mailchimp', 
					trailingslashit( get_template_directory_uri() ) . "js/mailchimp{$suffix}.js", 
					array( 'jquery' ), 
					null, 
					true 
				);				
			}

			wp_enqueue_script( 'jquery-form' );
			
			$ajaxurl    = admin_url( 'admin-ajax.php' );
			$ajax_nonce = wp_create_nonce( 'MailChimp' );

			wp_localize_script( 'luminous-mailchimp', 'ajaxVars', array( 
				'ajaxurl'    => $ajaxurl, 
				'ajax_nonce' => $ajax_nonce,
				'success'    => __( "You've been added to our sign-up list. We have sent an email, asking you to confirm the same.", 'luminous' ),
				'error'      => __( "There was an error. Please try again.", 'luminous' ),
				'email'      => __( "That does not look like a valid email!", 'luminous' ),
				) 
			);		
														
			?>
 
			<?php if ( ! empty( $text ) ) : ?>
				<p><?php echo $text; ?></p>
			<?php endif; ?>

			<form class="newsletter-form" action="#" method="POST">
				<input id="<?php echo $this->get_field_id('email'); ?>" placeholder="<?php _e( 'Your email address', 'luminous' ); ?>" class="newsletter-input" type="email" name="email" required />
				<button class="newsletter-button" type="submit"><?php echo $button_text; ?></button>
 			</form>

			<?php  		 
		}
		
		echo $after_widget;				
	}
	

	function add_to_mailchimp_list() {

		check_ajax_referer( 'MailChimp', 'ajax_nonce' );
		$_POST = array_map( 'stripslashes_deep', $_POST );

		$email = sanitize_email( $_POST['email'] );
		
		if ( is_email( $email ) ) {
			
			$mc_data = get_option( 'luminous_mailchimp_data' );
			
			if ( ! empty( $mc_data ) ) {
				
				$api_key      = esc_attr( $mc_data['api_key'] );
				$list_id      = esc_attr( $mc_data['active_list'] );
				
				/* Load Mailchimp API. */
				require_once( trailingslashit( get_template_directory() ) .'inc/mailchimp.php' );									
				$MailChimp = new Luminous_MailChimp_API( $api_key );

				$result = $MailChimp->call( 'lists/subscribe', array(
								'id'                => $list_id,
								'email'             => array( 'email' => $email ),
								'double_optin'      => true,
								'update_existing'   => true,
								'replace_interests' => false,
								));			

				if ( is_array( $result ) ) 
					echo 'added';
			}  
		} 
		else {
			echo 'invalid email';
		}
			
		wp_die();
	}
		
		
}
