<?php if ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php the_posts_pagination( array(
	    'mid_size' => 2,
	    'prev_text' => __( 'Previous', 'luminous' ),
	    'next_text' => __( 'Next', 'luminous' ),
	) ); ?>

<?php endif; // End check for type of page being viewed. ?>