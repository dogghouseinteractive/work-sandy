<?php
/**
 * Template Name: Brochure
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<?php while(have_posts()) { ?>
		<?php the_post(); ?>
		<?php the_content(); ?>
	<?php } ?>

	<?php get_footer();
