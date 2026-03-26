<?php global $block_count; ?>

<?php
	$background_image_key = get_sub_field_object('background_image')['key'];
	$background_image_label = get_sub_field_object('background_image')['label'];
	$background_image = get_sub_field('background_image');
	$bg_img_animation_style_key = get_sub_field_object('bg_image_animation_style')['key'];
	$bg_img_animation_style = get_sub_field('bg_image_animation_style');
	$link_card_position_toggle_key = get_sub_field_object('link_card_position_toggle')['key'];
	$link_card_position_toggle_label = get_sub_field_object('link_card_position_toggle')['label'];
	$link_card_position_toggle = get_sub_field('link_card_position_toggle');
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
	$link_card_heading_key = get_sub_field_object('link_card_heading')['key'];
	$link_card_heading_label = get_sub_field_object('link_card_heading')['label'];
	$link_card_heading = get_sub_field('link_card_heading');
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

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block link-card<?php if($link_card_position_toggle) { echo ' ' . $link_card_position_toggle; } ?>" aria-labelledby="<?php echo $aria_label; ?>">
	<?php if($background_image) { ?>
		<div class="background-image<?php if($bg_img_animation_style) { echo ' lazy ' . $bg_img_animation_style; } ?>" style="background-image: url(<?php echo $background_image; ?>);">
			<div id="<?php echo $background_image_key; ?>-container" data-field-label="<?php echo $background_image_label; ?>" class="acf-field-container">
				<div id="<?php echo $bg_img_animation_style_key; ?>-container" class="acf-field-container"></div>
			</div>
		</div>
	<?php } ?>	
	<?php if($eyebrow || $heading || $content || $cta) { ?>
		<div class="container">
			<div class="block-content-container">
				<?php if($eyebrow) { ?>
					<h3 id="<?php echo $aria_label; ?>" class="eyebrow lazy fade-in-down slow delay-one-quarter">
						<div id="<?php echo $eyebrow_key; ?>-container" data-field-label="<?php echo $eyebrow_label; ?>" class="acf-field-container"></div>
						<?php echo $eyebrow; ?>
					</h3>
				<?php } ?>	
				<?php if($heading) { ?>
					<?php if($block_count == 0) { ?>
						<h1 class="lazy fade-in-down delay-one-quarter"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>
							<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container"></div>
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
			</div>
			<?php if(have_rows('links')) { ?>
				<div class="card-links-container">
					<?php if($link_card_heading) { ?>
						<div id="<?php echo $link_card_heading_key; ?>-container" data-field-label="<?php echo $link_card_heading_label; ?>" class="acf-field-container"></div>
						<h3 class="eyebrow lazy fade-in-down slow delay-one-quarter"><?php echo $link_card_heading; ?></h3>
					<?php } ?>
					<div class="card-links lazy fade-in-right">
						<?php while(have_rows('links')) { ?>
							<?php the_row(); ?>
							<?php $link_key = get_sub_field_object('link')['key']; ?>
							<?php $link_label = get_sub_field_object('link')['label']; ?>
							<?php $link = get_sub_field('link'); ?>
							<?php if($link) { ?>
								<div class="link lazy fade-in delay-one-quarter">
									<div id="<?php echo $link_key; ?>-container" data-field-label="<?php echo $link_label; ?>" class="acf-field-container"></div>
	<!--								<a href="<?php //echo $link['url']; ?>" target="<?php //echo $link['target']; ?>"><?php //echo $link['title']; ?></a>	-->
										<div class="link-content"><?php echo $link['title']; ?></div>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</section>