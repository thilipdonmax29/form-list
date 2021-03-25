<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Sc-webshop
 */

add_action( 'after_setup_theme', 'sc_webshop_woocommerce_setup' );
add_action( 'init', 'sc_webshop_wc_remove_actions' );
add_action( 'wp_enqueue_scripts', 'sc_webshop_woocommerce_scripts' );
// Disable the default WooCommerce stylesheet.
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter( 'body_class', 'sc_webshop_woocommerce_active_body_class' );
add_filter( 'loop_shop_per_page', 'sc_webshop_woocommerce_products_per_page' );
add_filter( 'woocommerce_product_thumbnails_columns', 'sc_webshop_woocommerce_thumbnail_columns' );
add_filter( 'loop_shop_columns', 'sc_webshop_woocommerce_loop_columns' );
add_filter( 'woocommerce_output_related_products_args', 'sc_webshop_woocommerce_related_products_args' );
add_action( 'woocommerce_before_shop_loop', 'sc_webshop_woocommerce_product_columns_wrapper', 40 );
add_action( 'woocommerce_after_shop_loop', 'sc_webshop_woocommerce_product_columns_wrapper_close', 40 );
add_action( 'woocommerce_before_main_content', 'sc_webshop_woocommerce_wrapper_before' );
add_action( 'woocommerce_before_main_content', 'woocommerce_output_all_notices', 15 );
add_action( 'woocommerce_after_main_content', 'sc_webshop_woocommerce_wrapper_after' );
add_filter( 'woocommerce_add_to_cart_fragments', 'sc_webshop_woocommerce_cart_link_fragment' );
add_action( 'woocommerce_before_shop_loop', 'sc_webshop_wc_before_shop', 5 );
add_action( 'woocommerce_after_shop_loop', 'sc_webshop_wc_after_shop', 999 );
add_action( 'init', 'sc_webshop_wc_remove_product_single_actions' );

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function sc_webshop_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	// add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

/**
 * Remove WooCommerce actions.
 *
 * @return void
 */
function sc_webshop_wc_remove_actions() {
	// Remove sidebar on woo pages.
	// remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	// Remove shop page actions.
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function sc_webshop_woocommerce_scripts() {

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'sc-webshop-woocommerce-style', $inline_font );
}

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function sc_webshop_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function sc_webshop_woocommerce_products_per_page() {
	return 12;
}

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function sc_webshop_woocommerce_thumbnail_columns() {
	return 4;
}

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function sc_webshop_woocommerce_loop_columns() {
	return 3;
}

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function sc_webshop_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}

if ( ! function_exists( 'sc_webshop_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function sc_webshop_woocommerce_product_columns_wrapper() {
		$columns = sc_webshop_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}

if ( ! function_exists( 'sc_webshop_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function sc_webshop_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'sc_webshop_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function sc_webshop_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}


if ( ! function_exists( 'sc_webshop_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function sc_webshop_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'sc_webshop_woocommerce_header_cart' ) ) {
			sc_webshop_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'sc_webshop_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function sc_webshop_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		sc_webshop_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

if ( ! function_exists( 'sc_webshop_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function sc_webshop_woocommerce_cart_link() {
		?>
		<a class="cart-contents" data-toggle="collapse" href="#site-header-cart" aria-controls="site-header-cart" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle cart', 'sc-webshop' ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'sc-webshop' ); ?>">
			<i class="fas fa-shopping-cart"></i>
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'sc-webshop' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'sc_webshop_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function sc_webshop_woocommerce_header_cart() {
		?>
		<div id="site-header-cart" class="site-header-cart slide-in-menu right">
			<?php
			$instance = array(
				'title' => '',
			);

			the_widget( 'WC_Widget_Cart', $instance );
			?>
		</div>
		<?php
	}
}

function sc_webshop_wc_before_shop() {
	?>
	<div class="woocommerce-shop-wrapper">
	<?php
}

function sc_webshop_wc_after_shop() {
	?>
	</div>
	<?php
}

/**
 * Woo Single Product Page
 */

/**
 * Remove product single actions.
 *
 * @return void
 */
function sc_webshop_wc_remove_product_single_actions() {
	// remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	// remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
	// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}
