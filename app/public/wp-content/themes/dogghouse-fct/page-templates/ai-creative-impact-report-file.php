<?php
/**
 * AI Creative Impact Report — lead capture landing (Typeform).
 * Vanity URL: /AI-creative-impact-report-file
 *
 *
 * @package dogghouse_fct
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();
$assets    = $theme_uri . '/assets/images';

$theme_colors = function_exists( 'dogghouse_fct_get_theme_colors' ) ? dogghouse_fct_get_theme_colors() : array();
$typeform_accent_key = apply_filters( 'dogghouse_fct_ai_landing_typeform_accent_color', 'tertiary' );
$typeform_accent_hex = isset( $theme_colors[ $typeform_accent_key ] ) ? $theme_colors[ $typeform_accent_key ] : ( $theme_colors['tertiary'] ?? '#477982' );

status_header( 200 );
header( 'X-Robots-Tag: noindex, nofollow', true );
?>
<!DOCTYPE html>
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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
	<style>
		:root {
			<?php foreach ( $theme_colors as $slug => $hex ) : ?>
			--theme-<?php echo esc_attr( $slug ); ?>: <?php echo esc_attr( $hex ); ?>;
			<?php endforeach; ?>
			--theme-typeform-accent: <?php echo esc_attr( $typeform_accent_hex ); ?>;
		}
		/* Mirrors scss/style.scss utility colors using Theme Options (runtime), not compiled SCSS. */
		.text-primary { color: var(--theme-primary); }
		.text-secondary { color: var(--theme-secondary); }
		.text-tertiary { color: var(--theme-tertiary); }
		.text-quaternary { color: var(--theme-quaternary); }
		.text-quinary { color: var(--theme-quinary); }
		.text-senary { color: var(--theme-senary); }
		.text-septenary { color: var(--theme-septenary); }
		.text-octonary { color: var(--theme-octonary); }
		.text-nonary { color: var(--theme-nonary); }
		.text-denary { color: var(--theme-denary); }
		.text-eleven { color: var(--theme-eleven); }
		.text-twelve { color: var(--theme-twelve); }
		.text-light-gray,
		.text-med-gray,
		.text-dark-gray { color: var(--theme-gray); }
		.text-white { color: #fff; }
		.text-black { color: #000; }
		.background-primary { background-color: var(--theme-primary); }
		.background-secondary { background-color: var(--theme-secondary); }
		.background-tertiary { background-color: var(--theme-tertiary); }
		.background-quaternary { background-color: var(--theme-quaternary); }
		.background-quinary { background-color: var(--theme-quinary); }
		.background-senary { background-color: var(--theme-senary); }
		.background-septenary { background-color: var(--theme-septenary); }
		.background-octonary { background-color: var(--theme-octonary); }
		.background-nonary { background-color: var(--theme-nonary); }
		.background-denary { background-color: var(--theme-denary); }
		.background-eleven { background-color: var(--theme-eleven); }
		.background-twelve { background-color: var(--theme-twelve); }
		.background-gray { background-color: var(--theme-gray); }
		.background-white { background-color: #fff; }
		.background-black { background-color: #000; }
		* { box-sizing: border-box; }
		/*
		 * Typeform embed.js may set overflow:hidden on html/body (e.g. inline/mobile embed).
		 * Keep the host page scrollable so content below the fold isn’t trapped.
		 */
		html {
			overflow-x: hidden;
			overflow-y: auto !important;
		}
		body.ai-landing-body {
			margin: 0;
			min-height: 100vh;
			overflow-x: hidden;
			overflow-y: auto !important;
			display: flex;
			flex-direction: column;
			font-family: 'Montserrat', system-ui, -apple-system, sans-serif;
			color: var(--theme-secondary);
			background-color: #fff;
			background-image: url('<?php echo esc_url( $assets . '/blur-bg.png' ); ?>');
			background-repeat: no-repeat;
			background-position: center 20%;
			background-size: min(1200px, 100%) auto;
		}
		.ai-landing-header {
			padding: 1.25rem 1.5rem 0;
			max-width: 1200px;
			margin: 0 auto;
		}
		.ai-landing-header .custom-logo-link {
			display: inline-block;
			line-height: 0;
		}
		.ai-landing-header img,
		.ai-landing-header .custom-logo-link img {
			max-height: 48px;
			width: auto;
			height: auto;
		}
		.ai-landing-main {
			width: 90vw;
			margin: 0 auto;
			padding: 3rem 0;
			flex: 1 1 auto;
		}
		.ai-landing-grid {
			display: grid;
			grid-template-columns: 1fr minmax(0, 460px);
			gap: 2.5rem 3rem;
			align-items: start;
		}
		.ai-landing-left {
			display: flex;
			flex-direction: column;
			min-height: 0;
			min-width: 0;
		}
		.ai-landing-right {
			display: flex;
			flex-direction: column;
			min-height: 0;
			width: 100%;
		}
		.ai-landing-hero h1 {
			margin: 0 0 1rem;
			font-size: clamp(3rem, 2.5683rem + 2.1583vw, 4.5rem);
			font-weight: 800;
			line-height: 1.15;
		}
		.ai-landing-hero .lead {
			margin: 0 0 1.25rem;
			font-size: 1rem;
			line-height: 1.65;
		}
		.ai-landing-hero .bullets-intro {
			margin: 0 0 0.5rem;
			font-weight: 600;
			font-size: 0.95rem;
		}
		.ai-landing-hero ul {
			margin: 0;
			padding-left: 1.15rem;
		}
		.ai-landing-hero li {
			margin-bottom: 0.65rem;
			font-weight: 700;
			line-height: 1.45;
		}
		.ai-landing-mockup {
			margin-top: 1.75rem;
		}
		.ai-landing-mockup img {
			display: block;
			width: 100%;
			max-width: 650px;
			height: auto;
		}
		.ai-landing-card {
			background: #fff;
			border: 1px solid var(--theme-senary);
			border-radius: 24px;
			overflow: hidden;
			box-shadow: 0 4px 24px rgba(15, 31, 58, 0.06);
			position: relative;
			z-index: 1;
			isolation: isolate;
			display: flex;
			flex-direction: column;
			width: 100%;
		}
		.ai-landing-card__bar {
			color: #fff;
			text-align: center;
			font-size: 16px;
			font-weight: 400;
			text-transform: none;
			letter-spacing: normal;
			padding: 0.75rem 1rem;
			margin: 0;
		}
		/* Match measured Typeform embed height (~680px) so the slot and iframe don’t fight auto-resize. */
		.ai-landing-typeform {
			position: relative;
			width: 100%;
			min-height: 680px;
			flex-shrink: 0;
			display: block;
			overflow: visible;
		}
		.ai-landing-typeform > iframe {
			display: block;
			width: 100% !important;
			max-width: 100% !important;
			min-height: 658px;
			border: 0;
		}
		.bullets-inline-with-image {
			display: flex;
			gap: 2em;
			align-items: center;
		}
		.bullets-inline-with-image ul {
			color: var(--theme-twelve);
			font-size: 1.2rem;
			margin-top: 1em;
		}
		.bullets-inline-with-image ul li {
			margin-bottom: 1.5em;
		}
		@media (max-width: 1432px) {
			.ai-landing-hero h1 {
				font-size: 3.75rem;
			}
		}
		@media (max-width: 1243px) {
			.ai-landing-hero h1 {
				font-size: 3rem;
			}
			.bullets-inline-with-image ul {
				font-size: 0.875rem;
			}
		}
		@media (max-width: 1107px) {
			.ai-landing-hero h1 {
				font-size: 2.5rem;
			}
		}
		@media (max-width: 1023px) {
			.ai-landing-grid {
				grid-template-columns: 1fr;
			}
		}
		@media (max-width: 767px) {
			.bullets-inline-with-image {
				flex-direction: column;
			}
			.ai-landing-mockup {
				max-width: none !important;
				width: 100% !important;
				margin-top: -1em;
			}
		}
	</style>
</head>
<body class="ai-landing-body"<?php echo ! empty( $theme_colors ) ? ' data-dogghouse-theme-colors="' . esc_attr( wp_json_encode( $theme_colors ) ) . '"' : ''; ?>>
	<header class="ai-landing-header" role="banner">
		<div class="ai-landing-logo">
			<?php
			if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Core returns full escaped markup.
				echo get_custom_logo();
			} else {
				printf(
					'<a class="custom-logo-link" href="%s" rel="home"><img src="%s" alt="%s" width="200" height="48" /></a>',
					esc_url( home_url( '/' ) ),
					esc_url( $theme_uri . '/assets/images/logo.png' ),
					esc_attr( get_bloginfo( 'name' ) )
				);
			}
			?>
		</div>
	</header>

	<main class="ai-landing-main" id="main">
		<div class="ai-landing-grid">
			<div class="ai-landing-left">
				<div class="ai-landing-hero">
					<h1 class="ai-landing-hero-title">
						<span class="text-twelve">AI is Changing</span><br />
						<span class="text-quinary">Creative Work</span> <span class="text-eleven">Fast</span>
					</h1>
					<p class="lead text-twelve" style="font-size: 1.3rem; margin-top: 2em;">
					AI adoption isn't just a tools problem. It's a team and workflow problem. The AI Creative Impact Report is built for creative and marketing leaders and shows where teams get stuck and what helps them move forward.
					</p>
					<div class="bullets-inline-with-image">
						<div>
							<p class="bullets-intro text-eleven" style="margin: 3em 0 2em;">Inside, you&rsquo;ll find perspective on:</p>
							<ul>
								<li>Where your team compares to others</li>
								<li>What's working, what's stuck, and why</li>
								<li>Real-world insights from leaders and creative talent</li>
							</ul>
						</div>
						<div class="ai-landing-mockup" style="flex-shrink: 0; max-width: 650px; width: 60%;">
							<img
								src="<?php echo esc_url( $assets . '/report-mockup.png' ); ?>"
								alt=""
								loading="lazy"
								decoding="async"
							/>
						</div>
					</div>
				</div>
			</div>

			<div class="ai-landing-right">
				<div class="ai-landing-card">
					<h2 class="ai-landing-card__bar background-twelve">Free Resource</h2>
					<div
						class="ai-landing-typeform"
						id="ai-landing-typeform"
						data-tf-live="01KMK8CJ1FNW6J1DKCRJNB7H8G"
						data-tf-inline-on-mobile
						data-tf-auto-resize="480,1200"
						data-tf-hide-headers
					></div>
				</div>
			</div>
		</div>
	</main>

	<script src="https://embed.typeform.com/next/embed.js"></script>
	<?php if ( ! empty( $theme_colors ) ) : ?>
	<script type="application/json" id="dogghouse-theme-colors-json"><?php echo esc_html( wp_json_encode( $theme_colors ) ); ?></script>
	<?php endif; ?>
	<!--
		Typeform embed: the form document is a cross-origin iframe. Parent CSS cannot target inner wrappers.
		Apply typography and colors in Typeform (Design / theme / Custom CSS on your plan). Use the same hex as Theme Options:
		Subtitle accent (filter: dogghouse_fct_ai_landing_typeform_accent_color, default slot: tertiary): <?php echo esc_html( $typeform_accent_hex ); ?>

		Example (adjust selectors with DevTools on the iframe; Typeform updates class names occasionally):
		h1 { font-size: clamp(1.5rem, 1.2706rem + 1.1472vw, 2.25rem) !important; font-weight: 800 !important; }
		p { color: <?php echo esc_html( $typeform_accent_hex ); ?> !important; }
	-->
</body>
</html>
