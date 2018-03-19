<?php
class Luminous_Widget_Popular extends WP_Widget {
		
	public function __construct() {
		
		$widget_options = array( 
			'classname'   => 'luminous_widget_popular_posts', 
			'description' => __( 'Displays most popular posts.', 'luminous' ) 
		);

		parent::__construct( 
			'Luminous_Widget_Popular', 
			'Luminous - ' . __( 'Popular Posts', 'luminous' ), 
			$widget_options 
		);					

		$this->alt_option_name = 'widget_popular_entries';
		
		add_action( 'save_post', 	array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}
 
	public function form( $instance ) {
		
			$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$number     = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
			$show_date  = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;		
			$categories = isset( $instance['categories'] ) ? $instance['categories'] : array();	
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'luminous' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'luminous' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?', 'luminous' ); ?></label>
		</p>
				
		<p class="widget-select-container">
 			<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Choose Categories:', 'luminous' ); ?></label>		
			<select name="<?php echo $this->get_field_name( 'categories' ); ?>[]" id="<?php echo $this->get_field_id( 'categories' ); ?>"  style="height: 200px" class="widefat" multiple="multiple">
			<?php $cats = get_categories(array('hide_empty' => 0 )); ?>
			<?php foreach( $cats as $cat ) : ?>
				<option value="<?php echo absint( $cat->cat_ID ); ?>" <?php echo in_array( $cat->cat_ID, $categories ) ? 'selected="selected"' : ''; ?>><?php echo esc_attr( $cat->cat_name ); ?></option>
			<?php endforeach; ?>
			</select>		
		</p>
 
		<?php
	}
	
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title']      = strip_tags($new_instance['title']);
		$instance['number']     = (int) $new_instance['number'];
		$instance['show_date']  = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['categories'] = isset( $new_instance['categories'] ) ? $new_instance['categories'] : array();
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_popular_entries']) )
			delete_option( 'widget_popular_entries' );

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete( 'widget_recent_posts', 'widget' );
	}
	
	public function widget( $args, $instance ) { 
	
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_recent_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'luminous' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		
		$selected_cats = array();
		
		if ( ! empty( $instance['categories'] ) ) {
			foreach( $instance['categories'] as $cat ) {
				$selected_cats[] = (int) $cat;
			}
		}  
 
		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'category__in' 		  => $selected_cats,
			'orderby' 			  => 'comment_count',
		) ) );

		if ( $r->have_posts() ) :
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<ul class="hide-greater-sign">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li class="popular-post clear">
			
				<?php get_the_image( 
					array( 
					'size'   => 'luminous-widget-image', 
					'order'  => array( 'featured', 'attachment' ), 
					'before' => '<span class="widget-image-wrap">', 
					'after'  => '</span>' ) ); 
				?>
				<div class="post-info">
				<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
				<?php if ( $show_date ) : ?>
					<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></time> /
				<?php endif; ?>
				<?php comments_popup_link( 0, 1, '%', 'comments-link', __( 'Off', 'luminous' ) ); ?>				
				</div>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}	
	
}