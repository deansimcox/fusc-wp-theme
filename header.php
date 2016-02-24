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
	<header class="site-header">
		<div class="site-header_main">
			<div class="site-header_main-shade"></div>
			<menu class="site-header_menu-mob">
				<button class="site-header_menu-mob-search"><span class="visuallyhidden">Search</span><span class="fa fa-search"></span></button>
				<button class="site-header_menu-mob-nav"><span class="visuallyhidden">Navigation</span><span class="fa fa-bars"></span></button>
			</menu>
			<div class="site-header_main-left"><a href="" title="UWA" class="site-header_logo-link"><img src="images/logo-fusc.svg" alt="Site Logo" height="146" width="141" class="site-header_logo"></a>
				<p class="site-header_title">Forrestfield United Soccer Club</p>
			</div>
			<div class="site-header_main-right">
				<div class="site-header_search-wrap">
					<form id="site-header_search" class="site-header_search">
						<input type="text" placeholder="Search this site" class="site-header_search-input">
						<button class="site-header_search-btn"><span class="visuallyhidden">Submit</span><span class="fa fa-search"></span></button>
					</form>
				</div>
			</div>
		</div>
		<nav id="primary-nav" class="primary-nav">
			<ul>
				<li class="active"><a href="index.html"><span class="link-wrap">Home</span></a></li>
				<li><a href="club-info.html"><span class="link-wrap">Club Info</span></a></li>
				<li><a href="news.html"><span class="link-wrap">News</span></a></li>
				<li><a href="fixtures-results.html"><span class="link-wrap">Fixture &amp; Results</span></a></li>
				<li><a href="noticeboard.html"><span class="link-wrap">Noticeboard</span></a></li>
				<li><a href="teams.html"><span class="link-wrap">Teams</span></a></li>
				<li><a href="sponsors.html"><span class="link-wrap">Sponsors</span></a></li>
				<li><a href="merchandise.html"><span class="link-wrap">Merchandise</span></a></li>
			</ul>
		</nav>
		<button class="nav-close-mob"><span class="visuallyhidden">Close navigation</span></button>
	</header>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-header-main">
			<div class="site-branding">
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
				<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'twentysixteen' ); ?></button>

				<div id="site-header-menu" class="site-header-menu">
					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_class'     => 'primary-menu',
								 ) );
							?>
						</nav><!-- .main-navigation -->
					<?php endif; ?>

					<?php if ( has_nav_menu( 'social' ) ) : ?>
						<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentysixteen' ); ?>">
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
				</div><!-- .site-header-menu -->
			<?php endif; ?>
		</div><!-- .site-header-main -->

		<?php if ( get_header_image() ) : ?>
			<?php
				/**
				 * Filter the default twentysixteen custom header sizes attribute.
				 *
				 * @since Twenty Sixteen 1.0
				 *
				 * @param string $custom_header_sizes sizes attribute
				 * for Custom Header. Default '(max-width: 709px) 85vw,
				 * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
				 */
				$custom_header_sizes = apply_filters( 'twentysixteen_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
			?>
			<div class="header-image">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
			</div><!-- .header-image -->
		<?php endif; // End header image check. ?>
	</header><!-- .site-header -->

	<div class="container">
