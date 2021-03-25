<?php
/**
 * Editor setup, colors, font-sizes, etc.
 *
 * @package sc-webshop
 */

add_action( 'after_setup_theme', 'sc_webshop_editor_setup' );

/**
 * Setup Editor.
 *
 * @return void
 */
function sc_webshop_editor_setup() {

	/**
	 * Block Color Palettes.
	 */
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name' => __( 'Primary', 'sc-webshop' ),
				'slug' => 'primary',
				'color' => '#007bff',
			),
			array(
				'name' => __( 'Secondary', 'sc-webshop' ),
				'slug' => 'secondary',
				'color' => '#6c757d',
			),
			array(
				'name' => __( 'Success', 'sc-webshop' ),
				'slug' => 'success',
				'color' => '#28a745',
			),
			array(
				'name' => __( 'Info', 'sc-webshop' ),
				'slug' => 'info',
				'color' => '#17a2b8',
			),
			array(
				'name' => __( 'Warning', 'sc-webshop' ),
				'slug' => 'warning',
				'color' => '#ffc107',
			),
			array(
				'name' => __( 'Danger', 'sc-webshop' ),
				'slug' => 'danger',
				'color' => '#dc3545',
			),
			array(
				'name' => __( 'Gray', 'sc-webshop' ),
				'slug' => 'gray',
				'color' => '#f8f9fa',
			),
			array(
				'name' => __( 'White', 'sc-webshop' ),
				'slug' => 'white',
				'color' => '#fff',
			),
			array(
				'name' => __( 'Black', 'sc-webshop' ),
				'slug' => 'black',
				'color' => '#000',
			),
		)
	);

	/**
	 * Block Font Sizes.
	 */
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => __( 'Small', 'sc-webshop' ),
				'size' => 12,
				'slug' => 'small',
			),
			array(
				'name' => __( 'Regular', 'sc-webshop' ),
				'size' => 16,
				'slug' => 'regular',
			),
			array(
				'name' => __( 'Lead', 'sc-webshop' ),
				'size' => 22,
				'slug' => 'lead',
			)
		)
	);
}
