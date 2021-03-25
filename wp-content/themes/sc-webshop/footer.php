<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sc-webshop
 */

?>

	<footer id="page-footer" class="">
		<div class="footer-wrap py-5 mb-4">
			<div class="footer-logo">
				<a href="<?php echo esc_url( home_url() ); ?>" rel="home">
					<?php if ( has_site_icon() ) : ?>
						<img src="<?php site_icon_url(); ?>" alt="<?php bloginfo(); ?>" />
					<?php else : ?>
						<?php the_custom_logo(); ?>
					<?php endif; ?>
				</a>
			</div>
			<div class="contact">
				<h6 class="mb-3">Contact</h6>
				<p><small>Company Name</small></p>
				<p><small>hello@company.com<br />
				+91 999 11 11 111</small></p>
			</div>
			<div class="address">
				<h6 class="mb-3">Address</h6>
				<p><small>Sakshi Towers, 1st St. Kazura Garden<br />
				Palavakkam, Chennai, 600041<br />
				Tamil Nadu, Indien</small></p>
			</div>
			<div class="social">
				<h6 class="mb-3">Social Media</h6>
			</div>
		</div>
		<div class="footer-menu-wrapper">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => true,
					'menu_class'     => 'nav',
					'fallback_cb'    => '',
					'menu_id'        => 'footer-menu',
					'depth'          => 1,
					'walker'         => new WP_Bootstrap_Navwalker(),
				)
			);
			?>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
