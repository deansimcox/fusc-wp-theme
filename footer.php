<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

	</div><!-- .container -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'primary-menu',
					 ) );
				?>
			</nav><!-- .main-navigation -->
		<?php endif; ?>

		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					) );
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>

		<div class="site-info">
			<?php
				/**
				 * Fires before the twentysixteen footer text for footer customization.
				 *
				 * @since Twenty Sixteen 1.0
				 */
				do_action( 'twentysixteen_credits' );
			?>
			<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->
	
	<footer class="site-footer">
		<aside class="site-footer_sponsors">
			<div class="container">
				<a title="fosters group" target="_new" href="https://fostersgroup.com/"><img alt="fosters group" src="images/sponsors/fosters-group.png"></a><a title="prestige poultry" target="_new" href="http://fusc.org.au"><img alt="prestige poultry" src="images/sponsors/prestige-poultry.jpg"></a><a title="kelme" target="_new" href="http://www.kelme.com.au/"><img alt="kelme" src="images/sponsors/kelme.svg"></a><a title="Crazy Domains" target="_new" href="http://www.crazydomains.com.au/"><img alt="Crazy Domains" src="images/sponsors/crazy-domains.png"></a><a title="lawsons commercial flooring" target="_new" href="http://www.whitepages.com.au/business-listing/lawsons-commercial-flooring-1106062/cockburn-central-wa"><img alt="lawsons commercial flooring" src="images/sponsors/lawsons-commercial-flooring.png"></a><a title="b &amp; l pumps" target="_new" href="http://www.blpumps.com.au/"><img alt="b &amp; l pumps" src="images/sponsors/b_l_pumps.jpg"></a><a title="kalamunda toyota" target="_new" href="http://www.kalamundatoyota.com.au"><img alt="kalamunda toyota" src="images/sponsors/kalamunda-toyota.png"></a><a title="jayde transport" target="_new" href="http://www.jayde.com.au/"><img alt="jayde transport" src="images/sponsors/jayde-transport.png"></a><a title="craig mostyn group" target="_new" href="http://www.craigmostyn.com.au/"><img alt="craig mostyn group" src="images/sponsors/craig-mostyn-group.png"></a><a title="ACS Fabrication" target="_new" href="http://www.acsfabrication.com.au"><img alt="ACS Fabrication" src="http://www.acsfabrication.com.au/wp-content/themes/titan/images/logo.png"></a><a title="pro weld" target="_new" href="http://proweldconstructions.com/"><img alt="pro weld" src="images/sponsors/pro-weld.png"></a><a title="professionals" target="_new" href="www.professionals.com.au/"><img alt="professionals" src="images/sponsors/professionals.jpg"></a><a title="aerison" target="_new" href="http://www.aerison.com"><img alt="aerison" src="images/sponsors/aerison.png"></a><a title="bendigo bank" target="_blank" href="https://www.bendigobank.com.au/"><img alt="bendigo bank" src="images/sponsors/bendigo-bank.svg"></a><a title="Sas and Lees" target="_new" href="https://www.facebook.com/Sas-Lees-Hairstylists-134131593339341/"><img alt="Sas and Lees" src="images/sponsors/sas_and_lees2.jpg"></a><a title="high wycombe tavern" target="_new" href="http://www.highwycombetavern.com.au/"><img alt="high wycombe tavern" src="images/sponsors/high-wycombe-tavern.png"></a><a title="aquasports marine" target="_new" href="http://www.aquasportsmarine.com.au/"><img alt="aquasports marine" src="images/sponsors/aqua-sports-marine.png"></a>
			</div>
		</aside>
		<div class="container">
			<div class="site-footer_logo-wrap">
				<div class="site-footer_logo"><img src="images/logo-fusc-white.svg"></div>
			</div>
			<div class="site-footer_main">
				<p class="copyright">© Copyright 2016 Forrestfield United Soccer Club</p>
			</div>
		</div>
	</footer>
</div><!-- .page-viewport -->

<?php wp_footer(); ?>
</body>
</html>
