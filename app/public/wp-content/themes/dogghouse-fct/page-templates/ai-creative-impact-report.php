<?php
/**
 * Standalone vanity page: AI Creative Impact Report PDF (embed + download).
 * Loaded via template_redirect when query var dogghouse_ai_impact_report is set.
 *
 * @package dogghouse_fct
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$pdf_url  = get_template_directory_uri() . '/assets/files/2026-ai-creative-impact-report.pdf';
$pdf_path = get_template_directory() . '/assets/files/2026-ai-creative-impact-report.pdf';
$dl_name  = '2026-ai-creative-impact-report.pdf';

if ( ! is_readable( $pdf_path ) ) {
	status_header( 404 );
	wp_die( esc_html__( 'PDF file not found.', 'dogghouse_fct' ), '', array( 'response' => 404 ) );
}

status_header( 200 );
header( 'X-Robots-Tag: noindex, nofollow', true );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo esc_html( get_bloginfo( 'name' ) . ' — 2026 AI Creative Impact Report' ); ?></title>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=GT-MJMC57T"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'GT-MJMC57T');
	</script>
	<style>
		* { box-sizing: border-box; }
		body { margin: 0; font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif; background: #1a1a1a; color: #f5f5f5; }
		.pdf-frame {
			display: block;
			width: 100%;
			height: calc(100vh - 52px);
			border: 0;
			background: #2a2a2a;
		}
		.download-bar {
			position: fixed;
			bottom: 0;
			left: 0;
			right: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 1rem;
			min-height: 52px;
			padding: 0.5rem 1rem;
			background: #111;
			border-top: 1px solid #333;
			z-index: 10;
		}
		.download-bar a {
			color: #fff;
			font-weight: 600;
			text-decoration: none;
			padding: 0.35rem 1rem;
			background: #2563eb;
			border-radius: 6px;
		}
		.download-bar a:hover,
		.download-bar a:focus { background: #1d4ed8; }
		.download-bar a:focus { outline: 2px solid #93c5fd; outline-offset: 2px; }
	</style>
</head>
<body>
	<iframe
		class="pdf-frame"
		src="<?php echo esc_url( $pdf_url ); ?>#view=Fit"
		title="<?php esc_attr_e( '2026 AI Creative Impact Report', 'dogghouse_fct' ); ?>"
	></iframe>
	<div class="download-bar">
		<a href="<?php echo esc_url( $pdf_url ); ?>" download="<?php echo esc_attr( $dl_name ); ?>">
			<?php esc_html_e( 'Download PDF', 'dogghouse_fct' ); ?>
		</a>
	</div>
</body>
</html>
