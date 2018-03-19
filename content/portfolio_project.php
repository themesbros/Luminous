<article <?php hybrid_attr( 'post' ); ?>>

	<?php get_the_image( array( 'size' => 'full', 'order' => array( 'featured', 'attachment' ) ) ); ?>

	<header class="entry-header">
		<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div <?php hybrid_attr( 'entry-content' ); ?>>
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<div class="row">

			<div class="col-1-3">
				<span <?php hybrid_attr( 'entry-author' ); ?>><?php _e( 'Author', 'luminous' ); ?>: <?php the_author_posts_link(); ?></span>
			</div><!-- .col-1-3 -->

			<?php $client = get_post_meta( get_the_ID(), 'client', true ); ?>

			<?php if ( ! empty( $client ) ) : ?>

				<div class="col-1-3">
					<span class="client"><?php _e( 'Client', 'luminous' ); ?>: </span>
					<span class="client-name"><?php echo esc_html( $client ); ?></span>
				</div><!-- .col-1-3 -->

			<?php endif; ?>

			<?php $url = get_post_meta( get_the_ID(), 'url', true ); ?>

			<?php if ( ! empty( $url ) ) : ?>

				<div class="col-1-3">
					<span class="client-url"><?php _e( 'URL', 'luminous' ); ?>:</span> <a href="<?php echo esc_url( $url ); ?>"><?php echo esc_url( $url ); ?></a>
				</div><!-- .col-1-3 -->

			<?php endif; ?>

		</div><!-- .row -->

	</footer><!-- .entry-footer -->

</article><!-- .entry -->