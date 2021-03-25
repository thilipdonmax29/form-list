<?php
/**
 * Sc-webshop functions and definitions
 *
 * @package Sc-webshop
 */

/**
 * Theme support and setup.
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Editor setup.
 */
require get_template_directory() . '/inc/editor-setup.php';

/**
 * Load acf functions.
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Register Bootstrap Navigation Walker.
 */
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

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
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}



/**
 * Custom Post Type -  Exercise Bench
 */

require get_stylesheet_directory() . '/inc/recipe-post-type.php';


/**
 * Custom Patterns
 */

 require get_template_directory(). '/inc/patterns/my-custom-block-patterns.php';


//require get_template_directory(). '/inc/test.php';

require get_template_directory(). '/inc/contact-form-list.php';
