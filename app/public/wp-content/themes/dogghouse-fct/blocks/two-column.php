<?php global $block_count; ?>

<?php
	$column_1_background_color_key = get_sub_field_object('column_1_background_color_toggle')['key'];
	$column_1_background_color_label = get_sub_field_object('column_1_background_color_toggle')['label'];
	$column_1_background_color = get_sub_field('column_1_background_color_toggle');
	$column_1_text_color_key = get_sub_field_object('column_1_text_color_toggle')['key'];
	$column_1_text_color_label = get_sub_field_object('column_1_text_color_toggle')['value'];
	$column_1_text_color = get_sub_field('column_1_text_color_toggle');
	$column_1_eyebrow_key = get_sub_field_object('column_1_eyebrow')['key'];
	$column_1_eyebrow_label = get_sub_field_object('column_1_eyebrow')['label'];
	$column_1_eyebrow = get_sub_field('column_1_eyebrow');
	$column_1_heading_key = get_sub_field_object('column_1_heading')['key'];
	$column_1_heading_label = get_sub_field_object('column_1_heading')['label'];
	$column_1_heading = get_sub_field('column_1_heading');
	$column_1_content_key = get_sub_field_object('column_1_content')['key'];
	$column_1_content_label = get_sub_field_object('column_1_content')['label'];
	$column_1_content = get_sub_field('column_1_content');
	$column_1_cta_key = get_sub_field_object('column_1_cta')['key'];
	$column_1_cta_label = get_sub_field_object('column_1_cta')['label'];
	$column_1_cta = get_sub_field('column_1_cta');
	$column_1_cta_class_key = get_sub_field_object('column_1_cta_class')['key'];
	$column_1_cta_class = get_sub_field('column_1_cta_class');
	$column_2_background_color_key = get_sub_field_object('column_2_background_color_toggle')['key'];
	$column_2_background_color_label = get_sub_field_object('column_2_background_color_toggle')['label'];
	$column_2_background_color = get_sub_field('column_2_background_color_toggle');
	$column_2_text_color_key = get_sub_field_object('column_2_text_color_toggle')['key'];
	$column_2_text_color_label = get_sub_field_object('column_2_text_color_toggle')['label'];
	$column_2_text_color = get_sub_field('column_2_text_color_toggle');
	$column_2_eyebrow_key = get_sub_field_object('column_2_eyebrow')['key'];
	$column_2_eyebrow_label = get_sub_field_object('column_2_eyebrow')['label'];
	$column_2_eyebrow = get_sub_field('column_2_eyebrow');
	$column_2_heading_key = get_sub_field_object('column_2_heading')['key'];	
	$column_2_heading_label = get_sub_field_object('column_2_heading')['label'];	
	$column_2_heading = get_sub_field('column_2_heading');
	$column_2_content_key = get_sub_field_object('column_2_content')['key'];
	$column_2_content_label = get_sub_field_object('column_2_content')['label'];
	$column_2_content = get_sub_field('column_2_content');
	$column_2_cta_key = get_sub_field_object('column_2_cta')['key'];
	$column_2_cta_label = get_sub_field_object('column_2_cta')['label'];
	$column_2_cta = get_sub_field('column_2_cta');
	$column_2_cta_key = get_sub_field_object('column_2_cta_class')['key'];
	$column_2_cta_class = get_sub_field('column_2_cta_class');
	$column_1_aria_label = '';
	if($column_1_eyebrow) {
		$column_1_aria_label = $column_1_eyebrow;
	} else if($column_1_heading) {
		$column_1_aria_label = $column_1_heading;
	} else {
		$column_1_aria_label = get_the_title();
	}
	$column_1_aria_label = strip_tags(str_replace(' ', '-', strtolower($column_1_aria_label)));
	$column_1_aria_label = preg_replace('/(?![-])\p{P}/u', '', $column_1_aria_label); 

	$column_2_aria_label = '';
	if($column_2_eyebrow) {
		$column_2_aria_label = $column_2_eyebrow;
	} else if($column_2_heading) {
		$column_2_aria_label = $column_2_heading;
	} else {
		$column_2_aria_label = get_the_title();
	}
	$column_2_aria_label = strip_tags(str_replace(' ', '-', strtolower($column_2_aria_label)));
	$column_2_aria_label = preg_replace('/(?![-])\p{P}/u', '', $column_2_aria_label); 
?>

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block two-column-cta reveal">
	<?php if($column_1_eyebrow || $column_1_heading || $column_1_content || $column_1_cta) { ?>
		<div class="column-1 background-<?php echo $column_1_background_color; ?> text-<?php echo $column_1_text_color; ?>">
			<div id="<?php echo $column_1_background_color_key; ?>-container" data-field-label="<?php echo $column_1_background_color_label; ?>" class="acf-field-container"></div>
			<div id="<?php echo $column_1_text_color_key; ?>-container" data-field-label="<?php echo $column_1_text_color_label; ?>" class="acf-field-container"></div>
			<div class="container">
				<?php if($column_1_eyebrow) { ?>
					<h3 id="<?php echo $column_1_aria_label; ?>" class="eyebrow">
						<div id="<?php echo $column_1_eyebrow_key; ?>-container" data-field-label="<?php echo $column_1_eyebrow_label; ?>" class="acf-field-container"></div>
						<?php echo $column_1_eyebrow; ?>
					</h3>
				<?php } ?>	
				<?php if($column_1_heading) { ?>
					<h2<?php if(!$column_1_eyebrow) { echo ' id="'.$column_1_aria_label.'"'; } ?>>
						<div id="<?php echo $column_1_heading_key; ?>-container" data-field-label="<?php echo $column_1_heading_label; ?>" class="acf-field-container"></div>
						<?php echo $column_1_heading; ?>
					</h2>
				<?php } ?>
				<?php if($column_1_content) { ?>
					<div class="block-content">
						<div id="<?php echo $column_1_content_key; ?>-container" data-field-label="<?php echo $column_1_content_label; ?>" class="acf-field-container"></div>
						<?php echo $column_1_content; ?>
					</div>
				<?php } ?>
				<?php if($column_1_cta) { ?>
					<div class="cta">
						<div id="<?php echo $column_1_cta_key; ?>-container" data-field-label="<?php echo $column_1_cta_label; ?>" class="acf-field-container">
							<div id="<?php echo $column_1_cta_class_key; ?>-container" class="acf-field-container"></div>
						</div>
						<a class="button <?php echo $column_1_cta_class; ?>" href="<?php echo $column_1_cta['url']; ?>" target="<?php echo $column_1_cta['target']; ?>"><?php echo $column_1_cta['title']; ?></a>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	<?php if($column_2_eyebrow || $column_2_heading || $column_2_content || $column_2_cta) { ?>
		<div class="column-2 background-<?php echo $column_2_background_color; ?> text-<?php echo $column_2_text_color; ?>">
			<div id="<?php echo $column_2_background_color_key; ?>-container" data-field-label="<?php echo $column_2_background_color_label; ?>" class="acf-field-container"></div>
			<div id="<?php echo $column_2_text_color_key; ?>-container" data-field-label="<?php echo $column_2_text_color_label; ?>" class="acf-field-container"></div>
			<div class="container">
				<?php if($column_2_eyebrow) { ?>
					<h3 id="<?php echo $column_2_aria_label; ?>" class="eyebrow">
						<div id="<?php echo $column_2_eyebrow_key; ?>-container" data-field-label="<?php echo $column_2_eyebrow_label; ?>" class="acf-field-container"></div>
						<?php echo $column_2_eyebrow; ?>
					</h3>
				<?php } ?>	
				<?php if($column_2_heading) { ?>
					<h2<?php if(!$column_2_eyebrow) { echo ' id="'.$column_2_aria_label.'"'; } ?>>
						<div id="<?php echo $column_2_heading_key; ?>-container" data-field-label="<?php echo $column_2_heading_label; ?>" class="acf-field-container"></div>
						<?php echo $column_2_heading; ?>
					</h2>
				<?php } ?>
				<?php if($column_2_content) { ?>
					<div class="block-content">
						<div id="<?php echo $column_2_content_key; ?>-container" data-field-label="<?php echo $column_2_content_label; ?>" class="acf-field-container"></div>
						<?php echo $column_2_content; ?>
					</div>
				<?php } ?>
				<?php if($column_2_cta) { ?>
					<div class="cta">
						<div id="<?php echo $column_2_cta_key; ?>-container" data-field-label="<?php echo $column_2_cta_label; ?>" class="acf-field-container">
							<div id="<?php echo $column_2_cta_class_key; ?>-container" class="acf-field-container"></div>
						</div>
						<a class="button <?php echo $column_2_cta_class; ?>" href="<?php echo $column_2_cta['url']; ?>" target="<?php echo $column_2_cta['target']; ?>"><?php echo $column_2_cta['title']; ?></a>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
</section>