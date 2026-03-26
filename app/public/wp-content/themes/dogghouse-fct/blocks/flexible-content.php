<?php 
global $block_count; 
global $fcb_field_key;
$block_count = 0;

if(have_rows('flexible_content_blocks')) {  
	$fcb_field_key = get_field_object('flexible_content_blocks')['key'];
	while(have_rows('flexible_content_blocks')) {
		the_row();
    if(get_row_layout() == 'hero_block' ) {
    	get_template_part( 'blocks/hero' );
		} elseif(get_row_layout() == 'image_and_content_block' ) {
      get_template_part( 'blocks/image-and-content' );
		} elseif(get_row_layout() == 'link_card_with_content_block' ) {
      get_template_part( 'blocks/link-card' );
		} elseif(get_row_layout() == 'our_partners_block' ) {
      get_template_part( 'blocks/our-partners' );
		} elseif(get_row_layout() == 'full-width_text_block' ) {
      get_template_part( 'blocks/full-width-text' );
		} elseif(get_row_layout() == 'two_column_cta_block' ) {
      get_template_part( 'blocks/two-column' );
		} elseif(get_row_layout() == 'vertical_slider_block' ) {
      get_template_part( 'blocks/vertical-slider-2' );
		} elseif(get_row_layout() == 'horizontal_carousel_block' ) {
      get_template_part( 'blocks/horizontal-carousel' );
		} elseif(get_row_layout() == 'highlight_bricks_block' ) {
      get_template_part( 'blocks/highlight-bricks' );
		} elseif(get_row_layout() == 'testimonial_slider_block' ) {
      get_template_part( 'blocks/testimonial-slider' );
		} elseif(get_row_layout() == 'contact_form_block' ) {
      get_template_part( 'blocks/contact-form-block' );
		}
		$block_count++;
	}
} ?>

<div class="clear"></div>