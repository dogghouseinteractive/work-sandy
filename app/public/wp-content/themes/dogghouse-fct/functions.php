<?php
/**
 * Dogghouse FCT functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Dogghouse_FCT
 * @since 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dogghouse_fct_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/dogghouse_fct
	 * If you're building a theme based on Dogghouse FCT, use a find and replace
	 * to change 'dogghouse_fct' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dogghouse_fct' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'dogghouse_fct' ),
		'social' => __( 'Social Links Menu', 'dogghouse_fct' ),
		'footer' => __( 'Footer Menu', 'dogghouse_fct' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}
add_action( 'after_setup_theme', 'dogghouse_fct_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dogghouse_fct_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'dogghouse_fct' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your footer, on the left.', 'dogghouse_fct' ),
		'before_widget' => '<section id="footer-%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Center', 'dogghouse_fct' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer, in the middle.', 'dogghouse_fct' ),
		'before_widget' => '<section id="footer-%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Right', 'dogghouse_fct' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer, on the right.', 'dogghouse_fct' ),
		'before_widget' => '<section id="footer-%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dogghouse_fct_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Dogghouse FCT 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function dogghouse_fct_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dogghouse_fct' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'dogghouse_fct_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Dogghouse FCT 1.0
 */
function dogghouse_fct_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'dogghouse_fct_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function dogghouse_fct_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'dogghouse_fct_pingback_header' );


/**
 * Enqueue scripts and styles.
 */
function dogghouse_fct_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( 'dogghouse_fct-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Begin Custom Enqueues */
    
  /* jQuery Cycle2 */    
  wp_enqueue_script( 'jquery-cycle', get_template_directory_uri() . '/assets/js/jquery.cycle2.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* jQuery Cycle2 Carousel */
  wp_enqueue_script ( 'cycle-carousel', get_template_directory_uri() . '/assets/js/jquery.cycle2.carousel.min.js', array( 'jquery' ), date('YmdHis'), true );
	
	/* jQuery Cycle2 ScrollVert */
  wp_enqueue_script ( 'cycle-scroll-vert', get_template_directory_uri() . '/assets/js/jquery.cycle2.scrollVert.min.js', array( 'jquery' ), date('YmdHis'), true );
	
	/* jQuery Underscore */
  wp_enqueue_script ( 'underscore', get_template_directory_uri() . '/assets/js/underscore.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* jQuery ImagesLoaded */
  wp_enqueue_script ( 'images-loaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* jQuery Fancybox */
  wp_enqueue_script ( 'fancybox', get_template_directory_uri() . '/assets/js/fancybox/dist/jquery.fancybox.min.js', array( 'jquery' ), date('YmdHis'), true );
  wp_enqueue_script ( 'fancybox-media', get_template_directory_uri() . '/assets/js/fancybox/src/js/media.js', array( 'jquery' ), date('YmdHis'), true );
  wp_enqueue_style( 'fancy-style', get_template_directory_uri() . '/assets/js/fancybox/dist/jquery.fancybox.min.css', array(), date('YmdHis') );
    
  /* jQuery Stellar Parallax */
  wp_enqueue_script ( 'stellar-parallax', get_template_directory_uri() . '/assets/js/jquery.stellar.min.js' );
	
	/* LazyLoad.js */
  wp_enqueue_script ( 'lazyload', get_template_directory_uri() . '/assets/js/lazyload.min.js' );
	
  /* jQuery Masonry */
   wp_enqueue_script ( 'masonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* Fonts on Fonts on Fonts */
  wp_enqueue_style ( 'font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome-5.15.4/css/all.min.css' );    
    
  wp_enqueue_style ( 'ion-icons', get_template_directory_uri() . '/assets/fonts/ionicons-2.0.1/css/ionicons.min.css' ); 
	
	/* Theme Custom Fonts */
//	wp_enqueue_style ( 'font-grifter', get_template_directory_uri() . '/assets/fonts/Grifter/stylesheet.css' ); 
//	wp_enqueue_style ( 'font-nohemi', get_template_directory_uri() . '/assets/fonts/Nohemi/stylesheet.css' ); 
	
//	wp_enqueue_script('scroll-snap', get_template_directory_uri() . '/assets/js/scrollsnap-polyfill.bundled.js', array('jquery'), date('YmdHis'), true );
  
  wp_enqueue_script( 'site-functions', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), date('YmdHis'), true );

  wp_enqueue_script('jquery-tabs', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('jquery', 'jquery-ui-core') );
    
   wp_enqueue_style('jquery-ui-css', '//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css', array('jquery', 'jquery-ui-core') );
}
add_action( 'wp_enqueue_scripts', 'dogghouse_fct_scripts' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function dogghouse_fct_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'dogghouse_fct_front_page_template' );

/** 
 * Set SASS color vars with colorpicker fields from the ACF Options page 
 */
//define('WP_SCSS_ALWAYS_RECOMPILE', true);

add_filter( 'wp_scss_variables','wp_scss_set_variables' );

function wp_scss_set_variables() {
  $primary = get_field( 'primary_theme_color', 'option' ) ? : '#3F5563';
  $secondary = get_field( 'secondary_theme_color', 'option' ) ? : '#3D403F';
  $tertiary = get_field( 'tertiary_theme_color', 'option' ) ? : '#477982';
  $quaternary = get_field( 'quaternary_theme_color', 'option' ) ? : '#477982';
	$quinary = get_field( 'quinary_theme_color', 'option' ) ? : '#3F5563';
  $senary = get_field( 'senary_theme_color', 'option' ) ? : '#3D403F';
  $septenary = get_field( 'septenary_theme_color', 'option' ) ? : '#477982';
  $octonary = get_field( 'octonary_theme_color', 'option' ) ? : '#477982';
	$nonary = get_field( 'nonary_theme_color', 'option' ) ? : '#3F5563';
  $denary = get_field( 'denary_theme_color', 'option' ) ? : '#3D403F';
  $eleven = get_field( 'eleven_theme_color', 'option' ) ? : '#477982';
  $twelve = get_field( 'twelve_theme_color', 'option' ) ? : '#477982';
	$gray = get_field( 'gray_theme_color', 'option' ) ? : '#F6F6F6';
	$lightgray = get_field('lightgray_theme_color', 'option') ? : '#EDEDED';
	
	$mainfont = '';
	$headingfont = '';
    
	$variables = array(
		'primary' => $primary,
		'secondary' => $secondary,
		'tertiary' => $tertiary,
    'quaternary' => $quaternary,
		'quinary' => $quinary,
		'senary' => $senary,
		'septenary' => $septenary,
    'octonary' => $octonary,
		'nonary' => $nonary,
		'denary' => $denary,
		'eleven' => $eleven,
    'twelve' => $twelve,
		'palm' => $primary,
		'fern' => $secondary,
		'shoreline' => $tertiary,
    'soft-sand' => $quaternary,
		'dawn' => $quinary,
		'dusk' => $senary,
		'sea-foam' => $septenary,
    'red-sand' => $octonary,
		'surface-blue' => $nonary,
		'marine-blue' => $denary,
		'ultraviolet' => $eleven,
    'deep-sea' => $twelve,
		'gray' => $gray,
		'lightgray' => $lightgray,
		'mainfont' => $mainfont,
		'headingfont' => $headingfont,
	);
    return $variables;
}

/**
 * Create ACF Options Page for theme options
 */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

/* Colorize the color selector buttons in ACF FCB's */
add_filter( 'acf/load_field/type=button_group', 'modify_color_buttons' );           
function modify_color_buttons( $field )                                              
{                          
	$primary = get_field( 'primary_theme_color', 'option' ) ? : '#3F5563';
  $secondary = get_field( 'secondary_theme_color', 'option' ) ? : '#3D403F';
  $tertiary = get_field( 'tertiary_theme_color', 'option' ) ? : '#477982';
  $quaternary = get_field( 'quaternary_theme_color', 'option' ) ? : '#477982';
	$quinary = get_field( 'quinary_theme_color', 'option' ) ? : '#3F5563';
  $senary = get_field( 'senary_theme_color', 'option' ) ? : '#3D403F';
  $septenary = get_field( 'septenary_theme_color', 'option' ) ? : '#477982';
  $octonary = get_field( 'octonary_theme_color', 'option' ) ? : '#477982';
	$nonary = get_field( 'nonary_theme_color', 'option' ) ? : '#3F5563';
  $denary = get_field( 'denary_theme_color', 'option' ) ? : '#3D403F';
  $eleven = get_field( 'eleven_theme_color', 'option' ) ? : '#477982';
  $twelve = get_field( 'twelve_theme_color', 'option' ) ? : '#477982';
	$gray = get_field( 'gray_theme_color', 'option' ) ? : '#F6F6F6';
  $color_array = array(                                                              
    'primary' => 'Palm',                                                          
    'secondary' => 'Ferm',                                                
    'tertiary' => 'Shoreline',                                                      
    'quaternary' => 'Soft Sand',  
		'quinary' => 'Dawn',  
		'senary' => 'Dusk',
		'septenary' => 'Sea Foam', 
		'octonary' => 'Red Sand', 
		'nonary' => 'Surface Blue', 
		'denary' => 'Marine Blue', 
		'eleven' => 'Ultraviolet', 
		'twelve' => 'Deepsea', 
		'gray' => 'Gray',
		'white' => 'White',
		'black' => 'Black'
  );                                                                                 
  $colors = array(                                                                   
    'primary' => $primary,                                                
    'secondary' => $secondary,                                                      
    'tertiary' => $tertiary,  
		'quaternary' => $quaternary,  
		'quinary' => $quinary,
		'senary' => $senary,
		'septenary' => $septenary,                                                          
    'octonary' => $octonary,                                                
    'nonary' => $nonary,                                                      
    'denary' => $denary,  
		'eleven' => $eleven,  
		'twelve' => $twelve,
		'gray' => $gray,
		'white' => '#ffffff',
		'black' => '#000000',
  );                                                                                 
  $choices = array();                                                                
  foreach( $color_array as $key => $label )                                          
  {
		$styles = 'padding: 10px; font-size: 0; background-color: ' . $colors[$key] .';';
		if($label == 'White' || $label == 'Light Gray') {
			$styles .= 'color: #000;';
		} else {
			$styles .= 'color: #fff;';
		}
    $choices[$key] = "<div style='".$styles."'>$label</div>";
  }                                                                                  
                                                                                     
  $field['choices'] = $choices;                                                      
  return $field;                                                                     
}  

// Fix Active Color Toggle Styles
function my_acf_admin_head() { ?>
	<style type="text/css">
		.acf-button-group label.selected {
			background-color: #eaeaea !important;
			border-color: #eaeaea !important;
		}
	</style>
<?php }

add_action('acf/input/admin_head', 'my_acf_admin_head');

/** 
  * Custom Image Sizes
  */

add_action( 'after_setup_theme', 'custom_image_sizes' );
function custom_image_sizes() {
    /* New image size for HD images */
    add_image_size( 'full_hd', 1920, 1080, $crop = true );
		/* New image size for hero images */
    add_image_size( 'hero_image', 1920, 900, $crop = true );
    /* New image size for featured images */
    add_image_size( 'featured_image', 1920, 768, $crop = true );
    /* New image size for image & content blocks */
    add_image_size( 'image_content_block', 768, 615, $crop = true );
    /* New image size for half-width blocks */
    add_image_size( 'half_width_block', 768, 460, $crop = true );
}

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

// Add a link to launch the frontend page editor to the admin bar
add_action('admin_bar_menu', 'add_toolbar_items', 100);
function add_toolbar_items($admin_bar){
		$current_page_url = $_SERVER['REQUEST_URI'];
		$editor_active = (!empty($_GET['frontend_editor']) && $_GET['frontend_editor'] == 'true');
		if($editor_active) {
			$editor_title = 'Close Editor';
			$editor_link = strtok($current_page_url, '?');
		} else {
			$editor_title = 'Frontend Editor';
			$editor_link = $current_page_url . '?frontend_editor=true';
		}
		$admin_bar->add_menu( array(
				'id'    => 'frontend-editor-toggle',
				'title' => $editor_title,
				'href'  => $editor_link,
				'meta'  => array(
						'title' => __('Frontend Editor'),            
				),
		));
}

/**
 *
 * Save updated POST data from front end content editor
 *
 */

add_shortcode( 'front-end-editor', 'front_end_editor_shortcode' );

function front_end_editor_shortcode() {

    if ( ! is_admin() ) {
        require_once( ABSPATH . 'wp-admin/includes/template.php' );
    }

    // current post id
    $post_id = get_the_ID();
    $post    = get_post( $post_id, OBJECT, 'edit' );
    $content = $post->post_content; // current content

    // editor settings
    $editor_id = 'mycustomeditor';
    $settings  = array (
            'wpautop'          => true,   // Whether to use wpautop for adding in paragraphs. Note that the paragraphs are added automatically when wpautop is false.
            'media_buttons'    => true,   // Whether to display media insert/upload buttons
            'textarea_name'    => $editor_id,   // The name assigned to the generated textarea and passed parameter when the form is submitted.
            'textarea_rows'    => get_option( 'default_post_edit_rows', 10 ),  // The number of rows to display for the textarea
            'tabindex'         => '',     // The tabindex value used for the form field
            'editor_css'       => '',     // Additional CSS styling applied for both visual and HTML editors buttons, needs to include <style> tags, can use "scoped"
            'editor_class'     => '',     // Any extra CSS Classes to append to the Editor textarea
            'teeny'            => false,  // Whether to output the minimal editor configuration used in PressThis
            'dfw'              => false,  // Whether to replace the default fullscreen editor with DFW (needs specific DOM elements and CSS)
            'tinymce'          => true,   // Load TinyMCE, can be used to pass settings directly to TinyMCE using an array
            'quicktags'        => true,   // Load Quicktags, can be used to pass settings directly to Quicktags using an array. Set to false to remove your editor's Visual and Text tabs.
            'drag_drop_upload' => true    // Enable Drag & Drop Upload Support (since WordPress 3.9)
    );

		// display the editor
    wp_editor( $content, $editor_id, $settings );

    // display the submit button
    submit_button( 'Save Content' );

    // add javaScript to handle the submit button click,
    // and send the form data to WP backend,
    // then refresh on success.
    ?>
    <script>
			(function($) {
				$('#submit').on ('click', function(e) {
					var content = $('#mycustomeditor').val ();
					$.post ('<?php echo get_admin_url( null, '/admin-post.php' ) ?>',
					{
							action: 'front_end_submit',
							id: '<?php echo get_the_ID(); ?>',
							content: content
					},
					function(response) {

							// looks good
							console.log (response);

							// reload the latest content
							window.location.reload();
					});
				});
			}) (jQuery);
    </script>
    <?php
}

// Set anchor link in ACF Form return value to that of whichever block was just updated

add_filter('acf/save_post' , 'ncchr_redirect_anchor' );

function ncchr_redirect_anchor($post_id) {
	if( $post_id != 'new' ) {
		$current_block_id = (isset($_POST['current_block']) ? $_POST['current_block'] : '');
		if($current_block_id) {
			wp_redirect(get_permalink($post_id) . '/?frontend_editor=true&updated=true&block_id=' . $current_block_id );	
			exit;
		}
	}
}
