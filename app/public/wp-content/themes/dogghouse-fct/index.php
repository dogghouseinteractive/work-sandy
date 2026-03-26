<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section id="block-0" class="flexible-content-block page-header">
			<div class="container">
				<h3 class="eyebrow lazy fade-in-down">News</h3>
				<h1 class="lazy fade-in-up">The Sandy Journal</h1>
			</div>
		</section>
		<div class="container">
			<div class="facets-container">
				<div class="search-facet-container">
					<?php echo do_shortcode('[facetwp facet="search"]'); ?>
				</div>
				<div class="category-facet-container">
					<?php echo do_shortcode('[facetwp facet="categories"]'); ?>
				</div>
			</div>
			<div class="blog-posts-container">
				<?php echo do_shortcode('[facetwp template="blog_posts"]'); ?>
			</div>
			<div class="pagination-container">
				<?php echo do_shortcode('[facetwp facet="pagination"]'); ?>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php //get_sidebar(); ?>

<?php get_footer();
