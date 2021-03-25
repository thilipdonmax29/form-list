<?php
/**
 * Holy Talk post type functions
 *
 * @package WordPress
 * @subpackage webshop_Theme
 */

add_action( 'init', 'webshop_recipe_type' );
add_action( 'init', 'webshop_recipe_category_taxonomies', 0);
//add_filter( 'pre_get_posts', 'webshop_news_query' );

/**
 * Register News post type
 *
 * @return void
 */
function webshop_recipe_type() {
    // creating (registering) the custom type.
    register_post_type( 'recipe', // (http://codex.wordpress.org/Function_Reference/register_post_type).
        // let's now add all the options for this post type.
        array(
            'labels'              => array(
                'name'               => __( 'Recipe', 'webshop' ), /* This is the Title of the Group */
                'singular_name'      => __( 'recipe', 'webshop' ), /* This is the individual type */
                'all_items'          => __( 'All recipe', 'webshop' ), /* the all items menu item */
                'add_new'            => __( 'Add New', 'webshop' ), /* The add new menu item */
                'add_new_item'       => __( 'Add New recipe', 'webshop' ), /* Add New Display Title */
                'edit'               => __( 'Edit', 'webshop' ), /* Edit Dialog */
                'edit_item'          => __( 'Edit recipe', 'webshop' ), /* Edit Display Title */
                'new_item'           => __( 'New recipe', 'webshop' ), /* New Display Title */
                'view_item'          => __( 'View recipe', 'webshop' ), /* View Display Title */
                'search_items'       => __( 'Search recipe', 'webshop' ), /* Search Custom Type Title */
                'not_found'          => __( 'Nothing found in the Database.', 'webshop' ), /* This displays if there are no entries yet */
                'not_found_in_trash' => __( 'Nothing found in Trash', 'webshop' ), /* This displays if there is nothing in the trash */
                'parent_item_colon'  => '',
            ), /* end of arrays */
            'description'         => __( 'This is the example custom post type', 'webshop' ), /* Custom Type Description */
            'public'              => true,
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'query_var'           => true,
            'menu_position'       => 9, /* this is what order you want it to appear in on the left hand side menu */
            'menu_icon'           => 'dashicons-food', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
            'rewrite'	          => array( 'slug' => 'recipe', 'with_front' => false ), /* you can specify its url slug */
            'has_archive'         => 'recipe', /* you can rename the slug here */
            'capability_type'     => 'post',
            'hierarchical'        => false,
            /* the next one is important, it tells what's enabled in the post editor */
            'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'sticky', 'excerpt' ),
            'show_in_rest'        => true,
            //'taxonomies'          => array( 'news_category' ),
        ) /* end of options */
    ); /* end of register post type */

    flush_rewrite_rules();
}

function webshop_recipe_category_taxonomies() {

    $labels = array(
            'name'              => _x( 'recipe Category', 'taxonomy general name' ),
            'singular_name'     => _x( 'recipecategory', 'taxonomy singular name' ),
            'search_items'      => __( 'Search recipe Category' ),
            'all_items'         => __( 'All recipe Category' ),
            'parent_item'       => __( 'Parent recipe Category' ),
            'parent_item_colon' => __( 'Parent recipe Category:' ),
            'edit_item'         => __( 'Edit recipe Category' ),
            'update_item'       => __( 'Update recipe Category' ),
            'add_new_item'      => __( 'Add New recipe Category' ),
            'new_item_name'     => __( 'New recipe Category Name' ),
            'menu_name'         => __( 'Recipe Category' ),
        );
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'recipecategory' ),
        );

        register_taxonomy( 'recipecategory', array( 'recipe' ), $args );
    }
