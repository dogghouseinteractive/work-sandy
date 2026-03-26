<?php 
	$frontend_editor = (!isset($_GET['frontend_editor']) || $_GET['frontend_editor'] != 'true' ? false : true); 
	$block_anchor = (isset($_GET['block_id']) ? $_GET['block_id'] : '');
?>

<?php if(current_user_can('administrator') && $frontend_editor) { ?>
	<style type="text/css">
		a.frontend-edit-link {
			display: block;
		}
	</style>
	<div class="container">
		<div id="acf-frontend-edit-form">
			<?php ob_start(); ?>
			<input type='hidden' name='current_block' value=''>
			<?php $html_before_fields = ob_get_clean(); ?>
			<?php
				$settings = array(
					'html_before_fields' => $html_before_fields,
				);																											 
			?>
			<?php acf_form($settings); ?>
		</div>
		<div class="clear"></div>
	</div>

	<script type="text/javascript">
			jQuery(document).ready(function() {
				
				// Don't lazy load the elements when the frontend editor is active
				jQuery(document).find('*').removeClass('lazy');
				
				// If the frontend edit form is displaying a message, pull it out of the form itself, and display it on the page instead
				var frontendEditMsg = '';
				if(jQuery('#acf-frontend-edit-form #message').length > 0) {
					frontendEditMsg = jQuery('#acf-frontend-edit-form #message').html();
				}
				if(frontendEditMsg.length > 0) {
					jQuery('#acf-frontend-edit-form #message').remove();
					jQuery('body').append('<div id="frontend-edit-messaging"><div class="container">' + frontendEditMsg + '<span class="headingfont ellipsis-holder">Stand by <i class="ellipsis"></i></span></div></div>');
				}
				
				// If you just updated a block, scroll to it after the page refreshes
				<?php if($block_anchor) { ?>
					jQuery('body').imagesLoaded({background: true }, function() {
						setTimeout(function() {
							var headerHeight = jQuery('header.shrink').outerHeight();
							var blockAnchorPos = jQuery('#<?php echo $_GET['block_id']; ?>').offset().top;
							if(jQuery('body').hasClass('admin-bar')) {
								blockAnchorPos = Math.floor(blockAnchorPos - headerHeight - 32);
							} else {
								blockAnchorPos = Math.floor(blockAnchorPos - headerHeight);
							}
							jQuery('html, body').animate({
								scrollTop : blockAnchorPos,
							}, 500);
							// Close the frontend messaging display after the page scrolls
						jQuery('#frontend-edit-messaging').fadeOut(250);
						return false;
						}, 5000);
					});
				<?php } ?>
				
        let repeaterPattern = /field_(.+)\-row\-(\d+)-field_(.+)/;
        let fcbRepeaterPattern = /field_(.+)\-row\-(\d+)-field_(.+)\-row\-(\d+)-field_(.+)/;

				jQuery('.acf-field-container').each(function() {
					let containerID = jQuery(this).attr('ID');
					let fieldID = containerID.replace('-container', '');
					let repeaterInputName = fieldID.replace(repeaterPattern, 'acf[field_$1][row-$2][field_$3]');
					let fcbRepeaterInputName = fieldID.replace(fcbRepeaterPattern, 'acf[field_$1][row-$2][field_$3][row-$4][field_$5]');
					let fieldLabel = jQuery(this).attr('data-field-label');
          let adminEditLink = '<a id="' + fieldID + '-edit-link" class="frontend-edit-link ' + fieldID + '-edit-link" data-fancybox data-src="#acf-frontend-edit-form">Edit ' + fieldLabel + '</a>';

					if(jQuery(this).find('.frontend-edit-link').length !== 0) { return false; } 
          else { jQuery(this).prepend(adminEditLink); }
					
					jQuery(document).on('click', '#' + fieldID + '-edit-link', function() {
						
            // Grab the ID of the parent block of the element being clicked,
            // and convert it into its corresponding, ACF Form field data
            // attribute (you'll see why later)
						let currentBlockNum = jQuery(this).closest('section').attr('ID').split('-')[1];
            let currentRow = "row-" + currentBlockNum;
						
						jQuery('input[name="current_block"]').val('block-' + currentBlockNum);

						// Check for any existing, active classes and if there are any, remove them
            jQuery('#acf-form *').removeClass('active')
						
            // Add 'active' class to all elements required to display individual acf_form fields appropriately
						
						// Standard ACF Fields (not flexible content, but including standard repeaters)
            jQuery('.acf-field[data-key="' + fieldID + '"]').addClass('active');

            let repeater = jQuery('.acf-field-repeater #acf-' + fieldID);
						jQuery('.acf-field-repeater #acf-' + fieldID).closest('.acf-field').addClass('active');
						jQuery('.acf-field-repeater #acf-' + fieldID).closest('.acf-field-repeater').addClass('active');
						jQuery('.acf-field-repeater #acf-' + fieldID).parentsUntil('tbody').addClass('active');
						
						// ACF Flexible Content Repeater Fields (which already have their corresponding row IDs associated)
						jQuery('input[name="' + repeaterInputName + '"]').parentsUntil('tbody').addClass('active');
						jQuery('input[name="' + repeaterInputName + '"]').closest('.acf-field-repeater').addClass('active');
						jQuery('input[name="' + fcbRepeaterInputName + '"]').parentsUntil('.acf-form-fields').addClass('active');
						jQuery('textarea[name="' + fcbRepeaterInputName + '"]').parentsUntil('.acf-form-fields').addClass('active');
						
            // Allow for the targeting of fields from only one flexible content
            // block at a time if there are multiples of the same type on the
            // same page

            let matchingFields = jQuery( '.acf-field[data-key=' + fieldID + ']' );
//						console.log( currentRow );
//            console.log( matchingFields.length );
//						console.log( fieldID );

            if( jQuery('.acf-field[data-key="' + fieldID + '"] .values .layout[data-id=' + currentRow + ']') )
            {
							// ACF Flexible Content Fields (not repeaters therewithin)
							jQuery('.acf-field-flexible-content .acf-flexible-content .values .layout[data-id="' + currentRow + '"] .acf-fields .acf-field[data-key="' + fieldID + '"]').addClass('active');
							jQuery('.acf-field-flexible-content .acf-flexible-content .values .layout[data-id="' + currentRow + '"] .acf-fields .acf-field[data-key="' + fieldID + '"]').parentsUntil('.acf-form-fields').addClass('active');
						}
						
            // Don't forget to target any nested edit elements
						
						// Check for a nested edit link (as would be the case for video thumbs in a gallery block)
						let nestedInputName = '';
						if(jQuery('#' + fieldID + '-edit-link').parent('.acf-field-container').children('.acf-field-container').children('a').length > 0) {
							jQuery('#' + fieldID + '-edit-link').parent('.acf-field-container').children('.acf-field-container').each(function() {
								let currentChildID = jQuery(this).attr('id');
								let nestedField = jQuery('#' + currentChildID).children('a').attr('ID');
								let nestedFieldID = nestedField.replace('-edit-link', '');
								nestedInputName = nestedFieldID.replace(fcbRepeaterPattern, 'acf[field_$1][row-$2][field_$3][row-$4][field_$5]');

								// Standard ACF Fields (not flexible content, but including standard repeaters)
								jQuery('.acf-field[data-key="' + nestedFieldID + '"]').addClass('active');
								jQuery('.acf-field-repeater #acf-' + nestedFieldID).closest('.acf-field').addClass('active');
								jQuery('.acf-field-repeater #acf-' + nestedFieldID).closest('.acf-field-repeater').addClass('active');
								jQuery('.acf-field-repeater #acf-' + nestedFieldID).parentsUntil('tbody').addClass('active');

								// ACF Flexible Content Fields
								jQuery('input[name="' + nestedInputName + '"]').parentsUntil('.acf-form-fields').addClass('active');
								jQuery('textarea[name="' + nestedInputName + '"]').parentsUntil('.acf-form-fields').addClass('active');		

                // Allow for the targeting of fields from only one flexible
                // content block at a time if there are multiples of the same
                // type on the same page
								if(jQuery('.acf-field[data-key="' + fieldID + '"]').closest('.layout:not(.acf-clone)').attr('data-id') == currentRow ) {
									// ACF Flexible Content Fields (not repeaters therewithin)
									jQuery('.acf-field-flexible-content .acf-flexible-content .values .layout[data-id="' + currentRow + '"] .acf-fields .acf-field[data-key="' + nestedFieldID + '"]').addClass('active');
									jQuery('.acf-field-flexible-content .acf-flexible-content .values .layout[data-id="' + currentRow + '"] .acf-fields .acf-field[data-key="' + nestedFieldID + '"]').parentsUntil('.acf-form-fields').addClass('active');
								}
							});
						}
						
					});
				});

				// Disable TinyMCE, and re-enable it to prevent the content from disappearing
				jQuery.extend(jQuery.fancybox.defaults, {
					beforeShow: function() {
						tinymce.remove();
						setTimeout(function() {
							tinymce.init({
								mode : "specific_textareas",
								theme : "simple", 
								editor_selector : "tinymce-enabled",
							});
							jQuery('button.switch-html').click();
						}, 250);
					}
				});

			});
		
	</script>
<?php } ?>