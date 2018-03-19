<?php

class Luminous_Work_Hours extends WP_Widget {

	function __construct() {

		$widget_options = array( 
			'classname'   => 'luminous_office_hours',
			'description' => __( 'Displays your work hours.', 'luminous' ) 
		);

		parent::__construct( 'Luminous_Work_Hours', __( 'Luminous - Work Hours', 'luminous' ), $widget_options );
	}

	function form( $instance ) {

		$title      = isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : '';
		$subtitle   = isset( $instance['subtitle'] ) ? strip_tags( $instance['subtitle'] ) : '';
		$days       = isset( $instance['days'] ) ? strip_tags( $instance['days'] ) : '';
		$work_hours = isset( $instance['work_hours'] ) ? strip_tags( $instance['work_hours'] ) : '';
		$sat        = isset( $instance['sat'] ) ? strip_tags( $instance['sat'] ) : '';
		$sat_hours  = isset( $instance['sat_hours'] ) ? strip_tags( $instance['sat_hours'] ) : '';
		$sun        = isset( $instance['sun'] ) ? strip_tags( $instance['sun'] ) : '';
		$sun_hours  = isset( $instance['sun_hours'] ) ? strip_tags( $instance['sun_hours'] ) : '';

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'luminous' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Short text:', 'luminous' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $subtitle; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'days' ); ?>"><?php _e( 'Monday To Friday Text:', 'luminous' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>" value="<?php echo $days; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'work_hours' ); ?>"><?php _e( 'Monday To Friday Work Hours:', 'luminous' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'work_hours' ); ?>" name="<?php echo $this->get_field_name( 'work_hours' ); ?>" value="<?php echo $work_hours; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'sat' ); ?>"><?php _e( 'Saturday Text:', 'luminous' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'sat' ); ?>" name="<?php echo $this->get_field_name( 'sat' ); ?>" value="<?php echo $sat; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'sat_hours' ); ?>"><?php _e( 'Saturday Work Hours:', 'luminous' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'sat_hours' ); ?>" name="<?php echo $this->get_field_name( 'sat_hours' ); ?>" value="<?php echo $sat_hours; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'sun' ); ?>"><?php _e( 'Sunday Text:', 'luminous' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'sun' ); ?>" name="<?php echo $this->get_field_name( 'sun' ); ?>" value="<?php echo $sun; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'sun_hours' ); ?>"><?php _e( 'Sunday Work Hours:', 'luminous' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'sun_hours' ); ?>" name="<?php echo $this->get_field_name( 'sun_hours' ); ?>" value="<?php echo $sun_hours; ?>" />
		</p>
 		
		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['subtitle']   = strip_tags( $new_instance['subtitle'] );
		$instance['days']       = strip_tags( $new_instance['days'] );
		$instance['work_hours'] = strip_tags( $new_instance['work_hours'] );
		$instance['sat']        = strip_tags( $new_instance['sat'] );
		$instance['sat_hours']  = strip_tags( $new_instance['sat_hours'] );
		$instance['sun']        = strip_tags( $new_instance['sun'] );
		$instance['sun_hours']  = strip_tags( $new_instance['sun_hours'] );

	    return $instance;
	}

	function widget( $args, $instance ) {

		extract( $args );

		$title      = strip_tags( $instance['title'] );
		$subtitle   = strip_tags( $instance['subtitle'] );
		$days       = strip_tags( $instance['days'] );
		$work_hours = strip_tags( $instance['work_hours'] );
		$sat        = strip_tags( $instance['sat'] );
		$sat_hours  = strip_tags( $instance['sat_hours'] );
		$sun        = strip_tags( $instance['sun'] );
		$sun_hours  = strip_tags( $instance['sun_hours'] );		

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;
		?>

		<?php if ( ! empty( $subtitle ) ) : ?>
			<p><?php echo $subtitle; ?></p>
		<?php endif; ?>

  		<ul class="work-hours hide-greater-sign">
  			<?php if ( ! empty( $days ) && ! empty( $work_hours ) ) : ?>
	  			<li><?php echo $days; ?> <span><?php echo $work_hours; ?></span></li>
  			<?php endif ?>
  			<?php if ( ! empty( $sat ) && ! empty( $sat_hours ) ) : ?>
	  			<li><?php echo $sat; ?> <span><?php echo $sat_hours; ?></span></li>
  			<?php endif ?>
  			<?php if ( ! empty( $sun ) && ! empty( $sun_hours ) ) : ?>
	  			<li><?php echo $sun; ?> <span><?php echo $sun_hours; ?></span></li>
  			<?php endif ?>
  		</ul>

		<?php echo $after_widget;
	}

}

?>