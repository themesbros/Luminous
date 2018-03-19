<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
			<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
			<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date('F d, Y'); ?></time>
			<?php comments_popup_link( 0, 1, '%', 'comments-link', __( 'Off', 'luminous' ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'category' ) ); ?>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'sep' => '' ) ); ?>
			<div class="posts-nav">
				<?php previous_post_link( '<div class="post-nav prev">' . __( 'Previous Post: %link', 'luminous' ) . '</div>', '%title' ); ?>
				<?php next_post_link( '<div class="post-nav next">' . __( 'Next Post: %link',     'luminous' ) . '</div>', '%title' ); ?>
			</div>
 		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<?php get_the_image( array( 'size' => 'luminous-fp', 'order' => array( 'featured', 'attachment' ) ) ); ?>

		<header class="entry-header">
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
			<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
			<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date('F d, Y'); ?></time>
			<?php comments_popup_link( 0, 1, '%', 'comments-link', __( 'Off', 'luminous' ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'category' ) ); ?>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_excerpt(''); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-footer">
			<a class="more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'luminous' ); ?> &raquo;</a>
 		</footer><!-- .entry-footer -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->