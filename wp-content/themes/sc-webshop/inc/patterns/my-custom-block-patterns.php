<?php
/*
Description: Adds a custom block pattern to the Gutenberg block editor.
Version: 1.0
Author: thilip
Author URI: http://splitchennai.com/
*/

/**
 * Register the custom patten for top section
 *
 * @return void
 */
function my_custom_wp_block_patterns() {

	register_block_pattern(
		'sc-webshop/my-custom-pattern',
		array(
			'title'       => __( 'Top Section Pattern', 'sc-webshop' ),

			'description' => _x( 'Includes a cover block, two columns with headings and text, a separator and a single-column text block.', 'Block pattern description', 'page-intro-block' ),

			'content'     => "<!-- wp:group -->\n<div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":32,\"sizeSlug\":\"large\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"http://testwebsite.local/wp-content/uploads/2020/12/image-5@3x-1024x451.png\" alt=\"\" class=\"wp-image-32\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":\"66.66%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:heading {\"level\":1} -->\n<h1>Övningsbank för alla muskler</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"fontSize\":\"lead\"} -->\n<p class=\"has-lead-font-size\">I vår övningsbank hittar du styrkeövningar för alla kroppens olika muskelgrupper. Samtliga styrketräningsövningar beskrivs med illustrationer och tillhörande tips och råd gällande teknik och utförande. På så sätt kan du utföra övningarna var du vill, på rätt sätt</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:group -->",

			'categories'  => array( 'muscles' ),
		)
	);

}
add_action( 'init', 'my_custom_wp_block_patterns' );
