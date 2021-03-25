<?php
/**
 * Displays Recipe posts.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header(); ?>

<div class="wrapper recipe-archive" id="page-wrapper">
     <main class="site-main" id="main-content">
                <div class="container">
                    <?php
                        set_query_var( 'archive_page_field', 'test_archive_page' );
                        get_template_part( 'parts/archive-page-selector' );
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <h6 class="latst-tile">Senaste</h6>
                        </div>
                    </div>
                </div>

                    <!-- Loop for first 4 Post  Starts-->
                    <div class="container first">
                        <div class="row">
                        <?php

                        $category = get_categories (
							array(
								'post_type'   => 'recipe',
								'numberposts' => -1,
								'taxonomy'    => 'recipecategory',
							)
						);

						$c_keep = array();
						?>

						<div class="row">
						<?php
						foreach( $category as  $c ) {
							$c->short_description = get_field('short_description', 'category_'.$c->term_id);
							$c->image = get_field('category_image', 'category_'.$c->term_id);
							$c->link = get_category_link($c->cat_ID);
							//var_dump($c->slug);
							$c_keep[] = $c;
							?>
							<div class="col-lg-4">
								<a href="<?php echo $c->link; ?>"><img src="<?php echo $c->image['url'] ?>" alt=""></a>
								</div>
							<?php
						}

						?>
						</div>
                        </div>
                    </div>
                    <!-- Loop for first 4 Post  Ends-->
                </main><!-- #main -->
</div><!-- Wrapper end -->

<?php get_footer(); ?>
