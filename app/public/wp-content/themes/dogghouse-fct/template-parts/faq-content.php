<?php if ( have_posts() ) {
	while ( have_posts() ) { 
		the_post(); ?>

	<div class="faq">
		<h2 class="faq-heading">
			<?php echo get_the_title(); ?>
		</h2>
		<div class="faq-content">
			<?php the_content(); ?>
		</div>
	</div>

	<?php } ?>

<?php } else {

	echo 'No posts found.';

} ?>

<script type="text/javascript">
	jQuery(document).on('facetwp-loaded', function() {
		jQuery('h2.faq-heading').on('click', function() {
			if(jQuery(this).hasClass('clicked')) {
				jQuery(this).siblings('.faq-content').removeClass('clicked');
				jQuery(this).removeClass('clicked');
			} else {
				jQuery(this).siblings('.faq-content').addClass('clicked');
				jQuery(this).addClass('clicked');
			}
		});
	});
</script>