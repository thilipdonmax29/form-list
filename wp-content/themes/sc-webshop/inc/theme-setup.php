<?php
/**
 * Theme setup and support.
 *
 * @package WordPress
 * @subpackage SC_Webshop_Theme
 */

add_action( 'after_setup_theme', 'sc_webshop_setup' );
add_action( 'after_setup_theme', 'sc_webshop_content_width', 0 );
add_action( 'widgets_init', 'sc_webshop_widgets_init' );
add_action( 'wp_enqueue_scripts', 'sc_webshop_assets' );
add_action( 'admin_enqueue_scripts', 'sc_webshop_admin_assets' );
add_action( 'enqueue_block_editor_assets', 'sc_webshop_editor_assets' );


// Require the composer autoload for getting conflict-free access to enqueue.
require_once __DIR__ . '/../vendor/autoload.php';

// Instantiate.
$theme_info = wp_get_theme();
$sc_webshop_autoload_enqueue = new \WPackio\Enqueue( 'sc_webshop', 'dist', $theme_info->get( 'Version' ), 'theme', __FILE__ );

if ( ! function_exists( 'sc_webshop_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sc_webshop_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on sc_webshop, use a find and replace
		 * to change 'sc_webshop' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sc-webshop', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		// add_theme_support( 'automatic-feed-links' );.

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'sc-webshop' ),
				'footer'  => esc_html__( 'Footer', 'sc-webshop' ),
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
			)
		);

		// Add align wide support.
		add_theme_support( 'align-wide' );

		// Disable custom font-size controls in editor.
		add_theme_support( 'disable-custom-font-sizes' );

		// Disable custom color controls in editor.
		add_theme_support( 'disable-custom-colors' );

		// Responsive embed classes.
		add_theme_support( 'responsive-embeds' );

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
	}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sc_webshop_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'sc_webshop_content_width', 960 );
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sc_webshop_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'sc-webshop' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sc-webshop' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

/**
 * Enqueue scripts and styles.
 */
function sc_webshop_assets() {
	$theme_info = wp_get_theme();

	wp_enqueue_style( 'sc-webshop-google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap', array(), $theme_info->get( 'Version' ) );

	wp_deregister_script( 'jquery' ); // Remove default jQuery version.
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', true );
	wp_enqueue_script( 'vaidation_script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js', array(), '1.19.1', true );

	global $sc_webshop_autoload_enqueue;
	$assets = $sc_webshop_autoload_enqueue->enqueue(
		'theme',
		'main',
		array(
			'js'        => true,
			'css'       => true,
			'js_dep'    => array( 'jquery' ),
			'css_dep'   => array(),
			'in_footer' => true,
			'media'     => 'all',
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Enqueue wp-admin scripts and styles.
 */
function sc_webshop_admin_assets() {
	global $sc_webshop_autoload_enqueue;
	$assets = $sc_webshop_autoload_enqueue->enqueue(
		'theme',
		'admin',
		array(
			'js'        => true,
			'css'       => true,
			'js_dep'    => array( 'jquery' ),
			'css_dep'   => array(),
			'media'     => 'all',
		)
	);
}

/**
 * Enqueue editor scripts and styles.
 */
function sc_webshop_editor_assets() {
	global $sc_webshop_autoload_enqueue;
	$assets = $sc_webshop_autoload_enqueue->enqueue(
		'theme',
		'editor',
		array(
			'js'      => true,
			'css'     => true,
			'js_dep'  => array( 'wp-hooks', 'wp-i18n', 'wp-compose', 'wp-element', 'wp-block-editor', 'wp-components' ),
			'css_dep' => array(),
			'media'   => 'all',
		)
	);
}

/**
 * Register the Pattern block categories
 */
function sc_webshop_pattern_register_block_categories() {
	if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {

		register_block_pattern_category(
			'muscles',
			array( 'label' => __( 'Muscles', 'Block pattern category', 'sc-webshop' ) )
		);

	}
}
add_action( 'init', 'sc_webshop_pattern_register_block_categories' );

