<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="page-viewport">
	<!-- <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a> -->
	<div class="skip-links"><a href="#primary-nav">Skip to navigation</a><a href="#site-header_search">Skip to search</a></div>
	<header class="site-header" role="banner">
		<div class="site-header_main">
			<div class="site-header_main-shade"></div>
			<menu class="site-header_menu-mob">
				<button class="site-header_menu-mob-search"><span class="visuallyhidden">Search</span><span class="fa fa-search"></span></button>
				<button class="site-header_menu-mob-nav"><span class="visuallyhidden">Navigation</span><span class="fa fa-bars"></span></button>
			</menu>
			<div class="site-header_main-left">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" class="site-header_logo-link">
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo-fusc.svg" alt="Site Logo" height="146" width="141" class="site-header_logo">
				</a>
				<p class="site-header_title"><?php bloginfo( 'name' ); ?></p>
			</div>
			<div class="site-header_main-right">
				<div class="site-header_search-wrap">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
		<?php
			class wp_sublevel_walker extends Walker_Nav_Menu {
				function start_lvl( &$output, $depth = 0, $args = array() ) {
					$indent = str_repeat("\t", $depth);
					$output .= "\n$indent<div class='sub-menu-wrap'><ul class='sub-menu'>\n";
				}
				function end_lvl( &$output, $depth = 0, $args = array() ) {
					$indent = str_repeat("\t", $depth);
					$output .= "$indent</ul></div>\n";
				}
			}
			wp_nav_menu( array(
				'container' => 'nav',
				'container_class' => 'primary-nav',
				'container_id' => 'primary-nav',
				'link_before' => '<span class="link-wrap">',
				'link_after' => '</span>',
				'depth' => 0,
				'walker' => new wp_sublevel_walker
			) );
		?>
		<button class="nav-close-mob"><span class="visuallyhidden">Close navigation</span></button>
	</header>
