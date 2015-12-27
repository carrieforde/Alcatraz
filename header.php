<?php
/**
 * Template for displaying our header.
 *
 * This template displays all of the <head> section and everything up until <div id="content">
 *
 * @package alcatraz
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'alcatraz_before' ); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'alcatraz' ); ?></a>

	<?php do_action( 'alcatraz_before_header' ); ?>

	<header id="site-header" class="site-header" role="banner">

		<?php do_action( 'alcatraz_before_header_inside' ); ?>

		<div class="header-inner">

			<?php do_action( 'alcatraz_header' ); ?>

		</div>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="menu-text"><?php esc_html_e( 'Menu', 'alcatraz' ); ?></span>
				<span class="menu-toggle-span span-1"></span>
				<span class="menu-toggle-span span-2"></span>
				<span class="menu-toggle-span span-3"></span>
			</div>
			<div class="menu-overlay"></div>
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'container_id'   => 'primary-menu-wrap',
			) ); ?>
			<div id="mobile-nav-left-swipe-zone"></div>
			<div id="mobile-nav-right-swipe-zone"></div>
		</nav>

		<?php endif; ?>

		<?php do_action( 'alcatraz_after_header_inside' ); ?>

	</header>

	<?php do_action( 'alcatraz_after_header' ); ?>

	<?php do_action( 'alcatraz_before_content' ); ?>

	<div id="content" class="site-content">

		<?php do_action( 'alcatraz_before_content_inside' ); ?>
