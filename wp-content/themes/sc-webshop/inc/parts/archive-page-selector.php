<?php
/**
 * Template Partial to Load Product Archive Page contents as a 'Page' from WP-Admin Dashboard.
 *
 * @package Sc-webshop
 */

$archive_page_selector = get_field( $archive_page_field, 'options' );
$args                  = array(
	'page_id' => $archive_page_selector,
);
$archive_page_query    = new WP_Query( $args );
if ( $archive_page_query->have_posts() ) :
	while ( $archive_page_query->have_posts() ) :
		$archive_page_query->the_post();
		get_template_part( 'template-parts/content' );
	endwhile;
endif;
?>

