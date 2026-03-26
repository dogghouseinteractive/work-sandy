<?php global $block_count; ?>

<?php
	$eyebrow_key = get_sub_field_object('block_eyebrow')['key'];
	$eyebrow_label = get_sub_field_object('block_eyebrow')['label'];
	$eyebrow = get_sub_field('block_eyebrow');
	$heading_key = get_sub_field_object('block_heading')['key'];
	$heading_label = get_sub_field_object('block_heading')['label'];
	$heading = get_sub_field('block_heading');
	$content_key = get_sub_field_object('block_content')['key'];
	$content_label = get_sub_field_object('block_content')['label'];
	$content = get_sub_field('block_content');
	$cta_key = get_sub_field_object('block_cta')['key'];
	$cta_label = get_sub_field_object('block_cta')['label'];
	$cta = get_sub_field('block_cta');
	$cta_class_key = get_sub_field_object('block_cta_class')['key'];
	$cta_class = get_sub_field('block_cta_class');
	$aria_label = '';
	if($eyebrow) {
		$aria_label = $eyebrow;
	} else if($heading) {
		$aria_label = $heading;
	} else {
		$aria_label = get_the_title();
	}
	$aria_label = strip_tags(str_replace(' ', '-', strtolower($aria_label)));
	$aria_label = preg_replace('/(?![-])\p{P}/u', '', $aria_label); 
?>

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block our-clients" aria-labelledby="<?php echo $aria_label; ?>">
	<?php if($eyebrow || $heading || $content || $cta) { ?>
		<div class="container">
			<?php if($eyebrow) { ?>
				<h3 id="<?php echo $aria_label; ?>" class="eyebrow lazy fade-in-down slow delay-one-quarter">
					<div id="<?php echo $eyebrow_key; ?>-container" data-field-label="<?php echo $eyebrow_label; ?>" class="acf-field-container"></div>
					<?php echo $eyebrow; ?>
				</h3>
			<?php } ?>	
			<?php if($heading) { ?>
				<?php if($block_count == 0) { ?>
					<h1 class="lazy fade-in-down delay-one-quarter"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>
						<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container">
						<?php echo $heading; ?>
					</h1>
				<?php } else { ?>
						<h2 class="lazy fade-in-down delay-one-quarter"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>	
						<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container"></div>
						<?php echo $heading; ?>
					</h2>
				<?php } ?>
			<?php } ?>
			<?php if($content) { ?>
				<div class="block-content lazy fade-in-up delay-one-quarter">
					<div id="<?php echo $content_key; ?>-container" data-field-label="<?php echo $content_label; ?>" class="acf-field-container"></div>
					<?php echo $content; ?>
				</div>
			<?php } ?>
			<?php if($cta) { ?>
				<div class="cta lazy fade-in-up delay-one-half">
					<div id="<?php echo $cta_key; ?>-container" data-field-label="<?php echo $cta_label; ?>" class="acf-field-container">
						<div id="<?php echo $cta_class_key; ?>-container" class="acf-field-container"></div>
					</div>
					<a class="button <?php echo $cta_class; ?>" href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>"><?php echo $cta['title']; ?></a>
				</div>
			<?php } ?>
			<?php if(have_rows('clients')) { ?>
				<div class="clients">
					<?php while(have_rows('clients')) { ?>
						<?php the_row(); ?>
						<?php $logo_key = get_sub_field_object('client_logo')['key']; ?>
						<?php $logo_label = get_sub_field_object('client_logo')['label']; ?>
						<?php $logo = get_sub_field('client_logo'); ?>
						<?php $link_key = get_sub_field_object('client_link')['key']; ?>
						<?php $link = get_sub_field('client_link'); ?>
						<?php $delay = ''; ?>
						<?php if(get_row_index() <= 6) {
							$delay = 1;
						} else if(get_row_index() > 6 && get_row_index() <= 12) { 
							$delay = 2;
						} else if(get_row_index() > 12 && get_row_index() <= 18) { 
							$delay = 3;
						} else if(get_row_index() > 18 && get_row_index() <= 24) { 
							$delay = 4;
						} ?>
						<?php if($logo || $link) { ?>
							<div class="client lazy zoom-in delay-<?php echo $delay; ?>">
								<div id="<?php echo $logo_key; ?>-container" data-field-label="<?php echo $logo_label; ?>" class="acf-field-container">
									<div id="<?php echo $link_key; ?>-container" class="acf-field-container"></div>
								</div>
								<?php if($link) { ?>
									<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
								<?php } ?>
								<?php if($logo) { ?>
									<div class="client-logo" style="background-image: url(<?php echo $logo; ?>);"></div>
								<?php } else if($link) { ?>
										<?php echo $link['text']; ?>
									</a>	
								<?php } ?>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</section>