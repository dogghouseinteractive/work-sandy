<?php
/**
 * Template Name: FAQ
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<?php while(have_posts()) { ?>
		<?php the_post(); ?>
		<?php get_template_part('template-parts/acf-frontend-editor'); ?>
		<?php get_template_part('blocks/flexible-content'); ?>
		<div class="container">
			<div class="facets-container">
				<div class="search-facet-container">
					<?php echo do_shortcode('[facetwp facet="search"]'); ?>
				</div>
				<div class="category-facet-container">
					<?php echo do_shortcode('[facetwp facet="faq_categories"]'); ?>
				</div>
			</div>
			<div class="faq-posts-container">
				<?php echo do_shortcode('[facetwp template="faq"]'); ?>
			</div>
			<div class="pagination-container">
				<?php echo do_shortcode('[facetwp facet="pagination"]'); ?>
			</div>
		</div>
	<?php } ?>

	<?php get_footer();
