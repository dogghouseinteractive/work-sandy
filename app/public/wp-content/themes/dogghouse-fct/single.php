<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<section class="post-content">
		<?php while ( have_posts() ) {
			the_post(); ?>

			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-featured-image" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);" data-stellar-background-ratio="0.2"></div>
			<?php } ?>

			<div class="container">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div><!-- .entry-header -->

					<div class="entry-content">
						<?php
							/* translators: %s: Name of current post */
							the_content( sprintf(
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dogghouse_fct' ),
								get_the_title()
							) );

						?>
					</div><!-- .entry-content -->

				</article><!-- #post-## -->

				<?php 

					the_post_navigation( array(
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'dogghouse_fct' ) . '</span><span class="nav-title"><span class="nav-title-icon-wrapper"></span><i class="fa fa-chevron-left"></i> &nbsp;Previous Post</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'dogghouse_fct' ) . '</span><span class="nav-title">Next Post &nbsp;<i class="fa fa-chevron-right"></i> </span>',
					) );
	
				?>

				<div class="clear"></div>
			</div>
		<?php } ?>
	</section>
	
	<section class="related-posts">
		<?php $category = get_the_terms($post_id, 'category'); ?>
		<?php $args = array( 
			'post_type' => 'post',
			'posts_per_page' => 3,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'term_id',
					'terms' => $category[0]->term_id,
				)
			),
			'post__not_in' => array( $post->ID ),
		); ?>
		<?php $related_posts = new WP_Query($args); ?>
		<?php if($related_posts->have_posts()) { ?>
			<div class="container">
				<h2 class="section-heading">Related Posts</h2>
				<div class="related-posts-container">
					<?php while($related_posts->have_posts()) { ?>
						<?php $related_posts->the_post(); ?>
						<div id="post-<?php echo get_the_ID(); ?>" class="related-post">
							<?php if(has_post_thumbnail(get_the_ID())) { ?>
								<div class="featured-image" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>);">
									<a href="<?php echo get_the_permalink(get_the_ID()); ?>"></a>
								</div>
								<div class="related-post-meta">
									<a href="<?php echo get_category_link( $category[0]->term_id ); ?>"><?php echo $category[0]->name; ?></a>
								</div>
								<h2 class="related-post-title">
									<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(get_the_ID()); ?></a>
								</h2>
								<div class="related-post-content"><?php the_excerpt(); ?></div>
								<a class="button primary-solid" href="<?php echo get_the_permalink(get_the_ID()); ?>">Read More</a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		<?php wp_reset_postdata(); ?>
	</section>
</main><!-- #main -->

<?php get_footer();
