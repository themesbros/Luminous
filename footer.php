				<?php hybrid_get_sidebar( 'primary' ); // Loads the sidebar/primary.php template. ?>

			</div><!-- #main -->
			
		<?php hybrid_get_sidebar( 'subsidiary' ); // Loads the sidebar/subsidiary.php template. ?>
		
		<?php hybrid_get_sidebar( 'pre-footer' ); // Loads the sidebar/footer.php template. ?>

		<footer <?php hybrid_attr( 'footer' ); ?>>

			<div class="wrap">	
		
				<p class="credit">				
					<?php _e( 'Copyright &#169;', 'luminous' ); echo date( 'Y' ); ?>
					<a href="<?php echo bloginfo( 'url' ); ?>"><?php echo bloginfo( 'sitename' ); ?></a>.
					<?php _e( 'All rights reserved.', 'luminous' ); ?> 
				</p><!-- .credit -->	
					
			</div><!-- .wrap -->			
			
		</footer><!-- #footer -->
				
	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>