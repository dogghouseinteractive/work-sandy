<?php if ( have_posts() ) {
	while ( have_posts() ) { 
		the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="post-thumbnail">
				<?php if ( '' !== get_the_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'dogghouse_fct-featured-image' ); ?>
					</a>
				<?php } else { ?>
					<a href="<?php the_permalink(); ?>">
						<img src="https://place-hold.it/389x219">
					</a>
				<?php } ?>
			</div><!-- .post-thumbnail -->
			<div class="blog-post-container">
				<?php $categories = get_the_category(); ?>
				<div class="category">
					<?php foreach($categories as $category) { ?>
						<h3 class="eyebrow"><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a></h3>
					<?php } ?>
				</div>

				<div class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				</div><!-- .entry-header -->

				<div class="entry-content">
					<?php
						/* translators: %s: Name of current post */
						echo get_the_excerpt();

						wp_link_pages( array(
							'before'      => '<div class="page-links">' . __( 'Pages:', 'dogghouse_fct' ),
							'after'       => '</div>',
							'link_before' => '<span class="page-number">',
							'link_after'  => '</span>',
						) );
					?>
				</div><!-- .entry-content -->
			</div>
			<div class="button-container">
				<a class="button primary-transparent" href="<?php echo get_the_permalink(); ?>">Read more</a>
			</div>
		</article><!-- #post-## -->

	<?php } ?>

<?php } else {

	echo 'No posts found.';

} ?>