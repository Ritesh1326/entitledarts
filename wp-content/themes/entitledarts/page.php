<?php get_header(); ?>
<div>
	<div class="row">
		<div id="main-content" class="main-page <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<main id="main" class="site-main" role="main">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					the_content();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				// End the loop.
				endwhile;
				?>
			</main><!-- .site-main -->

		</div><!-- .content-area -->
	</div>
</div>

<!-- <?php //get_sidebar(); ?> -->
<?php get_footer(); ?>