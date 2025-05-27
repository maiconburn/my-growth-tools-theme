<?php
/**
 * My Growth Tools functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package My_Growth_Tools
 */

if ( ! defined( 'MY_GROWTH_TOOLS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'MY_GROWTH_TOOLS_VERSION', '1.0.5' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function my_growth_tools_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'my-growth-tools', get_template_directory() . '/languages' );

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

	// Set default thumbnail size
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image sizes
	add_image_size( 'my-growth-tools-featured', 1200, 600, true );
	add_image_size( 'my-growth-tools-card', 600, 400, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'my-growth-tools' ),
			'footer'  => esc_html__( 'Footer Menu', 'my-growth-tools' ),
			'social'  => esc_html__( 'Social Links Menu', 'my-growth-tools' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'my_growth_tools_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for custom color scheme.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => esc_html__( 'Primary', 'my-growth-tools' ),
			'slug'  => 'primary',
			'color' => '#ff3366',
		),
		array(
			'name'  => esc_html__( 'Secondary', 'my-growth-tools' ),
			'slug'  => 'secondary',
			'color' => '#3366ff',
		),
		array(
			'name'  => esc_html__( 'Dark Gray', 'my-growth-tools' ),
			'slug'  => 'dark-gray',
			'color' => '#333333',
		),
		array(
			'name'  => esc_html__( 'Light Gray', 'my-growth-tools' ),
			'slug'  => 'light-gray',
			'color' => '#f9f9f9',
		),
		array(
			'name'  => esc_html__( 'White', 'my-growth-tools' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
	) );

	// Add support for custom font sizes.
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => esc_html__( 'Small', 'my-growth-tools' ),
			'shortName' => esc_html__( 'S', 'my-growth-tools' ),
			'size'      => 14,
			'slug'      => 'small',
		),
		array(
			'name'      => esc_html__( 'Normal', 'my-growth-tools' ),
			'shortName' => esc_html__( 'M', 'my-growth-tools' ),
			'size'      => 16,
			'slug'      => 'normal',
		),
		array(
			'name'      => esc_html__( 'Large', 'my-growth-tools' ),
			'shortName' => esc_html__( 'L', 'my-growth-tools' ),
			'size'      => 20,
			'slug'      => 'large',
		),
		array(
			'name'      => esc_html__( 'Huge', 'my-growth-tools' ),
			'shortName' => esc_html__( 'XL', 'my-growth-tools' ),
			'size'      => 24,
			'slug'      => 'huge',
		),
	) );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'my_growth_tools_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function my_growth_tools_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'my_growth_tools_content_width', 1200 );
}
add_action( 'after_setup_theme', 'my_growth_tools_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function my_growth_tools_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'my-growth-tools' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'my-growth-tools' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'my-growth-tools' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 1.', 'my-growth-tools' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'my-growth-tools' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 2.', 'my-growth-tools' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'my-growth-tools' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 3.', 'my-growth-tools' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 4', 'my-growth-tools' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 4.', 'my-growth-tools' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'my_growth_tools_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function my_growth_tools_scripts() {
	// Enqueue Google Fonts: Inter & DM Sans
	wp_enqueue_style( 'my-growth-tools-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@400;500;600;700&display=swap', array(), null );

	// Main stylesheet
	wp_enqueue_style( 'my-growth-tools-style', get_stylesheet_uri(), array(), MY_GROWTH_TOOLS_VERSION );
	
	// Responsive styles
	wp_enqueue_style( 'my-growth-tools-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), MY_GROWTH_TOOLS_VERSION );
	
	// Theme script
	wp_enqueue_script( 'my-growth-tools-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), MY_GROWTH_TOOLS_VERSION, true );
	
	// Theme script
	wp_enqueue_script( 'my-growth-tools-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), MY_GROWTH_TOOLS_VERSION, true );

	// Localize script for AJAX
	wp_localize_script(
		'my-growth-tools-theme',
		'myGrowthToolsTheme',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'my_growth_tools_newsletter_nonce' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_growth_tools_scripts' );

/**
 * AJAX handler for newsletter subscription.
 */
function my_growth_tools_newsletter_ajax_handler() {
	// Verify nonce
	check_ajax_referer( 'my_growth_tools_newsletter_nonce', 'nonce' );

	// Get email from POST data
	$email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';

	// Validate email
	if ( ! is_email( $email ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Invalid email address provided.', 'my-growth-tools' ),
			)
		);
	}

	// At this point, the email is considered valid.
	// TODO: Add actual email processing logic here (e.g., save to database, send to Mailchimp, etc.)

	// Send success response (stub)
	wp_send_json_success(
		array(
			'message' => esc_html__( 'Thank you for subscribing! (This is a stub response)', 'my-growth-tools' ),
		)
	);
}
add_action( 'wp_ajax_my_growth_tools_subscribe_newsletter', 'my_growth_tools_newsletter_ajax_handler' );
add_action( 'wp_ajax_nopriv_my_growth_tools_subscribe_newsletter', 'my_growth_tools_newsletter_ajax_handler' );






/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom excerpt length
 */
function my_growth_tools_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'my_growth_tools_excerpt_length', 999 );

/**
 * Custom excerpt more
 */
function my_growth_tools_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'my_growth_tools_excerpt_more' );
