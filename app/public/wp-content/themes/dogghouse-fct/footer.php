<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

			<footer id="site-footer" class="flexible-content-block footer">
				<div class="container">
					<div class="footer-left site-info">
						<div class="site-branding">
							<div class="footer-logo" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/footer-logo.svg);">
								<a href="<?php echo home_url(); ?>"></a>
							</div>
						</div>
						<?php if(is_active_sidebar('sidebar-1')) { ?>
							<div class="footer-widget-area">
								<?php dynamic_sidebar( 'sidebar-1' ); ?>
							</div>
						<?php } ?>
					</div>
					<div class="footer-center footer-nav-container">
						<?php if(is_active_sidebar('sidebar-2')) { ?>
							<div class="footer-widget-area">
								<?php dynamic_sidebar( 'sidebar-2' ); ?>
							</div>
						<?php } ?>
					</div>
					<div
						</a>
					</div>
					<div class="footer-right footer-social-container">
						<?php if(is_active_sidebar('sidebar-3')) { ?>
							<div class="footer-widget-area">
								<?php dynamic_sidebar( 'sidebar-3' ); ?>
							</div>
						<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
			</footer>

			<?php wp_footer(); ?>
			<div class="clear"></div>
		</main><!-- #main -->
	</body>
</html>
