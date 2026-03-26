<?php
/**
 * The template for displaying archive pages
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
		<section class="flexible-content-block page-header">
			<div class="container">
				<h3 class="eyebrow lazy fade-in-down">Category</h3>
				<h1 class="lazy fade-in-up"><?php echo single_cat_title(); ?></h1>
			</div>
		</section>
		<div class="container">
			<div class="facets-container">
				<div class="search-facet-container">
					<?php echo do_shortcode('[facetwp facet="search"]'); ?>
				</div>
				<div class="breadcrumbs">
					<a href="/blog"><i class="fa fa-chevron-left"></i> &nbsp; Back to all news</a>
				</div>
<!--
				<div class="category-facet-container">
					<?php //echo do_shortcode('[facetwp facet="categories"]'); ?>
				</div>
-->
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


<?php get_sidebar(); ?>

<?php get_footer();
